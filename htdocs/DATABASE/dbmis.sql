-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2021 at 08:43 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbmis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblalbum`
--

CREATE TABLE `tblalbum` (
  `albumcode` char(3) NOT NULL,
  `catcode` char(3) DEFAULT NULL,
  `albumname` varchar(60) DEFAULT NULL,
  `artistcode` char(3) DEFAULT NULL,
  `albumwriter` varchar(100) DEFAULT NULL,
  `albumdesc` varchar(250) DEFAULT NULL,
  `albumimage` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblartist`
--

CREATE TABLE `tblartist` (
  `artistcode` char(3) NOT NULL,
  `artistname` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `catcode` char(3) NOT NULL,
  `catname` varchar(50) DEFAULT NULL,
  `catdesc` varchar(250) DEFAULT NULL,
  `catimage` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblfeedback`
--

CREATE TABLE `tblfeedback` (
  `f_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `message` varchar(250) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblhelp`
--

CREATE TABLE `tblhelp` (
  `Code` char(3) NOT NULL,
  `Data` varchar(50) NOT NULL DEFAULT '',
  `Tag` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblhelp`
--

INSERT INTO `tblhelp` (`Code`, `Data`, `Tag`) VALUES
('001', 'Active', '01'),
('002', 'Inactive', '01'),
('003', 'Bengali', '05'),
('004', 'Hindi', '05'),
('005', 'English', '05'),
('006', 'Others', '05');

-- --------------------------------------------------------

--
-- Table structure for table `tblip`
--

CREATE TABLE `tblip` (
  `ip_id` int(100) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `time` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblslider`
--

CREATE TABLE `tblslider` (
  `id` char(3) NOT NULL,
  `image` varchar(50) NOT NULL,
  `imgtitle` varchar(50) NOT NULL,
  `imgdesc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblslider`
--

INSERT INTO `tblslider` (`id`, `image`, `imgtitle`, `imgdesc`) VALUES
('001', 'slider-001.jpg', 'Test001    ', 'Test001'),
('002', 'slider-002.jpg', 'Test002', 'Test002');

-- --------------------------------------------------------

--
-- Table structure for table `tblsongs`
--

CREATE TABLE `tblsongs` (
  `songcode` char(3) NOT NULL,
  `songname` varchar(50) NOT NULL,
  `songdesc` varchar(50) NOT NULL,
  `albumcode` char(3) NOT NULL,
  `songtype` char(3) NOT NULL,
  `song` varchar(50) NOT NULL DEFAULT '',
  `status` char(3) NOT NULL DEFAULT '001',
  `UploadDt` date NOT NULL,
  `dwncount` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `user_id` char(3) NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(30) NOT NULL,
  `mobileno` int(10) NOT NULL,
  `password` varchar(30) NOT NULL,
  `usertype` char(3) NOT NULL,
  `Status` char(3) NOT NULL DEFAULT '001',
  `image` varchar(25) NOT NULL DEFAULT '',
  `regdt` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`user_id`, `name`, `username`, `mobileno`, `password`, `usertype`, `Status`, `image`, `regdt`) VALUES
('001', 'Jahar', 'q', 0, 'q', '050', '001', 'Adm-001.png', '2021-05-05');

-- --------------------------------------------------------

--
-- Table structure for table `tblvotes`
--

CREATE TABLE `tblvotes` (
  `vid` int(10) NOT NULL,
  `vname` varchar(50) NOT NULL,
  `vpoints` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblalbum`
--
ALTER TABLE `tblalbum`
  ADD PRIMARY KEY (`albumcode`);

--
-- Indexes for table `tblartist`
--
ALTER TABLE `tblartist`
  ADD PRIMARY KEY (`artistcode`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`catcode`);

--
-- Indexes for table `tblfeedback`
--
ALTER TABLE `tblfeedback`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `tblhelp`
--
ALTER TABLE `tblhelp`
  ADD PRIMARY KEY (`Code`);

--
-- Indexes for table `tblip`
--
ALTER TABLE `tblip`
  ADD PRIMARY KEY (`ip_id`);

--
-- Indexes for table `tblslider`
--
ALTER TABLE `tblslider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsongs`
--
ALTER TABLE `tblsongs`
  ADD PRIMARY KEY (`songcode`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tblvotes`
--
ALTER TABLE `tblvotes`
  ADD PRIMARY KEY (`vid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblfeedback`
--
ALTER TABLE `tblfeedback`
  MODIFY `f_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tblip`
--
ALTER TABLE `tblip`
  MODIFY `ip_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `tblvotes`
--
ALTER TABLE `tblvotes`
  MODIFY `vid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
