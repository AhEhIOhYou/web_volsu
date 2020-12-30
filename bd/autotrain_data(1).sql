-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 30 2020 г., 15:02
-- Версия сервера: 10.4.14-MariaDB
-- Версия PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `autotrain_data`
--

-- --------------------------------------------------------

--
-- Структура таблицы `city_data`
--

CREATE TABLE `city_data` (
  `id` int(5) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `city_data`
--

INSERT INTO `city_data` (`id`, `name`) VALUES
(26, 'Волгоград'),
(31, 'Калуга'),
(28, 'Москва'),
(29, 'Пермь');

-- --------------------------------------------------------

--
-- Структура таблицы `order_list`
--

CREATE TABLE `order_list` (
  `id` int(5) NOT NULL,
  `trip_id` int(5) NOT NULL,
  `seat_number` int(5) NOT NULL,
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `quarantine_data`
--

CREATE TABLE `quarantine_data` (
  `city_name` varchar(30) NOT NULL,
  `info` text NOT NULL,
  `relevance` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `quarantine_data`
--

INSERT INTO `quarantine_data` (`city_name`, `info`, `relevance`) VALUES
('Волгоград', 'Опасно', 1),
('Калуга', 'Опасно', 1),
('Москва', 'Опасно', 1),
('Пермь', 'Опасно', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `seats_list`
--

CREATE TABLE `seats_list` (
  `id` int(5) NOT NULL,
  `train_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `seats_list`
--

INSERT INTO `seats_list` (`id`, `train_id`, `number`, `state`) VALUES
(10, 7, 13, 0),
(12, 4, 28, 0),
(13, 4, 11, 0),
(14, 8, 23, 0),
(15, 8, 1, 0),
(16, 8, 110, 0),
(17, 5, 23, 0),
(19, 5, 13, 0),
(20, 6, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `train_list`
--

CREATE TABLE `train_list` (
  `id` int(5) NOT NULL,
  `type` int(2) NOT NULL,
  `number` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `train_list`
--

INSERT INTO `train_list` (`id`, `type`, `number`) VALUES
(4, 1, 22),
(5, 0, 110),
(6, 0, 213),
(7, 1, 9),
(8, 1, 190),
(9, 1, 21);

-- --------------------------------------------------------

--
-- Структура таблицы `trip_list`
--

CREATE TABLE `trip_list` (
  `id` int(5) NOT NULL,
  `place_from` varchar(30) NOT NULL,
  `place_to` varchar(30) NOT NULL,
  `time_from` varchar(15) NOT NULL,
  `time_to` varchar(15) NOT NULL,
  `price` int(5) NOT NULL,
  `data_from` varchar(15) NOT NULL,
  `train_number` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `trip_list`
--

INSERT INTO `trip_list` (`id`, `place_from`, `place_to`, `time_from`, `time_to`, `price`, `data_from`, `train_number`) VALUES
(14, 'Москва', 'Калуга', '11:22', '20:20', 1915, '12.12.2020', 9);

-- --------------------------------------------------------

--
-- Структура таблицы `user_list`
--

CREATE TABLE `user_list` (
  `id` int(5) NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `login` text NOT NULL,
  `pass` text NOT NULL,
  `email` text NOT NULL,
  `type` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_list`
--

INSERT INTO `user_list` (`id`, `name`, `surname`, `login`, `pass`, `email`, `type`) VALUES
(1, 'Дима', 'Владимиров', 'admin1234', 'd50a3c2d5ddf6cbc798fe0de0dc6194d', 'vladimirov@mail.ru', 1),
(8, 'Данилка', 'Кривоносов', 'lollogin', '5313577e13e71d509b6c4819e2754f48', 'krri@kek.ru', 0),
(9, 'неВаня', 'Масюков', 'mvanya123', 'd9f996732af89b011ac3582399441a9d', 'lkew@mail.ru', 0),
(10, 'Дима', 'Владимиров', 'vlasdafds', 'c126c6326b706d7c5107123eb05ddf53', '', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `weather_data`
--

CREATE TABLE `weather_data` (
  `city_name` varchar(30) NOT NULL,
  `data` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `weather_data`
--

INSERT INTO `weather_data` (`city_name`, `data`) VALUES
('Волгоград', 'Снег'),
('Калуга', 'Снег'),
('Москва', 'Снег'),
('Пермь', 'Солнечно');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `city_data`
--
ALTER TABLE `city_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Индексы таблицы `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trip_id` (`trip_id`,`user_id`),
  ADD KEY `order_list_ibfk_2` (`user_id`),
  ADD KEY `order_list_ibfk_3` (`seat_number`);

--
-- Индексы таблицы `quarantine_data`
--
ALTER TABLE `quarantine_data`
  ADD UNIQUE KEY `city_name` (`city_name`);

--
-- Индексы таблицы `seats_list`
--
ALTER TABLE `seats_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `train_id` (`train_id`),
  ADD KEY `number` (`number`);

--
-- Индексы таблицы `train_list`
--
ALTER TABLE `train_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `number` (`number`);

--
-- Индексы таблицы `trip_list`
--
ALTER TABLE `trip_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `place_from` (`place_from`),
  ADD KEY `place_to` (`place_to`),
  ADD KEY `trip_list_ibfk_4` (`train_number`);

--
-- Индексы таблицы `user_list`
--
ALTER TABLE `user_list`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `weather_data`
--
ALTER TABLE `weather_data`
  ADD UNIQUE KEY `city_name` (`city_name`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `city_data`
--
ALTER TABLE `city_data`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT для таблицы `order_list`
--
ALTER TABLE `order_list`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `seats_list`
--
ALTER TABLE `seats_list`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `train_list`
--
ALTER TABLE `train_list`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `trip_list`
--
ALTER TABLE `trip_list`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `user_list`
--
ALTER TABLE `user_list`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `order_list`
--
ALTER TABLE `order_list`
  ADD CONSTRAINT `order_list_ibfk_1` FOREIGN KEY (`trip_id`) REFERENCES `trip_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_list_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_list_ibfk_3` FOREIGN KEY (`seat_number`) REFERENCES `seats_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `quarantine_data`
--
ALTER TABLE `quarantine_data`
  ADD CONSTRAINT `quarantine_data_ibfk_1` FOREIGN KEY (`city_name`) REFERENCES `city_data` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `seats_list`
--
ALTER TABLE `seats_list`
  ADD CONSTRAINT `seats_list_ibfk_1` FOREIGN KEY (`train_id`) REFERENCES `train_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `trip_list`
--
ALTER TABLE `trip_list`
  ADD CONSTRAINT `trip_list_ibfk_2` FOREIGN KEY (`place_from`) REFERENCES `city_data` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trip_list_ibfk_3` FOREIGN KEY (`place_to`) REFERENCES `city_data` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trip_list_ibfk_4` FOREIGN KEY (`train_number`) REFERENCES `train_list` (`number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `weather_data`
--
ALTER TABLE `weather_data`
  ADD CONSTRAINT `weather_data_ibfk_1` FOREIGN KEY (`city_name`) REFERENCES `city_data` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
