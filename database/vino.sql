-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 07, 2024 at 01:24 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vino`
--

CREATE DATABASE IF NOT EXISTS `vino` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;

--
-- Table structure for table `cellars`
--

DROP TABLE IF EXISTS `cellars`;
CREATE TABLE IF NOT EXISTS `cellars` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `users_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cellars_users_idx` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `cellar_contents`
--

DROP TABLE IF EXISTS `cellar_contents`;
CREATE TABLE IF NOT EXISTS `cellar_contents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `quantity` int NOT NULL,
  `purchase_date` date NOT NULL,
  `vintage` year DEFAULT NULL,
  `notes` varchar(100) DEFAULT NULL,
  `revoke_date` date DEFAULT NULL,
  `cellars_id` int NOT NULL,
  `wine_personal_id` int DEFAULT NULL,
  `wines_saq_id` int DEFAULT NULL,
  `wine_source_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cellar_contents_cellars1_idx` (`cellars_id`),
  KEY `fk_cellar_contents_wine_personal1_idx` (`wine_personal_id`),
  KEY `fk_cellar_contents_wines_saq1_idx` (`wines_saq_id`),
  KEY `fk_cellar_contents_wine_source1_idx` (`wine_source_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

DROP TABLE IF EXISTS `types`;
CREATE TABLE IF NOT EXISTS `types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `rememberToken` varchar(100) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `wines_saq`
--

DROP TABLE IF EXISTS `wines_saq`;
CREATE TABLE IF NOT EXISTS `wines_saq` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `code_wine` varchar(50) DEFAULT NULL,
  `description` text,
  `price` double DEFAULT NULL,
  `format` varchar(10) DEFAULT NULL,
  `regulated_designation` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  `grape_varieties` varchar(100) DEFAULT NULL,
  `degree alcohol` varchar(10) DEFAULT NULL,
  `sugar_content` varchar(10) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `url_image` varchar(200) DEFAULT NULL,
  `types_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_wines_types1_idx` (`types_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `wine_personal`
--

DROP TABLE IF EXISTS `wine_personal`;
CREATE TABLE IF NOT EXISTS `wine_personal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `code_wine` varchar(50) DEFAULT NULL,
  `description` text,
  `price` double DEFAULT NULL,
  `format` varchar(10) DEFAULT NULL,
  `regulated_designation` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `grape_varieties` varchar(100) DEFAULT NULL,
  `degree alcohol` varchar(10) DEFAULT NULL,
  `sugar_content` varchar(10) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `url_image` varchar(200) DEFAULT NULL,
  `types_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_wine_diff_types1_idx` (`types_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `wine_source`
--

DROP TABLE IF EXISTS `wine_source`;
CREATE TABLE IF NOT EXISTS `wine_source` (
  `id` int NOT NULL AUTO_INCREMENT,
  `source` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cellars`
--
ALTER TABLE `cellars`
  ADD CONSTRAINT `fk_cellars_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cellar_contents`
--
ALTER TABLE `cellar_contents`
  ADD CONSTRAINT `fk_cellar_contents_cellars1` FOREIGN KEY (`cellars_id`) REFERENCES `cellars` (`id`),
  ADD CONSTRAINT `fk_cellar_contents_wine_personal1` FOREIGN KEY (`wine_personal_id`) REFERENCES `wine_personal` (`id`),
  ADD CONSTRAINT `fk_cellar_contents_wine_source1` FOREIGN KEY (`wine_source_id`) REFERENCES `wine_source` (`id`),
  ADD CONSTRAINT `fk_cellar_contents_wines_saq1` FOREIGN KEY (`wines_saq_id`) REFERENCES `wines_saq` (`id`);

--
-- Constraints for table `wines_saq`
--
ALTER TABLE `wines_saq`
  ADD CONSTRAINT `fk_wines_types1` FOREIGN KEY (`types_id`) REFERENCES `types` (`id`);

--
-- Constraints for table `wine_personal`
--
ALTER TABLE `wine_personal`
  ADD CONSTRAINT `fk_wine_diff_types1` FOREIGN KEY (`types_id`) REFERENCES `types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
