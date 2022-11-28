<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blocked extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('home/Home_model', 'home');
    }
    public function index()
    {
        $data['title'] = "401 Error";
        $data['nama'] = $this->session->userdata('nama');
        $data['foto'] = $this->session->userdata('foto');
        $data['userid'] = $this->session->userdata('userid');
        $kode_magang = $this->session->userdata('userid');
        $data['peserta'] = $this->home->getPesertaById($kode_magang);
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        if ($this->session->userdata('logged_in') == 'true') {
            $this->load->view('account/template/header', $data);
            $this->load->view('account/blocked', $data);
            $this->load->view('account/template/footer');
        } else {
            $this->load->view('account/template/header');
            $this->load->view('account/blocked');
            $this->load->view('account/template/footer');
        }
    }
}
