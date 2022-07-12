-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 12, 2022 at 08:11 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

DROP TABLE IF EXISTS `barang`;
CREATE TABLE IF NOT EXISTS `barang` (
  `idbarang` varchar(6) NOT NULL,
  `foto` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `deskripsi` varchar(65) CHARACTER SET latin1 NOT NULL,
  `pn_nsn` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `ds_number` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `holding` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `equipment_desc` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `store_location` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `supplementary_location` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `qty` float DEFAULT '0',
  `uoi` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `verwendung` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `idjenisbarang` varchar(6) CHARACTER SET latin1 NOT NULL,
  `idkapal` varchar(6) NOT NULL,
  PRIMARY KEY (`idbarang`),
  KEY `FK_barang_jenis` (`idjenisbarang`),
  KEY `FK_barang_kapal` (`idkapal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`idbarang`, `foto`, `deskripsi`, `pn_nsn`, `ds_number`, `holding`, `equipment_desc`, `store_location`, `supplementary_location`, `qty`, `uoi`, `verwendung`, `idjenisbarang`, `idkapal`) VALUES
('B00006', '', 'O RING', '98609000012', '', '', 'MPK', 'BOX 1', 'GUDANG SPARE', 0, 'EA', '', 'J00001', 'K00001'),
('B00007', '', 'MAIN BEARING TIEROD', '26001000800', '', '', 'MPK', 'BOX 1', 'GUDANG SPARE', 0, 'EA', '', 'J00001', 'K00001'),
('B00008', '', 'INNER SPRING', '26018010585', '', '', 'MPK', 'BOX 1', 'GUDANG SPARE', 0, 'EA', '', 'J00001', 'K00001'),
('B00009', '', 'OUTER SPRING', '26018010586', '', '', 'MPK', 'BOX 1', 'GUDANG SPARE', 0, 'EA', '', 'J00001', 'K00001'),
('B00010', '', 'HALF SHELL', '99526013009', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 0, 'EA', '', 'J00001', 'K00001'),
('B00011', '', 'GASKET', '9860900005', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 0, 'EA', '', 'J00001', 'K00001'),
('B00012', '', 'CIRCLIP', '00201010110', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 0, 'EA', '', 'J00001', 'K00001'),
('B00013', '', 'RECHANGER/SPARES', '333', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 0, 'EA', '', 'J00001', 'K00001'),
('B00014', '', 'EXTRATOR FOR INJECTION PUMP VALVE SEAT', 'T-266', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 0, 'EA', '', 'J00001', 'K00001'),
('B00015', '', 'LOWER UPPER BEARING SHELL', '00133675/91', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 0, 'EA', '', 'J00001', 'K00001'),
('B00016', '', 'POWER SUPPLAY 15V DC AE 24/15', 'ZZAUT000914', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 0, 'EA', '', 'J00001', 'K00001'),
('B00017', '', 'KIT NR 07196A', '98640401124', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 0, 'EA', '', 'J00001', 'K00001'),
('B00018', '', 'KEYBOARD', 'DV 3000', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 0, 'EA', '', 'J00001', 'K00001'),
('B00019', '', 'EXHAUST MANIFOLD GASKET', '26018000006', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 0, 'EA', '', 'J00001', 'K00001'),
('B00020', '', 'COMPRESSION RING', '26014000620', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 0, 'EA', '', 'J00001', 'K00001'),
('B00021', '', 'SCRAPER RING', '26014900020', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 0, 'EA', '', 'J00001', 'K00001'),
('B00022', '', 'ELECTRO VALVE', 'ZZAUT002JD3', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 0, 'EA', '', 'J00001', 'K00001'),
('B00023', '', 'JOINT 321365/001', '36040000064', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 0, 'EA', '', 'J00001', 'K00001'),
('B00024', '', 'ELECTRO DISTRIBUTOR', '514191027', '514191023', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 0, 'EA', 'BEKAS', 'J00001', 'K00001'),
('B00025', '', 'GASKET KIT', '98705912240', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 0, 'EA', '', 'J00001', 'K00001'),
('B00026', '', 'LEVEL SWITCH FLOAT FLANGEMOUNT', '5930AR0000495', '', '', 'MPK', 'BOX 3', 'GUDANG SPARE', 0, 'EA', '', 'J00001', 'K00001'),
('B00027', '', 'SAVETY VALVE', '4820AR0000877', '', '', 'MPK', 'BOX 3', 'GUDANG SPARE', 0, 'EA', '', 'J00001', 'K00001'),
('B00028', '', 'INJECTOR PIN', '26020000006', '', '', 'MPK', 'BOX 3', 'GUDANG SPARE', 0, 'EA', '', 'J00001', 'K00001'),
('B00029', '', 'LOCTITE 594', 'FR-99351200000', '', '', 'MPK', 'BOX 3', 'GUDANG SPARE', 0, 'EA', '', 'J00001', 'K00001'),
('B00030', '', 'LOCTITE 573', 'FR-99351320000', '', '', 'MPK', 'BOX 3', 'GUDANG SPARE', 0, 'EA', '', 'J00001', 'K00001'),
('B00031', '', 'LOCTITE 270', '', '', '', 'MPK', 'BOX 3', 'GUDANG SPARE', 0, 'EA', '', 'J00001', 'K00001'),
('B00032', '', 'MAIN BEARING SHELL', '26004805318', '', '', 'MPK', 'BOX 1', 'GUDANG SPARE', 0, 'EA', '', 'J00001', 'K00001'),
('B00033', '', 'SPRING COOLAR', '26018011365', '', '', 'MPK', 'BOX 1', 'GUDANG SPARE', 0, 'EA', '', 'J00001', 'K00001');

-- --------------------------------------------------------

--
-- Table structure for table `brg_keluar`
--

DROP TABLE IF EXISTS `brg_keluar`;
CREATE TABLE IF NOT EXISTS `brg_keluar` (
  `idbrg_keluar` varchar(6) NOT NULL,
  `idkapal` varchar(6) NOT NULL,
  `tgl` date NOT NULL,
  `idusers` varchar(20) NOT NULL,
  `alasan` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idbrg_keluar`),
  KEY `FK_brg_keluar_kapal` (`idkapal`),
  KEY `FK_brg_keluar_usr` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brg_keluar`
--

INSERT INTO `brg_keluar` (`idbrg_keluar`, `idkapal`, `tgl`, `idusers`, `alasan`) VALUES
('K00001', 'K00001', '2022-07-12', 'U00002', 'perobaan');

-- --------------------------------------------------------

--
-- Table structure for table `brg_keluar_detil`
--

DROP TABLE IF EXISTS `brg_keluar_detil`;
CREATE TABLE IF NOT EXISTS `brg_keluar_detil` (
  `idbrg_k_detil` varchar(8) NOT NULL,
  `idbarang` varchar(6) NOT NULL,
  `jumlah` float NOT NULL DEFAULT '0',
  `satuan` varchar(15) NOT NULL,
  `idbrg_keluar` varchar(6) NOT NULL,
  `alasan` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idbrg_k_detil`),
  KEY `FK_brg_keluar_detil_brg` (`idbarang`),
  KEY `FK_brg_keluar_detil_key` (`idbrg_keluar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brg_keluar_detil`
--

INSERT INTO `brg_keluar_detil` (`idbrg_k_detil`, `idbarang`, `jumlah`, `satuan`, `idbrg_keluar`, `alasan`) VALUES
('KD000001', 'B00006', 1, 'EA', 'K00001', 'Rusak');

-- --------------------------------------------------------

--
-- Table structure for table `brg_masuk`
--

DROP TABLE IF EXISTS `brg_masuk`;
CREATE TABLE IF NOT EXISTS `brg_masuk` (
  `idbrg_masuk` varchar(6) NOT NULL,
  `idkapal` varchar(6) NOT NULL,
  `tgl` date NOT NULL,
  `idusers` varchar(20) NOT NULL,
  PRIMARY KEY (`idbrg_masuk`),
  KEY `FK_brg_masuk_kapal` (`idkapal`),
  KEY `FK_brg_masuk_users` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brg_masuk`
--

INSERT INTO `brg_masuk` (`idbrg_masuk`, `idkapal`, `tgl`, `idusers`) VALUES
('M00001', 'K00001', '2022-07-08', 'U00002');

-- --------------------------------------------------------

--
-- Table structure for table `brg_masuk_cair`
--

DROP TABLE IF EXISTS `brg_masuk_cair`;
CREATE TABLE IF NOT EXISTS `brg_masuk_cair` (
  `idbrg_masuk` varchar(6) CHARACTER SET utf8mb4 NOT NULL,
  `idkapal` varchar(6) CHARACTER SET utf8mb4 NOT NULL,
  `tgl` date NOT NULL,
  `idusers` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`idbrg_masuk`),
  KEY `FK_brg_masuk_cair_kapal` (`idkapal`),
  KEY `FK_brg_masuk_cair_users` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `brg_masuk_detil`
--

DROP TABLE IF EXISTS `brg_masuk_detil`;
CREATE TABLE IF NOT EXISTS `brg_masuk_detil` (
  `idbrg_m_detil` varchar(8) NOT NULL,
  `idbarang` varchar(6) NOT NULL,
  `jumlah` float NOT NULL DEFAULT '0',
  `satuan` varchar(15) NOT NULL,
  `idbrg_masuk` varchar(6) NOT NULL,
  PRIMARY KEY (`idbrg_m_detil`),
  KEY `FK_brg_masuk_detil_brg` (`idbarang`),
  KEY `FK_brg_masuk_detil_key` (`idbrg_masuk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brg_masuk_detil`
--

INSERT INTO `brg_masuk_detil` (`idbrg_m_detil`, `idbarang`, `jumlah`, `satuan`, `idbrg_masuk`) VALUES
('MD000001', 'B00032', 1, 'EA', 'M00001'),
('MD000002', 'B00033', 12, 'EA', 'M00001'),
('MD000003', 'B00006', 4, 'EA', 'M00001'),
('MD000004', 'B00007', 2, 'EA', 'M00001'),
('MD000005', 'B00008', 6, 'EA', 'M00001'),
('MD000006', 'B00009', 6, 'EA', 'M00001'),
('MD000007', 'B00006', 2, 'EA', 'M00001'),
('MD000008', 'B00010', 12, 'EA', 'M00001'),
('MD000009', 'B00011', 2, 'EA', 'M00001'),
('MD000010', 'B00012', 2, 'EA', 'M00001'),
('MD000011', 'B00013', 1, 'EA', 'M00001'),
('MD000012', 'B00014', 1, 'EA', 'M00001'),
('MD000013', 'B00015', 2, 'EA', 'M00001'),
('MD000014', 'B00016', 1, 'EA', 'M00001'),
('MD000015', 'B00017', 10, 'EA', 'M00001'),
('MD000016', 'B00018', 1, 'EA', 'M00001'),
('MD000017', 'B00019', 1, 'EA', 'M00001'),
('MD000018', 'B00020', 2, 'EA', 'M00001'),
('MD000019', 'B00011', 2, 'EA', 'M00001'),
('MD000020', 'B00011', 2, 'EA', 'M00001'),
('MD000021', 'B00021', 2, 'EA', 'M00001'),
('MD000022', 'B00011', 2, 'EA', 'M00001'),
('MD000023', 'B00006', 1, 'EA', 'M00001'),
('MD000024', 'B00022', 3, 'EA', 'M00001'),
('MD000025', 'B00023', 1, 'EA', 'M00001'),
('MD000026', 'B00011', 39, 'EA', 'M00001'),
('MD000027', 'B00006', 6, 'EA', 'M00001'),
('MD000028', 'B00006', 12, 'EA', 'M00001'),
('MD000029', 'B00024', 11, 'EA', 'M00001'),
('MD000030', 'B00025', 2, 'EA', 'M00001'),
('MD000031', 'B00026', 1, 'EA', 'M00001'),
('MD000032', 'B00027', 3, 'EA', 'M00001'),
('MD000033', 'B00028', 66, 'EA', 'M00001'),
('MD000034', 'B00029', 6, 'EA', 'M00001'),
('MD000035', 'B00030', 12, 'EA', 'M00001'),
('MD000036', 'B00031', 3, 'EA', 'M00001');

-- --------------------------------------------------------

--
-- Table structure for table `brg_masuk_detil_cair`
--

DROP TABLE IF EXISTS `brg_masuk_detil_cair`;
CREATE TABLE IF NOT EXISTS `brg_masuk_detil_cair` (
  `idbrg_m_detil` varchar(8) CHARACTER SET utf8mb4 NOT NULL,
  `idbarang` varchar(6) CHARACTER SET utf8mb4 NOT NULL,
  `jumlah_minta` float NOT NULL DEFAULT '0',
  `jumlah_datang` float NOT NULL DEFAULT '0',
  `satuan` varchar(15) CHARACTER SET utf8mb4 NOT NULL,
  `file_bukti` varchar(150) DEFAULT NULL,
  `idbrg_masuk` varchar(6) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`idbrg_m_detil`),
  KEY `FK_brg_masuk_detil_cair_barang` (`idbarang`),
  KEY `FK_brg_masuk_detil_cair_key` (`idbrg_masuk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

DROP TABLE IF EXISTS `identitas`;
CREATE TABLE IF NOT EXISTS `identitas` (
  `kode` varchar(6) NOT NULL DEFAULT '0',
  `instansi` varchar(255) NOT NULL,
  `slogan` varchar(100) DEFAULT NULL,
  `tahun` float DEFAULT NULL,
  `pimpinan` varchar(150) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kdpos` varchar(7) DEFAULT NULL,
  `tlp` varchar(15) DEFAULT NULL,
  `fax` varchar(35) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `logo` longtext,
  `lat` varchar(45) DEFAULT NULL,
  `lon` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`kode`, `instansi`, `slogan`, `tahun`, `pimpinan`, `alamat`, `kdpos`, `tlp`, `fax`, `website`, `email`, `logo`, `lat`, `lon`) VALUES
('K00001', 'KOARMADA 2', 'Ghora Wira Madya Jala', 1985, 'Laksamana Muda TNI Iwan Isnurwanto, M.A.P., M.Tr.(Han).', 'Dermaga Ujung Surabaya, Jawa Timur', '60178', '08', '-', 'https://koarmada2.tnial.mil.id/', 'rampa@gmail.com', '1656081780_d4bf97842275cf4c6103.png', '-7.4063726', '112.5841074');

-- --------------------------------------------------------

--
-- Table structure for table `jenisbarang`
--

DROP TABLE IF EXISTS `jenisbarang`;
CREATE TABLE IF NOT EXISTS `jenisbarang` (
  `idjenisbarang` varchar(6) NOT NULL,
  `nama_jenis` varchar(45) NOT NULL,
  `idkapal` varchar(6) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`idjenisbarang`),
  KEY `FK_jenisbarang_kapal` (`idkapal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenisbarang`
--

INSERT INTO `jenisbarang` (`idjenisbarang`, `nama_jenis`, `idkapal`) VALUES
('J00001', 'Platform', 'K00001'),
('J00002', 'Sewaco', 'K00001'),
('J00003', 'Komaliwan', 'K00001'),
('J00004', 'Barang Umum', 'K00001'),
('J00005', 'Bahari', 'K00001'),
('J00006', 'Bahari', 'K00002');

-- --------------------------------------------------------

--
-- Table structure for table `kapal`
--

DROP TABLE IF EXISTS `kapal`;
CREATE TABLE IF NOT EXISTS `kapal` (
  `idkapal` varchar(6) NOT NULL,
  `nama_kapal` varchar(45) NOT NULL,
  `gambar` varchar(150) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`idkapal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kapal`
--

INSERT INTO `kapal` (`idkapal`, `nama_kapal`, `gambar`, `keterangan`) VALUES
('K00001', 'Dewaruci', '1656082231_2544998d662c894c180b.jpg', 'Gambar kapal dewaruci'),
('K00002', 'KRI B', '1656082238_ace2e7f0a1543f840dc1.jpg', ''),
('K00003', 'kri sultan hasanudin', '1656493858_0e0384b437dd3b25cd10.jpg', ''),
('K00004', 'KRI FKO', '', ''),
('K00005', 'KRI DPN-365', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `korps`
--

DROP TABLE IF EXISTS `korps`;
CREATE TABLE IF NOT EXISTS `korps` (
  `idkorps` varchar(6) CHARACTER SET utf8mb4 NOT NULL,
  `nama_korps` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`idkorps`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `korps`
--

INSERT INTO `korps` (`idkorps`, `nama_korps`) VALUES
('K00001', 'Laut (P)'),
('K00002', 'Laut (T)'),
('K00003', 'Laut (E)'),
('K00004', 'Laut (S)'),
('K00005', 'Laut (PM)'),
('K00006', 'Laut (K)'),
('K00007', 'Laut (KH)'),
('K00008', 'Marinir'),
('K00009', 'Bah'),
('K00010', 'Nav'),
('K00011', 'Kom'),
('K00012', 'Tlg'),
('K00013', 'Ekl'),
('K00014', 'Eko'),
('K00015', 'Mer'),
('K00016', 'Amo'),
('K00017', 'Rdl'),
('K00018', 'SAA'),
('K00019', 'SBA'),
('K00020', 'TRB'),
('K00021', 'Esa'),
('K00022', 'ETK'),
('K00023', 'PDK'),
('K00024', 'Jas'),
('K00025', 'Mus'),
('K00026', 'TTG'),
('K00027', 'Ttu'),
('K00028', 'Keu'),
('K00029', 'Mes'),
('K00030', 'Lis'),
('K00031', 'TKU'),
('K00032', 'MPU'),
('K00033', 'LPU'),
('K00034', 'Ang'),
('K00036', 'POM'),
('K00037', 'EDE'),
('K00038', 'Lek'),
('K00039', 'Pas'),
('K00040', 'PNS'),
('K00042', 'Tek'),
('K00043', 'Bek'),
('K00044', 'Adm');

-- --------------------------------------------------------

--
-- Table structure for table `pangkat`
--

DROP TABLE IF EXISTS `pangkat`;
CREATE TABLE IF NOT EXISTS `pangkat` (
  `idpangkat` varchar(6) CHARACTER SET utf8mb4 NOT NULL,
  `nama_pangkat` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`idpangkat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pangkat`
--

INSERT INTO `pangkat` (`idpangkat`, `nama_pangkat`) VALUES
('P00001', 'ADMINISTRATOR'),
('P00005', 'Laksma TNI'),
('P00010', 'Kolonel'),
('P00011', 'Letkol'),
('P00012', 'Mayor'),
('P00013', 'Kapten'),
('P00014', 'Lettu'),
('P00016', 'Peltu'),
('P00017', 'Pelda'),
('P00018', 'Serma'),
('P00019', 'Serka'),
('P00020', 'Sertu'),
('P00031', 'Penata Tk I III/d'),
('P00033', 'Penata III/C');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `idrole` varchar(6) CHARACTER SET utf8mb4 NOT NULL,
  `nama_role` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`idrole`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`idrole`, `nama_role`) VALUES
('R00001', 'ADMINISTRATOR'),
('R00002', 'Komandan'),
('R00003', 'Kepala gudang');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `idusers` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `nrp` varchar(15) CHARACTER SET utf8mb4 NOT NULL,
  `pass` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  `nama` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama` varchar(45) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kota_asal` varchar(45) CHARACTER SET utf8mb4 DEFAULT NULL,
  `foto` varchar(150) CHARACTER SET utf8mb4 DEFAULT NULL,
  `satuan_kerja` varchar(45) CHARACTER SET utf8mb4 DEFAULT NULL,
  `idrole` varchar(6) CHARACTER SET utf8mb4 NOT NULL,
  `idkapal` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`idusers`),
  KEY `FK_users_role` (`idrole`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idusers`, `nrp`, `pass`, `nama`, `tgl_lahir`, `agama`, `kota_asal`, `foto`, `satuan_kerja`, `idrole`, `idkapal`) VALUES
('U00001', 'ADMIN', 'aGtq', 'ADMIN', '1991-01-30', 'Islam', 'Surabaya', './assets/images/e7118256aaf4d1de09199e2b6cbe667c.png', 'TNI ANGKATAN LAUT', 'R00001', NULL),
('U00002', '111', 'aGtq', 'Rampa', '1989-08-02', 'Islam', 'Surabaya', '1656947456_64c14e624650113cae33.jpg', 'TNI', 'R00003', 'K00001'),
('U00003', '222', 'aGtq', 'Atika', NULL, NULL, NULL, NULL, NULL, 'R00002', 'K00001'),
('U00005', '444', 'aGtq', 'vhjv', NULL, NULL, NULL, NULL, NULL, 'R00003', 'K00002'),
('U00006', '555', 'aGtq', 'scscsx', NULL, NULL, NULL, NULL, NULL, 'R00003', 'K00001'),
('U00007', 'admin shn', 'aGtq', 'adiatma', NULL, NULL, NULL, NULL, NULL, 'R00003', 'K00003'),
('U00008', 'KRI DPN-365', 'aGtq', 'Naratama Yoga', NULL, NULL, NULL, NULL, NULL, 'R00003', 'K00004'),
('U00009', 'KRI FKO-368', 'aGtq', 'Koko Fajar Suharyogi', '0000-00-00', 'Islam', 'Blitar', NULL, 'Satkor Koarmada II', 'R00003', 'K00004');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `FK_barang_jenis` FOREIGN KEY (`idjenisbarang`) REFERENCES `jenisbarang` (`idjenisbarang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_barang_kapal` FOREIGN KEY (`idkapal`) REFERENCES `kapal` (`idkapal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `brg_keluar`
--
ALTER TABLE `brg_keluar`
  ADD CONSTRAINT `FK_brg_keluar_kapal` FOREIGN KEY (`idkapal`) REFERENCES `kapal` (`idkapal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_brg_keluar_usr` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `brg_keluar_detil`
--
ALTER TABLE `brg_keluar_detil`
  ADD CONSTRAINT `FK_brg_keluar_detil_brg` FOREIGN KEY (`idbarang`) REFERENCES `barang` (`idbarang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_brg_keluar_detil_key` FOREIGN KEY (`idbrg_keluar`) REFERENCES `brg_keluar` (`idbrg_keluar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `brg_masuk`
--
ALTER TABLE `brg_masuk`
  ADD CONSTRAINT `FK_brg_masuk_kapal` FOREIGN KEY (`idkapal`) REFERENCES `kapal` (`idkapal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_brg_masuk_users` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `brg_masuk_cair`
--
ALTER TABLE `brg_masuk_cair`
  ADD CONSTRAINT `FK_brg_masuk_cair_kapal` FOREIGN KEY (`idkapal`) REFERENCES `kapal` (`idkapal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_brg_masuk_cair_users` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `brg_masuk_detil`
--
ALTER TABLE `brg_masuk_detil`
  ADD CONSTRAINT `FK_brg_masuk_detil_brg` FOREIGN KEY (`idbarang`) REFERENCES `barang` (`idbarang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_brg_masuk_detil_key` FOREIGN KEY (`idbrg_masuk`) REFERENCES `brg_masuk` (`idbrg_masuk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `brg_masuk_detil_cair`
--
ALTER TABLE `brg_masuk_detil_cair`
  ADD CONSTRAINT `FK_brg_masuk_detil_cair_barang` FOREIGN KEY (`idbarang`) REFERENCES `barang` (`idbarang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_brg_masuk_detil_cair_key` FOREIGN KEY (`idbrg_masuk`) REFERENCES `brg_masuk_cair` (`idbrg_masuk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jenisbarang`
--
ALTER TABLE `jenisbarang`
  ADD CONSTRAINT `FK_jenisbarang_kapal` FOREIGN KEY (`idkapal`) REFERENCES `kapal` (`idkapal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_users_role` FOREIGN KEY (`idrole`) REFERENCES `role` (`idrole`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
