<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductApi extends Controller
{
    private $api;
    private $db;

    public function __construct()
    {
        parent::__construct();
        $this->api = $this->call->library('api');
        $this->db = null;
    }

    public function health()
    {
        $this->api->require_method('GET');
        $this->api->respond(['status' => 'ok']);
    }

    public function login()
    {
        $this->api->require_method('POST');
        $input = $this->request_body();
        $username = trim((string) ($input['username'] ?? ''));
        $password = (string) ($input['password'] ?? '');
        $adminUsername = getenv('ADMIN_USERNAME') ?: '';
        $passwordHash = getenv('ADMIN_PASSWORD_HASH') ?: '';

        if ($adminUsername === '' || $passwordHash === '') {
            $this->api->respond_error('Authentication is not configured', 503);
        }
        if (!hash_equals($adminUsername, $username) || !password_verify($password, $passwordHash)) {
            $this->api->respond_error('Invalid username or password', 401);
        }

        $now = time();
        $ttl = (int) config_item('payload_token_expiration');
        $claims = [
            'sub' => $adminUsername,
            'role' => 'admin',
            'iat' => $now,
            'exp' => $now + $ttl,
            'jti' => bin2hex(random_bytes(16)),
            'iss' => config_item('jwt_issuer'),
            'aud' => config_item('jwt_audience'),
        ];
        $token = $this->api->encode_jwt($claims);
        $this->database()->raw(
            'INSERT INTO auth_sessions (jti, expires_at) VALUES (?, FROM_UNIXTIME(?))',
            [$claims['jti'], $claims['exp']]
        );

        $this->api->respond([
            'access_token' => $token,
            'expires_in' => $ttl,
            'token_type' => 'Bearer',
            'username' => $adminUsername,
        ], 200);
    }

    public function logout()
    {
        $this->api->require_method('POST');
        $claims = $this->authenticated_user();
        $this->database()->raw('DELETE FROM auth_sessions WHERE jti = ?', [$claims['jti']]);
        $this->api->respond(['message' => 'Logged out']);
    }

    public function products()
    {
        $method = strtoupper($_SERVER['REQUEST_METHOD'] ?? '');
        if ($method === 'GET') {
            $this->index();
        }
        if ($method === 'POST') {
            $this->create();
        }
        $this->api->respond_error('Method Not Allowed', 405);
    }

    public function mutate($id)
    {
        $method = strtoupper($_SERVER['REQUEST_METHOD'] ?? '');
        if ($method === 'PUT' || $method === 'PATCH') {
            $this->update($id);
        }
        if ($method === 'DELETE') {
            $this->delete($id);
        }
        $this->api->respond_error('Method Not Allowed', 405);
    }

    private function index()
    {
        $this->authenticated_user();
        $stmt = $this->database()->raw(
            'SELECT id, product_name, description, price, quantity, created_at FROM products ORDER BY created_at DESC, id DESC'
        );
        $this->api->respond($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    private function create()
    {
        $this->authenticated_user();
        $product = $this->validated_product($this->request_body());
        $this->database()->raw(
            'INSERT INTO products (product_name, description, price, quantity) VALUES (?, ?, ?, ?)',
            [$product['product_name'], $product['description'], $product['price'], $product['quantity']]
        );
        $this->api->respond(['id' => (int) $this->database()->last_id()], 201);
    }

    private function update($id)
    {
        $this->authenticated_user();
        $productId = $this->validated_id($id);
        $product = $this->validated_product($this->request_body());
        $this->database()->raw(
            'UPDATE products SET product_name = ?, description = ?, price = ?, quantity = ? WHERE id = ?',
            [$product['product_name'], $product['description'], $product['price'], $product['quantity'], $productId]
        );
        $stmt = $this->database()->raw('SELECT id FROM products WHERE id = ?', [$productId]);
        if (!$stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->api->respond_error('Product not found', 404);
        }
        $this->api->respond(['message' => 'Product updated']);
    }

    private function delete($id)
    {
        $this->authenticated_user();
        $productId = $this->validated_id($id);
        $stmt = $this->database()->raw('DELETE FROM products WHERE id = ?', [$productId]);
        if ($stmt->rowCount() === 0) {
            $this->api->respond_error('Product not found', 404);
        }
        $this->api->respond(['message' => 'Product deleted']);
    }

    private function authenticated_user()
    {
        $claims = $this->api->require_jwt();
        if (($claims['iss'] ?? '') !== config_item('jwt_issuer') || ($claims['aud'] ?? '') !== config_item('jwt_audience') || empty($claims['jti'])) {
            $this->api->respond_error('Unauthorized', 401);
        }
        $stmt = $this->database()->raw(
            'SELECT jti FROM auth_sessions WHERE jti = ? AND expires_at > NOW()',
            [$claims['jti']]
        );
        if (!$stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->api->respond_error('Unauthorized', 401);
        }
        return $claims;
    }

    private function database()
    {
        if ($this->db === null) {
            $this->db = $this->call->database();
        }
        return $this->db;
    }

    private function request_body()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        if (!is_array($input)) {
            $this->api->respond_error('Request body must be valid JSON', 400);
        }
        return $input;
    }

    private function validated_product($input)
    {
        $name = trim((string) ($input['product_name'] ?? ''));
        $description = trim((string) ($input['description'] ?? ''));
        $price = $input['price'] ?? null;
        $quantity = filter_var($input['quantity'] ?? null, FILTER_VALIDATE_INT);

        if ($name === '' || mb_strlen($name) > 100) {
            $this->api->respond_error('Product name is required and must be at most 100 characters', 422);
        }
        if (mb_strlen($description) > 10000) {
            $this->api->respond_error('Description must be at most 10000 characters', 422);
        }
        if (!is_numeric($price) || !is_finite((float) $price) || (float) $price < 0 || (float) $price > 99999999.99) {
            $this->api->respond_error('Price must be a number between 0 and 99999999.99', 422);
        }
        if ($quantity === false || $quantity < 0) {
            $this->api->respond_error('Quantity must be a non-negative whole number', 422);
        }

        return [
            'product_name' => $name,
            'description' => $description,
            'price' => number_format((float) $price, 2, '.', ''),
            'quantity' => $quantity,
        ];
    }

    private function validated_id($id)
    {
        $productId = filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        if ($productId === false) {
            $this->api->respond_error('Invalid product id', 400);
        }
        return $productId;
    }
}