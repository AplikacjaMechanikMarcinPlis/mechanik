-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas generowania: 15 Kwi 2016, 20:41
-- Wersja serwera: 5.5.47-0+deb8u1
-- Wersja PHP: 5.6.19-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `mechanik`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `CZESCI`
--

CREATE TABLE IF NOT EXISTS `CZESCI` (
`ID_CZESCI` int(11) NOT NULL,
  `NAZWA` varchar(25) COLLATE utf8_polish_ci NOT NULL,
  `CENA` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `CZESCI`
--

INSERT INTO `CZESCI` (`ID_CZESCI`, `NAZWA`, `CENA`) VALUES
(1, 'Świeca', 100),
(2, 'Olej', 30.99),
(3, 'Zestaw opon', 549.99),
(4, 'Płyn chłodniczy', 99.99);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `KLIENT`
--

CREATE TABLE IF NOT EXISTS `KLIENT` (
`ID_KLIENTA` int(11) NOT NULL,
  `IMIE` varchar(35) COLLATE utf8_polish_ci DEFAULT NULL,
  `NAZWISKO` varchar(35) COLLATE utf8_polish_ci DEFAULT NULL,
  `LOGIN` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `HASLO` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `UPRAWNIENIA` varchar(25) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `KLIENT`
--

INSERT INTO `KLIENT` (`ID_KLIENTA`, `IMIE`, `NAZWISKO`, `LOGIN`, `HASLO`, `UPRAWNIENIA`) VALUES
(1, 'Marcin', 'Plis', 'klient1', '12345', 'klient'),
(2, 'Wojciech', 'Klientowy', 'klient2', '12345', 'klient');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `PRACOWNIK`
--

CREATE TABLE IF NOT EXISTS `PRACOWNIK` (
`ID_PRACOWNIKA` int(11) NOT NULL,
  `IMIE` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `NAZWISKO` varchar(35) COLLATE utf8_polish_ci NOT NULL,
  `LOGIN` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `HASLO` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `UPRAWNIENIA` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `PLACA` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `PRACOWNIK`
--

INSERT INTO `PRACOWNIK` (`ID_PRACOWNIKA`, `IMIE`, `NAZWISKO`, `LOGIN`, `HASLO`, `UPRAWNIENIA`, `PLACA`) VALUES
(1, 'Marcin', 'Mechanikowy', 'mechanik1', '12345', 'mechanik', 9000),
(2, 'Jan', 'Kowalski', 'mechanik2', '12345', 'mechanik', 11200);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `SAMOCHOD`
--

CREATE TABLE IF NOT EXISTS `SAMOCHOD` (
  `NR_REJESTRACYJNY` varchar(11) COLLATE utf8_polish_ci NOT NULL,
  `MARKA` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `MODEL` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `PRZEBIEG` int(11) NOT NULL,
  `ID_KLIENTA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `SAMOCHOD`
--

INSERT INTO `SAMOCHOD` (`NR_REJESTRACYJNY`, `MARKA`, `MODEL`, `PRZEBIEG`, `ID_KLIENTA`) VALUES
('RDE49CP', 'Audi', 'A80', 5874, 1),
('RRS30SW', 'Fiat', '126p', 80000, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `WIZYTA`
--

CREATE TABLE IF NOT EXISTS `WIZYTA` (
`ID_WIZYTY` int(11) NOT NULL,
  `DATA` date DEFAULT NULL,
  `STATUS` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `ID_KLIENTA` int(11) NOT NULL,
  `OPIS` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `CZESCI` int(11) DEFAULT NULL,
  `CENA` float DEFAULT NULL,
  `ID_PRACOWNIKA` int(11) NOT NULL,
  `SAMOCHOD` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `WIZYTA`
--

INSERT INTO `WIZYTA` (`ID_WIZYTY`, `DATA`, `STATUS`, `ID_KLIENTA`, `OPIS`, `CZESCI`, `CENA`, `ID_PRACOWNIKA`, `SAMOCHOD`) VALUES
(2, NULL, 'zgÅ‚oszona', 1, 'UkÅ‚ad hamulcowy.', NULL, NULL, 1, 'RDE49CP'),
(3, '0000-00-00', 'naprawa w toku', 2, 'Tragedia, wszystko siÄ™ sypie w zasadzie.', 3, 6500, 1, 'RRS30SW');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `CZESCI`
--
ALTER TABLE `CZESCI`
 ADD PRIMARY KEY (`ID_CZESCI`);

--
-- Indexes for table `KLIENT`
--
ALTER TABLE `KLIENT`
 ADD PRIMARY KEY (`ID_KLIENTA`);

--
-- Indexes for table `PRACOWNIK`
--
ALTER TABLE `PRACOWNIK`
 ADD PRIMARY KEY (`ID_PRACOWNIKA`);

--
-- Indexes for table `SAMOCHOD`
--
ALTER TABLE `SAMOCHOD`
 ADD PRIMARY KEY (`NR_REJESTRACYJNY`);

--
-- Indexes for table `WIZYTA`
--
ALTER TABLE `WIZYTA`
 ADD PRIMARY KEY (`ID_WIZYTY`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `CZESCI`
--
ALTER TABLE `CZESCI`
MODIFY `ID_CZESCI` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `KLIENT`
--
ALTER TABLE `KLIENT`
MODIFY `ID_KLIENTA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `PRACOWNIK`
--
ALTER TABLE `PRACOWNIK`
MODIFY `ID_PRACOWNIKA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `WIZYTA`
--
ALTER TABLE `WIZYTA`
MODIFY `ID_WIZYTY` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
