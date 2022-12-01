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
        $this->load->library('dompdfgenerator');
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

    public function penilaian()
    {
        $data['session'] = $this->session->userdata('nama');
        $data['title'] = 'Penilaian Magang';
        $id = $this->session->userdata('userid');
        $data['penyelia'] = $this->penyelia->getPenyeliaById($id);
        $kategori = $this->session->userdata('kode_kategori');
        $data['mahasiswa'] = $this->penyelia->getMhsByKuliah($kategori);
        $data['siswa'] = $this->penyelia->getSwaBySmk($kategori);
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $this->load->view('penyelia/template/header', $data);
        $this->load->view('penyelia/template/sidebar', $data);
        $this->load->view('penyelia/template/topbar', $data);
        $this->load->view('penyelia/penilaian', $data);
        $this->load->view('penyelia/template/footer');
    }

    public function upsertifmhs($kode_magang)
    {
        if (!empty($_FILES["sertifikat"]["name"])) {
            $date = substr(date('Ymd'), 2, 8);
            $config = array();
            $config['upload_path'] = './assets/data/peserta/sertifikat/';
            $config['allowed_types'] = 'pdf';
            $config['file_name']    = $date . '-' . $_FILES['sertifikat']['name'];

            $this->load->library('upload', $config, 'sertifikat');
            $this->sertifikat->initialize($config);
            $upload_sertifikat = $this->sertifikat->do_upload('sertifikat');

            if ($upload_sertifikat) {
                $this->db->set('sertifikat', $this->sertifikat->data("file_name"));
                $this->db->where('kode_magang', $kode_magang);
                $this->db->update('peserta_magang');
                $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Sertifikat Berhasil Diupload!</div>');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">error' . $this->sertifikat->display_errors() . '!</div>');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {

            $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Inputan Harap Diisi!</div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function edit_profil()
    {
        $data['session'] = $this->session->userdata('nama');
        $data['title'] = 'Edit Profil';
        $id = $this->session->userdata('userid');
        $data['penyelia'] = $this->penyelia->getPenyeliaById($id);
        $data['profil'] = $this->penyelia->getProfile();
        // $data['pesertaall'] = $this->home->getProfileAll();
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $this->form_validation->set_rules('kode_penyelia', 'kode_penyelia', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('jeniskel', 'jeniskel', 'required');
        $this->form_validation->set_rules('nip', 'nip', 'required');
        $this->form_validation->set_rules('telepon', 'telepon', 'required');
        if ($this->form_validation->run()) {
            $this->penyelia->update();
            $this->session->set_flashdata('success', 'Data Profil Berhasil Diperbarui');
            redirect('login/logout');
        } else {
            $this->session->set_flashdata('Error', 'Data Profil Gagal Diperbarui');
            $this->load->view('penyelia/template/header', $data);
            $this->load->view('penyelia/template/sidebar', $data);
            $this->load->view('penyelia/template/topbar', $data);
            $this->load->view('penyelia/edit_profile', $data);
            $this->load->view('penyelia/template/footer', $data);
        }
    }

    public function detailnilai()
    {
        $kode_nilai = $this->uri->segment(3);
        $data['kode_magang'] = $kode_nilai;
        $data['session'] = $this->session->userdata('nama');
        $data['title'] = 'Detail Nilai';
        $id = $this->session->userdata('userid');
        $data['penyelia'] = $this->penyelia->getPenyeliaById($id);
        $data['rownilai'] = $this->penyelia->getPesertaByRow($kode_nilai);
        $data['nilai'] = $this->penyelia->getNilaiById($kode_nilai);
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $this->form_validation->set_rules('tanggal_penilaian', 'tanggal_penilaian', 'required');
        $this->form_validation->set_rules('disiplin', 'disiplin', 'required');
        $this->form_validation->set_rules('tanggung', 'tanggung', 'required');
        $this->form_validation->set_rules('praktek', 'praktek', 'required');
        $this->form_validation->set_rules('rata', 'rata', 'required');
        $this->form_validation->set_rules('grade', 'grade', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('penyelia/template/header');
            $this->load->view('penyelia/template/sidebar', $data);
            $this->load->view('penyelia/template/topbar', $data);
            $this->load->view('penyelia/detail_nilai', $data);
            $this->load->view('penyelia/template/footer', $data);
        } else {
            $data = [
                'kode_magang' => $this->input->post('kode_magang'),
                'tanggal_penilaian' => $this->input->post('tanggal_penilaian'),
                'nilai_disiplin' => $this->input->post('disiplin'),
                'nilai_tanggungjawab' => $this->input->post('tanggung'),
                'nilai_praktek' => $this->input->post('praktek'),
                'nilai_rata' => $this->input->post('rata'),
                'grade' => $this->input->post('grade')
            ];
            $this->db->insert('penilaian_detail', $data);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Nilai Berhasil Di Tambah</div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function invoice()
    {
        $kode_nilai = $this->uri->segment(3);
        $data['kode_magang'] = $kode_nilai;
        $id = $this->session->userdata('userid');
        $data['penyelia'] = $this->penyelia->getPenyeliaById($id);
        $data['peserta'] = $this->penyelia->getPesertaById($kode_nilai);
        $data['nilai'] = $this->penyelia->getNilaiById($kode_nilai);
        $data['disiplin'] = $this->penyelia->getTotalDisiplin($kode_nilai);
        $data['praktek'] = $this->penyelia->getTotalPraktek($kode_nilai);
        $data['tanggung'] = $this->penyelia->getTotalTanggung($kode_nilai);
        $data['rata'] = $this->penyelia->getTotalRata($kode_nilai);
        $data['title'] = 'Laporan Nilai Magang';
        // filename dari pdf ketika didownload
        $file_pdf = 'Laporan Penilaian Magang';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $data['date'] = date('d F Y H:i:s');
        $html = $this->load->view('penyelia/invoice', $data, true);
        // $this->load->view('invoice', $data);
        $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        // $this->load->view('invoice', $data);

    }



    public function editnilai($id)
    {
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $data = [
            'nilai_disiplin' => $this->input->post('disiplinedit'),
            'nilai_tanggungjawab' => $this->input->post('tanggungedit'),
            'nilai_praktek' => $this->input->post('praktekedit'),
            'nilai_praktek' => $this->input->post('praktekedit'),
            'nilai_rata' => $this->input->post('rataedit'),
            'grade' => $this->input->post('gradeedit'),

        ];
        $this->db->where('nilai_id', $id);
        $this->db->update('penilaian_detail', $data);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">penilaian Berhasil Di Edit</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
