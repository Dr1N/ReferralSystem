-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Окт 22 2015 г., 01:31
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `referral_system`
--

-- --------------------------------------------------------

--
-- Структура таблицы `rf_campaign`
--

CREATE TABLE IF NOT EXISTS `rf_campaign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `alias` varchar(100) NOT NULL DEFAULT '',
  `site_url` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `code` varchar(16) NOT NULL,
  `active` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  KEY `organization_id` (`organization_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `rf_campaign`
--

INSERT INTO `rf_campaign` (`id`, `organization_id`, `user_id`, `name`, `alias`, `site_url`, `image`, `code`, `active`) VALUES
(1, 4, 4, 'DesignContest Promo', 'designcontest_promo', 'http://www.designcontest.com/', '20140329172506.jpg', '1234567890', 'yes'),
(2, 2, 2, 'Apple Promo', 'apple_promo', 'www.promo.aggle.com', '', '1234567890', 'yes'),
(3, 2, 3, 'Microsoft Promo', 'microsoft_promo', 'www.promomicrosoft.com', '', '1234567890', 'yes'),
(4, 4, 4, 'Inter Promo', 'Core Processors', 'www.promo-intel.com', '20131212213000.gif', '1234567890', 'yes');

-- --------------------------------------------------------

--
-- Структура таблицы `rf_campaign_click`
--

CREATE TABLE IF NOT EXISTS `rf_campaign_click` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `used_way` enum('mail','facebook','twitter','link') NOT NULL DEFAULT 'link',
  `ip_address` int(10) unsigned NOT NULL,
  `clicked_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `owner_id` (`owner_id`),
  KEY `campaign_id` (`campaign_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `rf_campaign_click`
--

INSERT INTO `rf_campaign_click` (`id`, `owner_id`, `campaign_id`, `used_way`, `ip_address`, `clicked_at`) VALUES
(1, 1, 1, 'mail', 1234567890, '0013-06-19 00:00:00'),
(2, 1, 1, 'facebook', 1234567890, '0013-06-19 00:00:00'),
(3, 1, 2, 'twitter', 1234567890, '0013-06-19 00:00:00'),
(4, 1, 1, 'link', 1234567890, '0013-06-19 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `rf_campaign_purchase`
--

CREATE TABLE IF NOT EXISTS `rf_campaign_purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `used_way` enum('mail','facebook','twitter','link') NOT NULL DEFAULT 'link',
  `ip_address` int(10) unsigned NOT NULL,
  `amount` float(5,2) NOT NULL DEFAULT '0.00',
  `paid_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `owner_id` (`owner_id`),
  KEY `campaign_id` (`campaign_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `rf_campaign_purchase`
--

INSERT INTO `rf_campaign_purchase` (`id`, `owner_id`, `campaign_id`, `used_way`, `ip_address`, `amount`, `paid_at`) VALUES
(1, 1, 1, 'mail', 1234567890, 40.00, '2013-06-19 00:00:00'),
(2, 1, 2, 'facebook', 1234567890, 39.99, '2013-06-19 00:00:00'),
(3, 2, 2, 'twitter', 1234567890, 12.00, '2013-06-05 09:49:48'),
(4, 3, 1, 'link', 1234567890, 45.00, '2013-05-01 11:16:27');

-- --------------------------------------------------------

--
-- Структура таблицы `rf_campaign_setting`
--

CREATE TABLE IF NOT EXISTS `rf_campaign_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` int(11) NOT NULL,
  `referral_prize` float(5,2) NOT NULL DEFAULT '0.00',
  `recipient_prize` float(5,2) NOT NULL DEFAULT '0.00',
  `min_payout` float(5,2) NOT NULL DEFAULT '0.00',
  `message_mail` text NOT NULL,
  `message_facebook` text NOT NULL,
  `message_twitter` varchar(140) NOT NULL DEFAULT '',
  `enable_mail` enum('yes','no') NOT NULL DEFAULT 'yes',
  `enable_facebook` enum('yes','no') NOT NULL DEFAULT 'yes',
  `enable_twitter` enum('yes','no') NOT NULL DEFAULT 'yes',
  `enable_link` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  KEY `campaign_id` (`campaign_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `rf_campaign_setting`
--

INSERT INTO `rf_campaign_setting` (`id`, `campaign_id`, `referral_prize`, `recipient_prize`, `min_payout`, `message_mail`, `message_facebook`, `message_twitter`, `enable_mail`, `enable_facebook`, `enable_twitter`, `enable_link`) VALUES
(1, 1, 15.00, 6.00, 50.00, '', 'face', 'tweet', 'yes', 'yes', 'yes', 'yes'),
(2, 2, 10.00, 3.50, 46.00, '', 'face', 'tweet', 'yes', 'yes', 'yes', 'yes'),
(3, 3, 10.00, 3.25, 55.00, '', 'face', 'tweet', 'yes', 'yes', 'yes', 'yes'),
(4, 4, 20.00, 5.00, 50.00, '', 'face', 'tweet', 'yes', 'yes', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Структура таблицы `rf_campaign_user`
--

CREATE TABLE IF NOT EXISTS `rf_campaign_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `amount_earned` float(5,2) NOT NULL DEFAULT '0.00',
  `amount_pending` float(5,2) NOT NULL DEFAULT '0.00',
  `active` enum('yes','no') NOT NULL DEFAULT 'yes',
  `code` varchar(16) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `campaign_id` (`campaign_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `rf_campaign_user`
--

INSERT INTO `rf_campaign_user` (`id`, `user_id`, `campaign_id`, `amount_earned`, `amount_pending`, `active`, `code`) VALUES
(1, 4, 4, -999.99, 999.99, 'yes', 'a88aeeec495b4cbe'),
(2, 4, 1, 500.00, 300.00, 'yes', 'a88aeeec495b4cbe');

-- --------------------------------------------------------

--
-- Структура таблицы `rf_country`
--

CREATE TABLE IF NOT EXISTS `rf_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `phone_code` int(5) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=246 ;

--
-- Дамп данных таблицы `rf_country`
--

INSERT INTO `rf_country` (`id`, `name`, `phone_code`) VALUES
(1, 'United States', 1),
(2, 'Canada', 1),
(3, 'United Kingdom', 44),
(4, 'Australia', 61),
(5, 'Abkhazia', 7),
(6, 'Afghanistan', 93),
(7, 'Ajaria', 995),
(8, 'Akrotiri and Dhekelia', 357),
(9, 'Albania', 355),
(10, 'Algeria', 213),
(11, 'American Samoa', 1684),
(12, 'Andorra', 376),
(13, 'Angola', 244),
(14, 'Anguilla', 1264),
(15, 'Antigua and Barbuda', 1268),
(16, 'Argentina', 54),
(17, 'Armenia', 374),
(18, 'Aruba', 297),
(19, 'Austria', 43),
(20, 'Azerbaijan', 994),
(21, 'Bahamas', 1242),
(22, 'Bahrain', 973),
(23, 'Bangladesh', 880),
(24, 'Barbados', 1246),
(25, 'Belarus', 375),
(26, 'Belgium', 32),
(27, 'Belize', 501),
(28, 'Benin', 229),
(29, 'Bermuda', 1441),
(30, 'Bhutan', 975),
(31, 'Bolivia', 591),
(32, 'Bosnia and Herzegovina', 387),
(33, 'Botswana', 267),
(34, 'Brazil', 55),
(35, 'British Antarctic Territory', 0),
(36, 'British Indian Ocean Territory', 246),
(37, 'British Virgin Islands', 1284),
(38, 'Brunei', 673),
(39, 'Bulgaria', 359),
(40, 'Burkina Faso', 226),
(41, 'Burma', 95),
(42, 'Burundi', 257),
(43, 'Cambodia', 855),
(44, 'Cameroon', 237),
(45, 'Cape Verde', 238),
(46, 'Cayman Islands', 1345),
(47, 'Central African Republic', 236),
(48, 'Chad', 235),
(49, 'Chile', 56),
(50, 'China', 86),
(51, 'Christmas Island', 61),
(52, 'Cocos (Keeling) Islands', 61),
(53, 'Colombia', 57),
(54, 'Comoros', 269),
(55, 'Congo-Brazzaville', 242),
(56, 'Congo-Kinshasa', 243),
(57, 'Cook Islands', 682),
(58, 'Costa Rica', 506),
(59, 'Cote d''Ivoire', 225),
(60, 'Crimea', 380),
(61, 'Croatia', 385),
(62, 'Cuba', 53),
(63, 'Cyprus', 357),
(64, 'Czech Republic', 420),
(65, 'Denmark', 45),
(66, 'Djibouti', 253),
(67, 'Dominica', 1767),
(68, 'Dominican Republic', 1809),
(69, 'East Timor', 670),
(70, 'Ecuador', 593),
(71, 'Egypt', 20),
(72, 'El Salvador', 503),
(73, 'Equatorial Guinea', 240),
(74, 'Eritrea', 291),
(75, 'Estonia', 372),
(76, 'Ethiopia', 251),
(77, 'Falkland Islands', 500),
(78, 'Faroe Islands', 298),
(79, 'Federated States of Micronesia', 691),
(80, 'Fiji', 679),
(81, 'Finland', 358),
(82, 'France', 33),
(83, 'French Southern and Antarctic Lands', 262),
(84, 'Gabon', 241),
(85, 'Gambia', 220),
(86, 'Georgia', 995),
(87, 'Germany', 49),
(88, 'Ghana', 233),
(89, 'Gibraltar', 350),
(90, 'Greece', 30),
(91, 'Greenland', 299),
(92, 'Grenada', 1473),
(93, 'Guam', 1671),
(94, 'Guatemala', 502),
(95, 'Guinea', 224),
(96, 'Guinea-Bissau', 245),
(97, 'Guyana', 592),
(98, 'Haiti', 509),
(99, 'Honduras', 504),
(100, 'Hong Kong', 852),
(101, 'Hungary', 36),
(102, 'Iceland', 354),
(103, 'India', 91),
(104, 'Indonesia', 62),
(105, 'Iran', 98),
(106, 'Iraq', 964),
(107, 'Ireland', 353),
(108, 'Israel', 972),
(109, 'Italy', 39),
(110, 'Jamaica', 1876),
(111, 'Japan', 81),
(112, 'Jordan', 962),
(113, 'Karakalpakstan', 998),
(114, 'Kazakhstan', 7),
(115, 'Kenya', 254),
(116, 'Kiribati', 686),
(117, 'Kosovo', 381),
(118, 'Kuwait', 965),
(119, 'Kyrgyzstan', 996),
(120, 'Laos', 856),
(121, 'Latvia', 371),
(122, 'Lebanon', 961),
(123, 'Lesotho', 266),
(124, 'Liberia', 231),
(125, 'Libya', 218),
(126, 'Liechtenstein', 423),
(127, 'Lithuania', 370),
(128, 'Luxembourg', 352),
(129, 'Macau', 853),
(130, 'Macedonia', 389),
(131, 'Madagascar', 261),
(132, 'Malawi', 265),
(133, 'Malaysia', 60),
(134, 'Maldives', 960),
(135, 'Mali', 223),
(136, 'Malta', 356),
(137, 'Marshall Islands', 692),
(138, 'Mauritania', 222),
(139, 'Mauritius', 230),
(140, 'Mayotte', 262),
(141, 'Mexico', 52),
(142, 'Moldova', 373),
(143, 'Monaco', 377),
(144, 'Mongolia', 976),
(145, 'Montenegro', 382),
(146, 'Montserrat', 1664),
(147, 'Morocco', 212),
(148, 'Mozambique', 258),
(149, 'Nagorno-Karabakh Republic', 374),
(150, 'Namibia', 264),
(151, 'Nauru', 674),
(152, 'Nepal', 977),
(153, 'Netherlands', 31),
(154, 'Netherlands Antilles', 599),
(155, 'New Caledonia', 687),
(156, 'New Zealand', 64),
(157, 'Nicaragua', 505),
(158, 'Niger', 227),
(159, 'Nigeria', 234),
(160, 'Niue', 683),
(161, 'Norfolk Island', 672),
(162, 'North Korea', 850),
(163, 'Northern Cyprus', 90392),
(164, 'Northern Mariana Islands', 1670),
(165, 'Norway', 47),
(166, 'Oman', 968),
(167, 'Pakistan', 92),
(168, 'Palau', 680),
(169, 'Palestine', 970),
(170, 'Panama', 507),
(171, 'Papua New Guinea', 675),
(172, 'Paraguay', 595),
(173, 'Peru', 51),
(174, 'Philippines', 63),
(175, 'Pitcairn Islands', 870),
(176, 'Poland', 48),
(177, 'Polynesia', 689),
(178, 'Portugal', 351),
(179, 'Puerto Rico', 1),
(180, 'Qatar', 974),
(181, 'Romania', 40),
(182, 'Russia', 7),
(183, 'Rwanda', 250),
(184, 'Saint Barthelemy', 590),
(185, 'Saint Helena', 290),
(186, 'Saint Kitts and Nevis', 1869),
(187, 'Saint Lucia', 1758),
(188, 'Saint Martin', 1599),
(189, 'Saint Pierre and Miquelon', 508),
(190, 'Saint Vincent and the Grenadines', 1784),
(191, 'Samoa', 685),
(192, 'San Marino', 378),
(193, 'Sao Tome and Principe', 239),
(194, 'Saudi Arabia', 966),
(195, 'Senegal', 221),
(196, 'Serbia', 381),
(197, 'Seychelles', 248),
(198, 'Sierra Leone', 232),
(199, 'Singapore', 65),
(200, 'Slovakia', 421),
(201, 'Slovenia', 386),
(202, 'Solomon Islands', 677),
(203, 'Somalia', 252),
(204, 'Somaliland', 252),
(205, 'South Africa', 27),
(206, 'South Georgia and the South Sandwich Islands', 500),
(207, 'South Korea', 82),
(208, 'South Ossetia', 99534),
(209, 'Spain', 34),
(210, 'Sri Lanka', 94),
(211, 'Sudan', 249),
(212, 'Suriname', 597),
(213, 'Swaziland', 268),
(214, 'Sweden', 46),
(215, 'Switzerland', 41),
(216, 'Syria', 963),
(217, 'Taiwan', 886),
(218, 'Tajikistan', 992),
(219, 'Tanzania', 255),
(220, 'Thailand', 66),
(221, 'Togo', 228),
(222, 'Tokelau', 690),
(223, 'Tonga', 676),
(224, 'Transnistria', 373),
(225, 'Trinidad and Tobago', 1868),
(226, 'Tunisia', 216),
(227, 'Turkey', 90),
(228, 'Turkmenistan', 993),
(229, 'Turks and Caicos Islands', 1649),
(230, 'Tuvalu', 688),
(231, 'Uganda', 256),
(232, 'Ukraine', 380),
(233, 'United Arab Emirates', 971),
(234, 'United States Virgin Islands', 1340),
(235, 'Uruguay', 598),
(236, 'Uzbekistan', 998),
(237, 'Vanuatu', 678),
(238, 'Vatican City', 379),
(239, 'Venezuela', 58),
(240, 'Vietnam', 84),
(241, 'Wallis and Futuna', 681),
(242, 'Western Sahara', 212),
(243, 'Yemen', 967),
(244, 'Zambia', 260),
(245, 'Zimbabwe', 263);

-- --------------------------------------------------------

--
-- Структура таблицы `rf_imported_mail`
--

CREATE TABLE IF NOT EXISTS `rf_imported_mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `sent_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` enum('sent','not_sent') NOT NULL DEFAULT 'not_sent',
  `added_type` varchar(8) NOT NULL DEFAULT 'manually',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `campaign_id` (`campaign_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `rf_imported_mail`
--

INSERT INTO `rf_imported_mail` (`id`, `user_id`, `campaign_id`, `mail`, `sent_at`, `status`, `added_type`) VALUES
(1, 1, 1, 't-gold@mail.ru', '2013-06-18 00:00:00', 'sent', 'manually');

-- --------------------------------------------------------

--
-- Структура таблицы `rf_industry`
--

CREATE TABLE IF NOT EXISTS `rf_industry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Дамп данных таблицы `rf_industry`
--

INSERT INTO `rf_industry` (`id`, `name`) VALUES
(1, 'Accounting'),
(2, 'Automotive'),
(3, 'Beauty'),
(4, 'Construction'),
(5, 'Consulting'),
(6, 'Education'),
(7, 'Entertainment'),
(8, 'Events'),
(9, 'Financial and Insurance'),
(10, 'Home and Garden'),
(11, 'Internet'),
(12, 'Legal'),
(13, 'Manufacturing and Wholesale'),
(14, 'Media'),
(15, 'Medical and Dental'),
(16, 'Natural Resources'),
(17, 'Non-Profit'),
(18, 'Real Estate'),
(19, 'Religious'),
(20, 'Restaurant'),
(21, 'Retail'),
(22, 'Service Industries'),
(23, 'Sports and Recreation'),
(24, 'Technology'),
(25, 'Travel and Hospitality');

-- --------------------------------------------------------

--
-- Структура таблицы `rf_invitation`
--

CREATE TABLE IF NOT EXISTS `rf_invitation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `inviter_id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `status` enum('invited','registered') NOT NULL DEFAULT 'invited',
  `code` varchar(16) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `inviter_id` (`inviter_id`),
  KEY `organization_id` (`organization_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `rf_invitation`
--

INSERT INTO `rf_invitation` (`id`, `user_id`, `inviter_id`, `organization_id`, `status`, `code`) VALUES
(10, 3, 4, 4, 'invited', '0ab3ccb82336b69b'),
(11, 5, 4, 4, 'invited', '8497a1cc70f42de1');

-- --------------------------------------------------------

--
-- Структура таблицы `rf_organization`
--

CREATE TABLE IF NOT EXISTS `rf_organization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `site_url` varchar(255) NOT NULL DEFAULT '',
  `country_id` int(11) DEFAULT NULL,
  `postal_code` varchar(5) NOT NULL DEFAULT '',
  `state` varchar(100) NOT NULL DEFAULT '',
  `city` varchar(100) NOT NULL DEFAULT '',
  `address_line_1` varchar(100) NOT NULL DEFAULT '',
  `address_line_2` varchar(100) NOT NULL DEFAULT '',
  `industry_id` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `country_id` (`country_id`),
  KEY `industry_id` (`industry_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `rf_organization`
--

INSERT INTO `rf_organization` (`id`, `name`, `site_url`, `country_id`, `postal_code`, `state`, `city`, `address_line_1`, `address_line_2`, `industry_id`, `description`) VALUES
(1, 'DesignContest', 'http://www.designcontest.com/', 1, '', '', '', '', '', 24, ''),
(2, 'Apple', 'www.apple.com', 1, '', '', '', '', '', 24, 'iPad, iPod, iPhone'),
(3, 'Microsoft', 'www.microsoft.com', 1, '', '', '', '', '', 24, 'Windows, XBOX'),
(4, 'Intel', 'http://www.intel.com', 1, '10050', 'Oslo', 'Oslo', 'Norwen Street', 'Norwen Street', 24, 'Core Processors'),
(5, 'Amd', 'www.amd.com', 1, '', '', '', '', '', 24, 'Athlon');

-- --------------------------------------------------------

--
-- Структура таблицы `rf_page`
--

CREATE TABLE IF NOT EXISTS `rf_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `page_url` varchar(100) NOT NULL,
  `link_name` varchar(100) NOT NULL,
  `type` enum('html','code','both','alias') NOT NULL DEFAULT 'html',
  `access` enum('guest','insider') NOT NULL DEFAULT 'guest',
  `sorting` int(4) unsigned NOT NULL DEFAULT '0',
  `visible_main` enum('yes','no') NOT NULL DEFAULT 'yes',
  `visible_bottom` enum('yes','no') NOT NULL DEFAULT 'no',
  `dropdown` enum('yes','no') NOT NULL DEFAULT 'no',
  `title` varchar(100) NOT NULL DEFAULT '',
  `meta_keywords` varchar(255) NOT NULL DEFAULT '',
  `meta_description` varchar(255) NOT NULL DEFAULT '',
  `meta_author` varchar(100) NOT NULL DEFAULT '',
  `meta_creator` varchar(100) NOT NULL DEFAULT '',
  `meta_title` varchar(100) NOT NULL DEFAULT '',
  `meta_subject` varchar(100) NOT NULL DEFAULT '',
  `meta_date` varchar(100) NOT NULL DEFAULT '',
  `meta_identifier` varchar(100) NOT NULL DEFAULT '',
  `meta_type` varchar(100) NOT NULL DEFAULT '',
  `meta_language` varchar(100) NOT NULL DEFAULT '',
  `header` varchar(100) NOT NULL DEFAULT '',
  `text_page` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `rf_page`
--

INSERT INTO `rf_page` (`id`, `parent_id`, `page_url`, `link_name`, `type`, `access`, `sorting`, `visible_main`, `visible_bottom`, `dropdown`, `title`, `meta_keywords`, `meta_description`, `meta_author`, `meta_creator`, `meta_title`, `meta_subject`, `meta_date`, `meta_identifier`, `meta_type`, `meta_language`, `header`, `text_page`) VALUES
(1, 0, 'site/index', 'Main', 'both', 'guest', 1, 'yes', 'no', 'no', '', '', '', '', '', '', '', '', '', '', '', '', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.'),
(2, 0, 'site/help', 'FAQ', 'both', 'guest', 2, 'no', 'yes', 'no', '', '', '', '', '', '', '', '', '', '', '', '', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.'),
(3, 0, 'site/terms', 'Terms and Conditions', 'both', 'guest', 3, 'no', 'yes', 'no', '', '', '', '', '', '', '', '', '', '', '', '', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.'),
(4, 0, 'user/profile', 'My Profile', 'both', 'insider', 4, 'no', 'no', 'no', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, 0, 'user/update', 'Update My Profile', 'both', 'insider', 5, 'no', 'no', 'no', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(6, 0, 'user/password', '', 'both', 'insider', 6, 'no', 'no', 'no', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(7, 0, 'organization/profile', 'Organization', 'both', 'insider', 7, 'yes', 'no', 'no', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(8, 0, 'organization/create', 'Register Organization', 'both', 'insider', 8, 'no', 'no', 'no', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(9, 0, 'organization/update', 'Update My Organization', 'both', 'insider', 9, 'no', 'no', 'no', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(10, 0, 'campaign/list', 'Campaigns', 'both', 'insider', 10, 'yes', 'no', 'yes', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(11, 0, 'campaign/add', 'Add Campaign', 'both', 'insider', 11, 'no', 'no', 'no', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(12, 0, 'campaign/edit', 'Edit Campaign', 'both', 'insider', 12, 'no', 'no', 'no', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(13, 0, 'campaign/tracking', 'Campaign Tracking', 'both', 'insider', 13, 'no', 'no', 'no', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(14, 0, 'colleague/list', 'Colleagues', 'both', 'insider', 14, 'yes', 'no', 'no', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(15, 0, 'colleague/add', 'Add Colleague', 'both', 'insider', 15, 'no', 'no', 'no', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(16, 0, 'colleague/edit', 'Edit Colleague', 'both', 'insider', 16, 'no', 'no', 'no', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(17, 0, 'payout/list', 'Payouts', 'both', 'insider', 17, 'yes', 'no', 'no', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18, 0, 'site/contact', 'Contact Us', 'both', 'guest', 18, 'no', 'yes', 'no', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(19, 0, 'site/program', 'Refer a Friend Program', 'both', 'insider', 19, 'no', 'no', 'no', '', '', '', '', '', '', '', '', '', '', '', '', '<p>Get a $15 reward for each friend you refer when they send their first transfer.</p><p>Just follow these three easy steps to start earning rewards:</p><h2>Sign up and refer via Email, Facebook, or Twitter</h2><p>Click on the start referring button below, import your friend''s email addresses, or post to Facebook or Twitter.</p><h2>Your friends click on your link and send their 1st transfer</h2><p>Your friends MUST click on your personal referral link and then send their first money transfer for you and your friend to receive your rewards.</p><h2>Both you and your friend get a $15 reward via email</h2><p>Both you and your friend will receive a $15 electronic gift card via email within 2 business days after your friend'),
(20, 0, 'site/logout', 'Logout', 'both', 'insider', 20, 'no', 'no', 'no', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `rf_payout`
--

CREATE TABLE IF NOT EXISTS `rf_payout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `amount` float(5,2) NOT NULL DEFAULT '0.00',
  `end_amount` float(5,2) NOT NULL DEFAULT '0.00',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` enum('pending','completed','rejected') NOT NULL DEFAULT 'pending',
  `payout_way` enum('paypal','westernunion') NOT NULL DEFAULT 'paypal',
  `details` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `campaign_id` (`campaign_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `rf_payout`
--

INSERT INTO `rf_payout` (`id`, `user_id`, `campaign_id`, `amount`, `end_amount`, `created_at`, `status`, `payout_way`, `details`) VALUES
(10, 4, 4, 65.00, 735.00, '2013-12-04 20:09:16', 'pending', 'paypal', '{"mail":"fasf@fasf.ru"}'),
(11, 4, 4, 89.00, 696.00, '2013-12-13 20:04:29', 'pending', 'paypal', '{"mail":"drn_edfsa@mail.ru"}'),
(12, 4, 4, 111.00, 140.00, '2013-12-18 19:54:10', 'pending', 'paypal', '{"mail":"pay@mail.ru"}');

-- --------------------------------------------------------

--
-- Структура таблицы `rf_user`
--

CREATE TABLE IF NOT EXISTS `rf_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_id` int(11) DEFAULT NULL,
  `mail` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL DEFAULT '',
  `last_name` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `city` varchar(100) NOT NULL DEFAULT '',
  `address` varchar(100) NOT NULL DEFAULT '',
  `phone` varchar(14) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  `type` enum('admin','insider','user') NOT NULL DEFAULT 'user',
  `verified` enum('yes','no') NOT NULL DEFAULT 'no',
  `active` enum('yes','no') NOT NULL DEFAULT 'yes',
  `registered_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_login_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `organization_id` (`organization_id`),
  KEY `country_id` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `rf_user`
--

INSERT INTO `rf_user` (`id`, `organization_id`, `mail`, `first_name`, `last_name`, `password`, `country_id`, `city`, `address`, `phone`, `image`, `birthday`, `type`, `verified`, `active`, `registered_at`, `last_login_at`) VALUES
(1, 1, 'tetyanan@designcontest.com', 'Tanya', 'Nazarchuk', '765bdb72c79d64432306cf6074b81ec8', 1, 'Zaporozhye', '', '+30968308708', '', '2013-01-01', 'admin', 'yes', 'yes', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 'steve@apple.com', 'Steve', 'Jobs', '765bdb72c79d64432306cf6074b81ec8', 12, 'California', '', '+380973213457', '', '1950-04-23', 'admin', 'yes', 'yes', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, NULL, 'bill@microsoft.com', 'Bill', 'Gates', '765bdb72c79d64432306cf6074b81ec8', 12, 'Sietl', '', '+709934567876', '', '2013-05-23', 'user', 'yes', 'yes', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 4, 'drn_exp@mail.ru', 'Albert', 'Einstein', '765bdb72c79d64432306cf6074b81ec8', 61, 'Zaporozhye', 'st. Voronina', '+380994304508', '20140329172631.gif', '1984-03-06', 'admin', 'yes', 'yes', '0000-00-00 00:00:00', '2014-04-29 13:15:26'),
(5, NULL, 'fasdfas@fdsaf.re', '', '', '7b4bade13d1d4f4a9571a7cebbbd9366', NULL, '', '', '', '', '0000-00-00', 'insider', 'no', 'yes', '2014-01-02 01:38:34', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `rf_user_statistic`
--

CREATE TABLE IF NOT EXISTS `rf_user_statistic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `used_way` enum('mail','facebook','twitter','link') NOT NULL DEFAULT 'link',
  `clicks_amount` int(11) NOT NULL DEFAULT '0',
  `earnings_amount` float(6,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `rf_campaign`
--
ALTER TABLE `rf_campaign`
  ADD CONSTRAINT `rf_campaign_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `rf_organization` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rf_campaign_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `rf_user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `rf_campaign_click`
--
ALTER TABLE `rf_campaign_click`
  ADD CONSTRAINT `rf_campaign_click_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `rf_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rf_campaign_click_ibfk_2` FOREIGN KEY (`campaign_id`) REFERENCES `rf_campaign` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `rf_campaign_purchase`
--
ALTER TABLE `rf_campaign_purchase`
  ADD CONSTRAINT `rf_campaign_purchase_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `rf_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rf_campaign_purchase_ibfk_2` FOREIGN KEY (`campaign_id`) REFERENCES `rf_campaign` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `rf_campaign_setting`
--
ALTER TABLE `rf_campaign_setting`
  ADD CONSTRAINT `rf_campaign_setting_ibfk_1` FOREIGN KEY (`campaign_id`) REFERENCES `rf_campaign` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `rf_campaign_user`
--
ALTER TABLE `rf_campaign_user`
  ADD CONSTRAINT `rf_campaign_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `rf_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rf_campaign_user_ibfk_2` FOREIGN KEY (`campaign_id`) REFERENCES `rf_campaign` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `rf_imported_mail`
--
ALTER TABLE `rf_imported_mail`
  ADD CONSTRAINT `rf_imported_mail_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `rf_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rf_imported_mail_ibfk_2` FOREIGN KEY (`campaign_id`) REFERENCES `rf_campaign` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `rf_invitation`
--
ALTER TABLE `rf_invitation`
  ADD CONSTRAINT `rf_invitation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `rf_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rf_invitation_ibfk_2` FOREIGN KEY (`inviter_id`) REFERENCES `rf_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rf_invitation_ibfk_3` FOREIGN KEY (`organization_id`) REFERENCES `rf_organization` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `rf_organization`
--
ALTER TABLE `rf_organization`
  ADD CONSTRAINT `rf_organization_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `rf_country` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `rf_organization_ibfk_2` FOREIGN KEY (`industry_id`) REFERENCES `rf_industry` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `rf_payout`
--
ALTER TABLE `rf_payout`
  ADD CONSTRAINT `rf_payout_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `rf_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rf_payout_ibfk_2` FOREIGN KEY (`campaign_id`) REFERENCES `rf_campaign` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `rf_user`
--
ALTER TABLE `rf_user`
  ADD CONSTRAINT `rf_user_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `rf_organization` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `rf_user_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `rf_country` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `rf_user_statistic`
--
ALTER TABLE `rf_user_statistic`
  ADD CONSTRAINT `rf_user_statistic_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `rf_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
