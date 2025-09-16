-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2025 at 09:26 AM
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
-- Database: `db_smartdrive1`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(20) UNSIGNED NOT NULL,
  `name` varchar(36) NOT NULL,
  `lastName` varchar(36) NOT NULL,
  `email` varchar(28) NOT NULL,
  `password` varchar(28) NOT NULL,
  `driversLicence` varchar(16) NOT NULL,
  `nationalID` varchar(13) NOT NULL,
  `role` enum('admin','moderator','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `name`, `lastName`, `email`, `password`, `driversLicence`, `nationalID`, `role`) VALUES
(1, 'Petar', 'Vukovic', 'petar@gmail.com', 'petar12345', 'B56EU94I', '1234567890123', 'admin'),
(29, 'Aleksa', 'Aleksic', 'aleksa@gmail.com', 'aleksa12345', 'EE35A555R', '3333555566661', 'moderator'),
(31, 'Marko', 'Markovic', 'marko@gmail.com', 'marko12345', 'A123B456C', '1234567898765', 'user'),
(32, 'Luka', 'Lukic', 'luka@gmail.com', 'luka12345', 'B123C456D789', '0012304050607', 'user'),
(33, 'Milos', 'Savic', 'milos@gmail.com', 'milos12345', 'C123D456E789', '1122334455667', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `protection`
--

CREATE TABLE `protection` (
  `protection_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(36) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `protection`
--

INSERT INTO `protection` (`protection_id`, `name`, `price`) VALUES
(1, 'Basic Protection', 8.65),
(2, 'Smart Protection', 21.05),
(3, 'All Inclusive', 30.39);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `vehicle_id` int(10) UNSIGNED NOT NULL,
  `pickup_return_location` varchar(28) NOT NULL,
  `pickup_date` date NOT NULL,
  `return_date` date NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `customer_id`, `vehicle_id`, `pickup_return_location`, `pickup_date`, `return_date`, `price`) VALUES
(2, 1, 1, 'Belgrade', '2025-02-27', '2025-03-02', 67.95),
(3, 1, 1, 'Belgrade', '2025-02-27', '2025-03-02', 67.95),
(26, 1, 5, 'Budva', '2025-02-15', '2025-02-21', 588.3),
(27, 29, 16, 'Budva', '2025-02-16', '2025-02-21', 580.25),
(60, 29, 1, 'Belgrade', '2025-09-14', '2025-09-17', 42.18);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicle_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(24) NOT NULL,
  `year` int(4) UNSIGNED NOT NULL,
  `type` varchar(24) NOT NULL,
  `description` varchar(64) NOT NULL,
  `seats` int(10) UNSIGNED NOT NULL,
  `transmission` varchar(12) NOT NULL,
  `doors` int(2) UNSIGNED NOT NULL,
  `suitcase` int(2) UNSIGNED NOT NULL,
  `bag` int(2) UNSIGNED NOT NULL,
  `price` float NOT NULL,
  `unlimited_km` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vehicle_id`, `name`, `year`, `type`, `description`, `seats`, `transmission`, `doors`, `suitcase`, `bag`, `price`, `unlimited_km`) VALUES
(1, 'Fiat 500', 2024, 'hatchback', 'Economy Hatchback Manual', 4, 'Manual', 2, 1, 1, 14.06, 2.48),
(2, 'Toyota Yaris', 2024, 'hatchback', 'Compact Automatic', 4, 'Automatic', 4, 1, 1, 20.95, 3.28),
(3, 'VW Golf 8', 2023, 'hatchback', 'Compact Hatchback Automatic', 4, 'Automatic', 4, 1, 2, 32.85, 5.69),
(4, 'Skoda Octavia', 2023, 'sedan', 'Midsize Sedan Automatic', 4, 'Automatic', 4, 2, 2, 35, 7.09),
(5, 'Audi A4', 2024, 'sedan', 'Compact Automatic', 4, 'Automatic', 4, 2, 2, 58.65, 19.25),
(16, 'Mercedes E Cabrio', 2024, 'convertable', 'Premium Convertable', 4, 'Automatic', 2, 2, 2, 69.99, 24.95),
(17, 'Mercedes C Class', 2024, 'Sedan', 'Premium Compact Automatic', 4, 'Automatic', 4, 2, 2, 61.19, 21.99),
(18, 'BMW X3', 2023, 'SUV', 'Premium SUV', 4, 'Automatic', 4, 2, 2, 68.89, 25.45),
(19, 'Mercedes GLC', 2023, 'suv', 'Premium SUV', 4, 'Automatic', 4, 2, 2, 69.92, 28.05);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `protection`
--
ALTER TABLE `protection`
  ADD PRIMARY KEY (`protection_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `protection`
--
ALTER TABLE `protection`
  MODIFY `protection_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
