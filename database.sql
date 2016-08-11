-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 08, 2016 at 09:07 PM
-- Server version: 5.7.13-0ubuntu0.16.04.2
-- PHP Version: 7.0.8-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-budgeting`
--
CREATE DATABASE IF NOT EXISTS `e-budgeting` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `e-budgeting`;

-- --------------------------------------------------------

--
-- Table structure for table `komponen_sub_var_guna`
--

CREATE TABLE `komponen_sub_var_guna` (
  `kd_komp_sub_var_guna` int(5) NOT NULL,
  `kd_sub_var_guna_keluar` int(5) NOT NULL,
  `nama_komp_sub_var_guna` varchar(50) NOT NULL,
  `satuan` int(6) DEFAULT NULL,
  `harga` int(8) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komponen_sub_var_guna`
--

INSERT INTO `komponen_sub_var_guna` (`kd_komp_sub_var_guna`, `kd_sub_var_guna_keluar`, `nama_komp_sub_var_guna`, `satuan`, `harga`, `jumlah`) VALUES
(1, 1, 'Konsumsi Rapat', 10, 20000, 200000),
(2, 1, 'ATK', 16, 15000, 240000),
(4, 1, 'Penggandaan Dokumen KKM', 15, 6000, 90000),
(5, 3, 'Konsumsi Rapat', 30, 20000, 600000),
(6, 3, 'ATK', 45, 5000, 225000),
(7, 3, 'penggandaan dokumen', 90, 7000, 630000),
(8, 4, 'Pelaksanaan Bimbel sukses UN', 12, 15000, 180000);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria_keluar`
--

CREATE TABLE `kriteria_keluar` (
  `kd_kriteria_keluar` int(5) NOT NULL,
  `nama_kriteria_keluar` varchar(30) NOT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria_keluar`
--

INSERT INTO `kriteria_keluar` (`kd_kriteria_keluar`, `nama_kriteria_keluar`, `jumlah`) VALUES
(1, 'PROGRAM SEKOLAH', 100000000),
(2, 'BELANJA LAINNYA', 135000000);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria_masuk`
--

CREATE TABLE `kriteria_masuk` (
  `kd_kriteria` int(5) NOT NULL,
  `nama_kriteria_masuk` varchar(30) NOT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria_masuk`
--

INSERT INTO `kriteria_masuk` (`kd_kriteria`, `nama_kriteria_masuk`, `jumlah`) VALUES
(1, 'SISA DANA TAHUN LALU', 10000000),
(2, 'DANA DARI PEMERINTAH', 150000000),
(3, 'ORANG TUA SISWA/KOMITE', 75000000);

-- --------------------------------------------------------

--
-- Table structure for table `pengambilan_dana`
--

CREATE TABLE `pengambilan_dana` (
  `kd_pengambilan_dana` int(11) NOT NULL,
  `kd_var_guna_masuk` int(5) NOT NULL,
  `kd_komp_sub_var_guna` int(5) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengambilan_dana`
--

INSERT INTO `pengambilan_dana` (`kd_pengambilan_dana`, `kd_var_guna_masuk`, `kd_komp_sub_var_guna`, `jumlah`) VALUES
(1, 1, 1, 20000),
(2, 2, 2, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `sub_komponen_sub_var_guna`
--

CREATE TABLE `sub_komponen_sub_var_guna` (
  `kd_sub_komp_sub_var_guna` int(5) NOT NULL,
  `kd_komp_sub_var_guna` int(5) NOT NULL,
  `nama_sub_komp_sub_var_guna` varchar(50) NOT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_komponen_sub_var_guna`
--

INSERT INTO `sub_komponen_sub_var_guna` (`kd_sub_komp_sub_var_guna`, `kd_komp_sub_var_guna`, `nama_sub_komp_sub_var_guna`, `jumlah`) VALUES
(1, 8, 'konsumsi pembimbing', 50000),
(2, 8, 'ATK', 40000),
(3, 8, 'pengadaan bahan bimbingan', 90000);

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `kd_sub_kriteria` int(5) NOT NULL,
  `kd_kriteria` int(5) NOT NULL,
  `nama_sub_kriteria` varchar(50) NOT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`kd_sub_kriteria`, `kd_kriteria`, `nama_sub_kriteria`, `jumlah`) VALUES
(1, 2, 'RUTIN', 100000000),
(2, 2, 'BANTUAN OPERASIONAL SEKOLAH BOS', 20000000),
(3, 2, 'BANTUAN', 30000000),
(4, 3, 'Dana Operasional sekolah', 25000000),
(5, 3, 'Dana Pengembangan Sarpras', 30000000),
(6, 3, 'Dana Komputer', 20000000);

-- --------------------------------------------------------

--
-- Table structure for table `sub_var_guna_keluar`
--

CREATE TABLE `sub_var_guna_keluar` (
  `kd_sub_var_guna_keluar` int(5) NOT NULL,
  `kd_var_guna_keluar` int(5) NOT NULL,
  `nama_sub_var_guna_keluar` varchar(50) NOT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_var_guna_keluar`
--

INSERT INTO `sub_var_guna_keluar` (`kd_sub_var_guna_keluar`, `kd_var_guna_keluar`, `nama_sub_var_guna_keluar`, `jumlah`) VALUES
(1, 1, 'Penyusunan Kriteria Ketuntasan Minimal', 2500000),
(3, 1, 'penyusunan kriteria kenaikan kelas dan kelulusan', 2000000),
(4, 1, 'Bimbel Sukses UN', 500000);

-- --------------------------------------------------------

--
-- Table structure for table `tim_rkaas`
--

CREATE TABLE `tim_rkaas` (
  `id_tim_RKAAS` int(9) NOT NULL,
  `username` varchar(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `status` enum('ketua','anggota') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tim_rkaas`
--

INSERT INTO `tim_rkaas` (`id_tim_RKAAS`, `username`, `nama`, `password`, `status`) VALUES
(2, 'anggota', 'Anggota', 'dfb9e85bc0da607ff76e0559c62537e8', 'anggota'),
(6, 'ketua', 'Ketua', '00719910bb805741e4b7f28527ecb3ad', 'ketua');

-- --------------------------------------------------------

--
-- Table structure for table `variabel_guna_keluar`
--

CREATE TABLE `variabel_guna_keluar` (
  `kd_var_guna_keluar` int(5) NOT NULL,
  `kd_kriteria_keluar` int(5) NOT NULL,
  `nama_var_guna_keluar` varchar(50) NOT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `variabel_guna_keluar`
--

INSERT INTO `variabel_guna_keluar` (`kd_var_guna_keluar`, `kd_kriteria_keluar`, `nama_var_guna_keluar`, `jumlah`) VALUES
(1, 1, 'Pengembangan Kompetensi Lulusan', 5000000),
(2, 1, 'Pengembangan standar isi', 500000),
(3, 1, 'Pengembangan Standar Proses', 7000000),
(4, 1, 'Pengembangan pendidikdan tenaga kependidikan', 20000000),
(5, 1, 'Pengembangan sarana dan prasarana sekolah', 50000000),
(6, 1, 'Pengembangan Standar pengelolaan', 3000000),
(7, 1, 'pengembangan standar pembiayaan', 4000000),
(8, 1, 'Pengembangan dan implementasi sistem penilaian', 6000000),
(9, 2, 'Gaji PNS dan Tunjangannya', 105000000),
(10, 2, 'Honor PTT', 15000000),
(11, 2, 'Honor GTT', 10000000),
(12, 2, 'Honor Tugas Tambahan', 5000000);

-- --------------------------------------------------------

--
-- Table structure for table `variabel_guna_masuk`
--

CREATE TABLE `variabel_guna_masuk` (
  `kd_var_guna_masuk` int(5) NOT NULL,
  `kd_sub_kriteria` int(5) NOT NULL,
  `nama_var_guna_masuk` varchar(50) NOT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `variabel_guna_masuk`
--

INSERT INTO `variabel_guna_masuk` (`kd_var_guna_masuk`, `kd_sub_kriteria`, `nama_var_guna_masuk`, `jumlah`) VALUES
(1, 1, 'GAJI PNS', 70000000),
(2, 1, 'DANA RUTIN', 15000000),
(3, 1, 'Fasilitas Penelitian', 10000000),
(4, 1, 'Sanitasi', 5000000),
(5, 2, 'PUSAT', 20000000),
(6, 3, 'DAK', 20000000),
(7, 3, 'BANSOS', 10000000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `komponen_sub_var_guna`
--
ALTER TABLE `komponen_sub_var_guna`
  ADD PRIMARY KEY (`kd_komp_sub_var_guna`),
  ADD KEY `kd_sub_var_guna_keluar` (`kd_sub_var_guna_keluar`);

--
-- Indexes for table `kriteria_keluar`
--
ALTER TABLE `kriteria_keluar`
  ADD PRIMARY KEY (`kd_kriteria_keluar`);

--
-- Indexes for table `kriteria_masuk`
--
ALTER TABLE `kriteria_masuk`
  ADD PRIMARY KEY (`kd_kriteria`);

--
-- Indexes for table `pengambilan_dana`
--
ALTER TABLE `pengambilan_dana`
  ADD PRIMARY KEY (`kd_pengambilan_dana`),
  ADD KEY `kd_var_guna_masuk` (`kd_var_guna_masuk`),
  ADD KEY `kd_komp_sub_var_guna` (`kd_komp_sub_var_guna`);

--
-- Indexes for table `sub_komponen_sub_var_guna`
--
ALTER TABLE `sub_komponen_sub_var_guna`
  ADD PRIMARY KEY (`kd_sub_komp_sub_var_guna`),
  ADD KEY `kd_komp_sub_var_guna` (`kd_komp_sub_var_guna`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`kd_sub_kriteria`),
  ADD KEY `kd_kriteria` (`kd_kriteria`);

--
-- Indexes for table `sub_var_guna_keluar`
--
ALTER TABLE `sub_var_guna_keluar`
  ADD PRIMARY KEY (`kd_sub_var_guna_keluar`),
  ADD KEY `kd_var_guna_keluar` (`kd_var_guna_keluar`);

--
-- Indexes for table `tim_rkaas`
--
ALTER TABLE `tim_rkaas`
  ADD PRIMARY KEY (`id_tim_RKAAS`);

--
-- Indexes for table `variabel_guna_keluar`
--
ALTER TABLE `variabel_guna_keluar`
  ADD PRIMARY KEY (`kd_var_guna_keluar`),
  ADD KEY `kd_kriteria_keluar` (`kd_kriteria_keluar`);

--
-- Indexes for table `variabel_guna_masuk`
--
ALTER TABLE `variabel_guna_masuk`
  ADD PRIMARY KEY (`kd_var_guna_masuk`),
  ADD KEY `kd_sub_kriteria` (`kd_sub_kriteria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `komponen_sub_var_guna`
--
ALTER TABLE `komponen_sub_var_guna`
  MODIFY `kd_komp_sub_var_guna` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `kriteria_keluar`
--
ALTER TABLE `kriteria_keluar`
  MODIFY `kd_kriteria_keluar` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kriteria_masuk`
--
ALTER TABLE `kriteria_masuk`
  MODIFY `kd_kriteria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pengambilan_dana`
--
ALTER TABLE `pengambilan_dana`
  MODIFY `kd_pengambilan_dana` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sub_komponen_sub_var_guna`
--
ALTER TABLE `sub_komponen_sub_var_guna`
  MODIFY `kd_sub_komp_sub_var_guna` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `kd_sub_kriteria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `sub_var_guna_keluar`
--
ALTER TABLE `sub_var_guna_keluar`
  MODIFY `kd_sub_var_guna_keluar` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tim_rkaas`
--
ALTER TABLE `tim_rkaas`
  MODIFY `id_tim_RKAAS` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `variabel_guna_keluar`
--
ALTER TABLE `variabel_guna_keluar`
  MODIFY `kd_var_guna_keluar` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `variabel_guna_masuk`
--
ALTER TABLE `variabel_guna_masuk`
  MODIFY `kd_var_guna_masuk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `komponen_sub_var_guna`
--
ALTER TABLE `komponen_sub_var_guna`
  ADD CONSTRAINT `komponen_sub_var_guna_ibfk_1` FOREIGN KEY (`kd_sub_var_guna_keluar`) REFERENCES `sub_var_guna_keluar` (`kd_sub_var_guna_keluar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengambilan_dana`
--
ALTER TABLE `pengambilan_dana`
  ADD CONSTRAINT `pengambilan_dana_ibfk_1` FOREIGN KEY (`kd_var_guna_masuk`) REFERENCES `variabel_guna_masuk` (`kd_var_guna_masuk`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengambilan_dana_ibfk_2` FOREIGN KEY (`kd_komp_sub_var_guna`) REFERENCES `komponen_sub_var_guna` (`kd_komp_sub_var_guna`) ON DELETE CASCADE;

--
-- Constraints for table `sub_komponen_sub_var_guna`
--
ALTER TABLE `sub_komponen_sub_var_guna`
  ADD CONSTRAINT `sub_komponen_sub_var_guna_ibfk_1` FOREIGN KEY (`kd_komp_sub_var_guna`) REFERENCES `komponen_sub_var_guna` (`kd_komp_sub_var_guna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`kd_kriteria`) REFERENCES `kriteria_masuk` (`kd_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_var_guna_keluar`
--
ALTER TABLE `sub_var_guna_keluar`
  ADD CONSTRAINT `sub_var_guna_keluar_ibfk_1` FOREIGN KEY (`kd_var_guna_keluar`) REFERENCES `variabel_guna_keluar` (`kd_var_guna_keluar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `variabel_guna_keluar`
--
ALTER TABLE `variabel_guna_keluar`
  ADD CONSTRAINT `variabel_guna_keluar_ibfk_1` FOREIGN KEY (`kd_kriteria_keluar`) REFERENCES `kriteria_keluar` (`kd_kriteria_keluar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `variabel_guna_masuk`
--
ALTER TABLE `variabel_guna_masuk`
  ADD CONSTRAINT `variabel_guna_masuk_ibfk_1` FOREIGN KEY (`kd_sub_kriteria`) REFERENCES `sub_kriteria` (`kd_sub_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
