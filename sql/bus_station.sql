-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2022 at 09:24 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bus_station`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_tickets`
--

CREATE TABLE `book_tickets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seat` varchar(10) NOT NULL,
  `driving_time_id` int(11) NOT NULL,
  `price_rate_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_tickets`
--

INSERT INTO `book_tickets` (`id`, `user_id`, `seat`, `driving_time_id`, `price_rate_id`, `date`) VALUES
(1, 1, '02', 4, 11, '2022-04-13'),
(2, 3, '01', 3, 10, '2022-04-13'),
(3, 1, '06', 4, 12, '2022-04-13'),
(4, 1, '09', 4, 3, '2022-04-13'),
(5, 1, '13', 3, 2, '2022-04-13'),
(6, 3, '14', 4, 11, '2022-04-13'),
(7, 3, '05', 4, 3, '2022-04-13'),
(8, 4, '01', 2, 8, '2022-04-14'),
(9, 4, '25', 2, 3, '2022-04-14'),
(10, 1, '02', 2, 8, '2022-04-14'),
(11, 1, '14', 2, 2, '2022-04-14'),
(12, 3, '09', 2, 10, '2022-04-14'),
(13, 1, '23', 1, 10, '2022-04-14'),
(14, 5, '01', 1, 2, '2022-04-15'),
(15, 1, '02', 1, 8, '2022-04-15'),
(16, 1, '04', 1, 7, '2022-04-15');

-- --------------------------------------------------------

--
-- Table structure for table `driving_times`
--

CREATE TABLE `driving_times` (
  `id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `destiantion_time` time NOT NULL,
  `route` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driving_times`
--

INSERT INTO `driving_times` (`id`, `time`, `start_time`, `destiantion_time`, `route`) VALUES
(1, 1, '06:00:00', '06:30:00', 'สกลนคร-ชัยภมิ'),
(2, 2, '09:00:00', '09:30:00', 'สกลนคร-ชัยภูมิ'),
(3, 3, '12:00:00', '12:30:00', 'สกลนคร-ชัยภูมิ'),
(4, 4, '15:00:00', '15:30:00', 'สกลนคร-ชัยภูมิ');

-- --------------------------------------------------------

--
-- Table structure for table `price_rates`
--

CREATE TABLE `price_rates` (
  `id` int(11) NOT NULL,
  `start` varchar(100) NOT NULL,
  `destiantion` varchar(100) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `price_rates`
--

INSERT INTO `price_rates` (`id`, `start`, `destiantion`, `price`) VALUES
(1, 'ชัยภูมิ', 'ขอนแก่น', 110),
(2, 'ชัยภูมิ', 'กาฬสินธุ์', 180),
(3, 'ชัยภูมิ', 'สกลนคร', 300),
(4, 'ขอนแก่น', 'ชัยภูมิ', 110),
(5, 'ขอนแก่น', 'กาฬสินธุ์', 70),
(6, 'ขอนแก่น', 'สกลนคร', 190),
(7, 'กาฬสินธุ์', 'ชัยภูมิ', 180),
(8, 'กาฬสินธุ์', 'ขอนแก่น', 70),
(9, 'กาฬสินธุ์', 'สกลนคร', 120),
(10, 'สกลนคร', 'ชัยภูมิ', 300),
(11, 'สกลนคร', 'กาฬสินธุ์', 120),
(12, 'สกลนคร', 'ขอนแก่น', 190);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `phone`) VALUES
(1, 'รชานนท์', 'rachanon', '$2y$10$4wbXQ3FAbZ7gNayCdvBezumWyrCWn1Jt8lM.FaXSsRh6WIH9friJe', '', ''),
(3, 'kasetsart', 'kasetsart', '$2y$10$XrxoHrXgnUL6KpoBCiHq4e7wdCZ/GYtHHNYZUDfkk.jSMA6Gp7HyK', 'kasetsart@ku.th', '0611283823'),
(4, 'somvang', 'somvang01', '$2y$10$gk4WNG1IKlv4yUljLe7y1uOHVLZonXnD.swAGzS.uAlqTOmVSXFxS', 'som@gmail.com', '0611238659'),
(5, 'gg01', 'gg01', '$2y$10$oy2O8CFNjmlfscoUxUpqIuDBrH8RglxRk.nvdmhviLZty4VkKdrUe', 'g@gmail.com', '0611231234'),
(6, 'phum', 'phum', '$2y$10$/FOPEqotpnTThxkPCPVwZ.TBnD5bH5./i6Kx6rnMP7cuzLLO9s18q', 'ra@gmail.com', '0611283823'),
(7, 'admin', 'admin', '$2y$10$4xNRZGogi27H2Bq8Hmqg9O9Fa1a60wxDeUFOEXei2ojqthkCKBXWC', 'gg', '12345'),
(8, 'admin', 'admin2', '$2y$10$UGD7hRmryfUjKEngues.CeyH4FRzIqpf2t48yKE7ZSLEiBIirMxZe', 'gg', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_tickets`
--
ALTER TABLE `book_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driving_times`
--
ALTER TABLE `driving_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price_rates`
--
ALTER TABLE `price_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_tickets`
--
ALTER TABLE `book_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `driving_times`
--
ALTER TABLE `driving_times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `price_rates`
--
ALTER TABLE `price_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
