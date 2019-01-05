-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2019 at 08:25 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_calendar`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_title` varchar(80) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NULL',
  `event_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `event_start` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `event_end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_title`, `event_desc`, `event_start`, `event_end`) VALUES
(1, 'New Year\'s Day', 'Happy New Year!', '2018-10-31 17:00:00', '2018-12-31 16:59:59'),
(2, 'Last Day of January', 'Last Day of the month! Yay!', '2018-10-31 17:00:00', '2018-12-31 16:59:59'),
(7, 'mothaibama', '2018-28-122018-28-122018-28-122018-28-122018-28-12', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'mothaibama', '2018-28-122018-28-122018-28-122018-28-122018-28-122018-28-122018-28-12', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Mot hai ba bon', 'Mot hai ba bon', '2018-12-11 17:00:00', '2018-12-30 17:00:00'),
(9, 'mothaibama', '2018-28-122018-28-122018-28-122018-28-12', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'asdf', '2019-12-282019-12-282019-12-282019-12-282019-12-28', '2018-12-27 17:00:00', '2019-12-27 17:00:00'),
(11, 'bmasdfsa', '2018-28-122018-28-122018-28-122018-28-122018-28-122018-28-122018-28-122018-28-12', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'mothaibama', '2020-01-02 00:00:002020-01-02 00:00:002020-01-02 00:00:002020-01-02 00:00:00', '2019-01-01 17:00:00', '2020-01-01 17:00:00'),
(15, 'mothaiba', '2019-02-012019-02-012019-02-012019-02-01', '2019-01-31 17:00:00', '2020-01-31 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_pass` varchar(47) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_email` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`, `user_email`) VALUES
(1, 'testuser', '98690515dba054526ed4a5f25e84ceba8e264e5f7920615', 'admin@localhost');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `event_end` (`event_end`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
