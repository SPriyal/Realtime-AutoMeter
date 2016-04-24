-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2016 at 09:15 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bm`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `depth` int(11) DEFAULT NULL,
  `parameter_id` int(20) DEFAULT NULL,
  `csvFilePath` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `columnNoInCSV` int(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `companies_parent_id_index` (`parent_id`),
  KEY `companies_lft_index` (`lft`),
  KEY `companies_rgt_index` (`rgt`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=205 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `parent_id`, `lft`, `rgt`, `depth`, `parameter_id`, `csvFilePath`, `columnNoInCSV`, `created_at`, `updated_at`) VALUES
(1, 'AutoSoft Corp.', NULL, 1, 30, 0, NULL, NULL, NULL, '2016-04-10 14:49:48', '2016-04-10 14:49:48'),
(2, 'Dept 1 : Spinning', 1, 2, 15, 1, NULL, NULL, NULL, '2016-04-10 14:49:48', '2016-04-10 14:49:48'),
(3, 'Machine 1 : Dyeing', 2, 3, 8, 2, NULL, NULL, NULL, '2016-04-10 14:49:48', '2016-04-10 14:49:48'),
(4, 'Meter 1', 3, 4, 5, 3, NULL, NULL, NULL, '2016-04-10 14:49:48', '2016-04-10 14:49:48'),
(5, 'Meter 2', 3, 6, 7, 3, NULL, NULL, NULL, '2016-04-10 14:49:48', '2016-04-10 14:49:48'),
(6, 'Machine 2 : Printing', 2, 9, 14, 2, NULL, NULL, NULL, '2016-04-10 14:49:48', '2016-04-10 14:49:48'),
(7, 'Meter 1', 6, 10, 11, 3, NULL, NULL, NULL, '2016-04-10 14:49:48', '2016-04-10 14:49:48'),
(8, 'Meter 2', 6, 12, 13, 3, NULL, NULL, NULL, '2016-04-10 14:49:48', '2016-04-10 14:49:48'),
(9, 'Meter 1', 15, 18, 19, 3, NULL, NULL, NULL, '2016-04-10 14:49:48', '2016-04-10 14:49:48'),
(10, 'Meter 2', 15, 20, 21, 3, NULL, NULL, NULL, '2016-04-10 14:49:48', '2016-04-10 14:49:48'),
(11, 'Machine 2 : Printing', 14, 23, 24, 2, NULL, NULL, NULL, '2016-04-10 14:49:48', '2016-04-10 14:49:48'),
(12, 'Dept 3 : Finishing', 1, 26, 27, 1, NULL, NULL, NULL, '2016-04-10 14:49:48', '2016-04-10 14:49:48'),
(13, 'Dept 4 : Testing', 1, 28, 29, 1, NULL, NULL, NULL, '2016-04-10 14:49:48', '2016-04-10 14:49:48'),
(14, 'Dept 2 : Knitting', 1, 16, 25, 1, NULL, NULL, NULL, '2016-04-10 14:49:48', '2016-04-10 14:49:48'),
(15, 'Machine 1 : Dyeing', 14, 17, 22, 2, NULL, NULL, NULL, '2016-04-10 14:49:48', '2016-04-10 14:49:48'),
(16, 'N2P2 Pvt. Ltd.', NULL, 31, 96, 0, NULL, 'N2P2 Pvt. Ltd./', NULL, '2016-04-10 20:19:52', '2016-04-10 20:19:56'),
(17, 'Coating 01', 16, 32, 39, 1, NULL, 'N2P2 Pvt. Ltd./', NULL, '2016-04-10 20:19:52', '2016-04-10 20:19:53'),
(18, 'STR1', 17, 33, 34, 2, 1, 'N2P2 Pvt. Ltd./', 6, '2016-04-10 20:19:53', '2016-04-10 15:46:37'),
(19, 'SPD1', 17, 35, 36, 2, 2, 'N2P2 Pvt. Ltd./', 7, '2016-04-10 20:19:53', '2016-04-10 15:46:37'),
(20, 'RT1', 17, 37, 38, 2, 3, 'N2P2 Pvt. Ltd./', 8, '2016-04-10 20:19:53', '2016-04-10 15:46:37'),
(21, 'Coating 02', 16, 40, 47, 1, NULL, 'N2P2 Pvt. Ltd./', NULL, '2016-04-10 20:19:53', '2016-04-10 20:19:53'),
(22, 'STR2', 21, 41, 42, 2, 1, 'N2P2 Pvt. Ltd./', 9, '2016-04-10 20:19:53', '2016-04-10 15:46:37'),
(23, 'SPD2', 21, 43, 44, 2, 2, 'N2P2 Pvt. Ltd./', 10, '2016-04-10 20:19:53', '2016-04-10 15:46:37'),
(24, 'RT2', 21, 45, 46, 2, 3, 'N2P2 Pvt. Ltd./', 11, '2016-04-10 20:19:53', '2016-04-10 15:46:37'),
(25, 'Roller 01', 16, 48, 55, 1, NULL, 'N2P2 Pvt. Ltd./', NULL, '2016-04-10 20:19:53', '2016-04-10 20:19:54'),
(26, 'STR3', 25, 49, 50, 2, 1, 'N2P2 Pvt. Ltd./', 12, '2016-04-10 20:19:53', '2016-04-10 15:46:37'),
(27, 'SPD3', 25, 51, 52, 2, 2, 'N2P2 Pvt. Ltd./', 13, '2016-04-10 20:19:54', '2016-04-10 15:46:37'),
(28, 'RT3', 25, 53, 54, 2, 3, 'N2P2 Pvt. Ltd./', 14, '2016-04-10 20:19:54', '2016-04-10 15:46:37'),
(29, 'Roller 02', 16, 56, 63, 1, NULL, 'N2P2 Pvt. Ltd./', NULL, '2016-04-10 20:19:54', '2016-04-10 20:19:54'),
(30, 'STR4', 29, 57, 58, 2, 1, 'N2P2 Pvt. Ltd./', 15, '2016-04-10 20:19:54', '2016-04-10 15:46:37'),
(31, 'SPD4', 29, 59, 60, 2, 2, 'N2P2 Pvt. Ltd./', 16, '2016-04-10 20:19:54', '2016-04-10 15:46:37'),
(32, 'RT4', 29, 61, 62, 2, 3, 'N2P2 Pvt. Ltd./', 17, '2016-04-10 20:19:54', '2016-04-10 15:46:37'),
(33, 'Stenter 05', 16, 64, 71, 1, NULL, 'N2P2 Pvt. Ltd./', NULL, '2016-04-10 20:19:54', '2016-04-10 20:19:55'),
(34, 'STR5', 33, 65, 66, 2, 1, 'N2P2 Pvt. Ltd./', 18, '2016-04-10 20:19:54', '2016-04-10 15:46:37'),
(35, 'SPD5', 33, 67, 68, 2, 2, 'N2P2 Pvt. Ltd./', 19, '2016-04-10 20:19:55', '2016-04-10 15:46:37'),
(36, 'RT5', 33, 69, 70, 2, 3, 'N2P2 Pvt. Ltd./', 20, '2016-04-10 20:19:55', '2016-04-10 15:46:37'),
(37, 'Stenter 06', 16, 72, 79, 1, NULL, 'N2P2 Pvt. Ltd./', NULL, '2016-04-10 20:19:55', '2016-04-10 20:19:55'),
(38, 'STR6', 37, 73, 74, 2, 1, 'N2P2 Pvt. Ltd./', 21, '2016-04-10 20:19:55', '2016-04-10 15:46:37'),
(39, 'SPD6', 37, 75, 76, 2, 2, 'N2P2 Pvt. Ltd./', 22, '2016-04-10 20:19:55', '2016-04-10 15:46:37'),
(40, 'RT6', 37, 77, 78, 2, 3, 'N2P2 Pvt. Ltd./', 23, '2016-04-10 20:19:55', '2016-04-10 15:46:37'),
(41, 'Stenter 07', 16, 80, 87, 1, NULL, 'N2P2 Pvt. Ltd./', NULL, '2016-04-10 20:19:55', '2016-04-10 20:19:55'),
(42, 'STR7', 41, 81, 82, 2, 1, 'N2P2 Pvt. Ltd./', 24, '2016-04-10 20:19:55', '2016-04-10 15:46:37'),
(43, 'SPD7', 41, 83, 84, 2, 2, 'N2P2 Pvt. Ltd./', 25, '2016-04-10 20:19:55', '2016-04-10 15:46:37'),
(44, 'RT7', 41, 85, 86, 2, 3, 'N2P2 Pvt. Ltd./', 26, '2016-04-10 20:19:55', '2016-04-10 15:46:37'),
(45, 'Stenter 08', 16, 88, 95, 1, NULL, 'N2P2 Pvt. Ltd./', NULL, '2016-04-10 20:19:55', '2016-04-10 20:19:56'),
(46, 'STR8', 45, 89, 90, 2, 1, 'N2P2 Pvt. Ltd./', 27, '2016-04-10 20:19:56', '2016-04-10 15:46:37'),
(47, 'SPD8', 45, 91, 92, 2, 2, 'N2P2 Pvt. Ltd./', 28, '2016-04-10 20:19:56', '2016-04-10 15:46:38'),
(48, 'RT8', 45, 93, 94, 2, 3, 'N2P2 Pvt. Ltd./', 29, '2016-04-10 20:19:56', '2016-04-10 15:46:38'),
(49, 'NTB', NULL, 97, 158, 0, NULL, 'NTB/', NULL, '2016-04-10 20:20:21', '2016-04-10 20:20:23'),
(50, 'department 1', 49, 98, 113, 1, NULL, 'NTB/', NULL, '2016-04-10 20:20:21', '2016-04-10 20:20:21'),
(51, 'machine 1', 50, 99, 108, 2, NULL, 'NTB/', NULL, '2016-04-10 20:20:21', '2016-04-10 20:20:21'),
(52, 'meter 1', 51, 100, 101, 3, NULL, 'NTB/', NULL, '2016-04-10 20:20:21', '2016-04-10 20:20:21'),
(53, 'meter 2', 51, 102, 103, 3, NULL, 'NTB/', NULL, '2016-04-10 20:20:21', '2016-04-10 20:20:21'),
(54, 'meter 3', 51, 104, 105, 3, NULL, 'NTB/', NULL, '2016-04-10 20:20:21', '2016-04-10 20:20:21'),
(55, 'meter 4', 51, 106, 107, 3, NULL, 'NTB/', NULL, '2016-04-10 20:20:21', '2016-04-10 20:20:21'),
(56, 'machine 2', 50, 109, 112, 2, NULL, 'NTB/', NULL, '2016-04-10 20:20:21', '2016-04-10 20:20:21'),
(57, 'meter 1-1', 56, 110, 111, 3, NULL, 'NTB/', NULL, '2016-04-10 20:20:21', '2016-04-10 20:20:21'),
(58, 'department2', 49, 114, 147, 1, NULL, 'NTB/', NULL, '2016-04-10 20:20:21', '2016-04-10 20:20:23'),
(59, 'machine 3', 58, 115, 144, 2, NULL, 'NTB/', NULL, '2016-04-10 20:20:21', '2016-04-10 20:20:23'),
(60, 'meter2-1', 59, 116, 141, 3, NULL, 'NTB/', NULL, '2016-04-10 20:20:22', '2016-04-10 20:20:23'),
(61, 'sub-meter1', 60, 117, 118, 4, NULL, 'NTB/', NULL, '2016-04-10 20:20:22', '2016-04-10 20:20:22'),
(62, 'sub-meter2', 60, 119, 122, 4, NULL, 'NTB/', NULL, '2016-04-10 20:20:22', '2016-04-10 20:20:22'),
(63, 'reading 1', 62, 120, 121, 5, NULL, 'NTB/', NULL, '2016-04-10 20:20:22', '2016-04-10 20:20:22'),
(64, 'sub-meter3', 60, 123, 140, 4, NULL, 'NTB/', NULL, '2016-04-10 20:20:22', '2016-04-10 20:20:23'),
(65, 'r1', 64, 124, 131, 5, NULL, 'NTB/', NULL, '2016-04-10 20:20:22', '2016-04-10 20:20:22'),
(66, 'r2', 65, 125, 130, 6, NULL, 'NTB/', NULL, '2016-04-10 20:20:22', '2016-04-10 20:20:22'),
(67, 'r3', 66, 126, 129, 7, NULL, 'NTB/', NULL, '2016-04-10 20:20:22', '2016-04-10 20:20:22'),
(68, 'r4', 67, 127, 128, 8, NULL, 'NTB/', NULL, '2016-04-10 20:20:22', '2016-04-10 20:20:22'),
(69, 't1', 64, 132, 139, 5, NULL, 'NTB/', NULL, '2016-04-10 20:20:22', '2016-04-10 20:20:23'),
(70, 't2', 69, 133, 138, 6, NULL, 'NTB/', NULL, '2016-04-10 20:20:22', '2016-04-10 20:20:23'),
(71, 'shgduy', 70, 134, 137, 7, NULL, 'NTB/', NULL, '2016-04-10 20:20:23', '2016-04-10 20:20:23'),
(72, 'vasdj', 71, 135, 136, 8, NULL, 'NTB/', NULL, '2016-04-10 20:20:23', '2016-04-10 20:20:23'),
(73, 'meter 2-1', 59, 142, 143, 3, NULL, 'NTB/', NULL, '2016-04-10 20:20:23', '2016-04-10 20:20:23'),
(74, 'machine4', 58, 145, 146, 2, NULL, 'NTB/', NULL, '2016-04-10 20:20:23', '2016-04-10 20:20:23'),
(75, 'department 3', 49, 148, 149, 1, NULL, 'NTB/', NULL, '2016-04-10 20:20:23', '2016-04-10 20:20:23'),
(76, 'department 4', 49, 150, 151, 1, NULL, 'NTB/', NULL, '2016-04-10 20:20:23', '2016-04-10 20:20:23'),
(77, 'department 5', 49, 152, 153, 1, NULL, 'NTB/', NULL, '2016-04-10 20:20:23', '2016-04-10 20:20:23'),
(78, 'department 6', 49, 154, 155, 1, NULL, 'NTB/', NULL, '2016-04-10 20:20:23', '2016-04-10 20:20:23'),
(79, 'department 7', 49, 156, 157, 1, NULL, 'NTB/', NULL, '2016-04-10 20:20:23', '2016-04-10 20:20:23'),
(85, 'aa', NULL, 169, 188, 0, NULL, 'aa/', NULL, '2016-04-10 20:40:48', '2016-04-10 20:40:50'),
(86, 'EXCEL1', 85, 170, 183, 1, NULL, 'aa/', NULL, '2016-04-10 20:40:49', '2016-04-10 20:40:49'),
(87, 'WORD1', 86, 171, 182, 2, NULL, 'aa/', NULL, '2016-04-10 20:40:49', '2016-04-10 20:40:49'),
(88, 'PAGES1', 87, 172, 177, 3, NULL, 'aa/', NULL, '2016-04-10 20:40:49', '2016-04-10 20:40:49'),
(89, 'PPT1', 88, 173, 174, 4, NULL, 'aa/', NULL, '2016-04-10 20:40:49', '2016-04-10 20:40:49'),
(90, 'PPT2', 88, 175, 176, 4, NULL, 'aa/', NULL, '2016-04-10 20:40:49', '2016-04-10 20:40:49'),
(91, 'PAGES1', 87, 178, 181, 3, NULL, 'aa/', NULL, '2016-04-10 20:40:49', '2016-04-10 20:40:49'),
(92, 'PPT3', 91, 179, 180, 4, NULL, 'aa/', NULL, '2016-04-10 20:40:49', '2016-04-10 20:40:49'),
(93, 'EXCEL1', 85, 184, 187, 1, NULL, 'aa/', NULL, '2016-04-10 20:40:49', '2016-04-10 20:40:50'),
(94, 'word2', 93, 185, 186, 2, NULL, 'aa/', NULL, '2016-04-10 20:40:50', '2016-04-10 20:40:50'),
(95, 'bb', NULL, 189, 222, 0, NULL, 'bb/', NULL, '2016-04-10 20:44:52', '2016-04-10 20:44:54'),
(96, 'department 1', 95, 190, 205, 1, NULL, 'bb/', NULL, '2016-04-10 20:44:52', '2016-04-10 20:44:53'),
(97, 'machine 1', 96, 191, 200, 2, NULL, 'bb/', NULL, '2016-04-10 20:44:52', '2016-04-10 20:44:53'),
(98, 'meter 1', 97, 192, 193, 3, NULL, 'bb/', NULL, '2016-04-10 20:44:52', '2016-04-10 20:44:52'),
(99, 'meter 2', 97, 194, 195, 3, NULL, 'bb/', NULL, '2016-04-10 20:44:52', '2016-04-10 20:44:52'),
(100, 'meter 3', 97, 196, 197, 3, NULL, 'bb/', NULL, '2016-04-10 20:44:52', '2016-04-10 20:44:52'),
(101, 'meter 4', 97, 198, 199, 3, NULL, 'bb/', NULL, '2016-04-10 20:44:53', '2016-04-10 20:44:53'),
(102, 'machine 2', 96, 201, 204, 2, NULL, 'bb/', NULL, '2016-04-10 20:44:53', '2016-04-10 20:44:53'),
(103, 'meter 1-1', 102, 202, 203, 3, NULL, 'bb/', NULL, '2016-04-10 20:44:53', '2016-04-10 20:44:53'),
(104, 'department2', 95, 206, 211, 1, NULL, 'bb/', NULL, '2016-04-10 20:44:53', '2016-04-10 20:44:53'),
(105, 'machine 3', 104, 207, 208, 2, NULL, 'bb/', NULL, '2016-04-10 20:44:53', '2016-04-10 20:44:53'),
(106, 'machine4', 104, 209, 210, 2, NULL, 'bb/', NULL, '2016-04-10 20:44:53', '2016-04-10 20:44:53'),
(107, 'department 3', 95, 212, 213, 1, NULL, 'bb/', NULL, '2016-04-10 20:44:53', '2016-04-10 20:44:53'),
(108, 'department 4', 95, 214, 215, 1, NULL, 'bb/', NULL, '2016-04-10 20:44:53', '2016-04-10 20:44:53'),
(109, 'department 5', 95, 216, 217, 1, NULL, 'bb/', NULL, '2016-04-10 20:44:53', '2016-04-10 20:44:53'),
(110, 'department 6', 95, 218, 219, 1, NULL, 'bb/', NULL, '2016-04-10 20:44:53', '2016-04-10 20:44:53'),
(111, 'department 7', 95, 220, 221, 1, NULL, 'bb/', NULL, '2016-04-10 20:44:53', '2016-04-10 20:44:54'),
(112, 'ColumnMappingTest', NULL, 223, 232, 0, NULL, 'ColumnMappingTest/', NULL, '2016-04-11 13:35:38', '2016-04-11 13:35:39'),
(113, 'dept1', 112, 224, 231, 1, NULL, 'ColumnMappingTest/', NULL, '2016-04-11 13:35:38', '2016-04-11 13:35:39'),
(114, 'mac1', 113, 225, 230, 2, NULL, 'ColumnMappingTest/', NULL, '2016-04-11 13:35:39', '2016-04-11 13:35:39'),
(115, 'test_meter1', 114, 226, 227, 3, 2, 'ColumnMappingTest/', 5, '2016-04-11 13:35:39', '2016-04-11 08:09:47'),
(116, 'test_meter2', 114, 228, 229, 3, 3, 'ColumnMappingTest/', 6, '2016-04-11 13:35:39', '2016-04-11 08:09:47'),
(117, 'test', NULL, 233, 266, 0, NULL, 'test/', NULL, '2016-04-16 18:00:50', '2016-04-16 18:00:52'),
(118, 'department 1', 117, 234, 249, 1, NULL, 'test/', NULL, '2016-04-16 18:00:50', '2016-04-16 18:00:51'),
(119, 'machine 1', 118, 235, 244, 2, NULL, 'test/', NULL, '2016-04-16 18:00:50', '2016-04-16 18:00:51'),
(120, 'meter 1', 119, 236, 237, 3, NULL, 'test/', NULL, '2016-04-16 18:00:50', '2016-04-16 18:00:50'),
(121, 'meter 2', 119, 238, 239, 3, NULL, 'test/', NULL, '2016-04-16 18:00:51', '2016-04-16 18:00:51'),
(122, 'meter 3', 119, 240, 241, 3, NULL, 'test/', NULL, '2016-04-16 18:00:51', '2016-04-16 18:00:51'),
(123, 'meter 4', 119, 242, 243, 3, NULL, 'test/', NULL, '2016-04-16 18:00:51', '2016-04-16 18:00:51'),
(124, 'machine 2', 118, 245, 248, 2, NULL, 'test/', NULL, '2016-04-16 18:00:51', '2016-04-16 18:00:51'),
(125, 'meter 1-1', 124, 246, 247, 3, NULL, 'test/', NULL, '2016-04-16 18:00:51', '2016-04-16 18:00:51'),
(126, 'department2', 117, 250, 255, 1, NULL, 'test/', NULL, '2016-04-16 18:00:51', '2016-04-16 18:00:51'),
(127, 'machine 3', 126, 251, 252, 2, NULL, 'test/', NULL, '2016-04-16 18:00:51', '2016-04-16 18:00:51'),
(128, 'machine4', 126, 253, 254, 2, NULL, 'test/', NULL, '2016-04-16 18:00:51', '2016-04-16 18:00:51'),
(129, 'department 3', 117, 256, 257, 1, NULL, 'test/', NULL, '2016-04-16 18:00:52', '2016-04-16 18:00:52'),
(130, 'department 4', 117, 258, 259, 1, NULL, 'test/', NULL, '2016-04-16 18:00:52', '2016-04-16 18:00:52'),
(131, 'department 5', 117, 260, 261, 1, NULL, 'test/', NULL, '2016-04-16 18:00:52', '2016-04-16 18:00:52'),
(132, 'department 6', 117, 262, 263, 1, NULL, 'test/', NULL, '2016-04-16 18:00:52', '2016-04-16 18:00:52'),
(133, 'department 7', 117, 264, 265, 1, NULL, 'test/', NULL, '2016-04-16 18:00:52', '2016-04-16 18:00:52'),
(134, 'testing 2', NULL, 267, 276, 0, NULL, 'testing 2/', NULL, '2016-04-19 08:31:12', '2016-04-19 08:31:13'),
(135, 'dept1', 134, 268, 275, 1, NULL, 'testing 2/', NULL, '2016-04-19 08:31:12', '2016-04-19 08:31:13'),
(136, 'mac1', 135, 269, 274, 2, NULL, 'testing 2/', NULL, '2016-04-19 08:31:12', '2016-04-19 08:31:13'),
(137, 'test_meter1', 136, 270, 271, 3, NULL, 'testing 2/', NULL, '2016-04-19 08:31:12', '2016-04-19 08:31:12'),
(138, 'test_meter2', 136, 272, 273, 3, NULL, 'testing 2/', NULL, '2016-04-19 08:31:13', '2016-04-19 08:31:13'),
(139, 'PankajBhai CSV Pvt Ltd.', NULL, 277, 398, 0, NULL, 'PankajBhai CSV Pvt Ltd./', NULL, '2016-04-19 18:53:34', '2016-04-19 18:53:40'),
(140, 'Coating 01', 139, 278, 285, 1, NULL, 'PankajBhai CSV Pvt Ltd./', NULL, '2016-04-19 18:53:34', '2016-04-19 18:53:35'),
(141, 'STR1', 140, 279, 280, 2, 1, 'PankajBhai CSV Pvt Ltd./', 10, '2016-04-19 18:53:34', '2016-04-19 13:41:44'),
(142, 'SPD1', 140, 281, 282, 2, 2, 'PankajBhai CSV Pvt Ltd./', 11, '2016-04-19 18:53:34', '2016-04-19 13:41:44'),
(143, 'RT1', 140, 283, 284, 2, 1, 'PankajBhai CSV Pvt Ltd./', 12, '2016-04-19 18:53:34', '2016-04-19 13:41:44'),
(144, 'Coating 02', 139, 286, 293, 1, NULL, 'PankajBhai CSV Pvt Ltd./', NULL, '2016-04-19 18:53:35', '2016-04-19 18:53:35'),
(145, 'STR2', 144, 287, 288, 2, 1, 'PankajBhai CSV Pvt Ltd./', 19, '2016-04-19 18:53:35', '2016-04-19 13:41:44'),
(146, 'SPD2', 144, 289, 290, 2, 2, 'PankajBhai CSV Pvt Ltd./', 20, '2016-04-19 18:53:35', '2016-04-19 13:41:44'),
(147, 'RT2', 144, 291, 292, 2, 1, 'PankajBhai CSV Pvt Ltd./', 21, '2016-04-19 18:53:35', '2016-04-19 13:41:44'),
(148, 'Roller 01', 139, 294, 301, 1, NULL, 'PankajBhai CSV Pvt Ltd./', NULL, '2016-04-19 18:53:35', '2016-04-19 18:53:35'),
(149, 'STR3', 148, 295, 296, 2, 1, 'PankajBhai CSV Pvt Ltd./', 28, '2016-04-19 18:53:35', '2016-04-19 13:41:44'),
(150, 'SPD3', 148, 297, 298, 2, 2, 'PankajBhai CSV Pvt Ltd./', 29, '2016-04-19 18:53:35', '2016-04-19 13:41:44'),
(151, 'RT3', 148, 299, 300, 2, 1, 'PankajBhai CSV Pvt Ltd./', 30, '2016-04-19 18:53:35', '2016-04-19 13:41:45'),
(152, 'Roller 02', 139, 302, 309, 1, NULL, 'PankajBhai CSV Pvt Ltd./', NULL, '2016-04-19 18:53:35', '2016-04-19 18:53:36'),
(153, 'STR4', 152, 303, 304, 2, 1, 'PankajBhai CSV Pvt Ltd./', 37, '2016-04-19 18:53:35', '2016-04-19 13:41:45'),
(154, 'SPD4', 152, 305, 306, 2, 2, 'PankajBhai CSV Pvt Ltd./', 38, '2016-04-19 18:53:36', '2016-04-19 13:41:45'),
(155, 'RT4', 152, 307, 308, 2, 1, 'PankajBhai CSV Pvt Ltd./', 39, '2016-04-19 18:53:36', '2016-04-19 13:41:45'),
(156, 'Stenter 05', 139, 310, 317, 1, NULL, 'PankajBhai CSV Pvt Ltd./', NULL, '2016-04-19 18:53:36', '2016-04-19 18:53:36'),
(157, 'STR5', 156, 311, 312, 2, 1, 'PankajBhai CSV Pvt Ltd./', 46, '2016-04-19 18:53:36', '2016-04-19 13:41:45'),
(158, 'SPD5', 156, 313, 314, 2, 2, 'PankajBhai CSV Pvt Ltd./', 47, '2016-04-19 18:53:36', '2016-04-19 13:41:45'),
(159, 'RT5', 156, 315, 316, 2, 1, 'PankajBhai CSV Pvt Ltd./', 48, '2016-04-19 18:53:36', '2016-04-19 13:41:45'),
(160, 'Stenter 06', 139, 318, 325, 1, NULL, 'PankajBhai CSV Pvt Ltd./', NULL, '2016-04-19 18:53:36', '2016-04-19 18:53:36'),
(161, 'STR6', 160, 319, 320, 2, 1, 'PankajBhai CSV Pvt Ltd./', 55, '2016-04-19 18:53:36', '2016-04-19 13:41:45'),
(162, 'SPD6', 160, 321, 322, 2, 2, 'PankajBhai CSV Pvt Ltd./', 56, '2016-04-19 18:53:36', '2016-04-19 13:41:45'),
(163, 'RT6', 160, 323, 324, 2, 1, 'PankajBhai CSV Pvt Ltd./', 57, '2016-04-19 18:53:36', '2016-04-19 13:41:45'),
(164, 'Stenter 07', 139, 326, 333, 1, NULL, 'PankajBhai CSV Pvt Ltd./', NULL, '2016-04-19 18:53:36', '2016-04-19 18:53:37'),
(165, 'STR7', 164, 327, 328, 2, 1, 'PankajBhai CSV Pvt Ltd./', 64, '2016-04-19 18:53:37', '2016-04-19 13:41:45'),
(166, 'SPD7', 164, 329, 330, 2, 2, 'PankajBhai CSV Pvt Ltd./', 65, '2016-04-19 18:53:37', '2016-04-19 13:41:45'),
(167, 'RT7', 164, 331, 332, 2, 1, 'PankajBhai CSV Pvt Ltd./', 66, '2016-04-19 18:53:37', '2016-04-19 13:41:45'),
(168, 'Stenter 08', 139, 334, 341, 1, NULL, 'PankajBhai CSV Pvt Ltd./', NULL, '2016-04-19 18:53:37', '2016-04-19 18:53:37'),
(169, 'STR8', 168, 335, 336, 2, 1, 'PankajBhai CSV Pvt Ltd./', 73, '2016-04-19 18:53:37', '2016-04-19 13:41:45'),
(170, 'SPD8', 168, 337, 338, 2, 2, 'PankajBhai CSV Pvt Ltd./', 74, '2016-04-19 18:53:37', '2016-04-19 13:41:45'),
(171, 'RT8', 168, 339, 340, 2, 1, 'PankajBhai CSV Pvt Ltd./', 75, '2016-04-19 18:53:37', '2016-04-19 13:41:45'),
(172, 'Stenter 09', 139, 342, 349, 1, NULL, 'PankajBhai CSV Pvt Ltd./', NULL, '2016-04-19 18:53:37', '2016-04-19 18:53:37'),
(173, 'STR9', 172, 343, 344, 2, 1, 'PankajBhai CSV Pvt Ltd./', 82, '2016-04-19 18:53:37', '2016-04-19 13:41:45'),
(174, 'SPD9', 172, 345, 346, 2, 2, 'PankajBhai CSV Pvt Ltd./', 83, '2016-04-19 18:53:37', '2016-04-19 13:41:45'),
(175, 'RT9', 172, 347, 348, 2, 1, 'PankajBhai CSV Pvt Ltd./', 84, '2016-04-19 18:53:37', '2016-04-19 13:41:45'),
(176, 'Stenter 10', 139, 350, 357, 1, NULL, 'PankajBhai CSV Pvt Ltd./', NULL, '2016-04-19 18:53:38', '2016-04-19 18:53:38'),
(177, 'STR10', 176, 351, 352, 2, 1, 'PankajBhai CSV Pvt Ltd./', 91, '2016-04-19 18:53:38', '2016-04-19 13:41:45'),
(178, 'SPD10', 176, 353, 354, 2, 2, 'PankajBhai CSV Pvt Ltd./', 92, '2016-04-19 18:53:38', '2016-04-19 13:41:45'),
(179, 'RT10', 176, 355, 356, 2, 1, 'PankajBhai CSV Pvt Ltd./', 93, '2016-04-19 18:53:38', '2016-04-19 13:41:45'),
(180, 'Stenter 11', 139, 358, 365, 1, NULL, 'PankajBhai CSV Pvt Ltd./', NULL, '2016-04-19 18:53:38', '2016-04-19 18:53:38'),
(181, 'STR11', 180, 359, 360, 2, 1, 'PankajBhai CSV Pvt Ltd./', 100, '2016-04-19 18:53:38', '2016-04-19 13:41:45'),
(182, 'SPD11', 180, 361, 362, 2, 2, 'PankajBhai CSV Pvt Ltd./', 101, '2016-04-19 18:53:38', '2016-04-19 13:41:45'),
(183, 'RT11', 180, 363, 364, 2, 1, 'PankajBhai CSV Pvt Ltd./', 102, '2016-04-19 18:53:38', '2016-04-19 13:41:46'),
(184, 'Stenter 12', 139, 366, 373, 1, NULL, 'PankajBhai CSV Pvt Ltd./', NULL, '2016-04-19 18:53:38', '2016-04-19 18:53:39'),
(185, 'STR12', 184, 367, 368, 2, 1, 'PankajBhai CSV Pvt Ltd./', 109, '2016-04-19 18:53:39', '2016-04-19 13:41:46'),
(186, 'SPD12', 184, 369, 370, 2, 2, 'PankajBhai CSV Pvt Ltd./', 110, '2016-04-19 18:53:39', '2016-04-19 13:41:46'),
(187, 'RT12', 184, 371, 372, 2, 1, 'PankajBhai CSV Pvt Ltd./', 111, '2016-04-19 18:53:39', '2016-04-19 13:41:46'),
(188, 'Stenter 13', 139, 374, 381, 1, NULL, 'PankajBhai CSV Pvt Ltd./', NULL, '2016-04-19 18:53:39', '2016-04-19 18:53:39'),
(189, 'STR13', 188, 375, 376, 2, 1, 'PankajBhai CSV Pvt Ltd./', 118, '2016-04-19 18:53:39', '2016-04-19 13:41:46'),
(190, 'SPD13', 188, 377, 378, 2, 2, 'PankajBhai CSV Pvt Ltd./', 119, '2016-04-19 18:53:39', '2016-04-19 13:41:46'),
(191, 'RT13', 188, 379, 380, 2, 1, 'PankajBhai CSV Pvt Ltd./', 120, '2016-04-19 18:53:39', '2016-04-19 13:41:46'),
(192, 'Stenter 14', 139, 382, 389, 1, NULL, 'PankajBhai CSV Pvt Ltd./', NULL, '2016-04-19 18:53:39', '2016-04-19 18:53:40'),
(193, 'STR14', 192, 383, 384, 2, 1, 'PankajBhai CSV Pvt Ltd./', 127, '2016-04-19 18:53:39', '2016-04-19 13:41:46'),
(194, 'SPD14', 192, 385, 386, 2, 2, 'PankajBhai CSV Pvt Ltd./', 128, '2016-04-19 18:53:39', '2016-04-19 13:41:46'),
(195, 'RT14', 192, 387, 388, 2, 1, 'PankajBhai CSV Pvt Ltd./', 129, '2016-04-19 18:53:40', '2016-04-19 13:41:46'),
(196, 'Stenter 15', 139, 390, 397, 1, NULL, 'PankajBhai CSV Pvt Ltd./', NULL, '2016-04-19 18:53:40', '2016-04-19 18:53:40'),
(197, 'STR15', 196, 391, 392, 2, 1, 'PankajBhai CSV Pvt Ltd./', 136, '2016-04-19 18:53:40', '2016-04-19 13:41:46'),
(198, 'SPD15', 196, 393, 394, 2, 2, 'PankajBhai CSV Pvt Ltd./', 137, '2016-04-19 18:53:40', '2016-04-19 13:41:46'),
(199, 'RT15', 196, 395, 396, 2, 1, 'PankajBhai CSV Pvt Ltd./', 138, '2016-04-19 18:53:40', '2016-04-19 13:41:46'),
(200, 'testing 3', NULL, 399, 408, 0, NULL, 'testing 3/', NULL, '2016-04-21 18:07:02', '2016-04-21 18:07:03'),
(201, 'dept1', 200, 400, 407, 1, NULL, 'testing 3/', NULL, '2016-04-21 18:07:03', '2016-04-21 18:07:03'),
(202, 'mac1', 201, 401, 406, 2, NULL, 'testing 3/', NULL, '2016-04-21 18:07:03', '2016-04-21 18:07:03'),
(203, 'test_meter1', 202, 402, 403, 3, NULL, 'testing 3/', NULL, '2016-04-21 18:07:03', '2016-04-21 18:07:03'),
(204, 'test_meter2', 202, 404, 405, 3, NULL, 'testing 3/', NULL, '2016-04-21 18:07:03', '2016-04-21 18:07:03');

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE IF NOT EXISTS `data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `meter_id` int(10) unsigned NOT NULL,
  `parameter_id` int(20) unsigned NOT NULL,
  `value` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `DateTime` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `data_meter_id_foreign` (`meter_id`),
  KEY `parameter_id` (`parameter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_09_08_035159_create_companies_table', 1),
('2015_09_08_041950_create_data_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `parameter_details`
--

CREATE TABLE IF NOT EXISTS `parameter_details` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `parameter_name` varchar(255) NOT NULL,
  `associated_graph` varchar(30) NOT NULL,
  `unit` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `parameter_details`
--

INSERT INTO `parameter_details` (`id`, `parameter_name`, `associated_graph`, `unit`) VALUES
(1, 'Production', 'bar', 'units'),
(2, 'Speed', 'linear', 'units/min'),
(3, 'Real-Time', 'bar', 'seconds');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `asso_id` int(30) unsigned NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `asso_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'demo', 'demo@demo.com', '$2y$10$cJvsjnFNHwtn86kKAr.XYOHsNiCef42IM./ZDwiF9r1S/CSP/Skfm', 16, 'PeJ2qWgQ0ddvCe9XBwVZe3xzpYph9Nj8tnoI8fX3CRLzz45DvA1v4mu3AIdq', '2015-09-14 05:07:31', '2015-10-29 03:14:30');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
