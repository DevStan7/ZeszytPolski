-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2026 at 05:42 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zeszytpolski`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `epoki`
--

CREATE TABLE `epoki` (
  `id_epoka` int(11) NOT NULL,
  `nazwa` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `epoki`
--

INSERT INTO `epoki` (`id_epoka`, `nazwa`) VALUES
(1, 'Antyk'),
(2, 'Średniowiecze'),
(3, 'Renesans'),
(4, 'Barok'),
(5, 'Oświecenie'),
(6, 'Romantyzm'),
(7, 'Pozytywizm'),
(8, 'Młoda Polska'),
(9, 'Dwudziestolecie międzywojenne'),
(10, 'Literatura współczesna'),
(11, 'Notatka z lektury'),
(12, 'Notatka z wiersza'),
(13, 'Notatka z fragmentu tekstu'),
(14, 'Lektura obowiązkowa'),
(15, 'Lektura uzupełniająca'),
(16, 'Tekst obowiązkowy'),
(17, 'Tekst dodatkowy'),
(18, 'Analiza utworu'),
(19, 'Interpretacja utworu'),
(20, 'Charakterystyka bohatera'),
(21, 'Motyw literacki'),
(22, 'Kontekst historycznoliteracki'),
(23, 'Środki stylistyczne'),
(24, 'Plan wydarzeń'),
(25, 'Streszczenie'),
(26, 'Cytaty'),
(27, 'Opracowanie problemu'),
(28, 'Notatka ogólna'),
(29, 'Antyk'),
(30, 'Średniowiecze'),
(31, 'Renesans'),
(32, 'Barok'),
(33, 'Oświecenie'),
(34, 'Romantyzm'),
(35, 'Pozytywizm'),
(36, 'Młoda Polska'),
(37, 'Dwudziestolecie międzywojenne'),
(38, 'Literatura współczesna');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `id_kategoria` int(11) NOT NULL,
  `nazwa` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategorie`
--

INSERT INTO `kategorie` (`id_kategoria`, `nazwa`) VALUES
(1, 'Notatka z lektury'),
(2, 'Notatka z wiersza'),
(3, 'Notatka z fragmentu tekstu'),
(4, 'Lektura obowiązkowa'),
(5, 'Lektura uzupełniająca'),
(6, 'Tekst obowiązkowy'),
(7, 'Tekst dodatkowy'),
(8, 'Analiza utworu'),
(9, 'Interpretacja utworu'),
(10, 'Charakterystyka bohatera'),
(11, 'Motyw literacki'),
(12, 'Kontekst historycznoliteracki'),
(13, 'Środki stylistyczne'),
(14, 'Plan wydarzeń'),
(15, 'Streszczenie'),
(16, 'Cytaty'),
(17, 'Opracowanie problemu'),
(18, 'Notatka ogólna');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klasy`
--

CREATE TABLE `klasy` (
  `id_klasa` int(11) NOT NULL,
  `nazwa` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klasy`
--

INSERT INTO `klasy` (`id_klasa`, `nazwa`) VALUES
(1, 'Pierwsza'),
(2, 'Druga'),
(3, 'Trzecia');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `notatka`
--

CREATE TABLE `notatka` (
  `id_notatki` int(11) NOT NULL,
  `nazwa` varchar(50) DEFAULT NULL,
  `tresc` longtext DEFAULT NULL,
  `id_kategoria` int(11) DEFAULT NULL,
  `id_klasa` int(11) DEFAULT NULL,
  `id_epoka` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id_uzytkownik` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `haslo` varchar(100) NOT NULL,
  `czyAdmin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id_uzytkownik`, `login`, `haslo`, `czyAdmin`) VALUES
(1, 'user1', 'haslo1', 1),
(2, 'user2', 'haslo2', 0);

--
-- Dumping data for table `notatka`
--

INSERT INTO `notatka` (`id_notatki`, `nazwa`, `tresc`, `id_kategoria`, `id_klasa`, `id_epoka`) VALUES
(1, 'Motyw heroizmu w Antyku', 'Omówienie postawy bohatera tragicznego na przykładzie mitologii greckiej.', 9, 1, 1),
(2, 'Średniowieczny wzorzec rycerza', 'Opis cech idealnego rycerza na podstawie Pieśni o Rolandzie.', 8, 2, 2),
(3, 'Humanizm w Renesansie', 'Renesansowe spojrzenie na człowieka i jego miejsce w świecie.', 7, 2, 3),
(4, 'Konceptyzm w Baroku', 'Charakterystyka środków stylistycznych typowych dla baroku.', 13, 3, 4),
(5, 'Racjonalizm Oświecenia', 'Znaczenie nauki i rozumu w literaturze oświecenia.', 12, 2, 5),
(6, 'Bunt romantyczny', 'Postawa buntownika w literaturze romantycznej.', 9, 3, 6),
(7, 'Praca u podstaw', 'Założenia pozytywizmu i ich realizacja w literaturze.', 12, 2, 7),
(8, 'Symbolizm Młodej Polski', 'Zastosowanie symboli w poezji modernistycznej.', 13, 3, 8),
(9, 'Awangarda międzywojenna', 'Nowatorskie podejście do sztuki w dwudziestoleciu międzywojennym.', 11, 3, 9),
(10, 'Literatura współczesna a tożsamość', 'Problematyka tożsamości w literaturze współczesnej.', 12, 2, 10),
(11, 'Tragizm bohatera antycznego', 'Analiza tragizmu na przykładzie wybranego mitu.', 10, 1, 1),
(12, 'Ascetyzm w średniowieczu', 'Wzorzec świętego ascety w literaturze hagiograficznej.', 9, 2, 2),
(13, 'Pieśni renesansowe', 'Charakterystyka pieśni jako gatunku literackiego.', 2, 1, 3),
(14, 'Vanitas w Baroku', 'Motyw przemijania w poezji barokowej.', 9, 3, 4),
(15, 'Satyra oświeceniowa', 'Rola satyry w krytyce społeczeństwa.', 2, 2, 5),
(16, 'Mesjanizm romantyczny', 'Idea narodu jako mesjasza w literaturze romantycznej.', 12, 3, 6),
(17, 'Realizm pozytywizmu', 'Opis rzeczywistości społecznej w powieściach realistycznych.', 8, 2, 7),
(18, 'Dekadentyzm Młodej Polski', 'Postawa dekadencka i jej przejawy w literaturze.', 9, 3, 8),
(19, 'Katastrofizm międzywojenny', 'Wizje zagłady w literaturze XX wieku.', 9, 1, 9),
(20, 'Motyw samotności we współczesności', 'Obraz samotności w literaturze XXI wieku.', 9, 2, 10);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `epoki`
--
ALTER TABLE `epoki`
  ADD PRIMARY KEY (`id_epoka`);

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id_kategoria`);

--
-- Indeksy dla tabeli `klasy`
--
ALTER TABLE `klasy`
  ADD PRIMARY KEY (`id_klasa`);

--
-- Indeksy dla tabeli `notatka`
--
ALTER TABLE `notatka`
  ADD PRIMARY KEY (`id_notatki`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id_uzytkownik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `epoki`
--
ALTER TABLE `epoki`
  MODIFY `id_epoka` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id_kategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `klasy`
--
ALTER TABLE `klasy`
  MODIFY `id_klasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notatka`
--
ALTER TABLE `notatka`
  MODIFY `id_notatki` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id_uzytkownik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
