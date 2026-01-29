<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

    public function login($username, $password) {
        $this->db->where('username', $username);
        $user = $this->db->get('users')->row_array();
        
        if($user) {
            if(password_verify($password, $user['password'])) {
                return $user;
            }
        }
        
        return false;
    }
}
