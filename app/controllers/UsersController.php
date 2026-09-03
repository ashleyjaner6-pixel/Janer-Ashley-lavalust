<?php

class UsersController extends Controller
{
    public function index()
    {
        $users = $this->UsersModel->all();

        return $this->call->view('users', ['users' => $users]);
    }
}