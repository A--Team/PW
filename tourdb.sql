-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generato il: Lug 30, 2013 alle 12:28
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
-- Struttura della tabella `destinazione`
--

CREATE TABLE IF NOT EXISTS `destinazione` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `continente` varchar(50) NOT NULL,
  `citta` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dump dei dati per la tabella `destinazione`
--

INSERT INTO `destinazione` (`id`, `continente`, `citta`, `tipo`, `foto`) VALUES
(1, 'europa', 'roma', 'culturale', 'roma.jpg'),
(2, 'asia', 'tokyo', 'culturale', 'tokyo.jpg'),
(3, 'america', 'miami', 'divertimento', 'miami.jpg'),
(4, 'oceania', 'sydney', 'relax', 'sydney.jpg'),
(5, 'europa', 'parigi', 'divertimento', 'parigi.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
