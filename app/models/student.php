<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Student extends Model {
    public function get_profile() {
        return [
            'student_no' => '2024-00172',
            'name' => 'Ashley Rhiene G. Janer',
            'course' => 'BS Information Technology',
            'year_level' => '3rd Year',
            'section' => '3-F4',
            'email' => 'ashleyjaner6@gmail.com',
            'address' => 'Tawiran, Calapan City, Oriental Mindoro',
        ];
    }

    public function get_subjects() {
        return [
            'Web Systems and Technologies',
            'Database Management Systems',
            'Object-Oriented Programming',
            'Data Structures and Algorithms',
        ];
    }
}
?>
