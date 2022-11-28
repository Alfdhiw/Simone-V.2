<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyelia extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'form'));
        $this->load->model('auth/Auth_model', 'auth');
        $this->load->model('admin/Dashboard_model', 'dashboard');
        $this->load->model('ketua/Ketua_model', 'ketua');
        $this->load->model('penyelia/Penyelia_model', 'penyelia');
        $this->load->model('admin/DataPeserta_model', 'peserta');
        $this->user_access->cek_login();
        $this->user_access->cek_akses();
        $this->CI = &get_instance();
    }

    public function index()
    {
        $data['session'] = $this->session->userdata('nama');
        $data['title'] = 'Dashboard';
        $id = $this->session->userdata('userid');
        $kategori = $this->session->userdata('kode_kategori');
        $data['penyelia'] = $this->penyelia->getPenyeliaById($id);
        $data['totalpeserta'] = $this->penyelia->countAllPenggunaById($kategori);
        $data['totalswa'] = $this->penyelia->countAllSwaById($kategori);
        $data['totalmhs'] = $this->penyelia->countAllMhsById($kategori);
        $data['peserta'] = $this->penyelia->getAllPesertaByid($kategori);
        $data['unverif'] = $this->penyelia->countAllUnverifById($kategori);
        $data['unverifuser'] = $this->penyelia->getAllUnverifById($kategori);
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $this->load->view('penyelia/template/header');
        $this->load->view('penyelia/template/sidebar', $data);
        $this->load->view('penyelia/template/topbar', $data);
        $this->load->view('penyelia/penyelia', $data);
        $this->load->view('penyelia/template/footer', $data);
    }

    public function konfirmasi()
    {
        $data['session'] = $this->session->userdata('nama');
        $data['title'] = 'Konfirmasi Anggota';
        $id = $this->session->userdata('userid');
        $data['penyelia'] = $this->penyelia->getPenyeliaById($id);
        $kategori = $this->session->userdata('kode_kategori');
        $data['peserta'] = $this->penyelia->getAllPesertaByid($kategori);
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $this->load->view('penyelia/template/header');
        $this->load->view('penyelia/template/sidebar', $data);
        $this->load->view('penyelia/template/topbar', $data);
        $this->load->view('penyelia/konfirmasi', $data);
        $this->load->view('penyelia/template/footer', $data);
    }

    public function datapelamar()
    {
        $kode_id = $this->uri->segment(3);
        $id = $this->session->userdata('userid');
        $data['penyelia'] = $this->penyelia->getPenyeliaById($id);
        $data['pelamar'] = $this->peserta->getMhsById($kode_id);
        $data['role'] = $this->peserta->getRoleById($kode_id);
        $data['session'] = $this->session->userdata('nama');
        $data['title'] = 'Detail Data';
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $idadm = $this->session->userdata('userid');
        $data['nama'] = $this->db->get_where('penyelia', ['kode_penyelia' => $idadm])->row_array();

        $this->load->view('penyelia/template/header');
        $this->load->view('penyelia/template/sidebar', $data);
        $this->load->view('penyelia/template/topbar', $data);
        $this->load->view('penyelia/konfirmasi_detail', $data);
        $this->load->view('penyelia/template/footer', $data);
    }

    public function anggota()
    {
        $data['session'] = $this->session->userdata('nama');
        $data['title'] = 'Data Anggota';
        $id = $this->session->userdata('userid');
        $data['penyelia'] = $this->penyelia->getPenyeliaById($id);
        $kategori = $this->session->userdata('kode_kategori');
        $data['mahasiswa'] = $this->penyelia->getMhsByKuliah($kategori);
        $data['siswa'] = $this->penyelia->getSwaBySmk($kategori);
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $this->load->view('penyelia/template/header', $data);
        $this->load->view('penyelia/template/sidebar', $data);
        $this->load->view('penyelia/template/topbar', $data);
        $this->load->view('penyelia/anggota', $data);
        $this->load->view('penyelia/template/footer', $data);
    }

    public function datamhs()
    {
        $kode_id = $this->uri->segment(3);
        $data['info'] = $this->penyelia->getMhsById($kode_id);
        $data['session'] = $this->session->userdata('nama');
        $data['title'] = 'Detail Data';
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $id = $this->session->userdata('userid');
        $data['penyelia'] = $this->penyelia->getPenyeliaById($id);

        $this->load->view('penyelia/template/header');
        $this->load->view('penyelia/template/sidebar', $data);
        $this->load->view('penyelia/template/topbar', $data);
        $this->load->view('penyelia/mahasiswa', $data);
        $this->load->view('penyelia/template/footer', $data);
    }

    public function confirm($kode_magang)
    {
        $this->db->set('konfirmasi', $this->input->post('konfirmasi'));
        $this->db->where('kode_magang', $kode_magang);
        $this->db->update('peserta_magang');
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Pelamar Telah Berhasil Diverifikasi!</div>');
        redirect('penyelia/konfirmasi');
    }

    public function monitoring()
    {
        $data['session'] = $this->session->userdata('nama');
        $data['title'] = 'Monitoring Absen';
        $id = $this->session->userdata('userid');
        $data['penyelia'] = $this->penyelia->getPenyeliaById($id);
        $kategori = $this->session->userdata('kode_kategori');
        $data['mahasiswa'] = $this->penyelia->getMhsByKuliah($kategori);
        $data['siswa'] = $this->penyelia->getSwaBySmk($kategori);
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $this->load->view('penyelia/template/header', $data);
        $this->load->view('penyelia/template/sidebar', $data);
        $this->load->view('penyelia/template/topbar', $data);
        $this->load->view('penyelia/monitoring', $data);
        $this->load->view('penyelia/template/footer');
    }

    public function detailabsen()
    {
        $kode_absen = $this->uri->segment(3);
        $data['session'] = $this->session->userdata('nama');
        $data['title'] = 'Detail Monitoring Absensi';
        $id = $this->session->userdata('userid');
        $data['penyelia'] = $this->penyelia->getPenyeliaById($id);
        $data['detail'] = $this->dashboard->getMonitorById($kode_absen);
        $data['absen'] = $this->dashboard->getAbsenById($kode_absen);
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $this->load->view('penyelia/template/header', $data);
        $this->load->view('penyelia/template/sidebar', $data);
        $this->load->view('penyelia/template/topbar', $data);
        $this->load->view('penyelia/detail_absen', $data);
        $this->load->view('penyelia/template/footer');
    }
}
