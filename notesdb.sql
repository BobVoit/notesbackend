-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 17 2021 г., 22:35
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `notesdb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `avatars`
--

CREATE TABLE `avatars` (
  `userId` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `avatars`
--

INSERT INTO `avatars` (`userId`, `image`) VALUES
(8, 'Илья с автоматом.jpg'),
(9, 'tableBackground.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `title` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `messageDate` datetime NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `notes`
--

INSERT INTO `notes` (`id`, `title`, `message`, `messageDate`, `userId`) VALUES
(61, 'v g ', 'xfbgb', '2021-01-15 20:47:16', 8),
(67, 'svfdfv', 'dfbvgb ', '2021-01-16 20:19:04', 8),
(83, 'Начало доработки', 'Сегодня началась доработка приложения. Добавляю функции для удобства интерфейса. ', '2021-01-17 21:03:31', 9),
(84, 'Также!!!', 'Добавил кнопу, при нажатии на которую всплывает окно на весь экран. На этом экране отображается список с заметками, но в без лишних деталей интерфейса.', '2021-01-17 21:06:16', 9);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `nickname`, `token`) VALUES
(1, 'bob25', '182d74d39033e06d08b439c1fb28f71e', 'bob2345', ''),
(2, 'llllllllllllll', '8085997d5944e238997b33370ac4813b', 'qwwwwwww', ''),
(3, 'dgfdbgb', '3a2341e1d9d5869fdd6154d2f0b142bc', 'dfgdbfbg', ''),
(4, '2343543', '52781af841740ee923d349bedfdfcf3d', 'gfhfhnhgn', ''),
(6, 'd565765', '314ebce9832d3462dcc70b15636fadc0', 'bgfhnhgn', ''),
(7, '12312342423', '6675514b65b83131bdbeb3ccdbc7b91c', 'wgvrdbgfd', ''),
(8, 'hilesve', '37516dc876320d79c2fb3e548eb513eb', 'Ilya', ''),
(9, 'danbob', '98158078fc09adda37506793723f9e1b', 'Danbob', 'e12521435a342def3dfdc9fe27294867');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `avatars`
--
ALTER TABLE `avatars`
  ADD UNIQUE KEY `userId` (`userId`);

--
-- Индексы таблицы `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `avatars`
--
ALTER TABLE `avatars`
  ADD CONSTRAINT `avatars_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
