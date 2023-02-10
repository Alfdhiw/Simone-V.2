<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper(array('url', 'form'));
		$this->load->model('auth/Auth_model', 'auth');
		$this->load->model('admin/Dashboard_model', 'dashboard');
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
		$data['nama'] = $this->db->get_where('admin', ['kode_admin' => $id])->row_array();
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
		$data['prosesuser'] = $this->dashboard->getAllUnproses();
		$data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
		$this->load->view('admin/template/header');
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/template/topbar', $data);
		$this->load->view('admin/admin', $data);
		$this->load->view('admin/template/footer', $data);
	}

	public function divisi()
	{
		$data['session'] = $this->session->userdata('nama');
		$data['title'] = 'Divisi Magang';
		$id = $this->session->userdata('userid');
		$data['nama'] = $this->db->get_where('admin', ['kode_admin' => $id])->row_array();
		$data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
		$data['divisi'] = $this->dashboard->getAllMonitor();
		$data['penyelia'] = $this->dashboard->getAllPenyelia();
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/template/topbar', $data);
		$this->load->view('admin/divisi', $data);
		$this->load->view('admin/template/footer', $data);
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
				'kode_penyelia' => 1,
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
		$data['nama'] = $this->db->get_where('admin', ['kode_admin' => $id])->row_array();
		$data['menu'] = $this->dashboard->getAllMenu();
		$data['submenu'] = $this->dashboard->getSubMenu();
		$this->form_validation->set_rules('menu', 'Menu', 'required');
		$data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
		if ($this->form_validation->run() == false) {
			$this->load->view('admin/template/header');
			$this->load->view('admin/template/sidebar', $data);
			$this->load->view('admin/template/topbar', $data);
			$this->load->view('admin/menu_management', $data);
			$this->load->view('admin/template/footer', $data);
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
		$data['nama'] = $this->db->get_where('admin', ['kode_admin' => $id])->row_array();
		$data['kerja'] = $this->dashboard->getAllDivisi();
		$data['loker'] = $this->dashboard->getAllLoker();
		$data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
		$this->load->view('admin/template/header');
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/template/topbar', $data);
		$this->load->view('admin/loker', $data);
		$this->load->view('admin/template/footer', $data);
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

	public function abort($kode_magang)
	{
		$this->db->set('status', $this->input->post('status'));
		$this->db->set('tgl_terima', $this->input->post('tgl_terima'));
		$this->db->where('kode_magang', $kode_magang);
		$this->db->update('peserta_magang');
		$this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Pelamar Telah Ditolak!</div>');
		redirect('dashboard/verif');
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
		$data['nama'] = $this->db->get_where('admin', ['kode_admin' => $idadm])->row_array();

		$this->load->view('admin/template/header');
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/template/topbar', $data);
		$this->load->view('admin/mahasiswa', $data);
		$this->load->view('admin/template/footer', $data);
	}

	public function datapelamar()
	{
		$kode_id = $this->uri->segment(3);
		$data['pelamar'] = $this->peserta->getMhsById($kode_id);
		$data['role'] = $this->peserta->getRoleById($kode_id);
		$data['session'] = $this->session->userdata('nama');
		$data['title'] = 'Detail Data';
		$data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
		$idadm = $this->session->userdata('userid');
		$data['nama'] = $this->db->get_where('admin', ['kode_admin' => $idadm])->row_array();

		$this->load->view('admin/template/header');
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/template/topbar', $data);
		$this->load->view('admin/verif_detail', $data);
		$this->load->view('admin/template/footer', $data);
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
		redirect('dashboard/data_peserta');
	}

	public function deleteSwa($id)
	{
		$this->dashboard->deleteMhs($id);
		$this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Siswa Terhapus!</div>');
		redirect('dashboard/data_peserta');
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
		$data['nama'] = $this->db->get_where('admin', ['kode_admin' => $id])->row_array();
		$data['role'] = $this->dashboard->getAllRole();
		$data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
		if ($this->form_validation->run() == false) {
			$this->load->view('admin/template/header');
			$this->load->view('admin/template/sidebar', $data);
			$this->load->view('admin/template/topbar', $data);
			$this->load->view('admin/user_role', $data);
			$this->load->view('admin/template/footer');
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
		$data['nama'] = $this->db->get_where('admin', ['kode_admin' => $idadm])->row_array();
		$data['role'] = $this->db->get_where('user_role', ['idrole' => $id])->row_array();
		$data['menu'] = $this->db->get('menu')->result_array();
		$this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Akses User Role Berhasil Di Edit</div>');
		$this->load->view('admin/template/header');
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/template/topbar', $data);
		$this->load->view('admin/akses_role', $data);
		$this->load->view('admin/template/footer');
	}

	public function verif()
	{
		$data['session'] = $this->session->userdata('nama');
		$data['title'] = 'Verifikasi Pelamar';
		$id = $this->session->userdata('userid');
		$data['nama'] = $this->db->get_where('admin', ['kode_admin' => $id])->row_array();
		$data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
		$data['peserta'] = $this->dashboard->getPeserta();
		$data['loker'] = $this->dashboard->getAllLoker();

		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/template/topbar', $data);
		$this->load->view('admin/verif', $data);
		$this->load->view('admin/template/footer', $data);
	}

	public function histori()
	{
		$data['session'] = $this->session->userdata('nama');
		$data['title'] = 'Histori Pelamar';
		$id = $this->session->userdata('userid');
		$data['nama'] = $this->db->get_where('admin', ['kode_admin' => $id])->row_array();
		$data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
		$data['terima'] = $this->dashboard->getPesertaVerif();
		$data['tolak'] = $this->dashboard->getPesertaTolak();
		$data['proses'] = $this->dashboard->getPesertaProses();
		$data['loker'] = $this->dashboard->getAllLoker();

		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/template/topbar', $data);
		$this->load->view('admin/histori', $data);
		$this->load->view('admin/template/footer', $data);
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
		$data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
		$data['nama'] = $this->db->get_where('admin', ['kode_admin' => $id])->row_array();
		$data['mahasiswa'] = $this->dashboard->getMhsByKuliah($kuliah);
		$data['siswa'] = $this->dashboard->getSwaBySmk($smk);
		$data['kerja'] = $this->dashboard->getAllDivisi();
		$data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/template/topbar', $data);
		$this->load->view('admin/data_peserta', $data);
		$this->load->view('admin/template/footer', $data);
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
		$html = $this->load->view('admin/cetak_laporan', $data, true);
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
		$this->db->set('kuota', $this->input->post('kuota'));
		$this->db->where('kode_kategori', $id);
		$this->db->update('kategori_magang');
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
		redirect('dashboard/data_peserta');
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
		$data['title'] = 'Data Penyelia';
		$id = $this->session->userdata('userid');
		$data['nama'] = $this->db->get_where('admin', ['kode_admin' => $id])->row_array();
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
			$this->load->view('admin/template/header');
			$this->load->view('admin/template/sidebar', $data);
			$this->load->view('admin/template/topbar', $data);
			$this->load->view('admin/data_penyelia', $data);
			$this->load->view('admin/template/footer', $data);
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
		$data['nama'] = $this->db->get_where('admin', ['kode_admin' => $id])->row_array();
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
		$this->load->view('admin/template/header');
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/template/topbar', $data);
		$this->load->view('admin/data_ketua', $data);
		$this->load->view('admin/template/footer', $data);
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
		$data['nama'] = $this->db->get_where('admin', ['kode_admin' => $id])->row_array();
		$data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
		$data['detail'] = $this->dashboard->getPenyeliaById($kode_id);
		$data['role'] = $this->peserta->getRoleById($kode_id);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/template/topbar', $data);
		$this->load->view('admin/detail_penyelia', $data);
		$this->load->view('admin/template/footer', $data);
	}

	public function detailketua()
	{
		$kode_id = $this->uri->segment(3);
		$data['session'] = $this->session->userdata('nama');
		$data['title'] = 'Data Lengkap';
		$id = $this->session->userdata('userid');
		$data['nama'] = $this->db->get_where('admin', ['kode_admin' => $id])->row_array();
		$data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
		$data['detail'] = $this->dashboard->getKetuaById($kode_id);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/template/topbar', $data);
		$this->load->view('admin/detail_ketua', $data);
		$this->load->view('admin/template/footer', $data);
	}

	public function monitoring()
	{
		$data['session'] = $this->session->userdata('nama');
		$data['title'] = 'Monitoring Absen';
		$id = $this->session->userdata('userid');
		$data['monitoring'] = $this->dashboard->getAllMonitor();
		$data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
		$data['nama'] = $this->db->get_where('admin', ['kode_admin' => $id])->row_array();
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/template/topbar', $data);
		$this->load->view('admin/monitoring', $data);
		$this->load->view('admin/template/footer');
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
		$data['nama'] = $this->db->get_where('admin', ['kode_admin' => $id])->row_array();
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/template/topbar', $data);
		$this->load->view('admin/detail_monitoring', $data);
		$this->load->view('admin/template/footer');
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
		$data['nama'] = $this->db->get_where('admin', ['kode_admin' => $id])->row_array();
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/template/topbar', $data);
		$this->load->view('admin/detail_nilai', $data);
		$this->load->view('admin/template/footer');
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
		$data['nama'] = $this->db->get_where('admin', ['kode_admin' => $id])->row_array();
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/template/topbar', $data);
		$this->load->view('admin/detail_absen', $data);
		$this->load->view('admin/template/footer');
	}

	public function detail_nilai()
	{
		$kode_nilai = $this->uri->segment(3);
		$data['kode_magang'] = $kode_nilai;
		$data['session'] = $this->session->userdata('nama');
		$data['title'] = 'Detail Nilai';
		$id = $this->session->userdata('userid');
		$data['nama'] = $this->db->get_where('admin', ['kode_admin' => $id])->row_array();
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
			$this->load->view('admin/template/header');
			$this->load->view('admin/template/sidebar', $data);
			$this->load->view('admin/template/topbar', $data);
			$this->load->view('admin/detail_penilaian', $data);
			$this->load->view('admin/template/footer', $data);
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
		$data['nama'] = $this->db->get_where('admin', ['kode_admin' => $id])->row_array();
		$data['monitoring'] = $this->dashboard->getAllMonitor();
		$data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/template/topbar', $data);
		$this->load->view('admin/penilaian', $data);
		$this->load->view('admin/template/footer');
	}

	public function jadwal_absen()
	{
		$data['session'] = $this->session->userdata('nama');
		$data['title'] = 'Jadwal Absen';
		$id = $this->session->userdata('userid');
		$data['nama'] = $this->db->get_where('admin', ['kode_admin' => $id])->row_array();
		$data['jadwal'] = $this->dashboard->getAllJadwal();
		$data['con'] = mysqli_connect('localhost', 'root', '', $this->db->database);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/template/topbar', $data);
		$this->load->view('admin/jadwal', $data);
		$this->load->view('admin/template/footer');
	}
}
