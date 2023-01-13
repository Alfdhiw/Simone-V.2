<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function getAllRole()
    {
        return $this->db->get('user_role')->result_array();
    }

    public function getAllJadwal()
    {
        return $this->db->get('waktu')->result_array();
    }

    public function getAllPeserta()
    {
        $query = "SELECT p. * ,j.kode_kategori, j.divisi from peserta_magang p, kategori_magang j where  p.kode_kategori=j.kode_kategori";
        return $this->db->query($query)->result_array();
    }

    public function getAllKetua()
    {
        $query = "SELECT k. * ,j.kode_kategori, j.divisi from ketua k, kategori_magang j where  k.kode_kategori=j.kode_kategori";
        return $this->db->query($query)->result_array();
    }

    public function getAllUnverif()
    {
        $query = "SELECT p. * ,j.kode_kategori, j.divisi from peserta_magang p, kategori_magang j where  p.kode_kategori=j.kode_kategori and p.status = '0'";
        return $this->db->query($query)->result_array();
    }

    public function getPeserta()
    {
        $query = "SELECT p. * ,k.divisi from peserta_magang p, kategori_magang k where  p.kode_kategori=k.kode_kategori and p.status = '0'";
        return $this->db->query($query)->result_array();
    }

    public function getPesertaById($kode_nilai)
    {
        $query = "SELECT p. * ,k.divisi from peserta_magang p, kategori_magang k where  p.kode_kategori=k.kode_kategori and p.kode_kategori='$kode_nilai'";
        return $this->db->query($query)->row_array();
    }

    public function getPesertaVerif()
    {
        $query = "SELECT p. * ,k.kode_kategori,k.divisi from peserta_magang p, kategori_magang k  where  p.kode_kategori=k.kode_kategori and p.status = '1'";
        return $this->db->query($query)->result_array();
    }

    public function getPesertaTolak()
    {
        $query = "SELECT p. * ,k.kode_kategori,k.divisi from peserta_magang p, kategori_magang k  where  p.kode_kategori=k.kode_kategori and p.status = '2'";
        return $this->db->query($query)->result_array();
    }

    public function getRoleById($id)
    {
        return $this->db->get_where('user_role', ['idrole' => $id])->row_array();
    }

    public function countAllPengguna()
    {
        $peserta = $this->db->get('peserta_magang')->num_rows();
        return $peserta;
    }

    public function countAllUnverif()
    {
        $peserta = $this->db->get_where('peserta_magang', ['status' => 0])->num_rows();
        return $peserta;
    }

    public function countAllMagang()
    {
        $job = $this->db->get('job')->num_rows();
        return $job;
    }

    public function countAllPenyelia()
    {
        $penyelia = $this->db->get('penyelia')->num_rows();
        return $penyelia;
    }

    public function countAllSwa($swa)
    {
        $query = "SELECT `peserta_magang`.*
        FROM peserta_magang WHERE tingkat_pendidikan = '$swa' ";
        return $this->db->query($query)->num_rows();
    }

    public function countAllLaki($laki)
    {
        $query = "SELECT `penyelia`.*
        FROM penyelia WHERE jeniskel = '$laki' ";
        return $this->db->query($query)->num_rows();
    }

    public function countAllCewe($cewe)
    {
        $query = "SELECT `penyelia`.*
        FROM penyelia WHERE jeniskel = '$cewe' ";
        return $this->db->query($query)->num_rows();
    }

    public function countAllMhs($mhs)
    {
        $query = "SELECT `peserta_magang`.*
        FROM peserta_magang WHERE tingkat_pendidikan = '$mhs' ";
        return $this->db->query($query)->num_rows();
    }


    public function deleteRole($id)
    {
        $this->db->delete('user_role', ['idrole' => $id]);
    }

    public function getAllMenu()
    {
        return $this->db->get('menu')->result_array();
    }

    public function getAllDivisi()
    {
        return $this->db->get('kategori_magang')->result_array();
    }

    public function getAllLoker()
    {
        $query = "SELECT j. * ,p.kode_kategori,p.divisi from kategori_magang p, job j where  p.kode_kategori=j.kode_kategori";
        return $this->db->query($query)->result_array();
    }

    public function getAllMonitor()
    {
        $query = "SELECT d.kode_kategori, d.divisi, p.nama, d.kode_penyelia FROM penyelia p, kategori_magang d where p.kode_kategori = d.kode_kategori and d.status = '1'";
        return $this->db->query($query)->result_array();
    }

    public function getAllPenyelia()
    {
        $query = "SELECT p. * ,k.divisi from penyelia p, kategori_magang k where  p.kode_kategori=k.kode_kategori";
        return $this->db->query($query)->result_array();
    }

    public function getPenyeliaById($kode_id)
    {
        $query = "SELECT p. * ,k.divisi from penyelia p, kategori_magang k where  p.kode_kategori=k.kode_kategori and p.kode_penyelia = '" . $kode_id . "';";
        return $this->db->query($query)->row_array();
    }

    public function getKetuaById($kode_id)
    {
        $query = "SELECT k. *, j.divisi from ketua k, kategori_magang j where  k.kode_kategori = j.kode_kategori and k.kode_ketua = '" . $kode_id . "';";
        return $this->db->query($query)->row_array();
    }

    public function getSubMenu()
    {
        $query = "SELECT `submenu`.*, `menu`.`menu`
                    FROM `submenu` JOIN `menu`
                    ON `submenu`.`menuid` = `menu`.`menuid`
                    ";
        return $this->db->query($query)->result_array();
    }

    public function getMenuById($id)
    {
        return $this->db->get_where('menu', ['menuid' => $id])->row_array();
    }

    public function getDivisiById($id)
    {
        return $this->db->get_where('kategori_magang', ['kode_kategori' => $id])->row_array();
    }

    public function getDivisiByKategori($kode_monitor)
    {
        return $this->db->get_where('kategori_magang', ['kode_kategori' => $kode_monitor])->row_array();
    }

    public function getAbsenById($kode_absen)
    {
        $query = "SELECT * FROM absensi where kode_magang = $kode_absen and status != '4' order by absen_id ASC ";
        return $this->db->query($query)->result_array();
    }

    public function getLokerById($id)
    {
        return $this->db->get_where('job', ['kode_kategori' => $id])->row_array();
    }

    public function deleteMenu($id)
    {
        $this->db->delete('menu', ['menuid' => $id]);
    }

    public function deleteDivisi($id)
    {
        $this->db->delete('kategori_magang', ['kode_kategori' => $id]);
    }

    public function deleteLoker($id)
    {
        $this->db->delete('job', ['jobid' => $id]);
    }

    public function getSubMenuById($id)
    {
        return $this->db->get_where('submenu', ['submenuid' => $id])->row_array();
    }

    public function deleteSubMenu($id)
    {
        $this->db->delete('submenu', ['submenuid' => $id]);
    }

    public function deleteMhs($id)
    {
        $this->db->delete('peserta_magang', ['kode_magang' => $id]);
    }

    public function deletePenyelia($id)
    {
        $this->db->delete('penyelia', ['kode_penyelia' => $id]);
    }

    public function deleteKetua($id)
    {
        $this->db->delete('ketua', ['kode_ketua' => $id]);
    }

    public function getMhsById($id)
    {
        $query = "SELECT p. * ,k.divisi from peserta_magang p, kategori_magang k where  p.kode_kategori=k.kode_kategori  and p.kode_magang='" . $id . "'; ";
        return $this->db->query($query)->row_array();
    }

    public function getMonitorById($kode_monitor)
    {
        $query = "SELECT p. * ,k.divisi from peserta_magang p, kategori_magang k where  p.kode_kategori=k.kode_kategori  and p.kode_kategori='" . $kode_monitor . "'; ";
        return $this->db->query($query)->result_array();
    }

    public function getNilaiById($kode_nilai)
    {
        $query = "SELECT p. * ,k.divisi from peserta_magang p, kategori_magang k where  p.kode_kategori=k.kode_kategori  and p.kode_kategori='" . $kode_nilai . "'; ";
        return $this->db->query($query)->result_array();
    }

    public function getMhsByKuliah($kuliah)
    {
        $query = "SELECT p. * ,k.divisi from peserta_magang p, kategori_magang k where  p.kode_kategori=k.kode_kategori  and p.tingkat_pendidikan='" . $kuliah . "' and p.status='1'; ";
        return $this->db->query($query)->result_array();
    }

    public function getSwaBySmk($smk)
    {
        $query = "SELECT p. * ,k.divisi from peserta_magang p, kategori_magang k where  p.kode_kategori=k.kode_kategori  and p.tingkat_pendidikan='" . $smk . "' and p.status='1'; ";
        return $this->db->query($query)->result_array();
    }
}
