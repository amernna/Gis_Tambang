<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_user');
    }

    public function index() {
        $admin_data = [
            'username' => 'admin',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'role' => 'admin'
        ];

        if ($this->m_user->insert_user($admin_data)) {
            echo "Admin user berhasil ditambahkan.";
        } else {
            echo "Gagal menambahkan admin user.";
        }
    }
}