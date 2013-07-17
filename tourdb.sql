-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generato il: Lug 17, 2013 alle 17:26
-- Versione del server: 5.5.27
-- Versione PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tourdb`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `attrazioni`
--

CREATE TABLE IF NOT EXISTS `attrazioni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prezzo` float NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `id_destinazione` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_destinazione` (`id_destinazione`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `commento`
--

CREATE TABLE IF NOT EXISTS `commento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utente` varchar(50) NOT NULL,
  `id_destinazione` int(11) NOT NULL,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `pacchetto`
--

CREATE TABLE IF NOT EXISTS `pacchetto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persone` varchar(5) NOT NULL,
  `durata` varchar(5) NOT NULL,
  `data_partenza` date NOT NULL,
  `id_utente` varchar(50) NOT NULL,
  `id_pernottamento` int(11) NOT NULL,
  `id_attrazioni` int(11) NOT NULL,
  `id_trasporto` int(11) NOT NULL,
  `id_destinazione` int(11) NOT NULL,
  `prenotato` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_utente` (`id_utente`),
  KEY `id_pernottamento` (`id_pernottamento`),
  KEY `id_attrazioni` (`id_attrazioni`),
  KEY `id_trasporto` (`id_trasporto`),
  KEY `id_destinazione` (`id_destinazione`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `pernottamento`
--

CREATE TABLE IF NOT EXISTS `pernottamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prezzo` float NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `id_destinazione` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_destinazione` (`id_destinazione`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `rel_attrazioni`
--

CREATE TABLE IF NOT EXISTS `rel_attrazioni` (
  `id_pacchetto` int(11) NOT NULL,
  `id_attrazione` int(11) NOT NULL,
  KEY `id_pacchetto` (`id_pacchetto`),
  KEY `id_attrazione` (`id_attrazione`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `trasporto`
--

CREATE TABLE IF NOT EXISTS `trasporto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prezzo` float NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `id_destinazione` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_destinazione` (`id_destinazione`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`cf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`cf`, `nome`, `cognome`, `mail`, `indirizzo`, `tel`, `user`, `password`) VALUES
('AAAAAAAAAAAAAAAA', 'Agenzia', 'Agenzia', 'agenzia@agenzia.com', '', '', 'agenzia', 'c38f879fbf14e4cec57deb7a92efbb65f3d2631ba0a2a9bc44cb445b4c7a55b1'),
('DRVJHN45L23F205T', 'John', 'Drive', 'john.drive@jdcompany.com', 'Via Montenapoleone, Milano', '023478963', 'johndrive', '22e8fe2e720de91ac08adc53e6ef10ea9cf9a72aa08035e2bfd05e9f69b79b57'),
('RSSMRO73E24B157P', 'Mario', 'Rossi', 'mariorossi@rossis.com', 'via dei rossi', '0246876535', 'mario', '30cc6dd8ef8458e679e13ae3bf3f634cace9810e2eea03bb6487904595f41056'),
('VRDLGI15F12C754Q', 'Luigi', 'Verdi', 'luigi@verdi.com', 'via verdi', '0156541640', 'luigi', 'aeca01371581fda90e31862e10405c4948567d1f74cd92aeac5fe8cd29b6ea96');

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
  ADD CONSTRAINT `commento_ibfk_2` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`cf`);

--
-- Limiti per la tabella `pacchetto`
--
ALTER TABLE `pacchetto`
  ADD CONSTRAINT `pacchetto_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`cf`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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
