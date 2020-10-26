-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2020 at 10:56 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blood_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `blood_info`
--

CREATE TABLE `blood_info` (
  `blood_id` varchar(100) NOT NULL,
  `blood_grp` varchar(5) NOT NULL,
  `quantity_recieved` int(100) NOT NULL,
  `donor_name` varchar(100) NOT NULL,
  `donor_email` varchar(100) NOT NULL,
  `h_id` varchar(100) NOT NULL,
  `date_of_donation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blood_info`
--

INSERT INTO `blood_info` (`blood_id`, `blood_grp`, `quantity_recieved`, `donor_name`, `donor_email`, `h_id`, `date_of_donation`) VALUES
('B_2020-10-25-1603666469', 'A+', 320, 'HItesh Kumar', 'hkhiteshkumar66@gmail.com', 'H_2020-10-25-1603615636', '2021-01-25'),
('B_2020-10-25-1603666608', 'A+', 350, 'Jitesh', 'jitesh@mail.com', 'H_2020-10-25-1603655019', '2021-01-25'),
('B_2020-10-26-1603689296', 'B+', 250, 'Mohan Kumar', 'mhe24629@eoopy.com', 'H_2020-10-25-1603615636', '2021-01-26'),
('B_2020-10-26-1603696114', 'A+', 200, 'Arpita', 'arpita@mail.com', 'H_2020-10-25-1603615636', '2021-01-26');

-- --------------------------------------------------------

--
-- Table structure for table `blood_inventory`
--

CREATE TABLE `blood_inventory` (
  `blood_grp` varchar(5) NOT NULL,
  `total_available_quantity` int(100) NOT NULL,
  `h_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blood_inventory`
--

INSERT INTO `blood_inventory` (`blood_grp`, `total_available_quantity`, `h_id`) VALUES
('A+', 520, 'H_2020-10-25-1603615636'),
('A+', 350, 'H_2020-10-25-1603655019'),
('B+', 250, 'H_2020-10-25-1603615636');

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `h_id` varchar(100) NOT NULL,
  `h_name` varchar(100) NOT NULL,
  `h_phone` bigint(100) NOT NULL,
  `h_address` varchar(100) NOT NULL,
  `h_city` varchar(100) NOT NULL,
  `h_email` varchar(100) NOT NULL,
  `h_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`h_id`, `h_name`, `h_phone`, `h_address`, `h_city`, `h_email`, `h_password`) VALUES
('H_2020-10-25-1603615636', 'AIIMS', 7004312549, 'hno. 22, narmada path, tank road, uliyan', 'JAMSHEDPUR', 'aiims@mail.com', '$2y$10$pqIdzw6dwt4p.2.fqL771ed14Ruhyzi7cWiF470Q5lg3VnmmNiplu'),
('H_2020-10-25-1603655019', 'Tata Main Hospital', 8965317294, 'jusco golchakkar se right lena mil jayega', 'JAMSHEDPUR', 'tatamainhospital@gmail.com', '$2y$10$D6WC6BdZqao4azgkN/CQ1e3JkiY3w8qUCtXiTqM.wTMVdexM7ga42');

-- --------------------------------------------------------

--
-- Table structure for table `reciever`
--

CREATE TABLE `reciever` (
  `r_id` varchar(100) NOT NULL,
  `r_name` varchar(100) NOT NULL,
  `r_phone` bigint(100) NOT NULL,
  `r_address` varchar(100) NOT NULL,
  `r_city` varchar(100) NOT NULL,
  `r_blood-grp` varchar(100) NOT NULL,
  `r_email` varchar(100) NOT NULL,
  `r_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reciever`
--

INSERT INTO `reciever` (`r_id`, `r_name`, `r_phone`, `r_address`, `r_city`, `r_blood-grp`, `r_email`, `r_password`) VALUES
('Rec_2020-10-24-1603548112', 'MOHIT KUMAR SAHU', 8969608764, 'HNO. 22, NARMADA PATH, TANK ROAD, ULIYAN', 'JAMSHEDPUR', 'B+', 'bar25810@bcaoo.com', '$2y$10$GBH31pRHnE6Zp7V/CTd31uLDIE47qklRUHNH5qMoiQEQiGj8WgBx2'),
('Rec_2020-10-25-1603660178', 'Hitesh Kumar', 7004312549, 'hno. 22, narmada path, tank road, uliyan', 'JAMSHEDPUR', 'A+', 'hkhiteshkumar66@gmail.com', '$2y$10$rWO3Qhvy0dNDT/6Vg7ySDuHNZFujXViYFP/lFDi8hqenv6mHmeJDC');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `req_id` varchar(100) NOT NULL,
  `r_id` varchar(100) NOT NULL,
  `h_id` varchar(100) NOT NULL,
  `blood_grp` varchar(5) NOT NULL,
  `units_requested` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`req_id`, `r_id`, `h_id`, `blood_grp`, `units_requested`) VALUES
('REQ-2020-10-26/AM-16037006883', 'Rec_2020-10-25-1603660178', 'H_2020-10-25-1603655019', 'A+', 12),
('REQ-2020-10-26/AM-16037008143', 'Rec_2020-10-25-1603660178', 'H_2020-10-25-1603615636', 'A+', 30),
('REQ-2020-10-26/AM-16037012083', 'Rec_2020-10-25-1603660178', 'H_2020-10-25-1603655019', 'A+', 10),
('REQ-2020-10-26/AM-16037012233', 'Rec_2020-10-25-1603660178', 'H_2020-10-25-1603615636', 'A+', 30),
('REQ-2020-10-26/AM-16037014123', 'Rec_2020-10-24-1603548112', 'H_2020-10-25-1603615636', 'B+', 30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blood_info`
--
ALTER TABLE `blood_info`
  ADD PRIMARY KEY (`blood_id`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`h_id`);

--
-- Indexes for table `reciever`
--
ALTER TABLE `reciever`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`req_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
