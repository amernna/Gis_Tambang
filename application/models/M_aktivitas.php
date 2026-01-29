<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_aktivitas extends CI_Model
{
	private $table = 'aktivitas';

	public function get_all_data()
	{
		$this->db->order_by('tanggal', 'DESC');
		return $this->db->get($this->table)->result_array();
	}

	public function get_aktivitas_by_id($id)
	{
		return $this->db->get_where($this->table, ['id_aktivitas' => $id])->row_array();
	}

	public function add_aktivitas($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function update_aktivitas($id, $data)
	{
		$this->db->where('id_aktivitas', $id);
		return $this->db->update($this->table, $data);
	}

	public function delete_aktivitas($id)
	{
		$this->db->where('id_aktivitas', $id);
		return $this->db->delete($this->table);
	}
}
