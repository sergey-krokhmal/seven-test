-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 07 2017 г., 23:36
-- Версия сервера: 5.7.13
-- Версия PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tree`
--

-- --------------------------------------------------------

--
-- Структура таблицы `departs`
--

CREATE TABLE IF NOT EXISTS `departs` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(256) NOT NULL,
  `parent` int(10) unsigned DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `departs`
--

INSERT INTO `departs` (`id`, `name`, `parent`) VALUES
(1, 'M', 0),
(2, 'EJT', 0),
(3, 'LBSF', 1),
(4, 'J', 2),
(5, 'L', 0),
(6, 'XXCCG', 3),
(7, 'ABUQJ', 0),
(8, 'JIUO', 4),
(9, 'XZTO', 6),
(10, 'BTYVT', 8),
(11, 'R', 5),
(12, 'KXD', 4),
(13, 'N', 10),
(14, 'CZR', 7),
(15, 'FFL', 5),
(16, 'DVMO', 12),
(17, 'DB', 2),
(18, 'MHBQY', 4),
(19, 'NICU', 11),
(20, 'EJGTU', 6),
(21, 'Z', 0),
(22, 'YNCOP', 9),
(23, 'CH', 15),
(24, 'CSWF', 8),
(25, 'B', 17),
(26, 'DGF', 14),
(27, 'I', 11),
(28, 'PP', 5),
(29, 'Y', 28),
(30, 'KVQ', 27),
(31, 'NP', 6),
(32, 'RDS', 4),
(33, 'DXL', 1),
(34, 'EWSGN', 26),
(35, 'OKPVR', 30),
(36, 'YYC', 27),
(37, 'FJIM', 35),
(38, 'T', 30),
(39, 'CVI', 32),
(40, 'RFNSW', 34),
(41, 'RMOVX', 9),
(42, 'QWZOF', 6),
(43, 'FVH', 20),
(44, 'K', 36),
(45, 'TGR', 8),
(46, 'FTFJ', 39),
(47, 'UEIYC', 29),
(48, 'MIKO', 38),
(49, 'U', 23),
(50, 'HB', 12),
(51, 'S', 31),
(52, 'G', 2),
(53, 'GRYKS', 21),
(54, 'RGV', 47),
(55, 'DZC', 23),
(56, 'IY', 7),
(57, 'J', 12),
(58, 'F', 8),
(59, 'FD', 57),
(60, 'BR', 41),
(61, 'H', 29),
(62, 'LBNP', 11),
(63, 'Z', 8),
(64, 'SK', 23),
(65, 'OF', 5),
(66, 'VD', 13),
(67, 'G', 46),
(68, 'Q', 43),
(69, 'ENB', 6),
(70, 'WID', 2),
(71, 'QD', 17),
(72, 'FXSX', 45),
(73, 'YYNM', 54),
(74, 'EN', 20),
(75, 'AR', 15),
(76, 'RG', 54),
(77, 'LETR', 18),
(78, 'TONT', 54);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `departs`
--
ALTER TABLE `departs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `departs`
--
ALTER TABLE `departs`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=79;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
