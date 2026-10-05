<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->call->model('UserModel');
    }

    public function index() {
        $this->login();
    }

    public function login() {
        $this->UserModel->ensure_table();

        if ($this->form_validation->submitted()) {
            $username = trim($this->io->post('username'));
            $password = $this->io->post('password');

            $user = $this->UserModel->find_by_username($username);
            if ($user && password_verify($password, $user['password_hash'])) {
                $this->session->set_userdata('logged_in', true);
                $this->session->set_userdata('username', $user['username']);
                $this->session->set_userdata('user_id', $user['id']);
                redirect('products');
                return;
            }

            $data['error'] = 'Invalid username or password';
            $this->call->view('auth/login', $data);
            return;
        }
        $this->call->view('auth/login');
    }

    public function register() {
        $this->UserModel->ensure_table();

        if ($this->form_validation->submitted()) {
            $username = trim($this->io->post('username'));
            $email = trim($this->io->post('email'));
            $password = $this->io->post('password');
            $confirm_password = $this->io->post('confirm_password');

            if (empty($username) || empty($email) || empty($password)) {
                $data['error'] = 'Please fill in all fields.';
                $this->call->view('auth/register', $data);
                return;
            }

            if ($password !== $confirm_password) {
                $data['error'] = 'Passwords do not match.';
                $this->call->view('auth/register', $data);
                return;
            }

            if ($this->UserModel->find_by_username($username)) {
                $data['error'] = 'That username is already taken.';
                $this->call->view('auth/register', $data);
                return;
            }

            if ($this->UserModel->find_by_email($email)) {
                $data['error'] = 'That email is already registered.';
                $this->call->view('auth/register', $data);
                return;
            }

            $user = [
                'username' => $username,
                'email' => $email,
                'password_hash' => password_hash($password, PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s')
            ];

            $user_id = $this->UserModel->create_user($user);
            $this->session->set_userdata('logged_in', true);
            $this->session->set_userdata('username', $username);
            $this->session->set_userdata('user_id', $user_id);
            redirect('products');
            return;
        }

        $this->call->view('auth/register');
    }

    public function logout() {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('user_id');
        redirect('auth/login');
    }
}