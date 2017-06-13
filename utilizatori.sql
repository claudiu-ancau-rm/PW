-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2017 at 12:58 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eveniment`
--

-- --------------------------------------------------------

--
-- Table structure for table `utilizatori`
--

CREATE TABLE `utilizatori` (
  `id_utilizator` int(5) UNSIGNED NOT NULL,
  `nume_utilizator` varchar(10) NOT NULL,
  `parola` int(6) NOT NULL,
  `email` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utilizatori`
--

INSERT INTO `utilizatori` (`id_utilizator`, `nume_utilizator`, `parola`, `email`) VALUES
(7, '', 0, NULL),
(8, '', 0, NULL),
(9, '', 0, NULL),
(11, '', 0, NULL),
(12, '', 0, NULL),
(13, '', 0, NULL),
(14, '1', 0, NULL),
(15, 'claudiu', 0, NULL),
(16, '', 0, NULL),
(17, 'claudiu', 1234, NULL),
(18, 'claudiu', 1234, NULL),
(20, 'claudiu', 1234, 'claudiu@gmail.com'),
(22, ' ', 0, 'a'),
(23, ' ', 0, 'a'),
(24, ' ', 0, 'a'),
(25, ' ', 0, 'a'),
(26, ' ', 0, 'a'),
(27, 'Claudiu 12', 0, 'Izabella'),
(28, 'Claudiu', 123, 'Izabella'),
(29, 'Claudiu', 123, 'Izabella'),
(32, 'Claudiu', 123, 'Izabella'),
(34, 'Claudiu', 1234, 'Izabella'),
(35, '31,Claudiu', 1234, 'Izabella'),
(36, '31,Claudiu', 1234, 'Izabella'),
(38, 'Claudiu', 1234, 'Izabella'),
(39, 'Claudiu', 1234, 'Izabella'),
(40, 'Claudiu', 1234, 'Izabella'),
(41, 'Claudiu', 2323, 'Izabella'),
(42, 'Claudiu', 1234, ''),
(44, 'Claudiu', 1234, 'Izabella'),
(45, 'Claudiu', 1234, 'Izabella'),
(46, 'Claudiu', 1234, 'Izabella'),
(47, 'Claudiu', 1234, 'Izabella'),
(48, 'Claudiu', 1234, 'Izabella'),
(49, 'Claudiu', 1234, 'Izabella'),
(50, 'Claudiu', 1234, 'Izabella'),
(51, 'Claudiu', 1234, 'Izabella'),
(52, 'Claudiu', 1234, 'Izabella'),
(53, 'Claudiu', 1234, 'Izabella'),
(54, 'call', 1234, 'Izabella'),
(55, 'call', 1234, 'Izabella');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `utilizatori`
--
ALTER TABLE `utilizatori`
  ADD PRIMARY KEY (`id_utilizator`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `utilizatori`
--
ALTER TABLE `utilizatori`
  MODIFY `id_utilizator` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
