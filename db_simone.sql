-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2023 at 06:27 PM
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
(1, 1, 'AYU RETNO WULAN DINI ', '2022-11-23 19:33:23', 'IT Enginering', 'Mencoba membuat website', NULL, 3),
(2, 1, 'AYU RETNO WULAN DINI ', '2022-11-24 10:16:52', 'IT Enginering', 'IJIN SAKIT', '221124-ALUR.pdf', 2),
(3, 1, 'AYU RETNO WULAN DINI ', '2022-11-24 10:17:45', 'IT Enginering', '', NULL, 0),
(4, 1, 'AYU RETNO WULAN DINI', '2023-01-05 14:47:12', 'Marketing Officer', '', NULL, 1),
(5, 1, 'AYU RETNO WULAN DINI', '2023-01-05 14:51:49', 'Marketing Officer', 'hari ini hanya bengong', NULL, 1),
(6, 28, 'anggita oktaviana', '2023-01-09 10:06:23', 'Panitera Muda Perdata', '', NULL, 1),
(7, 30, 'rizqi fajriati', '2023-01-09 13:24:50', 'Panitera Muda Perdata', '', NULL, 4),
(8, 28, 'anggita oktaviana', '2023-01-09 20:47:55', 'Panitera Muda Perdata', 'membantu staff IT memasukan data', NULL, 3),
(9, 32, 'Tanaya azka nariswari', '2023-01-10 21:50:42', 'Panitera Muda Perdata', '', NULL, 4),
(10, 32, 'Tanaya azka nariswari', '2023-01-10 21:53:35', 'Panitera Muda Perdata', 'hahhoo', NULL, 3);

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
('ADM-2022-01', 'Admin', 'admin@gmail.com', 'admin', 1, 1, 1, 1, 'default.png', 7);

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
  `kuota` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`jobid`, `kode_kategori`, `jobdesc`, `jobstart`, `jobend`, `registerend`, `jobadded`, `workingtype`, `kuota`, `status`) VALUES
(1, 1, 'membantu staff Panmud Perdata', '2023-01-16', '2023-02-20', '2023-02-24', '2023-01-10 06:23:19', 'WFO', 1, 1),
(2, 2, 'Mengatur Jaringan Internet Kantor, Instalasi Jaringan Internet, Membuat sambungan natar ruangan dengan mikrotik', '2023-01-16', '2023-02-20', '2023-02-24', '2023-01-09 13:23:47', 'WFO', 2, 1),
(11, 3, 'membantu staff Panmud Pidana', '2023-01-16', '2023-02-20', '2023-02-24', '2023-01-09 02:35:32', 'WFO', 3, 1),
(12, 9, 'membantu staff kepegawaian ', '2023-01-16', '2023-02-20', '2023-02-24', '2023-01-09 02:38:36', 'WFO', 3, 1),
(13, 10, 'membantu staff Tindakan Korupsi ', '2023-01-16', '2023-02-20', '2023-02-24', '2023-01-09 02:39:16', 'WFO', 3, 1),
(14, 11, 'membantu staff kepegawaian', '2023-01-16', '2023-02-20', '2023-02-24', '2023-01-09 07:28:02', 'WFO', 3, 1),
(15, 12, 'membantu staff Tindakan Korupsi', '2023-01-16', '2023-02-20', '2023-02-24', '2023-01-09 07:28:59', 'WFO', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_magang`
--

CREATE TABLE `kategori_magang` (
  `kode_kategori` int(11) NOT NULL,
  `divisi` varchar(150) NOT NULL,
  `kode_penyelia` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_magang`
--

INSERT INTO `kategori_magang` (`kode_kategori`, `divisi`, `kode_penyelia`, `status`) VALUES
(1, 'Panitera Muda Perdata', 1, 1),
(2, 'IT Enginering', 2, 1),
(3, 'Panitera Muda Pidana', 6, 1),
(6, 'Ketua', 0, 0),
(7, 'Admin', 0, 0),
(13, 'Tipikor', 8, 1),
(14, 'Kepegawaian', 7, 1);

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
(1, 'RIZA FAUZI, S.H., C.N.', 'rizafauzi@gmail.com', 'rizafauzi', '19650326 199103 1 001', '0895645342', 'L', 1, '230109-ketuaPN.jpg', 3, 1, 6);

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
-- Table structure for table `penilaian_detail`
--

CREATE TABLE `penilaian_detail` (
  `nilai_id` int(11) NOT NULL,
  `tanggal_penilaian` date NOT NULL,
  `kode_magang` int(20) NOT NULL,
  `nilai_disiplin` double NOT NULL,
  `nilai_tanggungjawab` double NOT NULL,
  `nilai_praktek` double NOT NULL,
  `nilai_rata` double NOT NULL,
  `grade` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penilaian_detail`
--

INSERT INTO `penilaian_detail` (`nilai_id`, `tanggal_penilaian`, `kode_magang`, `nilai_disiplin`, `nilai_tanggungjawab`, `nilai_praktek`, `nilai_rata`, `grade`) VALUES
(1, '2022-11-29', 1, 90, 70, 60, 73, 'B'),
(2, '2022-12-29', 1, 70, 80, 60, 70, 'B'),
(3, '2023-01-29', 1, 80, 70, 90, 80, 'A'),
(4, '2023-02-28', 1, 90, 70, 90, 83, 'A'),
(5, '2023-03-29', 1, 90, 80, 80, 83, 'A'),
(8, '2022-12-01', 5, 90, 90, 90, 90, 'A'),
(9, '2023-01-09', 28, 80, 80, 80, 80, 'A');

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
(1, 'HENING WAHYUNINGTYAS, SH, MM', '19720906 199903 2 002', 'P', '08976722313121', '230109-panmud_perdata.jpg', 'heningwahyuningtyas@gmail.com', 'heningwahyuningtyas', 4, 1, 1, 1),
(2, 'NORMANDITO WIJAYA, S.Kom. ,M.M', '19861006 200912 1 004', 'L', '0899873131231', '230109-Pak_Norman.jpg', 'normanditowijaya@gmail.com', 'normanditowijaya', 4, 1, 2, 1),
(6, 'JAHJA AMUDJADI, SH', '19661118 199203 1 004', 'L', '09878567565', '230109-jahja.jpg', 'jahjaamudjadi@gmail.com', 'jahjaamudjadi', 4, 1, 3, 1),
(7, 'HERLIA ASRI FITRIANI, S.T', '19840702 200904 2 007', 'P', '089789906854', '230109-kepegawaian.jpg', 'herliaasrifitriani@gmail.com', 'herliaasrifitriani', 4, 1, 13, 1),
(8, 'KURNIAWAN ASHARI, S.T., S.H., M.Hum.', '19760121 200112 1 001', 'L', '086521889043', '230109-tipikor.jpg', 'kurniawanashari@gmail.com', 'kurniawanashari', 4, 1, 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `peserta_magang`
--

CREATE TABLE `peserta_magang` (
  `kode_magang` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `nim` varchar(100) NOT NULL,
  `jurusan` varchar(150) NOT NULL,
  `sekolah` varchar(150) NOT NULL,
  `jeniskel` char(2) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `surat_pengantar` varchar(255) NOT NULL,
  `sertifikat` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(150) NOT NULL,
  `status` int(2) NOT NULL,
  `idrole` int(10) NOT NULL,
  `is_active` int(10) NOT NULL,
  `kode_kategori` int(11) NOT NULL,
  `tingkat_pendidikan` varchar(30) NOT NULL,
  `tgl_daftar` datetime NOT NULL,
  `tgl_terima` datetime DEFAULT NULL,
  `konfirmasi` int(11) NOT NULL,
  `absen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peserta_magang`
--

INSERT INTO `peserta_magang` (`kode_magang`, `nama`, `nim`, `jurusan`, `sekolah`, `jeniskel`, `telepon`, `foto`, `surat_pengantar`, `sertifikat`, `email`, `password`, `status`, `idrole`, `is_active`, `kode_kategori`, `tingkat_pendidikan`, `tgl_daftar`, `tgl_terima`, `konfirmasi`, `absen`) VALUES
(1, 'AYU RETNO WULAN DINI', 'A22.2020.02824', 'TEKNIK INFORMATIKA', 'UDINUS', 'P', '62895376249050', '221117-A22.2020.02855.jpg', '221117-ALUR.pdf', 1, 'ayu@gmail.com', 'ayu123', 1, 2, 1, 1, 'mahasiswa', '2022-11-21 17:47:19', '2022-11-21 11:46:21', 1, 0),
(28, 'anggita oktaviana', 'A22.2020.02817', 'hukum', 'UDINUS', 'P', '6286748593846', '230109-ANGGITA.jpg', '230109-surat_magang.pdf', 1, 'anggita@gmail.com', 'anggita', 1, 2, 1, 1, 'mahasiswa', '2023-01-09 09:54:57', '2023-01-09 10:01:36', 1, 0),
(31, 'rizqi fajriati', 'A22.2020.02816', 'TEKNIK INFORMATIKA', 'UDINUS', 'P', '6289667498880', '230109-kiki2.png', '230109-surat_magang3.pdf', NULL, 'rizqi@gmail.com', 'rizqi', 1, 2, 1, 2, 'mahasiswa', '2023-01-09 20:22:51', '2023-01-09 21:48:18', 1, 0),
(32, 'Tanaya azka nariswari', 'A22.2020.02856', 'Hukum', 'UDINUS', 'P', '6289667498880', '230110-girl.png', '230110-surat_magang.pdf', NULL, 'tanaya@gmail.com', 'x2k6ph3f', 1, 2, 1, 1, 'mahasiswa', '2023-01-10 10:15:55', '2023-01-10 10:18:19', 0, 0),
(33, 'Fakta fidinia', 'A22.2020.02857', 'TEKNIK INFORMATIKA', 'trisakti', 'P', '6289667498880', '230110-girl1.png', '230110-surat_magang1.pdf', NULL, 'fatkafidinia@gmail.com', '5bkjzo1q', 2, 2, 1, 1, 'mahasiswa', '2023-01-10 13:22:21', '2023-01-10 13:30:32', 0, 0);

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
(8, 3, 'Penilaian', 'dashboard/penilaian', 'fas fa-list', 1),
(12, 1, 'Kuota Magang', 'dashboard/loker', 'fas fa-pen-ruler', 1),
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
(26, 11, 'penilaian', 'penyelia/penilaian', 'fas fa-list', 1),
(27, 10, 'Penilaian ', 'ketua/penilaian', 'fas fa-list', 1),
(28, 1, 'Jadwal Absen', 'dashboard/jadwal_absen', 'fas fa-calendar', 1),
(29, 11, 'Verifikasi Absen', 'penyelia/verifabsen', 'fas fa-pen', 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `waktu`
--

CREATE TABLE `waktu` (
  `id` int(11) NOT NULL,
  `masuk` time NOT NULL,
  `pulang` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `waktu`
--

INSERT INTO `waktu` (`id`, `masuk`, `pulang`) VALUES
(1, '19:00:00', '21:00:00');

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
-- Indexes for table `penilaian_detail`
--
ALTER TABLE `penilaian_detail`
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
-- Indexes for table `waktu`
--
ALTER TABLE `waktu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `absen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `jobid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kategori_magang`
--
ALTER TABLE `kategori_magang`
  MODIFY `kode_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
-- AUTO_INCREMENT for table `penilaian_detail`
--
ALTER TABLE `penilaian_detail`
  MODIFY `nilai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `penyelia`
--
ALTER TABLE `penyelia`
  MODIFY `kode_penyelia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `peserta_magang`
--
ALTER TABLE `peserta_magang`
  MODIFY `kode_magang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `submenu`
--
ALTER TABLE `submenu`
  MODIFY `submenuid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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

--
-- AUTO_INCREMENT for table `waktu`
--
ALTER TABLE `waktu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
