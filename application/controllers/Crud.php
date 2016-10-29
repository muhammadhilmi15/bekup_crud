<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 public function __construct()
	 {
			 parent::__construct();
			 $this->load->helper(array('form', 'url'));
			 $this->load->model('M_pegawai');
			 $this->load->model('M_dropdown');
			 $this->load->library('form_validation');
	 }

	public function index()
	{
		$data = array(
			'kota' => $this->M_dropdown->dd_kota(),
			'kelamin' => $this->M_dropdown->dd_kelamin(),
			'posisi' => $this->M_dropdown->dd_posisi(),  
		);
		// $data['kota'] = $this->M_dropdown->dd_kota();
		// $data['kelamin'] = $this->M_dropdown->dd_kelamin();
		// $data['posisi'] = $this->M_dropdown->dd_posisi();
		$this->load->view('main_page',$data);
	}

	public function insert()
	{
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$this->form_validation->set_rules('nomor', 'Nomor', 'required' );
			$this->form_validation->set_rules('kota', 'Kota', 'required' );
			$this->form_validation->set_rules('kelamin', 'Kelamin', 'required' );
			$this->form_validation->set_rules('posisi', 'Posisi', 'required' );
			$this->form_validation->set_rules('status', 'Status', 'required' );
			if ($this->form_validation->run() == FALSE) {
					$this->session->set_flashdata("pesan", "<div class=\"col-md-11\"><div class=\"alert alert-danger\" id=\"alert\">Silahkan lengkapi data anda!</div></div>");
					redirect('Crud');
			} else {
					$idpeg = $this->input->post('idpeg');
					$nama = $this->input->post('nama');
					$nomor = $this->input->post('nomor');
					$kota = $this->input->post('kota');
					$kelamin = $this->input->post('kelamin');
					$posisi = $this->input->post('posisi');
					$status = $this->input->post('status');
					$data = array(
							'id_pegawai' => $idpeg,
							'nama' => $nama,
							'no_telp' => $nomor,
							'kota' => $kota,
							'kelamin' => $kelamin,
							'id_posisi' => $posisi,
							'status' => $status,
					);
					$this->M_pegawai->insert_pegawai($data, 'pegawai');
					$this->session->set_flashdata("pesan", "<div class=\"col-md-11\"><div class=\"alert alert-success\" id=\"alert\">Data yang anda masukkan telah disimpan!</div></div>");
					redirect('Crud');
			}
	}

	public function update()
	{
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$this->form_validation->set_rules('nomor', 'Nomor', 'required' );
			$this->form_validation->set_rules('kota', 'Kota', 'required' );
			$this->form_validation->set_rules('kelamin', 'Kelamin', 'required' );
			$this->form_validation->set_rules('posisi', 'Posisi', 'required' );
			$this->form_validation->set_rules('status', 'Status', 'required' );
			if ($this->form_validation->run() == FALSE) {
					$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Silahkan lengkapi data anda!</div></div>");
					redirect('Crud/tampil');
			} else {
					$idpeg = $this->input->post('idpeg');
					$nama = $this->input->post('nama');
					$nomor = $this->input->post('nomor');
					$kota = $this->input->post('kota');
					$kelamin = $this->input->post('kelamin');
					$posisi = $this->input->post('posisi');
					$status = $this->input->post('status');
					$data = array(
							'id_pegawai' => $idpeg,
							'nama' => $nama,
							'no_telp' => $nomor,
							'kota' => $kota,
							'kelamin' => $kelamin,
							'id_posisi' => $posisi,
							'status' => $status,
					);
					$where = array(
							'id_pegawai' => $idpeg
					);
					$this->M_pegawai->update_pegawai($where, $data, 'pegawai');
					$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Data berhasil diupdate!</div></div>");
					redirect('Crud/tampil');
			}
	}

	public function hapus($idpeg)
	{
			$where = array('id_pegawai' => $idpeg);
			$this->M_pegawai->hapus_pegawai($where, 'pegawai');
			redirect('Crud/tampil');
	}

	public function edit($idpeg)
	{
			$where = array('id_pegawai' => $idpeg);
			$data['pegawai'] = $this->M_pegawai->edit_pegawai($where, 'pegawai')->result();
			$this->load->view('edit_pegawai', $data);
	}

	public function tampil()
	{
			$data['pegawai'] = $this->M_pegawai->tampil_pegawai();
			$this->load->view('list_pegawai', $data);
	}
}
