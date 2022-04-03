-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.5.8-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for hoteldb
CREATE DATABASE IF NOT EXISTS `hoteldb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `hoteldb`;

-- Dumping structure for table hoteldb.booking
CREATE TABLE IF NOT EXISTS `booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bk_rm_id` (`room_id`),
  CONSTRAINT `bk_rm_id` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table hoteldb.booking: ~5 rows (approximately)
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
INSERT INTO `booking` (`id`, `room_id`, `check_in`, `check_out`) VALUES
	(4, 1, '2022-03-23', '2022-03-24'),
	(5, 8, '2022-03-25', '2022-03-27'),
	(6, 5, '2022-03-27', '2022-03-28'),
	(7, 10, '2022-03-25', '2022-03-29'),
	(8, 3, '2022-03-23', '2022-03-30');
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;

-- Dumping structure for table hoteldb.hotel
CREATE TABLE IF NOT EXISTS `hotel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total_rooms` int(11) NOT NULL DEFAULT 0,
  `vacant_rooms` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table hoteldb.hotel: ~0 rows (approximately)
/*!40000 ALTER TABLE `hotel` DISABLE KEYS */;
INSERT INTO `hotel` (`id`, `total_rooms`, `vacant_rooms`) VALUES
	(1, 10, 5);
/*!40000 ALTER TABLE `hotel` ENABLE KEYS */;

-- Dumping structure for table hoteldb.room
CREATE TABLE IF NOT EXISTS `room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_id` int(11) NOT NULL,
  `type` enum('double','triple') NOT NULL DEFAULT 'double',
  PRIMARY KEY (`id`),
  KEY `FK__hotel` (`hotel_id`),
  CONSTRAINT `FK__hotel` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Dumping data for table hoteldb.room: ~10 rows (approximately)
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` (`id`, `hotel_id`, `type`) VALUES
	(1, 1, 'double'),
	(2, 1, 'double'),
	(3, 1, 'double'),
	(4, 1, 'double'),
	(5, 1, 'double'),
	(6, 1, 'double'),
	(7, 1, 'double'),
	(8, 1, 'triple'),
	(9, 1, 'triple'),
	(10, 1, 'triple');
/*!40000 ALTER TABLE `room` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
