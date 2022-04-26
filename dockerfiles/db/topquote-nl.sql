-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Gegenereerd op: 26 apr 2022 om 08:56
-- Serverversie: 10.7.1-MariaDB-1:10.7.1+maria~focal
-- PHP-versie: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `topquote-nl`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `quotes`
--

CREATE TABLE `quotes` (
  `id` int(11) NOT NULL,
  `import_id` varchar(128) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `slug` varchar(255) NOT NULL,
  `quote` text NOT NULL,
  `quote_lc` text NOT NULL,
  `sayer` varchar(255) NOT NULL,
  `sayer_lc` varchar(255) NOT NULL,
  `sayer_slug` varchar(255) NOT NULL,
  `submitter` varchar(255) NOT NULL,
  `submitter_lc` varchar(255) NOT NULL,
  `submitter_slug` varchar(255) NOT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `tags_lc` varchar(255) DEFAULT NULL,
  `hits` bigint(20) NOT NULL DEFAULT 0,
  `likes` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
