-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2023 at 08:27 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vottingapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(200) NOT NULL,
  `admin_password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_name`, `admin_password`) VALUES
(3, 'admin2', 'admin2'),
(5, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `ballot`
--

CREATE TABLE `ballot` (
  `id` int(11) NOT NULL,
  `election_id` int(11) NOT NULL,
  `voternumber` int(11) NOT NULL,
  `candidate_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ballot`
--

INSERT INTO `ballot` (`id`, `election_id`, `voternumber`, `candidate_number`) VALUES
(21, 1234, 12000, 1001),
(22, 1234, 1122, 1001),
(23, 11001, 1122, 11002);

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `candidate_name` varchar(50) NOT NULL,
  `cand_photo` varchar(100) NOT NULL,
  `election_id` int(25) NOT NULL,
  `voternumber` int(25) NOT NULL,
  `position` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `candidate_name`, `cand_photo`, `election_id`, `voternumber`, `position`) VALUES
(51, 'Hezron', '../assets/images/l4ZSOmq2/user.jpg', 1234, 1001, ' class rep'),
(52, 'Junior', '../assets/images/C08AT17u/user (4).jpg', 1234, 1002, ' class rep'),
(53, 'Jane', '../assets/images/9Y6vRkvN/user 2.jpg', 1234, 1003, ' class rep'),
(54, 'hezron', '../assets/images/OZleJNhB/IMG_20200509_145928_7.jpg', 11001, 11002, ' football team captain');

-- --------------------------------------------------------

--
-- Table structure for table `election`
--

CREATE TABLE `election` (
  `election_id` int(25) NOT NULL,
  `election_title` varchar(200) NOT NULL,
  `starting_time` datetime NOT NULL,
  `ending_time` datetime NOT NULL,
  `election_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `election`
--

INSERT INTO `election` (`election_id`, `election_title`, `starting_time`, `ending_time`, `election_status`) VALUES
(1234, 'class rep', '2023-07-08 09:00:00', '2023-07-09 09:00:00', 'active'),
(11001, 'football team captain', '2023-07-26 09:00:00', '2023-08-27 09:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `voternumber` int(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`id`, `email`, `username`, `voternumber`, `password`, `user_role`) VALUES
(28, 'user@gmail.com', 'user One', 12000, '$2y$10$cvEiJxLx5WAOJvytdjYYyubkh8fpl83o31db2WXkNpAVSPAyz2B0u', 'Voter'),
(29, 'user2@gmail.com', 'user 2', 1122, '$2y$10$HhCt72jgr48X6BQodOX1nuhke77WvGBaZTCjhdyzUx0SsMdCjUQXy', 'Voter');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ballot`
--
ALTER TABLE `ballot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `election_id` (`election_id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `election_id` (`election_id`);

--
-- Indexes for table `election`
--
ALTER TABLE `election`
  ADD PRIMARY KEY (`election_id`);

--
-- Indexes for table `voters`
--
ALTER TABLE `voters`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ballot`
--
ALTER TABLE `ballot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `voters`
--
ALTER TABLE `voters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ballot`
--
ALTER TABLE `ballot`
  ADD CONSTRAINT `ballot_ibfk_1` FOREIGN KEY (`election_id`) REFERENCES `election` (`election_id`);

--
-- Constraints for table `candidates`
--
ALTER TABLE `candidates`
  ADD CONSTRAINT `candidates_ibfk_1` FOREIGN KEY (`election_id`) REFERENCES `election` (`election_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
