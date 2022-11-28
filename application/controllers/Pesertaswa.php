<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PesertaSwa extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'form'));
        $this->load->model('auth/Auth_model', 'auth');
        $this->load->model('admin/Dashboard_model', 'dashboard');
        $this->user_access->cek_login();
        $this->user_access->cek_akses();
        $this->CI = &get_instance();
    }

    public function index($id)
    {
        $data['session'] = $this->session->userdata('nama');
        $data['title'] = 'Dashboard';
        $id = $this->session->userdata('userid');
        $data['nama'] = $this->db->get_where('admin', ['kode_admin' => $id])->row_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/template/topbar', $data);
        $this->load->view('admin/admin', $data);
        $this->load->view('admin/template/footer', $data);
    }
}
