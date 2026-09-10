<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Products extends Controller
{
    public function before_action()
    {
        $this->call->model('ProductModel');
    }

    private function product_data()
    {
        return [
            'product_name' => trim((string) $this->request->post('product_name')),
            'description' => trim((string) $this->request->post('description')),
            'price' => (float) $this->request->post('price'),
            'quantity' => (int) $this->request->post('quantity'),
        ];
    }

    private function validate($data)
    {
        if ($data['product_name'] === '' || strlen($data['product_name']) > 100) {
            return 'Product name is required and must be 100 characters or fewer.';
        }
        if ($data['price'] < 0 || $data['quantity'] < 0) {
            return 'Price and quantity cannot be negative.';
        }
        return null;
    }

    public function index()
    {
        $products = ProductModel::order_by('created_at', 'DESC');
        $this->call->view('products/index', [
            'products' => $products,
            'user_name' => $this->session->userdata('user_name'),
        ]);
    }

    public function create()
    {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->product_data();
            $error = $this->validate($data);
            if (!$error) {
                ProductModel::insert($data);
                redirect('/products');
            }
        }
        $this->call->view('products/form', ['product' => null, 'error' => $error, 'heading' => 'Add product']);
    }

    public function edit($id)
    {
        $product = ProductModel::find((int) $id);
        if (!$product) {
            redirect('/products');
        }

        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->product_data();
            $error = $this->validate($data);
            if (!$error) {
                ProductModel::update((int) $id, $data);
                redirect('/products');
            }
            $product = array_merge($product, $data);
        }
        $this->call->view('products/form', ['product' => $product, 'error' => $error, 'heading' => 'Edit product']);
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            ProductModel::delete((int) $id);
        }
        redirect('/products');
    }
}
