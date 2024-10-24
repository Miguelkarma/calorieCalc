-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for caloriecalc
CREATE DATABASE IF NOT EXISTS `caloriecalc` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `caloriecalc`;

-- Dumping structure for table caloriecalc.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table caloriecalc.admins: ~0 rows (approximately)
INSERT INTO `admins` (`id`, `email`, `username`, `password`, `created_at`) VALUES
	(1, 'calorieadmin@gmail.com', 'calorieadmin', '$2a$04$3N0FQzTcle32ankKhNT7qO/F1b456DC/W0SAtYXx3l5ILAkxRiw12', '2024-10-09 10:27:51');

-- Dumping structure for table caloriecalc.calculation_history
CREATE TABLE IF NOT EXISTS `calculation_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `calculation` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `calculation_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table caloriecalc.calculation_history: ~10 rows (approximately)
INSERT INTO `calculation_history` (`id`, `user_id`, `calculation`, `created_at`) VALUES
	(1, 2, '[]', '2024-09-28 09:58:11'),
	(2, 2, '[]', '2024-09-28 10:03:29'),
	(3, 2, '{"age":null,"gender":null,"weight":null,"height":null,"activity":null,"maintainWeight":-0}', '2024-09-28 10:05:34'),
	(4, 2, '{"age":null,"gender":null,"weight":null,"height":null,"activity":null,"maintainWeight":-0}', '2024-09-28 10:09:34'),
	(5, 2, '{"Maintain Weight":null,"Mild Weight Loss":null,"Weight Loss":null,"Extreme Weight Loss":null}', '2024-09-28 10:13:17'),
	(6, 2, '{"Maintain Weight":"-180","Mild Weight Loss":"-162","Weight Loss":"-144","Extreme Weight Loss":"-110"}', '2024-09-28 10:19:40'),
	(7, 2, '{"Maintain Weight":"33","Mild Weight Loss":"30","Weight Loss":"26","Extreme Weight Loss":"20"}', '2024-09-28 13:05:09'),
	(8, 2, '{"Maintain Weight":"33","Mild Weight Loss":"30","Weight Loss":"26","Extreme Weight Loss":"20"}', '2024-09-28 13:07:54'),
	(9, 3, '{"Maintain Weight":"131944118","Mild Weight Loss":"118749706","Weight Loss":"105555295","Extreme Weight Loss":"80485912"}', '2024-09-28 13:34:31'),
	(10, 4, '{"Maintain Weight":"228","Mild Weight Loss":"206","Weight Loss":"183","Extreme Weight Loss":"139"}', '2024-10-10 00:17:01'),
	(11, 7, '{"Maintain Weight":"3275","Mild Weight Loss":"2948","Weight Loss":"2620","Extreme Weight Loss":"1998"}', '2024-10-20 09:56:17'),
	(12, 7, '{"Maintain Weight":"367130","Mild Weight Loss":"330417","Weight Loss":"293704","Extreme Weight Loss":"223949"}', '2024-10-20 12:39:44'),
	(13, 4, '{"Maintain Weight":"5149","Mild Weight Loss":"4634","Weight Loss":"4119","Extreme Weight Loss":"3141"}', '2024-10-21 12:01:48'),
	(14, 5, '{"Maintain Weight":"41682","Mild Weight Loss":"37514","Weight Loss":"33346","Extreme Weight Loss":"25426"}', '2024-10-21 13:47:33');

-- Dumping structure for table caloriecalc.tbl_calorie
CREATE TABLE IF NOT EXISTS `tbl_calorie` (
  `tbl_calorie_id` int NOT NULL AUTO_INCREMENT,
  `calorie_amount` int NOT NULL,
  `calorie_date` date NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`tbl_calorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table caloriecalc.tbl_calorie: ~6 rows (approximately)
INSERT INTO `tbl_calorie` (`tbl_calorie_id`, `calorie_amount`, `calorie_date`, `user_id`) VALUES
	(1, 1234, '2024-06-24', 1),
	(2, 12341, '2024-06-25', 2),
	(5, 23, '2024-10-15', 7),
	(7, 5125, '2024-10-15', 7),
	(9, 123, '2024-10-21', 7),
	(10, 4, '2024-10-30', 7),
	(11, 213, '2024-10-21', 5);

-- Dumping structure for table caloriecalc.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `birth_date` date DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `bio` text,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('active','inactive','blocked') DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table caloriecalc.users: ~1 rows (approximately)
INSERT INTO `users` (`id`, `email`, `birth_date`, `username`, `password`, `bio`, `profile_picture`, `created_at`, `updated_at`, `status`) VALUES
	(2, '123@gmail.com', '2024-10-21', 'bitch', '$2y$10$fLNZUoSO0Pp825wM/IvfA.vq8NRz.rMkmnLeQV9pjOD9zp6VSKC/K', 'k', NULL, '2024-10-21 00:52:22', '2024-10-21 01:12:59', 'active'),
	(3, 'tolonges@gmail.com', '2024-10-21', 'okinawa', '$2y$10$.UWvS/PgGIYvTx3nQh7l..3iVQYgB3rC8IjRI6NyrQi5u9y4t2eJm', 'hey', NULL, '2024-10-21 01:25:02', '2024-10-21 01:30:57', 'active'),
	(4, 'paul@gmail.com', '2024-10-21', '123', '$2y$10$CBQfouqR.aaCsCHs/PqZdux2PGxAinfUJujtgg7vPc.x1dhBzoS6O', '123', NULL, '2024-10-21 11:38:17', '2024-10-21 12:43:15', 'active'),
	(5, 'fas@gmail.com', '2024-10-22', 'migz', '$2y$10$B7rgHWuiF8GBRBycFUEIaOGET6/X8Hr2nJ74G8KXq2YQ.2MlPYC/S', 'e', '../imagesicon1.png', '2024-10-21 12:53:41', '2024-10-21 13:15:20', 'active');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
