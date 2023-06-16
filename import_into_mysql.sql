-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Erstellungszeit: 15. Jun 2023 um 16:14
-- Server-Version: 5.7.41-log
-- PHP-Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `dbs11193519`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `account_locks`
--

CREATE TABLE `account_locks` (
  `ip` varchar(124) NOT NULL DEFAULT '',
  `locked_until` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `activate_keys`
--

CREATE TABLE `activate_keys` (
  `uid` int(11) DEFAULT NULL,
  `key` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `username` varchar(24) NOT NULL,
  `ip` varchar(124) DEFAULT NULL,
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `things_api`
--

CREATE TABLE `things_api` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `lastrequest` datetime NOT NULL,
  `secret` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `things_todo`
--

CREATE TABLE `things_todo` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `inbox` longtext NOT NULL,
  `today` longtext NOT NULL,
  `everyday` longtext NOT NULL,
  `someday` longtext NOT NULL,
  `lastapi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(24) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `login_count` int(11) DEFAULT '0',
  `login_fails` int(11) DEFAULT '0',
  `logged_out` datetime DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_login_ip` varchar(50) DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `activated` tinyint(1) DEFAULT '0',
  `last_fail` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `account_locks`
--
ALTER TABLE `account_locks`
  ADD PRIMARY KEY (`ip`) USING BTREE;

--
-- Indizes für die Tabelle `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `things_api`
--
ALTER TABLE `things_api`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `things_todo`
--
ALTER TABLE `things_todo`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `user_key` (`username`,`email`) USING BTREE;

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `things_api`
--
ALTER TABLE `things_api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `things_todo`
--
ALTER TABLE `things_todo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
