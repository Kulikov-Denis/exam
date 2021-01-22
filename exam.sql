-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 22 2021 г., 02:29
-- Версия сервера: 10.4.16-MariaDB
-- Версия PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `exam`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `PK_TASKS` int(11) NOT NULL,
  `FK_USERS` int(11) NOT NULL,
  `FK_TYPES` int(11) NOT NULL,
  `FK_STATUSES` int(11) NOT NULL,
  `TASKS_DATEADD` date NOT NULL DEFAULT current_timestamp(),
  `TASKS_DATESTART` date DEFAULT NULL,
  `TASKS_DATECOMPLETE` date DEFAULT NULL,
  `TASKS_ABOUT` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`PK_TASKS`, `FK_USERS`, `FK_TYPES`, `FK_STATUSES`, `TASKS_DATEADD`, `TASKS_DATESTART`, `TASKS_DATECOMPLETE`, `TASKS_ABOUT`) VALUES
(1, 1, 1, 1, '2020-05-31', NULL, NULL, 'Закупка девайсов новой модели'),
(2, 2, 2, 2, '2021-10-30', '2021-01-12', NULL, 'Закупка девайсов новой модели'),
(3, 2, 3, 3, '2021-01-07', '2021-01-16', '2021-01-16', 'Привет'),
(4, 2, 2, 3, '2021-01-06', '2021-01-11', '2021-01-12', 'Закупка девайсов новой модели'),
(5, 2, 3, 3, '2021-01-16', '2021-01-16', '2021-01-16', 'Привеgт'),
(6, 2, 8, 2, '2021-01-16', '2021-01-22', NULL, 'Приsвеgтefsaefefsafefasf'),
(7, 2, 5, 1, '2021-01-16', NULL, NULL, 'Приssdвеgт'),
(11, 1, 2, 1, '2021-10-30', NULL, NULL, 'jkjhvdslfhvlsidufvlaisubfegs'),
(12, 1, 7, 2, '2021-01-21', '2021-01-21', NULL, 'es;oghf;osauiehg;ouihasg;oih;oiah'),
(14, 2, 4, 2, '2021-01-21', '2021-01-21', NULL, 'sdgsdg'),
(15, 2, 4, 1, '2021-01-21', NULL, NULL, 'seGgesgse'),
(17, 1, 4, 1, '2021-01-21', NULL, NULL, 'seGgesgsesegseg'),
(18, 1, 8, 1, '2021-01-21', NULL, NULL, 'seGgesgsesegseg'),
(19, 1, 2, 1, '2021-01-21', NULL, NULL, 'seGgesgsesegseg'),
(20, 1, 2, 1, '2021-01-21', NULL, NULL, 'seGgesgsesegseg'),
(21, 2, 3, 3, '2021-01-22', '2021-01-22', '2021-01-22', 'hfcjhc'),
(23, 1, 7, 3, '2021-01-22', '2021-01-22', '2021-01-22', 'hjhcgkhgc'),
(24, 1, 9, 3, '2021-01-22', '2021-01-22', '2021-01-22', 'hjhcgkhgc'),
(25, 2, 2, 2, '2021-01-22', '2021-01-22', NULL, 'seafasfseaf'),
(26, 1, 7, 3, '2021-01-22', '2021-01-22', '2021-01-22', 'seafasfseaf'),
(27, 2, 3, 2, '2021-01-22', '2021-01-22', NULL, 'efaesfasef'),
(29, 1, 8, 2, '2021-01-22', '2021-01-22', NULL, 'efaesfasefesaf'),
(30, 2, 3, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt'),
(31, 2, 3, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt'),
(32, 2, 3, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt'),
(33, 2, 3, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt'),
(34, 2, 3, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt'),
(35, 2, 3, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt'),
(36, 2, 3, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt'),
(37, 2, 3, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt'),
(38, 2, 3, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt'),
(39, 2, 3, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt'),
(40, 2, 3, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt'),
(41, 2, 3, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt'),
(42, 2, 3, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt'),
(43, 2, 3, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt'),
(44, 2, 3, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt'),
(45, 2, 3, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt'),
(46, 2, 3, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt'),
(47, 2, 3, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt'),
(48, 2, 3, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt'),
(49, 2, 3, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt'),
(50, 2, 3, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt'),
(51, 2, 3, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt'),
(52, 2, 3, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt'),
(53, 2, 3, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt'),
(54, 2, 3, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt'),
(55, 2, 3, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt'),
(56, 2, 3, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt'),
(57, 2, 3, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt'),
(58, 1, 8, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt,jlyljy'),
(60, 1, 8, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt,jlyljy'),
(62, 1, 8, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt,jlyljy'),
(63, 1, 8, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt,jlyljy'),
(64, 1, 8, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt,jlyljy'),
(66, 1, 8, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt,jlyljy'),
(67, 1, 8, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt,jlyljy'),
(68, 1, 8, 1, '2021-01-22', NULL, NULL, 'jtfkytfyktdkyt,jlyljy');

-- --------------------------------------------------------

--
-- Структура таблицы `task_statuses`
--

CREATE TABLE `task_statuses` (
  `PK_STATUSES` int(11) NOT NULL,
  `STATUSES_NAME` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `task_statuses`
--

INSERT INTO `task_statuses` (`PK_STATUSES`, `STATUSES_NAME`) VALUES
(2, 'В работе'),
(3, 'Завершена'),
(1, 'Новая задача');

-- --------------------------------------------------------

--
-- Структура таблицы `task_types`
--

CREATE TABLE `task_types` (
  `PK_TYPES` int(11) NOT NULL,
  `TYPES_NAME` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `task_types`
--

INSERT INTO `task_types` (`PK_TYPES`, `TYPES_NAME`) VALUES
(1, 'Закупка'),
(2, 'Контроль'),
(9, 'Маркетинг'),
(3, 'Продажа'),
(4, 'Разработка'),
(7, 'Распространение'),
(8, 'Сбыт'),
(5, 'Хранение');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `PK_USERS` int(11) NOT NULL,
  `USERS_FIO` varchar(255) NOT NULL,
  `USERS_PASSWORD` varchar(255) NOT NULL,
  `USERS_TOKEN` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`PK_USERS`, `USERS_FIO`, `USERS_PASSWORD`, `USERS_TOKEN`) VALUES
(1, 'Root', '$2y$10$tQsA8csB.HdAYllw2LfS6eoaHcy4A9cwfxJX10kaah4WRclz4KOPS', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MTEyNzg4OTMsImV4cCI6MTYxMTMzMjg5MywiaWQiOjEsImZpbyI6IlJvb3QifQ.ps_kxUtICOfRtw2ANmfhGQUeHoelHqgBVteB4B7r12o'),
(2, 'Root2', '$2y$10$3Vswcv13vTd0iugehu4kQO6d3udE.JyKS4byHYI.SfGZpZp6PSjxO', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`PK_TASKS`),
  ADD KEY `FK_USERS` (`FK_USERS`),
  ADD KEY `FK_STATUSES` (`FK_STATUSES`),
  ADD KEY `FK_TYPES` (`FK_TYPES`);

--
-- Индексы таблицы `task_statuses`
--
ALTER TABLE `task_statuses`
  ADD PRIMARY KEY (`PK_STATUSES`),
  ADD UNIQUE KEY `UNIQUE_STATUS` (`STATUSES_NAME`);

--
-- Индексы таблицы `task_types`
--
ALTER TABLE `task_types`
  ADD PRIMARY KEY (`PK_TYPES`),
  ADD UNIQUE KEY `UNIQUE_TYPE` (`TYPES_NAME`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`PK_USERS`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `PK_TASKS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT для таблицы `task_statuses`
--
ALTER TABLE `task_statuses`
  MODIFY `PK_STATUSES` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `task_types`
--
ALTER TABLE `task_types`
  MODIFY `PK_TYPES` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `PK_USERS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`FK_USERS`) REFERENCES `users` (`PK_USERS`),
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`FK_STATUSES`) REFERENCES `task_statuses` (`PK_STATUSES`),
  ADD CONSTRAINT `tasks_ibfk_3` FOREIGN KEY (`FK_TYPES`) REFERENCES `task_types` (`PK_TYPES`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
