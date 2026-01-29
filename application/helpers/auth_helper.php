<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('is_admin')) {
    function is_admin() {
        $CI =& get_instance();
        $user_role = $CI->session->userdata('role');
        return $user_role === 'admin';
    }
}

if (!function_exists('admin_check')) {
    function admin_check() {
        $CI =& get_instance();
        if (!$CI->session->userdata('username')) {
            redirect('auth');
        } elseif (!is_admin()) {
            show_error('Anda tidak memiliki akses ke halaman ini.', 403, 'Akses Ditolak');
        }
    }
}

