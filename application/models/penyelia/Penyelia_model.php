<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Penyelia_model extends CI_Model
{
    public function getPenyeliaById($id)
    {
        $query = "SELECT p. * ,k.divisi from penyelia p, kategori_magang k  where  p.kode_kategori=k.kode_kategori and p.kode_penyelia = '$id'";
        return $this->db->query($query)->row_array();
    }

    public function countAllPenggunaById($kategori)
    {
        $query = "SELECT p. * from peserta_magang p  where p.kode_kategori = '$kategori' and p.status='1'";
        return $this->db->query($query)->num_rows();
    }

    public function countAllSwaById($kategori)
    {
        $query = "SELECT `peserta_magang`.*
        FROM peserta_magang WHERE tingkat_pendidikan = 'siswa' and kode_kategori = '$kategori' and status='1'";
        return $this->db->query($query)->num_rows();
    }

    public function countAllMhsById($kategori)
    {
        $query = "SELECT `peserta_magang`.*
        FROM peserta_magang WHERE tingkat_pendidikan = 'mahasiswa' and kode_kategori = '$kategori' and status='1' ";
        return $this->db->query($query)->num_rows();
    }

    public function getAllPesertaByid($kategori)
    {
        $query = "SELECT p. *, j.divisi from peserta_magang p, kategori_magang j where  p.kode_kategori=j.kode_kategori and P.kode_kategori = '$kategori' and p.konfirmasi='0'and p.status='1'";
        return $this->db->query($query)->result_array();
    }

    public function getMhsByAbsenMhs($kategori)
    {
        $query = "SELECT p.kode_magang, p.nama, p.foto, k.divisi, a.tgl_absen, a.status, a.absen_id FROM peserta_magang p, kategori_magang k, absensi a WHERE p.kode_kategori = k.kode_kategori and p.kode_magang = a.kode_magang and a.status ='4' and p.kode_kategori = $kategori and p.tingkat_pendidikan = 'mahasiswa' ORDER BY a.absen_id DESC";
        return $this->db->query($query)->result_array();
    }

    public function getMhsByAbsenSwa($kategori)
    {
        $query = "SELECT p.kode_magang, p.nama, p.foto, k.divisi, a.tgl_absen, a.status, a.absen_id FROM peserta_magang p, kategori_magang k, absensi a WHERE p.kode_kategori = k.kode_kategori and p.kode_magang = a.kode_magang and a.status ='4' and p.kode_kategori = $kategori and p.tingkat_pendidikan = 'siswa' ORDER BY a.absen_id DESC";
        return $this->db->query($query)->result_array();
    }

    public function getPesertaByid($kode_nilai)
    {
        $query = "SELECT p. *, j.divisi, a.nama as nama_penyelia from peserta_magang p, kategori_magang j, penyelia a where  p.kode_kategori=j.kode_kategori and a.kode_kategori=j.kode_kategori and p.kode_magang = '$kode_nilai'";
        return $this->db->query($query)->row_array();
    }

    public function getTotalDisiplin($kode_nilai)
    {
        $query = "SELECT AVG(nilai_disiplin) as total_disiplin from penilaian_detail where  kode_magang = '$kode_nilai'";
        return $this->db->query($query)->row_array();
    }

    public function getTotalPraktek($kode_nilai)
    {
        $query = "SELECT AVG(nilai_praktek) as total_praktek from penilaian_detail where  kode_magang = '$kode_nilai'";
        return $this->db->query($query)->row_array();
    }

    public function getTotalRata($kode_nilai)
    {
        $query = "SELECT AVG(nilai_rata) as total_rata from penilaian_detail where  kode_magang = '$kode_nilai'";
        return $this->db->query($query)->row_array();
    }

    public function getTotalTanggung($kode_nilai)
    {
        $query = "SELECT AVG(nilai_tanggungjawab) as total_tanggungjawab from penilaian_detail where  kode_magang = '$kode_nilai'";
        return $this->db->query($query)->row_array();
    }

    public function getAllUnverifById($kategori)
    {
        $query = "SELECT p. *, j.divisi from peserta_magang p, kategori_magang j where  p.kode_kategori=j.kode_kategori and p.konfirmasi = '0' and P.kode_kategori = '$kategori' and p.status ='1' and p.is_active='1'";
        return $this->db->query($query)->result_array();
    }

    public function countAllUnverifById($kategori)
    {
        $query = "SELECT `peserta_magang`.*
        FROM peserta_magang WHERE kode_kategori = '$kategori' and konfirmasi = '0' ";
        return $this->db->query($query)->num_rows();
    }

    public function countAllUnverifAbsenById($kategori)
    {
        $query = "SELECT p.kode_magang, p.nama, p.foto, k.divisi, a.tgl_absen, a.status, a.absen_id FROM peserta_magang p, kategori_magang k, absensi a WHERE p.kode_kategori = k.kode_kategori and p.kode_magang = a.kode_magang and a.status ='4' and p.kode_kategori = $kategori ORDER BY a.absen_id DESC";
        return $this->db->query($query)->num_rows();
    }

    public function getAllUnverifAbsenById($kategori)
    {
        $query = "SELECT p.kode_magang, p.nama, p.foto, k.divisi, a.tgl_absen, a.status, a.absen_id FROM peserta_magang p, kategori_magang k, absensi a WHERE p.kode_kategori = k.kode_kategori and p.kode_magang = a.kode_magang and a.status ='4' and p.kode_kategori = $kategori ORDER BY a.absen_id DESC";
        return $this->db->query($query)->result_array();
    }

    public function getMhsByKuliah($kategori)
    {
        $query = "SELECT p. * ,k.divisi from peserta_magang p, kategori_magang k where  p.kode_kategori=k.kode_kategori  and p.kode_kategori = '$kategori' and p.tingkat_pendidikan='mahasiswa' and p.status='1' and p.konfirmasi='1' ";
        return $this->db->query($query)->result_array();
    }

    public function getSertifByKuliah($kategori)
    {
        $query = "SELECT p. * ,k.divisi from peserta_magang p, kategori_magang k where  p.kode_kategori=k.kode_kategori  and p.kode_kategori = '$kategori' and p.tingkat_pendidikan='mahasiswa' and p.status='1' and p.konfirmasi='1' ";
        return $this->db->query($query)->row_array();
    }

    public function getSwaBySmk($kategori)
    {
        $query = "SELECT p. * ,k.divisi from peserta_magang p, kategori_magang k where  p.kode_kategori=k.kode_kategori  and p.kode_kategori = '$kategori' and p.tingkat_pendidikan='siswa' and p.status='1' and p.konfirmasi='1' ";
        return $this->db->query($query)->result_array();
    }

    public function getMhsById($id)
    {
        $query = "SELECT p. * ,k.divisi from peserta_magang p, kategori_magang k where  p.kode_kategori=k.kode_kategori  and p.kode_magang='" . $id . "'; ";
        return $this->db->query($query)->row_array();
    }

    public function getNilaiById($kode_nilai)
    {
        return $this->db->get_where('penilaian_detail', ['kode_magang' => $kode_nilai])->result_array();
    }
    public function getPesertaByRow($kode_nilai)
    {
        return $this->db->get_where('peserta_magang', ['kode_magang' => $kode_nilai])->row_array();
    }

    public function getProfile($id = 0)
    {

        if ($id < 1) {
            $id = $this->session->userdata('userid');
        }

        return $this->db->get_where('penyelia', ["kode_penyelia" => $id])->row_array();
    }

    public function update()
    {

        $post = $this->input->post();


        $this->kode_penyelia = $post["kode_penyelia"];

        $this->nama = $post["nama"];

        $this->nip = $post["nip"];

        $this->jeniskel = $post["jeniskel"];

        $this->telepon = $post["telepon"];

        $this->email = $post["email"];

        $this->password = $post['password'];

        if (!empty($_FILES["foto"]["name"])) {

            $this->foto = $this->_uploadImage();
        } else {

            $this->foto = $post["gambar_lama"];
        }

        return $this->db->update('penyelia', $this, array('kode_penyelia' => $post['kode_penyelia']));
    }

    private function _uploadImage()
    {
        $date = substr(date('Ymd'), 2, 8);

        $post = $this->input->post();

        $config['upload_path']          = './assets/data/penyelia/pas_foto/';

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

        return base_url('assets/data/penyelia/pas_foto/') . $post["gambar_lama"];
    }

    public function getTahunTransaksi()
    {
        $query = "SELECT DISTINCT year(`penilaian_detail`.tanggal_penilaian) as tahun from `penilaian_detail`";
        return $this->db->query($query)->result_array();
    }
}
