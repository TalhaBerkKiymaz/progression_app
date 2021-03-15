-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema progressionapp
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema progressionapp
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `progressionapp` DEFAULT CHARACTER SET latin1 ;
USE `progressionapp` ;

-- -----------------------------------------------------
-- Table `progressionapp`.`course`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `progressionapp`.`course` ;

CREATE TABLE IF NOT EXISTS `progressionapp`.`course` (
  `lessons` VARCHAR(5) NOT NULL,
  `course_name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`lessons`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `progressionapp`.`assigments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `progressionapp`.`assigments` ;

CREATE TABLE IF NOT EXISTS `progressionapp`.`assigments` (
  `id` DECIMAL(3,1) NOT NULL,
  `lessons` VARCHAR(5) NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  `ddline_date` DATE NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_assigments_lessons`
    FOREIGN KEY (`lessons`)
    REFERENCES `progressionapp`.`course` (`lessons`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE INDEX `fk_assigments_lessons_idx` ON `progressionapp`.`assigments` (`lessons` ASC);


-- -----------------------------------------------------
-- Table `progressionapp`.`class`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `progressionapp`.`class` ;

CREATE TABLE IF NOT EXISTS `progressionapp`.`class` (
  `class_name` VARCHAR(45) NOT NULL,
  `education` VARCHAR(45) NOT NULL,
  `cohort` VARCHAR(5) NOT NULL,
  PRIMARY KEY (`class_name`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `progressionapp`.`periode`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `progressionapp`.`periode` ;

CREATE TABLE IF NOT EXISTS `progressionapp`.`periode` (
  `periode` VARCHAR(5) NOT NULL,
  `semester` VARCHAR(5) NOT NULL,
  PRIMARY KEY (`periode`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `progressionapp`.`class_course`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `progressionapp`.`class_course` ;

CREATE TABLE IF NOT EXISTS `progressionapp`.`class_course` (
  `lessons` VARCHAR(5) NOT NULL,
  `class_name` VARCHAR(45) NOT NULL,
  `periode` VARCHAR(5) NOT NULL,
  CONSTRAINT `fk_classes_courses_class_name`
    FOREIGN KEY (`class_name`)
    REFERENCES `progressionapp`.`class` (`class_name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_classes_courses_lessons`
    FOREIGN KEY (`lessons`)
    REFERENCES `progressionapp`.`course` (`lessons`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_classes_courses_periode`
    FOREIGN KEY (`periode`)
    REFERENCES `progressionapp`.`periode` (`periode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE INDEX `fk_classes_courses_lessons_idx` ON `progressionapp`.`class_course` (`lessons` ASC);

CREATE INDEX `fk_classes_courses_class_name_idx` ON `progressionapp`.`class_course` (`class_name` ASC);

CREATE INDEX `fk_classes_courses_periode_idx` ON `progressionapp`.`class_course` (`periode` ASC);


-- -----------------------------------------------------
-- Table `progressionapp`.`planning`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `progressionapp`.`planning` ;

CREATE TABLE IF NOT EXISTS `progressionapp`.`planning` (
  `id` INT(10) UNSIGNED NOT NULL,
  `assigment_id` DECIMAL(3,1) NOT NULL,
  `wknr_school` TINYINT(3) UNSIGNED NOT NULL,
  `wknr_kalender` TINYINT(3) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_planning_assigment_id`
    FOREIGN KEY (`assigment_id`)
    REFERENCES `progressionapp`.`assigments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE INDEX `fk_planning_assigment_id_idx` ON `progressionapp`.`planning` (`assigment_id` ASC);


-- -----------------------------------------------------
-- Table `progressionapp`.`register`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `progressionapp`.`register` ;

CREATE TABLE IF NOT EXISTS `progressionapp`.`register` (
  `user_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `userrole` ENUM('admin', 'director', 'teachers', 'student') NOT NULL,
  `activated` BIT(1) NOT NULL,
  PRIMARY KEY (`user_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `progressionapp`.`students`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `progressionapp`.`students` ;

CREATE TABLE IF NOT EXISTS `progressionapp`.`students` (
  `register_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `student_id` INT(6) NOT NULL AUTO_INCREMENT,
  `class_name` VARCHAR(45) NOT NULL,
  `firstname` VARCHAR(45) NOT NULL,
  `infix` VARCHAR(10) NOT NULL,
  `lastname` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`student_id`),
  CONSTRAINT `FK_students_PK_register`
    FOREIGN KEY (`register_id`)
    REFERENCES `progressionapp`.`register` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_students_class_name`
    FOREIGN KEY (`class_name`)
    REFERENCES `progressionapp`.`class` (`class_name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 20
DEFAULT CHARACTER SET = latin1;

CREATE INDEX `fk_students_class_name_idx` ON `progressionapp`.`students` (`class_name` ASC);

CREATE INDEX `FK_students_PK_register` ON `progressionapp`.`students` (`register_id` ASC);


-- -----------------------------------------------------
-- Table `progressionapp`.`teachers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `progressionapp`.`teachers` ;

CREATE TABLE IF NOT EXISTS `progressionapp`.`teachers` (
  `register_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `id` VARCHAR(4) NOT NULL,
  `firstname` VARCHAR(200) NOT NULL,
  `infix` VARCHAR(50) NOT NULL,
  `lastname` VARCHAR(300) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_teachers_PK_register`
    FOREIGN KEY (`register_id`)
    REFERENCES `progressionapp`.`register` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE INDEX `FK_teachers_PK_register` ON `progressionapp`.`teachers` (`register_id` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


-- -----------------------------------------------------
-- Data for table `progressionapp`.`class`
-- -----------------------------------------------------
START TRANSACTION;
USE `progressionapp`;
INSERT INTO `progressionapp`.`class` (`class_name`, `education`, `cohort`) VALUES ('AM2A', 'AM', 'C2020');
INSERT INTO `progressionapp`.`class` (`class_name`, `education`, `cohort`) VALUES ('AM2B', 'AM', 'C2020');
INSERT INTO `progressionapp`.`class` (`class_name`, `education`, `cohort`) VALUES ('AM1C', 'AM', 'C2020');
INSERT INTO `progressionapp`.`class` (`class_name`, `education`, `cohort`) VALUES ('AM1D', 'AM', 'C2020');

COMMIT;


-- -----------------------------------------------------
-- Data for table `progressionapp`.`course`
-- -----------------------------------------------------
START TRANSACTION;
USE `progressionapp`;
INSERT INTO `progressionapp`.`course` (`lessons`, `course_name`, `description`) VALUES ('WEB', 'PHP & CRUD', 'Hier leer je PHP');
INSERT INTO `progressionapp`.`course` (`lessons`, `course_name`, `description`) VALUES ('NED', 'Grammatica', 'Structureel zinnen maken. Het gebruik van tijden');
INSERT INTO `progressionapp`.`course` (`lessons`, `course_name`, `description`) VALUES ('ENG', 'Tenses', 'Hier leer je tijden');
INSERT INTO `progressionapp`.`course` (`lessons`, `course_name`, `description`) VALUES ('BUR', 'Burgerschap', 'Hier leer je je mening te geven');
INSERT INTO `progressionapp`.`course` (`lessons`, `course_name`, `description`) VALUES ('ASP', 'C# Essentials', 'Dit is een basiscursus van ASP.NET');

COMMIT;


-- -----------------------------------------------------
-- Data for table `progressionapp`.`students`
-- -----------------------------------------------------
START TRANSACTION;
USE `progressionapp`;

INSERT INTO `progressionapp`.`students` (`register_id`,`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (NULL, '329188', 'AM2A', 'Ahmet', '', 'Erdogan');
INSERT INTO `progressionapp`.`students` (`register_id`,`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (NULL, '568741', 'AM2A', 'Arjan', 'de', 'Ruijter');
INSERT INTO `progressionapp`.`students` (`register_id`,`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (NULL, '878787','AM2A', 'Hans', '', 'Odijk');
INSERT INTO `progressionapp`.`students` (`register_id`,`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (NULL, '415131','AM2A', 'Cuneyt', '', 'Sterk');
INSERT INTO `progressionapp`.`students` (`register_id`,`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (NULL, '986542','AM2B', 'Nalinie', '', 'Zwemmer');
INSERT INTO `progressionapp`.`students` (`register_id`,`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (NULL, '456123','AM2B', 'Yaron', 'van den', 'Nieuwenhuijzen');
INSERT INTO `progressionapp`.`students` (`register_id`,`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (NULL, '753951','AM2B', 'Ghizlan', 'van der', 'Zon');
INSERT INTO `progressionapp`.`students` (`register_id`,`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (NULL, '746321','AM2B', 'Tarik', '', 'Comolokko');
INSERT INTO `progressionapp`.`students` (`register_id`,`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (NULL, '784523','AM2B', 'Talha', '', 'Kiymaz');
INSERT INTO `progressionapp`.`students` (`register_id`,`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (NULL, '325485','AM1C', 'Orpheo ', '', 'Woortman');
INSERT INTO `progressionapp`.`students` (`register_id`,`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (NULL, '785429','AM1C', 'Julienne ', '', 'Sneekes');
INSERT INTO `progressionapp`.`students` (`register_id`,`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (NULL, '154892','AM1C', 'Berry', '', 'Schermer');
INSERT INTO `progressionapp`.`students` (`register_id`,`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (NULL, '254769','AM1C', 'Kristin ', '', 'Passchier');
INSERT INTO `progressionapp`.`students` (`register_id`,`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (NULL, '781594','AM1C', 'Pieterdina ', '', 'Boonzaaijer');
INSERT INTO `progressionapp`.`students` (`register_id`,`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (NULL, '987532','AM1D', 'Pip ', '', 'Creemers');
INSERT INTO `progressionapp`.`students` (`register_id`,`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (NULL, '158756','AM1D', 'Cherryl ', '', 'Pels');
INSERT INTO `progressionapp`.`students` (`register_id`,`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (NULL, '123489','AM1D', 'Sheryl ', '', 'Touissaint');
INSERT INTO `progressionapp`.`students` (`register_id`,`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (NULL, '178549','AM1D', 'Teis', 'van der', 'Wel');
INSERT INTO `progressionapp`.`students` (`register_id`,`student_id`, `class_name`, `firstname`, `infix`, `lastname`) VALUES (NULL, '987562','AM1D', 'Kenn', '', 'Perquin');

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
INSERT INTO `progressionapp`.`class_course` (`lessons`, `class_name`, `periode`) VALUES ('ENG', 'AM2A', 'P1');
INSERT INTO `progressionapp`.`class_course` (`lessons`, `class_name`, `periode`) VALUES ('NED', 'AM2A', 'P1');
INSERT INTO `progressionapp`.`class_course` (`lessons`, `class_name`, `periode`) VALUES ('BUR', 'AM2A', 'P1');
INSERT INTO `progressionapp`.`class_course` (`lessons`, `class_name`, `periode`) VALUES ('ASP', 'AM2A', 'P1');
INSERT INTO `progressionapp`.`class_course` (`lessons`, `class_name`, `periode`) VALUES ('WEB', 'AM1C', 'P5');
INSERT INTO `progressionapp`.`class_course` (`lessons`, `class_name`, `periode`) VALUES ('ENG', 'AM1C', 'P5');
INSERT INTO `progressionapp`.`class_course` (`lessons`, `class_name`, `periode`) VALUES ('NED', 'AM1C', 'P5');
INSERT INTO `progressionapp`.`class_course` (`lessons`, `class_name`, `periode`) VALUES ('BUR', 'AM1C', 'P5');
INSERT INTO `progressionapp`.`class_course` (`lessons`, `class_name`, `periode`) VALUES ('ASP', 'AM1C', 'P5');
INSERT INTO `progressionapp`.`class_course` (`lessons`, `class_name`, `periode`) VALUES ('WEB', 'AM2B', 'P3');
INSERT INTO `progressionapp`.`class_course` (`lessons`, `class_name`, `periode`) VALUES ('ENG', 'AM2B', 'P3');
INSERT INTO `progressionapp`.`class_course` (`lessons`, `class_name`, `periode`) VALUES ('NED', 'AM2B', 'P3');
INSERT INTO `progressionapp`.`class_course` (`lessons`, `class_name`, `periode`) VALUES ('BUR', 'AM2B', 'P3');
INSERT INTO `progressionapp`.`class_course` (`lessons`, `class_name`, `periode`) VALUES ('ASP', 'AM2B', 'P3');
INSERT INTO `progressionapp`.`class_course` (`lessons`, `class_name`, `periode`) VALUES ('WEB', 'AM1D', 'P7');
INSERT INTO `progressionapp`.`class_course` (`lessons`, `class_name`, `periode`) VALUES ('ENG', 'AM1D', 'P7');
INSERT INTO `progressionapp`.`class_course` (`lessons`, `class_name`, `periode`) VALUES ('NED', 'AM1D', 'P7');
INSERT INTO `progressionapp`.`class_course` (`lessons`, `class_name`, `periode`) VALUES ('BUR', 'AM1D', 'P7');
INSERT INTO `progressionapp`.`class_course` (`lessons`, `class_name`, `periode`) VALUES ('ASP', 'AM1D', 'P9');

COMMIT;

-- -----------------------------------------------------
-- Data for table `progressionapp`.`teachers`
-- -----------------------------------------------------

INSERT INTO `teachers` (`register_id`, `id`, `firstname`, `infix`, `lastname`) VALUES (NULL, 'rra', 'Arjan', 'de', 'Ruijter');
INSERT INTO `teachers` (`register_id`, `id`, `firstname`, `infix`, `lastname`) VALUES (NULL, 'avt', 'Annouk', 'van', 'Tol');
INSERT INTO `teachers` (`register_id`, `id`, `firstname`, `infix`, `lastname`) VALUES (NULL, 'hsok', 'Hans', '', 'Odijk');
INSERT INTO `teachers` (`register_id`, `id`, `firstname`, `infix`, `lastname`) VALUES (NULL, 'srah', 'Srarah', '', 'Said');
INSERT INTO `teachers` (`register_id`, `id`, `firstname`, `infix`, `lastname`) VALUES (NULL, 'jsmx', 'Jesse', '', 'Malotaux');

COMMIT;
