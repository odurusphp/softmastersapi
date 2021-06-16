/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.7.26-log : Database - pic
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `voters` */

DROP TABLE IF EXISTS `voters`;

CREATE TABLE `voters` (
  `vid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(90) DEFAULT NULL,
  `age` varchar(90) DEFAULT NULL,
  `votersid` varchar(90) DEFAULT NULL,
  `sex` varchar(90) DEFAULT NULL,
  `region` varchar(90) DEFAULT NULL,
  `constituency` varchar(90) DEFAULT NULL,
  `pollingstation` varchar(90) DEFAULT NULL,
  `pollingcode` varchar(90) DEFAULT NULL,
  `vkey` int(11) DEFAULT NULL,
  PRIMARY KEY (`vid`)
) ENGINE=InnoDB AUTO_INCREMENT=8001 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
