-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2024 at 10:13 AM
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
-- Database: `clearsky`
--

-- --------------------------------------------------------

--
-- Table structure for table `facturen`
--

CREATE TABLE `facturen` (
  `FactuurID` int(11) NOT NULL,
  `KlantID` int(11) DEFAULT NULL,
  `Naam` varchar(55) DEFAULT NULL,
  `Adres` varchar(255) DEFAULT NULL,
  `Postcode` varchar(10) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `Telefoonnummer` varchar(20) NOT NULL,
  `Datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facturen`
--

INSERT INTO `facturen` (`FactuurID`, `KlantID`, `Naam`, `Adres`, `Postcode`, `Email`, `Telefoonnummer`, `Datum`) VALUES
(9, 13, 'Peter Atkinson', 'Magni nisi aspernatu', 'Enim nobis', 'pory@mailinator.com', '+1 (746) 249-7818', '2018-11-16'),
(10, 13, 'Branden Medina', 'Voluptates earum vol', 'Enim aut a', 'lukoreqix@mailinator.com', '+1 (639) 876-2787', '1973-12-21'),
(11, 13, 'Brenda Dean', 'Ut consectetur quae', 'Quo autem ', 'givuxe@mailinator.com', '+1 (157) 464-8798', '2002-01-18'),
(12, 13, 'Ariel Coleman', 'Reprehenderit duis', 'In similiq', 'hevilyciq@mailinator.com', '+1 (634) 689-9723', '2010-04-20'),
(14, 13, 'Lars Dickerson', 'Sit optio ipsa ve', 'Dolore off', 'wohonago@mailinator.com', '+1 (346) 803-5194', '2004-09-21');

-- --------------------------------------------------------

--
-- Table structure for table `factuur_regel`
--

CREATE TABLE `factuur_regel` (
  `Factuurregel_id` int(11) NOT NULL,
  `FactuurID` int(11) DEFAULT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `Amount` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `factuur_regel`
--

INSERT INTO `factuur_regel` (`Factuurregel_id`, `FactuurID`, `ProductID`, `Amount`) VALUES
(6, 9, 2, 3),
(7, 10, 2, 3),
(8, 10, 5, 1),
(9, 10, 1, 2),
(10, 11, 2, 3),
(11, 11, 5, 1),
(12, 11, 1, 2),
(13, 12, 2, 3),
(14, 12, 5, 1),
(15, 12, 1, 2),
(19, 14, 2, 2),
(20, 14, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `klant`
--

CREATE TABLE `klant` (
  `KlantID` int(11) NOT NULL,
  `Naam` varchar(55) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Wachtwoord` varchar(255) DEFAULT NULL,
  `Adres` varchar(255) DEFAULT NULL,
  `Postcode` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klant`
--

INSERT INTO `klant` (`KlantID`, `Naam`, `Email`, `Wachtwoord`, `Adres`, `Postcode`) VALUES
(13, 'Yorrick', 'admin@admin.com', '$2y$10$U290aHRvhgWpjas5D947Ku5kccgncy785brquSfqJh8GmI4Vpg/Pa', 'postbode 23', '2824 GW'),
(14, 'Audrey Galloway', 'negepo@mailinator.com', '$2y$10$LD3qhaNBqMiL5o2tWpyMVuo1oH9rPIGLo/rgCOZbjyVX6pPFW3UCe', 'Eiusmod voluptates d', 'Iste excep'),
(15, 'Sara Obrien', 'vuqytumyta@mailinator.com', '$2y$10$A/kkcvcMOGXXmfTbgyPnde2TJjF1MvrAI0ejWJPCQbi4kCsls2Xuu', 'Et nobis quasi eos a', 'Necessitat'),
(16, 'Destiny Lara', 'suzuhyk@mailinator.com', '$2y$10$BAn4f.fc7liugcN/c4UvJOzMAs2BtWDSH9H0L0CjI2Ql8pGpNhOym', 'Laudantium exceptur', 'Ea et comm'),
(17, 'Ian Mccarty', 'pasezox@mailinator.com', '$2y$10$I5M2AtF6iWGxC/anXbYUEeTwexxhyztnyo09MQfoAkzZ7BVcOGP4K', 'Deserunt nostrum num', 'Magnam iru'),
(18, 'Uta Torres', 'zyboso@mailinator.com', '$2y$10$8vWNRnrQ3JC/GEmJWRm7MuejSYS6PyC1cO9rZOlaEcX8x83vTZg46', 'Nostrum reprehenderi', 'Doloremque'),
(19, 'Ima Pitts', 'sedigy@mailinator.com', '$2y$10$XmMdTtHE.JFxzitqBWGayOiweta/YMGHUYJ9xMAY1Pnppky0wy4eC', 'Sit eveniet explica', 'Itaque mol'),
(20, 'Brennan Kinney', 'kucelezile@mailinator.com', '$2y$10$vKAhAuRnFwsHcqKNyiUfZeFkJ5nLol6m15o12g/IvaQ3/d/z8dTi6', 'Dolor suscipit Nam f', 'FUGIAT QUI');

-- --------------------------------------------------------

--
-- Table structure for table `klantinfo`
--

CREATE TABLE `klantinfo` (
  `id` int(11) NOT NULL,
  `KlantID` int(11) DEFAULT NULL,
  `Admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klantinfo`
--

INSERT INTO `klantinfo` (`id`, `KlantID`, `Admin`) VALUES
(1, 13, 1),
(2, 14, 0),
(3, 15, 0),
(4, 16, 0),
(5, 17, 0),
(6, 18, 0),
(7, 19, 0),
(8, 20, 0);

-- --------------------------------------------------------

--
-- Table structure for table `producten`
--

CREATE TABLE `producten` (
  `ProductID` int(11) NOT NULL,
  `Titel` varchar(55) DEFAULT NULL,
  `Omschrijving` text DEFAULT NULL,
  `Prijs` decimal(10,2) DEFAULT NULL,
  `Voorraad` int(11) DEFAULT NULL,
  `Foto` longblob DEFAULT NULL,
  `Specificaties` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `producten`
--


-- --------------------------------------------------------

--
-- Table structure for table `zonnepanelen`
--

CREATE TABLE `zonnepanelen` (
  `ZonnepaneelID` int(11) NOT NULL,
  `KlantID` int(11) DEFAULT NULL,
  `Stroomvoorziening` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `facturen`
--
ALTER TABLE `facturen`
  ADD PRIMARY KEY (`FactuurID`),
  ADD KEY `KlantID` (`KlantID`);

--
-- Indexes for table `factuur_regel`
--
ALTER TABLE `factuur_regel`
  ADD PRIMARY KEY (`Factuurregel_id`),
  ADD KEY `fk_factuur_regel_facturen` (`FactuurID`),
  ADD KEY `fk_factuur_regel_producten` (`ProductID`);

--
-- Indexes for table `klant`
--
ALTER TABLE `klant`
  ADD PRIMARY KEY (`KlantID`);

--
-- Indexes for table `klantinfo`
--
ALTER TABLE `klantinfo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `KlantID` (`KlantID`);

--
-- Indexes for table `producten`
--
ALTER TABLE `producten`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `zonnepanelen`
--
ALTER TABLE `zonnepanelen`
  ADD PRIMARY KEY (`ZonnepaneelID`),
  ADD KEY `KlantID` (`KlantID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `facturen`
--
ALTER TABLE `facturen`
  MODIFY `FactuurID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `factuur_regel`
--
ALTER TABLE `factuur_regel`
  MODIFY `Factuurregel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `klant`
--
ALTER TABLE `klant`
  MODIFY `KlantID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `klantinfo`
--
ALTER TABLE `klantinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `producten`
--
ALTER TABLE `producten`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `zonnepanelen`
--
ALTER TABLE `zonnepanelen`
  MODIFY `ZonnepaneelID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `facturen`
--
ALTER TABLE `facturen`
  ADD CONSTRAINT `facturen_ibfk_1` FOREIGN KEY (`KlantID`) REFERENCES `klant` (`KlantID`);

--
-- Constraints for table `factuur_regel`
--
ALTER TABLE `factuur_regel`
  ADD CONSTRAINT `fk_factuur_regel_facturen` FOREIGN KEY (`FactuurID`) REFERENCES `facturen` (`FactuurID`),
  ADD CONSTRAINT `fk_factuur_regel_producten` FOREIGN KEY (`ProductID`) REFERENCES `producten` (`ProductID`);

--
-- Constraints for table `klantinfo`
--
ALTER TABLE `klantinfo`
  ADD CONSTRAINT `klantinfo_ibfk_1` FOREIGN KEY (`KlantID`) REFERENCES `klant` (`KlantID`);

--
-- Constraints for table `zonnepanelen`
--
ALTER TABLE `zonnepanelen`
  ADD CONSTRAINT `zonnepanelen_ibfk_1` FOREIGN KEY (`KlantID`) REFERENCES `klant` (`KlantID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
