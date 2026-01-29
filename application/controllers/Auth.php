<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_user');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->load->view('auth/login');
    }

    public function login() {
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/login');
        } else {
            $this->_login();
        }
    }

    private function _login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
    
        $user = $this->m_user->get_user_by_username($username);
    
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'username' => $user['username'],
                    'role' => $user['role'],
                    'logged_in' => TRUE  // Tambahkan ini
                ];
                $this->session->set_userdata($data);
                if ($user['role'] === 'admin') {
                    redirect('home');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda tidak memiliki akses admin!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username tidak terdaftar!</div>');
            redirect('auth');
        }
    }

    public function logout() {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('logged_in');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil logout!</div>');
        redirect('home');
    }
}

