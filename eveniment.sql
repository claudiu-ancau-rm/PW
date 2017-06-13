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
-- Table structure for table `eveniment`
--

CREATE TABLE `eveniment` (
  `id_eveniment` int(5) NOT NULL,
  `nume_eveniment` varchar(25) NOT NULL,
  `data` date NOT NULL,
  `categorie` varchar(10) NOT NULL,
  `locatia` varchar(20) NOT NULL,
  `id_utilizator` int(5) NOT NULL,
  `detalii` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eveniment`
--

INSERT INTO `eveniment` (`id_eveniment`, `nume_eveniment`, `data`, `categorie`, `locatia`, `id_utilizator`, `detalii`) VALUES
(104, 'Concert muzica clasica', '2017-01-21', '', '', 0, ' '),
(105, 'Cinema', '2017-01-22', '', '', 0, 'Actiune'),
(109, 'Opereta', '2017-01-21', '', '', 0, ' '),
(112, 'Teatru', '2017-01-23', '', '', 0, ' '),
(113, 'Proiectie film', '2017-01-23', '', '', 0, 'Filme vechi'),
(114, 'Teatru', '2017-01-22', '', '', 0, ' '),
(118, '', '0000-00-00', 'Izabella', 'a', 1, 'a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eveniment`
--
ALTER TABLE `eveniment`
  ADD PRIMARY KEY (`id_eveniment`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eveniment`
--
ALTER TABLE `eveniment`
  MODIFY `id_eveniment` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
