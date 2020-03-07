-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2020 at 08:54 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `car_wash`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '0',
  `allow_customer` int(11) NOT NULL DEFAULT '0',
  `allow_partner` int(11) NOT NULL DEFAULT '0',
  `allow_brand` int(11) NOT NULL DEFAULT '0',
  `allow_category` int(11) NOT NULL DEFAULT '0',
  `user_type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `mobile_number`, `password`, `is_active`, `allow_customer`, `allow_partner`, `allow_brand`, `allow_category`, `user_type`) VALUES
(1, 'asdfg', 'a@gmail.com', '1234567890', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 1, 1, 1, 'subadmin'),
(2, 'a', 'a@gmail.com', 'a', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, 0, 0, 0, 'subadmin'),
(3, 'adminone', 'a@gmail.com', '9876543210', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, 1, 1, 1, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `logo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `model`, `logo`) VALUES
(1, 'a', 'a', ''),
(3, 'b', 'b', ''),
(4, 'c', 'c', ''),
(5, 'd', 'd', '');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `min_price` varchar(50) NOT NULL,
  `max_price` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `parent_id`, `min_price`, `max_price`) VALUES
(1, 'a', 0, '', ''),
(2, 'b', 0, '', ''),
(4, 'f', 2, '2000', '4000'),
(5, 'w', 2, '1', '2');

-- --------------------------------------------------------

--
-- Table structure for table `customer_partner`
--

CREATE TABLE IF NOT EXISTS `customer_partner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile_number` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '0',
  `user_type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `customer_partner`
--

INSERT INTO `customer_partner` (`id`, `name`, `email`, `mobile_number`, `password`, `is_active`, `user_type`) VALUES
(2, 'a', 'a@gmail.com..', '978654213', '', 1, 'customer'),
(3, 'qwerty', 'a@gmail.com', '1234567890', '', 0, 'partner'),
(4, 'sdasd', 'a@gmail.com', '1234567890', '', 0, 'customer');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
