-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2024 at 08:50 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uniqlone`
--

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `kategori`, `deskripsi`, `gambar`) VALUES
(1, 'Blus Rayon Dasi Pita Lengan Panjang', 'Atasan', 'Blus Wanita yang terasa lembut saat disentuh. Tidak mudah kusut setelah dicuci, sehingga mudah perawatannya.', 'blus.avif'),
(2, 'T-Shirt Katun Lembut Stretch Kerah Bulat Lengan Panjang', 'Modest Wear', 'T-shirt Wanita yang klasik untuk kesempatan apapun. Terasa lembut dan lentur untuk fit yang nyaman.', 'sweater.avif'),
(3, 'Kardigan Proteksi Sinar UV Kerah Bulat Lengan Panjang (Garis)', 'Sweater & Kardigan', 'Cardigan Wanita dari bahan campuran katun-rayon yang lembut dan nyaman, juga dilengkapi fitur UV protection.', 'kardigan.avif'),
(4, 'Pullover Sweat Hoodie Lengan Panjang', 'Jaket Hoodie', 'Sweater Pria bertekstur halus dengan lapisan yang tidak mudah mencuat. Bagian tudung memiliki tampilan berkontur yang stylish.', 'hoodie.avif'),
(5, 'Gaun Katun Ringan Tanpa Lengan (Kotak)', 'Gaun', 'Gaun Wanita dari bahan 100% katun yang ringan dan nyaman. Siluet A-line yang bervolume.', 'gaun.avif'),
(6, 'Rok Panjang Denim', 'Rok', 'Rok Wanita dari bahan 100% katun denim dengan desain klasik 5 saku.', 'rok.avif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
