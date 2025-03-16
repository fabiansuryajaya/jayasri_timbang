/*
SQLyog Ultimate v10.3 
MySQL - 5.5.5-10.4.27-MariaDB : Database - jayasri_new
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`jayasri_new` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `jayasri_new`;

/*Table structure for table `conf_sistem` */

DROP TABLE IF EXISTS `conf_sistem`;

CREATE TABLE `conf_sistem` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `desc` varchar(20) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `jenis` int(1) DEFAULT NULL COMMENT '1 profile, 2 sistem',
  `gambar` int(1) DEFAULT NULL COMMENT '1 = YA',
  `notes` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `conf_sistem` */

insert  into `conf_sistem`(`id`,`desc`,`content`,`jenis`,`gambar`,`notes`) values (1,'Judul','PT. JAYASRI AGRO NIAGA',2,NULL,NULL),(2,'Sub Judul','BALUNG',2,NULL,NULL),(5,'logo','Jayasri_Besar.png',2,1,NULL),(6,'Singkatan ','JYSR',2,NULL,NULL),(15,'gambar_login','261121-081750-1168794085.jpg',2,1,NULL),(17,'cctv1','http://192.168.8.52/ISAPI/Streaming/channels/1/httppreview',1,NULL,'admin:Admi#888'),(18,'cctv2','http://192.168.8.53/ISAPI/Streaming/channels/1/httppreview',1,NULL,'admin:Admi#888'),(19,'cam1','http://192.168.8.52/ISAPI/Streaming/channels/1/picture',1,NULL,'admin:Admi#888'),(20,'cam2','http://192.168.8.53/ISAPI/Streaming/channels/1/picture',1,NULL,'admin:Admi#888'),(21,'cctv3','http://192.168.8.51/Streaming/channels/1/httppreview',1,NULL,'admin:Admi#888'),(22,'cctv4','http://192.168.8.54/Streaming/channels/1/httppreview',1,NULL,'admin:Admi#888'),(23,'cam3','http://192.168.8.51/ISAPI/Streaming/channels/1/picture',1,NULL,'admin:Admi#888'),(24,'cam4','http://192.168.8.54/ISAPI/Streaming/channels/1/picture',1,NULL,'admin:Admi#888'),(25,'favicon','icon.png',2,1,NULL),(26,'Gudang','JAYASRI BALUNG',1,NULL,NULL),(27,'Nopol OCR 1','Yes',1,NULL,NULL),(29,'Indikator OCR 1','Yes',1,NULL,NULL),(30,'Indikator OCR 2','Yes',1,NULL,NULL),(31,'Timbang Port 1','Yes',1,NULL,NULL),(32,'Timbang Port 2','No',1,NULL,NULL),(33,'License','f7607b17dc0c1a0fbee28add01ed89ce4419e2f88002e9a91ded679cc25b301a',1,NULL,NULL),(34,'Baudrate','9600',1,NULL,NULL),(35,'Hide Display Konfig','Yes',1,NULL,NULL);

/*Table structure for table `master_produk` */

DROP TABLE IF EXISTS `master_produk`;

CREATE TABLE `master_produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(100) DEFAULT NULL,
  `satuan` varchar(10) DEFAULT NULL,
  `harga_pokok` varchar(15) DEFAULT NULL,
  `harga_jual` varchar(15) DEFAULT NULL,
  `rowstatus` int(1) DEFAULT NULL COMMENT '0 nonaktif / 1 aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `master_produk` */

insert  into `master_produk`(`id`,`nama_produk`,`satuan`,`harga_pokok`,`harga_jual`,`rowstatus`) values (6,'Jagung','Kg','0','0',1);

/*Table structure for table `tb_cctv` */

DROP TABLE IF EXISTS `tb_cctv`;

CREATE TABLE `tb_cctv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tiket` varchar(30) DEFAULT NULL,
  `cam` varchar(10) DEFAULT NULL,
  `gambar` longblob DEFAULT NULL,
  `capture` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_cctv` */

/*Table structure for table `tb_customer` */

DROP TABLE IF EXISTS `tb_customer`;

CREATE TABLE `tb_customer` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nama_customer` varchar(70) DEFAULT NULL,
  `nomor_telp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `rowstatus` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_customer` */

/*Table structure for table `tb_kendaraan` */

DROP TABLE IF EXISTS `tb_kendaraan`;

CREATE TABLE `tb_kendaraan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_kendaraan` varchar(20) DEFAULT NULL,
  `nopol` varchar(15) DEFAULT NULL,
  `rowstatus` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_kendaraan` */

/*Table structure for table `tb_sopir` */

DROP TABLE IF EXISTS `tb_sopir`;

CREATE TABLE `tb_sopir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ktp` varchar(20) DEFAULT NULL,
  `nama_sopir` varchar(50) DEFAULT NULL,
  `rowstatus` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_sopir` */

insert  into `tb_sopir`(`id`,`ktp`,`nama_sopir`,`rowstatus`) values (1,'123','Dodi',1),(2,'456','Widodo',1),(3,'','',0),(4,'12334','sdfsd',0),(5,'19230','Jumroni',0),(6,'12354','Jajang',0),(7,'21232165','Mulus Rahayu',0),(8,'123','aaa',0),(9,'33232323','Suhanda',0),(10,'322','Mang Edo',0),(11,'12345678','Darso',0),(12,'520852','Maman',0),(13,'988','Jaja',0);

/*Table structure for table `tb_tujuan` */

DROP TABLE IF EXISTS `tb_tujuan`;

CREATE TABLE `tb_tujuan` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `tujuan` varchar(100) DEFAULT NULL,
  `rowstatus` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_tujuan` */

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(20) DEFAULT NULL,
  `jabatan` varchar(20) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `level` enum('Admin','Pegawas','Operator') DEFAULT NULL,
  `aktif` int(1) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_user` */

insert  into `tb_user`(`id`,`nama_user`,`jabatan`,`username`,`password`,`level`,`aktif`,`last_login`) values (1,'Aldy','Operator','aldy','b5e75be03ff409a','Admin',1,'2025-03-08 14:58:25'),(27,'BALUNG','OPERATOR','OPERATOR','7110eda4d09e062','Operator',1,NULL),(28,'ADMIN','ADMIN','ADMIN','6fd599b68b363c0','Admin',1,NULL);

/*Table structure for table `tb_weighing_scale` */

DROP TABLE IF EXISTS `tb_weighing_scale`;

CREATE TABLE `tb_weighing_scale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produk` int(11) DEFAULT NULL,
  `mode_timbang` varchar(15) DEFAULT NULL,
  `tiket` varchar(11) NOT NULL COMMENT 'Update : 10 > 30',
  `gudang` varchar(50) DEFAULT NULL,
  `kendaraan` varchar(11) DEFAULT NULL,
  `kendaraan2` varchar(11) DEFAULT NULL,
  `plate_recognize` varchar(20) DEFAULT NULL,
  `plate_recognize2` varchar(20) DEFAULT NULL,
  `pengemudi` varchar(20) DEFAULT NULL,
  `tgl_masuk` datetime DEFAULT NULL,
  `tgl_keluar` datetime DEFAULT NULL,
  `asal` varchar(100) DEFAULT NULL,
  `tujuan` varchar(100) DEFAULT NULL,
  `material` varchar(30) DEFAULT NULL,
  `timbang1` varchar(15) DEFAULT NULL,
  `timbang2` varchar(15) DEFAULT NULL,
  `ocrTimbang1` varchar(20) DEFAULT NULL,
  `ocrTimbang2` varchar(20) DEFAULT NULL,
  `catatan` varchar(100) DEFAULT NULL,
  `harga_pokok` int(15) DEFAULT NULL,
  `harga_jual` int(15) DEFAULT NULL,
  `hpp_total` int(20) DEFAULT NULL,
  `harga_total` int(30) DEFAULT NULL,
  `createdby` varchar(20) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `rowstatus` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`,`tiket`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tb_weighing_scale` */

insert  into `tb_weighing_scale`(`id`,`id_produk`,`mode_timbang`,`tiket`,`gudang`,`kendaraan`,`kendaraan2`,`plate_recognize`,`plate_recognize2`,`pengemudi`,`tgl_masuk`,`tgl_keluar`,`asal`,`tujuan`,`material`,`timbang1`,`timbang2`,`ocrTimbang1`,`ocrTimbang2`,`catatan`,`harga_pokok`,`harga_jual`,`hpp_total`,`harga_total`,`createdby`,`createdon`,`rowstatus`) values (42,6,'Pengiriman','TKT-01-1','Gudang 2','',NULL,'123',NULL,'HADI','0000-00-00 00:00:00',NULL,'','','Jagung','',NULL,'123',NULL,'',0,0,NULL,NULL,'Aldy','2025-01-01 11:29:14',1),(43,6,'Pengiriman','TKT-01-2','Gudang 2','',NULL,'P 9912 AB',NULL,'ababil','2025-03-08 10:17:56','2025-03-08 12:54:28','','pt abc','Jagung','003220','1710','TidakTerdeteksi','Tidak Terdeteksi','',0,0,0,0,'Aldy','2025-03-08 10:19:32',1),(44,6,'Pengiriman','TKT-01-3','Gudang 2','',NULL,'P 9849 UE',NULL,'ababil','2025-03-08 11:04:51',NULL,'','ABC','Jagung','003320',NULL,'TidakTerdeteksi',NULL,'',0,0,NULL,NULL,'Aldy','2025-03-08 11:05:47',1),(45,6,'Pengiriman','TKT-01-4','Gudang 2','',NULL,'P 9849 UE',NULL,'ababil 2','2025-03-08 11:14:47','2025-03-08 12:27:48','','123','Jagung','003310','3340','TidakTerdeteksi','Tidak Terdeteks','',0,0,0,0,'Aldy','2025-03-08 11:14:58',1),(46,6,'Pengiriman','TKT-01-5','Gudang 2','','P 9336 GA','P 9336 GA','P 9336 GA','HADI','2025-03-08 12:56:53','2025-03-08 13:04:09','','Bulog','Jagung','3250','3250','TidakTerdeteksi','Tidak Terdeteksi','',0,0,0,0,'Aldy','2025-03-08 12:56:58',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
