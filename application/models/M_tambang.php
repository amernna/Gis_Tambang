<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_tambang extends CI_Model
{

	private $table = 'tbl_tambang';

	public function get_all_data()
	{
		return $this->db->get($this->table)->result_array();
	}

	public function get_tambang_by_id($id)
	{
		return $this->db->get_where($this->table, ['id_tambang' => $id])->row_array();
	}

	public function insert_tambang($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function update_tambang($id, $data)
	{
		$this->db->where('id_tambang', $id);
		return $this->db->update($this->table, $data);
	}

	public function delete_tambang($id)
	{
		$this->db->where('id_tambang', $id);
		return $this->db->delete($this->table);
	}

	public function search_tambang($keyword)
	{
		$this->db->like('nama_tambang', $keyword);
		$this->db->or_like('jenis_tambang', $keyword);
		$this->db->or_like('pemilik_tambang', $keyword);
		return $this->db->get($this->table)->result_array();
	}

	public function count_tambang()
	{
		return $this->db->count_all($this->table);
	}
	public function get_total_area()
	{
		$this->db->select_sum('luas_area');
		return $this->db->get($this->table)->row()->luas_area;
	}
}
