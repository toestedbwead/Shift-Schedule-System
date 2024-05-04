-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2024 at 06:46 PM
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
(27, 'Person 1', 'Full-time', 'Doctor', 'Emergency-dept'),
(28, 'Person 2', 'Part-time', 'Nurse', 'Pediatric'),
(29, 'Person 3', 'Contract', 'Nurse-practitioner', 'Pediatric'),
(30, 'Person 4', 'Part-time', 'Surgeon', 'Gynecology'),
(31, 'Person 5', 'Contract', 'Surgeon', 'Internal-medicine'),
(32, 'Person 6', 'Contract', 'Surgeon', 'Pediatric');

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
(2, 'admin@gmail.com', 'admin', 1),
(3, 'hello@gmail.com', 'hello', 0);

-- --------------------------------------------------------

--
-- Table structure for table `shift_table`
--

CREATE TABLE `shift_table` (
  `shift_id` int(25) NOT NULL,
  `employeeName` varchar(255) NOT NULL,
  `shift_type` varchar(255) NOT NULL,
  `shift_time` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `day` varchar(255) NOT NULL,
  `notes` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shift_table`
--

INSERT INTO `shift_table` (`shift_id`, `employeeName`, `shift_type`, `shift_time`, `date`, `day`, `notes`) VALUES
(25, 'Person 3', 'Morning', '6:00 am - 2:00 pm', '05/14/2024', 'Tuesday', 'dadaudaud'),
(26, 'Person 4', 'Evening', '10:00 pm - 6:00 am', '05/15/2024', 'Wednesday', 'jdahjhfaefiuwutegf'),
(27, 'Person 5', 'Afternoon', '2:00 pm - 10:00 pm', '05/12/2024', 'Sunday', 'daefae'),
(28, 'Person 6', 'Afternoon', '2:00 pm - 10:00 pm', '05/16/2024', 'Thursday', 'fegfwsgw');

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
-- Indexes for table `shift_table`
--
ALTER TABLE `shift_table`
  ADD PRIMARY KEY (`shift_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee_table`
--
ALTER TABLE `employee_table`
  MODIFY `emp_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `login_table`
--
ALTER TABLE `login_table`
  MODIFY `login_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shift_table`
--
ALTER TABLE `shift_table`
  MODIFY `shift_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
