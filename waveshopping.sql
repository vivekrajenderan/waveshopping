-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2016 at 06:22 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `waveshopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivered_pickup_by`
--

CREATE TABLE IF NOT EXISTS `delivered_pickup_by` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivered_pickup_by`
--

INSERT INTO `delivered_pickup_by` (`id`, `name`, `email`, `status`, `created_on`, `updated_on`) VALUES
(2, 'hariharan', 'hari@gmail.com', 1, '2016-06-01 10:22:37', '0000-00-00 00:00:00'),
(3, 'Janith', 'janith@gmail.com', 1, '2016-06-01 10:22:56', '0000-00-00 00:00:00'),
(4, 'Speedex', 'Speedex@gmail.com', 1, '2016-06-01 10:23:25', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `expense_type`
--

CREATE TABLE IF NOT EXISTS `expense_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense_type`
--

INSERT INTO `expense_type` (`id`, `name`) VALUES
(1, 'Metro'),
(2, 'Phone Credit'),
(3, 'Printouts'),
(4, 'Covers'),
(5, 'Taxi'),
(6, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `extra_expenses`
--

CREATE TABLE IF NOT EXISTS `extra_expenses` (
  `id` int(11) NOT NULL,
  `expense_date` date NOT NULL,
  `type_id` int(11) NOT NULL COMMENT 'refer table - expense_type',
  `description` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `extra_expenses`
--

INSERT INTO `extra_expenses` (`id`, `expense_date`, `type_id`, `description`, `amount`, `status`, `created_date`) VALUES
(1, '2016-06-01', 1, 'retg', 76, 2, '2016-06-01 13:12:45'),
(2, '2016-06-02', 2, 'sgsgsg', 87, 1, '2016-06-01 13:12:45'),
(3, '2016-06-01', 5, 'retg', 23, 2, '2016-06-01 13:13:09'),
(4, '2016-06-02', 4, 'sgsgsg', 32, 1, '2016-06-01 13:13:09'),
(5, '2016-06-01', 1, 'retg', 23, 2, '2016-06-01 13:13:24'),
(6, '2016-06-02', 4, 'sgsgsg', 32, 1, '2016-06-01 13:13:24'),
(7, '2016-06-01', 1, 'retg', 23, 2, '2016-06-01 13:40:40'),
(8, '2016-06-01', 1, 'retg', 23, 2, '2016-06-01 13:42:06'),
(9, '2016-06-02', 2, 'hh hshs', 56466, 1, '2016-06-01 13:43:02'),
(10, '2016-06-01', 1, '5ggs', 545, 1, '2016-06-01 13:43:47'),
(11, '2016-06-01', 1, '5ggs', 545, 1, '2016-06-01 13:44:15'),
(12, '2016-06-01', 1, '5ggs', 545, 1, '2016-06-01 13:44:31'),
(13, '2016-06-01', 1, '5ggs', 545, 1, '2016-06-01 13:44:52'),
(14, '2016-06-01', 1, '5ggs', 545, 1, '2016-06-01 13:45:12'),
(15, '2016-06-01', 1, '5ggs', 545, 1, '2016-06-01 13:45:40'),
(16, '2016-06-01', 1, '5ggs', 545, 1, '2016-06-01 13:45:56'),
(17, '2016-06-06', 2, '9', 6577, 1, '2016-06-06 07:32:09'),
(18, '2016-06-06', 1, '776', 776, 0, '2016-06-06 07:32:09'),
(19, '2016-06-15', 2, '67', 545, 0, '2016-06-06 07:32:10'),
(20, '2016-06-09', 2, '7hg', 23, 0, '2016-06-06 07:32:10');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `order_no` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `item_description` varchar(255) NOT NULL,
  `purchase_id` int(11) NOT NULL COMMENT 'refer table - purchase_shop',
  `sold_price` int(11) NOT NULL,
  `purchase_price` int(11) NOT NULL,
  `deliver_cost` int(11) NOT NULL,
  `deliver_pickup_id` int(11) NOT NULL,
  `net` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL COMMENT 'refer table - payment_mode',
  `cash_received` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `order_date`, `order_no`, `customer_name`, `item_description`, `purchase_id`, `sold_price`, `purchase_price`, `deliver_cost`, `deliver_pickup_id`, `net`, `payment_id`, `cash_received`, `status`, `created_by`, `created_on`) VALUES
(1, '2016-06-01', '123', 'vivek', 'rubber', 2, 50, 545, 65656, 2, -66151, 2, 50, 1, 1, '2016-06-02 12:49:38'),
(2, '2016-06-02', '124', 'suthan', 'sweet corner', 4, 65, 78, 87, 2, -100, 3, 65, 1, 1, '2016-06-02 12:49:38'),
(3, '2016-06-03', '345', 'velu kumar', 'popcorn', 4, 566, 656, 65, 4, -155, 2, 566, 1, 1, '2016-06-02 12:49:38'),
(4, '2016-06-04', '125', 'kumarji', 'britinia', 6, 87, 87, 54, 2, -54, 2, 87, 1, 1, '2016-06-02 12:51:28'),
(5, '2016-06-08', '126', 'ramanan', 'cookies', 2, 67, 56, 887, 3, -876, 3, 67, 2, 1, '2016-06-02 12:51:28'),
(6, '2016-06-10', '7677', 'venkat', 'Dairy Milk', 5, 54, 56, 66, 3, -68, 1, 54, 1, 1, '2016-06-02 12:53:39'),
(7, '2016-06-11', '665', 'palaniappan', 'diary Milk', 4, 55, 65, 656, 4, -666, 4, 55, 1, 1, '2016-06-02 12:53:39'),
(8, '2016-06-02', '7667', 'gffdh dh d', 'pannana', 2, 4545, 5, 656, 2, 3884, 4, 4545, 1, 1, '2016-06-03 04:56:38'),
(9, '2016-06-03', '6585 8', 'nshs shs', 'shsh shshs', 2, 98, 54, 656, 3, -612, 4, 98, 1, 1, '2016-06-03 05:32:49'),
(10, '2016-06-15', '545', 'rth hs hsh', 'shs shs', 3, 6766666, 65, 65, 3, 6766536, 3, 6766666, 2, 1, '2016-06-03 05:32:50'),
(11, '2016-07-06', '65565', 'sundar', 'cricket ball', 2, 56565, 76, 56, 3, 56433, 2, 56565, 1, 1, '2016-06-03 06:54:19'),
(12, '2016-07-08', '65656', 'sdh shshsh', 'footaball', 1, 77674354, 554, 65, 3, 77673735, 3, 77674354, 1, 1, '2016-06-03 06:54:19'),
(13, '2016-07-08', '676', 's shsh', 'shs', 3, 878, 87, 87, 2, 704, 4, 878, 2, 1, '2016-06-03 06:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `payment_mode`
--

CREATE TABLE IF NOT EXISTS `payment_mode` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_mode`
--

INSERT INTO `payment_mode` (`id`, `name`) VALUES
(1, 'Cash'),
(2, 'Credit Cards'),
(3, 'Account'),
(4, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_shop`
--

CREATE TABLE IF NOT EXISTS `purchase_shop` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_shop`
--

INSERT INTO `purchase_shop` (`id`, `name`, `email`, `status`, `created_on`, `updated_on`) VALUES
(1, 'Summith', '', 0, '2016-06-01 06:41:09', '0000-00-00 00:00:00'),
(2, 'Azaz', 'azaz@gmail.com', 1, '2016-06-01 06:41:09', '0000-00-00 00:00:00'),
(3, 'Stiger', '', 0, '2016-06-01 06:41:09', '0000-00-00 00:00:00'),
(4, 'Summith', '', 0, '2016-06-01 06:41:09', '0000-00-00 00:00:00'),
(5, 'In Stocks', 'instock@gmail.com', 1, '2016-06-01 06:41:09', '0000-00-00 00:00:00'),
(6, 'Sambath', 'sambath@gmail.com', 1, '2016-06-01 07:17:32', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`, `status`, `created_date`) VALUES
(1, 'Vivek', 'vivek.r@gmail.com', '8a09052c9601178c546f1ee513920cf2', 'Male', 1, '2016-05-27 09:50:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivered_pickup_by`
--
ALTER TABLE `delivered_pickup_by`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_type`
--
ALTER TABLE `expense_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extra_expenses`
--
ALTER TABLE `extra_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_mode`
--
ALTER TABLE `payment_mode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_shop`
--
ALTER TABLE `purchase_shop`
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
-- AUTO_INCREMENT for table `delivered_pickup_by`
--
ALTER TABLE `delivered_pickup_by`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `expense_type`
--
ALTER TABLE `expense_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `extra_expenses`
--
ALTER TABLE `extra_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `payment_mode`
--
ALTER TABLE `payment_mode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `purchase_shop`
--
ALTER TABLE `purchase_shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
