-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 30 2020 г., 17:09
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
-- База данных: `big_data`
--

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(4) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `trip_id`, `user_id`) VALUES
(30, 1, 9),
(31, 3, 10),
(32, 3, 29),
(33, 3, 21);

-- --------------------------------------------------------

--
-- Структура таблицы `trips_data`
--

CREATE TABLE `trips_data` (
  `id` int(11) NOT NULL,
  `place_from` varchar(50) NOT NULL,
  `place_to` varchar(50) NOT NULL,
  `time_from` varchar(9) NOT NULL,
  `time_to` varchar(9) NOT NULL,
  `price` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `trips_data`
--

INSERT INTO `trips_data` (`id`, `place_from`, `place_to`, `time_from`, `time_to`, `price`) VALUES
(1, 'Санкт-Петербург', 'Москва', '13:10', '21:09', 2300),
(3, 'Кострома', 'Иловля', '12:11', '20:08', 12345),
(7, 'Махачкала', 'Иркутск', '13:11', '17:22', 12312);

-- --------------------------------------------------------

--
-- Структура таблицы `users_data`
--

CREATE TABLE `users_data` (
  `id` int(11) NOT NULL,
  `user_type` tinyint(1) NOT NULL DEFAULT 1,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `login` varchar(30) NOT NULL,
  `age` int(3) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `tel` bigint(15) DEFAULT NULL,
  `email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users_data`
--

INSERT INTO `users_data` (`id`, `user_type`, `name`, `surname`, `login`, `age`, `pass`, `tel`, `email`) VALUES
(9, 1, 'Димаааааа', 'Владимиров', 'bokuno', 18, '12345678', 2147483647, 'lolkek@bk.com'),
(10, 1, 'Наш', 'Какэмыв', 'yfuds', 1, 'dasdsdfs', 9, 'kek@mail.ru'),
(18, 1, 'Чччч', 'Ааааааа', 'aga123', 11, 'nog1234', 0, 'lokj@bk.com'),
(21, 2, 'Димчик', 'Владимиров', 'admin1234', 18, '6b3893a3567483f88dcae28163174db4', 2147483647, 'vla@bk.ru'),
(23, 1, 'ВсеТаки', 'неТема', 'lolkafg', 12, 'coolpass', 0, ''),
(27, 1, 'Тика', 'Фудзивара', 'tikawaaaa', 18, '12345678', 0, 'chikabest@sh.ja'),
(29, 1, 'Дима', 'Владимиров', 'dimka1234', 0, '6b3893a3567483f88dcae28163174db4', 0, '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trip_id` (`trip_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `trips_data`
--
ALTER TABLE `trips_data`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_data`
--
ALTER TABLE `users_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `trips_data`
--
ALTER TABLE `trips_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users_data`
--
ALTER TABLE `users_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`trip_id`) REFERENCES `trips_data` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users_data` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
