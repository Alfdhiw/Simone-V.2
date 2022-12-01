<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{
    public function getAllJob()
    {
        date_default_timezone_set("Asia/Bangkok");
        $date_now = date("Y-m-d");
        $query = "SELECT j. * ,k.divisi from job j, kategori_magang k where  j.kode_kategori=k.kode_kategori and j.registerend > '" . $date_now . "'";
        return $this->db->query($query)->result_array();
    }

    public function getPesertaById($kode_magang)
    {
        $query = "SELECT p. * ,k.divisi from peserta_magang p, kategori_magang k where  p.kode_kategori=k.kode_kategori and p.kode_magang = '" . $kode_magang . "'";
        return $this->db->query($query)->row_array();
    }

    public function getAllAbsenById($kode_magang)
    {
        $query = "SELECT a. * from absensi a where  a.kode_magang = '" . $kode_magang . "'";
        return $this->db->query($query)->result_array();
    }

    public function getAllNilaiById($kode_magang)
    {
        $query = "SELECT a. * from penilaian_detail a where  a.kode_magang = '" . $kode_magang . "'";
        return $this->db->query($query)->result_array();
    }

    public function getProfile($id = 0)
    {

        if ($id < 1) {
            $id = $this->session->userdata('userid');
        }

        return $this->db->get_where('peserta_magang', ["kode_magang" => $id])->row_array();
    }

    public function getProfileAll($id = 0)
    {

        if ($id < 1) {
            $id = $this->session->userdata('userid');
        }

        return $this->db->get_where('peserta_magang', ["kode_magang" => $id])->result_array();
    }

    public function update()
    {

        $post = $this->input->post();


        $this->kode_magang = $post["kode_magang"];

        $this->nama = $post["nama"];

        $this->sekolah = $post["sekolah"];

        $this->jurusan = $post["jurusan"];

        $this->jeniskel = $post["jeniskel"];

        $this->telepon = $post["telepon"];

        $this->email = $post["email"];

        $this->password = $post['password'];

        if (!empty($_FILES["foto"]["name"])) {

            $this->foto = $this->_uploadImage();
        } else {

            $this->foto = $post["gambar_lama"];
        }

        return $this->db->update('peserta_magang', $this, array('kode_magang' => $post['kode_magang']));
    }

    private function _uploadImage()
    {
        $date = substr(date('Ymd'), 2, 8);

        $post = $this->input->post();

        $config['upload_path']          = './assets/data/peserta/pas_foto/';

        $config['allowed_types']        = 'gif|jpg|png';

        $config['file_name']            = $date . '-' . $_FILES['foto']['name'];

        $config['overwrite']            = true;

        $config['max_size']             = 5000; // 1MB

        // $config['max_width']            = 1024;

        // $config['max_height']           = 768;



        $this->load->library('upload', $config);



        if ($this->upload->do_upload('foto')) {

            return $this->upload->data("file_name");
        }

        return base_url('assets/data/peserta/pas_foto/') . $post["gambar_lama"];
    }

    public function getJobById($loker_id)
    {
        $query = "SELECT j. * ,k.divisi from job j, kategori_magang k where  j.kode_kategori=k.kode_kategori and j.jobid = '" . $loker_id . "'";
        return $this->db->query($query)->row_array();
    }
    public function getPasswd()
    {

        $string = "abcdefghijklmnopqrstufwxyz0123456789";
        $passwd = substr(str_shuffle($string), 0, 8);
        return $passwd;
    }

    public function adddaftar($data)
    {
        return $this->db->insert('peserta_magang', $data);
    }

    public function addabsen($data)
    {
        return $this->db->insert('absensi', $data);
    }

    public function countAllAbsen($kode_magang)
    {
        $totalabsen = $this->db->get_where('absensi', ['kode_magang' => $kode_magang])->num_rows();
        return $totalabsen;
    }
    public function countAllNilai($kode_magang)
    {
        $totalnilai = $this->db->get_where('penilaian_detail', ['kode_magang' => $kode_magang])->num_rows();
        return $totalnilai;
    }
    public function countAllMasuk($kode_magang)
    {
        $query = "SELECT `absensi`.*
        FROM absensi WHERE kode_magang = '$kode_magang' and status = '1' ";
        return $this->db->query($query)->num_rows();
    }
    public function countAllIjin($kode_magang)
    {
        $query = "SELECT `absensi`.*
        FROM absensi WHERE kode_magang = '$kode_magang' and status = '2' ";
        return $this->db->query($query)->num_rows();
    }
    public function countAllLibur($kode_magang)
    {
        $query = "SELECT `absensi`.*
        FROM absensi WHERE kode_magang = '$kode_magang' and status = '0' ";
        return $this->db->query($query)->num_rows();
    }
}
