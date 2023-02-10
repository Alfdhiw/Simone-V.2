-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2023 at 07:09 AM
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
(11, 35, 'testing', '2023-02-07 18:23:07', 'IT Enginering', '', NULL, 1);

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
  `kode_penyelia` int(11) DEFAULT NULL,
  `kuota` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_magang`
--

INSERT INTO `kategori_magang` (`kode_kategori`, `divisi`, `kode_penyelia`, `kuota`, `status`) VALUES
(1, 'Panitera Muda Perdata', 1, 9, 1),
(2, 'IT Enginering', 2, 2, 1),
(3, 'Panitera Muda Pidana', 6, 10, 1),
(6, 'Ketua', 0, 0, 0),
(7, 'Admin', 0, 0, 0),
(13, 'Tipikor', 8, 10, 1),
(14, 'Kepegawaian', 7, 10, 1),
(15, 'Sekretaris', 0, 0, 1);

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
(12, 'Keanggotaan'),
(13, 'Sekretaris'),
(14, 'Seleksi'),
(15, 'Input Data');

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
-- Table structure for table `peserta_kelompok`
--

CREATE TABLE `peserta_kelompok` (
  `kode_kelompok` int(11) NOT NULL,
  `sekolah` varchar(120) NOT NULL,
  `jurusan` varchar(120) NOT NULL,
  `surat_pengantar` varchar(120) NOT NULL,
  `transkip_nilai` varchar(120) NOT NULL,
  `email_kampus` varchar(120) NOT NULL,
  `status` int(11) NOT NULL,
  `tingkat_pendidikan` varchar(120) NOT NULL,
  `tgl_daftar` datetime NOT NULL,
  `tgl_terima` date NOT NULL,
  `nama_1` varchar(120) NOT NULL,
  `nama_2` varchar(120) NOT NULL,
  `nama_3` varchar(120) DEFAULT NULL,
  `nim_1` varchar(120) NOT NULL,
  `nim_2` varchar(120) NOT NULL,
  `nim_3` varchar(120) DEFAULT NULL,
  `email_1` varchar(120) NOT NULL,
  `email_2` varchar(120) NOT NULL,
  `email_3` varchar(120) DEFAULT NULL,
  `telp_1` varchar(120) NOT NULL,
  `telp_2` varchar(120) NOT NULL,
  `telp_3` varchar(120) DEFAULT NULL,
  `jeniskel_1` char(11) NOT NULL,
  `jeniskel_2` char(11) NOT NULL,
  `jeniskel_3` char(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peserta_kelompok`
--

INSERT INTO `peserta_kelompok` (`kode_kelompok`, `sekolah`, `jurusan`, `surat_pengantar`, `transkip_nilai`, `email_kampus`, `status`, `tingkat_pendidikan`, `tgl_daftar`, `tgl_terima`, `nama_1`, `nama_2`, `nama_3`, `nim_1`, `nim_2`, `nim_3`, `email_1`, `email_2`, `email_3`, `telp_1`, `telp_2`, `telp_3`, `jeniskel_1`, `jeniskel_2`, `jeniskel_3`) VALUES
(2, 'UDINUS', 'TI', '230207-Undangan_Sosialisasi_Jepang.pdf', '230207-Revisi.pdf', 'januartegar504@gmail.com', 2, 'mahasiswa', '2023-02-07 20:14:07', '2023-02-07', 'ayu', 'ari', '', 'a22.2020.02825', 'a22.2020.0282283', '', 'ayu@gmail.com', 'ari@gmail.com', '', '08955544344', '0986655343434', NULL, 'P', 'L', NULL);

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
  `surat_pengantar` varchar(255) DEFAULT NULL,
  `transkip_nilai` varchar(120) DEFAULT NULL,
  `sertifikat` varchar(250) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_kampus` varchar(120) DEFAULT NULL,
  `password` varchar(150) NOT NULL,
  `status` int(2) NOT NULL,
  `idrole` int(10) NOT NULL,
  `is_active` int(10) NOT NULL,
  `kode_kategori` int(11) DEFAULT NULL,
  `tingkat_pendidikan` varchar(30) NOT NULL,
  `tgl_daftar` datetime NOT NULL,
  `tgl_terima` date DEFAULT NULL,
  `konfirmasi` int(11) NOT NULL,
  `absen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peserta_magang`
--

INSERT INTO `peserta_magang` (`kode_magang`, `nama`, `nim`, `jurusan`, `sekolah`, `jeniskel`, `telepon`, `foto`, `surat_pengantar`, `transkip_nilai`, `sertifikat`, `email`, `email_kampus`, `password`, `status`, `idrole`, `is_active`, `kode_kategori`, `tingkat_pendidikan`, `tgl_daftar`, `tgl_terima`, `konfirmasi`, `absen`) VALUES
(35, 'testing', '12345678', 'tkj', 'smkn8', 'P', '628953765434', '230205-selfi_cewek1.jpg', '230205-Revisi1.pdf', '230205-ELS-20-Januari-20231.pdf', NULL, 'tes@gmail.com', 'tumbalgendhon22@gmail.com', 'dc97zwis', 1, 2, 1, 2, 'siswa', '2023-02-05 19:30:08', '2023-02-07', 1, 1),
(36, 'bagus tri', 'A22.2020.02825', 'informatika', 'udinus', 'L', '62895376249050', '230207-selfi.jpeg', '230207-Jadwal_Ujian_Sertifikasi_Ganjil2022_2023.pdf', '230207-ELS-20-Januari-2023.pdf', NULL, 'bagus@gmail.com', 'tumbalgendhon22@gmail.com', 'pzrqecal', 1, 2, 1, 1, 'siswa', '2023-02-07 12:58:49', '2023-02-07', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sekretaris`
--

CREATE TABLE `sekretaris` (
  `kode_sekretaris` int(11) NOT NULL,
  `nama` varchar(120) NOT NULL,
  `nip` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `idrole` int(11) NOT NULL,
  `jeniskel` int(11) NOT NULL,
  `telepon` varchar(120) NOT NULL,
  `status` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `foto` varchar(120) NOT NULL,
  `kode_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sekretaris`
--

INSERT INTO `sekretaris` (`kode_sekretaris`, `nama`, `nip`, `email`, `password`, `idrole`, `jeniskel`, `telepon`, `status`, `is_active`, `foto`, `kode_kategori`) VALUES
(1, 'sekretaris', '3374070205544', 'sekretaris@gmail.com', '12345', 5, 1, '0895376249050', 1, 1, '230205-selfi_cowok.jpeg', 15);

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
(6, 3, 'Verifikasi Pelamar ', 'dashboard/verif', 'fas fa-user-check', 0),
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
(23, 11, 'Konfirmasi Anggota', 'penyelia/konfirmasi', 'fas fa-user-check', 0),
(24, 12, 'Data Anggota', 'penyelia/anggota', 'fas fa-user', 1),
(25, 11, 'Monitoring', 'penyelia/monitoring', 'fas fa-desktop', 1),
(26, 11, 'penilaian', 'penyelia/penilaian', 'fas fa-list', 1),
(27, 10, 'Penilaian ', 'ketua/penilaian', 'fas fa-list', 1),
(28, 1, 'Jadwal Absen', 'dashboard/jadwal_absen', 'fas fa-calendar', 1),
(29, 11, 'Verifikasi Absen', 'penyelia/verifabsen', 'fas fa-pen', 1),
(30, 13, 'Dashboard', 'sekretaris', 'fas fa-tachometer-alt', 1),
(31, 13, 'Data Peserta', 'sekretaris/data_peserta', 'fas fa-user-graduate', 1),
(32, 13, 'Data Penyelia', 'sekretaris/data_penyelia', 'fas fa-user-tie', 1),
(33, 13, 'Data Ketua', 'sekretaris/data_ketua', 'fas fa-user-tie', 1),
(34, 14, 'Pendaftar Individu', 'sekretaris/verif', 'fas fa-user-check', 1),
(35, 13, 'Histori Pelamar', 'sekretaris/histori', 'fas fa-clock', 1),
(36, 14, 'Konfirmasi Berkas', 'sekretaris/berkas', 'fas fa-folder-open', 1),
(37, 14, 'Pendaftar Kelompok', 'sekretaris/verif_kelompok', 'fas fa-users', 1),
(38, 13, 'Data Peserta Kelompok', 'sekretaris/kelompok', 'fas fa-users', 1),
(39, 15, 'Input Peserta', 'sekretaris/daftarindividu', 'fas fa-pencil', 1);

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
(16, 4, 12),
(22, 5, 13),
(25, 5, 14),
(26, 5, 15);

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
(4, 'Penyelia'),
(5, 'Sekretaris');

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
-- Indexes for table `peserta_kelompok`
--
ALTER TABLE `peserta_kelompok`
  ADD PRIMARY KEY (`kode_kelompok`);

--
-- Indexes for table `peserta_magang`
--
ALTER TABLE `peserta_magang`
  ADD PRIMARY KEY (`kode_magang`);

--
-- Indexes for table `sekretaris`
--
ALTER TABLE `sekretaris`
  ADD PRIMARY KEY (`kode_sekretaris`);

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
  MODIFY `absen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `jobid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kategori_magang`
--
ALTER TABLE `kategori_magang`
  MODIFY `kode_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ketua`
--
ALTER TABLE `ketua`
  MODIFY `kode_ketua` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menuid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `penilaian_detail`
--
ALTER TABLE `penilaian_detail`
  MODIFY `nilai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `penyelia`
--
ALTER TABLE `penyelia`
  MODIFY `kode_penyelia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `peserta_kelompok`
--
ALTER TABLE `peserta_kelompok`
  MODIFY `kode_kelompok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `peserta_magang`
--
ALTER TABLE `peserta_magang`
  MODIFY `kode_magang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `sekretaris`
--
ALTER TABLE `sekretaris`
  MODIFY `kode_sekretaris` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `submenu`
--
ALTER TABLE `submenu`
  MODIFY `submenuid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `idrole` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `waktu`
--
ALTER TABLE `waktu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
