-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 29, 2024 at 06:32 PM
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
-- Table structure for table `clock_table`
--

CREATE TABLE `clock_table` (
  `userID` int(11) NOT NULL,
  `employeeName` varchar(50) NOT NULL,
  `clockDate` varchar(50) NOT NULL,
  `clockInTime` varchar(50) NOT NULL,
  `clockOutTime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clock_table`
--

INSERT INTO `clock_table` (`userID`, `employeeName`, `clockDate`, `clockInTime`, `clockOutTime`) VALUES
(3, 'Pogi ni Kefi', '2024-05-09', '13:06', '13:08'),
(4, 'Ink Keu', '0777-02-05', '14:22', '14:22');

-- --------------------------------------------------------

--
-- Table structure for table `employee_table`
--

CREATE TABLE `employee_table` (
  `emp_id` int(25) NOT NULL,
  `emp_name` varchar(255) NOT NULL,
  `emp_status` varchar(255) NOT NULL,
  `emp_role` varchar(255) NOT NULL,
  `emp_department` varchar(255) NOT NULL,
  `emp_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_table`
--

INSERT INTO `employee_table` (`emp_id`, `emp_name`, `emp_status`, `emp_role`, `emp_department`, `emp_img`) VALUES
(35, 'ff', 'Full-time', 'Doctor', 'Internal-medicine', 'system-pfp.png');

-- --------------------------------------------------------

--
-- Table structure for table `login_table`
--

CREATE TABLE `login_table` (
  `login_id` int(25) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Account_type` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_table`
--

INSERT INTO `login_table` (`login_id`, `Email`, `phone`, `password`, `Account_type`) VALUES
(2, 'admin@gmail.com', '0', 'admin', 1),
(3, 'hello@gmail.com', '0', 'hello', 0),
(4, 'pogingkefi@gmail.com', '0', 'hello', 0),
(5, 'kenneth@gmail.com', '2147483647', 'hello', 0),
(6, 'ran@gmail.com', '2147483647', 'lol', 0),
(7, 'adi@gmail.com', '09851752846', 'hello', 0),
(8, 'kin66520@gmail.com', '12345678888', 'hello', 0),
(9, 'leielcano@gmail.com', '12354212222', 'iloveyoubebe', 0);

-- --------------------------------------------------------

--
-- Table structure for table `shift_change_requests`
--

CREATE TABLE `shift_change_requests` (
  `requestID` int(11) NOT NULL,
  `employeeName` varchar(255) NOT NULL,
  `currentShiftDate` varchar(50) NOT NULL,
  `currentShiftType` varchar(50) NOT NULL,
  `desiredShiftDate` varchar(50) NOT NULL,
  `desiredShiftType` varchar(50) NOT NULL,
  `swapEmployeeName` varchar(255) DEFAULT NULL,
  `requestDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shift_change_requests`
--

INSERT INTO `shift_change_requests` (`requestID`, `employeeName`, `currentShiftDate`, `currentShiftType`, `desiredShiftDate`, `desiredShiftType`, `swapEmployeeName`, `requestDate`, `status`) VALUES
(3, 'Pogi ni Kefi', '2222-12-12', 'Morning Shift', '2222-12-12', 'Afternoon Shift', 'Loe', '2024-05-26 06:13:41', 'Rejected'),
(4, 'Ink', '1222-02-21', 'Afternoon Shift', '2222-02-12', 'Night Shift', 'rrrrrrrr', '2024-05-26 07:27:24', 'Rejected'),
(5, 'Kenneth', '2222-02-12', 'Afternoon Shift', '2222-02-21', 'Night Shift', 'Lei', '2024-05-26 08:08:33', 'Rejected');

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
(28, 'Person 6', 'Afternoon', '2:00 pm - 10:00 pm', '05/16/2024', 'Thursday', 'fegfwsgw'),
(29, 'Pogi ni Kefi', 'Evening', '10:00 pm - 6:00 am', '05/23/2024', 'Thursday', ':3333');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clock_table`
--
ALTER TABLE `clock_table`
  ADD PRIMARY KEY (`userID`);

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
-- Indexes for table `shift_change_requests`
--
ALTER TABLE `shift_change_requests`
  ADD PRIMARY KEY (`requestID`);

--
-- Indexes for table `shift_table`
--
ALTER TABLE `shift_table`
  ADD PRIMARY KEY (`shift_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clock_table`
--
ALTER TABLE `clock_table`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee_table`
--
ALTER TABLE `employee_table`
  MODIFY `emp_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `login_table`
--
ALTER TABLE `login_table`
  MODIFY `login_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `shift_change_requests`
--
ALTER TABLE `shift_change_requests`
  MODIFY `requestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shift_table`
--
ALTER TABLE `shift_table`
  MODIFY `shift_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
