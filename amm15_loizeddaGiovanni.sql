-- phpMyAdmin SQL Dump
-- version 4.2.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Lug 15, 2015 alle 17:07
-- Versione del server: 5.5.41-0ubuntu0.14.10.1
-- PHP Version: 5.5.12-2ubuntu4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `amm15_loizeddaGiovanni`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `autori`
--

CREATE TABLE IF NOT EXISTS `autori` (
  `nome` varchar(20) DEFAULT NULL,
  `cognome` varchar(30) DEFAULT NULL,
`id` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dump dei dati per la tabella `autori`
--

INSERT INTO `autori` (`nome`, `cognome`, `id`) VALUES
('Isaac', 'Asimov', 1),
('George', 'Orwell', 2),
('Stephen', 'Hawking', 3),
('Herman', 'Melville', 4),
('Luigi', 'Pirandello', 5),
('Italo', 'Svevo', 6),
('Grazia', 'Deledda', 7);

-- --------------------------------------------------------

--
-- Struttura della tabella `libri`
--

CREATE TABLE IF NOT EXISTS `libri` (
  `titolo` varchar(60) NOT NULL,
  `autore_id` bigint(20) unsigned NOT NULL DEFAULT '0',
`id` bigint(20) unsigned NOT NULL,
  `prestatoA` bigint(20) unsigned DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dump dei dati per la tabella `libri`
--

INSERT INTO `libri` (`titolo`, `autore_id`, `id`, `prestatoA`) VALUES
('1984', 2, 3, NULL),
('Antologia del bicentenario', 1, 10, NULL),
('Canne al vento', 7, 1, NULL),
('Cenere', 7, 18, NULL),
('Dal big bang ai buchi nero. Breve storia del tempo', 3, 12, NULL),
('Fattoria degli Animali', 2, 2, NULL),
('Il fu Mattia Pascal', 5, 4, NULL),
('Il grande disegno', 3, 13, NULL),
('Il secondo libro dei robot', 1, 9, NULL),
('Io, Robot', 1, 8, NULL),
('La coscienza di Zeno', 6, 6, NULL),
('Missione alle origini dell''universo', 3, 14, NULL),
('Moby Dick', 4, 15, NULL),
('Omoo', 4, 17, NULL),
('Senilità', 6, 7, NULL),
('Taipi', 4, 16, NULL),
('Tutti i miei robot', 1, 11, NULL),
('Uno, nessuno e centomila', 5, 5, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE IF NOT EXISTS `utenti` (
  `username` varchar(60) NOT NULL DEFAULT '',
`id` bigint(20) unsigned NOT NULL,
  `password` varchar(30) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`username`, `id`, `password`) VALUES
('admin', 1, 'admin'),
('user1', 2, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autori`
--
ALTER TABLE `autori`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `libri`
--
ALTER TABLE `libri`
 ADD PRIMARY KEY (`titolo`,`autore_id`), ADD UNIQUE KEY `id` (`id`), ADD KEY `titolo` (`titolo`), ADD KEY `libri_ibfk_1` (`autore_id`), ADD KEY `libri_ibfk_2` (`prestatoA`);

--
-- Indexes for table `utenti`
--
ALTER TABLE `utenti`
 ADD PRIMARY KEY (`username`), ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `autori`
--
ALTER TABLE `autori`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `libri`
--
ALTER TABLE `libri`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `utenti`
--
ALTER TABLE `utenti`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `libri`
--
ALTER TABLE `libri`
ADD CONSTRAINT `libri_ibfk_1` FOREIGN KEY (`autore_id`) REFERENCES `autori` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `libri_ibfk_2` FOREIGN KEY (`prestatoA`) REFERENCES `utenti` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
