-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 24, 2025 at 05:06 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pobus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `username`, `password`, `level`, `created_at`) VALUES
(3, 'admin', 'admin@gmail.com', 'admin', '$2y$10$3gQuUbfBCgTMOcuQ.t5sF.1z0u0/f7lJ/0SiiUNVpt/LT3iLx9D36', 'admin', '2025-09-19 13:03:10');

-- --------------------------------------------------------

--
-- Table structure for table `pobus_bus`
--

CREATE TABLE `pobus_bus` (
  `bus_id` int UNSIGNED NOT NULL,
  `nama_bus` varchar(100) NOT NULL,
  `tipe` varchar(100) NOT NULL,
  `kapasitas` int NOT NULL,
  `kategori` enum('Non Ekonomi','Ekonomi') NOT NULL,
  `rute_id` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pobus_bus`
--

INSERT INTO `pobus_bus` (`bus_id`, `nama_bus`, `tipe`, `kapasitas`, `kategori`, `rute_id`) VALUES
(1, 'PO Rosalia Indah', 'Super Executive AC', 32, 'Non Ekonomi', 1),
(2, 'PO Gunung Harta', 'Executive AC', 34, 'Non Ekonomi', 2),
(3, 'PO Pahala Kencana', 'Executive AC', 36, 'Non Ekonomi', 3),
(4, 'PO Sinar Jaya', 'Double Decker Executive AC', 42, 'Non Ekonomi', 4),
(5, 'PO Handoyo', 'Executive AC', 36, 'Non Ekonomi', 5),
(6, 'PO Borlindo', 'Executive AC', 34, 'Non Ekonomi', 6),
(7, 'PO Primajasa', 'Executive AC', 40, 'Non Ekonomi', 7),
(8, 'PO Bintang Timur', 'Executive AC', 36, 'Non Ekonomi', 8),
(9, 'PO Maju Lancar', 'Ekonomi AC', 48, 'Ekonomi', 9),
(10, 'PO Rosalia Indah', 'Ekonomi AC', 50, 'Ekonomi', 10),
(11, 'PO Gunung Harta', 'Ekonomi AC', 46, 'Ekonomi', 11),
(12, 'PO Handoyo', 'Ekonomi AC', 50, 'Ekonomi', 12),
(13, 'PO Pahala Kencana', 'Ekonomi AC', 49, 'Ekonomi', 13),
(14, 'PO Medan Jaya', 'Ekonomi AC', 52, 'Ekonomi', 14),
(15, 'PO Budiman', 'Ekonomi AC', 48, 'Ekonomi', 15),
(16, 'PO Sinar Jaya', 'Ekonomi AC', 50, 'Ekonomi', 16);

-- --------------------------------------------------------

--
-- Table structure for table `pobus_rute`
--

CREATE TABLE `pobus_rute` (
  `rute_id` int UNSIGNED NOT NULL,
  `asal` varchar(100) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `jarak_km` int DEFAULT NULL,
  `harga` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pobus_rute`
--

INSERT INTO `pobus_rute` (`rute_id`, `asal`, `tujuan`, `jarak_km`, `harga`) VALUES
(1, 'Jakarta', 'Surabaya', 780, 150000),
(2, 'Denpasar', 'Jakarta', 1150, 160000),
(3, 'Jakarta', 'Malang', 670, 175000),
(4, 'Bandung', 'Semarang', 450, 180000),
(5, 'Semarang', 'Jakarta', 450, 190000),
(6, 'Makassar', 'Palopo', 320, 200000),
(7, 'Jakarta', 'Garut', 120, 210000),
(8, 'Medan', 'Pekanbaru', 1050, 220000),
(9, 'Jakarta', 'Purwokerto', 410, 230000),
(10, 'Solo', 'Jakarta', 540, 240000),
(11, 'Denpasar', 'Surabaya', 450, 250000),
(12, 'Semarang', 'Bandung', 420, 260000),
(13, 'Jakarta', 'Madura', 650, 270000),
(14, 'Medan', 'Pekanbaru', 1050, 280000),
(15, 'Tasikmalaya', 'Jakarta', 180, 290000),
(16, 'Jakarta', 'Purwokerto', 410, 300000);

-- --------------------------------------------------------

--
-- Table structure for table `pobus_tiket`
--

CREATE TABLE `pobus_tiket` (
  `tiket_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `nama_pemesan` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telpn` varchar(20) NOT NULL,
  `bus_id` int UNSIGNED DEFAULT NULL,
  `rute_id` int UNSIGNED DEFAULT NULL,
  `tgl_berangkat` date NOT NULL,
  `jam_berangkat` time NOT NULL,
  `harga` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pobus_tiket`
--

INSERT INTO `pobus_tiket` (`tiket_id`, `user_id`, `nama_pemesan`, `alamat`, `no_telpn`, `bus_id`, `rute_id`, `tgl_berangkat`, `jam_berangkat`, `harga`, `created_at`) VALUES
(14, 1, 'saiya', 'Grogol', '083367238758', 10, 4, '2025-09-24', '03:33:00', 180000, '2025-09-24 11:46:02'),
(15, 1, 'klio', 'Klaten', '086676438758', 2, 6, '2025-09-24', '05:55:00', 200000, '2025-09-24 12:55:39'),
(16, 3, 'alucard', 'Jogja', '08763555356', 4, 13, '2025-09-24', '06:59:00', 270000, '2025-09-24 12:57:50'),
(17, 2, 'papa', 'Semarang', '0876655544555', 6, 12, '2025-09-24', '05:44:00', 260000, '2025-09-24 15:22:19');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `username`, `password`, `level`) VALUES
(1, 'nana', 'nana@gmail.com', 'nana', '$2y$10$9gkSFfoVYC5mfqBmnZVboO/g3Zv7JhyZBWda6B507AG754wNzlk0m', 'user'),
(2, 'papa', 'papa@gmail.com', 'papa', '$2y$10$7umbg8K2G9EmhPqRH02SIuYvkRyV65d6M.r7PWKmjTEiBSLB5cZYi', 'user'),
(3, 'alucard', 'alucard@gmail.com', 'alucard', '$2y$10$i12jCnkik4fYWIBpMKNZWOwD9blhfZhf/M.6/mozwZgXgGYJqm15G', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `pobus_bus`
--
ALTER TABLE `pobus_bus`
  ADD PRIMARY KEY (`bus_id`),
  ADD KEY `rute_id` (`rute_id`);

--
-- Indexes for table `pobus_rute`
--
ALTER TABLE `pobus_rute`
  ADD PRIMARY KEY (`rute_id`);

--
-- Indexes for table `pobus_tiket`
--
ALTER TABLE `pobus_tiket`
  ADD PRIMARY KEY (`tiket_id`),
  ADD KEY `bus_id` (`bus_id`),
  ADD KEY `rute_id` (`rute_id`),
  ADD KEY `fk_tiket_user` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pobus_bus`
--
ALTER TABLE `pobus_bus`
  MODIFY `bus_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pobus_rute`
--
ALTER TABLE `pobus_rute`
  MODIFY `rute_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pobus_tiket`
--
ALTER TABLE `pobus_tiket`
  MODIFY `tiket_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pobus_bus`
--
ALTER TABLE `pobus_bus`
  ADD CONSTRAINT `pobus_bus_ibfk_1` FOREIGN KEY (`rute_id`) REFERENCES `pobus_rute` (`rute_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pobus_tiket`
--
ALTER TABLE `pobus_tiket`
  ADD CONSTRAINT `fk_tiket_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pobus_tiket_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `pobus_bus` (`bus_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `pobus_tiket_ibfk_2` FOREIGN KEY (`rute_id`) REFERENCES `pobus_rute` (`rute_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
