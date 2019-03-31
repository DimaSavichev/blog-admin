-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 31 2019 г., 13:46
-- Версия сервера: 10.1.32-MariaDB
-- Версия PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(255) NOT NULL,
  `post` int(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `post`, `author`, `text`, `time`) VALUES
(1, 2, 'hhh', 'usuus', '2019-03-31 14:29:34'),
(2, 2, 'hhh', 'usuus', '2019-03-31 14:29:41'),
(3, 2, '<h1>lol</h1>', 'usuus', '2019-03-31 14:30:05'),
(4, 2, '<h1>lol</h1>', 'usuus', '2019-03-31 14:30:12'),
(5, 2, '<h1>lol</h1>', 'usuus', '2019-03-31 14:30:27'),
(6, 2, 'hhh', 'usuus', '2019-03-31 14:30:35'),
(7, 2, '<h1>lol</h1>', 'hhh', '2019-03-31 14:30:44'),
(8, 2, 'a', 'a', '2019-03-31 14:30:59'),
(9, 2, 'a', 'a', '2019-03-31 14:31:05'),
(10, 2, 'a', 'a', '2019-03-31 14:33:36'),
(11, 2, 'a', 'a', '2019-03-31 14:34:20'),
(12, 2, 'f', 's', '2019-03-31 14:34:27'),
(13, 2, 'f', 's', '2019-03-31 14:34:59'),
(14, 2, 'hhh', 'usuus', '2019-03-31 14:35:05');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `heading`, `text`, `time`) VALUES
(2, 'FFF', 'lllll', '2019-03-31 13:37:46');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
