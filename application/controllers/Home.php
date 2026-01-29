<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('m_tambang');
	}

	public function index()
	{
		$data = array(
			'title' => 'Pemetaan Tambang',
			'tambang' => $this->m_tambang->get_all_data(), // Change from 'lahan' to 'tambang'
			'total_area' => $this->m_tambang->get_total_area(),
			'total_plots' => $this->m_tambang->count_tambang(),
			'isi' => 'v_home'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function detail_lahan($id_lahan)
	{
		$data = array(
			'title' => 'Lahan Pertanian',
			'lahan'	=> $this->m_tambang->detail($id_lahan),
			'foto'	=> $this->m_tambang->detail_galleri($id_lahan),
			'isi'	=> 'v_detail_lahan'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
		// $this->load->view('layout/v_detail_lahan', $data, FALSE);
	}
}

/* End of file Home.php */
