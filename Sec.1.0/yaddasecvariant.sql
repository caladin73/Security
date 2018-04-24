-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 24. 04 2018 kl. 08:28:23
-- Serverversion: 10.1.28-MariaDB
-- PHP-version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yaddasecvariant`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `avatar`
--

CREATE TABLE `avatar` (
  `uid` varchar(16) NOT NULL,
  `mimetype` varchar(32) NOT NULL,
  `image` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `user`
--

CREATE TABLE `user` (
  `uid` varchar(16) NOT NULL,
  `pwd` blob NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(64) NOT NULL,
  `profile` enum('admin','regular') NOT NULL DEFAULT 'regular',
  `realname` varchar(64) NOT NULL,
  `login_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `user`
--

INSERT INTO `user` (`uid`, `pwd`, `activated`, `email`, `profile`, `realname`, `login_time`) VALUES
('admin', 0x24327924313024433742395345656c556567317557635679552f534e7570744b5849466557613754324d71615a593862445a7846496d66676f6c3069, 1, 'admin@yaddayaddayadda.dk', 'admin', 'Ad Min', '2018-04-23 20:17:37'),
('anybody', 0x243279243130247a594965347933647668492f6644433052346e786d754d52336c4644466d427243796b414f394d6e533359334d6f4a376f6d563979, 0, 'anybody@yaddayaddayadda.dk', 'regular', 'John Doe', '2018-04-23 20:17:37'),
('nobody', 0x243279243130244337613456704c766d33443334415554506d53555875316776687768736236356159752e4139764f434d756856415a38314d334e71, 1, 'nobody@yaddayaddayadda.dk', 'regular', 'Who Am I', '2018-04-24 08:18:16'),
('somebody', 0x243279243130246f577339355962566f666e47564e663356426e774a65386d53764862384b58316378594e55526b636946454134546e657a46315861, 1, 'somebody@yaddayaddayadda.dk', 'regular', 'Jane Doe', '2018-04-23 20:17:37');

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `avatar`
--
ALTER TABLE `avatar`
  ADD PRIMARY KEY (`uid`);

--
-- Indeks for tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Begrænsninger for dumpede tabeller
--

--
-- Begrænsninger for tabel `avatar`
--
ALTER TABLE `avatar`
  ADD CONSTRAINT `avatar_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
