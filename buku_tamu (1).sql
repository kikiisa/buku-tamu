-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2024 at 12:52 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buku_tamu`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(75) NOT NULL,
  `category` char(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `category`) VALUES
(1, 'bisnis'),
(2, 'resmi'),
(3, 'umum'),
(4, 'pelajar / mahasiswa');

-- --------------------------------------------------------

--
-- Table structure for table `ttamu`
--

CREATE TABLE `ttamu` (
  `id` int(3) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `nope` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `asal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ttamu`
--

INSERT INTO `ttamu` (`id`, `tanggal`, `nama`, `kategori_id`, `alamat`, `tujuan`, `nope`, `image`, `asal`) VALUES
(25, '2024-01-27', 'Pratiwi Bayahu', 2, 'Pentadio', 'STTD', '081319100186', 'image/65b4eda856a80.png', 'Pentadio'),
(26, '2024-01-29', 'kikiikikikik', 4, 'ikikikiki', 'kikikikikik', 'ikikikikiki', 'image/65b78d6453bfd.png', 'kikikikiki');

-- --------------------------------------------------------

--
-- Table structure for table `tuser`
--

CREATE TABLE `tuser` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `nama_pengguna` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tuser`
--

INSERT INTO `tuser` (`id_user`, `username`, `password`, `nama_pengguna`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ttamu`
--
ALTER TABLE `ttamu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tuser`
--
ALTER TABLE `tuser`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ttamu`
--
ALTER TABLE `ttamu`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tuser`
--
ALTER TABLE `tuser`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
