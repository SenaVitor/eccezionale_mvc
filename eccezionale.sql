-- MySQL dump 10.13  Distrib 8.0.18, for Win64 (x86_64)
--
-- Host: localhost    Database: eccezionale_mvc
-- ------------------------------------------------------
-- Server version	5.7.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `carrinho`
--

DROP TABLE IF EXISTS `carrinho`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carrinho` (
  `id_carrinho` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) unsigned NOT NULL,
  `id_comida` bigint(20) unsigned NOT NULL,
  `quantidade_delivery` int(11) NOT NULL,
  PRIMARY KEY (`id_carrinho`),
  KEY `carrinho_id_user_foreign` (`id_user`),
  KEY `carrinho_id_comida_foreign` (`id_comida`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrinho`
--

LOCK TABLES `carrinho` WRITE;
/*!40000 ALTER TABLE `carrinho` DISABLE KEYS */;
/*!40000 ALTER TABLE `carrinho` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comidas`
--

DROP TABLE IF EXISTS `comidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comidas` (
  `id_comida` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome_comida` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preco_comida` decimal(6,2) NOT NULL,
  `imagem_comida` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao_comida` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nacionalidade_comida` enum('alemanha','italia','japao') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_comida`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comidas`
--

LOCK TABLES `comidas` WRITE;
/*!40000 ALTER TABLE `comidas` DISABLE KEYS */;
INSERT INTO `comidas` VALUES (1,'Lá modelita de la cassa',150.00,'img/comidas/imagem_comida_8222.jpeg','uma delícia','italia'),(2,'Vinho',29.00,'img/comidas/imagem_comida_9479.jpeg','Vinho alemão','alemanha'),(3,'arrozinho show',60.00,'img/comidas/imagem_comida_2327.pdf','sajdljaklsjd sdjkasjdk ajk  akjskjdka kasj','alemanha');
/*!40000 ALTER TABLE `comidas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_emails`
--

DROP TABLE IF EXISTS `contact_emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_emails` (
  `id_email_contato` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_mensagem` timestamp NOT NULL,
  PRIMARY KEY (`id_email_contato`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_emails`
--

LOCK TABLES `contact_emails` WRITE;
/*!40000 ALTER TABLE `contact_emails` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_emails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery`
--

DROP TABLE IF EXISTS `delivery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `delivery` (
  `id_delivery` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) unsigned NOT NULL,
  `cep_delivery` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_delivery` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `complemento_delivery` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_entrega` datetime NOT NULL,
  `preco_total` decimal(6,2) NOT NULL,
  PRIMARY KEY (`id_delivery`),
  KEY `delivery_id_user_foreign` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery`
--

LOCK TABLES `delivery` WRITE;
/*!40000 ALTER TABLE `delivery` DISABLE KEYS */;
INSERT INTO `delivery` VALUES (1,3,'32489-230','234','laksdjlak','2020-06-29 18:02:27',1505.00),(2,4,'34943-895','211','Casa a','2020-06-29 18:20:17',121.00);
/*!40000 ALTER TABLE `delivery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery_item`
--

DROP TABLE IF EXISTS `delivery_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `delivery_item` (
  `id_delivery_item` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_delivery` bigint(20) unsigned NOT NULL,
  `id_comida` bigint(20) unsigned NOT NULL,
  `quantidade_delivery` int(11) NOT NULL,
  `preco_comida` decimal(6,2) NOT NULL,
  PRIMARY KEY (`id_delivery_item`),
  KEY `delivery_item_id_delivery_foreign` (`id_delivery`),
  KEY `delivery_item_id_comida_foreign` (`id_comida`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery_item`
--

LOCK TABLES `delivery_item` WRITE;
/*!40000 ALTER TABLE `delivery_item` DISABLE KEYS */;
INSERT INTO `delivery_item` VALUES (1,1,1,10,150.00),(2,2,2,4,29.00);
/*!40000 ALTER TABLE `delivery_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mesas`
--

DROP TABLE IF EXISTS `mesas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mesas` (
  `id_mesa` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `qtd_cadeiras` int(11) NOT NULL,
  `tipo_mesa` enum('normal','vip') COLLATE utf8mb4_unicode_ci NOT NULL,
  `preco_mesa` decimal(6,2) NOT NULL,
  `reservada` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_mesa`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mesas`
--

LOCK TABLES `mesas` WRITE;
/*!40000 ALTER TABLE `mesas` DISABLE KEYS */;
INSERT INTO `mesas` VALUES (1,1,'normal',30.00,0),(2,1,'vip',60.00,0),(3,2,'vip',60.00,0),(4,2,'normal',30.00,0),(5,3,'normal',30.00,0),(6,3,'vip',60.00,0),(7,4,'normal',30.00,0),(8,4,'vip',60.00,0),(9,5,'normal',30.00,0),(10,5,'vip',60.00,1);
/*!40000 ALTER TABLE `mesas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_100000_create_password_resets_table',1),(2,'2020_05_28_220819_criar_tabelas',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservas`
--

DROP TABLE IF EXISTS `reservas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservas` (
  `id_reserva` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) unsigned NOT NULL,
  `cpf_user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_mesa` bigint(20) unsigned NOT NULL,
  `preco_total` decimal(6,2) NOT NULL,
  `data_reserva` datetime NOT NULL,
  PRIMARY KEY (`id_reserva`),
  KEY `reservas_id_user_foreign` (`id_user`),
  KEY `reservas_id_mesa_foreign` (`id_mesa`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservas`
--

LOCK TABLES `reservas` WRITE;
/*!40000 ALTER TABLE `reservas` DISABLE KEYS */;
INSERT INTO `reservas` VALUES (1,1,'711.711.711-78',1,30.00,'2020-06-17 15:36:00'),(2,1,'777.787.784-44',1,30.00,'2020-06-16 16:36:00'),(3,1,'711.711.711-78',1,30.00,'2020-06-16 18:19:00'),(4,1,'711.711.711-78',1,30.00,'2020-06-18 15:35:00'),(5,1,'711.711.711-78',10,300.00,'2020-06-21 16:16:00'),(6,1,'721.123.123-78',2,60.00,'2020-06-21 16:55:00'),(7,1,'711.711.711-78',2,60.00,'2020-06-23 19:50:00'),(8,1,'777.787.783-33',4,60.00,'2020-06-21 19:52:00'),(9,3,'324.798.739-42',10,300.00,'2022-06-29 18:03:00'),(10,3,'938.729.438-74',1,30.00,'2020-06-30 18:04:00'),(11,1,'324.798.739-41',7,120.00,'2020-06-29 18:05:00'),(12,1,'324.798.739-41',9,150.00,'2020-06-29 18:06:00'),(13,3,'324.798.739-42',2,60.00,'2020-06-29 18:08:00'),(14,1,'324.798.739-42',3,120.00,'2020-07-08 20:08:00'),(15,1,'324.798.739-42',2,60.00,'2020-06-29 18:10:00'),(16,1,'923.847.982-37',7,120.00,'2020-06-29 18:09:00'),(17,1,'324.798.739-42',5,90.00,'2020-06-29 19:10:00'),(18,3,'324.798.739-42',7,120.00,'2020-06-29 18:13:00'),(19,1,'324.798.739-42',8,240.00,'2020-06-30 18:12:00');
/*!40000 ALTER TABLE `reservas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sobrenome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_de_criacao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_telefone_unique` (`telefone`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Vitor','Lucas','vitorlucasdesenalima@gmail.com','$2y$10$1WU9yRSDvBL8U8syR.S5W.n.YERMAp8OdIuZY7ow0SOBN.BKEvWLW','(85) 9924-0090',NULL),(2,'Sena','Vitor','senavitor556@gmail.com','$2y$10$fYItFURdn2iSaA2zvYP1m.InLPYiqUI5wrAGH.yIuXYganeWHCNUK','(85) 9924-2211',NULL),(3,'Leandro','Lima','leandro@gmail.com','$2y$10$VvSLFljKnrMx3cKzxNcy9.BHS40vtyC/rcWRa6a40s745D2fSqMNe','(34) 5495-8473',NULL),(4,'José','Wilker','josepal@gmail.com','$2y$10$uMvXfZ9I7yD8jO4HCUwl5e.2cN9zh9I6Lj0c7ljXuIaoR1TmX4U.e','(64) 6357-3667',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-01 11:28:51
