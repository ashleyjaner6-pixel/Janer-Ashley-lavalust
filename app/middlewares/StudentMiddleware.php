<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentMiddleware
{
    public function handle($next)
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $from_student_home = preg_match('#/student(?:\?.*)?$#', $_SERVER['HTTP_REFERER'] ?? '') === 1;

        if (!($_SESSION['student_access'] ?? false) && !$from_student_home) {
            redirect('student?access=required');
            return;
        }

        return $next();
    }
}