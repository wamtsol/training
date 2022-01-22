-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 22, 2022 at 04:22 PM
-- Server version: 5.7.24
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `training`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_type_id` int(11) NOT NULL,
  `linked_user` int(11) DEFAULT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_type_id`, `linked_user`, `username`, `email`, `name`, `password`, `status`, `ts`) VALUES
(1, 1, 5, 'admin', 'vickyali2@hotmail.com', 'Admin', 'admin', 1, '2022-01-12 11:52:28'),
(29, 6, 0, 'hassan', 'hassan@test.com', 'Hassan', '1122', 1, '2022-01-22 15:56:54'),
(30, 4, 0, 'new', 'tajmal-hassan@hotmail.com', 'Majeed Dhamrah', 'new', 1, '2022-01-22 15:57:01');

-- --------------------------------------------------------

--
-- Table structure for table `admin_type`
--

CREATE TABLE `admin_type` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `can_add` int(1) NOT NULL DEFAULT '0',
  `can_edit` int(1) NOT NULL DEFAULT '0',
  `can_delete` int(1) NOT NULL DEFAULT '0',
  `can_read` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `ts` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_type`
--

INSERT INTO `admin_type` (`id`, `title`, `can_add`, `can_edit`, `can_delete`, `can_read`, `status`, `ts`) VALUES
(1, 'Administrator', 1, 1, 1, 1, 1, '2017-02-27 12:10:38'),
(3, 'Center Incharge', 0, 0, 0, 1, 1, '2022-01-12 11:15:25'),
(4, 'Trainer Livestock', 0, 0, 0, 0, 1, '2022-01-22 14:33:47'),
(5, 'Administrator1', 0, 0, 0, 1, 1, '2022-01-12 12:24:32'),
(6, 'Trainer Fisheries', 0, 0, 0, 0, 1, '2022-01-22 14:34:03');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `center_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `center_id`, `user_id`, `date`, `ts`) VALUES
(1, 1, 5, '2022-01-10', '2022-01-12 13:15:24'),
(2, 1, 5, '2022-01-11', '2022-01-12 13:16:49'),
(3, 1, 5, '2022-01-12', '2022-01-12 13:37:02'),
(4, 2, 5, '2022-01-10', '2022-01-12 23:18:53'),
(5, 2, 5, '2022-01-11', '2022-01-12 23:19:08'),
(6, 2, 5, '2022-01-12', '2022-01-12 23:19:43'),
(9, 4, 7, '2022-01-12', '2022-01-13 03:37:51'),
(10, 4, 7, '2022-01-13', '2022-01-13 03:43:20');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_records`
--

CREATE TABLE `attendance_records` (
  `attendance_id` int(11) DEFAULT NULL,
  `trainee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance_records`
--

INSERT INTO `attendance_records` (`attendance_id`, `trainee_id`) VALUES
(1, 8),
(2, 8),
(2, 7),
(4, 9),
(4, 10),
(5, 10),
(9, 11),
(9, 12),
(10, 12);

-- --------------------------------------------------------

--
-- Table structure for table `centers`
--

CREATE TABLE `centers` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `center` varchar(50) NOT NULL,
  `incharge_user_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `centers`
--

INSERT INTO `centers` (`id`, `project_id`, `district_id`, `center`, `incharge_user_id`, `start_date`, `end_date`, `status`, `ts`) VALUES
(1, 1, 1, 'call center', 5, '2021-09-01', '2022-01-31', 1, '2022-01-15 01:49:43'),
(2, 1, 2, 'Cant Center 1', 0, '2022-01-13', '2022-01-17', 1, '2022-01-17 09:54:55'),
(4, 4, 1, 'Masu Bhurgri', 0, '2022-01-17', '2022-01-18', 1, '2022-01-17 11:40:23');

-- --------------------------------------------------------

--
-- Table structure for table `config_type`
--

CREATE TABLE `config_type` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `sortorder` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `config_type`
--

INSERT INTO `config_type` (`id`, `title`, `sortorder`) VALUES
(1, 'General Settings', 1),
(9, 'Invoice Setting', 2);

-- --------------------------------------------------------

--
-- Table structure for table `config_variable`
--

CREATE TABLE `config_variable` (
  `id` int(11) NOT NULL,
  `config_type_id` int(11) NOT NULL,
  `title` varchar(512) NOT NULL,
  `notes` varchar(512) NOT NULL,
  `type` varchar(200) NOT NULL,
  `default_values` text NOT NULL,
  `key` varchar(200) NOT NULL,
  `value` text NOT NULL,
  `sortorder` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `config_variable`
--

INSERT INTO `config_variable` (`id`, `config_type_id`, `title`, `notes`, `type`, `default_values`, `key`, `value`, `sortorder`) VALUES
(1, 1, 'Site URL', '', 'text', '', 'site_url', 'http://localhost/training', 2),
(2, 1, 'Site Title', '', 'text', '', 'site_title', 'Training', 1),
(3, 1, 'Admin Logo', '', 'file', '', 'admin_logo', '', 4),
(10, 1, 'Currency Symbol', '', 'text', '', 'currency_symbol', 'Rs', 5),
(7, 1, 'Admin Email', 'Main Email Address where all the notifications will be sent.', 'text', '', 'admin_email', '', 3),
(18, 1, 'Address/Phone', '', 'editor', '', 'address_phone', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', 6),
(19, 1, 'Header', '', 'editor', '', 'fees_chalan_header', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', 7),
(21, 9, 'Supplier Detail', '', 'editor', '', 'supplier_detail', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', 8),
(22, 1, 'Customer ID', '', 'text', '', 'customer_id', '3', 9);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `admin_type_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `title`, `admin_type_id`, `status`, `ts`) VALUES
(2, 'Fisheries wing', 0, 1, '2022-01-12 13:01:07'),
(4, 'Livestock wing', 4, 1, '2022-01-22 14:31:31'),
(5, 'new2', 6, 1, '2022-01-22 16:12:57');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `title`, `status`, `ts`) VALUES
(1, 'Project Director BBSHRRDB', 1, '2022-01-12 14:20:44'),
(2, 'Deputy Project Director Livestock', 1, '2022-01-12 14:13:51'),
(3, 'Deputy Project Director Fisheries', 1, '2022-01-12 14:14:11'),
(4, 'Assistant Director Livestock', 1, '2022-01-12 14:14:33'),
(5, 'Assistant Director Fisheries', 1, '2022-01-12 14:14:51'),
(6, 'Accounts Officer', 1, '2022-01-12 14:15:08'),
(7, 'Incharge IT Livestock', 1, '2022-01-12 14:15:31'),
(8, 'Incharge IT Fisheries', 1, '2022-01-12 14:15:49'),
(9, 'Trainer Fisheries', 1, '2022-01-12 14:18:02'),
(10, 'Trainer Livestock', 1, '2022-01-12 14:18:15'),
(11, 'Assistant Trainer Fisheries', 1, '2022-01-12 14:18:31'),
(12, 'Assistant Trainer Livestock', 1, '2022-01-12 14:18:44'),
(13, 'Training Coordinator Fisheries', 1, '2022-01-12 14:19:03');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `status`, `ts`) VALUES
(1, 'Hyderabad', 1, '2022-01-12 13:13:26'),
(2, 'Larkana', 1, '2022-01-10 16:07:21'),
(3, 'Dadu', 1, '2022-01-12 13:31:18'),
(4, 'Ghotki', 1, '2022-01-12 13:31:29'),
(5, 'Khairpur Mirs', 1, '2022-01-12 13:32:05'),
(6, 'Thatta', 1, '2022-01-12 13:32:12'),
(7, 'Shaheed Benazirabad', 1, '2022-01-12 13:32:27'),
(8, 'Sanghar', 1, '2022-01-12 13:32:38'),
(9, 'Tando Muhammad Khan', 1, '2022-01-12 13:32:50'),
(10, 'Matyari', 1, '2022-01-12 13:33:01'),
(11, 'Jamshoro', 1, '2022-01-12 13:33:12'),
(12, 'Sukkur', 1, '2022-01-12 13:33:22'),
(13, 'Badin', 1, '2022-01-12 13:33:32'),
(14, 'Sujjawal', 1, '2022-01-12 13:33:43'),
(15, 'Naushro Feroze', 1, '2022-01-12 13:34:27'),
(16, 'FTC Chillya Thatta', 1, '2022-01-12 13:35:34'),
(17, 'FTC Keenjhar Lake', 1, '2022-01-12 13:35:50'),
(18, 'Shikarpur', 1, '2022-01-12 13:36:01'),
(19, 'FTC Badin', 1, '2022-01-12 13:36:14'),
(20, 'FTC Dokri Larkana', 1, '2022-01-12 13:36:31'),
(21, 'FTC Mando Dero Sukkur', 1, '2022-01-12 13:36:44');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `depth` int(1) NOT NULL,
  `sortorder` int(11) DEFAULT NULL,
  `icon` varchar(200) DEFAULT NULL,
  `small_icon` varchar(200) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `title`, `url`, `parent_id`, `depth`, `sortorder`, `icon`, `small_icon`) VALUES
(1, 'Dashboard', '#', 0, 0, 1, 'dashboard.png', 'home'),
(68, 'Training', '#', 0, 0, 6, 'training.jpg', 'magnet'),
(69, 'Departments', 'departments_manage.php', 68, 1, 8, 'departments.png', 'circle'),
(8, 'Manage Users', 'admin_manage.php', 1, 1, 4, 'administrator.png', 'user'),
(7, 'General Settings', 'config_manage.php?config_id=1', 1, 1, 2, 'general-settings.png', 'cog'),
(12, 'Upload Center', 'upload_manage.php', 1, 1, 3, 'upload-center.png', 'file-o'),
(26, 'Manage User Types', 'admin_type_manage.php', 1, 1, 5, 'admin-type.png', 'unlock-alt'),
(32, 'Users', 'users_manage.php', 68, 1, 13, 'transaction.png', 'money'),
(73, 'Centers', 'centers_manage.php', 68, 1, 11, 'centers.png', 'columns'),
(70, 'Districts', 'districts_manage.php', 68, 1, 9, 'districts.png', 'exchange'),
(71, 'Projects', 'projects_manage.php', 68, 1, 10, 'projects.png', 'empire'),
(83, 'Designations', 'designations_manage.php', 68, 1, 12, 'designations.png', 'magnet'),
(88, 'Trainees', 'trainees_manage.php', 68, 1, 1, 'trainees.png', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `menu_2_admin_type`
--

CREATE TABLE `menu_2_admin_type` (
  `menu_id` int(11) NOT NULL,
  `admin_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_2_admin_type`
--

INSERT INTO `menu_2_admin_type` (`menu_id`, `admin_type_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(4, 3),
(4, 4),
(5, 1),
(5, 3),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(12, 1),
(14, 1),
(14, 3),
(15, 1),
(15, 3),
(16, 1),
(16, 3),
(17, 1),
(17, 3),
(18, 1),
(18, 3),
(19, 1),
(20, 1),
(21, 1),
(21, 3),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(27, 3),
(28, 1),
(29, 1),
(29, 3),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(33, 3),
(34, 1),
(34, 3),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(41, 3),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(58, 3),
(59, 1),
(59, 3),
(60, 1),
(60, 3),
(61, 1),
(61, 3),
(62, 1),
(62, 3),
(63, 1),
(63, 3),
(64, 1),
(64, 3),
(65, 1),
(65, 3),
(66, 1),
(66, 3),
(67, 1),
(67, 3),
(68, 1),
(68, 4),
(68, 6),
(69, 1),
(70, 1),
(71, 1),
(71, 4),
(71, 6),
(72, 1),
(73, 1),
(73, 4),
(73, 6),
(74, 1),
(74, 3),
(75, 1),
(76, 1),
(76, 3),
(77, 1),
(78, 1),
(78, 3),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(87, 3),
(88, 1),
(88, 4),
(88, 6);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `duration` varchar(50) DEFAULT NULL,
  `total_batches` int(20) DEFAULT NULL,
  `min_qualification` varchar(300) DEFAULT NULL,
  `total_no_of_trainees` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `department_id`, `title`, `status`, `ts`, `duration`, `total_batches`, `min_qualification`, `total_no_of_trainees`) VALUES
(1, 2, 'Fish Farming Extension Technology', 1, '2022-01-22 13:39:55', NULL, 5, '4', 100),
(4, 4, 'Livestock Community Health Worker', 1, '2022-01-12 12:27:01', NULL, NULL, NULL, NULL),
(5, 2, 'Integrated Fish Farming', 1, '2022-01-12 13:17:02', NULL, NULL, NULL, NULL),
(6, 2, 'Integrated Fish Farming Female', 1, '2022-01-12 13:17:31', NULL, NULL, NULL, NULL),
(7, 2, 'Aqua Ponic Fish Farming', 1, '2022-01-13 03:59:58', '1', 6, 'Fish Rearing', 150),
(8, 2, 'Hatchery Technician & Management', 1, '2022-01-12 13:18:12', NULL, NULL, NULL, NULL),
(9, 2, 'Fish Farming in Cages', 1, '2022-01-12 13:18:27', NULL, NULL, NULL, NULL),
(10, 2, 'Bioflock Fish Farming', 1, '2022-01-12 13:18:45', NULL, NULL, NULL, NULL),
(11, 2, 'Mud Crab Fattening', 1, '2022-01-12 13:19:00', NULL, NULL, NULL, NULL),
(12, 2, 'Fish Nursing & Culture Technology', 1, '2022-01-12 13:19:17', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trainees`
--

CREATE TABLE `trainees` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `father_name` varchar(50) DEFAULT NULL,
  `gender` int(1) DEFAULT NULL,
  `cnic` varchar(16) DEFAULT NULL,
  `cnic_photo_front` varchar(50) DEFAULT NULL,
  `cnic_photo_back` varchar(50) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `cnic_issue_date` date DEFAULT NULL,
  `contact` varchar(20) NOT NULL,
  `address1` varchar(220) NOT NULL,
  `address` varchar(220) NOT NULL,
  `trainee_status_id` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trainees`
--

INSERT INTO `trainees` (`id`, `name`, `father_name`, `gender`, `cnic`, `cnic_photo_front`, `cnic_photo_back`, `birth_date`, `cnic_issue_date`, `contact`, `address1`, `address`, `trainee_status_id`, `status`, `ts`) VALUES
(1, 'Raheel', NULL, 0, '41304-2094017-5', NULL, NULL, '2021-12-01', NULL, '', '', '', 0, 1, '2022-01-11 12:27:35'),
(2, 'Raheel', NULL, 0, '41304-2094017-5', NULL, NULL, '2022-01-12', NULL, '', '', '', 0, 1, '2022-01-12 00:51:08'),
(3, 'Hassan', NULL, 0, '41304-2094017-5', NULL, NULL, '2022-01-12', NULL, '', '', '', 0, 1, '2022-01-11 22:35:24'),
(4, 'Ali', NULL, 0, '', NULL, NULL, '2022-01-12', NULL, '', '', '', 0, 1, '2022-01-12 12:04:05'),
(5, 'Raheel', NULL, 0, '', NULL, NULL, '2022-01-12', NULL, '', '', '', 0, 1, '2022-01-12 12:08:27'),
(6, 'Tajamul Hassan', NULL, 0, '', NULL, NULL, '2022-01-12', NULL, '', '', '', 0, 1, '2022-01-12 12:12:48'),
(7, 'Raheel', 'Sami', 0, '41304-2091017-5', NULL, NULL, '1995-01-12', '2000-01-14', '3234324999', 'addrrr', 'Qazi Ahmed', 2, 1, '2022-01-21 13:07:41'),
(8, 'Hassan', 'Ali', 0, '23123-1324234-3', NULL, NULL, '1995-01-12', '2022-01-22', '3234324999', '', 'latifabad', 0, 1, '2022-01-21 13:07:35'),
(9, 'Bilal', '', 0, '41304-2094017-5', NULL, NULL, '2002-01-12', '2022-01-02', '', '', '', 2, 1, '2022-01-14 23:09:01'),
(10, 'Tariq', NULL, 0, '', NULL, NULL, '2022-01-12', NULL, '', '', '', 0, 1, '2022-01-12 12:09:38'),
(11, 'Muhammad Ali', 'Muhammad Tufail', 0, '41304-2094017-5', NULL, NULL, '2001-01-12', '2022-01-01', '32323444', '', '', 1, 1, '2022-01-17 11:17:55'),
(12, 'Faraz', NULL, 0, '', NULL, NULL, '2022-01-13', NULL, '', '', '', 0, 1, '2022-01-13 03:15:11'),
(13, 'Ali', 'raheem', 0, '34435-4354577-6', NULL, NULL, '1995-01-17', '2022-01-17', '3234324999', 'latifabad no 7 hyderabad mazar wali gali', 'hassan@gmail.com', 1, 1, '2022-01-22 12:00:51'),
(14, 'new', 'father', 0, '34435-4354567-6', NULL, NULL, '1995-01-21', '2022-01-21', '3234324999', 'addrrr', 'crseee', 2, 1, '2022-01-21 12:39:54'),
(15, 'admin', 'father', 0, '22323-3243453-4', NULL, NULL, '1995-01-21', '2022-01-21', '3234324999', 'addrrr', 'latifabad', 1, 1, '2022-01-21 12:54:59'),
(16, 'admin', 'raheem', 0, '34435-4374567-6', NULL, NULL, '1995-01-22', '2022-01-22', '3234324999', 'addrrr', 'latifabad', 4, 1, '2022-01-22 08:54:54');

-- --------------------------------------------------------

--
-- Table structure for table `trainees_2_center`
--

CREATE TABLE `trainees_2_center` (
  `trainee_id` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trainees_2_center`
--

INSERT INTO `trainees_2_center` (`trainee_id`, `center_id`) VALUES
(10, 2),
(12, 4),
(9, 2),
(11, 4),
(14, 2),
(15, 2),
(13, 1),
(8, 1),
(7, 1),
(16, 2);

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `filename` varchar(200) NOT NULL,
  `filelocation` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `filename`, `filelocation`) VALUES
(1, 'my file', 'my-file.xlsx');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `gender` int(1) DEFAULT NULL,
  `cnic` varchar(16) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `releaving_date` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `designation_id`, `name`, `gender`, `cnic`, `appointment_date`, `releaving_date`, `status`, `ts`) VALUES
(5, 2, 'Dr. Faroque Ahmed Memon', 0, '41304-2094017-5', '2022-01-05', NULL, 1, '2022-01-12 14:16:43'),
(6, 6, 'Mr. Tajamul Hassan Memon', 0, '41303-3619576-9', '1970-01-01', NULL, 1, '2022-01-12 14:22:39'),
(7, 1, 'Dr. Majeed Hakeem Dhamrah', 0, '', '2022-01-12', NULL, 1, '2022-01-12 14:43:34'),
(8, 4, 'Dr. Murk Pirzada', 1, '', '2022-01-12', NULL, 1, '2022-01-12 14:20:06'),
(9, 5, 'Mr. Makhdom Muhammad Hussain', 0, '', '2022-01-12', NULL, 1, '2022-01-12 14:21:35'),
(10, 13, 'Mr. Adnan Ali Pirzada', 0, '', '2022-01-12', NULL, 1, '2022-01-12 14:22:27'),
(11, 13, 'Mr. Naveed Ali Jokhio', 0, '', '2022-01-12', NULL, 1, '2022-01-12 14:22:15');

-- --------------------------------------------------------

--
-- Table structure for table `users_2_center`
--

CREATE TABLE `users_2_center` (
  `user_id` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_2_center`
--

INSERT INTO `users_2_center` (`user_id`, `center_id`) VALUES
(5, 1),
(7, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_type`
--
ALTER TABLE `admin_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `centers`
--
ALTER TABLE `centers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config_type`
--
ALTER TABLE `config_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config_variable`
--
ALTER TABLE `config_variable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_2_admin_type`
--
ALTER TABLE `menu_2_admin_type`
  ADD PRIMARY KEY (`menu_id`,`admin_type_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainees`
--
ALTER TABLE `trainees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `admin_type`
--
ALTER TABLE `admin_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `centers`
--
ALTER TABLE `centers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `config_type`
--
ALTER TABLE `config_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `config_variable`
--
ALTER TABLE `config_variable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `trainees`
--
ALTER TABLE `trainees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
