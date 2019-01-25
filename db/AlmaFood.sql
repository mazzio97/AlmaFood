-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Gen 25, 2019 alle 23:37
-- Versione del server: 10.3.12-MariaDB
-- Versione PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `almafood`
--

CREATE DATABASE almafood;
USE almafood;

-- --------------------------------------------------------

--
-- Struttura della tabella `aula`
--

CREATE TABLE `aula` (
  `idAula` int(11) NOT NULL,
  `nome` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `aula`
--

INSERT INTO `aula` (`idAula`, `nome`) VALUES
(2000, 'Sala Ristoro'),
(2001, 'Ingresso'),
(2003, 'Aula 2.3'),
(3002, 'Laboratorio ISI'),
(3003, 'Laboratorio 3.3'),
(3004, 'Aula Magna');

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `nome` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nome`) VALUES
(1, 'Pizza'),
(2, 'Burger'),
(3, 'Panini'),
(4, 'Primi'),
(5, 'Pesce'),
(6, 'Carne'),
(7, 'Contorni'),
(8, 'Bevande'),
(9, 'Birra'),
(10, 'Sushi'),
(11, 'Sashimi'),
(12, 'Dessert');

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
--

CREATE TABLE `cliente` (
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cognome` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `cliente`
--

INSERT INTO `cliente` (`username`, `password`, `email`, `nome`, `cognome`) VALUES
('elreech', '$2y$10$2ftbI3Wt/0el.0moFMd7.ud5SHucf7H.5zrdYo5/f.iWbR2Ho98ti', 'elreech@aviato.com', 'Elrich', 'Bachman'),
('giuluck', '$2y$10$ZlUuvXgqT9kWdL0ZPwCI5.APnBJv6929PtcYniVvcdVIyD8gY5WG.', 'giuluck@gmail.com', 'Luca', 'Giuliani'),
('imraazy', '$2y$10$byZlHWDMWumXV8Dcb/NNR.yg6fC2bS9h4KAU7nUkonynrrvK2ndSm', 'imraazy@libero.com', 'Milo', 'Marchetti'),
('markyR', '$2y$10$tLFW3YJ6Whk8qipsZVga4uMMZwQhePuGdSVnA1kqYKb4H8NKHTkxG', 'markyR@qq.com', 'Mark', 'Renton'),
('mazziokiller', '$2y$10$orF6nbusm9jv4il5akfsHeLFPsll4F5GnqGRMQ1YDG3eHzXTZkI8O', 'mazzio@killer.com', 'Diego', 'Mazzieri'),
('tr354m1g05', '$2y$10$Gz21rMpbr3vsSMVrBUdMnOPyy7C7fOuTbb8WFrKSkirCdK0F18EPq', 'tres@amigos.com', 'Tres', 'Amigos');

-- --------------------------------------------------------

--
-- Struttura della tabella `composizione`
--

CREATE TABLE `composizione` (
  `idIngrediente` int(11) NOT NULL,
  `idPietanza` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `composizione`
--

INSERT INTO `composizione` (`idIngrediente`, `idPietanza`) VALUES
(27, 1),
(35, 1),
(46, 1),
(47, 1),
(51, 1),
(59, 1),
(60, 1),
(6, 2),
(44, 3),
(61, 3),
(66, 3),
(4, 4),
(5, 4),
(24, 4),
(5, 5),
(15, 5),
(66, 5),
(10, 6),
(16, 6),
(29, 6),
(33, 6),
(48, 6),
(1, 7),
(2, 7),
(66, 8),
(4, 9),
(8, 9),
(50, 9),
(60, 9),
(4, 10),
(5, 10),
(7, 10),
(11, 10),
(43, 10),
(41, 11),
(1, 13),
(2, 13),
(1, 14),
(2, 14),
(20, 14),
(25, 14),
(43, 14),
(1, 15),
(2, 15),
(37, 15),
(7, 19),
(10, 19),
(12, 19),
(17, 19),
(33, 19),
(42, 19),
(48, 19),
(60, 19),
(31, 20),
(26, 21),
(14, 22),
(31, 22),
(31, 23),
(26, 24),
(5, 26),
(28, 26),
(31, 26),
(41, 26),
(60, 26),
(14, 27),
(28, 27),
(31, 27),
(60, 27),
(24, 29),
(41, 29),
(46, 29),
(59, 29),
(60, 29),
(16, 30),
(59, 30),
(59, 31);

-- --------------------------------------------------------

--
-- Struttura della tabella `fornitore`
--

CREATE TABLE `fornitore` (
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ristorante` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qual_sum` int(11) NOT NULL DEFAULT 0,
  `qual_tot` int(11) NOT NULL DEFAULT 0,
  `prez_sum` int(11) NOT NULL DEFAULT 0,
  `prez_tot` int(11) NOT NULL DEFAULT 0,
  `abilitato` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `fornitore`
--

INSERT INTO `fornitore` (`username`, `password`, `email`, `ristorante`, `qual_sum`, `qual_tot`, `prez_sum`, `prez_tot`, `abilitato`) VALUES
('lucullo', '$2y$10$MEdeLvLUZ2zL48KrJxTwROF63BYHahN6tSOnbrF7eeKMBnnrSYdaq', 'pizzeria@lucullo.com', 'Pizzeria Lucullo', 0, 1, 0, 1, 1),
('mcdonalds', '$2y$10$GOXYFV9ao5c8uGNJMndi9u.JHE0cfbWWIu9TvHJky0sM.WI8dY.Ea', 'mcflurry@gmail.com', 'Mc Donald\'s', -3, 1, -2, 1, 1),
('mrslovett', '$2y$10$firGM1N13rLbyxBJcjaZxu/ecr1xFLko.GKVRHajxqb6I0n5LD1Bm', 'mrslovett@hotmail.com', 'Fleet Street\'s', -3, 2, 0, 2, 1),
('ratatouille', '$2y$10$/apX7L5.GGFjmbw58HYJQuRkkdRhwdSo5iDWl1CHmGX9G.xSzE8Fu', 'ratatouille@pixar.com', 'Gusteau\'s', 3, 1, 2, 1, 1),
('tokyhotel', '$2y$10$72xfXKSOObG4VIz/cBw3NuHtSTDEWP1vpcCIJxka5fK4/4yD13wji', 'toki@qq.com', 'Toki Hotel', 3, 3, 4, 3, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `ingrediente`
--

CREATE TABLE `ingrediente` (
  `idIngrediente` int(11) NOT NULL,
  `nome` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `ingrediente`
--

INSERT INTO `ingrediente` (`idIngrediente`, `nome`) VALUES
(1, 'pomodoro'),
(2, 'mozzarella'),
(3, 'insalata'),
(4, 'pancetta'),
(5, 'uovo'),
(6, 'carne macinata'),
(7, 'burger maiale'),
(8, 'burger pollo'),
(9, 'burger pesce'),
(10, 'burger cinghiale'),
(11, 'maionese'),
(12, 'senape'),
(13, 'ketchup'),
(14, 'avocado'),
(15, 'ananas'),
(16, 'peperoncino'),
(17, 'fontina'),
(18, 'squacquerone'),
(19, 'rucola'),
(20, 'prosciutto cotto'),
(21, 'prosciutto crudo'),
(22, 'salame'),
(23, 'lonza'),
(24, 'pecorino'),
(25, 'olive'),
(26, 'tonno'),
(27, 'basilico'),
(28, 'gamberetti'),
(29, 'gorgonzola'),
(30, 'tofu'),
(31, 'salmone'),
(32, 'salmone affumicato'),
(33, 'scamorza'),
(34, 'scamorza affumicata'),
(35, 'pomodorini'),
(36, 'insalata belga'),
(37, 'salsiccia'),
(38, 'salsiccia piccante'),
(39, 'salame piccante'),
(40, 'wurstel'),
(41, 'patate'),
(42, 'carciofi'),
(43, 'carciofini'),
(44, 'philadelphia'),
(45, 'sgombro'),
(46, 'zucchine'),
(47, 'melanzane'),
(48, 'funghi porcini'),
(49, 'funghi champignon'),
(50, 'funghi trifolati'),
(51, 'peperoni'),
(52, 'arance'),
(53, 'mele'),
(54, 'pere'),
(55, 'banane'),
(56, 'kiwi'),
(57, 'mandarini'),
(58, 'noci'),
(59, 'aglio'),
(60, 'cipolla'),
(61, 'frutti di bosco'),
(62, 'fragole'),
(63, 'more'),
(64, 'lamponi'),
(65, 'ribes'),
(66, 'panna');

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE `ordine` (
  `idOrdine` int(11) NOT NULL,
  `dataora` int(11) NOT NULL,
  `costoTot` decimal(6,2) NOT NULL,
  `rec_qualita` int(11) DEFAULT NULL,
  `rec_prezzo` int(11) DEFAULT NULL,
  `idAula` int(11) NOT NULL,
  `idStato` int(11) NOT NULL DEFAULT 1,
  `cli_user` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `forn_user` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `ordine`
--

INSERT INTO `ordine` (`idOrdine`, `dataora`, `costoTot`, `rec_qualita`, `rec_prezzo`, `idAula`, `idStato`, `cli_user`, `forn_user`) VALUES
(4, 1548437400, '23.00', -3, 2, 3003, 4, 'imraazy', 'tokyhotel'),
(5, 1548442800, '8.50', NULL, NULL, 3003, 3, 'imraazy', 'lucullo'),
(6, 1548441900, '11.10', 0, 0, 2003, 4, 'imraazy', 'mrslovett'),
(7, 1548448440, '23.00', 3, 2, 2003, 4, 'imraazy', 'tokyhotel'),
(8, 1548450000, '14.50', -3, -2, 2003, 4, 'mazziokiller', 'mcdonalds'),
(9, 1548455400, '39.20', 3, 2, 2003, 4, 'mazziokiller', 'ratatouille'),
(10, 1548445140, '11.70', -3, 0, 2000, 4, 'mazziokiller', 'mrslovett'),
(11, 1548455640, '17.00', 0, 0, 2003, 4, 'giuluck', 'lucullo'),
(12, 1548456300, '24.00', 3, 0, 2003, 4, 'giuluck', 'tokyhotel'),
(13, 1548456300, '17.00', NULL, NULL, 3004, 4, 'elreech', 'ratatouille'),
(14, 1548456300, '17.00', NULL, NULL, 2003, 4, 'elreech', 'ratatouille'),
(15, 1548457020, '17.00', NULL, NULL, 2003, 4, 'elreech', 'ratatouille'),
(16, 1548457080, '3.30', NULL, NULL, 2003, 4, 'markyR', 'mrslovett'),
(17, 1548457140, '1.00', NULL, NULL, 3004, 4, 'markyR', 'mcdonalds');

-- --------------------------------------------------------

--
-- Struttura della tabella `pietanza`
--

CREATE TABLE `pietanza` (
  `idPietanza` int(11) NOT NULL,
  `nome` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `costo` decimal(5,2) NOT NULL,
  `forn_user` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `pietanza`
--

INSERT INTO `pietanza` (`idPietanza`, `nome`, `costo`, `forn_user`, `idCategoria`) VALUES
(1, 'Ratatouille', '6.90', 'ratatouille', 7),
(2, 'Pasticcio di Carne', '1.10', 'mrslovett', 6),
(3, 'Cheesecake', '4.50', 'ratatouille', 12),
(4, 'Carbonara', '8.00', 'mrslovett', 4),
(5, 'Dolce all\'ananas', '5.00', 'mrslovett', 12),
(6, 'Panino del minatore', '10.00', 'mrslovett', 3),
(7, 'Caprese', '4.50', 'mrslovett', 7),
(8, 'Mc Flurry', '1.00', 'mcdonalds', 12),
(9, 'Mc Guedo', '6.00', 'mcdonalds', 2),
(10, 'Big Mac', '7.00', 'mcdonalds', 2),
(11, 'Patatine', '4.50', 'mcdonalds', 7),
(12, 'Birra Moretti', '3.00', 'mcdonalds', 8),
(13, 'Margherita', '3.50', 'lucullo', 1),
(14, 'Quattro Stagioni', '5.60', 'lucullo', 1),
(15, 'Salsiccia', '5.00', 'lucullo', 1),
(16, 'Fanta', '2.50', 'lucullo', 8),
(17, 'Coca Cola', '2.50', 'lucullo', 8),
(18, 'Acqua', '1.00', 'lucullo', 8),
(19, 'Panino Ciccio', '10.00', 'lucullo', 2),
(20, 'Nigiri Salmone', '6.00', 'tokyhotel', 10),
(21, 'Nigiri Tonno', '6.00', 'tokyhotel', 10),
(22, 'Machi', '5.00', 'tokyhotel', 10),
(23, 'Sashimi Salmone', '6.00', 'tokyhotel', 11),
(24, 'Sashimi Tonno', '6.00', 'tokyhotel', 11),
(25, 'Sakè', '8.00', 'tokyhotel', 8),
(26, 'Udon', '8.00', 'tokyhotel', 4),
(27, 'Miso', '6.00', 'tokyhotel', 4),
(29, 'Vellutata', '12.30', 'ratatouille', 4),
(30, 'Cime di rapa', '8.00', 'ratatouille', 7),
(31, 'Fiorentina', '20.00', 'ratatouille', 6);

-- --------------------------------------------------------

--
-- Struttura della tabella `pietanza_in_ordine`
--

CREATE TABLE `pietanza_in_ordine` (
  `idPietanza` int(11) NOT NULL,
  `idOrdine` int(11) NOT NULL,
  `quantita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `pietanza_in_ordine`
--

INSERT INTO `pietanza_in_ordine` (`idPietanza`, `idOrdine`, `quantita`) VALUES
(20, 4, 2),
(22, 4, 1),
(24, 4, 1),
(13, 5, 1),
(15, 5, 1),
(2, 6, 1),
(6, 6, 1),
(20, 7, 2),
(22, 7, 1),
(24, 7, 1),
(8, 8, 1),
(9, 8, 1),
(11, 8, 1),
(12, 8, 1),
(1, 9, 1),
(29, 9, 1),
(31, 9, 1),
(2, 10, 2),
(5, 10, 1),
(7, 10, 1),
(13, 11, 2),
(15, 11, 1),
(17, 11, 2),
(21, 12, 4),
(3, 13, 2),
(30, 13, 1),
(3, 14, 2),
(30, 14, 1),
(3, 15, 2),
(30, 15, 1),
(2, 16, 3),
(8, 17, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `stato`
--

CREATE TABLE `stato` (
  `idStato` int(11) NOT NULL,
  `nome` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `stato`
--

INSERT INTO `stato` (`idStato`, `nome`) VALUES
(1, 'pendente'),
(2, 'accettato'),
(3, 'rifiutato'),
(4, 'consegnato');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `aula`
--
ALTER TABLE `aula`
  ADD PRIMARY KEY (`idAula`);

--
-- Indici per le tabelle `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indici per le tabelle `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `IDCLIENTE_1` (`email`);

--
-- Indici per le tabelle `composizione`
--
ALTER TABLE `composizione`
  ADD PRIMARY KEY (`idPietanza`,`idIngrediente`),
  ADD KEY `FKcompone` (`idIngrediente`);

--
-- Indici per le tabelle `fornitore`
--
ALTER TABLE `fornitore`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `IDFORNITORE_1` (`email`);

--
-- Indici per le tabelle `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD PRIMARY KEY (`idIngrediente`);

--
-- Indici per le tabelle `ordine`
--
ALTER TABLE `ordine`
  ADD PRIMARY KEY (`idOrdine`),
  ADD KEY `FKdiretto` (`idAula`),
  ADD KEY `FKstato` (`idStato`),
  ADD KEY `FKinvia` (`cli_user`),
  ADD KEY `FKriceve` (`forn_user`);

--
-- Indici per le tabelle `pietanza`
--
ALTER TABLE `pietanza`
  ADD PRIMARY KEY (`idPietanza`),
  ADD KEY `FKcomprende` (`forn_user`),
  ADD KEY `FKappartiene` (`idCategoria`);

--
-- Indici per le tabelle `pietanza_in_ordine`
--
ALTER TABLE `pietanza_in_ordine`
  ADD PRIMARY KEY (`idOrdine`,`idPietanza`),
  ADD KEY `FKR_1` (`idPietanza`);

--
-- Indici per le tabelle `stato`
--
ALTER TABLE `stato`
  ADD PRIMARY KEY (`idStato`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--
--

-- AUTO_INCREMENT per la tabella `aula`
--
ALTER TABLE `aula`
  MODIFY `idAula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT per la tabella `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT per la tabella `ingrediente`
--
ALTER TABLE `ingrediente`
  MODIFY `idIngrediente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT per la tabella `ordine`
--
ALTER TABLE `ordine`
  MODIFY `idOrdine` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT per la tabella `pietanza`
--
ALTER TABLE `pietanza`
  MODIFY `idPietanza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT per la tabella `stato`
--
ALTER TABLE `stato`
  MODIFY `idStato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `composizione`
--
ALTER TABLE `composizione`
  ADD CONSTRAINT `FKcompone` FOREIGN KEY (`idIngrediente`) REFERENCES `ingrediente` (`idIngrediente`) ON DELETE CASCADE,
  ADD CONSTRAINT `FKcomposto` FOREIGN KEY (`idPietanza`) REFERENCES `pietanza` (`idPietanza`) ON DELETE CASCADE;

--
-- Limiti per la tabella `ordine`
--
ALTER TABLE `ordine`
  ADD CONSTRAINT `FKdiretto` FOREIGN KEY (`idAula`) REFERENCES `aula` (`idAula`) ON DELETE CASCADE,
  ADD CONSTRAINT `FKinvia` FOREIGN KEY (`cli_user`) REFERENCES `cliente` (`username`) ON DELETE CASCADE,
  ADD CONSTRAINT `FKriceve` FOREIGN KEY (`forn_user`) REFERENCES `fornitore` (`username`) ON DELETE CASCADE,
  ADD CONSTRAINT `FKstato` FOREIGN KEY (`idStato`) REFERENCES `stato` (`idStato`) ON DELETE CASCADE;

--
-- Limiti per la tabella `pietanza`
--
ALTER TABLE `pietanza`
  ADD CONSTRAINT `FKappartiene` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE CASCADE,
  ADD CONSTRAINT `FKcomprende` FOREIGN KEY (`forn_user`) REFERENCES `fornitore` (`username`) ON DELETE CASCADE;

--
-- Limiti per la tabella `pietanza_in_ordine`
--
ALTER TABLE `pietanza_in_ordine`
  ADD CONSTRAINT `FKR` FOREIGN KEY (`idOrdine`) REFERENCES `ordine` (`idOrdine`) ON DELETE CASCADE,
  ADD CONSTRAINT `FKR_1` FOREIGN KEY (`idPietanza`) REFERENCES `pietanza` (`idPietanza`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
