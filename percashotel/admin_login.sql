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
-- Database: `admin_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `room_number` varchar(255) NOT NULL,
  `room_type` varchar(255) NOT NULL,
  `room_price` decimal(10,2) NOT NULL,
  `arrival_date` date NOT NULL,
  `departure_date` date NOT NULL,
  `guests` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `booking_status` enum('Pending','Confirmed','Cancelled') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `room_number`, `room_type`, `room_price`, `arrival_date`, `departure_date`, `guests`, `total_price`, `booking_status`, `created_at`) VALUES
(1, '102', 'Executive Room', 250.00, '2024-12-04', '2024-12-05', 3, 250.00, 'Pending', '2024-12-04 11:35:36'),
(2, '102', 'Executive Room', 250.00, '2024-12-04', '2024-12-05', 3, 250.00, 'Pending', '2024-12-04 11:45:22'),
(3, '101', 'Deluxe Suite', 399.00, '2024-12-04', '2024-12-05', 2, 399.00, 'Pending', '2024-12-04 11:52:01'),
(4, '101', 'Deluxe Suite', 399.00, '2024-12-04', '2024-12-05', 3, 399.00, 'Pending', '2024-12-04 13:26:07'),
(5, '101', 'Deluxe Suite', 399.00, '2024-12-04', '2024-12-05', 3, 399.00, 'Pending', '2024-12-04 13:27:22'),
(6, '101', 'Deluxe Suite', 399.00, '2024-12-04', '2024-12-05', 3, 399.00, 'Pending', '2024-12-04 13:27:32'),
(7, '101', 'Deluxe Suite', 399.00, '2024-12-05', '2024-12-25', 2, 7980.00, 'Pending', '2024-12-04 13:29:19'),
(8, '101', 'Deluxe Suite', 399.00, '2024-12-08', '2024-12-13', 1, 1995.00, 'Pending', '2024-12-04 13:39:54'),
(9, '103', 'Presidential Suite', 799.00, '2024-12-04', '2024-12-05', 2, 799.00, 'Pending', '2024-12-04 13:41:37'),
(10, 'R103', 'Suite', 299.99, '2024-12-05', '2024-12-06', 2, 299.99, 'Pending', '2024-12-04 23:21:59');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `room_type` varchar(100) NOT NULL,
  `is_available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statistics`
--

CREATE TABLE `statistics` (
  `room_number` int(11) NOT NULL,
  `times_booked` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `usernam` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usernam`, `password`) VALUES
(1, 'admin', '<?php\r\necho password_hash(\'12345\', PASSWORD_BCRYPT);\r\n?>');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`room_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
