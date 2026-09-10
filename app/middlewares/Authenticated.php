<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Authenticated
{
    public function handle($next)
    {
        $session = lava_instance()->session;

        if (!$session->userdata('user_id')) {
            redirect('/login');
        }

        return $next();
    }
}
