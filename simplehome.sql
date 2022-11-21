-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 24, 2021 at 12:32 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simplehome`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `address` varchar(550) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zipcode` varchar(150) NOT NULL,
  `primaryadd` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `uid`, `address`, `city`, `zipcode`, `primaryadd`, `created_at`, `updated_at`) VALUES
(49, 20, 'H-23, Shanti Niketan, Mota Varacha, Surat', 'Surat', '395006', 'true', '2021-03-23 05:01:29', NULL),
(3, 4, 'h-157,punitdham,mota varacha', 'Surat', '365025', 'true', '2021-03-03 08:17:26', NULL),
(52, 4, 'Man City,Bypass Road , Surat', 'Surat', '395006', NULL, '2021-03-23 11:26:37', NULL),
(25, 5, 'h-8,shubhlakshmi society,yogi chowk', 'Surat', '365553', 'true', '2021-03-03 10:46:37', NULL),
(50, 21, 'Madhav Nagar ,Kukavav Road,Mota Ankadiya', 'Amreli', '365401', 'true', '2021-03-23 09:32:02', NULL),
(41, 4, 'Khodiyar Nagar,Amreli Road,Mota Ankadiya', 'Amreli', '365401', NULL, '2021-03-05 05:41:03', NULL),
(42, 18, 'Mota Ankadiya', 'Amreli', '456789', 'true', '2021-03-05 06:14:45', NULL),
(43, 6, 'h-3,krishana rowhouse,sudama chowk', 'Surat', '365423', 'true', '2021-03-05 07:17:08', NULL),
(44, 4, 'New Ranip ,Khodiyar nagar', 'Ahmedabad', '653325', NULL, '2021-03-08 05:03:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile_image` varchar(100) NOT NULL,
  `remember_token` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `profile_image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Reena vaghasiya', 'patelreena172@gmail.com', '$2y$10$63SmJYft4PiB0dp/0fXOBuZcqJ0xkhSnnUQPDGcc9PDFU8xOZ/yZC', '1614400766aa.jpg', '636982', '2021-02-22 09:53:39', '2021-03-05 02:53:41');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

DROP TABLE IF EXISTS `bill`;
CREATE TABLE IF NOT EXISTS `bill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `cardname` varchar(100) NOT NULL,
  `cardno` text NOT NULL,
  `cvv` int(11) NOT NULL,
  `expiredate` varchar(500) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `charge_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=120 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `order_id`, `cardname`, `cardno`, `cvv`, `expiredate`, `payment_method`, `payment_status`, `charge_id`, `created_at`, `updated_at`) VALUES
(117, 169, 'Visa', '4111 1111 1111 1111', 444, '4/2025', 'card', 'succeeded', 'ch_1IVvBiHWCwg7HjvwY1d15WUB', '2021-03-17 08:57:08', NULL),
(116, 168, 'Visa', '4111 1111 1111 1111', 222, '3/2025', 'card', 'succeeded', 'ch_1IVrZRHWCwg7Hjvw8yoYFhsy', '2021-03-17 05:05:24', NULL),
(119, 171, 'Visa', '4242 4242 4242 4242', 423, '5/2025', 'card', 'succeeded', 'ch_1IY8NgHWCwg7HjvwpNtcPV1N', '2021-03-23 11:26:40', NULL),
(114, 166, 'Visa', '4111 1111 1111 1111', 456, '6/2026', 'card', 'refund', 'ch_1IVrRwHWCwg7HjvwUCVqlUn1', '2021-03-17 04:57:39', NULL),
(113, 165, 'Visa', '4242 4242 4242 4242', 444, '5/2024', 'card', 'succeeded', 'ch_1IVrQgHWCwg7HjvwmhBVDAcC', '2021-03-17 04:56:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hometb`
--

DROP TABLE IF EXISTS `hometb`;
CREATE TABLE IF NOT EXISTS `hometb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `item_name` text NOT NULL,
  `item_img` varchar(500) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `des` text NOT NULL,
  `status` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hometb`
--

INSERT INTO `hometb` (`id`, `u_id`, `item_name`, `item_img`, `price`, `des`, `status`, `created_at`, `updated_at`) VALUES
(31, 5, 'Salad', '161312799601.jpg', 600, 'vegetable masala salad', 'Active', '2021-02-12 11:06:36', NULL),
(46, 5, 'Bread pizza', '161397158406.jpg', 400, 'new bread pizza ', 'Active', '2021-02-22 05:26:24', NULL),
(45, 5, 'Chess pizza', '161397152013.jpg', 300, 'yummy and testy  chess pizza', 'Active', '2021-02-22 05:25:20', NULL),
(30, 5, 'Noodle', '1613637251.jpg', 300, 'noddle noodle...', 'Active', '2021-02-12 10:54:43', NULL),
(35, 4, 'Salad', '1613637078.jpg', 100, 'new  salad item', 'Pendding', '2021-02-13 08:05:10', NULL),
(36, 4, 'Noodle', '1613637027.jpg', 250, 'new one added noodle', 'Decline', '2021-02-13 08:05:48', NULL),
(42, 4, 'Simple  and testy noodle', '1613636808.jpg', 300, 'hello come on  every one eat the testy noodle', 'Decline', '2021-02-17 04:47:26', NULL),
(38, 5, 'Noodle', '1613637365.jpg', 550, 'simple and testy noodle', 'Active', '2021-02-13 08:58:42', NULL),
(49, 4, 'Pizza', '161397657414.jpg', 200, 'pizza', 'Pendding', '2021-02-22 06:49:34', NULL),
(48, 4, 'Chess with masala pizza', '161397221712.jpg', 350, 'new pizza added ...its very testy', 'Active', '2021-02-22 05:36:57', NULL),
(47, 4, 'Pizza ', '161397176421.jpg', 500, 'pizza hut', 'Active', '2021-02-22 05:29:24', NULL),
(44, 4, 'Vegetable salad', '1613636899.jpg', 70, ' healthy vegetable salad', 'Active', '2021-02-18 08:20:10', NULL),
(52, 4, 'Pizza', '161397667706.jpg', 170, 'bread pizza\r\n', 'Active', '2021-02-22 06:51:17', NULL),
(57, 4, 'Noodle', '161555142315.jpg', 111, 'new....', 'Active', '2021-03-12 12:17:03', NULL),
(56, 6, 'Noodle', '161543836818.jpg', 110, 'Yummy Noodle', 'Active', '2021-03-11 04:52:48', NULL),
(54, 4, 'Salad', '161425705311.jpg', 200, 'salad', 'Active', '2021-02-25 12:44:13', NULL),
(61, 20, 'Veg pizza', '1616476577slice.jpg', 80, 'simple vegetable pizza', 'Active', '2021-03-23 05:16:17', NULL),
(58, 4, 'A pizza', '161588897502.jpg', 100, 'A pizza', 'Pendding', '2021-03-16 10:02:55', NULL),
(62, 4, 'Veg chess pizza', '161649831313.jpg', 150, 'yummy and testy veg chess pizza', 'Active', '2021-03-23 11:18:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ordertb`
--

DROP TABLE IF EXISTS `ordertb`;
CREATE TABLE IF NOT EXISTS `ordertb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_id` varchar(110) NOT NULL,
  `qty` varchar(110) NOT NULL,
  `total_price` int(11) NOT NULL,
  `address` text NOT NULL,
  `status` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upadted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=172 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordertb`
--

INSERT INTO `ordertb` (`id`, `user_id`, `item_id`, `qty`, `total_price`, `address`, `status`, `created_at`, `upadted_at`) VALUES
(169, 4, '49,', '3,', 600, 'h-157,punitdham,mota varacha,surat,365025', 'Conform', '2021-03-17 08:57:06', NULL),
(168, 4, '57,44,', '1,2,', 251, 'New Ranip ,Khodiyar nagar,Ahmedabad,653325', 'Pendding', '2021-03-17 05:05:22', NULL),
(171, 4, '61,', '2,', 160, 'Man City,Bypass Road , Surat , Surat , 395006', 'InProcess', '2021-03-23 11:26:37', NULL),
(166, 4, '38,', '2,', 1100, 'Khodiyar Nagar,Amreli Road,Mota Ankadiya,Amreli,365401', 'OrderCancel', '2021-03-17 04:57:37', NULL),
(165, 4, '44,49,', '2,1,', 340, 'h-157,punitdham,mota varacha,surat,365025', 'Pendding', '2021-03-17 04:56:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `remember_token` text,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fname`, `lname`, `email`, `password`, `phone`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Reena', 'Vaghasiya', 'patelreena172@gmail.com', '$2y$10$IScRR0wPHjzEU4MfwWU1VuSjjMze8PSAOgjVnSvgfTuPs6jQtsGUK', '6353095498', '344970', 'Active', '2021-02-11 10:42:03', '2021-03-12 06:29:59'),
(5, 'Chetan', 'Gothaliya', 'chetan123@gmail.com', '$2y$10$TNZ0PYWdMOI9/mTNOUIsceb3PFjnJCOnv95E7GkFCyaXpXYd.6Pfq', '9725533900', NULL, 'Active', '2021-02-12 06:52:51', NULL),
(6, 'Dhara', 'Vaghasiya', 'pateldhara123@gmail.com', '$2y$10$OoXoUdtAl2OEOc565lkdzu9YYTBzu63iI2ajJ9v8ZaEBhUj.nZ3Du', '9512935434', NULL, 'Active', '2021-02-13 08:57:09', NULL),
(18, 'Dherya', 'Vaghasiya', 'dheru45@gmail.com', '$2y$10$GB39Ursy7buLuR.P5.xXzunfELB/aiPFAZEo8JcOKfUobVTDZiVgS', '7562024585', NULL, 'Blocked', '2021-03-05 06:14:45', NULL),
(20, 'Ajay', 'Vaghasiya', 'ajayvaghasiya2000@gmail.com', '$2y$10$VSo9p2QlH3xfdW/2qyB2HujcFw3BcymwRCECA5fSemrYYfq0jw2Zq', '7547144056', NULL, 'Active', '2021-03-23 05:01:29', NULL),
(21, 'Shreya', 'Vaghasiya', 'shreyu11@gmail.com', '$2y$10$SynNLcmJD.WhwVPeoSU5y.i3MAoz9DS19UGtEVjw0GR/nnx7WJnae', '7485859685', NULL, 'Active', '2021-03-23 09:32:02', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
