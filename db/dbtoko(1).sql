-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 28, 2015 at 03:39 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbtoko`
--
CREATE DATABASE IF NOT EXISTS `dbtoko` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dbtoko`;

-- --------------------------------------------------------

--
-- Table structure for table `tblbarang`
--

CREATE TABLE IF NOT EXISTS `tblbarang` (
  `idBarang` varchar(10) NOT NULL,
  `namaBarang` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` float NOT NULL,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`idBarang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbarang`
--

INSERT INTO `tblbarang` (`idBarang`, `namaBarang`, `deskripsi`, `kategori`, `jumlah`, `harga`, `foto`) VALUES
('b01', 'Jam Mahal', 'Jam yang mahal', 'jam tangan', 12, 1290000, 'image/19_10_1.jpg'),
('b02', 'Pakaian mini', 'Pakaian yang minimalis', 'pakaian perempuan', 8, 150000, 'image/product_26__1_7.jpg'),
('b03', 'pakaian minim', 'Pakaian yang minim', 'pakaian perempuan', 13, 130000, 'image/product_24__1_12.jpg'),
('b04', 'cincin mahal', 'perhiasan', 'perhiasan', 3, 590000, 'image/1_4.jpg'),
('b05', 'unknown', 'mahal', 'perhiasan', 5, 339000, 'image/13_2_2.jpg'),
('b06', 'jam murah', 'murah ', 'jam tangan', 30, 100000, 'image/15_2.jpg'),
('b07', 'jam ori', 'jam original', 'jam tangan', 4, 989000, 'image/16_3.jpg'),
('b08', 'Pakaian perempuan', 'perempuan', 'pakaian perempuan', 14, 200000, 'image/product_27__1_6.jpg'),
('b09', 'pakaian pink', 'berwarna pink', 'pakaian perempuan', 17, 259000, 'image/product_52__2.jpg'),
('b10', 'Gelang Antik', 'gelang wwwww', 'perhiasan', 6, 890000, 'image/5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblkategori`
--

CREATE TABLE IF NOT EXISTS `tblkategori` (
  `kategori` varchar(100) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblkategori`
--

INSERT INTO `tblkategori` (`kategori`, `keterangan`) VALUES
('jam tangan', 'oi oi'),
('pakaian perempuan', 'untuk perempuan'),
('perhiasan', 'Cocok untuk dibawa sekolah dan terlihat mbois');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
