<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller {
    public function index() {
        $this->call->view('student/index');
    }

    public function profile() {
        $this->call->model('student', 'student_model');

        $data = [
            'student' => $this->student_model->get_profile(),
            'subjects' => $this->student_model->get_subjects(),
        ];

        $this->call->view('student/profile', $data);
    }
}
?>
