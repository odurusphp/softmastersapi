/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.7.21-log : Database - umid
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`umid` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `umid`;

/*Table structure for table `smslog` */

DROP TABLE IF EXISTS `smslog`;

CREATE TABLE `smslog` (
  `smid` int(11) NOT NULL AUTO_INCREMENT,
  `applicantid` varchar(90) DEFAULT NULL,
  `code` varchar(90) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`smid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `smslog` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
