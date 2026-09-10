<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Auth extends Controller
{
    public function before_action()
    {
        $this->call->model('UserModel');
    }

    public function login()
    {
        if ($this->session->userdata('user_id')) {
            redirect('/products');
        }

        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim((string) $this->request->post('email'));
            $password = (string) $this->request->post('password');
            $user = UserModel::find_by('email', $email);

            if (!$user && getenv('ADMIN_EMAIL') === $email && getenv('ADMIN_PASSWORD') === $password) {
                UserModel::insert([
                    'username' => getenv('ADMIN_USERNAME') ?: 'Administrator',
                    'email' => $email,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'role' => 'admin',
                    'is_active' => 1,
                ]);
                $user = UserModel::find_by('email', $email);
            }

            if ($user && (int) $user['is_active'] === 1 && password_verify($password, $user['password'])) {
                session_regenerate_id(true);
                $this->session->set_userdata([
                    'user_id' => $user['id'],
                    'user_email' => $user['email'],
                    'user_name' => $user['username'],
                ]);
                redirect('/products');
            }

            $error = 'The email or password is incorrect.';
        }

        $this->call->view('auth/login', ['error' => $error]);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/login');
    }
}
