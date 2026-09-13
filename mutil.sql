-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2026 at 11:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mutil`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_ekskul`
--

CREATE TABLE `admin_ekskul` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_ekskul` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_ekskul`
--

INSERT INTO `admin_ekskul` (`id_admin`, `username`, `email`, `password`, `id_ekskul`) VALUES
(1, 'Rohis', 'chiwapandaa@gmail.com', '5103753', 10);

-- --------------------------------------------------------

--
-- Table structure for table `data_diri`
--

CREATE TABLE `data_diri` (
  `id_data` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `alamat` text DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_diri`
--

INSERT INTO `data_diri` (`id_data`, `id`, `nama_lengkap`, `nis`, `kelas`, `alamat`, `jenis_kelamin`, `no_hp`, `foto`) VALUES
(1, 3, 'Gilang Ryan Eka Putra', '22019201', 'X TJKT', 'sudiang\r\n', 'Laki-laki', '9283109', 'human-simple-line-icon-on-white-background-free-vector.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ekskul`
--

CREATE TABLE `ekskul` (
  `id_ekskul` int(11) NOT NULL,
  `nama_ekskul` varchar(100) NOT NULL,
  `link_group` varchar(100) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ekskul`
--

INSERT INTO `ekskul` (`id_ekskul`, `nama_ekskul`, `link_group`, `status`) VALUES
(1, 'ART MEDIA', 'https://chat.whatsapp.com/GNAsPE3QH6sGKWLlqv6UpT', 'aktif'),
(2, 'ENGLISH CLUB', NULL, 'aktif'),
(3, 'FUTSAL', NULL, 'aktif'),
(4, 'PASKIBRA', 'https://chat.whatsapp.com/BugGZiwS7M00gdSNzXzQLp', 'aktif'),
(5, 'PMR', NULL, 'aktif'),
(6, 'PRAMUKA', 'https://chat.whatsapp.com/GNAsPE3QH6sGKWLlqv6UpT', 'aktif'),
(7, 'SANGGAR SENI', NULL, 'aktif'),
(8, 'TAKRAW', NULL, 'aktif'),
(10, 'ROHIS AKHWAT', 'https://chat.whatsapp.com/GNAsPE3QH6sGKWLlqv6UpT', 'aktif'),
(11, 'ROHIS IKHWA', NULL, 'aktif'),
(12, 'ROKRIST', NULL, 'aktif'),
(13, 'EKSIS - MI', 'https://chat.whatsapp.com/GNAsPE3QH6sGKWLlqv6UpT', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id_pendaftaran` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `ekskul_1` int(11) DEFAULT NULL,
  `ekskul_2` int(11) DEFAULT NULL,
  `alasan_1` varchar(100) DEFAULT NULL,
  `alasan_tolak_1` text DEFAULT NULL,
  `alasan_2` varchar(100) DEFAULT NULL,
  `alasan_tolak_2` text DEFAULT NULL,
  `status_ekskul_1` enum('pending','diterima','ditolak') DEFAULT 'pending',
  `status_ekskul_2` enum('pending','diterima','ditolak') DEFAULT 'pending',
  `status_siswa_1` enum('aktif','pasif','keluar') DEFAULT 'aktif',
  `status_siswa_2` enum('aktif','pasif','keluar') DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id_pendaftaran`, `id`, `ekskul_1`, `ekskul_2`, `alasan_1`, `alasan_tolak_1`, `alasan_2`, `alasan_tolak_2`, `status_ekskul_1`, `status_ekskul_2`, `status_siswa_1`, `status_siswa_2`) VALUES
(3, 3, 10, NULL, 'ingin memperbaiki diri', 'tidak memenuhi kriteria', NULL, NULL, 'diterima', NULL, 'aktif', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','users') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'Superadmin', 'smksmutiarailmu@gmail.com', 'superadmin', 'admin'),
(3, 'Gilang', 'gilangryan.ken@gmail.com', '$2y$10$kBdD2bXvYtnAZUyidpAbDOeG9Byhn49FOfx2I.lmzreVRk/S6G7qi', 'users');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_ekskul`
--
ALTER TABLE `admin_ekskul`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `data_diri`
--
ALTER TABLE `data_diri`
  ADD PRIMARY KEY (`id_data`);

--
-- Indexes for table `ekskul`
--
ALTER TABLE `ekskul`
  ADD PRIMARY KEY (`id_ekskul`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_ekskul`
--
ALTER TABLE `admin_ekskul`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_diri`
--
ALTER TABLE `data_diri`
  MODIFY `id_data` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ekskul`
--
ALTER TABLE `ekskul`
  MODIFY `id_ekskul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id_pendaftaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
