-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 29, 2021 at 07:59 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id17675919_basic_banking_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `debtor` varchar(100) NOT NULL,
  `creditor` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`debtor`, `creditor`, `amount`) VALUES
('Arya Rajani', 'Rakhi Chiranjeevi', 300000),
('Arya Rajani', 'Abhishek Dhaval', 400000),
('Arya Rajani', 'Jagadish Chandra', 500000),
('Arya Rajani', 'Bharat Bachchan', 700000),
('Arya Rajani', 'Sujay Ahmad', 300000),
('Arya Rajani', 'Lakshmi Misra', 200000),
('Arya Rajani', 'Dip Gupta', 500000),
('Arya Rajani', 'Indrajit Sharma', 600000),
('Arya Rajani', 'Harsh Jain', 800000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `fname`, `lname`, `balance`) VALUES
(1, 'Arya', 'Rajani', 349991),
(2, 'Rakhi', 'Chiranjeevi', 300001),
(3, 'Abhishek', 'Dhaval', 400001),
(4, 'Jagadish', 'Chandra', 500001),
(5, 'Bharat', 'Bachchan', 700001),
(6, 'Sujay', 'Ahmad', 300001),
(7, 'Lakshmi', 'Misra', 200001),
(8, 'Dip', 'Gupta', 500001),
(9, 'Indrajit', 'Sharma', 600001),
(10, 'Harsh', 'Jain', 800001);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
