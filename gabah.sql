-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 03 Jan 2016 pada 02.29
-- Versi Server: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gabah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(2) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `nama`, `username`, `password`, `status`) VALUES
(1, 'Super Admin', 'hanyasaya', 'sayahanya', 1),
(2, 'Admin', 'hanyaadmin', 'adminhanya', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jurnal`
--

CREATE TABLE `tbl_jurnal` (
  `id` int(11) NOT NULL,
  `periode` int(4) NOT NULL,
  `kode` char(5) NOT NULL,
  `tanggal` date NOT NULL,
  `nomor_bukti` char(5) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `bertambah` double NOT NULL DEFAULT '0',
  `berkurang` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_laba_rugi`
--

CREATE TABLE `tbl_laba_rugi` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `kode` char(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `penjualan` decimal(10,0) NOT NULL DEFAULT '0',
  `hpp` decimal(10,0) NOT NULL DEFAULT '0',
  `biaya` decimal(10,0) NOT NULL DEFAULT '0',
  `berubah` decimal(10,0) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_laba_rugi`
--

INSERT INTO `tbl_laba_rugi` (`id`, `status`, `kode`, `nama`, `penjualan`, `hpp`, `biaya`, `berubah`) VALUES
(1, 3, '00008', 'Gabah Bulog', '0', '0', '0', '0'),
(2, 3, '00009', 'Gabah Pasar', '0', '0', '0', '0'),
(3, 2, '00010', 'Persediaan awal Bulog', '0', '0', '0', '0'),
(4, 1, '00011', 'ATK', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_neraca`
--

CREATE TABLE `tbl_neraca` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `kode` char(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `saldo_aset` decimal(10,0) NOT NULL DEFAULT '0',
  `saldo_kewajiban` decimal(10,0) NOT NULL DEFAULT '0',
  `berubah` decimal(10,0) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_neraca`
--

INSERT INTO `tbl_neraca` (`id`, `status`, `kode`, `nama`, `saldo_aset`, `saldo_kewajiban`, `berubah`) VALUES
(1, 5, '00001', 'Kas (Perusahaan)', '0', '0', '0'),
(2, 5, '00002', 'Kas Bank Mega', '0', '0', '0'),
(3, 5, '00003', 'Kas BRI', '0', '0', '0'),
(4, 5, '00004', 'Persediaan', '0', '0', '0'),
(5, 4, '00005', 'Hutang Usaha', '0', '0', '0'),
(6, 4, '00006', 'Hutang Non Usaha', '0', '0', '0'),
(7, 4, '00007', 'Hutang Bank Mega', '0', '0', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rekening`
--

CREATE TABLE `tbl_rekening` (
  `id` int(11) NOT NULL,
  `id_rek_induk` int(11) NOT NULL,
  `kode` char(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `status` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_rekening`
--

INSERT INTO `tbl_rekening` (`id`, `id_rek_induk`, `kode`, `nama`, `status`) VALUES
(17, 1, '00001', 'Kas (Perusahaan)', 5),
(18, 1, '00002', 'Kas Bank Mega', 5),
(19, 1, '00003', 'Kas BRI', 5),
(20, 1, '00004', 'Persediaan', 5),
(21, 1, '00005', 'Hutang Usaha', 4),
(22, 1, '00006', 'Hutang Non Usaha', 4),
(23, 1, '00007', 'Hutang Bank Mega', 4),
(24, 2, '00008', 'Gabah Bulog', 3),
(25, 2, '00009', 'Gabah Pasar', 3),
(26, 2, '00010', 'Persediaan awal Bulog', 2),
(27, 2, '00011', 'ATK', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rekening_induk`
--

CREATE TABLE `tbl_rekening_induk` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_rekening_induk`
--

INSERT INTO `tbl_rekening_induk` (`id`, `nama`) VALUES
(1, 'Neraca'),
(2, 'Laba Rugi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_saldo_awal`
--

CREATE TABLE `tbl_saldo_awal` (
  `id` int(11) NOT NULL,
  `periode` int(4) NOT NULL,
  `kode` char(5) NOT NULL,
  `bertambah` decimal(10,0) NOT NULL DEFAULT '0',
  `berkurang` decimal(10,0) NOT NULL DEFAULT '0',
  `saldo` decimal(10,0) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_saldo_awal`
--

INSERT INTO `tbl_saldo_awal` (`id`, `periode`, `kode`, `bertambah`, `berkurang`, `saldo`) VALUES
(25, 2016, '00001', '15000000', '0', '15000000'),
(26, 2016, '00002', '3000000', '0', '3000000'),
(27, 2016, '00003', '5000000', '0', '5000000'),
(28, 2016, '00007', '200000', '0', '200000'),
(29, 2016, '00012', '2000000', '0', '2000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_jurnal`
--
ALTER TABLE `tbl_jurnal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_laba_rugi`
--
ALTER TABLE `tbl_laba_rugi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_neraca`
--
ALTER TABLE `tbl_neraca`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rekening`
--
ALTER TABLE `tbl_rekening`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rekening_induk`
--
ALTER TABLE `tbl_rekening_induk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_saldo_awal`
--
ALTER TABLE `tbl_saldo_awal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_jurnal`
--
ALTER TABLE `tbl_jurnal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_laba_rugi`
--
ALTER TABLE `tbl_laba_rugi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_neraca`
--
ALTER TABLE `tbl_neraca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_rekening`
--
ALTER TABLE `tbl_rekening`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `tbl_rekening_induk`
--
ALTER TABLE `tbl_rekening_induk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_saldo_awal`
--
ALTER TABLE `tbl_saldo_awal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
