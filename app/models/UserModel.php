<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserModel extends Model
{
    protected $db;
    protected $table = 'users';
    protected $fillable = ['username', 'email', 'password', 'role', 'is_active'];

    public function __construct()
    {
        parent::__construct();
        $this->db = lava_instance()->db;
    }
}
