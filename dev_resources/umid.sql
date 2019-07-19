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

/*Table structure for table `apikeys` */

DROP TABLE IF EXISTS `apikeys`;

CREATE TABLE `apikeys` (
  `key_id` int(11) NOT NULL AUTO_INCREMENT,
  `apikey` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`key_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `apikeys` */

insert  into `apikeys`(`key_id`,`apikey`) values (1,'BiSJjJkaWB'),(2,'MKzBvzRPvs');

/*Table structure for table `basicinformation` */

DROP TABLE IF EXISTS `basicinformation`;

CREATE TABLE `basicinformation` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(90) DEFAULT NULL,
  `lastname` varchar(90) DEFAULT NULL,
  `middlename` varchar(90) DEFAULT NULL,
  `othernames` varchar(90) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `dateofbirth` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `telephone` varchar(40) DEFAULT NULL,
  `mobilenumber` varchar(40) DEFAULT NULL,
  `email` varchar(90) DEFAULT NULL,
  `applicantid` varchar(50) DEFAULT NULL,
  `applieddate` date DEFAULT NULL,
  `fullname` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `basicinformation` */

insert  into `basicinformation`(`bid`,`firstname`,`lastname`,`middlename`,`othernames`,`age`,`dateofbirth`,`gender`,`nationality`,`telephone`,`mobilenumber`,`email`,`applicantid`,`applieddate`,`fullname`) values (1,'John','Doe',NULL,'',NULL,'1975-12-07',NULL,NULL,'030030303',NULL,'jdoe@gm.com','{2A7A825D-E083-4981-AD80-EB5433E8F478}','2019-06-20','John Doe '),(2,'John','Doe',NULL,'',NULL,'1975-12-07',NULL,NULL,'030030303',NULL,'jdoe@gmail.com','{5F702F11-E533-499F-85BD-2C917AD8EA57}','2019-06-20','John Doe '),(3,'John','Doe',NULL,'',NULL,'1975-12-07',NULL,NULL,'030030303',NULL,'prince@gmail.com','{54DBFDE0-224C-4EE7-8306-BB7AD72BE35D}','2019-06-20','John Doe '),(4,'John','Doe',NULL,'',NULL,'1975-12-07',NULL,NULL,'030030303',NULL,'nana@gmail.com','{FE082FD5-E966-42B7-97B5-EEA6A02C0350}','2019-06-20','John Doe ');

/*Table structure for table `business` */

DROP TABLE IF EXISTS `business`;

CREATE TABLE `business` (
  `busid` int(11) NOT NULL AUTO_INCREMENT,
  `businessname` varchar(100) DEFAULT NULL,
  `natureofbusiness` varchar(100) DEFAULT NULL,
  `tinnumber` varchar(20) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `email` varchar(90) DEFAULT NULL,
  `applieddate` date DEFAULT NULL,
  `businessuid` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`busid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `business` */

insert  into `business`(`busid`,`businessname`,`natureofbusiness`,`tinnumber`,`telephone`,`email`,`applieddate`,`businessuid`) values (1,'Prince Online',NULL,'C232334223','princeon@gmail.com','princeon@gmail.com','2019-06-21','BUS-{8E6730B9-6DE7-448F-9772-6E563D43D58A}'),(2,'Prince Online 2',NULL,'C232334223','princeon2@gmail.com','princeon2@gmail.com','2019-06-21','BUS-{603FC170-1A2A-411A-9D14-59D1245EC5A9}'),(3,'Prince Online 2',NULL,'C232334223','0265742649','princeon289@gmail.com','2019-06-21','BUS-{F0052FEE-9B77-4E42-B8F8-C3DD55D97CA4}'),(4,'Prince Online 2',NULL,'C232334223','0265742649','princeon32289@gmail.com','2019-06-21','BUS-{3802A230-8969-4236-9AB6-2F882ACD0434}'),(5,'Prince Online 2',NULL,'C232334223','0265742649','princeon322809@gmail.com','2019-06-21','BUS-{D3457953-2EF3-4A3F-AB31-E2F6E6B2A81F}');

/*Table structure for table `frameworkjobs` */

DROP TABLE IF EXISTS `frameworkjobs`;

CREATE TABLE `frameworkjobs` (
  `jobid` int(11) NOT NULL AUTO_INCREMENT,
  `jobname` varchar(45) NOT NULL,
  `jobmethod` varchar(45) NOT NULL,
  `lastrun` timestamp NULL DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `queuewait` tinyint(4) DEFAULT NULL,
  `frequencyminutes` int(11) DEFAULT NULL,
  `numtoprocess` int(11) DEFAULT NULL,
  `batchsize` int(11) DEFAULT NULL,
  `processed` int(11) DEFAULT NULL,
  `lastprocessed` int(11) DEFAULT NULL,
  `lasttimestamp` timestamp NULL DEFAULT NULL,
  `exitmessage` varchar(45) DEFAULT NULL,
  `queuedata` text,
  PRIMARY KEY (`jobid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `frameworkjobs` */

/*Table structure for table `location` */

DROP TABLE IF EXISTS `location`;

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `popularname` varchar(90) DEFAULT NULL,
  `city` varchar(90) DEFAULT NULL,
  `street` varchar(90) DEFAULT NULL,
  `region` varchar(90) DEFAULT NULL,
  `country` varchar(90) DEFAULT NULL,
  `assembly` varchar(90) DEFAULT NULL,
  `unitno` varchar(90) DEFAULT NULL,
  `housenumber` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `location` */

/*Table structure for table `location_business` */

DROP TABLE IF EXISTS `location_business`;

CREATE TABLE `location_business` (
  `location_id` int(11) DEFAULT NULL,
  `busid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `location_business` */

/*Table structure for table `location_individual` */

DROP TABLE IF EXISTS `location_individual`;

CREATE TABLE `location_individual` (
  `location_id` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `location_individual` */

/*Table structure for table `logcategories` */

DROP TABLE IF EXISTS `logcategories`;

CREATE TABLE `logcategories` (
  `logcategory` varchar(32) NOT NULL,
  PRIMARY KEY (`logcategory`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `logcategories` */

insert  into `logcategories`(`logcategory`) values ('administrator action'),('customer action'),('information'),('system - general'),('system - scheduled');

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `roleid` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(24) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`roleid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `roles` */

insert  into `roles`(`roleid`,`role`,`description`) values (1,'Administrator','Administrator'),(2,'Individual','Individual'),(3,'Business','Business');

/*Table structure for table `smslog` */

DROP TABLE IF EXISTS `smslog`;

CREATE TABLE `smslog` (
  `smid` int(11) NOT NULL AUTO_INCREMENT,
  `applicantid` varchar(90) DEFAULT NULL,
  `code` varchar(90) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`smid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `smslog` */

insert  into `smslog`(`smid`,`applicantid`,`code`,`status`,`verified_at`) values (1,'BUS-{8E6730B9-6DE7-448F-9772-6E563D43D58A}','NTlxyRRLlX',0,NULL),(2,'BUS-{603FC170-1A2A-411A-9D14-59D1245EC5A9}','ytFHlGEyAt',0,NULL);

/*Table structure for table `systemlog` */

DROP TABLE IF EXISTS `systemlog`;

CREATE TABLE `systemlog` (
  `idsystemlog` int(11) NOT NULL AUTO_INCREMENT,
  `logcategory` varchar(32) NOT NULL DEFAULT 'information',
  `user` varchar(90) NOT NULL DEFAULT 'unknown - error?',
  `logmessage` varchar(1024) NOT NULL,
  `diagnostic` text,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idsystemlog`),
  KEY `enforce_cats_idx` (`logcategory`),
  CONSTRAINT `enforce_cat` FOREIGN KEY (`logcategory`) REFERENCES `logcategories` (`logcategory`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `systemlog` */

/*Table structure for table `user_basic` */

DROP TABLE IF EXISTS `user_basic`;

CREATE TABLE `user_basic` (
  `userid` int(11) DEFAULT NULL,
  `bid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_basic` */

insert  into `user_basic`(`userid`,`bid`) values (6,1),(7,2),(8,3),(9,4);

/*Table structure for table `user_business` */

DROP TABLE IF EXISTS `user_business`;

CREATE TABLE `user_business` (
  `uid` int(11) DEFAULT NULL,
  `busid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_business` */

insert  into `user_business`(`uid`,`busid`) values (10,1),(11,2),(12,3),(13,4),(14,5);

/*Table structure for table `user_roles` */

DROP TABLE IF EXISTS `user_roles`;

CREATE TABLE `user_roles` (
  `users_uid` int(11) NOT NULL,
  `roles_roleid` int(11) NOT NULL,
  PRIMARY KEY (`users_uid`,`roles_roleid`),
  KEY `fk_user_roles_roles1_idx` (`roles_roleid`),
  CONSTRAINT `fk_user_roles_roles1` FOREIGN KEY (`roles_roleid`) REFERENCES `roles` (`roleid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_roles_users1` FOREIGN KEY (`users_uid`) REFERENCES `users` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_roles` */

insert  into `user_roles`(`users_uid`,`roles_roleid`) values (5,1),(6,2),(7,2),(8,2),(9,2),(10,3),(11,3),(12,3),(13,3),(14,3);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(80) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `firstname` varchar(24) DEFAULT NULL,
  `lastname` varchar(24) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid_UNIQUE` (`uid`),
  UNIQUE KEY `username_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`uid`,`email`,`password`,`firstname`,`lastname`,`status`) values (5,'admin@getinnotized.com','e10adc3949ba59abbe56e057f20f883e','Prince','Odurooppp',0),(6,'jdoe@gm.com','5f4dcc3b5aa765d61d8327deb882cf99','John','Doe',NULL),(7,'jdoe@gmail.com','5f4dcc3b5aa765d61d8327deb882cf99','John','Doe',NULL),(8,'prince@gmail.com','e10adc3949ba59abbe56e057f20f883e','John','Doe',NULL),(9,'nana@gmail.com','5f4dcc3b5aa765d61d8327deb882cf99','John','Doe',NULL),(10,'princeon@gmail.com','e10adc3949ba59abbe56e057f20f883e',NULL,NULL,NULL),(11,'princeon2@gmail.com','e10adc3949ba59abbe56e057f20f883e',NULL,NULL,NULL),(12,'princeon289@gmail.com','e10adc3949ba59abbe56e057f20f883e',NULL,NULL,NULL),(13,'princeon32289@gmail.com','e10adc3949ba59abbe56e057f20f883e',NULL,NULL,NULL),(14,'princeon322809@gmail.com','e10adc3949ba59abbe56e057f20f883e',NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
