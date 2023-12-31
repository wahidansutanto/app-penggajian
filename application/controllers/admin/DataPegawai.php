<?php
class dataPegawai extends CI_Controller
{
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
    public function index()
    {
        $data['title'] = "Data Pegawai";
        $data['pegawai'] = $this->penggajianModel->get_data('data_pegawai')->result();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/dataPegawai', $data);
        $this->load->view('templates_admin/footer', $data);
    }

    public function tambahData()
    {
        $data['title'] = "Tambah Data Pegawai";
        $data['jabatan'] = $this->penggajianModel->get_data('data_jabatan')->result();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/formTambahPegawai', $data);
        $this->load->view('templates_admin/footer');
    }

    public function tambahDataAksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->tambahData();
        } else {
            $nik               =  $this->input->post('nik');
            $nama_pegawai      =  $this->input->post('nama_pegawai');
            $jenis_kelamin     =  $this->input->post('jenis_kelamin');
            $tangal_masuk      =  $this->input->post('tanggal_masuk');
            $jabatan           =  $this->input->post('jabatan');
            $status            =  $this->input->post('status');
            $hak_akses         =  $this->input->post('hak_akses');
            $username          =  $this->input->post('username');
            $password          =  md5($this->input->post('password'));
            $photo             =  $_FILES['photo']['name'];
            if ($photo = '') {
            } else {
                $config['upload_path'] = './assets/photo';
                $config['allowed_types'] = 'jpg|jpeg|png|tiff';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('photo')) {
                    echo "Photo gagal di upload";
                } else {
                    $photo = $this->upload->data('file_name');
                }
            }
            $data = array(
                'nik'              =>  $nik,
                'nama_pegawai'     =>  $nama_pegawai,
                'jenis_kelamin'    =>  $jenis_kelamin,
                'tanggal_masuk'    =>  $tangal_masuk,
                'jabatan'          =>  $jabatan,
                'status'           =>  $status,
                'hak_akses'        =>  $hak_akses,
                'username'         =>  $username,
                'password'         =>  $password,
                'photo'            =>  $photo
            );

            $this->penggajianModel->insert_data($data, 'data_pegawai');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Data berhasil ditambahkan!
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('admin/dataPegawai');
        }
    }

    public function updateData($id)
    {
        $where = array('id_pegawai' => $id);
        $data['title'] = 'Update Data Pegawai';
        $data['jabatan'] = $this->penggajianModel->get_data('data_jabatan')->result();
        $data['pegawai'] = $this->db->query("SELECT * FROM data_pegawai WHERE id_pegawai = '$id'")->result();

        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/formUpdatePegawai', $data);
        $this->load->view('templates_admin/footer');
    }

    public function updateDataAksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->updateData();
        } else {
            $id                =  $this->input->post('id_pegawai');
            $nik               =  $this->input->post('nik');
            $nama_pegawai      =  $this->input->post('nama_pegawai');
            $jenis_kelamin     =  $this->input->post('jenis_kelamin');
            $tangal_masuk      =  $this->input->post('tanggal_masuk');
            $jabatan           =  $this->input->post('jabatan');
            $status            =  $this->input->post('status');
            $hak_akses         =  $this->input->post('hak_akses');
            $username          =  $this->input->post('username');
            $password          =  md5($this->input->post('password'));
            $photo             =  $_FILES['photo']['name'];
            if ($photo) {
                $config['upload_path'] = './assets/photo';
                $config['allowed_types'] = 'jpg|jpeg|png|tiff';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('photo')) {
                    $photo = $this->upload->data('file_name');
                    $this->db->set('photo', $photo);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $data = array(
                'nik'              =>  $nik,
                'nama_pegawai'     =>  $nama_pegawai,
                'jenis_kelamin'    =>  $jenis_kelamin,
                'tanggal_masuk'    =>  $tangal_masuk,
                'jabatan'          =>  $jabatan,
                'hak_akses'        =>  $hak_akses,
                'username'         =>  $username,
                'password'         =>  $password,
                'status'           =>  $status
            );

            $where = array(
                'id_pegawai' => $id
            );

            $this->penggajianModel->update_data('data_pegawai', $data, $where);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Data berhasil diupdate!
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('admin/dataPegawai');
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim', [
            'required' => "Kolom ini wajib di isi!"
        ]);
        $this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'required|trim', [
            'required' => "Kolom ini wajib di isi!"
        ]);
        $this->form_validation->set_rules('username', 'Nama Pegawai', 'required|trim', [
            'required' => "Kolom ini wajib di isi!"
        ]);
        $this->form_validation->set_rules('password', 'Nama Pegawai', 'required|trim', [
            'required' => "Kolom ini wajib di isi!"
        ]);
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim', [
            'required' => "Kolom ini wajib di isi!"
        ]);
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required|trim', [
            'required' => "Kolom ini wajib di isi!"
        ]);
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim', [
            'required' => "Kolom ini wajib di isi!"
        ]);
        $this->form_validation->set_rules('status', 'Status', 'required|trim', [
            'required' => "Kolom ini wajib di isi!"
        ]);
        $this->form_validation->set_rules('hak_akses', 'Nama Pegawai', 'required|trim', [
            'required' => "Kolom ini wajib di isi!"
        ]);
    }

    public function deleteData($id)
    {
        $where = array('id_pegawai' => $id);
        $this->penggajianModel->delete_data($where, 'data_pegawai');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Data berhasil dihapus!
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect('admin/dataPegawai');
    }
}
