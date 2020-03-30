-- phpMyAdmin SQL Dump
-- version OVH
-- https://www.phpmyadmin.net/
--
-- Generation Time: Mar 30, 2020 at 11:54 AM
-- Server version: 5.6.46-log
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Table structure for table `food_diary`
--

CREATE TABLE `food_diary` (
  `id` int(32) UNSIGNED ZEROFILL NOT NULL,
  `insertime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ReportedFor` varchar(10) NOT NULL COMMENT 'welcher Tag gemeldet wird',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '-1=vorher 0=essen 1=nachher',
  `meal` tinyint(1) NOT NULL COMMENT '1=frühstück 2=mittag 3=abend',
  `feeling` tinyint(1) DEFAULT NULL COMMENT '0=gut / 1=ok / 2=bad / 3=terrible ',
  `foods` varchar(1024) NOT NULL COMMENT 'was gegessen wurde',
  `user_id` int(5) UNSIGNED ZEROFILL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `food_feelings`
--

CREATE TABLE `food_feelings` (
  `id` tinyint(1) NOT NULL,
  `feeling` tinyint(1) DEFAULT NULL COMMENT '0=good 1=ok 2=bad 3=terribel',
  `name` varchar(64) DEFAULT NULL,
  `language` varchar(2) NOT NULL COMMENT 'international 2 Standart letter'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `food_ingredients`
--

CREATE TABLE `food_ingredients` (
  `id` int(9) UNSIGNED ZEROFILL NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_used` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `food_intolerances`
--

CREATE TABLE `food_intolerances` (
  `id_food` int(10) UNSIGNED ZEROFILL NOT NULL,
  `id_user` int(5) NOT NULL,
  `rating1` float NOT NULL DEFAULT '0',
  `rating2` float NOT NULL DEFAULT '0',
  `rating3` float NOT NULL DEFAULT '0',
  `rate_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `food_meals`
--

CREATE TABLE `food_meals` (
  `id` tinyint(4) NOT NULL,
  `meal` tinyint(1) NOT NULL COMMENT '1=Breakfast 2=Lunch 3=Dinner',
  `name` varchar(64) NOT NULL,
  `language` varchar(2) NOT NULL COMMENT 'international 2 letter standart'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `food_sets`
--

CREATE TABLE `food_sets` (
  `id` int(9) UNSIGNED ZEROFILL NOT NULL,
  `firma` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `ingredients` varchar(1024) NOT NULL,
  `barcode` varchar(16) NOT NULL,
  `last_used` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `food_types`
--

CREATE TABLE `food_types` (
  `id` int(4) NOT NULL,
  `type` varchar(2) NOT NULL,
  `name` varchar(64) NOT NULL,
  `language` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(128) NOT NULL,
  `language` varchar(2) NOT NULL DEFAULT 'EN',
  `email` varchar(128) NOT NULL,
  `hash` varchar(1024) NOT NULL,
  `intolerances` varchar(128) NOT NULL,
  `acc_food` tinyint(1) NOT NULL DEFAULT '0',
  `acc_drive` tinyint(1) NOT NULL DEFAULT '0',
  `acc_http` tinyint(1) NOT NULL DEFAULT '0',
  `acc_ftp` tinyint(1) NOT NULL DEFAULT '0',
  `acc_dev` tinyint(1) NOT NULL DEFAULT '0',
  `acc_proxy` tinyint(1) NOT NULL DEFAULT '0',
  `acc_gallery` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_languages`
--

CREATE TABLE `user_languages` (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `language` varchar(2) NOT NULL,
  `language_name` varchar(64) NOT NULL,
  `language_flag` varchar(8000) NOT NULL,
  `acc_details` varchar(64) NOT NULL,
  `acc_settings` varchar(64) NOT NULL,
  `acc_login` varchar(64) NOT NULL,
  `acc_logout` varchar(64) NOT NULL,
  `menu_diary` varchar(64) NOT NULL,
  `menu_statistics` varchar(64) NOT NULL,
  `menu_history` varchar(64) NOT NULL,
  `menu_charts` varchar(64) NOT NULL,
  `menu_daily` varchar(64) NOT NULL,
  `sug_latest_scans` varchar(64) NOT NULL,
  `sug_latest_ingredients` varchar(1024) NOT NULL,
  `stat_times` varchar(64) NOT NULL,
  `stat_ingredients` varchar(64) NOT NULL,
  `his_date` varchar(64) NOT NULL,
  `his_meal` varchar(64) NOT NULL,
  `his_ingredients` varchar(64) NOT NULL,
  `nav_goback` varchar(64) NOT NULL,
  `nav_edit` varchar(64) NOT NULL,
  `tip_filterby` varchar(64) NOT NULL,
  `chart_average` varchar(64) NOT NULL,
  `chart_total` varchar(64) NOT NULL,
  `last_used` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_visitors`
--

CREATE TABLE `user_visitors` (
  `id` int(16) UNSIGNED ZEROFILL NOT NULL,
  `firstseen` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastseen` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `ip` varchar(128) NOT NULL,
  `agent` varchar(256) NOT NULL,
  `host` varchar(256) NOT NULL,
  `referrer` varchar(1024) DEFAULT NULL,
  `visits` int(8) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `food_diary`
--
ALTER TABLE `food_diary`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `food_feelings`
--
ALTER TABLE `food_feelings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `name_2` (`name`),
  ADD KEY `name_3` (`name`);

--
-- Indexes for table `food_ingredients`
--
ALTER TABLE `food_ingredients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `food` (`name`);

--
-- Indexes for table `food_intolerances`
--
ALTER TABLE `food_intolerances`
  ADD UNIQUE KEY `id_food` (`id_food`,`id_user`);

--
-- Indexes for table `food_meals`
--
ALTER TABLE `food_meals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `food_sets`
--
ALTER TABLE `food_sets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `barcode` (`barcode`);

--
-- Indexes for table `food_types`
--
ALTER TABLE `food_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_languages`
--
ALTER TABLE `user_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_visitors`
--
ALTER TABLE `user_visitors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ip` (`ip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food_diary`
--
ALTER TABLE `food_diary`
  MODIFY `id` int(32) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_feelings`
--
ALTER TABLE `food_feelings`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_ingredients`
--
ALTER TABLE `food_ingredients`
  MODIFY `id` int(9) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_meals`
--
ALTER TABLE `food_meals`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_sets`
--
ALTER TABLE `food_sets`
  MODIFY `id` int(9) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_types`
--
ALTER TABLE `food_types`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_languages`
--
ALTER TABLE `user_languages`
  MODIFY `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_visitors`
--
ALTER TABLE `user_visitors`
  MODIFY `id` int(16) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
