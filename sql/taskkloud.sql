-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 16, 2013 at 07:02 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `taskkloud`
--

-- --------------------------------------------------------

--
-- Table structure for table `feeds`
--

CREATE TABLE IF NOT EXISTS `feeds` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `feeds` varchar(500) DEFAULT NULL,
  `hide` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `contact_no` bigint(10) DEFAULT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `name`, `email`, `contact_no`) VALUES
(1, 'Archit', 'saxenarchit@gmail.com', 8765381519),
(2, 'Tanay ', 'tanay1400089@gmail.com', 3456885647),
(3, 'Prince', 'aroraprince@ovi.com', 5757575757),
(4, 'Nikhil', 'contact.nikhil10@gmail.com', 4545622),
(5, 'Nishant', 'nishants95@yahoo.com', 123),
(6, 'Chetan', 'tochetanwadhwa@gmail.com', 123),
(7, 'Ashish', 'ashish.cuidadoso@gmail.com', 123),
(8, 'Sufiyan', 'sufiyan.contact10@gmail.com', 123),
(9, 'Anurag', 'anuragarora_cool@yahoo.com', 123),
(10, 'Rishabh', 'goelrishabh09@gmail.com', 123),
(11, 'Shivam ', 'cool_shivambansal@yahoo.com', 123),
(12, 'Sakshi ', 'sakshi.singhal313@gmail.com', 123),
(13, 'Khushboo', 'khushboosingh@outlook.com', 123),
(14, 'Priyanshu', 'priyanshuagarwal2005@gmail.com', 123);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(30) NOT NULL,
  `project_description` text,
  `alotted_by` varchar(30) NOT NULL,
  `alotted_to` varchar(40) NOT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `taskname` varchar(500) DEFAULT NULL,
  `taskto` varchar(50) NOT NULL,
  `task_from` varchar(50) NOT NULL,
  `done` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `usernames`
--

CREATE TABLE IF NOT EXISTS `usernames` (
  `user_id` int(3) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `user_exists` varchar(50) NOT NULL DEFAULT '1',
  `user_email_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `usernames`
--

INSERT INTO `usernames` (`user_id`, `user_name`, `user_exists`, `user_email_id`) VALUES
(1, 'Utsav Narayan Singh', '0', 'vastusingh@gmail.com'),
(2, 'Fraaz Hashmi', '0', 'fraaz.ahmad786@gmail.com'),
(3, 'Praneet Asthana', '0', 'teenarp.asthana@gmail.com'),
(4, 'Abhishek Verma', '0', 'abhishekkai08@gmail.com'),
(5, 'Shivam Gupta', '0', 'shivam4.akg@gmail.com'),
(6, 'Ankit Jouhri', '0', NULL),
(7, 'Anamika saroha', '0', 'saroha.anamika@gmail.com'),
(8, 'Deeksha Singh', '0', 'sngh.deeksha@gmail.com'),
(9, 'Priyanshi gupta', '0', 'priyaangel.gupta38@gmail.com'),
(10, 'Shivani verma', '0', 'varma.shivani8@gmail.com'),
(11, 'Mahek seth', '0', 'mahek.seth04@gmail.com'),
(12, 'Gopal Sharma', '0', NULL),
(13, 'Keshi Chandra Yadav', '0', NULL),
(14, 'Dhruv Singhal', '1', 'blackhatd@gmail.com'),
(15, 'Rishabh Kesarwani', '1', 'manu.inspiration@gmail.com'),
(16, 'Tushar Gupta', '1', 'rishabh.kesarwani@gmail.com'),
(17, 'Mohammad Afaq Alam', '1', 'afaqalam.4@gmail.com'),
(18, 'Prateek Arora', '0', 'aroraprateek22891@gmail.com'),
(19, 'Shatroopa Saxena', '1', 'shatroopasaxena@yahoo.co.in'),
(20, 'Aveeral Agarwal', '0', NULL),
(21, 'Chetna Khanna', '1', 'ckchetna92@gmail.com'),
(23, 'Shubham Jaiswal', '1', 'shubh17jaiswal@gmail.com'),
(24, 'Rishabh Khanna', '1', 'rishabhkhanna8087@gmail.com'),
(26, 'Archit Saxena', '1', 'saxenarchit@gmail.com'),
(27, 'Tanay Tandon', '1', 'tanay1400089@gmail.com'),
(28, 'Prince Arora', '1', 'aroraprince@ovi.com'),
(29, 'Nikhil Maheshwari ', '1', 'contact.nikhil10@gmail.com'),
(30, 'Priyanshu Agrawal', '1', 'priyanshuagarwal2005@gmail.com'),
(31, 'Chetan Wadhwa', '1', 'tochetanwadhwa@gmail.com'),
(32, 'Ashish Mishra', '1', 'ashish.cuidadoso@gmail.com'),
(33, 'Mohammad Sufiyan', '1', 'sufiyan.contact10@gmail.com'),
(34, 'Anurag Arora', '1', 'anuragarora_cool@yahoo.com'),
(35, 'Rishabh Goel', '1', 'goelrishabh09@gmail.com'),
(36, 'Nishant Srivastava', '1', 'nishants95@yahoo.com'),
(37, 'Shivam Bansal', '1', 'cool_shivambansal@yahoo.com'),
(38, 'Sakshi Singhal', '1', 'sakshi.singhal313@gmail.com'),
(39, 'Khushboo', '1', 'khushboosingh@outlook.com'),
(40, 'The God Father', '1', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
