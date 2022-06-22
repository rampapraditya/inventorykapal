-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 22, 2022 at 05:40 PM
-- Server version: 10.3.34-MariaDB-cll-lve
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pramedia_inv`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `idbarang` varchar(6) NOT NULL,
  `foto` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `deskripsi` varchar(65) CHARACTER SET latin1 NOT NULL,
  `pn_nsn` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `ds_number` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `holding` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `equipment_desc` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `store_location` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `supplementary_location` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `qty` float DEFAULT 0,
  `uoi` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `verwendung` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `idjenisbarang` varchar(6) CHARACTER SET latin1 NOT NULL,
  `idkapal` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`idbarang`, `foto`, `deskripsi`, `pn_nsn`, `ds_number`, `holding`, `equipment_desc`, `store_location`, `supplementary_location`, `qty`, `uoi`, `verwendung`, `idjenisbarang`, `idkapal`) VALUES
('B00001', '', 'CU INTERFACE BOARD', '341519-001L2', 'K101625', '2-EA', 'DECOY', 'RAK 9A', 'NAVAL STORE', 1, 'EA', 'DI AMBIL LTT ZULKAIDAR  (16-04-19)', 'J00002', 'K00001'),
('B00002', '', 'POWER SUPPLY MODULE', '4662288C', 'K100791', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00001'),
('B00003', '', 'POWER SUPPY UNIT-INTN', '606488-00', 'K100762', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 2, 'EA', '', 'J00002', 'K00001'),
('B00004', '', 'HEATER PANEL ASSY.', '602953-00', 'K100775', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00001'),
('B00005', '', 'VIKTOR MK 4 TRANDUCER', '4718450344', 'K101525', '', 'HULL MOUNTED SONAR', 'RAK 9A', 'NAVAL STORE', 2, 'EA', '', 'J00002', 'K00001'),
('B00006', '', 'ELECTROMECHANICAL', '47229238AH', 'K100414', '', 'HULL MOUNTED SONAR', 'RAK 7A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00001'),
('B00007', '', 'CAPACITOR MODULE', '56950517AA01', 'K100454', '', 'HULL MOUNTED SONAR', 'RAK 9A', 'NAVAL STORE', 1, 'EA', 'di ambil sertu AGUS S (12-01-19)', 'J00002', 'K00001'),
('B00008', '', 'EQUIPPED CHASSIS', '61559321AA', 'K100815', '', 'IFF', 'RAK9A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00001'),
('B00009', '', 'SENSOR', '352250057061', 'K10101007', '', 'MW-08', 'RAK 7A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00001'),
('B00010', '', 'GROUND CABLE', '14100029075', 'K101471', '', 'SSM MISSILE WEAPON SYSTEM', 'RAK 8A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00001'),
('B00011', '', 'FANS ASSEMBLY', '14100015789', 'K101450', '', 'SSM MISSILE WEAPON SYSTEM', 'RAK 8A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00001'),
('B00012', '', 'AMMUNITION 115 V - 400 PSU', '676-70/YI-3593', 'K101455', '', 'SSM MISSILE WEAPON SYSTEM', 'RAK 8A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00001'),
('B00013', '', 'CABINET TOOL CASE', '1410006129', 'K101661', '', 'SSM MISSILE WEAPON SYSTEM', 'RAK 8A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00001'),
('B00014', '', 'CPU/DISPLAY PANEL ASSY.', 'WTP089800001', 'K100903', '', 'TORPEDO LAUNCHING SYSTEM', 'RAK 8A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00001'),
('B00015', '', 'R.A. CO. MB', '955672108600', 'K100616', '', 'BTS NAVRAD', 'RAK 7A', 'NAVAL STORE', 2, 'EA', '', 'J00002', 'K00001'),
('B00016', '', 'RTV MOD 18', '955673147100', 'K100638', '', 'BTS NAVRAD', 'RAK 7A', 'NAVAL STORE', 2, 'EA', '', 'J00002', 'K00001'),
('B00017', '', 'VME-10D15', '955672111700', 'K100619', '', 'BTS SAM', 'RAK 7A', 'NAVAL STORE', 2, 'EA', '', 'J00002', 'K00001'),
('B00018', '', 'DSU 1 (MW-08)', '9556-811-201XX', 'K101648', '', 'COMMAND AND CONTROL SYSTEM', 'RAK 8A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00001'),
('B00019', '', 'LIU RELAY BOARD', '261048-001', 'K101075', '', 'DECOY', 'RAK 8A', 'NAVAL STORE', 3, 'EA', '', 'J00002', 'K00001'),
('B00020', '', 'LIU POWER MODULE IN ', '261056-001', 'K101085', '', 'DECOY', 'RAK 8A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00001'),
('B00021', '', 'TFT COLOUR LCD DISPLAY 12.1', '', 'K101629', '', 'DECOY', 'RAK 8A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00001'),
('B00022', '', 'LIU CPU MODULE WITH WINDOWS XP', '', 'K101078', '', 'DECOY', 'RAK 8A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00001'),
('B00023', '', 'RELAY BRD', '955672120400', 'K101015', '', 'EGCC', 'RAK 7A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00001'),
('B00024', '', 'EXITER MODULE', '700141-536-00A', 'K100780', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 2, 'EA', '', 'J00002', 'K00001'),
('B00025', '', 'MAIN POWER SUPPLY MODULE', '4662295C', 'K100790', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00001'),
('B00026', '', 'DSP MODULE', '700084-536-002', 'K100457', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 2, 'EA', '', 'J00002', 'K00001'),
('B00027', '', 'RECEIVER MODULE', '700108-536-001', 'K100779', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 2, 'EA', '', 'J00002', 'K00001'),
('B00028', '', 'PRESPOT SELECTOR MODULE', '60477501', 'K100764', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00001'),
('B00029', '', 'PEC TRIPLEXER ACU 50', '602353-00', 'K100771', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00001'),
('B00030', '', 'SYNTHESIZER MODULE OCXO', '70109-536-002', 'K100760', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 2, 'EA', '', 'J00002', 'K00001'),
('B00031', '', 'CPU MODULE', '700137-536002', 'K100782', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 2, 'EA', '', 'J00002', 'K00001'),
('B00032', '', 'PCRRV SENSE', '602356-00', 'K100774', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00001'),
('B00033', '', 'POWER SUPPLY UNIT', '606488-00', 'K100762', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00001'),
('B00034', '', 'AUDIO FREQUENCY MODULE', '4662290C', 'K100788', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00001'),
('B00035', '', 'PEC DISTRIBUTION', '606083-00', 'K100753', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00001'),
('B00036', '', 'PEC EXCITER', '', 'K100754', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 2, 'EA', '', 'J00002', 'K00001'),
('B00037', '', 'EXCITER MODULE', '700141536004', 'K100780', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00001'),
('B00038', '', 'LUPS 24 V', 'LK1601-7ERP104', 'K100457', '', 'HULL MOUNTED SONAR', 'RAK 7A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00001'),
('B00039', '', 'K. MULTIPL', '916973152300', 'K100486', '', 'LIROD MK2', 'RAK 7A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00001'),
('B00040', '', 'PDK 35 BRD', '955672800000', 'K101050', '', 'MOC-L', 'RAK 7A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00001'),
('B00041', 'geoculus.jpg', 'CU INTERFACE BOARD', '341519-001L2', 'K101625', '2-EA', 'DECOY', 'RAK 9A', 'NAVAL STORE', 1, 'EA', 'DI AMBIL LTT ZULKAIDAR  (16-04-19)', 'J00002', 'K00003'),
('B00042', '', 'POWER SUPPLY MODULE', '4662288C', 'K100791', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00003'),
('B00043', '', 'POWER SUPPY UNIT-INTN', '606488-00', 'K100762', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 2, 'EA', '', 'J00002', 'K00003'),
('B00044', '', 'HEATER PANEL ASSY.', '602953-00', 'K100775', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00003'),
('B00045', '', 'VIKTOR MK 4 TRANDUCER', '4718450344', 'K101525', '', 'HULL MOUNTED SONAR', 'RAK 9A', 'NAVAL STORE', 2, 'EA', '', 'J00002', 'K00003'),
('B00046', '', 'ELECTROMECHANICAL', '47229238AH', 'K100414', '', 'HULL MOUNTED SONAR', 'RAK 7A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00003'),
('B00047', '', 'CAPACITOR MODULE', '56950517AA01', 'K100454', '', 'HULL MOUNTED SONAR', 'RAK 9A', 'NAVAL STORE', 1, 'EA', 'di ambil sertu AGUS S (12-01-19)', 'J00002', 'K00003'),
('B00048', '', 'EQUIPPED CHASSIS', '61559321AA', 'K100815', '', 'IFF', 'RAK9A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00003'),
('B00049', '', 'SENSOR', '352250057061', 'K10101007', '', 'MW-08', 'RAK 7A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00003'),
('B00050', '', 'GROUND CABLE', '14100029075', 'K101471', '', 'SSM MISSILE WEAPON SYSTEM', 'RAK 8A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00003'),
('B00051', '', 'FANS ASSEMBLY', '14100015789', 'K101450', '', 'SSM MISSILE WEAPON SYSTEM', 'RAK 8A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00003'),
('B00052', '', 'AMMUNITION 115 V - 400 PSU', '676-70/YI-3593', 'K101455', '', 'SSM MISSILE WEAPON SYSTEM', 'RAK 8A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00003'),
('B00053', '', 'CABINET TOOL CASE', '1410006129', 'K101661', '', 'SSM MISSILE WEAPON SYSTEM', 'RAK 8A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00003'),
('B00054', '', 'CPU/DISPLAY PANEL ASSY.', 'WTP089800001', 'K100903', '', 'TORPEDO LAUNCHING SYSTEM', 'RAK 8A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00003'),
('B00055', '', 'R.A. CO. MB', '955672108600', 'K100616', '', 'BTS NAVRAD', 'RAK 7A', 'NAVAL STORE', 2, 'EA', '', 'J00002', 'K00003'),
('B00056', '', 'RTV MOD 18', '955673147100', 'K100638', '', 'BTS NAVRAD', 'RAK 7A', 'NAVAL STORE', 2, 'EA', '', 'J00002', 'K00003'),
('B00057', '', 'VME-10D15', '955672111700', 'K100619', '', 'BTS SAM', 'RAK 7A', 'NAVAL STORE', 2, 'EA', '', 'J00002', 'K00003'),
('B00058', '', 'DSU 1 (MW-08)', '9556-811-201XX', 'K101648', '', 'COMMAND AND CONTROL SYSTEM', 'RAK 8A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00003'),
('B00059', '', 'LIU RELAY BOARD', '261048-001', 'K101075', '', 'DECOY', 'RAK 8A', 'NAVAL STORE', 3, 'EA', '', 'J00002', 'K00003'),
('B00060', '', 'LIU POWER MODULE IN ', '261056-001', 'K101085', '', 'DECOY', 'RAK 8A', 'NAVAL STORE', 1, 'EA', '', 'J00002', 'K00003'),
('B00061', 'java.png', 'NO', 'DESCRIPTION', 'PN/NSN', 'DS NUMBER', 'Holding', 'EQUIPMENT DESCRIPTION', 'STORE  LOCATION', 0, 'QUANT', 'UOI', 'J00001', 'K00004'),
('B00062', '', '1', 'TEMPERATURE TRANSMITTER', '6685 AR 0000483', '', '', 'MPK', 'BOX 1', 0, '1', 'EA', 'J00001', 'K00004'),
('B00063', '', '2', 'FILTER LCP MPK', '', '', '', 'MPK', 'BOX 1', 0, '3', 'EA', 'J00001', 'K00004'),
('B00064', '', '3', 'PRESSURE TRANSMITTER 10 BAR', 'FR-98711000001', '', '', 'MPK', 'BOX 1', 0, '1', 'EA', 'J00001', 'K00004'),
('B00065', '', '4', 'RING', '6H9691', '', '', 'MPK', 'BOX 1', 0, '4', 'EA', 'J00001', 'K00004'),
('B00066', '', '5', 'GASKET', 'FR-00651303840', '', '', 'MPK', 'BOX 1', 0, '3', 'EA', 'J00001', 'K00004'),
('B00067', '', '6', 'AIR HOSE PIPE 7 BAR', '', '', '', 'MPK', 'BOX 1', 0, '8', 'EA', 'J00001', 'K00004'),
('B00068', '', '7', 'PRESSURE SWITCH 2.0-42 BAR SPDT', '5930AR0000491', '', '', 'MPK', 'BOX 1', 0, '1', 'EA', 'J00001', 'K00004'),
('B00069', '', '8', 'TEMPERATURE SENSOR PT 100 PROBE', '6685AR0000041', '', '', 'MPK', 'BOX 1', 0, '4', 'EA', 'J00001', 'K00004'),
('B00070', '', '9', 'FREQUENCY DIVIDER PREAMP', '5999AR0000029', '', '', 'MPK', 'BOX 1', 0, '1', 'EA', 'J00001', 'K00004'),
('B00071', '', '10', 'ORING', '1800-05224', '', '', 'MPK', 'BOX 1', 0, '2', 'EA', 'J00001', 'K00004'),
('B00072', '', '11', 'SPEED SENSOR', '6680AR0000018', '', '', 'MPK', 'BOX 1', 0, '1', 'EA', 'J00001', 'K00004'),
('B00073', '', '12', 'MANOMETER 6 BAR', '', '', '', 'MPK', 'BOX 1', 0, '1', 'EA', 'J00001', 'K00004'),
('B00074', '', '13', 'THERMOMETER 50C', '', '', '', 'MPK', 'BOX 1', 0, '4', 'EA', 'J00001', 'K00004'),
('B00075', '', '14', 'THERMOMETER 120C', '', '', '', 'MPK', 'BOX 1', 0, '4', 'EA', 'J00001', 'K00004'),
('B00076', '', '15', 'THERMOMETER 160C', '', '', '', 'MPK', 'BOX 1', 0, '2', 'EA', 'J00001', 'K00004'),
('B00077', '', 'NO', 'DESCRIPTION', 'PN/NSN', 'DS NUMBER', 'Holding', 'EQUIPMENT DESCRIPTION', 'STORE  LOCATION', 0, 'QUANT', 'UOI', 'J00002', 'K00004'),
('B00078', '', '1', 'BLOWER ', '3522-500-43852', 'K100997', '', 'LIROD MK2', 'RAK 1A', 0, '9', 'EA', 'J00002', 'K00004'),
('B00079', '', '2', 'BLOWER', '3522-500-55091', 'K101006', '', 'MOC-L', 'RAK 1A', 0, '2', 'EA', 'J00002', 'K00004'),
('B00080', '', '3', 'POWER SUPPY ', '3522-500-57029', 'K100478', '', 'LINKY-TERM', 'RAK 1A', 0, '3', 'EA', 'J00002', 'K00004'),
('B00081', '', '4', 'BLOWER', '3522-500-25193', 'K100995', '', 'LIROD MK2', 'RAK 1A', 0, '1', 'EA', 'J00002', 'K00004'),
('B00082', '', '5', 'SCREW DRIVER ', '3522-589-20366', '', '', '', 'RAK 1A', 0, '1', 'EA', 'J00002', 'K00004'),
('B00083', '', '6', 'SCREW DRIVER FOR REPLENISHMENT', '3522-589-20082', '', '', '', 'RAK 1A', 0, '1', 'EA', 'J00002', 'K00004'),
('B00084', '', '7', 'FUSE F8', 'J211033', 'K101520', '', 'SAM MISSLE WEAPON SYSTEM', 'RAK 1A', 0, '10', 'EA', 'J00002', 'K00004'),
('B00085', '', '8', 'FUSE F5', 'G075722', 'K101519', '', 'SAM MISSLE WEAPON SYSTEM', 'RAK 1A', 0, '10', 'EA', 'J00002', 'K00004'),
('B00086', '', '9', 'FUSE F4', 'T098687', 'K101518', '', 'SAM MISSLE WEAPON SYSTEM', 'RAK 1A', 0, '10', 'EA', 'J00002', 'K00004'),
('B00087', '', '10', 'DREYER EDZ', '0139015', 'K100954', '', 'LIROD MK2', 'RAK 1B', 0, '1', 'EA', 'J00002', 'K00004'),
('B00088', '', '11', 'HEATER', '3522-500-49597', 'K100999', '', 'LIROD MK2', 'RAK 1B', 0, '1', 'EA', 'J00002', 'K00004'),
('B00089', '', '12', 'SILINCER', '4030303', 'K100958', '', 'LIROD MK2', 'RAK 1B', 0, '1', 'EA', 'J00002', 'K00004'),
('B00090', '', '13', 'MA-SWITCH', '955600174900', 'K101010', '', 'LIROD MK2', 'RAK 1B', 0, '1', 'EA', 'J00002', 'K00004'),
('B00091', '', '14', 'CPU-PCI CARD', 'WTP089100011', 'K100834', '', 'TORPEDO LAUNCHING SYSTEM', 'RAK 1C', 0, '1', 'EA', 'J00002', 'K00004'),
('B00092', '', '15', 'EXCITATION COIL', '258049001', 'K101644', '', 'DECOY', 'RAK 1C', 0, '1', 'EA', 'J00002', 'K00004');

-- --------------------------------------------------------

--
-- Table structure for table `brg_keluar`
--

CREATE TABLE `brg_keluar` (
  `idbrg_keluar` varchar(6) NOT NULL,
  `idkapal` varchar(6) NOT NULL,
  `tgl` date NOT NULL,
  `idusers` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brg_keluar`
--

INSERT INTO `brg_keluar` (`idbrg_keluar`, `idkapal`, `tgl`, `idusers`) VALUES
('K00001', 'K00001', '2022-05-27', 'U00006'),
('K00002', 'K00003', '2022-06-22', 'U00007');

-- --------------------------------------------------------

--
-- Table structure for table `brg_keluar_detil`
--

CREATE TABLE `brg_keluar_detil` (
  `idbrg_k_detil` varchar(8) NOT NULL,
  `idbarang` varchar(6) NOT NULL,
  `jumlah` float NOT NULL DEFAULT 0,
  `satuan` varchar(15) NOT NULL,
  `idbrg_keluar` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brg_keluar_detil`
--

INSERT INTO `brg_keluar_detil` (`idbrg_k_detil`, `idbarang`, `jumlah`, `satuan`, `idbrg_keluar`) VALUES
('KD000001', 'B00003', 1, 'ea', 'K00001'),
('KD000002', 'B00043', 1, 'ea', 'K00002');

-- --------------------------------------------------------

--
-- Table structure for table `brg_masuk`
--

CREATE TABLE `brg_masuk` (
  `idbrg_masuk` varchar(6) NOT NULL,
  `idkapal` varchar(6) NOT NULL,
  `tgl` date NOT NULL,
  `idusers` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brg_masuk`
--

INSERT INTO `brg_masuk` (`idbrg_masuk`, `idkapal`, `tgl`, `idusers`) VALUES
('M00001', 'K00001', '2022-05-27', 'U00006'),
('M00002', 'K00003', '2022-06-22', 'U00007');

-- --------------------------------------------------------

--
-- Table structure for table `brg_masuk_detil`
--

CREATE TABLE `brg_masuk_detil` (
  `idbrg_m_detil` varchar(8) NOT NULL,
  `idbarang` varchar(6) NOT NULL,
  `jumlah` float NOT NULL DEFAULT 0,
  `satuan` varchar(15) NOT NULL,
  `idbrg_masuk` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brg_masuk_detil`
--

INSERT INTO `brg_masuk_detil` (`idbrg_m_detil`, `idbarang`, `jumlah`, `satuan`, `idbrg_masuk`) VALUES
('MD000001', 'B00001', 1, '', 'M00001'),
('MD000002', 'B00002', 1, '', 'M00001'),
('MD000003', 'B00003', 2, '', 'M00001'),
('MD000004', 'B00004', 1, '', 'M00001'),
('MD000005', 'B00005', 2, '', 'M00001'),
('MD000006', 'B00006', 1, '', 'M00001'),
('MD000007', 'B00007', 1, '', 'M00001'),
('MD000008', 'B00008', 1, '', 'M00001'),
('MD000009', 'B00009', 1, '', 'M00001'),
('MD000010', 'B00010', 1, '', 'M00001'),
('MD000011', 'B00011', 1, '', 'M00001'),
('MD000012', 'B00012', 1, '', 'M00001'),
('MD000013', 'B00013', 1, '', 'M00001'),
('MD000014', 'B00014', 1, '', 'M00001'),
('MD000015', 'B00015', 2, '', 'M00001'),
('MD000016', 'B00016', 2, '', 'M00001'),
('MD000017', 'B00017', 2, '', 'M00001'),
('MD000018', 'B00018', 1, '', 'M00001'),
('MD000019', 'B00019', 3, '', 'M00001'),
('MD000020', 'B00020', 1, '', 'M00001'),
('MD000021', 'B00021', 1, '', 'M00001'),
('MD000022', 'B00022', 1, '', 'M00001'),
('MD000023', 'B00023', 1, '', 'M00001'),
('MD000024', 'B00024', 2, '', 'M00001'),
('MD000025', 'B00025', 1, '', 'M00001'),
('MD000026', 'B00026', 2, '', 'M00001'),
('MD000027', 'B00027', 2, '', 'M00001'),
('MD000028', 'B00028', 1, '', 'M00001'),
('MD000029', 'B00029', 1, '', 'M00001'),
('MD000030', 'B00030', 2, '', 'M00001'),
('MD000031', 'B00031', 2, '', 'M00001'),
('MD000032', 'B00032', 1, '', 'M00001'),
('MD000033', 'B00033', 1, '', 'M00001'),
('MD000034', 'B00034', 1, '', 'M00001'),
('MD000035', 'B00035', 1, '', 'M00001'),
('MD000036', 'B00036', 2, '', 'M00001'),
('MD000037', 'B00037', 1, '', 'M00001'),
('MD000038', 'B00038', 1, '', 'M00001'),
('MD000039', 'B00039', 1, '', 'M00001'),
('MD000040', 'B00040', 1, '', 'M00001'),
('MD000041', 'B00041', 1, '', 'M00002'),
('MD000042', 'B00042', 1, '', 'M00002'),
('MD000043', 'B00043', 2, '', 'M00002'),
('MD000044', 'B00044', 1, '', 'M00002'),
('MD000045', 'B00045', 2, '', 'M00002'),
('MD000046', 'B00046', 1, '', 'M00002'),
('MD000047', 'B00047', 1, '', 'M00002'),
('MD000048', 'B00048', 1, '', 'M00002'),
('MD000049', 'B00049', 1, '', 'M00002'),
('MD000050', 'B00050', 1, '', 'M00002'),
('MD000051', 'B00051', 1, '', 'M00002'),
('MD000052', 'B00052', 1, '', 'M00002'),
('MD000053', 'B00053', 1, '', 'M00002'),
('MD000054', 'B00054', 1, '', 'M00002'),
('MD000055', 'B00055', 2, '', 'M00002'),
('MD000056', 'B00056', 2, '', 'M00002'),
('MD000057', 'B00057', 2, '', 'M00002'),
('MD000058', 'B00058', 1, '', 'M00002'),
('MD000059', 'B00059', 3, '', 'M00002'),
('MD000060', 'B00060', 1, '', 'M00002');

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE `identitas` (
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
  `logo` longtext DEFAULT NULL,
  `lat` varchar(45) DEFAULT NULL,
  `lon` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`kode`, `instansi`, `slogan`, `tahun`, `pimpinan`, `alamat`, `kdpos`, `tlp`, `fax`, `website`, `email`, `logo`, `lat`, `lon`) VALUES
('K00001', 'KOARMADA 2', 'Ghora Wira Madya Jala', 1985, 'Laksamana Muda TNI Iwan Isnurwanto, M.A.P., M.Tr.(Han).', 'Dermaga Ujung Surabaya, Jawa Timur', '60178', '08', '-', 'https://koarmada2.tnial.mil.id/', 'rampa@gmail.com', 'Koarmada2.png', '-7.4063726', '112.5841074');

-- --------------------------------------------------------

--
-- Table structure for table `jenisbarang`
--

CREATE TABLE `jenisbarang` (
  `idjenisbarang` varchar(6) NOT NULL,
  `nama_jenis` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenisbarang`
--

INSERT INTO `jenisbarang` (`idjenisbarang`, `nama_jenis`) VALUES
('J00001', 'Platform'),
('J00002', 'Sewaco'),
('J00003', 'Komaliwan'),
('J00004', 'Barang Umum'),
('J00005', 'bahari');

-- --------------------------------------------------------

--
-- Table structure for table `kapal`
--

CREATE TABLE `kapal` (
  `idkapal` varchar(6) NOT NULL,
  `nama_kapal` varchar(45) NOT NULL,
  `gambar` varchar(150) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kapal`
--

INSERT INTO `kapal` (`idkapal`, `nama_kapal`, `gambar`, `keterangan`) VALUES
('K00001', 'Dewaruci', 'Dewaruci1.jpg', 'Gambar kapal dewaruci'),
('K00002', 'KRI B', '', ''),
('K00003', 'kri sultan hasanudin', '', ''),
('K00004', 'KRI FKO', '', ''),
('K00005', 'KRI DPN-365', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `korps`
--

CREATE TABLE `korps` (
  `idkorps` varchar(6) CHARACTER SET utf8mb4 NOT NULL,
  `nama_korps` varchar(45) CHARACTER SET utf8mb4 NOT NULL
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

CREATE TABLE `pangkat` (
  `idpangkat` varchar(6) CHARACTER SET utf8mb4 NOT NULL,
  `nama_pangkat` varchar(45) CHARACTER SET utf8mb4 NOT NULL
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

CREATE TABLE `role` (
  `idrole` varchar(6) CHARACTER SET utf8mb4 NOT NULL,
  `nama_role` varchar(45) CHARACTER SET utf8mb4 NOT NULL
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

CREATE TABLE `users` (
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
  `idkapal` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idusers`, `nrp`, `pass`, `nama`, `tgl_lahir`, `agama`, `kota_asal`, `foto`, `satuan_kerja`, `idrole`, `idkapal`) VALUES
('U00001', 'ADMIN', 'aGtq', 'ADMIN', '1991-01-30', 'Islam', 'Surabaya', './assets/images/e7118256aaf4d1de09199e2b6cbe667c.png', 'TNI ANGKATAN LAUT', 'R00001', NULL),
('U00002', '111', 'aGtq', 'Rampa', '1989-08-02', 'Islam', 'Surabaya', NULL, 'TNI', 'R00003', 'K00001'),
('U00003', '222', 'aGtq', 'Atika', NULL, NULL, NULL, NULL, NULL, 'R00002', 'K00001'),
('U00004', '333', 'aGtq', 'Putri Hapsari', NULL, NULL, NULL, NULL, NULL, 'R00003', 'K00002'),
('U00005', '444', 'aGtq', 'vhjv', NULL, NULL, NULL, NULL, NULL, 'R00003', 'K00002'),
('U00006', '555', 'aGtq', 'scscsx', NULL, NULL, NULL, NULL, NULL, 'R00003', 'K00001'),
('U00007', 'admin shn', 'aGtq', 'adiatma', NULL, NULL, NULL, NULL, NULL, 'R00003', 'K00003'),
('U00008', 'KRI DPN-365', 'aGtq', 'Naratama Yoga', NULL, NULL, NULL, NULL, NULL, 'R00003', '-'),
('U00009', 'KRI FKO-368', 'aGtq', 'Koko Fajar Suharyogi', '0000-00-00', 'Islam', 'Blitar', NULL, 'Satkor Koarmada II', 'R00003', 'K00004');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`idbarang`),
  ADD KEY `FK_barang_jenis` (`idjenisbarang`),
  ADD KEY `FK_barang_kapal` (`idkapal`);

--
-- Indexes for table `brg_keluar`
--
ALTER TABLE `brg_keluar`
  ADD PRIMARY KEY (`idbrg_keluar`),
  ADD KEY `FK_brg_keluar_kapal` (`idkapal`),
  ADD KEY `FK_brg_keluar_usr` (`idusers`);

--
-- Indexes for table `brg_keluar_detil`
--
ALTER TABLE `brg_keluar_detil`
  ADD PRIMARY KEY (`idbrg_k_detil`),
  ADD KEY `FK_brg_keluar_detil_brg` (`idbarang`),
  ADD KEY `FK_brg_keluar_detil_key` (`idbrg_keluar`);

--
-- Indexes for table `brg_masuk`
--
ALTER TABLE `brg_masuk`
  ADD PRIMARY KEY (`idbrg_masuk`),
  ADD KEY `FK_brg_masuk_kapal` (`idkapal`),
  ADD KEY `FK_brg_masuk_users` (`idusers`);

--
-- Indexes for table `brg_masuk_detil`
--
ALTER TABLE `brg_masuk_detil`
  ADD PRIMARY KEY (`idbrg_m_detil`),
  ADD KEY `FK_brg_masuk_detil_brg` (`idbarang`),
  ADD KEY `FK_brg_masuk_detil_key` (`idbrg_masuk`);

--
-- Indexes for table `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `jenisbarang`
--
ALTER TABLE `jenisbarang`
  ADD PRIMARY KEY (`idjenisbarang`);

--
-- Indexes for table `kapal`
--
ALTER TABLE `kapal`
  ADD PRIMARY KEY (`idkapal`);

--
-- Indexes for table `korps`
--
ALTER TABLE `korps`
  ADD PRIMARY KEY (`idkorps`);

--
-- Indexes for table `pangkat`
--
ALTER TABLE `pangkat`
  ADD PRIMARY KEY (`idpangkat`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`idrole`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idusers`),
  ADD KEY `FK_users_role` (`idrole`);

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
-- Constraints for table `brg_masuk_detil`
--
ALTER TABLE `brg_masuk_detil`
  ADD CONSTRAINT `FK_brg_masuk_detil_brg` FOREIGN KEY (`idbarang`) REFERENCES `barang` (`idbarang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_brg_masuk_detil_key` FOREIGN KEY (`idbrg_masuk`) REFERENCES `brg_masuk` (`idbrg_masuk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_users_role` FOREIGN KEY (`idrole`) REFERENCES `role` (`idrole`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
