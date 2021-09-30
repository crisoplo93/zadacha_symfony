-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Сен 30 2021 г., 02:42
-- Версия сервера: 10.4.17-MariaDB
-- Версия PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `symfony`
--

-- --------------------------------------------------------

--
-- Структура таблицы `administrator`
--

CREATE TABLE `administrator` (
  `id` int(11) NOT NULL,
  `login` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `administrator`
--

INSERT INTO `administrator` (`id`, `login`, `password`) VALUES
(1, 'admin@symfony.com', '$2y$10$2gRnlHaA5WYZFMeUh94Yjubi3ie6zRqEwEezymKxecgYie.v19CSS'),
(2, 'admin2@symfony.com', '$2y$10$8Og3CFMYYJF8GcjzzUEdwefY/PEPOKZSy2rwgdHiCTm/.VvRUlN.u'),
(4, 'gran_master', '$2y$10$x4IJlykRu3OJ3vr90HecZOuOOs2ZNciRha1vMMwXJUHJ9cq.9t3du'),
(5, 'gran_master2', '$2y$10$2MOrToaSvB0FszfL5MRCJ.sCH8jC0K6suJIp8/7D5vqV079kHG.G6'),
(6, 'admin', '$2y$10$Wi8O.BP70xhRyaxRIIU2/eE/WrGDsH40s1VAvcQqlUzr/txUBGXz.');

-- --------------------------------------------------------

--
-- Структура таблицы `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `name` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `color`
--

INSERT INTO `color` (`id`, `name`, `code`) VALUES
(1, 'DarkRed', '#8B0000'),
(2, 'LimeGreen', '#32CD32'),
(3, 'DarkCyan', '#008B8B'),
(4, 'SaddleBrown', '#8B4513'),
(5, 'Navy', '#000080');

-- --------------------------------------------------------

--
-- Структура таблицы `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210929075835', '2021-09-29 09:58:55', 205),
('DoctrineMigrations\\Version20210929091107', '2021-09-29 11:11:15', 109),
('DoctrineMigrations\\Version20210929125234', '2021-09-29 14:54:43', 129),
('DoctrineMigrations\\Version20210929170242', '2021-09-29 19:02:57', 102);

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `dir` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `image`
--

INSERT INTO `image` (`id`, `dir`, `user_id`) VALUES
(10, 'http://localhost/zadacha_symfony/src/user_pictures/65658b260abb0e8df7a47a8f72b512bf01f8efc4a2f038fa3a53d30ac4928408_bee_logo1.png.png', 6),
(11, 'http://localhost/zadacha_symfony/src/user_pictures/65658b260abb0e8df7a47a8f72b512bf01f8efc4a2f038fa3a53d30ac4928408_bee_logo2.png.png', 6),
(12, 'http://localhost/zadacha_symfony/src/user_pictures/65658b260abb0e8df7a47a8f72b512bf01f8efc4a2f038fa3a53d30ac4928408_more-12.jpg.png', 6),
(13, 'http://localhost/zadacha_symfony/src/user_pictures/65658b260abb0e8df7a47a8f72b512bf01f8efc4a2f038fa3a53d30ac4928408_Sin nombre.png.png', 6),
(14, 'http://localhost/zadacha_symfony/src/user_pictures/0333865c03e33b4ba40bebbae0b787a904b9d924f66a80570ec26ec78d54f324_Logo be2.png', 7),
(15, 'http://localhost/zadacha_symfony/src/user_pictures/0333865c03e33b4ba40bebbae0b787a904b9d924f66a80570ec26ec78d54f324_more-12.jpg', 7),
(16, 'http://localhost/zadacha_symfony/src/user_pictures/f42bd582f1e64471141b7cef3f05abc80b7a9efd0aff5c4da45c2307c91e6b78_bee_logo1.png', 8),
(17, 'http://localhost/zadacha_symfony/src/user_pictures/f42bd582f1e64471141b7cef3f05abc80b7a9efd0aff5c4da45c2307c91e6b78_bee_logo2.png', 8),
(18, 'http://localhost/zadacha_symfony/src/user_pictures/f42bd582f1e64471141b7cef3f05abc80b7a9efd0aff5c4da45c2307c91e6b78_Learner-Lab-Podcast-Background.png', 8),
(19, 'http://localhost/zadacha_symfony/src/user_pictures/f42bd582f1e64471141b7cef3f05abc80b7a9efd0aff5c4da45c2307c91e6b78_Logo be.png', 8),
(20, 'http://localhost/zadacha_symfony/src/user_pictures/d71c0cbe9ae3eeb521d4431dfdeb3c893bf4c7dd871d72247e2517d32889c3d6_more-12.jpg', 9),
(21, 'http://localhost/zadacha_symfony/src/user_pictures/304f2fb192a782313d294eb11c7c50ea41d2fc022b5f68e9b47199f9cd17ef5b_Sin nombre.png', 10),
(22, 'http://localhost/zadacha_symfony/src/user_pictures/dbe828ef321aff6f78e96036438aff893f71cd1154cf650a199a3146c686eee0_Logo be2.png', 11),
(23, 'http://localhost/zadacha_symfony/src/user_pictures/8f3c38492b077a0053df2be3580e2dbf398d60cdbd8bab3e14849bbf730c44b0_bee_logo2.png', 12),
(24, 'http://localhost/zadacha_symfony/src/user_pictures/a872c51e5e61b48f54a9ef1b2b80d6fc6f6788f726614aa970624d012099d37b_Logo be.png', 13),
(25, 'http://localhost/zadacha_symfony/src/user_pictures/509a1a057d4b5b6d5f20f70590b3a06b6be82ee1f71ad5c7985763d1deb095ac_bd_structure.JPG', 14),
(26, 'http://localhost/zadacha_symfony/src/user_pictures/64ee21332e363493c98ea8f9f76e19d1afcc406b9f756d5b906fb12eb01fdeee_FB_IMG_1600707546812.jpg', 15),
(27, 'http://localhost/zadacha_symfony/src/user_pictures/2baaf3cec8b15c4b61c2f470bc3232f5f8c69894c4c8e1491dc1a3c8b5b755c0_FB_IMG_1601790596023.jpg', 16),
(28, 'http://localhost/zadacha_symfony/src/user_pictures/8d54e83012dbaddaf8b877d2cf304fadb621c1f5bcdc07f3791547d53b4212f6_FB_IMG_1603012044240.jpg', 18);

-- --------------------------------------------------------

--
-- Структура таблицы `shape`
--

CREATE TABLE `shape` (
  `id` int(11) NOT NULL,
  `name` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `shape`
--

INSERT INTO `shape` (`id`, `name`) VALUES
(1, 'Треугольник'),
(2, 'Круг'),
(3, 'Ромб'),
(4, 'Звезда'),
(5, 'Квадрат');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `shape_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `message`, `email`, `shape_id`, `color_id`) VALUES
(6, 'la noche', 'cris@hh.ru', 3, 3),
(7, 'el zorro astuto', 'ccrcr@fsg.net', 2, 2),
(8, 'For purposes of action nothing is more useful than narrowness of thought combined with energy of will.', '10@hotmail.com', 4, 3),
(9, 'Philosophers say a great deal about what is absolutely necessary for science, and it is always, so far as one can see, rather naive, and probably wrong.', '11@hotmail.com', 1, 5),
(10, 'He had discovered a great law of human action, without knowing it - namely, that in order to make a man or a boy covet a thing, it is only necessary to make the thing difficult to obtain.', '12@hotmail.com', 3, 2),
(11, 'My success has depended wholly on putting things over on people, so I\'m not sure that I\'m that great a role model. I am, however, an expert on pretending to be an expert on pretending to be an expert.', '13@hotmail.com', 4, 3),
(12, 'You must have a room, or a certain hour or so a day, where you don\'t know what was in the newspapers that morning... a place where you can simply experience and bring forth what you are and what you might be.', '16@hotmail.com', 4, 2),
(13, 'Everyone is a genius at least once a year. The real geniuses simply have their bright ideas closer together.', 'jkl@gmail.com', 2, 4),
(14, 'Your primary goal should be to have a great life. You can still have a good day, enjoy your child, and ultimately find happiness, whether your ex is acting like a jerk or a responsible person. Your happiness is not dependent upon someone else.', 'ghi@yahoo.com', 5, 1),
(15, 'We are like a bunch of dogs squirting on fire hydrants. We poison the groundwater with our toxic piss, marking everything MINE in a ridiculous attempt to survive our deaths.', 'lll@mail.ru', 3, 3),
(16, 'Nothing like a lot of exercise to make you realize you\'d rather be lazy and dead sooner.', 'development@apple.com', 1, 4),
(17, 'el sol y la luna', 'reme@yandex.ru', 2, 2),
(18, 'el sol y la luna', 'reme2@yandex.ru', 2, 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_58DF0651AA08CB10` (`login`) USING HASH;

--
-- Индексы таблицы `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `shape`
--
ALTER TABLE `shape`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`) USING HASH;

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `shape`
--
ALTER TABLE `shape`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
