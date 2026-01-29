<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aktivitas extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_aktivitas');
		$this->load->model('m_tambang');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data = array(
			'title' => 'Aktivitas Tambang',
			'aktivitas' => $this->m_aktivitas->get_all_data(),
			'isi' => 'aktivitas/v_aktivitas'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function add()
	{
		$data['tambang'] = $this->m_tambang->get_all_data();

		$this->form_validation->set_rules('id_tambang', 'Tambang', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		$this->form_validation->set_rules('deskripsi_aktivitas', 'Deskripsi Aktivitas', 'required');
		$this->form_validation->set_rules('dibuat_oleh', 'Dibuat Oleh', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah Aktivitas Tambang';
			$data['isi'] = 'aktivitas/v_add_aktivitas';
			$this->load->view('layout/v_wrapper', $data, FALSE);
		} else {
			$data_input = array(
				'id_tambang' => $this->input->post('id_tambang'),
				'tanggal' => $this->input->post('tanggal'),
				'deskripsi_aktivitas' => $this->input->post('deskripsi_aktivitas'),
				'dibuat_oleh' => $this->input->post('dibuat_oleh')
			);

			$this->m_aktivitas->add_aktivitas($data_input);
			$this->session->set_flashdata('pesan', 'Aktivitas berhasil ditambahkan');
			redirect('aktivitas');
		}
	}
	public function edit($id)
	{
		$data['tambang'] = $this->m_tambang->get_all_data();
		$data['aktivitas'] = $this->m_aktivitas->get_aktivitas_by_id($id);

		$this->form_validation->set_rules('id_tambang', 'Tambang', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		$this->form_validation->set_rules('deskripsi_aktivitas', 'Deskripsi Aktivitas', 'required');
		$this->form_validation->set_rules('dibuat_oleh', 'Dibuat Oleh', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Edit Aktivitas Tambang';
			$data['isi'] = 'aktivitas/v_edit_aktivitas';
			$this->load->view('layout/v_wrapper', $data, FALSE);
		} else {
			$data_update = array(
				'id_tambang' => $this->input->post('id_tambang'),
				'tanggal' => $this->input->post('tanggal'),
				'deskripsi_aktivitas' => $this->input->post('deskripsi_aktivitas'),
				'dibuat_oleh' => $this->input->post('dibuat_oleh')
			);

			$this->m_aktivitas->update_aktivitas($id, $data_update);
			$this->session->set_flashdata('pesan', 'Aktivitas berhasil diupdate');
			redirect('aktivitas');
		}
	}

	public function delete($id)
	{
		$this->m_aktivitas->delete_aktivitas($id);
		$this->session->set_flashdata('pesan', 'Aktivitas berhasil dihapus');
		redirect('aktivitas');
	}
}
