-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2022 at 02:50 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simone`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `absen_id` int(11) NOT NULL,
  `kode_magang` int(20) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `tgl_absen` datetime NOT NULL,
  `jobname` varchar(125) NOT NULL,
  `kegiatan` text NOT NULL,
  `surat_ijin` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`absen_id`, `kode_magang`, `nama`, `tgl_absen`, `jobname`, `kegiatan`, `surat_ijin`, `status`) VALUES
(1, 1, 'AYU RETNO WULAN DINI ', '2022-11-23 19:33:23', 'IT Enginering', 'Mencoba membuat website', NULL, 1),
(2, 1, 'AYU RETNO WULAN DINI ', '2022-11-24 10:16:52', 'IT Enginering', 'IJIN SAKIT', '221124-ALUR.pdf', 2),
(3, 1, 'AYU RETNO WULAN DINI ', '2022-11-24 10:17:45', 'IT Enginering', '', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `kode_admin` char(20) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `idrole` int(10) NOT NULL,
  `jeniskel` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  `is_active` int(10) NOT NULL,
  `foto` varchar(120) NOT NULL,
  `kode_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`kode_admin`, `nama`, `email`, `password`, `idrole`, `jeniskel`, `status`, `is_active`, `foto`, `kode_kategori`) VALUES
('ADM-2022-01', 'Admin', 'admin@gmail.com', 'ADMIN', 1, 1, 1, 1, 'default.png', 7);

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `jobid` int(11) NOT NULL,
  `kode_kategori` int(30) NOT NULL,
  `jobdesc` text NOT NULL,
  `jobstart` date NOT NULL,
  `jobend` date NOT NULL,
  `registerend` date NOT NULL,
  `jobadded` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `workingtype` char(3) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`jobid`, `kode_kategori`, `jobdesc`, `jobstart`, `jobend`, `registerend`, `jobadded`, `workingtype`, `status`) VALUES
(1, 1, 'Mengatur instalasi Aplikasi, Mengawasi Jalannya Aplikasi, Membuat Aplikasi', '2022-11-16', '2023-04-16', '2022-11-30', '2022-11-24 16:19:20', 'WFH', 1),
(2, 2, 'Mengatur Jaringan Internet Kantor, Instalasi Jaringan Internet, Membuat sambungan natar ruangan dengan mikrotik', '2022-11-16', '2023-03-18', '2022-11-30', '2022-11-24 14:54:08', 'WFO', 1),
(8, 3, 'tes', '2022-11-24', '2022-11-30', '2022-11-25', '2022-11-24 14:54:13', 'WFH', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_magang`
--

CREATE TABLE `kategori_magang` (
  `kode_kategori` int(11) NOT NULL,
  `divisi` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_magang`
--

INSERT INTO `kategori_magang` (`kode_kategori`, `divisi`) VALUES
(1, 'Marketing Officer'),
(2, 'IT Enginering'),
(3, 'Tes'),
(5, 'tes 2'),
(6, 'Ketua'),
(7, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `ketua`
--

CREATE TABLE `ketua` (
  `kode_ketua` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `email` char(125) NOT NULL,
  `password` varchar(250) NOT NULL,
  `nip` char(25) NOT NULL,
  `telp` char(25) NOT NULL,
  `jeniskel` char(2) NOT NULL,
  `is_active` int(11) NOT NULL,
  `foto` varchar(120) NOT NULL,
  `idrole` int(12) NOT NULL,
  `status` int(12) NOT NULL,
  `kode_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ketua`
--

INSERT INTO `ketua` (`kode_ketua`, `nama`, `email`, `password`, `nip`, `telp`, `jeniskel`, `is_active`, `foto`, `idrole`, `status`, `kode_kategori`) VALUES
(1, 'KETUA', 'ketua@gmail.com', 'KETUA', 'A23.2450.2231', '0895645342', 'L', 1, 'default.png', 3, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menuid` int(10) NOT NULL,
  `menu` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menuid`, `menu`) VALUES
(1, 'Admin'),
(2, 'Kepegawaian'),
(3, 'Proses'),
(10, 'Ketua'),
(11, 'Penyelia'),
(12, 'Keanggotaan');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `nilai_id` int(11) NOT NULL,
  `mhs_id` char(20) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `universitas` varchar(150) NOT NULL,
  `nilai_disiplin` double NOT NULL,
  `nilai_tgjwb` double NOT NULL,
  `nilai_ujian` double NOT NULL,
  `rata_rata` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `penyelia`
--

CREATE TABLE `penyelia` (
  `kode_penyelia` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `nip` varchar(150) NOT NULL,
  `jeniskel` char(2) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(150) NOT NULL,
  `idrole` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `kode_kategori` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penyelia`
--

INSERT INTO `penyelia` (`kode_penyelia`, `nama`, `nip`, `jeniskel`, `telepon`, `foto`, `email`, `password`, `idrole`, `is_active`, `kode_kategori`, `status`) VALUES
(1, 'Penyelia 1', 'A22.2020.02820', 'P', '08976722313121', 'default.png', 'penyelia1@gmail.com', 'PENYELIA1', 4, 1, 1, 1),
(2, 'Penyelia 2', 'A22.2020.02825', 'L', '0899873131231', 'default.png', 'penyelia2@gmail.com', 'PENYELIA2', 4, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `peserta_magang`
--

CREATE TABLE `peserta_magang` (
  `kode_magang` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `jurusan` varchar(150) NOT NULL,
  `sekolah` varchar(150) NOT NULL,
  `jeniskel` char(2) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `surat_pengantar` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(150) NOT NULL,
  `status` int(2) NOT NULL,
  `idrole` int(10) NOT NULL,
  `is_active` int(10) NOT NULL,
  `kode_kategori` int(11) NOT NULL,
  `tingkat_pendidikan` varchar(30) NOT NULL,
  `tgl_daftar` datetime NOT NULL,
  `tgl_terima` datetime DEFAULT NULL,
  `konfirmasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peserta_magang`
--

INSERT INTO `peserta_magang` (`kode_magang`, `nama`, `jurusan`, `sekolah`, `jeniskel`, `telepon`, `foto`, `surat_pengantar`, `email`, `password`, `status`, `idrole`, `is_active`, `kode_kategori`, `tingkat_pendidikan`, `tgl_daftar`, `tgl_terima`, `konfirmasi`) VALUES
(1, 'AYU RETNO WULAN DINI', 'TEKNIK INFORMATIKA', 'UDINUS', 'P', '62895376249050', '221117-A22.2020.02855.jpg', '221117-ALUR.pdf', 'ayu@gmail.com', 'AYU123', 1, 2, 1, 1, 'mahasiswa', '2022-11-21 17:47:19', '2022-11-21 11:46:21', 1),
(5, 'CANDRA AGUNG PURNOMO', 'TEKNIK INFORMATIKA', 'UDINUS', 'L', '62895376249050', '221117-A22_2020_02820.jpg', '221117-ALUR.pdf', 'tes@gmail.com', 'GZ1Q9UPE', 1, 2, 1, 2, 'siswa', '2022-11-21 17:49:29', '2022-11-24 13:51:33', 0),
(14, 'biyu', 'TEKNIK INFORMATIKA', 'UDINUS', 'L', '625757567567757', '221125-avatar1.png', '221125-ALUR1.pdf', 'biyu@gmail.com', 'LRIK54V9', 1, 2, 1, 3, 'siswa', '2022-11-25 10:27:28', '2022-11-25 11:06:43', 0),
(15, 'Customer 1', 'TEKNIK INFORMATIKA', 'UDINUS', 'P', '6245345353', '221125-pakan.jpg', '221125-ALUR2.pdf', 'user@gmail.com', '74SHEY39', 2, 2, 1, 3, 'mahasiswa', '2022-11-25 11:08:48', '2022-11-25 11:12:45', 0);

-- --------------------------------------------------------

--
-- Table structure for table `submenu`
--

CREATE TABLE `submenu` (
  `submenuid` int(11) NOT NULL,
  `menuid` int(11) NOT NULL,
  `title` varchar(120) NOT NULL,
  `url` varchar(120) NOT NULL,
  `icon` varchar(120) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `submenu`
--

INSERT INTO `submenu` (`submenuid`, `menuid`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'dashboard', 'fas fa-tachometer-alt', 1),
(2, 1, 'User Role', 'dashboard/user_role', 'fas fa-user', 1),
(3, 1, 'Menu Management', 'dashboard/menu_management', 'fas fa-folder-plus', 1),
(4, 2, 'Data Peserta Magang', 'dashboard/data_peserta', 'fas fa-user-graduate', 1),
(5, 2, 'Data Penyelia', 'dashboard/data_penyelia', 'fas fa-user-tie', 1),
(6, 3, 'Verifikasi Pelamar ', 'dashboard/verif', 'fas fa-user-check', 1),
(7, 3, 'Monitoring', 'dashboard/monitoring', 'fas fa-desktop', 1),
(8, 3, 'Penilaian', 'dashboard/input_nilai', 'fas fa-list', 1),
(12, 1, 'Lowongan Magang', 'dashboard/loker', 'fas fa-pen-ruler', 1),
(14, 1, 'Histori Pelamar', 'dashboard/histori', 'fas fa-clock', 1),
(15, 1, 'Divisi Magang', 'dashboard/divisi', 'fas fa-city', 1),
(16, 2, 'Data Ketua', 'dashboard/data_ketua', 'fas fa-user-secret', 1),
(17, 10, 'Dashboard', 'ketua', 'fas fa-tachometer-alt', 1),
(18, 10, 'Data Peserta', 'ketua/data_peserta', 'fas fa-user-graduate', 1),
(19, 10, 'Data Penyelia', 'ketua/data_penyelia', 'fas fa-user-tie', 1),
(20, 10, 'Data Ketua', 'ketua/data_ketua', 'fas fa-user-secret', 1),
(21, 10, 'Monitoring', 'ketua/monitoring', 'fas fa-desktop', 1),
(22, 11, 'Dashboard', 'penyelia', 'fas fa-tachometer-alt', 1),
(23, 11, 'Konfirmasi Anggota', 'penyelia/konfirmasi', 'fas fa-user-check', 1),
(24, 12, 'Data Anggota', 'penyelia/anggota', 'fas fa-user', 1),
(25, 11, 'Monitoring', 'penyelia/monitoring', 'fas fa-desktop', 1),
(26, 11, 'penilaian', 'penyelia/penilaian', 'fas fa-list', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `roleid` int(11) NOT NULL,
  `menuid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `roleid`, `menuid`) VALUES
(1, 1, 1),
(2, 1, 2),
(4, 1, 4),
(11, 1, 3),
(14, 3, 10),
(15, 4, 11),
(16, 4, 12);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `idrole` int(10) NOT NULL,
  `role` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`idrole`, `role`) VALUES
(1, 'Admin'),
(2, 'Peserta Magang'),
(3, 'Ketua'),
(4, 'Penyelia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`absen_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`kode_admin`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`jobid`);

--
-- Indexes for table `kategori_magang`
--
ALTER TABLE `kategori_magang`
  ADD PRIMARY KEY (`kode_kategori`);

--
-- Indexes for table `ketua`
--
ALTER TABLE `ketua`
  ADD PRIMARY KEY (`kode_ketua`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menuid`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`nilai_id`);

--
-- Indexes for table `penyelia`
--
ALTER TABLE `penyelia`
  ADD PRIMARY KEY (`kode_penyelia`);

--
-- Indexes for table `peserta_magang`
--
ALTER TABLE `peserta_magang`
  ADD PRIMARY KEY (`kode_magang`);

--
-- Indexes for table `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`submenuid`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`idrole`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `absen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `jobid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kategori_magang`
--
ALTER TABLE `kategori_magang`
  MODIFY `kode_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ketua`
--
ALTER TABLE `ketua`
  MODIFY `kode_ketua` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menuid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `nilai_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penyelia`
--
ALTER TABLE `penyelia`
  MODIFY `kode_penyelia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `peserta_magang`
--
ALTER TABLE `peserta_magang`
  MODIFY `kode_magang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `submenu`
--
ALTER TABLE `submenu`
  MODIFY `submenuid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `idrole` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
