/*
SQLyog Ultimate v12.4.1 (64 bit)
MySQL - 10.4.11-MariaDB : Database - spk_tanti
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`spk_tanti` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `spk_tanti`;

/*Table structure for table `auth` */

DROP TABLE IF EXISTS `auth`;

CREATE TABLE `auth` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `token` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `level` enum('Admin','User') DEFAULT 'User',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

/*Data for the table `auth` */

insert  into `auth`(`id_user`,`username`,`password`,`token`,`status`,`level`) values 
(10,'nur.aminnudin@gmail.com','21232f297a57a5a743894a0e4a801fc3',NULL,NULL,'User'),
(12,'aminousgg@gmail.com','aabff2636e4b909ef56bcbbd7c62064a',NULL,NULL,'User'),
(13,'aminousgg@gmail.com','aabff2636e4b909ef56bcbbd7c62064a',NULL,NULL,'User'),
(14,'michelle@gmail.com','aabff2636e4b909ef56bcbbd7c62064a',NULL,NULL,'User'),
(15,'admin@amin.com','aabff2636e4b909ef56bcbbd7c62064a',NULL,NULL,'Admin'),
(16,'syahreza@gmail.com','ee25136ee204aa44362b5444bf6556f8',NULL,NULL,'User');

/*Table structure for table `pelamar` */

DROP TABLE IF EXISTS `pelamar`;

CREATE TABLE `pelamar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `tmp_lahir` varchar(128) DEFAULT NULL,
  `no_hp` varchar(16) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `gender` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `foto` varchar(255) DEFAULT 'default_profile.svg',
  `img_ijasah` varchar(255) DEFAULT NULL,
  `img_ktp` varchar(255) DEFAULT NULL,
  `img_cv` varchar(255) DEFAULT NULL,
  `img_sertif` varchar(255) DEFAULT NULL,
  `nilai` float(10,2) DEFAULT NULL,
  `range_nilai` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pelamar` */

insert  into `pelamar`(`id`,`id_user`,`nama`,`nik`,`tgl_lahir`,`tmp_lahir`,`no_hp`,`alamat`,`gender`,`foto`,`img_ijasah`,`img_ktp`,`img_cv`,`img_sertif`,`nilai`,`range_nilai`) values 
(1,10,'Nur Amin Nudin','3328132209980002','1998-09-22','Tegal','089667203086','Jl. Karya Bakti RT. 01/02 Kec. Dukuhturi','Laki-laki','10_me_persegi.jpg','10_Ijazah.jpg','10_Scan_KTP.pdf','10_mycv.pdf',NULL,3.40,4),
(2,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'default_profile.svg',NULL,NULL,NULL,NULL,NULL,NULL),
(3,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'default_profile.svg',NULL,NULL,NULL,NULL,NULL,NULL),
(6,16,'Syahreza Panca','8174724','2001-02-15','Semarang','0899872181','Jl. Sawung 3','Laki-laki','16_michellearabelle_profilepicture.jpg',NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `pendidikan` */

DROP TABLE IF EXISTS `pendidikan`;

CREATE TABLE `pendidikan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `tingkat` enum('SD','SMP','SMA','S1') DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `jenis_pend` enum('Formal','Non') DEFAULT NULL,
  `bidang` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pendidikan` */

insert  into `pendidikan`(`id`,`id_user`,`tingkat`,`nama`,`tahun`,`jenis_pend`,`bidang`) values 
(1,10,'SD','SDN 1 Dukuhturi',2010,'Formal','-'),
(2,12,NULL,NULL,NULL,NULL,NULL),
(3,14,NULL,NULL,NULL,NULL,NULL),
(7,10,NULL,'Cisco Academy',2015,'Non','IT Essential'),
(8,10,'SMP','MTs. Assalafiyah Kota Tegal',2013,'Formal','-'),
(9,16,'SD','SD 2 Banyumanik',2010,'Formal','-'),
(10,16,'SMP','SMP 12 Smarang',2013,'Formal','-'),
(11,16,'SMA','SMA 3 Semarang',2016,'Formal','-');

/*Table structure for table `riwayat_kerja` */

DROP TABLE IF EXISTS `riwayat_kerja`;

CREATE TABLE `riwayat_kerja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `nama_perusahaan` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `tahun_mulai` year(4) DEFAULT NULL,
  `tahun_selesai` year(4) DEFAULT NULL,
  `gaji` double(12,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `riwayat_kerja` */

insert  into `riwayat_kerja`(`id`,`id_user`,`nama_perusahaan`,`jabatan`,`tahun_mulai`,`tahun_selesai`,`gaji`) values 
(1,10,'PT Rajawali Nusindo','Web Developer Divisi IT',2020,2021,4100000.00),
(2,12,NULL,NULL,NULL,NULL,NULL),
(3,14,NULL,NULL,NULL,NULL,NULL),
(5,16,NULL,NULL,NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
