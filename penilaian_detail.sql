-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2022 at 08:54 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

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
(5, '2023-03-29', 1, 90, 80, 80, 83, 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `penilaian_detail`
--
ALTER TABLE `penilaian_detail`
  ADD PRIMARY KEY (`nilai_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `penilaian_detail`
--
ALTER TABLE `penilaian_detail`
  MODIFY `nilai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
