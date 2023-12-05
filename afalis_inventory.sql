-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2023 at 07:42 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `afalis_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `b_barcode` varchar(50) NOT NULL,
  `b_nama` varchar(100) NOT NULL,
  `s_kode` varchar(20) NOT NULL,
  `k_id` int(11) NOT NULL,
  `b_stok` int(11) NOT NULL,
  `sa_id` int(11) NOT NULL,
  `b_harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`b_barcode`, `b_nama`, `s_kode`, `k_id`, `b_stok`, `sa_id`, `b_harga`) VALUES
('0468947686', 'Zinc Black Shine Shampo 100ml', '0946289657788', 15, 60, 1, 24000),
('54375733567', 'Samsung Galaxy S22 Ultra', '8798', 3, 27, 1, 15000000),
('65666674550', 'Samsung Galaxy S21 Plus', '8798', 3, 40, 1, 9000000),
('657478648678', 'Samsung Galaxy S20 Snapdragon', '8798', 3, 53, 1, 7000000),
('96809680980', 'Gatsby Side Blow Mat & Hard 25g', '468765887', 11, 54, 1, 15000);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `k_id` int(11) NOT NULL,
  `k_nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`k_id`, `k_nama`) VALUES
(2, 'makanan dan minuman'),
(3, 'handphone'),
(10, 'aksesoris wanita'),
(11, 'perawatan tubuh'),
(12, 'gerabah'),
(13, 'sabun mandi'),
(14, 'sabun cuci'),
(15, 'shampo'),
(16, 'jam tangan');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `sa_id` int(11) NOT NULL,
  `sa_nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`sa_id`, `sa_nama`) VALUES
(1, 'pcs'),
(2, 'kg'),
(3, 'liter'),
(4, 'ml'),
(5, 'lusin'),
(6, 'box'),
(7, 'ons'),
(8, 'meter');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `s_kode` varchar(20) NOT NULL,
  `s_nama` varchar(100) NOT NULL,
  `s_rek` varchar(20) NOT NULL,
  `s_alamat` text NOT NULL,
  `s_telp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`s_kode`, `s_nama`, `s_rek`, `s_alamat`, `s_telp`) VALUES
('0946289657788', 'Cashews', '2147483647', 'Bandung', '089879870989'),
('09843927695465', 'Infinix Indoneisa', '47635626', 'Banten', '085784673563'),
('468765887', 'Gatsby', '2147483647', 'Surabaya', '087896767786'),
('486467564675467', 'Nuget Chicken', '2147483647', 'Jakarta', '086575467476'),
('686787686', 'Indofood', '0', 'Jakarta', '081284558889'),
('8798', 'Samsung Mobile Phone', '0', 'Jakarta', '082177980987'),
('9056830953786', 'Realme Indonesia', '0', 'Batam', '085465456835'),
('97098785985798678', 'Casio Indonesia', '2147483647', 'Banten', '087890878686');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `t_inv` varchar(50) NOT NULL,
  `b_barcode` varchar(50) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `t_nama` varchar(100) NOT NULL,
  `t_telp` varchar(13) NOT NULL,
  `t_tgl` datetime NOT NULL,
  `t_jenis` enum('masuk','keluar') NOT NULL,
  `t_jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`t_inv`, `b_barcode`, `nik`, `t_nama`, `t_telp`, `t_tgl`, `t_jenis`, `t_jumlah`) VALUES
('07987987', '54375733567', '1', 'Fattur', '08129256544', '2022-12-28 00:00:00', 'masuk', 2),
('INV-K54375733567-202', '54375733567', '2', 'Tuti', '0896765677786', '2023-01-16 00:00:00', 'keluar', 23),
('INV-K657478648678-20', '657478648678', '2', 'Tuti', '0896765677786', '2023-01-16 00:00:00', 'keluar', 10),
('INV-M0468947686-2023', '0468947686', '1', 'Arisa', '081976786786', '2023-01-26 00:00:00', 'masuk', 40),
('INV-M0468947686-20230126-120524', '0468947686', '1', 'Asasad', '085867474764', '2023-01-26 00:00:00', 'masuk', 20),
('INV-M54375733567-202', '54375733567', '2', 'Rani', '087906969799', '2023-01-16 00:00:00', 'masuk', 50),
('INV-M6566667455090-2', '65666674550', '1', 'Alisaiyu', '088796876575', '2023-01-26 00:00:00', 'masuk', 30),
('INV-M657478648678-20', '657478648678', '2', 'Rani', '087906969799', '2023-01-16 00:00:00', 'masuk', 50),
('INV-M657478648678-20230126-120319', '657478648678', '1', 'Asassd', '083563563456', '2023-01-26 00:00:00', 'masuk', 5),
('INV-M96809680980869-', '96809680980', '1', 'Arisa', '081976786786', '2023-01-26 00:00:00', 'masuk', 20),
('INV-M96809680980869-20230126-120524', '96809680980', '1', 'Asasad', '085867474764', '2023-01-26 00:00:00', 'masuk', 34),
('K657478648678-230318104641', '657478648678', '1', 'ghth', '09988889789', '2023-03-18 10:46:41', 'keluar', 6),
('M6566667455090-230201185155', '65666674550', '1', 'Rediu', '081276884457', '2023-02-01 18:51:55', 'masuk', 5),
('M657478648678-230201-184943', '657478648678', '1', 'Guisos', '0812423546576', '2023-02-01 18:49:43', 'masuk', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `nik` varchar(16) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(13) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('superadmin','admin','member') NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`nik`, `nama`, `alamat`, `telp`, `username`, `password`, `level`, `foto`) VALUES
('1', 'Superadmin', '0', '0000', 'Superadmin', 'dddcdaa8264e6d96baadd43f324fbd83', 'superadmin', 'user.png'),
('2', 'Admin', 'Wonosobo', '0000', 'Admin', 'e3afed0047b08059d0fada10f400c1e5', 'admin', 'user.png'),
('3', 'Admin', 'Wonosobo', '0000', 'Member', '858ba4765e53c712ef672a9570474b1d', 'admin', 'user.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`b_barcode`),
  ADD KEY `s_kode` (`s_kode`),
  ADD KEY `sa_id` (`sa_id`),
  ADD KEY `k_id` (`k_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`k_id`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`sa_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`s_kode`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`t_inv`),
  ADD KEY `b_barcode` (`b_barcode`),
  ADD KEY `nik` (`nik`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`nik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `k_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `sa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`s_kode`) REFERENCES `supplier` (`s_kode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_ibfk_3` FOREIGN KEY (`k_id`) REFERENCES `kategori` (`k_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_ibfk_4` FOREIGN KEY (`sa_id`) REFERENCES `satuan` (`sa_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`b_barcode`) REFERENCES `barang` (`b_barcode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`nik`) REFERENCES `users` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
