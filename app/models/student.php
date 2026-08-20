<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Student extends Model {
    public function get_profile() {
        return [
            'student_no' => '2026-0001',
            'name' => 'Your Name',
            'course' => 'BS Information Technology',
            'year_level' => '2nd Year',
            'section' => 'A',
            'email' => 'your.email@example.com',
            'address' => 'Your Address',
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
