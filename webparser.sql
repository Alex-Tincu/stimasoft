-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2017 at 11:45 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webparser`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_users`
--

CREATE TABLE `app_users` (
  `id` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `app_users`
--

INSERT INTO `app_users` (`id`, `password`, `email`, `enabled`, `username`, `username_canonical`, `email_canonical`, `salt`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`) VALUES
(2, '$2y$13$WE71E1mu6K3Wap.raONQDO6xn/AaR6j1CLzFlfBwk1DjCLLGYxKG.', 'alex.tincu@ymail.com', 1, 'alex.tincu', 'alex.tincu', 'alex.tincu@ymail.com', NULL, '2017-03-02 12:09:44', NULL, NULL, 'a:0:{}'),
(3, '$2y$13$CEfIcM8D.cqhXlAU085h1ukWyoMwzTdpGgADQAmYM/FekKHhebYXy', 'alex.tincu2@ymail.com', 1, 'alex.tincu2', 'alex.tincu2', 'alex.tincu2@ymail.com', NULL, '2017-03-02 10:49:25', NULL, NULL, 'a:0:{}');

-- --------------------------------------------------------

--
-- Table structure for table `resource`
--

CREATE TABLE `resource` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `url` longtext COLLATE utf8_unicode_ci NOT NULL,
  `css_rule` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `check_date` datetime DEFAULT NULL,
  `new_html` longtext COLLATE utf8_unicode_ci,
  `old_html` longtext COLLATE utf8_unicode_ci,
  `alert_html` longtext COLLATE utf8_unicode_ci,
  `alert_sent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resource_history`
--

CREATE TABLE `resource_history` (
  `id` int(11) NOT NULL,
  `resource_id` int(11) DEFAULT NULL,
  `html` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_users`
--
ALTER TABLE `app_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_C250282492FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_C2502824A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_C2502824C05FB297` (`confirmation_token`);

--
-- Indexes for table `resource`
--
ALTER TABLE `resource`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BC91F416A76ED395` (`user_id`);

--
-- Indexes for table `resource_history`
--
ALTER TABLE `resource_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7A1A97A389329D25` (`resource_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_users`
--
ALTER TABLE `app_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `resource`
--
ALTER TABLE `resource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `resource_history`
--
ALTER TABLE `resource_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `resource`
--
ALTER TABLE `resource`
  ADD CONSTRAINT `FK_BC91F416A76ED395` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `resource_history`
--
ALTER TABLE `resource_history`
  ADD CONSTRAINT `FK_7A1A97A389329D25` FOREIGN KEY (`resource_id`) REFERENCES `resource` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
