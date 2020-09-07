-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2020 at 11:02 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

CREATE TABLE `kategorija` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 PACK_KEYS=0;

--
-- Dumping data for table `kategorija`
--

INSERT INTO `kategorija` (`id`, `naziv`) VALUES
(1, 'Podrska'),
(2, 'Prijava problema/kvara');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(255) DEFAULT NULL,
  `prezime` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `uloga_id` int(11) DEFAULT NULL,
  `sektor_id` int(11) DEFAULT NULL,
  `spec_id` int(11) DEFAULT NULL,
  `aktivan` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 PACK_KEYS=0;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `username`, `password`, `uloga_id`, `sektor_id`, `spec_id`, `aktivan`) VALUES
(1, 'Bojan', 'Lozo', 'bojan', '827ccb0eea8a706c4c34a16891f84e7b', 1, NULL, NULL, 1),
(2, 'Filip', 'Filipovic', 'filip', '827ccb0eea8a706c4c34a16891f84e7b', 2, 1, 1, 1),
(3, 'Marko', 'Markovic', 'marko', '827ccb0eea8a706c4c34a16891f84e7b', 2, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `potkategorija`
--

CREATE TABLE `potkategorija` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 PACK_KEYS=0;

--
-- Dumping data for table `potkategorija`
--

INSERT INTO `potkategorija` (`id`, `naziv`) VALUES
(1, 'Internet'),
(2, 'Telefonija'),
(3, 'Televizija');

-- --------------------------------------------------------

--
-- Table structure for table `prioritet`
--

CREATE TABLE `prioritet` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 PACK_KEYS=0;

--
-- Dumping data for table `prioritet`
--

INSERT INTO `prioritet` (`id`, `naziv`) VALUES
(1, 'Hitno'),
(2, 'Nije hitno');

-- --------------------------------------------------------

--
-- Table structure for table `sektor`
--

CREATE TABLE `sektor` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Table structure for table `specijalizacija`
--

CREATE TABLE `specijalizacija` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 PACK_KEYS=0;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `naziv`) VALUES
(1, 'Nedodijeljen'),
(2, 'U obradi'),
(3, 'Zavrsen');

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 PACK_KEYS=0;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`id`, `naziv`) VALUES
(1, 'Administrator'),
(2, 'Operater');

-- --------------------------------------------------------

--
-- Table structure for table `zahtjev`
--

CREATE TABLE `zahtjev` (
  `id` int(11) NOT NULL,
  `ime` varchar(255) DEFAULT NULL,
  `prezime` varchar(255) DEFAULT NULL,
  `pretplatnicki_broj` varchar(255) DEFAULT NULL,
  `kategorija_id` int(11) DEFAULT NULL,
  `potkategorija_id` int(11) DEFAULT NULL,
  `opis` text DEFAULT NULL,
  `prioritet_id` int(11) DEFAULT NULL,
  `telefon` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `obavjestenje_saglasnost` tinyint(1) DEFAULT 0,
  `jedinstveni_kod` varchar(255) DEFAULT NULL,
  `za_korisnika` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT 1,
  `datum` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 PACK_KEYS=0;

--
-- Dumping data for table `zahtjev`
--

INSERT INTO `zahtjev` (`id`, `ime`, `prezime`, `pretplatnicki_broj`, `kategorija_id`, `potkategorija_id`, `opis`, `prioritet_id`, `telefon`, `mail`, `obavjestenje_saglasnost`, `jedinstveni_kod`, `za_korisnika`, `status_id`, `datum`) VALUES
(1, 'Bojan', 'Lozo', 'ASDFRE123', 2, 1, 'NE RADI MI KONEKCIJA!!!', 1, '067363573', 'lozobojan@gmail.com', 1, NULL, NULL, 1, '2020-09-03 16:15:17'),
(2, 'Marko', 'Markovic', 'ASCV12344', 1, 2, 'OPIS TEST ...', 2, '068555147', 'marko123@mail.com', 0, 'F8NO1X', NULL, 1, '2020-09-03 16:15:17'),
(3, 'Janko', 'Jankovic', 'ASC34456', 1, 2, 'AAAAAAAAAAAA', 1, '067858522', 'markojanko@mail.com', 1, 'W4IDP6', NULL, 1, '2020-09-03 16:15:17'),
(4, 'Filip', 'Filipovic', 'ASD123', 1, 1, 'Aasasas Aasasas Aasasas Aasasas Aasasas ', 1, '069852147', 'filip@gmail.com', 1, '5RBRCB', NULL, 1, '2020-09-03 16:15:17'),
(5, 'Marko', 'Markovic', '123SSS', 1, 2, 'ne radi ...', 1, '06877412', 'asasas@ffff.me', 1, 'MS4XHK', NULL, 1, '2020-09-03 16:15:17'),
(6, 'Marko', 'Markovic', '123AAA', 1, 1, 'Aaasasasas SASAS', 1, '067885631', 'lll@mail.com', 1, 'U9T5I5', NULL, 1, '2020-09-03 16:15:17'),
(7, 'AA', 'BB', 'CC', 1, 1, 'AAASSS', 1, '555888', 'sasasas', 1, 'BMDW5G', NULL, 1, '2020-09-03 16:15:17'),
(8, 'SSS', 'DDD', 'ASSS', 1, 1, 'ASSASAS', 1, '3343343', 'dsdsds', 1, 'G6YCLC', NULL, 1, '2020-09-03 16:15:17'),
(9, 'AAA', 'AAA', 'AAA', 1, 1, 'sasasasa', 1, '1212', 'q12121', 1, 'HGD167', NULL, 1, '2020-09-03 16:15:17'),
(10, 'AAA', 'AA', 'AAAAAA', 1, 1, 'asasa', 1, 'sasasa', 'sasasa', 1, '30L99H', NULL, 1, '2020-09-03 16:15:17'),
(11, 'TEst ', 'Kod', '123', 1, 1, 'sasasaa', 1, 'sasasasa', 'sasasa', 1, 'VRM812', NULL, 1, '2020-09-03 16:15:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uloga_id` (`uloga_id`);

--
-- Indexes for table `potkategorija`
--
ALTER TABLE `potkategorija`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prioritet`
--
ALTER TABLE `prioritet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sektor`
--
ALTER TABLE `sektor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specijalizacija`
--
ALTER TABLE `specijalizacija`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zahtjev`
--
ALTER TABLE `zahtjev`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategorija_id` (`kategorija_id`),
  ADD KEY `potkategorija_id` (`potkategorija_id`),
  ADD KEY `prioritet_id` (`prioritet_id`),
  ADD KEY `za_korisnika` (`za_korisnika`),
  ADD KEY `status_id` (`status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorija`
--
ALTER TABLE `kategorija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `potkategorija`
--
ALTER TABLE `potkategorija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prioritet`
--
ALTER TABLE `prioritet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sektor`
--
ALTER TABLE `sektor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `specijalizacija`
--
ALTER TABLE `specijalizacija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `zahtjev`
--
ALTER TABLE `zahtjev`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `korisnik_fk1` FOREIGN KEY (`uloga_id`) REFERENCES `uloga` (`id`);

--
-- Constraints for table `zahtjev`
--
ALTER TABLE `zahtjev`
  ADD CONSTRAINT `zahtjev_fk1` FOREIGN KEY (`kategorija_id`) REFERENCES `kategorija` (`id`),
  ADD CONSTRAINT `zahtjev_fk2` FOREIGN KEY (`potkategorija_id`) REFERENCES `potkategorija` (`id`),
  ADD CONSTRAINT `zahtjev_fk3` FOREIGN KEY (`prioritet_id`) REFERENCES `prioritet` (`id`),
  ADD CONSTRAINT `zahtjev_fk4` FOREIGN KEY (`za_korisnika`) REFERENCES `korisnik` (`id`),
  ADD CONSTRAINT `zahtjev_fk5` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
