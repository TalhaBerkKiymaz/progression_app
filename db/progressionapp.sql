-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 04 feb 2021 om 13:28
-- Serverversie: 5.7.26
-- PHP-versie: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Tabelstructuur voor tabel `class`
--

DROP TABLE IF EXISTS `class`;
CREATE TABLE IF NOT EXISTS `class` (
  `class_name` varchar(45) NOT NULL,
  `education` varchar(45) NOT NULL,
  `cohort` varchar(5) NOT NULL,
  PRIMARY KEY (`class_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `class`
--

INSERT INTO `class` (`class_name`, `education`, `cohort`) VALUES
('AM1C', 'AM', 'C2020'),
('AM1D', 'AM', 'C2020'),
('AM2A', 'AM', 'C2020'),
('AM2B', 'AM', 'C2020');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `class_course`
--

DROP TABLE IF EXISTS `class_course`;
CREATE TABLE IF NOT EXISTS `class_course` (
  `lessons` varchar(5) NOT NULL,
  `class_name` varchar(45) NOT NULL,
  `periode` varchar(5) NOT NULL,
  KEY `fk_classes_courses_lessons_idx` (`lessons`),
  KEY `fk_classes_courses_class_name_idx` (`class_name`),
  KEY `fk_classes_courses_periode_idx` (`periode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `class_course`
--

INSERT INTO `class_course` (`lessons`, `class_name`, `periode`) VALUES
('WEB', 'AM2A', 'P1'),
('ENG', 'AM1C', 'P5'),
('NED', 'AM2B', 'P3'),
('BUR', 'AM1D', 'P7'),
('ASP', 'AM1D', 'P9'),
('ASP', 'AM2A', 'P2'),
('ENG', 'AM2A', 'P1'),
('NED', 'AM2A', 'P1'),
('BUR', 'AM2A', 'P1'),
('ASP', 'AM2A', 'P1'),
('WEB', 'AM1C', 'P5'),
('NED', 'AM1C', 'P5'),
('BUR', 'AM1C', 'P5'),
('ASP', 'AM1C', 'P5'),
('WEB', 'AM2B', 'P3'),
('ENG', 'AM2B', 'P3'),
('BUR', 'AM2B', 'P3'),
('ASP', 'AM2B', 'P3'),
('WEB', 'AM1D', 'P7'),
('ENG', 'AM1D', 'P7'),
('NED', 'AM1D', 'P7');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `lessons` varchar(5) NOT NULL,
  `course_name` varchar(45) NOT NULL,
  `description` varchar(400) NOT NULL,
  PRIMARY KEY (`lessons`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `course`
--

INSERT INTO `course` (`lessons`, `course_name`, `description`) VALUES
('ASP', 'Essential Training', 'Dit is een basiscursus Laravel'),
('BUR', 'Vrijheid', 'Hier leer je je mening te geven'),
('ENG', 'Past Simple', 'Hier leer je verleden tijd'),
('NED', 'Adjectives', 'Adjectives is een woordsoort in de taalkundige benoeming'),
('WEB', 'PHP & CRUD', 'Hier leer je PHP');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `periode`
--

DROP TABLE IF EXISTS `periode`;
CREATE TABLE IF NOT EXISTS `periode` (
  `periode` varchar(5) NOT NULL,
  `semester` varchar(5) NOT NULL,
  PRIMARY KEY (`periode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `periode`
--

INSERT INTO `periode` (`periode`, `semester`) VALUES
('P1', 'S1'),
('P10', 'S5'),
('P11', 'S6'),
('P12', 'S6'),
('P2', 'S1'),
('P3', 'S2'),
('P4', 'S2'),
('P5', 'S3'),
('P6', 'S3'),
('P7', 'S4'),
('P8', 'S4'),
('P9', 'S5');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `infix` varchar(10) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  PRIMARY KEY (`student_id`),
  KEY `fk_students_class_name_idx` (`class_name`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `student`
--

INSERT INTO `student` (`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES
(1, 'AM2A', 'Ahmet', '', 'Erdogan'),
(2, 'AM2A', 'Arjan', 'de', 'Ruijter'),
(3, 'AM2A', 'Hans', '', 'Odijk'),
(4, 'AM2A', 'Cuneyt', '', 'Sterk'),
(5, 'AM2B', 'Nalinie', '', 'Zwemmer'),
(6, 'AM2B', 'Yaron', 'van den', 'Nieuwenhuijzen'),
(7, 'AM2B', 'Ghizlan', 'van der', 'Zon'),
(8, 'AM2B', 'Tarik', '', 'Comolokko'),
(9, 'AM2B', 'Talha', '', 'Kiymaz'),
(10, 'AM1C', 'Orpheo ', '', 'Woortman'),
(11, 'AM1C', 'Julienne ', '', 'Sneekes'),
(12, 'AM1C', 'Berry', '', 'Schermer'),
(13, 'AM1C', 'Kristin ', '', 'Passchier'),
(14, 'AM1C', 'Pieterdina ', '', 'Boonzaaijer'),
(15, 'AM1D', 'Pip ', '', 'Creemers'),
(16, 'AM1D', 'Cherryl ', '', 'Pels'),
(17, 'AM1D', 'Sheryl ', '', 'Touissaint'),
(18, 'AM1D', 'Teis', 'van der', 'Wel'),
(19, 'AM1D', 'Kenn', '', 'Perquin');

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `class_course`
--
ALTER TABLE `class_course`
  ADD CONSTRAINT `fk_classes_courses_class_name` FOREIGN KEY (`class_name`) REFERENCES `class` (`class_name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_classes_courses_lessons` FOREIGN KEY (`lessons`) REFERENCES `course` (`lessons`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_classes_courses_periode` FOREIGN KEY (`periode`) REFERENCES `periode` (`periode`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_students_class_name` FOREIGN KEY (`class_name`) REFERENCES `class` (`class_name`) ON DELETE NO ACTION ON UPDATE NO ACTION;
USE `progressionapp`;
INSERT INTO `progressionapp`.`course` (`lessons`, `course_name`) VALUES ('WEB', 'PHP & CRUD');
INSERT INTO `progressionapp`.`course` (`lessons`, `course_name`) VALUES ('NED', 'Adjectives');
INSERT INTO `progressionapp`.`course` (`lessons`, `course_name`) VALUES ('ENG', 'Past Simple');
INSERT INTO `progressionapp`.`course` (`lessons`, `course_name`) VALUES ('BUR', 'Vrijheid');
INSERT INTO `progressionapp`.`course` (`lessons`, `course_name`) VALUES ('ASP', 'Essential Training');

COMMIT;


-- -----------------------------------------------------
-- Data for table `progressionapp`.`student`
-- -----------------------------------------------------
START TRANSACTION;
USE `progressionapp`;
INSERT INTO `progressionapp`.`student` (`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (DEFAULT, 'AM2A', 'Ahmet', '', 'Erdogan');
INSERT INTO `progressionapp`.`student` (`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (DEFAULT, 'AM2A', 'Arjan', 'de', 'Ruijter');
INSERT INTO `progressionapp`.`student` (`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (DEFAULT, 'AM2A', 'Hans', '', 'Odijk');
INSERT INTO `progressionapp`.`student` (`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (DEFAULT, 'AM2A', 'Cuneyt', '', 'Sterk');
INSERT INTO `progressionapp`.`student` (`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (DEFAULT, 'AM2B', 'Nalinie', '', 'Zwemmer');
INSERT INTO `progressionapp`.`student` (`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (DEFAULT, 'AM2B', 'Yaron', 'van den', 'Nieuwenhuijzen');
INSERT INTO `progressionapp`.`student` (`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (DEFAULT, 'AM2B', 'Ghizlan', 'van der', 'Zon');
INSERT INTO `progressionapp`.`student` (`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (DEFAULT, 'AM2B', 'Tarik', '', 'Comolokko');
INSERT INTO `progressionapp`.`student` (`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (DEFAULT, 'AM2B', 'Talha', '', 'Kiymaz');
INSERT INTO `progressionapp`.`student` (`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (DEFAULT, 'AM1C', 'Orpheo ', '', 'Woortman');
INSERT INTO `progressionapp`.`student` (`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (DEFAULT, 'AM1C', 'Julienne ', '', 'Sneekes');
INSERT INTO `progressionapp`.`student` (`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (DEFAULT, 'AM1C', 'Berry', '', 'Schermer');
INSERT INTO `progressionapp`.`student` (`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (DEFAULT, 'AM1C', 'Kristin ', '', 'Passchier');
INSERT INTO `progressionapp`.`student` (`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (DEFAULT, 'AM1C', 'Pieterdina ', '', 'Boonzaaijer');
INSERT INTO `progressionapp`.`student` (`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (DEFAULT, 'AM1D', 'Pip ', '', 'Creemers');
INSERT INTO `progressionapp`.`student` (`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (DEFAULT, 'AM1D', 'Cherryl ', '', 'Pels');
INSERT INTO `progressionapp`.`student` (`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (DEFAULT, 'AM1D', 'Sheryl ', '', 'Touissaint');
INSERT INTO `progressionapp`.`student` (`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (DEFAULT, 'AM1D', 'Teis', 'van der', 'Wel');
INSERT INTO `progressionapp`.`student` (`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (DEFAULT, 'AM1D', 'Kenn', '', 'Perquin');

COMMIT;


-- -----------------------------------------------------
-- Data for table `progressionapp`.`periode`
-- -----------------------------------------------------
START TRANSACTION;
USE `progressionapp`;
INSERT INTO `progressionapp`.`periode` (`periode`, `semester`) VALUES ('P1', 'S1');
INSERT INTO `progressionapp`.`periode` (`periode`, `semester`) VALUES ('P2', 'S1');
INSERT INTO `progressionapp`.`periode` (`periode`, `semester`) VALUES ('P3', 'S2');
INSERT INTO `progressionapp`.`periode` (`periode`, `semester`) VALUES ('P4', 'S2');
INSERT INTO `progressionapp`.`periode` (`periode`, `semester`) VALUES ('P5', 'S3');
INSERT INTO `progressionapp`.`periode` (`periode`, `semester`) VALUES ('P6', 'S3');
INSERT INTO `progressionapp`.`periode` (`periode`, `semester`) VALUES ('P7', 'S4');
INSERT INTO `progressionapp`.`periode` (`periode`, `semester`) VALUES ('P8', 'S4');
INSERT INTO `progressionapp`.`periode` (`periode`, `semester`) VALUES ('P9', 'S5');
INSERT INTO `progressionapp`.`periode` (`periode`, `semester`) VALUES ('P10', 'S5');
INSERT INTO `progressionapp`.`periode` (`periode`, `semester`) VALUES ('P11', 'S6');
INSERT INTO `progressionapp`.`periode` (`periode`, `semester`) VALUES ('P12', 'S6');

COMMIT;


-- -----------------------------------------------------
-- Data for table `progressionapp`.`class_course`
-- -----------------------------------------------------
START TRANSACTION;
USE `progressionapp`;
INSERT INTO `progressionapp`.`class_course` (`lessons`, `class_name`, `periode`) VALUES ('WEB', 'AM2A', 'P1');
INSERT INTO `progressionapp`.`class_course` (`lessons`, `class_name`, `periode`) VALUES ('ENG', 'AM1C', 'P5');
INSERT INTO `progressionapp`.`class_course` (`lessons`, `class_name`, `periode`) VALUES ('NED', 'AM2B', 'P3');
INSERT INTO `progressionapp`.`class_course` (`lessons`, `class_name`, `periode`) VALUES ('BUR', 'AM1D', 'P7');
INSERT INTO `progressionapp`.`class_course` (`lessons`, `class_name`, `periode`) VALUES ('ASP', 'AM1D', 'P9');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
