<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'form'));
        $this->load->model('home/Home_model', 'home');
        $this->load->model('penyelia/Penyelia_model', 'penyelia');
        $this->CI = &get_instance();
        $this->load->library('dompdfgenerator');
    }


    public function index()
    {
        $jadwal_id = 1;
        $data['nama'] = $this->session->userdata('nama');
        $data['foto'] = $this->session->userdata('foto');
        $kode_magang = $this->session->userdata('userid');
        $data['loker'] = $this->home->getAllJob();
        $data['peserta'] = $this->home->getPesertaById($kode_magang);
        $data['sertif'] = $this->home->getSertifById($kode_magang);
        $data['absen'] = $this->home->getAllAbsenById($kode_magang);
        $data['totalabsen'] = $this->home->countAllAbsen($kode_magang);
        $data['totalnilai'] = $this->home->countAllNilai($kode_magang);
        $data['totalmasuk'] = $this->home->countAllMasuk($kode_magang);
        $data['totalijin'] = $this->home->countAllIjin($kode_magang);
        $data['totallibur'] = $this->home->countAllLibur($kode_magang);
        $data['waktu'] = $this->home->getWaktuById($jadwal_id);
        $data['absenid'] = $this->home->getAbsenById($kode_magang);
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        //jika sudah login
        if ($this->session->userdata('logged_in') == 'true') {
            $this->load->view('home/template/header_login', $data);
            $this->load->view('home/home_peserta', $data);
            $this->load->view('home/template/footer');
        } else {
            $this->load->view('home/template/header', $data);
            $this->load->view('home/home', $data);
            $this->load->view('home/template/footer');
        }
    }

    public function penilaian()
    {

        $data['nama'] = $this->session->userdata('nama');
        $data['foto'] = $this->session->userdata('foto');
        $data['userid'] = $this->session->userdata('userid');
        $kode_magang = $this->session->userdata('userid');
        $data['loker'] = $this->home->getAllJob();
        $data['rownilai'] = $this->penyelia->getPesertaByRow($kode_magang);
        $data['peserta'] = $this->home->getPesertaById($kode_magang);
        $data['nilai'] = $this->home->getAllNilaiById($kode_magang);
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        //jika sudah login
        if ($this->session->userdata('logged_in') == 'true') {
            $this->load->view('home/template/header_login', $data);
            $this->load->view('home/penilaian', $data);
            $this->load->view('home/template/footer');
        } else {
            $this->load->view('home/template/header', $data);
            $this->load->view('home/home', $data);
            $this->load->view('home/template/footer');
        }
    }

    public function invoice()
    {
        $id = $this->session->userdata('userid');
        $data['penyelia'] = $this->home->getPenyeliaById($id);
        $data['peserta'] = $this->home->getPesertaById($id);
        $data['nilai'] = $this->home->getNilaiById($id);
        $data['disiplin'] = $this->home->getTotalDisiplin($id);
        $data['praktek'] = $this->home->getTotalPraktek($id);
        $data['tanggung'] = $this->home->getTotalTanggung($id);
        $data['rata'] = $this->home->getTotalRata($id);
        $data['title'] = 'Laporan Nilai Magang';
        // filename dari pdf ketika didownload
        $file_pdf = 'Laporan Penilaian Magang';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $data['date'] = date('d F Y H:i:s');
        $html = $this->load->view('home/invoice_nilai', $data, true);
        // $this->load->view('invoice', $data);
        $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        // $this->load->view('invoice', $data);

    }

    public function sertifikat()
    {
        $id = $this->session->userdata('userid');
        $data['ketua'] = $this->home->getKetua();
        $data['peserta'] = $this->home->getPesertaById($id);
        $data['nilai'] = $this->home->getNilaiById($id);
        $data['disiplin'] = $this->home->getTotalDisiplin($id);
        $data['praktek'] = $this->home->getTotalPraktek($id);
        $data['tanggung'] = $this->home->getTotalTanggung($id);
        $data['rata'] = $this->home->getTotalRata($id);
        $data['job'] = $this->home->getJobMagang($id);
        $data['title'] = 'Laporan Sertifikat Magang';
        // filename dari pdf ketika didownload
        $file_pdf = 'Laporan Sertifikat Magang';
        // setting paper
        $paper = 'A4';
        // orientasi paper potrait / landscape
        $orientation = "landscape";
        $data['date'] = date('d F Y');
        $data['nomor'] = date('dmy');
        $data['tahun'] = date('Y');
        $html = $this->load->view('home/sertifikat_magang', $data, true);
        // $this->load->view('home/sertifikat_magang', $data);
        $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        // $this->load->view('invoice', $data);

    }


    public function edit_profil()
    {
        $data['nama'] = $this->session->userdata('nama');
        $data['profil'] = $this->home->getProfile();
        // $data['pesertaall'] = $this->home->getProfileAll();
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $this->form_validation->set_rules('kode_magang', 'kode_magang', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nim', 'Nim', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('jeniskel', 'jeniskel', 'required');
        $this->form_validation->set_rules('sekolah', 'Sekolah', 'required');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
        $this->form_validation->set_rules('telepon', 'Telepon', 'required');
        if ($this->form_validation->run()) {
            $this->home->update();
            $this->session->set_flashdata('success', 'Data Profil Berhasil Diperbarui');
            redirect('login/logout');
        } else {
            $this->session->set_flashdata('Error', 'Data Profil Gagal Diperbarui');
            $this->load->view('home/template/header_edit', $data);
            $this->load->view('home/edit_profil', $data);
            $this->load->view('home/template/footer', $data);
        }
    }

    public function absen()
    {
        $kode_magang = $this->session->userdata('userid');
        $jadwal_id = 1;
        $data['title'] = 'Absensi Peserta Magang';
        $data['nama'] = $this->session->userdata('nama');
        $data['foto'] = $this->session->userdata('foto');
        $data['peserta'] = $this->home->getPesertaById($kode_magang);
        $data['waktu'] = $this->home->getWaktuById($jadwal_id);
        $data['absen'] = $this->home->getAbsenById($kode_magang);
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $this->form_validation->set_rules('kode_magang', 'Kode Magang', 'required');
        $this->form_validation->set_rules('nama', 'Nama Peserta', 'required');
        $this->form_validation->set_rules('jobname', 'jobname', 'required');
        $this->form_validation->set_rules('nama', 'Nama Produk', 'required');
        $this->form_validation->set_rules('tgl_absen', 'Tanggal Absen', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('home/template/header_login', $data);
            $this->load->view('home/absen', $data);
            $this->load->view('home/template/footer', $data);
        } else {
            if (!empty($_FILES["surat_ijin"]["name"])) {
                $date = substr(date('Ymd'), 2, 8);
                $config = array();
                $config['upload_path'] = './assets/data/peserta/surat_ijin';
                $config['allowed_types'] = 'pdf';
                $config['file_name']    = $date . '-' . $_FILES['surat_ijin']['name'];

                $this->load->library('upload', $config, 'surat_ijin');
                $this->surat_ijin->initialize($config);
                $upload_surat_ijin = $this->surat_ijin->do_upload('surat_ijin');

                if ($upload_surat_ijin) {
                    $data =  array(
                        'kode_magang' => $this->input->post('kode_magang'),
                        'nama' => $this->input->post('nama'),
                        'jobname' => $this->input->post('jobname'),
                        'status' => $this->input->post('status'),
                        'surat_ijin' => $this->surat_ijin->data("file_name"),
                        'tgl_absen' => $this->input->post('tgl_absen'),
                    );

                    $this->db->insert('absensi', $data);
                    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Absensi Baru Telah Diupdate!</div>');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Absensi Gagal, silahkan ulangi pengisian form!</div>');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                $data =  [
                    'kode_magang' => $this->input->post('kode_magang'),
                    'nama' => $this->input->post('nama'),
                    'jobname' => $this->input->post('jobname'),
                    'status' => $this->input->post('status'),
                    'surat_ijin' => null,
                    'tgl_absen' => $this->input->post('tgl_absen'),
                ];

                if ($data == true) {
                    $this->db->insert('absensi', $data);
                    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Absensi Baru Telah Diupdate!</div>');
                    $this->updatemasuk($kode_magang);
                } else {
                    $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Absensi Baru Gagal Diupdate!</div>');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
        }
    }

    public function updatemasuk($kode_magang)
    {
        $this->db->set('absen', 1);
        $this->db->where('kode_magang', $kode_magang);
        $this->db->update('peserta_magang');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function absenpulang()
    {
        $kode_magang = $this->session->userdata('userid');
        $jadwal_id = 1;
        $data['title'] = 'Absensi Peserta Magang';
        $data['nama'] = $this->session->userdata('nama');
        $data['foto'] = $this->session->userdata('foto');
        $data['peserta'] = $this->home->getPesertaById($kode_magang);
        $data['waktu'] = $this->home->getWaktuById($jadwal_id);
        $data['absen'] = $this->home->getAbsenById($kode_magang);
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $this->form_validation->set_rules('kode_magang', 'Kode Magang', 'required');
        $this->form_validation->set_rules('nama', 'Nama Peserta', 'required');
        $this->form_validation->set_rules('jobname', 'jobname', 'required');
        $this->form_validation->set_rules('nama', 'Nama Produk', 'required');
        $this->form_validation->set_rules('tgl_absen', 'Tanggal Absen', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('home/template/header_login', $data);
            $this->load->view('home/absen', $data);
            $this->load->view('home/template/footer', $data);
        } else {
            if (!empty($_FILES["surat_ijin"]["name"])) {
                $date = substr(date('Ymd'), 2, 8);
                $config = array();
                $config['upload_path'] = './assets/data/peserta/surat_ijin';
                $config['allowed_types'] = 'pdf';
                $config['file_name']    = $date . '-' . $_FILES['surat_ijin']['name'];

                $this->load->library('upload', $config, 'surat_ijin');
                $this->surat_ijin->initialize($config);
                $upload_surat_ijin = $this->surat_ijin->do_upload('surat_ijin');

                if ($upload_surat_ijin) {
                    $data =  array(
                        'kode_magang' => $this->input->post('kode_magang'),
                        'nama' => $this->input->post('nama'),
                        'jobname' => $this->input->post('jobname'),
                        'status' => $this->input->post('status'),
                        'surat_ijin' => $this->surat_ijin->data("file_name"),
                        'tgl_absen' => $this->input->post('tgl_absen'),
                        'kegiatan' => $this->input->post('kegiatan'),
                    );

                    $this->db->insert('absensi', $data);
                    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Absensi Baru Telah Diupdate!</div>');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Absensi Gagal, silahkan ulangi pengisian form!</div>');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                $data =  [
                    'kode_magang' => $this->input->post('kode_magang'),
                    'nama' => $this->input->post('nama'),
                    'jobname' => $this->input->post('jobname'),
                    'status' => $this->input->post('status'),
                    'surat_ijin' => null,
                    'tgl_absen' => $this->input->post('tgl_absen'),
                    'kegiatan' => $this->input->post('kegiatan'),
                ];

                if ($data == true) {
                    $this->db->insert('absensi', $data);
                    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Absensi Baru Telah Diupdate!</div>');
                    $this->updatepulang($kode_magang);
                } else {
                    $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Absensi Baru Gagal Diupdate!</div>');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
        }
    }

    public function updatepulang($kode_magang)
    {
        $this->db->set('absen', 0);
        $this->db->where('kode_magang', $kode_magang);
        $this->db->update('peserta_magang');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function daftarloker()
    {
        $loker_id = $this->uri->segment(3);
        $data['nama'] = $this->session->userdata('nama');
        $data['role'] = $this->session->userdata('role');
        $data['foto'] = $this->session->userdata('foto');
        $data['userid'] = $this->session->userdata('userid');
        $data['loker'] = $this->home->getAllJob();
        $kuota = $this->input->post('kuota', TRUE);
        $jobid = $this->input->post('jobid', TRUE);
        $data['daftar'] = $this->home->getJobById($loker_id);
        $data['password'] =  $this->home->getPasswd();
        $data['waktu'] = date_default_timezone_set('Asia/Jakarta');
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nim', 'nim', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required');
        $this->form_validation->set_rules('jeniskel', 'jeniskel', 'required');
        $this->form_validation->set_rules('sekolah', 'Sekolah', 'required');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
        $this->form_validation->set_rules('telepon', 'Telepon', 'required');
        $this->form_validation->set_rules('kode_kategori', 'kode_kategori', 'required');
        $this->form_validation->set_rules('is_active', 'Is_active', 'required');
        $this->form_validation->set_rules('status', 'status', 'required');
        $this->form_validation->set_rules('idrole', 'Role', 'required');
        $this->form_validation->set_rules('tgl_daftar', 'Tgl Daftar', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('home/template/header', $data);
            $this->load->view('home/daftar_loker', $data);
            $this->load->view('home/template/footer');
            // var_dump($this->form_validation->run());
            // die;
        } else {
            $date = substr(date('Ymd'), 2, 8);
            $config = array();
            $config['upload_path'] = './assets/data/peserta/pas_foto';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['file_name']    =  $date . '-' . $_FILES['foto']['name'];

            $this->load->library('upload', $config, 'foto');
            $this->foto->initialize($config);
            $upload_foto = $this->foto->do_upload('foto');

            $config = array();
            $config['upload_path'] = './assets/data/peserta/surat_pengantar';
            $config['allowed_types'] = 'pdf';
            $config['file_name']    = $date . '-' . $_FILES['surat_pengantar']['name'];

            $this->load->library('upload', $config, 'surat_pengantar');
            $this->surat_pengantar->initialize($config);
            $upload_surat_pengantar = $this->surat_pengantar->do_upload('surat_pengantar');

            if ($upload_foto && $upload_surat_pengantar) {
                $length =  $this->home->getPasswd();

                $data = array(
                    'nama'              => $this->input->post('nama'),
                    'nim'              => $this->input->post('nim'),
                    'email'             => $this->input->post('email'),
                    'jeniskel'          => $this->input->post('jeniskel'),
                    'sekolah'           => $this->input->post('sekolah'),
                    'jurusan'           => $this->input->post('jurusan'),
                    'kode_kategori'             => $this->input->post('kode_kategori'),
                    'telepon'             => $this->input->post('telepon'),
                    'idrole'             => $this->input->post('idrole'),
                    'foto'              => $this->foto->data("file_name"),
                    'surat_pengantar'   => $this->surat_pengantar->data("file_name"),
                    'is_active'         => 1,
                    'status'            => 0,
                    'password'          => $length,
                    'tingkat_pendidikan' => $this->input->post('pendidikan'),
                    'tgl_daftar' => $this->input->post('tgl_daftar')
                );

                $this->db->insert('peserta_magang', $data);
                $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Anda telah terdaftar, silahkan menunggu konfirmasi!</div>');

                $this->updatekuota($kuota, $jobid);
            } else {
                $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Gagal mendaftar, silahkan ulangi pendaftaran!</div>');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function daftarindividu()
    {
        $data['nama'] = $this->session->userdata('nama');
        $data['role'] = $this->session->userdata('role');
        $data['foto'] = $this->session->userdata('foto');
        $data['userid'] = $this->session->userdata('userid');
        $data['password'] =  $this->home->getPasswd();
        $data['waktu'] = date_default_timezone_set('Asia/Jakarta');
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nim', 'nim', 'required');
        $this->form_validation->set_rules('email_kampus', 'email_kampus', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required');
        $this->form_validation->set_rules('jeniskel', 'jeniskel', 'required');
        $this->form_validation->set_rules('sekolah', 'Sekolah', 'required');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
        $this->form_validation->set_rules('telepon', 'Telepon', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('home/template/header', $data);
            $this->load->view('home/daftar_individu', $data);
            $this->load->view('home/template/footer');
            // var_dump($this->form_validation->run());
            // die;
        } else {
            $date = substr(date('Ymd'), 2, 8);
            $config = array();
            $config['upload_path'] = './assets/data/peserta/pas_foto';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['file_name']    =  $date . '-' . $_FILES['foto']['name'];

            $this->load->library('upload', $config, 'foto');
            $this->foto->initialize($config);
            $upload_foto = $this->foto->do_upload('foto');

            $config = array();
            $config['upload_path'] = './assets/data/peserta/surat_pengantar';
            $config['allowed_types'] = 'pdf';
            $config['file_name']    = $date . '-' . $_FILES['surat_pengantar']['name'];

            $this->load->library('upload', $config, 'surat_pengantar');
            $this->surat_pengantar->initialize($config);
            $upload_surat_pengantar = $this->surat_pengantar->do_upload('surat_pengantar');

            $config = array();
            $config['upload_path'] = './assets/data/peserta/transkip_nilai';
            $config['allowed_types'] = 'pdf';
            $config['file_name']    = $date . '-' . $_FILES['transkip_nilai']['name'];

            $this->load->library('upload', $config, 'transkip_nilai');
            $this->transkip_nilai->initialize($config);
            $upload_transkip_nilai = $this->transkip_nilai->do_upload('transkip_nilai');

            if ($upload_foto && $upload_surat_pengantar && $upload_transkip_nilai) {
                $length =  $this->home->getPasswd();

                $data = array(
                    'nama'              => $this->input->post('nama'),
                    'nim'              => $this->input->post('nim'),
                    'email'             => $this->input->post('email'),
                    'email_kampus'             => $this->input->post('email_kampus'),
                    'jeniskel'          => $this->input->post('jeniskel'),
                    'sekolah'           => $this->input->post('sekolah'),
                    'jurusan'           => $this->input->post('jurusan'),
                    'kode_kategori'             => $this->input->post('kode_kategori'),
                    'telepon'             => $this->input->post('telepon'),
                    'idrole'             => $this->input->post('idrole'),
                    'foto'              => $this->foto->data("file_name"),
                    'surat_pengantar'   => $this->surat_pengantar->data("file_name"),
                    'transkip_nilai'   => $this->transkip_nilai->data("file_name"),
                    'is_active'         => 1,
                    'status'            => 0,
                    'password'          => $length,
                    'tingkat_pendidikan' => $this->input->post('pendidikan'),
                    'sertifikat' => 'default.pdf',
                    'tgl_daftar' => $this->input->post('tgl_daftar')
                );

                $this->db->insert('peserta_magang', $data);
                $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Anda telah terdaftar, silahkan menunggu konfirmasi!</div>');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Gagal mendaftar, silahkan ulangi pendaftaran!</div>');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function daftarkelompok()
    {
        $data['nama'] = $this->session->userdata('nama');
        $data['role'] = $this->session->userdata('role');
        $data['foto'] = $this->session->userdata('foto');
        $data['userid'] = $this->session->userdata('userid');
        $data['password'] =  $this->home->getPasswd();
        $data['waktu'] = date_default_timezone_set('Asia/Jakarta');
        $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
        $this->form_validation->set_rules('email_kampus', 'email_kampus', 'required');
        $this->form_validation->set_rules('tingkat_pendidikan', 'tingkat_pendidikan', 'required');
        $this->form_validation->set_rules('sekolah', 'Sekolah', 'required');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('home/template/header', $data);
            $this->load->view('home/daftar_kelompok', $data);
            $this->load->view('home/template/footer');
            // var_dump($this->form_validation->run());
            // die;
        } else {
            $date = substr(date('Ymd'), 2, 8);
            $config = array();
            $config['upload_path'] = './assets/data/kelompok/surat_pengantar';
            $config['allowed_types'] = 'pdf';
            $config['file_name']    = $date . '-' . $_FILES['surat_pengantar']['name'];

            $this->load->library('upload', $config, 'surat_pengantar');
            $this->surat_pengantar->initialize($config);
            $upload_surat_pengantar = $this->surat_pengantar->do_upload('surat_pengantar');

            $config = array();
            $config['upload_path'] = './assets/data/kelompok/transkip_nilai';
            $config['allowed_types'] = 'pdf';
            $config['file_name']    = $date . '-' . $_FILES['transkip_nilai']['name'];

            $this->load->library('upload', $config, 'transkip_nilai');
            $this->transkip_nilai->initialize($config);
            $upload_transkip_nilai = $this->transkip_nilai->do_upload('transkip_nilai');

            if ($upload_surat_pengantar && $upload_transkip_nilai) {
                $length =  $this->home->getPasswd();

                $data = array(
                    'nama_1'              => $this->input->post('nama1'),
                    'nama_2'              => $this->input->post('nama2'),
                    'nama_3'              => $this->input->post('nama3'),
                    'nim_1'              => $this->input->post('nim1'),
                    'nim_2'              => $this->input->post('nim2'),
                    'nim_3'              => $this->input->post('nim3'),
                    'email_1'             => $this->input->post('email1'),
                    'email_2'             => $this->input->post('email2'),
                    'email_3'             => $this->input->post('email3'),
                    'email_kampus'             => $this->input->post('email_kampus'),
                    'jeniskel_1'          => $this->input->post('jeniskel1'),
                    'jeniskel_2'          => $this->input->post('jeniskel2'),
                    'jeniskel_3'          => $this->input->post('jeniskel3'),
                    'sekolah'           => $this->input->post('sekolah'),
                    'jurusan'           => $this->input->post('jurusan'),
                    'telp_1'             => $this->input->post('telp1'),
                    'telp_2'             => $this->input->post('telp2'),
                    'telp_3'             => $this->input->post('telepon'),
                    'surat_pengantar'   => $this->surat_pengantar->data("file_name"),
                    'transkip_nilai'   => $this->transkip_nilai->data("file_name"),
                    'status'            => 0,
                    'tingkat_pendidikan' => $this->input->post('tingkat_pendidikan'),
                    'tgl_daftar' => $this->input->post('tgl_daftar')
                );

                $this->db->insert('peserta_kelompok', $data);
                $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Anda telah terdaftar, silahkan menunggu konfirmasi!</div>');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Gagal mendaftar, silahkan ulangi pendaftaran!</div>');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function updatekuota($kuota, $jobid)
    {

        $this->db->set('kuota',  $kuota);
        $this->db->where('jobid', $jobid);
        $this->db->update('job');
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Anda telah terdaftar, silahkan menunggu konfirmasi!</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
