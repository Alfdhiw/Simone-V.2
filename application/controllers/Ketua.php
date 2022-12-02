<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ketua extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'form'));
        $this->load->model('auth/Auth_model', 'auth');
        $this->load->model('admin/Dashboard_model', 'dashboard');
        $this->load->model('penyelia/Penyelia_model', 'penyelia');
        $this->load->model('ketua/Ketua_model', 'ketua');
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
        $data['nama'] = $this->db->get_where('ketua', ['kode_ketua' => $id])->row_array();
        $data['job'] = $this->dashboard->countAllMagang();
        $data['unverif'] = $this->dashboard->countAllUnverif();
        $data['totalpeserta'] = $this->dashboard->countAllPengguna();
        $data['totalpenyelia'] = $this->dashboard->countAllPenyelia();
        $mhs = 'mahasiswa';
        $swa = 'siswa';
        $laki = 'L';
        $cewe = 'P';
        $data['totalswa'] = $this->dashboard->countAllSwa($swa);
        $data['totalmhs'] = $this->dashboard->countAllMhs($mhs);
        $data['totallaki'] = $this->dashboard->countAllLaki($laki);
        $data['totalcewe'] = $this->dashboard->countAllCewe($cewe);
        $data['loker'] = $this->dashboard->getAllLoker();
        $data['peserta'] = $this->dashboard->getAllPeserta();
        $data['unverifuser'] = $this->dashboard->getAllUnverif();
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $this->load->view('ketua/template/header');
        $this->load->view('ketua/template/sidebar', $data);
        $this->load->view('ketua/template/topbar', $data);
        $this->load->view('ketua/ketua', $data);
        $this->load->view('ketua/template/footer', $data);
    }

    public function edit_profil()
    {
        $data['session'] = $this->session->userdata('nama');
        $data['title'] = 'Edit Profil';
        $id = $this->session->userdata('userid');
        $data['nama'] = $this->db->get_where('ketua', ['kode_ketua' => $id])->row_array();
        $data['profil'] = $this->ketua->getProfile();
        // $data['pesertaall'] = $this->home->getProfileAll();
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $this->form_validation->set_rules('kode_ketua', 'kode_ketua', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('jeniskel', 'jeniskel', 'required');
        $this->form_validation->set_rules('nip', 'nip', 'required');
        $this->form_validation->set_rules('telp', 'telp', 'required');
        if ($this->form_validation->run()) {
            $this->ketua->update();
            $this->session->set_flashdata('success', 'Data Profil Berhasil Diperbarui');
            redirect('login/logout');
        } else {
            $this->session->set_flashdata('Error', 'Data Profil Gagal Diperbarui');
            $this->load->view('ketua/template/header', $data);
            $this->load->view('ketua/template/sidebar', $data);
            $this->load->view('ketua/template/topbar', $data);
            $this->load->view('ketua/edit_profile', $data);
            $this->load->view('ketua/template/footer', $data);
        }
    }



    public function data_peserta()
    {
        $data['session'] = $this->session->userdata('nama');
        $data['title'] = 'Data Peserta Magang';
        $id = $this->session->userdata('userid');
        $kuliah = 'mahasiswa';
        $smk = 'siswa';
        $data['nama'] = $this->db->get_where('ketua', ['kode_ketua' => $id])->row_array();
        $data['mahasiswa'] = $this->dashboard->getMhsByKuliah($kuliah);
        $data['siswa'] = $this->dashboard->getSwaBySmk($smk);
        $data['kerja'] = $this->dashboard->getAllDivisi();
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $this->load->view('ketua/template/header', $data);
        $this->load->view('ketua/template/sidebar', $data);
        $this->load->view('ketua/template/topbar', $data);
        $this->load->view('ketua/data_peserta', $data);
        $this->load->view('ketua/template/footer', $data);
    }

    public function data_penyelia()
    {
        $data['session'] = $this->session->userdata('nama');
        $data['title'] = 'Data Penyelia';
        $id = $this->session->userdata('userid');
        $data['nama'] = $this->db->get_where('ketua', ['kode_ketua' => $id])->row_array();
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $data['penyelia'] = $this->dashboard->getAllPenyelia();
        $data['kerja'] = $this->dashboard->getAllDivisi();
        // $this->form_validation->set_rules('nama', 'nama', 'required');
        // $this->form_validation->set_rules('nip', 'nip', 'required');
        // $this->form_validation->set_rules('email', 'email', 'required');
        // $this->form_validation->set_rules('password', 'password', 'required');
        // $this->form_validation->set_rules('jeniskel', 'jeniskel', 'required');
        // $this->form_validation->set_rules('telepon', 'telepon', 'required');
        // $this->form_validation->set_rules('kode_kategori', 'kode_kategori', 'required');

        // if ($this->form_validation->run() == false) {
        $this->load->view('ketua/template/header');
        $this->load->view('ketua/template/sidebar', $data);
        $this->load->view('ketua/template/topbar', $data);
        $this->load->view('ketua/data_penyelia', $data);
        $this->load->view('ketua/template/footer', $data);
        // } else {
        //     $data = [
        //         'nama' => $this->input->post('nama'),
        //         'nip' => $this->input->post('nip'),
        //         'email' => $this->input->post('email'),
        //         'password' => $this->input->post('password'),
        //         'jeniskel' => $this->input->post('jeniskel'),
        //         'telepon' => $this->input->post('telepon'),
        //         'kode_kategori' => $this->input->post('kode_kategori'),
        //         'is_active' => $this->input->post('is_active'),
        //         'foto' => $this->input->post('foto')
        //     ];
        //     $this->db->insert('penyelia', $data);
        //     $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Penyelia Berhasil Di Tambah</div>');
        //     redirect('dashboard/data_penyelia');
        // }
    }

    public function datamhs()
    {
        $kode_id = $this->uri->segment(3);
        $data['info'] = $this->peserta->getMhsById($kode_id);
        $data['role'] = $this->peserta->getRoleById($kode_id);
        $data['session'] = $this->session->userdata('nama');
        $data['title'] = 'Detail Data';
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $idadm = $this->session->userdata('userid');
        $data['nama'] = $this->db->get_where('ketua', ['kode_ketua' => $idadm])->row_array();

        $this->load->view('ketua/template/header');
        $this->load->view('ketua/template/sidebar', $data);
        $this->load->view('ketua/template/topbar', $data);
        $this->load->view('ketua/mahasiswa', $data);
        $this->load->view('ketua/template/footer', $data);
    }

    public function detailpenyelia()
    {
        $kode_id = $this->uri->segment(3);
        $data['session'] = $this->session->userdata('nama');
        $data['title'] = 'Data Lengkap';
        $id = $this->session->userdata('userid');
        $data['nama'] = $this->db->get_where('ketua', ['kode_ketua' => $id])->row_array();
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $data['detail'] = $this->dashboard->getPenyeliaById($kode_id);
        $data['role'] = $this->peserta->getRoleById($kode_id);
        $this->load->view('ketua/template/header', $data);
        $this->load->view('ketua/template/sidebar', $data);
        $this->load->view('ketua/template/topbar', $data);
        $this->load->view('ketua/detail_penyelia', $data);
        $this->load->view('ketua/template/footer', $data);
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
        $html = $this->load->view('admin/invoice_nilai', $data, true);
        // $this->load->view('invoice', $data);
        $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        // $this->load->view('invoice', $data);

    }

    public function invoice_absen()
    {
        $kode_absen = $this->uri->segment(3);
        $data['kode_magang'] = $kode_absen;
        $id = $this->session->userdata('userid');
        $data['penyelia'] = $this->penyelia->getPenyeliaById($id);
        $data['peserta'] = $this->penyelia->getPesertaById($kode_absen);
        $data['absen'] = $this->dashboard->getAbsenById($kode_absen);
        $data['title'] = 'Laporan Absen Magang';
        // // filename dari pdf ketika didownload
        $file_pdf = 'Laporan Penilaian Magang';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $data['date'] = date('d F Y H:i:s');
        $html = $this->load->view('admin/invoice_absen', $data, true);
        // $this->load->view('invoice', $data);
        $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        // $this->load->view('invoice', $data);

    }

    public function data_ketua()
    {
        $data['session'] = $this->session->userdata('nama');
        $data['title'] = 'Data Ketua';
        $id = $this->session->userdata('userid');
        $data['nama'] = $this->db->get_where('ketua', ['kode_ketua' => $id])->row_array();
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $data['ketua'] = $this->dashboard->getAllKetua();
        // $this->form_validation->set_rules('nama', 'nama', 'required');
        // $this->form_validation->set_rules('nip', 'nip', 'required');
        // $this->form_validation->set_rules('email', 'email', 'required');
        // $this->form_validation->set_rules('password', 'password', 'required');
        // $this->form_validation->set_rules('jeniskel', 'jeniskel', 'required');
        // $this->form_validation->set_rules('telepon', 'telepon', 'required');
        // $this->form_validation->set_rules('kode_kategori', 'kode_kategori', 'required');

        // if ($this->form_validation->run() == false) {
        $this->load->view('ketua/template/header');
        $this->load->view('ketua/template/sidebar', $data);
        $this->load->view('ketua/template/topbar', $data);
        $this->load->view('ketua/data_ketua', $data);
        $this->load->view('ketua/template/footer', $data);
        // } else {
        // 	$data = [
        // 		'nama' => $this->input->post('nama'),
        // 		'nip' => $this->input->post('nip'),
        // 		'email' => $this->input->post('email'),
        // 		'password' => $this->input->post('password'),
        // 		'jeniskel' => $this->input->post('jeniskel'),
        // 		'telepon' => $this->input->post('telepon'),
        // 		'kode_kategori' => $this->input->post('kode_kategori'),
        // 		'is_active' => $this->input->post('is_active'),
        // 		'foto' => $this->input->post('foto')
        // 	];
        // 	$this->db->insert('penyelia', $data);
        // 	$this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Penyelia Berhasil Di Tambah</div>');
        // 	redirect('dashboard/data_penyelia');
        // }
    }

    public function detailketua()
    {
        $kode_id = $this->uri->segment(3);
        $data['session'] = $this->session->userdata('nama');
        $data['title'] = 'Data Lengkap';
        $id = $this->session->userdata('userid');
        $data['nama'] = $this->db->get_where('ketua', ['kode_ketua' => $id])->row_array();
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $data['detail'] = $this->dashboard->getKetuaById($kode_id);
        $this->load->view('ketua/template/header', $data);
        $this->load->view('ketua/template/sidebar', $data);
        $this->load->view('ketua/template/topbar', $data);
        $this->load->view('ketua/detail_ketua', $data);
        $this->load->view('ketua/template/footer', $data);
    }

    public function monitoring()
    {
        $data['session'] = $this->session->userdata('nama');
        $data['title'] = 'Monitoring Absen';
        $id = $this->session->userdata('userid');
        $data['monitoring'] = $this->dashboard->getAllMonitor();
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $data['nama'] = $this->db->get_where('ketua', ['kode_ketua' => $id])->row_array();
        $this->load->view('ketua/template/header', $data);
        $this->load->view('ketua/template/sidebar', $data);
        $this->load->view('ketua/template/topbar', $data);
        $this->load->view('ketua/monitoring', $data);
        $this->load->view('ketua/template/footer');
    }

    public function detailmonitor()
    {
        $kode_monitor = $this->uri->segment(3);
        $data['session'] = $this->session->userdata('nama');
        $data['title'] = 'Monitoring Absen';
        $id = $this->session->userdata('userid');
        $data['detail'] = $this->dashboard->getMonitorById($kode_monitor);
        $data['monitor'] = $this->dashboard->getDivisiById($kode_monitor);
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $data['nama'] = $this->db->get_where('ketua', ['kode_ketua' => $id])->row_array();
        $this->load->view('ketua/template/header', $data);
        $this->load->view('ketua/template/sidebar', $data);
        $this->load->view('ketua/template/topbar', $data);
        $this->load->view('ketua/detail_monitoring', $data);
        $this->load->view('ketua/template/footer');
    }

    public function detailabsen()
    {
        $kode_absen = $this->uri->segment(3);
        $data['kode_magang'] = $kode_absen;
        $data['session'] = $this->session->userdata('nama');
        $data['title'] = 'Detail Monitoring Absensi';
        $id = $this->session->userdata('userid');
        $data['detail'] = $this->dashboard->getMonitorById($kode_absen);
        $data['absen'] = $this->dashboard->getAbsenById($kode_absen);
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $data['nama'] = $this->db->get_where('ketua', ['kode_ketua' => $id])->row_array();
        $this->load->view('ketua/template/header', $data);
        $this->load->view('ketua/template/sidebar', $data);
        $this->load->view('ketua/template/topbar', $data);
        $this->load->view('ketua/detail_absen', $data);
        $this->load->view('ketua/template/footer');
    }

    public function penilaian()
    {
        $data['session'] = $this->session->userdata('nama');
        $data['title'] = 'Penilaian Magang';
        $id = $this->session->userdata('userid');
        $data['nama'] = $this->db->get_where('ketua', ['kode_ketua' => $id])->row_array();
        $data['monitoring'] = $this->dashboard->getAllMonitor();
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $this->load->view('ketua/template/header', $data);
        $this->load->view('ketua/template/sidebar', $data);
        $this->load->view('ketua/template/topbar', $data);
        $this->load->view('ketua/penilaian', $data);
        $this->load->view('ketua/template/footer');
    }

    public function detailnilai()
    {
        $kode_nilai = $this->uri->segment(3);
        $data['session'] = $this->session->userdata('nama');
        $data['title'] = 'Detail Nilai';
        $id = $this->session->userdata('userid');
        $data['detail'] = $this->dashboard->getMonitorById($kode_nilai);
        $data['nilai'] = $this->dashboard->getDivisiById($kode_nilai);
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $data['nama'] = $this->db->get_where('ketua', ['kode_ketua' => $id])->row_array();
        $this->load->view('ketua/template/header', $data);
        $this->load->view('ketua/template/sidebar', $data);
        $this->load->view('ketua/template/topbar', $data);
        $this->load->view('ketua/detail_nilai', $data);
        $this->load->view('ketua/template/footer');
    }

    public function detail_nilai()
    {
        $kode_nilai = $this->uri->segment(3);
        $data['kode_magang'] = $kode_nilai;
        $data['session'] = $this->session->userdata('nama');
        $data['title'] = 'Detail Nilai';
        $data['rownilai'] = $this->penyelia->getPesertaByRow($kode_nilai);
        $id = $this->session->userdata('userid');
        $data['nama'] = $this->db->get_where('ketua', ['kode_ketua' => $id])->row_array();
        $data['nilai'] = $this->penyelia->getNilaiById($kode_nilai);
        $data['peserta'] = $this->dashboard->getPesertaById($kode_nilai);
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $this->form_validation->set_rules('tanggal_penilaian', 'tanggal_penilaian', 'required');
        $this->form_validation->set_rules('disiplin', 'disiplin', 'required');
        $this->form_validation->set_rules('tanggung', 'tanggung', 'required');
        $this->form_validation->set_rules('praktek', 'praktek', 'required');
        $this->form_validation->set_rules('rata', 'rata', 'required');
        $this->form_validation->set_rules('grade', 'grade', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('ketua/template/header');
            $this->load->view('ketua/template/sidebar', $data);
            $this->load->view('ketua/template/topbar', $data);
            $this->load->view('ketua/detail_penilaian', $data);
            $this->load->view('ketua/template/footer', $data);
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
}
