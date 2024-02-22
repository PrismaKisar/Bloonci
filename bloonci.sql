-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 22, 2024 at 09:40 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bloonci`
--

-- --------------------------------------------------------

--
-- Table structure for table `amicizia`
--

CREATE TABLE `amicizia` (
  `emailRichiedente` varchar(50) NOT NULL,
  `emailRicevitore` varchar(50) NOT NULL,
  `dataRichiesta` date NOT NULL,
  `dataAccettazione` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `amicizia`
--

INSERT INTO `amicizia` (`emailRichiedente`, `emailRicevitore`, `dataRichiesta`, `dataAccettazione`) VALUES
('ale.sarchi@gmail.com', 'alebilo@gmail.com', '2024-02-22', NULL),
('ale.sarchi@gmail.com', 'carmi@gmail.com', '2024-02-22', '2023-10-03'),
('ale.sarchi@gmail.com', 'filo@gmail.com', '2024-02-22', '2024-02-07'),
('ale.sarchi@gmail.com', 'giorgiapolli11@libero.it', '2024-02-22', '2024-02-07'),
('ale.sarchi@gmail.com', 'kit@gmail.com', '2024-02-22', '2024-02-21'),
('ale.sarchi@gmail.com', 'lora@gmail.com', '2024-02-22', '2024-02-20'),
('ale.sarchi@gmail.com', 'luke.giuss@gmail.com', '2024-02-22', '2024-02-06');

-- --------------------------------------------------------

--
-- Table structure for table `città`
--

CREATE TABLE `città` (
  `città` varchar(30) NOT NULL,
  `provincia` varchar(30) NOT NULL,
  `stato` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `città`
--

INSERT INTO `città` (`città`, `provincia`, `stato`) VALUES
('Milano', 'MI', 'Italia'),
('Pavia', 'PV', 'Italia'),
('Segrate', 'MI', 'Italia'),
('Trivolzio', 'PV', 'Italia');

-- --------------------------------------------------------

--
-- Table structure for table `commento`
--

CREATE TABLE `commento` (
  `IDCommento` bigint(20) NOT NULL,
  `progressivo` enum('1','2','3','4','5') NOT NULL,
  `emailCommento` varchar(50) NOT NULL,
  `emailMessaggio` varchar(50) NOT NULL,
  `timestampMessaggio` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `testo` varchar(500) NOT NULL,
  `IDMessaggio` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `commento`
--

INSERT INTO `commento` (`IDCommento`, `progressivo`, `emailCommento`, `emailMessaggio`, `timestampMessaggio`, `testo`, `IDMessaggio`) VALUES
(1, '1', 'ale.sarchi@gmail.com', 'luke.giuss@gmail.com', '2024-02-22 08:46:05', 'Vamoosss', NULL),
(2, '1', 'ale.sarchi@gmail.com', 'ale.sarchi@gmail.com', '2024-02-22 08:22:36', 'jadhkadjka', 12),
(3, '2', 'ale.sarchi@gmail.com', 'ale.sarchi@gmail.com', '2024-02-22 08:22:36', '88888', 8),
(4, '3', 'ale.sarchi@gmail.com', 'ale.sarchi@gmail.com', '2024-02-22 08:22:36', 'acaf', NULL),
(5, '1', 'ale.sarchi@gmail.com', 'ale.sarchi@gmail.com', '2024-02-22 08:21:41', 'NOOOOOOO', NULL),
(6, '1', 'ale.sarchi@gmail.com', 'ale.sarchi@gmail.com', '2024-02-22 08:21:53', 'siiii', NULL),
(7, '2', 'ale.sarchi@gmail.com', 'luke.giuss@gmail.com', '2024-02-22 08:46:05', 'Riferisco', 17),
(8, '3', 'ale.sarchi@gmail.com', 'luke.giuss@gmail.com', '2024-02-22 08:46:05', 'Commento referenziante', NULL),
(9, '1', 'ale.sarchi@gmail.com', 'ale.sarchi@gmail.com', '2024-02-22 20:08:54', 'Senza referenza', NULL),
(10, '1', 'ale.sarchi@gmail.com', 'ale.sarchi@gmail.com', '2024-02-22 20:06:06', 'zafsf', 15);

-- --------------------------------------------------------

--
-- Table structure for table `gradimento`
--

CREATE TABLE `gradimento` (
  `IDGradimento` bigint(20) NOT NULL,
  `IDCommento` bigint(20) NOT NULL,
  `indiceGradimento` enum('-3','-2','-1','0','1','2','3') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `emailGradimento` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gradimento`
--

INSERT INTO `gradimento` (`IDGradimento`, `IDCommento`, `indiceGradimento`, `emailGradimento`) VALUES
(1, 1, '1', 'ale.sarchi@gmail.com'),
(2, 9, '2', 'ale.sarchi@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `hobby`
--

CREATE TABLE `hobby` (
  `hobby` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `hobby`
--

INSERT INTO `hobby` (`hobby`) VALUES
('Atletica'),
('Basket'),
('Calcio'),
('Nuoto'),
('Pallavolo'),
('Scherma');

-- --------------------------------------------------------

--
-- Table structure for table `messaggio`
--

CREATE TABLE `messaggio` (
  `IDMessaggio` bigint(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tipo` enum('foto','testo') NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `percorso` varchar(100) DEFAULT NULL,
  `testo` varchar(100) DEFAULT NULL,
  `città` varchar(30) DEFAULT NULL,
  `provincia` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `messaggio`
--

INSERT INTO `messaggio` (`IDMessaggio`, `email`, `timestamp`, `tipo`, `nome`, `percorso`, `testo`, `città`, `provincia`) VALUES
(8, 'luke.giuss@gmail.com', '2024-02-22 08:46:05', 'testo', NULL, NULL, 'CIAOOOO', NULL, NULL),
(12, 'ale.sarchi@gmail.com', '2024-02-22 08:18:29', 'testo', NULL, NULL, 'SIIIIII', 'Milano', 'MI'),
(13, 'ale.sarchi@gmail.com', '2024-02-22 08:21:41', 'testo', NULL, NULL, 'vediamo', NULL, NULL),
(14, 'ale.sarchi@gmail.com', '2024-02-22 08:21:53', 'testo', NULL, NULL, 'vediamo 2', 'Milano', 'MI'),
(15, 'ale.sarchi@gmail.com', '2024-02-22 08:22:36', 'foto', '65d7044c03aa7.jpeg', 'images/ale.sarchi@gmail.com/', 'Boh', NULL, NULL),
(16, 'ale.sarchi@gmail.com', '2024-02-22 20:06:06', 'testo', NULL, NULL, 'Testo senza luogo', NULL, NULL),
(17, 'ale.sarchi@gmail.com', '2024-02-22 20:06:18', 'testo', NULL, NULL, 'Testo con luogo', 'Segrate', 'MI'),
(18, 'ale.sarchi@gmail.com', '2024-02-22 20:07:55', 'foto', '65d7a99b96802.jpeg', 'images/ale.sarchi@gmail.com/', 'Foto senza luogo', NULL, NULL),
(19, 'ale.sarchi@gmail.com', '2024-02-22 20:08:54', 'foto', '65d7a9d65a4a3.jpg', 'images/ale.sarchi@gmail.com/', 'Foto con luogo', 'Pavia', 'PV');

-- --------------------------------------------------------

--
-- Table structure for table `possiede`
--

CREATE TABLE `possiede` (
  `hobby` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `possiede`
--

INSERT INTO `possiede` (`hobby`, `email`) VALUES
('Basket', 'ale.sarchi@gmail.com'),
('Calcio', 'ale.sarchi@gmail.com'),
('Scherma', 'ale.sarchi@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `utente`
--

CREATE TABLE `utente` (
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `dataNascita` date DEFAULT NULL,
  `cittàNacita` varchar(30) DEFAULT NULL,
  `provinciaNascita` varchar(30) DEFAULT NULL,
  `orientamentoSessuale` enum('eterosessuale','omosessuale','bisessuale','altro') DEFAULT NULL,
  `rispettabilità` enum('0','1','2','3','4','5','6','7','8','9','10') NOT NULL DEFAULT '6',
  `bloccante` varchar(50) DEFAULT NULL,
  `amministratore` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `utente`
--

INSERT INTO `utente` (`email`, `password`, `nome`, `cognome`, `dataNascita`, `cittàNacita`, `provinciaNascita`, `orientamentoSessuale`, `rispettabilità`, `bloccante`, `amministratore`) VALUES
('ale.sarchi@gmail.com', 'cr7', 'Alessandro', 'Sarchi', '2024-02-02', 'Pavia', 'PV', 'omosessuale', '6', NULL, 1),
('alebilo@gmail.com', 'bilo', 'Alessandro', 'Bilotta', NULL, NULL, NULL, NULL, '6', NULL, 0),
('carmi@gmail.com', 'carmi', 'Carmilla', 'Galasso', NULL, NULL, NULL, NULL, '6', NULL, 0),
('filo@gmail.com', '123', 'Filippo', 'Di Marco', NULL, NULL, NULL, NULL, '6', NULL, 0),
('giorgiapolli11@libero.it', 'giopolli', 'Giorgia', 'Polli', NULL, NULL, NULL, NULL, '6', NULL, 0),
('kit@gmail.com', 'kitt', 'Giulia', 'Cattaneo', NULL, NULL, NULL, NULL, '6', NULL, 0),
('lora@gmail.com', 'lora', 'Laura', 'Capella', '2023-12-07', 'Milano', 'MI', 'omosessuale', '6', NULL, 0),
('lucio@gmail.com', 'lucio', 'Lucio', 'Cojo', NULL, 'Milano', 'MI', 'eterosessuale', '6', NULL, 0),
('luke.giuss@gmail.com', 'giuss', 'Luca', 'Giussani', NULL, NULL, NULL, NULL, '8', NULL, 0),
('michbymich@gmail.com', 'yomich', 'Michele', 'D\'Ettorre', '2002-02-16', NULL, NULL, NULL, '6', NULL, 0),
('rick@gmail.com', 'imperatore', 'Riccardo', 'Cataldi', NULL, NULL, NULL, NULL, '6', NULL, 0),
('sofi.buda@gmail.com', 'ciaociao', 'Sofia', 'Buda', '2001-12-28', NULL, NULL, NULL, '6', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `valuta`
--

CREATE TABLE `valuta` (
  `IDValuta` bigint(20) NOT NULL,
  `emailValutazione` varchar(50) NOT NULL,
  `emailMessaggio` varchar(50) NOT NULL,
  `timestampMessaggio` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `valutazione` enum('-3','-2','-1','0','1','2','3') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `valuta`
--

INSERT INTO `valuta` (`IDValuta`, `emailValutazione`, `emailMessaggio`, `timestampMessaggio`, `valutazione`) VALUES
(1, 'ale.sarchi@gmail.com', 'ale.sarchi@gmail.com', '2024-02-22 08:22:36', '-2'),
(2, 'ale.sarchi@gmail.com', 'ale.sarchi@gmail.com', '2024-02-22 08:21:53', '0'),
(3, 'ale.sarchi@gmail.com', 'ale.sarchi@gmail.com', '2024-02-22 08:21:41', '1'),
(4, 'ale.sarchi@gmail.com', 'ale.sarchi@gmail.com', '2024-02-22 20:08:54', '1'),
(5, 'ale.sarchi@gmail.com', 'luke.giuss@gmail.com', '2024-02-22 08:46:05', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amicizia`
--
ALTER TABLE `amicizia`
  ADD PRIMARY KEY (`emailRichiedente`,`emailRicevitore`),
  ADD KEY `emailRicevitore` (`emailRicevitore`);

--
-- Indexes for table `città`
--
ALTER TABLE `città`
  ADD PRIMARY KEY (`città`,`provincia`);

--
-- Indexes for table `commento`
--
ALTER TABLE `commento`
  ADD PRIMARY KEY (`IDCommento`,`progressivo`),
  ADD UNIQUE KEY `emailCommento` (`emailCommento`,`emailMessaggio`,`timestampMessaggio`,`progressivo`) USING BTREE,
  ADD KEY `emailMessaggio` (`emailMessaggio`,`timestampMessaggio`),
  ADD KEY `IDMessaggio` (`IDMessaggio`);

--
-- Indexes for table `gradimento`
--
ALTER TABLE `gradimento`
  ADD PRIMARY KEY (`IDGradimento`),
  ADD KEY `IDCommento` (`IDCommento`),
  ADD KEY `emailGradimento` (`emailGradimento`);

--
-- Indexes for table `hobby`
--
ALTER TABLE `hobby`
  ADD PRIMARY KEY (`hobby`);

--
-- Indexes for table `messaggio`
--
ALTER TABLE `messaggio`
  ADD PRIMARY KEY (`IDMessaggio`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`,`timestamp`),
  ADD KEY `città` (`città`,`provincia`);

--
-- Indexes for table `possiede`
--
ALTER TABLE `possiede`
  ADD PRIMARY KEY (`hobby`,`email`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`email`),
  ADD KEY `utente_ibfk_1` (`cittàNacita`,`provinciaNascita`),
  ADD KEY `bloccante` (`bloccante`);

--
-- Indexes for table `valuta`
--
ALTER TABLE `valuta`
  ADD PRIMARY KEY (`IDValuta`),
  ADD UNIQUE KEY `emailValutazione` (`emailValutazione`,`emailMessaggio`,`timestampMessaggio`),
  ADD KEY `emailMessaggio` (`emailMessaggio`,`timestampMessaggio`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `amicizia`
--
ALTER TABLE `amicizia`
  ADD CONSTRAINT `amicizia_ibfk_1` FOREIGN KEY (`emailRichiedente`) REFERENCES `utente` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `amicizia_ibfk_2` FOREIGN KEY (`emailRicevitore`) REFERENCES `utente` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `commento`
--
ALTER TABLE `commento`
  ADD CONSTRAINT `commento_ibfk_1` FOREIGN KEY (`emailMessaggio`,`timestampMessaggio`) REFERENCES `messaggio` (`email`, `timestamp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commento_ibfk_2` FOREIGN KEY (`emailCommento`) REFERENCES `utente` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commento_ibfk_3` FOREIGN KEY (`IDMessaggio`) REFERENCES `messaggio` (`IDMessaggio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gradimento`
--
ALTER TABLE `gradimento`
  ADD CONSTRAINT `gradimento_ibfk_1` FOREIGN KEY (`IDCommento`) REFERENCES `commento` (`IDCommento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gradimento_ibfk_2` FOREIGN KEY (`emailGradimento`) REFERENCES `utente` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messaggio`
--
ALTER TABLE `messaggio`
  ADD CONSTRAINT `messaggio_ibfk_1` FOREIGN KEY (`email`) REFERENCES `utente` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `possiede`
--
ALTER TABLE `possiede`
  ADD CONSTRAINT `possiede_ibfk_1` FOREIGN KEY (`email`) REFERENCES `utente` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `possiede_ibfk_2` FOREIGN KEY (`hobby`) REFERENCES `hobby` (`hobby`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `utente`
--
ALTER TABLE `utente`
  ADD CONSTRAINT `utente_ibfk_1` FOREIGN KEY (`cittàNacita`,`provinciaNascita`) REFERENCES `città` (`città`, `provincia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `utente_ibfk_2` FOREIGN KEY (`bloccante`) REFERENCES `utente` (`email`);

--
-- Constraints for table `valuta`
--
ALTER TABLE `valuta`
  ADD CONSTRAINT `valuta_ibfk_1` FOREIGN KEY (`emailValutazione`) REFERENCES `utente` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `valuta_ibfk_2` FOREIGN KEY (`emailMessaggio`,`timestampMessaggio`) REFERENCES `messaggio` (`email`, `timestamp`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
