<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DataPeserta_model extends CI_Model
{
    public function getMhsById($kode_id)
    {
        $query = "SELECT p.*,k.divisi, a.nama as nama_penyelia, a.nip from peserta_magang p,kategori_magang k, penyelia a where  p.kode_kategori=k.kode_kategori and a.kode_penyelia = k.kode_penyelia and p.kode_magang='" . $kode_id . "';";
        return $this->db->query($query)->row_array();
    }

    public function getRoleById($kode_id)
    {
        $query = "SELECT p.kode_magang,p.nama,p.idrole,r.role,k.divisi from peserta_magang p,user_role r, kategori_magang k where p.idrole=r.idrole and p.kode_kategori=k.kode_kategori and p.kode_magang='" . $kode_id . "';";
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
}
