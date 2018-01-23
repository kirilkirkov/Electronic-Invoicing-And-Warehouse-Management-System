-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 17, 2018 at 10:32 AM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 7.0.27-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `in_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(80) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `registered` int(11) NOT NULL,
  `last_login` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `name`, `username`, `password`, `email`, `image`, `registered`, `last_login`) VALUES
(1, 'Kiril Kirkov', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.admin', '16427489_1341882885869514_8248047917573720528_n2.jpg', 0, 1505722170);

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `time` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `image`, `url`, `tags`, `time`) VALUES
(1, NULL, 'Api-for-invoices-manage_1', 'api,create invoices api', 1492518797),
(2, NULL, 'ImportExport_2', 'import,export,accounting', 1492590359);

-- --------------------------------------------------------

--
-- Table structure for table `blog_translates`
--

CREATE TABLE `blog_translates` (
  `id` int(11) NOT NULL,
  `for_id` int(10) UNSIGNED NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog_translates`
--

INSERT INTO `blog_translates` (`id`, `for_id`, `abbr`, `title`, `description`) VALUES
(1, 1, 'en', 'Api for invoices manage', '<p>&nbsp;Soon we will launch a new feature allowing management of invoices by api</p>\r\n'),
(2, 2, 'en', 'Import/Export', '<p>We will soon make it possible to import and export to most used accounting programs</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL,
  `for_company` int(10) UNSIGNED NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_bulstat` varchar(50) NOT NULL,
  `is_to_person` tinyint(1) NOT NULL,
  `client_vat_registered` tinyint(1) NOT NULL,
  `vat_number` varchar(50) NOT NULL,
  `client_ident_num` varchar(50) NOT NULL,
  `client_address` varchar(500) NOT NULL,
  `client_city` varchar(80) NOT NULL,
  `client_country` varchar(80) NOT NULL,
  `accountable_person` varchar(200) NOT NULL COMMENT 'MOL',
  `recipient_name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `for_user`, `for_company`, `client_name`, `client_bulstat`, `is_to_person`, `client_vat_registered`, `vat_number`, `client_ident_num`, `client_address`, `client_city`, `client_country`, `accountable_person`, `recipient_name`) VALUES
(3, 1, 1, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'Кирил Пламенов'),
(4, 1, 1, 'Радин Недков', '', 1, 0, '', '918278237', 'ул. Незабравка', 'Пловдив', 'България', '', 'Радин Недков'),
(17, 3, 3, 'Findo Max', '', 1, 0, '', '810292392329', 'Mladost 3', 'Sofia', 'Bulgaria', '', ''),
(18, 4, 4, 'asd', 'asd', 0, 0, '', '', 'asd', 'asd', 'asd', 'asd', 'asd'),
(20, 6, 7, 'dqwdqw', 'dqwdqw', 0, 0, '', '', 'dqwdqw', '', '', '', ''),
(21, 1, 1, 'Радин Недков', '', 1, 0, '', '918278237', 'ул. Незабравка', 'Пловдив', 'България', '', 'Радин Недков'),
(22, 1, 1, 'Радин Недков', '', 1, 0, '', '918278237', 'ул. Незабравка', 'Пловдив', 'България', '', 'Радин Недков'),
(23, 1, 1, 'Радин Недков', '', 1, 0, '', '918278237', 'ул. Незабравка', 'Пловдив', 'България', '', 'Радин Недков'),
(24, 1, 1, 'Радин Недков', '', 1, 0, '', '918278237', 'ул. Незабравка', 'Пловдив', 'България', '', 'Радин Недков');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `value` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `value`, `name`) VALUES
(1, 'ALL', 'Albania Lek'),
(2, 'AFN', 'Afghanistan Afghani'),
(3, 'ARS', 'Argentina Peso'),
(4, 'AWG', 'Aruba Guilder'),
(5, 'AUD', 'Australia Dollar'),
(6, 'AZN', 'Azerbaijan New Manat'),
(7, 'BSD', 'Bahamas Dollar'),
(8, 'BBD', 'Barbados Dollar'),
(9, 'BDT', 'Bangladeshi taka'),
(10, 'BYR', 'Belarus Ruble'),
(11, 'BZD', 'Belize Dollar'),
(12, 'BMD', 'Bermuda Dollar'),
(13, 'BOB', 'Bolivia Boliviano'),
(14, 'BAM', 'Bosnia and Herzegovina Convertible Marka'),
(15, 'BWP', 'Botswana Pula'),
(16, 'BGN', 'Bulgaria Lev'),
(17, 'BRL', 'Brazil Real'),
(18, 'BND', 'Brunei Darussalam Dollar'),
(19, 'KHR', 'Cambodia Riel'),
(20, 'CAD', 'Canada Dollar'),
(21, 'KYD', 'Cayman Islands Dollar'),
(22, 'CLP', 'Chile Peso'),
(23, 'CNY', 'China Yuan Renminbi'),
(24, 'COP', 'Colombia Peso'),
(25, 'CRC', 'Costa Rica Colon'),
(26, 'HRK', 'Croatia Kuna'),
(27, 'CUP', 'Cuba Peso'),
(28, 'CZK', 'Czech Republic Koruna'),
(29, 'DKK', 'Denmark Krone'),
(30, 'DOP', 'Dominican Republic Peso'),
(31, 'XCD', 'East Caribbean Dollar'),
(32, 'EGP', 'Egypt Pound'),
(33, 'SVC', 'El Salvador Colon'),
(34, 'EEK', 'Estonia Kroon'),
(35, 'EUR', 'Euro Member Countries'),
(36, 'FKP', 'Falkland Islands (Malvinas) Pound'),
(37, 'FJD', 'Fiji Dollar'),
(38, 'GHC', 'Ghana Cedis'),
(39, 'GIP', 'Gibraltar Pound'),
(40, 'GTQ', 'Guatemala Quetzal'),
(41, 'GGP', 'Guernsey Pound'),
(42, 'GYD', 'Guyana Dollar'),
(43, 'HNL', 'Honduras Lempira'),
(44, 'HKD', 'Hong Kong Dollar'),
(45, 'HUF', 'Hungary Forint'),
(46, 'ISK', 'Iceland Krona'),
(47, 'INR', 'India Rupee'),
(48, 'IDR', 'Indonesia Rupiah'),
(49, 'IRR', 'Iran Rial'),
(50, 'IMP', 'Isle of Man Pound'),
(51, 'ILS', 'Israel Shekel'),
(52, 'JMD', 'Jamaica Dollar'),
(53, 'JPY', 'Japan Yen'),
(54, 'JEP', 'Jersey Pound'),
(55, 'KZT', 'Kazakhstan Tenge'),
(56, 'KPW', 'Korea (North) Won'),
(57, 'KRW', 'Korea (South) Won'),
(58, 'KGS', 'Kyrgyzstan Som'),
(59, 'LAK', 'Laos Kip'),
(60, 'LVL', 'Latvia Lat'),
(61, 'LBP', 'Lebanon Pound'),
(62, 'LRD', 'Liberia Dollar'),
(63, 'LTL', 'Lithuania Litas'),
(64, 'MKD', 'Macedonia Denar'),
(65, 'MYR', 'Malaysia Ringgit'),
(66, 'MUR', 'Mauritius Rupee'),
(67, 'MXN', 'Mexico Peso'),
(68, 'MNT', 'Mongolia Tughrik'),
(69, 'MZN', 'Mozambique Metical'),
(70, 'NAD', 'Namibia Dollar'),
(71, 'NPR', 'Nepal Rupee'),
(72, 'ANG', 'Netherlands Antilles Guilder'),
(73, 'NZD', 'New Zealand Dollar'),
(74, 'NIO', 'Nicaragua Cordoba'),
(75, 'NGN', 'Nigeria Naira'),
(76, 'NOK', 'Norway Krone'),
(77, 'OMR', 'Oman Rial'),
(78, 'PKR', 'Pakistan Rupee'),
(79, 'PAB', 'Panama Balboa'),
(80, 'PYG', 'Paraguay Guarani'),
(81, 'PEN', 'Peru Nuevo Sol'),
(82, 'PHP', 'Philippines Peso'),
(83, 'PLN', 'Poland Zloty'),
(84, 'QAR', 'Qatar Riyal'),
(85, 'RON', 'Romania New Leu'),
(86, 'RUB', 'Russia Ruble'),
(87, 'SHP', 'Saint Helena Pound'),
(88, 'SAR', 'Saudi Arabia Riyal'),
(89, 'RSD', 'Serbia Dinar'),
(90, 'SCR', 'Seychelles Rupee'),
(91, 'SGD', 'Singapore Dollar'),
(92, 'SBD', 'Solomon Islands Dollar'),
(93, 'SOS', 'Somalia Shilling'),
(94, 'ZAR', 'South Africa Rand'),
(95, 'LKR', 'Sri Lanka Rupee'),
(96, 'SEK', 'Sweden Krona'),
(97, 'CHF', 'Switzerland Franc'),
(98, 'SRD', 'Suriname Dollar'),
(99, 'SYP', 'Syria Pound'),
(100, 'TWD', 'Taiwan New Dollar'),
(101, 'THB', 'Thailand Baht'),
(102, 'TTD', 'Trinidad and Tobago Dollar'),
(103, 'TRY', 'Turkey Lira'),
(104, 'TRL', 'Turkey Lira'),
(105, 'TVD', 'Tuvalu Dollar'),
(106, 'UAH', 'Ukraine Hryvna'),
(107, 'GBP', 'United Kingdom Pound'),
(108, 'USD', 'United States Dollar'),
(109, 'UYU', 'Uruguay Peso'),
(110, 'UZS', 'Uzbekistan Som'),
(111, 'VEF', 'Venezuela Bolivar'),
(112, 'VND', 'Viet Nam Dong'),
(113, 'YER', 'Yemen Rial'),
(114, 'ZWD', 'Zimbabwe Dollar');

-- --------------------------------------------------------

--
-- Table structure for table `cusom_plan_requests`
--

CREATE TABLE `cusom_plan_requests` (
  `id` int(11) NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL,
  `invoices` int(10) UNSIGNED NOT NULL,
  `companies` int(10) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL COMMENT '0new, 1rejected, 2added_to_individual_plans',
  `time` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cusom_plan_requests`
--

INSERT INTO `cusom_plan_requests` (`id`, `for_user`, `invoices`, `companies`, `status`, `time`) VALUES
(1, 1, 20, 30, 2, 1504012706),
(2, 1, 32, 32, 2, 1504013500),
(3, 1, 32, 32, 2, 1504013539),
(4, 1, 23, 32, 2, 1504076335),
(5, 1, 20, 30, 1, 1504077155),
(6, 1, 40, 50, 2, 1504077661),
(7, 1, 20, 30, 2, 1504079197),
(8, 1, 40, 50, 1, 1504079783),
(9, 1, 60, 70, 2, 1504079789),
(10, 1, 10, 20, 2, 1504082235),
(11, 1, 32, 3, 0, 1504871257);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL,
  `email` varchar(250) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `schiffer` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `time_added` int(11) NOT NULL,
  `firms_access` varchar(200) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `for_user`, `email`, `name`, `phone`, `schiffer`, `password`, `time_added`, `firms_access`, `enabled`) VALUES
(1, 1, 'dqwdqw@asd.asd', 'dqwdq', '32132', 'dqw', '61dbb488dee9bbe491d57f46970b7b91', 1501226470, 'a:1:{i:0;s:1:"1";}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employees_permissions`
--

CREATE TABLE `employees_permissions` (
  `id` int(11) NOT NULL,
  `for_employee` int(11) NOT NULL,
  `perm` varchar(50) NOT NULL,
  `role` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees_permissions`
--

INSERT INTO `employees_permissions` (`id`, `for_employee`, `perm`, `role`) VALUES
(1, 1, 'perm_add_invoice', 0),
(2, 1, 'perm_edit_invoice', 1),
(3, 1, 'perm_delete_invoice', 1),
(4, 1, 'perm_change_inv_status', 1),
(5, 1, 'perm_add_clients', 1),
(6, 1, 'perm_edit_clients', 1),
(7, 1, 'perm_delete_clients', 1),
(8, 1, 'perm_add_items', 1),
(9, 1, 'perm_edit_items', 1),
(10, 1, 'perm_delete_items', 1),
(11, 1, 'perm_can_manage_rights', 1),
(12, 1, 'perm_delete_employees', 1),
(13, 1, 'perm_edit_employees', 1),
(14, 1, 'perm_add_employees', 1),
(15, 1, 'perm_can_manage_firms', 1),
(16, 1, 'perm_add_movement', 1),
(17, 1, 'perm_view_movement_page', 1),
(18, 1, 'perm_view_store_stocks', 1),
(19, 1, 'perm_view_warranty_page', 1),
(20, 1, 'perm_add_warranty', 1),
(21, 1, 'perm_view_warranty_events', 1),
(22, 1, 'perm_add_warranty_events', 1),
(23, 1, 'perm_view_protocols_page', 1),
(24, 1, 'perm_add_protocol', 1);

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `image`) VALUES
(2, 'inventory-management-software2.png'),
(3, 'priemo-predavatelen-protokol.gif'),
(4, 'Warranty-Certificate-Template.png');

-- --------------------------------------------------------

--
-- Table structure for table `features_translates`
--

CREATE TABLE `features_translates` (
  `id` int(11) NOT NULL,
  `for_id` int(10) UNSIGNED NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `features_translates`
--

INSERT INTO `features_translates` (`id`, `for_id`, `abbr`, `title`, `description`) VALUES
(3, 2, 'en', 'Inventory System', '<p>Through our storage system, you can add type moves (picking, inserting, moving) and keep track of stocks in your various warehouses. You can issue commodity receipts and have the opportunity to issue an invoice directly from a receipt.</p>\r\n'),
(4, 2, 'bg', 'Склад', '<p>Чрез складовата ни система ще можете да добавяте движения от тип (изкадване, вкарване, преместване) и да следите постоянните наличности в различните ви складове. Можете да издавате стокови разписки и има възможност и за издаване на фактура директно от стокова разписка.</p>\r\n'),
(5, 3, 'en', 'Protocols', '<p>Create acceptable transmission protocols, download/print.</p>\r\n'),
(6, 3, 'bg', 'Протоколи', '<p>Създаване на приемно предавателни протоколи. Сваляне като PDF и принтиране</p>\r\n'),
(7, 4, 'en', 'Warranty', '<p>You can issue warranties and download/print as pdf.</p>\r\n'),
(8, 4, 'bg', 'Гаранционни карти', '<p>Можете да създавате гаранционни карти колко да сваляте/принтирате като pdf</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `firms_payment_requests`
--

CREATE TABLE `firms_payment_requests` (
  `id` int(11) NOT NULL,
  `for_user` int(11) NOT NULL,
  `req_num` int(11) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `plan_type` varchar(50) NOT NULL,
  `plan_period` int(10) UNSIGNED NOT NULL COMMENT 'in months',
  `date_generated` int(11) NOT NULL,
  `date_activated` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0new, 1rejected, 2activated'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `firms_payment_requests`
--

INSERT INTO `firms_payment_requests` (`id`, `for_user`, `req_num`, `payment_type`, `plan_type`, `plan_period`, `date_generated`, `date_activated`, `status`) VALUES
(1, 1, 1, 'bank', 'PRO', 1, 1504082387, 0, 2),
(2, 1, 2, 'bank', 'CUSTOM', 1, 1504085368, 0, 1),
(3, 1, 3, 'bank', 'PRO', 1, 1504085464, 0, 2),
(4, 1, 4, 'bank', 'PRO', 12, 1504529040, 1504529050, 2),
(5, 1, 5, 'bank', 'PRO', 1, 1504531951, 0, 1),
(6, 1, 6, 'bank', 'CUSTOM', 1, 1504535558, 0, 1),
(7, 1, 7, 'bank', 'ADVANCED', 1, 1504871111, 0, 1),
(8, 1, 8, 'bank', 'ADVANCED', 1, 1504871242, 0, 1),
(9, 1, 9, 'bank', 'ADVANCED', 1, 1504871247, 0, 1),
(10, 1, 10, 'bank', 'ADVANCED', 1, 1504871260, 0, 1),
(11, 1, 11, 'paypal', 'ADVANCED', 1, 1505113203, 0, 1),
(12, 1, 12, 'bank', 'PRO', 1, 1505114038, 0, 1),
(13, 1, 13, 'bank', 'PRO', 1, 1505132467, 0, 1),
(14, 1, 14, 'bank', 'PRO', 1, 1505132696, 0, 1),
(15, 1, 15, 'paypal', 'BASIC', 1, 1505132704, 0, 1),
(16, 1, 16, 'bank', 'PRO', 1, 1505132720, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `firms_plans`
--

CREATE TABLE `firms_plans` (
  `id` int(11) NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL,
  `from_date` int(11) NOT NULL,
  `to_date` int(11) NOT NULL,
  `plan_type` varchar(50) NOT NULL,
  `num_invoices` int(11) NOT NULL,
  `num_firms` int(11) NOT NULL,
  `time` int(10) UNSIGNED NOT NULL COMMENT 'time added',
  `sponsored` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `firms_plans`
--

INSERT INTO `firms_plans` (`id`, `for_user`, `from_date`, `to_date`, `plan_type`, `num_invoices`, `num_firms`, `time`, `sponsored`) VALUES
(1, 1, 1504082391, 1504790477, 'PRO', 956, 5, 1504082391, 0),
(2, 1, 1504529050, 1504082391, 'PRO', 1000, 10, 1504529050, 0),
(4, 5, 1504596322, 1507188322, 'PRO', 1000, 5, 1504596322, 1),
(5, 6, 1504602821, 1507194821, 'PRO', 998, 5, 1504602821, 1),
(6, 7, 1504855594, 1507447594, 'PRO', 1000, 5, 1504855594, 1);

-- --------------------------------------------------------

--
-- Table structure for table `firms_translations`
--

CREATE TABLE `firms_translations` (
  `id` int(11) NOT NULL,
  `for_firm` int(10) UNSIGNED NOT NULL COMMENT 'firm id',
  `name` varchar(500) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `city` varchar(250) NOT NULL,
  `mol` varchar(100) NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `trans_name` varchar(100) NOT NULL COMMENT 'for internally usage',
  `is_default` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `firms_translations`
--

INSERT INTO `firms_translations` (`id`, `for_firm`, `name`, `address`, `city`, `mol`, `image`, `trans_name`, `is_default`) VALUES
(1, 1, 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 'default', 1),
(2, 2, 'dasdas', 'dad', 'awdaw', 'dawdwa', NULL, 'default', 1),
(3, 3, 'KIRKATA', 'Pancha', 'Sofia West', 'Kirkata Kasap', NULL, 'default', 1),
(4, 4, 'asd', 'asd', 'asd', 'asd', NULL, 'default', 1),
(5, 5, 'dqwdqwqw21', 'dqwd', 'dqwdqw', 'dqwdqw', NULL, 'default', 1),
(6, 6, 'dqwdqw', 'dsda', 'ddqdqw', 'dqwdqw', NULL, 'default', 1),
(7, 7, 'test babyh', 'dsada', 'dasda', 'dasdas', '16427489_1341882885869514_8248047917573720528_n.jpg', 'default', 1);

-- --------------------------------------------------------

--
-- Table structure for table `firms_users`
--

CREATE TABLE `firms_users` (
  `id` int(11) NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL COMMENT 'user id',
  `bulstat` varchar(100) NOT NULL,
  `is_vat_registered` tinyint(1) NOT NULL DEFAULT '0',
  `vat_number` varchar(50) NOT NULL,
  `default_currency` varchar(10) DEFAULT NULL,
  `show_logo` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Show logo in invoices',
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `firms_users`
--

INSERT INTO `firms_users` (`id`, `for_user`, `bulstat`, `is_vat_registered`, `vat_number`, `default_currency`, `show_logo`, `is_default`, `is_deleted`) VALUES
(1, 1, '020366879', 1, 'VATNUM2232322', 'BDT', 0, 1, 0),
(2, 2, 'dqwq3213', 0, '', NULL, 1, 1, 0),
(3, 3, '99928828', 0, '', NULL, 1, 1, 0),
(4, 4, 'asd', 0, '', NULL, 1, 1, 0),
(5, 1, '3213', 0, '', NULL, 0, 0, 1),
(6, 1, '3213221', 0, '', NULL, 0, 0, 1),
(7, 6, '321312', 0, '', NULL, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `activity` varchar(255) NOT NULL,
  `time` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `individual_plans`
--

CREATE TABLE `individual_plans` (
  `id` int(11) NOT NULL,
  `for_user` int(11) NOT NULL,
  `num_invoices` int(11) NOT NULL,
  `num_firms` int(11) NOT NULL,
  `price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `individual_plans`
--

INSERT INTO `individual_plans` (`id`, `for_user`, `num_invoices`, `num_firms`, `price`) VALUES
(1, 1, 10, 20, '50');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL,
  `for_company` int(10) UNSIGNED NOT NULL,
  `inv_type` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `inv_number` varchar(20) NOT NULL,
  `inv_currency` varchar(50) NOT NULL,
  `date_create` int(10) UNSIGNED NOT NULL,
  `date_tax_event` int(10) UNSIGNED NOT NULL,
  `cash_accounting` tinyint(1) NOT NULL,
  `have_maturity_date` tinyint(1) NOT NULL,
  `maturity_date` int(10) UNSIGNED NOT NULL,
  `remarks` longtext NOT NULL,
  `payment_method` varchar(200) NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `to_inv_number` varchar(20) NOT NULL,
  `to_inv_date` int(10) UNSIGNED NOT NULL,
  `invoice_amount` varchar(50) NOT NULL,
  `discount` varchar(50) NOT NULL,
  `discount_type` varchar(50) NOT NULL,
  `tax_base` varchar(50) NOT NULL,
  `vat_percent` varchar(50) NOT NULL,
  `vat_sum` varchar(50) NOT NULL,
  `no_vat` tinyint(1) NOT NULL,
  `no_vat_reason` varchar(255) NOT NULL,
  `final_total` varchar(50) NOT NULL,
  `composed` varchar(255) NOT NULL,
  `schiffer` varchar(100) NOT NULL,
  `created` int(10) UNSIGNED NOT NULL,
  `date_received` int(10) UNSIGNED NOT NULL,
  `return_reason` varchar(500) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `uniqid` varchar(50) NOT NULL COMMENT 'used for links'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `for_user`, `for_company`, `inv_type`, `status`, `inv_number`, `inv_currency`, `date_create`, `date_tax_event`, `cash_accounting`, `have_maturity_date`, `maturity_date`, `remarks`, `payment_method`, `payment_status`, `to_inv_number`, `to_inv_date`, `invoice_amount`, `discount`, `discount_type`, `tax_base`, `vat_percent`, `vat_sum`, `no_vat`, `no_vat_reason`, `final_total`, `composed`, `schiffer`, `created`, `date_received`, `return_reason`, `is_deleted`, `uniqid`) VALUES
(11, 1, 1, 'tax_inv', 'issued', '0000000001', 'BGN', 1497906000, 1497906000, 0, 0, 0, '&quot;\'&gt; \'\' \' &gt;  &lt;', 'Credit or Debit Card', 'paid', '', 0, '2.00', '0.00', 'BGN', '2.00', '20', '0.40', 0, '', '2.40', '', '', 1497949084, 0, '', 0, '1u5952139cb80c1'),
(12, 1, 1, 'tax_inv', 'draft', '0000000002', 'BGN', 1497906000, 1497906000, 0, 0, 1497906000, '', 'Credit or Debit Card', 'unpaid', '', 0, '4.00', '0.00', 'BGN', '4.00', '20', '0.80', 0, '', '4.80', '', '', 1497949093, 0, '', 0, '1u5952139cb80c2'),
(13, 1, 1, 'tax_inv', 'sended', '0000000003', 'BGN', 1497906000, 1497906000, 0, 0, 1497906000, '', 'Credit or Debit Card', 'paid', '', 0, '46.00', '0.00', 'BGN', '46.00', '20', '9.20', 0, '', '55.20', '', '', 1497949558, 0, '', 0, '1u5952139cb80c4'),
(14, 1, 1, 'tax_inv', 'canceled', '0000000004', 'BGN', 1497906000, 1497906000, 0, 0, 1497906000, '', 'Credit or Debit Card', 'unpaid', '', 0, '108.00', '0.00', 'BGN', '108.00', '20', '21.60', 0, '', '129.60', '', '', 1497949567, 0, '', 0, '1u5952139cb80c5'),
(15, 1, 1, 'tax_inv', 'accepted', '0000000005', 'BGN', 1497906000, 1497906000, 0, 0, 1497906000, '', 'Credit or Debit Card', 'paid', '', 0, '0.80', '0.00', 'BGN', '0.80', '20', '0.16', 0, '', '0.96', '', '', 1497949580, 0, '', 0, '1u5952139cb80ca'),
(16, 1, 1, 'credit', 'refused', '0000000006', 'BGN', 1497906000, 1497906000, 0, 0, 0, '', 'Credit or Debit Card', 'paid', '321321', 0, '60.00', '0.00', 'BGN', '60.00', '20', '12.00', 0, '', '72.01', '', '', 1497949589, 0, '', 0, '1u5952139cb80c7v'),
(17, 1, 1, 'debit', 'issued', '0000000007', 'BGN', 1497906000, 1497906000, 0, 0, 0, '', 'Credit or Debit Card', 'partly_paid', '3421321', 0, '34.00', '0.00', 'BGN', '34.00', '20', '6.80', 0, '', '40.80', '', '', 1497949601, 0, '', 0, '1u5952139cb80cas'),
(18, 1, 1, 'tax_inv', 'issued', '0000000008', 'BGN', 1497906000, 1497906000, 0, 0, 0, '', 'Credit or Debit Card', 'unpaid', '', 0, '6486.00', '0.00', 'BGN', '6486.00', '20', '1297.20', 0, '', '7783.20', '', '', 1497949615, 0, '', 0, '1u5952139cb80cbe'),
(19, 1, 1, 'tax_inv', 'issued', '0000000009', 'BGN', 1497906000, 1497906000, 0, 0, 1497906000, '', 'aee', 'unpaid', '', 0, '46.00', '0.00', 'BGN', '46.00', '20', '9.20', 0, '', '55.20', '', '', 1497949655, 0, '', 0, '1u5952139cb80cz'),
(20, 1, 1, 'tax_inv', 'issued', '0000000010', 'BGN', 1497906000, 1497906000, 0, 0, 0, '', 'Credit or Debit Card', 'unpaid', '', 0, '26.00', '0.00', 'BGN', '26.00', '20', '5.20', 0, '', '31.20', '', '', 1497949665, 0, '', 0, '1u5952139cb80c7aas'),
(23, 1, 1, 'tax_inv', 'draft', '0000000011', 'BGN', 1498165200, 1498165200, 0, 0, 1498165200, '', 'Credit or Debit Card', 'unpaid', '', 0, '0.00', '0.00', 'BGN', '0.00', '20', '0.00', 0, '', '0.00', '', '', 1498203949, 0, '', 1, '1u5952139cb80c3'),
(24, 1, 1, 'tax_inv', 'issued', '0000000011', 'BGN', 1498165200, 1498165200, 0, 0, 1498165200, '', 'Credit or Debit Card', 'unpaid', '', 0, '0.00', '0.00', 'BGN', '0.00', '20', '0.00', 0, '', '0.00', '', '', 1498204399, 0, '', 1, '1u5952139cb80c7asd'),
(26, 3, 3, 'tax_inv', 'issued', '0000000001', 'EUR', 1498165200, 1498165200, 0, 0, 1498165200, '', 'Credit or Debit Card', 'unpaid', '', 0, '0.00', '0.00', 'EUR', '0.00', '20', '0.00', 0, '', '0.00', '', '', 1498217949, 0, '', 0, '1u5952139cb80c6'),
(27, 1, 1, 'tax_inv', 'issued', '0000000011', 'BGN', 1498510800, 1498510800, 0, 0, 0, '', 'Credit or Debit Card', 'unpaid', '', 0, '400.00', '0.00', 'BGN', '400.00', '20', '80.00', 0, '', '480.00', '', '', 1498551196, 0, '', 1, '1u5952139cb80c7'),
(28, 1, 1, 'tax_inv', 'issued', '0000000012', 'BGN', 1498510800, 1498510800, 0, 0, 1498510800, '', 'Credit or Debit Card', 'unpaid', '', 0, '20.00', '0.00', 'BGN', '20.00', '20', '4.00', 0, '', '24.00', '', '', 1498567763, 0, '', 1, '1u59525453bc9d6'),
(29, 1, 1, 'tax_inv', 'issued', '0000000012', 'BGN', 1498510800, 1498510800, 0, 0, 1498510800, '', 'Credit or Debit Card', 'unpaid', '', 0, '40.00', '0.00', 'BGN', '40.00', '20', '8.00', 0, '', '48.00', '', '', 1498567803, 0, '', 1, '1u5952547b7c4a8'),
(30, 4, 4, 'tax_inv', 'issued', '0000000001', 'EUR', 1499720400, 1499720400, 0, 0, 1499720400, '', 'Credit or Debit Card', 'unpaid', '', 0, '2.00', '0.00', 'EUR', '2.00', '20', '0.40', 0, '', '2.40', '', '', 1499771539, 0, '', 0, '4u5964b293889c8'),
(31, 1, 1, 'tax_inv', 'issued', '0000000012', 'BGN', 1499720400, 1499720400, 0, 0, 1499720400, '', 'Credit or Debit Card', 'unpaid', '', 0, '4.00', '0.00', 'BGN', '4.00', '20', '0.80', 0, '', '4.80', '', '', 1499773662, 0, '', 1, '1u5964bade50e16'),
(33, 1, 1, 'tax_inv', 'issued', '0000000111', 'BGN', 1504472400, 1504472400, 0, 0, 1504472400, '', 'Credit or Debit Card', 'unpaid', '', 0, '20.00', '0.00', 'BGN', '20.00', '20', '4.00', 0, '', '24.00', '', '', 1504533851, 0, '', 0, '1u59ad5d5b312fc'),
(34, 1, 1, 'tax_inv', 'issued', '0000000112', 'BGN', 1504472400, 1504472400, 0, 0, 1504472400, '', 'Credit or Debit Card', 'unpaid', '', 0, '20.00', '0.00', 'BGN', '20.00', '20', '4.00', 0, '', '24.00', '', '', 1504533940, 0, '', 0, '1u59ad5db41b5c3'),
(35, 1, 1, 'tax_inv', 'issued', '0000000113', 'BGN', 1504472400, 1504472400, 0, 0, 1504472400, '', 'Credit or Debit Card', 'unpaid', '', 0, '2.00', '0.00', 'BGN', '2.00', '20', '0.40', 0, '', '2.40', '', '', 1504534360, 0, '', 0, '1u59ad5f5880c9f'),
(36, 1, 1, 'tax_inv', 'issued', '0000000115', 'BGN', 1504472400, 1504472400, 0, 0, 1504472400, '', 'Credit or Debit Card', 'unpaid', '', 0, '4.00', '0.00', 'BGN', '4.00', '20', '0.80', 0, '', '4.80', '', '', 1504534867, 0, '', 0, '1u59ad615348442'),
(37, 1, 1, 'tax_inv', 'issued', '0000000116', 'BGN', 1504472400, 1504472400, 0, 0, 1504472400, '', 'Credit or Debit Card', 'unpaid', '', 0, '20.00', '0.00', 'BGN', '20.00', '20', '4.00', 0, '', '24.00', '', '', 1504534925, 0, '', 0, '1u59ad618d6cf3d'),
(38, 1, 1, 'tax_inv', 'issued', '0000000117', 'BGN', 1504472400, 1504472400, 0, 0, 1504472400, '', 'Credit or Debit Card', 'unpaid', '', 0, '0.00', '0.00', 'BGN', '0.00', '20', '0.00', 0, '', '0.00', '', '', 1504534945, 0, '', 0, '1u59ad61a1e666e'),
(39, 1, 1, 'tax_inv', 'issued', '0000000118', 'BGN', 1504472400, 1504472400, 0, 0, 1504472400, '', 'Credit or Debit Card', 'unpaid', '', 0, '0.00', '0.00', 'BGN', '0.00', '20', '0.00', 0, '', '0.00', '', '', 1504535250, 0, '', 0, '1u59ad62d2cd01e'),
(40, 1, 1, 'tax_inv', 'issued', '0000000119', 'BGN', 1504472400, 1504472400, 0, 0, 1504472400, '', 'Credit or Debit Card', 'unpaid', '', 0, '0.00', '0.00', 'BGN', '0.00', '20', '0.00', 0, '', '0.00', '', '', 1504535277, 0, '', 0, '1u59ad62ed53c0a'),
(41, 1, 1, 'tax_inv', 'issued', '0000000120', 'BGN', 1504472400, 1504472400, 0, 0, 1504472400, '', 'Credit or Debit Card', 'unpaid', '', 0, '0.00', '0.00', 'BGN', '0.00', '20', '0.00', 0, '', '0.00', '', '', 1504535289, 0, '', 0, '1u59ad62f945162'),
(42, 1, 1, 'tax_inv', 'issued', '0000000121', 'BGN', 1504472400, 1504472400, 0, 0, 1504472400, '', 'Credit or Debit Card', 'paid', '', 0, '0.00', '0.00', 'BGN', '0.00', '20', '0.00', 0, '', '0.00', '', '', 1504535301, 0, '', 0, '1u59ad63058595a'),
(43, 1, 1, 'tax_inv', 'issued', '0000000122', 'BGN', 1504472400, 1504472400, 0, 0, 1491685200, '', 'Credit or Debit Card', 'paid', '', 0, '0.00', '0.00', 'BGN', '0.00', '20', '0.00', 0, '', '0.00', '', '', 1504535444, 0, '', 0, '1u59ad63947acb1'),
(44, 6, 7, 'tax_inv', 'issued', '0000000001', 'EUR', 1504558800, 1504558800, 0, 0, 1494277200, '', 'Credit or Debit Card', 'paid', '', 0, '2.00', '0.00', 'EUR', '2.00', '20', '0.40', 0, '', '2.40', '', '', 1504602850, 0, '', 1, '6u59ae6ae29b6c7'),
(45, 6, 7, 'tax_inv', 'issued', '0000000001', 'EUR', 1504558800, 1504558800, 0, 0, 1494277200, '', 'Credit or Debit Card', 'unpaid', '', 0, '0', '0.00', 'EUR', '0.00', '20', '0.00', 0, '', '0.00', '', '', 1504603054, 0, '', 0, '6u59ae6baeb6f54'),
(46, 1, 1, 'tax_inv', 'issued', '0000000123', 'BGN', 1504731600, 1504731600, 0, 0, 1504731600, '', 'Credit or Debit Card', 'unpaid', '', 0, '0.00', '0.00', 'BGN', '0.00', '20', '0.00', 0, '', '0.00', '', '', 1504787071, 0, '', 0, '1u59b13a7f46112'),
(47, 1, 1, 'tax_inv', 'issued', '0000000124', 'BGN', 1504731600, 1504731600, 0, 0, 1504731600, '', 'Credit or Debit Card', 'unpaid', '', 0, '0.00', '0.00', 'BGN', '0.00', '20', '0.00', 0, '', '0.00', '', '', 1504787192, 0, '', 0, '1u59b13af899aa4'),
(48, 1, 1, 'tax_inv', 'issued', '0000000125', 'BGN', 1504731600, 1504731600, 0, 0, 1504731600, '', 'Credit or Debit Card', 'unpaid', '', 0, '0.00', '0.00', 'BGN', '0.00', '20', '0.00', 0, '', '0.00', '', '', 1504787865, 0, '', 0, '1u59b13d993667d'),
(49, 1, 1, 'tax_inv', 'issued', '0000000126', 'BGN', 1504731600, 1504731600, 0, 0, 1499547600, '', 'Credit or Debit Card', 'unpaid', '', 0, '2.00', '0.00', 'BGN', '2.00', '20', '0.40', 0, '', '2.40', '', '', 1504788077, 0, '', 0, '1u59b13e6d7ebd5'),
(50, 1, 1, 'tax_inv', 'issued', '0000000127', 'BGN', 1504818000, 1504818000, 0, 0, 1504818000, '', 'Credit or Debit Card', 'unpaid', '', 0, '0.00', '0.00', 'BGN', '0.00', '20', '0.00', 0, '', '0.00', '', '', 1504863599, 0, '', 0, '1u59b2656f60d32'),
(51, 1, 1, 'tax_inv', 'issued', '0000000128', 'BGN', 1504818000, 1504818000, 0, 0, 1504818000, '', 'Credit or Debit Card', 'paid', '', 0, '4.00', '0.00', 'BGN', '4.00', '20', '0.80', 0, '', '4.80', '', '', 1504863852, 0, '', 0, '1u59b2666c44864'),
(52, 1, 1, 'tax_inv', 'issued', '0000000129', 'BGN', 1504818000, 1504818000, 0, 0, 1504818000, '', 'Credit or Debit Card', 'unpaid', '', 0, '2.00', '0.00', 'BGN', '2.00', '20', '0.40', 0, '', '2.40', '', '', 1504876915, 0, '', 0, '1u59b2997330530'),
(53, 1, 1, 'tax_inv', 'issued', '0000000130', 'BGN', 1504818000, 1504818000, 0, 0, 1504818000, '', 'Credit or Debit Card', 'unpaid', '', 0, '2.00', '0.00', 'BGN', '2.00', '20', '0.40', 0, '', '2.40', '', '', 1504876924, 0, '', 0, '1u59b2997c13347');

-- --------------------------------------------------------

--
-- Table structure for table `invoices_clients`
--

CREATE TABLE `invoices_clients` (
  `id` int(11) NOT NULL,
  `for_invoice` int(10) UNSIGNED NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL,
  `for_company` int(10) UNSIGNED NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_bulstat` varchar(50) NOT NULL,
  `is_to_person` tinyint(1) NOT NULL,
  `client_vat_registered` tinyint(1) NOT NULL,
  `vat_number` varchar(50) NOT NULL,
  `client_ident_num` varchar(50) NOT NULL,
  `client_address` varchar(500) NOT NULL,
  `client_city` varchar(80) NOT NULL,
  `client_country` varchar(80) NOT NULL,
  `accountable_person` varchar(200) NOT NULL,
  `recipient_name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoices_clients`
--

INSERT INTO `invoices_clients` (`id`, `for_invoice`, `for_user`, `for_company`, `client_name`, `client_bulstat`, `is_to_person`, `client_vat_registered`, `vat_number`, `client_ident_num`, `client_address`, `client_city`, `client_country`, `accountable_person`, `recipient_name`) VALUES
(11, 11, 1, 1, 'ГАРД ООД&quot;', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'Кирил Пламенов'),
(12, 12, 1, 1, 'Радин Недков', '', 1, 0, '', '918278237', 'ул. Незабравка', 'Пловдив', 'България', '', 'Радин Недков'),
(13, 13, 1, 1, 'Радин Недков', '', 1, 0, '', '918278237', 'ул. Незабравка', 'Пловдив', 'България', '', 'Радин Недков'),
(14, 14, 1, 1, 'Радин Недков', '', 1, 0, '', '918278237', 'ул. Незабравка', 'Пловдив', 'България', '', 'Радин Недков'),
(15, 15, 1, 1, 'Радин Недков', '', 1, 0, '', '918278237', 'ул. Незабравка', 'Пловдив', 'България', '', 'Радин Недков'),
(16, 16, 1, 1, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'Кирил Пламенов'),
(17, 17, 1, 1, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'Кирил Пламенов'),
(18, 18, 1, 1, 'Радин Недков', '', 1, 0, '', '918278237', 'ул. Незабравка', 'Пловдив', 'България', '', 'Радин Недков'),
(19, 19, 1, 1, 'СИМ АУТО ООД', '32322323', 0, 0, '', '', 'ул Малина', 'Варна', 'България', 'Валентин Кацарски', 'Симеон Нелсън'),
(20, 20, 1, 1, 'СИМ АУТО ООД', '32322323', 0, 0, '', '', 'ул Малина', 'Варна', 'България', 'Валентин Кацарски', 'Симеон Нелсън'),
(25, 23, 1, 1, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'Кирил Пламенов'),
(26, 24, 1, 1, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'Кирил Пламенов'),
(27, 25, 3, 3, 'Findo Max', '', 1, 0, '', '810292392329', 'Mladost 3', 'Sofia', 'Bulgaria', '', ''),
(28, 26, 3, 3, 'Findo Max', '', 1, 0, '', '810292392329', 'Mladost 3', 'Sofia', 'Bulgaria', '', ''),
(29, 27, 1, 1, 'СИМ АУТО ООД', '32322323', 0, 0, '', '', 'ул Малина', 'Варна', 'България', 'Валентин Кацарски', 'Симеон Нелсън'),
(30, 28, 1, 1, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'Кирил Пламенов'),
(31, 29, 1, 1, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'Кирил Пламенов'),
(32, 30, 4, 4, 'asd', 'asd', 0, 0, '', '', 'asd', 'asd', 'asd', 'asd', 'asd'),
(33, 31, 1, 1, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'Кирил Пламенов'),
(34, 32, 1, 1, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'Кирил Пламенов'),
(35, 33, 1, 1, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'Кирил Пламенов'),
(36, 34, 1, 1, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'Кирил Пламенов'),
(37, 35, 1, 1, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'Кирил Пламенов'),
(38, 36, 1, 1, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'Кирил Пламенов'),
(39, 37, 1, 1, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'Кирил Пламенов'),
(40, 38, 1, 1, 'Радин Недков', '', 1, 0, '', '918278237', 'ул. Незабравка', 'Пловдив', 'България', '', 'Радин Недков'),
(41, 39, 1, 1, 'Радин Недков', '', 1, 0, '', '918278237', 'ул. Незабравка', 'Пловдив', 'България', '', 'Радин Недков'),
(42, 40, 1, 1, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'Кирил Пламенов'),
(43, 41, 1, 1, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'Кирил Пламенов'),
(44, 42, 1, 1, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'Кирил Пламенов'),
(45, 43, 1, 1, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'Кирил Пламенов'),
(46, 44, 6, 7, 'test', 'test', 0, 0, '', '', 'dasdsa', '', '', '', ''),
(47, 45, 6, 7, 'dqwdqw', 'dqwdqw', 0, 0, '', '', 'dqwdqw', '', '', '', ''),
(48, 46, 1, 1, 'Радин Недков', '', 1, 0, '', '918278237', 'ул. Незабравка', 'Пловдив', 'България', '', 'Радин Недков'),
(49, 47, 1, 1, 'Радин Недков', '', 1, 0, '', '918278237', 'ул. Незабравка', 'Пловдив', 'България', '', 'Радин Недков'),
(50, 48, 1, 1, 'Радин Недков', '', 1, 0, '', '918278237', 'ул. Незабравка', 'Пловдив', 'България', '', 'Радин Недков'),
(51, 49, 1, 1, 'Радин Недков', '', 1, 0, '', '918278237', 'ул. Незабравка', 'Пловдив', 'България', '', 'Радин Недков'),
(52, 50, 1, 1, 'Радин Недков', '', 1, 0, '', '918278237', 'ул. Незабравка', 'Пловдив', 'България', '', 'Радин Недков'),
(53, 51, 1, 1, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'Кирил Пламенов'),
(54, 52, 1, 1, 'Радин Недков', '', 1, 0, '', '918278237', 'ул. Незабравка', 'Пловдив', 'България', '', 'Радин Недков'),
(55, 53, 1, 1, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'Кирил Пламенов'),
(56, 54, 1, 1, 'Радин Недков', '', 1, 0, '', '918278237', 'ул. Незабравка', 'Пловдив', 'България', '', 'Радин Недков'),
(57, 54, 1, 1, 'Радин Недков', '', 1, 0, '', '918278237', 'ул. Незабравка', 'Пловдив', 'България', '', 'Радин Недков');

-- --------------------------------------------------------

--
-- Table structure for table `invoices_firms`
--

CREATE TABLE `invoices_firms` (
  `id` int(11) NOT NULL,
  `for_invoice` int(10) UNSIGNED NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL,
  `bulstat` varchar(100) NOT NULL,
  `name` varchar(500) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `city` varchar(250) NOT NULL,
  `accountable_person` varchar(100) NOT NULL,
  `image` varchar(500) NOT NULL,
  `is_vat_registered` tinyint(1) NOT NULL,
  `vat_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoices_firms`
--

INSERT INTO `invoices_firms` (`id`, `for_invoice`, `for_user`, `bulstat`, `name`, `address`, `city`, `accountable_person`, `image`, `is_vat_registered`, `vat_number`) VALUES
(10, 11, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(11, 12, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(12, 13, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(13, 14, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(14, 15, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(15, 16, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(16, 17, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(17, 18, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(18, 19, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(19, 20, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(22, 23, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(23, 24, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(24, 25, 3, '99928828', 'KIRKATA', 'Pancha', 'Sofia West', 'Kirkata Kasap', '', 0, ''),
(25, 26, 3, '99928828', 'KIRKATA', 'Pancha', 'Sofia West', 'Kirkata Kasap', '', 0, ''),
(26, 27, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(27, 28, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(28, 29, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(29, 30, 4, 'asd', 'asd', 'asd', 'asd', 'asd', '', 0, ''),
(30, 31, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(31, 32, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 0, ''),
(32, 33, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(33, 34, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(34, 35, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(35, 36, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(36, 37, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(37, 38, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(38, 39, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(39, 40, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(40, 41, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(41, 42, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(42, 43, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(43, 44, 6, '321312', 'test babyh', 'dsada', 'dasda', 'dasdas', '', 0, ''),
(44, 45, 6, '321312', 'test babyh', 'dsada', 'dasda', 'dasdas', '16427489_1341882885869514_8248047917573720528_n.jpg', 0, ''),
(45, 46, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(46, 47, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(47, 48, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(48, 49, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(49, 50, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(50, 51, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(51, 52, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(52, 53, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(53, 54, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(54, 54, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322');

-- --------------------------------------------------------

--
-- Table structure for table `invoices_items`
--

CREATE TABLE `invoices_items` (
  `id` int(11) NOT NULL,
  `for_invoice` int(10) UNSIGNED NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL,
  `for_company` int(10) UNSIGNED NOT NULL,
  `name` varchar(500) NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `quantity_type` varchar(50) NOT NULL,
  `single_price` varchar(20) NOT NULL,
  `total_price` varchar(20) NOT NULL,
  `position` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoices_items`
--

INSERT INTO `invoices_items` (`id`, `for_invoice`, `for_user`, `for_company`, `name`, `quantity`, `quantity_type`, `single_price`, `total_price`, `position`) VALUES
(63, 12, 1, 1, 'Банани', '2.00', 'kilogram', '2', '4.00', 1),
(64, 13, 1, 1, 'Банани', '23.00', 'kilogram', '2', '46.00', 1),
(65, 14, 1, 1, 'Банани', '54.00', 'kilogram', '2', '108.00', 1),
(66, 15, 1, 1, 'Банани', '0.40', 'kilogram', '2', '0.80', 1),
(67, 16, 1, 1, 'Банани', '30.00', 'kilogram', '2', '60.00', 1),
(68, 17, 1, 1, 'Банани', '17.00', 'kilogram', '2', '34.00', 1),
(69, 18, 1, 1, 'Банани', '2.00', 'kilogram', '2', '4.00', 1),
(70, 19, 1, 1, 'Банани', '23.00', 'kilogram', '2', '46.00', 1),
(71, 20, 1, 1, 'Банани', '13.00', 'kilogram', '2', '26.00', 2),
(77, 23, 1, 1, 'asdas', '20.00', 'kilogram', '0.00', '0.00', 1),
(78, 24, 1, 1, 'dasdas', '20.00', 'kilogram', '0.00', '0.00', 1),
(79, 25, 3, 3, 'Aerobika', '1.00', 'kilogram', '20.00', '20.00', 1),
(80, 20, 1, 1, 'asdas', '10.00', 'kilogram', '0.00', '0.00', 1),
(81, 26, 3, 3, 'asd', '20.00', 'kilogram', '0.00', '0.00', 1),
(82, 27, 1, 1, 'asd', '20.00', 'kilogram', '0.00', '0.00', 1),
(83, 28, 1, 1, 'Банани', '10.00', 'kilogram', '2', '20.00', 1),
(84, 29, 1, 1, 'Банани', '20.00', 'kilogram', '2', '40.00', 1),
(85, 27, 1, 1, 'asd', '20.00', 'kilogram', '20.00', '400.00', 2),
(87, 11, 1, 1, '3232', '2', 'kilogram', '1', '2.00', 1),
(88, 30, 4, 4, 'asd', '1', 'kilogram', '2', '2.00', 1),
(89, 31, 1, 1, 'Банани', '2', 'kilogram', '2', '4.00', 1),
(90, 32, 1, 1, 'Банани', '2', 'kilogram', '2', '4.00', 1),
(91, 18, 1, 1, 'asdas', '2', 'kilogram', '2', '4.00', 2),
(92, 18, 1, 1, 'Банани', '2', 'kilogram', '2', '4.00', 3),
(93, 18, 1, 1, 'asdas', '3', 'kilogram', '2', '6.00', 4),
(94, 18, 1, 1, 'asd', '3', 'kilogram', '3', '9.00', 5),
(95, 18, 1, 1, 'asdas', '3', 'kilogram', '3', '9.00', 6),
(96, 18, 1, 1, 'asdas', '30.00', 'kilogram', '30.00', '900.00', 7),
(97, 18, 1, 1, 'asdas', '30.00', 'kilogram', '30.00', '900.00', 8),
(98, 18, 1, 1, 'Банани', '30.00', 'kilogram', '32', '960.00', 9),
(99, 18, 1, 1, 'Банани', '30.00', 'kilogram', '23', '690.00', 10),
(100, 18, 1, 1, 'asdas', '30.00', 'kilogram', '30.00', '900.00', 11),
(101, 18, 1, 1, 'dasdas', '30.00', 'kilogram', '30.00', '900.00', 12),
(102, 18, 1, 1, 'dasdas', '20.00', 'kilogram', '20.00', '400.00', 13),
(103, 18, 1, 1, 'asdas', '20.00', 'kilogram', '20.00', '400.00', 14),
(104, 33, 1, 1, 'Банани', '10.00', 'kilogram', '2', '20.00', 1),
(105, 34, 1, 1, 'Банани', '10.00', 'kilogram', '2', '20.00', 1),
(106, 35, 1, 1, 'Банани', '1', 'kilogram', '2', '2.00', 1),
(107, 36, 1, 1, 'Банани', '02.00', 'kilogram', '2', '4.00', 1),
(108, 37, 1, 1, 'Банани', '10.00', 'kilogram', '2', '20.00', 1),
(109, 38, 1, 1, '32121', '20.00', 'kilogram', '0.00', '0.00', 1),
(110, 39, 1, 1, 'Банани', '1.00', 'kilogram', '2', '0.00', 1),
(111, 40, 1, 1, 'Банани', '1.00', 'kilogram', '2', '0.00', 1),
(112, 41, 1, 1, 'Банани', '1.00', 'kilogram', '2', '0.00', 1),
(113, 42, 1, 1, 'Банани', '1.00', 'kilogram', '2', '0.00', 1),
(114, 43, 1, 1, 'Банани', '1.00', 'kilogram', '2', '0.00', 1),
(115, 44, 6, 7, 'test', '1.00', 'kilogram', '2', '2.00', 1),
(116, 45, 6, 7, 'dqwdqw', '1.00', 'kilogram', '\'', '-220.00', 1),
(117, 46, 1, 1, 'Банани', '1.00', 'kilogram', '2', '0.00', 1),
(118, 47, 1, 1, 'Банани', '1.00', 'kilogram', '2', '0.00', 1),
(119, 48, 1, 1, 'Банани', '1.00', 'kilogram', '2', '0.00', 1),
(120, 49, 1, 1, 'Банани', '1', 'kilogram', '2', '2.00', 1),
(121, 50, 1, 1, 'Банани', '1.00', 'kilogram', '2', '0.00', 1),
(122, 51, 1, 1, 'Банани', '1.00', 'kilogram', '2', '2.00', 1),
(123, 51, 1, 1, 'Банани', '1.00', 'kilogram', '2', '2.00', 2),
(124, 52, 1, 1, 'Банани', '1.00', 'kilogram', '2', '2.00', 1),
(125, 53, 1, 1, 'Банани', '1.00', 'kilogram', '2', '2.00', 1),
(126, 54, 1, 1, 'Банани', '1.00', 'kilogram', '2', '2.00', 1),
(127, 54, 1, 1, 'Банани', '1.00', 'kilogram', '2', '2.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoices_languages`
--

CREATE TABLE `invoices_languages` (
  `id` int(11) NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL,
  `language_name` varchar(500) NOT NULL,
  `recipient` varchar(250) NOT NULL,
  `bulstat` varchar(100) NOT NULL,
  `mol` varchar(100) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `original` varchar(100) NOT NULL,
  `number` varchar(100) NOT NULL,
  `date_of_issue` varchar(100) NOT NULL,
  `a_date_of_a_tax_event` varchar(100) NOT NULL,
  `to_an_invoice` varchar(100) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `debit_note` varchar(100) NOT NULL,
  `credit_note` varchar(100) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `pro_forma` varchar(100) NOT NULL,
  `products_name` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `single_price` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `tax_base` varchar(100) NOT NULL,
  `percentage_vat` varchar(100) NOT NULL,
  `vat_charget` varchar(100) NOT NULL,
  `everything` varchar(100) NOT NULL,
  `reason_for_non_vat` varchar(100) NOT NULL,
  `compiled` varchar(100) NOT NULL,
  `signature` varchar(100) NOT NULL,
  `schiffer` varchar(100) NOT NULL,
  `page` varchar(100) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `from_date` varchar(100) NOT NULL,
  `discount` varchar(100) NOT NULL,
  `receive_inv` varchar(100) NOT NULL,
  `i_accept` varchar(100) NOT NULL,
  `i_refuse` varchar(100) NOT NULL,
  `receive_inv_from` varchar(100) NOT NULL,
  `vat_number` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoices_languages`
--

INSERT INTO `invoices_languages` (`id`, `for_user`, `language_name`, `recipient`, `bulstat`, `mol`, `sender`, `original`, `number`, `date_of_issue`, `a_date_of_a_tax_event`, `to_an_invoice`, `invoice`, `debit_note`, `credit_note`, `remarks`, `pro_forma`, `products_name`, `quantity`, `single_price`, `value`, `amount`, `tax_base`, `percentage_vat`, `vat_charget`, `everything`, `reason_for_non_vat`, `compiled`, `signature`, `schiffer`, `page`, `payment_type`, `from_date`, `discount`, `receive_inv`, `i_accept`, `i_refuse`, `receive_inv_from`, `vat_number`) VALUES
(1, 0, 'English', 'Beneficiary\n', 'Bulstat:', 'Contact:', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Description', 'Quantity', 'Unit Cost', 'Price', 'Subtotal:', 'VAT base:', 'Percentage vat', 'Vat charged', 'Total:', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Page', 'Payment type', 'From date', 'Discount:', 'Reveice invoice', 'I accept', 'I refuse', 'Receive invoice from', 'Vat Number:'),
(2, 0, 'Bulgarian', 'Получател', 'Булстат:', 'Мол:', 'Доставчик', 'Оригинал', 'Номер', 'Дата на издаване', 'Дата на данъчно събитие', 'Към фактура', 'Фактура', 'Дебитно известие', 'Кредитно известие', 'Забележки', 'Проформа', 'Наименование на продукта', 'Количество', 'Ед.цена', 'Стойност', 'Сума по фактура:', 'Данъчна основа:', 'Процент ДДС', 'ДДС', 'Общо:', 'Причина за неначисляване на ДДС', 'Съставил', 'Подпис', 'Шифър', 'Страница', 'Начин на плащане', 'От дата', 'Отстъпка:', 'Получихте фактура', 'Приемам', 'Отказвам', 'Получихте фактура от', 'ДДС Номер:');

-- --------------------------------------------------------

--
-- Table structure for table `invoices_logs`
--

CREATE TABLE `invoices_logs` (
  `id` int(11) NOT NULL,
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `action` varchar(50) NOT NULL,
  `info` varchar(500) NOT NULL,
  `time` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoices_logs`
--

INSERT INTO `invoices_logs` (`id`, `invoice_id`, `action`, `info`, `time`) VALUES
(1, 11, 'accepted', '', 1498636693),
(2, 11, 'refused', 'EQ', 1498636718),
(3, 11, 'accepted', '', 1498637748);

-- --------------------------------------------------------

--
-- Table structure for table `invoices_translations`
--

CREATE TABLE `invoices_translations` (
  `id` int(11) NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL,
  `for_invoice` int(10) UNSIGNED NOT NULL,
  `language_name` varchar(500) NOT NULL,
  `recipient` varchar(250) NOT NULL,
  `bulstat` varchar(100) NOT NULL,
  `mol` varchar(100) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `original` varchar(100) NOT NULL,
  `number` varchar(100) NOT NULL,
  `date_of_issue` varchar(100) NOT NULL,
  `a_date_of_a_tax_event` varchar(100) NOT NULL,
  `to_an_invoice` varchar(100) NOT NULL,
  `from_date` varchar(100) NOT NULL COMMENT 'to an invoice from date',
  `invoice` varchar(100) NOT NULL,
  `debit_note` varchar(100) NOT NULL,
  `credit_note` varchar(100) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `pro_forma` varchar(100) NOT NULL,
  `products_name` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `single_price` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `tax_base` varchar(100) NOT NULL,
  `percentage_vat` varchar(100) NOT NULL,
  `vat_charget` varchar(100) NOT NULL,
  `discount` varchar(100) NOT NULL,
  `everything` varchar(100) NOT NULL,
  `reason_for_non_vat` varchar(100) NOT NULL,
  `compiled` varchar(100) NOT NULL,
  `signature` varchar(100) NOT NULL,
  `schiffer` varchar(100) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `page` varchar(100) NOT NULL,
  `receive_inv` varchar(100) NOT NULL,
  `i_accept` varchar(100) NOT NULL,
  `i_refuse` varchar(100) NOT NULL,
  `receive_inv_from` varchar(100) NOT NULL,
  `vat_number` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoices_translations`
--

INSERT INTO `invoices_translations` (`id`, `for_user`, `for_invoice`, `language_name`, `recipient`, `bulstat`, `mol`, `sender`, `original`, `number`, `date_of_issue`, `a_date_of_a_tax_event`, `to_an_invoice`, `from_date`, `invoice`, `debit_note`, `credit_note`, `remarks`, `pro_forma`, `products_name`, `quantity`, `single_price`, `value`, `amount`, `tax_base`, `percentage_vat`, `vat_charget`, `discount`, `everything`, `reason_for_non_vat`, `compiled`, `signature`, `schiffer`, `payment_type`, `page`, `receive_inv`, `i_accept`, `i_refuse`, `receive_inv_from`, `vat_number`) VALUES
(10, 0, 11, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', '', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', 'Discount', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', 'You received ', 'I accept', 'I refuse', 'from', 'ДДС Номер'),
(11, 0, 12, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', 'From Date', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', 'Discount', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', '', '', '', '', ''),
(12, 0, 13, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', '', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', '', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', '', '', '', '', ''),
(13, 0, 14, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', '', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', '', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', '', '', '', '', ''),
(14, 0, 15, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', '', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', '', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', '', '', '', '', ''),
(15, 0, 16, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', '', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', '', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', '', '', '', '', ''),
(16, 0, 17, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', '', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', '', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', '', '', '', '', ''),
(17, 0, 18, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', '', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', '', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', '', '', '', '', ''),
(18, 0, 19, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', '', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', '', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', '', '', '', '', ''),
(19, 0, 20, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', '', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', '', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', '', '', '', '', ''),
(24, 0, 23, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', '', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', '', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', '', '', '', '', ''),
(25, 0, 24, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', '', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', '', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', '', '', '', '', ''),
(26, 0, 25, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', '', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', '', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', '', '', '', '', ''),
(27, 0, 26, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', '', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', '', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', '', '', '', '', ''),
(28, 0, 27, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', '', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', '', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', '', '', '', '', ''),
(29, 0, 28, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', '', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', '', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', '', '', '', '', ''),
(30, 0, 29, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', '', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', '', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', 'asd1', 'asd2', 'asd3', 'asd4', ''),
(31, 4, 30, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', '', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', '', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', 'asd1', 'asd2', 'asd3', 'asd4', ''),
(32, 1, 31, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', '', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', '', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', 'asd1', 'asd2', 'asd3', 'asd4', ''),
(33, 1, 32, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', '', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', '', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', 'asd1', 'asd2', 'asd3', 'asd4', ''),
(34, 1, 33, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', 'From date', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', 'Discount', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', 'asd1', 'asd2', 'asd3', 'asd4', 'Vat Number'),
(35, 1, 34, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', 'From date', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', 'Discount', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', 'asd1', 'asd2', 'asd3', 'asd4', 'Vat Number'),
(36, 1, 35, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', 'From date', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', 'Discount', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', 'asd1', 'asd2', 'asd3', 'asd4', 'Vat Number'),
(37, 1, 36, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', 'From date', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', 'Discount', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', 'asd1', 'asd2', 'asd3', 'asd4', 'Vat Number'),
(38, 1, 37, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', 'From date', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', 'Discount', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', 'asd1', 'asd2', 'asd3', 'asd4', 'Vat Number'),
(39, 1, 38, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', 'From date', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', 'Discount', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', 'asd1', 'asd2', 'asd3', 'asd4', 'Vat Number'),
(40, 1, 39, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', 'From date', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', 'Discount', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', 'asd1', 'asd2', 'asd3', 'asd4', 'Vat Number'),
(41, 1, 40, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', 'From date', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', 'Discount', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', 'asd1', 'asd2', 'asd3', 'asd4', 'Vat Number'),
(42, 1, 41, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', 'From date', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', 'Discount', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', 'asd1', 'asd2', 'asd3', 'asd4', 'Vat Number'),
(43, 1, 42, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', 'From date', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', 'Discount', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', 'asd1', 'asd2', 'asd3', 'asd4', 'Vat Number'),
(44, 1, 43, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', 'From date', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', 'Discount', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', 'asd1', 'asd2', 'asd3', 'asd4', 'Vat Number'),
(45, 6, 44, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', 'From date', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', 'Discount', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', 'asd1', 'asd2', 'asd3', 'asd4', 'Vat Number'),
(46, 6, 45, 'English', 'Recipient', 'Bulstat', 'Mol', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', 'From date', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charget', 'Discount', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', 'asd1', 'asd2', 'asd3', 'asd4', 'Vat Number'),
(47, 1, 46, 'English', 'Beneficiary\n', 'Bulstat', 'Accountable person', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', 'From date', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charged', 'Discount', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', 'Reveice invoice', 'I accept', 'I refuse', 'Receive invoice from', 'Vat Number'),
(48, 1, 47, 'English', 'Beneficiary\n', 'Bulstat', 'Accountable person', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', 'From date', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charged', 'Discount', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', 'Reveice invoice', 'I accept', 'I refuse', 'Receive invoice from', 'Vat Number'),
(49, 1, 48, 'English', 'Beneficiary\n', 'Bulstat', 'Accountable person', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', 'From date', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Product name', 'Quantity', 'Price', 'Final', 'Amount', 'Tax base', 'Percentage vat', 'Vat charged', 'Discount', 'Everything', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', 'Reveice invoice', 'I accept', 'I refuse', 'Receive invoice from', 'Vat Number'),
(50, 1, 49, 'Bulgarian', 'Получател', 'Булстат:', 'Мол:', 'Доставчик', 'Оригинал', 'Номер', 'Дата на издаване', 'Дата на данъчно събитие', 'Към фактура', 'От дата', 'Фактура', 'Дебитно известие', 'Кредитно известие', 'Забележки', 'Проформа', 'Наименование на продукта', 'Количество', 'Ед.цена', 'Стойност', 'Сума по фактура:', 'Данъчна основа:', 'Процент ДДС', 'ДДС', 'Отстъпка:', 'Общо:', 'Причина за неначисляване на ДДС', 'Съставил', 'Подпис', 'Шифър', 'Начин на плащане', 'Страница', 'Получихте фактура', 'Приемам', 'Отказвам', 'Получихте фактура от', 'ДДС Номер:'),
(51, 1, 50, 'English', 'Beneficiary\n', 'Bulstat:', 'Contact:', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', 'From date', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Description', 'Quantity', 'Unit Cost', 'Price', 'Subtotal:', 'VAT base:', 'Percentage vat', 'Vat charged', 'Discount:', 'Total:', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', 'Reveice invoice', 'I accept', 'I refuse', 'Receive invoice from', 'Vat Number:'),
(52, 1, 51, 'English', 'Beneficiary\n', 'Bulstat:', 'Contact:', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', 'From date', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Description', 'Quantity', 'Unit Cost', 'Price', 'Subtotal:', 'VAT base:', 'Percentage vat', 'Vat charged', 'Discount:', 'Total:', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', 'Reveice invoice', 'I accept', 'I refuse', 'Receive invoice from', 'Vat Number:'),
(53, 1, 52, 'English', 'Beneficiary\n', 'Bulstat:', 'Contact:', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', 'From date', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Description', 'Quantity', 'Unit Cost', 'Price', 'Subtotal:', 'VAT base:', 'Percentage vat', 'Vat charged', 'Discount:', 'Total:', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', 'Reveice invoice', 'I accept', 'I refuse', 'Receive invoice from', 'Vat Number:'),
(54, 1, 53, 'English', 'Beneficiary\n', 'Bulstat:', 'Contact:', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', 'From date', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Description', 'Quantity', 'Unit Cost', 'Price', 'Subtotal:', 'VAT base:', 'Percentage vat', 'Vat charged', 'Discount:', 'Total:', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', 'Reveice invoice', 'I accept', 'I refuse', 'Receive invoice from', 'Vat Number:'),
(55, 1, 54, 'English', 'Beneficiary\n', 'Bulstat:', 'Contact:', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', 'From date', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Description', 'Quantity', 'Unit Cost', 'Price', 'Subtotal:', 'VAT base:', 'Percentage vat', 'Vat charged', 'Discount:', 'Total:', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', 'Reveice invoice', 'I accept', 'I refuse', 'Receive invoice from', 'Vat Number:'),
(56, 1, 54, 'English', 'Beneficiary\n', 'Bulstat:', 'Contact:', 'Sender', 'Original', 'Number', 'Date of issue', 'Date of tax event', 'To an invoice', 'From date', 'Invoice', 'Debit note', 'Credit note', 'Remakrs', 'Pro-forma', 'Description', 'Quantity', 'Unit Cost', 'Price', 'Subtotal:', 'VAT base:', 'Percentage vat', 'Vat charged', 'Discount:', 'Total:', 'Reason for non vat', 'Compiled', 'Signature', 'Schiffer', 'Payment type', 'Page', 'Reveice invoice', 'I accept', 'I refuse', 'Receive invoice from', 'Vat Number:');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL,
  `for_company` int(10) UNSIGNED NOT NULL,
  `name` varchar(500) NOT NULL,
  `quantity_type` varchar(50) NOT NULL,
  `single_price` varchar(20) NOT NULL,
  `currency` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `for_user`, `for_company`, `name`, `quantity_type`, `single_price`, `currency`) VALUES
(2, 1, 1, 'Банани', 'kilogram', '2', 'BGN'),
(7, 3, 3, 'Aerobika', 'kilogram', '20.00', 'EUR'),
(8, 3, 3, 'asd', 'kilogram', '0.00', 'EUR'),
(10, 4, 4, 'asd', 'kilogram', '2', 'EUR'),
(11, 6, 7, 'test', 'kilogram', '0.00', 'EUR'),
(12, 6, 7, 'dqwdqw', 'kilogram', '0.00', 'EUR'),
(13, 1, 1, 'Банани', 'kilogram', '2', 'BGN'),
(14, 1, 1, 'Банани', 'kilogram', '2', 'BGN'),
(15, 1, 1, 'Банани', 'kilogram', '2', 'BGN'),
(16, 1, 1, 'Банани', 'kilogram', '2', 'BGN');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `flag` varchar(255) NOT NULL,
  `currencyKey` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `abbr`, `name`, `currency`, `flag`, `currencyKey`) VALUES
(2, 'en', 'english', 'EUR', 'en.png', 'EUR'),
(3, 'bg', 'bulgarian', 'лв', '', 'bgn');

-- --------------------------------------------------------

--
-- Table structure for table `movements`
--

CREATE TABLE `movements` (
  `id` int(11) NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL,
  `for_company` int(10) UNSIGNED NOT NULL,
  `movement_number` varchar(20) NOT NULL,
  `movement_type` varchar(15) NOT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `movement_currency` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `discount` varchar(50) NOT NULL,
  `discount_type` varchar(50) NOT NULL,
  `tax_base` varchar(50) NOT NULL,
  `vat_percent` varchar(50) NOT NULL,
  `vat_sum` varchar(50) NOT NULL,
  `no_vat_reason` varchar(255) NOT NULL,
  `final_total` varchar(50) NOT NULL,
  `remarks` longtext NOT NULL,
  `payment_method` varchar(200) NOT NULL,
  `created` int(10) UNSIGNED NOT NULL COMMENT 'date_create field in view',
  `cancelled` tinyint(1) NOT NULL DEFAULT '0',
  `betrayed` varchar(100) NOT NULL,
  `accepted` varchar(100) NOT NULL,
  `lot` varchar(20) NOT NULL,
  `expire_date` int(10) UNSIGNED NOT NULL,
  `to_invoice` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movements`
--

INSERT INTO `movements` (`id`, `for_user`, `for_company`, `movement_number`, `movement_type`, `store_id`, `movement_currency`, `amount`, `discount`, `discount_type`, `tax_base`, `vat_percent`, `vat_sum`, `no_vat_reason`, `final_total`, `remarks`, `payment_method`, `created`, `cancelled`, `betrayed`, `accepted`, `lot`, `expire_date`, `to_invoice`) VALUES
(1, 1, 1, '0000000001', 'in', 1, 'BGN', '0.00', '0.00', 'BGN', '0.00', '20', '0.00', '', '0.00', '', 'Credit or Debit Card', 1499115600, 0, '', '', '', 0, ''),
(2, 1, 1, '0000000002', 'in', 1, 'BGN', '0.00', '0.00', 'BGN', '0.00', '20', '0.00', '', '0.00', '', 'Credit or Debit Card', 1499115600, 0, '', '', '', 0, ''),
(3, 1, 1, '0000000003', 'in', 1, 'BGN', '0.00', '0.00', 'BGN', '0.00', '20', '0.00', '', '0.00', 'baba', 'Credit or Debit Card', 1499115600, 0, '', '', '', 0, ''),
(5, 1, 1, '0000000004', 'in', 1, 'BGN', '0.00', '0.00', 'BGN', '0.00', '20', '0.00', '', '0.00', '', 'Credit or Debit Card', 1499115600, 0, '', '', '', 0, ''),
(6, 1, 1, '0000000005', 'in', 1, 'BGN', '0.00', '0.00', 'BGN', '0.00', '20', '0.00', '', '0.00', '', 'Credit or Debit Card', 1499115600, 0, '', '', '', 0, ''),
(7, 1, 1, '0000000006', 'out', 1, 'BGN', '0.00', '0.00', 'BGN', '0.00', '20', '0.00', '', '0.00', '', 'Credit or Debit Card', 1499115600, 0, '', '', '', 0, ''),
(8, 1, 1, '0000000007', 'move', 1, 'BGN', '0.00', '0.00', 'BGN', '0.00', '20', '0.00', '', '0.00', '', 'Credit or Debit Card', 1499115600, 0, '', '', '', 0, ''),
(9, 1, 1, '0000000008', 'in', 2, 'BGN', '0.00', '0.00', 'BGN', '0.00', '20', '0.00', '', '0.00', '', 'Credit or Debit Card', 1499115600, 0, '', '', '', 0, ''),
(10, 1, 1, '0000000009', 'move', 2, 'BGN', '0.00', '0.00', 'BGN', '0.00', '20', '0.00', '', '0.00', '', 'Credit or Debit Card', 1499115600, 0, '', '', '', 0, ''),
(11, 1, 1, '0000000010', 'in', 1, 'BGN', '0.00', '0.00', 'BGN', '0.00', '20', '0.00', '', '0.00', '', 'Credit or Debit Card', 1499115600, 0, '', '', '', 0, ''),
(12, 1, 1, '0000000011', 'move', 1, 'BGN', '0.00', '0.00', 'BGN', '0.00', '20', '0.00', '', '0.00', '', 'Credit or Debit Card', 1499115600, 0, '', '', '', 0, ''),
(13, 1, 1, '0000000012', 'revision', 1, 'BGN', '0.00', '0.00', 'BGN', '0.00', '20', '0.00', '', '0.00', '', 'Credit or Debit Card', 1499115600, 0, '', '', '', 0, ''),
(14, 1, 1, '0000000013', 'revision', 1, 'BGN', '0.00', '0.00', 'BGN', '0.00', '20', '0.00', '', '0.00', '', 'Credit or Debit Card', 1499115600, 0, '', '', '', 0, ''),
(15, 1, 1, '0000000014', 'revision', 1, 'BGN', '0.00', '0.00', 'BGN', '0.00', '20', '0.00', '', '0.00', '', 'Credit or Debit Card', 1499115600, 1, '', '', '', 0, ''),
(16, 1, 1, '0000000015', 'out', 1, 'BGN', '0.00', '0.00', 'BGN', '0.00', '20', '0.00', '', '0.00', '', 'Credit or Debit Card', 1499115600, 1, '', '', '', 0, ''),
(17, 1, 1, '0000000016', 'out', 1, 'BGN', '66.0', '0.00', 'BGN', '66.0', '20', '13.2', '', '79.2', '', 'Credit or Debit Card', 1499115600, 1, '', '', '', 0, ''),
(18, 1, 1, '0000000017', 'out', 1, 'BGN', '66.0', '0.00', 'BGN', '66.0', '20', '13.2', '', '79.2', '', 'Credit or Debit Card', 1499115600, 1, '', '', '', 0, ''),
(19, 1, 1, '0000000018', 'out', 1, 'BGN', '0.0', '0.00', 'BGN', '0.0', '20', '0.0', '', '0.0', '', 'Credit or Debit Card', 1499115600, 1, '', '', '', 0, ''),
(25, 1, 1, '0000000019', 'in', 1, 'BGN', '0.0', '0.00', 'BGN', '0.0', '20', '0.0', '', '0.0', '', 'Credit or Debit Card', 1499115600, 1, '', '', '', 0, ''),
(26, 1, 1, '0000000020', 'in', 1, 'BGN', '44.0', '0.00', 'BGN', '44.0', '20', '8.8', '', '52.8', 'test', 'Credit or Debit Card', 1499202000, 1, '', '', '', 0, ''),
(27, 1, 1, '0000000021', 'in', 1, 'BGN', '46.0', '0.00', 'BGN', '46.0', '20', '9.2', '', '55.2', '', 'Credit or Debit Card', 1499202000, 1, 'Kiro', 'Valio', '', 0, ''),
(28, 1, 1, '0000000022', 'in', 1, 'BGN', '0.00', '2', 'BGN', '2', '20', '2', '', '2', '', 'Credit or Debit Card', 1499374800, 1, '', '', '', 0, ''),
(29, 1, 1, '0000000023', 'in', 1, 'BGN', '4.0', '0.00', 'BGN', '4.0', '20', '0.8', '', '4.8', '', 'Credit or Debit Card', 1499893200, 1, '', '', '', 0, ''),
(30, 6, 7, '0000000001', 'in', 3, 'EUR', '0.00', '0.00', 'EUR', '0.00', '20', '0.00', '', '0.00', '', 'Credit or Debit Card', 1504558800, 0, '', '', '', 0, ''),
(31, 1, 1, '0000000024', 'in', 1, 'BGN', '2.0', '0.00', 'BGN', '2.0', '20', '0.4', '', '2.4', '', 'Credit or Debit Card', 1504731600, 0, '', '', '1222336', 1567803600, ''),
(32, 1, 1, '0000000025', 'in', 1, 'BGN', '2.0', '0.00', 'BGN', '2.0', '20', '0.4', '', '2.4', '', 'Credit or Debit Card', 1504731600, 0, '', '', '4423423', 1567803600, ''),
(33, 1, 1, '0000000026', 'in', 1, 'BGN', '0.00', '0.00', 'BGN', '0.00', '20', '0.00', '', '0.00', '', 'Credit or Debit Card', 1504731600, 0, '', '', '', 1567803600, ''),
(34, 1, 1, '0000000027', 'in', 1, 'BGN', '0.00', '0.00', 'BGN', '0.00', '20', '0.00', '', '0.00', '', 'Credit or Debit Card', 1504731600, 0, '', '', '', 1567803600, ''),
(35, 1, 1, '0000000028', 'in', 1, 'BGN', '0.00', '0.00', 'BGN', '0.00', '20', '0.00', '', '0.00', '', 'Credit or Debit Card', 1504731600, 0, '', '', '', 1567803600, ''),
(36, 1, 1, '0000000029', 'out', 1, 'BGN', '0.00', '0.00', 'BGN', '0.00', '20', '0.00', '', '0.00', '', 'Credit or Debit Card', 1504731600, 0, '', '', '', 1567803600, '0000000126');

-- --------------------------------------------------------

--
-- Table structure for table `movements_clients`
--

CREATE TABLE `movements_clients` (
  `id` int(11) NOT NULL,
  `for_movement` int(10) UNSIGNED NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_bulstat` varchar(50) NOT NULL,
  `is_to_person` tinyint(1) NOT NULL,
  `client_vat_registered` tinyint(1) NOT NULL,
  `vat_number` varchar(50) NOT NULL,
  `client_ident_num` varchar(50) NOT NULL,
  `client_address` varchar(500) NOT NULL,
  `client_city` varchar(80) NOT NULL,
  `client_country` varchar(80) NOT NULL,
  `accountable_person` varchar(200) NOT NULL,
  `recipient_name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movements_clients`
--

INSERT INTO `movements_clients` (`id`, `for_movement`, `client_name`, `client_bulstat`, `is_to_person`, `client_vat_registered`, `vat_number`, `client_ident_num`, `client_address`, `client_city`, `client_country`, `accountable_person`, `recipient_name`) VALUES
(1, 1, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД'),
(2, 2, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД'),
(3, 3, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД'),
(5, 5, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД'),
(6, 6, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД'),
(7, 7, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД'),
(8, 8, '', '', 0, 0, '', '', '', '', '', '', ''),
(9, 9, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД'),
(10, 10, '', '', 0, 0, '', '', '', '', '', '', ''),
(11, 11, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД'),
(12, 12, '', '', 0, 0, '', '', '', '', '', '', ''),
(13, 13, '', '', 0, 0, '', '', '', '', '', '', ''),
(14, 14, '', '', 0, 0, '', '', '', '', '', '', ''),
(15, 15, '', '', 0, 0, '', '', '', '', '', '', ''),
(16, 16, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД'),
(17, 17, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД'),
(18, 18, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД'),
(19, 19, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД'),
(25, 25, 'Радин Недков', '', 1, 0, '', '918278237', 'ул. Незабравка', 'Пловдив', 'България', '', 'Радин Недков'),
(26, 26, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД'),
(27, 27, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД'),
(28, 28, '', '', 0, 0, '', '', '', '', '', '', ''),
(29, 29, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД'),
(30, 30, 'dawdaw', 'dawdaw', 0, 0, '', '', '', '', '', '', 'dawdaw'),
(31, 31, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД'),
(32, 32, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД'),
(33, 33, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД'),
(34, 34, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД'),
(35, 35, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД'),
(36, 36, 'Радин Недков', '', 1, 0, '', '918278237', 'ул. Незабравка', 'Пловдив', 'България', '', 'Радин Недков');

-- --------------------------------------------------------

--
-- Table structure for table `movements_firms`
--

CREATE TABLE `movements_firms` (
  `id` int(11) NOT NULL,
  `for_movement` int(10) UNSIGNED NOT NULL,
  `bulstat` varchar(100) NOT NULL,
  `name` varchar(500) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `city` varchar(250) NOT NULL,
  `accountable_person` varchar(100) NOT NULL,
  `image` varchar(500) NOT NULL,
  `is_vat_registered` tinyint(1) NOT NULL DEFAULT '0',
  `vat_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movements_firms`
--

INSERT INTO `movements_firms` (`id`, `for_movement`, `bulstat`, `name`, `address`, `city`, `accountable_person`, `image`, `is_vat_registered`, `vat_number`) VALUES
(1, 1, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(2, 2, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(3, 3, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(5, 5, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(6, 6, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(7, 7, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(8, 8, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(9, 9, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(10, 10, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(11, 11, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(12, 12, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(13, 13, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(14, 14, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(15, 15, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(16, 16, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(17, 17, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(18, 18, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(19, 19, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(25, 25, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(26, 26, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(27, 27, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(28, 28, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(29, 29, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(30, 30, '321312', 'test babyh', 'dsada', 'dasda', 'dasdas', '', 0, ''),
(31, 31, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(32, 32, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(33, 33, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(34, 34, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(35, 35, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(36, 36, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322');

-- --------------------------------------------------------

--
-- Table structure for table `movements_from_to_store`
--

CREATE TABLE `movements_from_to_store` (
  `id` int(11) NOT NULL,
  `for_movement` int(10) UNSIGNED NOT NULL,
  `from_store` varchar(250) NOT NULL,
  `to_store` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movements_from_to_store`
--

INSERT INTO `movements_from_to_store` (`id`, `for_movement`, `from_store`, `to_store`) VALUES
(1, 12, 'test', 'test1');

-- --------------------------------------------------------

--
-- Table structure for table `movements_languages`
--

CREATE TABLE `movements_languages` (
  `id` int(11) NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL,
  `language_name` varchar(500) NOT NULL,
  `bill_of_goods` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `recipient` varchar(100) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `bulstat` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `betrayed` varchar(100) NOT NULL,
  `accepted` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `vat` varchar(100) NOT NULL,
  `vat_amount` varchar(100) NOT NULL,
  `no_vat_reason` varchar(100) NOT NULL,
  `final_amount` varchar(20) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_quantity` varchar(10) NOT NULL,
  `product_quantity_type` varchar(100) NOT NULL,
  `single_price` varchar(20) NOT NULL,
  `product_amount` varchar(20) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `page` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `vat_number` varchar(100) NOT NULL,
  `lot` varchar(100) NOT NULL,
  `expire_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movements_languages`
--

INSERT INTO `movements_languages` (`id`, `for_user`, `language_name`, `bill_of_goods`, `date`, `recipient`, `sender`, `bulstat`, `address`, `betrayed`, `accepted`, `amount`, `vat`, `vat_amount`, `no_vat_reason`, `final_amount`, `product_name`, `product_quantity`, `product_quantity_type`, `single_price`, `product_amount`, `payment_method`, `page`, `city`, `remarks`, `vat_number`, `lot`, `expire_date`) VALUES
(1, 0, 'English', 'Store order', 'Date', 'Recipient', 'Sender', 'Bulstat', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', 'Page', 'City', 'Remarks', 'Vat number', 'LOT#', 'Expiry date'),
(2, 0, 'Bulgarian', 'Стокова разписка', 'Дата', 'Получател', 'Доставчик', 'Булстат', 'Адрес', 'Предал', 'Приел', 'Сума', 'ДДС', 'ДДС сума', 'Основание за неначисляване на ддс', 'Общо', 'Наименование на стока', 'Количество', 'Тип количество', 'Ед.цена', 'Общо', 'Начин на плащане', 'Страница', 'Град', 'Забележки', 'ДДС Номер', 'Партиден номер', 'Срок на годност');

-- --------------------------------------------------------

--
-- Table structure for table `movements_revisions`
--

CREATE TABLE `movements_revisions` (
  `id` int(11) NOT NULL,
  `for_movement` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `before_revision` varchar(20) NOT NULL,
  `after_revision` varchar(20) NOT NULL,
  `difference` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movements_revisions`
--

INSERT INTO `movements_revisions` (`id`, `for_movement`, `name`, `before_revision`, `after_revision`, `difference`) VALUES
(1, 13, 'aa', '24', '33', '9'),
(2, 14, 'aa', '60', '50', '10'),
(3, 15, 'aa', '60', '50', '-10');

-- --------------------------------------------------------

--
-- Table structure for table `movements_translations`
--

CREATE TABLE `movements_translations` (
  `id` int(11) NOT NULL,
  `language_name` varchar(500) NOT NULL,
  `for_movement` int(10) UNSIGNED NOT NULL,
  `bill_of_goods` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `recipient` varchar(100) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `bulstat` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `betrayed` varchar(100) NOT NULL,
  `accepted` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `vat` varchar(100) NOT NULL,
  `vat_amount` varchar(100) NOT NULL,
  `no_vat_reason` varchar(100) NOT NULL,
  `final_amount` varchar(20) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_quantity` varchar(10) NOT NULL,
  `product_quantity_type` varchar(100) NOT NULL,
  `single_price` varchar(20) NOT NULL,
  `product_amount` varchar(20) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `page` varchar(100) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `vat_number` varchar(100) NOT NULL,
  `lot` varchar(100) NOT NULL,
  `expire_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movements_translations`
--

INSERT INTO `movements_translations` (`id`, `language_name`, `for_movement`, `bill_of_goods`, `date`, `recipient`, `sender`, `bulstat`, `city`, `address`, `betrayed`, `accepted`, `amount`, `vat`, `vat_amount`, `no_vat_reason`, `final_amount`, `product_name`, `product_quantity`, `product_quantity_type`, `single_price`, `product_amount`, `payment_method`, `page`, `remarks`, `vat_number`, `lot`, `expire_date`) VALUES
(1, 'English', 3, 'Bill of goods', 'Date', 'Recipient', 'Sender', 'Bulstat', 'City', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', 'Page', 'Remarks', '', '', ''),
(2, 'English', 0, 'Bill of goods', '0', 'Recipient', 'Sender', 'Bulstat', '', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', '', '', '', '', ''),
(3, 'English', 0, 'Bill of goods', '0', 'Recipient', 'Sender', 'Bulstat', '', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', '', '', '', '', ''),
(5, 'English', 0, 'Bill of goods', '0', 'Recipient', 'Sender', 'Bulstat', '', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', '', '', '', '', ''),
(6, 'English', 0, 'Bill of goods', '0', 'Recipient', 'Sender', 'Bulstat', '', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', '', '', '', '', ''),
(7, 'English', 0, 'Bill of goods', '0', 'Recipient', 'Sender', 'Bulstat', '', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', '', '', '', '', ''),
(8, 'English', 0, 'Bill of goods', '0', 'Recipient', 'Sender', 'Bulstat', '', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', '', '', '', '', ''),
(9, 'English', 0, 'Bill of goods', '0', 'Recipient', 'Sender', 'Bulstat', '', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', '', '', '', '', ''),
(10, 'English', 0, 'Bill of goods', '0', 'Recipient', 'Sender', 'Bulstat', '', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', '', '', '', '', ''),
(11, 'English', 0, 'Bill of goods', '0', 'Recipient', 'Sender', 'Bulstat', '', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', '', '', '', '', ''),
(12, 'English', 0, 'Bill of goods', '0', 'Recipient', 'Sender', 'Bulstat', '', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', '', '', '', '', ''),
(13, 'English', 0, 'Bill of goods', '0', 'Recipient', 'Sender', 'Bulstat', '', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', '', '', '', '', ''),
(14, 'English', 0, 'Bill of goods', '0', 'Recipient', 'Sender', 'Bulstat', '', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', '', '', '', '', ''),
(15, 'English', 0, 'Bill of goods', '0', 'Recipient', 'Sender', 'Bulstat', '', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', '', '', '', '', ''),
(16, 'English', 0, 'Bill of goods', '0', 'Recipient', 'Sender', 'Bulstat', '', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', '', '', '', '', ''),
(17, 'English', 0, 'Bill of goods', '0', 'Recipient', 'Sender', 'Bulstat', '', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', '', '', '', '', ''),
(18, 'English', 0, 'Bill of goods', '0', 'Recipient', 'Sender', 'Bulstat', '', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', '', '', '', '', ''),
(19, 'English', 0, 'Bill of goods', '0', 'Recipient', 'Sender', 'Bulstat', '', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', '', '', '', '', ''),
(20, 'English', 0, 'Bill of goods', '0', 'Recipient', 'Sender', 'Bulstat', '', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', '', '', '', '', ''),
(21, 'English', 26, 'Bill of lading', 'Date', 'Recipient', 'Sender', 'Bulstat', '', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', '', '', '', '', ''),
(22, 'English', 27, 'Bill of lading', 'Date', 'Recipient', 'Sender', 'Bulstat', '', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', '', '', '', '', ''),
(23, 'English', 28, 'Bill of lading', 'Date', 'Recipient', 'Sender', 'Bulstat', '', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', '', '', '', '', ''),
(24, 'English', 29, 'Bill of lading', 'Date', 'Recipient', 'Sender', 'Bulstat', 'City', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', 'Page', 'Remarks', 'Vat Number', '', ''),
(25, 'English', 30, 'Bill of lading', 'Date', 'Recipient', 'Sender', 'Bulstat', 'City', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', 'Page', 'Remarks', '', '', ''),
(26, 'English', 31, 'Store order', 'Date', 'Recipient', 'Sender', 'Bulstat', 'City', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', 'Page', 'Remarks', '', '', ''),
(27, 'English', 32, 'Store order', 'Date', 'Recipient', 'Sender', 'Bulstat', 'City', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', 'Page', 'Remarks', 'Vat number', 'LOT#', 'Expiry date'),
(28, 'English', 33, 'Store order', 'Date', 'Recipient', 'Sender', 'Bulstat', 'City', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', 'Page', 'Remarks', 'Vat number', 'LOT#', 'Expiry date'),
(29, 'English', 34, 'Store order', 'Date', 'Recipient', 'Sender', 'Bulstat', 'City', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', 'Page', 'Remarks', 'Vat number', 'LOT#', 'Expiry date'),
(30, 'English', 35, 'Store order', 'Date', 'Recipient', 'Sender', 'Bulstat', 'City', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', 'Page', 'Remarks', 'Vat number', 'LOT#', 'Expiry date'),
(31, 'English', 36, 'Store order', 'Date', 'Recipient', 'Sender', 'Bulstat', 'City', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', 'Page', 'Remarks', 'Vat number', 'LOT#', 'Expiry date');

-- --------------------------------------------------------

--
-- Table structure for table `movement_items`
--

CREATE TABLE `movement_items` (
  `id` int(11) NOT NULL,
  `for_movement` int(10) UNSIGNED NOT NULL,
  `name` varchar(500) NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `quantity_type` varchar(50) NOT NULL,
  `single_price` varchar(20) NOT NULL,
  `total_price` varchar(20) NOT NULL,
  `position` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movement_items`
--

INSERT INTO `movement_items` (`id`, `for_movement`, `name`, `quantity`, `quantity_type`, `single_price`, `total_price`, `position`) VALUES
(1, 1, 'Банани', '22', 'kilogram', '2', '0.00', 1),
(2, 2, 'Банани', '3', 'kilogram', '2', '0.00', 1),
(3, 3, 'Банани', '3', 'kilogram', '2', '0.00', 1),
(5, 5, 'Банани', '3', 'kilogram', '2', '0.00', 1),
(6, 6, 'Банани', '3', 'kilogram', '2', '0.00', 1),
(7, 7, 'Банани', '2', 'kilogram', '2', '0.00', 1),
(8, 8, 'Банани', '3', 'kilogram', '2', '0.00', 1),
(9, 9, 'Банани', '3', 'kilogram', '2', '0.00', 1),
(10, 10, 'Банани', '6', 'kilogram', '2', '0.00', 1),
(11, 11, 'asdas', '2', 'kilogram', '0.00', '0.00', 1),
(12, 11, 'asd', '3', 'kilogram', '0.00', '0.00', 2),
(13, 12, 'Банани', '2', 'kilogram', '2', '0.00', 1),
(14, 13, 'Банани', '33', 'kilogram', '2', '0.00', 1),
(15, 14, 'Банани', '50', 'kilogram', '2', '0.00', 1),
(16, 15, 'Банани', '50', 'kilogram', '2', '0.00', 1),
(17, 16, 'Банани', '32322322', 'kilogram', '2', '0.00', 1),
(18, 17, 'Банани', '33', 'kilogram', '2', '66.0', 1),
(19, 18, 'Банани', '33', 'kilogram', '2', '66.0', 1),
(20, 19, 'asd', '22', 'kilogram', '0.00', '0.0', 1),
(26, 25, 'asdas', '22', 'kilogram', '0.00', '0.0', 1),
(27, 26, 'Банани', '22', 'kilogram', '2', '44.0', 1),
(28, 27, 'Банани', '23', 'kilogram', '2', '46.0', 1),
(29, 28, 'asd', '2', 'kilogram', '2', '2', 1),
(30, 29, 'Банани', '2', 'kilogram', '2', '4.0', 1),
(31, 30, 'ddawaw', '1', 'kilogram', '0.00', '0.00', 1),
(32, 31, 'Банани', '1', 'kilogram', '2', '2.0', 1),
(33, 32, 'Банани', '1', 'kilogram', '2', '2.0', 1),
(34, 33, 'Банани', '1.00', 'kilogram', '2', '0.00', 1),
(35, 34, 'Банани', '1.00', 'kilogram', '2', '0.00', 1),
(36, 35, 'Банани', '1.00', 'kilogram', '2', '0.00', 1),
(37, 36, 'Банани', '1.00', 'kilogram', '2', '0.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`) VALUES
(1, 'Credit or Debit Card'),
(2, 'Check'),
(3, 'PayPal'),
(4, 'Easypay'),
(5, 'E-Pay'),
(6, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `protocols`
--

CREATE TABLE `protocols` (
  `id` int(11) NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL,
  `for_company` int(10) UNSIGNED NOT NULL,
  `protocol_number` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `from_date` int(10) UNSIGNED NOT NULL,
  `to_invoice` varchar(20) NOT NULL,
  `remarks` longtext NOT NULL,
  `created` int(10) UNSIGNED NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `received` varchar(100) NOT NULL,
  `compiled` varchar(100) NOT NULL,
  `provider_transmit` text NOT NULL,
  `contract` text NOT NULL,
  `amount` varchar(50) NOT NULL,
  `vat_percent` varchar(50) NOT NULL,
  `vat_sum` varchar(50) NOT NULL,
  `final_total` varchar(50) NOT NULL,
  `currency` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `protocols`
--

INSERT INTO `protocols` (`id`, `for_user`, `for_company`, `protocol_number`, `type`, `from_date`, `to_invoice`, `remarks`, `created`, `is_deleted`, `received`, `compiled`, `provider_transmit`, `contract`, `amount`, `vat_percent`, `vat_sum`, `final_total`, `currency`) VALUES
(1, 1, 1, '0000000001', '', 1499634000, '003', 'RemarksVisible for client', 1499690704, 1, 'Received', 'Compiled', 'Provider transmit', 'Contract', '70.0', '20', '14.0', '84.0', ''),
(2, 1, 1, '0000000002', '', 1499634000, '', '', 1499690953, 1, '', '', '', '', '4.0', '20', '0.8', '4.8', ''),
(3, 1, 1, '0000000003', '', 1499634000, '', '', 1499690974, 1, '', '', '', '', '60.0', '20', '12.0', '72.0', ''),
(4, 1, 1, '0000000001', 'acceptable', 1499634000, '0000000012', '', 1499693505, 0, 'Станислав Илиев', 'Кирил Кирков', 'се подписа настоящия приемо-предавателен протокол.\r\nДоставчикът предава, а получателят приема следните продукти/услуги:', 'Получателят приема описаните продукти/услуги без забележка по отношение на количеството и качеството.\r\nНастоящият приемо-предавателен протокол се съставя в два еднакви екземпляра - по един за всяка от страните.', '4.0', '20', '0.8', '4.8', 'BGN'),
(5, 1, 1, '0000000002', 'transmitte', 1499806800, '', '', 1499859402, 1, '', '', '', '', '4.0', '20', '0.8', '4.8', 'BGN'),
(6, 1, 1, '0000000002', 'transmitte', 1499806800, '', '', 1499859469, 1, '', '', '', '', '4.0', '20', '0.8', '4.8', 'BGN'),
(8, 1, 1, '0000000002', 'transmitte', 1499893200, '', '', 1499945070, 0, '', '', '', '', '4.0', '20', '0.8', '4.8', 'BGN'),
(9, 1, 1, '0000000003', '', 1499893200, '', '', 1499945088, 0, 'Kirkata', 'OOd', 'gqegqegqe', 'gqegqeqegqq', '4.0', '20', '0.8', '4.8', 'BGN');

-- --------------------------------------------------------

--
-- Table structure for table `protocols_clients`
--

CREATE TABLE `protocols_clients` (
  `id` int(11) NOT NULL,
  `for_protocol` int(10) UNSIGNED NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_bulstat` varchar(50) NOT NULL,
  `is_to_person` tinyint(1) NOT NULL,
  `client_vat_registered` tinyint(1) NOT NULL,
  `vat_number` varchar(50) NOT NULL,
  `client_ident_num` varchar(50) NOT NULL,
  `client_address` varchar(500) NOT NULL,
  `client_city` varchar(80) NOT NULL,
  `client_country` varchar(80) NOT NULL,
  `accountable_person` varchar(200) NOT NULL,
  `recipient_name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `protocols_clients`
--

INSERT INTO `protocols_clients` (`id`, `for_protocol`, `client_name`, `client_bulstat`, `is_to_person`, `client_vat_registered`, `vat_number`, `client_ident_num`, `client_address`, `client_city`, `client_country`, `accountable_person`, `recipient_name`) VALUES
(1, 1, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД'),
(2, 2, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД'),
(3, 3, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД'),
(4, 4, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД'),
(5, 5, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД'),
(6, 5, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД'),
(7, 6, 'Радин Недков', '', 1, 0, '', '918278237', 'ул. Незабравка', 'Пловдив', 'България', '', 'Радин Недков'),
(9, 8, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД'),
(10, 9, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД');

-- --------------------------------------------------------

--
-- Table structure for table `protocols_contracts`
--

CREATE TABLE `protocols_contracts` (
  `id` int(11) NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `contract` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `protocols_firms`
--

CREATE TABLE `protocols_firms` (
  `id` int(11) NOT NULL,
  `for_protocol` int(10) UNSIGNED NOT NULL,
  `bulstat` varchar(100) NOT NULL,
  `name` varchar(500) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `city` varchar(250) NOT NULL,
  `accountable_person` varchar(100) NOT NULL,
  `image` varchar(500) NOT NULL,
  `is_vat_registered` tinyint(1) NOT NULL DEFAULT '0',
  `vat_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `protocols_firms`
--

INSERT INTO `protocols_firms` (`id`, `for_protocol`, `bulstat`, `name`, `address`, `city`, `accountable_person`, `image`, `is_vat_registered`, `vat_number`) VALUES
(1, 1, '', '', '', '', '', '', 0, ''),
(2, 2, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(3, 3, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(4, 4, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(5, 5, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(6, 5, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(7, 6, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(8, 8, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322'),
(9, 9, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '14021717_10206471549579129_6704033388321984289_n1.jpg', 1, 'VATNUM2232322');

-- --------------------------------------------------------

--
-- Table structure for table `protocols_items`
--

CREATE TABLE `protocols_items` (
  `id` int(11) NOT NULL,
  `for_protocol` int(10) UNSIGNED NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL,
  `for_company` int(10) UNSIGNED NOT NULL,
  `name` varchar(500) NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `quantity_type` varchar(50) NOT NULL,
  `single_price` varchar(20) NOT NULL,
  `total_price` varchar(20) NOT NULL,
  `position` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `protocols_items`
--

INSERT INTO `protocols_items` (`id`, `for_protocol`, `for_user`, `for_company`, `name`, `quantity`, `quantity_type`, `single_price`, `total_price`, `position`) VALUES
(1, 1, 1, 1, 'Банани', '20.00', 'kilogram', '2', '40.0', 1),
(2, 1, 1, 1, 'asdas', '30.00', 'kilogram', '1', '30.0', 2),
(3, 2, 1, 1, 'Банани', '2', 'kilogram', '2', '4.0', 1),
(4, 3, 1, 1, 'Банани', '30', 'kilogram', '2', '60.0', 1),
(5, 4, 1, 1, 'Банани', '2', 'kilogram', '2', '4.0', 1),
(6, 5, 1, 1, 'Банани', '2', 'kilogram', '2', '4.0', 1),
(7, 5, 1, 1, 'asd', '2', 'kilogram', '3', '6.0', 2),
(8, 5, 1, 1, 'Банани', '2', 'kilogram', '2', '4.0', 1),
(9, 6, 1, 1, 'Банани', '2', 'kilogram', '2', '4.0', 1),
(11, 8, 1, 1, 'dasdas', '2', '--', '2', '4.0', 1),
(12, 9, 1, 1, 'asdas', '2', '--', '2', '4.0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `protocols_languages`
--

CREATE TABLE `protocols_languages` (
  `id` int(11) NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL,
  `language_name` varchar(500) NOT NULL,
  `transmission_protocol` varchar(100) NOT NULL,
  `protocol_number` varchar(100) NOT NULL,
  `from_date` varchar(100) NOT NULL,
  `recipient` varchar(100) NOT NULL,
  `supplier` varchar(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_quantity` varchar(100) NOT NULL,
  `product_quantity_type` varchar(100) NOT NULL,
  `product_single_price` varchar(100) NOT NULL,
  `product_final_price` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `vat` varchar(100) NOT NULL,
  `vat_amount` varchar(100) NOT NULL,
  `final_amount` varchar(100) NOT NULL,
  `received` varchar(100) NOT NULL,
  `compiled` varchar(100) NOT NULL,
  `signature` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `bulstat` varchar(100) NOT NULL,
  `to_invoice` varchar(100) NOT NULL,
  `page` varchar(100) NOT NULL,
  `vat_number` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `protocols_languages`
--

INSERT INTO `protocols_languages` (`id`, `for_user`, `language_name`, `transmission_protocol`, `protocol_number`, `from_date`, `recipient`, `supplier`, `product_name`, `product_quantity`, `product_quantity_type`, `product_single_price`, `product_final_price`, `amount`, `vat`, `vat_amount`, `final_amount`, `received`, `compiled`, `signature`, `city`, `address`, `bulstat`, `to_invoice`, `page`, `vat_number`) VALUES
(1, 0, 'English', 'Admission - transmission protocol', 'Number', 'From date', 'Recipient', 'Supplier', 'Name', 'Quantity', 'Quantity type', 'Single Price', 'Amount', 'Amount', 'Vat', 'Vat amount', 'Amount', 'Received', 'Compiled', 'Signature', 'City', 'Address', 'Bulstat', 'To invoice', 'Page', 'Vat number'),
(2, 0, 'Bulgarian', 'Приемно-предавателен протокол', 'Номер', 'От дата', 'Получател', 'Доставчик', 'Име', 'Количество', 'Тип', 'Ец.цена', 'Крайна цена', 'Цена', 'ДДС', 'ДДС Сума', 'Сума крайна', 'Получил', 'Съставил', 'Подпис', 'Град', 'Адрес', 'Булстат', 'Към фактура', 'Страница', 'ДДС Номер');

-- --------------------------------------------------------

--
-- Table structure for table `protocols_provider_transmit`
--

CREATE TABLE `protocols_provider_transmit` (
  `id` int(11) NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `protocols_translations`
--

CREATE TABLE `protocols_translations` (
  `id` int(11) NOT NULL,
  `for_protocol` int(10) UNSIGNED NOT NULL,
  `language_name` varchar(500) NOT NULL,
  `transmission_protocol` varchar(100) NOT NULL,
  `protocol_number` varchar(100) NOT NULL,
  `from_date` varchar(100) NOT NULL,
  `recipient` varchar(100) NOT NULL,
  `supplier` varchar(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_quantity` varchar(100) NOT NULL,
  `product_quantity_type` varchar(100) NOT NULL,
  `product_single_price` varchar(100) NOT NULL,
  `product_final_price` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `vat` varchar(100) NOT NULL,
  `vat_amount` varchar(100) NOT NULL,
  `final_amount` varchar(100) NOT NULL,
  `received` varchar(100) NOT NULL,
  `compiled` varchar(100) NOT NULL,
  `signature` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `bulstat` varchar(100) NOT NULL,
  `to_invoice` varchar(100) NOT NULL,
  `page` varchar(100) NOT NULL,
  `vat_number` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `protocols_translations`
--

INSERT INTO `protocols_translations` (`id`, `for_protocol`, `language_name`, `transmission_protocol`, `protocol_number`, `from_date`, `recipient`, `supplier`, `product_name`, `product_quantity`, `product_quantity_type`, `product_single_price`, `product_final_price`, `amount`, `vat`, `vat_amount`, `final_amount`, `received`, `compiled`, `signature`, `city`, `address`, `bulstat`, `to_invoice`, `page`, `vat_number`) VALUES
(1, 1, 'English', '', 'Number', 'From date', 'Recipient', 'Supplier', 'Product', 'Quantity', 'Quantity type', 'Single Price', 'Final price', 'Amount', 'Vat', 'Vat amount', 'Final amount', 'Received', 'Compiled', 'Signature', 'City', 'Address', 'Bulstat', 'To invoice', 'Page', ''),
(2, 2, 'English', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 4, 'English', 'ADMISSION-TRANSMISSION PROTOCOL', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, 5, 'English', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(6, 5, 'English', 'ADMISSION-TRANSMISSION PROTOCOL', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(7, 6, 'English', 'ADMISSION-TRANSMISSION PROTOCOL', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(9, 8, 'English', 'ADMISSION-TRANSMISSION PROTOCOL', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(10, 9, 'Bulgarian', 'Приемо-предавателен протокол', 'Номер', 'От дата', 'Получател', 'Доставчик', 'Име', 'Количество', 'Тип', 'Цена', 'Крайна цена', 'Цена', 'ДДС', 'ДДС Сума', 'Сума крайна', 'Получил', 'Съставил', 'Подпис', 'Град', 'Адрес', 'Булстат', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `quantity_types`
--

CREATE TABLE `quantity_types` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quantity_types`
--

INSERT INTO `quantity_types` (`id`, `name`) VALUES
(1, 'kilogram'),
(2, 'number'),
(3, 'days'),
(4, 'months');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `position` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `position`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `questions_translates`
--

CREATE TABLE `questions_translates` (
  `id` int(11) NOT NULL,
  `for_id` int(10) UNSIGNED NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `question` varchar(500) NOT NULL,
  `answer` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions_translates`
--

INSERT INTO `questions_translates` (`id`, `for_id`, `abbr`, `question`, `answer`) VALUES
(1, 1, 'en', 'How to register?', 'Registration is the easy part. Just click 2332 and fill in the email and password after you fill them correctly will be redirected to your personal account on invoicing.'),
(2, 2, 'en', 'In what format are invoices', 'Invoices are in PDF format. They can be sent via email as an attachment or link that when opened by the customer invoice is displayed in the browser, so can be downloaded and to accept or refuse that will be reflected in your system.');

-- --------------------------------------------------------

--
-- Table structure for table `stock_availability`
--

CREATE TABLE `stock_availability` (
  `id` int(11) NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL,
  `for_company` int(10) UNSIGNED NOT NULL,
  `for_store` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `quantity` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock_availability`
--

INSERT INTO `stock_availability` (`id`, `for_user`, `for_company`, `for_store`, `item_id`, `quantity`) VALUES
(1, 1, 1, 1, 2, '71'),
(4, 1, 1, 2, 2, '2'),
(5, 1, 1, 1, 4, '2'),
(6, 1, 1, 1, 9, '-19'),
(12, 1, 1, 1, 5, '22'),
(13, 1, 1, 1, 0, '2'),
(14, 6, 7, 3, 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL,
  `for_company` int(10) UNSIGNED NOT NULL,
  `created` int(10) UNSIGNED NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `for_user`, `for_company`, `created`, `is_deleted`) VALUES
(1, 'test', 1, 1, 1498724925, 0),
(2, 'test1', 1, 1, 1499159426, 0),
(3, 'st', 6, 7, 1504602939, 0);

-- --------------------------------------------------------

--
-- Table structure for table `texts`
--

CREATE TABLE `texts` (
  `id` int(11) NOT NULL,
  `admin_info` varchar(255) NOT NULL,
  `my_key` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `texts`
--

INSERT INTO `texts` (`id`, `admin_info`, `my_key`) VALUES
(1, 'Home Text 1', 'homeOne'),
(2, 'Home Text 2 - Specifications', 'homeSpecifications'),
(3, 'Features Page Text', 'featuresText'),
(4, 'Terms & Conditions', 'termsCondit');

-- --------------------------------------------------------

--
-- Table structure for table `texts_translates`
--

CREATE TABLE `texts_translates` (
  `id` int(11) NOT NULL,
  `for_id` int(10) UNSIGNED NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `text` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `texts_translates`
--

INSERT INTO `texts_translates` (`id`, `for_id`, `abbr`, `text`) VALUES
(1, 1, 'en', '<p>One reason for not using free software or storing invoices on your personal computer is that they are not safe there. The reasons for data loss can be many like viruses, broken hard drive, hacker attack and more. We provide you with a highly secure server on which we will store your important documents so that they will never be lost unless you choose to delete them. You will also always be able to refer to the issued documents as well as quickly and easily find them as customer search, date, number and many other varied options. You can translate your documents, currency, company name and everything you need to issue invoices in your language.<br />\r\nOur support team will waiting for all yours questions and help need.</p>\r\n'),
(2, 2, 'en', '<p>The interface for creating invoices as simple as possible so as to be most suitable for each type of user. The system is designed so that it can be used in any devices like tablet, PC and phone. In addition invoicing offer and a bunch of other accounting services so as to make your work easier. Your account can be accessed from anywhere in the world.</p>\r\n'),
(3, 3, 'en', '<p>Other inventory system help features</p>\r\n'),
(4, 4, 'en', '<p>ds asd as</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `schiffer` varchar(100) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(100) NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `time_registered` int(10) UNSIGNED NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `schiffer`, `email`, `password`, `ip_address`, `time_registered`, `enabled`) VALUES
(1, '', '', '', 'kiro_tyson@abv.bg', '$2y$10$3cL.nFVs089lybgcu1AlPe0jhxF6YmcZW71bSOnIBvAuxYEyFN5Wm', '', 1497268592, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_currencies`
--

CREATE TABLE `users_currencies` (
  `id` int(11) NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL,
  `value` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_currencies`
--

INSERT INTO `users_currencies` (`id`, `for_user`, `value`, `name`) VALUES
(1, 1, 'asd', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `users_payment_methods`
--

CREATE TABLE `users_payment_methods` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_payment_methods`
--

INSERT INTO `users_payment_methods` (`id`, `name`, `for_user`) VALUES
(1, '2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_quantity_types`
--

CREATE TABLE `users_quantity_types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_quantity_types`
--

INSERT INTO `users_quantity_types` (`id`, `name`, `for_user`) VALUES
(1, 'num', 1),
(3, ' dqw qw', 1),
(4, 'asd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_no_vat_reasons`
--

CREATE TABLE `user_no_vat_reasons` (
  `id` int(11) NOT NULL,
  `reason` varchar(500) NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_no_vat_reasons`
--

INSERT INTO `user_no_vat_reasons` (`id`, `reason`, `for_user`) VALUES
(2, 'чл.113 ал.9 от ЗДДС', 1);

-- --------------------------------------------------------

--
-- Table structure for table `value_store`
--

CREATE TABLE `value_store` (
  `id` int(11) NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL,
  `_key` varchar(50) NOT NULL,
  `value` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `value_store`
--

INSERT INTO `value_store` (`id`, `for_user`, `_key`, `value`) VALUES
(1, 1, 'opt_invRoundTo', '2'),
(2, 1, 'opt_invCalculator', '1'),
(7, 1, 'opt_pagination', '10'),
(8, 2, 'opt_invRoundTo', '2'),
(9, 2, 'opt_invCalculator', '1'),
(10, 2, 'opt_pagination', '20'),
(11, 3, 'opt_invRoundTo', '2'),
(12, 3, 'opt_invCalculator', '1'),
(13, 3, 'opt_pagination', '20'),
(14, 1, 'opt_invTemplate', 'creative'),
(15, 1, 'opt_movementRoundTo', '1'),
(16, 1, 'opt_movementCalculator', '1'),
(17, 1, 'opt_negativeQuantities', '1'),
(18, 1, 'opt_protocolCalculator', '1'),
(19, 1, 'opt_protocolRoundTo', '1'),
(20, 4, 'opt_invRoundTo', '2'),
(21, 4, 'opt_invCalculator', '1'),
(22, 4, 'opt_pagination', '20'),
(23, 4, 'opt_movementRoundTo', '2'),
(24, 4, 'opt_movementCalculator', '1'),
(25, 4, 'opt_negativeQuantities', '1'),
(26, 4, 'opt_protocolCalculator', '1'),
(27, 4, 'opt_protocolRoundTo', '1'),
(36, 5, 'opt_invRoundTo', '2'),
(37, 5, 'opt_invCalculator', '1'),
(38, 5, 'opt_pagination', '20'),
(39, 5, 'opt_movementRoundTo', '2'),
(40, 5, 'opt_movementCalculator', '1'),
(41, 5, 'opt_negativeQuantities', '1'),
(42, 5, 'opt_protocolCalculator', '1'),
(43, 5, 'opt_protocolRoundTo', '1'),
(44, 6, 'opt_invRoundTo', '2'),
(45, 6, 'opt_invCalculator', '1'),
(46, 6, 'opt_pagination', '20'),
(47, 6, 'opt_movementRoundTo', '2'),
(48, 6, 'opt_movementCalculator', '1'),
(49, 6, 'opt_negativeQuantities', '1'),
(50, 6, 'opt_protocolCalculator', '1'),
(51, 6, 'opt_protocolRoundTo', '1'),
(52, 7, 'opt_invRoundTo', '2'),
(53, 7, 'opt_invCalculator', '1'),
(54, 7, 'opt_pagination', '20'),
(55, 7, 'opt_movementRoundTo', '2'),
(56, 7, 'opt_movementCalculator', '1'),
(57, 7, 'opt_negativeQuantities', '1'),
(58, 7, 'opt_protocolCalculator', '1'),
(59, 7, 'opt_protocolRoundTo', '1');

-- --------------------------------------------------------

--
-- Table structure for table `warranties`
--

CREATE TABLE `warranties` (
  `id` int(11) NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL,
  `for_company` int(10) UNSIGNED NOT NULL,
  `warranty_number` varchar(20) NOT NULL,
  `valid_from` int(10) UNSIGNED NOT NULL,
  `to_invoice` varchar(20) NOT NULL,
  `conditions` longtext NOT NULL,
  `remarks` longtext NOT NULL,
  `created` int(10) UNSIGNED NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `received` varchar(100) NOT NULL,
  `compiled` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `warranties`
--

INSERT INTO `warranties` (`id`, `for_user`, `for_company`, `warranty_number`, `valid_from`, `to_invoice`, `conditions`, `remarks`, `created`, `is_deleted`, `received`, `compiled`) VALUES
(5, 1, 1, '0000000001', 1499288400, '32132132121', '\r\n                                dawd awd[aw \r\nlawpdk\r\nawdawdkdaw dawdawdawda\r\n                            ', 'bebe2', 1499346431, 0, 'Findo', 'Kirka'),
(6, 1, 1, '0000000002', 1499374800, '', '2', '', 1499429754, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `warranties_clients`
--

CREATE TABLE `warranties_clients` (
  `id` int(11) NOT NULL,
  `for_warranty` int(10) UNSIGNED NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_bulstat` varchar(50) NOT NULL,
  `is_to_person` tinyint(1) NOT NULL,
  `client_vat_registered` tinyint(1) NOT NULL,
  `vat_number` varchar(50) NOT NULL,
  `client_ident_num` varchar(50) NOT NULL,
  `client_address` varchar(500) NOT NULL,
  `client_city` varchar(80) NOT NULL,
  `client_country` varchar(80) NOT NULL,
  `accountable_person` varchar(200) NOT NULL,
  `recipient_name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `warranties_clients`
--

INSERT INTO `warranties_clients` (`id`, `for_warranty`, `client_name`, `client_bulstat`, `is_to_person`, `client_vat_registered`, `vat_number`, `client_ident_num`, `client_address`, `client_city`, `client_country`, `accountable_person`, `recipient_name`) VALUES
(3, 5, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД'),
(4, 6, 'ГАРД ООД', '328328382', 0, 0, '', '', 'Младост 4', 'София', 'България', 'Кирил Кирков', 'ГАРД ООД');

-- --------------------------------------------------------

--
-- Table structure for table `warranties_firms`
--

CREATE TABLE `warranties_firms` (
  `id` int(11) NOT NULL,
  `for_warranty` int(10) UNSIGNED NOT NULL,
  `bulstat` varchar(100) NOT NULL,
  `name` varchar(500) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `city` varchar(250) NOT NULL,
  `accountable_person` varchar(100) NOT NULL,
  `image` varchar(500) NOT NULL,
  `is_vat_registered` tinyint(1) NOT NULL DEFAULT '0',
  `vat_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `warranties_firms`
--

INSERT INTO `warranties_firms` (`id`, `for_warranty`, `bulstat`, `name`, `address`, `city`, `accountable_person`, `image`, `is_vat_registered`, `vat_number`) VALUES
(2, 5, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, ''),
(3, 6, '020366879', 'PMINVOICE EOOD', 'Pancharevo Iovanec 34', 'Sofia', 'Kiril Kirkov', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `warranties_items`
--

CREATE TABLE `warranties_items` (
  `id` int(11) NOT NULL,
  `for_warranty` int(10) UNSIGNED NOT NULL,
  `name` varchar(500) NOT NULL,
  `months` varchar(20) NOT NULL,
  `valid_to` int(10) UNSIGNED NOT NULL,
  `serial` varchar(100) NOT NULL,
  `position` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `warranties_items`
--

INSERT INTO `warranties_items` (`id`, `for_warranty`, `name`, `months`, `valid_to`, `serial`, `position`) VALUES
(3, 5, '12', '323', 2348776800, 'asd', 1),
(18, 5, '32', '22', 1557090000, '', 2),
(19, 6, 'te', '22', 1557176400, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `warranties_languages`
--

CREATE TABLE `warranties_languages` (
  `id` int(11) NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL,
  `language_name` varchar(500) NOT NULL,
  `warranty_card` varchar(100) NOT NULL,
  `date_valid` varchar(100) NOT NULL,
  `recipient` varchar(100) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `bulstat` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_months` varchar(100) NOT NULL,
  `product_valid_to` varchar(100) NOT NULL,
  `product_serial_num` varchar(100) NOT NULL,
  `page` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `received` varchar(100) NOT NULL,
  `compiled` varchar(100) NOT NULL,
  `signature` varchar(100) NOT NULL,
  `warranty_conditions` varchar(100) NOT NULL,
  `vat_number` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `warranties_languages`
--

INSERT INTO `warranties_languages` (`id`, `for_user`, `language_name`, `warranty_card`, `date_valid`, `recipient`, `sender`, `bulstat`, `address`, `product_name`, `product_months`, `product_valid_to`, `product_serial_num`, `page`, `city`, `remarks`, `received`, `compiled`, `signature`, `warranty_conditions`, `vat_number`) VALUES
(1, 0, 'English', 'Warranty Card', 'Valid from:', 'Recipient', 'Sender', 'Bulstat', 'Address', 'Name', 'Months', 'Valid to', 'Serial number', 'Page', 'City', 'Remarks', 'Received', 'Compiled', 'Signature', 'Warranty conditions:', '');

-- --------------------------------------------------------

--
-- Table structure for table `warranties_translations`
--

CREATE TABLE `warranties_translations` (
  `id` int(11) NOT NULL,
  `for_warranty` int(10) UNSIGNED NOT NULL,
  `language_name` varchar(500) NOT NULL,
  `warranty_card` varchar(100) NOT NULL,
  `date_valid` varchar(100) NOT NULL,
  `recipient` varchar(100) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `bulstat` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_months` varchar(100) NOT NULL,
  `product_valid_to` varchar(100) NOT NULL,
  `product_serial_num` varchar(100) NOT NULL,
  `page` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `received` varchar(100) NOT NULL,
  `compiled` varchar(100) NOT NULL,
  `signature` varchar(100) NOT NULL,
  `warranty_conditions` varchar(100) NOT NULL,
  `vat_number` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `warranties_translations`
--

INSERT INTO `warranties_translations` (`id`, `for_warranty`, `language_name`, `warranty_card`, `date_valid`, `recipient`, `sender`, `bulstat`, `address`, `product_name`, `product_months`, `product_valid_to`, `product_serial_num`, `page`, `city`, `remarks`, `received`, `compiled`, `signature`, `warranty_conditions`, `vat_number`) VALUES
(1, 5, 'English', 'Warranty Card', 'Valid from:', 'Recipient', 'Sender', 'Bulstat', 'Address', 'Name', 'Months', 'Valid to', 'Serial number', 'Page', 'City', 'Remarks', 'Received', 'Compiled', 'Signature', 'Warranty conditions:', ''),
(2, 6, 'English', 'Warranty Card', 'Valid from:', 'Recipient', 'Sender', 'Bulstat', 'Address', 'Name', 'Months', 'Valid to', 'Serial number', 'Page', 'City', 'Remarks', 'Received', 'Compiled', 'Signature', 'Warranty conditions:', '');

-- --------------------------------------------------------

--
-- Table structure for table `warranty_conditions`
--

CREATE TABLE `warranty_conditions` (
  `id` int(11) NOT NULL,
  `for_user` int(10) UNSIGNED NOT NULL,
  `condition_title` varchar(255) NOT NULL,
  `condition_description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `warranty_conditions`
--

INSERT INTO `warranty_conditions` (`id`, `for_user`, `condition_title`, `condition_description`) VALUES
(2, 1, 'test', 'dawd awd[aw \r\nlawpdk\r\nawdawdkdaw dawdawdawda\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `warranty_events`
--

CREATE TABLE `warranty_events` (
  `id` int(11) NOT NULL,
  `for_warranty` int(10) UNSIGNED NOT NULL,
  `type` varchar(20) NOT NULL,
  `on_date` int(10) UNSIGNED NOT NULL,
  `item` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `warranty_events`
--

INSERT INTO `warranty_events` (`id`, `for_warranty`, `type`, `on_date`, `item`, `description`, `created`) VALUES
(1, 5, 'replacement', 1499374800, '32', 'dawa', 1499429129),
(2, 5, 'repair', 1501189200, '12', 'dasdas', 1501232131);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_translates`
--
ALTER TABLE `blog_translates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cusom_plan_requests`
--
ALTER TABLE `cusom_plan_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees_permissions`
--
ALTER TABLE `employees_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features_translates`
--
ALTER TABLE `features_translates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firms_payment_requests`
--
ALTER TABLE `firms_payment_requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `req_num` (`req_num`);

--
-- Indexes for table `firms_plans`
--
ALTER TABLE `firms_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firms_translations`
--
ALTER TABLE `firms_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firms_users`
--
ALTER TABLE `firms_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `individual_plans`
--
ALTER TABLE `individual_plans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`for_user`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices_clients`
--
ALTER TABLE `invoices_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices_firms`
--
ALTER TABLE `invoices_firms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices_items`
--
ALTER TABLE `invoices_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices_languages`
--
ALTER TABLE `invoices_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices_logs`
--
ALTER TABLE `invoices_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices_translations`
--
ALTER TABLE `invoices_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movements`
--
ALTER TABLE `movements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movements_clients`
--
ALTER TABLE `movements_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movements_firms`
--
ALTER TABLE `movements_firms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movements_from_to_store`
--
ALTER TABLE `movements_from_to_store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movements_languages`
--
ALTER TABLE `movements_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movements_revisions`
--
ALTER TABLE `movements_revisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movements_translations`
--
ALTER TABLE `movements_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movement_items`
--
ALTER TABLE `movement_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `protocols`
--
ALTER TABLE `protocols`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `protocols_clients`
--
ALTER TABLE `protocols_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `protocols_contracts`
--
ALTER TABLE `protocols_contracts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `protocols_firms`
--
ALTER TABLE `protocols_firms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `protocols_items`
--
ALTER TABLE `protocols_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `protocols_languages`
--
ALTER TABLE `protocols_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `protocols_provider_transmit`
--
ALTER TABLE `protocols_provider_transmit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `protocols_translations`
--
ALTER TABLE `protocols_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quantity_types`
--
ALTER TABLE `quantity_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions_translates`
--
ALTER TABLE `questions_translates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_availability`
--
ALTER TABLE `stock_availability`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `texts`
--
ALTER TABLE `texts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `my_key` (`my_key`);

--
-- Indexes for table `texts_translates`
--
ALTER TABLE `texts_translates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_unique` (`email`);

--
-- Indexes for table `users_currencies`
--
ALTER TABLE `users_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_payment_methods`
--
ALTER TABLE `users_payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_quantity_types`
--
ALTER TABLE `users_quantity_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_no_vat_reasons`
--
ALTER TABLE `user_no_vat_reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `value_store`
--
ALTER TABLE `value_store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warranties`
--
ALTER TABLE `warranties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warranties_clients`
--
ALTER TABLE `warranties_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warranties_firms`
--
ALTER TABLE `warranties_firms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warranties_items`
--
ALTER TABLE `warranties_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warranties_languages`
--
ALTER TABLE `warranties_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warranties_translations`
--
ALTER TABLE `warranties_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warranty_conditions`
--
ALTER TABLE `warranty_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warranty_events`
--
ALTER TABLE `warranty_events`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `blog_translates`
--
ALTER TABLE `blog_translates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
--
-- AUTO_INCREMENT for table `cusom_plan_requests`
--
ALTER TABLE `cusom_plan_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `employees_permissions`
--
ALTER TABLE `employees_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `features_translates`
--
ALTER TABLE `features_translates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `firms_payment_requests`
--
ALTER TABLE `firms_payment_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `firms_plans`
--
ALTER TABLE `firms_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `firms_translations`
--
ALTER TABLE `firms_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `firms_users`
--
ALTER TABLE `firms_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `individual_plans`
--
ALTER TABLE `individual_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `invoices_clients`
--
ALTER TABLE `invoices_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `invoices_firms`
--
ALTER TABLE `invoices_firms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `invoices_items`
--
ALTER TABLE `invoices_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
--
-- AUTO_INCREMENT for table `invoices_languages`
--
ALTER TABLE `invoices_languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `invoices_logs`
--
ALTER TABLE `invoices_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `invoices_translations`
--
ALTER TABLE `invoices_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `movements`
--
ALTER TABLE `movements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `movements_clients`
--
ALTER TABLE `movements_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `movements_firms`
--
ALTER TABLE `movements_firms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `movements_from_to_store`
--
ALTER TABLE `movements_from_to_store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `movements_languages`
--
ALTER TABLE `movements_languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `movements_revisions`
--
ALTER TABLE `movements_revisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `movements_translations`
--
ALTER TABLE `movements_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `movement_items`
--
ALTER TABLE `movement_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `protocols`
--
ALTER TABLE `protocols`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `protocols_clients`
--
ALTER TABLE `protocols_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `protocols_contracts`
--
ALTER TABLE `protocols_contracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `protocols_firms`
--
ALTER TABLE `protocols_firms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `protocols_items`
--
ALTER TABLE `protocols_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `protocols_languages`
--
ALTER TABLE `protocols_languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `protocols_provider_transmit`
--
ALTER TABLE `protocols_provider_transmit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `protocols_translations`
--
ALTER TABLE `protocols_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `quantity_types`
--
ALTER TABLE `quantity_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `questions_translates`
--
ALTER TABLE `questions_translates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `stock_availability`
--
ALTER TABLE `stock_availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `texts`
--
ALTER TABLE `texts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `texts_translates`
--
ALTER TABLE `texts_translates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_currencies`
--
ALTER TABLE `users_currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_payment_methods`
--
ALTER TABLE `users_payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_quantity_types`
--
ALTER TABLE `users_quantity_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_no_vat_reasons`
--
ALTER TABLE `user_no_vat_reasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `value_store`
--
ALTER TABLE `value_store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `warranties`
--
ALTER TABLE `warranties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `warranties_clients`
--
ALTER TABLE `warranties_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `warranties_firms`
--
ALTER TABLE `warranties_firms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `warranties_items`
--
ALTER TABLE `warranties_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `warranties_languages`
--
ALTER TABLE `warranties_languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `warranties_translations`
--
ALTER TABLE `warranties_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `warranty_conditions`
--
ALTER TABLE `warranty_conditions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `warranty_events`
--
ALTER TABLE `warranty_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
