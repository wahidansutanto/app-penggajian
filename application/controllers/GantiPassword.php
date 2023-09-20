<?php

class GantiPassword extends CI_Controller
{
    public function index()
    {
        $data['title'] = "Ganti Password";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('formGantiPassword', $data);
        $this->load->view('templates_admin/footer');
    }

    public function gantiPasswordAksi()
    {
        $passBaru  = $this->input->post('passBaru');
        $ulangPass = $this->input->post('ulangPass');

        $this->form_validation->set_rules('passBaru', 'password baru', 'required|matches[ulangPass]',[
            'required' => "Kolom ini wajib di isi!",
            'matches' => "Password baru tidak cocok!"
        ]);
        $this->form_validation->set_rules('ulangPass', 'ulangi password', 'required', [
            'required' => "Kolom ini wajib di isi!"
        ]);

        if ($this->form_validation->run() != FALSE) {
            $data = array('password' => md5($passBaru));
            $id = array('id_pegawai' => $this->session->userdata('id_pegawai'));

            $this->penggajianModel->update_data('data_pegawai', $data, $id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Password berhasil diganti!
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
            </button>
            </div>');
            redirect('welcome');
        } else {
            $data['title'] = "Ganti Password";
            $this->load->view('templates_admin/header', $data);
            $this->load->view('templates_admin/sidebar');
            $this->load->view('formGantiPassword', $data);
            $this->load->view('templates_admin/footer');
        }
    }
}
