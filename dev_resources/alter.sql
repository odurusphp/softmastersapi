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
USE `umid`;

/*Table structure for table `company` */

DROP TABLE IF EXISTS `company`;

CREATE TABLE `company` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `company` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `company` */

/*Table structure for table `fundingsource_bank` */

DROP TABLE IF EXISTS `fundingsource_bank`;

CREATE TABLE `fundingsource_bank` (
  `fdkid` int(11) NOT NULL AUTO_INCREMENT,
  `bankname` varchar(90) DEFAULT NULL,
  `branch` varchar(90) DEFAULT NULL,
  `accountnumber` varchar(90) DEFAULT NULL,
  `account_type` varchar(90) DEFAULT NULL,
  `userid` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`fdkid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `fundingsource_bank` */

/*Table structure for table `fundingsource_card` */

DROP TABLE IF EXISTS `fundingsource_card`;

CREATE TABLE `fundingsource_card` (
  `fcid` int(11) NOT NULL AUTO_INCREMENT,
  `cardname` varchar(90) DEFAULT NULL,
  `cardtype` varchar(90) DEFAULT NULL,
  `expirydate` date DEFAULT NULL,
  `cvv` varchar(90) DEFAULT NULL,
  `cardnumber` varchar(90) DEFAULT NULL,
  `userid` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`fcid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `fundingsource_card` */

/*Table structure for table `fundingsource_mobilemoney` */

DROP TABLE IF EXISTS `fundingsource_mobilemoney`;

CREATE TABLE `fundingsource_mobilemoney` (
  `fmid` int(11) NOT NULL AUTO_INCREMENT,
  `network` varchar(90) DEFAULT NULL,
  `mobilenumber` varchar(90) DEFAULT NULL,
  `userid` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`fmid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `fundingsource_mobilemoney` */

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product` varchar(90) DEFAULT NULL,
  `userid` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `products` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
