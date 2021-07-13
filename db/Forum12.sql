-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 21 2019 г., 12:17
-- Версия сервера: 5.7.11
-- Версия PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Forum`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bans`
--

CREATE TABLE IF NOT EXISTS `bans` (
  `id` int(11) NOT NULL,
  `id_temi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `staty` enum('0','1') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bans`
--

INSERT INTO `bans` (`id`, `id_temi`, `id_user`, `staty`) VALUES
(10, 8, 7, '1'),
(11, 8, 8, '1');

-- --------------------------------------------------------

--
-- Структура таблицы `com`
--

CREATE TABLE IF NOT EXISTS `com` (
  `id` int(11) NOT NULL,
  `id_temi` int(11) NOT NULL,
  `id_coment` int(11) DEFAULT NULL,
  `texty` varchar(255) NOT NULL,
  `daty` date NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `com`
--

INSERT INTO `com` (`id`, `id_temi`, `id_coment`, `texty`, `daty`, `id_user`) VALUES
(17, 6, NULL, 'В конфиге там файл WEB', '2019-06-21', 17),
(18, 6, 17, 'Там строка "Cookie validation key"', '2019-06-21', 17);

-- --------------------------------------------------------

--
-- Структура таблицы `temi`
--

CREATE TABLE IF NOT EXISTS `temi` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `data` date NOT NULL,
  `stati` enum('0','1') NOT NULL,
  `text` varchar(500) NOT NULL,
  `id_sozd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `temi`
--

INSERT INTO `temi` (`id`, `name`, `data`, `stati`, `text`, `id_sozd`) VALUES
(5, 'Админы', '2019-06-07', '0', 'Админы совсем распоясолись забанили моехо друха', 4),
(6, 'Помогите разобраться', '2019-06-17', '1', 'Как прописать ключ в yii2', 4),
(7, 'Научите плииииз!!', '2019-06-21', '0', 'Как начать работу на PHP', 4),
(8, 'Гайды', '2019-06-21', '1', 'Я буду выкладывать уроки раз в неделю по Yii2', 17);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `previl` enum('0','1') NOT NULL,
  `staty` enum('0','1') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `previl`, `staty`) VALUES
(4, 'Holo', '$2y$13$RUQbMdQ.SFcNR.CpVXMvT.UINUHMP2n6BSY17daznEJ0OjRfc1Wxq', '1', '0'),
(5, 'Sanya', '$2y$13$7C7irz12YxrPdGU82LovW.WHwtVGbv65JvM0DXXhbrzNwNU.JEro.', '1', '0'),
(7, 'Rigiy', '$2y$13$zp4QCTZoTirtKYtf2.r1A.14o7ePkdIXX/mKkwECL6PMZtcXUaJOq', '0', '0'),
(8, 'Tester', '$2y$13$HuXZSTupkfOquNxSi32kNOLrD.NtMUR0Fd53FbvEQIkPalgmMT4oa', '0', '0'),
(16, 'Kul', '$2y$13$RUQbMdQ.SFcNR.CpVXMvT.UINUHMP2n6BSY17daznEJ0OjRfc1Wxq', '0', '0'),
(17, 'Lux', '$2y$13$4BpLrC54ltY7KAEUnmHrg.L29V7f27j9mKePeFhIWakxSxrjN5BJu', '0', '0');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bans`
--
ALTER TABLE `bans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`id_temi`,`id_user`,`staty`),
  ADD KEY `id_temi` (`id_temi`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `com`
--
ALTER TABLE `com`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`id_temi`,`id_coment`,`texty`,`daty`,`id_user`),
  ADD KEY `id_temi` (`id_temi`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `temi`
--
ALTER TABLE `temi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`name`,`data`,`stati`,`text`(255),`id_sozd`),
  ADD KEY `id_sozd` (`id_sozd`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`username`,`password`,`previl`,`staty`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bans`
--
ALTER TABLE `bans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `com`
--
ALTER TABLE `com`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT для таблицы `temi`
--
ALTER TABLE `temi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `bans`
--
ALTER TABLE `bans`
  ADD CONSTRAINT `bans_ibfk_1` FOREIGN KEY (`id_temi`) REFERENCES `temi` (`id`),
  ADD CONSTRAINT `bans_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `com`
--
ALTER TABLE `com`
  ADD CONSTRAINT `com_ibfk_1` FOREIGN KEY (`id_temi`) REFERENCES `temi` (`id`),
  ADD CONSTRAINT `com_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `temi`
--
ALTER TABLE `temi`
  ADD CONSTRAINT `temi_ibfk_1` FOREIGN KEY (`id_sozd`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
