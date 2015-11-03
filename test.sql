-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Структура таблицы `stav_bank`
--

CREATE TABLE IF NOT EXISTS `stav_bank` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `name_vlad` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Структура таблицы `stav_provodki`
--

CREATE TABLE IF NOT EXISTS `stav_provodki` (
  `id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `stav_id` int(11) DEFAULT NULL,
  `com` varchar(255) NOT NULL,
  `sum` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Структура таблицы `stav_sob`
--

CREATE TABLE IF NOT EXISTS `stav_sob` (
  `id` int(11) NOT NULL,
  `com` text NOT NULL,
  `kef` float NOT NULL,
  `sort` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `stav_sob`
--

INSERT INTO `stav_sob` (`id`, `com`, `kef`, `sort`) VALUES
(1, 'тест1', 1.45, 3),
(2, 'тест2', 1.75, 2),
(3, 'тест3', 1.72, 1),
(4, 'тест4', 1.7, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `stav_stavki`
--

CREATE TABLE IF NOT EXISTS `stav_stavki` (
  `id` int(11) NOT NULL,
  `com` text NOT NULL,
  `kef` float NOT NULL,
  `sum` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `stav_stavki`
--

INSERT INTO `stav_stavki` (`id`, `com`, `kef`, `sum`) VALUES
(1, 'Локомотив - Амкар: 1,52\r\nКортрийк - Андерлехт: 1,7', 2.58, 100);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `stav_bank`
--
ALTER TABLE `stav_bank`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `stav_provodki`
--
ALTER TABLE `stav_provodki`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stav_id` (`stav_id`),
  ADD KEY `bank_id` (`bank_id`);

--
-- Индексы таблицы `stav_sob`
--
ALTER TABLE `stav_sob`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `stav_stavki`
--
ALTER TABLE `stav_stavki`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `stav_bank`
--
ALTER TABLE `stav_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `stav_provodki`
--
ALTER TABLE `stav_provodki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `stav_sob`
--
ALTER TABLE `stav_sob`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `stav_stavki`
--
ALTER TABLE `stav_stavki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `stav_provodki`
--
ALTER TABLE `stav_provodki`
  ADD CONSTRAINT `stav_provodki_ibfk_1` FOREIGN KEY (`bank_id`) REFERENCES `stav_bank` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
