-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 07, 2021 at 08:58 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `progressionapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `assigments`
--

DROP TABLE IF EXISTS `assigments`;
CREATE TABLE IF NOT EXISTS `assigments` (
  `id` decimal(3,1) NOT NULL,
  `lessons` varchar(5) NOT NULL,
  `description` varchar(255) NOT NULL,
  `ddline_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_assigments_lessons_idx` (`lessons`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assigments`
--

INSERT INTO `assigments` (`id`, `lessons`, `description`, `ddline_date`) VALUES
('1.3', 'BUR', 'Menschappelijke leven', '2021-06-23'),
('3.1', 'WEB', 'PHP &amp; CRUD', '2021-06-25');

-- --------------------------------------------------------

--
-- Table structure for table `assigment_points`
--

DROP TABLE IF EXISTS `assigment_points`;
CREATE TABLE IF NOT EXISTS `assigment_points` (
  `ass_id` decimal(3,1) NOT NULL,
  `student_id` int(6) NOT NULL,
  `result` int(11) NOT NULL,
  KEY `fk_assigment_points_ass_id` (`ass_id`),
  KEY `fk_assigments_points_result` (`result`),
  KEY `fk_assigments_points` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assigment_points`
--

INSERT INTO `assigment_points` (`ass_id`, `student_id`, `result`) VALUES
('3.1', 329188, 2);

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

DROP TABLE IF EXISTS `points`;
CREATE TABLE IF NOT EXISTS `points` (
  `id` int(11) NOT NULL,
  `pointurl` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `points`
--

INSERT INTO `points` (`id`, `pointurl`, `description`) VALUES
(1, 'goed.png', 'Goed'),
(2, 'voldoende.png', 'Voldoende'),
(3, 'onvoldoende.png', 'Onvoldoende');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assigments`
--
ALTER TABLE `assigments`
  ADD CONSTRAINT `fk_assigments_lessons` FOREIGN KEY (`lessons`) REFERENCES `course` (`lessons`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `assigment_points`
--
ALTER TABLE `assigment_points`
  ADD CONSTRAINT `fk_assigment_points_ass_id` FOREIGN KEY (`ass_id`) REFERENCES `assigments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_assigments_points` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_assigments_points_result` FOREIGN KEY (`result`) REFERENCES `points` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
