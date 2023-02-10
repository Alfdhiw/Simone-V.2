<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DataPeserta_model extends CI_Model
{
    public function getMhsById($kode_id)
    {
        $query = "SELECT p.* from peserta_magang p where p.kode_magang='" . $kode_id . "';";
        return $this->db->query($query)->row_array();
    }

    public function getKelompokById()
    {
        $query = "SELECT p.* from peserta_kelompok p";
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
