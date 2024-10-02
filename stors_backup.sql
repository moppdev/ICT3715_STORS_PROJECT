-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2024 at 07:47 PM
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
-- Database: `stors`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `learner_id` int(11) NOT NULL,
  `initials` varchar(3) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `parent_id`, `learner_id`, `initials`, `surname`, `password`, `email`) VALUES
(1, 1, 2, 'J', 'Smit', 'JS@ST0RS78', 'johansmit@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `learner_id` int(11) NOT NULL,
  `pickup_id` varchar(2) NOT NULL,
  `dropoff_id` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `learner_id`, `pickup_id`, `dropoff_id`) VALUES
(61, 24, '1A', '1B'),
(63, 26, '2A', '2A');

-- --------------------------------------------------------

--
-- Table structure for table `bus_routes`
--

CREATE TABLE `bus_routes` (
  `id` varchar(2) NOT NULL,
  `route_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus_routes`
--

INSERT INTO `bus_routes` (`id`, `route_name`) VALUES
('1', 'Rooihuiskraal'),
('2', 'Wierdapark'),
('3', 'Centurion');

-- --------------------------------------------------------

--
-- Table structure for table `learners`
--

CREATE TABLE `learners` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `cell_num` char(10) NOT NULL,
  `grade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `learners`
--

INSERT INTO `learners` (`id`, `name`, `surname`, `cell_num`, `grade`) VALUES
(1, 'Carel', 'Smit', '0794568458', 10),
(2, 'Pieter', 'Smit', '0824591023', 9),
(24, 'Melanie', 'Smit', '0784523698', 10),
(25, 'Miyu', 'Miyasaki', '0745896325', 11),
(26, 'Lila', 'Miyasaki', '0835698745', 9);

-- --------------------------------------------------------

--
-- Table structure for table `learner_trips`
--

CREATE TABLE `learner_trips` (
  `id` int(11) NOT NULL,
  `learner_id` int(11) NOT NULL,
  `pickup_id` varchar(2) NOT NULL,
  `dropoff_id` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `learner_trips`
--

INSERT INTO `learner_trips` (`id`, `learner_id`, `pickup_id`, `dropoff_id`) VALUES
(8, 2, '3A', '3B'),
(9, 1, '1A', '1B'),
(10, 25, '3A', '3A');

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL,
  `cell_num` char(10) NOT NULL,
  `email` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`id`, `name`, `surname`, `password`, `cell_num`, `email`) VALUES
(1, 'Johan', 'Smit', 'JS@ST0RS78', '0792391078', 'johansmit@gmail.com'),
(10, 'Shane', 'Miyasaki', 'Shane56#', '0759632148', 'shane@mungaka.jp');

-- --------------------------------------------------------

--
-- Table structure for table `relations`
--

CREATE TABLE `relations` (
  `id` int(11) NOT NULL,
  `learner_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `relations`
--

INSERT INTO `relations` (`id`, `learner_id`, `parent_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(24, 24, 1),
(25, 25, 10),
(26, 26, 10);

-- --------------------------------------------------------

--
-- Table structure for table `route_points`
--

CREATE TABLE `route_points` (
  `point_num` varchar(2) NOT NULL,
  `route_num` varchar(2) NOT NULL,
  `point_name` varchar(50) NOT NULL,
  `pickup_time` char(5) NOT NULL,
  `dropoff_time` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `route_points`
--

INSERT INTO `route_points` (`point_num`, `route_num`, `point_name`, `pickup_time`, `dropoff_time`) VALUES
('1A', '1', 'Panorama and Marabou Road', '06:22', '14:30'),
('1B', '1', 'Kolgansstraat and Skimmerstraat', '06:30', '14:39'),
('2A', '2', 'Reddersburg Street and Mafeking Drive', '06:25', '14:25'),
('2B', '2', 'Theuns van Niekerkstraat and Roosmarynstraat', '06:35', '14:30'),
('3A', '3', 'Jasper Drive and Tieroog Street', '06:20', '14:30'),
('3B', '3', 'Louise Street and Von Willich Drive', '06:40', '14:40');

-- --------------------------------------------------------

--
-- Table structure for table `waiting_list`
--

CREATE TABLE `waiting_list` (
  `learner_id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `waiting_list`
--

INSERT INTO `waiting_list` (`learner_id`, `application_id`, `date_added`) VALUES
(24, 61, '2024-10-01 18:52:34'),
(26, 63, '2024-10-01 18:58:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `learner_id` (`learner_id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`,`learner_id`),
  ADD KEY `learner_id` (`learner_id`),
  ADD KEY `fk_dropoff` (`dropoff_id`),
  ADD KEY `fk_pickup` (`pickup_id`);

--
-- Indexes for table `bus_routes`
--
ALTER TABLE `bus_routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `learners`
--
ALTER TABLE `learners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `learner_trips`
--
ALTER TABLE `learner_trips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `learner_id` (`learner_id`),
  ADD KEY `pickup_id` (`pickup_id`),
  ADD KEY `dropoff_id` (`dropoff_id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relations`
--
ALTER TABLE `relations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `learner_id` (`learner_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `route_points`
--
ALTER TABLE `route_points`
  ADD PRIMARY KEY (`point_num`),
  ADD KEY `route_num` (`route_num`);

--
-- Indexes for table `waiting_list`
--
ALTER TABLE `waiting_list`
  ADD PRIMARY KEY (`learner_id`),
  ADD KEY `application_id` (`application_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `learners`
--
ALTER TABLE `learners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `learner_trips`
--
ALTER TABLE `learner_trips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `relations`
--
ALTER TABLE `relations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admins_ibfk_2` FOREIGN KEY (`learner_id`) REFERENCES `learners` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`learner_id`) REFERENCES `learners` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_dropoff` FOREIGN KEY (`dropoff_id`) REFERENCES `route_points` (`point_num`),
  ADD CONSTRAINT `fk_pickup` FOREIGN KEY (`pickup_id`) REFERENCES `route_points` (`point_num`);

--
-- Constraints for table `learner_trips`
--
ALTER TABLE `learner_trips`
  ADD CONSTRAINT `learner_trips_ibfk_2` FOREIGN KEY (`pickup_id`) REFERENCES `route_points` (`point_num`) ON DELETE NO ACTION,
  ADD CONSTRAINT `learner_trips_ibfk_3` FOREIGN KEY (`dropoff_id`) REFERENCES `route_points` (`point_num`) ON DELETE NO ACTION,
  ADD CONSTRAINT `learner_trips_ibfk_4` FOREIGN KEY (`learner_id`) REFERENCES `learners` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `relations`
--
ALTER TABLE `relations`
  ADD CONSTRAINT `relations_ibfk_1` FOREIGN KEY (`learner_id`) REFERENCES `learners` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `relations_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `route_points`
--
ALTER TABLE `route_points`
  ADD CONSTRAINT `route_points_ibfk_1` FOREIGN KEY (`route_num`) REFERENCES `bus_routes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `waiting_list`
--
ALTER TABLE `waiting_list`
  ADD CONSTRAINT `waiting_list_ibfk_1` FOREIGN KEY (`learner_id`) REFERENCES `learners` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `waiting_list_ibfk_2` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
