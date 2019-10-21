-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 21, 2019 at 07:44 PM
-- Server version: 5.7.27-0ubuntu0.16.04.1
-- PHP Version: 7.0.33-11+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_codebank`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact_number` varchar(15) DEFAULT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `message` text,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`contact_id`, `name`, `email`, `contact_number`, `subject`, `message`, `created_on`) VALUES
(10, 'Ravi', 'ravi@getnada.com', NULL, '0', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam', '2019-10-17 19:29:37'),
(13, 'mohan', 'mohan.chapter2147@gmail.com', NULL, '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo', '2019-10-18 14:53:36'),
(14, 'tarun', 'tarun.chapter247@gmail.com', NULL, '0', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea', '2019-10-18 14:59:18'),
(15, 'Chanchal', 'chanchal.chapter247@gmail.com', NULL, '0', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2019-10-19 16:15:30');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `email_template_id` int(11) NOT NULL,
  `template_name` varchar(150) DEFAULT NULL,
  `template_subject` text,
  `template_layout` varchar(50) DEFAULT NULL COMMENT '0: default template',
  `template_body` text,
  `template_created` datetime NOT NULL,
  `template_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`email_template_id`, `template_name`, `template_subject`, `template_layout`, `template_body`, `template_created`, `template_updated`) VALUES
(17, 'Registration Confirmation', 'Registration Confirmation', 'layout1', '<p><strong>Hi, {name}!</strong></p>\r\n<p><br />Your account has been created successfully with Codebank and It\'s ready to be used.<br /> To access your account use below mentioned Credentials:</p>\r\n<p><strong>Email ID:</strong>&nbsp;{email}<br /> <strong>Password:</strong>&nbsp;{password}</p>\r\n<p><strong><a href="{link}" target="_blank">Click here to Login</a></strong></p>\r\n<p>The registration details contained in this email are provided by {site_name}.<br />It is a good idea for you to change your password the first time you log in to the site.</p>\r\n<p>&nbsp;</p>\r\n<p>Thank You! <br />Code Bank</p>', '2019-02-12 03:43:56', '2019-10-18 11:50:38'),
(23, 'Email Update', 'Email Update', 'layout3', '<h1 style="text-align: center;"><span style="color: #337ab7;">Email has been changed</span></h1>\r\n<h3>&nbsp;</h3>\r\n<p>Hello {name},</p>\r\n<p>Your email has been changed from {old_email} to {new_email}</p>', '2019-02-12 03:43:56', '2019-10-19 11:17:13'),
(25, 'Forgot Password', 'Forgot Password', 'layout2', '<h2 style="text-align: center;"><span style="color: #337ab7;">Forgot Password</span></h2>\r\n<h3>&nbsp;</h3>\r\n<p>Hello {name},</p>\r\n<p>It looks like you requested a new password.</p>\r\n<p>If that sounds right, you can enter the new password by clicking on the below link.</p>\r\n<p><a href="{link}" target="_blank">Click here</a></p>', '2019-02-12 03:43:56', '2019-10-21 17:10:55');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `faq_id` int(11) NOT NULL,
  `question` varchar(100) DEFAULT NULL,
  `answer` text,
  `order_by` float NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL COMMENT '0 = Inactive, 1 = Active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`faq_id`, `question`, `answer`, `order_by`, `status`, `created_at`, `updated_at`) VALUES
(3, 'How do I unsubscribe?', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 4, 1, '2019-05-11 18:16:40', '2019-10-17 19:39:37'),
(7, 'What do I get with a Subscription?', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 3, 0, '2019-05-11 19:14:36', '2019-10-18 15:29:58'),
(21, 'Lorem ipsum dolor sit amet, consectetur adipisicing eli ?', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 1, 1, '2019-10-18 17:06:49', '2019-10-18 17:07:18'),
(26, 'dsgdsg', '<p>dsg</p>', 0, 0, '2019-10-18 17:22:07', '2019-10-21 17:04:48');

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `lh_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`lh_id`, `user_id`, `ip_address`, `city`, `created_on`) VALUES
(106, 909, '::1', '', '2019-10-14 16:16:36'),
(107, 909, '::1', '', '2019-10-15 12:10:15'),
(108, 909, '::1', '', '2019-10-16 14:52:29'),
(109, 909, '::1', '', '2019-10-16 15:18:56'),
(110, 909, '::1', '', '2019-10-16 16:17:09'),
(111, 909, '::1', '', '2019-10-16 16:40:05'),
(112, 909, '::1', '', '2019-10-16 18:48:56'),
(113, 909, '::1', '', '2019-10-17 15:27:40'),
(114, 909, '::1', '', '2019-10-17 18:40:25');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(11) NOT NULL,
  `table_name` varchar(50) DEFAULT NULL,
  `activity` text,
  `log` longtext,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(2) DEFAULT '0' COMMENT '0=unread, 1=read'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `option_id` bigint(20) UNSIGNED NOT NULL,
  `option_name` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `option_value` longtext CHARACTER SET utf8,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1=text,2=image',
  `order` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`option_id`, `option_name`, `option_value`, `status`, `order`) VALUES
(1, 'FACEBOOK_URL', 'http://facebook.com/', 1, 1.00),
(2, 'TWITTER_URL', 'https://twitter.com/', 1, 2.00),
(6, 'INSTAGRAM_URL', 'https://www.instagram.com/', 1, 4.50),
(8, 'YOUTUBE_URL', 'https://www.youtube.com/', 1, 6.00),
(16, 'EMAIL', 'superadmin@codebank.com', 1, 8.00),
(17, 'SUPPORT_EMAIL', 'support@codebank.com', 1, 9.00),
(19, 'WEBSITE', 'http://www.example.com', 1, 11.00),
(20, 'PHONE', '+123456789', 1, 1.00),
(21, 'ADDRESS', '<span>301, Lorem test data Ipsum has been the industry,<br>orem Ipsum, Ipsum has been the industry,dummy text ever since the 1500s</span>', 1, 1.00),
(22, 'CURRENT_THEME', '{"sidebar_color":"#4f3f71","header_color":"#f9efef","sidebar_active_color":"#bfdaf1","sidebar_hover_color":"#b8e3f5","admin_dropdown":"#a430dc","btn_primary":"#1019c4","btn_default":"#646464","btn_danger":"#c9356a","btn_success":"#14a85e","modal_header":"#c09ee7"}', 1, 12.00),
(23, 'DEFAULT_THEME', '{"sidebar_color":"#653f71","header_color":"#b0b0b0","sidebar_active_color":"#bfdaf1","sidebar_hover_color":"#b8e3f5","admin_dropdown":"#a430dc","btn_primary":"#1019c4","btn_default":"#646464","btn_danger":"#c9356a","btn_success":"#14a85e","modal_header":"#7b0dfa"}', 1, 13.00);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `page_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_content` text COLLATE utf8mb4_unicode_ci,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=active 2=deactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `title`, `description`, `meta_description`, `meta_content`, `meta_keyword`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Privacy Policy', '<h4>What is Lorem Ipsum</h4>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\r\n<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\r\n<h5 class="privacy-content-spacer">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h5>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.</p>\r\n<h5 class="privacy-content-spacer">Lorem Ipsum has been the industry\'s standard dummy text:</h5>\r\n<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500.</p>\r\n<ul>\r\n<li>It has survived not only five centuries</li>\r\n<li>Lorem Ipsum is simply dummy text of the printing when an unknown printer took a galley of type and scrambled it to make.</li>\r\n<li>Remaining essentially unchanged when an unknown printer took a galley of type.</li>\r\n<li>Lorem Ipsum is simply dummy text of the printing</li>\r\n<li>It has survived not only five centuries</li>\r\n<li>Lorem Ipsum is simply dummy text of the printing when an unknown printer took a galley of type and scrambled it to make.</li>\r\n<li><a href="#">Remaining essentially unchanged</a> when an unknown printer took a galley of type.</li>\r\n<li>Lorem Ipsum is simply dummy text of the printing</li>\r\n</ul>\r\n<h4 class="privacy-content-spacer">Remaining Essentially Unchanged</h4>\r\n<p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\r\n<h4 class="privacy-content-spacer">What is Lorem Ipsum</h4>\r\n<p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. t has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. text of the printing and typesetting industry.</p>\r\n<h4 class="privacy-content-spacer">Remaining Essentially Unchanged</h4>\r\n<p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\r\n<h4 class="privacy-content-spacer">What is Lorem Ipsum</h4>\r\n<p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. t has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. text of the printing and typesetting industry.</p>\r\n<h4 class="privacy-content-spacer">Remaining Essentially Unchanged</h4>\r\n<p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\r\n<h4 class="privacy-content-spacer">What is Lorem Ipsum</h4>\r\n<p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. t has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. text of the printing and typesetting industry.</p>\r\n<h4 class="privacy-content-spacer">Remaining Essentially Unchanged</h4>\r\n<p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\r\n<h4 class="privacy-content-spacer">What is Lorem Ipsum</h4>\r\n<p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. t has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. text of the printing and typesetting industry.</p>', ' ', '', '', 1, '2018-01-15 11:04:19', '2019-05-13 06:52:18'),
(32, 'How It Works', '<div class="inner-banner-section">\r\n<div class="container">\r\n<div class="col-sm-12 text-center">\r\n<h1>How It Works</h1>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>\r\n</div>\r\n</div>\r\n</div>\r\n<section class="our-highlights-section">\r\n<div class="container">\r\n<div class="row our-highlights-content">\r\n<div class="col-sm-6">\r\n<h2><span>Our</span> Highlights</h2>\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>\r\n<div class="col-sm-6"><img src="assets/frontend/img/how-ourhilights-right.jpg" alt="" /></div>\r\n</div>\r\n</div>\r\n</section>\r\n<section class="how-we-work">\r\n<div class="container">\r\n<div class="row">\r\n<div class="col-sm-12">\r\n<h2 class="text-center"><span>How</span> It Works</h2>\r\n</div>\r\n</div>\r\n<div class="row how-we-work-content">\r\n<div class="col-sm-4">\r\n<div class="how-we-heading"><span>01</span>\r\n<h4>Signup</h4>\r\n</div>\r\n<p>Add a focused and productive edge to your study with instant access to our audio-visual notes and exam-material when you sign up for a SimpleStudy account.</p>\r\n</div>\r\n<div class="col-sm-4">\r\n<div class="how-we-heading"><span>02</span>\r\n<h4>Select Subjects</h4>\r\n</div>\r\n<p>Students can choose their subjects in order to start tracking their progress as they complete new topics and exam tasks on our platform.</p>\r\n</div>\r\n<div class="col-sm-4">\r\n<div class="how-we-heading"><span>03</span>\r\n<h4>Study Smart</h4>\r\n</div>\r\n<p>Smart study begins by using our digital homework journal to take note of weekly tasks, while using our carefully curated study notes whenever there is a topic you don&rsquo;t understand.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</section>\r\n<section class="our-mission">\r\n<div class="container">\r\n<h2 class="text-center"><span>Our</span> Mission</h2>\r\n<div class="row">\r\n<div class="col-sm-12 text-center">\r\n<div class="our-mission-content">SimpleStudy wants to change the online education market. We want to help students focus, achieve their potential, and eventually start to ask the right questions. Equally, we want to help digitalise the classroom to allow teachers the data they need to perform at their best. Yet at the core, our project is to innovate the way we teach so that we leave students capable of learning for themselves, a crucial skill that will be of benefit long after school exams. Watch our video to learn more about SimpleStudy and our vision as educators.</div>\r\n</div>\r\n</div>\r\n</div>\r\n</section>', '', '', '', 1, '2019-01-21 15:33:17', '2019-07-26 08:42:01'),
(8, 'Terms of Use', '<h4>What is Lorem Ipsum</h4>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\r\n<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\r\n<h5 class="terms-content-spacer">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h5>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.</p>\r\n<h5 class="terms-content-spacer">Lorem Ipsum has been the industry\'s standard dummy text:</h5>\r\n<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500.</p>\r\n<ul>\r\n<li>It has survived not only five centuries</li>\r\n<li>Lorem Ipsum is simply dummy text of the printing when an unknown printer took a galley of type and scrambled it to make.</li>\r\n<li>Remaining essentially unchanged when an unknown printer took a galley of type.</li>\r\n<li>Lorem Ipsum is simply dummy text of the printing</li>\r\n<li>It has survived not only five centuries</li>\r\n<li>Lorem Ipsum is simply dummy text of the printing when an unknown printer took a galley of type and scrambled it to make.</li>\r\n<li><a href="#">Remaining essentially unchanged</a> when an unknown printer took a galley of type.</li>\r\n<li>Lorem Ipsum is simply dummy text of the printing</li>\r\n</ul>\r\n<h4 class="terms-content-spacer">Remaining Essentially Unchanged</h4>\r\n<p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\r\n<h4 class="terms-content-spacer">What is Lorem Ipsum</h4>\r\n<p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. t has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. text of the printing and typesetting industry.</p>\r\n<h4 class="terms-content-spacer">Remaining Essentially Unchanged</h4>\r\n<p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\r\n<h4 class="terms-content-spacer">What is Lorem Ipsum</h4>\r\n<p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. t has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. text of the printing and typesetting industry.</p>\r\n<h4 class="terms-content-spacer">Remaining Essentially Unchanged</h4>\r\n<p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\r\n<h4 class="terms-content-spacer">What is Lorem Ipsum</h4>\r\n<p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. t has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. text of the printing and typesetting industry.</p>\r\n<h4 class="terms-content-spacer">Remaining Essentially Unchanged</h4>\r\n<p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\r\n<h4 class="terms-content-spacer">What is Lorem Ipsum</h4>\r\n<p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. t has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. text of the printing and typesetting industry.</p>', '', '', '', 1, '2018-03-01 13:42:46', '2019-05-13 07:06:24'),
(27, 'Contact Us', '<div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<div>\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n</div>\r\n<ul class="detail">\r\n<li class="map">301, Lorem Ipsum has been the industry,<br />orem Ipsum, Ipsum has been the industry,dummy text ever since the 1500s</li>\r\n<li class="phone"><a class="tel" href="tel:+1234567890">+1234567890</a></li>\r\n<li><a href="mailto:loremipsum@gmail.com">loremipsum@gmail.com</a></li>\r\n</ul>', '', '', '', 1, '2018-12-27 21:29:43', '2019-04-26 08:44:04'),
(29, 'About Us', '<div class="inner-banner-section">\r\n<div class="container">\r\n<div class="col-md-12 text-center">\r\n<h1>About Us</h1>\r\n<p>SimpleStudy is an all-inclusive study solution for both Leaving Cert and Junior Cert exams. Our platform offers curated study content alongside organizational and self-assessment tools to ensure that our students stay exam-focused both inside and outside of the classroom.</p>\r\n</div>\r\n</div>\r\n</div>\r\n<section class="about-boxes-wrap">\r\n<div class="container">&nbsp;</div>\r\n</section>\r\n<section class="about-who-section">\r\n<div class="container">\r\n<h2 class="text-center  main-heading heading">Who We Are</h2>\r\n<div class="row who-content-wrap">\r\n<div class="col-md-12">\r\n<p>SimpleStudy was founded by two smart lads from West Cork. Childhood friends, Oisin and Jack share an eclectic set of interests that range from film photography and physics to interior design and micro-economics. Creating a comprehensive online learning platform quickly turned from a weekend project into a growing business venture. Now studying Economics and Architecture respectively, we continue to grow and learn together, and hope to reflect that love of learning in everything we build at SimpleStudy.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</section>\r\n<section class="how-we-do">\r\n<div class="container">\r\n<h2 class="text-center  main-heading heading">What We Do</h2>\r\n<div class="row">\r\n<div class="col-md-12">\r\n<p>At SimpleStudy we are constantly working to enhance the student experience. Equally, we believe our technology can benefit in allowing teachers to innovate so that everyone can benefit from digital learning. No matter your level, we made studying online simple so you can use our platform wherever you are. Don&rsquo;t believe us? Here&rsquo;s how it works!</p>\r\n</div>\r\n</div>\r\n</div>\r\n</section>', '', '', '', 1, '2019-01-21 15:33:17', '2019-10-19 10:40:35');

-- --------------------------------------------------------

--
-- Table structure for table `paypal_temp_data`
--

CREATE TABLE `paypal_temp_data` (
  `id` int(11) NOT NULL,
  `data` text NOT NULL,
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paypal_temp_data`
--

INSERT INTO `paypal_temp_data` (`id`, `data`, `created`) VALUES
(747, '{"tx":"9PM31689X1318581V","st":"Pending","amt":"10.00","cc":"EUR","cm":"909","item_number":"1","sig":"gmiyHhszPnkjoyfI4uR9J\\/qPYo3Wlf6g0bAHWqjLFWe7VMV\\/+0n+uTKpC5DB+hLrV2D7I7yPrGyS6y1TwhR+RQPt5XCy4gVBBMAigjpLqNqE0kcbj+eDqajRWwDHVqnIqy2vfVs9F4vG8CdX7mzpmENRpCU9LlWN3xNqR5IbSvQ="}', '2019-10-18 12:53:50'),
(743, '{"tx":"7JR124303Y5253709","st":"Pending","amt":"10.00","cc":"EUR","cm":"909","item_number":"","sig":"VMHWiv8++xuFS0x63raAJU1oKn0QYNl+e\\/KG3t1KYsoB0vDg+cSxx44nQ8rgcYSUFyHhu++ymlFYq5MaSozus0JbXnZ6yZSu+VxPADMCP\\/88DSqaJToZCktQQXKt48vjpVUfy7osCVcDb+YOGIpJBSfSbWF3OmG8Ck9FbHQ+PtY="}', '2019-10-08 15:14:58'),
(746, '{"tx":"80481576YH3774127","st":"Pending","amt":"10.00","cc":"EUR","cm":"909","item_number":"10","sig":"Vd6Waq1OF+dH115hjMaOH1j78uGhs9iZfudaxlnqSL81A1LIIvf6s\\/8phtHrBPTmMlltkVap1wdYGx8q97NWh1ZZ\\/nIGpB\\/75tlIZ857BdKhygIpVAOhZEIVcMSS77DEz8opl0vEsRIFIibtxOGDWKKISf7j8j3f2XlPh2orYZU="}', '2019-10-08 17:20:17'),
(745, '{"tx":"7RF8083996717443P","st":"Pending","amt":"10.00","cc":"EUR","cm":"909","item_number":"","sig":"gnDK3qODDhleoqx\\/Y+oMMmzQrwAeCnGYjilY3njj38BbbvvK8mPJcsGiCpdzslhHjCcMq3eqtvORmSoTyEgBvpJy7ACJub9ul8DkuDe3XLF2OAfM\\/UyVtv1ldYNlMtFnNDdDPjT6dUtxQN5UzmVmaFfti6zWXDDgAs35k+Rvilc="}', '2019-10-08 15:34:11');

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE `support` (
  `support_id` int(11) NOT NULL,
  `ticket_id` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `replies` longtext,
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0=open,1=close',
  `is_new` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0:new message,1:old message',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `support`
--

INSERT INTO `support` (`support_id`, `ticket_id`, `user_id`, `name`, `email`, `contact_number`, `subject`, `replies`, `status`, `is_new`, `created_on`, `updated_on`) VALUES
(118, '1571406898', 909, 'Mohan', 'mohan.chapter247@gmail.com', '', '3', '[{"You":{"comment":"Lorem ipsum dolor sit amet, consectetur","date":"2019-10-18 07:24:58"}},{"Admin":{"comment":"Hi User\\r\\nThis is test message.","date":"2019-10-18 07:29:57"}},{"You":{"comment":"Hi admin","date":"2019-10-18 07:31:14"}},{"Admin":{"comment":"Hello Mohan","date":"2019-10-18 07:51:13"}},{"You":{"comment":"Hi","date":"2019-10-21 02:08:22"}},{"You":{"comment":"hello","date":"2019-10-21 02:12:10"}}]', 1, 1, '2019-10-18 19:24:58', '2019-10-21 16:38:17');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `secretKey` varchar(50) DEFAULT NULL,
  `transaction_type` int(11) NOT NULL COMMENT '1 = paypal, 2 = stripe',
  `amount` int(11) NOT NULL,
  `status` varchar(20) NOT NULL COMMENT '1 = Completed, 2 = Failure',
  `transaction_details` text NOT NULL,
  `txn_id` varchar(50) NOT NULL,
  `subscription_id` varchar(50) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `cancelled_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `user_id`, `secretKey`, `transaction_type`, `amount`, `status`, `transaction_details`, `txn_id`, `subscription_id`, `transaction_date`, `cancelled_date`) VALUES
(28, 909, NULL, 1, 10, 'Pending', '{"tx":"7JR124303Y5253709","st":"Pending","amt":"10.00","cc":"EUR","cm":"909","item_number":"","sig":"VMHWiv8++xuFS0x63raAJU1oKn0QYNl+e\\/KG3t1KYsoB0vDg+cSxx44nQ8rgcYSUFyHhu++ymlFYq5MaSozus0JbXnZ6yZSu+VxPADMCP\\/88DSqaJToZCktQQXKt48vjpVUfy7osCVcDb+YOGIpJBSfSbWF3OmG8Ck9FbHQ+PtY="}', '7JR124303Y5253709', '', '2019-10-08 15:14:58', NULL),
(29, 909, NULL, 1, 10, 'Pending', '{"tx":"7RF8083996717443P","st":"Pending","amt":"10.00","cc":"EUR","cm":"909","item_number":"","sig":"gnDK3qODDhleoqx\\/Y+oMMmzQrwAeCnGYjilY3njj38BbbvvK8mPJcsGiCpdzslhHjCcMq3eqtvORmSoTyEgBvpJy7ACJub9ul8DkuDe3XLF2OAfM\\/UyVtv1ldYNlMtFnNDdDPjT6dUtxQN5UzmVmaFfti6zWXDDgAs35k+Rvilc="}', '7RF8083996717443P', '', '2019-10-08 15:34:11', NULL),
(30, 909, NULL, 1, 10, 'Pending', '{"tx":"80481576YH3774127","st":"Pending","amt":"10.00","cc":"EUR","cm":"909","item_number":"10","sig":"Vd6Waq1OF+dH115hjMaOH1j78uGhs9iZfudaxlnqSL81A1LIIvf6s\\/8phtHrBPTmMlltkVap1wdYGx8q97NWh1ZZ\\/nIGpB\\/75tlIZ857BdKhygIpVAOhZEIVcMSS77DEz8opl0vEsRIFIibtxOGDWKKISf7j8j3f2XlPh2orYZU="}', '80481576YH3774127', '', '2019-10-08 17:20:17', NULL),
(31, 909, NULL, 1, 10, 'Pending', '{"tx":"9PM31689X1318581V","st":"Pending","amt":"10.00","cc":"EUR","cm":"909","item_number":"1","sig":"gmiyHhszPnkjoyfI4uR9J\\/qPYo3Wlf6g0bAHWqjLFWe7VMV\\/+0n+uTKpC5DB+hLrV2D7I7yPrGyS6y1TwhR+RQPt5XCy4gVBBMAigjpLqNqE0kcbj+eDqajRWwDHVqnIqy2vfVs9F4vG8CdX7mzpmENRpCU9LlWN3xNqR5IbSvQ="}', '9PM31689X1318581V', '', '2019-10-18 12:53:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_role` tinyint(4) NOT NULL COMMENT '0 = User, 1 = Superadmin, 2 = Subadmin',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0 = Inactive, 1 = Active',
  `new_password_key` varchar(50) NOT NULL,
  `is_verify` tinyint(4) NOT NULL,
  `user_type` tinyint(4) NOT NULL COMMENT '0 = System User, 1 = Teachable User',
  `last_login` datetime DEFAULT NULL,
  `login_status` int(11) NOT NULL COMMENT '0 = logout, 1 = login',
  `ip_address` varchar(20) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_role`, `name`, `contact`, `email`, `date_of_birth`, `password`, `status`, `new_password_key`, `is_verify`, `user_type`, `last_login`, `login_status`, `ip_address`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 1, 'Super Admin', '', 'superadmin@codebank.com', NULL, '9fc092651f5af3ae9b7d0a5bc69bbe5828bdfb85090710c18e69d6a6ae85c4773119bdce80cf88e91bb2ce17b826b858e21a0f692fc1fcde96da6002e78b45b1rNo/CV7JNNTZ/ZqjZxEJjU68sSo82ytqz15a3KikBo8=', 1, 'ba4002d88b8860b6a684ade8357aba56', 0, 0, '2019-04-10 14:05:32', 0, '', 1, '2019-02-13 00:00:00', 1, '2019-10-17 18:34:21'),
(887, 0, 'Chanchal', '9898989898', 'chanchal.chapter@gmail.com', '0000-00-00', '6c5973fcffb0ef1d41921f5464d46c07d40012c2bfe88243b8e0b1251e21a829b318ad245aa4c634952fc1fa59d60bd8b5bed2a9e1ff7d38eba2037c29fee1a2TQYsZL5jyFR2rjhJ+pKTR29y74c1nBIFkMoJVkkyIAQ=', 1, '', 1, 0, '2019-10-21 18:03:45', 0, '::1', NULL, '2019-09-03 00:44:27', NULL, '2019-10-21 18:03:45'),
(908, 0, 'Chapter247', '1236549871', 'test.chapter247@gmail.com', '0000-00-00', 'b079f91c7ea75b8c5ef5bc18982d2153480c5d63e83962d7df03c047d88a5fb1eb719b177d9828e5fc46b308ec52d0dbc4d969d99d45a3370a5caf887239e94bAmxMXTTmq1fhQO4VqxiXeP9U9Hmh4Mf8QVavjW6Wo1U=', 0, '', 1, 0, '2019-10-21 17:21:43', 0, '::1', NULL, '2019-09-09 18:34:21', NULL, '2019-10-21 17:21:43'),
(909, 0, 'Mohan', '', 'mohan.chapter247@gmail.com', '0000-00-00', 'f7f3ca5581d1f0c80f40eabf6189257388f8c80c44260f64216877d774338e3218cb3ecb1793d1acd486f11a87c68ba4442b6efc51114992aa2befd819602720dke5c/O1uYQ47EcjU3A9LK9liZK5k3IbW1QVaCnLWy4=', 0, '', 1, 0, '2019-10-21 14:08:12', 0, '::1', NULL, '2019-09-13 12:47:32', NULL, '2019-10-21 14:08:12'),
(913, 0, 'John Doe', '1231231234', 'johndoe@gmail.com', NULL, '', 1, '', 0, 0, NULL, 0, '', NULL, '2019-10-21 17:22:00', NULL, '2019-10-21 17:22:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`email_template_id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`lh_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`option_id`),
  ADD UNIQUE KEY `option_name` (`option_name`),
  ADD KEY `option_name_2` (`option_name`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `paypal_temp_data`
--
ALTER TABLE `paypal_temp_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`support_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `email_template_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `lh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `option_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `paypal_temp_data`
--
ALTER TABLE `paypal_temp_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=748;
--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `support_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=914;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_history`
--
ALTER TABLE `login_history`
  ADD CONSTRAINT `login_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `support`
--
ALTER TABLE `support`
  ADD CONSTRAINT `support_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
