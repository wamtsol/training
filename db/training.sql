-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 10, 2022 at 04:47 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `monthly_salary` decimal(10,2) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_type_id`, `username`, `email`, `name`, `monthly_salary`, `password`, `status`, `ts`) VALUES
(1, 1, 'admin', 'vickyali2@hotmail.com', 'Admin', '0.00', 'admin', 1, '2022-01-10 15:16:45'),
(28, 3, 'FARHAN', 'mburhan2030@gmail.com', 'FARHAN', '0.00', 'dawood123', 1, '2022-01-05 11:49:37');

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
(3, 'FARHAN', 0, 0, 0, 1, 1, '2022-01-01 11:57:35');

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
  `status` int(1) NOT NULL DEFAULT '1',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `status` int(1) NOT NULL DEFAULT '1',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `title`, `status`, `ts`) VALUES
(2, 'Home', 1, '2022-01-10 15:59:12');

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
(1, 'Hyderabad', 1, '2022-01-10 16:06:55'),
(2, 'Larkana', 1, '2022-01-10 16:07:21');

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
  `sortorder` int(11) NOT NULL,
  `icon` varchar(200) NOT NULL,
  `small_icon` varchar(200) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `title`, `url`, `parent_id`, `depth`, `sortorder`, `icon`, `small_icon`) VALUES
(1, 'Dashboard', '#', 0, 0, 1, 'dashboard.png', 'home'),
(68, 'Bangles Setting', '#', 0, 0, 6, 'bengles.jpg', 'magnet'),
(69, 'Color', 'color_manage.php', 68, 1, 7, 'color.png', 'circle'),
(8, 'Manage Users', 'admin_manage.php', 1, 1, 4, 'administrator.png', 'user'),
(7, 'General Settings', 'config_manage.php?config_id=1', 1, 1, 2, 'general-settings.png', 'cog'),
(12, 'Upload Center', 'upload_manage.php', 1, 1, 3, 'upload-center.png', 'file-o'),
(22, 'Reports', '#', 0, 0, 24, 'reports.png', 'line-chart'),
(24, 'General Journal', 'report_manage.php?tab=general_journal', 22, 1, 23, 'general-journal.png', 'th-large'),
(26, 'Manage User Types', 'admin_type_manage.php', 1, 1, 5, 'admin-type.png', 'unlock-alt'),
(30, 'Accounts', '#', 0, 0, 19, 'accounts.jpg', 'suitcase'),
(28, 'Manage Expenses', 'expense_manage.php', 30, 1, 14, 'manage-expense.png', 'car'),
(32, 'Manage Transactions', 'transaction_manage.php', 30, 1, 21, 'transaction.png', 'money'),
(35, 'Manage Accounts', 'account_manage.php', 30, 1, 10, 'manage-accounts.png', 'balance-scale'),
(40, 'Expense Category', 'expense_category_manage.php', 30, 1, 13, 'expense-category.png', 'server'),
(74, 'Incoming', 'incoming_manage.php', 78, 1, 13, 'incoming.png', 'rub'),
(75, 'Washing', 'washing_manage.php', 78, 1, 14, 'washing.png', 'eraser'),
(76, 'Delivery', 'delivery_manage.php', 78, 1, 15, 'delivery.png', 'yelp'),
(53, 'Balance Sheet', 'report_manage.php?tab=balance_sheet', 22, 1, 24, 'balance-sheet.png', '500px'),
(54, 'Income Report', 'report_manage.php?tab=income', 22, 1, 25, 'income-report.png', 'backward'),
(73, 'Labour', 'labour_manage.php', 68, 1, 12, 'labour.png', 'male'),
(70, 'Size', 'size_manage.php', 68, 1, 8, 'size.png', 'exchange'),
(71, 'Design', 'design_manage.php', 68, 1, 9, 'design.png', 'empire'),
(72, 'Customer', 'customer_manage.php', 30, 1, 11, 'customer.png', 'male'),
(77, 'Customer Payment', 'customer_payment_manage.php', 30, 1, 12, 'customer-payment.png', 'random'),
(78, 'Bangles Manufacturing', '#', 0, 0, 7, 'bengles-manufacturing.jpg', 'map-signs'),
(79, 'Employees', '#', 0, 0, 18, 'employees.png', 'male'),
(80, 'Manage Employee', 'employee_manage.php', 79, 1, 27, 'manage-employee.png', 'user'),
(84, 'Employee Payment', 'employee_payment_manage.php', 79, 1, 30, 'employee-payment.png', 'archive'),
(82, 'Stock Report', 'report_manage.php?tab=stock_report', 22, 1, 28, 'stock-report.png', 'cogs'),
(83, 'Machine', 'machine_manage.php', 68, 1, 30, 'machine.png', 'magnet'),
(85, 'Employee Salary', 'employee_salary_manage.php', 79, 1, 31, 'employee-salary.png', 'anchor'),
(86, 'Manage Invoice', 'invoice_manage.php', 30, 1, 32, 'manage-invoice.png', 'balance-scale'),
(87, 'Stock Report New', 'report_manage.php?tab=stock_total', 22, 1, 33, 'stock-report-new.png', 'android');

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
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
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
(87, 3);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `department_id`, `title`, `status`, `ts`) VALUES
(1, 2, 'Project 1', 1, '2022-01-10 16:42:32');

-- --------------------------------------------------------

--
-- Table structure for table `trainees`
--

CREATE TABLE `trainees` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` int(1) DEFAULT NULL,
  `cnic` varchar(16) DEFAULT NULL,
  `cnic_photo_front` varchar(50) DEFAULT NULL,
  `cnic_photo_back` varchar(50) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `cnic_photo_front` varchar(50) DEFAULT NULL,
  `cnic_photo_back` varchar(50) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `admin_type`
--
ALTER TABLE `admin_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `centers`
--
ALTER TABLE `centers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trainees`
--
ALTER TABLE `trainees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
