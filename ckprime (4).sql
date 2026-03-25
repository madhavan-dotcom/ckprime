-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2025 at 07:19 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ckprime`
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
  `itemname` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `additem`
--

INSERT INTO `additem` (`id`, `date`, `uom`, `itemcode`, `itemname`, `patterncode`, `drawingno`, `pattern_material`, `casting_weight`, `liquid_weight`, `yield`, `price`, `taxtype`, `sgst`, `cgst`, `igst`, `status`, `priceType`, `itemtype`, `purchaseNo`) VALUES
(1, '2025-08-11', '1', '002', 'Coal Nozzle', '1001', '001', 'Yield', '250', '100', '250', '15000', '1', '9', '9', '18', '1', 'Exclusive', '', NULL);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `lastupdate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `backup_details`
--

CREATE TABLE `backup_details` (
  `id` int(11) NOT NULL,
  `file_name` longtext DEFAULT NULL,
  `date_created` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `backup_details`
--

INSERT INTO `backup_details` (`id`, `file_name`, `date_created`) VALUES
(1, 'backup-on-2025-06-21-09-29-14.zip', '2025-06-21'),
(2, 'backup-on-2025-06-23-10-32-40.zip', '2025-06-23'),
(3, 'backup-on-2025-06-24-12-15-22.zip', '2025-06-24'),
(4, 'backup-on-2025-06-25-15-18-12.zip', '2025-06-25'),
(5, 'backup-on-2025-06-28-11-57-40.zip', '2025-06-28'),
(6, 'backup-on-2025-07-01-15-17-26.zip', '2025-07-01'),
(7, 'backup-on-2025-07-02-11-36-22.zip', '2025-07-02'),
(8, 'backup-on-2025-07-03-12-06-54.zip', '2025-07-03'),
(9, 'backup-on-2025-07-11-17-20-54.zip', '2025-07-11'),
(10, 'backup-on-2025-07-13-10-28-41.zip', '2025-07-13'),
(11, 'backup-on-2025-07-14-16-02-07.zip', '2025-07-14'),
(12, 'backup-on-2025-07-17-12-20-39.zip', '2025-07-17'),
(13, 'backup-on-2025-07-19-12-34-18.zip', '2025-07-19'),
(14, 'backup-on-2025-07-20-12-06-32.zip', '2025-07-20'),
(15, 'backup-on-2025-07-22-15-22-23.zip', '2025-07-22'),
(16, 'backup-on-2025-07-23-12-24-23.zip', '2025-07-23'),
(17, 'backup-on-2025-07-24-11-53-24.zip', '2025-07-24'),
(18, 'backup-on-2025-07-25-15-20-00.zip', '2025-07-25'),
(19, 'backup-on-2025-08-04-10-18-51.zip', '2025-08-04'),
(20, 'backup-on-2025-08-11-14-38-18.zip', '2025-08-11'),
(21, 'backup-on-2025-08-13-18-55-03.zip', '2025-08-13'),
(22, 'backup-on-2025-08-14-11-06-34.zip', '2025-08-14'),
(23, 'backup-on-2025-08-18-12-13-01.zip', '2025-08-18'),
(24, 'backup-on-2025-08-19-15-31-40.zip', '2025-08-19'),
(25, 'backup-on-2025-08-21-10-24-45.zip', '2025-08-21'),
(26, 'backup-on-2025-08-23-11-25-14.zip', '2025-08-23'),
(27, 'backup-on-2025-08-25-18-08-57.zip', '2025-08-25'),
(28, 'backup-on-2025-08-26-10-43-44.zip', '2025-08-26'),
(29, 'backup-on-2025-08-28-13-20-40.zip', '2025-08-28'),
(30, 'backup-on-2025-09-01-11-18-03.zip', '2025-09-01'),
(31, 'backup-on-2025-09-02-11-00-26.zip', '2025-09-02'),
(32, 'backup-on-2025-09-03-09-53-12.zip', '2025-09-03'),
(33, 'backup-on-2025-09-04-18-16-21.zip', '2025-09-04'),
(34, 'backup-on-2025-09-05-10-48-29.zip', '2025-09-05'),
(35, 'backup-on-2025-09-06-11-07-45.zip', '2025-09-06'),
(36, 'backup-on-2025-09-11-16-39-38.zip', '2025-09-11'),
(37, 'backup-on-2025-09-12-10-52-25.zip', '2025-09-12'),
(38, 'backup-on-2025-09-18-11-32-59.zip', '2025-09-18'),
(39, 'backup-on-2025-09-24-14-38-55.zip', '2025-09-24'),
(40, 'backup-on-2025-09-25-11-16-25.zip', '2025-09-25'),
(41, 'backup-on-2025-10-06-15-54-49.zip', '2025-10-06'),
(42, 'backup-on-2025-10-08-12-15-16.zip', '2025-10-08');

-- --------------------------------------------------------

--
-- Table structure for table `backup_url`
--

CREATE TABLE `backup_url` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bed_details`
--

CREATE TABLE `bed_details` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `bed` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `typesgst` longtext DEFAULT NULL,
  `typecgst` longtext DEFAULT NULL,
  `typeigst` longtext DEFAULT NULL,
  `hsnno` longtext DEFAULT NULL,
  `itemname` longtext DEFAULT NULL,
  `uom` longtext DEFAULT NULL,
  `rate` longtext DEFAULT NULL,
  `qty` longtext DEFAULT NULL,
  `amount` longtext DEFAULT NULL,
  `discount` longtext DEFAULT NULL,
  `discountBy` varchar(255) NOT NULL,
  `discountamount` longtext DEFAULT NULL,
  `taxableamount` longtext DEFAULT NULL,
  `sgst` longtext DEFAULT NULL,
  `sgstamount` longtext DEFAULT NULL,
  `cgst` longtext DEFAULT NULL,
  `cgstamount` longtext DEFAULT NULL,
  `igst` longtext DEFAULT NULL,
  `igstamount` longtext DEFAULT NULL,
  `total` longtext DEFAULT NULL,
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
  `return_status` longtext DEFAULT NULL,
  `grandtotal` varchar(225) DEFAULT NULL,
  `invoicenodate` varchar(225) DEFAULT NULL,
  `invoicenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL,
  `systemDate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `dcno` longtext DEFAULT NULL,
  `customername` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `deliveryat` varchar(225) DEFAULT NULL,
  `transportmode` varchar(255) DEFAULT NULL,
  `vehicleno` varchar(225) DEFAULT NULL,
  `billtype` varchar(255) DEFAULT NULL,
  `gsttype` varchar(225) DEFAULT NULL,
  `typesgst` longtext DEFAULT NULL,
  `typecgst` longtext DEFAULT NULL,
  `typeigst` longtext DEFAULT NULL,
  `dcnos` longtext DEFAULT NULL,
  `insertid` varchar(225) DEFAULT NULL,
  `deliveryid` longtext DEFAULT NULL,
  `hsnno` longtext DEFAULT NULL,
  `itemname` longtext DEFAULT NULL,
  `uom` longtext DEFAULT NULL,
  `rate` longtext DEFAULT NULL,
  `qty` longtext DEFAULT NULL,
  `amount` longtext DEFAULT NULL,
  `discount` longtext DEFAULT NULL,
  `discountamount` longtext DEFAULT NULL,
  `taxableamount` longtext DEFAULT NULL,
  `sgst` longtext DEFAULT NULL,
  `sgstamount` longtext DEFAULT NULL,
  `cgst` longtext DEFAULT NULL,
  `cgstamount` longtext DEFAULT NULL,
  `igst` longtext DEFAULT NULL,
  `igstamount` longtext DEFAULT NULL,
  `total` longtext DEFAULT NULL,
  `subtotal` varchar(225) DEFAULT NULL,
  `freightcharges` varchar(225) DEFAULT NULL,
  `packingcharges` varchar(225) DEFAULT NULL,
  `othercharges` varchar(225) DEFAULT NULL,
  `return_status` longtext DEFAULT NULL,
  `grandtotal` varchar(225) DEFAULT NULL,
  `invoicenodate` varchar(225) DEFAULT NULL,
  `invoicenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `category` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `collection_details`
--

INSERT INTO `collection_details` (`id`, `date`, `invoicedate`, `receiptdate`, `throughcheck`, `receiptno`, `customername`, `mobileno`, `totalamount`, `purpose`, `alreadypaid`, `alreadybalance`, `chamount`, `banktransfer`, `bankamount`, `chequeno`, `paymentmode`, `amount`, `invoiceno`, `balance`, `status`, `paymentdetails`, `overallamount`, `receiptamt`, `invoiceamt`, `payment`, `paid`, `invoicenoyear`, `invoicenodate`, `invoiceid`) VALUES
(1, '2025-06-20', NULL, '2025-06-20', NULL, 'V/25-26/-001', 'jack', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'Cash', NULL, NULL, NULL, NULL, '800', NULL, NULL, NULL),
(2, '2025-06-20', NULL, '2025-06-20', NULL, 'V/25-26/-002', 'jack', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'Cheque INDIAN OVERSEAS 484654355454', NULL, NULL, NULL, NULL, '8000', NULL, NULL, NULL),
(3, '2025-06-21', NULL, '2025-06-21', NULL, 'V/25-26/-002', 'SIGMA POWER & ENERGY ENGINEERS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'Cash', NULL, NULL, NULL, NULL, '8800', NULL, NULL, NULL),
(4, '2025-06-24', NULL, '2025-06-24', NULL, 'V/25-26/-004', 'IT Solution', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'Cash', NULL, NULL, NULL, NULL, '500', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_logo`
--

CREATE TABLE `company_logo` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`id`, `date`, `type`, `name`, `phoneno`, `email`, `address1`, `address2`, `contactperson`, `state`, `city`, `tinno`, `cstno`, `creditdays`, `openingbal`, `old_openingBal`, `salesamount`, `paidamount`, `balanceamount`, `returnamount`, `panno`, `location`, `pincode`, `eccno`, `range`, `division`, `commissionerate`, `remarks`, `status`, `accountname`, `printname`, `statecode`, `gstno`, `adharno`, `bankname`, `accountno`, `accountpay`, `chequeno`, `last_modified`) VALUES
(1, '2025-06-20', 'Intra customer', 'jack', '7806876370', 'jack@gmail.com', 'gandhipuram', 'singanallur', 'maddy', 'Tamil Nadu', 'karaikudi', '', '', NULL, '0.00', NULL, '909970', '300', '2903070', NULL, '', NULL, '654616', NULL, NULL, NULL, NULL, NULL, '1', '', '', '33', '', '', '', '', '', '', '2025-06-20'),
(2, '2025-07-17', 'Intra customer', 'SIGMA POWER & ENERGY ENGINEERS', '7339666782', 'sigmapower@sigmapower.in', 'PLOT No.E-5 SIDCO INDUSTRIES ESTATE', 'Phase II, VALAVANTHAN KOTTAI, THUVAKUDI', 'NANDHINI.P', 'Tamil Nadu', 'TRICHY', '', '', NULL, '0.00', NULL, '-36000', '8800', '227200', NULL, '', NULL, '620015', NULL, NULL, NULL, NULL, NULL, '1', '', '', '33', '33ABRFS2547Q1ZD', '', '', '', '', '', '2025-07-17'),
(3, '2025-06-21', 'Intra supplier', 'CK PRIME ALLOYS', '', '', 'ANNUR ROAD', 'KARUMATTAMPATTY', '', 'Tamil Nadu', 'COIMBATORE', '', '', NULL, '0.00', NULL, '2885100', '2400', '2174700', NULL, '', NULL, '641659', NULL, NULL, NULL, NULL, NULL, '1', '', '', '33', '', '', '', '', '', '', '2025-06-21'),
(4, '2025-06-23', 'Intra customer', 'IT Solution', '09360296512', '', 'Hoysala nagar, Ramamurthy signal', 'Kasthuri nagar', 'Pradeepa D', 'Karnataka', 'Bangalore', '', '', NULL, '0.00', NULL, '2366.7', '500', '1866.7', NULL, '', NULL, '560016', NULL, NULL, NULL, NULL, NULL, '1', '', '', '29', '', '', '', '', '', '', '2025-06-23'),
(5, '2025-06-24', 'Intra supplier', 'Gateway', '9500995841', 'lithikutti81@gmail.com', 'Kasthuri nagar, Sri lakshmi apartement', 'Bangalore', 'Lithi', 'Karnataka', 'Bangalore', '', '', NULL, '0.00', NULL, '1368.5', '500', '868.5', '995.50', '', NULL, '560016', NULL, NULL, NULL, NULL, NULL, '1', '', '', '29', '', '', '', '', '', '', '2025-06-24'),
(6, '2025-06-25', 'Intra customer', 'Tech AU', '1234567890', 'pradee@gmail.com', 'Hoysala nagar, Ramamurthy signal', 'Avinashi Road, Hopes College', 'Pradeepa D', 'Tamil Nadu', 'Bangalore', '', '', NULL, '0.00', NULL, NULL, NULL, '0.00', NULL, '', NULL, '560016', NULL, NULL, NULL, NULL, NULL, '1', '', '', '33', '', '', '', '', '', '', '2025-06-25'),
(7, '2025-07-17', 'Intra customer', 'M/S CADALAN OFFSHORE PRIVATE LIMITED', '7708330192', 'sales@cadalan.com.sg', 'No:54 SRI VIGNESHWAR ILLAM', 'MGR NAGAR, GOLDWINS', 'SELVARAJ', 'Tamil Nadu', 'Coimbatore', '', '', NULL, '0.00', NULL, '7109500', NULL, '14189500', NULL, '', NULL, '641014', NULL, NULL, NULL, NULL, NULL, '1', '', '', '33', '33AAICC6141M1ZK', '', '', '', '', '', '2025-07-17');

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
  `inwardno` longtext DEFAULT NULL,
  `customerdcno` longtext DEFAULT NULL,
  `customerdcdate` longtext DEFAULT NULL,
  `itemname` longtext DEFAULT NULL,
  `itemid` varchar(100) NOT NULL,
  `heatno` varchar(100) DEFAULT NULL,
  `item_desc` text NOT NULL,
  `qty` longtext DEFAULT NULL,
  `remarks` longtext DEFAULT NULL,
  `hsnno` longtext DEFAULT NULL,
  `itemcode` varchar(255) DEFAULT NULL,
  `uom` longtext DEFAULT NULL,
  `grade` varchar(100) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `dcnoyear` varchar(225) DEFAULT NULL,
  `dcnodate` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `delete_status` int(11) DEFAULT NULL,
  `billtype` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dcbill_details`
--

INSERT INTO `dcbill_details` (`id`, `date`, `dctype`, `dcno`, `dcdate`, `customerId`, `cusname`, `dispatchthrough`, `time`, `purpose`, `process`, `remarkss`, `approximate_value`, `address`, `inwardno`, `customerdcno`, `customerdcdate`, `itemname`, `itemid`, `heatno`, `item_desc`, `qty`, `remarks`, `hsnno`, `itemcode`, `uom`, `grade`, `weight`, `dcnoyear`, `dcnodate`, `status`, `delete_status`, `billtype`) VALUES
(2, '2025-06-20', 'Against Inward', 'SDC/25-26/-001', '2025-06-20', 1, 'jack', '', '07:43:PM', '', '', '', '2000', 'gandhipuram, singanallur', 'I001', NULL, NULL, '1080-rotor||1080-motor||1080-rotor', '1||2||1', '', '||||', '50||50||50', '50||50||50', '0001||0002||0001', NULL, 'KGS||KGS||KGS', '', '', 'SDC/25-26/-001-25', 'SDC/25-26/-001200625', 1, 1, ''),
(3, '2025-06-20', 'Direct DC', 'SDC/25-26/-002', '2025-06-20', 1, 'jack', '', '07:44:PM', '', '', '', '2000', 'gandhipuram, singanallur', NULL, NULL, NULL, '1080-rotor||1080-motor', '1||2', '', '||', '100||100', '||', '0001||0002', NULL, 'KGS||KGS', '', '', 'SDC/25-26/-002-25', 'SDC/25-26/-002200625', 1, 1, ''),
(4, '2025-06-20', 'Direct DC', 'SDC/25-26/-003', '2025-06-20', 1, 'jack', '', '08:01:PM', '', '', '', '2000', 'gandhipuram, singanallur', NULL, NULL, NULL, '1080-rotor||1080-motor', '1||2', '', '||', '100||100', '||', '0001||0002', NULL, 'KGS||KGS', '', '', 'SDC/25-26/-003-25', 'SDC/25-26/-003200625', 1, 1, ''),
(5, '2025-06-20', 'Against Inward', 'SDC/25-26/-004', '2025-06-20', 1, 'jack', '', '08:11:PM', '', '', '', '2000', 'gandhipuram, singanallur', 'I002', NULL, NULL, '1080-rotor||1080-motor', '1||2', '', '||', '50||50', '||', '0001||0002', NULL, 'KGS||KGS', '', '', 'SDC/25-26/-004-25', 'SDC/25-26/-004200625', 1, 1, ''),
(6, '2025-06-21', 'Against Inward', 'SDC/25-26/-005', '2025-06-21', 2, 'SIGMA POWER & ENERGY ENGINEERS', '', '09:50:AM', '', '', '', '', 'e-5 SIDCO INDUSTRIES ESTATE, THUVAKUDI', 'I003', NULL, NULL, 'EH OUTER BOX', '3', '', '', '50', '', '123456', NULL, 'KGS', '', '', 'SDC/25-26/-005-25', 'SDC/25-26/-005210625', 1, 1, ''),
(7, '2025-06-25', 'Direct DC', 'SDC/25-26/-006', '2025-06-25', 4, 'IT Solution', '', '10:36:PM', '', '', 'Urgent Item', '', 'Hoysala nagar, Ramamurthy signal, Kasthuri nagar', NULL, NULL, NULL, 'Stationary things', '4', '', '', '2', 'Urgent Item', '00002', '15015', 'PACK', '', '', 'SDC/25-26/-006-25', 'SDC/25-26/-006250625', 1, 1, ''),
(8, '2025-07-23', 'Direct DC', 'SDC/25-26/-007', '2025-07-23', 1, 'jack', '001', '01:02:PM', '', '', '', '', 'gandhipuram, singanallur', '', NULL, NULL, '1080 Rotor||1080 Stator', '7||8', '1001||1002', '||', '10||10', 'qwerty||qwerty', '123456||123456', '001||002', 'KGS||KGS', 'MSS||MSS', '', 'SDC/25-26/-007-25', 'SDC/25-26/-007230725', 1, 1, ''),
(9, '2025-07-23', 'Direct DC', 'SDC/25-26/-007', '2025-07-23', 1, 'jack', '001', '01:02:PM', '', '', '', '', 'gandhipuram, singanallur', '', NULL, NULL, '1080 Rotor||1080 Stator', '7||8', '1001||1002', '||', '10||10', 'qwerty||qwerty', '123456||123456', '001||002', 'KGS||KGS', 'MSS||MSS', '', 'SDC/25-26/-007-25', 'SDC/25-26/-007230725', 1, 1, ''),
(10, '2025-07-23', 'Direct DC', 'SDC/25-26/-007', '2025-07-23', 1, 'jack', '001', '01:02:PM', '', '', '', '', 'gandhipuram, singanallur', '', NULL, NULL, '1080 Rotor||1080 Stator', '7||8', '1001||1002', '||', '10||10', 'qwerty||qwerty', '123456||123456', '001||002', 'KGS||KGS', 'MSS||MSS', '', 'SDC/25-26/-007-25', 'SDC/25-26/-007230725', 1, 1, ''),
(11, '2025-07-23', 'Direct DC', 'SDC/25-26/-007', '2025-07-23', 1, 'jack', '001', '03:25:PM', '', '', '', '10000', 'gandhipuram, singanallur', '', '', '', '1080 Rotor||1080 Stator||1080 Stator', '7||8||8', '1001||1002||', '||||', '10||10||10', 'qwerty||qwerty||qqq', '123456||123456||123456', '001||002||002', 'KGS||KGS||KGS', 'MSS||MSS||MSS', '', 'SDC/25-26/-007-25', 'SDC/25-26/-007230725', 1, 1, ''),
(12, '2025-07-23', 'Against Inward', 'SDC/25-26/-008', '2025-07-23', 1, 'jack', '', '04:23:PM', '', '', '', '250000', 'gandhipuram, singanallur', 'I006', '', '', '1080 Rotor||1080 Stator||1/2', '7||8||5', '1001||1002||1003', '||||', '50||50||2', 'qwerty||qwerty||qwerty', '123456||123456||73259930', '', 'KGS||KGS||KGS', 'MSS||MSS||', '', 'SDC/25-26/-008-25', 'SDC/25-26/-008230725', 1, 1, ''),
(13, '2025-07-23', 'Against Inward', 'SDC/25-26/-009', '2025-07-23', 1, 'jack', '', '04:42:PM', '', '', '', '', 'gandhipuram, singanallur', 'I006', '', '', '1080 Stator||1080 Rotor||1/2\" CL 600 Body', '8||7||5', '1002||1001||1003', '||||', '10||10||1', 'qwerty||qwerty||qwerty', '123456||123456||73259930', '', 'KGS||KGS||KGS', 'MSS||MSS||', '', 'SDC/25-26/-009-25', 'SDC/25-26/-009230725', 1, 1, ''),
(14, '2025-08-04', 'Direct DC', 'SDC/25-26/-010', '2025-08-04', 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', '', '11:51:AM', '', '', '', '10000', 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS', '', NULL, NULL, 'Coal Nozzle', '6', '200', '', '10', '-', '84803000', '0', 'NOS', 'MSS', '', 'SDC/25-26/-010-25', 'SDC/25-26/-010040825', 1, 1, ''),
(15, '2025-09-18', 'Direct DC', 'SDC/25-26/-011', '2025-09-18', 1, 'jack', '', '12:39:PM', '', '', NULL, '', 'gandhipuram, singanallur', '', NULL, NULL, 'Coal Nozzle||Coal Nozzle', '1||1', NULL, '-||-', '10||10', '-||-', '123456||123456', '002||002', 'KGS||KGS', '1||1', '', 'SDC/25-26/-011-25', 'SDC/25-26/-011180925', 1, 1, ''),
(16, '2025-09-18', 'Direct DC', 'SDC/25-26/-011', '2025-09-18', 1, 'jack', '', '12:39:PM', '', '', NULL, '', 'gandhipuram, singanallur', '', NULL, NULL, 'Coal Nozzle||Coal Nozzle', '1||1', NULL, '-||-', '10||10', '-||-', '123456||123456', '002||002', 'KGS||KGS', '1||1', '', 'SDC/25-26/-011-25', 'SDC/25-26/-011180925', 1, 1, ''),
(17, '2025-09-18', 'Direct DC', 'SDC/25-26/-012', '2025-09-18', 1, 'jack', '', '02:39:PM', '', '', NULL, '50000', 'gandhipuram, singanallur', '', '', '', 'Coal Nozzle||Coal Nozzle||Coal Nozzle', '1||1||', NULL, '-||-||-', '50||50||50', '-||-||-', '123456||123456||123456', '002||002||002', 'KGS||KGS||KGS', '1||1||1', '100||150||200', 'SDC/25-26/-012-25', 'SDC/25-26/-012180925', 1, 1, '');

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
  `inwardno` longtext DEFAULT NULL,
  `customerdcno` longtext DEFAULT NULL,
  `customerdcdate` longtext DEFAULT NULL,
  `itemname` longtext DEFAULT NULL,
  `itemid` varchar(100) NOT NULL,
  `heatno` varchar(100) NOT NULL,
  `item_desc` text NOT NULL,
  `qty` longtext DEFAULT NULL,
  `remarks` longtext DEFAULT NULL,
  `hsnno` longtext DEFAULT NULL,
  `itemcode` varchar(255) DEFAULT NULL,
  `uom` longtext DEFAULT NULL,
  `grade` varchar(100) NOT NULL,
  `dcnoyear` varchar(225) DEFAULT NULL,
  `dcnodate` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `delete_status` int(11) DEFAULT NULL,
  `billtype` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `inwardno` longtext DEFAULT NULL,
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
  `weight` varchar(100) NOT NULL,
  `remarkss` varchar(255) DEFAULT NULL,
  `dcnoyear` varchar(225) NOT NULL,
  `dcnodate` varchar(225) NOT NULL,
  `status` int(11) NOT NULL,
  `dc_status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dc_delivery`
--

INSERT INTO `dc_delivery` (`id`, `date`, `insertid`, `inwardid`, `dctype`, `dcno`, `dcdate`, `customerId`, `cusname`, `dispatchthrough`, `address`, `inwardno`, `customerdcno`, `customerdcdate`, `itemname`, `itemid`, `heatno`, `item_desc`, `qty`, `balanceqty`, `remarks`, `hsnno`, `itemcode`, `uom`, `grade`, `weight`, `remarkss`, `dcnoyear`, `dcnodate`, `status`, `dc_status`) VALUES
(4, '2025-06-20', 2, 9, 'Against Inward', 'SDC/25-26/-001', '2025-06-20', 1, 'jack', '', 'gandhipuram, singanallur', NULL, NULL, NULL, '1080-rotor', '1', '', '', '50', '50', '50', '0001', NULL, 'KGS', '', '', '', 'SDC/25-26/-001-25', 'SDC/25-26/-001200625', 1, 1),
(5, '2025-06-20', 2, 10, 'Against Inward', 'SDC/25-26/-001', '2025-06-20', 1, 'jack', '', 'gandhipuram, singanallur', NULL, NULL, NULL, '1080-motor', '2', '', '', '50', '50', '50', '0002', NULL, 'KGS', '', '', '', 'SDC/25-26/-001-25', 'SDC/25-26/-001200625', 1, 1),
(6, '2025-06-20', 2, 11, 'Against Inward', 'SDC/25-26/-001', '2025-06-20', 1, 'jack', '', 'gandhipuram, singanallur', NULL, NULL, NULL, '1080-rotor', '1', '', '', '50', '50', '50', '0001', NULL, 'KGS', '', '', '', 'SDC/25-26/-001-25', 'SDC/25-26/-001200625', 1, 1),
(7, '2025-06-20', 3, NULL, 'Direct DC', 'SDC/25-26/-002', '2025-06-20', 1, 'jack', '', 'gandhipuram, singanallur', NULL, NULL, NULL, '1080-rotor', '1', '', '', '100', '50', '', '0001', NULL, 'KGS', '', '', '', 'SDC/25-26/-002-25', 'SDC/25-26/-002200625', 1, 1),
(8, '2025-06-20', 3, NULL, 'Direct DC', 'SDC/25-26/-002', '2025-06-20', 1, 'jack', '', 'gandhipuram, singanallur', NULL, NULL, NULL, '1080-motor', '2', '', '', '100', '50', '', '0002', NULL, 'KGS', '', '', '', 'SDC/25-26/-002-25', 'SDC/25-26/-002200625', 1, 1),
(9, '2025-06-20', 4, NULL, 'Direct DC', 'SDC/25-26/-003', '2025-06-20', 1, 'jack', '', 'gandhipuram, singanallur', NULL, NULL, NULL, '1080-rotor', '1', '', '', '100', '100', '', '0001', NULL, 'KGS', '', '', '', 'SDC/25-26/-003-25', 'SDC/25-26/-003200625', 1, 1),
(10, '2025-06-20', 4, NULL, 'Direct DC', 'SDC/25-26/-003', '2025-06-20', 1, 'jack', '', 'gandhipuram, singanallur', NULL, NULL, NULL, '1080-motor', '2', '', '', '100', '100', '', '0002', NULL, 'KGS', '', '', '', 'SDC/25-26/-003-25', 'SDC/25-26/-003200625', 1, 1),
(11, '2025-06-20', 5, 12, 'Against Inward', 'SDC/25-26/-004', '2025-06-20', 1, 'jack', '', 'gandhipuram, singanallur', 'I002', NULL, NULL, '1080-rotor', '1', '', '', '50', '25', '', '0001', NULL, 'KGS', '', '', '', 'SDC/25-26/-004-25', 'SDC/25-26/-004200625', 1, 1),
(12, '2025-06-20', 5, 13, 'Against Inward', 'SDC/25-26/-004', '2025-06-20', 1, 'jack', '', 'gandhipuram, singanallur', NULL, NULL, NULL, '1080-motor', '2', '', '', '50', '25', '', '0002', NULL, 'KGS', '', '', '', 'SDC/25-26/-004-25', 'SDC/25-26/-004200625', 1, 1),
(13, '2025-06-21', 6, 14, 'Against Inward', 'SDC/25-26/-005', '2025-06-21', 2, 'SIGMA POWER & ENERGY ENGINEERS', '', 'e-5 SIDCO INDUSTRIES ESTATE, THUVAKUDI', 'I003', NULL, NULL, 'EH OUTER BOX', '3', '', '', '50', '50', '', '123456', NULL, 'KGS', '', '', '', 'SDC/25-26/-005-25', 'SDC/25-26/-005210625', 1, 1),
(14, '2025-06-25', 7, NULL, 'Direct DC', 'SDC/25-26/-006', '2025-06-25', 4, 'IT Solution', '', 'Hoysala nagar, Ramamurthy signal, Kasthuri nagar', NULL, NULL, NULL, 'Stationary things', '4', '', '', '2', '2', 'Urgent Item', '00002', NULL, 'PACK', '', '', 'Urgent Item', 'SDC/25-26/-006-25', 'SDC/25-26/-006250625', 1, 1),
(21, '2025-07-23', 12, 22, 'Against Inward', 'SDC/25-26/-008', '2025-07-23', 1, 'jack', '', 'gandhipuram, singanallur', 'I006', '', '', '1080 Stator', '8', '1002', '', '50', '49', 'qwerty', '123456', NULL, 'KGS', 'MSS', '', '', 'SDC/25-26/-008-25', 'SDC/25-26/-008230725', 1, 1),
(22, '2025-07-23', 12, 23, 'Against Inward', 'SDC/25-26/-008', '2025-07-23', 1, 'jack', '', 'gandhipuram, singanallur', 'I006', '', '', '1/2\" CL 600 Body', '5', '1003', '', '2', '1', 'qwerty', '73259930', NULL, 'KGS', '', '', '', 'SDC/25-26/-008-25', 'SDC/25-26/-008230725', 1, 1),
(20, '2025-07-23', 12, 21, 'Against Inward', 'SDC/25-26/-008', '2025-07-23', 1, 'jack', '', 'gandhipuram, singanallur', 'I006', '', '', '1080 Rotor', '7', '1001', '', '50', '49', 'qwerty', '123456', NULL, 'KGS', 'MSS', '', '', 'SDC/25-26/-008-25', 'SDC/25-26/-008230725', 1, 1),
(28, '2025-07-23', 13, 23, 'Against Inward', 'SDC/25-26/-009', '2025-07-23', 1, 'jack', '', 'gandhipuram, singanallur', 'I006', '', '', '1/2\" CL 600 Body', '5', '1003', '', '1', '1', 'qwerty', '73259930', NULL, 'KGS', '', '', '', 'SDC/25-26/-009-25', 'SDC/25-26/-009230725', 1, 1),
(27, '2025-07-23', 13, 21, 'Against Inward', 'SDC/25-26/-009', '2025-07-23', 1, 'jack', '', 'gandhipuram, singanallur', 'I006', '', '', '1080 Rotor', '7', '1001', '', '10', '10', 'qwerty', '123456', NULL, 'KGS', 'MSS', '', '', 'SDC/25-26/-009-25', 'SDC/25-26/-009230725', 1, 1),
(26, '2025-07-23', 13, 22, 'Against Inward', 'SDC/25-26/-009', '2025-07-23', 1, 'jack', '', 'gandhipuram, singanallur', 'I006', '', '', '1080 Stator', '8', '1002', '', '10', '10', 'qwerty', '123456', NULL, 'KGS', 'MSS', '', '', 'SDC/25-26/-009-25', 'SDC/25-26/-009230725', 1, 1),
(29, '2025-08-04', 14, NULL, 'Direct DC', 'SDC/25-26/-010', '2025-08-04', 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', '', 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS', NULL, NULL, NULL, 'Coal Nozzle', '6', '200', '', '10', '9', '-', '84803000', '0', 'NOS', 'MSS', '', '', 'SDC/25-26/-010-25', 'SDC/25-26/-010040825', 1, 1),
(30, '2025-09-18', 16, NULL, 'Direct DC', 'SDC/25-26/-011', '2025-09-18', 1, 'jack', '', 'gandhipuram, singanallur', NULL, NULL, NULL, 'Coal Nozzle', '1', NULL, '-', '10', '10', '-', '123456', '002', 'KGS', '1', '', NULL, 'SDC/25-26/-011-25', 'SDC/25-26/-011180925', 1, 1),
(31, '2025-09-18', 16, NULL, 'Direct DC', 'SDC/25-26/-011', '2025-09-18', 1, 'jack', '', 'gandhipuram, singanallur', NULL, NULL, NULL, 'Coal Nozzle', '1', NULL, '-', '10', '10', '-', '123456', '002', 'KGS', '1', '', NULL, 'SDC/25-26/-011-25', 'SDC/25-26/-011180925', 1, 1),
(35, '2025-09-18', 17, NULL, 'Direct DC', 'SDC/25-26/-012', '2025-09-18', 1, 'jack', '', 'gandhipuram, singanallur', '', '', '', 'Coal Nozzle', '1', NULL, '-', '50', '50', '-', '123456', '002', 'KGS', '1', '150', NULL, 'SDC/25-26/-012-25', 'SDC/25-26/-012180925', 1, 1),
(34, '2025-09-18', 17, NULL, 'Direct DC', 'SDC/25-26/-012', '2025-09-18', 1, 'jack', '', 'gandhipuram, singanallur', '', '', '', 'Coal Nozzle', '1', NULL, '-', '50', '50', '-', '123456', '002', 'KGS', '1', '100', NULL, 'SDC/25-26/-012-25', 'SDC/25-26/-012180925', 1, 1),
(36, '2025-09-18', 17, NULL, 'Direct DC', 'SDC/25-26/-012', '2025-09-18', 1, 'jack', '', 'gandhipuram, singanallur', '', '', '', 'Coal Nozzle', '', NULL, '-', '50', '50', '-', '123456', '002', 'KGS', '1', '200', NULL, 'SDC/25-26/-012-25', 'SDC/25-26/-012180925', 1, 1);

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `date`, `expensesid`, `name`, `expensesdate`, `purpose`, `paymentmode`, `throughcheck`, `chequeno`, `chamount`, `banktransfer`, `bamount`, `amount`, `cardtype`, `paymentdetails`, `overallamount`, `status`, `headers`, `transactionid`) VALUES
(1, '2025-06-23', '001', 'Pradeepa', '2025-06-23', 'Advance salary', 'Cash', '0', '', '', '0', '', '30000', NULL, 'Cash', '30000', '1', 'Salary ', ''),
(3, '2025-06-23', '002', 'RM Company', '2025-06-23', 'tea', 'Cheque', 'AXIS', '1224335', '3', '0', '', '', NULL, 'Cheque AXIS 1224335', '3', '1', 'Salary ', ''),
(4, '2025-06-23', '003', 'RM Company', '2025-06-23', 'tea', 'Cash', 'AXIS', '1224335', '3', '0', '', '30000', NULL, 'Cash', '30000', '1', 'Salary ', '');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `element` text DEFAULT NULL,
  `min_value` text DEFAULT NULL,
  `max_value` text DEFAULT NULL,
  `mechanicalelement` text DEFAULT NULL,
  `mechanicalminvalue` text DEFAULT NULL,
  `mechanicalmaxvalue` text DEFAULT NULL,
  `remarks` longtext NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`id`, `date`, `heat_treatment`, `grade`, `hsnno`, `element`, `min_value`, `max_value`, `mechanicalelement`, `mechanicalminvalue`, `mechanicalmaxvalue`, `remarks`, `status`) VALUES
(3, '2025-10-08', 'SOLUTION ANNEALING: Heated  to  1080°C soak for  3 Hrs and  then  water quenched.', 'ASTM A351 GR CF3M', '641024', 'C,Mn,Si,P,S,Cr,Ni,Mo,,,,,,,', '-,-,-,-,-,17.000,9.000,2.000,,,,,,,', '-,-,-,-,-,17.000,9.000,2.000,,,,,,,', 'Yield Strength,Tensile Strength,% Elongation,% Reduction of Area,Hardness,Bend Test,Impact Test in Joules', '205,485,30,-,-,-,-', '-,-,-,-,200,-,-', '<p><span style=\"font-size: 14px;\">Separate test bar poured and the same bar tested for chemical and mechanical properties</span></p><p><span style=\"font-size: 14px;\">&nbsp; Tensile Testing conducted on round specimen at room temperature</span></p><p><span style=\"font-size: 14px;\">&nbsp;Visual inspection carried out at as per MSS SP-55, found satisfied</span></p><p>Radio active contamination not found in the castings</p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `headers`
--

CREATE TABLE `headers` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hsnmaster`
--

INSERT INTO `hsnmaster` (`id`, `date`, `hsnno`, `party`, `status`) VALUES
(2, '2025-08-11', '145311090', NULL, 1);

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
  `dcno` longtext DEFAULT NULL,
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
  `shipToAddress` longtext DEFAULT NULL,
  `deliveryAddress1` longtext DEFAULT NULL,
  `deliveryAddress2` longtext DEFAULT NULL,
  `mobileNo` varchar(255) DEFAULT NULL,
  `billtype` varchar(255) DEFAULT NULL,
  `gsttype` varchar(225) DEFAULT NULL,
  `typesgst` longtext DEFAULT NULL,
  `typecgst` longtext DEFAULT NULL,
  `typeigst` longtext DEFAULT NULL,
  `dcnos` longtext DEFAULT NULL,
  `insertid` varchar(225) DEFAULT NULL,
  `deliveryid` longtext DEFAULT NULL,
  `hsnno` longtext DEFAULT NULL,
  `itemcode` longtext DEFAULT NULL,
  `itemname` longtext DEFAULT NULL,
  `itemid` varchar(100) NOT NULL,
  `heatno` varchar(100) NOT NULL,
  `item_desc` text NOT NULL,
  `uom` longtext DEFAULT NULL,
  `grade` varchar(100) NOT NULL,
  `rate` longtext DEFAULT NULL,
  `qty` longtext DEFAULT NULL,
  `weight` varchar(100) NOT NULL,
  `amount` longtext DEFAULT NULL,
  `discount` longtext DEFAULT NULL,
  `discountBy` varchar(255) NOT NULL,
  `discountamount` longtext DEFAULT NULL,
  `taxableamount` longtext DEFAULT NULL,
  `sgst` longtext DEFAULT NULL,
  `sgstamount` longtext DEFAULT NULL,
  `cgst` longtext DEFAULT NULL,
  `cgstamount` longtext DEFAULT NULL,
  `igst` longtext DEFAULT NULL,
  `igstamount` longtext DEFAULT NULL,
  `total` longtext DEFAULT NULL,
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
  `return_status` longtext DEFAULT NULL,
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `date`, `invoicedate`, `orderno`, `orderdate`, `invoiceno`, `dcno`, `pono`, `pino`, `purchaseordernos`, `bill_type`, `invoicetype`, `customerdcnos`, `customerId`, `customername`, `address`, `deliveryat`, `transportmode`, `vehicleno`, `removalDate`, `time`, `shipTo`, `shipToId`, `shipToAddress`, `deliveryAddress1`, `deliveryAddress2`, `mobileNo`, `billtype`, `gsttype`, `typesgst`, `typecgst`, `typeigst`, `dcnos`, `insertid`, `deliveryid`, `hsnno`, `itemcode`, `itemname`, `itemid`, `heatno`, `item_desc`, `uom`, `grade`, `rate`, `qty`, `weight`, `amount`, `discount`, `discountBy`, `discountamount`, `taxableamount`, `sgst`, `sgstamount`, `cgst`, `cgstamount`, `igst`, `igstamount`, `total`, `subtotal`, `freightamount`, `freightcgst`, `freightcgstamount`, `freightsgst`, `freightsgstamount`, `freightigst`, `freightigstamount`, `freighttotal`, `loadingamount`, `loadingcgst`, `loadingcgstamount`, `loadingsgst`, `loadingsgstamount`, `loadingigst`, `loadingigstamount`, `loadingtotal`, `roundOff`, `othercharges`, `return_status`, `grandtotal`, `balance`, `vou_status`, `invoicenodate`, `invoicenoyear`, `status`, `edit_status`, `totalqty`, `acno`, `acdate`, `irn`, `signedinvoice`, `signedqrcode`, `status_ein`, `ewayno`, `ewaydate`, `ewbvalidtill`, `remarks`, `status_cd`, `status_desc`, `einvoice_status`, `eway_status`) VALUES
(13, '2025-07-17', '2025-03-21', '2025361', '2025-03-18', 'INV/25-26/-', NULL, 'P1', NULL, 'P1', 'Tax Invoice', 'Against PO', '', 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', NULL, NULL, '', '2025-07-17', '01:20 PM', 'M/S CADALAN OFFSHORE PRIVATE LIMITED', '7', 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', NULL, NULL, NULL, 'intrastate', 'intrastate', 'sgst', 'cgst', '', NULL, NULL, '4', '73259930', 'CA16', '1/2', '', '', '', 'KGS', '', '1250', '20', '', '25000.00', '0', 'amount_wise', NULL, '25000.00', '9', '2250.00', '9', '2250.00', '18', '', NULL, '25000.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1', '29500.00', '29500.00', 1, 'INV/25-26/-170725', 'INV/25-26/--2025', 1, 1, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 0, 0),
(14, '2025-07-17', '2025-07-17', '3704', '1970-01-01', 'INV/25-26/-1', NULL, NULL, NULL, NULL, 'Tax Invoice', 'Direct Invoice', '', 2, 'SIGMA POWER & ENERGY ENGINEERS', 'PLOT No.E-5 SIDCO INDUSTRIES ESTATE, Phase II, VALAVANTHAN KOTTAI, THUVAKUDI, TRICHY, Tamil Nadu', NULL, NULL, '', '2025-07-17', '01:33 PM', '', '', '', NULL, NULL, NULL, 'intrastate', 'intrastate', 'sgst', 'cgst', '', NULL, NULL, NULL, '84803000', 'SP01', 'Coal Nozzle', '', '', '', 'NOS', '', '200000', '1', '', '200000.00', '0', 'amount_wise', '0', '200000.00', '9', '18000.00', '9', '18000.00', '', '', NULL, '200000.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1', '236000.00', '236000.00', 1, 'INV/25-26/-1170725', 'INV/25-26/-1-2025', 1, 1, '1.00', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0),
(15, '2025-07-25', '2025-07-25', '', '1970-01-01', 'INV/25-26/-2', '', '', NULL, '', 'Tax Invoice', 'Direct Invoice', '', 1, 'jack', 'gandhipuram, singanallur, karaikudi, Tamil Nadu', NULL, NULL, '', '2025-07-25', '03:22 PM', '', '', '', NULL, NULL, NULL, 'intrastate', 'intrastate', 'sgst', 'cgst', '', '', NULL, '', '123456||123456', '001||002', '1080 Rotor||1080 Stator', '||', '001||001', '||', 'KGS||KGS', 'MSS||MSS', '15000||15000', '10||10', '', '150000.00||150000.00', '0||0', 'amount_wise', '0||0', '150000.00||150000.00', '9', '', '9', '', '18', '', '', '300000.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1||1', '300000.00', '300000.00', 1, 'INV/25-26/-2250725', 'INV/25-26/-2-2025', 1, 1, '20.00', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0),
(16, '2025-07-25', '2025-07-25', '', '1970-01-01', 'INV/25-26/-3', '', '', NULL, '', 'Tax Invoice', 'Direct Invoice', '', 1, 'jack', 'gandhipuram, singanallur, karaikudi, Tamil Nadu', NULL, NULL, '', '2025-07-25', '04:43 PM', '', '', '', NULL, NULL, NULL, 'intrastate', 'intrastate', 'sgst', 'cgst', '', '', NULL, '', '123456||123456||123456', '001||002||001', '1080 Rotor||1080 Stator||1080 Rotor', '1001||||1002', '1001||1002||1003', '||||', 'KGS||KGS||KGS', 'MSS||MSS||MSS', '15000||15000||15000', '10||10||5', '', '150000.00||150000.00||75000.00', '0||0||0', 'amount_wise', '0||0||0', '150000.00||150000.00||75000.00', '9', '33750.00', '9', '33750.00', '18', '', '', '375000.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1||1||1', '442500.00', '442500.00', 1, 'INV/25-26/-3250725', 'INV/25-26/-3-2025', 1, 1, '20.00', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0),
(17, '2025-07-25', '2025-07-25', '', '1970-01-01', 'INV/25-26/-4', 'SDC/25-26/-008', '', NULL, '', 'Tax Invoice', 'Against DC', '', 1, 'jack', 'gandhipuram, singanallur, karaikudi, Tamil Nadu', NULL, NULL, '', '2025-07-25', '07:01 PM', '', '', '', NULL, NULL, NULL, 'intrastate', 'intrastate', 'sgst', 'cgst', '', 'SDC/25-26/-008||SDC/25-26/-008||SDC/25-26/-008', '12', '21||22||20', '123456||73259930||123456', '002||CA16||001', '1080 Stator||1/2\" CL 600 Body||1080 Rotor', '8||5||7', '1002||1003||1001', '||||', 'KGS||KGS||KGS', 'MSS||||MSS', '15000||1500||15000', '1||1||1', '', '15000.00||1500.00||15000.00', '0||0||0', 'amount_wise', '||||', '15000.00||1500.00||15000.00', '9', '2835.00', '9', '2835.00', '18', '', '15000.00||1500.00||15000.00', '31500.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1||1||1', '37170.00', '37170.00', 1, 'INV/25-26/-4250725', 'INV/25-26/-4-2025', 1, 1, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 0, 0),
(18, '2025-08-04', '2025-08-04', '', '1970-01-01', 'INV/25-26/-5', '', '', NULL, '', 'Tax Invoice', 'Direct Invoice', '', 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', NULL, NULL, '', '2025-08-04', '10:35 AM', '', '', '', NULL, NULL, NULL, 'intrastate', 'intrastate', 'sgst', 'cgst', '', '', NULL, '', '84803000||84803000', '0||0', 'Coal Nozzle||Coal Nozzle', '||6', '001||002', 'Casting||Core vox', 'NOS||NOS', 'MSS||MSS', '200000||200000', '1||1', '', '2000000.00||2000000.00', '0||0', 'amount_wise', '0||0', '2000000.00||2000000.00', '9', '360000.00', '9', '360000.00', '18', '', '', '4000000.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1||1', '4720000.00', '4720000.00', 1, 'INV/25-26/-5040825', 'INV/25-26/-5-2025', 1, 1, '2.00', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0),
(19, '2025-08-04', '2025-08-04', '', '1970-01-01', 'INV/25-26/-6', '', '', NULL, '', 'Tax Invoice', 'Direct Invoice', '', 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', NULL, NULL, '', '2025-08-04', '11:10 AM', '', '', '', NULL, NULL, NULL, 'intrastate', 'intrastate', 'sgst', 'cgst', '', '', NULL, '', '84803000||84803000', '0||0', 'Coal Nozzle||Coal Nozzle', '||6', '001||002', '||', 'NOS||NOS', 'MSS||MSS', '200000||200000', '1||1', '10||10', '2000000.00||2000000.00', '0||0', 'amount_wise', '0||0', '2000000.00||2000000.00', '9', '360000.00', '9', '360000.00', '18', '', '', '4000000.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1||1', '4720000.00', '4720000.00', 1, 'INV/25-26/-6040825', 'INV/25-26/-6-2025', 1, 1, '3.00', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0),
(20, '2025-08-04', '2025-08-04', '', '1970-01-01', 'INV/25-26/-7', 'SDC/25-26/-010', '', NULL, '', 'Tax Invoice', 'Against DC', '', 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', NULL, NULL, '', '2025-08-04', '11:58 AM', '', '', '', NULL, NULL, NULL, 'intrastate', 'intrastate', 'sgst', 'cgst', '', 'SDC/25-26/-010', '14', '29', '84803000', '0', 'Coal Nozzle', '6', '200', '', 'NOS', 'MSS', '200000', '1', '20', '4000000.00', '0', 'amount_wise', '', '4000000.00', '9', '360000.00', '9', '360000.00', '18', '', '4000000.00', '4000000.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1', '4720000.00', '4720000.00', 1, 'INV/25-26/-7040825', 'INV/25-26/-7-2025', 1, 1, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 0, 0);

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
  `dcno` longtext DEFAULT NULL,
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
  `shipToAddress` longtext DEFAULT NULL,
  `deliveryAddress1` longtext DEFAULT NULL,
  `deliveryAddress2` longtext DEFAULT NULL,
  `mobileNo` varchar(255) DEFAULT NULL,
  `billtype` varchar(255) DEFAULT NULL,
  `gsttype` varchar(225) DEFAULT NULL,
  `typesgst` longtext DEFAULT NULL,
  `typecgst` longtext DEFAULT NULL,
  `typeigst` longtext DEFAULT NULL,
  `dcnos` longtext DEFAULT NULL,
  `insertid` varchar(225) DEFAULT NULL,
  `deliveryid` longtext DEFAULT NULL,
  `hsnno` longtext DEFAULT NULL,
  `heatno` varchar(100) NOT NULL,
  `itemid` varchar(100) NOT NULL,
  `itemcode` longtext DEFAULT NULL,
  `itemname` longtext DEFAULT NULL,
  `item_desc` text NOT NULL,
  `uom` longtext DEFAULT NULL,
  `grade` varchar(100) NOT NULL,
  `rate` longtext DEFAULT NULL,
  `qty` longtext DEFAULT NULL,
  `weight` varchar(100) NOT NULL,
  `amount` longtext DEFAULT NULL,
  `discount` longtext DEFAULT NULL,
  `discountBy` varchar(255) NOT NULL,
  `discountamount` longtext DEFAULT NULL,
  `taxableamount` longtext DEFAULT NULL,
  `sgst` longtext DEFAULT NULL,
  `sgstamount` longtext DEFAULT NULL,
  `cgst` longtext DEFAULT NULL,
  `cgstamount` longtext DEFAULT NULL,
  `igst` longtext DEFAULT NULL,
  `igstamount` longtext DEFAULT NULL,
  `total` longtext DEFAULT NULL,
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
  `return_status` longtext DEFAULT NULL,
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `invoice_party_statement`
--

INSERT INTO `invoice_party_statement` (`id`, `receiptno`, `paid`, `receiptid`, `date`, `invoiceno`, `customerId`, `customername`, `cstno`, `phoneno`, `tinno`, `itemname`, `item_desc`, `rate`, `qty`, `weight`, `credit`, `debit`, `amount`, `total`, `status`, `receiptdate`, `invoicedate`, `totalamount`, `payment`, `throughcheck`, `balanceamount`, `payamount`, `paymentmode`, `chamount`, `paidamount`, `balance`, `banktransfer`, `bankamount`, `chequeno`, `paymentdetails`, `overallamount`, `receiptamt`, `invoiceamt`, `returnamount`, `formtype`, `invoicenoyear`, `invoicenodate`, `invoiceid`) VALUES
(9, 'V/25-26/-001', '', NULL, '2025-06-20', '-', 0, 'jack', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '1', '2025-06-20', '0000-00-00', '', '', NULL, '', '', NULL, NULL, NULL, '583000', NULL, NULL, NULL, 'Cash', NULL, '1100', '-', NULL, NULL, NULL, NULL, NULL),
(13, 'V/25-26/-002', '', NULL, '2025-06-21', '-', 0, 'SIGMA POWER & ENERGY ENGINEERS', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '1', '2025-06-21', '0000-00-00', '', '', NULL, '', '', NULL, NULL, NULL, '180000', NULL, NULL, NULL, 'Cash', NULL, '8800', '-', NULL, NULL, NULL, NULL, NULL),
(16, 'V/25-26/-004', '', NULL, '2025-06-24', '-', 0, 'IT Solution', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '1', '2025-06-24', '0000-00-00', '', '', NULL, '', '', NULL, NULL, NULL, '-500', NULL, NULL, NULL, 'Cash', NULL, '500', '-', NULL, NULL, NULL, NULL, NULL),
(19, '-', '-', NULL, '2025-03-21', 'INV/25-26/-', 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', '', '', '', '1/2', '', '', '', '', NULL, NULL, '', '', '1', '2025-03-21', '2025-03-21', '29500.00', '-', '-', '', '', '-', '-', NULL, '29500', '-', '-', '-', '-', '29500.00', '-', '29500.00', NULL, NULL, 'INV/25-26/--2025', 'INV/25-26/-170725', '13'),
(21, '-', '-', NULL, '2025-07-17', 'INV/25-26/-1', 2, 'SIGMA POWER & ENERGY ENGINEERS', '', '', '', 'Coal Nozzle', '', '', '', '', NULL, NULL, '', '', '1', '2025-07-17', '2025-07-17', '236000.00', '-', '-', '', '', '-', '-', NULL, '227200', '-', '-', '-', '-', '236000.00', '-', '236000.00', NULL, NULL, NULL, NULL, '14'),
(22, '-', '-', NULL, '2025-07-25', 'INV/25-26/-2', 1, 'jack', '', '', '', '1080 Rotor||1080 Stator', '||', '', '', '', NULL, NULL, '', '', '1', '2025-07-25', '2025-07-25', '300000.00', '-', '-', '', '', '-', '-', NULL, '2423400', '-', '-', '-', '-', '300000.00', '-', '300000.00', NULL, NULL, 'INV/25-26/-2-2025', 'INV/25-26/-2250725', '15'),
(24, '-', '-', NULL, '2025-07-25', 'INV/25-26/-3', 1, 'jack', '', '', '', '1080 Rotor||1080 Stator||1080 Rotor', '||||', '', '', '', NULL, NULL, '', '', '1', '2025-07-25', '2025-07-25', '442500.00', '-', '-', '', '', '-', '-', NULL, '2865900', '-', '-', '-', '-', '442500.00', '-', '442500.00', NULL, NULL, NULL, NULL, '16'),
(25, '-', '-', NULL, '2025-07-25', 'INV/25-26/-4', 1, 'jack', '', '', '', '1080 Stator||1/2\" CL 600 Body||1080 Rotor', '||||', '', '', '', NULL, NULL, '', '', '1', '2025-07-25', '2025-07-25', '37170.00', '-', '-', '', '', '-', '-', NULL, '2903070', '-', '-', '-', '-', '37170.00', '-', '37170.00', NULL, NULL, 'INV/25-26/-4-2025', 'INV/25-26/-4250725', '17'),
(26, '-', '-', NULL, '2025-08-04', 'INV/25-26/-5', 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', '', '', '', 'Coal Nozzle||Coal Nozzle', 'Casting||Core vox', '', '', '', NULL, NULL, '', '', '1', '2025-08-04', '2025-08-04', '4720000.00', '-', '-', '', '', '-', '-', NULL, '4749500', '-', '-', '-', '-', '4720000.00', '-', '4720000.00', NULL, NULL, 'INV/25-26/-5-2025', 'INV/25-26/-5040825', '18'),
(29, '-', '-', NULL, '2025-08-04', 'INV/25-26/-6', 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', '', '', '', 'Coal Nozzle||Coal Nozzle', '||', '', '', '', NULL, NULL, '', '', '1', '2025-08-04', '2025-08-04', '4720000.00', '-', '-', '', '', '-', '-', NULL, '9469500', '-', '-', '-', '-', '4720000.00', '-', '4720000.00', NULL, NULL, NULL, NULL, '19'),
(30, '-', '-', NULL, '2025-08-04', 'INV/25-26/-7', 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', '', '', '', 'Coal Nozzle', '', '', '', '', NULL, NULL, '', '', '1', '2025-08-04', '2025-08-04', '4720000.00', '-', '-', '', '', '-', '-', NULL, '14189500', '-', '-', '-', '-', '4720000.00', '-', '4720000.00', NULL, NULL, 'INV/25-26/-7-2025', 'INV/25-26/-7040825', '20');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_reports`
--

CREATE TABLE `invoice_reports` (
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
  `invoiceid` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `invoice_reports`
--

INSERT INTO `invoice_reports` (`id`, `date`, `invoiceno`, `invoicedate`, `paymenttype`, `dcdate`, `customerId`, `customername`, `mobileno`, `tinno`, `cstno`, `address`, `gsttype`, `billtype`, `deliveryat`, `vehicleno`, `dcno`, `orderdate`, `orderno`, `despatch`, `hsnno`, `heatno`, `itemid`, `itemcode`, `itemno`, `itemname`, `item_desc`, `rate`, `uom`, `grade`, `qty`, `weight`, `total`, `totalamount`, `subtotal`, `discount`, `disamount`, `grandtotal`, `paid`, `balance`, `status`, `invoicenoyear`, `invoicenodate`, `invoiceid`) VALUES
(28, '2025-07-17', 'INV/25-26/-', '2025-03-21', NULL, NULL, 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', NULL, NULL, NULL, 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', 'intrastate', 'intrastate', NULL, '', NULL, '2025-03-18', '2025361', NULL, '73259930', '', '', 'CA16', NULL, '1/2', '', '1', '', '', '20', '', NULL, NULL, '25000.00', NULL, NULL, '29500.00', NULL, NULL, '1', 'INV/25-26/--2025', 'INV/25-26/-170725', '13'),
(30, '2025-07-17', 'INV/25-26/-1', '2025-07-17', NULL, NULL, 0, 'SIGMA POWER & ENERGY ENGINEERS', NULL, NULL, NULL, 'PLOT No.E-5 SIDCO INDUSTRIES ESTATE, Phase II, VALAVANTHAN KOTTAI, THUVAKUDI, TRICHY, Tamil Nadu', 'intrastate', 'intrastate', NULL, '', NULL, '1970-01-01', '3704', NULL, '84803000', '', '', '1', NULL, 'Coal Nozzle', '', '200000', '', '', '1', '', NULL, NULL, '200000.00', NULL, NULL, '236000.00', NULL, NULL, '1', NULL, NULL, '14'),
(31, '2025-07-25', 'INV/25-26/-2', '2025-07-25', NULL, NULL, 1, 'jack', NULL, NULL, NULL, 'gandhipuram, singanallur, karaikudi, Tamil Nadu', 'intrastate', 'intrastate', NULL, '', NULL, '1970-01-01', '', NULL, '123456', '001', '', '001', NULL, '1080 Rotor', '', '1', '', 'MSS', '10', '', '', NULL, '300000.00', NULL, NULL, '300000.00', NULL, NULL, '1', 'INV/25-26/-2-2025', 'INV/25-26/-2250725', '15'),
(32, '2025-07-25', 'INV/25-26/-2', '2025-07-25', NULL, NULL, 1, 'jack', NULL, NULL, NULL, 'gandhipuram, singanallur, karaikudi, Tamil Nadu', 'intrastate', 'intrastate', NULL, '', NULL, '1970-01-01', '', NULL, '123456', '001', '', '002', NULL, '1080 Stator', '', '5', '', 'MSS', '10', '', '', NULL, '300000.00', NULL, NULL, '300000.00', NULL, NULL, '1', 'INV/25-26/-2-2025', 'INV/25-26/-2250725', '15'),
(38, '2025-07-25', 'INV/25-26/-3', '2025-07-25', NULL, NULL, 0, 'jack', NULL, NULL, NULL, 'gandhipuram, singanallur, karaikudi, Tamil Nadu', 'intrastate', 'intrastate', NULL, '', NULL, '1970-01-01', '', NULL, '123456', '1002', '', '002', NULL, '1080 Stator', '', '15000', '', 'MSS', '10', '', NULL, NULL, '375000.00', NULL, NULL, '442500.00', NULL, NULL, '1', NULL, NULL, '16'),
(37, '2025-07-25', 'INV/25-26/-3', '2025-07-25', NULL, NULL, 0, 'jack', NULL, NULL, NULL, 'gandhipuram, singanallur, karaikudi, Tamil Nadu', 'intrastate', 'intrastate', NULL, '', NULL, '1970-01-01', '', NULL, '123456', '1001', '1001', '001', NULL, '1080 Rotor', '', '15000', '', 'MSS', '10', '', NULL, NULL, '375000.00', NULL, NULL, '442500.00', NULL, NULL, '1', NULL, NULL, '16'),
(39, '2025-07-25', 'INV/25-26/-3', '2025-07-25', NULL, NULL, 0, 'jack', NULL, NULL, NULL, 'gandhipuram, singanallur, karaikudi, Tamil Nadu', 'intrastate', 'intrastate', NULL, '', NULL, '1970-01-01', '', NULL, '123456', '1003', '1002', '001', NULL, '1080 Rotor', '', '15000', '', 'MSS', '5', '', NULL, NULL, '375000.00', NULL, NULL, '442500.00', NULL, NULL, '1', NULL, NULL, '16'),
(40, '2025-07-25', 'INV/25-26/-4', '2025-07-25', NULL, NULL, 1, 'jack', NULL, NULL, NULL, 'gandhipuram, singanallur, karaikudi, Tamil Nadu', 'intrastate', 'intrastate', NULL, '', NULL, '1970-01-01', '', NULL, '123456', '1002', '8', '002', NULL, '1080 Stator', '', '1', '', 'MSS', '1', '', '1', NULL, '31500.00', NULL, NULL, '37170.00', NULL, NULL, '1', 'INV/25-26/-4-2025', 'INV/25-26/-4250725', '17'),
(41, '2025-07-25', 'INV/25-26/-4', '2025-07-25', NULL, NULL, 1, 'jack', NULL, NULL, NULL, 'gandhipuram, singanallur, karaikudi, Tamil Nadu', 'intrastate', 'intrastate', NULL, '', NULL, '1970-01-01', '', NULL, '73259930', '1003', '5', 'CA16', NULL, '1/2\" CL 600 Body', '', '5', '', '', '1', '', '5', NULL, '31500.00', NULL, NULL, '37170.00', NULL, NULL, '1', 'INV/25-26/-4-2025', 'INV/25-26/-4250725', '17'),
(42, '2025-07-25', 'INV/25-26/-4', '2025-07-25', NULL, NULL, 1, 'jack', NULL, NULL, NULL, 'gandhipuram, singanallur, karaikudi, Tamil Nadu', 'intrastate', 'intrastate', NULL, '', NULL, '1970-01-01', '', NULL, '123456', '1001', '7', '001', NULL, '1080 Rotor', '', '0', '', 'MSS', '1', '', '0', NULL, '31500.00', NULL, NULL, '37170.00', NULL, NULL, '1', 'INV/25-26/-4-2025', 'INV/25-26/-4250725', '17'),
(43, '2025-08-04', 'INV/25-26/-5', '2025-08-04', NULL, NULL, 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', NULL, NULL, NULL, 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', 'intrastate', 'intrastate', NULL, '', NULL, '1970-01-01', '', NULL, '84803000', '001', '', '0', NULL, 'Coal Nozzle', 'Casting', '2', '', 'MSS', '1', '', '', NULL, '4000000.00', NULL, NULL, '4720000.00', NULL, NULL, '1', 'INV/25-26/-5-2025', 'INV/25-26/-5040825', '18'),
(44, '2025-08-04', 'INV/25-26/-5', '2025-08-04', NULL, NULL, 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', NULL, NULL, NULL, 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', 'intrastate', 'intrastate', NULL, '', NULL, '1970-01-01', '', NULL, '84803000', '002', '6', '0', NULL, 'Coal Nozzle', 'Core vox', '0', '', 'MSS', '1', '', '', NULL, '4000000.00', NULL, NULL, '4720000.00', NULL, NULL, '1', 'INV/25-26/-5-2025', 'INV/25-26/-5040825', '18'),
(50, '2025-08-04', 'INV/25-26/-6', '2025-08-04', NULL, NULL, 0, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', NULL, NULL, NULL, 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', 'intrastate', 'intrastate', NULL, '', NULL, '1970-01-01', '', NULL, '84803000', '002', '6', '0', NULL, 'Coal Nozzle', '', '200000', '', 'MSS', '1', '10', NULL, NULL, '4000000.00', NULL, NULL, '4720000.00', NULL, NULL, '1', NULL, NULL, '19'),
(49, '2025-08-04', 'INV/25-26/-6', '2025-08-04', NULL, NULL, 0, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', NULL, NULL, NULL, 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', 'intrastate', 'intrastate', NULL, '', NULL, '1970-01-01', '', NULL, '84803000', '001', '', '0', NULL, 'Coal Nozzle', '', '200000', '', 'MSS', '1', '10', NULL, NULL, '4000000.00', NULL, NULL, '4720000.00', NULL, NULL, '1', NULL, NULL, '19'),
(51, '2025-08-04', 'INV/25-26/-7', '2025-08-04', NULL, NULL, 7, 'M/S CADALAN OFFSHORE PRIVATE LIMITED', NULL, NULL, NULL, 'No:54 SRI VIGNESHWAR ILLAM, MGR NAGAR, GOLDWINS, Coimbatore, Tamil Nadu', 'intrastate', 'intrastate', NULL, '', NULL, '1970-01-01', '', NULL, '84803000', '200', '6', '0', NULL, 'Coal Nozzle', '', '2', '', 'MSS', '1', '20', '4', NULL, '4000000.00', NULL, NULL, '4720000.00', NULL, NULL, '1', 'INV/25-26/-7-2025', 'INV/25-26/-7040825', '20');

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
  `hsnno` longtext DEFAULT NULL,
  `itemcode` varchar(255) DEFAULT NULL,
  `uom` longtext DEFAULT NULL,
  `grade` varchar(50) NOT NULL,
  `inwardnoyear` varchar(225) DEFAULT NULL,
  `inwardnodate` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `inward_status` int(11) DEFAULT NULL,
  `lastupdated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `inward_delivery`
--

INSERT INTO `inward_delivery` (`id`, `insertid`, `date`, `inwardno`, `inwarddate`, `cusname`, `address`, `customerdcno`, `customerdcdate`, `itemid`, `heatno`, `itemname`, `item_desc`, `qty`, `balanceqty`, `lastupdatedqty`, `remarks`, `hsnno`, `itemcode`, `uom`, `grade`, `inwardnoyear`, `inwardnodate`, `status`, `inward_status`, `lastupdated`) VALUES
(9, 4, '2025-06-20', 'I001', '2025-06-20', 'jack', 'gandhipuram, singanallur', '001', '2025-06-20', '1', '', '1080-rotor', '', '100', '50', 100, '', '0001', NULL, 'KGS', '', 'I001-25', 'I001200625', 1, 1, '2025-06-20 14:12:54'),
(10, 4, '2025-06-20', 'I001', '2025-06-20', 'jack', 'gandhipuram, singanallur', '001', '2025-06-20', '2', '', '1080-motor', '', '100', '50', 100, '', '0002', NULL, 'KGS', '', 'I001-25', 'I001200625', 1, 1, '2025-06-20 14:12:54'),
(11, 4, '2025-06-20', 'I001', '2025-06-20', 'jack', 'gandhipuram, singanallur', '001', '2025-06-20', '1', '', '1080-rotor', '', '100', '50', 100, '', '0001', NULL, 'KGS', '', 'I001-25', 'I001200625', 1, 1, '2025-06-20 14:12:54'),
(12, 5, '2025-06-20', 'I002', '2025-06-20', 'jack', 'gandhipuram, singanallur', '002', '2025-06-20', '1', '', '1080-rotor', '', '100', '50', 100, '', '0001', NULL, 'KGS', '', 'I002-25', 'I002200625', 1, 1, '2025-06-20 14:41:08'),
(13, 5, '2025-06-20', 'I002', '2025-06-20', 'jack', 'gandhipuram, singanallur', '002', '2025-06-20', '2', '', '1080-motor', '', '100', '50', 100, '', '0002', NULL, 'KGS', '', 'I002-25', 'I002200625', 1, 1, '2025-06-20 14:41:08'),
(14, 6, '2025-06-20', 'I003', '2025-06-20', 'SIGMA POWER & ENERGY ENGINEERS', 'e-5 SIDCO INDUSTRIES ESTATE, THUVAKUDI', '001', '2025-06-20', '3', '', 'EH OUTER BOX', '', '100', '50', 100, '', '123456', NULL, 'KGS', '', 'I003-25', 'I003200625', 1, 1, '2025-06-21 04:18:40'),
(15, 7, '2025-06-25', 'I004', '2025-06-25', 'IT Solution', 'Hoysala nagar, Ramamurthy signal, Kasthuri nagar', 'Hosur', '2025-06-25', '4', '', 'Stationary things', '', '2', '2', 2, 'Urgent needed', '00002', NULL, 'PACK', '', 'I004-25', 'I004250625', 1, 1, '2025-06-25 16:06:23'),
(19, 8, '2025-07-22', 'I005', '2025-07-22', 'jack', 'gandhipuram, singanallur', '001', '2025-07-22', '8', '1001', '1080 Stator', '', '100', '100', 100, 'qwerty', '123456', '002', 'KGS', '', 'I005-25', 'I005220725', 1, 1, '2025-07-22 13:54:30'),
(17, 8, '2025-07-22', 'I005', '2025-07-22', 'jack', 'gandhipuram, singanallur', '001', '2025-07-22', '8', '', '1080 Stator', '', '100', '100', 100, 'qwerty', '123456', '1002', 'KGS', '', 'I005-25', 'I005220725', 1, 1, '2025-07-22 13:54:30'),
(16, 8, '2025-07-22', 'I005', '2025-07-22', 'jack', 'gandhipuram, singanallur', '001', '2025-07-22', '7', '', '1080 Rotor', '', '100', '100', 100, 'qwerty', '123456', '1001', 'KGS', '', 'I005-25', 'I005220725', 1, 1, '2025-07-22 13:54:30'),
(20, 8, '2025-07-22', 'I005', '2025-07-22', 'jack', 'gandhipuram, singanallur', '001', '2025-07-22', '5', '', '1/2\" CL 600 Body', '', '5', '5', 5, 'Machining', '73259930', 'CA16', 'KGS', '', 'I005-25', 'I005220725', 1, 1, '2025-07-22 13:54:30'),
(22, 9, '2025-07-23', 'I006', '2025-07-23', 'jack', 'gandhipuram, singanallur', '002', '2025-07-23', '8', '1002', '1080 Stator', '', '100', '40', 100, 'qwerty', '123456', '002', 'KGS', 'MSS', 'I006-25', 'I006230725', 1, 1, '2025-07-23 10:09:02'),
(21, 9, '2025-07-23', 'I006', '2025-07-23', 'jack', 'gandhipuram, singanallur', '002', '2025-07-23', '7', '1001', '1080 Rotor', '', '100', '40', 100, 'qwerty', '123456', '001', 'KGS', 'MSS', 'I006-25', 'I006230725', 1, 1, '2025-07-23 10:09:02'),
(23, 9, '2025-07-23', 'I006', '2025-07-23', 'jack', 'gandhipuram, singanallur', '002', '2025-07-23', '5', '1003', '1/2\" CL 600 Body', '', '5', '2', 5, 'qwerty', '73259930', 'CA16', 'KGS', '', 'I006-25', 'I006230725', 1, 1, '2025-07-23 10:09:02');

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
  `hsnno` longtext DEFAULT NULL,
  `itemcode` varchar(255) DEFAULT NULL,
  `uom` longtext DEFAULT NULL,
  `grade` varchar(50) NOT NULL,
  `inwardnoyear` varchar(225) DEFAULT NULL,
  `inwardnodate` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `delete_status` int(11) DEFAULT NULL,
  `inward_delivery_id` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `inward_details`
--

INSERT INTO `inward_details` (`id`, `date`, `inwardno`, `inwarddate`, `cusname`, `address`, `customerdcno`, `customerdcdate`, `itemid`, `heatno`, `itemname`, `item_desc`, `qty`, `remarks`, `hsnno`, `itemcode`, `uom`, `grade`, `inwardnoyear`, `inwardnodate`, `status`, `delete_status`, `inward_delivery_id`) VALUES
(4, '2025-06-20', 'I001', '2025-06-20', 'jack', 'gandhipuram, singanallur', '001', '2025-06-20', '1||2||1', '', '1080-rotor||1080-motor||1080-rotor', '', '100||100||100', '', '0001||0002||0001', NULL, 'KGS||KGS||KGS', '', 'I001-25', 'I001200625', 1, 0, '9,10,11'),
(5, '2025-06-20', 'I002', '2025-06-20', 'jack', 'gandhipuram, singanallur', '002', '2025-06-20', '1||2', '', '1080-rotor||1080-motor', '', '100||100', '', '0001||0002', NULL, 'KGS||KGS', '', 'I002-25', 'I002200625', 1, 0, '12,13'),
(6, '2025-06-20', 'I003', '2025-06-20', 'SIGMA POWER & ENERGY ENGINEERS', 'e-5 SIDCO INDUSTRIES ESTATE, THUVAKUDI', '001', '2025-06-20', '3', '', 'EH OUTER BOX', '', '100', '', '123456', NULL, 'KGS', '', 'I003-25', 'I003200625', 1, 0, '14'),
(7, '2025-06-25', 'I004', '2025-06-25', 'IT Solution', 'Hoysala nagar, Ramamurthy signal, Kasthuri nagar', 'Hosur', '2025-06-25', '4', '', 'Stationary things', '', '2', 'Urgent needed', '00002', NULL, 'PACK', '', 'I004-25', 'I004250625', 1, 1, '15'),
(8, '2025-07-22', 'I005', '2025-07-22', 'jack', 'gandhipuram, singanallur', '001', '2025-07-22', '7||8||8||5', '001||002||003||004', '1080 Rotor||1080 Stator||1080 Stator||1/2\" CL 600 Body', '', '100||100||100||5', 'qwerty||qwerty||qwerty||Machining', '123456||123456||123456||73259930', '1001||1002||002||CA16', 'KGS||KGS||KGS||KGS', 'MSS||MSS||MSS', 'I005-25', 'I005220725', 1, 1, '16,17,19,20'),
(9, '2025-07-23', 'I006', '2025-07-23', 'jack', 'gandhipuram, singanallur', '002', '2025-07-23', '7||8||5', '1001||1002||1003', '1080 Rotor||1080 Stator||1/2\" CL 600 Body', '', '100||100||5', 'qwerty||qwerty||qwerty', '123456||123456||73259930', '001||002||CA16', 'KGS||KGS||KGS', 'MSS||MSS', 'I006-25', 'I006230725', 1, 0, '21,22,23');

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
  `hsnno` longtext DEFAULT NULL,
  `itemcode` varchar(255) DEFAULT NULL,
  `uom` longtext DEFAULT NULL,
  `grade` varchar(100) NOT NULL,
  `inwardnoyear` varchar(225) DEFAULT NULL,
  `inwardnodate` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `delete_status` int(11) DEFAULT NULL,
  `inward_delivery_id` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

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
  `vendordetails` longtext DEFAULT NULL,
  `joborderno` varchar(225) DEFAULT NULL,
  `category` longtext DEFAULT NULL,
  `jobdescription` longtext DEFAULT NULL,
  `issueby` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

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
  `inwardno` longtext DEFAULT NULL,
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `jobworkdc_delivery`
--

INSERT INTO `jobworkdc_delivery` (`id`, `date`, `insertid`, `inwardid`, `dctype`, `dcno`, `dcdate`, `customerId`, `cusname`, `dispatchthrough`, `address`, `inwardno`, `customerdcno`, `customerdcdate`, `itemname`, `item_desc`, `qty`, `balanceqty`, `remarks`, `hsnno`, `itemcode`, `uom`, `dcnoyear`, `dcnodate`, `status`, `dc_status`) VALUES
(1, '2025-06-25', 1, NULL, 'Direct DC', 'PDC/25-26/001', '2025-06-25', 0, 'Tech AU', '', 'Avinashi Road, Hopes College', NULL, NULL, NULL, 'Stationary things', '', '2', '2', 'Urgent', '00002', '15015', 'PACK', 'PDC/25-26/001-25', 'PDC/25-26/001250625', 1, 1);

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
  `inwardno` longtext DEFAULT NULL,
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `dispatchthrough` varchar(225) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `process` varchar(255) DEFAULT NULL,
  `remarkss` varchar(255) DEFAULT NULL,
  `approximate_value` varchar(255) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `inwardno` longtext DEFAULT NULL,
  `customerdcno` longtext DEFAULT NULL,
  `customerdcdate` longtext DEFAULT NULL,
  `itemname` longtext DEFAULT NULL,
  `item_desc` text NOT NULL,
  `qty` longtext DEFAULT NULL,
  `remarks` longtext DEFAULT NULL,
  `hsnno` longtext DEFAULT NULL,
  `itemcode` varchar(255) DEFAULT NULL,
  `uom` longtext DEFAULT NULL,
  `dcnoyear` varchar(225) DEFAULT NULL,
  `dcnodate` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `delete_status` int(11) DEFAULT NULL,
  `billtype` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `jobworkdc_details`
--

INSERT INTO `jobworkdc_details` (`id`, `date`, `dctype`, `dcno`, `dcdate`, `customerId`, `cusname`, `dispatchthrough`, `time`, `purpose`, `process`, `remarkss`, `approximate_value`, `address`, `inwardno`, `customerdcno`, `customerdcdate`, `itemname`, `item_desc`, `qty`, `remarks`, `hsnno`, `itemcode`, `uom`, `dcnoyear`, `dcnodate`, `status`, `delete_status`, `billtype`) VALUES
(1, '2025-06-25', 'Direct DC', 'PDC/25-26/001', '2025-06-25', 0, 'Tech AU', '', '12:50:PM', 'Online Purchase', '', '', '', 'Avinashi Road, Hopes College', NULL, NULL, NULL, 'Stationary things', '', '2', 'Urgent', '00002', '15015', 'PACK', 'PDC/25-26/001-25', 'PDC/25-26/001250625', 1, 1, '');

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
  `inwardno` longtext DEFAULT NULL,
  `customerdcno` longtext DEFAULT NULL,
  `customerdcdate` longtext DEFAULT NULL,
  `itemname` longtext DEFAULT NULL,
  `item_desc` text NOT NULL,
  `qty` longtext DEFAULT NULL,
  `remarks` longtext DEFAULT NULL,
  `hsnno` longtext DEFAULT NULL,
  `itemcode` varchar(255) DEFAULT NULL,
  `uom` longtext DEFAULT NULL,
  `dcnoyear` varchar(225) DEFAULT NULL,
  `dcnodate` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `delete_status` int(11) DEFAULT NULL,
  `billtype` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `vendordetails` longtext DEFAULT NULL,
  `category` longtext DEFAULT NULL,
  `jobdescription` longtext DEFAULT NULL,
  `issueby` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `sub_menu_link` text DEFAULT NULL,
  `selectedMainMenu` text NOT NULL,
  `selectedSubMenu` text NOT NULL,
  `add_party` int(11) DEFAULT NULL,
  `add_expenses` int(11) DEFAULT NULL,
  `add_quotation` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `inwardno` longtext DEFAULT NULL,
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `inwardno` longtext DEFAULT NULL,
  `customerdcno` longtext DEFAULT NULL,
  `customerdcdate` longtext DEFAULT NULL,
  `itemname` longtext DEFAULT NULL,
  `item_desc` text NOT NULL,
  `qty` longtext DEFAULT NULL,
  `remarks` longtext DEFAULT NULL,
  `hsnno` longtext DEFAULT NULL,
  `itemcode` varchar(255) DEFAULT NULL,
  `uom` longtext DEFAULT NULL,
  `dcnoyear` varchar(225) DEFAULT NULL,
  `dcnodate` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `delete_status` int(11) DEFAULT NULL,
  `billtype` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `inwardno` longtext DEFAULT NULL,
  `customerdcno` longtext DEFAULT NULL,
  `customerdcdate` longtext DEFAULT NULL,
  `itemname` longtext DEFAULT NULL,
  `item_desc` text NOT NULL,
  `qty` longtext DEFAULT NULL,
  `remarks` longtext DEFAULT NULL,
  `hsnno` longtext DEFAULT NULL,
  `itemcode` varchar(255) DEFAULT NULL,
  `uom` longtext DEFAULT NULL,
  `dcnoyear` varchar(225) DEFAULT NULL,
  `dcnodate` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `delete_status` int(11) DEFAULT NULL,
  `billtype` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mtc_report`
--

INSERT INTO `mtc_report` (`id`, `date`, `tcno`, `tcdate`, `heatno`, `customername`, `customerid`, `purchaseorderno`, `grade`, `heat_treatment`, `product_code`, `itemname`, `drawing_no`, `partno`, `poured_qty`, `chemical_element`, `chemical_minvalue`, `chemical_maxvalue`, `chemical_actualvalue`, `mechanical_element`, `mechanical_minvalue`, `mechanical_maxvalue`, `mechanical_actualvalue`, `remarks`, `status`) VALUES
(1, '2025-10-08', 'MTC001', '08-10-2025', '0001', 'jack', '1', 'P001', '3', 'SOLUTION ANNEALING: Heated  to  1080°C soak for  3 Hrs and  then  water quenched.', '002', 'Coal Nozzle', '001', '001', '10', 'C,Mn,Si,P,S,Cr,Ni,Mo,,,,,,,', '-,-,-,-,-,17.000,9.000,2.000,,,,,,,', '-,-,-,-,-,17.000,9.000,2.000,,,,,,,', '-,-,-,-,-,15,8,1,,,,,,,', 'Yield Strength,Tensile Strength,% Elongation,% Reduction of Area,Hardness,Bend Test,Impact Test in Joules', '205,485,30,-,-,-,-', '-,-,-,-,200,-,-', '-,-,-,-,-,-,-', '<p><span style=\"font-size: 14px;\">Separate test bar poured and the same bar tested for chemical and mechanical properties</span></p><p><span style=\"font-size: 14px;\">&nbsp; Tensile Testing conducted on round specimen at room temperature</span></p><p><span style=\"font-size: 14px;\">&nbsp;Visual inspection carried out at as per MSS SP-55, found satisfied</span></p><p>Radio active contamination not found in the castings</p>', 1);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `po_party_statements`
--

INSERT INTO `po_party_statements` (`id`, `date`, `purchasedate`, `receiptno`, `purchaseno`, `supplierId`, `suppliername`, `mobileno`, `address`, `itemname`, `qty`, `total`, `currentpaid`, `purpose`, `payment`, `paid`, `paidamount`, `balance`, `paymentmode`, `throughcheck`, `chequeno`, `chamount`, `banktransfer`, `bankamount`, `amount`, `paymentdetails`, `openingbalance`, `receiptamt`, `returnamount`, `purchaseamt`, `formtype`, `invoiceno`, `invoicedate`, `status`, `purchasenodate`, `purchasenoyear`, `purchaseid`) VALUES
(1, '2025-06-21', '2025-06-21', '-', 'P001', 3, 'CK PRIME ALLOYS', NULL, NULL, 'EH OUTER BOX', NULL, '212400.00', '-', '-', '-', NULL, '-', '212400', NULL, '-', '-', '-', '-', '-', '212400.00', '-', NULL, '-', NULL, '212400.00', NULL, 'OO1', '2025-06-21', '1', 'P001210625', 'P001-2025', '1'),
(2, '2025-06-21', NULL, 'V/25-26/-003', NULL, 0, 'CK PRIME ALLOYS', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '210000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Cash', NULL, '2400', NULL, '-', NULL, '-', NULL, '1', NULL, NULL, NULL),
(3, '2025-06-21', '2025-06-21', '-', 'P0002', 3, 'CK PRIME ALLOYS', NULL, NULL, 'EH OUTER BOX', NULL, '442500.00', '-', '-', '-', NULL, '-', '652500', NULL, '-', '-', '-', '-', '-', '442500.00', '-', NULL, '-', NULL, '442500.00', NULL, '0098', '2025-06-21', '1', 'P0002210625', 'P0002-2025', '2'),
(4, '2025-06-24', '2025-06-24', '-', 'P0003', 5, 'Gateway', NULL, NULL, 'Stationary things', NULL, '2364.00', '-', '-', '-', NULL, '-', '2364', NULL, '-', '-', '-', '-', '-', '2346.00', '-', NULL, '-', NULL, '2364.00', NULL, '001', '2025-06-24', '1', 'P0003240625', 'P0003-2025', '3'),
(5, '2025-06-24', NULL, 'V/25-26/-005', NULL, 0, 'Gateway', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '1864', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Cash', NULL, '500', NULL, '-', NULL, '-', NULL, '1', NULL, NULL, NULL),
(6, '2025-06-24', '2025-06-24', 'C001', 'P003', 0, 'Gateway', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '868.5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Package damage', NULL, NULL, '995.50', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
(7, '2025-09-11', '2025-09-11', '-', 'P0004', 3, 'CK PRIME ALLOYS', NULL, NULL, 'Coal Nozzle||Coal Nozzle', NULL, '177000.00', '-', '-', '-', NULL, '-', '1891500', NULL, '-', '-', '-', '-', '-', '88500.00||88500.00', '-', NULL, '-', NULL, '177000.00', NULL, '001', '2025-09-11', '1', 'P0004110925', 'P0004-2025', '5'),
(10, '2025-09-11', '2025-09-11', '-', 'P006', 0, 'CK PRIME ALLOYS', NULL, NULL, 'Coal Nozzle||Coal Nozzle', NULL, '212400.00', '-', '-', '-', NULL, '-', '2174700', NULL, '-', '-', '-', '-', '-', '106200.00||106200.00', '-', NULL, '-', NULL, '212400.00', NULL, '001', '2025-09-11', '1', NULL, NULL, '6');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `creditnote` varchar(255) DEFAULT NULL,
  `purchaseorder` varchar(255) NOT NULL,
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `preference_settings`
--

INSERT INTO `preference_settings` (`id`, `quotationPrefix`, `quotation`, `expenses`, `expensePrefix`, `dc`, `voucherPrefix`, `voucher`, `debitPrefix`, `debit`, `creditPrefix`, `credit`, `purchasePrefix`, `purchase`, `invoicePrefix`, `invoice`, `salesdcPrefix`, `materialdcPrefix`, `jobdcPrefix`, `proforma_invoicePrefix`, `proforma_invoice`, `inwardPrefix`, `inward`, `cashbillPrefix`, `cashbill_invoice`, `mtcPrefix`, `tcno`, `creditnote`, `purchaseorder`, `supplierpurchaseorder`, `jobworkdc`, `materialdc`, `cmp_companyname`, `cmp_phoneno`, `cmp_mobileno`, `cmp_address1`, `cmp_address2`, `cmp_city`, `cmp_pincode`, `cmp_stateCode`, `cmp_website`, `cmp_emailid`, `cmp_logo`, `cont_companyname`, `cont_phoneno`, `cont_mobileno`, `cont_address1`, `cont_address2`, `cont_city`, `cont_pincode`, `cont_stateCode`, `cont_website`, `cont_emailid`, `cont_logo`, `discountBy`, `invoiceBy`, `itemType`, `bill_type`, `quot_bill_type`, `voucher_receivable`, `voucher_payable`, `last_backup`, `itemcode`, `inward_add`, `cashbill_add`, `cashbill_tax_type`, `priceType`, `priceType1`, `sales_dc`, `material_dc`, `jobwork_dc`, `cpo_type`, `spo_type`, `proforma_type`, `attendance`, `status`, `einvoice`, `eway`) VALUES
(1, 'Q', '', '', 'E', '', 'V/25-26/-', '', 'D', '001', 'C', '', 'P', '', 'INV/25-26/-', '', 'SDC/25-26/-', 'MDC/25-26/-', 'PDC/25-26/', 'PI/25-26/', '', 'I', '', 'CB', '001', 'MTC', '', NULL, '', '', '', '001', 'Myoffice Solutions', '7373333321', '8608701222', ' #91 Dr. Jaganathan Nagar', 'Civil Aerodrome Post, Coimbatore', 'Coimbatore', '641014', '33', 'www.idreamdevelopers.org', 'info@idreamdevelopers.com', '12832299_1579401915712151_5416626780361493206_n.png', 'IDREAMDEVELOPERS', '7373333321', '8608701333', ' #91 Dr. Jaganathan Nagar', 'Civil Aerodrome Post, Coimbatore', 'Coimbatore', '641014', '33', 'www.idreamdevelopers.com', 'info@idreamdevelopers.com', 'idream_logo.PNG', 'amount_wise', 'without_stock', 'with_item', 'Overall Tax', 'Overall Tax', 'Without Invoice', 'Without Purchase', '2025-03-01', '1', 'With Inward', 'Without Cashbill', 'Overall Tax', '1', '0', 1, 0, 3, 'Overall Tax', 'Overall Tax', 'Overall Tax', 0, 1, 0, 0);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `date`, `companyname`, `softwarename`, `mobileno`, `phoneno`, `address1`, `address2`, `city`, `pincode`, `stateCode`, `emailid`, `website`, `tinno`, `cstno`, `gstin`, `aadharno`, `status`, `username`, `password`, `bankname`, `accountno`, `bankbranch`, `ifsccode`, `state`) VALUES
(1, NULL, 'CK PRIME ALLOYS', 'MYOFFICE ERP', '8608701222', '9159531600', 'SF.NO:845B, Door No:1J(4) Annur road, Rayarpalayam, Karumathampatti', 'Avinashi Road, Hopes College', 'Coimbatore', '641659', 'Karnataka', 'info@idreamdevelopers.com', 'www.ckprimealloys.com', '12345', '54321', '29AABCT1332L000', '', '1', 'admin', 'admin001', '', '', '', '', NULL);

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
  `dcno` longtext DEFAULT NULL,
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
  `typesgst` longtext DEFAULT NULL,
  `typecgst` longtext DEFAULT NULL,
  `typeigst` longtext DEFAULT NULL,
  `dcnos` longtext DEFAULT NULL,
  `insertid` varchar(225) DEFAULT NULL,
  `deliveryid` longtext DEFAULT NULL,
  `hsnno` longtext DEFAULT NULL,
  `itemcode` varchar(255) DEFAULT NULL,
  `itemname` longtext DEFAULT NULL,
  `item_desc` text NOT NULL,
  `uom` longtext DEFAULT NULL,
  `rate` longtext DEFAULT NULL,
  `qty` longtext DEFAULT NULL,
  `amount` longtext DEFAULT NULL,
  `discount` longtext DEFAULT NULL,
  `discountBy` varchar(255) NOT NULL,
  `discountamount` longtext DEFAULT NULL,
  `taxableamount` longtext DEFAULT NULL,
  `sgst` longtext DEFAULT NULL,
  `sgstamount` longtext DEFAULT NULL,
  `cgst` longtext DEFAULT NULL,
  `cgstamount` longtext DEFAULT NULL,
  `igst` longtext DEFAULT NULL,
  `igstamount` longtext DEFAULT NULL,
  `total` longtext DEFAULT NULL,
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
  `return_status` longtext DEFAULT NULL,
  `grandtotal` varchar(225) DEFAULT NULL,
  `invoicenodate` varchar(225) DEFAULT NULL,
  `invoicenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `proforma_invoice_details`
--

INSERT INTO `proforma_invoice_details` (`id`, `date`, `invoicedate`, `orderno`, `orderdate`, `invoiceno`, `dcno`, `bill_type`, `invoicetype`, `customerId`, `customername`, `address`, `deliveryat`, `transportmode`, `vehicleno`, `billtype`, `gsttype`, `typesgst`, `typecgst`, `typeigst`, `dcnos`, `insertid`, `deliveryid`, `hsnno`, `itemcode`, `itemname`, `item_desc`, `uom`, `rate`, `qty`, `amount`, `discount`, `discountBy`, `discountamount`, `taxableamount`, `sgst`, `sgstamount`, `cgst`, `cgstamount`, `igst`, `igstamount`, `total`, `subtotal`, `freightamount`, `freightcgst`, `freightcgstamount`, `freightsgst`, `freightsgstamount`, `freightigst`, `freightigstamount`, `freighttotal`, `loadingamount`, `loadingcgst`, `loadingcgstamount`, `loadingsgst`, `loadingsgstamount`, `loadingigst`, `loadingigstamount`, `loadingtotal`, `roundOff`, `othercharges`, `return_status`, `grandtotal`, `invoicenodate`, `invoicenoyear`, `status`, `edit_status`) VALUES
(1, '2025-06-25', '2025-06-25', '101', '2025-06-25', 'PI/25-26/001', NULL, 'Sales Invoice', NULL, 4, 'IT Solution', 'Hoysala nagar, Ramamurthy signal, Kasthuri nagar, Bangalore, Karnataka', 'Hosur', 'Eicher', 'TN7 V1234', 'intrastate', 'intrastate', 'sgst', 'cgst', '', NULL, NULL, NULL, '00002', '15015', 'Stationary things', '', 'PACK', '170', '12', '2040.00', '0', 'amount_wise', '0', '2040.00', '7.5', '154.35', '7.5', '154.35', '15', '', NULL, '2040.00', '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1', '2366.70', 'PI/25-26/001250625', 'PI/25-26/001-2025', 1, 1);

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
  `dcno` longtext DEFAULT NULL,
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
  `typesgst` longtext DEFAULT NULL,
  `typecgst` longtext DEFAULT NULL,
  `typeigst` longtext DEFAULT NULL,
  `dcnos` longtext DEFAULT NULL,
  `insertid` varchar(225) DEFAULT NULL,
  `deliveryid` longtext DEFAULT NULL,
  `hsnno` longtext DEFAULT NULL,
  `itemcode` varchar(255) NOT NULL,
  `itemname` longtext DEFAULT NULL,
  `item_desc` text NOT NULL,
  `uom` longtext DEFAULT NULL,
  `rate` longtext DEFAULT NULL,
  `qty` longtext DEFAULT NULL,
  `amount` longtext DEFAULT NULL,
  `discount` longtext DEFAULT NULL,
  `discountBy` varchar(255) NOT NULL,
  `discountamount` longtext DEFAULT NULL,
  `taxableamount` longtext DEFAULT NULL,
  `sgst` longtext DEFAULT NULL,
  `sgstamount` longtext DEFAULT NULL,
  `cgst` longtext DEFAULT NULL,
  `cgstamount` longtext DEFAULT NULL,
  `igst` longtext DEFAULT NULL,
  `igstamount` longtext DEFAULT NULL,
  `total` longtext DEFAULT NULL,
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
  `return_status` longtext DEFAULT NULL,
  `grandtotal` varchar(225) DEFAULT NULL,
  `invoicenodate` varchar(225) DEFAULT NULL,
  `invoicenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `proforma_invoice_reports`
--

INSERT INTO `proforma_invoice_reports` (`id`, `date`, `invoiceno`, `invoicedate`, `paymenttype`, `dcdate`, `customerId`, `customername`, `mobileno`, `tinno`, `cstno`, `address`, `gsttype`, `billtype`, `deliveryat`, `vehicleno`, `dcno`, `orderdate`, `orderno`, `despatch`, `hsnno`, `itemcode`, `itemno`, `itemname`, `item_desc`, `rate`, `qty`, `uom`, `total`, `totalamount`, `subtotal`, `discount`, `disamount`, `grandtotal`, `paid`, `balance`, `status`, `invoicenoyear`, `invoicenodate`, `invoiceid`) VALUES
(1, '2025-06-25', 'PI/25-26/001', '2025-06-25', NULL, NULL, 4, 'IT Solution', NULL, NULL, NULL, 'Hoysala nagar, Ramamurthy signal, Kasthuri nagar, Bangalore, Karnataka', 'intrastate', 'intrastate', 'Hosur', 'TN7 V1234', NULL, '2025-06-25', '101', NULL, '00002', '15015', NULL, 'Stationary things', '', '1', '12', 'PACK', NULL, NULL, '2040.00', NULL, NULL, '2366.70', NULL, NULL, '1', 'PI/25-26/001-2025', 'PI/25-26/001250625', '1');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `proinvoice_party_statement`
--

INSERT INTO `proinvoice_party_statement` (`id`, `receiptno`, `paid`, `receiptid`, `date`, `invoiceno`, `customerId`, `customername`, `cstno`, `phoneno`, `tinno`, `itemname`, `item_desc`, `rate`, `qty`, `credit`, `debit`, `amount`, `total`, `status`, `receiptdate`, `invoicedate`, `totalamount`, `payment`, `throughcheck`, `balanceamount`, `payamount`, `paymentmode`, `chamount`, `paidamount`, `balance`, `banktransfer`, `bankamount`, `chequeno`, `paymentdetails`, `overallamount`, `receiptamt`, `invoiceamt`, `returnamount`, `formtype`, `invoicenoyear`, `invoicenodate`, `invoiceid`) VALUES
(1, '-', '-', NULL, '2025-06-25', 'PI/25-26/001', 4, 'IT Solution', '', '', '', 'Stationary things', '', '', '', NULL, NULL, '', '', '1', '2025-06-25', '2025-06-25', '2366.70', '-', '-', '', '', '-', '-', NULL, '2844.2', '-', '-', '-', '-', '2366.70', '-', '2366.70', NULL, NULL, 'PI/25-26/001-2025', 'PI/25-26/001250625', '1');

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
  `typesgst` longtext DEFAULT NULL,
  `typecgst` longtext DEFAULT NULL,
  `typeigst` longtext DEFAULT NULL,
  `hsnno` longtext DEFAULT NULL,
  `itemcode` longtext DEFAULT NULL,
  `heatno` text DEFAULT NULL,
  `itemname` longtext DEFAULT NULL,
  `item_desc` text NOT NULL,
  `drawingno` varchar(100) NOT NULL,
  `grade` varchar(100) NOT NULL,
  `uom` longtext DEFAULT NULL,
  `weight` varchar(100) NOT NULL,
  `rate` longtext DEFAULT NULL,
  `qty` longtext DEFAULT NULL,
  `balanceqty` longtext DEFAULT NULL,
  `bom_qty` varchar(255) NOT NULL,
  `amount` longtext DEFAULT NULL,
  `discount` longtext DEFAULT NULL,
  `discountBy` longtext NOT NULL,
  `discountamount` longtext DEFAULT NULL,
  `taxableamount` longtext DEFAULT NULL,
  `sgst` longtext DEFAULT NULL,
  `sgstamount` longtext DEFAULT NULL,
  `cgst` longtext DEFAULT NULL,
  `cgstamount` longtext DEFAULT NULL,
  `igst` longtext DEFAULT NULL,
  `igstamount` longtext DEFAULT NULL,
  `total` longtext DEFAULT NULL,
  `subtotal` longtext DEFAULT NULL,
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
  `return_status` longtext DEFAULT NULL,
  `grandtotal` varchar(225) DEFAULT NULL,
  `purchasenodate` varchar(225) DEFAULT NULL,
  `purchasenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `oa_status` int(11) NOT NULL,
  `oa_deliverydate` varchar(255) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `purchaseorder_details`
--

INSERT INTO `purchaseorder_details` (`id`, `date`, `purchasedate`, `invoicedate`, `deliverydate`, `potype`, `purchaseorderno`, `purchaseorder`, `selected_bom`, `customerId`, `customername`, `address`, `invoiceno`, `billtype`, `gsttype`, `typesgst`, `typecgst`, `typeigst`, `hsnno`, `itemcode`, `heatno`, `itemname`, `item_desc`, `drawingno`, `grade`, `uom`, `weight`, `rate`, `qty`, `balanceqty`, `bom_qty`, `amount`, `discount`, `discountBy`, `discountamount`, `taxableamount`, `sgst`, `sgstamount`, `cgst`, `cgstamount`, `igst`, `igstamount`, `total`, `subtotal`, `freightamount`, `freightcgst`, `freightcgstamount`, `freightsgst`, `freightsgstamount`, `freightigst`, `freightigstamount`, `freighttotal`, `loadingamount`, `loadingcgst`, `loadingcgstamount`, `loadingsgst`, `loadingsgstamount`, `loadingigst`, `loadingigstamount`, `loadingtotal`, `othercharges`, `roundOff`, `return_status`, `grandtotal`, `purchasenodate`, `purchasenoyear`, `status`, `oa_status`, `oa_deliverydate`, `edit_status`) VALUES
(1, '2025-09-01', '2025-09-01', '2025-09-01', '01-09-2025', 'Direct PO', 'P001', '001', NULL, 1, 'jack', 'gandhipuram, singanallur, karaikudi, Tamil Nadu', '0', 'intrastate', 'intrastate', NULL, NULL, NULL, '123456||123456', '002||002', NULL, 'Coal Nozzle||Coal Nozzle', '||', '001||001', '1||1', 'KGS||KGS', '250||250', '15000||15000', '10||10', '10||10', '', '37500000.00||37500000.00', '0||0', 'amount_wise', '0||0', '37500000.00||37500000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1||1', NULL, 'P001010925', 'P001-2025', 1, 2, '05-09-2025||25-09-2025', 1);

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
  `typesgst` longtext DEFAULT NULL,
  `typecgst` longtext DEFAULT NULL,
  `typeigst` longtext DEFAULT NULL,
  `hsnno` longtext DEFAULT NULL,
  `itemcode` varchar(255) DEFAULT NULL,
  `itemname` longtext DEFAULT NULL,
  `uom` longtext DEFAULT NULL,
  `rate` longtext DEFAULT NULL,
  `qty` longtext DEFAULT NULL,
  `balanceqty` varchar(255) DEFAULT NULL,
  `bom_qty` varchar(255) NOT NULL,
  `amount` longtext DEFAULT NULL,
  `discount` longtext DEFAULT NULL,
  `discountBy` varchar(255) NOT NULL,
  `discountamount` longtext DEFAULT NULL,
  `taxableamount` longtext DEFAULT NULL,
  `sgst` longtext DEFAULT NULL,
  `sgstamount` longtext DEFAULT NULL,
  `cgst` longtext DEFAULT NULL,
  `cgstamount` longtext DEFAULT NULL,
  `igst` longtext DEFAULT NULL,
  `igstamount` longtext DEFAULT NULL,
  `total` longtext DEFAULT NULL,
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
  `return_status` longtext DEFAULT NULL,
  `grandtotal` varchar(225) DEFAULT NULL,
  `purchasenodate` varchar(225) DEFAULT NULL,
  `purchasenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `heatno` text DEFAULT NULL,
  `itemid` text DEFAULT NULL,
  `hsnno` varchar(255) DEFAULT NULL,
  `itemname` varchar(255) DEFAULT NULL,
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
  `bedadjs` varchar(200) DEFAULT NULL,
  `edcadjus` varchar(255) DEFAULT NULL,
  `sedadjus` varchar(255) DEFAULT NULL,
  `cstadjus` varchar(255) DEFAULT NULL,
  `taxpercentage` varchar(255) DEFAULT NULL,
  `purchasenoyear` varchar(255) DEFAULT NULL,
  `purchasenodate` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `purchaseorder_reports`
--

INSERT INTO `purchaseorder_reports` (`id`, `purchaseid`, `date`, `potype`, `purchaseorderno`, `purchaseorder`, `selected_bom`, `purchasedate`, `paymenttype`, `customerId`, `customername`, `address`, `invoiceno`, `invoicedate`, `batchno`, `itemcode`, `heatno`, `itemid`, `hsnno`, `itemname`, `uom`, `weight`, `grade`, `drawingno`, `rate`, `qty`, `balaceqty`, `bom_qty`, `total`, `subtotal`, `discount`, `disamount`, `taxname`, `taxamount`, `adjustment`, `grandtotal`, `taxtotal`, `adjus`, `vatadjus`, `paid`, `balance`, `workorderbalance`, `status`, `bedadjs`, `edcadjus`, `sedadjus`, `cstadjus`, `taxpercentage`, `purchasenoyear`, `purchasenodate`) VALUES
(1, '1', '2025-09-01', 'Direct PO', 'P001', '001', NULL, '2025-09-01', NULL, 1, 'jack', 'gandhipuram, singanallur, karaikudi, Tamil Nadu', '0', '2025-09-01', NULL, '002', NULL, NULL, '123456', 'Coal Nozzle', 'KGS', '250', '1', '001', '15000', '10', '10', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5', '1', NULL, NULL, NULL, NULL, NULL, 'P001-2025', 'P001010925'),
(2, '1', '2025-09-01', 'Direct PO', 'P001', '001', NULL, '2025-09-01', NULL, 1, 'jack', 'gandhipuram, singanallur, karaikudi, Tamil Nadu', '0', '2025-09-01', NULL, '002', NULL, NULL, '123456', 'Coal Nozzle', 'KGS', '250', '1', '001', '15000', '10', '10', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5', '1', NULL, NULL, NULL, NULL, NULL, 'P001-2025', 'P001010925');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `purchase_collection`
--

INSERT INTO `purchase_collection` (`id`, `date`, `date_po`, `purchasedate`, `invoicedate`, `receiptdate`, `throughcheck`, `receiptno`, `suppliername`, `mobileno`, `totalamount`, `purpose`, `alreadypaid`, `alreadybalance`, `chamount`, `banktransfer`, `bamount`, `bankamount`, `chequeno`, `paymentmode`, `amount`, `purchaseno`, `currentlypaid`, `balance`, `status`, `paymentdetails`, `overallamount`, `receiptamt`, `payment`, `paid`, `invoiceamt`, `invoiceno`, `purchasenodate`, `purchasenoyear`, `purchaseid`) VALUES
(1, '2025-06-21', '0000-00-00', NULL, NULL, '2025-06-21', NULL, 'V/25-26/-003', 'CK PRIME ALLOYS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '1', 'Cash', NULL, NULL, NULL, '2400', NULL, NULL, NULL, NULL, NULL),
(2, '2025-06-24', '0000-00-00', NULL, NULL, '2025-06-24', NULL, 'V/25-26/-005', 'Gateway', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '1', 'Cash', NULL, NULL, NULL, '500', NULL, NULL, NULL, NULL, NULL);

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
  `billtype` varchar(225) DEFAULT NULL,
  `gsttype` varchar(225) DEFAULT NULL,
  `typesgst` longtext DEFAULT NULL,
  `typecgst` longtext DEFAULT NULL,
  `typeigst` longtext DEFAULT NULL,
  `hsnno` longtext DEFAULT NULL,
  `itemcode` varchar(255) DEFAULT NULL,
  `heatno` text DEFAULT NULL,
  `itemid` text DEFAULT NULL,
  `itemname` longtext DEFAULT NULL,
  `uom` longtext DEFAULT NULL,
  `rate` longtext DEFAULT NULL,
  `qty` longtext DEFAULT NULL,
  `amount` longtext DEFAULT NULL,
  `discount` longtext DEFAULT NULL,
  `discountBy` varchar(255) NOT NULL,
  `discountamount` longtext DEFAULT NULL,
  `taxableamount` longtext DEFAULT NULL,
  `sgst` longtext DEFAULT NULL,
  `sgstamount` longtext DEFAULT NULL,
  `cgst` longtext DEFAULT NULL,
  `cgstamount` longtext DEFAULT NULL,
  `igst` longtext DEFAULT NULL,
  `igstamount` longtext DEFAULT NULL,
  `total` longtext DEFAULT NULL,
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
  `return_status` longtext DEFAULT NULL,
  `grandtotal` varchar(225) DEFAULT NULL,
  `purchasenodate` varchar(225) DEFAULT NULL,
  `purchasenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `vou_status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`id`, `date`, `purchasedate`, `invoicedate`, `purchasetype`, `purchaseno`, `supplierId`, `suppliername`, `address`, `invoiceno`, `billtype`, `gsttype`, `typesgst`, `typecgst`, `typeigst`, `hsnno`, `itemcode`, `heatno`, `itemid`, `itemname`, `uom`, `rate`, `qty`, `amount`, `discount`, `discountBy`, `discountamount`, `taxableamount`, `sgst`, `sgstamount`, `cgst`, `cgstamount`, `igst`, `igstamount`, `total`, `subtotal`, `freightamount`, `freightcgst`, `freightcgstamount`, `freightsgst`, `freightsgstamount`, `freightigst`, `freightigstamount`, `freighttotal`, `loadingamount`, `loadingcgst`, `loadingcgstamount`, `loadingsgst`, `loadingsgstamount`, `loadingigst`, `loadingigstamount`, `loadingtotal`, `othercharges`, `roundOff`, `return_status`, `grandtotal`, `purchasenodate`, `purchasenoyear`, `status`, `balance`, `vou_status`, `edit_status`) VALUES
(1, '2025-06-21', '2025-06-21', '2025-06-21', 'Direct Purchase', 'P001', 3, 'CK PRIME ALLOYS', 'ANNUR ROAD, KARUMATTAMPATTY, COIMBATORE, Tamil Nadu', 'OO1', 'intrastate', 'intrastate', 'sgst', 'cgst', '', '123456', NULL, NULL, NULL, 'EH OUTER BOX', 'KGS', '15000', '12', '180000.00', '0', 'amount_wise', '0', '180000.00', '9', '16200.00', '9', '16200.00', '18', '32400.00', '212400.00', '212400.00', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1', '212400.00', 'P001210625', 'P001-2025', 1, '212400.00', 1, 1),
(2, '2025-06-21', '2025-06-21', '2025-06-21', 'purchase Order', 'P002', 3, 'CK PRIME ALLOYS', 'ANNUR ROAD, KARUMATTAMPATTY, COIMBATORE, Tamil Nadu', '0098', 'intrastate', 'intrastate', 'sgst', 'cgst', '', '123456', NULL, NULL, NULL, 'EH OUTER BOX', 'KGS', '15000', '25', '375000.00', '0', 'amount_wise', '0', '375000.00', '9', '33750.00', '9', '33750.00', '9', '33750.00', '442500.00', '442500.00', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1', '442500.00', 'P0002210625', 'P0002-2025', 1, '442500.00', 1, 1),
(3, '2025-06-24', '2025-06-24', '2025-06-24', 'Direct Purchase', 'P003', 5, 'Gateway', 'Kasthuri nagar, Sri lakshmi apartement, Bangalore, Bangalore, Karnataka', '001', 'intrastate', 'intrastate', 'sgst', 'cgst', '', '00002', NULL, NULL, NULL, 'Stationary things', 'PACK', '170', '12', '2040.00', '0', 'amount_wise', '0', '2040.00', '7.5', '153.00', '7.5', '153.00', '15', '306.00', '2346.00', '2364.00', '6', '0', '0.00', '0', '0.00', '0', '0.00', '6.00', '12', '0', '0.00', '0', '0.00', '0', '0.00', '12.00', '0', '0', '0', '2364.00', 'P0003240625', 'P0003-2025', 1, '2364.00', 1, 0),
(4, '2025-09-11', '2025-09-11', '2025-09-11', 'purchase Order', 'P004', 3, 'CK PRIME ALLOYS', 'ANNUR ROAD, KARUMATTAMPATTY, COIMBATORE, Tamil Nadu', '001', 'intrastate', 'intrastate', 'sgst', 'cgst', '', '123456||123456', '002||002', '001||001', '1||1', 'Coal Nozzle||Coal Nozzle', 'KGS||KGS', '15000||15000', '5||5', '75000.00||75000.00', '0||0', 'amount_wise', '0||0', '75000.00||75000.00', '9||9', '6750.00||6750.00', '9||9', '6750.00||6750.00', '9||9', '6750.00||6750.00', '88500.00||88500.00', '177000.00', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1||1', '177000.00', 'P0004110925', 'P0004-2025', 1, '177000.00', 1, 1),
(5, '2025-09-11', '2025-09-11', '2025-09-11', 'purchase Order', 'P005', 3, 'CK PRIME ALLOYS', 'ANNUR ROAD, KARUMATTAMPATTY, COIMBATORE, Tamil Nadu', '001', 'intrastate', 'intrastate', 'sgst', 'cgst', '', '123456||123456', '002||002', '001||001', '1||1', 'Coal Nozzle||Coal Nozzle', 'KGS||KGS', '15000||15000', '5||5', '75000.00||75000.00', '0||0', 'amount_wise', '0||0', '75000.00||75000.00', '9||9', '6750.00||6750.00', '9||9', '6750.00||6750.00', '9||9', '6750.00||6750.00', '88500.00||88500.00', '177000.00', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1||1', '177000.00', 'P0004110925', 'P0004-2025', 1, '177000.00', 1, 1),
(6, '2025-09-11', '2025-09-11', '2025-09-11', 'purchase Order', 'P006', 3, 'CK PRIME ALLOYS', 'ANNUR ROAD, KARUMATTAMPATTY, COIMBATORE, Tamil Nadu', '001', 'intrastate', 'intrastate', 'sgst', 'cgst', '', '123456||123456', '002||002', '001||002', '1||1', 'Coal Nozzle||Coal Nozzle', 'KGS||KGS', '15000||15000', '6||6', '90000.00||90000.00', '0||0', 'amount_wise', '0||0', '90000.00||90000.00', '9||9', '8100.00||8100.00', '9||9', '8100.00||8100.00', '9||9', '6750.00||6750.00', '106200.00||106200.00', '212400.00', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1||1', '212400.00', 'P0006110925', 'P0006-2025', 1, '177000.00', 1, 1);

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
  `typesgst` longtext DEFAULT NULL,
  `typecgst` longtext DEFAULT NULL,
  `typeigst` longtext DEFAULT NULL,
  `hsnno` longtext DEFAULT NULL,
  `itemcode` varchar(255) DEFAULT NULL,
  `itemname` longtext DEFAULT NULL,
  `uom` longtext DEFAULT NULL,
  `rate` longtext DEFAULT NULL,
  `qty` longtext DEFAULT NULL,
  `amount` longtext DEFAULT NULL,
  `discount` longtext DEFAULT NULL,
  `discountBy` varchar(255) NOT NULL,
  `discountamount` longtext DEFAULT NULL,
  `taxableamount` longtext DEFAULT NULL,
  `sgst` longtext DEFAULT NULL,
  `sgstamount` longtext DEFAULT NULL,
  `cgst` longtext DEFAULT NULL,
  `cgstamount` longtext DEFAULT NULL,
  `igst` longtext DEFAULT NULL,
  `igstamount` longtext DEFAULT NULL,
  `total` longtext DEFAULT NULL,
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
  `return_status` longtext DEFAULT NULL,
  `grandtotal` varchar(225) DEFAULT NULL,
  `purchasenodate` varchar(225) DEFAULT NULL,
  `purchasenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `vou_status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `invoicedate` date DEFAULT NULL,
  `batchno` varchar(255) DEFAULT NULL,
  `itemcode` varchar(255) DEFAULT NULL,
  `heatno` varchar(255) DEFAULT NULL,
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
  `purchasenodate` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `purchase_reports`
--

INSERT INTO `purchase_reports` (`id`, `purchaseid`, `date`, `purchaseno`, `purchasedate`, `paymenttype`, `supplierId`, `suppliername`, `address`, `invoiceno`, `invoicedate`, `batchno`, `itemcode`, `heatno`, `itemid`, `hsnno`, `itemname`, `rate`, `qty`, `total`, `subtotal`, `discount`, `disamount`, `taxname`, `taxamount`, `adjustment`, `grandtotal`, `taxtotal`, `adjus`, `vatadjus`, `paid`, `balance`, `status`, `bedadjs`, `edcadjus`, `sedadjus`, `cstadjus`, `taxpercentage`, `purchasenoyear`, `purchasenodate`) VALUES
(1, '1', '2025-06-21', 'P001', '2025-06-21', NULL, 3, 'CK PRIME ALLOYS', 'ANNUR ROAD, KARUMATTAMPATTY, COIMBATORE, Tamil Nadu', 'OO1', '2025-06-21', NULL, NULL, NULL, NULL, '123456', 'EH OUTER BOX', '1', '12', '2', '212400.00', NULL, NULL, NULL, NULL, NULL, '212400.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'P001-2025', 'P001210625'),
(2, '2', '2025-06-21', 'P0002', '2025-06-21', NULL, 3, 'CK PRIME ALLOYS', 'ANNUR ROAD, KARUMATTAMPATTY, COIMBATORE, Tamil Nadu', '0098', '2025-06-21', NULL, NULL, NULL, NULL, '123456', 'EH OUTER BOX', '1', '25', '4', '442500.00', NULL, NULL, NULL, NULL, NULL, '442500.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'P0002-2025', 'P0002210625'),
(3, '3', '2025-06-24', 'P0003', '2025-06-24', NULL, 5, 'Gateway', 'Kasthuri nagar, Sri lakshmi apartement, Bangalore, Bangalore, Karnataka', '001', '2025-06-24', NULL, NULL, NULL, NULL, '00002', 'Stationary things', '1', '12', '2', '2364.00', NULL, NULL, NULL, NULL, NULL, '2364.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'P0003-2025', 'P0003240625'),
(4, '5', '2025-09-11', 'P0004', '2025-09-11', NULL, 3, 'CK PRIME ALLOYS', 'ANNUR ROAD, KARUMATTAMPATTY, COIMBATORE, Tamil Nadu', '001', '2025-09-11', NULL, '002', '001', '1', '123456', 'Coal Nozzle', '1', '5', '8', '177000.00', NULL, NULL, NULL, NULL, NULL, '177000.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'P0004-2025', 'P0004110925'),
(5, '5', '2025-09-11', 'P0004', '2025-09-11', NULL, 3, 'CK PRIME ALLOYS', 'ANNUR ROAD, KARUMATTAMPATTY, COIMBATORE, Tamil Nadu', '001', '2025-09-11', NULL, '002', '001', '1', '123456', 'Coal Nozzle', '5', '5', '8', '177000.00', NULL, NULL, NULL, NULL, NULL, '177000.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'P0004-2025', 'P0004110925'),
(11, '6', '2025-09-12', 'P006', '2025-09-11', NULL, 0, 'CK PRIME ALLOYS', 'ANNUR ROAD, KARUMATTAMPATTY, COIMBATORE, Tamil Nadu', '001', '2025-09-11', NULL, '002', NULL, '|', '123456', 'Coal Nozzle', '5', '6', '0', '212400.00', NULL, NULL, NULL, NULL, NULL, '212400.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, '6', '2025-09-12', 'P006', '2025-09-11', NULL, 0, 'CK PRIME ALLOYS', 'ANNUR ROAD, KARUMATTAMPATTY, COIMBATORE, Tamil Nadu', '001', '2025-09-11', NULL, '002', NULL, '|', '123456', 'Coal Nozzle', '1', '6', '1', '212400.00', NULL, NULL, NULL, NULL, NULL, '212400.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
  `typesgst` longtext DEFAULT NULL,
  `typecgst` longtext DEFAULT NULL,
  `typeigst` longtext DEFAULT NULL,
  `hsnno` longtext DEFAULT NULL,
  `itemname` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `uom` longtext DEFAULT NULL,
  `rate` longtext DEFAULT NULL,
  `qty` longtext DEFAULT NULL,
  `amount` longtext DEFAULT NULL,
  `discount` longtext DEFAULT NULL,
  `discountamount` longtext DEFAULT NULL,
  `taxableamount` longtext DEFAULT NULL,
  `sgst` longtext DEFAULT NULL,
  `sgstamount` longtext DEFAULT NULL,
  `cgst` longtext DEFAULT NULL,
  `cgstamount` longtext DEFAULT NULL,
  `igst` longtext DEFAULT NULL,
  `igstamount` longtext DEFAULT NULL,
  `total` longtext DEFAULT NULL,
  `subtotal` varchar(225) DEFAULT NULL,
  `freightcharges` varchar(225) DEFAULT NULL,
  `packingcharges` varchar(225) DEFAULT NULL,
  `othercharges` varchar(225) DEFAULT NULL,
  `return_status` longtext DEFAULT NULL,
  `grandtotal` varchar(225) DEFAULT NULL,
  `purchasenodate` varchar(225) DEFAULT NULL,
  `purchasenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `quotation_details`
--

INSERT INTO `quotation_details` (`id`, `date`, `quotationdate`, `gstinno`, `invoicedate`, `quotationno`, `customerId`, `customername`, `address`, `invoiceno`, `billtype`, `gsttype`, `typesgst`, `typecgst`, `typeigst`, `hsnno`, `itemname`, `description`, `uom`, `rate`, `qty`, `amount`, `discount`, `discountamount`, `taxableamount`, `sgst`, `sgstamount`, `cgst`, `cgstamount`, `igst`, `igstamount`, `total`, `subtotal`, `freightcharges`, `packingcharges`, `othercharges`, `return_status`, `grandtotal`, `purchasenodate`, `purchasenoyear`, `status`, `edit_status`) VALUES
(1, '2025-06-23', '2025-06-23', NULL, NULL, 'Q001', 4, 'IT Solution', 'Hoysala nagar, Ramamurthy signal, Kasthuri nagar, Bangalore, Karnataka', NULL, NULL, 'intrastate', NULL, NULL, NULL, '00002', 'Stationary things', NULL, 'PACK', '170', '12', '2040.00', '0', '0', '2040.00', '7.5', '153.00', '7.5', '153.00', '15', '', '2040.00', '2040.00', NULL, NULL, NULL, NULL, '2346.00', NULL, NULL, 1, 1);

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
  `typesgst` longtext DEFAULT NULL,
  `typecgst` longtext DEFAULT NULL,
  `typeigst` longtext DEFAULT NULL,
  `hsnno` longtext DEFAULT NULL,
  `itemname` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `uom` longtext DEFAULT NULL,
  `rate` longtext DEFAULT NULL,
  `qty` longtext DEFAULT NULL,
  `amount` longtext DEFAULT NULL,
  `discount` longtext DEFAULT NULL,
  `discountamount` longtext DEFAULT NULL,
  `taxableamount` longtext DEFAULT NULL,
  `sgst` longtext DEFAULT NULL,
  `sgstamount` longtext DEFAULT NULL,
  `cgst` longtext DEFAULT NULL,
  `cgstamount` longtext DEFAULT NULL,
  `igst` longtext DEFAULT NULL,
  `igstamount` longtext DEFAULT NULL,
  `total` longtext DEFAULT NULL,
  `subtotal` varchar(225) DEFAULT NULL,
  `freightcharges` varchar(225) DEFAULT NULL,
  `packingcharges` varchar(225) DEFAULT NULL,
  `othercharges` varchar(225) DEFAULT NULL,
  `return_status` longtext DEFAULT NULL,
  `grandtotal` varchar(225) DEFAULT NULL,
  `purchasenodate` varchar(225) DEFAULT NULL,
  `purchasenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `hsnno` longtext DEFAULT NULL,
  `itemname` longtext DEFAULT NULL,
  `rate` longtext DEFAULT NULL,
  `qty` longtext DEFAULT NULL,
  `uom` longtext DEFAULT NULL,
  `amount` longtext DEFAULT NULL,
  `discount` longtext DEFAULT NULL,
  `taxableamount` longtext DEFAULT NULL,
  `discountamount` longtext DEFAULT NULL,
  `cgst` longtext DEFAULT NULL,
  `cgstamount` longtext DEFAULT NULL,
  `sgst` longtext DEFAULT NULL,
  `sgstamount` longtext DEFAULT NULL,
  `igst` longtext DEFAULT NULL,
  `igstamount` longtext DEFAULT NULL,
  `total` longtext DEFAULT NULL,
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sales_return`
--

INSERT INTO `sales_return` (`id`, `date`, `returndate`, `types`, `time`, `dateofissue`, `customername`, `customerid`, `supplierid`, `gsttype`, `suppliername`, `openingbal`, `outstandingamount`, `returnno`, `description`, `invoiceno`, `purchaseno`, `itemno`, `hsnno`, `itemname`, `rate`, `qty`, `uom`, `amount`, `discount`, `taxableamount`, `discountamount`, `cgst`, `cgstamount`, `sgst`, `sgstamount`, `igst`, `igstamount`, `total`, `subtotal`, `freightamount`, `freightcgst`, `freightcgstamount`, `freightsgst`, `freightsgstamount`, `freightigst`, `freightigstamount`, `freighttotal`, `loadingamount`, `loadingcgst`, `loadingcgstamount`, `loadingsgst`, `loadingsgstamount`, `loadingigst`, `loadingigstamount`, `loadingtotal`, `othercharges`, `grandtotal`, `status`) VALUES
(1, '2025-06-24', '2025-06-24', 'Credit', '11:14:26 PM', '2025-06-24', '-', '-', '5', 'intrastate', 'Gateway', '1864', NULL, 'C001', 'Package damage', '-', 'P003', NULL, '00002', 'Stationary things', '170', '5', 'PACK', '850.00', '0', '850.00', '0.00', '7.5', '63.75', '7.5', '63.75', '15', '', '977.50', '995.50', '6', '0', '0.00', '0', '0.00', '0', '0.00', '6.00', '12', '0', '0.00', '0', '0.00', '0', '0.00', '12.00', '0', '995.50', '1');

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
  `hsnno` longtext DEFAULT NULL,
  `itemname` longtext DEFAULT NULL,
  `rate` longtext DEFAULT NULL,
  `qty` longtext DEFAULT NULL,
  `uom` longtext DEFAULT NULL,
  `amount` longtext DEFAULT NULL,
  `discount` longtext DEFAULT NULL,
  `taxableamount` longtext DEFAULT NULL,
  `discountamount` longtext DEFAULT NULL,
  `cgst` longtext DEFAULT NULL,
  `cgstamount` longtext DEFAULT NULL,
  `sgst` longtext DEFAULT NULL,
  `sgstamount` longtext DEFAULT NULL,
  `igst` longtext DEFAULT NULL,
  `igstamount` longtext DEFAULT NULL,
  `total` longtext DEFAULT NULL,
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statecode`
--

CREATE TABLE `statecode` (
  `id` int(11) NOT NULL,
  `state` varchar(255) NOT NULL,
  `stateCode` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `total` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `balance` varchar(255) NOT NULL,
  `oldqty` varchar(255) DEFAULT NULL,
  `currentstock` varchar(255) DEFAULT NULL,
  `stat` varchar(255) NOT NULL,
  `stockdate` date DEFAULT NULL,
  `priceType` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `date`, `hsnno`, `heatno`, `itemid`, `itemcode`, `sgst`, `cgst`, `igst`, `itemname`, `quantity`, `rate`, `updatestock`, `total`, `status`, `balance`, `oldqty`, `currentstock`, `stat`, `stockdate`, `priceType`) VALUES
(1, '2025-09-12', '123456', '001', '1', '002', '9', '9', '9', 'Coal Nozzle', '5', '15000', '6', '', '', '-24', NULL, NULL, '', '2025-09-11', 'Exclusive'),
(2, '2025-09-12', '123456', '002', '|', '002', '9', '9', '9', 'Coal Nozzle', '5', '15000', '6', '', '', '-24', NULL, NULL, '', '2025-09-11', 'Exclusive');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `stock_reports`
--

INSERT INTO `stock_reports` (`id`, `date`, `hsnno`, `heatno`, `itemid`, `itemcode`, `itemname`, `status`, `updatestock`, `stat`, `stockdate`, `purchaseid`, `balance`, `priceType`) VALUES
(6, '2025-09-12', '123456', '002', '|', '002', 'Coal Nozzle', NULL, '6', '', '2025-09-11', '6', NULL, ''),
(5, '2025-09-12', '123456', '001', '1', '002', 'Coal Nozzle', NULL, '6', '', '2025-09-11', '6', NULL, '');

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
  `billtype` varchar(225) DEFAULT NULL,
  `gsttype` varchar(225) DEFAULT NULL,
  `typesgst` longtext DEFAULT NULL,
  `typecgst` longtext DEFAULT NULL,
  `typeigst` longtext DEFAULT NULL,
  `hsnno` longtext DEFAULT NULL,
  `itemcode` varchar(100) NOT NULL,
  `itemname` longtext DEFAULT NULL,
  `grade` varchar(100) NOT NULL,
  `workorderno` varchar(100) NOT NULL,
  `workorderid` varchar(100) NOT NULL,
  `drawingno` varchar(100) NOT NULL,
  `uom` longtext DEFAULT NULL,
  `weight` varchar(100) DEFAULT NULL,
  `rate` longtext DEFAULT NULL,
  `qty` longtext DEFAULT NULL,
  `balanceqty` varchar(255) DEFAULT NULL,
  `bom_qty` varchar(255) NOT NULL,
  `amount` longtext DEFAULT NULL,
  `discount` longtext DEFAULT NULL,
  `discountBy` varchar(255) NOT NULL,
  `discountamount` longtext DEFAULT NULL,
  `taxableamount` longtext DEFAULT NULL,
  `sgst` longtext DEFAULT NULL,
  `sgstamount` longtext DEFAULT NULL,
  `cgst` longtext DEFAULT NULL,
  `cgstamount` longtext DEFAULT NULL,
  `igst` longtext DEFAULT NULL,
  `igstamount` longtext DEFAULT NULL,
  `total` longtext DEFAULT NULL,
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
  `return_status` longtext DEFAULT NULL,
  `grandtotal` varchar(225) DEFAULT NULL,
  `purchasenodate` varchar(225) DEFAULT NULL,
  `purchasenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sup_purchaseorder_details`
--

INSERT INTO `sup_purchaseorder_details` (`id`, `date`, `purchasedate`, `invoicedate`, `deliverydate`, `potype`, `purchaseorderno`, `purchaseorder`, `selected_bom`, `supplierid`, `suppliername`, `customerId`, `customername`, `address`, `shipTo`, `shipToAddress`, `invoiceno`, `billtype`, `gsttype`, `typesgst`, `typecgst`, `typeigst`, `hsnno`, `itemcode`, `itemname`, `grade`, `workorderno`, `workorderid`, `drawingno`, `uom`, `weight`, `rate`, `qty`, `balanceqty`, `bom_qty`, `amount`, `discount`, `discountBy`, `discountamount`, `taxableamount`, `sgst`, `sgstamount`, `cgst`, `cgstamount`, `igst`, `igstamount`, `total`, `subtotal`, `freightamount`, `freightcgst`, `freightcgstamount`, `freightsgst`, `freightsgstamount`, `freightigst`, `freightigstamount`, `freighttotal`, `loadingamount`, `loadingcgst`, `loadingcgstamount`, `loadingsgst`, `loadingsgstamount`, `loadingigst`, `loadingigstamount`, `loadingtotal`, `othercharges`, `roundOff`, `return_status`, `grandtotal`, `purchasenodate`, `purchasenoyear`, `status`, `edit_status`) VALUES
(1, '2025-09-01', '2025-09-01', NULL, '01-09-2025', 'workorder', 'P001', NULL, NULL, '3', 'CK PRIME ALLOYS', 1, 'jack', 'ANNUR ROAD, KARUMATTAMPATTY, COIMBATORE, Tamil Nadu', NULL, NULL, '0', 'intrastate', 'intrastate', 'sgst', 'cgst', '', '123456||123456', '002||002', 'Coal Nozzle||Coal Nozzle', '1||1', 'P001', '1||2', '001||001', 'KGS||KGS', '250||250', '15000||15000', '5||5', '5||5', '', '18750000.00||18750000.00', NULL, 'amount_wise', '||', '18750000.00||18750000.00', '6', '2250000.00', '6', '2250000.00', '0||0', '0||0', NULL, '37500000.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1||1', '42000000.00', 'P001010925', 'P001-2025', 1, 1);

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
  `typesgst` longtext DEFAULT NULL,
  `typecgst` longtext DEFAULT NULL,
  `typeigst` longtext DEFAULT NULL,
  `hsnno` longtext DEFAULT NULL,
  `itemname` longtext DEFAULT NULL,
  `uom` longtext DEFAULT NULL,
  `rate` longtext DEFAULT NULL,
  `qty` longtext DEFAULT NULL,
  `balanceqty` varchar(255) DEFAULT NULL,
  `bom_qty` varchar(255) NOT NULL,
  `amount` longtext DEFAULT NULL,
  `discount` longtext DEFAULT NULL,
  `discountBy` varchar(255) NOT NULL,
  `discountamount` longtext DEFAULT NULL,
  `taxableamount` longtext DEFAULT NULL,
  `sgst` longtext DEFAULT NULL,
  `sgstamount` longtext DEFAULT NULL,
  `cgst` longtext DEFAULT NULL,
  `cgstamount` longtext DEFAULT NULL,
  `igst` longtext DEFAULT NULL,
  `igstamount` longtext DEFAULT NULL,
  `total` longtext DEFAULT NULL,
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
  `return_status` longtext DEFAULT NULL,
  `grandtotal` varchar(225) DEFAULT NULL,
  `purchasenodate` varchar(225) DEFAULT NULL,
  `purchasenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `itemname` varchar(255) DEFAULT NULL,
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
  `purchasenodate` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sup_purchaseorder_reports`
--

INSERT INTO `sup_purchaseorder_reports` (`id`, `purchaseid`, `date`, `potype`, `purchaseorderno`, `purchaseorder`, `selected_bom`, `purchasedate`, `paymenttype`, `customerId`, `customername`, `supplierid`, `suppliername`, `address`, `invoiceno`, `invoicedate`, `deliverydate`, `batchno`, `itemno`, `hsnno`, `itemcode`, `itemname`, `uom`, `weight`, `rate`, `qty`, `grade`, `drawingno`, `workorderid`, `workorderno`, `balaceqty`, `bom_qty`, `total`, `subtotal`, `discount`, `disamount`, `taxname`, `taxamount`, `adjustment`, `grandtotal`, `taxtotal`, `adjus`, `vatadjus`, `paid`, `balance`, `status`, `bedadjs`, `edcadjus`, `sedadjus`, `cstadjus`, `taxpercentage`, `purchasenoyear`, `purchasenodate`) VALUES
(1, '1', '2025-09-01', 'workorder', 'P001', NULL, NULL, '2025-09-01', NULL, 1, 'jack', '3', 'CK PRIME ALLOYS', 'ANNUR ROAD, KARUMATTAMPATTY, COIMBATORE, Tamil Nadu', '0', NULL, '01-09-2025', NULL, NULL, '123456', '002', 'Coal Nozzle', 'KGS', '250', '1', '5', '1', '001', '1||2', 'P001', '5', '', NULL, '37500000.00', NULL, NULL, NULL, NULL, NULL, '42000000.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'P001-2025', 'P001010925'),
(2, '1', '2025-09-01', 'workorder', 'P001', NULL, NULL, '2025-09-01', NULL, 1, 'jack', '3', 'CK PRIME ALLOYS', 'ANNUR ROAD, KARUMATTAMPATTY, COIMBATORE, Tamil Nadu', '0', NULL, '01-09-2025', NULL, NULL, '123456', '002', 'Coal Nozzle', 'KGS', '250', '5', '5', '1', '001', '1||2', 'P001', '5', '', NULL, '37500000.00', NULL, NULL, NULL, NULL, NULL, '42000000.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'P001-2025', 'P001010925');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_person`
--

CREATE TABLE `tbl_person` (
  `id` bigint(20) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `dob` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `uom`
--

CREATE TABLE `uom` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `uom` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`id`, `date`, `voucherid`, `cus_suppId`, `name`, `voucherdate`, `vouchertype`, `purpose`, `paymentmode`, `throughcheck`, `chequeno`, `chamount`, `banktransfer`, `bamount`, `amount`, `paymentdetails`, `transactionid`, `chequedate`, `overallamount`, `voucheramount`, `tdsamount`, `status`, `invoiceno`, `purchaseno`, `balance_amt`, `otherBank`) VALUES
(1, '2025-06-20', 'V/25-26/-001', 1, 'jack', '2025-06-20', 'payment', '', 'Cash', '', '', '', '', '', '1100', 'Cash', NULL, NULL, '1100', '1100', '', '1', NULL, NULL, '', 0),
(3, '2025-06-21', 'V/25-26/-002', 2, 'SIGMA POWER', '2025-06-21', 'payment', '', 'Cash', '0', '', '', '0', '', '8800', 'Cash', NULL, NULL, '8800', '8800', '', '1', NULL, NULL, '', 0),
(4, '2025-06-21', 'V/25-26/-003', 3, 'CK PRIME ALLOYS', '2025-06-21', 'receipt', '', 'Cash', '0', '', '', '0', '', '2400', 'Cash', NULL, NULL, '2400', '2400', '', '1', NULL, NULL, '', 0),
(5, '2025-06-24', 'V/25-26/-004', 4, 'IT Solution', '2025-06-24', 'payment', 'Online Purchase', 'Cash', '0', '', '', '0', '', '500', 'Cash', NULL, NULL, '500', '500', '', '1', NULL, NULL, '', 0),
(6, '2025-06-24', 'V/25-26/-005', 5, 'Gateway', '2025-06-24', 'receipt', 'Online Purchase', 'Cash', '0', '', '', '0', '', '500', 'Cash', NULL, NULL, '500', '500', '', '1', NULL, NULL, '', 0);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dcbill_details`
--
ALTER TABLE `dcbill_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `dcbill_details_backup`
--
ALTER TABLE `dcbill_details_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dc_delivery`
--
ALTER TABLE `dc_delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `einvoicetoken`
--
ALTER TABLE `einvoicetoken`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `expenses_backup`
--
ALTER TABLE `expenses_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `invoice_details_backup`
--
ALTER TABLE `invoice_details_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_party_statement`
--
ALTER TABLE `invoice_party_statement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `invoice_party_statement_backup`
--
ALTER TABLE `invoice_party_statement_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_reports`
--
ALTER TABLE `invoice_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `inward_delivery`
--
ALTER TABLE `inward_delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `inward_details`
--
ALTER TABLE `inward_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobworkdc_delivery_backup`
--
ALTER TABLE `jobworkdc_delivery_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobworkdc_details`
--
ALTER TABLE `jobworkdc_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `mtc_report`
--
ALTER TABLE `mtc_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `po_party_statements`
--
ALTER TABLE `po_party_statements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `proforma_invoice_details_backup`
--
ALTER TABLE `proforma_invoice_details_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proforma_invoice_reports`
--
ALTER TABLE `proforma_invoice_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `proinvoice_party_statement`
--
ALTER TABLE `proinvoice_party_statement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchaseorder_details`
--
ALTER TABLE `purchaseorder_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchaseorder_details_backup`
--
ALTER TABLE `purchaseorder_details_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchaseorder_reports`
--
ALTER TABLE `purchaseorder_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_collection`
--
ALTER TABLE `purchase_collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `purchase_details_backup`
--
ALTER TABLE `purchase_details_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_reports`
--
ALTER TABLE `purchase_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `quotation_details`
--
ALTER TABLE `quotation_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quotation_details_backup`
--
ALTER TABLE `quotation_details_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_return`
--
ALTER TABLE `sales_return`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock_reports`
--
ALTER TABLE `stock_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sup_purchaseorder_details`
--
ALTER TABLE `sup_purchaseorder_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sup_purchaseorder_details_backup`
--
ALTER TABLE `sup_purchaseorder_details_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sup_purchaseorder_reports`
--
ALTER TABLE `sup_purchaseorder_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `voucher_backup`
--
ALTER TABLE `voucher_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
