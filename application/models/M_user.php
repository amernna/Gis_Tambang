<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

    private $table = 'users';

    public function get_user_by_username($username) {
        return $this->db->get_where($this->table, ['username' => $username])->row_array();
    }

    public function insert_user($data) {
        return $this->db->insert($this->table, $data);
    }
}

