-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.12-0ubuntu1.1 - (Ubuntu)
-- Server OS:                    Linux
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for report_mammoth
CREATE DATABASE IF NOT EXISTS `report_mammoth` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `report_mammoth`;

-- Dumping structure for table report_mammoth.access_level
CREATE TABLE IF NOT EXISTS `access_level` (
  `accessid` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY (`accessid`,`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table report_mammoth.access_level: ~0 rows (approximately)
/*!40000 ALTER TABLE `access_level` DISABLE KEYS */;
/*!40000 ALTER TABLE `access_level` ENABLE KEYS */;

-- Dumping structure for table report_mammoth.department
CREATE TABLE IF NOT EXISTS `department` (
  `deptid` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY (`deptid`,`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table report_mammoth.department: ~0 rows (approximately)
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
/*!40000 ALTER TABLE `department` ENABLE KEYS */;

-- Dumping structure for table report_mammoth.messaging
CREATE TABLE IF NOT EXISTS `messaging` (
  `messid` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`messid`,`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table report_mammoth.messaging: ~0 rows (approximately)
/*!40000 ALTER TABLE `messaging` DISABLE KEYS */;
/*!40000 ALTER TABLE `messaging` ENABLE KEYS */;

-- Dumping structure for table report_mammoth.reports
CREATE TABLE IF NOT EXISTS `reports` (
  `repid` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) NOT NULL,
  `title` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `userid` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`repid`,`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table report_mammoth.reports: ~0 rows (approximately)
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;

-- Dumping structure for table report_mammoth.report_content
CREATE TABLE IF NOT EXISTS `report_content` (
  `rcid` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) NOT NULL,
  `repid` int(11) DEFAULT NULL,
  `content` text,
  `userid` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL COMMENT 'approved, ongoing, declined, pending',
  PRIMARY KEY (`rcid`,`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table report_mammoth.report_content: ~0 rows (approximately)
/*!40000 ALTER TABLE `report_content` DISABLE KEYS */;
/*!40000 ALTER TABLE `report_content` ENABLE KEYS */;

-- Dumping structure for table report_mammoth.users
CREATE TABLE IF NOT EXISTS `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) NOT NULL,
  `fulname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `access_level` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  PRIMARY KEY (`userid`,`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- View that helps me simply merge the report to the department
CREATE OR REPLACE VIEW `view_reports` AS 
SELECT 
`r`.`repid`, 
`r`.`uuid`, 
`r`.`title`,
`r`.`desc`,
`r`.`userid` AS `created_by`, 
`r`.`status`,
`u`.`fulname`, 
`u`.`email`,
`u`.`dept_id`
FROM `reports` `r` LEFT JOIN `users` `u` ON `r`.`userid` = `u`.`userid`;

-- Dumping data for table report_mammoth.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
