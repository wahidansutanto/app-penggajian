<?php 
    class Dashboard extends CI_Controller{

        public function __construct()
        {
            parent::__construct();
            if ($this->session->userdata('hak_akses') !='1'){
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            Anda belum login!
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
            </button>
            </div>');
            redirect('welcome');
            }
        }
        public function Index() {
            $data['title'] = 'Dashboard';

            $pegawai = $this->db->query("SELECT * FROM data_pegawai");
            $admin = $this->db->query("SELECT * FROM data_pegawai WHERE jabatan = 'admin'");
            $jabatan = $this->db->query("SELECT * FROM data_jabatan");
            $absensi = $this->db->query("SELECT * FROM data_absensi");

            $data['pegawai'] = $pegawai->num_rows();
            $data['admin'] = $admin->num_rows();
            $data['jabatan'] = $jabatan->num_rows();
            $data['absensi'] = $absensi->num_rows();

            $this->load->view('templates_admin/header', $data);
            $this->load->view('templates_admin/sidebar');
            $this->load->view('admin/dashboard');
            $this->load->view('templates_admin/footer', $data);
        }
    }
