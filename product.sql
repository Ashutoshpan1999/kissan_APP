-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2021 at 08:15 PM
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
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `seller_id` int(11) NOT NULL,
  `entry_data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('active','deactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `qty`, `image`, `description`, `seller_id`, `entry_data`, `status`) VALUES
(1, 'BAJRA', 120, 2000, 'image/bajra.jpg', 'IN GOOD QUALITY', 1, '2021-02-15 18:02:58', 'active'),
(2, 'CHANA', 110, 2300, 'image/chana.jpg', 'IN GOOD QUALITY,WITH SOLID DISCOUNT.', 1, '2021-02-15 18:03:40', 'active'),
(3, 'COLVE', 140, 3000, 'image/colve.jfif', 'IN GOOD QUALITY', 1, '2021-02-15 18:04:07', 'active'),
(4, 'CORN', 55, 700, 'image/corn.jpg', 'IN GOOD QUALITY', 1, '2021-02-15 18:04:30', 'active'),
(5, 'MUSTARD', 70, 8000, 'image/mustard.jfif', 'IN GOOD QUALITY', 1, '2021-02-15 18:05:58', 'active'),
(6, 'RAJMA', 125, 4000, 'image/rajma.jpg', 'IN GOOD QUALITY', 2, '2021-02-15 18:07:38', 'active'),
(7, 'RICE', 45, 95000, 'image/rice.jpg', 'IN GOOD QUALITY WITH EXTRA CARE.', 2, '2021-02-15 18:08:17', 'active'),
(8, 'TOOR DAL', 110, 6000, 'image/toor_dal.jpg', 'IN GOOD QUALITY', 2, '2021-02-15 18:08:48', 'active'),
(9, 'WHEAT', 30, 55000, 'image/wheat.jpg', 'IN GOOD QUALITY', 2, '2021-02-15 18:09:40', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
