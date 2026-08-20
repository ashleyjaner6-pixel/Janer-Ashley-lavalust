<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentMiddleware
{
    public function handle($next)
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $access_granted = ($_GET['access'] ?? '') === 'granted';

        if (!($_SESSION['student_access'] ?? false) && !$access_granted) {
            redirect('student?access=required');
            return;
        }

        $_SESSION['student_access'] = true;

        return $next();
    }
}