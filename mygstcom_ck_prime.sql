-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 28, 2026 at 01:42 AM
-- Server version: 5.7.23-23
-- PHP Version: 8.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mygstcom_ck_prime`
--

-- --------------------------------------------------------

--
-- Table structure for table `additem`
--

CREATE TABLE `additem` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `uom` varchar(255) DEFAULT NULL,
  `itemcode` varchar(255) DEFAULT NULL,
  `itemname` text CHARACTER SET utf8,
  `patterncode` varchar(255) NOT NULL,
  `drawingno` varchar(100) NOT NULL,
  `pattern_material` varchar(255) NOT NULL,
  `casting_weight` varchar(255) NOT NULL,
  `liquid_weight` varchar(255) NOT NULL,
  `yield` varchar(255) NOT NULL,
  `price` varchar(255) DEFAULT NULL,
  `taxtype` varchar(225) DEFAULT NULL,
  `sgst` varchar(255) DEFAULT NULL,
  `cgst` varchar(255) DEFAULT NULL,
  `igst` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `priceType` varchar(10) NOT NULL,
  `itemtype` varchar(255) NOT NULL,
  `purchaseNo` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `additem`
--

INSERT INTO `additem` (`id`, `date`, `uom`, `itemcode`, `itemname`, `patterncode`, `drawingno`, `pattern_material`, `casting_weight`, `liquid_weight`, `yield`, `price`, `taxtype`, `sgst`, `cgst`, `igst`, `status`, `priceType`, `itemtype`, `purchaseNo`) VALUES
(1, '2026-02-10', '2', 'SP01', 'Coal Nozzle ', '', 'C-13-004', 'Teakwood Pattern', '-', '-', '', '200000', '1', '9', '9', '18', '1', 'Exclusive', '', NULL),
(2, '2026-02-10', '2', 'SP01', 'Coal Nozzle(C)', '', 'C-13-004', 'Cast Iron', '95.2', '105.5', '90.24', '590', '1', '9', '9', '18', '1', 'Exclusive', '', NULL),
(3, '2026-02-11', '2', 'CA16', '1/2\" CL 600 Body', '', '-', 'Aluminium', '3', '9', '33.33', '1250', '1', '9', '9', '18', '1', 'Exclusive', '', NULL),
(4, '2026-02-11', '2', 'SBM08', 'EH Outer Box', '', 'ST-MSC-017', 'Aluminium', '34.5', '40.2', '85.82', '167', '1', '9', '9', '18', '1', 'Exclusive', '', NULL),
(5, '2026-02-11', '2', 'SBM03', 'LH Outer Box', '', 'ST-MSC-016', 'Aluminium', '25.4', '35', '72.57', '167', '1', '9', '9', '18', '1', 'Exclusive', '', NULL),
(6, '2026-02-11', '2', 'SBM05', 'LH Inner Box', '', 'ST-MSC-014-R1', 'Aluminium', '26.1', '45', '58.00', '167', '1', '9', '9', '18', '1', 'Exclusive', '', NULL),
(7, '2026-02-11', '2', 'SBM10', '12FN Top Plate', '', 'STMSC022 R1', 'Aluminium', '27', '30', '90.00', '167', '1', '9', '9', '18', '1', 'Exclusive', '', NULL),
(8, '2026-02-11', '2', 'SBM02', 'NH Outer Box', '', 'ST-MSC-015', 'Aluminium', '28', '35', '80.00', '167', '1', '9', '9', '18', '1', 'Exclusive', '', NULL),
(9, '2026-02-11', '2', 'SBM04', 'NH Inner Box', '', 'ST-MSC-013 R1', 'Aluminium', '28.5', '30', '95.00', '167', '1', '9', '9', '18', '1', 'Exclusive', '', NULL),
(10, '2026-02-11', '2', 'SBM15', 'EH Inner Box', '', 'ST-MSC-027 R0', 'Aluminium', '29', '40', '72.50', '167', '1', '9', '9', '18', '1', 'Exclusive', '', NULL),
(11, '2026-02-11', '2', 'SBM09', 'Moving Block', '', 'ST-MSC-012 R1', 'Aluminium', '10.85', '25', '43.40', '167', '1', '9', '9', '18', '1', 'Exclusive', '', NULL),
(12, '2026-02-11', '2', 'SP02', 'Collector Casting', '', '3-SPG-9473', 'Aluminium', '26.5', '35', '75.71', '538', '1', '9', '9', '18', '1', 'Exclusive', '', NULL),
(13, '2026-02-11', '2', 'SP03', 'Collector Casting 8557', '', '3-SPG-8557 ', 'Aluminium', '31', '32', '96.88', '342', '1', '9', '9', '18', '1', 'Exclusive', '', NULL),
(14, '2026-02-11', '2', 'SP04', 'Flame Holder Segment', '', '4-SPG-10462R/01', 'Aluminium', '2.7', '3', '90.00', '542', '1', '9', '9', '18', '1', 'Exclusive', '', NULL),
(15, '2026-02-11', '2', 'OMI 01', 'Retainer 2.0', '', '2.067398', 'Teakwood', '112.5', '115', '97.83', '185', '1', '9', '9', '18', '1', 'Exclusive', '', NULL),
(16, '2026-02-11', '2', 'OMI 02', 'Retainer 3.0', '', '3.062269', 'Teakwood', '52', '55', '94.55', '185', '1', '9', '9', '18', '1', 'Exclusive', '', NULL),
(17, '2026-02-12', '2', '001', 'Inspection', '', '-', '-', '-', '-', '', '2000', '1', '9', '9', '18', '1', 'Exclusive', '', NULL),
(18, '2026-02-13', '2', 'CA02', '4\" 1500 Body', '', 'CAD-SPS-YST-0001', 'TEAKWOOD', '212', '250', '84.80', '220', '1', '9', '9', '18', '1', 'Exclusive', '', NULL),
(19, '2026-02-13', '2', 'OMI 01', 'Retainer 2.0  Pattern', '', '2.067398', 'Teakwood', '-', '-', '', '45500', '1', '9', '9', '18', '1', 'Exclusive', '', NULL),
(20, '2026-02-13', '2', 'OMI 02', 'Retainer 3.0 Pattern', '', '3.062269', 'Teakwood', '-', '-', '', '35000', '1', '9', '9', '18', '1', 'Exclusive', '', NULL),
(21, '2026-02-14', '2', 'SP03', 'Collector Casting 3-SPG-8557', '', '3-SPG-8557', 'Aluminium Pattern', '-', '-', '', '10000', '1', '9', '9', '18', '1', 'Exclusive', '', NULL),
(22, '2026-02-14', '2', 'WC1', 'Website Creation', '', '-', '-', '-', '-', '', '6000', '1', '9', '9', '18', '1', 'Exclusive', '', NULL),
(23, '2026-02-18', '2', 'TB1', 'TEST BAR(300mmX50mmX50mm)', '', '', 'ALUMINIUM', '6', '10', '60.00', '175', '1', '9', '9', '18', '1', 'Exclusive', '', NULL),
(24, '2026-02-25', '2', 'PR1', 'Pattern Rework Cost', '-', '-', '-', '-', '-', '', '9500', '1', '9', '9', '18', '1', 'Exclusive', '', NULL),
(25, '2026-02-25', '2', 'FC1', 'Forwarding Cost', '-', '-', '-', '-', '-', '', '1000', '1', '9', '9', '18', '1', 'Exclusive', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `add_staff`
--

CREATE TABLE `add_staff` (
  `id` int(11) NOT NULL,
  `staff_id` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `staff_name` varchar(255) NOT NULL,
  `mobileno` varchar(255) NOT NULL,
  `amobileno` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `referred` varchar(255) NOT NULL,
  `salary` varchar(255) NOT NULL,
  `salarytype` varchar(255) NOT NULL,
  `perdaysalary` varchar(255) NOT NULL,
  `ot` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(10) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `attendancedate` date NOT NULL,
  `staff` varchar(255) NOT NULL,
  `attendances` varchar(255) NOT NULL,
  `intime` varchar(255) NOT NULL,
  `outtime` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `lastupdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `backup_details`
--

CREATE TABLE `backup_details` (
  `id` int(11) NOT NULL,
  `file_name` longtext,
  `date_created` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `backup_details`
--

INSERT INTO `backup_details` (`id`, `file_name`, `date_created`) VALUES
(1, 'backup-on-2026-02-09-12-32-46.zip', '2026-02-09'),
(2, 'backup-on-2026-02-10-12-45-42.zip', '2026-02-10'),
(3, 'backup-on-2026-02-11-11-13-06.zip', '2026-02-11'),
(4, 'backup-on-2026-02-12-12-20-25.zip', '2026-02-12'),
(5, 'backup-on-2026-02-13-11-41-45.zip', '2026-02-13'),
(6, 'backup-on-2026-02-14-13-10-01.zip', '2026-02-14'),
(7, 'backup-on-2026-02-16-16-59-54.zip', '2026-02-16'),
(8, 'backup-on-2026-02-17-12-04-29.zip', '2026-02-17'),
(9, 'backup-on-2026-02-18-11-16-55.zip', '2026-02-18'),
(10, 'backup-on-2026-02-20-11-55-50.zip', '2026-02-20'),
(11, 'backup-on-2026-02-24-10-05-20.zip', '2026-02-24'),
(12, 'backup-on-2026-02-25-11-02-56.zip', '2026-02-25'),
(13, 'backup-on-2026-02-27-10-43-02.zip', '2026-02-27');

-- --------------------------------------------------------

--
-- Table structure for table `backup_url`
--

CREATE TABLE `backup_url` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bed_details`
--

CREATE TABLE `bed_details` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `bed` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cashbill_details`
--

CREATE TABLE `cashbill_details` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `taxtype` varchar(255) DEFAULT NULL,
  `invoiceno` varchar(225) DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(225) DEFAULT NULL,
  `cust_mobno` varchar(255) NOT NULL,
  `address` varchar(225) DEFAULT NULL,
  `gsttype` varchar(225) DEFAULT NULL,
  `typesgst` longtext,
  `typecgst` longtext,
  `typeigst` longtext,
  `hsnno` longtext,
  `itemname` longtext,
  `uom` longtext,
  `rate` longtext,
  `qty` longtext,
  `amount` longtext,
  `discount` longtext,
  `discountBy` varchar(255) NOT NULL,
  `discountamount` longtext,
  `taxableamount` longtext,
  `sgst` longtext,
  `sgstamount` longtext,
  `cgst` longtext,
  `cgstamount` longtext,
  `igst` longtext,
  `igstamount` longtext,
  `total` longtext,
  `subtotal` varchar(225) DEFAULT NULL,
  `freightamount` varchar(225) DEFAULT NULL,
  `freightcgst` varchar(225) DEFAULT NULL,
  `freightcgstamount` varchar(225) DEFAULT NULL,
  `freightsgst` varchar(225) DEFAULT NULL,
  `freightsgstamount` varchar(225) DEFAULT NULL,
  `freightigst` varchar(255) NOT NULL,
  `freightigstamount` varchar(225) DEFAULT NULL,
  `freighttotal` varchar(225) DEFAULT NULL,
  `loadingamount` varchar(225) DEFAULT NULL,
  `loadingcgst` varchar(225) DEFAULT NULL,
  `loadingcgstamount` varchar(225) DEFAULT NULL,
  `loadingsgst` varchar(225) DEFAULT NULL,
  `loadingsgstamount` varchar(225) DEFAULT NULL,
  `loadingigst` varchar(225) DEFAULT NULL,
  `loadingigstamount` varchar(225) DEFAULT NULL,
  `loadingtotal` varchar(225) DEFAULT NULL,
  `roundOff` varchar(255) NOT NULL,
  `othercharges` varchar(225) DEFAULT NULL,
  `return_status` longtext,
  `grandtotal` varchar(225) DEFAULT NULL,
  `invoicenodate` varchar(225) DEFAULT NULL,
  `invoicenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL,
  `systemDate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cashbill_reports`
--

CREATE TABLE `cashbill_reports` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `taxtype` varchar(255) DEFAULT NULL,
  `systemDate` date DEFAULT NULL,
  `invoiceno` varchar(255) DEFAULT NULL,
  `invoicedate` varchar(255) DEFAULT NULL,
  `paymenttype` varchar(255) DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(255) DEFAULT NULL,
  `mobileno` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gsttype` varchar(255) DEFAULT NULL,
  `hsnno` varchar(255) DEFAULT NULL,
  `itemno` varchar(255) DEFAULT NULL,
  `itemname` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `totalamount` varchar(255) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `disamount` varchar(255) DEFAULT NULL,
  `grandtotal` varchar(255) DEFAULT NULL,
  `paid` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `invoicenoyear` varchar(255) DEFAULT NULL,
  `invoicenodate` varchar(255) DEFAULT NULL,
  `invoiceid` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cash_bill`
--

CREATE TABLE `cash_bill` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `orderno` varchar(255) DEFAULT NULL,
  `orderdate` date DEFAULT NULL,
  `invoiceno` varchar(225) DEFAULT NULL,
  `invoicetype` varchar(225) DEFAULT NULL,
  `dcno` longtext,
  `customername` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `deliveryat` varchar(225) DEFAULT NULL,
  `transportmode` varchar(255) DEFAULT NULL,
  `vehicleno` varchar(225) DEFAULT NULL,
  `billtype` varchar(255) DEFAULT NULL,
  `gsttype` varchar(225) DEFAULT NULL,
  `typesgst` longtext,
  `typecgst` longtext,
  `typeigst` longtext,
  `dcnos` longtext,
  `insertid` varchar(225) DEFAULT NULL,
  `deliveryid` longtext,
  `hsnno` longtext,
  `itemname` longtext,
  `uom` longtext,
  `rate` longtext,
  `qty` longtext,
  `amount` longtext,
  `discount` longtext,
  `discountamount` longtext,
  `taxableamount` longtext,
  `sgst` longtext,
  `sgstamount` longtext,
  `cgst` longtext,
  `cgstamount` longtext,
  `igst` longtext,
  `igstamount` longtext,
  `total` longtext,
  `subtotal` varchar(225) DEFAULT NULL,
  `freightcharges` varchar(225) DEFAULT NULL,
  `packingcharges` varchar(225) DEFAULT NULL,
  `othercharges` varchar(225) DEFAULT NULL,
  `return_status` longtext,
  `grandtotal` varchar(225) DEFAULT NULL,
  `invoicenodate` varchar(225) DEFAULT NULL,
  `invoicenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `category` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `collection_details`
--

CREATE TABLE `collection_details` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `receiptdate` date DEFAULT NULL,
  `throughcheck` varchar(255) DEFAULT NULL,
  `receiptno` varchar(255) DEFAULT NULL,
  `customername` varchar(255) DEFAULT NULL,
  `mobileno` varchar(255) DEFAULT NULL,
  `totalamount` varchar(255) DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `alreadypaid` varchar(255) DEFAULT NULL,
  `alreadybalance` varchar(255) DEFAULT NULL,
  `chamount` varchar(255) DEFAULT NULL,
  `banktransfer` varchar(255) DEFAULT NULL,
  `bankamount` varchar(255) DEFAULT NULL,
  `chequeno` varchar(255) DEFAULT NULL,
  `paymentmode` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `invoiceno` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `paymentdetails` varchar(255) DEFAULT NULL,
  `overallamount` varchar(255) DEFAULT NULL,
  `receiptamt` varchar(255) DEFAULT NULL,
  `invoiceamt` varchar(255) DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `paid` varchar(255) DEFAULT NULL,
  `invoicenoyear` varchar(255) DEFAULT NULL,
  `invoicenodate` varchar(255) DEFAULT NULL,
  `invoiceid` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company_logo`
--

CREATE TABLE `company_logo` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_logo`
--

INSERT INTO `company_logo` (`id`, `date`, `image`, `status`) VALUES
(1, '2025-07-14', 'Untitled.png', '1');

-- --------------------------------------------------------

--
-- Table structure for table `customerpo_details`
--

CREATE TABLE `customerpo_details` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `pono` varchar(255) DEFAULT NULL,
  `cuspodate` date DEFAULT NULL,
  `invoicetype` varchar(255) DEFAULT NULL,
  `paymenttype` varchar(255) DEFAULT NULL,
  `customername` varchar(255) DEFAULT NULL,
  `cuspono` varchar(255) DEFAULT NULL,
  `transport` varchar(255) DEFAULT NULL,
  `customerpodate` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `itemno` varchar(255) DEFAULT NULL,
  `itemname` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `disamount` varchar(255) DEFAULT NULL,
  `taxname` varchar(255) DEFAULT NULL,
  `taxamount` varchar(255) DEFAULT NULL,
  `cstname` varchar(255) DEFAULT NULL,
  `cstamount` varchar(255) DEFAULT NULL,
  `pf` varchar(255) DEFAULT NULL,
  `freight` varchar(255) DEFAULT NULL,
  `adjustment` varchar(255) DEFAULT NULL,
  `grandtotal` varchar(255) DEFAULT NULL,
  `taxtotal` varchar(255) DEFAULT NULL,
  `adjus` varchar(255) DEFAULT NULL,
  `vatadjus` varchar(255) DEFAULT NULL,
  `cstadjus` varchar(255) DEFAULT NULL,
  `pfadjus` varchar(255) DEFAULT NULL,
  `freightadjus` varchar(255) DEFAULT NULL,
  `roundoff` varchar(255) DEFAULT NULL,
  `paid` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phoneno` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `contactperson` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `tinno` varchar(255) DEFAULT NULL,
  `cstno` varchar(255) DEFAULT NULL,
  `creditdays` varchar(255) DEFAULT NULL,
  `openingbal` varchar(255) DEFAULT NULL,
  `old_openingBal` varchar(255) DEFAULT NULL,
  `salesamount` varchar(255) DEFAULT NULL,
  `paidamount` varchar(255) DEFAULT NULL,
  `balanceamount` varchar(255) DEFAULT NULL,
  `returnamount` varchar(255) DEFAULT NULL,
  `panno` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `eccno` varchar(255) DEFAULT NULL,
  `range` varchar(255) DEFAULT NULL,
  `division` varchar(255) DEFAULT NULL,
  `commissionerate` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `accountname` varchar(100) NOT NULL,
  `printname` varchar(100) NOT NULL,
  `statecode` varchar(255) NOT NULL,
  `gstno` varchar(255) NOT NULL,
  `adharno` varchar(255) NOT NULL,
  `bankname` varchar(100) NOT NULL,
  `accountno` varchar(100) NOT NULL,
  `accountpay` varchar(255) NOT NULL,
  `chequeno` varchar(100) NOT NULL,
  `last_modified` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`id`, `date`, `type`, `name`, `phoneno`, `email`, `address1`, `address2`, `contactperson`, `state`, `city`, `tinno`, `cstno`, `creditdays`, `openingbal`, `old_openingBal`, `salesamount`, `paidamount`, `balanceamount`, `returnamount`, `panno`, `location`, `pincode`, `eccno`, `range`, `division`, `commissionerate`, `remarks`, `status`, `accountname`, `printname`, `statecode`, `gstno`, `adharno`, `bankname`, `accountno`, `accountpay`, `chequeno`, `last_modified`) VALUES
(1, '2025-09-17', 'Intra customer', 'jack', '7806876370', 'jack@gmail.com', 'gandhipuram', 'singanallur', 'maddy', 'Tamil Nadu', 'karaikudi', '', '', NULL, '0.00', NULL, '54260848.62', '300', '54260548.62', NULL, '', NULL, '654616', NULL, NULL, NULL, NULL, NULL, '1', '', '', '33', '33ADXPT3291N2ZJ', '', '', '', '', '', '2025-09-17'),
(2, '2025-07-17', 'Intra customer', 'SIGMA POWER & ENERGY ENGINEERS', '7339666782', 'sigmapower@sigmapower.in', 'PLOT No.E-5 SIDCO INDUSTRIES ESTATE', 'Phase II, VALAVANTHAN KOTTAI, THUVAKUDI', 'NANDHINI.P', 'Tamil Nadu', 'TRICHY', '', '', NULL, '0.00', NULL, '981506.92', '8800', '1244706.92', NULL, '', NULL, '620015', NULL, NULL, NULL, NULL, NULL, '1', '', '', '33', '33ABRFS2547Q1ZD', '', '', '', '', '', '2025-07-17'),
(3, '2026-01-29', 'Intra supplier', 'CK PRIME ALLOYS', '9159531031', '', 'ANNUR ROAD', 'KARUMATTAMPATTY', 'C.Karthik', 'Tamil Nadu', 'COIMBATORE', '', '', NULL, '0.00', NULL, '4324232.72', '2400', '4321832.72', NULL, '', NULL, '641659', NULL, NULL, NULL, NULL, NULL, '1', '', 'Somanur Branch', '33', '33CGRPR4623R1ZI', '', 'City Union Bank', '510909010332667 ', '', 'CIUB0000097', '2026-01-29'),
(4, '2025-06-23', 'Intra customer', 'IT Solution', '09360296512', '', 'Hoysala nagar, Ramamurthy signal', 'Kasthuri nagar', 'Pradeepa D', 'Karnataka', 'Bangalore', '', '', NULL, '0.00', NULL, '2366.7', '500', '1866.7', NULL, '', NULL, '560016', NULL, NULL, NULL, NULL, NULL, '1', '', '', '29', '', '', '', '', '', '', '2025-06-23'),
(5, '2025-06-24', 'Intra supplier', 'Gateway', '9500995841', 'lithikutti81@gmail.com', 'Kasthuri nagar, Sri lakshmi apartement', 'Bangalore', 'Lithi', 'Karnataka', 'Bangalore', '', '', NULL, '0.00', NULL, '44370326.66', '500', '22185347.58', '995.50', '', NULL, '560016', NULL, NULL, NULL, NULL, NULL, '1', '', '', '29', '', '', '', '', '', '', '2025-06-24'),
(6, '2025-06-25', 'Intra customer', 'Tech AU', '1234567890', 'pradee@gmail.com', 'Hoysala nagar, Ramamurthy signal', 'Avinashi Road, Hopes College', 'Pradeepa D', 'Tamil Nadu', 'Bangalore', '', '', NULL, '0.00', NULL, NULL, NULL, '0.00', NULL, '', NULL, '560016', NULL, NULL, NULL, NULL, NULL, '1', '', '', '33', '', '', '', '', '', '', '2025-06-25'),
(7, '2025-07-17', 'Intra customer', 'M/S CADALAN OFFSHORE PRIVATE LIMITED', '7708330192', 'sales@cadalan.com.sg', 'No:54 SRI VIGNESHWAR ILLAM', 'MGR NAGAR, GOLDWINS', 'SELVARAJ', 'Tamil Nadu', 'Coimbatore', '', '', NULL, '0.00', NULL, '6595250.1', NULL, '14778367.7', NULL, '', NULL, '641014', NULL, NULL, NULL, NULL, NULL, '1', '', '', '33', '33AAICC6141M1ZK', '', '', '', '', '', '2025-07-17'),
(8, '2025-10-08', 'Intra supplier', 'PREMIER ALLOYS', '9894021872', 'premieralloys@yahoo.com', 'No 2, Goldwins,Avinashi Road, ', 'Civil Aerodrome(po)', 'SARAN', 'Tamil Nadu', 'Coimbatore', '', '', NULL, '0.00', NULL, '5739887.94', NULL, '3399351.62', NULL, '', NULL, '641014', NULL, NULL, NULL, NULL, NULL, '1', '', '', '33', '33AAHFP3172F1ZG', '', '', '', '', '', '2025-10-08'),
(9, '2025-11-20', 'Intra customer', 'STAAN BIO MED PVT LTD', '9710240325', 'murugan@staan.in', '190-A, Bharathiar Road', 'Ganapathy', 'MURUGAN', 'Tamil Nadu', 'Coimbatore', '', '', NULL, '0.00', NULL, '-2548427.24', NULL, '976889.56', NULL, '', NULL, '641006', NULL, NULL, NULL, NULL, NULL, '1', '', '', '33', '33AAICS8026R1ZQ', '', '', '', '', '', '2025-11-20'),
(10, '2025-12-15', 'Intra supplier', 'Shristi Engineering Works', '9500990107', 'shrishtienggworks@yahoo.com', 'Door No.3,Ravathur Road,', 'Athappa Gounder Pudur,Irugur', 'SELVARAJ ', 'Tamil Nadu', 'Coimbatore', '', '', NULL, '0.00', NULL, '57348', NULL, '38232', NULL, '', NULL, '641103', NULL, NULL, NULL, NULL, NULL, '1', '', 'AVINASHI ROAD', '33', '33CUBPS7373B1ZO', '', 'SOUTH INDIAN BANK', '0772081000000254', '', 'SIBL0000772', '2025-12-15'),
(11, '2026-02-10', 'Intra supplier', 'Sri Ayyappa Engineering Works', '7871652509', 'saenggworks2020@gmail.com', '4/348C,Kallipalayam Road', 'Chikarampalayam, Karamadai', 'Manikandan', 'Tamil Nadu', 'Coimbatore', '', '', NULL, '0.00', NULL, '265500', NULL, '265500', NULL, '', NULL, '641104', NULL, NULL, NULL, NULL, NULL, '1', '', '', '33', '33AECFS3283F1Z6', '', '', '', '', '', '2026-02-10'),
(12, '2026-02-12', 'Intra supplier', 'PKS Inspection Service', '9965223671', 'pkinspections@gmail.com', '83A Pudukadu 2nd Street,Sivanathapuram', 'Vellakovil-638111,Kangeyam Taluk', 'Prakash', 'Tamil Nadu', 'Tiruppur', '', '', NULL, '0.00', NULL, '7080', NULL, '4720', NULL, '', NULL, '638111', NULL, NULL, NULL, NULL, NULL, '1', 'PKS Inspection Service', 'Sulur', '33', '33BMHPP7661N1ZE', '', 'Bank of India', '824020110000850', '', 'BKID0008240', '2026-02-12'),
(13, '2026-02-12', 'Intra customer', 'CKP LOI', '9790153461', '', 'SF NO.845B,D.NO.1J(4)', 'Annur,Rayarpalayam', 'Hema latha', 'Tamil Nadu', 'Coimbatore', '', '', NULL, '0.00', NULL, NULL, NULL, '0.00', NULL, '', NULL, '641659', NULL, NULL, NULL, NULL, NULL, '1', '', '', '33', '33CGRPR4623R1ZI', '', '', '', '', '', '2026-02-12'),
(14, '2026-02-13', 'Intra supplier', 'Shree Kumaran Alloys', '9952424271', 'ska@shreekumaranalloys.com', 'S/F No - 461, Telungupalayam Road,', 'Ellapalayam Post,Annur', 'M.Prakash', 'Tamil Nadu', 'Coimbatore', '', '', NULL, '0.00', NULL, '217548', NULL, '217548', NULL, '', NULL, '641697', NULL, NULL, NULL, NULL, NULL, '1', '', 'Ganapathy', '33', '33ABFFS0702H1ZN', '', 'Indian Overseas Bank', '061302000010284', '', 'IOBA0000613', '2026-02-13'),
(15, '2026-02-13', 'Intra customer', 'OM Industries', '9791321620', 'omdamu@gmail.com', 'No:230/2, 4Th Cross,', 'Vanapadi Road,Sipcot', 'Damotharan', 'Tamil Nadu', 'Ranipet', '', '', NULL, '0.00', NULL, NULL, NULL, '0.00', NULL, '', NULL, '632403', NULL, NULL, NULL, NULL, NULL, '1', '', '', '33', '33ABKPL9684J1Z0', '', '', '', '', '', '2026-02-13'),
(16, '2026-02-14', 'Intra supplier', 'TryMy Website', '9597236423', 'trymywebsites@gmail.com', '2nd Floor, SK Towers, Sathy Main Road, ', 'Saravanampatti', 'Kumar', 'Tamil Nadu', 'Coimbatore', '', '', NULL, '0.00', NULL, NULL, NULL, '0.00', NULL, '', NULL, '641035', NULL, NULL, NULL, NULL, NULL, '1', '', '', '33', '33LSFPS9739E1Z3', '', '', '', '', '', '2026-02-14');

-- --------------------------------------------------------

--
-- Table structure for table `dcbill_details`
--

CREATE TABLE `dcbill_details` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `dctype` varchar(225) DEFAULT NULL,
  `dcno` varchar(225) DEFAULT NULL,
  `dcdate` date DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `cusname` varchar(225) DEFAULT NULL,
  `dispatchthrough` varchar(225) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `process` varchar(255) DEFAULT NULL,
  `remarkss` varchar(255) DEFAULT NULL,
  `approximate_value` varchar(255) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `inwardno` longtext,
  `customerdcno` longtext,
  `customerdcdate` longtext,
  `itemname` longtext,
  `itemid` varchar(100) NOT NULL,
  `heatno` varchar(100) NOT NULL,
  `item_desc` text NOT NULL,
  `qty` longtext,
  `remarks` longtext,
  `hsnno` longtext,
  `itemcode` varchar(255) DEFAULT NULL,
  `uom` longtext,
  `grade` varchar(100) NOT NULL,
  `weight` varchar(100) DEFAULT NULL,
  `dcnoyear` varchar(225) DEFAULT NULL,
  `dcnodate` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `delete_status` int(11) DEFAULT NULL,
  `billtype` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dcbill_details_backup`
--

CREATE TABLE `dcbill_details_backup` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `dctype` varchar(225) DEFAULT NULL,
  `dcno` varchar(225) DEFAULT NULL,
  `dcdate` date DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `cusname` varchar(225) DEFAULT NULL,
  `dispatchthrough` varchar(225) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `process` varchar(255) DEFAULT NULL,
  `remarkss` varchar(255) DEFAULT NULL,
  `approximate_value` varchar(255) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `inwardno` longtext,
  `customerdcno` longtext,
  `customerdcdate` longtext,
  `itemname` longtext,
  `itemid` varchar(100) NOT NULL,
  `heatno` varchar(100) NOT NULL,
  `item_desc` text NOT NULL,
  `qty` longtext,
  `remarks` longtext,
  `hsnno` longtext,
  `itemcode` varchar(255) DEFAULT NULL,
  `uom` longtext,
  `grade` varchar(100) NOT NULL,
  `dcnoyear` varchar(225) DEFAULT NULL,
  `dcnodate` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `delete_status` int(11) DEFAULT NULL,
  `billtype` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dc_delivery`
--

CREATE TABLE `dc_delivery` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `insertid` int(11) NOT NULL,
  `inwardid` int(11) DEFAULT NULL,
  `dctype` varchar(225) NOT NULL,
  `dcno` varchar(225) NOT NULL,
  `dcdate` varchar(225) NOT NULL,
  `customerId` int(11) NOT NULL,
  `cusname` varchar(225) NOT NULL,
  `dispatchthrough` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL,
  `inwardno` longtext,
  `customerdcno` varchar(225) DEFAULT NULL,
  `customerdcdate` varchar(225) DEFAULT NULL,
  `itemname` longtext NOT NULL,
  `itemid` varchar(100) NOT NULL,
  `heatno` varchar(100) DEFAULT NULL,
  `item_desc` text NOT NULL,
  `qty` longtext NOT NULL,
  `balanceqty` varchar(225) DEFAULT NULL,
  `remarks` longtext NOT NULL,
  `hsnno` longtext NOT NULL,
  `itemcode` varchar(255) DEFAULT NULL,
  `uom` longtext NOT NULL,
  `grade` varchar(100) NOT NULL,
  `weight` varchar(100) DEFAULT NULL,
  `remarkss` varchar(255) DEFAULT NULL,
  `dcnoyear` varchar(225) NOT NULL,
  `dcnodate` varchar(225) NOT NULL,
  `status` int(11) NOT NULL,
  `dc_status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dpt_report`
--

CREATE TABLE `dpt_report` (
  `id` int(11) NOT NULL,
  `date` varchar(100) NOT NULL,
  `dpt_report_no` varchar(100) NOT NULL,
  `dpt_date` varchar(100) NOT NULL,
  `customername` varchar(100) DEFAULT NULL,
  `customerid` varchar(100) DEFAULT NULL,
  `report_no` varchar(100) DEFAULT NULL,
  `stage_of_test` varchar(100) DEFAULT NULL,
  `grade` varchar(100) DEFAULT NULL,
  `type_of_penetrant` varchar(100) DEFAULT NULL,
  `casting_temperature` varchar(100) DEFAULT NULL,
  `type_of_developer` varchar(100) DEFAULT NULL,
  `surface_condition` varchar(100) DEFAULT NULL,
  `testing_date` varchar(100) DEFAULT NULL,
  `acceptance_standard` varchar(100) DEFAULT NULL,
  `dwell_time` varchar(100) DEFAULT NULL,
  `procedure_ref` varchar(100) DEFAULT NULL,
  `fluosrecent` varchar(100) DEFAULT NULL,
  `area_method_of_test` varchar(100) DEFAULT NULL,
  `penetrant_apply_method` varchar(10) DEFAULT NULL,
  `precleaning_method` varchar(100) DEFAULT NULL,
  `post_of_test_cleaning` varchar(100) DEFAULT NULL,
  `light_indensity` varchar(100) DEFAULT NULL,
  `background` varchar(100) DEFAULT NULL,
  `result` varchar(100) DEFAULT NULL,
  `description` text,
  `drawing_no` text,
  `heat_no` text,
  `dp_no` text,
  `qty` text,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `einvoicetoken`
--

CREATE TABLE `einvoicetoken` (
  `id` int(11) NOT NULL,
  `tokenexpiry` varchar(255) NOT NULL,
  `authtoken` varchar(255) NOT NULL,
  `sek` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `expensesid` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `expensesdate` date DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `paymentmode` varchar(255) DEFAULT NULL,
  `throughcheck` varchar(255) DEFAULT NULL,
  `chequeno` varchar(255) DEFAULT NULL,
  `chamount` varchar(255) DEFAULT NULL,
  `banktransfer` varchar(255) DEFAULT NULL,
  `bamount` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `cardtype` varchar(255) DEFAULT NULL,
  `paymentdetails` varchar(255) DEFAULT NULL,
  `overallamount` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `headers` varchar(255) NOT NULL,
  `transactionid` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expenses_backup`
--

CREATE TABLE `expenses_backup` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `expensesid` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `expensesdate` date DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `paymentmode` varchar(255) DEFAULT NULL,
  `throughcheck` varchar(255) DEFAULT NULL,
  `chequeno` varchar(255) DEFAULT NULL,
  `chamount` varchar(255) DEFAULT NULL,
  `banktransfer` varchar(255) DEFAULT NULL,
  `bamount` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `cardtype` varchar(255) DEFAULT NULL,
  `paymentdetails` varchar(255) DEFAULT NULL,
  `overallamount` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `headers` varchar(255) NOT NULL,
  `transactionid` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `id` int(11) NOT NULL,
  `date` varchar(100) NOT NULL,
  `heat_treatment` varchar(255) DEFAULT NULL,
  `grade` varchar(100) NOT NULL,
  `hsnno` varchar(100) NOT NULL,
  `element` text,
  `min_value` text,
  `max_value` text,
  `mechanicalelement` text,
  `mechanicalminvalue` text,
  `mechanicalmaxvalue` text,
  `remarks` text,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`id`, `date`, `heat_treatment`, `grade`, `hsnno`, `element`, `min_value`, `max_value`, `mechanicalelement`, `mechanicalminvalue`, `mechanicalmaxvalue`, `remarks`, `status`) VALUES
(1, '2026-02-09', 'SOLUTION ANNEALING : 1080 ° C / 3 HRS SOAKED / WATER QUENCHED', 'ASTM A351 CF3M', '73259930', 'C.%,Si.%,Mn.%,S.%,P.%,Cr.%,Ni.%,Mo.%,,,,,,,', '-,-,-,-,-,17.000,9.000,2.000,,,,,,,', '0.030,1.500,1.500,0.040,0.040,21.000,13.000,3.000,,,,,,,', 'Yield Strength,Tensile Strength,% Elongation,% Reduction of Area,Hardness,Bend Test,Impact Test in Joules', '205,485,30,-,-,,', '-,,,-,200,,', '<p><span style=\"font-size: 12px;\">﻿Separate test bar poured and the same bar tested for chemical and mechanical properties</span></p><p><span style=\"font-size: 12px;\"><br></span><br></p>', 1),
(2, '2026-02-09', 'NORMALAZING : Heated  to  920°C soak for  3 Hrs and  then  air cooled.', 'ASTM A216 WCB', '73259999', 'C,Si,Mn,S,P,Cr,Ni,Mo,Cu,V,,,,,', ',,,,,,,,,,,,,,', '0.300,0.600,1.000,0.035,0.035,0.500,0.500,0.200,0.300,0.030,,,,,', 'Yield Strength,Tensile Strength,% Elongation,% Reduction of Area,Hardness,Bend Test,Impact Test in Joules', '250,485,22,35,,,', '-,-,-,-,235,,', '<p><span style=\"font-size: 12px;\">﻿Separate test bar poured and the same bar tested for chemical and mechanical properties</span></p><p><span style=\"font-size: 12px;\">Tensile Testing conducted on round specimen at room temperature</span><br>Visual inspection carried out at as per MSS SP-55, found satisfied<br></p>', 1),
(3, '2026-02-09', '', 'ASTM A148 90-60', '73259920', 'C%,Si%,Mn%,P%,S%,Cr%,Ni%,Mo%,Cu,V,Al,TRE,CE,,', '0.180,-,0.950,-,-,,,,,,,,,,', '0.250,0.600,1.280,0.035,0.035,0.500,0.500,0.200,0.300,0.030,0.060,1.000,0.450,,', 'Yield Strength,Tensile Strength,% Elongation,% Reduction of Area,Hardness,Bend Test,Impact Test in Joules', '325,485,22,35,143,,', '-,-,,,237,,', '<p><span style=\"font-size: 12px;\">﻿1. Integral BlockIdentification ,Chemical, Mechnical, Impact Hardness Witnessed By TPI Sunshine Inspection and Certification Services.<br></span></p><p><span style=\"font-size: 12px;\">2. Visual inspection Carried out as per MSS SP 55</span></p><p><span style=\"font-size: 12px;\">3.Chemical &amp; Mechanical Test Carried out at NABL ISO 17025 Certified Laboratory and reports Found satisfied.</span></p><p><span style=\"font-size: 12px;\">5. Magnetic Particle Inspection of casting:100% Satisfactory According to ASME B16.34 Appendix II</span></p><p><span style=\"font-size: 12px;\">6.Ultrasonic Inspection of casting all accessible area found Satisfactory According to ASME B16.34 Appendix IV</span></p><p><span style=\"font-size: 12px;\">7.Casting meets customer requirement DMS -CAST-002 REV.0</span></p><p><span style=\"font-size: 12px;\">8.Visual inspection carried out as per ANSI/MSS SP 55 and meeting to Type II a to XII a</span><br>9.Radio active contamination not found in the castings<br></p>', 1),
(4, '2026-02-09', 'Not Applicable', 'BS310 0 309C30', '73259930', 'C%,Si%,Mn%,S%,P%,Cr%,Ni%,Mo%,,,,,,,', '-,-,-,-,-,22.000,10.000,-,,,,,,,', '0.500,2.500,2.000,0.050,0.050,27.000,14.000,1.500,,,,,,,', 'Yield Strength,Tensile Strength,% Elongation,% Reduction of Area,Hardness,Bend Test,Impact Test in Joules', '-,-,-,-,-,-,', '-,-,-,-,-,-,', '<p><span style=\"font-size: 12px;\">﻿Visual inspection carried out at as per MSS SP-55, found satisfied</span></p><p><span style=\"font-size: 12px;\">Radio active contamination not found in the castings</span><br><br></p>', 1),
(5, '2026-02-10', 'No', 'ASTM A297 Gr.HE', '73259930', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', 'Yield Strength,Tensile Strength,% Elongation,% Reduction of Area,Hardness,Bend Test,Impact Test in Joules', ',,,,,,', ',,,,,,', '<p><span style=\"font-size: 12px;\">﻿</span><br></p>', 1),
(6, '2026-02-10', '', 'Pattern', '84803000', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', 'Yield Strength,Tensile Strength,% Elongation,% Reduction of Area,Hardness,Bend Test,Impact Test in Joules', ',,,,,,', ',,,,,,', '<p><span style=\"font-size: 12px;\">﻿</span><br></p>', 1),
(7, '2026-02-13', '-', 'INSPECTION', '998898', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', 'Yield Strength,Tensile Strength,% Elongation,% Reduction of Area,Hardness,Bend Test,Impact Test in Joules', ',,,,,,', ',,,,,,', '<p><span style=\"font-size: 12px;\">﻿</span><br></p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `headers`
--

CREATE TABLE `headers` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `headers`
--

INSERT INTO `headers` (`id`, `date`, `status`, `name`) VALUES
(1, '2025-06-23', 1, 'Salary ');

-- --------------------------------------------------------

--
-- Table structure for table `hsnmaster`
--

CREATE TABLE `hsnmaster` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `hsnno` varchar(225) DEFAULT NULL,
  `party` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hsnmaster`
--

INSERT INTO `hsnmaster` (`id`, `date`, `hsnno`, `party`, `status`) VALUES
(2, '2025-08-11', '145311090', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inspectionmaster`
--

CREATE TABLE `inspectionmaster` (
  `id` int(11) NOT NULL,
  `date` varchar(100) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `itemname` varchar(100) NOT NULL,
  `itemid` int(11) DEFAULT NULL,
  `sno` text NOT NULL,
  `view` text NOT NULL,
  `length` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inspectionmaster`
--

INSERT INTO `inspectionmaster` (`id`, `date`, `product_code`, `itemname`, `itemid`, `sno`, `view`, `length`, `status`, `created_at`) VALUES
(1, '2026-02-11', 'SBM05', 'LH Inner Box', 6, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50', 'TOTAL LENGTH,LENGTH,WIDTH,HEIGHT,WIDTH,INNER WIDTH,DEPTH,DEPTH,WIDTH,WIDTH,HEIGHT,WIDTH,WIDTH,WIDTH,WIDTH,HEIGHT,WIDTH,INNER WIDTH,INNER WIDTH,INNER WIDTH,WIDTH,WIDTH,HEIGHT,WIDTH,WIDTH,WIDTH,WIDTH,INNER WIDTH,WIDTH,,,,,,,,,,,,,,,,,,,,,', '502 ± 2,405 ± 2,20 ± 2,28 ± 2,100 ± 2,64 ± 0/1,18 ± 2,33 ± 2,18 ± 2,43 ± 2,71 ± 2,71 ± 0/1,28 ± 2,120 ± 2,28 ± 2,152 ± 2,176 ± 2,64 ± 1,18 ± 2,18 ± 2,26 ± 2,26 ± 2,97 ± 2,152 ± 2,41 ± 2,9 ± 2,45 ± 2,37 ± 2,73 ± 2,,,,,,,,,,,,,,,,,,,,,', 1, '2026-02-11 13:38:07'),
(2, '2026-02-11', 'SBM10', '12FN Top Plate', 7, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50', 'LENGTH,LENGTH,WIDTH,LENGTH,HEIGHT,INNER WIDTH,DEGREE,DEPTH,INNER WIDTH,WIDTH,HEIGHT,HEIGHT,HEIGHT,INNER WIDTH,INNER WIDTH,WIDTH,WIDTH,DIM,DIM,DIM,DIM,DIM,DIM,INNER WIDTH,WIDTH,DIM,DIM,DIM,HEIGHT,DIM,DIM,DIM,HEIGHT,HEIGHT,INNER WIDTH,INNER WIDTH,WIDTH,HEIGHT,HEIGHT,HEIGHT,HEIGHT,HEIGHT,WIDTH,WIDTH,WIDTH,WIDTH,,,,', '364,98,331,364,22.5,30,45°,48,126.5,51.5,271,24,11,97,119.5,331,62,1.5°,1.5°,5°,2.5°,5°,1.5°,54.5,98,1.5°,1.5°,1°,32,5°,5°,1.5°,20,35,97,119.5,331,25,42,220,45,32,57,50,70,20,,,,', 1, '2026-02-11 13:45:50'),
(3, '2026-02-11', 'SP03', 'Collector Casting 8557', 13, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50', 'TOTAL LENGTH,DISTANCE,DISTANCE,DISTANCE,WIDTH,DISTANCE,DEPTH,WIDTH,DEPTH,LENGTH,LENGTH,ANGLE,DISTANCE,DISTANCE BOSS,BOSS DIA,HEIGHT,RADIUS,INNER DISTANCE,WIDTH,CENTER TO ,DISTANCE,DISTANCE,THICK,THICK,RADIUS,,,,,,,,,,,,,,,,,,,,,,,,,', '500 ± 3,125 ± 2,250 ± 2,125,258,210,20,40,20,80,210,45°,130,10°,ø25,10,R427,128,3,R116,14,258,5,6,R6,,,,,,,,,,,,,,,,,,,,,,,,,', 1, '2026-02-11 13:55:33'),
(4, '2026-02-11', 'SP02', 'Collector Casting', 12, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50', 'TOTAL LENGTH,DISTANCE,DISTANCE,DISTANCE,WIDTH,DISTANCE,DEPTH,WIDTH,DEPTH,LENGTH,LENGTH,RADIUS,WALL THICK,DISTANCE BOSS,BOSS DIA,HEIGHT,ANGLE,ANGLE,WIDTH,CENTER TO,RADIUS,DISTANCE,THICK,THICK,RADIUS,,,,,,,,,,,,,,,,,,,,,,,,,', '500 ± 3,125 ± 2,250 ± 2,125 ± 2,231 + 0.0 - 1.0,210,20,40,20,80,210,R398,14 +1.5-0.0,10,Ø25,116,10°,45°,3,115,R102,231+0.0-1.0,5+0.0-1.0,6,R6,,,,,,,,,,,,,,,,,,,,,,,,,', 1, '2026-02-11 14:03:47'),
(5, '2026-02-11', 'SBM15', 'EH Inner Box', 10, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50', 'LENGTH,WIDTH,DISTANCE,WIDTH,WIDTH,DISTANCE,DISTANCE,DISTANCE,RADIUS,INNER DIS,LENGTH,DISTANCE,OUTER DIS,LENGTH,INNER DIS,RADIUS,RADIUS,DISTANCE,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,', '244 ± 2,133+2-0,112+2-0,26+0.2-0,45° ± 0°,108+2-0,135° ± 0°,69+2-0,R13,96+2-0,64 ± 2,204+2-0,554+2-0,23+2-0,69,R5,R13,44+1-0,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,', 1, '2026-02-11 14:10:19'),
(6, '2026-02-11', 'SBM08', 'EH Outer Box', 4, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50', 'TOTAL LENGTH,DEPTH,DISTANCE,WIDTH,WIDTH,DISTANCE,INNER DIS,INNER DIS,WIDTH,INNER DIS,LENGTH,LENGTH,DISTANCE,WIDTH,DISTANCE,INNER DIS,DISTANCE,WIDTH,DISTANCE,OUTER DIS,WIDTH,WIDTH,INNER DIS,DISTANCE,HEIGHT,INNER DIS,HEIGHT,HEIGHT,DISTANCE,DISTANCE,INNER DIS,HEIGHT,HEIGHT,HEIGHT,INNER DIS,LENGTH,LENGTH,HEIGHT,DISTANCE,DISTANCE,,,,,,,,,,', '531 ± 2,206 ± 2,30 ± 2,17 ± 2,50 ± 2,65 ± 2,51 ± 2,96 ± 2,17 ± 2,50 ± 2,527 ± 2,541 ± 2,36 ± 2,60 ± 2,37 ± 2,60 ± 2,58 ± 2,29,75 ± 2,17 ± 2,17 ± 2,581 ± 2,52 ± 2,60 ± 2,194 ± 2,36 ± 2,41 ± 2,66 ± 2,60 ± 2,50 ± 2,32 ± 2,40 ± 2,75 ± 2,52 ± 2,30 ± 2,40 ± 2,50 ± 2,51 ± 2,65 ± 2,130 ± 2,,,,,,,,,,', 1, '2026-02-11 14:17:15'),
(7, '2026-02-17', 'SP04', 'Flame Holder Segment', 14, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50', 'TOTAL LENGTH,LENGTH,WIDTH,RADIUS,WIDTH,WIDTH,RADIUS,RADIUS,RADIUS,THICKNESS,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,', '340,302,50,R3,50,98,453.5,403.5,473,20,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,', 1, '2026-02-11 14:19:10'),
(8, '2026-02-16', 'SBM03', 'LH Outer Box', 5, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50', 'TOTAL LENGTH,LENGTH,WIDTH,WIDTH,WIDTH,DEPTH,DEPTH,DEPTH,LENGTH,LENGTH,WIDTH,LENGTH,INNER WIDTH,INNER LENGTH,LENGTH,INNER HEIGHT,INNER HEIGHT,HEIGHT,LENGTH,LENGTH,WIDTH,INNER WIDTH,INNER WIDTH,HEIGHT,HEIGHT,WIDTH,HEIGHT,LENGTH,INNER LENGTH,WIDTH,WIDTH,INNE WIDTH,WIDTH,,,,,,,,,,,,,,,,,', '461 ± 2,411 ± 2,86 ± 2,55 ± 2,64 ± 2,96 ± 2,130 ± 2,35 ± 2,400 ± 2,431 ± 2,43 ± 2,25 ± 2,62 ± 2,50 ± 2,442 ± 2,34 ± 2,46 ± 2,30 ± 2,25 ± 2,60 ± 2,62 ± 2,53 ± 2,36 ± 2,75 ± 2,40 ± 2,23.5 ± 2,38.5 ± 2,53 ± 2,26 ± 2,39 ± 2,65 ± 2,65 ± 2,130 ± 2,,,,,,,,,,,,,,,,,', 1, '2026-02-16 12:11:26'),
(10, '2026-02-18', 'SBM09', 'Moving Block', 11, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50', 'TOTAL LENGTH,LENGTH,LENGTH,LENGTH,LENGTH,LENGTH,WIDTH,WIDTH,LENGTH,LENGTH,HEIGHT,WIDTH,ANGLE,ANGLE,HEIGHT,LENGTH,LENGTH,LENGTH,HEIGHT,LENGTH,ANGLE,ANGLE,ANGLE,HEIGHT,HEIGHT,HEIGHT,INNER LENGTH,HEIGHT,LENGTH,LENGTH,,,,,,,,,,,,,,,,,,,,', '555 + 2,383 + 2,285 + 2,70+ 2,230 ± 2,40 ± 2,30 ± 2,53 ± 2,40 ± 2,112 ± 2,44 ± 2,30 ± 2,124°,124°,102 ± 2,50.5,53,170 ± 2,53,50.5,54°,56°,124°,76 + 2,56 + 2,132 + 3,127  ± 2,35.5  ± 2,277.5,277.5,,,,,,,,,,,,,,,,,,,,', 1, '2026-02-18 07:20:43'),
(11, '2026-02-18', 'SBM04', 'NH Inner Box', 9, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50', 'TOTAL LENGTH,LENGTH,INNER WIDTH,WIDTH, INNER WIDTH,DEPTH,WIDTH, INNER WIDTH,DEPTH,WIDTH,HEIGHT,INNER HEIGHT,INNER WIDTH,WIDTH,WIDTH,WIDTH,HEIGHT,WIDTH,INNER WIDTH,INNER WIDTH,WIDTH,WIDTH,HEIGHT,WIDTH,WIDTH,WIDTH,WIDTH,INNER WIDTH,WIDTH,,,,,,,,,,,,,,,,,,,,,', '552± 2,455 ± 2,18 ± 2,33 ± 2,20 ± 2,28 ± 2,100 + 2,64 -1,18 ± 2,43 ± 2,82,71 ± 2,71+1,28 ± 2,120 ± 2,28 ± 2,152 ± 2,176 ± 2,18 ± 2,18 ± 2,26 ± 2,26 ± 2,97 ± 2,152 ± 2,41 ± 2,9 ± 2,45 ± 2,37 ± 2,73 ± 2,,,,,,,,,,,,,,,,,,,,,', 1, '2026-02-18 07:23:12'),
(12, '2026-02-18', 'SBM02', 'NH Outer Box', 8, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50', 'TOTAL LENGTH,WIDTH,INNER WIDTH,WIDTH,WIDTH,WIDTH,DEPTH,HEIGHT,HEIGHT,HEIGHT,INNER HEIGHT,HEIGHT,HEIGHT,INNER LENGTH,OUTER LENGTH,OUTER WIDTH,WIDTH,INNER WIDTH,OUTER LENGTH,HEIGHT,HEIGHT,INNER HEIGHT,INNER HEIGHT,HEIGHT,INNER WIDTH,LENGTH,INNER LENGTH,HEIGHT,HEIGHT,WIDTH,HEIGHT,HEIGHT,INNER HEIGHT,WIDTH,WIDTH,LENGHT ,LENGTH ,,,,,,,,,,,,,', '460± 2,86± 2,54 ± 2,65 ± 2,130 ± 2,96 ± 2,25,51± 2,448± 2,447 ± 2,33 ± 2,45 ± 2,47 ± 2,62 ± 2,65 ± 2,30  ± 2,56 ± 2,25 ± 2,75 ± 2,490 ± 2,505 ± 2,35 ± 2,45 ± 2,62 ± 2,62 ± 2,53  ± 2,36  ± 2,75  ± 2,40  ± 2,23.5  ± 2,38.5  ± 2,53 ± 2,25 ± 2,40 ± 2,65 ± 2,130 ± 2,65,,,,,,,,,,,,,', 1, '2026-02-18 07:47:56'),
(13, '2026-02-18', 'OMI 01', 'Retainer 2.0', 15, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50', 'WIDTH,RADIUS,ANGLE,WIDTH,INNER DIS,ANGLE,LENGTH,RADIUS,ANGLE,RADIUS,INNER DIS,LENGTH,LENGTH,WIDTH,INNER WIDTH,ANGLE,ANGLE,HEIGHT,HEIGHT,LENGTH,HEIGHT,RADIUS,WIDTH,WIDTH,INNER DIS,INNER DIS,WIDTH,INNER DIS,INNER DIS,INNER DIS,,,,,,,,,,,,,,,,,,,,', '275,R10,25,150,75,25,80,R20,48,R10,70,182,250,410,90,45,60,20,160,216,56,R3,ø139.5-0.2,115,ø11.5,11,80,ø95,75,90,,,,,,,,,,,,,,,,,,,,', 1, '2026-02-18 07:56:07'),
(14, '2026-02-18', 'OMI 02', 'Retainer 3.0', 16, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50', 'DISTANCE,INNER DIS,RADIUS,INNER DIS,LENGTH,INNER DIS,LENGTH,DISTANCE,HEIGHT,DISTANCE,DISTANCE,RADIUS,DISTANCE,DIA,WIDTH,DISTANCE,HEIGHT,INNER DIS,RADIUS,OUTER DIS,HEIGHT,,,,,,,,,,,,,,,,,,,,,,,,,,,,,', '130,5,R5,290,56,48,60,120,180,95,95,R12,60,80,70,60,45,175,R3,99 ± 0.1,60,,,,,,,,,,,,,,,,,,,,,,,,,,,,,', 1, '2026-02-18 08:01:45');

-- --------------------------------------------------------

--
-- Table structure for table `inspection_report`
--

CREATE TABLE `inspection_report` (
  `id` int(11) NOT NULL,
  `date` varchar(100) NOT NULL,
  `insno` varchar(100) NOT NULL,
  `inspection_date` varchar(100) NOT NULL,
  `customername` varchar(100) NOT NULL,
  `customerid` varchar(100) NOT NULL,
  `itemname` varchar(100) NOT NULL,
  `drawingno` varchar(100) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `grade` varchar(100) NOT NULL,
  `dimension_in` varchar(100) NOT NULL,
  `heatno1` varchar(100) NOT NULL,
  `heatno2` varchar(100) NOT NULL,
  `heatno3` varchar(100) NOT NULL,
  `heatno4` varchar(100) NOT NULL,
  `sno` longtext NOT NULL,
  `view` longtext NOT NULL,
  `length` longtext NOT NULL,
  `inspection1` longtext NOT NULL,
  `inspection2` longtext NOT NULL,
  `inspection3` longtext NOT NULL,
  `inspection4` longtext NOT NULL,
  `remark` longtext NOT NULL,
  `ndt` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL,
  `ndt_remarks` text NOT NULL,
  `overall_remarks` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inspection_report`
--

INSERT INTO `inspection_report` (`id`, `date`, `insno`, `inspection_date`, `customername`, `customerid`, `itemname`, `drawingno`, `product_code`, `grade`, `dimension_in`, `heatno1`, `heatno2`, `heatno3`, `heatno4`, `sno`, `view`, `length`, `inspection1`, `inspection2`, `inspection3`, `inspection4`, `remark`, `ndt`, `qty`, `result`, `ndt_remarks`, `overall_remarks`, `status`, `created_at`) VALUES
(1, '2026-02-13', 'CK/CIR/001', '05-05-2025', 'STAAN BIO MED PVT LTD', '9', 'EH Outer Box', 'ST-MSC-017', 'SBM08', '2', 'mm', 'P0464', 'P0471', 'P0482', 'P0497', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40', 'TOTAL LENGTH,DEPTH,DISTANCE,WIDTH,WIDTH,DISTANCE,INNER DIS,INNER DIS,WIDTH,INNER DIS,LENGTH,LENGTH,DISTANCE,WIDTH,DISTANCE,INNER DIS,DISTANCE,WIDTH,DISTANCE,OUTER DIS,WIDTH,WIDTH,INNER DIS,DISTANCE,HEIGHT,INNER DIS,HEIGHT,HEIGHT,DISTANCE,DISTANCE,INNER DIS,HEIGHT,HEIGHT,HEIGHT,INNER DIS,LENGTH,LENGTH,HEIGHT,DISTANCE,DISTANCE', '531 ± 2,206 ± 2,30 ± 2,17 ± 2,50 ± 2,65 ± 2,51 ± 2,96 ± 2,17 ± 2,50 ± 2,527 ± 2,541 ± 2,36 ± 2,60 ± 2,37 ± 2,60 ± 2,58 ± 2,29,75 ± 2,17 ± 2,17 ± 2,581 ± 2,52 ± 2,60 ± 2,194 ± 2,36 ± 2,41 ± 2,66 ± 2,60 ± 2,50 ± 2,32 ± 2,40 ± 2,75 ± 2,52 ± 2,30 ± 2,40 ± 2,50 ± 2,51 ± 2,65 ± 2,130 ± 2', '529/530,206/207,30,18/19,48/49,66/67,52,95/96,18/19,54,526/527,542,36/37,60/61,40/41,62,56,29,74/75,18/19,18/19,581/581.5,52/54,59/60,193,36/37,43,64,62,54,30/31,39,74/75,52/54,27,38,48/49,52,67.5/68,135/136', '528/529,206/206,30.5,18.5/19,48/48,66/67,52,95/96,18/19,53,526/527,543,36/37,60/61,40/41,61/62,56,29,74/75,18/19,18/19,581.5/581,52/54,59/60,193,36/37,43.5,64,63,53,30/31,39,74/75,52/54,27,37.5,48/49,53,67.5/68,135/136', '528/529,206/206,30,18.5/19,48/48,66/67,52,95/96,18.5/19,54,526/527,542,36/37,60/61,40/41,61/62,56,29,74/75,18/19,18/19,581/581.5,52/54,58/59,193,36/37,43.5,64,62,54,30/31,39,74/75,52/54,27,38,48/49,53,67.5/68,135/136', '529/530,205/206,30.5,18/19,48/49,66/67,52,94.5/95,18.5/19,54,526/527,543,36/37,60/61,40/41,62,55,29,74/75,18/19,18/19,581.5/581,52/54,59/60,193,36/37,43,64,63,53,30/31,39,74/75,52/54,27,37.5,48/49,52,67.5/68,135/136', 'OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK,OK', 'DP ,MP,RT,UT,VISUAL (As Per Mss SP-55),DIM.INSPECTION,DESPATCH QTY,OTHER REQUIRMENT', ',,,,40,4,40,-', ',,,,40,4,40,-', ',,,,,,,', '<p><span style=\"font-size: 12px;\">﻿</span><br></p>', 1, '2026-02-13 06:50:36');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `orderno` varchar(255) DEFAULT NULL,
  `orderdate` date DEFAULT NULL,
  `invoiceno` varchar(225) DEFAULT NULL,
  `dcno` longtext,
  `pono` varchar(255) DEFAULT NULL,
  `pino` varchar(255) DEFAULT NULL,
  `purchaseordernos` varchar(255) DEFAULT NULL,
  `purchaseorder` varchar(255) NOT NULL,
  `bill_type` varchar(255) NOT NULL,
  `invoicetype` varchar(225) DEFAULT NULL,
  `customerdcnos` varchar(100) NOT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `deliveryat` varchar(225) DEFAULT NULL,
  `transportmode` varchar(255) DEFAULT NULL,
  `vehicleno` varchar(225) DEFAULT NULL,
  `removalDate` date NOT NULL,
  `time` varchar(255) DEFAULT NULL,
  `shipTo` varchar(255) DEFAULT NULL,
  `shipToId` varchar(255) DEFAULT NULL,
  `shipToAddress` longtext,
  `deliveryAddress1` longtext,
  `deliveryAddress2` longtext,
  `mobileNo` varchar(255) DEFAULT NULL,
  `billtype` varchar(255) DEFAULT NULL,
  `gsttype` varchar(225) DEFAULT NULL,
  `typesgst` longtext,
  `typecgst` longtext,
  `typeigst` longtext,
  `dcnos` longtext,
  `insertid` varchar(225) DEFAULT NULL,
  `deliveryid` longtext,
  `workorderid` varchar(20) NOT NULL,
  `hsnno` longtext,
  `itemcode` longtext,
  `itemname` varchar(255) DEFAULT NULL,
  `itemid` varchar(100) NOT NULL,
  `heatno` varchar(100) NOT NULL,
  `item_desc` text NOT NULL,
  `uom` longtext,
  `grade` varchar(100) NOT NULL,
  `rate` longtext,
  `qty` longtext,
  `weight` varchar(100) NOT NULL,
  `amount` longtext,
  `discount` longtext,
  `discountBy` varchar(255) NOT NULL,
  `discountamount` longtext,
  `taxableamount` longtext,
  `sgst` longtext,
  `sgstamount` longtext,
  `cgst` longtext,
  `cgstamount` longtext,
  `igst` longtext,
  `igstamount` longtext,
  `total` longtext,
  `subtotal` varchar(225) DEFAULT NULL,
  `freightamount` varchar(225) DEFAULT NULL,
  `freightcgst` varchar(225) DEFAULT NULL,
  `freightcgstamount` varchar(225) DEFAULT NULL,
  `freightsgst` varchar(225) DEFAULT NULL,
  `freightsgstamount` varchar(225) DEFAULT NULL,
  `freightigst` varchar(225) DEFAULT NULL,
  `freightigstamount` varchar(225) DEFAULT NULL,
  `freighttotal` varchar(225) DEFAULT NULL,
  `loadingamount` varchar(225) DEFAULT NULL,
  `loadingcgst` varchar(225) DEFAULT NULL,
  `loadingcgstamount` varchar(225) DEFAULT NULL,
  `loadingsgst` varchar(225) DEFAULT NULL,
  `loadingsgstamount` varchar(225) DEFAULT NULL,
  `loadingigst` varchar(225) DEFAULT NULL,
  `loadingigstamount` varchar(225) DEFAULT NULL,
  `loadingtotal` varchar(225) DEFAULT NULL,
  `roundOff` varchar(255) NOT NULL,
  `othercharges` varchar(225) DEFAULT NULL,
  `return_status` longtext,
  `grandtotal` varchar(225) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `vou_status` int(11) DEFAULT NULL,
  `invoicenodate` varchar(225) DEFAULT NULL,
  `invoicenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL,
  `totalqty` varchar(255) DEFAULT NULL,
  `acno` varchar(255) NOT NULL,
  `acdate` varchar(255) NOT NULL,
  `irn` varchar(255) NOT NULL,
  `signedinvoice` longtext NOT NULL,
  `signedqrcode` longtext NOT NULL,
  `status_ein` longtext NOT NULL,
  `ewayno` varchar(255) NOT NULL,
  `ewaydate` varchar(255) NOT NULL,
  `ewbvalidtill` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `status_cd` varchar(255) NOT NULL,
  `status_desc` varchar(255) NOT NULL,
  `einvoice_status` int(11) NOT NULL,
  `eway_status` int(11) NOT NULL,
  `invoice_status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `date`, `invoicedate`, `orderno`, `orderdate`, `invoiceno`, `dcno`, `pono`, `pino`, `purchaseordernos`, `purchaseorder`, `bill_type`, `invoicetype`, `customerdcnos`, `customerId`, `customername`, `address`, `deliveryat`, `transportmode`, `vehicleno`, `removalDate`, `time`, `shipTo`, `shipToId`, `shipToAddress`, `deliveryAddress1`, `deliveryAddress2`, `mobileNo`, `billtype`, `gsttype`, `typesgst`, `typecgst`, `typeigst`, `dcnos`, `insertid`, `deliveryid`, `workorderid`, `hsnno`, `itemcode`, `itemname`, `itemid`, `heatno`, `item_desc`, `uom`, `grade`, `rate`, `qty`, `weight`, `amount`, `discount`, `discountBy`, `discountamount`, `taxableamount`, `sgst`, `sgstamount`, `cgst`, `cgstamount`, `igst`, `igstamount`, `total`, `subtotal`, `freightamount`, `freightcgst`, `freightcgstamount`, `freightsgst`, `freightsgstamount`, `freightigst`, `freightigstamount`, `freighttotal`, `loadingamount`, `loadingcgst`, `loadingcgstamount`, `loadingsgst`, `loadingsgstamount`, `loadingigst`, `loadingigstamount`, `loadingtotal`, `roundOff`, `othercharges`, `return_status`, `grandtotal`, `balance`, `vou_status`, `invoicenodate`, `invoicenoyear`, `status`, `edit_status`, `totalqty`, `acno`, `acdate`, `irn`, `signedinvoice`, `signedqrcode`, `status_ein`, `ewayno`, `ewaydate`, `ewbvalidtill`, `remarks`, `status_cd`, `status_desc`, `einvoice_status`, `eway_status`, `invoice_status`) VALUES
(3, '2026-02-13', '2026-02-11', 'CAD2025361REV01', '2025-03-18', 'CK/INV/25-26/-001', '', 'CK/WO/25-26/-002', NULL, 'CK/WO/25-26/-002', '-', 'Tax Invoice', 'Against PO', '', 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', NULL, NULL, '', '2026-02-11', '03:59 PM', 'M/S CADALAN OFFSHORE PRIVATE LIMITED', '7', 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', NULL, NULL, NULL, 'intrastate', 'intrastate', 'sgst', 'cgst', '', '', NULL, '', '15', '73259930', 'CA16', '1/2\" CL 600 Body', '3', '', 'heatno : P0213-20', 'NOS', '1', '1250', '20', '3.5', '87500.00', '0', 'amount_wise', '', '87500.00', '9', '7875.00', '9', '7875.00', '18', '', '', '87500.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1', '103250.00', '103250.00', 1, 'CK/INV/25-26/-110226', 'CK/INV/25-26/--2026', 1, 1, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 1),
(4, '2026-02-13', '2025-04-09', '', '1970-01-01', 'CK/INV/25-26/-002', '', 'CK/WO/25-26/-001', NULL, 'CK/WO/25-26/-001', 'PO3704', 'Tax Invoice', 'Against PO', '', 2, 'SIGMA POWER & ENERGY ENGINEERS', 'PLOT No.E-5 SIDCO INDUSTRIES ESTATE, Phase II, VALAVANTHAN KOTTAI, THUVAKUDI, TRICHY, Tamil Nadu', NULL, NULL, '', '2026-02-13', '11:53 AM', '', '', '', NULL, NULL, NULL, 'intrastate', 'intrastate', 'sgst', 'cgst', '', '', NULL, '', '3', '84803000', 'SP01', 'Coal Nozzle ', '1', '', 'heatno : ', 'NOS', '6', '200000', '1', '1', '200000.00', '0', 'amount_wise', '', '200000.00', '9', '18000.00', '9', '18000.00', '18', '', '', '200000.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1', '236000.00', '236000.00', 1, 'CK/INV/25-26/-002130226', 'CK/INV/25-26/-002-2026', 1, 1, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0),
(5, '2026-02-13', '2025-05-07', '', '1970-01-01', 'CK/INV/25-26/-003', '', 'CK/WO/25-26/-004', NULL, 'CK/WO/25-26/-004', 'PO-SC-2526-008', 'Tax Invoice', 'Against PO', '', 9, 'STAAN BIO MED PVT LTD', '190-A, Bharathiar Road, Ganapathy, Coimbatore, Tamil Nadu', NULL, NULL, '', '2026-02-13', '12:25 PM', '', '', '', NULL, NULL, NULL, 'intrastate', 'intrastate', 'sgst', 'cgst', '', '', NULL, '', '17', '73259999', 'SBM08', 'EH Outer Box', '4', '', 'heatno : P0464-2 , P0470-2 , P0471-2 , P0472-2 , P0473-2 , P0474-2 , P0475-2 , P0476-2 , P0477-2 , P0478-2 , P0479-2 , P0481-2 , P0482-2 , P0483-2 , P0484-2 , P0485-2 , P0495-2 , P0496-2 , P0497-2 , P0498-2', 'NOS', '2', '167', '40', '34.1', '227788.00', '0', 'amount_wise', '', '227788.00', '9', '20500.92', '9', '20500.92', '18', '', '', '227788.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.16', NULL, '1', '268790.00', '268790.00', 1, 'CK/INV/25-26/-003130226', 'CK/INV/25-26/-003-2026', 1, 1, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 1),
(6, '2026-02-14', '2025-05-07', '', '1970-01-01', 'CK/INV/25-26/-004', '', 'CK/WO/25-26/-003', NULL, 'CK/WO/25-26/-003', 'CAD2025405 REV 01', 'Tax Invoice', 'Against PO', '', 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', NULL, NULL, '', '2026-02-13', '12:42 PM', '', '', '', NULL, NULL, NULL, 'intrastate', 'intrastate', 'sgst', 'cgst', '', '', NULL, '', '16', '73259999', 'CA16', '1/2\" CL 600 Body', '3', '', 'heatno : P0412-4 , P0424-5 , P0425-5 , P0426-2 , P0443-1', 'NOS', '2', '350', '17', '3.5', '20825.00', '0', 'amount_wise', '', '20825.00', '9', '1874.25', '9', '1874.25', '18', '', '', '20825.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.50', NULL, '1', '24574.00', '24574.00', 1, 'CK/INV/25-26/-004130226', 'CK/INV/25-26/-004-2026', 1, 1, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 1),
(7, '2026-02-25', '2025-06-09', '', '1970-01-01', 'CK/INV/25-26/-005', '', 'CK/WO/25-26/-006||CK/WO/25-26/-017', NULL, 'CK/WO/25-26/-006||CK/WO/25-26/-017||CK/WO/25-26/-017||CK/WO/25-26/-017', 'CAD2025363 REV01||CAD2025363||CAD2025363||CAD2025363', 'Tax Invoice', 'Against PO', '', 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', NULL, NULL, '', '2026-02-25', '12:25 PM', '', '', '', NULL, NULL, NULL, 'intrastate', 'intrastate', 'sgst', 'cgst', '', '', NULL, '', '21||48||49||50', '73259999||73259999||84803000', 'CA02||TB1||PR1', '4\" 1500 Body||TEST BAR(300mmX50mmX50mm)||Pattern Rework Cost', '18||23||24', '', 'heatno : 33801-3 , 33817-2||heatno : 33801||heatno : ', 'NOS||NOS||NOS', '2||2||6', '220||220||9500', '5||2||1', '212||6||1', '233200.00||2640.00||9500.00', '0||0||0', 'amount_wise', '||||0', '233200.00||2640.00||9500.00', '9', '22170.60', '9', '22170.60', '18', '', '', '245340.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1||1||1', '290681.20', '290681.20', 1, 'CK/INV/25-26/-005250226', 'CK/INV/25-26/-005-2026', 1, 1, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details_backup`
--

CREATE TABLE `invoice_details_backup` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `orderno` varchar(255) DEFAULT NULL,
  `orderdate` date DEFAULT NULL,
  `invoiceno` varchar(225) DEFAULT NULL,
  `dcno` longtext,
  `pono` varchar(255) DEFAULT NULL,
  `pino` varchar(255) DEFAULT NULL,
  `purchaseordernos` varchar(255) DEFAULT NULL,
  `bill_type` varchar(255) NOT NULL,
  `invoicetype` varchar(225) DEFAULT NULL,
  `customerdcnos` varchar(100) NOT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `deliveryat` varchar(225) DEFAULT NULL,
  `transportmode` varchar(255) DEFAULT NULL,
  `vehicleno` varchar(225) DEFAULT NULL,
  `removalDate` date NOT NULL,
  `time` varchar(255) DEFAULT NULL,
  `shipTo` varchar(255) DEFAULT NULL,
  `shipToId` varchar(255) DEFAULT NULL,
  `shipToAddress` longtext,
  `deliveryAddress1` longtext,
  `deliveryAddress2` longtext,
  `mobileNo` varchar(255) DEFAULT NULL,
  `billtype` varchar(255) DEFAULT NULL,
  `gsttype` varchar(225) DEFAULT NULL,
  `typesgst` longtext,
  `typecgst` longtext,
  `typeigst` longtext,
  `dcnos` longtext,
  `insertid` varchar(225) DEFAULT NULL,
  `deliveryid` longtext,
  `hsnno` longtext,
  `heatno` varchar(100) NOT NULL,
  `itemid` varchar(100) NOT NULL,
  `itemcode` longtext,
  `itemname` longtext,
  `item_desc` text NOT NULL,
  `uom` longtext,
  `grade` varchar(100) NOT NULL,
  `rate` longtext,
  `qty` longtext,
  `weight` varchar(100) NOT NULL,
  `amount` longtext,
  `discount` longtext,
  `discountBy` varchar(255) NOT NULL,
  `discountamount` longtext,
  `taxableamount` longtext,
  `sgst` longtext,
  `sgstamount` longtext,
  `cgst` longtext,
  `cgstamount` longtext,
  `igst` longtext,
  `igstamount` longtext,
  `total` longtext,
  `subtotal` varchar(225) DEFAULT NULL,
  `freightamount` varchar(225) DEFAULT NULL,
  `freightcgst` varchar(225) DEFAULT NULL,
  `freightcgstamount` varchar(225) DEFAULT NULL,
  `freightsgst` varchar(225) DEFAULT NULL,
  `freightsgstamount` varchar(225) DEFAULT NULL,
  `freightigst` varchar(225) DEFAULT NULL,
  `freightigstamount` varchar(225) DEFAULT NULL,
  `freighttotal` varchar(225) DEFAULT NULL,
  `loadingamount` varchar(225) DEFAULT NULL,
  `loadingcgst` varchar(225) DEFAULT NULL,
  `loadingcgstamount` varchar(225) DEFAULT NULL,
  `loadingsgst` varchar(225) DEFAULT NULL,
  `loadingsgstamount` varchar(225) DEFAULT NULL,
  `loadingigst` varchar(225) DEFAULT NULL,
  `loadingigstamount` varchar(225) DEFAULT NULL,
  `loadingtotal` varchar(225) DEFAULT NULL,
  `roundOff` varchar(255) NOT NULL,
  `othercharges` varchar(225) DEFAULT NULL,
  `return_status` longtext,
  `grandtotal` varchar(225) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `vou_status` int(11) DEFAULT NULL,
  `invoicenodate` varchar(225) DEFAULT NULL,
  `invoicenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL,
  `totalqty` varchar(255) DEFAULT NULL,
  `acno` varchar(255) NOT NULL,
  `acdate` varchar(255) NOT NULL,
  `irn` varchar(255) NOT NULL,
  `signedinvoice` longtext NOT NULL,
  `signedqrcode` longtext NOT NULL,
  `status_ein` longtext NOT NULL,
  `ewayno` varchar(255) NOT NULL,
  `ewaydate` varchar(255) NOT NULL,
  `ewbvalidtill` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `status_cd` varchar(255) NOT NULL,
  `status_desc` varchar(255) NOT NULL,
  `einvoice_status` int(11) NOT NULL,
  `eway_status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_party_statement`
--

CREATE TABLE `invoice_party_statement` (
  `id` int(11) NOT NULL,
  `receiptno` varchar(255) DEFAULT NULL,
  `paid` varchar(255) NOT NULL,
  `receiptid` varchar(100) DEFAULT NULL,
  `date` date NOT NULL,
  `invoiceno` varchar(255) NOT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(255) NOT NULL,
  `cstno` varchar(255) NOT NULL,
  `phoneno` varchar(255) NOT NULL,
  `tinno` varchar(255) NOT NULL,
  `itemname` varchar(255) NOT NULL,
  `item_desc` text NOT NULL,
  `rate` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `credit` varchar(255) DEFAULT NULL,
  `debit` varchar(255) DEFAULT NULL,
  `amount` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `receiptdate` date NOT NULL,
  `invoicedate` date NOT NULL,
  `totalamount` varchar(255) NOT NULL,
  `payment` varchar(100) NOT NULL,
  `throughcheck` varchar(255) DEFAULT NULL,
  `balanceamount` varchar(255) NOT NULL,
  `payamount` varchar(255) NOT NULL,
  `paymentmode` varchar(255) DEFAULT NULL,
  `chamount` varchar(255) DEFAULT NULL,
  `paidamount` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `banktransfer` varchar(255) DEFAULT NULL,
  `bankamount` varchar(255) DEFAULT NULL,
  `chequeno` varchar(255) DEFAULT NULL,
  `paymentdetails` varchar(255) DEFAULT NULL,
  `overallamount` varchar(255) DEFAULT NULL,
  `receiptamt` varchar(255) DEFAULT NULL,
  `invoiceamt` varchar(255) DEFAULT NULL,
  `returnamount` varchar(255) DEFAULT NULL,
  `formtype` varchar(255) DEFAULT NULL,
  `invoicenoyear` varchar(255) DEFAULT NULL,
  `invoicenodate` varchar(255) DEFAULT NULL,
  `invoiceid` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_party_statement`
--

INSERT INTO `invoice_party_statement` (`id`, `receiptno`, `paid`, `receiptid`, `date`, `invoiceno`, `customerId`, `customername`, `cstno`, `phoneno`, `tinno`, `itemname`, `item_desc`, `rate`, `qty`, `weight`, `credit`, `debit`, `amount`, `total`, `status`, `receiptdate`, `invoicedate`, `totalamount`, `payment`, `throughcheck`, `balanceamount`, `payamount`, `paymentmode`, `chamount`, `paidamount`, `balance`, `banktransfer`, `bankamount`, `chequeno`, `paymentdetails`, `overallamount`, `receiptamt`, `invoiceamt`, `returnamount`, `formtype`, `invoicenoyear`, `invoicenodate`, `invoiceid`) VALUES
(9, '-', '-', NULL, '2026-02-11', 'CK/INV/25-26/-001', 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', '', '', '', '1/2\" CL 600 Body', 'heatno : P0213-20', '', '', '', NULL, NULL, '', '', '1', '2026-02-11', '2026-02-11', '103250.00', '-', '-', '', '', '-', '-', NULL, '14487686.5', '-', '-', '-', '-', '103250.00', '-', '103250.00', NULL, NULL, 'CK/INV/25-26/-001-2026', 'CK/INV/25-26/-001130226', '3'),
(5, '-', '-', NULL, '2025-04-09', 'CK/INV/25-26/-002', 2, 'SIGMA POWER & ENERGY ENGINEERS', '', '', '', 'Coal Nozzle ', 'heatno : ', '', '', '', NULL, NULL, '', '', '1', '2025-04-09', '2025-04-09', '236000.00', '-', '-', '', '', '-', '-', NULL, '1244706.92', '-', '-', '-', '-', '236000.00', '-', '236000.00', NULL, NULL, 'CK/INV/25-26/-002-2026', 'CK/INV/25-26/-002130226', '4'),
(7, '-', '-', NULL, '2025-05-07', 'CK/INV/25-26/-003', 9, 'STAAN BIO MED PVT LTD', '', '', '', 'EH Outer Box', 'heatno : P0464-2 , P0470-2 , P0471-2 , P0472-2 , P0473-2 , P0474-2 , P0475-2 , P0476-2 , P0477-2 , P0478-2 , P0479-2 , P0481-2 , P0482-2 , P0483-2 , P0484-2 , P0485-2 , P0495-2 , P0496-2 , P0497-2 , P0498-2', '', '', '', NULL, NULL, '', '', '1', '2025-05-07', '2025-05-07', '268790.00', '-', '-', '', '', '-', '-', NULL, '976889.56', '-', '-', '-', '-', '268790.00', '-', '268790.00', NULL, NULL, 'CK/INV/25-26/-003-2026', 'CK/INV/25-26/-003130226', '5'),
(10, '-', '-', NULL, '2025-05-07', 'CK/INV/25-26/-004', 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', '', '', '', '1/2\" CL 600 Body', 'heatno : P0412-4 , P0424-5 , P0425-5 , P0426-2 , P0443-1', '', '', '', NULL, NULL, '', '', '1', '2025-05-07', '2025-05-07', '24574.00', '-', '-', '', '', '-', '-', NULL, '14487686.5', '-', '-', '-', '-', '24574.00', '-', '24574.00', NULL, NULL, 'CK/INV/25-26/-004-2026', 'CK/INV/25-26/-004140226', '6'),
(14, '-', '-', NULL, '2025-06-09', 'CK/INV/25-26/-005', 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', '', '', '', '4\" 1500 Body||TEST BAR(300mmX50mmX50mm)||Pattern Rework Cost', 'heatno : 33801-3 , 33817-2||heatno : 33801||heatno : ', '', '', '', NULL, NULL, '', '', '1', '2025-06-09', '2025-06-09', '290681.20', '-', '-', '', '', '-', '-', NULL, '14778367.7', '-', '-', '-', '-', '290681.20', '-', '290681.20', NULL, NULL, 'CK/INV/25-26/-005-2026', 'CK/INV/25-26/-005250226', '7');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_party_statement_backup`
--

CREATE TABLE `invoice_party_statement_backup` (
  `id` int(11) NOT NULL,
  `receiptno` varchar(255) DEFAULT NULL,
  `paid` varchar(255) NOT NULL,
  `receiptid` varchar(100) DEFAULT NULL,
  `date` date NOT NULL,
  `invoiceno` varchar(255) NOT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(255) NOT NULL,
  `cstno` varchar(255) NOT NULL,
  `phoneno` varchar(255) NOT NULL,
  `tinno` varchar(255) NOT NULL,
  `itemname` varchar(255) NOT NULL,
  `item_desc` text NOT NULL,
  `rate` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `credit` varchar(255) DEFAULT NULL,
  `debit` varchar(255) DEFAULT NULL,
  `amount` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `receiptdate` date NOT NULL,
  `invoicedate` date NOT NULL,
  `totalamount` varchar(255) NOT NULL,
  `payment` varchar(100) NOT NULL,
  `throughcheck` varchar(255) DEFAULT NULL,
  `balanceamount` varchar(255) NOT NULL,
  `payamount` varchar(255) NOT NULL,
  `paymentmode` varchar(255) DEFAULT NULL,
  `chamount` varchar(255) DEFAULT NULL,
  `paidamount` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `banktransfer` varchar(255) DEFAULT NULL,
  `bankamount` varchar(255) DEFAULT NULL,
  `chequeno` varchar(255) DEFAULT NULL,
  `paymentdetails` varchar(255) DEFAULT NULL,
  `overallamount` varchar(255) DEFAULT NULL,
  `receiptamt` varchar(255) DEFAULT NULL,
  `invoiceamt` varchar(255) DEFAULT NULL,
  `returnamount` varchar(255) DEFAULT NULL,
  `formtype` varchar(255) DEFAULT NULL,
  `invoicenoyear` varchar(255) DEFAULT NULL,
  `invoicenodate` varchar(255) DEFAULT NULL,
  `invoiceid` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_reports`
--

CREATE TABLE `invoice_reports` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `invoiceno` varchar(255) DEFAULT NULL,
  `purchaseordernos` varchar(100) NOT NULL,
  `purchaseorder` varchar(100) NOT NULL,
  `invoicedate` varchar(255) DEFAULT NULL,
  `paymenttype` varchar(255) DEFAULT NULL,
  `dcdate` date DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(255) DEFAULT NULL,
  `mobileno` varchar(255) DEFAULT NULL,
  `tinno` varchar(255) DEFAULT NULL,
  `cstno` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gsttype` varchar(255) DEFAULT NULL,
  `billtype` varchar(255) DEFAULT NULL,
  `deliveryat` varchar(255) DEFAULT NULL,
  `vehicleno` varchar(255) DEFAULT NULL,
  `dcno` varchar(255) DEFAULT NULL,
  `orderdate` date DEFAULT NULL,
  `orderno` varchar(255) DEFAULT NULL,
  `despatch` varchar(255) DEFAULT NULL,
  `hsnno` varchar(255) DEFAULT NULL,
  `heatno` varchar(100) NOT NULL,
  `itemid` varchar(100) NOT NULL,
  `itemcode` varchar(255) DEFAULT NULL,
  `itemno` varchar(255) DEFAULT NULL,
  `itemname` varchar(255) DEFAULT NULL,
  `item_desc` text NOT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `uom` varchar(100) NOT NULL,
  `grade` varchar(100) NOT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `weight` varchar(100) NOT NULL,
  `total` varchar(255) DEFAULT NULL,
  `totalamount` varchar(255) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `disamount` varchar(255) DEFAULT NULL,
  `grandtotal` varchar(255) DEFAULT NULL,
  `paid` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `invoicenoyear` varchar(255) DEFAULT NULL,
  `invoicenodate` varchar(255) DEFAULT NULL,
  `invoiceid` varchar(255) DEFAULT NULL,
  `workorderid` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_reports`
--

INSERT INTO `invoice_reports` (`id`, `date`, `invoiceno`, `purchaseordernos`, `purchaseorder`, `invoicedate`, `paymenttype`, `dcdate`, `customerId`, `customername`, `mobileno`, `tinno`, `cstno`, `address`, `gsttype`, `billtype`, `deliveryat`, `vehicleno`, `dcno`, `orderdate`, `orderno`, `despatch`, `hsnno`, `heatno`, `itemid`, `itemcode`, `itemno`, `itemname`, `item_desc`, `rate`, `uom`, `grade`, `qty`, `weight`, `total`, `totalamount`, `subtotal`, `discount`, `disamount`, `grandtotal`, `paid`, `balance`, `status`, `invoicenoyear`, `invoicenodate`, `invoiceid`, `workorderid`) VALUES
(9, '2026-02-13', 'CK/INV/25-26/-001', '', '', '2026-02-11', NULL, NULL, 0, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', NULL, NULL, NULL, 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', 'intrastate', 'intrastate', NULL, '', NULL, '2025-03-18', 'CAD2025361REV01', NULL, '73259930', '', '3', 'CA16', NULL, '1/2\" CL 600 Body', 'heatno : P0213-20', '1250', '', '1', '20', '3.5', NULL, NULL, '87500.00', NULL, NULL, '103250.00', NULL, NULL, '1', 'CK/INV/25-26/-001-2026', 'CK/INV/25-26/-001130226', '3', ''),
(5, '2026-02-13', 'CK/INV/25-26/-002', 'CK/WO/25-26/-001', 'PO3704', '2025-04-09', NULL, NULL, 2, 'SIGMA POWER & ENERGY ENGINEERS', NULL, NULL, NULL, 'PLOT No.E-5 SIDCO INDUSTRIES ESTATE, Phase II, VALAVANTHAN KOTTAI, THUVAKUDI, TRICHY, Tamil Nadu', 'intrastate', 'intrastate', '', '', NULL, '1970-01-01', '', NULL, '84803000', '', '1', 'SP01', NULL, 'Coal Nozzle ', 'heatno : ', '2', '', '6', '1', '1', '', NULL, '200000.00', NULL, NULL, '236000.00', NULL, NULL, '1', 'CK/INV/25-26/-002-2026', 'CK/INV/25-26/-002130226', '4', '3'),
(7, '2026-02-13', 'CK/INV/25-26/-003', '', '', '2025-05-07', NULL, NULL, 0, 'STAAN BIO MED PVT LTD', NULL, NULL, NULL, '190-A, Bharathiar Road, Ganapathy, Coimbatore, Tamil Nadu', 'intrastate', 'intrastate', NULL, '', NULL, '1970-01-01', '', NULL, '73259999', '', '4', 'SBM08', NULL, 'EH Outer Box', 'heatno : P0464-2 , P0470-2 , P0471-2 , P0472-2 , P0473-2 , P0474-2 , P0475-2 , P0476-2 , P0477-2 , P0478-2 , P0479-2 , P0481-2 , P0482-2 , P0483-2 , P0484-2 , P0485-2 , P0495-2 , P0496-2 , P0497-2 , P0498-2', '167', '', '2', '40', '34.1', NULL, NULL, '227788.00', NULL, NULL, '268790.00', NULL, NULL, '1', 'CK/INV/25-26/-003-2026', 'CK/INV/25-26/-003130226', '5', ''),
(10, '2026-02-14', 'CK/INV/25-26/-004', '', '', '2025-05-07', NULL, NULL, 0, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', NULL, NULL, NULL, 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', 'intrastate', 'intrastate', NULL, '', NULL, '1970-01-01', '', NULL, '73259999', '', '3', 'CA16', NULL, '1/2\" CL 600 Body', 'heatno : P0412-4 , P0424-5 , P0425-5 , P0426-2 , P0443-1', '350', '', '2', '17', '3.5', NULL, NULL, '20825.00', NULL, NULL, '24574.00', NULL, NULL, '1', 'CK/INV/25-26/-004-2026', 'CK/INV/25-26/-004140226', '6', ''),
(24, '2026-02-25', 'CK/INV/25-26/-005', '', '', '2025-06-09', NULL, NULL, 0, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', NULL, NULL, NULL, 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', 'intrastate', 'intrastate', NULL, '', NULL, '1970-01-01', '', NULL, '84803000', '', '24', 'PR1', NULL, 'Pattern Rework Cost', 'heatno : ', '9500', '', '6', '1', '1', NULL, NULL, '245340.00', NULL, NULL, '290681.20', NULL, NULL, '1', 'CK/INV/25-26/-005-2026', 'CK/INV/25-26/-005250226', '7', ''),
(22, '2026-02-25', 'CK/INV/25-26/-005', '', '', '2025-06-09', NULL, NULL, 0, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', NULL, NULL, NULL, 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', 'intrastate', 'intrastate', NULL, '', NULL, '1970-01-01', '', NULL, '73259999', '', '18', 'CA02', NULL, '4\" 1500 Body', 'heatno : 33801-3 , 33817-2', '220', '', '2', '5', '212', NULL, NULL, '245340.00', NULL, NULL, '290681.20', NULL, NULL, '1', 'CK/INV/25-26/-005-2026', 'CK/INV/25-26/-005250226', '7', ''),
(23, '2026-02-25', 'CK/INV/25-26/-005', '', '', '2025-06-09', NULL, NULL, 0, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', NULL, NULL, NULL, 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', 'intrastate', 'intrastate', NULL, '', NULL, '1970-01-01', '', NULL, '73259999', '', '23', 'TB1', NULL, 'TEST BAR(300mmX50mmX50mm)', 'heatno : 33801', '220', '', '2', '2', '6', NULL, NULL, '245340.00', NULL, NULL, '290681.20', NULL, NULL, '1', 'CK/INV/25-26/-005-2026', 'CK/INV/25-26/-005250226', '7', '');

-- --------------------------------------------------------

--
-- Table structure for table `inward_delivery`
--

CREATE TABLE `inward_delivery` (
  `id` int(11) NOT NULL,
  `insertid` int(11) NOT NULL,
  `date` date NOT NULL,
  `inwardno` varchar(255) NOT NULL,
  `inwarddate` date NOT NULL,
  `cusname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `customerdcno` varchar(255) NOT NULL,
  `customerdcdate` date NOT NULL,
  `itemid` varchar(100) NOT NULL,
  `heatno` varchar(50) NOT NULL,
  `itemname` longtext NOT NULL,
  `item_desc` text NOT NULL,
  `qty` longtext NOT NULL,
  `balanceqty` varchar(225) DEFAULT NULL,
  `lastupdatedqty` int(11) NOT NULL,
  `remarks` longtext NOT NULL,
  `hsnno` longtext,
  `itemcode` varchar(255) DEFAULT NULL,
  `uom` longtext,
  `grade` varchar(50) NOT NULL,
  `inwardnoyear` varchar(225) DEFAULT NULL,
  `inwardnodate` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `inward_status` int(11) DEFAULT NULL,
  `lastupdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `inward_details`
--

CREATE TABLE `inward_details` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `inwardno` varchar(255) NOT NULL,
  `inwarddate` date NOT NULL,
  `cusname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `customerdcno` varchar(255) NOT NULL,
  `customerdcdate` date NOT NULL,
  `itemid` varchar(100) NOT NULL,
  `heatno` varchar(50) NOT NULL,
  `itemname` longtext NOT NULL,
  `item_desc` text NOT NULL,
  `qty` longtext NOT NULL,
  `remarks` longtext NOT NULL,
  `hsnno` longtext,
  `itemcode` varchar(255) DEFAULT NULL,
  `uom` longtext,
  `grade` varchar(50) NOT NULL,
  `inwardnoyear` varchar(225) DEFAULT NULL,
  `inwardnodate` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `delete_status` int(11) DEFAULT NULL,
  `inward_delivery_id` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inward_details_backup`
--

CREATE TABLE `inward_details_backup` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `inwardno` varchar(255) NOT NULL,
  `inwarddate` date NOT NULL,
  `cusname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `customerdcno` varchar(255) NOT NULL,
  `customerdcdate` date NOT NULL,
  `itemid` varchar(100) NOT NULL,
  `heatno` varchar(100) NOT NULL,
  `itemname` longtext NOT NULL,
  `item_desc` text NOT NULL,
  `qty` longtext NOT NULL,
  `remarks` longtext NOT NULL,
  `hsnno` longtext,
  `itemcode` varchar(255) DEFAULT NULL,
  `uom` longtext,
  `grade` varchar(100) NOT NULL,
  `inwardnoyear` varchar(225) DEFAULT NULL,
  `inwardnodate` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `delete_status` int(11) DEFAULT NULL,
  `inward_delivery_id` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jobinward_data`
--

CREATE TABLE `jobinward_data` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `insertid` int(11) DEFAULT NULL,
  `jobinwardno` varchar(225) DEFAULT NULL,
  `joborderno` varchar(225) DEFAULT NULL,
  `itemname` varchar(225) DEFAULT NULL,
  `qty` varchar(225) DEFAULT NULL,
  `joborderqty` varchar(225) DEFAULT NULL,
  `hsnno` varchar(225) DEFAULT NULL,
  `uom` varchar(225) DEFAULT NULL,
  `returnitemname` varchar(225) DEFAULT NULL,
  `returnqty` varchar(225) DEFAULT NULL,
  `scrap` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `job_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `jobinward_details`
--

CREATE TABLE `jobinward_details` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `jobtype` varchar(225) DEFAULT NULL,
  `jobinwardno` varchar(225) DEFAULT NULL,
  `jobinwarddate` date DEFAULT NULL,
  `dateofcompletion` date DEFAULT NULL,
  `operatorname` varchar(225) DEFAULT NULL,
  `vendors` varchar(225) DEFAULT NULL,
  `vendordetails` longtext,
  `joborderno` varchar(225) DEFAULT NULL,
  `category` longtext,
  `jobdescription` longtext,
  `issueby` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `jobworkdc_delivery`
--

CREATE TABLE `jobworkdc_delivery` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `insertid` int(11) NOT NULL,
  `inwardid` int(11) DEFAULT NULL,
  `dctype` varchar(225) NOT NULL,
  `dcno` varchar(225) NOT NULL,
  `dcdate` varchar(225) NOT NULL,
  `customerId` int(11) NOT NULL,
  `cusname` varchar(225) NOT NULL,
  `dispatchthrough` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL,
  `inwardno` longtext,
  `customerdcno` varchar(225) DEFAULT NULL,
  `customerdcdate` varchar(225) DEFAULT NULL,
  `itemname` longtext NOT NULL,
  `itemid` varchar(100) NOT NULL,
  `item_desc` text NOT NULL,
  `qty` longtext NOT NULL,
  `balanceqty` varchar(225) DEFAULT NULL,
  `weight` varchar(100) NOT NULL,
  `remarks` longtext NOT NULL,
  `hsnno` longtext NOT NULL,
  `grade` varchar(100) NOT NULL,
  `itemcode` varchar(255) DEFAULT NULL,
  `uom` longtext NOT NULL,
  `dcnoyear` varchar(225) NOT NULL,
  `dcnodate` varchar(225) NOT NULL,
  `status` int(11) NOT NULL,
  `dc_status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jobworkdc_delivery_backup`
--

CREATE TABLE `jobworkdc_delivery_backup` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `insertid` int(11) NOT NULL,
  `inwardid` int(11) DEFAULT NULL,
  `dctype` varchar(225) NOT NULL,
  `dcno` varchar(225) NOT NULL,
  `dcdate` varchar(225) NOT NULL,
  `customerId` int(11) NOT NULL,
  `cusname` varchar(225) NOT NULL,
  `dispatchthrough` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL,
  `inwardno` longtext,
  `customerdcno` varchar(225) DEFAULT NULL,
  `customerdcdate` varchar(225) DEFAULT NULL,
  `itemname` longtext NOT NULL,
  `item_desc` text NOT NULL,
  `qty` longtext NOT NULL,
  `balanceqty` varchar(225) DEFAULT NULL,
  `remarks` longtext NOT NULL,
  `hsnno` longtext NOT NULL,
  `itemcode` varchar(255) DEFAULT NULL,
  `uom` longtext NOT NULL,
  `dcnoyear` varchar(225) NOT NULL,
  `dcnodate` varchar(225) NOT NULL,
  `status` int(11) NOT NULL,
  `dc_status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jobworkdc_details`
--

CREATE TABLE `jobworkdc_details` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `dctype` varchar(225) DEFAULT NULL,
  `dcno` varchar(225) DEFAULT NULL,
  `dcdate` date DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `cusname` varchar(225) DEFAULT NULL,
  `vehicleno` varchar(100) NOT NULL,
  `dispatchthrough` varchar(225) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `process` varchar(255) DEFAULT NULL,
  `remarkss` varchar(255) DEFAULT NULL,
  `approximate_value` varchar(255) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `inwardno` longtext,
  `customerdcno` longtext,
  `customerdcdate` longtext,
  `itemname` longtext,
  `itemid` varchar(100) NOT NULL,
  `item_desc` text NOT NULL,
  `qty` longtext,
  `weight` varchar(100) NOT NULL,
  `remarks` longtext,
  `hsnno` longtext,
  `itemcode` varchar(255) DEFAULT NULL,
  `uom` longtext,
  `grade` varchar(100) NOT NULL,
  `dcnoyear` varchar(225) DEFAULT NULL,
  `dcnodate` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `edit_status` tinyint(4) NOT NULL,
  `delete_status` int(11) DEFAULT NULL,
  `billtype` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jobworkdc_details_backup`
--

CREATE TABLE `jobworkdc_details_backup` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `dctype` varchar(225) DEFAULT NULL,
  `dcno` varchar(225) DEFAULT NULL,
  `dcdate` date DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `cusname` varchar(225) DEFAULT NULL,
  `dispatchthrough` varchar(225) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `process` varchar(255) DEFAULT NULL,
  `remarkss` varchar(255) DEFAULT NULL,
  `approximate_value` varchar(255) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `inwardno` longtext,
  `customerdcno` longtext,
  `customerdcdate` longtext,
  `itemname` longtext,
  `item_desc` text NOT NULL,
  `qty` longtext,
  `remarks` longtext,
  `hsnno` longtext,
  `itemcode` varchar(255) DEFAULT NULL,
  `uom` longtext,
  `dcnoyear` varchar(225) DEFAULT NULL,
  `dcnodate` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `delete_status` int(11) DEFAULT NULL,
  `billtype` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_data`
--

CREATE TABLE `job_data` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `insertid` int(11) DEFAULT NULL,
  `joborderno` varchar(225) DEFAULT NULL,
  `itemname` varchar(225) DEFAULT NULL,
  `qty` varchar(225) DEFAULT NULL,
  `hsnno` varchar(225) DEFAULT NULL,
  `uom` varchar(225) DEFAULT NULL,
  `returnitemname` varchar(225) DEFAULT NULL,
  `returnqty` varchar(225) DEFAULT NULL,
  `scrap` varchar(225) DEFAULT NULL,
  `balanceqty` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `job_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_details`
--

CREATE TABLE `job_details` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `jobtype` varchar(225) DEFAULT NULL,
  `joborderno` varchar(225) DEFAULT NULL,
  `joborderdate` date DEFAULT NULL,
  `dateofcompletion` date DEFAULT NULL,
  `operatorname` varchar(225) DEFAULT NULL,
  `vendors` varchar(225) DEFAULT NULL,
  `vendordetails` longtext,
  `category` longtext,
  `jobdescription` longtext,
  `issueby` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `id` int(11) NOT NULL,
  `userType` char(1) NOT NULL,
  `date` date DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phoneno` varchar(255) DEFAULT NULL,
  `doj` date DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `sub_menu_link` text,
  `selectedMainMenu` text NOT NULL,
  `selectedSubMenu` text NOT NULL,
  `add_party` int(11) DEFAULT NULL,
  `add_expenses` int(11) DEFAULT NULL,
  `add_quotation` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`id`, `userType`, `date`, `name`, `designation`, `email`, `phoneno`, `doj`, `username`, `password`, `status`, `sub_menu_link`, `selectedMainMenu`, `selectedSubMenu`, `add_party`, `add_expenses`, `add_quotation`) VALUES
(1, 'A', '2017-01-26', 'admin', '', 'test@gmail.com', '876049652', '0000-00-00', 'admin', 'admin001', '1', '', '', '', NULL, NULL, NULL),
(5, 'U', '2018-05-02', 'purchase', 'Purchase Team', '', '', '1970-01-01', 'purchase', '123456', '1', 'purchase,inward,inward/view,inward/pending,stockmaster,daily_stockreports,customer/view', 'Purchase,Inward,Inward,Inward,Stock,Stock,Reports', 'Purchase Receipt,Add Inward,Inward Reports,Inward Pending,Add Stock,Daily Stock Reports,Party Reports', 1, 0, 0),
(6, 'U', '2018-05-02', 'Accounts', 'Accounts Team', '', '', '1970-01-01', 'Accounts', '123456', '1', 'invoice_statement/view,tax/view,cashbill/listing,purchase_statement/view,purchasetax/view,voucher,voucher/reports,stockmaster,daily_stockreports,itemwise_report,expenses/reports,quotation/view', 'Sales Invoice,Sales Invoice,Cash Bill,Purchase,Purchase,Voucher,Voucher,Stock,Stock,Stock,Reports,Reports', 'Invoice Party Statement,Invoice Tax Reports,Cash Bill Reports,Purchase Party Statement,Purchase Tax Reports,Add Voucher,Voucher Reports,Add Stock,Daily Stock Reports,Itemwise Reports,Expenses Reports,Quotation Reports', 0, 0, 0),
(7, 'U', '2018-08-10', 'ramesh', 'developer', '', '', '1970-01-01', 'ramesh', '123456', '1', 'dashboard,invoice,invoice/view,invoice_statement/view,tax/view,proforma_invoice,purchase,purchase/reports,purchase_statement/view,purchasetax/view,stockmaster,itemmaster', 'dashboard,Sales Invoice,Sales Invoice,Sales Invoice,Sales Invoice,Sales Invoice,Purchase,Purchase,Purchase,Purchase,Stock,Settings', 'Dashboard,Add Invoice,Invoice Reports,Invoice Party Statement,Invoice Tax Reports,Add Proforma Invoice,Purchase Receipt,Purchase Reports,Purchase Party Statement,Purchase Tax Reports,Add Stock,Add Item', 0, 0, 0),
(8, 'U', '2018-08-10', 'tester1', 'testing', '', '', '1970-01-01', 'tester1', '123456', '1', 'dashboard,invoice,invoice/view,invoice_statement/view,tax/view,proforma_invoice,purchase,purchase/view,purchase_statement/view,purchasetax/view,taxtype,uom,itemmaster', 'dashboard,Sales Invoice,Sales Invoice,Sales Invoice,Sales Invoice,Sales Invoice,Purchase,Purchase,Purchase,Purchase,Settings,Settings,Settings', 'Dashboard,Add Invoice,Invoice Reports,Invoice Party Statement,Invoice Tax Reports,Add Proforma Invoice,Purchase Receipt,Purchase Reports,Purchase Party Statement,Purchase Tax Reports,Tax Type,Add UOM,Add Item', 1, 0, 0),
(9, 'U', '2021-06-28', 'parmesh', 'developer', 'pshm956@gmail.com', '8344031191', '2021-06-28', 'parmesh', '123456', '1', 'dashboard,invoice,invoice/view,invoice_statement/view,tax/view,proforma_invoice,proforma_invoice/view', 'dashboard,Sales Invoice,Sales Invoice,Sales Invoice,Sales Invoice,Sales Invoice,Sales Invoice', 'Dashboard,Add Invoice,Invoice Reports,Invoice Party Statement,Invoice Tax Reports,Add Proforma Invoice,Proforma Invoice Reports', 0, 0, 0),
(10, 'U', '2023-09-12', 'jp', 'quotation', 'jp@idreamdevelopers.com', '7810028222', '2023-09-12', 'jp', '123456', '1', 'taxtype,uom,itemmaster,headers,profile,backup,support,usermaster', 'Settings,Settings,Settings,Settings,Settings,Settings,Settings,Settings', 'Tax Type,Add UOM,Add Item,Account Headers,Company Profile,Backup Settings,Support,User Manager', 1, 1, 1),
(12, 'U', '2025-06-20', 'Pradeepa ', 'Technical support', 'pradee@gmail.com', '9500995841', '2025-06-03', 'Pradeepa ', 'adminoo1', '1', '', '', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `materialdc_delivery`
--

CREATE TABLE `materialdc_delivery` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `insertid` int(11) NOT NULL,
  `inwardid` int(11) DEFAULT NULL,
  `dctype` varchar(225) NOT NULL,
  `dcno` varchar(225) NOT NULL,
  `dcdate` varchar(225) NOT NULL,
  `customerId` int(11) NOT NULL,
  `cusname` varchar(225) NOT NULL,
  `dispatchthrough` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL,
  `inwardno` longtext,
  `customerdcno` varchar(225) DEFAULT NULL,
  `customerdcdate` varchar(225) DEFAULT NULL,
  `itemname` longtext NOT NULL,
  `item_desc` text NOT NULL,
  `qty` longtext NOT NULL,
  `balanceqty` varchar(225) DEFAULT NULL,
  `remarks` longtext NOT NULL,
  `hsnno` longtext NOT NULL,
  `itemcode` varchar(255) DEFAULT NULL,
  `uom` longtext NOT NULL,
  `dcnoyear` varchar(225) NOT NULL,
  `dcnodate` varchar(225) NOT NULL,
  `status` int(11) NOT NULL,
  `dc_status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `materialdc_details`
--

CREATE TABLE `materialdc_details` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `dctype` varchar(225) DEFAULT NULL,
  `dcno` varchar(225) DEFAULT NULL,
  `dcdate` date DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `cusname` varchar(225) DEFAULT NULL,
  `dispatchthrough` varchar(225) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `process` varchar(255) DEFAULT NULL,
  `remarkss` varchar(255) DEFAULT NULL,
  `approximate_value` varchar(255) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `inwardno` longtext,
  `customerdcno` longtext,
  `customerdcdate` longtext,
  `itemname` longtext,
  `item_desc` text NOT NULL,
  `qty` longtext,
  `remarks` longtext,
  `hsnno` longtext,
  `itemcode` varchar(255) DEFAULT NULL,
  `uom` longtext,
  `dcnoyear` varchar(225) DEFAULT NULL,
  `dcnodate` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `delete_status` int(11) DEFAULT NULL,
  `billtype` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `materialdc_details_backup`
--

CREATE TABLE `materialdc_details_backup` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `dctype` varchar(225) DEFAULT NULL,
  `dcno` varchar(225) DEFAULT NULL,
  `dcdate` date DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `cusname` varchar(225) DEFAULT NULL,
  `dispatchthrough` varchar(225) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `process` varchar(255) DEFAULT NULL,
  `remarkss` varchar(255) DEFAULT NULL,
  `approximate_value` varchar(255) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `inwardno` longtext,
  `customerdcno` longtext,
  `customerdcdate` longtext,
  `itemname` longtext,
  `item_desc` text NOT NULL,
  `qty` longtext,
  `remarks` longtext,
  `hsnno` longtext,
  `itemcode` varchar(255) DEFAULT NULL,
  `uom` longtext,
  `dcnoyear` varchar(225) DEFAULT NULL,
  `dcnodate` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `delete_status` int(11) DEFAULT NULL,
  `billtype` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mpt_report`
--

CREATE TABLE `mpt_report` (
  `id` int(11) NOT NULL,
  `date` varchar(100) NOT NULL,
  `mpt_report_no` varchar(100) NOT NULL,
  `mpt_date` varchar(100) NOT NULL,
  `customername` varchar(100) NOT NULL,
  `customerid` varchar(100) NOT NULL,
  `grade` varchar(100) NOT NULL,
  `equipment_make` varchar(100) NOT NULL,
  `magnetic_powder_color` varchar(100) NOT NULL,
  `equipment_type` varchar(100) NOT NULL,
  `prod_spacing` varchar(100) NOT NULL,
  `procedure_ref` varchar(100) NOT NULL,
  `current_amps` varchar(100) NOT NULL,
  `stage_of_test` varchar(100) NOT NULL,
  `magnetisation` varchar(100) NOT NULL,
  `process` varchar(100) NOT NULL,
  `surface_condition` varchar(100) NOT NULL,
  `inspection_date` varchar(100) NOT NULL,
  `acceptance_standard` varchar(100) NOT NULL,
  `current` varchar(100) NOT NULL,
  `medium` varchar(100) NOT NULL,
  `light_indensity` varchar(100) NOT NULL,
  `fluosrecent` varchar(100) NOT NULL,
  `area_of_test` varchar(100) NOT NULL,
  `casting_temp` varchar(100) NOT NULL,
  `demagnetization` varchar(100) NOT NULL,
  `observation` varchar(100) NOT NULL,
  `po_no_dt` longtext NOT NULL,
  `description` longtext NOT NULL,
  `drawing_no` longtext NOT NULL,
  `heat_no` longtext NOT NULL,
  `mpi_no` longtext NOT NULL,
  `desp_qty` longtext NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mtc_report`
--

CREATE TABLE `mtc_report` (
  `id` int(11) NOT NULL,
  `date` varchar(100) NOT NULL,
  `tcno` varchar(100) NOT NULL,
  `tcdate` varchar(100) NOT NULL,
  `heatno` varchar(100) NOT NULL,
  `customername` varchar(100) NOT NULL,
  `customerid` varchar(100) NOT NULL,
  `purchaseorderno` varchar(100) NOT NULL,
  `purchaseorder` varchar(100) NOT NULL,
  `grade` varchar(100) NOT NULL,
  `heat_treatment` text NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `itemname` varchar(255) NOT NULL,
  `drawing_no` varchar(100) NOT NULL,
  `partno` varchar(100) NOT NULL,
  `poured_qty` varchar(100) NOT NULL,
  `chemical_element` text NOT NULL,
  `chemical_minvalue` text NOT NULL,
  `chemical_maxvalue` text NOT NULL,
  `chemical_actualvalue` text NOT NULL,
  `mechanical_element` longtext NOT NULL,
  `mechanical_minvalue` text NOT NULL,
  `mechanical_maxvalue` text NOT NULL,
  `mechanical_actualvalue` text NOT NULL,
  `remarks` longtext NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mtc_report`
--

INSERT INTO `mtc_report` (`id`, `date`, `tcno`, `tcdate`, `heatno`, `customername`, `customerid`, `purchaseorderno`, `purchaseorder`, `grade`, `heat_treatment`, `product_code`, `itemname`, `drawing_no`, `partno`, `poured_qty`, `chemical_element`, `chemical_minvalue`, `chemical_maxvalue`, `chemical_actualvalue`, `mechanical_element`, `mechanical_minvalue`, `mechanical_maxvalue`, `mechanical_actualvalue`, `remarks`, `status`) VALUES
(1, '2026-02-13', 'MTC/25-26/001', '20-03-2025', 'P0213', 'M/S CADALAN OFFSHORE PRIVATE LIMITED', '7', '-', 'CK/WO/25-26/-003', '1', 'SOLUTION ANNEALING : 1080 ° C / 3 HRS SOAKED / WATER QUENCHED', 'CA16', '1/2\" CL 600 Body', '-', '', 'CA16', 'C.%,Si.%,Mn.%,S.%,P.%,Cr.%,Ni.%,Mo.%,,,,,,,', '-,-,-,-,-,17.000,9.000,2.000,,,,,,,', '0.030,1.500,1.500,0.040,0.040,21.000,13.000,3.000,,,,,,,', '0.027,0.885,1.370,0.004,0.024,17.340,10.310,2.050,,,,,,,', 'Yield Strength,Tensile Strength,% Elongation,% Reduction of Area,Hardness,Bend Test,Impact Test in Joules', '205,485,30,-,-,,', '-,,,-,200,,', '370.15,574.35,63.30,,163,,', '<p><span style=\"font-size: 12px;\">﻿Separate test bar poured and the same bar tested for chemical and mechanical properties</span></p><p><span style=\"font-size: 12px;\"><br></span></p><p><span style=\"font-size: 12px;\"><br></span><br></p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `po_party_statements`
--

CREATE TABLE `po_party_statements` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `purchasedate` date DEFAULT NULL,
  `receiptno` varchar(255) DEFAULT NULL,
  `purchaseno` varchar(255) DEFAULT NULL,
  `joborder_No` varchar(100) NOT NULL,
  `supplierId` int(11) NOT NULL,
  `suppliername` varchar(255) DEFAULT NULL,
  `mobileno` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `itemname` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `currentpaid` varchar(255) NOT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `paid` varchar(255) DEFAULT NULL,
  `paidamount` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `paymentmode` varchar(255) DEFAULT NULL,
  `throughcheck` varchar(255) DEFAULT NULL,
  `chequeno` varchar(255) DEFAULT NULL,
  `chamount` varchar(255) DEFAULT NULL,
  `banktransfer` varchar(255) DEFAULT NULL,
  `bankamount` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `paymentdetails` varchar(255) DEFAULT NULL,
  `openingbalance` varchar(225) DEFAULT NULL,
  `receiptamt` varchar(255) DEFAULT NULL,
  `returnamount` varchar(255) DEFAULT NULL,
  `purchaseamt` varchar(255) DEFAULT NULL,
  `formtype` varchar(255) DEFAULT NULL,
  `invoiceno` varchar(255) DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `purchasenodate` varchar(255) DEFAULT NULL,
  `purchasenoyear` varchar(255) DEFAULT NULL,
  `purchaseid` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `po_party_statements`
--

INSERT INTO `po_party_statements` (`id`, `date`, `purchasedate`, `receiptno`, `purchaseno`, `joborder_No`, `supplierId`, `suppliername`, `mobileno`, `address`, `itemname`, `qty`, `total`, `currentpaid`, `purpose`, `payment`, `paid`, `paidamount`, `balance`, `paymentmode`, `throughcheck`, `chequeno`, `chamount`, `banktransfer`, `bankamount`, `amount`, `paymentdetails`, `openingbalance`, `receiptamt`, `returnamount`, `purchaseamt`, `formtype`, `invoiceno`, `invoicedate`, `status`, `purchasenodate`, `purchasenoyear`, `purchaseid`) VALUES
(3, '2025-03-20', '2025-03-20', '-', 'CK/P/25-26/.-001', '', 8, 'PREMIER ALLOYS', NULL, NULL, '1/2\" CL 600 Body', NULL, '48852.00', '-', '-', '-', '-', '-', '3135833.62', NULL, '-', '-', '-', '-', '-', '48852.00', '-', NULL, '-', NULL, '48852.00', NULL, '0290/24-25', '2025-03-20', '1', 'CK/P/25-26/.-001110226', 'CK/P/25-26/.-001-2026', '3'),
(4, '2025-04-09', '2025-04-09', '-', 'CK/P/25-26/.-026', '', 11, 'Sri Ayyappa Engineering Works', NULL, NULL, 'Coal Nozzle ', NULL, '171100.00', '-', '-', '-', '-', '-', '171100', NULL, '-', '-', '-', '-', '-', '171100.00', '-', NULL, '-', NULL, '171100.00', NULL, 'SA003/25-26', '2025-04-09', '1', 'CK/P/25-26/.-026120226', 'CK/P/25-26/.-026-2026', '4'),
(7, '2025-05-05', '2025-05-05', '-', 'CK/P/25-26/.-026', '', 0, 'PREMIER ALLOYS', NULL, NULL, '1/2\\\" CL 600 Body||1/2\\\" CL 600 Body||1/2\\\" CL 600 Body||1/2\\\" CL 600 Body||1/2\\\" CL 600 Body||EH Outer Box||EH Outer Box||EH Outer Box||EH Outer Box||EH Outer Box||EH Outer Box||EH Outer Box||EH Outer Box||EH Outer Box||EH Outer Box||EH Outer Box||EH Out', NULL, '263518.00', '-', '-', '-', '-', '-', '3399351.62', NULL, '-', '-', '-', '-', '-', '3304.00||4130.00||4130.00||1652.00||826.00||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78', '-', NULL, '-', NULL, '263518.00', NULL, '0026/25-26', '2025-05-05', '1', 'CK/P/25-26/.-026180226', 'CK/P/25-26/.-026-2026', '5'),
(8, '2025-05-05', '2025-05-05', '-', 'CK/P/25-26/.-026', '', 0, 'PKS Inspection Service', NULL, NULL, 'Inspection', NULL, '2360.00', '-', '-', '-', '-', '-', '2360', NULL, '-', '-', '-', '-', '-', '2360.00', '-', NULL, '-', NULL, '2360.00', NULL, 'PKS/09/25-26', '2025-05-05', '1', 'CK/P/25-26/.-026180226', 'CK/P/25-26/.-026-2026', '6'),
(9, '2025-05-09', '2025-05-09', '-', 'CK/P/25-26/005', '', 11, 'Sri Ayyappa Engineering Works', NULL, NULL, '4\" 1500 Body', NULL, '9440.00', '-', '-', '-', '-', '-', '180540', NULL, '-', '-', '-', '-', '-', '9440.00', '-', NULL, '-', NULL, '9440.00', NULL, 'SA010/25-26', '2025-05-09', '1', 'CK/P/25-26/005180226', 'CK/P/25-26/005-2026', '7'),
(10, '2025-05-29', '2025-05-29', '-', 'CK/P/25-26/006', '', 11, 'Sri Ayyappa Engineering Works', NULL, NULL, 'Retainer 3.0 Pattern||Retainer 2.0  Pattern', NULL, '84960.00', '-', '-', '-', '-', '-', '265500', NULL, '-', '-', '-', '-', '-', '37760.00||47200.00', '-', NULL, '-', NULL, '84960.00', NULL, 'SA012/25-26', '2025-05-29', '1', 'CK/P/25-26/006180226', 'CK/P/25-26/006-2026', '8'),
(11, '2025-06-01', '2025-06-01', '-', 'CK/P/25-26/007', '', 12, 'PKS Inspection Service', NULL, NULL, 'Inspection', NULL, '2360.00', '-', '-', '-', '-', '-', '4720', NULL, '-', '-', '-', '-', '-', '2360.00', '-', NULL, '-', NULL, '2360.00', NULL, 'PKS/11/25-26', '2025-06-01', '1', 'CK/P/25-26/007180226', 'CK/P/25-26/007-2026', '9'),
(18, '2025-06-07', '2025-06-07', '-', 'CK/P/25-26/008', '', 14, 'Shree Kumaran Alloys', NULL, NULL, '4\" 1500 Body||4\" 1500 Body', NULL, '215070.00', '-', '-', '-', '-', '-', '215070', NULL, '-', '-', '-', '-', '-', '129041.85||86027.90', '-', NULL, '-', NULL, '215070.00', NULL, 'D0138/25-26', '2025-06-07', '1', 'CK/P/25-26/008250226', 'CK/P/25-26/008-2026', '16'),
(21, '2025-06-09', '2025-06-09', '-', 'CK/P/25-26/009', '', 14, 'Shree Kumaran Alloys', NULL, NULL, 'TEST BAR(300mmX50mmX50mm)', NULL, '2478.00', '-', '-', '-', '-', '-', '217548', NULL, '-', '-', '-', '-', '-', '2478.00', '-', NULL, '-', NULL, '2478.00', NULL, 'D0139/25-26', '2025-06-09', '1', 'CK/P/25-26/009250226', 'CK/P/25-26/009-2026', '19');

-- --------------------------------------------------------

--
-- Table structure for table `po_party_statements_backup`
--

CREATE TABLE `po_party_statements_backup` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `purchasedate` date DEFAULT NULL,
  `receiptno` varchar(255) DEFAULT NULL,
  `purchaseno` varchar(255) DEFAULT NULL,
  `supplierId` int(11) NOT NULL,
  `suppliername` varchar(255) DEFAULT NULL,
  `mobileno` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `itemname` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `currentpaid` varchar(255) NOT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `paid` varchar(255) DEFAULT NULL,
  `paidamount` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `paymentmode` varchar(255) DEFAULT NULL,
  `throughcheck` varchar(255) DEFAULT NULL,
  `chequeno` varchar(255) DEFAULT NULL,
  `chamount` varchar(255) DEFAULT NULL,
  `banktransfer` varchar(255) DEFAULT NULL,
  `bankamount` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `paymentdetails` varchar(255) DEFAULT NULL,
  `openingbalance` varchar(225) DEFAULT NULL,
  `receiptamt` varchar(255) DEFAULT NULL,
  `returnamount` varchar(255) DEFAULT NULL,
  `purchaseamt` varchar(255) DEFAULT NULL,
  `formtype` varchar(255) DEFAULT NULL,
  `invoiceno` varchar(255) DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `purchasenodate` varchar(255) DEFAULT NULL,
  `purchasenoyear` varchar(255) DEFAULT NULL,
  `purchaseid` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `preference_details`
--

CREATE TABLE `preference_details` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `sed` varchar(255) DEFAULT NULL,
  `edc` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `preference_settings`
--

CREATE TABLE `preference_settings` (
  `id` int(11) NOT NULL,
  `quotationPrefix` varchar(255) NOT NULL,
  `quotation` varchar(255) NOT NULL,
  `expenses` varchar(255) NOT NULL,
  `expensePrefix` varchar(255) NOT NULL,
  `dc` varchar(255) NOT NULL,
  `voucherPrefix` varchar(255) NOT NULL,
  `voucher` varchar(255) NOT NULL,
  `debitPrefix` varchar(255) NOT NULL,
  `debit` varchar(255) NOT NULL,
  `creditPrefix` varchar(255) NOT NULL,
  `credit` varchar(255) NOT NULL,
  `purchasePrefix` varchar(255) NOT NULL,
  `purchase` varchar(255) NOT NULL,
  `invoicePrefix` varchar(255) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `salesdcPrefix` varchar(255) NOT NULL,
  `materialdcPrefix` varchar(255) NOT NULL,
  `jobdcPrefix` varchar(255) NOT NULL,
  `proforma_invoicePrefix` varchar(255) NOT NULL,
  `proforma_invoice` varchar(255) NOT NULL,
  `inwardPrefix` varchar(255) NOT NULL,
  `inward` varchar(255) NOT NULL,
  `cashbillPrefix` varchar(255) NOT NULL,
  `cashbill_invoice` varchar(255) NOT NULL,
  `mtcPrefix` varchar(100) NOT NULL,
  `tcno` varchar(100) NOT NULL,
  `insPrefix` varchar(100) NOT NULL,
  `insno` varchar(100) NOT NULL,
  `utPrefix` varchar(100) NOT NULL,
  `utno` varchar(100) NOT NULL,
  `mptPrefix` varchar(100) NOT NULL,
  `mptno` varchar(100) NOT NULL,
  `dptPrefix` varchar(100) NOT NULL,
  `dptno` varchar(100) NOT NULL,
  `creditnote` varchar(255) DEFAULT NULL,
  `po_prefix` varchar(50) NOT NULL,
  `purchaseorder` varchar(255) NOT NULL,
  `spo_prefix` varchar(50) NOT NULL,
  `supplierpurchaseorder` varchar(100) NOT NULL,
  `jobworkdc` varchar(255) DEFAULT NULL,
  `materialdc` varchar(255) DEFAULT NULL,
  `cmp_companyname` varchar(255) NOT NULL,
  `cmp_phoneno` varchar(255) NOT NULL,
  `cmp_mobileno` varchar(255) NOT NULL,
  `cmp_address1` varchar(255) NOT NULL,
  `cmp_address2` varchar(255) NOT NULL,
  `cmp_city` varchar(255) NOT NULL,
  `cmp_pincode` varchar(255) NOT NULL,
  `cmp_stateCode` varchar(255) NOT NULL,
  `cmp_website` varchar(255) NOT NULL,
  `cmp_emailid` varchar(255) NOT NULL,
  `cmp_logo` varchar(255) NOT NULL,
  `cont_companyname` varchar(255) NOT NULL,
  `cont_phoneno` varchar(255) NOT NULL,
  `cont_mobileno` varchar(255) NOT NULL,
  `cont_address1` varchar(255) NOT NULL,
  `cont_address2` varchar(255) NOT NULL,
  `cont_city` varchar(255) NOT NULL,
  `cont_pincode` varchar(255) NOT NULL,
  `cont_stateCode` varchar(255) NOT NULL,
  `cont_website` varchar(255) NOT NULL,
  `cont_emailid` varchar(255) NOT NULL,
  `cont_logo` varchar(255) NOT NULL,
  `discountBy` varchar(255) NOT NULL,
  `invoiceBy` varchar(255) NOT NULL,
  `itemType` varchar(255) NOT NULL,
  `bill_type` varchar(255) DEFAULT NULL,
  `quot_bill_type` varchar(255) DEFAULT NULL,
  `voucher_receivable` varchar(255) DEFAULT NULL,
  `voucher_payable` varchar(255) DEFAULT NULL,
  `last_backup` date NOT NULL,
  `itemcode` varchar(255) DEFAULT NULL,
  `inward_add` varchar(255) NOT NULL,
  `cashbill_add` varchar(255) NOT NULL,
  `cashbill_tax_type` varchar(255) NOT NULL,
  `priceType` varchar(255) DEFAULT NULL,
  `priceType1` varchar(255) DEFAULT NULL,
  `sales_dc` int(11) NOT NULL,
  `material_dc` int(11) NOT NULL,
  `jobwork_dc` int(11) NOT NULL,
  `cpo_type` varchar(255) NOT NULL,
  `spo_type` varchar(255) NOT NULL,
  `proforma_type` varchar(255) NOT NULL,
  `attendance` int(11) NOT NULL,
  `status` int(10) NOT NULL,
  `einvoice` int(11) NOT NULL,
  `eway` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `preference_settings`
--

INSERT INTO `preference_settings` (`id`, `quotationPrefix`, `quotation`, `expenses`, `expensePrefix`, `dc`, `voucherPrefix`, `voucher`, `debitPrefix`, `debit`, `creditPrefix`, `credit`, `purchasePrefix`, `purchase`, `invoicePrefix`, `invoice`, `salesdcPrefix`, `materialdcPrefix`, `jobdcPrefix`, `proforma_invoicePrefix`, `proforma_invoice`, `inwardPrefix`, `inward`, `cashbillPrefix`, `cashbill_invoice`, `mtcPrefix`, `tcno`, `insPrefix`, `insno`, `utPrefix`, `utno`, `mptPrefix`, `mptno`, `dptPrefix`, `dptno`, `creditnote`, `po_prefix`, `purchaseorder`, `spo_prefix`, `supplierpurchaseorder`, `jobworkdc`, `materialdc`, `cmp_companyname`, `cmp_phoneno`, `cmp_mobileno`, `cmp_address1`, `cmp_address2`, `cmp_city`, `cmp_pincode`, `cmp_stateCode`, `cmp_website`, `cmp_emailid`, `cmp_logo`, `cont_companyname`, `cont_phoneno`, `cont_mobileno`, `cont_address1`, `cont_address2`, `cont_city`, `cont_pincode`, `cont_stateCode`, `cont_website`, `cont_emailid`, `cont_logo`, `discountBy`, `invoiceBy`, `itemType`, `bill_type`, `quot_bill_type`, `voucher_receivable`, `voucher_payable`, `last_backup`, `itemcode`, `inward_add`, `cashbill_add`, `cashbill_tax_type`, `priceType`, `priceType1`, `sales_dc`, `material_dc`, `jobwork_dc`, `cpo_type`, `spo_type`, `proforma_type`, `attendance`, `status`, `einvoice`, `eway`) VALUES
(1, 'Q', '001', '001', 'E', '001', 'CK/V/25-26/-', '001', 'D', '001', 'C', '001', 'CK/P/25-26/', '', 'CK/INV/25-26/-', '', 'CK/DC/25-26/-', 'CK/MDC/25-26/-', 'CK/PDC/25-26/-', 'CK/PI/25-26/-', '001', 'CK/I/25-26/-', '001', 'CB', '001', 'MTC/25-26/', '', 'CK/CIR/', '', 'CK/UT', '001', 'CK/MPT', '001', 'CK/DPT', '001', NULL, 'CK/WO/25-26/-', '', 'CK/PUR/25-26/-', '', '001', '001', 'Myoffice Solutions', '7373333321', '8608701222', ' #91 Dr. Jaganathan Nagar', 'Civil Aerodrome Post, Coimbatore', 'Coimbatore', '641014', '33', 'www.idreamdevelopers.org', 'info@idreamdevelopers.com', '12832299_1579401915712151_5416626780361493206_n.png', 'IDREAMDEVELOPERS', '7373333321', '8608701333', ' #91 Dr. Jaganathan Nagar', 'Civil Aerodrome Post, Coimbatore', 'Coimbatore', '641014', '33', 'www.idreamdevelopers.com', 'info@idreamdevelopers.com', 'idream_logo.PNG', 'amount_wise', 'without_stock', 'with_item', 'Overall Tax', 'Overall Tax', 'Without Invoice', 'Without Purchase', '2025-03-01', '1', 'With Inward', 'Without Cashbill', 'Overall Tax', '1', '0', 1, 0, 3, 'Overall Tax', 'Overall Tax', 'Overall Tax', 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `companyname` varchar(255) DEFAULT NULL,
  `softwarename` varchar(255) DEFAULT NULL,
  `mobileno` varchar(255) DEFAULT NULL,
  `phoneno` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `stateCode` varchar(255) NOT NULL,
  `emailid` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `tinno` varchar(255) DEFAULT NULL,
  `cstno` varchar(255) DEFAULT NULL,
  `gstin` varchar(225) DEFAULT NULL,
  `aadharno` varchar(225) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `bankname` varchar(255) DEFAULT NULL,
  `accountno` varchar(255) DEFAULT NULL,
  `bankbranch` varchar(255) DEFAULT NULL,
  `ifsccode` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `date`, `companyname`, `softwarename`, `mobileno`, `phoneno`, `address1`, `address2`, `city`, `pincode`, `stateCode`, `emailid`, `website`, `tinno`, `cstno`, `gstin`, `aadharno`, `status`, `username`, `password`, `bankname`, `accountno`, `bankbranch`, `ifsccode`, `state`) VALUES
(1, NULL, 'CK PRIME ALLOYS', 'MYOFFICE ERP', '9790153461', '9159531600', 'SF.NO:845B, Door No:1J(4) Annur road, Rayarpalayam', ' Karumathampatti', 'Coimbatore', '641659', 'TamilNadu', 'ckprimealloys@gmail.com', 'www.ckprimealloys.com', '12345', '54321', '33CGRPR4623R1ZI', '', '1', 'admin', 'admin001', 'City Union Bank', '510909010332667 ', 'Somanur Branch', 'CIUB0000097', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `proforma_invoice_details`
--

CREATE TABLE `proforma_invoice_details` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `orderno` varchar(255) DEFAULT NULL,
  `orderdate` date DEFAULT NULL,
  `invoiceno` varchar(225) DEFAULT NULL,
  `dcno` longtext,
  `bill_type` varchar(255) NOT NULL,
  `invoicetype` varchar(225) DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `deliveryat` varchar(225) DEFAULT NULL,
  `transportmode` varchar(255) DEFAULT NULL,
  `vehicleno` varchar(225) DEFAULT NULL,
  `billtype` varchar(255) DEFAULT NULL,
  `gsttype` varchar(225) DEFAULT NULL,
  `typesgst` longtext,
  `typecgst` longtext,
  `typeigst` longtext,
  `dcnos` longtext,
  `insertid` varchar(225) DEFAULT NULL,
  `deliveryid` longtext,
  `hsnno` longtext,
  `itemcode` varchar(255) DEFAULT NULL,
  `itemname` longtext,
  `item_desc` text NOT NULL,
  `uom` longtext,
  `rate` longtext,
  `qty` longtext,
  `amount` longtext,
  `discount` longtext,
  `discountBy` varchar(255) NOT NULL,
  `discountamount` longtext,
  `taxableamount` longtext,
  `sgst` longtext,
  `sgstamount` longtext,
  `cgst` longtext,
  `cgstamount` longtext,
  `igst` longtext,
  `igstamount` longtext,
  `total` longtext,
  `subtotal` varchar(225) DEFAULT NULL,
  `freightamount` varchar(225) DEFAULT NULL,
  `freightcgst` varchar(225) DEFAULT NULL,
  `freightcgstamount` varchar(225) DEFAULT NULL,
  `freightsgst` varchar(225) DEFAULT NULL,
  `freightsgstamount` varchar(225) DEFAULT NULL,
  `freightigst` varchar(225) DEFAULT NULL,
  `freightigstamount` varchar(225) DEFAULT NULL,
  `freighttotal` varchar(225) DEFAULT NULL,
  `loadingamount` varchar(225) DEFAULT NULL,
  `loadingcgst` varchar(225) DEFAULT NULL,
  `loadingcgstamount` varchar(225) DEFAULT NULL,
  `loadingsgst` varchar(225) DEFAULT NULL,
  `loadingsgstamount` varchar(225) DEFAULT NULL,
  `loadingigst` varchar(225) DEFAULT NULL,
  `loadingigstamount` varchar(225) DEFAULT NULL,
  `loadingtotal` varchar(225) DEFAULT NULL,
  `roundOff` varchar(255) NOT NULL,
  `othercharges` varchar(225) DEFAULT NULL,
  `return_status` longtext,
  `grandtotal` varchar(225) DEFAULT NULL,
  `invoicenodate` varchar(225) DEFAULT NULL,
  `invoicenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `proforma_invoice_details_backup`
--

CREATE TABLE `proforma_invoice_details_backup` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `orderno` varchar(255) DEFAULT NULL,
  `orderdate` date DEFAULT NULL,
  `invoiceno` varchar(225) DEFAULT NULL,
  `dcno` longtext,
  `bill_type` varchar(255) NOT NULL,
  `invoicetype` varchar(225) DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `deliveryat` varchar(225) DEFAULT NULL,
  `transportmode` varchar(255) DEFAULT NULL,
  `vehicleno` varchar(225) DEFAULT NULL,
  `billtype` varchar(255) DEFAULT NULL,
  `gsttype` varchar(225) DEFAULT NULL,
  `typesgst` longtext,
  `typecgst` longtext,
  `typeigst` longtext,
  `dcnos` longtext,
  `insertid` varchar(225) DEFAULT NULL,
  `deliveryid` longtext,
  `hsnno` longtext,
  `itemcode` varchar(255) NOT NULL,
  `itemname` longtext,
  `item_desc` text NOT NULL,
  `uom` longtext,
  `rate` longtext,
  `qty` longtext,
  `amount` longtext,
  `discount` longtext,
  `discountBy` varchar(255) NOT NULL,
  `discountamount` longtext,
  `taxableamount` longtext,
  `sgst` longtext,
  `sgstamount` longtext,
  `cgst` longtext,
  `cgstamount` longtext,
  `igst` longtext,
  `igstamount` longtext,
  `total` longtext,
  `subtotal` varchar(225) DEFAULT NULL,
  `freightamount` varchar(225) DEFAULT NULL,
  `freightcgst` varchar(225) DEFAULT NULL,
  `freightcgstamount` varchar(225) DEFAULT NULL,
  `freightsgst` varchar(225) DEFAULT NULL,
  `freightsgstamount` varchar(225) DEFAULT NULL,
  `freightigst` varchar(225) DEFAULT NULL,
  `freightigstamount` varchar(225) DEFAULT NULL,
  `freighttotal` varchar(225) DEFAULT NULL,
  `loadingamount` varchar(225) DEFAULT NULL,
  `loadingcgst` varchar(225) DEFAULT NULL,
  `loadingcgstamount` varchar(225) DEFAULT NULL,
  `loadingsgst` varchar(225) DEFAULT NULL,
  `loadingsgstamount` varchar(225) DEFAULT NULL,
  `loadingigst` varchar(225) DEFAULT NULL,
  `loadingigstamount` varchar(225) DEFAULT NULL,
  `loadingtotal` varchar(225) DEFAULT NULL,
  `roundOff` varchar(255) NOT NULL,
  `othercharges` varchar(225) DEFAULT NULL,
  `return_status` longtext,
  `grandtotal` varchar(225) DEFAULT NULL,
  `invoicenodate` varchar(225) DEFAULT NULL,
  `invoicenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `proforma_invoice_reports`
--

CREATE TABLE `proforma_invoice_reports` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `invoiceno` varchar(255) DEFAULT NULL,
  `invoicedate` varchar(255) DEFAULT NULL,
  `paymenttype` varchar(255) DEFAULT NULL,
  `dcdate` date DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(255) DEFAULT NULL,
  `mobileno` varchar(255) DEFAULT NULL,
  `tinno` varchar(255) DEFAULT NULL,
  `cstno` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gsttype` varchar(255) DEFAULT NULL,
  `billtype` varchar(255) DEFAULT NULL,
  `deliveryat` varchar(255) DEFAULT NULL,
  `vehicleno` varchar(255) DEFAULT NULL,
  `dcno` varchar(255) DEFAULT NULL,
  `orderdate` date DEFAULT NULL,
  `orderno` varchar(255) DEFAULT NULL,
  `despatch` varchar(255) DEFAULT NULL,
  `hsnno` varchar(255) DEFAULT NULL,
  `itemcode` varchar(255) DEFAULT NULL,
  `itemno` varchar(255) DEFAULT NULL,
  `itemname` varchar(255) DEFAULT NULL,
  `item_desc` text NOT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `uom` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `totalamount` varchar(255) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `disamount` varchar(255) DEFAULT NULL,
  `grandtotal` varchar(255) DEFAULT NULL,
  `paid` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `invoicenoyear` varchar(255) DEFAULT NULL,
  `invoicenodate` varchar(255) DEFAULT NULL,
  `invoiceid` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `proinvoice_party_statement`
--

CREATE TABLE `proinvoice_party_statement` (
  `id` int(11) NOT NULL,
  `receiptno` varchar(255) DEFAULT NULL,
  `paid` varchar(255) NOT NULL,
  `receiptid` varchar(100) DEFAULT NULL,
  `date` date NOT NULL,
  `invoiceno` varchar(255) NOT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(255) NOT NULL,
  `cstno` varchar(255) NOT NULL,
  `phoneno` varchar(255) NOT NULL,
  `tinno` varchar(255) NOT NULL,
  `itemname` varchar(255) NOT NULL,
  `item_desc` text NOT NULL,
  `rate` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `credit` varchar(255) DEFAULT NULL,
  `debit` varchar(255) DEFAULT NULL,
  `amount` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `receiptdate` date NOT NULL,
  `invoicedate` date NOT NULL,
  `totalamount` varchar(255) NOT NULL,
  `payment` varchar(100) NOT NULL,
  `throughcheck` varchar(255) DEFAULT NULL,
  `balanceamount` varchar(255) NOT NULL,
  `payamount` varchar(255) NOT NULL,
  `paymentmode` varchar(255) DEFAULT NULL,
  `chamount` varchar(255) DEFAULT NULL,
  `paidamount` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `banktransfer` varchar(255) DEFAULT NULL,
  `bankamount` varchar(255) DEFAULT NULL,
  `chequeno` varchar(255) DEFAULT NULL,
  `paymentdetails` varchar(255) DEFAULT NULL,
  `overallamount` varchar(255) DEFAULT NULL,
  `receiptamt` varchar(255) DEFAULT NULL,
  `invoiceamt` varchar(255) DEFAULT NULL,
  `returnamount` varchar(255) DEFAULT NULL,
  `formtype` varchar(255) DEFAULT NULL,
  `invoicenoyear` varchar(255) DEFAULT NULL,
  `invoicenodate` varchar(255) DEFAULT NULL,
  `invoiceid` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorder_details`
--

CREATE TABLE `purchaseorder_details` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `purchasedate` date DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `deliverydate` varchar(100) NOT NULL,
  `potype` varchar(255) NOT NULL,
  `purchaseorderno` varchar(225) DEFAULT NULL,
  `purchaseorder` varchar(255) DEFAULT NULL,
  `selected_bom` varchar(255) DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `invoiceno` varchar(225) DEFAULT NULL,
  `billtype` varchar(225) DEFAULT NULL,
  `gsttype` varchar(225) DEFAULT NULL,
  `typesgst` longtext,
  `typecgst` longtext,
  `typeigst` longtext,
  `hsnno` longtext,
  `itemid` varchar(255) DEFAULT NULL,
  `itemcode` longtext,
  `heatno` text,
  `itemname` longtext,
  `item_desc` text NOT NULL,
  `drawingno` varchar(100) NOT NULL,
  `grade` varchar(100) NOT NULL,
  `uom` longtext,
  `weight` varchar(100) NOT NULL,
  `rate` longtext,
  `qty` longtext,
  `balanceqty` longtext,
  `bom_qty` varchar(255) NOT NULL,
  `amount` longtext,
  `discount` longtext,
  `discountBy` longtext NOT NULL,
  `discountamount` longtext,
  `taxableamount` longtext,
  `sgst` longtext,
  `sgstamount` longtext,
  `cgst` longtext,
  `cgstamount` longtext,
  `igst` longtext,
  `igstamount` longtext,
  `total` longtext,
  `subtotal` longtext,
  `freightamount` varchar(225) DEFAULT NULL,
  `freightcgst` varchar(225) DEFAULT NULL,
  `freightcgstamount` varchar(225) DEFAULT NULL,
  `freightsgst` varchar(225) DEFAULT NULL,
  `freightsgstamount` varchar(225) DEFAULT NULL,
  `freightigst` varchar(225) DEFAULT NULL,
  `freightigstamount` varchar(225) DEFAULT NULL,
  `freighttotal` varchar(225) DEFAULT NULL,
  `loadingamount` varchar(225) DEFAULT NULL,
  `loadingcgst` varchar(225) DEFAULT NULL,
  `loadingcgstamount` varchar(225) DEFAULT NULL,
  `loadingsgst` varchar(225) DEFAULT NULL,
  `loadingsgstamount` varchar(225) DEFAULT NULL,
  `loadingigst` varchar(225) DEFAULT NULL,
  `loadingigstamount` varchar(225) DEFAULT NULL,
  `loadingtotal` varchar(225) DEFAULT NULL,
  `othercharges` varchar(225) DEFAULT NULL,
  `roundOff` varchar(255) DEFAULT NULL,
  `return_status` longtext,
  `grandtotal` varchar(225) DEFAULT NULL,
  `purchasenodate` varchar(225) DEFAULT NULL,
  `purchasenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `oa_status` int(11) NOT NULL,
  `oa_deliverydate` varchar(255) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL,
  `invoice_status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `purchaseorder_details`
--

INSERT INTO `purchaseorder_details` (`id`, `date`, `purchasedate`, `invoicedate`, `deliverydate`, `potype`, `purchaseorderno`, `purchaseorder`, `selected_bom`, `customerId`, `customername`, `address`, `invoiceno`, `billtype`, `gsttype`, `typesgst`, `typecgst`, `typeigst`, `hsnno`, `itemid`, `itemcode`, `heatno`, `itemname`, `item_desc`, `drawingno`, `grade`, `uom`, `weight`, `rate`, `qty`, `balanceqty`, `bom_qty`, `amount`, `discount`, `discountBy`, `discountamount`, `taxableamount`, `sgst`, `sgstamount`, `cgst`, `cgstamount`, `igst`, `igstamount`, `total`, `subtotal`, `freightamount`, `freightcgst`, `freightcgstamount`, `freightsgst`, `freightsgstamount`, `freightigst`, `freightigstamount`, `freighttotal`, `loadingamount`, `loadingcgst`, `loadingcgstamount`, `loadingsgst`, `loadingsgstamount`, `loadingigst`, `loadingigstamount`, `loadingtotal`, `othercharges`, `roundOff`, `return_status`, `grandtotal`, `purchasenodate`, `purchasenoyear`, `status`, `oa_status`, `oa_deliverydate`, `edit_status`, `invoice_status`) VALUES
(1, '2026-02-10', '2025-03-06', '2025-03-06', '30-04-2025', 'Direct PO', 'CK/WO/25-26/-001', 'PO3704', NULL, 2, 'SIGMA POWER & ENERGY ENGINEERS', 'PLOT No.E-5 SIDCO INDUSTRIES ESTATE, Phase II, VALAVANTHAN KOTTAI, THUVAKUDI, TRICHY, Tamil Nadu', '0', 'intrastate', 'intrastate', NULL, NULL, NULL, '84803000||73259930', '1||2', 'SP01||SP01', NULL, 'Coal Nozzle ||Coal Nozzle(C)', '||', 'C-13-004||C-13-004', '6||5', 'NOS||NOS', '-||95.2', '200000||590', '1||4', '1||4', '', 'NaN||224672.00', '0||0', 'amount_wise', '||', 'NaN||224672.00', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1||1', NULL, 'CK/WO/25-26/-001100226', 'CK/WO/25-26/-001-2026', 1, 2, '30-04-2025||30-04-2025', 2, 1),
(6, '2026-02-11', '2025-03-18', '2025-03-12', '30-04-2025', 'Direct PO', 'CK/WO/25-26/-002', '-', NULL, 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', '0', 'intrastate', 'intrastate', NULL, NULL, NULL, '73259930', '3', 'CA16', NULL, '1/2\" CL 600 Body', '', '-', '1', 'NOS', '3', '1250', '20', '20||20', '', '75000.00', '0', 'amount_wise', '0', '75000.00', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 'CK/WO/25-26/-002110226', 'CK/WO/25-26/-002-2026', 1, 2, '30-03-2025', 2, 1),
(7, '2026-02-11', '2025-03-18', '2025-03-18', '30-05-2025', 'Direct PO', 'CK/WO/25-26/-003', 'CAD2025405 REV 01', NULL, 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', '0', 'intrastate', 'intrastate', NULL, NULL, NULL, '73259999', '3', 'CA16', NULL, '1/2\" CL 600 Body', '', '-', '2', 'NOS', '3', '350', '20', '20', '', '21000.00', '0', 'amount_wise', '0', '21000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 'CK/WO/25-26/-003110226', 'CK/WO/25-26/-003-2026', 1, 2, '30-05-2025', 2, 1),
(8, '2026-02-12', '2025-04-10', '2025-04-10', '10-06-2025', 'Direct PO', 'CK/WO/25-26/-004', 'PO-SC-2526-008', NULL, 9, 'STAAN BIO MED PVT LTD', '190-A, Bharathiar Road, Ganapathy, Coimbatore, Tamil Nadu', '0', 'intrastate', 'intrastate', NULL, NULL, NULL, '73259999', '4', 'SBM08', NULL, 'EH Outer Box', '', 'ST-MSC-017', '2', 'NOS', '33.9', '167', '40', '40', '', '226452.00', '0', 'amount_wise', '0', '226452.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 'CK/WO/25-26/-004120226', 'CK/WO/25-26/-004-2026', 1, 2, '10-06-2025', 2, 1),
(9, '2026-02-12', '2025-04-24', '2025-04-25', '20-06-2025', 'Direct PO', 'CK/WO/25-26/-005', 'PO-SC-2526-020', NULL, 9, 'STAAN BIO MED PVT LTD', '190-A, Bharathiar Road, Ganapathy, Coimbatore, Tamil Nadu', '0', 'intrastate', 'intrastate', NULL, NULL, NULL, '73259999||73259999||73259999', '5||6||7', 'SBM03||SBM05||SBM10', NULL, 'LH Outer Box||LH Inner Box||12FN Top Plate', '||||', 'ST-MSC-016||ST-MSC-014-R1||STMSC022 R1', '2||2||2', 'NOS||NOS||NOS', '24.6||26.1||27', '167||167||167', '40||40||50', '40||40||50', '', '164328.00||174348.00||225450.00', '0||0||0', 'amount_wise', '0||0||0', '164328.00||174348.00||225450.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1||1||1', NULL, 'CK/WO/25-26/-005120226', 'CK/WO/25-26/-005-2026', 1, 2, '30-05-2025||04-06-2025||10-06-2025', 2, 1),
(10, '2026-02-13', '2025-04-26', '2025-04-27', '15-06-2025', 'Direct PO', 'CK/WO/25-26/-006', 'CAD2025363 REV01', NULL, 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', '0', 'intrastate', 'intrastate', NULL, NULL, NULL, '73259999', '18', 'CA02', NULL, '4\" 1500 Body', '', 'CAD-SPS-YST-0001', '2', 'NOS', '212', '220', '5', '5', '', '233200.00', '0', 'amount_wise', '0', '233200.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 'CK/WO/25-26/-006130226', 'CK/WO/25-26/-006-2026', 1, 2, '15-06-2025', 2, 1),
(11, '2026-02-13', '2025-05-01', '2025-05-01', '30-05-2025', 'Direct PO', 'CK/WO/25-26/-007', '1', NULL, 13, 'CKP LOI', 'SF NO.845B,D.NO.1J(4), Annur,Rayarpalayam, Coimbatore, Tamil Nadu', '0', 'intrastate', 'intrastate', NULL, NULL, NULL, '998898', '17', '001', NULL, 'Inspection', '', '-', '7', 'NOS', '1', '2000', '1', '1', '', '2000.00', '0', 'amount_wise', '0', '2000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 'CK/WO/25-26/-007130226', 'CK/WO/25-26/-007-2026', 1, 2, '30-05-2025', 2, 1),
(12, '2026-02-13', '2025-05-05', '2025-05-05', '30-05-2025', 'Direct PO', 'CK/WO/25-26/-008', '2', NULL, 13, 'CKP LOI', 'SF NO.845B,D.NO.1J(4), Annur,Rayarpalayam, Coimbatore, Tamil Nadu', '0', 'intrastate', 'intrastate', NULL, NULL, NULL, '84803000', '18', 'CA02', NULL, '4\" 1500 Body', '', 'CAD-SPS-YST-0001', '6', 'NOS', '1', '8000', '1', '1', '', '8000.00', '0', 'amount_wise', '0', '8000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 'CK/WO/25-26/-008130226', 'CK/WO/25-26/-008-2026', 1, 2, '30-05-2025', 2, 1),
(13, '2026-02-13', '2025-05-12', '2025-05-12', '12-07-2025', 'Direct PO', 'CK/WO/25-26/-009', 'OM/PO/05-25-26/01', NULL, 15, 'OM Industries', 'No:230/2, 4Th Cross,, Vanapadi Road,Sipcot, Ranipet, Tamil Nadu', '0', 'intrastate', 'intrastate', NULL, NULL, NULL, '73259920||73259920||84803000||84803000', '15||||||', 'OMI 01||OMI 02||OMI 01||OMI 02', NULL, 'Retainer 2.0||Retainer 3.0||Retainer 2.0  Pattern||Retainer 3.0 Pattern', '||||with Match Plate||with Match Plate', '2.067398||3.062269||2.067398||3.062269', '3||3||6||6', 'NOS||NOS||NOS||NOS', '103||49||1||1', '185||185||45500||35000', '12||4||1||1', '12', '', '228660.00||36260.00||45500.00||35000.00', '0||0||0||0', 'amount_wise', '0||||0||0', '228660.00||36260.00||45500.00||35000.00', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1||1||1||1', NULL, 'CK/WO/25-26/-009130226', 'CK/WO/25-26/-009-2026', 1, 2, '12-07-2025||12-07-2025||12-07-2025||12-07-2025', 2, 1),
(14, '2026-02-14', '2025-05-13', '2025-05-13', '20-05-2025', 'Direct PO', 'CK/WO/25-26/-010', 'PO 3742', NULL, 2, 'SIGMA POWER & ENERGY ENGINEERS', 'PLOT No.E-5 SIDCO INDUSTRIES ESTATE, Phase II, VALAVANTHAN KOTTAI, THUVAKUDI, TRICHY, Tamil Nadu', '0', 'intrastate', 'intrastate', NULL, NULL, NULL, '73259930', '12', 'SP02', NULL, 'Collector Casting', '', '3-SPG-9473', '4', 'NOS', '29.5', '542', '4', '4', '', '63956.00', '0', 'amount_wise', '0', '63956.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 'CK/WO/25-26/-010140226', 'CK/WO/25-26/-010-2026', 1, 2, '24-06-2025', 2, 1),
(16, '2026-02-14', '2025-05-20', '2025-05-20', '20-06-2025', 'Direct PO', 'CK/WO/25-26/-011', '3', NULL, 13, 'CKP LOI', 'SF NO.845B,D.NO.1J(4), Annur,Rayarpalayam, Coimbatore, Tamil Nadu', '0', 'intrastate', 'intrastate', NULL, NULL, NULL, '84803000', '21', 'SP03', NULL, 'Collector Casting 3-SPG-8557', '1 Set Aluminium Pattern with Match Plate for Rework', '3-SPG-8557', '6', 'NOS', '1', '9500', '1', '1', '', '9500.00', '0', 'amount_wise', '0', '9500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 'CK/WO/25-26/-011140226', 'CK/WO/25-26/-011-2026', 1, 2, '20-06-2025', 2, 1),
(19, '2026-02-14', '2025-06-05', '2025-06-05', '31-07-2025', 'Direct PO', 'CK/WO/25-26/-013', 'PO-2526-0333', NULL, 9, 'STAAN BIO MED PVT LTD', '190-A, Bharathiar Road, Ganapathy, Coimbatore, Tamil Nadu', '0', 'intrastate', 'intrastate', NULL, NULL, NULL, '73259999||73259999||73259999', '8||9||11', 'SBM02||SBM04||SBM09', NULL, 'NH Outer Box||NH Inner Box||Moving Block', '||||', 'ST-MSC-015||ST-MSC-013 R1||ST-MSC-012 R1', '2||2||2', 'NOS||NOS||NOS', '27.2||28.3||10.85', '167||167||167', '40||40||100', '40||40||100', '', '181696.00||189044.00||181195.00', '0||0||0', 'amount_wise', '0||0||0', '181696.00||189044.00||181195.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1||1||1', NULL, 'CK/WO/25-26/-013140226', 'CK/WO/25-26/-013-2026', 1, 2, '17-07-2025||25-07-2025||31-07-2025', 2, 1),
(18, '2026-02-14', '2025-06-03', '2025-06-03', '30-07-2025', 'Direct PO', 'CK/WO/25-26/-012', 'PO 3755', NULL, 2, 'SIGMA POWER & ENERGY ENGINEERS', 'PLOT No.E-5 SIDCO INDUSTRIES ESTATE, Phase II, VALAVANTHAN KOTTAI, THUVAKUDI, TRICHY, Tamil Nadu', '0', 'intrastate', 'intrastate', NULL, NULL, NULL, '73259930', '12', 'SP02', NULL, 'Collector Casting', '', '3-SPG-9473', '4', 'NOS', '27.8', '539', '348', '348', '', '5214501.60', '0', 'amount_wise', '0', '5214501.60', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 'CK/WO/25-26/-012140226', 'CK/WO/25-26/-012-2026', 1, 2, '30-07-2025', 2, 1),
(20, '2026-02-14', '2025-06-16', '2025-06-16', '10-07-2025', 'Direct PO', 'CK/WO/25-26/-014', '3757', NULL, 2, 'SIGMA POWER & ENERGY ENGINEERS', 'PLOT No.E-5 SIDCO INDUSTRIES ESTATE, Phase II, VALAVANTHAN KOTTAI, THUVAKUDI, TRICHY, Tamil Nadu', '0', 'intrastate', 'intrastate', NULL, NULL, NULL, '73259930', '13', 'SP03', NULL, 'Collector Casting 8557', '', '3-SPG-8557 ', '4', 'NOS', '31', '542', '128', '128', '', '2150656.00', '0', 'amount_wise', '0', '2150656.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 'CK/WO/25-26/-014140226', 'CK/WO/25-26/-014-2026', 1, 2, '30-07-2025', 2, 1),
(21, '2026-02-14', '2025-06-23', '2025-06-23', '30-07-2025', 'Direct PO', 'CK/WO/25-26/-015', '4', NULL, 13, 'CKP LOI', 'SF NO.845B,D.NO.1J(4), Annur,Rayarpalayam, Coimbatore, Tamil Nadu', '0', 'intrastate', 'intrastate', NULL, NULL, NULL, '998898', '22', 'WC1', NULL, 'Website Creation', 'Domain (1 year)         Hosting 1 GB(1 year)       6 Pages responsive Design        Watsapp Integration     Social Media Integration  Mobile Responsive Design', '-', '7', 'NOS', '1', '6000', '1', '1', '', '6000.00', '0', 'amount_wise', '0', '6000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 'CK/WO/25-26/-015140226', 'CK/WO/25-26/-015-2026', 1, 2, '30-07-2025', 2, 1),
(22, '2026-02-16', '2025-07-08', '2025-07-09', '02-09-2025', 'Direct PO', 'CK/WO/25-26/-016', 'PO-SC-2526-097', NULL, 9, 'STAAN BIO MED PVT LTD', '190-A, Bharathiar Road, Ganapathy, Coimbatore, Tamil Nadu', '0', 'intrastate', 'intrastate', NULL, NULL, NULL, '73259999||73259999', '5||6', 'SBM03||SBM05', NULL, 'LH Outer Box||LH Inner Box', '||', 'ST-MSC-016||ST-MSC-014-R1', '2||2', 'NOS||NOS', '24.6||26.1', '167||167', '40||40', '40||40', '', '164328.00||174348.00', '0||0', 'amount_wise', '0||0', '164328.00||174348.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1||1', NULL, 'CK/WO/25-26/-016160226', 'CK/WO/25-26/-016-2026', 1, 2, '19-08-2025||29-08-2025', 2, 1),
(23, '2026-02-25', '2025-06-09', '2025-06-09', '09-06-2025', 'Direct PO', 'CK/WO/25-26/-017', 'CAD2025363', NULL, 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', '0', 'intrastate', 'intrastate', NULL, NULL, NULL, '73259999||84803000', '23||24', 'TB1||PR1', NULL, 'TEST BAR(300mmX50mmX50mm)||Pattern Rework Cost', '||||', '-||-||', '2||6', 'NOS||NOS', '6||1', '175||9500|', '2||1', '2||1', '', '2100.00||9500.00', '0||0', 'amount_wise', '0||0||0', '2100.00||9500.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1||1||1', NULL, 'CK/WO/25-26/-017250226', 'CK/WO/25-26/-017-2026', 1, 2, '09-06-2025||09-06-2025', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorder_details_backup`
--

CREATE TABLE `purchaseorder_details_backup` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `purchasedate` date DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `potype` varchar(255) NOT NULL,
  `purchaseorderno` varchar(225) DEFAULT NULL,
  `purchaseorder` varchar(255) DEFAULT NULL,
  `selected_bom` varchar(255) DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `invoiceno` varchar(225) DEFAULT NULL,
  `billtype` varchar(225) DEFAULT NULL,
  `gsttype` varchar(225) DEFAULT NULL,
  `typesgst` longtext,
  `typecgst` longtext,
  `typeigst` longtext,
  `hsnno` longtext,
  `itemcode` varchar(255) DEFAULT NULL,
  `itemname` longtext,
  `uom` longtext,
  `rate` longtext,
  `qty` longtext,
  `balanceqty` varchar(255) DEFAULT NULL,
  `bom_qty` varchar(255) NOT NULL,
  `amount` longtext,
  `discount` longtext,
  `discountBy` varchar(255) NOT NULL,
  `discountamount` longtext,
  `taxableamount` longtext,
  `sgst` longtext,
  `sgstamount` longtext,
  `cgst` longtext,
  `cgstamount` longtext,
  `igst` longtext,
  `igstamount` longtext,
  `total` longtext,
  `subtotal` varchar(225) DEFAULT NULL,
  `freightamount` varchar(225) DEFAULT NULL,
  `freightcgst` varchar(225) DEFAULT NULL,
  `freightcgstamount` varchar(225) DEFAULT NULL,
  `freightsgst` varchar(225) DEFAULT NULL,
  `freightsgstamount` varchar(225) DEFAULT NULL,
  `freightigst` varchar(225) DEFAULT NULL,
  `freightigstamount` varchar(225) DEFAULT NULL,
  `freighttotal` varchar(225) DEFAULT NULL,
  `loadingamount` varchar(225) DEFAULT NULL,
  `loadingcgst` varchar(225) DEFAULT NULL,
  `loadingcgstamount` varchar(225) DEFAULT NULL,
  `loadingsgst` varchar(225) DEFAULT NULL,
  `loadingsgstamount` varchar(225) DEFAULT NULL,
  `loadingigst` varchar(225) DEFAULT NULL,
  `loadingigstamount` varchar(225) DEFAULT NULL,
  `loadingtotal` varchar(225) DEFAULT NULL,
  `othercharges` varchar(225) DEFAULT NULL,
  `roundOff` varchar(255) NOT NULL,
  `return_status` longtext,
  `grandtotal` varchar(225) DEFAULT NULL,
  `purchasenodate` varchar(225) DEFAULT NULL,
  `purchasenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorder_reports`
--

CREATE TABLE `purchaseorder_reports` (
  `id` int(11) NOT NULL,
  `purchaseid` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `potype` varchar(255) NOT NULL,
  `purchaseorderno` varchar(255) DEFAULT NULL,
  `purchaseorder` varchar(255) DEFAULT NULL,
  `selected_bom` varchar(255) DEFAULT NULL,
  `purchasedate` varchar(255) DEFAULT NULL,
  `paymenttype` varchar(255) DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `invoiceno` varchar(255) DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `batchno` varchar(255) DEFAULT NULL,
  `itemcode` varchar(255) DEFAULT NULL,
  `heatno` text,
  `itemid` text,
  `hsnno` varchar(255) DEFAULT NULL,
  `itemname` varchar(255) DEFAULT NULL,
  `item_desc` text NOT NULL,
  `uom` varchar(255) DEFAULT NULL,
  `weight` varchar(100) NOT NULL,
  `grade` varchar(100) NOT NULL,
  `drawingno` varchar(100) NOT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `balaceqty` varchar(255) DEFAULT NULL,
  `bom_qty` varchar(255) NOT NULL,
  `total` varchar(255) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `disamount` varchar(255) DEFAULT NULL,
  `taxname` varchar(255) DEFAULT NULL,
  `taxamount` varchar(255) DEFAULT NULL,
  `adjustment` varchar(255) DEFAULT NULL,
  `grandtotal` varchar(255) DEFAULT NULL,
  `taxtotal` varchar(255) DEFAULT NULL,
  `adjus` varchar(255) DEFAULT NULL,
  `vatadjus` varchar(255) DEFAULT NULL,
  `paid` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `workorderbalance` varchar(100) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `oa_status` int(11) NOT NULL,
  `bedadjs` varchar(200) DEFAULT NULL,
  `edcadjus` varchar(255) DEFAULT NULL,
  `sedadjus` varchar(255) DEFAULT NULL,
  `cstadjus` varchar(255) DEFAULT NULL,
  `taxpercentage` varchar(255) DEFAULT NULL,
  `purchasenoyear` varchar(255) DEFAULT NULL,
  `purchasenodate` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchaseorder_reports`
--

INSERT INTO `purchaseorder_reports` (`id`, `purchaseid`, `date`, `potype`, `purchaseorderno`, `purchaseorder`, `selected_bom`, `purchasedate`, `paymenttype`, `customerId`, `customername`, `address`, `invoiceno`, `invoicedate`, `batchno`, `itemcode`, `heatno`, `itemid`, `hsnno`, `itemname`, `item_desc`, `uom`, `weight`, `grade`, `drawingno`, `rate`, `qty`, `balaceqty`, `bom_qty`, `total`, `subtotal`, `discount`, `disamount`, `taxname`, `taxamount`, `adjustment`, `grandtotal`, `taxtotal`, `adjus`, `vatadjus`, `paid`, `balance`, `workorderbalance`, `status`, `oa_status`, `bedadjs`, `edcadjus`, `sedadjus`, `cstadjus`, `taxpercentage`, `purchasenoyear`, `purchasenodate`) VALUES
(4, '1', '2026-02-10', '', 'CK/WO/25-26/-001', 'PO3704', NULL, '2025-03-06', NULL, 2, 'SIGMA POWER & ENERGY ENGINEERS', 'PLOT No.E-5 SIDCO INDUSTRIES ESTATE, Phase II, VALAVANTHAN KOTTAI, THUVAKUDI, TRICHY, Tamil Nadu', NULL, '2025-03-06', NULL, 'SP01', NULL, '2', '73259930', 'Coal Nozzle(C)', '', 'NOS', '95.2', '5', 'C-13-004', '590', '4', '4', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 2, NULL, NULL, NULL, NULL, NULL, 'CK/WO/25-26/-001-2026', 'CK/WO/25-26/-001100226'),
(3, '1', '2026-02-10', '', 'CK/WO/25-26/-001', 'PO3704', NULL, '2025-03-06', NULL, 2, 'SIGMA POWER & ENERGY ENGINEERS', 'PLOT No.E-5 SIDCO INDUSTRIES ESTATE, Phase II, VALAVANTHAN KOTTAI, THUVAKUDI, TRICHY, Tamil Nadu', NULL, '2025-03-06', NULL, 'SP01', NULL, '1', '84803000', 'Coal Nozzle ', '', 'NOS', '-', '6', 'C-13-004', '200000', '1', '0', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', 2, NULL, NULL, NULL, NULL, NULL, 'CK/WO/25-26/-001-2026', 'CK/WO/25-26/-001100226'),
(15, '6', '2026-02-11', '', 'CK/WO/25-26/-002', '-', NULL, '2015-09-17', NULL, 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', NULL, '2025-03-12', NULL, 'CA16', NULL, '3', '73259930', '1/2\" CL 600 Body', '', 'NOS', '3', '1', '-', '1250', '20', '0', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', 2, NULL, NULL, NULL, NULL, NULL, 'CK/WO/25-26/-002-2026', 'CK/WO/25-26/-002110226'),
(16, '7', '2026-02-11', 'Direct PO', 'CK/WO/25-26/-003', 'CAD2025405 REV 01', NULL, '2025-03-18', NULL, 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', '0', '2025-03-18', NULL, 'CA16', NULL, '3', '73259999', '1/2\" CL 600 Body', '', 'NOS', '3', '2', '-', '350', '20', '3', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 2, NULL, NULL, NULL, NULL, NULL, 'CK/WO/25-26/-003-2026', 'CK/WO/25-26/-003110226'),
(17, '8', '2026-02-12', 'Direct PO', 'CK/WO/25-26/-004', 'PO-SC-2526-008', NULL, '2025-04-10', NULL, 9, 'STAAN BIO MED PVT LTD', '190-A, Bharathiar Road, Ganapathy, Coimbatore, Tamil Nadu', '0', '2025-04-10', NULL, 'SBM08', NULL, '4', '73259999', 'EH Outer Box', '', 'NOS', '33.9', '2', 'ST-MSC-017', '167', '40', '0', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', 2, NULL, NULL, NULL, NULL, NULL, 'CK/WO/25-26/-004-2026', 'CK/WO/25-26/-004120226'),
(18, '9', '2026-02-12', 'Direct PO', 'CK/WO/25-26/-005', 'PO-SC-2526-020', NULL, '2025-04-24', NULL, 9, 'STAAN BIO MED PVT LTD', '190-A, Bharathiar Road, Ganapathy, Coimbatore, Tamil Nadu', '0', '2025-04-25', NULL, 'SBM03', NULL, '5', '73259999', 'LH Outer Box', '', 'NOS', '24.6', '2', 'ST-MSC-016', '167', '40', '40', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 2, NULL, NULL, NULL, NULL, NULL, 'CK/WO/25-26/-005-2026', 'CK/WO/25-26/-005120226'),
(19, '9', '2026-02-12', 'Direct PO', 'CK/WO/25-26/-005', 'PO-SC-2526-020', NULL, '2025-04-24', NULL, 9, 'STAAN BIO MED PVT LTD', '190-A, Bharathiar Road, Ganapathy, Coimbatore, Tamil Nadu', '0', '2025-04-25', NULL, 'SBM05', NULL, '6', '73259999', 'LH Inner Box', '', 'NOS', '26.1', '2', 'ST-MSC-014-R1', '167', '40', '40', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 2, NULL, NULL, NULL, NULL, NULL, 'CK/WO/25-26/-005-2026', 'CK/WO/25-26/-005120226'),
(20, '9', '2026-02-12', 'Direct PO', 'CK/WO/25-26/-005', 'PO-SC-2526-020', NULL, '2025-04-24', NULL, 9, 'STAAN BIO MED PVT LTD', '190-A, Bharathiar Road, Ganapathy, Coimbatore, Tamil Nadu', '0', '2025-04-25', NULL, 'SBM10', NULL, '7', '73259999', '12FN Top Plate', '', 'NOS', '27', '2', 'STMSC022 R1', '167', '50', '50', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 2, NULL, NULL, NULL, NULL, NULL, 'CK/WO/25-26/-005-2026', 'CK/WO/25-26/-005120226'),
(21, '10', '2026-02-13', 'Direct PO', 'CK/WO/25-26/-006', 'CAD2025363 REV01', NULL, '2025-04-26', NULL, 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', '0', '2025-04-27', NULL, 'CA02', NULL, '18', '73259999', '4\" 1500 Body', '', 'NOS', '212', '2', 'CAD-SPS-YST-0001', '220', '5', '0', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', 2, NULL, NULL, NULL, NULL, NULL, 'CK/WO/25-26/-006-2026', 'CK/WO/25-26/-006130226'),
(22, '11', '2026-02-13', 'Direct PO', 'CK/WO/25-26/-007', '1', NULL, '2025-05-01', NULL, 13, 'CKP LOI', 'SF NO.845B,D.NO.1J(4), Annur,Rayarpalayam, Coimbatore, Tamil Nadu', '0', '2025-05-01', NULL, '001', NULL, '17', '998898', 'Inspection', '', 'NOS', '1', '7', '-', '2000', '1', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 2, NULL, NULL, NULL, NULL, NULL, 'CK/WO/25-26/-007-2026', 'CK/WO/25-26/-007130226'),
(23, '12', '2026-02-13', 'Direct PO', 'CK/WO/25-26/-008', '2', NULL, '2025-05-05', NULL, 13, 'CKP LOI', 'SF NO.845B,D.NO.1J(4), Annur,Rayarpalayam, Coimbatore, Tamil Nadu', '0', '2025-05-05', NULL, 'CA02', NULL, '18', '84803000', '4\" 1500 Body', '', 'NOS', '1', '6', 'CAD-SPS-YST-0001', '8000', '1', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 2, NULL, NULL, NULL, NULL, NULL, 'CK/WO/25-26/-008-2026', 'CK/WO/25-26/-008130226'),
(28, '13', '2026-02-13', '', 'CK/WO/25-26/-009', 'OM/PO/05-25-26/01', NULL, '2025-05-12', NULL, 15, 'OM Industries', 'No:230/2, 4Th Cross,, Vanapadi Road,Sipcot, Ranipet, Tamil Nadu', NULL, '2025-05-12', NULL, 'OMI 02', NULL, '', '73259920', 'Retainer 3.0', '', 'NOS', '49', '3', '3.062269', '185', '4', '4', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 2, NULL, NULL, NULL, NULL, NULL, 'CK/WO/25-26/-009-2026', 'CK/WO/25-26/-009130226'),
(27, '13', '2026-02-13', '', 'CK/WO/25-26/-009', 'OM/PO/05-25-26/01', NULL, '2025-05-12', NULL, 15, 'OM Industries', 'No:230/2, 4Th Cross,, Vanapadi Road,Sipcot, Ranipet, Tamil Nadu', NULL, '2025-05-12', NULL, 'OMI 01', NULL, '15', '73259920', 'Retainer 2.0', '', 'NOS', '103', '3', '2.067398', '185', '12', '12', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 2, NULL, NULL, NULL, NULL, NULL, 'CK/WO/25-26/-009-2026', 'CK/WO/25-26/-009130226'),
(29, '13', '2026-02-13', '', 'CK/WO/25-26/-009', 'OM/PO/05-25-26/01', NULL, '2025-05-12', NULL, 15, 'OM Industries', 'No:230/2, 4Th Cross,, Vanapadi Road,Sipcot, Ranipet, Tamil Nadu', NULL, '2025-05-12', NULL, 'OMI 01', NULL, '', '84803000', 'Retainer 2.0  Pattern', '', 'NOS', '1', '6', '2.067398', '45500', '1', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 2, NULL, NULL, NULL, NULL, NULL, 'CK/WO/25-26/-009-2026', 'CK/WO/25-26/-009130226'),
(30, '13', '2026-02-13', '', 'CK/WO/25-26/-009', 'OM/PO/05-25-26/01', NULL, '2025-05-12', NULL, 15, 'OM Industries', 'No:230/2, 4Th Cross,, Vanapadi Road,Sipcot, Ranipet, Tamil Nadu', NULL, '2025-05-12', NULL, 'OMI 02', NULL, '', '84803000', 'Retainer 3.0 Pattern', '', 'NOS', '1', '6', '3.062269', '35000', '1', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 2, NULL, NULL, NULL, NULL, NULL, 'CK/WO/25-26/-009-2026', 'CK/WO/25-26/-009130226'),
(31, '14', '2026-02-14', 'Direct PO', 'CK/WO/25-26/-010', 'PO 3742', NULL, '2025-05-13', NULL, 2, 'SIGMA POWER & ENERGY ENGINEERS', 'PLOT No.E-5 SIDCO INDUSTRIES ESTATE, Phase II, VALAVANTHAN KOTTAI, THUVAKUDI, TRICHY, Tamil Nadu', '0', '2025-05-13', NULL, 'SP02', NULL, '12', '73259930', 'Collector Casting', '', 'NOS', '29.5', '4', '3-SPG-9473', '542', '4', '4', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 2, NULL, NULL, NULL, NULL, NULL, 'CK/WO/25-26/-010-2026', 'CK/WO/25-26/-010140226'),
(40, '18', '2026-02-14', 'Direct PO', 'CK/WO/25-26/-012', 'PO 3755', NULL, '2025-06-03', NULL, 2, 'SIGMA POWER & ENERGY ENGINEERS', 'PLOT No.E-5 SIDCO INDUSTRIES ESTATE, Phase II, VALAVANTHAN KOTTAI, THUVAKUDI, TRICHY, Tamil Nadu', '0', '2025-06-03', NULL, 'SP02', NULL, '12', '73259930', 'Collector Casting', '', 'NOS', '27.8', '4', '3-SPG-9473', '539', '348', '348', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 2, NULL, NULL, NULL, NULL, NULL, 'CK/WO/25-26/-012-2026', 'CK/WO/25-26/-012140226'),
(42, '19', '2026-02-14', 'Direct PO', 'CK/WO/25-26/-013', 'PO-2526-0333', NULL, '2025-06-05', NULL, 9, 'STAAN BIO MED PVT LTD', '190-A, Bharathiar Road, Ganapathy, Coimbatore, Tamil Nadu', '0', '2025-06-05', NULL, 'SBM04', NULL, '9', '73259999', 'NH Inner Box', '', 'NOS', '28.3', '2', 'ST-MSC-013 R1', '167', '40', '40', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 2, NULL, NULL, NULL, NULL, NULL, 'CK/WO/25-26/-013-2026', 'CK/WO/25-26/-013140226'),
(41, '19', '2026-02-14', 'Direct PO', 'CK/WO/25-26/-013', 'PO-2526-0333', NULL, '2025-06-05', NULL, 9, 'STAAN BIO MED PVT LTD', '190-A, Bharathiar Road, Ganapathy, Coimbatore, Tamil Nadu', '0', '2025-06-05', NULL, 'SBM02', NULL, '8', '73259999', 'NH Outer Box', '', 'NOS', '27.2', '2', 'ST-MSC-015', '167', '40', '40', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 2, NULL, NULL, NULL, NULL, NULL, 'CK/WO/25-26/-013-2026', 'CK/WO/25-26/-013140226'),
(36, '16', '2026-02-14', 'Direct PO', 'CK/WO/25-26/-011', '3', NULL, '2025-05-20', NULL, 13, 'CKP LOI', 'SF NO.845B,D.NO.1J(4), Annur,Rayarpalayam, Coimbatore, Tamil Nadu', '0', '2025-05-20', NULL, 'SP03', NULL, '21', '84803000', 'Collector Casting 3-SPG-8557', '1 Set Aluminium Pattern with Match Plate for Rework', 'NOS', '1', '6', '3-SPG-8557', '9500', '1', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 2, NULL, NULL, NULL, NULL, NULL, 'CK/WO/25-26/-011-2026', 'CK/WO/25-26/-011140226'),
(43, '19', '2026-02-14', 'Direct PO', 'CK/WO/25-26/-013', 'PO-2526-0333', NULL, '2025-06-05', NULL, 9, 'STAAN BIO MED PVT LTD', '190-A, Bharathiar Road, Ganapathy, Coimbatore, Tamil Nadu', '0', '2025-06-05', NULL, 'SBM09', NULL, '11', '73259999', 'Moving Block', '', 'NOS', '10.85', '2', 'ST-MSC-012 R1', '167', '100', '100', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 2, NULL, NULL, NULL, NULL, NULL, 'CK/WO/25-26/-013-2026', 'CK/WO/25-26/-013140226'),
(44, '20', '2026-02-14', 'Direct PO', 'CK/WO/25-26/-014', '3757', NULL, '2025-06-16', NULL, 2, 'SIGMA POWER & ENERGY ENGINEERS', 'PLOT No.E-5 SIDCO INDUSTRIES ESTATE, Phase II, VALAVANTHAN KOTTAI, THUVAKUDI, TRICHY, Tamil Nadu', '0', '2025-06-16', NULL, 'SP03', NULL, '13', '73259930', 'Collector Casting 8557', '', 'NOS', '31', '4', '3-SPG-8557 ', '542', '128', '128', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 2, NULL, NULL, NULL, NULL, NULL, 'CK/WO/25-26/-014-2026', 'CK/WO/25-26/-014140226'),
(45, '21', '2026-02-14', 'Direct PO', 'CK/WO/25-26/-015', '4', NULL, '2025-06-23', NULL, 13, 'CKP LOI', 'SF NO.845B,D.NO.1J(4), Annur,Rayarpalayam, Coimbatore, Tamil Nadu', '0', '2025-06-23', NULL, 'WC1', NULL, '22', '998898', 'Website Creation', 'Domain (1 year)         Hosting 1 GB(1 year)       6 Pages responsive Design        Watsapp Integration     Social Media Integration  Mobile Responsive Design', 'NOS', '1', '7', '-', '6000', '1', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 2, NULL, NULL, NULL, NULL, NULL, 'CK/WO/25-26/-015-2026', 'CK/WO/25-26/-015140226'),
(46, '22', '2026-02-16', 'Direct PO', 'CK/WO/25-26/-016', 'PO-SC-2526-097', NULL, '2025-07-08', NULL, 9, 'STAAN BIO MED PVT LTD', '190-A, Bharathiar Road, Ganapathy, Coimbatore, Tamil Nadu', '0', '2025-07-09', NULL, 'SBM03', NULL, '5', '73259999', 'LH Outer Box', '', 'NOS', '24.6', '2', 'ST-MSC-016', '167', '40', '40', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 2, NULL, NULL, NULL, NULL, NULL, 'CK/WO/25-26/-016-2026', 'CK/WO/25-26/-016160226'),
(47, '22', '2026-02-16', 'Direct PO', 'CK/WO/25-26/-016', 'PO-SC-2526-097', NULL, '2025-07-08', NULL, 9, 'STAAN BIO MED PVT LTD', '190-A, Bharathiar Road, Ganapathy, Coimbatore, Tamil Nadu', '0', '2025-07-09', NULL, 'SBM05', NULL, '6', '73259999', 'LH Inner Box', '', 'NOS', '26.1', '2', 'ST-MSC-014-R1', '167', '40', '40', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 2, NULL, NULL, NULL, NULL, NULL, 'CK/WO/25-26/-016-2026', 'CK/WO/25-26/-016160226'),
(48, '23', '2026-02-25', 'Direct PO', 'CK/WO/25-26/-017', 'CAD2025363', NULL, '2025-06-09', NULL, 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', '0', '2025-06-09', NULL, 'TB1', NULL, '23', '73259999', 'TEST BAR(300mmX50mmX50mm)', '', 'NOS', '6', '2', '-', '175', '2', '0', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '0', 2, NULL, NULL, NULL, NULL, NULL, 'CK/WO/25-26/-017-2026', 'CK/WO/25-26/-017250226'),
(49, '23', '2026-02-25', 'Direct PO', 'CK/WO/25-26/-017', 'CAD2025363', NULL, '2025-06-09', NULL, 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', '0', '2025-06-09', NULL, 'PR1', NULL, '24', '84803000', 'Pattern Rework Cost', '', 'NOS', '1', '6', '-', '9500', '1', '0', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', 2, NULL, NULL, NULL, NULL, NULL, 'CK/WO/25-26/-017-2026', 'CK/WO/25-26/-017250226');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_collection`
--

CREATE TABLE `purchase_collection` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `date_po` date NOT NULL,
  `purchasedate` date DEFAULT NULL,
  `invoicedate` varchar(255) DEFAULT NULL,
  `receiptdate` date DEFAULT NULL,
  `throughcheck` varchar(255) DEFAULT NULL,
  `receiptno` varchar(255) DEFAULT NULL,
  `suppliername` varchar(255) DEFAULT NULL,
  `mobileno` varchar(255) DEFAULT NULL,
  `totalamount` varchar(255) DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `alreadypaid` varchar(255) DEFAULT NULL,
  `alreadybalance` varchar(255) DEFAULT NULL,
  `chamount` varchar(255) DEFAULT NULL,
  `banktransfer` varchar(255) DEFAULT NULL,
  `bamount` varchar(255) DEFAULT NULL,
  `bankamount` varchar(255) NOT NULL,
  `chequeno` varchar(255) DEFAULT NULL,
  `paymentmode` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `purchaseno` varchar(255) DEFAULT NULL,
  `currentlypaid` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `paymentdetails` varchar(255) DEFAULT NULL,
  `overallamount` varchar(255) DEFAULT NULL,
  `receiptamt` varchar(255) DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `paid` varchar(255) DEFAULT NULL,
  `invoiceamt` varchar(255) DEFAULT NULL,
  `invoiceno` varchar(255) DEFAULT NULL,
  `purchasenodate` varchar(255) DEFAULT NULL,
  `purchasenoyear` varchar(255) DEFAULT NULL,
  `purchaseid` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `purchasedate` date DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `purchasetype` varchar(100) NOT NULL,
  `purchaseno` varchar(225) DEFAULT NULL,
  `supplierId` int(11) NOT NULL,
  `suppliername` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `invoiceno` varchar(225) DEFAULT NULL,
  `purchaseorderno` varchar(200) NOT NULL,
  `purchaseorder` varchar(200) NOT NULL,
  `poRecordId` varchar(100) NOT NULL,
  `joborder_No` varchar(100) NOT NULL,
  `JO_RecordId` int(11) NOT NULL,
  `billtype` varchar(225) DEFAULT NULL,
  `gsttype` varchar(225) DEFAULT NULL,
  `typesgst` longtext,
  `typecgst` longtext,
  `typeigst` longtext,
  `hsnno` longtext,
  `itemcode` varchar(255) DEFAULT NULL,
  `heatno` text,
  `itemid` text,
  `itemname` longtext,
  `uom` longtext,
  `weight` longtext NOT NULL,
  `grade` longtext NOT NULL,
  `rate` longtext,
  `qty` longtext,
  `amount` longtext,
  `discount` longtext,
  `discountBy` varchar(255) NOT NULL,
  `discountamount` longtext,
  `taxableamount` longtext,
  `sgst` longtext,
  `sgstamount` longtext,
  `cgst` longtext,
  `cgstamount` longtext,
  `igst` longtext,
  `igstamount` longtext,
  `total` longtext,
  `subtotal` varchar(225) DEFAULT NULL,
  `freightamount` varchar(225) DEFAULT NULL,
  `freightcgst` varchar(225) DEFAULT NULL,
  `freightcgstamount` varchar(225) DEFAULT NULL,
  `freightsgst` varchar(225) DEFAULT NULL,
  `freightsgstamount` varchar(225) DEFAULT NULL,
  `freightigst` varchar(225) DEFAULT NULL,
  `freightigstamount` varchar(225) DEFAULT NULL,
  `freighttotal` varchar(225) DEFAULT NULL,
  `loadingamount` varchar(225) DEFAULT NULL,
  `loadingcgst` varchar(225) DEFAULT NULL,
  `loadingcgstamount` varchar(225) DEFAULT NULL,
  `loadingsgst` varchar(225) DEFAULT NULL,
  `loadingsgstamount` varchar(225) DEFAULT NULL,
  `loadingigst` varchar(225) DEFAULT NULL,
  `loadingigstamount` varchar(225) DEFAULT NULL,
  `loadingtotal` varchar(225) DEFAULT NULL,
  `othercharges` varchar(225) DEFAULT NULL,
  `roundOff` varchar(255) NOT NULL,
  `return_status` longtext,
  `grandtotal` varchar(225) DEFAULT NULL,
  `purchasenodate` varchar(225) DEFAULT NULL,
  `purchasenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `vou_status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`id`, `date`, `purchasedate`, `invoicedate`, `purchasetype`, `purchaseno`, `supplierId`, `suppliername`, `address`, `invoiceno`, `purchaseorderno`, `purchaseorder`, `poRecordId`, `joborder_No`, `JO_RecordId`, `billtype`, `gsttype`, `typesgst`, `typecgst`, `typeigst`, `hsnno`, `itemcode`, `heatno`, `itemid`, `itemname`, `uom`, `weight`, `grade`, `rate`, `qty`, `amount`, `discount`, `discountBy`, `discountamount`, `taxableamount`, `sgst`, `sgstamount`, `cgst`, `cgstamount`, `igst`, `igstamount`, `total`, `subtotal`, `freightamount`, `freightcgst`, `freightcgstamount`, `freightsgst`, `freightsgstamount`, `freightigst`, `freightigstamount`, `freighttotal`, `loadingamount`, `loadingcgst`, `loadingcgstamount`, `loadingsgst`, `loadingsgstamount`, `loadingigst`, `loadingigstamount`, `loadingtotal`, `othercharges`, `roundOff`, `return_status`, `grandtotal`, `purchasenodate`, `purchasenoyear`, `status`, `balance`, `vou_status`, `edit_status`) VALUES
(3, '2026-02-11', '2025-03-20', '2025-03-20', 'purchase Order', 'CK/P/25-26/-001', 8, 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0290/24-25', 'CK/PUR/25-26/-002', '-', '10', '', 0, 'intrastate', 'intrastate', 'sgst', 'cgst', '', '73259930', 'CA16', 'P0213', '3', '1/2\" CL 600 Body', 'NOS', '3.45', '1', '600', '20', '41400.00', '0', 'amount_wise', '0.00', '41400.00', '9', '3726.00', '9', '3726.00', '18', '7452.00', '48852.00', '48852.00', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1', '48852.00', 'CK/P/25-26/.-001110226', 'CK/P/25-26/.-001-2026', 1, '48852.00', 1, 1),
(4, '2026-02-12', '2025-04-09', '2025-04-09', 'purchase Order', 'CK/P/25-26/002', 11, 'Sri Ayyappa Engineering Works', '4/348C,Kallipalayam Road, Chikarampalayam, Karamadai, Coimbatore, Tamil Nadu', 'SA003/25-26', 'CK/PUR/25-26/-001', '', '15', '', 0, 'intrastate', 'intrastate', 'sgst', 'cgst', '', '84803000', 'SP01', '', '', 'Coal Nozzle ', 'NOS', '1', '1', '145000', '1', '145000.00', '0', 'amount_wise', '0.00', '145000.00', '9', '13050.00', '9', '13050.00', '18', '26100.00', '171100.00', '171100.00', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1', '171100.00', 'CK/P/25-26/.-026120226', 'CK/P/25-26/.-026-2026', 1, '171100.00', 1, 1),
(5, '2026-02-12', '2025-05-05', '2025-05-05', 'purchase Order', 'CK/P/25-26/003', 8, 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0026/25-26', 'CK/PUR/25-26/-004||CK/PUR/25-26/-004||CK/PUR/25-26/-004||CK/PUR/25-26/-004||CK/PUR/25-26/-004||CK/PUR/25-26/-005||CK/PUR/25-26/-005||CK/PUR/25-26/-005||CK/PUR/25-26/-005||CK/PUR/25-26/-005||CK/PUR/25-', 'CAD2025405 REV 01||CAD2025405 REV 01||CAD2025405 REV 01||CAD2025405 REV 01||CAD2025405 REV 01||PO-SC-2526-008||PO-SC-2526-008||PO-SC-2526-008||PO-SC-2526-008||PO-SC-2526-008||PO-SC-2526-008||PO-SC-252', '12||12||12||12||12||14||14||14||14||14||14||14||14||14||14||14||14||14||14||14||14||14||14||14||14', '', 0, 'intrastate', 'intrastate', 'sgst', 'cgst', '', '73259999||73259999||73259999||73259999||73259999||73259999||73259999||73259999||73259999||73259999||73259999||73259999||73259999||73259999||73259999||73259999||73259999||73259999||73259999||73259999||73259999||73259999||73259999||73259999||73259999', 'CA16||CA16||CA16||CA16||CA16||CA16||CA16||CA16||CA16||CA16||CA16||CA16||CA16||CA16||CA16||CA16||CA16||CA16||CA16||CA16||SBM08||SBM08||SBM08||SBM08||SBM08||SBM08||SBM08||SBM08||SBM08||SBM08||SBM08||SBM08||SBM08||SBM08||SBM08||SBM08||SBM08||SBM08||SBM08||SB', 'P0412||P0424||P0425||P0426||P0443||P0464||P0470||P0471||P0472||P0473||P0474||P0475||P0476||P0477||P0478||P0479||P0481||P0482||P0483||P0484||P0485||P0495||P0496||P0497||P0498', '3||3||3||3||3||||||||||||||||||||||||||||||||||||||||', '1/2\\\" CL 600 Body||1/2\\\" CL 600 Body||1/2\\\" CL 600 Body||1/2\\\" CL 600 Body||1/2\\\" CL 600 Body||EH Outer Box||EH Outer Box||EH Outer Box||EH Outer Box||EH Outer Box||EH Outer Box||EH Outer Box||EH Outer Box||EH Outer Box||EH Outer Box||EH Outer Box||EH Outer Box||EH Outer Box||EH Outer Box||EH Outer Box||EH Outer Box||EH Outer Box||EH Outer Box||EH Outer Box||EH Outer Box', 'NOS||NOS||NOS||NOS||NOS||NOS||NOS||NOS||NOS||NOS||NOS||NOS||NOS||NOS||NOS||NOS||NOS||NOS||NOS||NOS||NOS||NOS||NOS||NOS||NOS', '3.5||3.5||3.5||3.5||3.5||34.1||34.1||34.1||34.1||34.1||34.1||34.1||34.1||34.1||34.1||34.1||34.1||34.1||34.1||34.1||34.1||34.1||34.1||34.1||34.1', '2||2||2||2||2||1||1||1||1||1||1||1||1||1||1||1||1||1||1||1||1||1||1||1||1', '200||200||200||200||200||155||155||155||155||155||155||155||155||155||155||155||155||155||155||155||155||155||155||155||155', '4||5||5||2||1||2||2||2||2||2||2||2||2||2||2||2||2||2||2||2||2||2||2||2||2', '2800.00||3500.00||3500.00||1400.00||700.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00', '0||0||0||0||0||0||0||0||0||0||0||0||0||0||0||0||0||0||0||0||0||0||0||0||0', 'amount_wise', '||||||||||||||||||||||||||||||||||||||||||||||||', '2800.00||3500.00||3500.00||1400.00||700.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00||10571.00', '9||9||9||9||9||9||9||9||9||9||9||9||9||9||9||9||9||9||9||9||9||9||9||9||9', '252.00||315.00||315.00||126.00||63.00||951.39||951.39||951.39||951.39||951.39||951.39||951.39||951.39||951.39||951.39||951.39||951.39||951.39||951.39||951.39||951.39||951.39||951.39||951.39||951.39', '9||9||9||9||9||9||9||9||9||9||9||9||9||9||9||9||9||9||9||9||9||9||9||9||9', '252.00||315.00||315.00||126.00||63.00||951.39||951.39||951.39||951.39||951.39||951.39||951.39||951.39||951.39||951.39||951.39||951.39||951.39||951.39||951.39||951.39||951.39||951.39||951.39||951.39', '18||18||18||18||18||18||18||18||18||18||18||18||18||18||18||18||18||18||18||18||18||18||18||18||18', '504.00||630.00||630.00||252.00||126.00||1902.78||1902.78||1902.78||1902.78||1902.78||1902.78||1902.78||1902.78||1902.78||1902.78||1902.78||1902.78||1902.78||1902.78||1902.78||1902.78||1902.78||1902.78||1902.78||1902.78', '3304.00||4130.00||4130.00||1652.00||826.00||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78||12473.78', '263517.60', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0.40', '1||1||1||1||1||1||1||1||1||1||1||1||1||1||1||1||1||1||1||1||1||1||1||1||1', '263518.00', 'CK/P/25-26/.-026120226', 'CK/P/25-26/.-026-2026', 1, '263518.00', 1, 1),
(6, '2026-02-12', '2025-05-05', '2025-05-05', 'Direct Purchase', 'CK/P/25-26/004', 12, 'PKS Inspection Service', '83A Pudukadu 2nd Street,Sivanathapuram, Vellakovil-638111,Kangeyam Taluk, Tiruppur, Tamil Nadu', 'PKS/09/25-26', '', '', '', '', 0, 'intrastate', 'intrastate', 'sgst', 'cgst', '', '', '001', '', '17', 'Inspection', 'NOS', '1', '', '2000', '1', '2000.00', '0', 'amount_wise', '', '2000.00', '9', '180.00', '9', '180.00', '18', '360.00', '2360.00', '2360.00', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1', '2360.00', 'CK/P/25-26/.-026120226', 'CK/P/25-26/.-026-2026', 1, '2360.00', 1, 1),
(7, '2026-02-18', '2025-05-09', '2025-05-09', 'purchase Order', 'CK/P/25-26/005', 11, 'Sri Ayyappa Engineering Works', '4/348C,Kallipalayam Road, Chikarampalayam, Karamadai, Coimbatore, Tamil Nadu', 'SA010/25-26', 'CK/PUR/25-26/-008', '', '62', '', 0, 'intrastate', 'intrastate', 'sgst', 'cgst', '', '84803000', 'CA02', '', '', '4\" 1500 Body', 'NOS', '1', '1', '8000', '1', '8000.00', '0', 'amount_wise', '0.00', '8000.00', '9', '720.00', '9', '720.00', '18', '1440.00', '9440.00', '9440.00', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1', '9440.00', 'CK/P/25-26/005180226', 'CK/P/25-26/005-2026', 1, '9440.00', 1, 1),
(8, '2026-02-18', '2025-05-29', '2025-05-29', 'purchase Order', 'CK/P/25-26/006', 11, 'Sri Ayyappa Engineering Works', '4/348C,Kallipalayam Road, Chikarampalayam, Karamadai, Coimbatore, Tamil Nadu', 'SA012/25-26', 'CK/PUR/25-26/-010||CK/PUR/25-26/-010', '||', '58||57', '', 0, 'intrastate', 'intrastate', 'sgst', 'cgst', '', '84803000||84803000', 'OMI 02||OMI 01', '||', '||', 'Retainer 3.0 Pattern||Retainer 2.0  Pattern', 'NOS||NOS', '1||1', '1||1', '32000||40000', '1||1', '32000.00||40000.00', '0||0', 'amount_wise', '0.00||0.00', '32000.00||40000.00', '9||9', '2880.00||3600.00', '9||9', '2880.00||3600.00', '18||18', '5760.00||7200.00', '37760.00||47200.00', '84960.00', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1||1', '84960.00', 'CK/P/25-26/006180226', 'CK/P/25-26/006-2026', 1, '84960.00', 1, 1),
(9, '2026-02-18', '2025-06-01', '2025-06-01', 'Direct Purchase', 'CK/P/25-26/007', 12, 'PKS Inspection Service', '83A Pudukadu 2nd Street,Sivanathapuram, Vellakovil-638111,Kangeyam Taluk, Tiruppur, Tamil Nadu', 'PKS/11/25-26', '', '', '', '', 0, 'intrastate', 'intrastate', 'sgst', 'cgst', '', '998898', '001', '', '17', 'Inspection', 'NOS', '1', '7', '2000', '1', '2000.00', '0', 'amount_wise', '0', '2000.00', '9', '180.00', '9', '180.00', '18', '360.00', '2360.00', '2360.00', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1', '2360.00', 'CK/P/25-26/007180226', 'CK/P/25-26/007-2026', 1, '2360.00', 1, 1),
(16, '2026-02-25', '2025-06-07', '2025-06-07', 'purchase Order', 'CK/P/25-26/008', 14, 'Shree Kumaran Alloys', 'S/F No - 461, Telungupalayam Road,, Ellapalayam Post,Annur, Coimbatore, Tamil Nadu', 'D0138/25-26', 'CK/PUR/25-26/-009||CK/PUR/25-26/-009', 'CAD2025363 REV01||CAD2025363 REV01', '56||56', '', 0, 'intrastate', 'intrastate', 'sgst', 'cgst', '', '73259999||73259999', 'CA02||CA02', '33801||33817', '||', '4\"1500 Body||4\"1500 Body', 'NOS||NOS', '208.3||208.3', '1||1', '175||175', '3||2', '109357.50||72905.00', '0||0', 'amount_wise', '0.00||0.00', '109357.50||72905.00', '9||9', '9842.18||6561.45', '9||9', '9842.18||6561.45', '18||18', '19684.35||13122.90', '129041.85||86027.90', '215069.75', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0.25', '1||1', '215070.00', 'CK/P/25-26/008250226', 'CK/P/25-26/008-2026', 1, '215070.00', 1, 1),
(19, '2026-02-25', '2025-06-09', '2025-06-09', 'Direct Purchase', 'CK/P/25-26/009', 14, 'Shree Kumaran Alloys', 'S/F No - 461, Telungupalayam Road,, Ellapalayam Post,Annur, Coimbatore, Tamil Nadu', 'D0139/25-26', '', '', '', '', 0, 'intrastate', 'intrastate', 'sgst', 'cgst', '', '73259999', 'TB1', '33801', '23', 'TEST BAR(300mmX50mmX50mm)', 'NOS', '6', '2', '175', '2', '2100.00', '0', 'amount_wise', '0', '2100.00', '9', '189.00', '9', '189.00', '18', '378.00', '2478.00', '2478.00', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1', '2478.00', 'CK/P/25-26/009250226', 'CK/P/25-26/009-2026', 1, '2478.00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details_backup`
--

CREATE TABLE `purchase_details_backup` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `purchasedate` date DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `purchaseno` varchar(225) DEFAULT NULL,
  `supplierId` int(11) NOT NULL,
  `suppliername` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `invoiceno` varchar(225) DEFAULT NULL,
  `billtype` varchar(225) DEFAULT NULL,
  `gsttype` varchar(225) DEFAULT NULL,
  `typesgst` longtext,
  `typecgst` longtext,
  `typeigst` longtext,
  `hsnno` longtext,
  `itemcode` varchar(255) DEFAULT NULL,
  `itemname` longtext,
  `uom` longtext,
  `rate` longtext,
  `qty` longtext,
  `amount` longtext,
  `discount` longtext,
  `discountBy` varchar(255) NOT NULL,
  `discountamount` longtext,
  `taxableamount` longtext,
  `sgst` longtext,
  `sgstamount` longtext,
  `cgst` longtext,
  `cgstamount` longtext,
  `igst` longtext,
  `igstamount` longtext,
  `total` longtext,
  `subtotal` varchar(225) DEFAULT NULL,
  `freightamount` varchar(225) DEFAULT NULL,
  `freightcgst` varchar(225) DEFAULT NULL,
  `freightcgstamount` varchar(225) DEFAULT NULL,
  `freightsgst` varchar(225) DEFAULT NULL,
  `freightsgstamount` varchar(225) DEFAULT NULL,
  `freightigst` varchar(225) DEFAULT NULL,
  `freightigstamount` varchar(225) DEFAULT NULL,
  `freighttotal` varchar(225) DEFAULT NULL,
  `loadingamount` varchar(225) DEFAULT NULL,
  `loadingcgst` varchar(225) DEFAULT NULL,
  `loadingcgstamount` varchar(225) DEFAULT NULL,
  `loadingsgst` varchar(225) DEFAULT NULL,
  `loadingsgstamount` varchar(225) DEFAULT NULL,
  `loadingigst` varchar(225) DEFAULT NULL,
  `loadingigstamount` varchar(225) DEFAULT NULL,
  `loadingtotal` varchar(225) DEFAULT NULL,
  `othercharges` varchar(225) DEFAULT NULL,
  `roundOff` varchar(255) NOT NULL,
  `return_status` longtext,
  `grandtotal` varchar(225) DEFAULT NULL,
  `purchasenodate` varchar(225) DEFAULT NULL,
  `purchasenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `vou_status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_reports`
--

CREATE TABLE `purchase_reports` (
  `id` int(11) NOT NULL,
  `purchaseid` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `purchaseno` varchar(255) DEFAULT NULL,
  `purchasedate` varchar(255) DEFAULT NULL,
  `paymenttype` varchar(255) DEFAULT NULL,
  `supplierId` int(11) NOT NULL,
  `suppliername` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `invoiceno` varchar(255) DEFAULT NULL,
  `purchaseorderno` varchar(100) NOT NULL,
  `purchaseorder` varchar(100) NOT NULL,
  `poRecordId` varchar(50) NOT NULL,
  `joborder_No` varchar(100) NOT NULL,
  `JO_RecordId` int(11) NOT NULL,
  `invoicedate` date DEFAULT NULL,
  `batchno` varchar(255) DEFAULT NULL,
  `itemcode` varchar(255) DEFAULT NULL,
  `heatno` varchar(255) DEFAULT NULL,
  `weight` varchar(255) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `itemid` varchar(255) DEFAULT NULL,
  `hsnno` varchar(255) DEFAULT NULL,
  `itemname` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `disamount` varchar(255) DEFAULT NULL,
  `taxname` varchar(255) DEFAULT NULL,
  `taxamount` varchar(255) DEFAULT NULL,
  `adjustment` varchar(255) DEFAULT NULL,
  `grandtotal` varchar(255) DEFAULT NULL,
  `taxtotal` varchar(255) DEFAULT NULL,
  `adjus` varchar(255) DEFAULT NULL,
  `vatadjus` varchar(255) DEFAULT NULL,
  `paid` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `bedadjs` varchar(200) DEFAULT NULL,
  `edcadjus` varchar(255) DEFAULT NULL,
  `sedadjus` varchar(255) DEFAULT NULL,
  `cstadjus` varchar(255) DEFAULT NULL,
  `taxpercentage` varchar(255) DEFAULT NULL,
  `purchasenoyear` varchar(255) DEFAULT NULL,
  `purchasenodate` varchar(255) DEFAULT NULL,
  `create_mtc_status` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_reports`
--

INSERT INTO `purchase_reports` (`id`, `purchaseid`, `date`, `purchaseno`, `purchasedate`, `paymenttype`, `supplierId`, `suppliername`, `address`, `invoiceno`, `purchaseorderno`, `purchaseorder`, `poRecordId`, `joborder_No`, `JO_RecordId`, `invoicedate`, `batchno`, `itemcode`, `heatno`, `weight`, `grade`, `itemid`, `hsnno`, `itemname`, `rate`, `qty`, `total`, `subtotal`, `discount`, `disamount`, `taxname`, `taxamount`, `adjustment`, `grandtotal`, `taxtotal`, `adjus`, `vatadjus`, `paid`, `balance`, `status`, `bedadjs`, `edcadjus`, `sedadjus`, `cstadjus`, `taxpercentage`, `purchasenoyear`, `purchasenodate`, `create_mtc_status`) VALUES
(3, '3', '2026-02-11', 'CK/P/25-26/001', '2025-03-20', NULL, 8, 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0290/24-25', 'CK/PUR/25-26/-002', '-', '10', '', 0, '2025-03-20', NULL, 'CA16', 'P0213', '3.45', '1', '3', '73259930', '1/2\" CL 600 Body', '600', '20', '48852.00', '48852.00', NULL, NULL, NULL, NULL, NULL, '48852.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/.-001-2026', 'CK/P/25-26/.-001110226', 2),
(4, '4', '2026-02-12', 'CK/P/25-26/002', '2025-04-09', NULL, 11, 'Sri Ayyappa Engineering Works', '4/348C,Kallipalayam Road, Chikarampalayam, Karamadai, Coimbatore, Tamil Nadu', 'SA003/25-26', 'CK/PUR/25-26/-001', '', '15', '', 0, '2025-04-09', NULL, 'SP01', '', '1', '1', '', '84803000', 'Coal Nozzle ', '145000', '1', '171100.00', '171100.00', NULL, NULL, NULL, NULL, NULL, '171100.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/.-026-2026', 'CK/P/25-26/.-026120226', 1),
(59, '8', '2026-02-18', 'CK/P/25-26/006', '2025-05-29', NULL, 11, 'Sri Ayyappa Engineering Works', '4/348C,Kallipalayam Road, Chikarampalayam, Karamadai, Coimbatore, Tamil Nadu', 'SA012/25-26', 'CK/PUR/25-26/-010', '', '57', '', 0, '2025-05-29', NULL, 'OMI 01', '', '1', '1', '', '84803000', 'Retainer 2.0  Pattern', '40000', '1', '47200.00', '84960.00', NULL, NULL, NULL, NULL, NULL, '84960.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/006-2026', 'CK/P/25-26/006180226', 1),
(58, '8', '2026-02-18', 'CK/P/25-26/006', '2025-05-29', NULL, 11, 'Sri Ayyappa Engineering Works', '4/348C,Kallipalayam Road, Chikarampalayam, Karamadai, Coimbatore, Tamil Nadu', 'SA012/25-26', 'CK/PUR/25-26/-010', '', '58', '', 0, '2025-05-29', NULL, 'OMI 02', '', '1', '1', '', '84803000', 'Retainer 3.0 Pattern', '32000', '1', '37760.00', '84960.00', NULL, NULL, NULL, NULL, NULL, '84960.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/006-2026', 'CK/P/25-26/006180226', 1),
(55, '5', '2026-02-18', 'CK/P/25-26/003', '2025-05-05', NULL, 8, 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0026/25-26', '', '', '', '', 0, '2025-05-05', NULL, 'SBM08', 'P0412', '34.1', '1', '|', '73259999', 'EH Outer Box', '|', '2', '0', '263517.60', NULL, NULL, NULL, NULL, NULL, '263518.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/.-026-2026', 'CK/P/25-26/.-026180226', NULL),
(54, '5', '2026-02-18', 'CK/P/25-26/003', '2025-05-05', NULL, 8, 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0026/25-26', '', '', '', '', 0, '2025-05-05', NULL, 'SBM08', 'P0424', '34.1', '1', '|', '73259999', 'EH Outer Box', '|', '2', '0', '263517.60', NULL, NULL, NULL, NULL, NULL, '263518.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/.-026-2026', 'CK/P/25-26/.-026180226', NULL),
(53, '5', '2026-02-18', 'CK/P/25-26/003', '2025-05-05', NULL, 8, 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0026/25-26', '', '', '', '', 0, '2025-05-05', NULL, 'SBM08', 'P0425', '34.1', '1', '|', '73259999', 'EH Outer Box', '0', '2', '.', '263517.60', NULL, NULL, NULL, NULL, NULL, '263518.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/.-026-2026', 'CK/P/25-26/.-026180226', NULL),
(52, '5', '2026-02-18', 'CK/P/25-26/003', '2025-05-05', NULL, 8, 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0026/25-26', '', '', '', '', 0, '2025-05-05', NULL, 'SBM08', 'P0426', '34.1', '1', '|', '73259999', 'EH Outer Box', '0', '2', '0', '263517.60', NULL, NULL, NULL, NULL, NULL, '263518.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/.-026-2026', 'CK/P/25-26/.-026180226', NULL),
(51, '5', '2026-02-18', 'CK/P/25-26/003', '2025-05-05', NULL, 8, 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0026/25-26', '', '', '', '', 0, '2025-05-05', NULL, 'SBM08', 'P0443', '34.1', '1', '|', '73259999', 'EH Outer Box', '2', '2', '3', '263517.60', NULL, NULL, NULL, NULL, NULL, '263518.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/.-026-2026', 'CK/P/25-26/.-026180226', NULL),
(50, '5', '2026-02-18', 'CK/P/25-26/003', '2025-05-05', NULL, 8, 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0026/25-26', '', '', '', '', 0, '2025-05-05', NULL, 'CA16', 'P0464', '34.1', '1', '|', '73259999', 'EH Outer Box', '|', '2', '1', '263517.60', NULL, NULL, NULL, NULL, NULL, '263518.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/.-026-2026', 'CK/P/25-26/.-026180226', NULL),
(49, '5', '2026-02-18', 'CK/P/25-26/003', '2025-05-05', NULL, 8, 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0026/25-26', '', '', '', '', 0, '2025-05-05', NULL, 'CA16', 'P0470', '34.1', '1', '|', '73259999', 'EH Outer Box', '|', '2', '4', '263517.60', NULL, NULL, NULL, NULL, NULL, '263518.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/.-026-2026', 'CK/P/25-26/.-026180226', NULL),
(48, '5', '2026-02-18', 'CK/P/25-26/003', '2025-05-05', NULL, 8, 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0026/25-26', '', '', '', '', 0, '2025-05-05', NULL, 'CA16', 'P0471', '34.1', '1', '|', '73259999', 'EH Outer Box', '0', '2', '|', '263517.60', NULL, NULL, NULL, NULL, NULL, '263518.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/.-026-2026', 'CK/P/25-26/.-026180226', NULL),
(47, '5', '2026-02-18', 'CK/P/25-26/003', '2025-05-05', NULL, 8, 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0026/25-26', '', '', '', '', 0, '2025-05-05', NULL, 'CA16', 'P0472', '34.1', '1', '|', '73259999', 'EH Outer Box', '0', '2', '|', '263517.60', NULL, NULL, NULL, NULL, NULL, '263518.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/.-026-2026', 'CK/P/25-26/.-026180226', NULL),
(46, '5', '2026-02-18', 'CK/P/25-26/003', '2025-05-05', NULL, 8, 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0026/25-26', '', '', '', '', 0, '2025-05-05', NULL, 'CA16', 'P0473', '34.1', '1', '|', '73259999', 'EH Outer Box', '2', '2', '0', '263517.60', NULL, NULL, NULL, NULL, NULL, '263518.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/.-026-2026', 'CK/P/25-26/.-026180226', NULL),
(45, '5', '2026-02-18', 'CK/P/25-26/003', '2025-05-05', NULL, 8, 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0026/25-26', '', '', '', '', 0, '2025-05-05', NULL, 'CA16', 'P0474', '34.1', '1', '|', '73259999', 'EH Outer Box', '|', '2', '0', '263517.60', NULL, NULL, NULL, NULL, NULL, '263518.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/.-026-2026', 'CK/P/25-26/.-026180226', NULL),
(43, '5', '2026-02-18', 'CK/P/25-26/003', '2025-05-05', NULL, 8, 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0026/25-26', '', '', '', '', 0, '2025-05-05', NULL, 'CA16', 'P0475', '34.1', '1', '|', '73259999', 'EH Outer Box', '0', '2', '0', '263517.60', NULL, NULL, NULL, NULL, NULL, '263518.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/.-026-2026', 'CK/P/25-26/.-026180226', NULL),
(42, '5', '2026-02-18', 'CK/P/25-26/003', '2025-05-05', NULL, 8, 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0026/25-26', '', '', '', '', 0, '2025-05-05', NULL, 'CA16', 'P0476', '34.1', '1', '|', '73259999', 'EH Outer Box', '0', '2', '3', '263517.60', NULL, NULL, NULL, NULL, NULL, '263518.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/.-026-2026', 'CK/P/25-26/.-026180226', NULL),
(41, '5', '2026-02-18', 'CK/P/25-26/003', '2025-05-05', NULL, 8, 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0026/25-26', '', '', '', '', 0, '2025-05-05', NULL, 'CA16', 'P0477', '34.1', '1', '|', '73259999', 'EH Outer Box', '2', '2', '1', '263517.60', NULL, NULL, NULL, NULL, NULL, '263518.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/.-026-2026', 'CK/P/25-26/.-026180226', NULL),
(40, '5', '2026-02-18', 'CK/P/25-26/003', '2025-05-05', NULL, 8, 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0026/25-26', '', '', '', '', 0, '2025-05-05', NULL, 'CA16', 'P0478', '34.1', '1', '|', '73259999', 'EH Outer Box', '|', '2', '4', '263517.60', NULL, NULL, NULL, NULL, NULL, '263518.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/.-026-2026', 'CK/P/25-26/.-026180226', NULL),
(39, '5', '2026-02-18', 'CK/P/25-26/003', '2025-05-05', NULL, 8, 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0026/25-26', '', '', '', '', 0, '2025-05-05', NULL, 'CA16', 'P0479', '34.1', '1', '|', '73259999', 'EH Outer Box', '|', '2', '|', '263517.60', NULL, NULL, NULL, NULL, NULL, '263518.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/.-026-2026', 'CK/P/25-26/.-026180226', NULL),
(38, '5', '2026-02-18', 'CK/P/25-26/003', '2025-05-05', NULL, 8, 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0026/25-26', '', '', '', '', 0, '2025-05-05', NULL, 'CA16', 'P0481', '34.1', '1', '|', '73259999', 'EH Outer Box', '0', '2', '|', '263517.60', NULL, NULL, NULL, NULL, NULL, '263518.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/.-026-2026', 'CK/P/25-26/.-026180226', NULL),
(37, '5', '2026-02-18', 'CK/P/25-26/003', '2025-05-05', NULL, 8, 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0026/25-26', '', '', '', '', 0, '2025-05-05', NULL, 'CA16', 'P0482', '34.1', '1', '|', '73259999', 'EH Outer Box', '0', '2', '0', '263517.60', NULL, NULL, NULL, NULL, NULL, '263518.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/.-026-2026', 'CK/P/25-26/.-026180226', NULL),
(36, '5', '2026-02-18', 'CK/P/25-26/003', '2025-05-05', NULL, 8, 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0026/25-26', '', '', '', '', 0, '2025-05-05', NULL, 'CA16', 'P0483', '34.1', '1', '|', '73259999', 'EH Outer Box', '2', '2', '0', '263517.60', NULL, NULL, NULL, NULL, NULL, '263518.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/.-026-2026', 'CK/P/25-26/.-026180226', NULL),
(35, '5', '2026-02-18', 'CK/P/25-26/003', '2025-05-05', NULL, 8, 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0026/25-26', '', '', '', '', 0, '2025-05-05', NULL, 'CA16', 'P0484', '3.5', '2', '|', '73259999', '1/2\" CL 600 Body', '|', '1', '.', '263517.60', NULL, NULL, NULL, NULL, NULL, '263518.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/.-026-2026', 'CK/P/25-26/.-026180226', NULL),
(34, '5', '2026-02-18', 'CK/P/25-26/003', '2025-05-05', NULL, 8, 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0026/25-26', '', '', '', '', 0, '2025-05-05', NULL, 'CA16', 'P0485', '3.5', '2', '|', '73259999', '1/2\" CL 600 Body', '|', '2', '4', '263517.60', NULL, NULL, NULL, NULL, NULL, '263518.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/.-026-2026', 'CK/P/25-26/.-026180226', NULL),
(57, '7', '2026-02-18', 'CK/P/25-26/005', '2025-05-09', NULL, 11, 'Sri Ayyappa Engineering Works', '4/348C,Kallipalayam Road, Chikarampalayam, Karamadai, Coimbatore, Tamil Nadu', 'SA010/25-26', 'CK/PUR/25-26/-008', '', '62', '', 0, '2025-05-09', NULL, 'CA02', '', '1', '1', '', '84803000', '4\" 1500 Body', '8000', '1', '9440.00', '9440.00', NULL, NULL, NULL, NULL, NULL, '9440.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/005-2026', 'CK/P/25-26/005180226', 1),
(33, '5', '2026-02-18', 'CK/P/25-26/003', '2025-05-05', NULL, 8, 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0026/25-26', '', '', '', '', 0, '2025-05-05', NULL, 'CA16', 'P0495', '3.5', '2', '3', '73259999', '1/2\" CL 600 Body', '0', '5', '0', '263517.60', NULL, NULL, NULL, NULL, NULL, '263518.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/.-026-2026', 'CK/P/25-26/.-026180226', NULL),
(32, '5', '2026-02-18', 'CK/P/25-26/003', '2025-05-05', NULL, 8, 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0026/25-26', '', '', '', '', 0, '2025-05-05', NULL, 'CA16', 'P0496', '3.5', '2', '3', '73259999', '1/2\" CL 600 Body', '0', '5', '3', '263517.60', NULL, NULL, NULL, NULL, NULL, '263518.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/.-026-2026', 'CK/P/25-26/.-026180226', NULL),
(56, '6', '2026-02-18', 'CK/P/25-26/004', '2025-05-05', NULL, 12, 'PKS Inspection Service', '83A Pudukadu 2nd Street,Sivanathapuram, Vellakovil-638111,Kangeyam Taluk, Tiruppur, Tamil Nadu', 'PKS/09/25-26', '', '', '', '', 0, '2025-05-05', NULL, '001', NULL, '1', '', '7', '', 'Inspection', '2', '1', '2', '2360.00', NULL, NULL, NULL, NULL, NULL, '2360.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/.-026-2026', 'CK/P/25-26/.-026180226', NULL),
(44, '5', '2026-02-18', 'CK/P/25-26/003', '2025-05-05', NULL, 8, 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0026/25-26', '', '', '', '', 0, '2025-05-05', NULL, 'CA16', 'P0497', '34.1', '1', '|', '73259999', 'EH Outer Box', '|', '2', '.', '263517.60', NULL, NULL, NULL, NULL, NULL, '263518.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/.-026-2026', 'CK/P/25-26/.-026180226', NULL),
(31, '5', '2026-02-18', 'CK/P/25-26/003', '2025-05-05', NULL, 8, 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0026/25-26', '', 'CAD2025405 REV 01', '', '', 0, '2025-05-05', NULL, 'CA16', 'P0498', '3.5', '2', '3', '73259999', '1/2\" CL 600 Body', '2', '4', '3', '263517.60', NULL, NULL, NULL, NULL, NULL, '263518.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/.-026-2026', 'CK/P/25-26/.-026180226', NULL),
(60, '9', '2026-02-18', 'CK/P/25-26/007', '2025-06-01', NULL, 12, 'PKS Inspection Service', '83A Pudukadu 2nd Street,Sivanathapuram, Vellakovil-638111,Kangeyam Taluk, Tiruppur, Tamil Nadu', 'PKS/11/25-26', '', '', '', '', 0, '2025-06-01', NULL, '001', '', '1', '7', '17', '998898', 'Inspection', '2000', '1', '2360.00', '2360.00', NULL, NULL, NULL, NULL, NULL, '2360.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/007-2026', 'CK/P/25-26/007180226', 1),
(108, '16', '2026-02-25', 'CK/P/25-26/008', '2025-06-07', NULL, 14, 'Shree Kumaran Alloys', 'S/F No - 461, Telungupalayam Road,, Ellapalayam Post,Annur, Coimbatore, Tamil Nadu', 'D0138/25-26', 'CK/PUR/25-26/-009', 'CAD2025363 REV01', '56', '', 0, '2025-06-07', NULL, 'CA02', '33801', '208.3', '1', '18', '73259999', '4\" 1500 Body', '175', '3', '129041.85', '215069.75', NULL, NULL, NULL, NULL, NULL, '215070.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/008-2026', 'CK/P/25-26/008250226', 1),
(109, '16', '2026-02-25', 'CK/P/25-26/008', '2025-06-07', NULL, 14, 'Shree Kumaran Alloys', 'S/F No - 461, Telungupalayam Road,, Ellapalayam Post,Annur, Coimbatore, Tamil Nadu', 'D0138/25-26', 'CK/PUR/25-26/-009', 'CAD2025363 REV01', '56', '', 0, '2025-06-07', NULL, 'CA02', '33817', '208.3', '1', '18', '73259999', '4\" 1500 Body', '175', '2', '86027.90', '215069.75', NULL, NULL, NULL, NULL, NULL, '215070.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/008-2026', 'CK/P/25-26/008250226', 1),
(112, '19', '2026-02-25', 'CK/P/25-26/009', '2025-06-09', NULL, 14, 'Shree Kumaran Alloys', 'S/F No - 461, Telungupalayam Road,, Ellapalayam Post,Annur, Coimbatore, Tamil Nadu', 'D0139/25-26', '', '', '', '', 0, '2025-06-09', NULL, 'TB1', '33801', '6', '2', '23', '73259999', 'TEST BAR(300mmX50mmX50mm)', '175', '2', '2478.00', '2478.00', NULL, NULL, NULL, NULL, NULL, '2478.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/P/25-26/009-2026', 'CK/P/25-26/009250226', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quotation_details`
--

CREATE TABLE `quotation_details` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `quotationdate` date DEFAULT NULL,
  `gstinno` varchar(255) DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `quotationno` varchar(225) DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `invoiceno` varchar(225) DEFAULT NULL,
  `billtype` varchar(225) DEFAULT NULL,
  `gsttype` varchar(225) DEFAULT NULL,
  `typesgst` longtext,
  `typecgst` longtext,
  `typeigst` longtext,
  `hsnno` longtext,
  `itemname` longtext,
  `description` longtext,
  `uom` longtext,
  `rate` longtext,
  `qty` longtext,
  `amount` longtext,
  `discount` longtext,
  `discountamount` longtext,
  `taxableamount` longtext,
  `sgst` longtext,
  `sgstamount` longtext,
  `cgst` longtext,
  `cgstamount` longtext,
  `igst` longtext,
  `igstamount` longtext,
  `total` longtext,
  `subtotal` varchar(225) DEFAULT NULL,
  `freightcharges` varchar(225) DEFAULT NULL,
  `packingcharges` varchar(225) DEFAULT NULL,
  `othercharges` varchar(225) DEFAULT NULL,
  `return_status` longtext,
  `grandtotal` varchar(225) DEFAULT NULL,
  `purchasenodate` varchar(225) DEFAULT NULL,
  `purchasenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_details_backup`
--

CREATE TABLE `quotation_details_backup` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `quotationdate` date DEFAULT NULL,
  `gstinno` varchar(255) DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `quotationno` varchar(225) DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `invoiceno` varchar(225) DEFAULT NULL,
  `billtype` varchar(225) DEFAULT NULL,
  `gsttype` varchar(225) DEFAULT NULL,
  `typesgst` longtext,
  `typecgst` longtext,
  `typeigst` longtext,
  `hsnno` longtext,
  `itemname` longtext,
  `description` longtext,
  `uom` longtext,
  `rate` longtext,
  `qty` longtext,
  `amount` longtext,
  `discount` longtext,
  `discountamount` longtext,
  `taxableamount` longtext,
  `sgst` longtext,
  `sgstamount` longtext,
  `cgst` longtext,
  `cgstamount` longtext,
  `igst` longtext,
  `igstamount` longtext,
  `total` longtext,
  `subtotal` varchar(225) DEFAULT NULL,
  `freightcharges` varchar(225) DEFAULT NULL,
  `packingcharges` varchar(225) DEFAULT NULL,
  `othercharges` varchar(225) DEFAULT NULL,
  `return_status` longtext,
  `grandtotal` varchar(225) DEFAULT NULL,
  `purchasenodate` varchar(225) DEFAULT NULL,
  `purchasenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_return`
--

CREATE TABLE `sales_return` (
  `id` int(255) NOT NULL,
  `date` varchar(255) DEFAULT NULL,
  `returndate` varchar(255) DEFAULT NULL,
  `types` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `dateofissue` date DEFAULT NULL,
  `customername` varchar(255) DEFAULT NULL,
  `customerid` varchar(255) DEFAULT NULL,
  `supplierid` varchar(255) DEFAULT NULL,
  `gsttype` varchar(255) DEFAULT NULL,
  `suppliername` varchar(255) DEFAULT NULL,
  `openingbal` varchar(255) DEFAULT NULL,
  `outstandingamount` int(255) DEFAULT NULL,
  `returnno` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `invoiceno` varchar(255) DEFAULT NULL,
  `purchaseno` varchar(255) DEFAULT NULL,
  `itemno` varchar(255) DEFAULT NULL,
  `hsnno` longtext,
  `itemname` longtext,
  `rate` longtext,
  `qty` longtext,
  `uom` longtext,
  `amount` longtext,
  `discount` longtext,
  `taxableamount` longtext,
  `discountamount` longtext,
  `cgst` longtext,
  `cgstamount` longtext,
  `sgst` longtext,
  `sgstamount` longtext,
  `igst` longtext,
  `igstamount` longtext,
  `total` longtext,
  `subtotal` varchar(255) DEFAULT NULL,
  `freightamount` varchar(255) NOT NULL,
  `freightcgst` varchar(255) NOT NULL,
  `freightcgstamount` varchar(255) NOT NULL,
  `freightsgst` varchar(255) NOT NULL,
  `freightsgstamount` varchar(255) NOT NULL,
  `freightigst` varchar(255) NOT NULL,
  `freightigstamount` varchar(255) NOT NULL,
  `freighttotal` varchar(255) NOT NULL,
  `loadingamount` varchar(255) NOT NULL,
  `loadingcgst` varchar(255) NOT NULL,
  `loadingcgstamount` varchar(255) NOT NULL,
  `loadingsgst` varchar(255) NOT NULL,
  `loadingsgstamount` varchar(255) NOT NULL,
  `loadingigst` varchar(255) NOT NULL,
  `loadingigstamount` varchar(255) NOT NULL,
  `loadingtotal` varchar(255) NOT NULL,
  `othercharges` varchar(255) DEFAULT NULL,
  `grandtotal` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_return_backup`
--

CREATE TABLE `sales_return_backup` (
  `id` int(255) NOT NULL,
  `date` varchar(255) DEFAULT NULL,
  `returndate` varchar(255) DEFAULT NULL,
  `types` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `dateofissue` date DEFAULT NULL,
  `customername` varchar(255) DEFAULT NULL,
  `customerid` varchar(255) DEFAULT NULL,
  `supplierid` varchar(255) DEFAULT NULL,
  `gsttype` varchar(255) DEFAULT NULL,
  `suppliername` varchar(255) DEFAULT NULL,
  `openingbal` varchar(255) DEFAULT NULL,
  `outstandingamount` int(255) DEFAULT NULL,
  `returnno` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `invoiceno` varchar(255) DEFAULT NULL,
  `purchaseno` varchar(255) DEFAULT NULL,
  `itemno` varchar(255) DEFAULT NULL,
  `hsnno` longtext,
  `itemname` longtext,
  `rate` longtext,
  `qty` longtext,
  `uom` longtext,
  `amount` longtext,
  `discount` longtext,
  `taxableamount` longtext,
  `discountamount` longtext,
  `cgst` longtext,
  `cgstamount` longtext,
  `sgst` longtext,
  `sgstamount` longtext,
  `igst` longtext,
  `igstamount` longtext,
  `total` longtext,
  `subtotal` varchar(255) DEFAULT NULL,
  `freightamount` varchar(255) NOT NULL,
  `freightcgst` varchar(255) NOT NULL,
  `freightcgstamount` varchar(255) NOT NULL,
  `freightsgst` varchar(255) NOT NULL,
  `freightsgstamount` varchar(255) NOT NULL,
  `freightigst` varchar(255) NOT NULL,
  `freightigstamount` varchar(255) NOT NULL,
  `freighttotal` varchar(255) NOT NULL,
  `loadingamount` varchar(255) NOT NULL,
  `loadingcgst` varchar(255) NOT NULL,
  `loadingcgstamount` varchar(255) NOT NULL,
  `loadingsgst` varchar(255) NOT NULL,
  `loadingsgstamount` varchar(255) NOT NULL,
  `loadingigst` varchar(255) NOT NULL,
  `loadingigstamount` varchar(255) NOT NULL,
  `loadingtotal` varchar(255) NOT NULL,
  `othercharges` varchar(255) DEFAULT NULL,
  `grandtotal` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `statecode`
--

CREATE TABLE `statecode` (
  `id` int(11) NOT NULL,
  `state` varchar(255) NOT NULL,
  `stateCode` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statecode`
--

INSERT INTO `statecode` (`id`, `state`, `stateCode`, `status`) VALUES
(1, 'Jammu & Kashmir', '01', 1),
(2, 'Himachal Pradesh', '02', 1),
(3, 'Punjab', '03', 1),
(4, 'Chandigarh', '04', 1),
(5, 'Uttarakhand', '05', 1),
(6, 'Haryana', '06', 1),
(7, 'Delhi', '07', 1),
(8, 'Rajasthan', '08', 1),
(9, 'Uttar Pradesh', '09', 1),
(10, 'Bihar', '10', 1),
(11, 'Sikkim', '11', 1),
(12, 'Arunachal Pradesh', '12', 1),
(13, 'Nagaland', '13', 1),
(14, 'Manipur', '14', 1),
(15, 'Mizoram', '15', 1),
(16, 'Tripura', '16', 1),
(17, 'Meghalaya', '17', 1),
(18, 'Assam', '18', 1),
(19, 'West Bengal', '19', 1),
(20, 'Jharkhand', '20', 1),
(21, 'odisha', '21', 1),
(22, 'Chattisgarh', '22', 1),
(23, 'Madhya Pradesh', '23', 1),
(24, 'Daman & Diu', '25', 1),
(25, 'Gujarat', '24', 1),
(26, 'Dadra & Nagar Haveli', '26', 1),
(27, 'Maharashtra', '27', 1),
(28, 'Andhra Pradesh', '28', 1),
(29, 'Karnataka', '29', 1),
(30, 'Goa', '30', 1),
(31, 'Lakshadweep', '31', 1),
(32, 'Kerala', '32', 1),
(33, 'Tamil Nadu', '33', 1),
(34, 'Puducherry', '34', 1),
(35, 'Andaman & Nicobar Islands', '35', 1),
(36, 'Telengana', '36', 1),
(37, 'Andrapradesh(New)', '37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `hsnno` varchar(255) DEFAULT NULL,
  `heatno` varchar(255) DEFAULT NULL,
  `itemid` varchar(255) DEFAULT NULL,
  `itemcode` varchar(255) DEFAULT NULL,
  `sgst` varchar(255) DEFAULT NULL,
  `cgst` varchar(255) DEFAULT NULL,
  `igst` varchar(255) DEFAULT NULL,
  `itemname` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `updatestock` varchar(255) NOT NULL,
  `weight` varchar(100) DEFAULT NULL,
  `total` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `balance` varchar(255) NOT NULL,
  `oldqty` varchar(255) DEFAULT NULL,
  `currentstock` varchar(255) DEFAULT NULL,
  `stat` varchar(255) NOT NULL,
  `stockdate` date DEFAULT NULL,
  `priceType` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `date`, `hsnno`, `heatno`, `itemid`, `itemcode`, `sgst`, `cgst`, `igst`, `itemname`, `quantity`, `rate`, `updatestock`, `weight`, `total`, `status`, `balance`, `oldqty`, `currentstock`, `stat`, `stockdate`, `priceType`) VALUES
(1, '2026-02-13', '73259930', 'P0213', '3', 'CA16', '9', '9', '18', '1/2\" CL 600 Body', '20', '600', '20', NULL, '', '', '80', NULL, NULL, '', '2025-03-20', 'Exclusive'),
(2, '2026-02-13', '84803000', '', '', 'SP01', '9', '9', '18', 'Coal Nozzle ', '1', '145000', '1', NULL, '', '', '0', NULL, NULL, '', '2025-04-09', 'Exclusive'),
(3, '2026-02-18', '73259999', 'P0412', '3', 'CA16', '9', '9', '18', '1/2\" CL 600 Body', '4', '200', '4', NULL, '', '', '17', NULL, NULL, '', '2025-05-05', 'Exclusive'),
(4, '2026-02-18', '73259999', 'P0424', '3', 'CA16', '9', '9', '18', '1/2\" CL 600 Body', '5', '200', '5', NULL, '', '', '21', NULL, NULL, '', '2025-05-05', 'Exclusive'),
(5, '2026-02-18', '73259999', 'P0425', '3', 'CA16', '9', '9', '18', '1/2\" CL 600 Body', '5', '200', '5', NULL, '', '', '21', NULL, NULL, '', '2025-05-05', 'Exclusive'),
(6, '2026-02-18', '73259999', 'P0426', '3', 'CA16', '9', '9', '18', '1/2\" CL 600 Body', '2', '200', '2', NULL, '', '', '9', NULL, NULL, '', '2025-05-05', 'Exclusive'),
(7, '2026-02-18', '73259999', 'P0443', '3', 'CA16', '9', '9', '18', '1/2\" CL 600 Body', '1', '200', '1', NULL, '', '', '5', NULL, NULL, '', '2025-05-05', 'Exclusive'),
(8, '2026-02-13', '73259999', 'P0464', '', 'SBM08', '9', '9', '18', 'EH Outer Box', '2', '155', '2', NULL, '', '', '-70', NULL, NULL, '', '2025-05-05', 'Exclusive'),
(9, '2026-02-13', '73259999', 'P0470', '', 'SBM08', '9', '9', '18', 'EH Outer Box', '2', '155', '2', NULL, '', '', '-70', NULL, NULL, '', '2025-05-05', 'Exclusive'),
(10, '2026-02-13', '73259999', 'P0471', '', 'SBM08', '9', '9', '18', 'EH Outer Box', '2', '155', '2', NULL, '', '', '-70', NULL, NULL, '', '2025-05-05', 'Exclusive'),
(11, '2026-02-13', '73259999', 'P0472', '', 'SBM08', '9', '9', '18', 'EH Outer Box', '2', '155', '2', NULL, '', '', '-70', NULL, NULL, '', '2025-05-05', 'Exclusive'),
(12, '2026-02-13', '73259999', 'P0473', '', 'SBM08', '9', '9', '18', 'EH Outer Box', '2', '155', '2', NULL, '', '', '-70', NULL, NULL, '', '2025-05-05', 'Exclusive'),
(13, '2026-02-13', '73259999', 'P0474', '', 'SBM08', '9', '9', '18', 'EH Outer Box', '2', '155', '2', NULL, '', '', '-70', NULL, NULL, '', '2025-05-05', 'Exclusive'),
(14, '2026-02-13', '73259999', 'P0475', '', 'SBM08', '9', '9', '18', 'EH Outer Box', '2', '155', '2', NULL, '', '', '-70', NULL, NULL, '', '2025-05-05', 'Exclusive'),
(15, '2026-02-13', '73259999', 'P0476', '', 'SBM08', '9', '9', '18', 'EH Outer Box', '2', '155', '2', NULL, '', '', '-70', NULL, NULL, '', '2025-05-05', 'Exclusive'),
(16, '2026-02-13', '73259999', 'P0477', '', 'SBM08', '9', '9', '18', 'EH Outer Box', '2', '155', '2', NULL, '', '', '-70', NULL, NULL, '', '2025-05-05', 'Exclusive'),
(17, '2026-02-13', '73259999', 'P0478', '', 'SBM08', '9', '9', '18', 'EH Outer Box', '2', '155', '2', NULL, '', '', '-70', NULL, NULL, '', '2025-05-05', 'Exclusive'),
(18, '2026-02-13', '73259999', 'P0479', '', 'SBM08', '9', '9', '18', 'EH Outer Box', '2', '155', '2', NULL, '', '', '-70', NULL, NULL, '', '2025-05-05', 'Exclusive'),
(19, '2026-02-13', '73259999', 'P0481', '', 'SBM08', '9', '9', '18', 'EH Outer Box', '2', '155', '2', NULL, '', '', '-70', NULL, NULL, '', '2025-05-05', 'Exclusive'),
(20, '2026-02-13', '73259999', 'P0482', '', 'SBM08', '9', '9', '18', 'EH Outer Box', '2', '155', '2', NULL, '', '', '-70', NULL, NULL, '', '2025-05-05', 'Exclusive'),
(21, '2026-02-13', '73259999', 'P0483', '', 'SBM08', '9', '9', '18', 'EH Outer Box', '2', '155', '2', NULL, '', '', '-70', NULL, NULL, '', '2025-05-05', 'Exclusive'),
(22, '2026-02-13', '73259999', 'P0484', '', 'SBM08', '9', '9', '18', 'EH Outer Box', '2', '155', '2', NULL, '', '', '-70', NULL, NULL, '', '2025-05-05', 'Exclusive'),
(23, '2026-02-18', '73259999', 'P0485', '', 'SBM08', '9', '9', '18', 'EH Outer Box', '2', '155', '2', NULL, '', '', '-68', NULL, NULL, '', '2025-05-05', 'Exclusive'),
(24, '2026-02-18', '73259999', 'P0495', '', 'SBM08', '9', '9', '18', 'EH Outer Box', '2', '155', '2', NULL, '', '', '-68', NULL, NULL, '', '2025-05-05', 'Exclusive'),
(25, '2026-02-18', '73259999', 'P0496', '', 'SBM08', '9', '9', '18', 'EH Outer Box', '2', '155', '2', NULL, '', '', '-68', NULL, NULL, '', '2025-05-05', 'Exclusive'),
(26, '2026-02-18', '73259999', 'P0497', '', 'SBM08', '9', '9', '18', 'EH Outer Box', '2', '155', '2', NULL, '', '', '-68', NULL, NULL, '', '2025-05-05', 'Exclusive'),
(27, '2026-02-18', '73259999', 'P0498', '', 'SBM08', '9', '9', '18', 'EH Outer Box', '2', '155', '2', NULL, '', '', '-68', NULL, NULL, '', '2025-05-05', 'Exclusive'),
(28, '2026-02-12', '', '', '17', '001', '9', '9', '18', 'Inspection', '1', '2000', '1', NULL, '', '', '0', NULL, NULL, '', '2025-05-05', 'Exclusive'),
(29, '2026-02-18', '73259999', 'P0464', '|', 'CA16', '9', '9', '18', 'EH Outer Box', '2', '155', '2', '34.1', '', '', '2', NULL, NULL, '', '2025-05-05', ''),
(30, '2026-02-18', '73259999', 'P0470', '3', 'CA16', '9', '9', '18', 'EH Outer Box', '2', '155', '2', '34.1', '', '', '2', NULL, NULL, '', '2025-05-05', ''),
(31, '2026-02-18', '73259999', 'P0471', '|', 'CA16', '9', '9', '18', 'EH Outer Box', '2', '155', '2', '34.1', '', '', '2', NULL, NULL, '', '2025-05-05', ''),
(32, '2026-02-18', '73259999', 'P0472', '|', 'CA16', '9', '9', '18', 'EH Outer Box', '2', '155', '2', '34.1', '', '', '2', NULL, NULL, '', '2025-05-05', ''),
(33, '2026-02-18', '73259999', 'P0473', '3', 'CA16', '9', '9', '18', 'EH Outer Box', '2', '155', '2', '34.1', '', '', '2', NULL, NULL, '', '2025-05-05', ''),
(34, '2026-02-18', '73259999', 'P0474', '|', 'CA16', '9', '9', '18', 'EH Outer Box', '2', '155', '2', '34.1', '', '', '2', NULL, NULL, '', '2025-05-05', ''),
(35, '2026-02-18', '73259999', 'P0475', '|', 'CA16', '9', '9', '18', 'EH Outer Box', '2', '155', '2', '34.1', '', '', '2', NULL, NULL, '', '2025-05-05', ''),
(36, '2026-02-18', '73259999', 'P0476', '3', 'CA16', '9', '9', '18', 'EH Outer Box', '2', '155', '2', '34.1', '', '', '2', NULL, NULL, '', '2025-05-05', ''),
(37, '2026-02-18', '73259999', 'P0477', '|', 'CA16', '9', '9', '18', 'EH Outer Box', '2', '155', '2', '34.1', '', '', '2', NULL, NULL, '', '2025-05-05', ''),
(38, '2026-02-18', '73259999', 'P0478', '|', 'CA16', '9', '9', '18', 'EH Outer Box', '2', '155', '2', '34.1', '', '', '2', NULL, NULL, '', '2025-05-05', ''),
(39, '2026-02-18', '73259999', 'P0479', '|', 'CA16', '9', '9', '18', 'EH Outer Box', '2', '155', '2', '34.1', '', '', '2', NULL, NULL, '', '2025-05-05', ''),
(40, '2026-02-18', '73259999', 'P0481', '|', 'CA16', '9', '9', '18', 'EH Outer Box', '2', '155', '2', '34.1', '', '', '2', NULL, NULL, '', '2025-05-05', ''),
(41, '2026-02-18', '73259999', 'P0482', '|', 'CA16', '9', '9', '18', 'EH Outer Box', '2', '155', '2', '34.1', '', '', '2', NULL, NULL, '', '2025-05-05', ''),
(42, '2026-02-18', '73259999', 'P0483', '|', 'CA16', '9', '9', '18', 'EH Outer Box', '2', '155', '2', '34.1', '', '', '2', NULL, NULL, '', '2025-05-05', ''),
(43, '2026-02-18', '73259999', 'P0484', '|', 'CA16', '9', '9', '18', 'EH Outer Box', '2', '155', '2', '34.1', '', '', '2', NULL, NULL, '', '2025-05-05', ''),
(44, '2026-02-18', '', NULL, '1', '001', '9', '9', '18', 'Inspection', '1', '2000', '1', '1', '', '', '1', NULL, NULL, '', '2025-05-05', ''),
(45, '2026-02-18', '84803000', '', '', 'CA02', '9', '9', '18', '4\" 1500 Body', '1', '8000', '1', NULL, '', '', '1', NULL, NULL, '', '2025-05-09', 'Exclusive'),
(46, '2026-02-18', '84803000', '', '', 'OMI 02', '9', '9', '18', 'Retainer 3.0 Pattern', '1', '32000', '1', NULL, '', '', '1', NULL, NULL, '', '2025-05-29', 'Exclusive'),
(47, '2026-02-18', '84803000', '', '', 'OMI 01', '9', '9', '18', 'Retainer 2.0  Pattern', '1', '40000', '1', NULL, '', '', '1', NULL, NULL, '', '2025-05-29', 'Exclusive'),
(48, '2026-02-18', '998898', '', '17', '001', '9', '9', '18', 'Inspection', '1', '2000', '1', NULL, '', '', '1', NULL, NULL, '', '2025-06-01', 'Exclusive'),
(49, '2026-02-25', '73259999', '33801', '', 'CA02', '9', '9', '18', '4\" 1500 Body', '3', '175', '3', NULL, '', '', '15', NULL, NULL, '', '2025-06-07', 'Exclusive'),
(50, '2026-02-25', '73259999', '33817', '', 'CA02', '9', '9', '18', '4\" 1500 Body', '2', '175', '2', NULL, '', '', '15', NULL, NULL, '', '2025-06-07', 'Exclusive'),
(51, '2026-02-25', '73259999', '', '23', 'TB1', '9', '9', '18', 'TEST BAR(300mmX50mmX50mm)', '2', '175', '2', NULL, '', '', '0', NULL, NULL, '', '2025-06-09', 'Exclusive'),
(52, '2026-02-18', '73259999', 'P0546', '', 'SBM10', '9', '9', '18', '12FN Top Plate', '4', '155', '4', NULL, '', '', '-50', NULL, NULL, '', '2025-06-21', 'Exclusive'),
(53, '2026-02-18', '73259999', 'P0580', '', 'SBM10', '9', '9', '18', '12FN Top Plate', '4', '155', '4', NULL, '', '', '-50', NULL, NULL, '', '2025-06-21', 'Exclusive'),
(54, '2026-02-18', '73259999', 'P0582', '', 'SBM10', '9', '9', '18', '12FN Top Plate', '4', '155', '4', NULL, '', '', '-50', NULL, NULL, '', '2025-06-21', 'Exclusive'),
(55, '2026-02-18', '73259999', 'P0583', '', 'SBM10', '9', '9', '18', '12FN Top Plate', '4', '155', '4', NULL, '', '', '-50', NULL, NULL, '', '2025-06-21', 'Exclusive'),
(56, '2026-02-18', '73259999', 'P0584', '', 'SBM10', '9', '9', '18', '12FN Top Plate', '4', '155', '4', NULL, '', '', '-50', NULL, NULL, '', '2025-06-21', 'Exclusive'),
(57, '2026-02-18', '73259999', 'P0588', '', 'SBM10', '9', '9', '18', '12FN Top Plate', '4', '155', '4', NULL, '', '', '-50', NULL, NULL, '', '2025-06-21', 'Exclusive'),
(58, '2026-02-18', '73259999', 'P0589', '', 'SBM10', '9', '9', '18', '12FN Top Plate', '4', '155', '4', NULL, '', '', '-50', NULL, NULL, '', '2025-06-21', 'Exclusive'),
(59, '2026-02-18', '73259999', 'P0591', '', 'SBM10', '9', '9', '18', '12FN Top Plate', '3', '155', '3', NULL, '', '', '-50', NULL, NULL, '', '2025-06-21', 'Exclusive'),
(60, '2026-02-18', '73259999', 'P0592', '', 'SBM10', '9', '9', '18', '12FN Top Plate', '3', '155', '3', NULL, '', '', '-50', NULL, NULL, '', '2025-06-21', 'Exclusive'),
(61, '2026-02-18', '73259999', 'P0595', '', 'SBM10', '9', '9', '18', '12FN Top Plate', '3', '155', '3', NULL, '', '', '-50', NULL, NULL, '', '2025-06-21', 'Exclusive'),
(62, '2026-02-18', '73259999', 'P0600', '', 'SBM10', '9', '9', '18', '12FN Top Plate', '3', '155', '3', NULL, '', '', '-50', NULL, NULL, '', '2025-06-21', 'Exclusive'),
(63, '2026-02-18', '73259999', 'P0607', '', 'SBM10', '9', '9', '18', '12FN Top Plate', '3', '155', '3', NULL, '', '', '-50', NULL, NULL, '', '2025-06-21', 'Exclusive'),
(64, '2026-02-18', '73259999', 'P6-0608', '', 'SBM10', '9', '9', '18', '12FN Top Plate', '4', '155', '4', NULL, '', '', '-50', NULL, NULL, '', '2025-06-21', 'Exclusive'),
(65, '2026-02-18', '73259999', 'P0612', '', 'SBM10', '9', '9', '18', '12FN Top Plate', '3', '155', '3', NULL, '', '', '-50', NULL, NULL, '', '2025-06-21', 'Exclusive'),
(66, '2026-02-18', '73259999', 'P0545', '', 'SBM05', '9', '9', '18', 'LH Inner Box', '2', '155', '2', NULL, '', '', '-39', NULL, NULL, '', '2025-06-21', 'Exclusive'),
(67, '2026-02-18', '73259999', 'P0585', '', 'SBM05', '9', '9', '18', 'LH Inner Box', '3', '155', '3', NULL, '', '', '-39', NULL, NULL, '', '2025-06-21', 'Exclusive'),
(68, '2026-02-18', '73259999', 'P0586', '', 'SBM05', '9', '9', '18', 'LH Inner Box', '3', '155', '3', NULL, '', '', '-39', NULL, NULL, '', '2025-06-21', 'Exclusive'),
(69, '2026-02-18', '73259999', 'P0587', '', 'SBM05', '9', '9', '18', 'LH Inner Box', '3', '155', '3', NULL, '', '', '-39', NULL, NULL, '', '2025-06-21', 'Exclusive'),
(70, '2026-02-18', '73259999', 'P0590', '', 'SBM05', '9', '9', '18', 'LH Inner Box', '3', '155', '3', NULL, '', '', '-39', NULL, NULL, '', '2025-06-21', 'Exclusive'),
(71, '2026-02-18', '73259999', 'P0596', '', 'SBM05', '9', '9', '18', 'LH Inner Box', '3', '155', '3', NULL, '', '', '-39', NULL, NULL, '', '2025-06-21', 'Exclusive'),
(72, '2026-02-18', '73259999', 'P0597', '', 'SBM05', '9', '9', '18', 'LH Inner Box', '3', '155', '3', NULL, '', '', '-39', NULL, NULL, '', '2025-06-21', 'Exclusive'),
(73, '2026-02-18', '73259999', 'P0598', '', 'SBM05', '9', '9', '18', 'LH Inner Box', '3', '155', '3', NULL, '', '', '-39', NULL, NULL, '', '2025-06-21', 'Exclusive'),
(74, '2026-02-18', '73259999', 'P0599', '', 'SBM05', '9', '9', '18', 'LH Inner Box', '3', '155', '3', NULL, '', '', '-39', NULL, NULL, '', '2025-06-21', 'Exclusive'),
(75, '2026-02-18', '73259999', 'P0601', '', 'SBM05', '9', '9', '18', 'LH Inner Box', '1', '155', '1', NULL, '', '', '-39', NULL, NULL, '', '2025-06-21', 'Exclusive'),
(76, '2026-02-18', '73259999', 'P0602', '', 'SBM05', '9', '9', '18', 'LH Inner Box', '4', '155', '4', NULL, '', '', '-39', NULL, NULL, '', '2025-06-21', 'Exclusive'),
(77, '2026-02-18', '73259999', 'P0603', '', 'SBM05', '9', '9', '18', 'LH Inner Box', '4', '155', '4', NULL, '', '', '-39', NULL, NULL, '', '2025-06-21', 'Exclusive'),
(78, '2026-02-18', '73259999', 'P0604', '', 'SBM05', '9', '9', '18', 'LH Inner Box', '4', '155', '4', NULL, '', '', '-39', NULL, NULL, '', '2025-06-21', 'Exclusive'),
(79, '2026-02-18', '73259999', 'P0607', '', 'SBM05', '9', '9', '18', 'LH Inner Box', '1', '155', '1', NULL, '', '', '-39', NULL, NULL, '', '2025-06-21', 'Exclusive'),
(80, '2026-02-18', '73259999', 'P0579', '', 'SBM03', '9', '9', '18', 'LH Outer Box', '3', '155', '3', NULL, '', '', '-37', NULL, NULL, '', '2025-06-27', 'Exclusive'),
(81, '2026-02-18', '73259999', 'P0612', '', 'SBM03', '9', '9', '18', 'LH Outer Box', '1', '155', '1', NULL, '', '', '-37', NULL, NULL, '', '2025-06-27', 'Exclusive'),
(82, '2026-02-18', '73259999', 'P0613', '', 'SBM03', '9', '9', '18', 'LH Outer Box', '4', '155', '4', NULL, '', '', '-37', NULL, NULL, '', '2025-06-27', 'Exclusive'),
(83, '2026-02-18', '73259999', 'P0630', '', 'SBM03', '9', '9', '18', 'LH Outer Box', '4', '155', '4', NULL, '', '', '-37', NULL, NULL, '', '2025-06-27', 'Exclusive'),
(84, '2026-02-18', '73259999', 'P0635', '', 'SBM03', '9', '9', '18', 'LH Outer Box', '3', '155', '3', NULL, '', '', '-37', NULL, NULL, '', '2025-06-27', 'Exclusive'),
(85, '2026-02-18', '73259999', 'P0636', '', 'SBM03', '9', '9', '18', 'LH Outer Box', '3', '155', '3', NULL, '', '', '-37', NULL, NULL, '', '2025-06-27', 'Exclusive'),
(86, '2026-02-18', '73259999', 'P0637', '', 'SBM03', '9', '9', '18', 'LH Outer Box', '3', '155', '3', NULL, '', '', '-37', NULL, NULL, '', '2025-06-27', 'Exclusive'),
(87, '2026-02-18', '73259999', 'P0638', '', 'SBM03', '9', '9', '18', 'LH Outer Box', '3', '155', '3', NULL, '', '', '-37', NULL, NULL, '', '2025-06-27', 'Exclusive'),
(88, '2026-02-18', '73259999', 'P0640', '', 'SBM03', '9', '9', '18', 'LH Outer Box', '3', '155', '3', NULL, '', '', '-37', NULL, NULL, '', '2025-06-27', 'Exclusive'),
(89, '2026-02-18', '73259999', 'P0641', '', 'SBM03', '9', '9', '18', 'LH Outer Box', '3', '155', '3', NULL, '', '', '-37', NULL, NULL, '', '2025-06-27', 'Exclusive'),
(90, '2026-02-18', '73259999', 'P0642', '', 'SBM03', '9', '9', '18', 'LH Outer Box', '2', '155', '2', NULL, '', '', '-37', NULL, NULL, '', '2025-06-27', 'Exclusive'),
(91, '2026-02-18', '73259999', 'P0634', '', 'SBM03', '9', '9', '18', 'LH Outer Box', '3', '155', '3', NULL, '', '', '-37', NULL, NULL, '', '2025-06-27', 'Exclusive'),
(92, '2026-02-18', '73259999', 'P0660', '', 'SBM03', '9', '9', '18', 'LH Outer Box', '2', '155', '2', NULL, '', '', '-37', NULL, NULL, '', '2025-06-27', 'Exclusive'),
(93, '2026-02-18', '73259999', 'P0694', '', 'SBM03', '9', '9', '18', 'LH Outer Box', '3', '155', '3', NULL, '', '', '-37', NULL, NULL, '', '2025-06-27', 'Exclusive'),
(94, '2026-02-18', '73259999', '', '7', 'SBM10', '9', '9', '18', '12FN Top Plate', '1', '155', '1', NULL, '', '', '-50', NULL, NULL, '', '2025-06-27', 'Exclusive'),
(95, '2026-02-25', '73259999', '33801', '23', 'TB1', '9', '9', '18', 'TEST BAR(300mmX50mmX50mm)', '2', '175', '2', NULL, '', '', '0', NULL, NULL, '', '2025-06-09', 'Exclusive');

-- --------------------------------------------------------

--
-- Table structure for table `stock_reports`
--

CREATE TABLE `stock_reports` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `hsnno` varchar(255) DEFAULT NULL,
  `heatno` varchar(255) DEFAULT NULL,
  `itemid` varchar(255) DEFAULT NULL,
  `itemcode` varchar(255) DEFAULT NULL,
  `itemname` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `updatestock` varchar(255) DEFAULT NULL,
  `stat` varchar(255) NOT NULL,
  `stockdate` date DEFAULT NULL,
  `purchaseid` varchar(255) DEFAULT NULL,
  `balance` varchar(225) DEFAULT NULL,
  `priceType` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_reports`
--

INSERT INTO `stock_reports` (`id`, `date`, `hsnno`, `heatno`, `itemid`, `itemcode`, `itemname`, `status`, `updatestock`, `stat`, `stockdate`, `purchaseid`, `balance`, `priceType`) VALUES
(3, '2026-02-11', '73259930', 'P0213', '3', 'CA16', '1/2\" CL 600 Body', NULL, '20', '', NULL, '3', NULL, 'Exclusive'),
(4, '2026-02-12', '84803000', '', '', 'SP01', 'Coal Nozzle ', NULL, '1', '', NULL, '4', NULL, 'Exclusive'),
(70, '2026-02-18', '73259999', 'P0498', '|', 'SBM08', 'EH Outer Box', NULL, '2', '', '2025-05-05', '5', NULL, ''),
(69, '2026-02-18', '73259999', 'P0497', '|', 'SBM08', 'EH Outer Box', NULL, '2', '', '2025-05-05', '5', NULL, ''),
(68, '2026-02-18', '73259999', 'P0496', '|', 'SBM08', 'EH Outer Box', NULL, '2', '', '2025-05-05', '5', NULL, ''),
(67, '2026-02-18', '73259999', 'P0495', '|', 'SBM08', 'EH Outer Box', NULL, '2', '', '2025-05-05', '5', NULL, ''),
(66, '2026-02-18', '73259999', 'P0485', '|', 'SBM08', 'EH Outer Box', NULL, '2', '', '2025-05-05', '5', NULL, ''),
(65, '2026-02-18', '73259999', 'P0484', '|', 'CA16', 'EH Outer Box', NULL, '2', '', '2025-05-05', '5', NULL, ''),
(64, '2026-02-18', '73259999', 'P0483', '|', 'CA16', 'EH Outer Box', NULL, '2', '', '2025-05-05', '5', NULL, ''),
(63, '2026-02-18', '73259999', 'P0482', '|', 'CA16', 'EH Outer Box', NULL, '2', '', '2025-05-05', '5', NULL, ''),
(62, '2026-02-18', '73259999', 'P0481', '|', 'CA16', 'EH Outer Box', NULL, '2', '', '2025-05-05', '5', NULL, ''),
(61, '2026-02-18', '73259999', 'P0479', '|', 'CA16', 'EH Outer Box', NULL, '2', '', '2025-05-05', '5', NULL, ''),
(60, '2026-02-18', '73259999', 'P0478', '|', 'CA16', 'EH Outer Box', NULL, '2', '', '2025-05-05', '5', NULL, ''),
(59, '2026-02-18', '73259999', 'P0477', '|', 'CA16', 'EH Outer Box', NULL, '2', '', '2025-05-05', '5', NULL, ''),
(58, '2026-02-18', '73259999', 'P0476', '3', 'CA16', 'EH Outer Box', NULL, '2', '', '2025-05-05', '5', NULL, ''),
(57, '2026-02-18', '73259999', 'P0475', '|', 'CA16', 'EH Outer Box', NULL, '2', '', '2025-05-05', '5', NULL, ''),
(56, '2026-02-18', '73259999', 'P0474', '|', 'CA16', 'EH Outer Box', NULL, '2', '', '2025-05-05', '5', NULL, ''),
(55, '2026-02-18', '73259999', 'P0473', '3', 'CA16', 'EH Outer Box', NULL, '2', '', '2025-05-05', '5', NULL, ''),
(54, '2026-02-18', '73259999', 'P0472', '|', 'CA16', 'EH Outer Box', NULL, '2', '', '2025-05-05', '5', NULL, ''),
(53, '2026-02-18', '73259999', 'P0471', '|', 'CA16', 'EH Outer Box', NULL, '2', '', '2025-05-05', '5', NULL, ''),
(52, '2026-02-18', '73259999', 'P0470', '3', 'CA16', 'EH Outer Box', NULL, '2', '', '2025-05-05', '5', NULL, ''),
(51, '2026-02-18', '73259999', 'P0464', '|', 'CA16', 'EH Outer Box', NULL, '2', '', '2025-05-05', '5', NULL, ''),
(50, '2026-02-18', '73259999', 'P0443', '|', 'CA16', '1/2\" CL 600 Body', NULL, '1', '', '2025-05-05', '5', NULL, ''),
(49, '2026-02-18', '73259999', 'P0426', '3', 'CA16', '1/2\" CL 600 Body', NULL, '2', '', '2025-05-05', '5', NULL, ''),
(48, '2026-02-18', '73259999', 'P0425', '|', 'CA16', '1/2\" CL 600 Body', NULL, '5', '', '2025-05-05', '5', NULL, ''),
(47, '2026-02-18', '73259999', 'P0424', '|', 'CA16', '1/2\" CL 600 Body', NULL, '5', '', '2025-05-05', '5', NULL, ''),
(46, '2026-02-18', '73259999', 'P0412', '3', 'CA16', '1/2\" CL 600 Body', NULL, '4', '', '2025-05-05', '5', NULL, ''),
(71, '2026-02-18', '', NULL, '1', '001', 'Inspection', NULL, '1', '', '2025-05-05', '6', NULL, ''),
(72, '2026-02-18', '84803000', '', '', 'CA02', '4\" 1500 Body', NULL, '1', '', '2025-05-09', '7', NULL, 'Exclusive'),
(73, '2026-02-18', '84803000', '', '', 'OMI 02', 'Retainer 3.0 Pattern', NULL, '1', '', '2025-05-29', '8', NULL, 'Exclusive'),
(74, '2026-02-18', '84803000', '', '', 'OMI 01', 'Retainer 2.0  Pattern', NULL, '1', '', '2025-05-29', '8', NULL, 'Exclusive'),
(75, '2026-02-18', '998898', '', '17', '001', 'Inspection', NULL, '1', '', '2025-06-01', '9', NULL, 'Exclusive'),
(123, '2026-02-25', '73259999', '33801', '', 'CA02', '4\" 1500 Body', NULL, '3', '', NULL, '16', NULL, 'Exclusive'),
(124, '2026-02-25', '73259999', '33817', '', 'CA02', '4\" 1500 Body', NULL, '2', '', NULL, '16', NULL, 'Exclusive'),
(127, '2026-02-25', '73259999', '33801', '23', 'TB1', 'TEST BAR(300mmX50mmX50mm)', NULL, '2', '', NULL, '19', NULL, 'Exclusive');

-- --------------------------------------------------------

--
-- Table structure for table `sup_purchaseorder_details`
--

CREATE TABLE `sup_purchaseorder_details` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `purchasedate` date DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `deliverydate` varchar(100) NOT NULL,
  `potype` varchar(255) NOT NULL,
  `tctype` varchar(255) DEFAULT NULL,
  `purchaseorderno` varchar(225) DEFAULT NULL,
  `purchaseorder` varchar(255) DEFAULT NULL,
  `selected_bom` varchar(255) DEFAULT NULL,
  `supplierid` varchar(100) NOT NULL,
  `suppliername` varchar(100) NOT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `shipTo` varchar(255) DEFAULT NULL,
  `shipToAddress` varchar(255) DEFAULT NULL,
  `invoiceno` varchar(225) DEFAULT NULL,
  `requirements` text,
  `vendor_quot` varchar(100) DEFAULT NULL,
  `quot_date` varchar(100) DEFAULT NULL,
  `billtype` varchar(225) DEFAULT NULL,
  `gsttype` varchar(225) DEFAULT NULL,
  `tcctype` int(11) DEFAULT NULL,
  `typesgst` longtext,
  `typecgst` longtext,
  `typeigst` longtext,
  `hsnno` longtext,
  `itemcode` varchar(100) NOT NULL,
  `itemid` varchar(255) DEFAULT NULL,
  `itemname` varchar(255) DEFAULT NULL,
  `item_desc` text NOT NULL,
  `grade` varchar(100) NOT NULL,
  `workorderno` varchar(100) NOT NULL,
  `workorderid` varchar(100) NOT NULL,
  `drawingno` varchar(100) NOT NULL,
  `uom` longtext,
  `weight` varchar(100) DEFAULT NULL,
  `rate` longtext,
  `qty` longtext,
  `balanceqty` varchar(255) DEFAULT NULL,
  `bom_qty` varchar(255) NOT NULL,
  `amount` longtext,
  `discount` longtext,
  `discountBy` varchar(255) NOT NULL,
  `discountamount` longtext,
  `taxableamount` longtext,
  `sgst` longtext,
  `sgstamount` longtext,
  `cgst` longtext,
  `cgstamount` longtext,
  `igst` longtext,
  `igstamount` longtext,
  `total` longtext,
  `deliverydates` varchar(100) DEFAULT NULL,
  `subtotal` varchar(225) DEFAULT NULL,
  `freightamount` varchar(225) DEFAULT NULL,
  `freightcgst` varchar(225) DEFAULT NULL,
  `freightcgstamount` varchar(225) DEFAULT NULL,
  `freightsgst` varchar(225) DEFAULT NULL,
  `freightsgstamount` varchar(225) DEFAULT NULL,
  `freightigst` varchar(225) DEFAULT NULL,
  `freightigstamount` varchar(225) DEFAULT NULL,
  `freighttotal` varchar(225) DEFAULT NULL,
  `loadingamount` varchar(225) DEFAULT NULL,
  `loadingcgst` varchar(225) DEFAULT NULL,
  `loadingcgstamount` varchar(225) DEFAULT NULL,
  `loadingsgst` varchar(225) DEFAULT NULL,
  `loadingsgstamount` varchar(225) DEFAULT NULL,
  `loadingigst` varchar(225) DEFAULT NULL,
  `loadingigstamount` varchar(225) DEFAULT NULL,
  `loadingtotal` varchar(225) DEFAULT NULL,
  `othercharges` varchar(225) DEFAULT NULL,
  `roundOff` varchar(255) NOT NULL,
  `return_status` longtext,
  `grandtotal` varchar(225) DEFAULT NULL,
  `purchasenodate` varchar(225) DEFAULT NULL,
  `purchasenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sup_purchaseorder_details`
--

INSERT INTO `sup_purchaseorder_details` (`id`, `date`, `purchasedate`, `invoicedate`, `deliverydate`, `potype`, `tctype`, `purchaseorderno`, `purchaseorder`, `selected_bom`, `supplierid`, `suppliername`, `customerId`, `customername`, `address`, `shipTo`, `shipToAddress`, `invoiceno`, `requirements`, `vendor_quot`, `quot_date`, `billtype`, `gsttype`, `tcctype`, `typesgst`, `typecgst`, `typeigst`, `hsnno`, `itemcode`, `itemid`, `itemname`, `item_desc`, `grade`, `workorderno`, `workorderid`, `drawingno`, `uom`, `weight`, `rate`, `qty`, `balanceqty`, `bom_qty`, `amount`, `discount`, `discountBy`, `discountamount`, `taxableamount`, `sgst`, `sgstamount`, `cgst`, `cgstamount`, `igst`, `igstamount`, `total`, `deliverydates`, `subtotal`, `freightamount`, `freightcgst`, `freightcgstamount`, `freightsgst`, `freightsgstamount`, `freightigst`, `freightigstamount`, `freighttotal`, `loadingamount`, `loadingcgst`, `loadingcgstamount`, `loadingsgst`, `loadingsgstamount`, `loadingigst`, `loadingigstamount`, `loadingtotal`, `othercharges`, `roundOff`, `return_status`, `grandtotal`, `purchasenodate`, `purchasenoyear`, `status`, `edit_status`) VALUES
(1, '2026-02-10', '2025-03-12', NULL, '10-02-2026', 'workorder', '2', 'CK/PUR/25-26/-001', NULL, NULL, '11', 'Sri Ayyappa Engineering Works', 2, 'SIGMA POWER & ENERGY ENGINEERS', '4/348C,Kallipalayam Road, Chikarampalayam, Karamadai, Coimbatore, Tamil Nadu', NULL, NULL, '0', NULL, NULL, NULL, 'intrastate', 'intrastate', NULL, 'sgst', 'cgst', '', '84803000', 'SP01', NULL, 'Coal Nozzle ', '', '1', 'CK/WO/25-26/-001', '3', 'C-13-004', 'NOS', '1', '142000', '1', '1', '', '142000.00', '', 'amount_wise', '', '142000.00', '9', '12780.00', '9', '12780.00', '0', '0', NULL, '', '142000.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '0', '1', '167560.00', 'CK/PUR/25-26/-001100226', 'CK/PUR/25-26/-001-2026', 1, 2),
(7, '2026-02-11', '2025-03-12', NULL, '30-03-2025', 'workorder', '1', 'CK/PUR/25-26/-002', '-', NULL, '8', 'PREMIER ALLOYS', 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, NULL, '0', 'Note:\r\nTest Certificate Required', NULL, NULL, 'intrastate', 'intrastate', NULL, 'sgst', 'cgst', '', '73259930', 'CA16', '3', '1/2\" CL 600 Body', '', '1', 'CK/WO/25-26/-002', '15', '-', 'NOS', '3', '600', '20', '20', '', '36000.00', NULL, 'amount_wise', '', '36000.00', '9', '3240.00', '9', '3240.00', '0', '0', NULL, '30-03-2025', '36000.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', '42480.00', 'CK/PUR/25-26/-002110226', 'CK/PUR/25-26/-002-2026', 1, 2),
(8, '2026-02-11', '2025-03-12', NULL, '30-05-2025', 'workorder', '', 'CK/PUR/25-26/-003', 'PO3704', NULL, '8', 'PREMIER ALLOYS', 2, 'SIGMA POWER & ENERGY ENGINEERS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, NULL, '0', NULL, 'ORAL', '17-02-2025', 'intrastate', 'intrastate', NULL, 'sgst', 'cgst', '', '73259930', 'SP01', NULL, 'Coal Nozzle(C)', '', '1', 'CK/WO/25-26/-001', '4', 'C-13-004', 'NOS', '120', '450', '4', '4', '', '216000.00', '', 'amount_wise', '', '216000.00', '9', '19440.00', '9', '19440.00', '0', '0', NULL, '', '216000.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '0', '1', '254880.00', 'CK/PUR/25-26/-003110226', 'CK/PUR/25-26/-003-2026', 1, 1),
(9, '2026-02-11', '2025-03-23', NULL, '30-05-2025', 'workorder', '1', 'CK/PUR/25-26/-004', 'CAD2025405 REV 01', NULL, '8', 'PREMIER ALLOYS', 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, NULL, '0', 'Note:\r\nTest Certificate Required', NULL, NULL, 'intrastate', 'intrastate', NULL, 'sgst', 'cgst', '', '73259999', 'CA16', '3', '1/2\" CL 600 Body', '', '2', 'CK/WO/25-26/-003', '16', '-', 'NOS', '3.5', '200', '20', '20', '', '14000.00', NULL, 'amount_wise', '', '14000.00', '9', '1260.00', '9', '1260.00', '0', '0', NULL, '', '14000.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', '16520.00', 'CK/PUR/25-26/-004110226', 'CK/PUR/25-26/-004-2026', 1, 2),
(10, '2026-02-12', '2025-04-18', NULL, '12-02-2026', 'workorder', '1', 'CK/PUR/25-26/-005', 'PO-SC-2526-008', NULL, '8', 'PREMIER ALLOYS', 9, 'STAAN BIO MED PVT LTD', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, NULL, '0', NULL, NULL, NULL, 'intrastate', 'intrastate', NULL, 'sgst', 'cgst', '', '73259999', 'SBM08', NULL, 'EH Outer Box', '', '1', 'CK/WO/25-26/-004', '17', 'ST-MSC-017', 'NOS', '33.9', '150', '40', '40', '', '203400.00', '', 'amount_wise', '', '203400.00', '9', '18306.00', '9', '18306.00', '0', '0', NULL, '28-04-2025', '203400.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '0', '1', '240012.00', 'CK/PUR/25-26/-005120226', 'CK/PUR/25-26/-005-2026', 1, 2),
(11, '2026-02-13', '2025-05-05', NULL, '13-02-2026', 'workorder', '', 'CK/PUR/25-26/-006', '1', NULL, '12', 'PKS Inspection Service', 13, 'CKP LOI', '83A Pudukadu 2nd Street,Sivanathapuram, Vellakovil-638111,Kangeyam Taluk, Tiruppur, Tamil Nadu', NULL, NULL, '0', NULL, '1', '01-05-2025', 'intrastate', 'intrastate', NULL, 'sgst', 'cgst', '', '998898', '001', NULL, 'Inspection', '', '1', 'CK/WO/25-26/-007', '22', '-', 'NOS', '1', '2000', '1', '1', '', '2000.00', '', 'amount_wise', '', '2000.00', '9', '180.00', '9', '180.00', '0', '0', NULL, '30-05-2025', '2000.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '0', '1', '2360.00', 'CK/PUR/25-26/-006130226', 'CK/PUR/25-26/-006-2026', 1, 1),
(12, '2026-02-13', '2025-05-06', NULL, '13-02-2026', 'workorder', '', 'CK/PUR/25-26/-007', 'PO-SC-2526-020', NULL, '8', 'PREMIER ALLOYS', 9, 'STAAN BIO MED PVT LTD', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, NULL, '0', NULL, 'ORAL', '18-02-2025', 'intrastate', 'intrastate', NULL, 'sgst', 'cgst', '', '73259999||73259999||73259999', 'SBM03||SBM05||SBM10', NULL, 'LH Outer Box||LH Inner Box||12FN Top Plate', '||||', '1||1||1', 'CK/WO/25-26/-005', '18||19||20', 'ST-MSC-016||ST-MSC-014-R1||STMSC022 R1', 'NOS||NOS||NOS', '24.6||26.1||27', '155||155||155', '40||40||50', '40||40||50', '', '152520.00||161820.00||209250.00', '', 'amount_wise', '||||', '152520.00||161820.00||209250.00', '9', '47123.10', '9', '47123.10', '0||0||0', '0||0||0', NULL, '||||', '523590.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '0', '1||1||1', '617836.20', 'CK/PUR/25-26/-007130226', 'CK/PUR/25-26/-007-2026', 1, 1),
(13, '2026-02-13', '2025-05-07', NULL, '13-02-2026', 'workorder', '', 'CK/PUR/25-26/-008', '', NULL, '11', 'Sri Ayyappa Engineering Works', 13, 'CKP LOI', '4/348C,Kallipalayam Road, Chikarampalayam, Karamadai, Coimbatore, Tamil Nadu', NULL, NULL, '0', NULL, 'SA/25-26/15', '09-05-2025', 'intrastate', 'intrastate', NULL, 'sgst', 'cgst', '', '84803000', 'CA02', NULL, '4\" 1500 Body', 'Pattern & CoreBox for Dimension rework', '1', 'CK/WO/25-26/-008', '23', 'CAD-SPS-YST-0001', 'NOS', '1', '8000', '1', '1', '', '8000.00', '', 'amount_wise', '', '8000.00', '9', '720.00', '9', '720.00', '0', '0', NULL, '', '8000.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '0', '1', '9440.00', 'CK/PUR/25-26/-008130226', 'CK/PUR/25-26/-008-2026', 1, 2),
(14, '2026-02-13', '2025-05-08', NULL, '08-06-2025', 'workorder', '', 'CK/PUR/25-26/-009', 'CAD2025363 REV01', NULL, '14', 'Shree Kumaran Alloys', 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', 'S/F No - 461, Telungupalayam Road,, Ellapalayam Post,Annur, Coimbatore, Tamil Nadu', NULL, NULL, '0', NULL, 'ORAL', '07-05-2025', 'intrastate', 'intrastate', NULL, 'sgst', 'cgst', '', '73259999', 'CA02', NULL, '4\" 1500 Body', '', '1', 'CK/WO/25-26/-006', '21', 'CAD-SPS-YST-0001', 'NOS', '212', '175', '5', '5', '', '185500.00', '', 'amount_wise', '', '185500.00', '9', '16695.00', '9', '16695.00', '0', '0', NULL, '08-06-2025', '185500.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '0', '1', '218890.00', 'CK/PUR/25-26/-009130226', 'CK/PUR/25-26/-009-2026', 1, 2),
(15, '2026-02-14', '2025-05-12', NULL, '25-06-2025', 'workorder', '', 'CK/PUR/25-26/-010', '', NULL, '8', 'Sri Ayyappa Engineering Works', 15, 'OM Industries', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, NULL, '0', NULL, 'SA/25-25/096', '28-02-2025', 'intrastate', 'intrastate', NULL, 'sgst', 'cgst', '', '84803000||84803000', 'OMI 01||OMI 02', NULL, 'Retainer 2.0  Pattern||Retainer 3.0 Pattern', '||', '1||1', 'CK/WO/25-26/-009', '29||30', '2.067398||3.062269', 'NOS||NOS', '1||1', '40000||32000', '1||1', '1||1', '', '40000.00||32000.00', '', 'amount_wise', '||', '40000.00||32000.00', '9', '6480.00', '9', '6480.00', '0||0', '0||0', NULL, '30-05-2025||30-05-2025', '72000.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '0', '1||1', '84960.00', 'CK/PUR/25-26/-010140226', 'CK/PUR/25-26/-010-2026', 1, 2),
(16, '2026-02-14', '2025-05-16', NULL, '20-05-2026', 'workorder', '', 'CK/PUR/25-26/-011', 'PO 3742', NULL, '8', 'PREMIER ALLOYS', 2, 'SIGMA POWER & ENERGY ENGINEERS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, NULL, '0', NULL, 'ORAL', '16-05-2025', 'intrastate', 'intrastate', NULL, 'sgst', 'cgst', '', '73259930', 'SP02', NULL, 'Collector Casting', '', '1', 'CK/WO/25-26/-010', '31', '3-SPG-9473', 'NOS', '28.7', '410', '4', '4', '', '47068.00', '', 'amount_wise', '', '47068.00', '9', '4236.12', '9', '4236.12', '0', '0', NULL, '', '47068.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '0', '1', '55540.24', 'CK/PUR/25-26/-011140226', 'CK/PUR/25-26/-011-2026', 1, 1),
(17, '2026-02-14', '2025-05-19', NULL, '20-06-2025', 'workorder', '', 'CK/PUR/25-26/-012', 'OM/PO/05-25-26/01', NULL, '8', 'PREMIER ALLOYS', 15, 'OM Industries', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, NULL, '0', NULL, 'ORAL', '19-04-2025', 'intrastate', 'intrastate', NULL, 'sgst', 'cgst', '', '73259920||73259920', 'OMI 02||OMI 01', NULL, 'Retainer 3.0||Retainer 2.0', '||', '1||1', 'CK/WO/25-26/-009', '28||27', '3.062269||2.067398', 'NOS||NOS', '49||103', '165||165', '4||12', '4||12', '', '32340.00||203940.00', '', 'amount_wise', '||', '32340.00||203940.00', '9', '21265.20', '9', '21265.20', '0||0', '0||0', NULL, '||', '236280.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '0', '1||1', '278810.40', 'CK/PUR/25-26/-012140226', 'CK/PUR/25-26/-012-2026', 1, 1),
(18, '2026-02-14', '2026-05-20', NULL, '10-06-2025', 'workorder', '', 'CK/PUR/25-26/-013', '3', NULL, '11', 'Sri Ayyappa Engineering Works', 13, 'CKP LOI', '4/348C,Kallipalayam Road, Chikarampalayam, Karamadai, Coimbatore, Tamil Nadu', NULL, NULL, '0', NULL, 'SA/24-25/096', '28-02-2025', 'intrastate', 'intrastate', NULL, 'sgst', 'cgst', '', '84803000', 'SP03', NULL, 'Collector Casting 3-SPG-8557', '1 Set Aluminium Pattern with Match Plate for Rework', '1', 'CK/WO/25-26/-011', '36', '3-SPG-8557', 'NOS', '1', '9500', '1', '1', '', '9500.00', '', 'amount_wise', '', '9500.00', '9', '855.00', '9', '855.00', '0', '0', NULL, '20-06-2025', '9500.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '0', '1', '11210.00', 'CK/PUR/25-26/-013140226', 'CK/PUR/25-26/-013-2026', 1, 1),
(19, '2026-02-14', '2025-06-10', NULL, '30-07-2025', 'workorder', '', 'CK/PUR/25-26/-014', 'PO 3755', NULL, '8', 'PREMIER ALLOYS', 2, 'SIGMA POWER & ENERGY ENGINEERS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, NULL, '0', NULL, 'ORAL', '09-06-2025', 'intrastate', 'intrastate', NULL, 'sgst', 'cgst', '', '73259930', 'SP02', NULL, 'Collector Casting', '', '1', 'CK/WO/25-26/-012', '40', '3-SPG-9473', 'NOS', '27.5', '420', '348', '348', '', '4019400.00', '', 'amount_wise', '', '4019400.00', '9', '361746.00', '9', '361746.00', '0', '0', NULL, '', '4019400.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '0', '1', '4742892.00', 'CK/PUR/25-26/-014140226', 'CK/PUR/25-26/-014-2026', 1, 1),
(20, '2026-02-14', '2025-06-11', NULL, '15-07-2025', 'workorder', '', 'CK/PUR/25-26/-015', 'PO-2526-0333', NULL, '8', 'PREMIER ALLOYS', 9, 'STAAN BIO MED PVT LTD', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, NULL, '0', NULL, 'ORAL', '18-02-2025', 'intrastate', 'intrastate', NULL, 'sgst', 'cgst', '', '73259999||73259999||73259999', 'SBM04||SBM02||SBM09', NULL, 'NH Inner Box||NH Outer Box||Moving Block', '||||', '1||1||1', 'CK/WO/25-26/-013', '42||41||43', 'ST-MSC-013 R1||ST-MSC-015||ST-MSC-012 R1', 'NOS||NOS||NOS', '28||27||10', '155||155||155', '40||40||100', '40||40||100', '', '173600.00||167400.00||155000.00', '', 'amount_wise', '||||', '173600.00||167400.00||155000.00', '9', '44640.00', '9', '44640.00', '0||0||0', '0||0||0', NULL, '||||', '496000.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '0', '1||1||1', '585280.00', 'CK/PUR/25-26/-015140226', 'CK/PUR/25-26/-015-2026', 1, 1),
(21, '2026-02-14', '2025-06-16', NULL, '16-06-2025', 'workorder', '', 'CK/PUR/25-26/-016', '3757', NULL, '8', 'PREMIER ALLOYS', 2, 'SIGMA POWER & ENERGY ENGINEERS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, NULL, '0', NULL, 'ORAL', '09-06-2025', 'intrastate', 'intrastate', NULL, 'sgst', 'cgst', '', '73259930', 'SP03', NULL, 'Collector Casting 8557', '', '1', 'CK/WO/25-26/-014', '44', '3-SPG-8557 ', 'NOS', '30.5', '420', '4', '4', '', '51240.00', '', 'amount_wise', '', '51240.00', '9', '4611.60', '9', '4611.60', '0', '0', NULL, '30-06-2025', '51240.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '0', '1', '60463.20', 'CK/PUR/25-26/-016140226', 'CK/PUR/25-26/-016-2026', 1, 1),
(22, '2026-02-14', '2025-06-23', NULL, '30-07-2025', 'workorder', '', 'CK/PUR/25-26/-017', '4', NULL, '16', 'TryMy Website', 13, 'CKP LOI', '2nd Floor, SK Towers, Sathy Main Road, , Saravanampatti, Coimbatore, Tamil Nadu', NULL, NULL, '0', NULL, '132', '03-05-2025', 'intrastate', 'intrastate', NULL, 'sgst', 'cgst', '', '998898', 'WC1', NULL, 'Website Creation', 'Domain (1 year)         Hosting 1 GB(1 year)       6 Pages responsive Design        Watsapp Integration     Social Media Integration  Mobile Responsive Design', '1', 'CK/WO/25-26/-015', '45', '-', 'NOS', '1', '6000', '1', '1', '', '6000.00', '', 'amount_wise', '', '6000.00', '9', '540.00', '9', '540.00', '0', '0', NULL, '30-07-2025', '6000.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '0', '1', '7080.00', 'CK/PUR/25-26/-017140226', 'CK/PUR/25-26/-017-2026', 1, 1),
(23, '2026-02-14', '2025-06-28', NULL, '14-02-2026', 'workorder', '1', 'CK/PUR/25-26/-018', NULL, NULL, '8', 'PREMIER ALLOYS', 2, 'SIGMA POWER & ENERGY ENGINEERS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, NULL, '0', NULL, 'ORAL', '09-06-2025', 'intrastate', 'intrastate', NULL, 'sgst', 'cgst', '', '73259930', 'SP03', NULL, 'Collector Casting 8557', '', '1', 'CK/WO/25-26/-014', '44', '3-SPG-8557 ', 'NOS', '30.5', '420', '4', '4', '', '51240.00', '', 'amount_wise', '', '51240.00', '9', '4611.60', '9', '4611.60', '0', '0', NULL, '', '51240.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '0', '1', '60463.20', 'CK/PUR/25-26/-018140226', 'CK/PUR/25-26/-018-2026', 1, 1),
(24, '2026-02-14', '2025-07-16', NULL, '25-07-2025', 'workorder', '1', 'CK/PUR/25-26/-019', '3757', NULL, '8', 'PREMIER ALLOYS', 2, 'SIGMA POWER & ENERGY ENGINEERS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, NULL, '0', NULL, 'ORAL', '09-06-2025', 'intrastate', 'intrastate', NULL, 'sgst', 'cgst', '', '73259930', 'SP03', NULL, 'Collector Casting 8557', '', '1', 'CK/WO/25-26/-014', '44', '3-SPG-8557 ', 'NOS', '30', '420', '120', '120', '', '1512000.00', '', 'amount_wise', '', '1512000.00', '9', '136080.00', '9', '136080.00', '0', '0', NULL, '', '1512000.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '0', '1', '1784160.00', 'CK/PUR/25-26/-019140226', 'CK/PUR/25-26/-019-2026', 1, 1),
(25, '2026-02-16', '2025-07-17', NULL, '25-08-2025', 'workorder', '1', 'CK/PUR/25-26/-020', 'PO-SC-2526-097', NULL, '8', 'PREMIER ALLOYS', 9, 'STAAN BIO MED PVT LTD', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, NULL, '0', 'NOTE:\r\n1.Test Certifiacte Required\r\n2.Delivery Date 25.08.2025', 'ORAL', '18-02-2025', 'intrastate', 'intrastate', NULL, 'sgst', 'cgst', '', '73259999||73259999', 'SBM03||SBM05', '5||6', 'LH Outer Box||LH Inner Box', '||', '2||2', 'CK/WO/25-26/-016', '46||47', 'ST-MSC-016||ST-MSC-014-R1', 'NOS||NOS', '24.4||25.6', '155||155', '40||40', '40||40', '', '151280.00||158720.00', NULL, 'amount_wise', '||', '151280.00||158720.00', '9', '27900.00', '9', '27900.00', '0||0', '0||0', NULL, '18-08-2025||25-08-2025', '310000.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1||1', '365800.00', 'CK/PUR/25-26/-020160226', 'CK/PUR/25-26/-020-2026', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sup_purchaseorder_details_backup`
--

CREATE TABLE `sup_purchaseorder_details_backup` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `purchasedate` date DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `potype` varchar(255) NOT NULL,
  `purchaseorderno` varchar(225) DEFAULT NULL,
  `purchaseorder` varchar(255) DEFAULT NULL,
  `selected_bom` varchar(255) DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `invoiceno` varchar(225) DEFAULT NULL,
  `billtype` varchar(225) DEFAULT NULL,
  `gsttype` varchar(225) DEFAULT NULL,
  `typesgst` longtext,
  `typecgst` longtext,
  `typeigst` longtext,
  `hsnno` longtext,
  `itemname` longtext,
  `uom` longtext,
  `rate` longtext,
  `qty` longtext,
  `balanceqty` varchar(255) DEFAULT NULL,
  `bom_qty` varchar(255) NOT NULL,
  `amount` longtext,
  `discount` longtext,
  `discountBy` varchar(255) NOT NULL,
  `discountamount` longtext,
  `taxableamount` longtext,
  `sgst` longtext,
  `sgstamount` longtext,
  `cgst` longtext,
  `cgstamount` longtext,
  `igst` longtext,
  `igstamount` longtext,
  `total` longtext,
  `subtotal` varchar(225) DEFAULT NULL,
  `freightamount` varchar(225) DEFAULT NULL,
  `freightcgst` varchar(225) DEFAULT NULL,
  `freightcgstamount` varchar(225) DEFAULT NULL,
  `freightsgst` varchar(225) DEFAULT NULL,
  `freightsgstamount` varchar(225) DEFAULT NULL,
  `freightigst` varchar(225) DEFAULT NULL,
  `freightigstamount` varchar(225) DEFAULT NULL,
  `freighttotal` varchar(225) DEFAULT NULL,
  `loadingamount` varchar(225) DEFAULT NULL,
  `loadingcgst` varchar(225) DEFAULT NULL,
  `loadingcgstamount` varchar(225) DEFAULT NULL,
  `loadingsgst` varchar(225) DEFAULT NULL,
  `loadingsgstamount` varchar(225) DEFAULT NULL,
  `loadingigst` varchar(225) DEFAULT NULL,
  `loadingigstamount` varchar(225) DEFAULT NULL,
  `loadingtotal` varchar(225) DEFAULT NULL,
  `othercharges` varchar(225) DEFAULT NULL,
  `roundOff` varchar(255) NOT NULL,
  `return_status` longtext,
  `grandtotal` varchar(225) DEFAULT NULL,
  `purchasenodate` varchar(225) DEFAULT NULL,
  `purchasenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sup_purchaseorder_reports`
--

CREATE TABLE `sup_purchaseorder_reports` (
  `id` int(11) NOT NULL,
  `purchaseid` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `potype` varchar(255) NOT NULL,
  `purchaseorderno` varchar(255) DEFAULT NULL,
  `purchaseorder` varchar(255) DEFAULT NULL,
  `selected_bom` varchar(255) DEFAULT NULL,
  `purchasedate` varchar(255) DEFAULT NULL,
  `paymenttype` varchar(255) DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(255) DEFAULT NULL,
  `supplierid` varchar(100) NOT NULL,
  `suppliername` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `invoiceno` varchar(255) DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `deliverydate` varchar(100) NOT NULL,
  `batchno` varchar(255) DEFAULT NULL,
  `itemno` varchar(255) DEFAULT NULL,
  `hsnno` varchar(255) DEFAULT NULL,
  `itemcode` varchar(100) NOT NULL,
  `itemid` varchar(100) DEFAULT NULL,
  `itemname` varchar(255) DEFAULT NULL,
  `item_desc` text NOT NULL,
  `uom` varchar(255) DEFAULT NULL,
  `weight` varchar(100) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `grade` varchar(100) NOT NULL,
  `drawingno` varchar(100) NOT NULL,
  `workorderid` varchar(100) NOT NULL,
  `workorderno` varchar(100) NOT NULL,
  `balaceqty` varchar(255) DEFAULT NULL,
  `bom_qty` varchar(255) NOT NULL,
  `total` varchar(255) DEFAULT NULL,
  `deliverydates` varchar(100) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `disamount` varchar(255) DEFAULT NULL,
  `taxname` varchar(255) DEFAULT NULL,
  `taxamount` varchar(255) DEFAULT NULL,
  `adjustment` varchar(255) DEFAULT NULL,
  `grandtotal` varchar(255) DEFAULT NULL,
  `taxtotal` varchar(255) DEFAULT NULL,
  `adjus` varchar(255) DEFAULT NULL,
  `vatadjus` varchar(255) DEFAULT NULL,
  `paid` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `bedadjs` varchar(200) DEFAULT NULL,
  `edcadjus` varchar(255) DEFAULT NULL,
  `sedadjus` varchar(255) DEFAULT NULL,
  `cstadjus` varchar(255) DEFAULT NULL,
  `taxpercentage` varchar(255) DEFAULT NULL,
  `purchasenoyear` varchar(255) DEFAULT NULL,
  `purchasenodate` varchar(255) DEFAULT NULL,
  `requirements` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sup_purchaseorder_reports`
--

INSERT INTO `sup_purchaseorder_reports` (`id`, `purchaseid`, `date`, `potype`, `purchaseorderno`, `purchaseorder`, `selected_bom`, `purchasedate`, `paymenttype`, `customerId`, `customername`, `supplierid`, `suppliername`, `address`, `invoiceno`, `invoicedate`, `deliverydate`, `batchno`, `itemno`, `hsnno`, `itemcode`, `itemid`, `itemname`, `item_desc`, `uom`, `weight`, `rate`, `qty`, `grade`, `drawingno`, `workorderid`, `workorderno`, `balaceqty`, `bom_qty`, `total`, `deliverydates`, `subtotal`, `discount`, `disamount`, `taxname`, `taxamount`, `adjustment`, `grandtotal`, `taxtotal`, `adjus`, `vatadjus`, `paid`, `balance`, `status`, `bedadjs`, `edcadjus`, `sedadjus`, `cstadjus`, `taxpercentage`, `purchasenoyear`, `purchasenodate`, `requirements`) VALUES
(15, '1', '2026-02-12', 'workorder', 'CK/PUR/25-26/-001', NULL, NULL, '2025-03-12', NULL, 2, 'SIGMA POWER & ENERGY ENGINEERS', '11', 'Sri Ayyappa Engineering Works', '4/348C,Kallipalayam Road, Chikarampalayam, Karamadai, Coimbatore, Tamil Nadu', NULL, '1970-01-01', '', NULL, NULL, '84803000', 'SP01', NULL, 'Coal Nozzle ', '', 'NOS', '1', '142000', '1', '1', 'C-13-004', '3', 'CK/WO/25-26/-001', '0', '', NULL, '', '142000.00', NULL, NULL, NULL, NULL, NULL, '167560.00', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, 'CK/PUR/25-26/-001-2026', 'CK/PUR/25-26/-001120226', NULL),
(10, '7', '2026-02-11', 'workorder', 'CK/PUR/25-26/-002', '-', NULL, '2025-03-12', NULL, 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', '8', 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0', NULL, '30-03-2025', NULL, NULL, '73259930', 'CA16', '3', '1/2\" CL 600 Body', '', 'NOS', '3', '600', '20', '1', '-', '15', 'CK/WO/25-26/-002', '0', '', NULL, '30-03-2025', '36000.00', NULL, NULL, NULL, NULL, NULL, '42480.00', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, 'CK/PUR/25-26/-002-2026', 'CK/PUR/25-26/-002110226', NULL),
(50, '8', '2026-02-17', 'workorder', 'CK/PUR/25-26/-003', 'PO3704', NULL, '2025-03-12', NULL, 2, 'SIGMA POWER & ENERGY ENGINEERS', '8', 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, '1970-01-01', '', NULL, NULL, '73259930', 'SP01', NULL, 'Coal Nozzle(C)', '', 'NOS', '120', '450', '4', '1', 'C-13-004', '4', 'CK/WO/25-26/-001', '4', '', NULL, '', '216000.00', NULL, NULL, NULL, NULL, NULL, '254880.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/PUR/25-26/-003-2026', 'CK/PUR/25-26/-003170226', NULL),
(12, '9', '2026-02-11', 'workorder', 'CK/PUR/25-26/-004', 'CAD2025405 REV 01', NULL, '2025-03-23', NULL, 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', '8', 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0', NULL, '30-05-2025', NULL, NULL, '73259999', 'CA16', '3', '1/2\" CL 600 Body', '', 'NOS', '3.5', '200', '20', '2', '-', '16', 'CK/WO/25-26/-003', '3', '', NULL, '', '14000.00', NULL, NULL, NULL, NULL, NULL, '16520.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/PUR/25-26/-004-2026', 'CK/PUR/25-26/-004110226', NULL),
(14, '10', '2026-02-12', 'workorder', 'CK/PUR/25-26/-005', 'PO-SC-2526-008', NULL, '2025-04-18', NULL, 9, 'STAAN BIO MED PVT LTD', '8', 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, '1970-01-01', '', NULL, NULL, '73259999', 'SBM08', NULL, 'EH Outer Box', '', 'NOS', '33.9', '150', '40', '1', 'ST-MSC-017', '17', 'CK/WO/25-26/-004', '0', '', NULL, '28-04-2025', '203400.00', NULL, NULL, NULL, NULL, NULL, '240012.00', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, 'CK/PUR/25-26/-005-2026', 'CK/PUR/25-26/-005120226', NULL),
(51, '11', '2026-02-17', 'workorder', 'CK/PUR/25-26/-006', '1', NULL, '2025-05-05', NULL, 13, 'CKP LOI', '12', 'PKS Inspection Service', '83A Pudukadu 2nd Street,Sivanathapuram, Vellakovil-638111,Kangeyam Taluk, Tiruppur, Tamil Nadu', NULL, '1970-01-01', '', NULL, NULL, '998898', '001', NULL, 'Inspection', '', 'NOS', '1', '2000', '1', '1', '-', '22', 'CK/WO/25-26/-007', '1', '', NULL, '30-05-2025', '2000.00', NULL, NULL, NULL, NULL, NULL, '2360.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/PUR/25-26/-006-2026', 'CK/PUR/25-26/-006170226', NULL),
(54, '12', '2026-02-17', 'workorder', 'CK/PUR/25-26/-007', 'PO-SC-2526-020', NULL, '2025-05-06', NULL, 9, 'STAAN BIO MED PVT LTD', '8', 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, '1970-01-01', '', NULL, NULL, '73259999', 'SBM10', NULL, '12FN Top Plate', '', 'NOS', '27', '155', '50', '1', 'STMSC022 R1', '20', 'CK/WO/25-26/-005', '37', '', NULL, '', '523590.00', NULL, NULL, NULL, NULL, NULL, '617836.20', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, 'CK/PUR/25-26/-007-2026', 'CK/PUR/25-26/-007170226', NULL),
(53, '12', '2026-02-17', 'workorder', 'CK/PUR/25-26/-007', 'PO-SC-2526-020', NULL, '2025-05-06', NULL, 9, 'STAAN BIO MED PVT LTD', '8', 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, '1970-01-01', '', NULL, NULL, '73259999', 'SBM05', NULL, 'LH Inner Box', '', 'NOS', '26.1', '155', '40', '1', 'ST-MSC-014-R1', '19', 'CK/WO/25-26/-005', '0', '', NULL, '', '523590.00', NULL, NULL, NULL, NULL, NULL, '617836.20', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, 'CK/PUR/25-26/-007-2026', 'CK/PUR/25-26/-007170226', NULL),
(52, '12', '2026-02-17', 'workorder', 'CK/PUR/25-26/-007', 'PO-SC-2526-020', NULL, '2025-05-06', NULL, 9, 'STAAN BIO MED PVT LTD', '8', 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, '1970-01-01', '', NULL, NULL, '73259999', 'SBM03', NULL, 'LH Outer Box', '', 'NOS', '24.6', '155', '40', '1', 'ST-MSC-016', '18', 'CK/WO/25-26/-005', '30', '', NULL, '', '523590.00', NULL, NULL, NULL, NULL, NULL, '617836.20', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, 'CK/PUR/25-26/-007-2026', 'CK/PUR/25-26/-007170226', NULL),
(62, '13', '2026-02-17', 'workorder', 'CK/PUR/25-26/-008', '', NULL, '2025-05-07', NULL, 13, 'CKP LOI', '11', 'Sri Ayyappa Engineering Works', '4/348C,Kallipalayam Road, Chikarampalayam, Karamadai, Coimbatore, Tamil Nadu', NULL, '1970-01-01', '', NULL, NULL, '84803000', 'CA02', NULL, '4\" 1500 Body', 'Pattern & CoreBox for Dimension rework', 'NOS', '1', '8000', '1', '1', 'CAD-SPS-YST-0001', '23', 'CK/WO/25-26/-008', '0', '', NULL, '', '8000.00', NULL, NULL, NULL, NULL, NULL, '9440.00', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, 'CK/PUR/25-26/-008-2026', 'CK/PUR/25-26/-008170226', NULL),
(56, '14', '2026-02-17', 'workorder', 'CK/PUR/25-26/-009', 'CAD2025363 REV01', NULL, '2025-05-08', NULL, 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', '14', 'Shree Kumaran Alloys', 'S/F No - 461, Telungupalayam Road,, Ellapalayam Post,Annur, Coimbatore, Tamil Nadu', NULL, '1970-01-01', '', NULL, NULL, '73259999', 'CA02', NULL, '4\" 1500 Body', '', 'NOS', '212', '175', '5', '1', 'CAD-SPS-YST-0001', '21', 'CK/WO/25-26/-006', '0', '', NULL, '08-06-2025', '185500.00', NULL, NULL, NULL, NULL, NULL, '218890.00', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, 'CK/PUR/25-26/-009-2026', 'CK/PUR/25-26/-009170226', NULL),
(58, '15', '2026-02-17', 'workorder', 'CK/PUR/25-26/-010', '', NULL, '2025-05-12', NULL, 15, 'OM Industries', '8', 'Sri Ayyappa Engineering Works', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, '1970-01-01', '', NULL, NULL, '84803000', 'OMI 02', NULL, 'Retainer 3.0 Pattern', '', 'NOS', '1', '32000', '1', '1', '3.062269', '30', 'CK/WO/25-26/-009', '0', '', NULL, '30-05-2025', '72000.00', NULL, NULL, NULL, NULL, NULL, '84960.00', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, 'CK/PUR/25-26/-010-2026', 'CK/PUR/25-26/-010170226', NULL),
(57, '15', '2026-02-17', 'workorder', 'CK/PUR/25-26/-010', '', NULL, '2025-05-12', NULL, 15, 'OM Industries', '8', 'Sri Ayyappa Engineering Works', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, '1970-01-01', '', NULL, NULL, '84803000', 'OMI 01', NULL, 'Retainer 2.0  Pattern', '', 'NOS', '1', '40000', '1', '1', '2.067398', '29', 'CK/WO/25-26/-009', '0', '', NULL, '30-05-2025', '72000.00', NULL, NULL, NULL, NULL, NULL, '84960.00', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, 'CK/PUR/25-26/-010-2026', 'CK/PUR/25-26/-010170226', NULL),
(59, '16', '2026-02-17', 'workorder', 'CK/PUR/25-26/-011', 'PO 3742', NULL, '2025-05-16', NULL, 2, 'SIGMA POWER & ENERGY ENGINEERS', '8', 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, '1970-01-01', '', NULL, NULL, '73259930', 'SP02', NULL, 'Collector Casting', '', 'NOS', '28.7', '410', '4', '1', '3-SPG-9473', '31', 'CK/WO/25-26/-010', '4', '', NULL, '', '47068.00', NULL, NULL, NULL, NULL, NULL, '55540.24', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/PUR/25-26/-011-2026', 'CK/PUR/25-26/-011170226', NULL),
(61, '17', '2026-02-17', 'workorder', 'CK/PUR/25-26/-012', 'OM/PO/05-25-26/01', NULL, '2025-05-19', NULL, 15, 'OM Industries', '8', 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, '1970-01-01', '', NULL, NULL, '73259920', 'OMI 01', NULL, 'Retainer 2.0', '', 'NOS', '103', '165', '12', '1', '2.067398', '27', 'CK/WO/25-26/-009', '12', '', NULL, '', '236280.00', NULL, NULL, NULL, NULL, NULL, '278810.40', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/PUR/25-26/-012-2026', 'CK/PUR/25-26/-012170226', NULL),
(60, '17', '2026-02-17', 'workorder', 'CK/PUR/25-26/-012', 'OM/PO/05-25-26/01', NULL, '2025-05-19', NULL, 15, 'OM Industries', '8', 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, '1970-01-01', '', NULL, NULL, '73259920', 'OMI 02', NULL, 'Retainer 3.0', '', 'NOS', '49', '165', '4', '1', '3.062269', '28', 'CK/WO/25-26/-009', '4', '', NULL, '', '236280.00', NULL, NULL, NULL, NULL, NULL, '278810.40', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/PUR/25-26/-012-2026', 'CK/PUR/25-26/-012170226', NULL),
(63, '18', '2026-02-17', 'workorder', 'CK/PUR/25-26/-013', '3', NULL, '2026-05-20', NULL, 13, 'CKP LOI', '11', 'Sri Ayyappa Engineering Works', '4/348C,Kallipalayam Road, Chikarampalayam, Karamadai, Coimbatore, Tamil Nadu', NULL, '1970-01-01', '', NULL, NULL, '84803000', 'SP03', NULL, 'Collector Casting 3-SPG-8557', '1 Set Aluminium Pattern with Match Plate for Rework', 'NOS', '1', '9500', '1', '1', '3-SPG-8557', '36', 'CK/WO/25-26/-011', '1', '', NULL, '20-06-2025', '9500.00', NULL, NULL, NULL, NULL, NULL, '11210.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/PUR/25-26/-013-2026', 'CK/PUR/25-26/-013170226', NULL),
(64, '19', '2026-02-17', 'workorder', 'CK/PUR/25-26/-014', 'PO 3755', NULL, '2025-06-10', NULL, 2, 'SIGMA POWER & ENERGY ENGINEERS', '8', 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, '1970-01-01', '', NULL, NULL, '73259930', 'SP02', NULL, 'Collector Casting', '', 'NOS', '27.5', '420', '348', '1', '3-SPG-9473', '40', 'CK/WO/25-26/-012', '348', '', NULL, '', '4019400.00', NULL, NULL, NULL, NULL, NULL, '4742892.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/PUR/25-26/-014-2026', 'CK/PUR/25-26/-014170226', NULL),
(67, '20', '2026-02-17', 'workorder', 'CK/PUR/25-26/-015', 'PO-2526-0333', NULL, '2025-06-11', NULL, 9, 'STAAN BIO MED PVT LTD', '8', 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, '1970-01-01', '', NULL, NULL, '73259999', 'SBM09', NULL, 'Moving Block', '', 'NOS', '10', '155', '100', '1', 'ST-MSC-012 R1', '43', 'CK/WO/25-26/-013', '100', '', NULL, '', '496000.00', NULL, NULL, NULL, NULL, NULL, '585280.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/PUR/25-26/-015-2026', 'CK/PUR/25-26/-015170226', NULL),
(66, '20', '2026-02-17', 'workorder', 'CK/PUR/25-26/-015', 'PO-2526-0333', NULL, '2025-06-11', NULL, 9, 'STAAN BIO MED PVT LTD', '8', 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, '1970-01-01', '', NULL, NULL, '73259999', 'SBM02', NULL, 'NH Outer Box', '', 'NOS', '27', '155', '40', '1', 'ST-MSC-015', '41', 'CK/WO/25-26/-013', '40', '', NULL, '', '496000.00', NULL, NULL, NULL, NULL, NULL, '585280.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/PUR/25-26/-015-2026', 'CK/PUR/25-26/-015170226', NULL),
(65, '20', '2026-02-17', 'workorder', 'CK/PUR/25-26/-015', 'PO-2526-0333', NULL, '2025-06-11', NULL, 9, 'STAAN BIO MED PVT LTD', '8', 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, '1970-01-01', '', NULL, NULL, '73259999', 'SBM04', NULL, 'NH Inner Box', '', 'NOS', '28', '155', '40', '1', 'ST-MSC-013 R1', '42', 'CK/WO/25-26/-013', '40', '', NULL, '', '496000.00', NULL, NULL, NULL, NULL, NULL, '585280.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/PUR/25-26/-015-2026', 'CK/PUR/25-26/-015170226', NULL),
(68, '21', '2026-02-17', 'workorder', 'CK/PUR/25-26/-016', '3757', NULL, '2025-06-16', NULL, 2, 'SIGMA POWER & ENERGY ENGINEERS', '8', 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, '1970-01-01', '', NULL, NULL, '73259930', 'SP03', NULL, 'Collector Casting 8557', '', 'NOS', '30.5', '420', '4', '1', '3-SPG-8557 ', '44', 'CK/WO/25-26/-014', '4', '', NULL, '30-06-2025', '51240.00', NULL, NULL, NULL, NULL, NULL, '60463.20', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/PUR/25-26/-016-2026', 'CK/PUR/25-26/-016170226', NULL),
(69, '22', '2026-02-17', 'workorder', 'CK/PUR/25-26/-017', '4', NULL, '2025-06-23', NULL, 13, 'CKP LOI', '16', 'TryMy Website', '2nd Floor, SK Towers, Sathy Main Road, , Saravanampatti, Coimbatore, Tamil Nadu', NULL, '1970-01-01', '', NULL, NULL, '998898', 'WC1', NULL, 'Website Creation', 'Domain (1 year)         Hosting 1 GB(1 year)       6 Pages responsive Design        Watsapp Integration     Social Media Integration  Mobile Responsive Design', 'NOS', '1', '6000', '1', '1', '-', '45', 'CK/WO/25-26/-015', '1', '', NULL, '30-07-2025', '6000.00', NULL, NULL, NULL, NULL, NULL, '7080.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/PUR/25-26/-017-2026', 'CK/PUR/25-26/-017170226', NULL),
(45, '23', '2026-02-16', 'workorder', 'CK/PUR/25-26/-018', NULL, NULL, '2025-06-28', NULL, 2, 'SIGMA POWER & ENERGY ENGINEERS', '8', 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, '1970-01-01', '', NULL, NULL, '73259930', 'SP03', NULL, 'Collector Casting 8557', '', 'NOS', '30.5', '420', '4', '1', '3-SPG-8557 ', '44', 'CK/WO/25-26/-014', '4', '', NULL, '', '51240.00', NULL, NULL, NULL, NULL, NULL, '60463.20', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/PUR/25-26/-018-2026', 'CK/PUR/25-26/-018160226', NULL),
(49, '24', '2026-02-16', 'workorder', 'CK/PUR/25-26/-019', '3757', NULL, '2025-07-16', NULL, 2, 'SIGMA POWER & ENERGY ENGINEERS', '8', 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', NULL, '1970-01-01', '', NULL, NULL, '73259930', 'SP03', NULL, 'Collector Casting 8557', '', 'NOS', '30', '420', '120', '1', '3-SPG-8557 ', '44', 'CK/WO/25-26/-014', '120', '', NULL, '', '1512000.00', NULL, NULL, NULL, NULL, NULL, '1784160.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/PUR/25-26/-019-2026', 'CK/PUR/25-26/-019160226', NULL),
(42, '25', '2026-02-16', 'workorder', 'CK/PUR/25-26/-020', 'PO-SC-2526-097', NULL, '2025-07-17', NULL, 9, 'STAAN BIO MED PVT LTD', '8', 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0', NULL, '25-08-2025', NULL, NULL, '73259999', 'SBM03', '5', 'LH Outer Box', '', 'NOS', '24.4', '155', '40', '2', 'ST-MSC-016', '46', 'CK/WO/25-26/-016', '40', '', NULL, '18-08-2025', '310000.00', NULL, NULL, NULL, NULL, NULL, '365800.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/PUR/25-26/-020-2026', 'CK/PUR/25-26/-020160226', NULL),
(43, '25', '2026-02-16', 'workorder', 'CK/PUR/25-26/-020', 'PO-SC-2526-097', NULL, '2025-07-17', NULL, 9, 'STAAN BIO MED PVT LTD', '8', 'PREMIER ALLOYS', 'No 2, Goldwins,Avinashi Road, , Civil Aerodrome(po), Coimbatore, Tamil Nadu', '0', NULL, '25-08-2025', NULL, NULL, '73259999', 'SBM05', '6', 'LH Inner Box', '', 'NOS', '25.6', '155', '40', '2', 'ST-MSC-014-R1', '47', 'CK/WO/25-26/-016', '40', '', NULL, '25-08-2025', '310000.00', NULL, NULL, NULL, NULL, NULL, '365800.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'CK/PUR/25-26/-020-2026', 'CK/PUR/25-26/-020160226', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_person`
--

CREATE TABLE `tbl_person` (
  `id` bigint(20) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `dob` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `uom`
--

CREATE TABLE `uom` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `uom` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uom`
--

INSERT INTO `uom` (`id`, `date`, `uom`, `status`) VALUES
(1, '2025-06-20', 'KGS', 1),
(2, '2025-06-21', 'NOS', 1),
(3, '2025-06-23', 'PACK', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `main_menu` varchar(255) NOT NULL,
  `sub_menu` varchar(255) NOT NULL,
  `sub_menu_link` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ut_report`
--

CREATE TABLE `ut_report` (
  `id` int(11) NOT NULL,
  `date` varchar(100) NOT NULL,
  `ut_report_no` varchar(100) NOT NULL,
  `ut_date` varchar(100) NOT NULL,
  `customername` varchar(100) NOT NULL,
  `customerid` varchar(100) NOT NULL,
  `stage_of_test` varchar(100) NOT NULL,
  `test_date` varchar(100) NOT NULL,
  `surface_condition` varchar(100) NOT NULL,
  `calibration_block` varchar(100) NOT NULL,
  `equipment` varchar(100) NOT NULL,
  `couplant` varchar(100) NOT NULL,
  `probe` varchar(100) NOT NULL,
  `range_of_crt` varchar(100) NOT NULL,
  `frequency` varchar(100) NOT NULL,
  `gain` varchar(100) NOT NULL,
  `area_coverage` varchar(100) NOT NULL,
  `procedure_ref` varchar(100) NOT NULL,
  `acceptance_standard` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `itemid` varchar(100) NOT NULL,
  `drawing` varchar(100) NOT NULL,
  `grade` varchar(100) NOT NULL,
  `heat_no` varchar(100) NOT NULL,
  `ut_no` varchar(100) NOT NULL,
  `result` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vat_details`
--

CREATE TABLE `vat_details` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `taxtype` varchar(255) DEFAULT NULL,
  `taxname` varchar(255) DEFAULT NULL,
  `taxpercentage` varchar(255) DEFAULT NULL,
  `sgst` varchar(225) DEFAULT NULL,
  `cgst` varchar(225) DEFAULT NULL,
  `igst` varchar(225) DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vat_details`
--

INSERT INTO `vat_details` (`id`, `date`, `taxtype`, `taxname`, `taxpercentage`, `sgst`, `cgst`, `igst`, `status`) VALUES
(1, '2025-06-20', 'gst', '18', 'gst @ 18 %', '9', '9', '18', '1'),
(2, '2025-06-21', 'GSt', '12', 'GSt @ 12 %', '6', '6', '12', '1'),
(3, '2025-06-23', 'GST', '15', 'GST @ 15 %', '7.5', '7.5', '15', '1');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_details`
--

CREATE TABLE `vendor_details` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `vendorname` varchar(255) DEFAULT NULL,
  `phoneno` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `tinno` varchar(255) DEFAULT NULL,
  `cstno` varchar(255) DEFAULT NULL,
  `creditdays` varchar(255) DEFAULT NULL,
  `panno` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `eccno` varchar(255) DEFAULT NULL,
  `range` varchar(255) DEFAULT NULL,
  `division` varchar(255) DEFAULT NULL,
  `commissionerate` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `accountname` varchar(100) NOT NULL,
  `printname` varchar(100) NOT NULL,
  `statecode` varchar(255) NOT NULL,
  `gstno` varchar(255) NOT NULL,
  `adharno` varchar(255) NOT NULL,
  `bankname` varchar(100) NOT NULL,
  `accountno` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `voucherid` varchar(255) DEFAULT NULL,
  `cus_suppId` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `voucherdate` date DEFAULT NULL,
  `vouchertype` varchar(255) DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `paymentmode` varchar(255) DEFAULT NULL,
  `throughcheck` varchar(255) DEFAULT NULL,
  `chequeno` varchar(255) DEFAULT NULL,
  `chamount` varchar(255) DEFAULT NULL,
  `banktransfer` varchar(255) DEFAULT NULL,
  `bamount` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `paymentdetails` varchar(255) DEFAULT NULL,
  `transactionid` varchar(225) DEFAULT NULL,
  `chequedate` varchar(225) DEFAULT NULL,
  `overallamount` varchar(255) DEFAULT NULL,
  `voucheramount` varchar(255) DEFAULT NULL,
  `tdsamount` varchar(100) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `invoiceno` varchar(255) DEFAULT NULL,
  `purchaseno` varchar(255) DEFAULT NULL,
  `balance_amt` varchar(255) DEFAULT NULL,
  `otherBank` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `voucher_backup`
--

CREATE TABLE `voucher_backup` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `voucherid` varchar(255) DEFAULT NULL,
  `cus_suppId` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `voucherdate` date DEFAULT NULL,
  `vouchertype` varchar(255) DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `paymentmode` varchar(255) DEFAULT NULL,
  `throughcheck` varchar(255) DEFAULT NULL,
  `chequeno` varchar(255) DEFAULT NULL,
  `chamount` varchar(255) DEFAULT NULL,
  `banktransfer` varchar(255) DEFAULT NULL,
  `bamount` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `paymentdetails` varchar(255) DEFAULT NULL,
  `transactionid` varchar(225) DEFAULT NULL,
  `chequedate` varchar(225) DEFAULT NULL,
  `overallamount` varchar(255) DEFAULT NULL,
  `voucheramount` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `invoiceno` varchar(255) NOT NULL,
  `purchaseno` varchar(255) NOT NULL,
  `balance_amt` varchar(255) NOT NULL,
  `otherBank` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additem`
--
ALTER TABLE `additem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_staff`
--
ALTER TABLE `add_staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backup_details`
--
ALTER TABLE `backup_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backup_url`
--
ALTER TABLE `backup_url`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bed_details`
--
ALTER TABLE `bed_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cashbill_details`
--
ALTER TABLE `cashbill_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cashbill_reports`
--
ALTER TABLE `cashbill_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_bill`
--
ALTER TABLE `cash_bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collection_details`
--
ALTER TABLE `collection_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_logo`
--
ALTER TABLE `company_logo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customerpo_details`
--
ALTER TABLE `customerpo_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dcbill_details`
--
ALTER TABLE `dcbill_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dcbill_details_backup`
--
ALTER TABLE `dcbill_details_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dc_delivery`
--
ALTER TABLE `dc_delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dpt_report`
--
ALTER TABLE `dpt_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `einvoicetoken`
--
ALTER TABLE `einvoicetoken`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses_backup`
--
ALTER TABLE `expenses_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `headers`
--
ALTER TABLE `headers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hsnmaster`
--
ALTER TABLE `hsnmaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inspectionmaster`
--
ALTER TABLE `inspectionmaster`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `inspection_report`
--
ALTER TABLE `inspection_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_details_backup`
--
ALTER TABLE `invoice_details_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_party_statement`
--
ALTER TABLE `invoice_party_statement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_party_statement_backup`
--
ALTER TABLE `invoice_party_statement_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_reports`
--
ALTER TABLE `invoice_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inward_delivery`
--
ALTER TABLE `inward_delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inward_details`
--
ALTER TABLE `inward_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inward_details_backup`
--
ALTER TABLE `inward_details_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobinward_data`
--
ALTER TABLE `jobinward_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobinward_details`
--
ALTER TABLE `jobinward_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobworkdc_delivery`
--
ALTER TABLE `jobworkdc_delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobworkdc_delivery_backup`
--
ALTER TABLE `jobworkdc_delivery_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobworkdc_details`
--
ALTER TABLE `jobworkdc_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobworkdc_details_backup`
--
ALTER TABLE `jobworkdc_details_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_data`
--
ALTER TABLE `job_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_details`
--
ALTER TABLE `job_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materialdc_delivery`
--
ALTER TABLE `materialdc_delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materialdc_details`
--
ALTER TABLE `materialdc_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materialdc_details_backup`
--
ALTER TABLE `materialdc_details_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mpt_report`
--
ALTER TABLE `mpt_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mtc_report`
--
ALTER TABLE `mtc_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po_party_statements`
--
ALTER TABLE `po_party_statements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po_party_statements_backup`
--
ALTER TABLE `po_party_statements_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preference_details`
--
ALTER TABLE `preference_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preference_settings`
--
ALTER TABLE `preference_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proforma_invoice_details`
--
ALTER TABLE `proforma_invoice_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proforma_invoice_details_backup`
--
ALTER TABLE `proforma_invoice_details_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proforma_invoice_reports`
--
ALTER TABLE `proforma_invoice_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proinvoice_party_statement`
--
ALTER TABLE `proinvoice_party_statement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaseorder_details`
--
ALTER TABLE `purchaseorder_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaseorder_details_backup`
--
ALTER TABLE `purchaseorder_details_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaseorder_reports`
--
ALTER TABLE `purchaseorder_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_collection`
--
ALTER TABLE `purchase_collection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_details_backup`
--
ALTER TABLE `purchase_details_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_reports`
--
ALTER TABLE `purchase_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation_details`
--
ALTER TABLE `quotation_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation_details_backup`
--
ALTER TABLE `quotation_details_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_return`
--
ALTER TABLE `sales_return`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_return_backup`
--
ALTER TABLE `sales_return_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statecode`
--
ALTER TABLE `statecode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_reports`
--
ALTER TABLE `stock_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sup_purchaseorder_details`
--
ALTER TABLE `sup_purchaseorder_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sup_purchaseorder_details_backup`
--
ALTER TABLE `sup_purchaseorder_details_backup`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `sup_purchaseorder_reports`
--
ALTER TABLE `sup_purchaseorder_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_person`
--
ALTER TABLE `tbl_person`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uom`
--
ALTER TABLE `uom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ut_report`
--
ALTER TABLE `ut_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vat_details`
--
ALTER TABLE `vat_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_details`
--
ALTER TABLE `vendor_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voucher_backup`
--
ALTER TABLE `voucher_backup`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additem`
--
ALTER TABLE `additem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `add_staff`
--
ALTER TABLE `add_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `backup_details`
--
ALTER TABLE `backup_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `backup_url`
--
ALTER TABLE `backup_url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bed_details`
--
ALTER TABLE `bed_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cashbill_details`
--
ALTER TABLE `cashbill_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cashbill_reports`
--
ALTER TABLE `cashbill_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cash_bill`
--
ALTER TABLE `cash_bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `collection_details`
--
ALTER TABLE `collection_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_logo`
--
ALTER TABLE `company_logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customerpo_details`
--
ALTER TABLE `customerpo_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `dcbill_details`
--
ALTER TABLE `dcbill_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dcbill_details_backup`
--
ALTER TABLE `dcbill_details_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dc_delivery`
--
ALTER TABLE `dc_delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dpt_report`
--
ALTER TABLE `dpt_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `einvoicetoken`
--
ALTER TABLE `einvoicetoken`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses_backup`
--
ALTER TABLE `expenses_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `headers`
--
ALTER TABLE `headers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hsnmaster`
--
ALTER TABLE `hsnmaster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inspectionmaster`
--
ALTER TABLE `inspectionmaster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `inspection_report`
--
ALTER TABLE `inspection_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `invoice_details_backup`
--
ALTER TABLE `invoice_details_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_party_statement`
--
ALTER TABLE `invoice_party_statement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `invoice_party_statement_backup`
--
ALTER TABLE `invoice_party_statement_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_reports`
--
ALTER TABLE `invoice_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `inward_delivery`
--
ALTER TABLE `inward_delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inward_details`
--
ALTER TABLE `inward_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inward_details_backup`
--
ALTER TABLE `inward_details_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobinward_data`
--
ALTER TABLE `jobinward_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobinward_details`
--
ALTER TABLE `jobinward_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobworkdc_delivery`
--
ALTER TABLE `jobworkdc_delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobworkdc_delivery_backup`
--
ALTER TABLE `jobworkdc_delivery_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobworkdc_details`
--
ALTER TABLE `jobworkdc_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobworkdc_details_backup`
--
ALTER TABLE `jobworkdc_details_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_data`
--
ALTER TABLE `job_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_details`
--
ALTER TABLE `job_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `materialdc_delivery`
--
ALTER TABLE `materialdc_delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materialdc_details`
--
ALTER TABLE `materialdc_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materialdc_details_backup`
--
ALTER TABLE `materialdc_details_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mpt_report`
--
ALTER TABLE `mpt_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mtc_report`
--
ALTER TABLE `mtc_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `po_party_statements`
--
ALTER TABLE `po_party_statements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `po_party_statements_backup`
--
ALTER TABLE `po_party_statements_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `preference_details`
--
ALTER TABLE `preference_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `preference_settings`
--
ALTER TABLE `preference_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `proforma_invoice_details`
--
ALTER TABLE `proforma_invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proforma_invoice_details_backup`
--
ALTER TABLE `proforma_invoice_details_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proforma_invoice_reports`
--
ALTER TABLE `proforma_invoice_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proinvoice_party_statement`
--
ALTER TABLE `proinvoice_party_statement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchaseorder_details`
--
ALTER TABLE `purchaseorder_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `purchaseorder_details_backup`
--
ALTER TABLE `purchaseorder_details_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchaseorder_reports`
--
ALTER TABLE `purchaseorder_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `purchase_collection`
--
ALTER TABLE `purchase_collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `purchase_details_backup`
--
ALTER TABLE `purchase_details_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_reports`
--
ALTER TABLE `purchase_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `quotation_details`
--
ALTER TABLE `quotation_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_details_backup`
--
ALTER TABLE `quotation_details_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_return`
--
ALTER TABLE `sales_return`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_return_backup`
--
ALTER TABLE `sales_return_backup`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statecode`
--
ALTER TABLE `statecode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `stock_reports`
--
ALTER TABLE `stock_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `sup_purchaseorder_details`
--
ALTER TABLE `sup_purchaseorder_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `sup_purchaseorder_details_backup`
--
ALTER TABLE `sup_purchaseorder_details_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sup_purchaseorder_reports`
--
ALTER TABLE `sup_purchaseorder_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `tbl_person`
--
ALTER TABLE `tbl_person`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uom`
--
ALTER TABLE `uom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ut_report`
--
ALTER TABLE `ut_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vat_details`
--
ALTER TABLE `vat_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendor_details`
--
ALTER TABLE `vendor_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `voucher_backup`
--
ALTER TABLE `voucher_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
