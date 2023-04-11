-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2023 at 02:14 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `feastdb-copy`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` varchar(255) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_type`) VALUES
('1', 'first event', 'first type');

-- --------------------------------------------------------

--
-- Table structure for table `events_orders`
--

CREATE TABLE `events_orders` (
  `order_no` varchar(255) NOT NULL,
  `receipt_no` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `order_created_date` varchar(255) NOT NULL,
  `order_completed_date` varchar(255) NOT NULL,
  `pay_method` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events_orders`
--

INSERT INTO `events_orders` (`order_no`, `receipt_no`, `order_status`, `order_created_date`, `order_completed_date`, `pay_method`) VALUES
('1212', 'rcptno-gen-6433c67ed83a1', 'ok', '2021-12-23', '2023-03-07', 'cash'),
('1213', '1314', 'ok', '2021-12-24', '2023-03-08', 'cash'),
('1214', 'rcptno-gen-6433c3ffbd983', 'ok', '2021-12-25', '2023-03-09', 'cash'),
('2123', '1316', 'ok', '2021-12-26', '2023-03-10', 'cash'),
('2124', '1317', 'ok', '2021-12-27', '2023-03-11', 'cash'),
('2125', '1318', 'ok', '2021-12-28', '2023-03-12', 'cash'),
('2126', '1319', 'ok', '2021-12-29', '2023-03-13', 'cash'),
('2127', '1320', 'ok', '2021-12-30', '2023-03-14', 'cash'),
('2129', '1322', 'ok', '2022-01-01', '2023-03-16', 'bank'),
('2130', '1323', 'ok', '2022-01-02', '2023-03-17', 'bank'),
('2131', '1324', 'ok', '2022-01-03', '2023-03-18', 'bank'),
('2132', '1325', 'not ok', '2022-01-04', '2023-03-19', 'online'),
('2133', '1326', 'ok', '2022-01-05', '2023-03-20', 'online'),
('2134', '1327', 'ok', '2022-01-06', '2023-03-21', 'online'),
('2135', '1328', 'ok', '2022-01-07', '2023-03-22', 'online'),
('2136', '1329', 'ok', '2022-01-08', '2023-03-23', 'online'),
('ordno-gen-6433c3ffc00df', '1321', 'ok', '2021-12-31', '2023-03-15', 'online');

-- --------------------------------------------------------

--
-- Table structure for table `events_ticket`
--

CREATE TABLE `events_ticket` (
  `ticket_id` varchar(255) NOT NULL,
  `event_id` varchar(255) NOT NULL,
  `ticket_type` varchar(255) NOT NULL,
  `ticket_name` varchar(255) NOT NULL,
  `ticket_cost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events_ticket`
--

INSERT INTO `events_ticket` (`ticket_id`, `event_id`, `ticket_type`, `ticket_name`, `ticket_cost`) VALUES
('tcktid-64337a6ec9a13', '1', 'idk', 'eras tour', 5000),
('tcktid-6433a1a108eb1', '1', 'idk', 'eras tour', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `events_ticket_items`
--

CREATE TABLE `events_ticket_items` (
  `order_no` varchar(255) NOT NULL,
  `ticket_id` varchar(255) NOT NULL,
  `user_id` varchar(17) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `feastapp`
--

CREATE TABLE `feastapp` (
  `feastapp_id` varchar(20) NOT NULL,
  `user_id` varchar(17) NOT NULL,
  `date_downloaded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feastapp`
--

INSERT INTO `feastapp` (`feastapp_id`, `user_id`, `date_downloaded`) VALUES
('fstapp-6433be43c7994', 'uid-641c1617cc9d2', '2022-12-12');

-- --------------------------------------------------------

--
-- Table structure for table `feastbooks_orders`
--

CREATE TABLE `feastbooks_orders` (
  `order_id` varchar(19) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `order_created` date NOT NULL,
  `order_completed` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `feastbooks_products`
--

CREATE TABLE `feastbooks_products` (
  `product_id` varchar(19) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `cost` float NOT NULL,
  `variation` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `feastbook_transactions`
--

CREATE TABLE `feastbook_transactions` (
  `feastbook_id` varchar(19) NOT NULL,
  `order_id` varchar(19) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `user_id` varchar(17) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `feastmedia`
--

CREATE TABLE `feastmedia` (
  `feast_media_event_id` varchar(20) NOT NULL,
  `user_id` varchar(17) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `ticket_type` varchar(255) NOT NULL,
  `event_type` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `ticket_cost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feastmedia`
--

INSERT INTO `feastmedia` (`feast_media_event_id`, `user_id`, `event_name`, `ticket_type`, `event_type`, `event_date`, `ticket_cost`) VALUES
('fmedid-6433bad49bad3', 'uid-641c1617cecfa', 'live house', 'live band', 'music', '2020-04-20', 3500);

-- --------------------------------------------------------

--
-- Table structure for table `feastmercyministry`
--

CREATE TABLE `feastmercyministry` (
  `fmm_id` varchar(18) NOT NULL,
  `user_id` varchar(17) NOT NULL,
  `donor_type` varchar(255) NOT NULL,
  `donation_start_date` date NOT NULL,
  `donation_end_date` date NOT NULL,
  `amount` float NOT NULL,
  `pay_method` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feastmercyministry`
--

INSERT INTO `feastmercyministry` (`fmm_id`, `user_id`, `donor_type`, `donation_start_date`, `donation_end_date`, `amount`, `pay_method`) VALUES
('fmmid-6433a55fbc63', 'uid-641c1617d1fe6', 'one time', '2020-08-16', '2020-08-16', 60000, 'bank');

-- --------------------------------------------------------

--
-- Table structure for table `feastph`
--

CREATE TABLE `feastph` (
  `feastph_id` varchar(19) NOT NULL,
  `user_id` varchar(17) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_download_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feastph`
--

INSERT INTO `feastph` (`feastph_id`, `user_id`, `file_name`, `file_download_date`) VALUES
('fphid-6433b25352d96', 'uid-641c1617cc30f', 'extract-file.fle', '2021-09-10');

-- --------------------------------------------------------

--
-- Table structure for table `holyweekretreat`
--

CREATE TABLE `holyweekretreat` (
  `hwr_id` varchar(19) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `event_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `holyweekretreat`
--

INSERT INTO `holyweekretreat` (`hwr_id`, `user_id`, `event_date`) VALUES
('hwrid-6433aabdd2454', 'uid-641c1617d0a4f', '2019-03-20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(17) NOT NULL,
  `email` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `mobile_no` varchar(11) DEFAULT NULL,
  `is_bonafied` tinyint(1) NOT NULL,
  `is_feast_attendee` tinyint(1) DEFAULT NULL,
  `feast_name` varchar(255) DEFAULT NULL,
  `feast_district` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `last_name`, `first_name`, `mobile_no`, `is_bonafied`, `is_feast_attendee`, `feast_name`, `feast_district`, `address`, `city`, `country`) VALUES
('uid-641c1617c8e06', 'saibajoichiro@gmail.com', 'saiba', 'joichiro', '9080706050', 0, NULL, NULL, NULL, NULL, 'tokyo', NULL),
('uid-641c1617c96cf', 'contact@totsuki.com', 'sanzaemon', 'sanzaemon', '9080706051', 0, NULL, NULL, NULL, NULL, NULL, NULL),
('uid-641c1617ca497', 'alicenakiri@gmail.com', 'nakiri', 'alice', '9080706052', 0, NULL, NULL, NULL, NULL, NULL, NULL),
('uid-641c1617cabae', 'fd@sdf.com', 'dsf', 'sdf', '9080706053', 0, NULL, NULL, NULL, NULL, NULL, NULL),
('uid-641c1617cb3da', 'sd@sda.xom', 'sda', 'lasd', '9080706054', 0, NULL, NULL, NULL, NULL, NULL, NULL),
('uid-641c1617cbd0a', 'yukihirasoma@gmail.com', 'yukihira', 'soma', '9080706055', 0, NULL, NULL, NULL, NULL, NULL, NULL),
('uid-641c1617cc30f', 'hayamaakira@yahoo.com', 'hayama', 'akira', '9080706056', 0, NULL, NULL, NULL, NULL, NULL, NULL),
('uid-641c1617cc9d2', 'aldinitakumi@gmail.com', 'aldini', 'takumi', '9080706057', 0, NULL, NULL, NULL, NULL, NULL, NULL),
('uid-641c1617cd042', 'tadokoromegumi@yahoo.com', 'tadokoro', 'megumi', '9080706058', 0, NULL, NULL, NULL, NULL, NULL, NULL),
('uid-641c1617cd6a4', 'nakirierina@yahoo.com', 'nakiri', 'erina', '9080706059', 0, NULL, NULL, NULL, NULL, NULL, NULL),
('uid-641c1617cdd86', 'ryokurokiba@yahoo.com', 'kurokiba', 'ryo', '9080706060', 0, NULL, NULL, NULL, NULL, NULL, NULL),
('uid-641c1617ce2d8', 'kiyotakaayano@yahoo.com', 'ayanokouji', 'kiyotaka', '9080706061', 0, NULL, NULL, NULL, NULL, NULL, NULL),
('uid-641c1617ce7c6', 'karuizawakei@yahoo.com', 'karuizawa', 'kei', '9080706062', 0, NULL, NULL, NULL, NULL, NULL, NULL),
('uid-641c1617cecfa', 'hirasawayui@yahoo.com', 'hirasawa', 'yui', '9080706063', 0, NULL, NULL, NULL, NULL, NULL, NULL),
('uid-641c1617cf218', 'akiyamamio@yahoo.com', 'akiyama', 'mio', '9080706064', 0, NULL, NULL, NULL, NULL, NULL, NULL),
('uid-641c1617cf9db', 'kotobukitsumugi@yahoo.com', 'kotobuki', 'tsumugi', '9080706065', 0, NULL, NULL, NULL, NULL, NULL, NULL),
('uid-641c1617cffdc', 'tainakaritsu@yahoo.com', 'tainaka', 'ristu', '9080706066', 0, NULL, NULL, NULL, NULL, NULL, NULL),
('uid-641c1617d0525', 'houtarooreki@gmail.com', 'houtarou', 'oreki', '9080706067', 0, NULL, NULL, NULL, NULL, NULL, NULL),
('uid-641c1617d0a4f', 'eruchitanda@yahoo.com', 'chitanda', 'eru', '9080706068', 0, NULL, NULL, NULL, NULL, NULL, NULL),
('uid-641c1617d0eda', 'satoshifukube@yahoo.com', 'fukube', 'satoshi', '9080706069', 0, NULL, NULL, NULL, NULL, NULL, NULL),
('uid-641c1617d1429', 'mayakaibara@gmail.com', 'ibara', 'mayaka', '9080706070', 0, NULL, NULL, NULL, NULL, NULL, NULL),
('uid-641c1617d19b0', 'takasuryuuji@gmail.com', 'takasu', 'ryuuji', '9080706071', 0, NULL, NULL, NULL, NULL, NULL, NULL),
('uid-641c1617d1fe6', 'aisakataiga@yahoo.com', 'aisaka', 'taiga', '9080706072', 0, NULL, NULL, NULL, NULL, NULL, NULL),
('uid-641c1617d2554', 'nouzenshin@yahoo.com', 'nouzen', 'shinei', '9080706073', 0, NULL, NULL, NULL, NULL, NULL, NULL),
('uid-6433e5e87086a', 'akiyamamio@yahoo.com', 'akiyama', 'miu', '9080706064', 1, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `events_orders`
--
ALTER TABLE `events_orders`
  ADD PRIMARY KEY (`order_no`);

--
-- Indexes for table `events_ticket`
--
ALTER TABLE `events_ticket`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `events_ticket_items`
--
ALTER TABLE `events_ticket_items`
  ADD KEY `fk_etiideoid` (`order_no`),
  ADD KEY `fk_etiidetid` (`ticket_id`),
  ADD KEY `fk_etiiduid` (`user_id`);

--
-- Indexes for table `feastapp`
--
ALTER TABLE `feastapp`
  ADD PRIMARY KEY (`feastapp_id`),
  ADD KEY `FK_FAidUid` (`user_id`);

--
-- Indexes for table `feastbooks_orders`
--
ALTER TABLE `feastbooks_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `feastbooks_products`
--
ALTER TABLE `feastbooks_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `feastbook_transactions`
--
ALTER TABLE `feastbook_transactions`
  ADD PRIMARY KEY (`feastbook_id`),
  ADD KEY `FK_TidOid` (`order_id`),
  ADD KEY `FK_TidUid` (`user_id`),
  ADD KEY `fk_ftidpid` (`product_id`);

--
-- Indexes for table `feastmedia`
--
ALTER TABLE `feastmedia`
  ADD PRIMARY KEY (`feast_media_event_id`),
  ADD KEY `FK_FMidUid` (`user_id`);

--
-- Indexes for table `feastmercyministry`
--
ALTER TABLE `feastmercyministry`
  ADD PRIMARY KEY (`fmm_id`),
  ADD KEY `FK_AidUid` (`user_id`);

--
-- Indexes for table `feastph`
--
ALTER TABLE `feastph`
  ADD PRIMARY KEY (`feastph_id`),
  ADD KEY `FK_FphidUid` (`user_id`);

--
-- Indexes for table `holyweekretreat`
--
ALTER TABLE `holyweekretreat`
  ADD PRIMARY KEY (`hwr_id`),
  ADD KEY `FK_HWRidUid` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events_ticket`
--
ALTER TABLE `events_ticket`
  ADD CONSTRAINT `events_ticket_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`);

--
-- Constraints for table `events_ticket_items`
--
ALTER TABLE `events_ticket_items`
  ADD CONSTRAINT `fk_etiideoid` FOREIGN KEY (`order_no`) REFERENCES `events_orders` (`order_no`),
  ADD CONSTRAINT `fk_etiidetid` FOREIGN KEY (`ticket_id`) REFERENCES `events_ticket` (`ticket_id`),
  ADD CONSTRAINT `fk_etiiduid` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `feastapp`
--
ALTER TABLE `feastapp`
  ADD CONSTRAINT `FK_FAidUid` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `feastbook_transactions`
--
ALTER TABLE `feastbook_transactions`
  ADD CONSTRAINT `FK_TidOid` FOREIGN KEY (`order_id`) REFERENCES `feastbooks_orders` (`order_id`),
  ADD CONSTRAINT `FK_TidUid` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_ftidpid` FOREIGN KEY (`product_id`) REFERENCES `feastbooks_products` (`product_id`);

--
-- Constraints for table `feastmedia`
--
ALTER TABLE `feastmedia`
  ADD CONSTRAINT `FK_FMidUid` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `feastmercyministry`
--
ALTER TABLE `feastmercyministry`
  ADD CONSTRAINT `FK_AidUid` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `feastph`
--
ALTER TABLE `feastph`
  ADD CONSTRAINT `FK_FphidUid` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `holyweekretreat`
--
ALTER TABLE `holyweekretreat`
  ADD CONSTRAINT `FK_HWRidUid` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
