-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 12, 2022 at 07:49 PM
-- Server version: 10.3.35-MariaDB-cll-lve
-- PHP Version: 7.4.30

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
('B00005', '', 'TROPONG LAPANGAN DENGAN KOMP', '', '', '', '', '', 'NAVAL STORE', 0, 'UNIT', 'BP/230/III/2020 Sprin/1310/IX/2019 tanggal 09 September 2019', 'J00007', 'K00005'),
('B00006', '', 'TROPONG NIGHT VICION', '', '', '', '', '', 'NAVAL STORE', 0, 'UNIT', 'BP/230/III/2020 Sprin/1310/IX/2019 tanggal 09 September 2020', 'J00007', 'K00005'),
('B00007', '', 'DRY CABINET', '', '', '', '', '', 'NAVAL STORE', 0, 'UNIT', 'BP/230/III/2020 Sprin/1310/IX/2019 tanggal 09 September 2021', 'J00007', 'K00005'),
('B00008', '', 'BATTERY', '', '', '', '', '', 'NAVAL STORE', 0, 'UNIT', 'BP/230/III/2020 Sprin/1310/IX/2019 tanggal 09 September 2022', 'J00007', 'K00005'),
('B00009', '', 'TROPONG NIGHT', '', '', '', '', '', 'NAVAL STORE', 0, 'UNIT', 'BP/231/III/2021', 'J00007', 'K00005'),
('B00010', '', 'LAMELLAR STAGE 1', '037157', '', '', '', '', 'SUDAH DI KELUARKAN', 0, 'UNIT', 'DPB/O1/III/2020', 'J00007', 'K00005'),
('B00011', '', 'LAMELLAR STAGE 2', '037058', '', '', '', '', 'SUDAH DI KELUARKAN', 0, 'UNIT', '', 'J00007', 'K00005'),
('B00012', '', 'SELENOID DRAIN VALVE', '060354', '', '', '', '', 'SUDAH DI KELUARKAN', 0, 'UNIT', '', 'J00007', 'K00005'),
('B00013', '', 'COOLANT ADDITIVIES', '3P-2044/2170616', '', '', '', '', 'SUDAH DI KELUARKAN', 0, 'UNIT', '', 'J00007', 'K00005'),
('B00014', '', 'GASKET ACTUATOR', '6N-2645', '', '', '', '', 'SUDAH DI KELUARKAN', 0, 'UNIT', '', 'J00007', 'K00005'),
('B00015', '', 'ISOLATOR', '9Y-5292', '', '', '', '', 'SUDAH DI KELUARKAN', 0, 'UNIT', '', 'J00007', 'K00005'),
('B00016', '', 'GROMET', '9Y-5290', '', '', '', '', 'SUDAH DI KELUARKAN', 0, 'UNIT', '', 'J00007', 'K00005'),
('B00017', '', 'IMPELLER', '3N-4859', '', '', '', '', 'SUDAH DI KELUARKAN', 0, 'UNIT', '', 'J00007', 'K00005'),
('B00018', '', 'SEAL', '3N-4863', '', '', '', '', 'SUDAH DI KELUARKAN', 0, 'UNIT', '', 'J00007', 'K00005'),
('B00019', '', 'SHAFT', '3N-4858', '', '', '', '', 'SUDAH DI KELUARKAN', 0, 'UNIT', '', 'J00007', 'K00005'),
('B00020', '', 'RING RETAINING', '3N-7759', '', '', '', '', 'SUDAH DI KELUARKAN', 0, 'UNIT', '', 'J00007', 'K00005'),
('B00021', '', 'BALL BEARING', '1B-3867', '', '', '', '', 'SUDAH DI KELUARKAN', 0, 'UNIT', '', 'J00007', 'K00005'),
('B00022', '', 'CAM', '3N-4860', '', '', '', '', 'SUDAH DI KELUARKAN', 0, 'UNIT', '', 'J00007', 'K00005'),
('B00023', '', 'STAMFORD', '112097-0952', '', '', '', '', 'NAVAL STORE RAK 1.1', 0, 'UNIT', '', 'J00007', 'K00005'),
('B00024', '', 'MAN DIESEL', '0008532', '', '', '', '', 'NAVAL STORE RAK 1.1', 0, 'UNIT', '', 'J00007', 'K00005'),
('B00025', '', 'FULL FLOW ELEMENT', '26AFC900002/1-2', '', '', '', '', 'NAVAL STORE', 0, 'EA', '', 'J00007', 'K00005'),
('B00026', '', 'FILTER UDARA 7 BAR', 'ZZAUT004SDO', '', '', '', '', 'NAVAL STORE', 0, 'EA', '', 'J00007', 'K00005'),
('B00027', '', 'FILTER ELEMENT As-FUEL 9M', '2342', '', '', '', '', 'NAVAL STORE', 0, 'EA', '', 'J00007', 'K00005'),
('B00028', '', 'O RING SET', '', '', '', '', '', '', 0, 'SET', '', 'J00007', 'K00005'),
('B00029', '', 'CHARGE ACCU', '', '', '', '', '', '', 0, 'UNIT', '', 'J00007', 'K00005'),
('B00030', '', 'PENATRATING GREASE', '', '', '', '', '', '', 0, 'BTL', '', 'J00007', 'K00005'),
('B00031', '', 'PACKING TOMBO 1 MM', '', '', '', '', '', '', 0, 'LMBR', '', 'J00007', 'K00005'),
('B00032', '', 'PACKING TOMBO 2 MM', '', '', '', '', '', '', 0, 'LMBR', '', 'J00007', 'K00005'),
('B00033', '', 'PACKING TOMBO 3 MM', '', '', '', '', '', '', 0, 'LMBR', '', 'J00007', 'K00005'),
('B00034', '', 'PACKING TOMBO 4 MM', '', '', '', '', '', '', 0, 'LMBR', '', 'J00007', 'K00005'),
('B00035', '', 'PACKING KLINGRID 0,5 MM', '', '', '', '', '', '', 0, 'LMBR', '', 'J00007', 'K00005'),
('B00036', '', 'PACKING KLINGRID 1 MM', '', '', '', '', '', '', 0, 'LMBR', '', 'J00007', 'K00005'),
('B00037', '', 'PACKING KLINGRID 2 MM', '', '', '', '', '', '', 0, 'LMBR', '', 'J00007', 'K00005'),
('B00038', '', 'PACKING KARET SINTETIS 1 MM', '', '', '', '', '', '', 0, 'LMBR', '', 'J00007', 'K00005'),
('B00039', '', 'PACKING KARET SINTETIS 2 MM', '', '', '', '', '', '', 0, 'LMBR', '', 'J00007', 'K00005'),
('B00040', '', 'PACKING KARET SINTETIS 3 MM', '', '', '', '', '', '', 0, 'LMBR', '', 'J00007', 'K00005'),
('B00041', '', 'PACKING KARET SINTETIS 4 MM', '', '', '', '', '', '', 0, 'LMBR', '', 'J00007', 'K00005'),
('B00042', '', 'ELEKTRODA RD 460 UK 3,2 MM', '', '', '', '', '', '', 0, 'KG', '', 'J00007', 'K00005'),
('B00043', '', 'ELEKTRODA RD 460 UK 2,6 MM', '', '', '', '', '', '', 0, 'KG', '', 'J00007', 'K00005'),
('B00044', '', 'ELEKTRODA STENLES STELL UK 3,2 MM', '', '', '', '', '', '', 0, 'KG', '', 'J00007', 'K00005'),
('B00045', '', 'ELEKTRODA STENLES STELL UK 2,6 MM', '', '', '', '', '', '', 0, 'KG', '', 'J00007', 'K00005'),
('B00046', '', 'SARUNG TANGAN LAS', '', '', '', '', '', '', 0, 'PASANG', '', 'J00007', 'K00005'),
('B00047', '', 'BLANDER LAS', '', '', '', '', '', '', 0, 'UNIT', '', 'J00007', 'K00005'),
('B00048', '', 'BLANDER LAS ACETYLINE', '', '', '', '', '', '', 0, 'UNIT', '', 'J00007', 'K00005'),
('B00049', '', 'BLANDER LAS POTONG', '', '', '', '', '', '', 0, 'UNIT', '', 'J00007', 'K00005'),
('B00050', '', 'KABEL LAS', '', '', '', '', '', '', 0, 'ROLL', '', 'J00007', 'K00005'),
('B00051', '', 'GERINDA TANGAN', '', '', '', '', '', '', 0, 'UNIT', '', 'J00007', 'K00005'),
('B00052', '', 'MATA BOR', '', '', '', '', '', '', 0, 'SET', '', 'J00007', 'K00005'),
('B00053', '', 'BALLAST 18 WATT', '', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00054', '', 'KONTAKTOR', '', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00055', '', 'KLEM 2\\\"', '', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00056', '', 'KLEM2,5\\\"', '', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00057', '', 'SILICON RED', '', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00058', '', 'STEEL EPOXY', '', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00059', '', 'BREAKER 200 A', '', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00060', '', 'BREAKER 100 A', '', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00061', '', 'BREAKER 250', '', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00062', '', 'MCB 10 A', '', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00063', '', 'MCB 20 A', '', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00064', '', 'FUSE', '', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00065', '', 'LAMPU NAVIGASI 65 W/P285', '', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00066', '', 'LAMPU TL 18 W COOL WHITE', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00067', '', 'LAMPU TL 18 W WARM WHITE', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00068', '', 'LAMPU TL 18 W/T8 LED 8W RED', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00069', '', 'LAMPU PL 11 W', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00070', '', 'LAMPU PL 9 W', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00071', '', 'LAMPU PL 18 W', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00072', '', 'LAMPU ESCAPE', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00073', '', 'LAMPU TL 36W WARM WHITE', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00074', '', 'LAMPU TL 36 W COOL WHITE', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00075', '', 'LAMPU TL 36 W /T8 LED 16 W RED', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00076', '', 'LAMPU INTERIOR L PA 25 W', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00077', '', 'LAMPU HOLOGEN 500 W', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00078', '', 'LAMPU E 27 (ULIR) 20 W', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00079', '', 'ELECTRONIC BALLAST EBC 218 TI D', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00080', '', 'FUSE LINK 63X32 MM CERAMIC TUBE', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00081', '', 'SEKRING 6 A/500 V', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00082', '', 'SEKRING 10 A/500 V', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00083', '', 'SEKRING 16 A/500 V', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00084', '', 'SEKRING 20 A/500 V', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00085', '', 'SEKRING KOTAK 63 A/500 V', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00086', '', 'SEKRING KOTAK 80 A/500 V', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00087', '', 'FUSE 4A', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00088', '', 'FUSE 6A', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00089', '', 'FUSE 10A', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00090', '', 'FUSE 16A', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00091', '', 'KABEL2X1,5 MM', '', '', '', '', '', '', 0, 'ROLL', '', 'J00007', 'K00005'),
('B00092', '', 'LAMPU ULIR 220 V', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00093', '', 'FITING LAMPU ULIR', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00094', '', 'STAKER', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00095', '', 'LAMPU BAYONET 115 V/60 W', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00096', '', 'LAMPU HALOGEN 500 W', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00097', '', 'ISOLASI', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00098', '', 'CRC RED (RED GASKET)', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00099', '', 'TERMINAL KABEL 6 TITIK', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00100', '', 'BATERAY KOTAK 9V', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00101', '', 'BATERAY AA 1,5V', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00102', '', 'FUSE 5X25-4A', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00103', '', 'FUSE 5X20-4A', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00104', '', 'FUSE 5X20-6,3A', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00105', '', 'BULB', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00106', '', 'FUSE 5X20-0,5A', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00107', '', 'FUSE 5X25-10A', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00108', '', 'SOLDER + TIMAH + PENYEDOT TIMAH', '', '', '', '', '', '', 0, 'SET', '', 'J00007', 'K00005'),
('B00109', '', 'LAMPU JALAN', '', '', '', '', '', '', 0, 'SET', '', 'J00007', 'K00005'),
('B00110', '', 'EMERGENCY ESCAPE BREATHING DEVICE', '', '', '', '', '', '', 0, 'BUAH', 'BP/267/III/2020 TGL 10 MARET 2020 BEDASARKAN :SPPB/161/III/2020', 'J00007', 'K00005'),
('B00111', '', 'POMPA PEMADAM DIESEL PORTABLE', '', '', '', '', '', '', 0, 'BUAH', 'BP/267/III/2020 TGL 10 MARET 2020 BEDASARKAN :SPPB/161/III/2020', 'J00007', 'K00005'),
('B00112', '', 'SELANG 2,5\\\"', '', '', '', '', '', '', 0, 'BUAH', 'BP/267/III/2020 TGL 10 MARET 2020 BEDASARKAN :SPPB/161/III/2020', 'J00007', 'K00005'),
('B00113', '', 'NOZZLE 2,5\\\" PORTABLE', '', '', '', '', '', '', 0, 'BUAH', 'BP/267/III/2020 TGL 10 MARET 2020 BEDASARKAN :SPPB/161/III/2020', 'J00007', 'K00005'),
('B00114', '', 'SUBMERSIBLE PUMP 220 VOLT', '', '', '', '', '', '', 0, 'BUAH', 'BP/267/III/2020 TGL 10 MARET 2020 BEDASARKAN :SPPB/161/III/2020', 'J00007', 'K00005'),
('B00115', '', 'SELANG2\\\"', '', '', '', '', '', '', 0, 'BUAH', 'BP/267/III/2020 TGL 10 MARET 2020 BEDASARKAN :SPPB/161/III/2020', 'J00007', 'K00005'),
('B00116', '', 'NOZZLE 2\\\"', '', '', '', '', '', '', 0, 'BUAH', 'BP/267/III/2020 TGL 10 MARET 2020 BEDASARKAN :SPPB/161/III/2020', 'J00007', 'K00005'),
('B00117', '', 'TRAFO LAS PORTABLE ESAB 200A MASKER + SARUNG TANGAN', '', '', '', '', '', '', 0, 'EA', 'BP/268/III/2020 TGL 10 MARET 2020 BERDASARKAN : SPPB/160/III/2020', 'J00007', 'K00005'),
('B00118', '', 'OIL PUMP PORTABLE SET', '', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00119', '', 'SELANG OIL PUMP PORTABLE', '', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00120', '', 'ROLL CABLE 50 M', '', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00121', '', 'AIR SCREW', '', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00122', '', 'BAJU TAHAN API', '', '', '', '', '', '', 0, 'BUAH', 'BP/266/III/2020 TGL 10 MARET 2020 BERDASARKAN : SPPB/162/III/2020', 'J00007', 'K00005'),
('B00123', '', 'PORTABLE BRATHING APPARATUS', '', '', '', '', '', '', 0, 'BUAH', 'SPRIN/128/I/2020 TGL 27 JANUARI 2020', 'J00007', 'K00005'),
('B00124', '', 'FIRE FIGHTING GLOVES', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00125', '', 'FIRE FIGHTING SHOES SAFETY UK. 43', '', '', '', '', '', '', 0, 'BUAH', '', 'J00007', 'K00005'),
('B00126', '', 'MECHANICAL SEAL', '98680152694', '', '', '', '', '', 0, 'EA', 'BP/66/IV/2020 TGL 13 APRIL 2020 PT.BIFA PRATAMA', 'J00007', 'K00005'),
('B00127', '', 'AVR STAMFORD MX-341', 'E 000-23412', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00128', '', 'FILTER BB', '1R-0749', '', '', '', '', '', 0, 'EA', 'BP/570/V/2020 TGL 20 MEI 2020 BERDASARKAN : SPPB/283/V/2020', 'J00007', 'K00005'),
('B00129', '', 'FILTER OIL', '1R-0716', '', '', '', '', '', 0, 'EA', 'DASAR : KTR/77/03-20/IV/2020 TGL 06 APRIL 2020 PT. AATIKAH LUBNA', 'J00007', 'K00005'),
('B00130', '', 'FILTER RACOR BB', '2010/30M', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00131', '', 'FILTER BREATER CCV', '55274-08/9Y 2988', '', '', '', '', '', 0, 'EA', 'PENERIMA : SERDA BEK MAKSUM TGL 26 MEI 2020', 'J00007', 'K00005'),
('B00132', '', 'FILTER UDARA', '4N-0015', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00133', '', 'VARIABLE DC POWER SUPPLY MERK KEYSINGHT', 'MY60030050', '', '', '', '', '', 0, 'UNIT', 'BA/25/V/2020 TGL 25 MEI 2020 DARI DISMATBEK', 'J00007', 'K00005'),
('B00134', '', 'COOLANT ADDITIVE', '3P-2044', '', '', '', '', '', 0, 'EA', 'BEKAL OBS KRI', 'J00007', 'K00005'),
('B00135', '', 'ELEMENT (RACOR SEPARATOR)', '8N-0205', '', '', '', '', '', 0, 'EA', 'SPRIN/160/I/2020 TGL 30-01-2020 TERIMA 29-05-2020', 'J00007', 'K00005'),
('B00136', '', 'ELEMENT AS SEPARATOR', '8N-0205', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00137', '', 'FILTER AIR CLENER', '4N-0015', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00138', '', 'FUEL FILTER', 'IR-0749', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00139', '', 'OIL FILTER', 'IR-0716', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00140', '', 'ROD', 'GI-2280', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00141', '', 'V BBEL (ALTENATOR)', '4N-8216', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00142', '', 'SEAL GP (SEA WATER PUMP)', '3N-5632', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00143', '', 'IMPELLER (SEA WATER PUNP)', '3N-4859', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00144', '', 'KIT FUEL FILTER & WATER SEPARATOR', '141-0284', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00145', '', 'REGULATOR AS VOLTAGE (AVR) 6', '202-8634/3652076', '', '', '', '', '', 0, 'EA', '', 'J00007', 'K00005'),
('B00147', '', '2', 'POWER SUPPLY MODULE', '4662288C', 'K100791', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00148', '', '3', 'POWER SUPPY UNIT-INTN', '606488-00', 'K100762', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 0, '2', 'EA', 'J00008', 'K00005'),
('B00149', '', '4', 'HEATER PANEL ASSY.', '602953-00', 'K100775', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00150', '', '5', 'VIKTOR MK 4 TRANDUCER', '4718450344', 'K101525', '', 'HULL MOUNTED SONAR', 'RAK 9A', 0, '2', 'EA', 'J00008', 'K00005'),
('B00151', '', '6', 'ELECTROMECHANICAL', '47229238AH', 'K100414', '', 'HULL MOUNTED SONAR', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00152', '', '7', 'CAPACITOR MODULE', '56950517AA01', 'K100454', '', 'HULL MOUNTED SONAR', 'RAK 9A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00153', '', '8', 'EQUIPPED CHASSIS', '61559321AA', 'K100815', '', 'IFF', 'RAK9A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00154', '', '9', 'SENSOR', '352250057061', 'K10101007', '', 'MW-08', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00155', '', '10', 'GROUND CABLE', '14100029075', 'K101471', '', 'SSM MISSILE WEAPON SYSTEM', 'RAK 8A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00156', '', '11', 'FANS ASSEMBLY', '14100015789', 'K101450', '', 'SSM MISSILE WEAPON SYSTEM', 'RAK 8A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00157', '', '12', 'AMMUNITION 115 V - 400 PSU', '676-70/YI-3593', 'K101455', '', 'SSM MISSILE WEAPON SYSTEM', 'RAK 8A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00158', '', '13', 'CABINET TOOL CASE', '1410006129', 'K101661', '', 'SSM MISSILE WEAPON SYSTEM', 'RAK 8A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00159', '', '14', 'CPU/DISPLAY PANEL ASSY.', 'WTP089800001', 'K100903', '', 'TORPEDO LAUNCHING SYSTEM', 'RAK 8A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00160', '', '15', 'R.A. CO. MB', '955672108600', 'K100616', '', 'BTS NAVRAD', 'RAK 7A', 0, '2', 'EA', 'J00008', 'K00005'),
('B00161', '', '16', 'RTV MOD 18', '955673147100', 'K100638', '', 'BTS NAVRAD', 'RAK 7A', 0, '2', 'EA', 'J00008', 'K00005'),
('B00162', '', '17', 'VME-10D15', '955672111700', 'K100619', '', 'BTS SAM', 'RAK 7A', 0, '2', 'EA', 'J00008', 'K00005'),
('B00163', '', '18', 'DSU 1 (MW-08)', '9556-811-201XX', 'K101648', '', 'COMMAND AND CONTROL SYSTEM', 'RAK 8A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00164', '', '19', 'LIU RELAY BOARD', '261048-001', 'K101075', '', 'DECOY', 'RAK 8A', 0, '3', 'EA', 'J00008', 'K00005'),
('B00165', '', '20', 'LIU POWER MODULE IN', '261056-001', 'K101085', '', 'DECOY', 'RAK 8A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00166', '', '21', 'TFT COLOUR LCD DISPLAY 12.1', '', 'K101629', '', 'DECOY', 'RAK 8A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00167', '', '22', 'LIU CPU MODULE WITH WINDOWS XP', '', 'K101078', '', 'DECOY', 'RAK 8A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00168', '', '23', 'RELAY BRD', '955672120400', 'K101015', '', 'EGCC', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00169', '', '24', 'EXITER MODULE', '700141-536-00A', 'K100780', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 0, '2', 'EA', 'J00008', 'K00005'),
('B00170', '', '25', 'MAIN POWER SUPPLY MODULE', '4662295C', 'K100790', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00171', '', '26', 'DSP MODULE', '700084-536-002', 'K100457', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 0, '2', 'EA', 'J00008', 'K00005'),
('B00172', '', '27', 'RECEIVER MODULE', '700108-536-001', 'K100779', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 0, '2', 'EA', 'J00008', 'K00005'),
('B00173', '', '28', 'PRESPOT SELECTOR MODULE', '60477501', 'K100764', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00174', '', '29', 'PEC TRIPLEXER ACU 50', '602353-00', 'K100771', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00175', '', '30', 'SYNTHESIZER MODULE OCXO', '70109-536-002', 'K100760', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 0, '2', 'EA', 'J00008', 'K00005'),
('B00176', '', '31', 'CPU MODULE', '700137-536002', 'K100782', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 0, '2', 'EA', 'J00008', 'K00005'),
('B00177', '', '32', 'PCRRV SENSE', '602356-00', 'K100774', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00178', '', '33', 'POWER SUPPLY UNIT', '606488-00', 'K100762', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00179', '', '34', 'AUDIO FREQUENCY MODULE', '4662290C', 'K100788', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00180', '', '35', 'PEC DISTRIBUTION', '606083-00', 'K100753', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00181', '', '36', 'PEC EXCITER', '', 'K100754', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 0, '2', 'EA', 'J00008', 'K00005'),
('B00182', '', '37', 'EXCITER MODULE', '700141536004', 'K100780', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00183', '', '38', 'LUPS 24 V', 'LK1601-7ERP104', 'K100457', '', 'HULL MOUNTED SONAR', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00184', '', '39', 'K. MULTIPL', '916973152300', 'K100486', '', 'LIROD MK2', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00185', '', '40', 'PDK 35 BRD', '955672800000', 'K101050', '', 'MOC-L', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00186', '', '41', 'VME JCI', '9556-72114400', 'K100620', '', 'MW-08', 'RAK 7A', 0, '2', 'EA', 'J00008', 'K00005'),
('B00187', '', '42', 'VME-DISS-P', '9556-721-19400', 'K101547', '', 'MW-08', 'RAK 7A', 0, '2', 'EA', 'J00008', 'K00005'),
('B00188', '', '43', 'VID GEN-MK3', '955672312900', 'K100622', '', 'MW-08', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00189', '', '44', 'DC CONVERTER', '25175', 'K100798', '', 'PUBLIC ADDRESS SYSTEM', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00190', '', '45', 'LINE INPUT MODULE', 'A1009-01', 'K100793', '', 'PUBLIC ADDRESS SYSTEM', 'RAK 7A', 0, '2', 'EA', 'J00008', 'K00005'),
('B00191', '', '46', 'MONITOR MODULE', 'A1051-01', 'K100796', '', 'PUBLIC ADDRESS SYSTEM', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00192', '', '47', 'MASTER SUPERVISORY MODULE', '', 'K100797', '', 'PUBLIC ADDRESS SYSTEM', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00193', '', '48', 'SPARE KIT CONSISING OF', '1429ATO1429E', 'K101577', '', 'TELEPHONE SYSTEM', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00194', '', '49', 'POWER AMPLIFIER MODULE', '4662289D', 'K100792', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00195', '', '50', 'POWER SUPPY UNIT', '604042-00', 'K100781', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00196', '', '51', 'WIRED CHASSIS', '5611265A', 'K100783', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00197', '', '52', 'HOUSING AMP (STA 10)', '00-05-89-14-00', 'K100776', '', 'EXTERNAL COMMUNICATIONS', 'RAK 9A', 0, '2', 'EA', 'J00008', 'K00005'),
('B00198', '', '53', 'FK 2100 M (ACU)', 'FK 2100 M', 'K100777', '', 'EXTERNAL COMMUNICATIONS', 'RAK 9A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00199', '', '54', 'LINE SENSING', 'A0850', 'K100801', '', 'FOCON SYSTEM', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00200', '', '55', 'KEYBOARD, 1100 ASSY.', '1100201', 'K100461', '', 'HULL MOUNTED SONAR', 'RAK 9A', 0, '2', 'EA', 'J00008', 'K00005'),
('B00201', '', '56', 'ELECTRICAL FILTER', '89161449AA', 'K100413', '', 'HULL MOUNTED SONAR', 'RAK 9A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00202', '', '57', 'POWER SUPPLY', '89160519', 'K100424', '', 'HULL MOUNTED SONAR', 'RAK 9A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00203', '', '58', 'FILTER 115 V MAIN 16 A', 'DS30230', 'K100429', '', 'HULL MOUNTED SONAR', 'RAK 9A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00204', '', '59', 'CIT', '617760937AA', 'K100826', '', 'IFF', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00205', '', '60', 'WIRED AMMUNITION DRAWER', '14100015815', 'K1001456', '', 'SSM MISSILE WEAPON SYSTEM', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00206', '', '61', 'KEYBOARD WITH TOUCHPAD', 'WTP089800003', 'K100905', '', 'TORPEDO LAUNCHING SYSTEM', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00207', '', '62', 'EXCITATION COIL', '258049-001', 'K101644', '', 'DECOY', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00208', '', '63', 'RIS ANTENNA ASSY.', '518781022', 'K101073', '', 'DECOY', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00209', '', '64', 'RIS ANTENNA ASSY.', '518781021', 'K101074', '', 'DECOY', 'RAK 7A', 0, '2', 'EA', 'J00008', 'K00005'),
('B00210', '', '65', 'POWER SUPPLY UNIT', '604655-00', 'K100766', '', 'EXTERNAL COMMUNICATIONS', 'RAK 9A', 0, '2', 'EA', 'J00008', 'K00005'),
('B00211', '', '67', 'POWER SUPPLY MODULE', '4662288D', 'K100791', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00212', '', '68', 'MAIN POWER SUPPLY MODULE', '4662295C', 'K100790', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00213', '', '69', 'GCU', '897351478100', 'K100720', '', 'GIC 76 MM OSRG', 'RAK 7A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00214', '', '70', 'OUTPUT TRANSFORMER', '56950536AA', 'K10049', '', 'HULL MOUNTED SONAR', 'RAK 9A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00215', '', '71', 'TRACKER BALL', 'DT4655-00', 'K100460', '', 'HULL MOUNTED SONAR', 'RAK 9A', 0, '2', 'EA', 'J00008', 'K00005'),
('B00216', '', '72', 'MESUI PCB', '61181136AA', 'K100451', '', 'HULL MOUNTED SONAR', 'RAK 9A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00217', '', '73', 'ELEMENTARY FAN', '91390758', 'K101527', '', 'HULL MOUNTED SONAR', 'RAK 9A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00218', '', '74', 'T/R MODULE', '61178551AA01', 'K100446', '', 'HULL MOUNTED SONAR', 'RAK 9A', 0, '1', 'EA', 'J00008', 'K00005'),
('B00219', '', 'CU INTERFACE BOARD', '341519-001L2', 'K101625', '2-EA', 'DECOY', 'RAK 9A', 'NAVAL STORE', 0, 'EA', 'DI AMBIL LTT ZULKAIDAR  (16-04-19)', 'J00008', 'K00005'),
('B00220', '', 'POWER SUPPLY MODULE', '4662288C', 'K100791', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00222', '', 'HEATER PANEL ASSY.', '602953-00', 'K100775', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00223', '', 'VIKTOR MK 4 TRANDUCER', '4718450344', 'K101525', '', 'HULL MOUNTED SONAR', 'RAK 9A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00224', '', 'ELECTROMECHANICAL', '47229238AH', 'K100414', '', 'HULL MOUNTED SONAR', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00225', '', 'CAPACITOR MODULE', '56950517AA01', 'K100454', '', 'HULL MOUNTED SONAR', 'RAK 9A', 'NAVAL STORE', 0, 'EA', 'di ambil sertu AGUS S (12-01-19)', 'J00008', 'K00005'),
('B00226', '', 'EQUIPPED CHASSIS', '61559321AA', 'K100815', '', 'IFF', 'RAK9A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00227', '', 'SENSOR', '352250057061', 'K10101007', '', 'MW-08', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00228', '', 'GROUND CABLE', '14100029075', 'K101471', '', 'SSM MISSILE WEAPON SYSTEM', 'RAK 8A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00229', '', 'FANS ASSEMBLY', '14100015789', 'K101450', '', 'SSM MISSILE WEAPON SYSTEM', 'RAK 8A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00230', '', 'AMMUNITION 115 V - 400 PSU', '676-70/YI-3593', 'K101455', '', 'SSM MISSILE WEAPON SYSTEM', 'RAK 8A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00231', '', 'CABINET TOOL CASE', '1410006129', 'K101661', '', 'SSM MISSILE WEAPON SYSTEM', 'RAK 8A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00232', '', 'CPU/DISPLAY PANEL ASSY.', 'WTP089800001', 'K100903', '', 'TORPEDO LAUNCHING SYSTEM', 'RAK 8A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00233', '', 'R.A. CO. MB', '955672108600', 'K100616', '', 'BTS NAVRAD', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00234', '', 'RTV MOD 18', '955673147100', 'K100638', '', 'BTS NAVRAD', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00235', '', 'VME-10D15', '955672111700', 'K100619', '', 'BTS SAM', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00236', '', 'DSU 1 (MW-08)', '9556-811-201XX', 'K101648', '', 'COMMAND AND CONTROL SYSTEM', 'RAK 8A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00237', '', 'LIU RELAY BOARD', '261048-001', 'K101075', '', 'DECOY', 'RAK 8A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00238', '', 'LIU POWER MODULE IN', '261056-001', 'K101085', '', 'DECOY', 'RAK 8A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00239', '', 'TFT COLOUR LCD DISPLAY 12.1', '', 'K101629', '', 'DECOY', 'RAK 8A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00240', '', 'LIU CPU MODULE WITH WINDOWS XP', '', 'K101078', '', 'DECOY', 'RAK 8A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00241', '', 'RELAY BRD', '955672120400', 'K101015', '', 'EGCC', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00242', '', 'EXITER MODULE', '700141-536-00A', 'K100780', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00243', '', 'MAIN POWER SUPPLY MODULE', '4662295C', 'K100790', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00244', '', 'DSP MODULE', '700084-536-002', 'K100457', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00245', '', 'RECEIVER MODULE', '700108-536-001', 'K100779', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00246', '', 'PRESPOT SELECTOR MODULE', '60477501', 'K100764', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00247', '', 'PEC TRIPLEXER ACU 50', '602353-00', 'K100771', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00248', '', 'SYNTHESIZER MODULE OCXO', '70109-536-002', 'K100760', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00249', '', 'CPU MODULE', '700137-536002', 'K100782', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00250', '', 'PCRRV SENSE', '602356-00', 'K100774', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00251', '', 'POWER SUPPLY UNIT', '606488-00', 'K100762', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00252', '', 'AUDIO FREQUENCY MODULE', '4662290C', 'K100788', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00253', '', 'PEC DISTRIBUTION', '606083-00', 'K100753', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00254', '', 'PEC EXCITER', '', 'K100754', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00255', '', 'EXCITER MODULE', '700141536004', 'K100780', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00256', '', 'LUPS 24 V', 'LK1601-7ERP104', 'K100457', '', 'HULL MOUNTED SONAR', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00257', '', 'K. MULTIPL', '916973152300', 'K100486', '', 'LIROD MK2', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00258', '', 'PDK 35 BRD', '955672800000', 'K101050', '', 'MOC-L', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00259', '', 'VME JCI', '9556-72114400', 'K100620', '', 'MW-08', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00260', '', 'VME-DISS-P', '9556-721-19400', 'K101547', '', 'MW-08', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00261', '', 'VID GEN-MK3', '955672312900', 'K100622', '', 'MW-08', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00262', '', 'DC CONVERTER', '25175', 'K100798', '', 'PUBLIC ADDRESS SYSTEM', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00263', '', 'LINE INPUT MODULE', 'A1009-01', 'K100793', '', 'PUBLIC ADDRESS SYSTEM', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00264', '', 'MONITOR MODULE', 'A1051-01', 'K100796', '', 'PUBLIC ADDRESS SYSTEM', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00265', '', 'MASTER SUPERVISORY MODULE', '', 'K100797', '', 'PUBLIC ADDRESS SYSTEM', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00266', '', 'SPARE KIT CONSISING OF', '1429ATO1429E', 'K101577', '', 'TELEPHONE SYSTEM', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00267', '', 'POWER AMPLIFIER MODULE', '4662289D', 'K100792', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00268', '', 'POWER SUPPY UNIT', '604042-00', 'K100781', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00269', '', 'WIRED CHASSIS', '5611265A', 'K100783', '', 'EXTERNAL COMMUNICATIONS', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00270', '', 'HOUSING AMP (STA 10)', '00-05-89-14-00', 'K100776', '', 'EXTERNAL COMMUNICATIONS', 'RAK 9A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00271', '', 'FK 2100 M (ACU)', 'FK 2100 M', 'K100777', '', 'EXTERNAL COMMUNICATIONS', 'RAK 9A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00272', '', 'LINE SENSING', 'A0850', 'K100801', '', 'FOCON SYSTEM', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00273', '', 'KEYBOARD, 1100 ASSY.', '1100201', 'K100461', '', 'HULL MOUNTED SONAR', 'RAK 9A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00274', '', 'ELECTRICAL FILTER', '89161449AA', 'K100413', '', 'HULL MOUNTED SONAR', 'RAK 9A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00275', '', 'POWER SUPPLY', '89160519', 'K100424', '', 'HULL MOUNTED SONAR', 'RAK 9A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00276', '', 'FILTER 115 V MAIN 16 A', 'DS30230', 'K100429', '', 'HULL MOUNTED SONAR', 'RAK 9A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00277', '', 'CIT', '617760937AA', 'K100826', '', 'IFF', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00278', '', 'WIRED AMMUNITION DRAWER', '14100015815', 'K1001456', '', 'SSM MISSILE WEAPON SYSTEM', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00279', '', 'KEYBOARD WITH TOUCHPAD', 'WTP089800003', 'K100905', '', 'TORPEDO LAUNCHING SYSTEM', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00280', '', 'EXCITATION COIL', '258049-001', 'K101644', '', 'DECOY', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00281', '', 'RIS ANTENNA ASSY.', '518781022', 'K101073', '', 'DECOY', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00282', '', 'GCU', '897351478100', 'K100720', '', 'GIC 76 MM OSRG', 'RAK 7A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00283', '', 'OUTPUT TRANSFORMER', '56950536AA', 'K10049', '', 'HULL MOUNTED SONAR', 'RAK 9A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00284', '', 'TRACKER BALL', 'DT4655-00', 'K100460', '', 'HULL MOUNTED SONAR', 'RAK 9A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00285', '', 'MESUI PCB', '61181136AA', 'K100451', '', 'HULL MOUNTED SONAR', 'RAK 9A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00286', '', 'ELEMENTARY FAN', '91390758', 'K101527', '', 'HULL MOUNTED SONAR', 'RAK 9A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00287', '', 'T/R MODULE', '61178551AA01', 'K100446', '', 'HULL MOUNTED SONAR', 'RAK 9A', 'NAVAL STORE', 0, 'EA', '', 'J00008', 'K00005'),
('B00288', '', 'RAMPAK GENDANG', '1', '', '', '', '', '', 1, 'UNIT', '', 'J00012', 'K00006'),
('B00289', '', 'MAIN BEARING SHELL', '26004805318', '', '', 'MPK', 'BOX 1', 'GUDANG SPARE', 1, 'EA', '', 'J00016', 'K00005'),
('B00290', '', 'SPRING COOLAR', '26018011365', '', '', 'MPK', 'BOX 1', 'GUDANG SPARE', 12, 'EA', '', 'J00016', 'K00005'),
('B00291', '', 'O RING', '98609000012', '', '', 'MPK', 'BOX 1', 'GUDANG SPARE', 4, 'EA', '', 'J00016', 'K00005'),
('B00292', '', 'MAIN BEARING TIEROD', '26001000800', '', '', 'MPK', 'BOX 1', 'GUDANG SPARE', 2, 'EA', '', 'J00016', 'K00005'),
('B00293', '', 'INNER SPRING', '26018010585', '', '', 'MPK', 'BOX 1', 'GUDANG SPARE', 6, 'EA', '', 'J00016', 'K00005'),
('B00294', '', 'OUTER SPRING', '26018010586', '', '', 'MPK', 'BOX 1', 'GUDANG SPARE', 6, 'EA', '', 'J00016', 'K00005'),
('B00295', '', 'HALF SHELL', '99526013009', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 12, 'EA', '', 'J00016', 'K00005'),
('B00296', '', 'GASKET', '9860900005', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 2, 'EA', '', 'J00016', 'K00005'),
('B00297', '', 'CIRCLIP', '00201010110', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 2, 'EA', '', 'J00016', 'K00005'),
('B00298', '', 'RECHANGER/SPARES', '333', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 1, 'EA', '', 'J00016', 'K00005'),
('B00299', '', 'EXTRATOR FOR INJECTION PUMP VALVE SEAT', 'T-266', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 1, 'EA', '', 'J00016', 'K00005'),
('B00300', '', 'LOWER UPPER BEARING SHELL', '00133675/91', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 2, 'EA', '', 'J00016', 'K00005'),
('B00301', '', 'POWER SUPPLAY 15V DC AE 24/15', 'ZZAUT000914', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 1, 'EA', '', 'J00016', 'K00005'),
('B00302', '', 'KIT NR 07196A', '98640401124', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 10, 'EA', '', 'J00016', 'K00005'),
('B00303', '', 'KEYBOARD', 'DV 3000', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 1, 'EA', '', 'J00016', 'K00005'),
('B00304', '', 'EXHAUST MANIFOLD GASKET', '26018000006', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 1, 'EA', '', 'J00016', 'K00005'),
('B00305', '', 'COMPRESSION RING', '26014000620', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 2, 'EA', '', 'J00016', 'K00005'),
('B00306', '', 'SCRAPER RING', '26014900020', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 2, 'EA', '', 'J00016', 'K00005'),
('B00307', '', 'ELECTRO VALVE', 'ZZAUT002JD3', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 3, 'EA', '', 'J00016', 'K00005'),
('B00308', '', 'JOINT 321365/001', '36040000064', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 1, 'EA', '', 'J00016', 'K00005'),
('B00309', '', 'ELECTRO DISTRIBUTOR', '514191027', '514191023', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 11, 'EA', 'BEKAS', 'J00016', 'K00005'),
('B00310', '', 'GASKET KIT', '98705912240', '', '', 'MPK', 'BOX 2', 'GUDANG SPARE', 2, 'EA', '', 'J00016', 'K00005'),
('B00311', '', 'LEVEL SWITCH FLOAT FLANGEMOUNT', '5930AR0000495', '', '', 'MPK', 'BOX 3', 'GUDANG SPARE', 1, 'EA', '', 'J00016', 'K00005'),
('B00312', '', 'SAVETY VALVE', '4820AR0000877', '', '', 'MPK', 'BOX 3', 'GUDANG SPARE', 3, 'EA', '', 'J00016', 'K00005'),
('B00313', '', 'INJECTOR PIN', '26020000006', '', '', 'MPK', 'BOX 3', 'GUDANG SPARE', 66, 'EA', '', 'J00016', 'K00005'),
('B00314', '', 'LOCTITE 594', 'FR-99351200000', '', '', 'MPK', 'BOX 3', 'GUDANG SPARE', 6, 'EA', '', 'J00016', 'K00005'),
('B00315', '', 'LOCTITE 573', 'FR-99351320000', '', '', 'MPK', 'BOX 3', 'GUDANG SPARE', 12, 'EA', '', 'J00016', 'K00005'),
('B00316', '', 'LOCTITE 270', '', '', '', 'MPK', 'BOX 3', 'GUDANG SPARE', 3, 'EA', '', 'J00016', 'K00005');

-- --------------------------------------------------------

--
-- Table structure for table `brg_keluar`
--

CREATE TABLE `brg_keluar` (
  `idbrg_keluar` varchar(6) NOT NULL,
  `idkapal` varchar(6) NOT NULL,
  `tgl` date NOT NULL,
  `idusers` varchar(20) NOT NULL,
  `alasan` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `brg_keluar_detil`
--

CREATE TABLE `brg_keluar_detil` (
  `idbrg_k_detil` varchar(8) NOT NULL,
  `idbarang` varchar(6) NOT NULL,
  `jumlah` float NOT NULL DEFAULT 0,
  `satuan` varchar(15) NOT NULL,
  `idbrg_keluar` varchar(6) NOT NULL,
  `alasan` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
('M00002', 'K00005', '2022-07-05', 'U00008'),
('M00003', 'K00005', '2022-07-08', 'U00008');

-- --------------------------------------------------------

--
-- Table structure for table `brg_masuk_cair`
--

CREATE TABLE `brg_masuk_cair` (
  `idbrg_masuk` varchar(6) CHARACTER SET utf8mb4 NOT NULL,
  `idkapal` varchar(6) CHARACTER SET utf8mb4 NOT NULL,
  `tgl` date NOT NULL,
  `idusers` varchar(20) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
('MD000001', 'B00005', 1, 'ea', 'M00002'),
('MD000002', 'B00289', 1, 'EA', 'M00003'),
('MD000003', 'B00290', 12, 'EA', 'M00003'),
('MD000004', 'B00291', 4, 'EA', 'M00003'),
('MD000005', 'B00292', 2, 'EA', 'M00003'),
('MD000006', 'B00293', 6, 'EA', 'M00003'),
('MD000007', 'B00294', 6, 'EA', 'M00003'),
('MD000008', 'B00291', 2, 'EA', 'M00003'),
('MD000009', 'B00295', 12, 'EA', 'M00003'),
('MD000010', 'B00296', 2, 'EA', 'M00003'),
('MD000011', 'B00297', 2, 'EA', 'M00003'),
('MD000012', 'B00298', 1, 'EA', 'M00003'),
('MD000013', 'B00299', 1, 'EA', 'M00003'),
('MD000014', 'B00300', 2, 'EA', 'M00003'),
('MD000015', 'B00301', 1, 'EA', 'M00003'),
('MD000016', 'B00302', 10, 'EA', 'M00003'),
('MD000017', 'B00303', 1, 'EA', 'M00003'),
('MD000018', 'B00304', 1, 'EA', 'M00003'),
('MD000019', 'B00305', 2, 'EA', 'M00003'),
('MD000020', 'B00296', 2, 'EA', 'M00003'),
('MD000021', 'B00296', 2, 'EA', 'M00003'),
('MD000022', 'B00306', 2, 'EA', 'M00003'),
('MD000023', 'B00296', 2, 'EA', 'M00003'),
('MD000024', 'B00291', 1, 'EA', 'M00003'),
('MD000025', 'B00307', 3, 'EA', 'M00003'),
('MD000026', 'B00308', 1, 'EA', 'M00003'),
('MD000027', 'B00296', 39, 'EA', 'M00003'),
('MD000028', 'B00291', 6, 'EA', 'M00003'),
('MD000029', 'B00291', 12, 'EA', 'M00003'),
('MD000030', 'B00309', 11, 'EA', 'M00003'),
('MD000031', 'B00310', 2, 'EA', 'M00003'),
('MD000032', 'B00311', 1, 'EA', 'M00003'),
('MD000033', 'B00312', 3, 'EA', 'M00003'),
('MD000034', 'B00313', 66, 'EA', 'M00003'),
('MD000035', 'B00314', 6, 'EA', 'M00003'),
('MD000036', 'B00315', 12, 'EA', 'M00003'),
('MD000037', 'B00316', 3, 'EA', 'M00003');

-- --------------------------------------------------------

--
-- Table structure for table `brg_masuk_detil_cair`
--

CREATE TABLE `brg_masuk_detil_cair` (
  `idbrg_m_detil` varchar(8) CHARACTER SET utf8mb4 NOT NULL,
  `idbarang` varchar(6) CHARACTER SET utf8mb4 NOT NULL,
  `jumlah_minta` float NOT NULL DEFAULT 0,
  `jumlah_datang` float NOT NULL DEFAULT 0,
  `satuan` varchar(15) CHARACTER SET utf8mb4 NOT NULL,
  `file_bukti` varchar(150) DEFAULT NULL,
  `idbrg_masuk` varchar(6) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
('K00001', 'KOARMADA 2', 'Ghora Wira Madya Jala', 1985, 'Laksamana Muda TNI Iwan Isnurwanto, M.A.P., M.Tr.(Han).', 'Dermaga Ujung Surabaya, Jawa Timur', '60178', '08', '-', 'https://koarmada2.tnial.mil.id/', 'rampa@gmail.com', '1656675240_ad399acbd21bd47385a4.png', '-7.4063726', '112.5841074');

-- --------------------------------------------------------

--
-- Table structure for table `jenisbarang`
--

CREATE TABLE `jenisbarang` (
  `idjenisbarang` varchar(6) NOT NULL,
  `nama_jenis` varchar(45) NOT NULL,
  `idkapal` varchar(6) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenisbarang`
--

INSERT INTO `jenisbarang` (`idjenisbarang`, `nama_jenis`, `idkapal`) VALUES
('J00007', 'UMUM', 'K00005'),
('J00008', 'SEWACO', 'K00005'),
('J00009', 'PANTRY', 'K00006'),
('J00010', 'BAHARI', 'K00006'),
('J00011', 'CAT', 'K00006'),
('J00012', 'KESENIAN', 'K00006'),
('J00013', 'SPARE PART', 'K00006'),
('J00014', 'BARANG UMUM', 'K00006'),
('J00015', 'LAYAR', 'K00006'),
('J00016', 'platform', 'K00005');

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
('K00005', 'KRI DPN-365', '', ''),
('K00006', 'KRI BIMA SUCI', '1657007064_8ec660cf1c406a932484.png', '');

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
('R00003', 'Kepala gudang'),
('R00004', 'kadeplog');

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
('U00008', 'KRI DPN-365', 'aGtq', 'Naratama Yoga', NULL, NULL, NULL, NULL, NULL, 'R00003', 'K00005'),
('U00009', 'BSC-945', 'aGtqbZZo', 'mico prama', NULL, NULL, NULL, NULL, NULL, 'R00004', 'K00006');

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
-- Indexes for table `brg_masuk_cair`
--
ALTER TABLE `brg_masuk_cair`
  ADD PRIMARY KEY (`idbrg_masuk`),
  ADD KEY `FK_brg_masuk_cair_kapal` (`idkapal`),
  ADD KEY `FK_brg_masuk_cair_users` (`idusers`);

--
-- Indexes for table `brg_masuk_detil`
--
ALTER TABLE `brg_masuk_detil`
  ADD PRIMARY KEY (`idbrg_m_detil`),
  ADD KEY `FK_brg_masuk_detil_brg` (`idbarang`),
  ADD KEY `FK_brg_masuk_detil_key` (`idbrg_masuk`);

--
-- Indexes for table `brg_masuk_detil_cair`
--
ALTER TABLE `brg_masuk_detil_cair`
  ADD PRIMARY KEY (`idbrg_m_detil`),
  ADD KEY `FK_brg_masuk_detil_cair_barang` (`idbarang`),
  ADD KEY `FK_brg_masuk_detil_cair_key` (`idbrg_masuk`);

--
-- Indexes for table `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `jenisbarang`
--
ALTER TABLE `jenisbarang`
  ADD PRIMARY KEY (`idjenisbarang`),
  ADD KEY `FK_jenisbarang_kapal` (`idkapal`);

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
