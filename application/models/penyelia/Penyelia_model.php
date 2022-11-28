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
        $query = "SELECT p. * from peserta_magang p  where p.kode_kategori = '$kategori'";
        return $this->db->query($query)->num_rows();
    }

    public function countAllSwaById($kategori)
    {
        $query = "SELECT `peserta_magang`.*
        FROM peserta_magang WHERE tingkat_pendidikan = 'siswa' and kode_kategori = '$kategori'";
        return $this->db->query($query)->num_rows();
    }

    public function countAllMhsById($kategori)
    {
        $query = "SELECT `peserta_magang`.*
        FROM peserta_magang WHERE tingkat_pendidikan = 'mahasiswa' and kode_kategori = '$kategori' ";
        return $this->db->query($query)->num_rows();
    }

    public function getAllPesertaByid($kategori)
    {
        $query = "SELECT p. *, j.divisi from peserta_magang p, kategori_magang j where  p.kode_kategori=j.kode_kategori and P.kode_kategori = '$kategori' and p.konfirmasi='0'";
        return $this->db->query($query)->result_array();
    }

    public function getAllUnverifById($kategori)
    {
        $query = "SELECT p. *, j.divisi from peserta_magang p, kategori_magang j where  p.kode_kategori=j.kode_kategori and p.konfirmasi = '0' and P.kode_kategori = '$kategori'";
        return $this->db->query($query)->result_array();
    }

    public function countAllUnverifById($kategori)
    {
        $query = "SELECT `peserta_magang`.*
        FROM peserta_magang WHERE kode_kategori = '$kategori' and konfirmasi = '0' ";
        return $this->db->query($query)->num_rows();
    }

    public function getMhsByKuliah($kategori)
    {
        $query = "SELECT p. * ,k.divisi from peserta_magang p, kategori_magang k where  p.kode_kategori=k.kode_kategori  and p.kode_kategori = '$kategori' and p.tingkat_pendidikan='mahasiswa' and p.status='1' and p.konfirmasi='1' ";
        return $this->db->query($query)->result_array();
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
}
