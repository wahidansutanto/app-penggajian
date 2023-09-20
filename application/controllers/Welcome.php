<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function index()
	{
		$this->_rules();

		if ($this->form_validation->run() ==  FALSE) {
			$data['title'] = 'Halaman Login';
			$this->load->view('templates_admin/header', $data);
			$this->load->view('formLogin');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$cek = $this->penggajianModel->cek_login($username, $password);

			if ($cek == FALSE) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            Username atau password salah!
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
            </button>
            </div>');
			redirect('welcome');
			} else {
				$this->session->set_userdata('hak_akses', $cek->hak_akses);
				$this->session->set_userdata('nama_pegawai', $cek->nama_pegawai);
				$this->session->set_userdata('photo', $cek->photo);
				$this->session->set_userdata('id_pegawai', $cek->id_pegawai);
				$this->session->set_userdata('nik', $cek->nik);
				switch ($cek->hak_akses) {
					case 1:
						redirect('admin/dashboard');
						break;
					case 2:
						redirect('pegawai/dashboard');
						break;
					default:
						break;
				}
			}
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('username', 'username', 'required|trim', [
			'required' => "Kolom username wajib di isi!"
		]);
		$this->form_validation->set_rules('password', 'password', 'required|trim', [
			'required' => "Kolom password wajib di isi!"
		]);
	}

	public function logout() 
	{
		$this->session->sess_destroy();
		redirect('welcome');
	}
}
