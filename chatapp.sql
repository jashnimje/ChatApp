-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 22, 2022 at 06:13 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
CREATE TABLE IF NOT EXISTS `friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `approve` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user_id`, `friend_id`, `approve`) VALUES
(1, 611267228, 1110127113, 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'text',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `iv` text NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`, `type`, `time`, `iv`) VALUES
(1, 611267228, 1110127113, '9H0e', 'text', '2022-03-06 15:12:03', '2a1be32793a8bf1c73ab1b0ab7dc70c4'),
(2, 611267228, 1110127113, 'KOUfvDUHYqxYWeBu', 'image', '2022-03-06 15:51:15', 'e2fcb76d87bbd787c15a8d5ed7f2d29f'),
(3, 611267228, 1110127113, 'OrlyOy3yVbOc0VKt+bVvSKJgf7j5fdI=', 'application', '2022-03-06 16:37:09', '839c466f815aa8dd6241b3ab26aa1afa'),
(4, 611267228, 1110127113, 'osQRKU82nGEmtj0yCzywyE5IqWHdvW7ClA==', 'image', '2022-03-07 08:12:09', '7632a8f275f07eb071465ea340ecb306'),
(5, 611267228, 1110127113, '8U1Be8RsONWLIW9ZyQ/H1IVhjSLdHwaqxQ==', 'image', '2022-03-07 08:12:45', '6aa2779374614f9a534ba5dfe98f978f'),
(6, 611267228, 1110127113, 'Rwl2OMaZPjcjYuKFDayHUeIB+xtm5b8=', 'application', '2022-03-07 08:13:28', 'fd379f741e0590390c80e41c553d546d'),
(7, 611267228, 1110127113, 'ftJ7V0fkbcMRjGiiMdJqQC5J3beX5fQ=', 'application', '2022-03-07 08:15:42', '0ea4ed46f4144b5a445820b9fdbb037f'),
(8, 611267228, 1110127113, 'MVQx3F8XuhsJ66H+2YIjg4GtCi0VMXdQaA==', 'image', '2022-03-07 08:26:19', 'f6552127f2980c55235ec1b50f6fde42'),
(9, 611267228, 1110127113, 'P7go2mVLZa560AO2ylw9/lHQM6z7jkR+Zw==', 'image', '2022-03-07 09:26:51', '9c82c2c6cac67a1735cda41462d32e74'),
(10, 611267228, 1110127113, 'oM+FnuJq/dyEmYe3dlmk8pSX/fPcQPuv8A==', 'image', '2022-03-07 10:11:00', 'ecd767701cad57b6de0cf2dc6ca2ba4d'),
(11, 611267228, 1110127113, 'WZQS8lDTzVuS5cb2SaHvgGRIYzqCajDANg==', 'image', '2022-03-07 10:11:40', '6391a814dcf19477351c2f4068b39ba2'),
(12, 611267228, 1110127113, '/a6PpLxv+PTzKBVeNFPjgV3VN0bqxgFVQg==', 'image', '2022-03-07 10:11:48', 'bc88eedcc7d5ff9b6f53c6c305a294ba');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `private_key` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT 'default.png',
  `status` varchar(255) NOT NULL,
  `verify` int(1) DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `fname`, `lname`, `email`, `password`, `img`, `status`, `verify`) VALUES
(1, 1110127113, 'Admin', 'User', 'admin@email.com', '0192023a7bbd73250516f069df18b500', 'default.png', 'Online', 0),
(2, 611267228, 'Test1', 'User', 'test1@email.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'default.png', '06/03/22 - 03:10 pm', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
