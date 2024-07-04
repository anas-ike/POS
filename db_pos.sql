-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 30, 2024 at 02:53 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` varchar(100) NOT NULL,
  `barcode` varchar(20) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga_beli` int NOT NULL,
  `harga_jual` int NOT NULL,
  `stock` int NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `stock_minimal` int NOT NULL,
  `gambar` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `barcode`, `nama_barang`, `harga_beli`, `harga_jual`, `stock`, `satuan`, `stock_minimal`, `gambar`) VALUES
('BRG-001', '123213213', 'Dompet', 10000, 20000, 20, 'piece', 5, 'default-brg.png'),
('BRG-002', '3434234324', 'Teh Pucuk Harum', 2500, 5000, 10, 'botol', 10, 'BRG-002.png'),
('BRG-003', '9123982831829', 'Mizone', 3500, 6000, 0, 'botol', 5, 'BRG-003.png'),
('BRG-004', '823948938942', 'Coca Cola', 4000, 5000, 0, 'botol', 5, 'BRG-004-447.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_beli_detail`
--

CREATE TABLE `tbl_beli_detail` (
  `id` int NOT NULL,
  `no_beli` varchar(20) NOT NULL,
  `tgl_beli` date NOT NULL,
  `kode_brg` varchar(10) NOT NULL,
  `nama_brg` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `qty` int NOT NULL,
  `harga_beli` int NOT NULL,
  `jml_harga` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_beli_detail`
--

INSERT INTO `tbl_beli_detail` (`id`, `no_beli`, `tgl_beli`, `kode_brg`, `nama_brg`, `qty`, `harga_beli`, `jml_harga`) VALUES
(4, 'PB0001', '2024-06-28', 'BRG-002', 'teh pucuk harum', 2, 2500, 5000),
(6, 'PB0001', '2024-06-28', 'BRG-001', 'dompet', 5, 10000, 50000),
(7, 'PB0002', '2024-06-28', 'BRG-002', 'teh pucuk harum', 5, 2500, 12500),
(8, 'PB0002', '2024-06-28', 'BRG-001', 'dompet', 1, 10000, 10000),
(9, 'PB0003', '2024-06-28', 'BRG-001', 'dompet', 5, 10000, 50000),
(10, 'PB0003', '2024-06-28', 'BRG-002', 'teh pucuk harum', 7, 2500, 17500),
(11, 'PB0004', '2024-06-28', 'BRG-003', 'Buku', 3, 10000, 30000),
(12, 'PB0004', '2024-06-28', 'BRG-001', 'dompet', 1, 10000, 10000),
(23, 'PB0006', '2024-06-06', 'BRG-001', 'dompet', 2, 10000, 20000),
(24, 'PB0006', '2024-06-06', 'BRG-002', 'teh pucuk harum', 2, 2500, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_beli_head`
--

CREATE TABLE `tbl_beli_head` (
  `no_beli` varchar(20) NOT NULL,
  `tgl_beli` date NOT NULL,
  `supplier` varchar(256) NOT NULL,
  `total` int NOT NULL,
  `keterangan` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_beli_head`
--

INSERT INTO `tbl_beli_head` (`no_beli`, `tgl_beli`, `supplier`, `total`, `keterangan`) VALUES
('PB0001', '2024-06-28', 'PT Japfa', 55000, ''),
('PB0002', '2024-06-28', 'PT Japfa', 22500, ''),
('PB0003', '2024-06-28', 'PT Japfa', 67500, ''),
('PB0004', '2024-06-28', 'PT Adi Kusuma Wijaya', 40000, ''),
('PB0006', '2024-06-06', 'PT Japfa', 25000, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id_customer` int NOT NULL,
  `nama` varchar(256) NOT NULL,
  `telpon` varchar(25) NOT NULL,
  `deskripsi` varchar(256) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id_customer`, `nama`, `telpon`, `deskripsi`, `alamat`) VALUES
(3, 'Umum', '123123123', 'Umum', 'Jalan Umum'),
(4, 'Customer Lain', '123123123', 'Customer Lain', 'Jalan Lain');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jual_detail`
--

CREATE TABLE `tbl_jual_detail` (
  `id` int NOT NULL,
  `no_jual` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tgl_jual` date NOT NULL,
  `barcode` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nama_brg` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `qty` int NOT NULL,
  `harga_jual` int NOT NULL,
  `jml_harga` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_jual_detail`
--

INSERT INTO `tbl_jual_detail` (`id`, `no_jual`, `tgl_jual`, `barcode`, `nama_brg`, `qty`, `harga_jual`, `jml_harga`) VALUES
(2, 'PJ0001', '2024-06-29', '3434234324', 'teh pucuk harum', 2, 5000, 10000),
(3, 'PJ0001', '2024-06-29', '12413423432', 'Buku', 2, 12000, 24000),
(5, 'PJ0002', '2024-06-29', '123213213', 'dompet', 3, 20000, 60000),
(6, 'PJ0002', '2024-06-29', '3434234324', 'teh pucuk harum', 3, 5000, 15000),
(8, 'PJ0003', '2024-06-30', '3434234324', 'teh pucuk harum', 2, 5000, 10000),
(9, 'PJ0004', '2024-06-30', '3434234324', 'teh pucuk harum', 1, 5000, 5000),
(10, 'PJ0005', '2024-06-30', '3434234324', 'teh pucuk harum', 1, 5000, 5000),
(11, 'PJ0006', '2024-06-30', '123213213', 'dompet', 5, 20000, 100000),
(12, 'PJ0006', '2024-06-30', '3434234324', 'teh pucuk harum', 1, 5000, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jual_head`
--

CREATE TABLE `tbl_jual_head` (
  `no_jual` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tgl_jual` date NOT NULL,
  `customer` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `total` int NOT NULL,
  `keterangan` varchar(256) NOT NULL,
  `jml_bayar` int NOT NULL,
  `kembalian` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_jual_head`
--

INSERT INTO `tbl_jual_head` (`no_jual`, `tgl_jual`, `customer`, `total`, `keterangan`, `jml_bayar`, `kembalian`) VALUES
('PJ0001', '2024-06-29', 'Umum', 34000, '', 50000, 16000),
('PJ0002', '2024-06-29', 'Umum', 75000, '', 100000, 25000),
('PJ0003', '2024-06-30', 'Umum', 10000, '', 20000, 10000),
('PJ0004', '2024-06-30', 'Umum', 5000, '', 5000, 0),
('PJ0005', '2024-06-30', 'Umum', 5000, '', 10000, 5000),
('PJ0006', '2024-06-30', 'Umum', 105000, '', 150000, 45000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `id_supplier` int NOT NULL,
  `nama` varchar(256) NOT NULL,
  `telpon` varchar(25) NOT NULL,
  `deskripsi` varchar(256) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`id_supplier`, `nama`, `telpon`, `deskripsi`, `alamat`) VALUES
(1, 'PT Japfa', '07182382923', 'Distr', 'Jalan jalan'),
(5, 'PT Adi Kusuma Wijaya', '23423943289', 'Y', 'Dimana aja');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userid` int NOT NULL,
  `username` varchar(30) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `address` varchar(100) NOT NULL,
  `level` int NOT NULL COMMENT '1-admin\r\n2-supervisor\r\n3-operator',
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userid`, `username`, `fullname`, `password`, `address`, `level`, `foto`) VALUES
(5, 'admin', 'administrator', '$2y$10$GxyJEg/q66IMW0dlDPODZ.qtymZq1Y4BYskZRBU0dgXf6pGW/dU4u', 'asd\r\n', 1, '906-gambar.png'),
(6, 'supervisor', 'supervisor', '$2y$10$3s.UYN7IP4c3MM1z36Zmt.wXqb23IEh1g3mTcErV5KWPTx9K1l6Ke', 'Jalan Supervisor', 2, '645-gambar.png'),
(8, 'operator', 'operator', '$2y$10$6T4clEazOpAcFX8tQyBQYOafGnIyya2.wN5tdOiP//P5uToEvEA3u', 'Jalan Operator', 3, '166-gambar.png'),
(9, 'dosen', 'Dosen', '$2y$10$6.MXBhYcsTtlJP6DA2JBy.UeDzhuUd9I/H/lKYaOchTuLZewz/pli', 'Jalan jalan', 1, 'default-user.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tbl_beli_detail`
--
ALTER TABLE `tbl_beli_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_beli_head`
--
ALTER TABLE `tbl_beli_head`
  ADD PRIMARY KEY (`no_beli`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `tbl_jual_detail`
--
ALTER TABLE `tbl_jual_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_jual_head`
--
ALTER TABLE `tbl_jual_head`
  ADD PRIMARY KEY (`no_jual`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_beli_detail`
--
ALTER TABLE `tbl_beli_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id_customer` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_jual_detail`
--
ALTER TABLE `tbl_jual_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `id_supplier` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
