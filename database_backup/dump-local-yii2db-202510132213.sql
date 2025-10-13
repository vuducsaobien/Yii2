/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.8.2-MariaDB, for osx10.19 (arm64)
--
-- Host: localhost    Database: yii2db
-- ------------------------------------------------------
-- Server version	8.0.43-0ubuntu0.22.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `country` (
  `country_Id` int NOT NULL AUTO_INCREMENT,
  `country_Name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Country name',
  `country_Code` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Country code (ISO)',
  `country_Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `country_Updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`country_Id`),
  UNIQUE KEY `idx_country_Code` (`country_Code`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country`
--

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `country` VALUES
(1,'Viet Nam','vn','2025-09-26 10:12:05','2025-09-26 10:12:05'),
(2,'China','china','2025-09-26 10:12:05','2025-09-26 10:12:05'),
(3,'Lao','lao','2025-09-26 10:12:05','2025-09-26 10:12:05'),
(4,'Cambodia','cambodia','2025-09-26 10:12:05','2025-10-01 13:53:02'),
(5,'Thai Lan','thailand','2025-10-01 13:55:50','2025-10-01 13:55:50'),
(6,'Malaisia','malaisia','2025-10-01 13:56:11','2025-10-01 13:56:11');
/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer` (
  `customer_Id` int NOT NULL AUTO_INCREMENT,
  `customer_Country_id` int NOT NULL COMMENT 'Foreign key to country table',
  `customer_Name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Customer name',
  `customer_Email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Customer email',
  `customer_Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `customer_Updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`customer_Id`),
  KEY `idx_customer_Country_id` (`customer_Country_id`),
  CONSTRAINT `fk_customer_Country_id` FOREIGN KEY (`customer_Country_id`) REFERENCES `country` (`country_Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `customer` VALUES
(1,1,'Customer 1','1@gmail.com','2025-09-26 10:14:05','2025-10-01 13:57:16'),
(2,1,'Customer 2','2@gmail.com','2025-09-26 10:14:05','2025-10-01 13:57:16'),
(3,1,'Customer 3','3@gmail.com','2025-09-26 10:14:35','2025-10-01 13:57:16'),
(4,2,'Customer 4','4@gmail.com','2025-09-26 10:14:35','2025-10-01 13:57:16'),
(5,3,'Customer 5','5@gmail.com','2025-10-01 13:57:01','2025-10-01 13:57:20');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `items` (
  `item_Id` int NOT NULL AUTO_INCREMENT,
  `item_Name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Item name',
  `item_Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Item description',
  `item_Price` decimal(10,2) NOT NULL COMMENT 'Item price',
  `item_Category` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Item category',
  `item_Stock_quantity` int NOT NULL DEFAULT '0' COMMENT 'Stock quantity',
  `item_Is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Is item active',
  `item_Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `item_Updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`item_Id`),
  KEY `idx_items_category` (`item_Category`),
  KEY `idx_items_is_active` (`item_Is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migration` (
  `version` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `migration` VALUES
('m000000_000000_base',1758726567),
('m250916_150708_create_table_1_table',1758726568),
('m250916_152713_create_table_2_table',1758726568),
('m250926_093933_create_country_table',1758881433),
('m250926_094001_create_customer_table',1758881434),
('m250929_161525_create_order_table',1759163479),
('m251001_143000_create_items_table',1760030102),
('m251001_143001_create_order_items_table',1760030103),
('m251008_164953_update_customer_table',1760030103),
('m251008_165017_update_order_table',1760030103),
('m251008_165018_update_country_table',1760030104),
('m251012_051742_update_customer_table',1760368160),
('m251012_053949_update_order_table',1760368160),
('m251012_055109_update_country_table',1760368160);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `order` (
  `order_Id` int NOT NULL AUTO_INCREMENT,
  `order_Customer_id` int NOT NULL COMMENT 'Foreign key to customer table',
  `order_Order_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Order number',
  `order_Total_amount` decimal(10,2) NOT NULL COMMENT 'Total order amount',
  `order_Status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending' COMMENT 'Order status',
  `order_Order_date` date NOT NULL COMMENT 'Order date',
  `order_Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `order_Updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_Id`),
  UNIQUE KEY `idx_order_number` (`order_Order_number`),
  KEY `idx_order_customer_id` (`order_Customer_id`),
  KEY `idx_order_status` (`order_Status`),
  CONSTRAINT `fk_order_Customer_id` FOREIGN KEY (`order_Customer_id`) REFERENCES `customer` (`customer_Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `order` VALUES
(1,1,'A1',2.00,'pending','2025-09-29','2025-09-29 16:32:44','2025-09-29 16:32:44'),
(2,2,'A2',3.00,'pending','2025-09-28','2025-09-29 16:33:04','2025-10-11 13:44:33'),
(3,2,'A3',2.00,'order','2025-09-29','2025-09-29 16:32:44','2025-10-11 13:44:33'),
(4,3,'A4',3.00,'active','2025-09-28','2025-09-29 16:33:04','2025-10-11 13:44:33'),
(5,3,'A5',1.00,'inactive','2025-09-28','2025-09-29 16:33:04','2025-10-01 13:58:00'),
(6,3,'A6',1.00,'inactive','2025-09-28','2025-09-29 16:33:04','2025-10-01 13:58:00'),
(7,3,'A7',1.00,'inactive','2025-09-28','2025-09-29 16:33:04','2025-10-01 13:58:00');

/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `order_item_Id` int NOT NULL AUTO_INCREMENT,
  `order_item_Order_id` int NOT NULL COMMENT 'Foreign key to order table',
  `order_item_Item_id` int NOT NULL COMMENT 'Foreign key to item table',
  `order_item_Quantity` int NOT NULL COMMENT 'Quantity',
  `order_item_Price` decimal(10,2) NOT NULL COMMENT 'Price',
  `order_item_Total` decimal(10,2) NOT NULL COMMENT 'Total',
  `order_item_Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `order_item_Updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_item_Id`),
  KEY `fk_order_items_Order_id` (`order_item_Order_id`),
  CONSTRAINT `fk_order_items_Order_id` FOREIGN KEY (`order_item_Order_id`) REFERENCES `order` (`order_Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `table_1`
--

DROP TABLE IF EXISTS `table_1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `table_1` (
  `id` int NOT NULL AUTO_INCREMENT,
  `table_2_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table_1`
--

LOCK TABLES `table_1` WRITE;
/*!40000 ALTER TABLE `table_1` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `table_1` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `table_2`
--

DROP TABLE IF EXISTS `table_2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `table_2` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table_2`
--

LOCK TABLES `table_2` WRITE;
/*!40000 ALTER TABLE `table_2` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `table_2` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Dumping routines for database 'yii2db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2025-10-13 22:13:25
