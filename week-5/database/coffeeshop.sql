-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2023 at 09:51 AM
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
-- Database: `coffeeshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `coffeeType` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `totalPrice` float DEFAULT NULL,
  `instructions` varchar(255) DEFAULT NULL,
  `extras` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `name`, `coffeeType`, `size`, `totalPrice`, `instructions`, `extras`) VALUES
(1, 'Rahul Verma', 'espresso', 'small', 255.75, 'whipped cream', 'sugar'),
(2, 'Alex', 'americano', 'medium', 266.25, '', NULL),
(3, 'Alex', 'americano', 'medium', 266.25, '', NULL),
(4, 'Alexander', 'americano', 'large', 296.25, '', 'sugar, cream'),
(5, 'Alex', 'americano', 'small', 205.75, '', NULL),
(6, 'Alexander', 'americano', 'medium', 266.25, 'no whipped cream', 'sugar, cream'),
(7, 'Sheldon Cooper', 'mocha', 'large', 496.25, 'No whipped cream', 'sugar, cream'),
(8, 'Sheldon Cooper', 'mocha', 'large', 496.25, 'No whipped cream', 'sugar, cream'),
(9, 'Leonard Hofstadter', 'latte', 'medium', 366.25, '', 'sugar, cream');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`) VALUES
(1, 'user', '$2y$10$WI40JxD9zx4/iaJcHv3NIuXcr6UaQ8ZQtBt.lUNRbqd.m2arrguWq'),
(2, 'user1', '$2y$10$3Nau0R3hWyeMb4wIpPvAnOl7udStNcB2CAQj9UxMAFCSnFkdH0UmW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
