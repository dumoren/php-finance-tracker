-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2022 at 04:32 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_expenses`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `description`) VALUES
(1, 'Chase Bank', 'My Chase bank Account'),
(2, 'Paypal', 'My Paypal Account'),
(3, 'Bank of America  ', 'My Bank of America  account'),
(4, 'Bitcoin', 'My Bitcoin Wallet'),
(5, 'Cash Account', 'My Cash Account'),
(6, 'Credit Card - Equity Bank', 'My Credit-Card - Equity Bank'),
(7, 'M-Pesa', 'Safaricom Mobile banking account');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Rent', 'My rent Payments'),
(2, 'Car', 'My car fuel and Maintenance'),
(3, 'Groceries ', 'My Groceries '),
(4, 'Phone Bill', 'My Phone Bill'),
(5, 'Internet', 'My home internet '),
(6, 'Entertainment ', 'Entertainment '),
(7, 'Misc', 'Miscellaneous spending '),
(8, 'Savings', 'My saving'),
(9, 'Insurance', 'My Insurance'),
(10, 'Vacation ', 'My vacation savings ');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `payement_date` date DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `payment_to` text NOT NULL,
  `mode` text NOT NULL,
  `amount` double NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `payement_date`, `category_id`, `account_id`, `description`, `payment_to`, `mode`, `amount`, `date_created`, `date_updated`) VALUES
(1, '2022-08-19', 5, 5, 'Internet Payments for jan 22', 'Safaricom', 'Cash', 100, '2022-08-19 05:47:27', '2022-08-21 01:48:48'),
(2, '2022-08-21', 2, 1, 'Car Service', 'Too Autos', 'Bank', 1000, '2022-08-20 00:00:00', '2022-08-21 02:57:27'),
(3, '2022-03-01', 9, 2, 'My health insurance', 'APA Insurance', 'Online', 500, '2022-08-21 01:46:29', '2022-08-21 02:52:11'),
(4, '2022-02-04', 10, 6, 'August holiday to Japan', 'Personal', 'Bank', 1200, '2022-08-21 02:28:32', '2022-08-21 02:53:53'),
(5, '2022-01-01', 1, 7, 'Rent payment for Jan', 'Agent', 'Mobile', 200, '2022-08-21 02:30:33', '2022-08-21 02:50:32'),
(6, '2022-01-01', 1, 5, 'Rent payment for Feb', 'Agent', 'Cash', 200, '2022-01-01 00:00:00', '2022-08-21 02:42:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `account_id` (`account_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
