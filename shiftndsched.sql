-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2024 at 06:30 PM
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
-- Database: `shiftndsched`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee_table`
--

CREATE TABLE `employee_table` (
  `emp_id` int(25) NOT NULL,
  `emp_name` varchar(255) NOT NULL,
  `emp_status` varchar(255) NOT NULL,
  `emp_role` varchar(255) NOT NULL,
  `emp_department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_table`
--

INSERT INTO `employee_table` (`emp_id`, `emp_name`, `emp_status`, `emp_role`, `emp_department`) VALUES
(11, 'Lei Elcano', 'Full-time', 'Nurse', 'Surgery'),
(14, 'Nicole Gumball', 'contract', 'physician-assistant', 'internal-medicine'),
(15, 'Khem Gicana', 'Full-time', 'Doctor', 'Emergency-dept'),
(16, '123', 'Full-time', 'Nurse', 'Surgery'),
(17, '456', 'Full-time', 'Nurse', 'Neurology'),
(18, '678', 'Contract', 'Physician-assistant', 'Pediatric'),
(19, '91011', 'Contract', 'Physician-assistant', 'Gynecology'),
(20, '121314', 'Contract', 'Physician-assistant', 'Pediatric'),
(21, '151617', 'Part-time', 'Surgeon', 'Pediatric'),
(22, '181920', 'Part-time', 'Surgeon', 'Internal-medicine'),
(23, '21121', 'Contract', 'Nurse', 'Internal-medicine'),
(24, '222', 'Part-time', 'Doctor', 'Surgery'),
(25, 'aaaa', 'Full-time', 'Doctor', 'Pediatric'),
(26, 'dddd', 'Part-time', 'Surgeon', 'Surgery');

-- --------------------------------------------------------

--
-- Table structure for table `login_table`
--

CREATE TABLE `login_table` (
  `login_id` int(25) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Account_type` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_table`
--

INSERT INTO `login_table` (`login_id`, `Email`, `password`, `Account_type`) VALUES
(1, 'leielcano@gmail.com', 'shuusakamaki', 0),
(2, 'admin@gmail.com', 'admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee_table`
--
ALTER TABLE `employee_table`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `login_table`
--
ALTER TABLE `login_table`
  ADD PRIMARY KEY (`login_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee_table`
--
ALTER TABLE `employee_table`
  MODIFY `emp_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `login_table`
--
ALTER TABLE `login_table`
  MODIFY `login_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
