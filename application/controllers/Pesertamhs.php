<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PesertaMhs extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'form'));
        $this->load->model('auth/Auth_model', 'auth');
        $this->load->model('admin/Dashboard_model', 'dashboard');
        $this->load->model('admin/DataPeserta_model', 'peserta');
        $this->user_access->cek_login();
        $this->user_access->cek_akses();
        $this->CI = &get_instance();
    }

    public function index()
    {
        $kode_id = $this->uri->segment(2);
        $data['info'] = $this->peserta->getMhsById($kode_id);
        $data['session'] = $this->session->userdata('nama');
        $data['title'] = 'Data Lengkap';
        $idadm = $this->session->userdata('userid');
        $data['nama'] = $this->db->get_where('admin', ['kode_admin' => $idadm])->row_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/template/topbar', $data);
        $this->load->view('admin/data_peserta_mhs', $data);
        $this->load->view('admin/template/footer', $data);
    }
}
