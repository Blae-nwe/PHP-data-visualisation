-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2022 at 03:53 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `police tactic use`
--

CREATE TABLE `data` (
  `typeOfForce` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `tactic` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `total` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `police tactic use`
--

INSERT INTO `data` (`typeOfForce`, `tactic`, `total`) VALUES
('Restraint', 'Total Restraint', 285562),
('Restraint', 'Handcuffing, of which', 218810),
('Restraint', 'Compliant handcuffing', 106615),
('Restraint', 'Non-compliant handcuffing', 77763),
('Restraint', 'Not stated', 34432),
('Restraint', 'Limb / Body restraints', 21646),
('Restraint', 'Ground restraint', 45106),
('Unarmed skills', 'Total Unarmed skills', 109655),
('Other equipment', 'Total Other equipment', 22217),
('Other equipment', 'Baton, of which', 5026),
('Other equipment', 'Baton drawn', 2756),
('Other equipment', 'Baton used', 1377),
('Other equipment', 'Not stated', 893),
('Other equipment', 'Irritant spray, of which', 13723),
('Other equipment', 'Irritant spray - drawn', 4705),
('Other equipment', 'Irritant spray - used', 5635),
('Other equipment', 'Not stated', 3383),
('Other equipment', 'Spit and bite guard', 2641),
('Other equipment', 'Shield', 827),
('Less lethal weapons', 'Total Less lethal weapons', 17616),
('Less lethal weapons', 'CED, of which', 17084),
('Less lethal weapons', 'Drawn', 4340),
('Less lethal weapons', 'Aimed', 1549),
('Less lethal weapons', 'Red-dot', 8530),
('Less lethal weapons', 'Arced', 133),
('Less lethal weapons', 'Drive-stun', 62),
('Less lethal weapons', 'Fired', 1872),
('Less lethal weapons', 'Angle-drive stun', 70),
('Less lethal weapons', 'Not stated', 528),
('Less lethal weapons', 'AEP, of which', 532),
('Less lethal weapons', 'AEP aimed', 272),
('Less lethal weapons', 'AEP fired', 36),
('Less lethal weapons', 'Not stated', 224),
('Firearms', 'Total Firearms', 3145),
('Other', 'Total Other', 30680),
('Other', 'Dog use, of which', 1920),
('Other', 'Dog deployed', 1238),
('Other', 'Dog bite', 414),
('Other', 'Not stated', 268),
('Other', 'Other / improvised', 28760),
('Not reported', 'Total Not reported', 7042),
('', '', 0),
('', 'Tactical communication (with other tactic)', 164922),
('', '', 0),
('Total number of incidents', '', 313137);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
