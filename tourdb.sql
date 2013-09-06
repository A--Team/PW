-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generato il: Set 06, 2013 alle 16:36
-- Versione del server: 5.5.32
-- Versione PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tourdb`
--
CREATE DATABASE IF NOT EXISTS `tourdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tourdb`;

-- --------------------------------------------------------

--
-- Struttura della tabella `attrazioni`
--

CREATE TABLE IF NOT EXISTS `attrazioni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prezzo` float NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `id_destinazione` int(11) NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_destinazione` (`id_destinazione`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dump dei dati per la tabella `attrazioni`
--

INSERT INTO `attrazioni` (`id`, `prezzo`, `tipo`, `id_destinazione`, `visible`) VALUES
(1, 12, 'visita colosseo', 1, 1),
(2, 10, 'visita tour eiffel', 5, 1),
(3, 25, 'visita shibuya', 2, 1),
(4, 15, 'surf', 3, 1),
(5, 100, 'tour della città', 4, 1),
(6, 15, 'shopping a Akihabara', 2, 1),
(7, 30, 'Visita alle piramidi', 6, 1),
(8, 80, 'Escursione nel deserto', 6, 1),
(9, 80, 'Escursione nel deserto', 8, 1),
(10, 25, 'Snorkeling', 8, 1),
(11, 25, 'Snorkeling', 9, 1),
(12, 80, 'Viaggio in barca', 9, 1),
(13, 10, 'Ciaspolata', 10, 1),
(14, 1, 'Messa commemorativa del Dogui', 10, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `commento`
--

CREATE TABLE IF NOT EXISTS `commento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utente` varchar(50) NOT NULL,
  `id_destinazione` int(11) NOT NULL,
  `data` date NOT NULL,
  `rating` int(11) NOT NULL,
  `testo` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_utente` (`id_utente`),
  KEY `id_destinazione` (`id_destinazione`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `destinazione`
--

CREATE TABLE IF NOT EXISTS `destinazione` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `continente` varchar(50) NOT NULL,
  `citta` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `descrizione` longtext CHARACTER SET utf8 NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dump dei dati per la tabella `destinazione`
--

INSERT INTO `destinazione` (`id`, `continente`, `citta`, `tipo`, `foto`, `descrizione`, `visible`) VALUES
(1, 'europa', 'roma', 'culturale', 'roma.jpg', 'Memorabile visita alla città eterna.', 1),
(2, 'asia', 'tokyo', 'culturale', 'tokyo.jpg', 'Fatti ammaliare dalla più affascinante capitale asiatica.', 1),
(3, 'america', 'miami', 'divertimento', 'miami.jpg', 'Rivivi i momenti memorabili di Miami Vice.', 1),
(4, 'oceania', 'sydney', 'relax', 'sydney.jpg', 'La città migliore al mondo per la caccia al canguro.', 1),
(5, 'europa', 'parigi', 'divertimento', 'parigi.jpg', 'Cosa c''è di meglio di una vacanza senza bidet?', 1),
(6, 'africa', 'cairo', 'Divertimento', 'cairo.jpg', 'Entusiasmante viaggio nella capitale egiziana.', 1),
(7, 'europa', 'formentera', 'Divertimento', 'formentera.jpg', 'Divertente vacanza alle isole Baleari.', 1),
(8, 'africa', 'djerba', 'Divertimento', 'djerba.jpg', 'Fantastico viaggio in una delle principali mete tunisine.', 1),
(9, 'america', 'cancun', 'Divertimento', 'cancun.jpg', 'Il mare turchese più bello del mondo.', 1),
(10, 'europa', 'cortina d''ampezzo', 'Relax', 'cortina.jpg', 'Rilassante soggiorno a Cortina d''Ampezzo.', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `pacchetto`
--

CREATE TABLE IF NOT EXISTS `pacchetto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persone` int(5) NOT NULL,
  `durata` int(5) NOT NULL,
  `data_partenza` date NOT NULL,
  `id_utente` varchar(50) NOT NULL,
  `id_pernottamento` int(11) NOT NULL,
  `id_trasporto` int(11) NOT NULL,
  `id_destinazione` int(11) NOT NULL,
  `prenotato` tinyint(1) NOT NULL DEFAULT '0',
  `sconto` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_utente` (`id_utente`),
  KEY `id_pernottamento` (`id_pernottamento`),
  KEY `id_trasporto` (`id_trasporto`),
  KEY `id_destinazione` (`id_destinazione`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dump dei dati per la tabella `pacchetto`
--

INSERT INTO `pacchetto` (`id`, `persone`, `durata`, `data_partenza`, `id_utente`, `id_pernottamento`, `id_trasporto`, `id_destinazione`, `prenotato`, `sconto`) VALUES
(2, 2, 3, '2013-07-17', 'agenzia', 1, 1, 1, 0, 0.2),
(3, 3, 6, '2014-01-01', 'agenzia', 3, 6, 2, 0, 0),
(4, 2, 6, '2013-10-10', 'agenzia', 3, 5, 2, 0, 0),
(5, 2, 4, '2013-12-18', 'agenzia', 6, 8, 4, 0, 0),
(7, 6, 4, '2013-09-18', 'agenzia', 5, 9, 3, 0, 0),
(8, 2, 5, '2013-09-21', 'agenzia', 7, 10, 6, 0, 0),
(9, 1, 3, '2013-09-14', 'agenzia', 8, 12, 7, 0, 0.15),
(10, 2, 7, '2013-10-05', 'agenzia', 9, 13, 8, 0, 0),
(11, 2, 6, '2013-10-18', 'agenzia', 10, 15, 9, 0, 0.1),
(12, 2, 2, '2013-12-13', 'agenzia', 11, 16, 10, 0, 0),
(13, 2, 4, '2013-09-10', 'agenzia', 2, 7, 5, 0, 0.1),
(16, 2, 4, '2013-09-10', 'johndrive', 2, 7, 5, 0, 0),
(18, 2, 4, '2013-09-10', 'johndrive', 2, 7, 5, 1, 0),
(20, 6, 4, '2014-01-01', 'johndrive', 5, 9, 3, 1, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `pernottamento`
--

CREATE TABLE IF NOT EXISTS `pernottamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prezzo` float NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `id_destinazione` int(11) NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_destinazione` (`id_destinazione`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dump dei dati per la tabella `pernottamento`
--

INSERT INTO `pernottamento` (`id`, `prezzo`, `tipo`, `id_destinazione`, `visible`) VALUES
(1, 200, '4 stelle', 1, 1),
(2, 76, '3 stelle', 5, 1),
(3, 20, 'ostello', 2, 0),
(4, 500, '5 stelle', 2, 1),
(5, 400, '4 stelle', 3, 1),
(6, 120, '2 stelle', 4, 1),
(7, 200, '4 stelle', 6, 1),
(8, 35, '2 stelle', 7, 1),
(9, 70, '3 stelle', 8, 1),
(10, 150, '3 stelle', 9, 1),
(11, 350, '4 stelle', 10, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `rel_attrazioni`
--

CREATE TABLE IF NOT EXISTS `rel_attrazioni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pacchetto` int(11) NOT NULL,
  `id_attrazione` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pacchetto` (`id_pacchetto`),
  KEY `id_attrazione` (`id_attrazione`),
  KEY `id_pacchetto_2` (`id_pacchetto`),
  KEY `id_attrazione_2` (`id_attrazione`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Dump dei dati per la tabella `rel_attrazioni`
--

INSERT INTO `rel_attrazioni` (`id`, `id_pacchetto`, `id_attrazione`) VALUES
(1, 2, 1),
(16, 4, 3),
(17, 4, 6),
(18, 8, 7),
(19, 8, 8),
(21, 10, 10),
(22, 11, 11),
(23, 12, 14),
(62, 13, 2),
(65, 16, 2),
(67, 18, 2),
(70, 3, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `trasporto`
--

CREATE TABLE IF NOT EXISTS `trasporto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prezzo` float NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `id_destinazione` int(11) NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_destinazione` (`id_destinazione`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dump dei dati per la tabella `trasporto`
--

INSERT INTO `trasporto` (`id`, `prezzo`, `tipo`, `id_destinazione`, `visible`) VALUES
(1, 300, 'aereo-business', 1, 1),
(2, 60, 'aereo-economy', 1, 1),
(4, 30, 'treno-economy', 1, 1),
(5, 700, 'aereo-economy', 2, 1),
(6, 990, 'aereo-medium', 2, 1),
(7, 99, 'aereo-medium', 5, 1),
(8, 890, 'aereo-business', 4, 1),
(9, 1200, 'aereo-medium', 3, 1),
(10, 200, 'aereo-medium', 6, 1),
(11, 100, 'aereo-economy', 7, 1),
(12, 70, 'pullman', 7, 1),
(13, 250, 'aereo-medium', 8, 1),
(14, 1300, 'aereo-business', 9, 1),
(15, 750, 'aereo-economy', 9, 1),
(16, 50, 'pullman', 10, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE IF NOT EXISTS `utente` (
  `cf` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `indirizzo` varchar(50) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`cf`, `nome`, `cognome`, `mail`, `indirizzo`, `tel`, `user`, `password`) VALUES
('0', 'Agenzia', 'Agenzia', 'agenzia@agenzia.com', 'd', '3', 'agenzia', 'c38f879fbf14e4cec57deb7a92efbb65f3d2631ba0a2a9bc44cb445b4c7a55b1'),
('DRVJHN45L23F205T', 'John', 'Drive', 'john.drive@jdcompany.com', 'Via Montenapoleone, Milano', '023478963', 'johndrive', '22e8fe2e720de91ac08adc53e6ef10ea9cf9a72aa08035e2bfd05e9f69b79b57');

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `attrazioni`
--
ALTER TABLE `attrazioni`
  ADD CONSTRAINT `attrazioni_ibfk_1` FOREIGN KEY (`id_destinazione`) REFERENCES `destinazione` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `commento`
--
ALTER TABLE `commento`
  ADD CONSTRAINT `commento_ibfk_1` FOREIGN KEY (`id_destinazione`) REFERENCES `destinazione` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commento_ibfk_2` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`user`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `pacchetto`
--
ALTER TABLE `pacchetto`
  ADD CONSTRAINT `pacchetto_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`user`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `pacchetto_ibfk_2` FOREIGN KEY (`id_pernottamento`) REFERENCES `pernottamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pacchetto_ibfk_4` FOREIGN KEY (`id_trasporto`) REFERENCES `trasporto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pacchetto_ibfk_5` FOREIGN KEY (`id_destinazione`) REFERENCES `destinazione` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `pernottamento`
--
ALTER TABLE `pernottamento`
  ADD CONSTRAINT `pernottamento_ibfk_1` FOREIGN KEY (`id_destinazione`) REFERENCES `destinazione` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `rel_attrazioni`
--
ALTER TABLE `rel_attrazioni`
  ADD CONSTRAINT `rel_attrazioni_ibfk_1` FOREIGN KEY (`id_pacchetto`) REFERENCES `pacchetto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rel_attrazioni_ibfk_2` FOREIGN KEY (`id_attrazione`) REFERENCES `attrazioni` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `trasporto`
--
ALTER TABLE `trasporto`
  ADD CONSTRAINT `trasporto_ibfk_1` FOREIGN KEY (`id_destinazione`) REFERENCES `destinazione` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
