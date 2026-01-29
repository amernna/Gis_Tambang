<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tambang extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        // Memeriksa apakah pengguna sudah login
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Silakan login terlebih dahulu!</div>');
            redirect('auth');
        }
    
        // Memeriksa apakah pengguna adalah admin
        if ($this->session->userdata('role') !== 'admin') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda tidak memiliki akses ke halaman ini!</div>');
            redirect('auth');
        }
    
        // Load Dependencies
        $this->load->model('m_tambang');
        $this->load->library('upload');
    }

    public function index()
	{
		$data = array(
			'title' => 'Data Tambang',
			'tambang' => $this->m_tambang->get_all_data(),
			'isi' => 'lahan/v_data'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

    // Tambahkan item baru
    public function add()
    {
        $this->form_validation->set_rules('nama_area', 'Nama Area Tambang', 'required', array(
            'required' => '%s Harus Diisi !!!'
        ));
        $this->form_validation->set_rules('luas_area', 'Luas Area', 'required', array(
            'required' => '%s Harus Diisi !!!'
        ));
        $this->form_validation->set_rules('jenis_tambang', 'Jenis Tambang', 'required', array(
            'required' => '%s Harus Diisi !!!'
        ));
        $this->form_validation->set_rules('pemilik_area', 'Pemilik Area', 'required', array(
            'required' => '%s Harus Diisi !!!'
        ));
        $this->form_validation->set_rules('alamat_pemilik', 'Alamat Pemilik', 'required', array(
            'required' => '%s Harus Diisi !!!'
        ));

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']          = './gambar/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2000;
            $this->upload->initialize($config);

            // Cek apakah gambar diupload
            $upload_gambar = (!empty($_FILES['gambar']['name']));

            if ($upload_gambar) {
                if (!$this->upload->do_upload('gambar')) {
                    $data = array(
                        'title' => 'Input Data Tambang',
                        'error_upload' => $this->upload->display_errors(),
                        'isi' => 'lahan/v_add'
                    );
                    $this->load->view('layout/v_wrapper', $data, FALSE);
                    return; // Tambahkan return untuk menghentikan eksekusi lebih lanjut
                } else {
                    $upload_data = array('uploads' => $this->upload->data());
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './gambar/' . $upload_data['uploads']['file_name'];
                    $this->load->library('image_lib', $config);
                }
            }

            $data = array(
                'nama_tambang' => $this->input->post('nama_area'),
                'luas_area' => $this->input->post('luas_area'),
                'jenis_tambang' => $this->input->post('jenis_tambang'),
                'pemilik_area' => $this->input->post('pemilik_area'),
                'alamat_pemilik' => $this->input->post('alamat_pemilik'),
                'denah_geojson' => $this->input->post('denah_geojson'),
                'warna' => $this->input->post('warna'),
                'sumber_daya' => $this->input->post('sumber_daya'),
                'tanggal_dibuat' => $this->input->post('tanggal_dibuat'),
                'status' => $this->input->post('status')
            );

            // Tambahkan nama file gambar jika diupload
            if ($upload_gambar) {
                $data['gambar'] = $upload_data['uploads']['file_name'];
            }

            $this->m_tambang->insert_tambang($data);
            $this->session->set_flashdata('sukses', 'Data Berhasil Disimpan !!!');
            redirect('tambang/add');
        }

        $data = array(
            'title' => 'Input Data Tambang',
            'isi' => 'lahan/v_add'
        );
        $this->load->view('layout/v_wrapper', $data, FALSE);
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('nama_area', 'Nama Area Tambang', 'required', array(
            'required' => '%s Harus Diisi !!!'
        ));
        $this->form_validation->set_rules('luas_area', 'Luas Area', 'required', array(
            'required' => '%s Harus Diisi !!!'
        ));
        $this->form_validation->set_rules('jenis_tambang', 'Jenis Tambang', 'required', array(
            'required' => '%s Harus Diisi !!!'
        ));

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']          = './gambar/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2000;
            $this->upload->initialize($config);

            $upload_gambar = (!empty($_FILES['gambar']['name']));

            if ($upload_gambar) {
                if (!$this->upload->do_upload('gambar')) {
                    $data = array(
                        'title' => 'Edit Data Tambang',
                        'error_upload' => $this->upload->display_errors(),
                        'tambang' => $this->m_tambang->get_tambang_by_id($id),
                        'isi' => 'lahan/v_edit'
                    );
                    $this->load->view('layout/v_wrapper', $data, FALSE);
                    return; // Tambahkan return untuk menghentikan eksekusi lebih lanjut
                } else {
                    $upload_data = array('uploads' => $this->upload->data());
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './gambar/' . $upload_data['uploads']['file_name'];
                    $this->load->library('image_lib', $config);
                }
            }

            $data = array(
                'id_tambang' => $id,
                'nama_tambang' => $this->input->post('nama_area'),
                'luas_area' => $this->input->post('luas_area'),
                'jenis_tambang' => $this->input->post('jenis_tambang'),
                'pemilik_area' => $this->input->post('pemilik_area'),
                'alamat_pemilik' => $this->input->post('alamat_pemilik'),
                'denah_geojson' => $this->input->post('denah_geojson'),
                'warna' => $this->input->post('warna'),
                'sumber_daya' => $this->input->post('sumber_daya'),
                'tanggal_dibuat' => $this->input->post('tanggal_dibuat'),
                'status' => $this->input->post('status')
            );

            // Tambahkan nama file gambar jika diupload
            if ($upload_gambar) {
                // Hapus gambar lama jika ada
                $tambang = $this->m_tambang->get_tambang_by_id($id);
                if ($tambang['gambar'] != '') {
                    unlink('./gambar/' . $tambang['gambar']);
                }
                $data['gambar'] = $upload_data['uploads']['file_name'];
            }

            $this->m_tambang->update_tambang($id, $data);
            $this->session->set_flashdata('sukses', 'Data Berhasil Diupdate !!!');
            redirect('tambang');
        }

        $data = array(
            'title' => 'Edit Data Tambang',
            'tambang' => $this->m_tambang->get_tambang_by_id($id),
            'isi' => 'lahan/v_edit'
        );
        $this->load->view('layout/v_wrapper', $data, FALSE);
    }

    public function detail($id)
    {
        $data = array(
            'title' => 'Detail Data Tambang',
            'tambang' => $this->m_tambang->get_tambang_by_id($id),
            'isi' => 'lahan/v_detail'
        );
        $this->load->view('layout/v_wrapper', $data, FALSE);
    }

    public function delete($id)
    {
        // Ambil data tambang untuk menghapus gambar
        $tambang = $this->m_tambang->get_tambang_by_id($id);

        // Hapus gambar jika ada
        if ($tambang['gambar'] != '') {
            unlink('./gambar/' . $tambang['gambar']);
        }

        // Hapus data dari database
        $this->m_tambang->delete_tambang($id);

        $this->session->set_flashdata('sukses', 'Data Berhasil Dihapus !!!');
        redirect('tambang');
    }

    // Galeri tambang
    public function gallery()
    {
        $data = array(
            'title' => 'Galeri Tambang',
            'tambang' => $this->m_tambang->get_all_data(),
            'isi' => 'lahan/v_gallery'
        );
        $this->load->view('layout/v_wrapper', $data, FALSE);
    }
}