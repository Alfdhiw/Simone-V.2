<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sekretaris extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->helper(array('url', 'form'));
    $this->load->model('auth/Auth_model', 'auth');
    $this->load->model('sekretaris/Dashboard_model', 'dashboard');
    $this->load->model('penyelia/Penyelia_model', 'penyelia');
    $this->load->model('sekretaris/DataPeserta_model', 'peserta');
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
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $id])->row_array();
    $data['sekretaris'] = $this->dashboard->getSekretarisById($id);
    $data['job'] = $this->dashboard->countAllMagang();
    $data['unverif'] = $this->dashboard->countAllUnverif();
    $data['proses'] = $this->dashboard->countAllProses();
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
    $data['loker'] = $this->dashboard->getAllKuota();
    $data['peserta'] = $this->dashboard->getAllPeserta();
    $data['unverifuser'] = $this->dashboard->getAllUnverif();
    $data['unproses'] = $this->dashboard->getAllUnproses();
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    $this->load->view('sekretaris/template/header');
    $this->load->view('sekretaris/template/sidebar', $data);
    $this->load->view('sekretaris/template/topbar', $data);
    $this->load->view('sekretaris/sekretaris', $data);
    $this->load->view('sekretaris/template/footer', $data);
  }

  public function divisi()
  {
    $data['session'] = $this->session->userdata('nama');
    $data['title'] = 'Divisi Magang';
    $id = $this->session->userdata('userid');
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $id])->row_array();
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    $data['divisi'] = $this->dashboard->getAllMonitor();
    $data['penyelia'] = $this->dashboard->getAllPenyelia();
    $this->load->view('sekretaris/template/header', $data);
    $this->load->view('sekretaris/template/sidebar', $data);
    $this->load->view('sekretaris/template/topbar', $data);
    $this->load->view('sekretaris/divisi', $data);
    $this->load->view('sekretaris/template/footer', $data);
  }

  public function tambahdivisi()
  {
    $this->form_validation->set_rules('divisi', 'Divisi', 'required');

    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Divisi Gagal Ditambahkan!</div>');
      redirect('dashboard/divisi');
    } else {
      $data = [
        'divisi' => $this->input->post('divisi'),
        'kode_penyelia' => 0,
        'status' => 1,
      ];
      $this->db->insert('kategori_magang', $data);
      $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Divisi Berhasil Ditambahkan!</div>');
      redirect('dashboard/divisi');
    }
  }

  public function menu_management()
  {
    $data['session'] = $this->session->userdata('nama');
    $data['title'] = 'Menu Management';
    $id = $this->session->userdata('userid');
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $id])->row_array();
    $data['menu'] = $this->dashboard->getAllMenu();
    $data['submenu'] = $this->dashboard->getSubMenu();
    $this->form_validation->set_rules('menu', 'Menu', 'required');
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    if ($this->form_validation->run() == false) {
      $this->load->view('sekretaris/template/header');
      $this->load->view('sekretaris/template/sidebar', $data);
      $this->load->view('sekretaris/template/topbar', $data);
      $this->load->view('sekretaris/menu_management', $data);
      $this->load->view('sekretaris/template/footer', $data);
    } else {
      $this->db->insert('menu', ['menu' => $this->input->post('menu')]);
      $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Sub Menu Berhasil Ditambah!</div>');
      redirect('dashboard/menu_management');
    }
  }
  public function loker()
  {
    $data['session'] = $this->session->userdata('nama');
    $data['title'] = 'Kuota Magang';
    $id = $this->session->userdata('userid');
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $id])->row_array();
    $data['kerja'] = $this->dashboard->getAllDivisi();
    $data['loker'] = $this->dashboard->getAllLoker();
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    $this->load->view('sekretaris/template/header');
    $this->load->view('sekretaris/template/sidebar', $data);
    $this->load->view('sekretaris/template/topbar', $data);
    $this->load->view('sekretaris/loker', $data);
    $this->load->view('sekretaris/template/footer', $data);
  }

  public function editSubMenu($id)
  {
    $data['session'] = $this->session->userdata('nama');
    $data['submenu'] = $this->dashboard->getSubMenuById($id);
    $data['id'] = $id;
    $this->db->set('menuid', $this->input->post('menu_id'));
    $this->db->set('title', $this->input->post('title'));
    $this->db->set('url', $this->input->post('url'));
    $this->db->set('icon', $this->input->post('icon'));
    $this->db->set('is_active', $this->input->post('is_active'));
    $this->db->where('submenuid', $id);
    $this->db->update('submenu');
    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Sub Menu Berhasil Diedit!</div>');
    redirect('dashboard/menu_management');
  }

  public function confirm($kode_magang)
  {
    $this->db->set('status', $this->input->post('status'));
    $this->db->set('tgl_terima', $this->input->post('tgl_terima'));
    $this->db->where('kode_magang', $kode_magang);
    $this->db->update('peserta_magang');
    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Pelamar Telah Berhasil Diverifikasi!</div>');
    redirect('dashboard/verif');
  }

  public function terimapeserta($kode_magang)
  {
    $nama = $this->input->post('nama');
    $sekolah = $this->input->post('sekolah');
    $jurusan = $this->input->post('jurusan');
    $email_kampus = $this->input->post('email_kampus');
    $nim = $this->input->post('nim');
    $id = $this->session->userdata('userid');
    $kode_kategori = $this->input->post('kode_kategori');
    $data['kategori'] = $this->dashboard->getAllKuotaById($kode_kategori);
    $kuota = $data['kategori']['kuota'];
    $hasilkuota = $kuota - 1;
    $data['sekretaris'] = $this->dashboard->getSekretarisById($id);
    $telp = $data['sekretaris']['telepon'];
    $sekretaris = $data['sekretaris']['nama'];
    $this->db->set('konfirmasi', $this->input->post('konfirmasi'));
    $this->db->set('status', 2);
    $this->db->set('tgl_terima', $this->input->post('tgl_terima'));
    $this->db->set('kode_kategori', $this->input->post('kode_kategori'));
    $this->db->where('kode_magang', $kode_magang);
    $this->db->update('peserta_magang');
    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Pelamar Telah Berhasil Diverifikasi!</div>');
    // $this->sendEmail($email_kampus, $nama, $sekolah, $jurusan, $nim, $telp, $sekretaris);
    $this->updatekuota($hasilkuota, $kode_kategori);
    redirect($_SERVER['HTTP_REFERER']);
  }

  //function konfigurasi smtp
  public function sendEmail($email_kampus, $nama, $sekolah, $jurusan, $nim, $telp, $sekretaris)
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
      'smtp_host' => 'smtp.gmail.com',
      'newline' => "\r\n",
      'smtp_port' => 465,
      'smtp_user' => 'januartegar504@gmail.com',  //gmail id
      'smtp_pass' => 'wixyzhyuktisdmdp',   //gmail password
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
    $this->email->to('tumbalgendhon22@gmail.com');
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
                      <h1 style="margin: 0; text-align: center; font-size: 30px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">Pengumuman Penerimaan Peserta Magang</h1>
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
                    <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: ' . 'Source Sans Pro' . ', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 20px;">
                      <p style="margin: 0;">Telah diberitahukan penerimaan peserta magang di Pengadilan Tinggi Negeri Semarang, dengan data sebagai berikut :`</p>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" bgcolor="#ffffff" style="font-family: ' . 'Source Sans Pro' . ', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 5px;">
                      <p style="margin-left: 25px ;">Nama :' . $nama . '</p>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" bgcolor="#ffffff" style="font-family: ' . 'Source Sans Pro' . ', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 5px;">
                      <p style="margin-left: 25px ;">NIM / NISN : ' . $nim . '</p>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" bgcolor="#ffffff" style="font-family: ' . 'Source Sans Pro' . ', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 5px;">
                      <p style="margin-left: 25px ;">Asal Sekolah : ' . $sekolah . '</p>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" bgcolor="#ffffff" style="font-family: ' . 'Source Sans Pro' . ', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 5px;">
                      <p style="margin-left: 25px ;">Jurusan : ' . $jurusan . '</p>
                    </td>
                  </tr>
                  <!-- end copy -->
        
                  <!-- start button -->
                  <!-- end button -->
        
                  <!-- start copy -->
                  <tr>
                    <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: ' . 'Source Sans Pro' . ', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                      <p style="margin: 0;">Pihak sekolah diharapkan untuk memberitahukan informasi ini kepada pihak yang bersangkutan, untuk menghubungi pihak Pengadilan Tinggi Negeri Semarang secepatnya.</p>
                      <br>
                      <p style="margin: 0;">Silahkan hubungi nomer dibawah ini untuk informasi lebih lanjut.</p>
                      <p style="margin: 0;"><a href="https://wa.me/' . $telp . '" target="_blank">' . $telp . '</a>(' . $sekretaris . ')</p>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: ' . 'Source Sans Pro' . ', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                      
                    </td>
                  </tr>
                  <!-- end copy -->
        
                  <!-- start copy -->
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

  public function updatekuota($hasilkuota, $kode_kategori)
  {
    $this->db->set('kuota', $hasilkuota);
    $this->db->where('kode_kategori', $kode_kategori);
    $this->db->update('kategori_magang');
  }

  public function abort($kode_magang)
  {
    $this->db->set('status', $this->input->post('status'));
    $this->db->set('tgl_terima', $this->input->post('tgl_terima'));
    $this->db->where('kode_magang', $kode_magang);
    $this->db->update('peserta_magang');
    $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Pelamar Telah Ditolak!</div>');
    redirect('sekretaris/verif');
  }

  public function abortkelompok($kode_kelompok)
  {
    $this->db->set('status', $this->input->post('status'));
    $this->db->set('tgl_terima', $this->input->post('tgl_terima'));
    $this->db->where('kode_kelompok', $kode_kelompok);
    $this->db->update('peserta_kelompok');
    $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Pelamar Telah Ditolak!</div>');
    redirect('sekretaris/verif');
  }

  public function daftarindividu()
  {
    $data['session'] = $this->session->userdata('nama');
    $data['title'] = 'Input Data Pelamar';
    $id = $this->session->userdata('userid');
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $id])->row_array();
    $data['sekretaris'] = $this->dashboard->getSekretarisById($id);
    $data['kerja'] = $this->dashboard->getAllDivisi();
    $data['password'] =  $this->home->getPasswd();
    $length = $data['password'];
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

      $this->load->view('sekretaris/template/header', $data);
      $this->load->view('sekretaris/template/sidebar', $data);
      $this->load->view('sekretaris/template/topbar', $data);
      $this->load->view('sekretaris/input_data', $data);
      $this->load->view('sekretaris/template/footer', $data);
      // var_dump($this->form_validation->run());
      // die;
    } else {
      $data = array(
        'nama'              => $this->input->post('nama'),
        'nim'              => $this->input->post('nim'),
        'email'             => $this->input->post('email'),
        'email_kampus'             => $this->input->post('email_kampus'),
        'jeniskel'          => $this->input->post('jeniskel'),
        'sekolah'           => $this->input->post('sekolah'),
        'jurusan'           => $this->input->post('jurusan'),
        'kode_kategori'             => $this->input->post('divisi'),
        'telepon'             => $this->input->post('telepon'),
        'idrole'             => $this->input->post('idrole'),
        'foto'              => $this->input->post('foto'),
        'is_active'         => 1,
        'status'            => 1,
        'password'          => $length,
        'tingkat_pendidikan' => $this->input->post('pendidikan'),
        'tgl_daftar' => $this->input->post('tgl_daftar'),
        'sertifikat' => 'default.pdf',
        'tgl_terima' => $this->input->post('tgl_terima')
      );

      $this->db->insert('peserta_magang', $data);
      $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Anda telah terdaftar, silahkan menunggu konfirmasi!</div>');
      redirect($_SERVER['HTTP_REFERER']);
    }
  }



  public function terimakelompok($kode_kelompok)
  {
    $nama1 = $this->input->post('nama1');
    $nama2 = $this->input->post('nama2');
    $nama3 = $this->input->post('nama3');
    $sekolah = $this->input->post('sekolah');
    $jurusan = $this->input->post('jurusan');
    $email = $this->input->post('email_kampus');
    $nim1 = $this->input->post('nim1');
    $nim2 = $this->input->post('nim2');
    $nim3 = $this->input->post('nim3');
    $id = $this->session->userdata('userid');
    $kode_kategori = $this->input->post('kode_kategori');
    $data['sekretaris'] = $this->dashboard->getSekretarisById($id);
    $telp = $data['sekretaris']['telepon'];
    $sekretaris = $data['sekretaris']['nama'];
    $this->db->set('status', 2);
    $this->db->set('tgl_terima', $this->input->post('tgl_terima'));
    $this->db->where('kode_kelompok', $kode_kelompok);
    $this->db->update('peserta_kelompok');
    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Pelamar Telah Berhasil Diverifikasi!</div>');
    // $this->sendEmailKelompok($email, $nama1, $nama2, $nama3, $sekolah, $jurusan, $nim1, $nim2, $nim3, $telp, $sekretaris);
    redirect($_SERVER['HTTP_REFERER']);
  }

  public function sendEmailKelompok($email, $nama1, $nama2, $nama3, $sekolah, $jurusan, $nim1, $nim2, $nim3, $telp, $sekretaris)
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
      'smtp_pass' => 'suskrdjpsulfwoju',   //gmail password
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
                      <h1 style="margin: 0; text-align: center; font-size: 30px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">Pengumuman Penerimaan Peserta Magang</h1>
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
                    <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: ' . 'Source Sans Pro' . ', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 20px;">
                      <p style="margin: 0;">Telah diberitahukan penerimaan peserta magang di Pengadilan Tinggi Negeri Semarang, dengan data sebagai berikut :`</p>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" bgcolor="#ffffff" style="font-family: ' . 'Source Sans Pro' . ', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 5px;">
                      <p style="margin-left: 25px ;">Nama :' . $nama1 . '</p>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" bgcolor="#ffffff" style="font-family: ' . 'Source Sans Pro' . ', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 5px;">
                      <p style="margin-left: 25px ;">NIM / NISN : ' . $nim1 . '</p>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" bgcolor="#ffffff" style="font-family: ' . 'Source Sans Pro' . ', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 5px;">
                      <p style="margin-left: 25px ;">Asal Sekolah : ' . $sekolah . '</p>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" bgcolor="#ffffff" style="font-family: ' . 'Source Sans Pro' . ', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 5px;">
                      <p style="margin-left: 25px ;">Jurusan : ' . $jurusan . '</p>
                    </td>
                  </tr>
                  <!-- end copy -->
        
                  <!-- start button -->
                  <!-- end button -->
        
                  <!-- start copy -->
                  <tr>
                    <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: ' . 'Source Sans Pro' . ', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                      <p style="margin: 0;">Pihak sekolah diharapkan untuk memberitahukan informasi ini kepada pihak yang bersangkutan, untuk menghubungi pihak Pengadilan Tinggi Negeri Semarang secepatnya.</p>
                      <br>
                      <p style="margin: 0;">Silahkan hubungi nomer dibawah ini untuk informasi lebih lanjut.</p>
                      <p style="margin: 0;"><a href="https://wa.me/' . $telp . '" target="_blank">' . $telp . '</a>(' . $sekretaris . ')</p>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: ' . 'Source Sans Pro' . ', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                      
                    </td>
                  </tr>
                  <!-- end copy -->
        
                  <!-- start copy -->
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

  public function terimaberkas($kode_magang)
  {
    $this->db->set('status', 1);
    $this->db->where('kode_magang', $kode_magang);
    $this->db->update('peserta_magang');
    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Pelamar Telah Diterima Dan Telah Aktif Untuk Magang!</div>');
    redirect('sekretaris/berkas');
  }

  public function terimaberkaskelompok($kode_kelompok)
  {
    $this->db->set('status', 1);
    $this->db->where('kode_kelompok', $kode_kelompok);
    $this->db->update('peserta_kelompok');
    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Pelamar Telah Diterima Dan Telah Aktif Untuk Magang!</div>');
    redirect('sekretaris/berkas');
  }

  public function editMhs($id)
  {
    $data['session'] = $this->session->userdata('nama');
    $data['submenu'] = $this->dashboard->getMhsById($id);
    $data['id'] = $id;
    $this->db->set('kode_magang', $this->input->post('kode_magang'));
    $this->db->set('nama', $this->input->post('nama'));
    $this->db->set('jurusan', $this->input->post('jurusan'));
    $this->db->set('sekolah', $this->input->post('sekolah'));
    $this->db->set('jeniskel', $this->input->post('jeniskel'));
    $this->db->set('foto', $this->input->post('foto'));
    $this->db->set('surat_pengantar', $this->input->post('surat_pengantar'));
    $this->db->set('email', $this->input->post('email'));
    $this->db->set('password', $this->input->post('password'));
    $this->db->set('status', $this->input->post('status'));
    $this->db->set('role', $this->input->post('role'));
    $this->db->set('kode_kategori', $this->input->post('kode_kategori'));
    $this->db->set('tingkat_pendidikan', $this->input->post('tingkat_pendidikan'));
    $this->db->set('is_active', $this->input->post('is_active'));
    $this->db->where('kode_magang', $id);
    $this->db->update('peserta_magang');
    $this->session->set_flashdata('flash', '');
    redirect('dashboard/data_peserta');
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
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $idadm])->row_array();

    $this->load->view('sekretaris/template/header');
    $this->load->view('sekretaris/template/sidebar', $data);
    $this->load->view('sekretaris/template/topbar', $data);
    $this->load->view('sekretaris/mahasiswa', $data);
    $this->load->view('sekretaris/template/footer', $data);
  }

  public function datapelamar()
  {
    $kode_id = $this->uri->segment(3);
    $id = $this->session->userdata('userid');
    $data['pelamar'] = $this->peserta->getMhsById($kode_id);
    $data['role'] = $this->peserta->getRoleById($kode_id);
    $data['session'] = $this->session->userdata('nama');
    $data['title'] = 'Detail Data';
    $data['sekretaris'] = $this->dashboard->getSekretarisById($id);
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    $idadm = $this->session->userdata('userid');
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $idadm])->row_array();

    $this->load->view('sekretaris/template/header');
    $this->load->view('sekretaris/template/sidebar', $data);
    $this->load->view('sekretaris/template/topbar', $data);
    $this->load->view('sekretaris/verif_detail', $data);
    $this->load->view('sekretaris/template/footer', $data);
  }

  public function datapelamar_kelompok()
  {
    $kode_id = $this->uri->segment(3);
    $id = $this->session->userdata('userid');
    $data['pelamar'] = $this->peserta->getKelompokById($kode_id);
    $data['role'] = $this->peserta->getRoleById($kode_id);
    $data['session'] = $this->session->userdata('nama');
    $data['title'] = 'Detail Data';
    $data['sekretaris'] = $this->dashboard->getSekretarisById($id);
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    $idadm = $this->session->userdata('userid');
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $idadm])->row_array();

    $this->load->view('sekretaris/template/header');
    $this->load->view('sekretaris/template/sidebar', $data);
    $this->load->view('sekretaris/template/topbar', $data);
    $this->load->view('sekretaris/verif_detailkelompok', $data);
    $this->load->view('sekretaris/template/footer', $data);
  }

  public function deleteSubMenu($id)
  {
    $this->dashboard->deleteSubMenu($id);
    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Sub Menu Terhapus!</div>');
    redirect('dashboard/menu_management');
  }

  public function deleteMhs($id)
  {
    $this->dashboard->deleteMhs($id);
    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Mahasiswa Terhapus!</div>');
    redirect('sekretaris/data_peserta');
  }

  public function deleteSwa($id)
  {
    $this->dashboard->deleteMhs($id);
    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Siswa Terhapus!</div>');
    redirect('sekretaris/data_peserta');
  }

  public function deletepenyelia($id)
  {
    $this->dashboard->deletePenyelia($id);
    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Penyelia Terhapus!</div>');
    redirect('dashboard/data_penyelia');
  }

  public function deleteketua($id)
  {
    $this->dashboard->deleteKetua($id);
    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Ketua Terhapus!</div>');
    redirect('dashboard/data_ketua');
  }

  public function editMenu($id)
  {
    $data['session'] = $this->session->userdata('nama');
    $data['menu'] = $this->dashboard->getMenuById($id);
    $data['id'] = $id;
    $this->db->set('menu', $this->input->post('menu'));
    $this->db->where('menuid', $id);
    $this->db->update('menu');
    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Menu Berhasil Diubah!</div>');
    redirect('dashboard/menu_management');
  }

  public function editDivisi($id)
  {
    $data['session'] = $this->session->userdata('nama');

    $this->db->set('divisi', $this->input->post('divisi'));
    $this->db->set('kode_penyelia', $this->input->post('kode_penyelia'));
    $this->db->where('kode_kategori', $id);
    $this->db->update('kategori_magang');
    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Menu Berhasil Diubah!</div>');
    redirect('dashboard/divisi');
  }

  public function deletedivisi($id)
  {
    $this->dashboard->deleteDivisi($id);
    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Divisi Terhapus!</div>');
    redirect('dashboard/divisi');
  }

  public function delete_menu($id)
  {
    $this->dashboard->deleteMenu($id);
    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Menu Terhapus!</div>');
    redirect('dashboard/menu_management');
  }


  public function user_role()
  {
    $data['session'] = $this->session->userdata('nama');
    $this->form_validation->set_rules('role', 'Role', 'required');
    $data['title'] = 'User Role';
    $id = $this->session->userdata('userid');
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $id])->row_array();
    $data['role'] = $this->dashboard->getAllRole();
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    if ($this->form_validation->run() == false) {
      $this->load->view('sekretaris/template/header');
      $this->load->view('sekretaris/template/sidebar', $data);
      $this->load->view('sekretaris/template/topbar', $data);
      $this->load->view('sekretaris/user_role', $data);
      $this->load->view('sekretaris/template/footer');
    } else {
      $this->db->insert('user_role', ['role' => $this->input->post('role')]);
      $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">User Role Berhasil Di Edit</div>');
      redirect('dashboard/user_role');
    }
  }

  public function edit_role($id)
  {
    $data['role'] = $this->dashboard->getRoleById($id);
    $data['id'] = $id;
    $this->db->set('role', $this->input->post('role'));
    $this->db->where('idrole', $id);
    $this->db->update('user_role');
    redirect('dashboard/user_role');
  }

  public function edit_profil()
  {
    $data['session'] = $this->session->userdata('nama');
    $data['title'] = 'Edit Profil';
    $id = $this->session->userdata('userid');
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $id])->row_array();
    $data['sekretaris'] = $this->dashboard->getSekretarisById($id);
    $data['profil'] = $this->dashboard->getProfile();
    // $data['pesertaall'] = $this->home->getProfileAll();
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    $this->form_validation->set_rules('kode_sekretaris', 'kode_sekretaris', 'required');
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('jeniskel', 'jeniskel', 'required');
    $this->form_validation->set_rules('nip', 'nip', 'required');
    $this->form_validation->set_rules('telepon', 'telepon', 'required');
    if ($this->form_validation->run()) {
      $this->dashboard->update();
      $this->session->set_flashdata('success', 'Data Profil Berhasil Diperbarui');
      redirect('login/logout');
    } else {
      $this->session->set_flashdata('Error', 'Data Profil Gagal Diperbarui');
      $this->load->view('sekretaris/template/header', $data);
      $this->load->view('sekretaris/template/sidebar', $data);
      $this->load->view('sekretaris/template/topbar', $data);
      $this->load->view('sekretaris/edit_profile', $data);
      $this->load->view('sekretaris/template/footer', $data);
    }
  }

  public function delete_role($id)
  {
    $this->dashboard->deleteRole($id);
    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">User Role Berhasil Di Hapus</div>');
    redirect('dashboard/user_role');
  }

  public function akses_role($id)
  {
    $data['session'] = $this->session->userdata('nama');
    $data['title'] = 'Akses Role';
    $idadm = $this->session->userdata('userid');
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $idadm])->row_array();
    $data['role'] = $this->db->get_where('user_role', ['idrole' => $id])->row_array();
    $data['menu'] = $this->db->get('menu')->result_array();
    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Akses User Role Berhasil Di Edit</div>');
    $this->load->view('sekretaris/template/header');
    $this->load->view('sekretaris/template/sidebar', $data);
    $this->load->view('sekretaris/template/topbar', $data);
    $this->load->view('sekretaris/akses_role', $data);
    $this->load->view('sekretaris/template/footer');
  }

  public function verif()
  {
    $data['session'] = $this->session->userdata('nama');
    $data['title'] = 'Verifikasi Pelamar';
    $id = $this->session->userdata('userid');
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $id])->row_array();
    $data['sekretaris'] = $this->dashboard->getSekretarisById($id);
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    $data['peserta'] = $this->dashboard->getPeserta();
    $data['divisi'] = $this->dashboard->getAllDivisi();
    $data['loker'] = $this->dashboard->getAllLoker();
    $data['date'] = date('Y-m-d');

    $this->load->view('sekretaris/template/header', $data);
    $this->load->view('sekretaris/template/sidebar', $data);
    $this->load->view('sekretaris/template/topbar', $data);
    $this->load->view('sekretaris/verif', $data);
    $this->load->view('sekretaris/template/footer', $data);
  }

  public function verif_kelompok()
  {
    $data['session'] = $this->session->userdata('nama');
    $data['title'] = 'Verifikasi Pelamar Kelompok';
    $id = $this->session->userdata('userid');
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $id])->row_array();
    $data['sekretaris'] = $this->dashboard->getSekretarisById($id);
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    $data['kelompok'] = $this->dashboard->getKelompok();
    $data['divisi'] = $this->dashboard->getAllDivisi();
    $data['loker'] = $this->dashboard->getAllLoker();
    $data['date'] = date('Y-m-d');

    $this->load->view('sekretaris/template/header', $data);
    $this->load->view('sekretaris/template/sidebar', $data);
    $this->load->view('sekretaris/template/topbar', $data);
    $this->load->view('sekretaris/verif_kelompok', $data);
    $this->load->view('sekretaris/template/footer', $data);
  }

  public function berkas()
  {
    $data['session'] = $this->session->userdata('nama');
    $data['title'] = 'Verifikasi Berkas';
    $id = $this->session->userdata('userid');
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $id])->row_array();
    $data['sekretaris'] = $this->dashboard->getSekretarisById($id);
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    $data['peserta'] = $this->dashboard->getPesertaBerkas();
    $data['kelompok'] = $this->dashboard->getKelompokBerkas();
    $data['divisi'] = $this->dashboard->getAllDivisi();
    $data['loker'] = $this->dashboard->getAllLoker();
    $data['date'] = date('Y-m-d');

    $this->load->view('sekretaris/template/header', $data);
    $this->load->view('sekretaris/template/sidebar', $data);
    $this->load->view('sekretaris/template/topbar', $data);
    $this->load->view('sekretaris/berkas', $data);
    $this->load->view('sekretaris/template/footer', $data);
  }

  public function histori()
  {
    $data['session'] = $this->session->userdata('nama');
    $data['title'] = 'Histori Pelamar';
    $id = $this->session->userdata('userid');
    $data['sekretaris'] = $this->dashboard->getSekretarisById($id);
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $id])->row_array();
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    $data['terima'] = $this->dashboard->getPesertaVerif();
    $data['tolak'] = $this->dashboard->getPesertaTolak();
    $data['proses'] = $this->dashboard->getPesertaProses();
    $data['loker'] = $this->dashboard->getAllLoker();

    $this->load->view('sekretaris/template/header', $data);
    $this->load->view('sekretaris/template/sidebar', $data);
    $this->load->view('sekretaris/template/topbar', $data);
    $this->load->view('sekretaris/histori', $data);
    $this->load->view('sekretaris/template/footer', $data);
  }

  public function changeaccess()
  {
    $menu_id = $this->input->post('menuId');
    $role_id = $this->input->post('roleId');

    $data = [
      'roleid' => $role_id,
      'menuid' => $menu_id
    ];
    $result = $this->db->get_where('user_access_menu', $data);
    if ($result->num_rows() < 1) {
      $this->db->insert('user_access_menu', $data);
    } else {
      $this->db->delete('user_access_menu', $data);
    }
    $this->session->set_flashdata('flash', '');
  }

  public function changemhs()
  {
    $mhsid = $this->input->post('mhsId');
    $divid = $this->input->post('divId');

    $data = [
      'mhsid' => $mhsid,
      'divid' => $divid
    ];

    $this->db->update('peserta_magang', $data);
    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Magang Berhasil Di Tambah</div>');
  }

  public function submenu()
  {
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('menu_id', 'Menu', 'required');
    $this->form_validation->set_rules('url', 'URL', 'required');
    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Data Sub Menu Gagal Di Tambah</div>');
      redirect('dashboard/menu_management');
    } else {
      $data = [
        'menuid' => $this->input->post('menu_id'),
        'title' => $this->input->post('title'),
        'url' => $this->input->post('url'),
        'icon' => $this->input->post('icon'),
        'is_active' => $this->input->post('is_active')
      ];
      $this->db->insert('submenu', $data);
      $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Sub Menu Berhasil Di Tambah</div>');
      redirect('dashboard/menu_management');
    }
  }

  public function data_peserta()
  {
    $data['session'] = $this->session->userdata('nama');
    $data['title'] = 'Data Peserta Magang';
    $id = $this->session->userdata('userid');
    $kuliah = 'mahasiswa';
    $smk = 'siswa';
    $data['sekretaris'] = $this->dashboard->getSekretarisById($id);
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $id])->row_array();
    $data['mahasiswa'] = $this->dashboard->getMhsByKuliah($kuliah);
    $data['siswa'] = $this->dashboard->getSwaBySmk($smk);
    $data['kerja'] = $this->dashboard->getAllDivisi();
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    $this->load->view('sekretaris/template/header', $data);
    $this->load->view('sekretaris/template/sidebar', $data);
    $this->load->view('sekretaris/template/topbar', $data);
    $this->load->view('sekretaris/data_peserta', $data);
    $this->load->view('sekretaris/template/footer', $data);
  }

  public function kelompok()
  {
    $data['session'] = $this->session->userdata('nama');
    $data['title'] = 'Data Peserta Kelompok Magang';
    $id = $this->session->userdata('userid');
    $kuliah = 'mahasiswa';
    $smk = 'siswa';
    $data['sekretaris'] = $this->dashboard->getSekretarisById($id);
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $id])->row_array();
    $data['kelompok'] = $this->peserta->getKelompokById();
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    $this->load->view('sekretaris/template/header', $data);
    $this->load->view('sekretaris/template/sidebar', $data);
    $this->load->view('sekretaris/template/topbar', $data);
    $this->load->view('sekretaris/data_pesertakelompok', $data);
    $this->load->view('sekretaris/template/footer', $data);
  }

  public function cetak_laporan()
  {
    $from = $this->input->post('from');
    $to = $this->input->post('to');
    $id = $this->session->userdata('userid');
    $data['nama'] = $this->db->get_where('admin', ['kode_admin' => $id])->row_array();
    $data['from'] = $from;
    $data['to'] = $to;
    $data['datauser'] = $this->dashboard->getAllData($from, $to);
    $data['title'] = 'Laporan Data Peserta';
    // filename dari pdf ketika didownload
    $file_pdf = 'Laporan Data Peserta';
    // setting paper
    $paper = 'A4';
    //orientasi paper potrait / landscape
    $orientation = "potrait";
    $data['date_id'] = date('j / n / y');
    $data['date'] = date('d F Y');
    $html = $this->load->view('sekretaris/cetak_laporan', $data, true);
    // $this->load->view('atasan/cetak_laporan', $data);
    $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    // $this->load->view('invoice', $data);
  }

  public function cetak_laporankelompok()
  {
    $from = $this->input->post('from');
    $to = $this->input->post('to');
    $id = $this->session->userdata('userid');
    $data['nama'] = $this->db->get_where('admin', ['kode_admin' => $id])->row_array();
    $data['from'] = $from;
    $data['to'] = $to;
    $data['datauser'] = $this->dashboard->getAllDataKelompok($from, $to);
    $data['title'] = 'Laporan Data Peserta';
    // filename dari pdf ketika didownload
    $file_pdf = 'Laporan Data Peserta';
    // setting paper
    $paper = 'A4';
    //orientasi paper potrait / landscape
    $orientation = "potrait";
    $data['date_id'] = date('j / n / y');
    $data['date'] = date('d F Y');
    $html = $this->load->view('sekretaris/cetak_laporankelompok', $data, true);
    // $this->load->view('atasan/cetak_laporan', $data);
    $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    // $this->load->view('invoice', $data);
  }

  public function tambahjob()
  {
    $this->form_validation->set_rules('kode_kategori', 'kode_kategori', 'required');
    $this->form_validation->set_rules('desc', 'Desc', 'required');
    $this->form_validation->set_rules('start', 'Start', 'required');
    $this->form_validation->set_rules('end', 'End', 'required');
    $this->form_validation->set_rules('endregist', 'Endregist', 'required');
    $this->form_validation->set_rules('workingtype', 'Workingtype', 'required');
    $this->form_validation->set_rules('kuota', 'Kuota', 'required');

    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Kuota Magang Gagal Ditambahkan!</div>');
      redirect('dashboard/loker');
    } else {
      $data = [
        'kode_kategori' => $this->input->post('kode_kategori'),
        'jobdesc' => $this->input->post('desc'),
        'jobstart' => $this->input->post('start'),
        'jobend' => $this->input->post('end'),
        'registerend' => $this->input->post('endregist'),
        'status' => $this->input->post('status'),
        'workingtype' => $this->input->post('workingtype'),
        'kuota' => $this->input->post('kuota')
      ];
      $this->db->insert('job', $data);
      $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Kuota Magang Berhasil Ditambahkan!</div>');
      redirect('dashboard/loker');
    }
  }

  public function editjob($id)
  {
    $this->db->set('kode_kategori', $this->input->post('kode_kategori'));
    $this->db->set('jobdesc', $this->input->post('desc'));
    $this->db->set('jobstart', $this->input->post('start'));
    $this->db->set('jobend', $this->input->post('end'));
    $this->db->set('registerend', $this->input->post('endregist'));
    $this->db->set('workingtype', $this->input->post('workingtype'));
    $this->db->set('kuota', $this->input->post('kuota'));
    $this->db->set('status', $this->input->post('status'));
    $this->db->where('jobid', $id);
    $this->db->update('job');
    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Kuota Magang Berhasil Diedit!</div>');
    redirect('dashboard/loker');
  }

  public function editdatamhs($id)
  {
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    $data['mahasiswa'] = $this->dashboard->getMhsById($id);
    $data['id'] = $id;
    $data = [
      'kode_kategori' => $this->input->post('kode_kategori'),
      'is_active' => $this->input->post('is_active')
    ];
    $this->db->where('kode_magang', $id);
    $this->db->update('peserta_magang', $data);
    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Mahasiswa Berhasil Di Edit</div>');
    redirect('sekretaris/data_peserta');
  }

  public function editpenyelia($id)
  {
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    $data['penyelia'] = $this->dashboard->getPenyeliaById($id);
    $data['id'] = $id;
    $data = [
      'kode_kategori' => $this->input->post('kode_kategori'),
      'is_active' => $this->input->post('is_active')
    ];
    $this->db->where('kode_penyelia', $id);
    $this->db->update('penyelia', $data);
    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Penyelia Berhasil Di Edit</div>');
    redirect('dashboard/data_penyelia');
  }
  public function editketua($id)
  {
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    $data = [
      'kode_kategori' => $this->input->post('kode_kategori'),
      'is_active' => $this->input->post('is_active')
    ];
    $this->db->where('kode_ketua', $id);
    $this->db->update('ketua', $data);
    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Ketua Berhasil Di Edit</div>');
    redirect('dashboard/data_ketua');
  }

  public function editdataswa($id)
  {
    $data['mahasiswa'] = $this->dashboard->getMhsById($id);
    $data['id'] = $id;
    $data = [
      'jobid' => $this->input->post('jobid'),
      'is_active' => $this->input->post('is_active')
    ];
    $this->db->where('kode_magang', $id);
    $this->db->update('peserta_magang', $data);
    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Mahasiswa Berhasil Di Edit</div>');
    redirect('dashboard/data_peserta');
  }

  public function editjadwal($id)
  {
    $data['id'] = $id;
    $data = [
      'masuk' => $this->input->post('masuk'),
      'pulang' => $this->input->post('pulang')
    ];
    $this->db->where('id', $id);
    $this->db->update('waktu', $data);
    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Jadwal Berhasil Di Edit</div>');
    redirect($_SERVER['HTTP_REFERER']);
  }


  public function deleteloker($id)
  {
    $this->dashboard->deleteLoker($id);
    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Kuota Magang Terhapus!</div>');
    redirect('dashboard/loker');
  }

  public function data_penyelia()
  {
    $data['session'] = $this->session->userdata('nama');
    $id = $this->session->userdata('userid');
    $data['title'] = 'Data Penyelia';
    $data['sekretaris'] = $this->dashboard->getSekretarisById($id);
    $id = $this->session->userdata('userid');
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $id])->row_array();
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    $data['penyelia'] = $this->dashboard->getAllPenyelia();
    $data['kerja'] = $this->dashboard->getAllDivisi();
    $this->form_validation->set_rules('nama', 'nama', 'required');
    $this->form_validation->set_rules('nip', 'nip', 'required');
    $this->form_validation->set_rules('email', 'email', 'required');
    $this->form_validation->set_rules('password', 'password', 'required');
    $this->form_validation->set_rules('jeniskel', 'jeniskel', 'required');
    $this->form_validation->set_rules('telepon', 'telepon', 'required');
    $this->form_validation->set_rules('kode_kategori', 'kode_kategori', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('sekretaris/template/header');
      $this->load->view('sekretaris/template/sidebar', $data);
      $this->load->view('sekretaris/template/topbar', $data);
      $this->load->view('sekretaris/data_penyelia', $data);
      $this->load->view('sekretaris/template/footer', $data);
    } else {
      $data = [
        'nama' => $this->input->post('nama'),
        'nip' => $this->input->post('nip'),
        'email' => $this->input->post('email'),
        'password' => $this->input->post('password'),
        'jeniskel' => $this->input->post('jeniskel'),
        'telepon' => $this->input->post('telepon'),
        'kode_kategori' => $this->input->post('kode_kategori'),
        'is_active' => $this->input->post('is_active'),
        'status' => $this->input->post('status'),
        'idrole' => $this->input->post('role'),
        'foto' => $this->input->post('foto')
      ];
      $this->db->insert('penyelia', $data);
      $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Penyelia Berhasil Di Tambah</div>');
      redirect('dashboard/data_penyelia');
    }
  }

  public function data_ketua()
  {
    $data['session'] = $this->session->userdata('nama');
    $data['title'] = 'Data Ketua';
    $id = $this->session->userdata('userid');
    $data['sekretaris'] = $this->dashboard->getSekretarisById($id);
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $id])->row_array();
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    $data['ketua'] = $this->dashboard->getAllKetua();
    $data['kerja'] = $this->dashboard->getAllDivisi();
    // $this->form_validation->set_rules('nama', 'nama', 'required');
    // $this->form_validation->set_rules('nip', 'nip', 'required');
    // $this->form_validation->set_rules('email', 'email', 'required');
    // $this->form_validation->set_rules('password', 'password', 'required');
    // $this->form_validation->set_rules('jeniskel', 'jeniskel', 'required');
    // $this->form_validation->set_rules('telepon', 'telepon', 'required');
    // $this->form_validation->set_rules('kode_kategori', 'kode_kategori', 'required');

    // if ($this->form_validation->run() == false) {
    $this->load->view('sekretaris/template/header');
    $this->load->view('sekretaris/template/sidebar', $data);
    $this->load->view('sekretaris/template/topbar', $data);
    $this->load->view('sekretaris/data_ketua', $data);
    $this->load->view('sekretaris/template/footer', $data);
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

  public function detailpenyelia()
  {
    $kode_id = $this->uri->segment(3);
    $data['session'] = $this->session->userdata('nama');
    $data['title'] = 'Data Lengkap';
    $id = $this->session->userdata('userid');
    $data['sekretaris'] = $this->dashboard->getSekretarisById($id);
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $id])->row_array();
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    $data['detail'] = $this->dashboard->getPenyeliaById($kode_id);
    $data['role'] = $this->peserta->getRoleById($kode_id);
    $this->load->view('sekretaris/template/header', $data);
    $this->load->view('sekretaris/template/sidebar', $data);
    $this->load->view('sekretaris/template/topbar', $data);
    $this->load->view('sekretaris/detail_penyelia', $data);
    $this->load->view('sekretaris/template/footer', $data);
  }

  public function detailpeserta()
  {
    $kode_nilai = $this->uri->segment(3);
    $data['session'] = $this->session->userdata('nama');
    $data['title'] = 'Data Lengkap';
    $id = $this->session->userdata('userid');
    $data['sekretaris'] = $this->dashboard->getSekretarisById($id);
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $id])->row_array();
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    $data['detail'] = $this->dashboard->getPesertaById($kode_nilai);
    $data['role'] = $this->peserta->getRoleById($kode_nilai);
    $this->load->view('sekretaris/template/header', $data);
    $this->load->view('sekretaris/template/sidebar', $data);
    $this->load->view('sekretaris/template/topbar', $data);
    $this->load->view('sekretaris/detail_peserta', $data);
    $this->load->view('sekretaris/template/footer', $data);
  }

  public function detailketua()
  {
    $kode_id = $this->uri->segment(3);
    $data['session'] = $this->session->userdata('nama');
    $data['title'] = 'Data Lengkap';
    $id = $this->session->userdata('userid');
    $data['sekretaris'] = $this->dashboard->getSekretarisById($id);
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $id])->row_array();
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    $data['detail'] = $this->dashboard->getKetuaById($kode_id);
    $this->load->view('sekretaris/template/header', $data);
    $this->load->view('sekretaris/template/sidebar', $data);
    $this->load->view('sekretaris/template/topbar', $data);
    $this->load->view('sekretaris/detail_ketua', $data);
    $this->load->view('sekretaris/template/footer', $data);
  }

  public function monitoring()
  {
    $data['session'] = $this->session->userdata('nama');
    $data['title'] = 'Monitoring Absen';
    $id = $this->session->userdata('userid');
    $data['monitoring'] = $this->dashboard->getAllMonitor();
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $id])->row_array();
    $this->load->view('sekretaris/template/header', $data);
    $this->load->view('sekretaris/template/sidebar', $data);
    $this->load->view('sekretaris/template/topbar', $data);
    $this->load->view('sekretaris/monitoring', $data);
    $this->load->view('sekretaris/template/footer');
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
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $id])->row_array();
    $this->load->view('sekretaris/template/header', $data);
    $this->load->view('sekretaris/template/sidebar', $data);
    $this->load->view('sekretaris/template/topbar', $data);
    $this->load->view('sekretaris/detail_monitoring', $data);
    $this->load->view('sekretaris/template/footer');
  }

  public function detailnilai()
  {
    $kode_nilai = $this->uri->segment(3);
    $data['session'] = $this->session->userdata('nama');
    $data['title'] = 'Detail Nilai';
    $id = $this->session->userdata('userid');
    $data['detail'] = $this->dashboard->getMonitorById($kode_nilai);
    $data['nilai'] = $this->dashboard->getDivisiById($kode_nilai);
    $data['rownilai'] = $this->penyelia->getPesertaByRow($kode_nilai);
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $id])->row_array();
    $this->load->view('sekretaris/template/header', $data);
    $this->load->view('sekretaris/template/sidebar', $data);
    $this->load->view('sekretaris/template/topbar', $data);
    $this->load->view('sekretaris/detail_nilai', $data);
    $this->load->view('sekretaris/template/footer');
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
    $html = $this->load->view('sekretaris/invoice_nilai', $data, true);
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
    $html = $this->load->view('sekretaris/invoice_absen', $data, true);
    // $this->load->view('invoice', $data);
    $this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    // $this->load->view('invoice', $data);

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
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $id])->row_array();
    $this->load->view('sekretaris/template/header', $data);
    $this->load->view('sekretaris/template/sidebar', $data);
    $this->load->view('sekretaris/template/topbar', $data);
    $this->load->view('sekretaris/detail_absen', $data);
    $this->load->view('sekretaris/template/footer');
  }

  public function detail_nilai()
  {
    $kode_nilai = $this->uri->segment(3);
    $data['kode_magang'] = $kode_nilai;
    $data['session'] = $this->session->userdata('nama');
    $data['title'] = 'Detail Nilai';
    $id = $this->session->userdata('userid');
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $id])->row_array();
    $data['nilai'] = $this->penyelia->getNilaiById($kode_nilai);
    $data['peserta'] = $this->dashboard->getPesertaById($kode_nilai);
    $data['rownilai'] = $this->penyelia->getPesertaByRow($kode_nilai);
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    $this->form_validation->set_rules('tanggal_penilaian', 'tanggal_penilaian', 'required');
    $this->form_validation->set_rules('disiplin', 'disiplin', 'required');
    $this->form_validation->set_rules('tanggung', 'tanggung', 'required');
    $this->form_validation->set_rules('praktek', 'praktek', 'required');
    $this->form_validation->set_rules('rata', 'rata', 'required');
    $this->form_validation->set_rules('grade', 'grade', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('sekretaris/template/header');
      $this->load->view('sekretaris/template/sidebar', $data);
      $this->load->view('sekretaris/template/topbar', $data);
      $this->load->view('sekretaris/detail_penilaian', $data);
      $this->load->view('sekretaris/template/footer', $data);
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

  public function penilaian()
  {
    $data['session'] = $this->session->userdata('nama');
    $data['title'] = 'Penilaian Magang';
    $id = $this->session->userdata('userid');
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $id])->row_array();
    $data['monitoring'] = $this->dashboard->getAllMonitor();
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    $this->load->view('sekretaris/template/header', $data);
    $this->load->view('sekretaris/template/sidebar', $data);
    $this->load->view('sekretaris/template/topbar', $data);
    $this->load->view('sekretaris/penilaian', $data);
    $this->load->view('sekretaris/template/footer');
  }

  public function jadwal_absen()
  {
    $data['session'] = $this->session->userdata('nama');
    $data['title'] = 'Jadwal Absen';
    $id = $this->session->userdata('userid');
    $data['nama'] = $this->db->get_where('sekretaris', ['kode_sekretaris' => $id])->row_array();
    $data['jadwal'] = $this->dashboard->getAllJadwal();
    $data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
    $this->load->view('sekretaris/template/header', $data);
    $this->load->view('sekretaris/template/sidebar', $data);
    $this->load->view('sekretaris/template/topbar', $data);
    $this->load->view('sekretaris/jadwal', $data);
    $this->load->view('sekretaris/template/footer');
  }
}
