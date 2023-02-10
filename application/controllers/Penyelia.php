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
    $this->load->model('home/Home_model', 'home');
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
    $data['unverifabsen'] = $this->penyelia->countAllUnverifAbsenById($kategori);
    $data['unverifabsenuser'] = $this->penyelia->getAllUnverifAbsenById($kategori);
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

  public function cetak_laporan()
  {
    $from = $this->input->post('from');
    $to = $this->input->post('to');
    $id = $this->session->userdata('userid');
    $data['nama'] = $this->db->get_where('admin', ['kode_admin' => $id])->row_array();
    $data['from'] = $from;
    $data['to'] = $to;
    $data['datauser'] = $this->penyelia->getAllData($from, $to, $id);
    $data['title'] = 'Laporan Data Peserta';
    // filename dari pdf ketika didownload
    $file_pdf = 'Laporan Data Peserta';
    // setting paper
    $paper = 'A4';
    //orientasi paper potrait / landscape
    $orientation = "potrait";
    $data['date_id'] = date('j / n / y');
    $data['date'] = date('d F Y');
    $html = $this->load->view('penyelia/cetak_laporan', $data, true);
    // $this->load->view('atasan/cetak_laporan', $data);
    $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    // $this->load->view('invoice', $data);
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
    $nama = $this->input->post('nama');
    $divisi = $this->input->post('divisi');
    $password = $this->input->post('password');
    $email = $this->input->post('email');
    $this->db->set('konfirmasi', $this->input->post('konfirmasi'));
    $this->db->where('kode_magang', $kode_magang);
    $this->db->update('peserta_magang');
    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Pelamar Telah Berhasil Diverifikasi!</div>');
    $this->sendEmail($email, $divisi, $password, $nama);
    redirect($_SERVER['HTTP_REFERER']);
  }

  //function konfigurasi smtp
  public function sendEmail($email, $divisi, $password, $nama)
  {

    /* use this on server */

    /* $config = Array(
               'mailtype' => 'html',
               'charset' => 'iso-8859-1',
               'wordwrap' => TRUE
             );
          */


    /*This email configuration for sending email by Google Email(Gmail Acccount) from localhost */
    $config = array(
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'newline' => "\r\n",
      'smtp_port' => 465,
      'smtp_user' => 'ayuretnowulandini11@gmail.com',  //gmail id
      'smtp_pass' => 'gbtnmvjsepzvnxrk',   //gmail password
      'smtp_crypto' => 'security',
      'mailtype' => 'html',
      'charset' => 'iso-8859-1',
      'wordwrap' => TRUE
    );

    //configuration smtp mailtrap.io
    // $config = Array(
    // 'protocol' => 'smtp',
    // 'smtp_host' => 'smtp.mailtrap.io',
    // 'smtp_port' => 2525,
    // 'smtp_user' => '6e31d3a8ddbd56',
    // 'smtp_pass' => '96cdfdcb4065db',
    // 'crlf' => "\r\n",
    // 'newline' => "\r\n"
    // );
    $this->email->initialize($config);
    $this->load->library('email', $config);
    $this->email->set_newline("\r\n");
    $this->email->from('noreply');
    $this->email->to($email);
    $this->email->subject('Penerimaan Peserta');
    $this->email->message('
        
<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Konfirmasi Peserta Magang</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
  /**
   * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
   */
  @media screen {
    @font-face {
      font-family: ' . 'Source Sans Pro' . ';
      font-style: normal;
      font-weight: 400;
      src: local(' . 'Source Sans Pro Regular' . '), local(' . 'SourceSansPro-Regular' . '), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format(' . 'woff' . ');
    }
    @font-face {
      font-family: ' . 'Source Sans Pro' . ';
      font-style: normal;
      font-weight: 700;
      src: local(' . 'Source Sans Pro Bold' . '), local(' . 'SourceSansPro-Bold' . '), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format(' . 'woff' . ');
    }
  }
  /**
   * Avoid browser level font resizing.
   * 1. Windows Mobile
   * 2. iOS / OSX
   */
  body,
  table,
  td,
  a {
    -ms-text-size-adjust: 100%; /* 1 */
    -webkit-text-size-adjust: 100%; /* 2 */
  }
  /**
   * Remove extra space added to tables and cells in Outlook.
   */
  table,
  td {
    mso-table-rspace: 0pt;
    mso-table-lspace: 0pt;
  }
  /**
   * Better fluid images in Internet Explorer.
   */
  img {
    -ms-interpolation-mode: bicubic;
  }
  /**
   * Remove blue links for iOS devices.
   */
  a[x-apple-data-detectors] {
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    color: inherit !important;
    text-decoration: none !important;
  }
  /**
   * Fix centering issues in Android 4.4.
   */
  div[style*="margin: 16px 0;"] {
    margin: 0 !important;
  }
  body {
    width: 100% !important;
    height: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
  }
  /**
   * Collapse table borders to avoid space between cells.
   */
  table {
    border-collapse: collapse !important;
  }
  a {
    color: #1a82e2;
  }
  img {
    height: auto;
    line-height: 100%;
    text-decoration: none;
    border: 0;
    outline: none;
  }
  </style>

</head>
<body style="background-color: #e9ecef;">

  <!-- start preheader -->
  <div class="preheader" style="display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;">
   Penerimaan Magang Pengadilan Tinggi Negeri Semarang.
  </div>
  <!-- end preheader -->

  <!-- start body -->
  <table border="0" cellpadding="0" cellspacing="0" width="100%">

    <!-- start logo -->
    <tr>
      <td align="center" bgcolor="#e9ecef">
        <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
          <tr>
            <td align="center" valign="top" style="padding: 36px 24px;">
              <a href="http://localhost/simone target="_blank" style="display: inline-block;">
                <img src="https://d15k2d11r6t6rl.cloudfront.net/public/users/BeeFree/beefree-rwxrob1kfhs/pn.png" alt="Logo" border="0" width="60" style="display: block; width: 80px; max-width: 80px; min-width: 80px;">
              </a>
            </td>
          </tr>
        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end logo -->

    <!-- start hero -->
    <tr>
      <td align="center" bgcolor="#e9ecef">
        <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
          <tr>
            <td align="left" bgcolor="#ffffff" style="padding: 36px 24px 0; font-family: ' . 'Source Sans Pro' . ', Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;">
              <h1 style="margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">Selamat Anda Telah Diterima</h1>
            </td>
          </tr>
        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end hero -->

    <!-- start copy block -->
    <tr>
      <td align="center" bgcolor="#e9ecef">
        <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

          <!-- start copy -->
          <tr>
            <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: ' . 'Source Sans Pro' . ', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
              <p style="margin: 0;">' . $nama . ', Anda telah diterima magang di divisi ' . $divisi . ', Pengadilan Tinggi Negeri Semarang. Silahkan lakukan login menggunakan password kode dibawah ini</p>
            </td>
          </tr>
          <!-- end copy -->

          <!-- start button -->
          <tr>
            <td align="left" bgcolor="#ffffff">
              <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                  <td align="center" bgcolor="#ffffff" style="padding: 12px;">
                    <table border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td align="center" bgcolor="#CDCDCD" style="border-radius: 6px;">
                          <a class="disabled" style="display: inline-block; padding: 16px 36px; font-family: ' . 'Source Sans Pro' . ', Helvetica, Arial, sans-serif; font-size: 16px; color: #ffffff; text-decoration: none; border-radius: 6px;"><b>' . $password . '</b></a>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <!-- end button -->

          <!-- start copy -->
          <tr>
            <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: ' . 'Source Sans Pro' . ', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
              <p style="margin: 0;">Klik link dibawah ini untuk melakukan login ulang</p>
              <p style="margin: 0;"><a href="http://localhost/simone/login" target="_blank">http://localhost/simone/login</a></p>
            </td>
          </tr>
          <!-- end copy -->

          <!-- start copy -->
          <tr>
            <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: ' . 'Source Sans Pro' . ', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-bottom: 3px solid #d4dadf">
              
            </td>
          </tr>
          <!-- end copy -->

        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end copy block -->

    <!-- start footer -->
    <tr>
      <td align="center" bgcolor="#e9ecef" style="padding: 24px;">
        <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

          <!-- start permission -->
          <tr>
            <td align="center" bgcolor="#e9ecef" style="padding: 12px 24px; font-family: ' . 'Source Sans Pro' . ', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;">
              <p style="margin: 0;">Email ini merupakan email asli dari Pengadilan Tinggi Negeri Semarang. Anda tidak perlu membalas email ini, karena dijalankan oleh robot.</p>
            </td>
          </tr>
          <!-- end permission -->

          <!-- start unsubscribe -->
          <tr>
            <td align="center" bgcolor="#e9ecef" style="padding: 12px 24px; font-family: ' . 'Source Sans Pro' . ', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;">
              <p style="margin: 0;">Jika anda tidak melakukan pendaftaran silahkan abaikan pesan ini kapanpun.</p>
 
            </td>
          </tr>
          <!-- end unsubscribe -->

        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end footer -->

  </table>
  <!-- end body -->

</body>
</html>');

    if ($this->email->send()) {
      return true;
    } else {
      return false;
    }
  }

  public function verifconfirm($absen_id)
  {
    $this->db->set('status', 1);
    $this->db->where('absen_id', $absen_id);
    $this->db->update('absensi');
    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Absen Telah Berhasil Diverifikasi!</div>');
    redirect($_SERVER['HTTP_REFERER']);
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
    $data['kode_magang'] = $kode_absen;
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

  public function verifabsen()
  {
    $data['session'] = $this->session->userdata('nama');
    $data['title'] = 'Verifikasi Absen';
    $id = $this->session->userdata('userid');
    $data['penyelia'] = $this->penyelia->getPenyeliaById($id);
    $kategori = $this->session->userdata('kode_kategori');
    $data['absenmhs'] = $this->penyelia->getMhsByAbsenMhs($kategori);
    $data['absenswa'] = $this->penyelia->getMhsByAbsenSwa($kategori);
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    $this->load->view('penyelia/template/header', $data);
    $this->load->view('penyelia/template/sidebar', $data);
    $this->load->view('penyelia/template/topbar', $data);
    $this->load->view('penyelia/verifabsen', $data);
    $this->load->view('penyelia/template/footer');
  }

  public function sertifikat()
  {
    $id = $this->uri->segment(3);
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

  public function upsertifmhs($kode_magang)
  {
    // $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    // $data = [
    //   'sertifikat' => $this->input->post('sertif'),

    // ];
    // $this->db->where('kode_magang', $kode_magang);
    // $this->db->update('peserta_magang', $data);
    // $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Sertifikat berhasil dibuat</div>');
    // redirect($_SERVER['HTTP_REFERER']);
    $date = substr(date('Ymd'), 2, 8);
    $config = array();
    $config['upload_path'] = './assets/data/peserta/sertifikat';
    $config['allowed_types'] = 'pdf';
    $config['file_name']    = $date . '-' . $_FILES['surat_sertifikat']['name'];

    $this->load->library('upload', $config, 'surat_sertifikat');
    $this->surat_sertifikat->initialize($config);
    $upload_surat_sertifikat = $this->surat_sertifikat->do_upload('surat_sertifikat');

    if ($upload_surat_sertifikat) {
      $data = array(
        'sertifikat'   => $this->surat_sertifikat->data("file_name"),
      );
      $this->db->where('kode_magang', $kode_magang);
      $this->db->update('peserta_magang', $data);
      $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Upload Sertifikat Berhasil</div>');
      redirect($_SERVER['HTTP_REFERER']);
    } else {
      $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Gagal Upload, silahkan ulangi!</div>');
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
    $html = $this->load->view('penyelia/invoice_nilai', $data, true);
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
    $html = $this->load->view('penyelia/invoice_absen', $data, true);
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
