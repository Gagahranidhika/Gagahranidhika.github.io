-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2024 at 04:41 PM
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
-- Database: `akun`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_akun`
--

CREATE TABLE `data_akun` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `usia` int(10) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_akun`
--

INSERT INTO `data_akun` (`id`, `nama`, `usia`, `email`, `pass`) VALUES
(8, 'dika', 20, '2309106034@gmail.com', '$2y$10$dWYesFl0.zDfSe3OLv'),
(9, 'udin', 21, 'udin@gmail.com', '$2y$10$cDHqVR/d5e4eoj.9fj'),
(12, 'udin', 33, 'udin1@gmail.com', '$2y$10$MPbITpmVQimJF0FJxf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_akun`
--
ALTER TABLE `data_akun`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_akun`
--
ALTER TABLE `data_akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
