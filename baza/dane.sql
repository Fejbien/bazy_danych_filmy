-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 07 Gru 2022, 11:27
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `movies`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `generes`
--

CREATE TABLE `generes` (
  `id` int(11) NOT NULL,
  `genere` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `generes`
--

INSERT INTO `generes` (`id`, `genere`) VALUES
(1, 'scifi'),
(2, 'parodja'),
(3, 'komedia'),
(4, 'horror');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `year` varchar(45) DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  `genere_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `renter_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `movies`
--

INSERT INTO `movies` (`id`, `name`, `year`, `length`, `genere_id`, `user_id`, `admin_id`, `renter_id`) VALUES
(1, 'avengers', '2010', 188, 1, 5, 1, NULL),
(2, 'zombie', '2009', 168, 4, 5, 1, NULL),
(3, 'zombie2', '2019', 249, 4, 5, 1, NULL),
(4, 'icebron', '2022', 87, 2, 7, 1, NULL),
(5, 'the flash', '2022', 237, 2, 7, 1, NULL),
(6, 'batamn', '2009', 162, 4, 1, 1, NULL),
(7, 'kamien', '1999', 37, 3, 5, 1, NULL),
(8, 'ja', '209', 10978, 2, 1, 1, NULL),
(9, 'hghgfgf', '765', 765765, 3, 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `is_admin` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `is_admin`) VALUES
(1, 'fabian', '123', 1),
(3, 'koks', '321', 0),
(4, 'nizer', '1234', 1),
(5, 'koks', '12345', 0),
(6, 'superanckie', '987654321', 0),
(7, 'czarek', '123', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `generes`
--
ALTER TABLE `generes`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`,`genere_id`,`user_id`),
  ADD KEY `fk_movies_users_idx` (`user_id`),
  ADD KEY `fk_movies_generes1_idx` (`genere_id`),
  ADD KEY `fk_movies_users1_idx` (`admin_id`),
  ADD KEY `fk_movies_users2_idx` (`renter_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `generes`
--
ALTER TABLE `generes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `fk_movies_generes1` FOREIGN KEY (`genere_id`) REFERENCES `generes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movies_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movies_users1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movies_users2` FOREIGN KEY (`renter_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
