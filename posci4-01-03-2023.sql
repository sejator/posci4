-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: posci4
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tb_bulan_tahun`
--

DROP TABLE IF EXISTS `tb_bulan_tahun`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_bulan_tahun` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `bulan` varchar(10) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bln_thn` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_bulan_tahun`
--

LOCK TABLES `tb_bulan_tahun` WRITE;
/*!40000 ALTER TABLE `tb_bulan_tahun` DISABLE KEYS */;
INSERT INTO `tb_bulan_tahun` VALUES (1,'Jan',2020,'01-2020'),(2,'Feb',2020,'02-2020'),(3,'Mar',2020,'03-2020'),(4,'Apr',2020,'04-2020'),(5,'Mei',2020,'05-2020'),(6,'Jun',2020,'06-2020'),(7,'Jul',2020,'07-2020'),(8,'Agu',2020,'08-2020'),(9,'Sep',2020,'09-2020'),(10,'Okt',2020,'10-2020'),(11,'Nov',2020,'11-2020'),(12,'Des',2020,'12-2020'),(13,'Jan',2021,'01-2021'),(14,'Feb',2021,'02-2021'),(15,'Mar',2021,'03-2021'),(16,'Apr',2021,'04-2021'),(17,'Mei',2021,'05-2021'),(18,'Jun',2021,'06-2021'),(19,'Jul',2021,'07-2021'),(20,'Agu',2021,'08-2021'),(21,'Sep',2021,'09-2021'),(22,'Okt',2021,'10-2021'),(23,'Nov',2021,'11-2021'),(24,'Des',2021,'12-2021'),(25,'Jan',2022,'01-2022'),(26,'Feb',2022,'02-2022'),(27,'Mar',2022,'03-2022'),(28,'Apr',2022,'04-2022'),(29,'Mei',2022,'05-2022'),(30,'Jun',2022,'06-2022'),(31,'Jul',2022,'07-2022'),(32,'Agu',2022,'08-2022'),(33,'Sep',2022,'09-2022'),(34,'Okt',2022,'10-2022'),(35,'Nov',2022,'11-2022'),(36,'Des',2022,'12-2022'),(37,'Jan',2023,'01-2023'),(38,'Feb',2023,'02-2023'),(39,'Mar',2023,'03-2023'),(40,'Apr',2023,'04-2023'),(41,'Mei',2023,'05-2023'),(42,'Jun',2023,'06-2023'),(43,'Jul',2023,'07-2023'),(44,'Agu',2023,'08-2023'),(45,'Sep',2023,'09-2023'),(46,'Okt',2023,'10-2023'),(47,'Nov',2023,'11-2023'),(48,'Des',2023,'12-2023'),(49,'Jan',2024,'01-2024'),(50,'Feb',2024,'02-2024'),(51,'Mar',2024,'03-2024'),(52,'Apr',2024,'04-2024'),(53,'Mei',2024,'05-2024'),(54,'Jun',2024,'06-2024'),(55,'Jul',2024,'07-2024'),(56,'Agu',2024,'08-2024'),(57,'Sep',2024,'09-2024'),(58,'Okt',2024,'10-2024'),(59,'Nov',2024,'11-2024'),(60,'Des',2024,'12-2024'),(61,'Jan',2025,'01-2025'),(62,'Feb',2025,'02-2025'),(63,'Mar',2025,'03-2025'),(64,'Apr',2025,'04-2025'),(65,'Mei',2025,'05-2025'),(66,'Jun',2025,'06-2025'),(67,'Jul',2025,'07-2025'),(68,'Agu',2025,'08-2025'),(69,'Sep',2025,'09-2025'),(70,'Okt',2025,'10-2025'),(71,'Nov',2025,'11-2025'),(72,'Des',2025,'12-2025'),(73,'Jan',2026,'01-2026'),(74,'Feb',2026,'02-2026'),(75,'Mar',2026,'03-2026'),(76,'Apr',2026,'04-2026'),(77,'Mei',2026,'05-2026'),(78,'Jun',2026,'06-2026'),(79,'Jul',2026,'07-2026'),(80,'Agu',2026,'08-2026'),(81,'Sep',2026,'09-2026'),(82,'Okt',2026,'10-2026'),(83,'Nov',2026,'11-2026'),(84,'Des',2026,'12-2026'),(85,'Jan',2027,'01-2027'),(86,'Feb',2027,'02-2027'),(87,'Mar',2027,'03-2027'),(88,'Apr',2027,'04-2027'),(89,'Mei',2027,'05-2027'),(90,'Jun',2027,'06-2027'),(91,'Jul',2027,'07-2027'),(92,'Agu',2027,'08-2027'),(93,'Sep',2027,'09-2027'),(94,'Okt',2027,'10-2027'),(95,'Nov',2027,'11-2027'),(96,'Des',2027,'12-2027'),(97,'Jan',2028,'01-2028'),(98,'Feb',2028,'02-2028'),(99,'Mar',2028,'03-2028'),(100,'Apr',2028,'04-2028'),(101,'Mei',2028,'05-2028'),(102,'Jun',2028,'06-2028'),(103,'Jul',2028,'07-2028'),(104,'Agu',2028,'08-2028'),(105,'Sep',2028,'09-2028'),(106,'Okt',2028,'10-2028'),(107,'Nov',2028,'11-2028'),(108,'Des',2028,'12-2028'),(109,'Jan',2029,'01-2029'),(110,'Feb',2029,'02-2029'),(111,'Mar',2029,'03-2029'),(112,'Apr',2029,'04-2029'),(113,'Mei',2029,'05-2029'),(114,'Jun',2029,'06-2029'),(115,'Jul',2029,'07-2029'),(116,'Agu',2029,'08-2029'),(117,'Sep',2029,'09-2029'),(118,'Okt',2029,'10-2029'),(119,'Nov',2029,'11-2029'),(120,'Des',2029,'12-2029'),(121,'Jan',2030,'01-2030'),(122,'Feb',2030,'02-2030'),(123,'Mar',2030,'03-2030'),(124,'Apr',2030,'04-2030'),(125,'Mei',2030,'05-2030'),(126,'Jun',2030,'06-2030'),(127,'Jul',2030,'07-2030'),(128,'Agu',2030,'08-2030'),(129,'Sep',2030,'09-2030'),(130,'Okt',2030,'10-2030'),(131,'Nov',2030,'11-2030'),(132,'Des',2030,'12-2030');
/*!40000 ALTER TABLE `tb_bulan_tahun` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_item`
--

DROP TABLE IF EXISTS `tb_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_item` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `barcode` varchar(50) NOT NULL,
  `nama_item` varchar(100) NOT NULL,
  `id_kategori` int(11) unsigned NOT NULL,
  `id_unit` int(11) unsigned NOT NULL,
  `id_pemasok` int(11) unsigned NOT NULL,
  `harga` int(11) unsigned NOT NULL,
  `stok` int(11) unsigned NOT NULL,
  `gambar` varchar(100) NOT NULL DEFAULT 'gambar.jpg',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `barcode` (`barcode`),
  KEY `tb_item_id_unit_foreign` (`id_unit`),
  KEY `id_kategori_id_unit` (`id_kategori`,`id_unit`),
  KEY `id_pemasok` (`id_pemasok`),
  CONSTRAINT `tb_item_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `tb_item_id_pemasok_foreign` FOREIGN KEY (`id_pemasok`) REFERENCES `tb_pemasok` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `tb_item_id_unit_foreign` FOREIGN KEY (`id_unit`) REFERENCES `tb_unit` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_item`
--

LOCK TABLES `tb_item` WRITE;
/*!40000 ALTER TABLE `tb_item` DISABLE KEYS */;
INSERT INTO `tb_item` VALUES (1,'A0001','Sarimi Duo',1,2,2,2500,50,'gambar.jpg','2021-10-12 18:32:35','2022-05-02 22:03:59','0000-00-00 00:00:00'),(2,'A0002','Minyak Goreng',4,4,2,20000,50,'gambar.jpg','2021-10-19 22:33:38','2022-05-02 22:04:42','0000-00-00 00:00:00'),(3,'A0003','Rokok Djarum Super',6,6,1,20000,20,'gambar.jpg','2021-10-19 22:33:55','2022-05-02 22:06:50','0000-00-00 00:00:00'),(4,'A0004','Garam Dapur',4,5,1,2500,20,'gambar.jpg','2021-10-19 22:34:42','2022-05-02 22:07:20','0000-00-00 00:00:00'),(5,'A0005','Tolak Angin',3,2,1,3000,45,'gambar.jpg','2021-10-20 21:26:17','2022-05-02 22:07:51','0000-00-00 00:00:00'),(6,'A0006','Gula Pasir',4,4,1,10000,30,'gambar.jpg','2021-10-20 22:31:17','2022-05-02 22:08:20','0000-00-00 00:00:00'),(7,'A0007','Sprit',2,1,3,5000,20,'gambar.jpg','2022-01-21 18:57:34','2022-05-02 22:08:52','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `tb_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_kategori`
--

DROP TABLE IF EXISTS `tb_kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_kategori` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_kategori`
--

LOCK TABLES `tb_kategori` WRITE;
/*!40000 ALTER TABLE `tb_kategori` DISABLE KEYS */;
INSERT INTO `tb_kategori` VALUES (1,'Makanan','2021-10-12 18:31:03','2021-10-12 18:31:03','0000-00-00 00:00:00'),(2,'Minuman','2021-10-12 18:31:07','2021-10-19 22:19:43','0000-00-00 00:00:00'),(3,'Obat','2021-10-19 21:55:08','2021-10-19 21:56:16','0000-00-00 00:00:00'),(4,'Sembako','2021-10-20 21:25:19','2021-10-20 21:25:30','0000-00-00 00:00:00'),(5,'Atk','2022-05-02 21:51:21','2022-05-02 21:51:21','0000-00-00 00:00:00'),(6,'Lain-lain','2022-05-02 22:06:02','2022-05-02 22:06:02','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `tb_kategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_pelanggan`
--

DROP TABLE IF EXISTS `tb_pelanggan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_pelanggan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` varchar(100) NOT NULL,
  `jenkel` varchar(1) NOT NULL,
  `telp_pelanggan` varchar(20) NOT NULL,
  `alamat_pelanggan` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pelanggan`
--

LOCK TABLES `tb_pelanggan` WRITE;
/*!40000 ALTER TABLE `tb_pelanggan` DISABLE KEYS */;
INSERT INTO `tb_pelanggan` VALUES (1,'Umum','','-','-','2021-10-12 00:00:00','2022-05-02 21:52:31','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `tb_pelanggan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_pemasok`
--

DROP TABLE IF EXISTS `tb_pemasok`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_pemasok` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_pemasok` varchar(100) NOT NULL,
  `telp_pemasok` varchar(20) NOT NULL,
  `alamat_pemasok` varchar(100) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pemasok`
--

LOCK TABLES `tb_pemasok` WRITE;
/*!40000 ALTER TABLE `tb_pemasok` DISABLE KEYS */;
INSERT INTO `tb_pemasok` VALUES (1,'Pt. Jaya Abadi','98732783','Jakarta','','2021-10-19 20:44:45','2022-01-21 18:54:53','0000-00-00 00:00:00'),(2,'Cv Sejahtera','98732783','Bandung','','2021-10-19 21:17:05','2022-01-21 18:55:08','0000-00-00 00:00:00'),(3,'Toko Mulia','09298','Bandung','','2021-10-20 21:24:37','2022-05-02 22:05:27','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `tb_pemasok` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_pengaturan`
--

DROP TABLE IF EXISTS `tb_pengaturan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_pengaturan` (
  `nama_toko` varchar(20) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pengaturan`
--

LOCK TABLES `tb_pengaturan` WRITE;
/*!40000 ALTER TABLE `tb_pengaturan` DISABLE KEYS */;
INSERT INTO `tb_pengaturan` VALUES ('Khalisa Online Store','081295018034','Jl. Babakan Wadana No.39, Cipamokolan, Rancasari, Kota Bandung');
/*!40000 ALTER TABLE `tb_pengaturan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_penjualan`
--

DROP TABLE IF EXISTS `tb_penjualan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_penjualan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `invoice` varchar(50) NOT NULL,
  `id_pelanggan` int(11) unsigned NOT NULL,
  `total_harga` int(11) unsigned NOT NULL,
  `diskon` int(11) unsigned NOT NULL,
  `total_akhir` int(11) unsigned NOT NULL,
  `tunai` int(11) unsigned NOT NULL,
  `kembalian` int(11) unsigned NOT NULL,
  `catatan` text NOT NULL,
  `tanggal` date NOT NULL,
  `id_user` int(11) unsigned NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_penjualan_id_user_foreign` (`id_user`),
  KEY `id_pelanggan_id_user` (`id_pelanggan`,`id_user`),
  CONSTRAINT `tb_penjualan_id_pelanggan_foreign` FOREIGN KEY (`id_pelanggan`) REFERENCES `tb_pelanggan` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `tb_penjualan_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `tb_users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_penjualan`
--

LOCK TABLES `tb_penjualan` WRITE;
/*!40000 ALTER TABLE `tb_penjualan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_penjualan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_roles`
--

DROP TABLE IF EXISTS `tb_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_roles`
--

LOCK TABLES `tb_roles` WRITE;
/*!40000 ALTER TABLE `tb_roles` DISABLE KEYS */;
INSERT INTO `tb_roles` VALUES (1,'Super Admin'),(2,'Administrator'),(3,'Kasir');
/*!40000 ALTER TABLE `tb_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_stok`
--

DROP TABLE IF EXISTS `tb_stok`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_stok` (
  `id_stok` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tipe` enum('masuk','keluar') DEFAULT NULL,
  `id_item` int(11) unsigned NOT NULL,
  `id_pemasok` int(11) unsigned NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `id_user` int(11) unsigned NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id_stok`),
  KEY `tb_stok_id_pemasok_foreign` (`id_pemasok`),
  KEY `tb_stok_id_user_foreign` (`id_user`),
  KEY `id_item_id_pemasok_id_user` (`id_item`,`id_pemasok`,`id_user`),
  CONSTRAINT `tb_stok_id_item_foreign` FOREIGN KEY (`id_item`) REFERENCES `tb_item` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `tb_stok_id_pemasok_foreign` FOREIGN KEY (`id_pemasok`) REFERENCES `tb_pemasok` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `tb_stok_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `tb_users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_stok`
--

LOCK TABLES `tb_stok` WRITE;
/*!40000 ALTER TABLE `tb_stok` DISABLE KEYS */;
INSERT INTO `tb_stok` VALUES (1,'masuk',1,2,50,'belanja',1,'::1','2022-05-02 22:09:31','2022-05-02 22:09:31','0000-00-00 00:00:00'),(2,'masuk',6,1,30,'belanja',1,'::1','2022-05-02 22:09:47','2022-05-02 22:09:47','0000-00-00 00:00:00'),(3,'masuk',7,3,20,'belanja',1,'::1','2022-05-02 22:10:06','2022-05-02 22:10:06','0000-00-00 00:00:00'),(4,'keluar',5,1,5,'rusak',1,'::1','2022-05-02 22:10:42','2022-05-02 22:10:42','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `tb_stok` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_transaksi`
--

DROP TABLE IF EXISTS `tb_transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_penjualan` int(11) unsigned NOT NULL,
  `id_item` int(11) unsigned NOT NULL,
  `harga_item` int(11) unsigned NOT NULL,
  `jumlah_item` int(11) unsigned NOT NULL,
  `diskon_item` int(11) unsigned NOT NULL,
  `subtotal` int(11) unsigned NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `tb_transaksi_id_item_foreign` (`id_item`),
  KEY `id_penjualan_id_item` (`id_penjualan`,`id_item`),
  CONSTRAINT `tb_transaksi_id_item_foreign` FOREIGN KEY (`id_item`) REFERENCES `tb_item` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `tb_transaksi_id_penjualan_foreign` FOREIGN KEY (`id_penjualan`) REFERENCES `tb_penjualan` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_transaksi`
--

LOCK TABLES `tb_transaksi` WRITE;
/*!40000 ALTER TABLE `tb_transaksi` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_unit`
--

DROP TABLE IF EXISTS `tb_unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_unit` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_unit` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_unit`
--

LOCK TABLES `tb_unit` WRITE;
/*!40000 ALTER TABLE `tb_unit` DISABLE KEYS */;
INSERT INTO `tb_unit` VALUES (1,'Botol','2021-10-12 18:31:20','2022-05-01 16:07:11','0000-00-00 00:00:00'),(2,'Pcs','2021-10-12 18:31:25','2021-10-12 18:31:25','0000-00-00 00:00:00'),(3,'Buah','2021-10-12 18:31:29','2021-10-12 18:31:29','0000-00-00 00:00:00'),(4,'Kg','2021-10-19 22:26:05','2022-05-02 21:57:21','0000-00-00 00:00:00'),(5,'Gram','2021-10-20 21:25:42','2022-05-02 21:58:11','0000-00-00 00:00:00'),(6,'Bungkus','2022-05-02 22:06:13','2022-05-02 22:06:13','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `tb_unit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_users`
--

DROP TABLE IF EXISTS `tb_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `id_role` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'avatar.jpg',
  `status` int(1) NOT NULL DEFAULT 0,
  `token` varchar(255) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_username` (`email`,`username`),
  KEY `id_role` (`id_role`),
  CONSTRAINT `tb_users_id_role_foreign` FOREIGN KEY (`id_role`) REFERENCES `tb_roles` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_users`
--

LOCK TABLES `tb_users` WRITE;
/*!40000 ALTER TABLE `tb_users` DISABLE KEYS */;
INSERT INTO `tb_users` VALUES (1,'sejatordev@gmail.com','superadmin','$2y$10$PG9Nxciie3SHDVS6.a0Uw.QUqiAQx7pmM5qRnNuF0I5HvUpGbV50a','Super Admin','Bandung',1,'avatar.jpg',1,'7b9abf00d73a783b2f1559517823fd60331f9b0ae065f68b732be0a364ab7347','0.0.0.0','2021-10-12 18:29:41','2023-03-01 11:05:48',NULL),(2,'admin@gmail.com','admin','$2y$10$DMm.sX1hMZMmwufMtk4Ktug0Tp3VIeskxo8Dukcq1crEr5WE32hHW','Administrator','Boyolali',2,'avatar.jpg',1,'bdbc976f1212965d03dcce1fecbcc811d3c817b7efd1aa61c090b5d7913b895f','0.0.0.0','2021-10-12 18:29:41','2023-03-01 11:06:03',NULL),(3,'kasir@gmail.com','kasir','$2y$10$q1sAVbrj2Jt2w50GFXYPOuyLbgJgAFgVEBldMa85/eN0MzZI4X.CK','Kasir','Bandung',3,'avatar.jpg',1,NULL,'0.0.0.0','2021-10-12 18:29:41','2023-03-01 11:06:09',NULL);
/*!40000 ALTER TABLE `tb_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'posci4'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-03-01 11:06:47
