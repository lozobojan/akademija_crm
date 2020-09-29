-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2020 at 08:32 PM
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
  `aktivan` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 PACK_KEYS=0;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `username`, `password`, `uloga_id`, `sektor_id`, `aktivan`) VALUES
(1, 'Bojan', 'Lozo', 'bojan', '827ccb0eea8a706c4c34a16891f84e7b', 1, NULL, 1),
(2, 'Filip', 'Filipovic', 'filip', '827ccb0eea8a706c4c34a16891f84e7b', 2, 1, 1),
(3, 'Marko', 'Markovic', 'marko', '827ccb0eea8a706c4c34a16891f84e7b', 2, 1, 1),
(4, 'Goran', 'Goranovic', 'goran', '52ddd9ff1e957a1e6b15d329d8cefee7', 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik_modul`
--

CREATE TABLE `korisnik_modul` (
  `id` int(11) NOT NULL,
  `korisnik_id` int(11) DEFAULT NULL,
  `modul_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 PACK_KEYS=0;

--
-- Dumping data for table `korisnik_modul`
--

INSERT INTO `korisnik_modul` (`id`, `korisnik_id`, `modul_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(11, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik_specijalizacija`
--

CREATE TABLE `korisnik_specijalizacija` (
  `korisnik_id` int(11) NOT NULL,
  `spec_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 PACK_KEYS=0;

--
-- Dumping data for table `korisnik_specijalizacija`
--

INSERT INTO `korisnik_specijalizacija` (`korisnik_id`, `spec_id`) VALUES
(2, 1),
(3, 1),
(3, 2),
(4, 2),
(4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE `modul` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) DEFAULT NULL,
  `sistemski_naziv` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 PACK_KEYS=0;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id`, `naziv`, `sistemski_naziv`) VALUES
(1, 'Izvjestaj o ucinku operatera', 'izvjestaj_o_ucinku_operatera'),
(2, 'Izvjestaj o potkategorijama', 'izvjestaj_o_potkategorijama'),
(3, 'Zahtjevi za dodjelu', 'zahtjevi_za_dodjelu'),
(4, 'Kontrola pristupa', 'kontrola_pristupa'),
(5, 'Admin. statusa', 'administracija_statusa'),
(6, 'Admin. korisnika', 'administracija_korisnika');

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

--
-- Dumping data for table `sektor`
--

INSERT INTO `sektor` (`id`, `naziv`) VALUES
(1, 'Sektor za podrsku'),
(2, 'Sektor za prijavu kvara');

-- --------------------------------------------------------

--
-- Table structure for table `specijalizacija`
--

CREATE TABLE `specijalizacija` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 PACK_KEYS=0;

--
-- Dumping data for table `specijalizacija`
--

INSERT INTO `specijalizacija` (`id`, `naziv`) VALUES
(1, 'Internet'),
(2, 'Telefonija'),
(3, 'Televizija');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) DEFAULT NULL,
  `obavjestenje` int(11) DEFAULT 0 COMMENT 'da li status povlaci obavjestenje 1/0',
  `obavjestenje_tekst` text DEFAULT NULL,
  `aktivno` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 PACK_KEYS=0;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `naziv`, `obavjestenje`, `obavjestenje_tekst`, `aktivno`) VALUES
(1, 'Nedodijeljen', 0, '', 1),
(2, 'U obradi', 0, '', 1),
(3, 'Zavrsen', 1, '<div style=\"text-align: center;\"><b style=\"font-size: 1rem;\">Vas zahtjev je uspjesno zavrsen.</b></div><div style=\"text-align: left;\"><span style=\"font-size: 1rem;\">test 123</span></div>', 1),
(4, 'Test novi', 1, '<p><u><b>test 123</b></u></p>', 0);

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
  `datum` timestamp NULL DEFAULT current_timestamp(),
  `komentar_operatera` text DEFAULT NULL,
  `promijenio_status` int(11) DEFAULT NULL COMMENT 'id korisnika koji je izvrsio poslednju promjenu statusa',
  `dodao_komentar` int(11) DEFAULT NULL COMMENT 'id korisnika koji je poslednji dodao komentar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 PACK_KEYS=0;

--
-- Dumping data for table `zahtjev`
--

INSERT INTO `zahtjev` (`id`, `ime`, `prezime`, `pretplatnicki_broj`, `kategorija_id`, `potkategorija_id`, `opis`, `prioritet_id`, `telefon`, `mail`, `obavjestenje_saglasnost`, `jedinstveni_kod`, `za_korisnika`, `status_id`, `datum`, `komentar_operatera`, `promijenio_status`, `dodao_komentar`) VALUES
(1, 'Bojan', 'Lozo', 'ASDFRE123', 2, 1, 'NE RADI MI KONEKCIJA!!!', 1, '067363573', 'lozobojan@gmail.com', 1, '786YTH', NULL, 2, '2020-09-03 16:15:17', NULL, 2, NULL),
(2, 'Marko', 'Markovic', 'ASCV12344', 1, 2, 'OPIS TEST ...', 2, '068555147', 'marko123@mail.com', 0, 'F8NO1X', 3, 2, '2020-09-03 16:15:17', NULL, NULL, NULL),
(3, 'Janko', 'Jankovic', 'ASC34456', 1, 2, 'AAAAAAAAAAAA', 1, '067858522', 'markojanko@mail.com', 1, 'W4IDP6', 3, 3, '2020-09-03 16:15:17', 'test promjena', 3, 3),
(4, 'Filip', 'Filipovic', 'ASD123', 1, 1, 'Aasasas Aasasas Aasasas Aasasas Aasasas ', 1, '069852147', 'filip@gmail.com', 1, '5RBRCB', 2, 3, '2020-09-03 16:15:17', 'Test zavrseno 22', 2, 2),
(5, 'Marko', 'Markovic', '123SSS', 1, 2, 'ne radi ...', 1, '06877412', 'asasas@ffff.me', 1, 'MS4XHK', 3, 2, '2020-09-03 16:15:17', NULL, NULL, NULL),
(6, 'Marko', 'Markovic', '123AAA', 1, 1, 'Aaasasasas SASAS', 1, '067885631', 'lll@mail.com', 1, 'U9T5I5', 3, 3, '2020-09-03 16:15:17', 'Popravio sam to i to .... ', 2, 2),
(7, 'AA', 'BB', 'CC', 1, 1, 'AAASSS', 1, '555888', 'sasasas', 1, 'BMDW5G', NULL, 1, '2020-09-03 16:15:17', NULL, NULL, NULL),
(8, 'SSS', 'DDD', 'ASSS', 1, 1, 'ASSASAS', 1, '3343343', 'dsdsds', 1, 'G6YCLC', 2, 2, '2020-09-03 16:15:17', NULL, NULL, NULL),
(9, 'AAA', 'AAA', 'AAA', 1, 1, 'sasasasa', 1, '1212', 'q12121', 1, 'HGD167', 2, 2, '2020-09-03 16:15:17', NULL, NULL, NULL),
(10, 'AAA', 'AA', 'AAAAAA', 1, 1, 'asasa', 1, 'sasasa', 'lozobojan@gmail.com', 1, '30L99H', 2, 3, '2020-09-03 16:15:17', NULL, 2, NULL),
(11, 'TEst ', 'Kod', '123', 1, 1, 'sasasaa', 1, 'sasasasa', 'sasasa', 1, 'VRM812', 2, 3, '2020-09-03 16:15:17', NULL, NULL, NULL);

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
  ADD KEY `uloga_id` (`uloga_id`),
  ADD KEY `sektor_id` (`sektor_id`);

--
-- Indexes for table `korisnik_modul`
--
ALTER TABLE `korisnik_modul`
  ADD PRIMARY KEY (`id`),
  ADD KEY `korisnik_id` (`korisnik_id`),
  ADD KEY `modul_id` (`modul_id`);

--
-- Indexes for table `korisnik_specijalizacija`
--
ALTER TABLE `korisnik_specijalizacija`
  ADD PRIMARY KEY (`korisnik_id`,`spec_id`),
  ADD KEY `korisnik_id` (`korisnik_id`),
  ADD KEY `spec_id` (`spec_id`);

--
-- Indexes for table `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sistemski_naziv` (`sistemski_naziv`);

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
  ADD KEY `status_id` (`status_id`),
  ADD KEY `promijenio_status` (`promijenio_status`),
  ADD KEY `dodao_komentar` (`dodao_komentar`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorija`
--
ALTER TABLE `kategorija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `korisnik_modul`
--
ALTER TABLE `korisnik_modul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `specijalizacija`
--
ALTER TABLE `specijalizacija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  ADD CONSTRAINT `korisnik_fk1` FOREIGN KEY (`uloga_id`) REFERENCES `uloga` (`id`),
  ADD CONSTRAINT `korisnik_fk2` FOREIGN KEY (`sektor_id`) REFERENCES `sektor` (`id`);

--
-- Constraints for table `korisnik_modul`
--
ALTER TABLE `korisnik_modul`
  ADD CONSTRAINT `korisnik_modul_fk1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`id`),
  ADD CONSTRAINT `korisnik_modul_fk2` FOREIGN KEY (`modul_id`) REFERENCES `modul` (`id`);

--
-- Constraints for table `korisnik_specijalizacija`
--
ALTER TABLE `korisnik_specijalizacija`
  ADD CONSTRAINT `korisnik_specijalizacija_fk1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`id`),
  ADD CONSTRAINT `korisnik_specijalizacija_fk2` FOREIGN KEY (`spec_id`) REFERENCES `specijalizacija` (`id`);

--
-- Constraints for table `zahtjev`
--
ALTER TABLE `zahtjev`
  ADD CONSTRAINT `zahtjev_fk1` FOREIGN KEY (`kategorija_id`) REFERENCES `kategorija` (`id`),
  ADD CONSTRAINT `zahtjev_fk2` FOREIGN KEY (`potkategorija_id`) REFERENCES `potkategorija` (`id`),
  ADD CONSTRAINT `zahtjev_fk3` FOREIGN KEY (`prioritet_id`) REFERENCES `prioritet` (`id`),
  ADD CONSTRAINT `zahtjev_fk4` FOREIGN KEY (`za_korisnika`) REFERENCES `korisnik` (`id`),
  ADD CONSTRAINT `zahtjev_fk5` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `zahtjev_fk6` FOREIGN KEY (`promijenio_status`) REFERENCES `korisnik` (`id`),
  ADD CONSTRAINT `zahtjev_fk7` FOREIGN KEY (`dodao_komentar`) REFERENCES `korisnik` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
