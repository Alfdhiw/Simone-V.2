<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function getUsernameUsers($email)
    {
        $query = "select `peserta_magang`.`kode_magang` AS `kode`,`peserta_magang`.`nama` AS `nama`,`peserta_magang`.`password` AS `password`,`peserta_magang`.`email` AS `email`,`peserta_magang`.`idrole` AS `idrole`,`peserta_magang`.`jeniskel` AS `jeniskel`,`peserta_magang`.`is_active` AS `is_active`,`peserta_magang`.`status` AS `status`, `peserta_magang`.`kode_kategori` as `kode_kategori` from `peserta_magang` where email='" . $email . "'
        union
        select `admin`.`kode_admin` AS `kode`,`admin`.`email` AS `email`,`admin`.`password` AS `password`,`admin`.`nama` AS `nama`,`admin`.`idrole` AS `idrole`,`admin`.`jeniskel` as `jeniskel`, `admin`.`is_active` as `is_active`, `admin`.`status` as `status`, `admin`.`kode_kategori` as `kode_kategori` from `admin` where email='" . $email . "'
        union
        select `ketua`.`kode_ketua` AS `kode`,`ketua`.`email` AS `email`,`ketua`.`password` AS `password`,`ketua`.`nama` AS `nama`,`ketua`.`idrole` AS `idrole`,`ketua`.`jeniskel` as `jeniskel`, `ketua`.`is_active` as `is_active`, `ketua`.`status` as `status`, `ketua`.`kode_kategori` as `kode_kategori` from `ketua` where email='" . $email . "'
        union
        select `penyelia`.`kode_penyelia` AS `kode`,`penyelia`.`email` AS `email`,`penyelia`.`password` AS `password`,`penyelia`.`nama` AS `nama`,`penyelia`.`idrole` AS `idrole`,`penyelia`.`jeniskel` as `jeniskel`, `penyelia`.`is_active` as `is_active`,`penyelia`.`status` as `status`, `penyelia`.`kode_kategori` as `kode_kategori` from `penyelia` where email='" . $email . "'
        union 
        select `sekretaris`.`kode_sekretaris` AS `kode`,`sekretaris`.`email` AS `email`,`sekretaris`.`password` AS `password`,`sekretaris`.`nama` AS `nama`,`sekretaris`.`idrole` AS `idrole`,`sekretaris`.`jeniskel` as `jeniskel`, `sekretaris`.`is_active` as `is_active`, `sekretaris`.`status` as `status`, `sekretaris`.`kode_kategori` as `kode_kategori` from `sekretaris` where email='" . $email . "';";
        return $this->db->query($query)->row();
    }

    public function getUserPassUsers($email, $password)
    {
        $query = "select `peserta_magang`.`kode_magang` AS `kode`,`peserta_magang`.`nama` AS `nama`,`peserta_magang`.`password` AS `password`,`peserta_magang`.`email` AS `email`,`peserta_magang`.`idrole` AS `idrole`,`peserta_magang`.`jeniskel` AS `jeniskel`,`peserta_magang`.`is_active` AS `is_active`,`peserta_magang`.`status` AS `status`,`peserta_magang`.`foto` as `foto`, `peserta_magang`.`kode_kategori` as `kode_kategori` from `peserta_magang` where email='" . $email . "' and password='" . $password . "'
        UNION
        select `admin`.`kode_admin` AS `kode`,`admin`.`nama` AS `nama`,`admin`.`password` AS `password`,`admin`.`email` AS `email`,`admin`.`idrole` AS `idrole`,`admin`.`jeniskel` as `jeniskel`, `admin`.`is_active` as `is_active`, `admin`.`status` as `status`,`admin`.`foto`as`foto`, `admin`.`kode_kategori`as`kode_kategori` from `admin` where email='" . $email . "' and password='" . $password . "'
        UNION 
        select `ketua`.`kode_ketua` AS `kode`,`ketua`.`nama` AS `nama`,`ketua`.`password` AS `password`,`ketua`.`email` AS `email`,`ketua`.`idrole` AS `idrole`,`ketua`.`jeniskel` as `jeniskel`, `ketua`.`is_active` as `is_active`, `ketua`.`status` as `status`,`ketua`.`foto`as`foto`, `ketua`.`kode_kategori`as`kode_kategori` from `ketua` where email='" . $email . "' and password='" . $password . "'
        UNION 
        select `penyelia`.`kode_penyelia` AS `kode`,`penyelia`.`nama` AS `nama`,`penyelia`.`password` AS `password`,`penyelia`.`email` AS `email`,`penyelia`.`idrole` AS `idrole`,`penyelia`.`jeniskel` as `jeniskel`, `penyelia`.`is_active` as `is_active`, `penyelia`.`status` as `status`,`penyelia`.`foto`as`foto`, `penyelia`.`kode_kategori` as `kode_kategori` from `penyelia` where email='" . $email . "' and password='" . $password . "'
        union 
        select `sekretaris`.`kode_sekretaris` AS `kode`,`sekretaris`.`nama` AS `nama`,`sekretaris`.`password` AS `password`,`sekretaris`.`email` AS `email`,`sekretaris`.`idrole` AS `idrole`,`sekretaris`.`jeniskel` as `jeniskel`, `sekretaris`.`is_active` as `is_active`, `sekretaris`.`status` as `status`,`sekretaris`.`foto`as`foto`, `sekretaris`.`kode_kategori`as`kode_kategori` from `sekretaris` where email='" . $email . "' and password='" . $password . "'";
        return $this->db->query($query);
    }
}
