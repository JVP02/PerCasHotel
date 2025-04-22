-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2024 at 02:22 AM
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
-- Database: `hotel_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `roomlist`
--

CREATE TABLE `roomlist` (
  `id` int(11) NOT NULL,
  `room_image` varchar(255) NOT NULL,
  `room_number` varchar(50) NOT NULL,
  `room_desc` text NOT NULL,
  `room_type` varchar(100) NOT NULL,
  `room_price` decimal(10,2) NOT NULL,
  `room_status` varchar(50) NOT NULL,
  `room_capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roomlist`
--

INSERT INTO `roomlist` (`id`, `room_image`, `room_number`, `room_desc`, `room_type`, `room_price`, `room_status`, `room_capacity`) VALUES
(1, 'room1.jpg', '101', 'Deluxe room with sea view', 'Deluxe', 150.00, 'Available', 2),
(2, 'room2.jpg', '102', 'Standard room with garden view', 'Standard', 100.00, 'Occupied', 2),
(3, 'room3.jpg', '103', 'Family room with two double beds', 'Family', 200.00, 'Available', 4),
(4, 'room4.jpg', '104', 'Single room with city view', 'Single', 80.00, 'Occupied', 1),
(5, 'room5.jpg', '105', 'Luxury suite with private balcony', 'Suite', 300.00, 'Available', 2),
(6, 'room6.jpg', '106', 'Double room with mountain view', 'Double', 120.00, 'Under Maintenance', 2),
(7, 'room7.jpg', '107', 'Economy room with basic amenities', 'Economy', 60.00, 'Available', 2),
(8, 'room8.jpg', '108', 'Penthouse suite with panoramic view', 'Penthouse', 500.00, 'Occupied', 2),
(9, 'room9.jpg', '109', 'Twin room with shared bathroom', 'Twin', 90.00, 'Available', 2),
(10, 'room10.jpg', '110', 'Honeymoon suite with Jacuzzi', 'Suite', 350.00, 'Occupied', 2),
(11, 'room11.jpg', '111', 'Accessible room with wheelchair access', 'Accessible', 110.00, 'Available', 2),
(12, 'room12.jpg', '112', 'Deluxe room with king-size bed', 'Deluxe', 150.00, 'Occupied', 2),
(13, 'room13.jpg', '113', 'Economy room with single bed', 'Economy', 50.00, 'Available', 1),
(14, 'room14.jpg', '114', 'Studio apartment with kitchenette', 'Studio', 200.00, 'Available', 3),
(15, 'room15.jpg', '115', 'Double room with garden access', 'Double', 130.00, 'Occupied', 2),
(16, 'room16.jpg', '116', 'Luxury suite with private pool', 'Suite', 400.00, 'Under Maintenance', 4),
(17, 'room17.jpg', '117', 'Penthouse with rooftop access', 'Penthouse', 550.00, 'Available', 3),
(18, 'room18.jpg', '118', 'Standard room with twin beds', 'Standard', 100.00, 'Occupied', 2),
(19, 'room19.jpg', '119', 'Single room with work desk', 'Single', 85.00, 'Available', 1),
(20, 'room20.jpg', '120', 'Family room with play area', 'Family', 250.00, 'Occupied', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `roomlist`
--
ALTER TABLE `roomlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `roomlist`
--
ALTER TABLE `roomlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
