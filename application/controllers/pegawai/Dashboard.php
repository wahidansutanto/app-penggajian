<?php
class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('hak_akses') != '2') {
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
        Anda belum login!
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
        </button>
        </div>');
        redirect('welcome');
        }
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $id = $this->session->userdata('id_pegawai');
        $data['pegawai'] = $this->db->query("SELECT * FROM data_pegawai WHERE id_pegawai = '$id'")->result();
        $this->load->view('templates_pegawai/header', $data);
        $this->load->view('templates_pegawai/sidebar');
        $this->load->view('pegawai/dashboard', $data);
        $this->load->view('templates_pegawai/footer');
    }
}
