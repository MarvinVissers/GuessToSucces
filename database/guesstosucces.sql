-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2020 at 10:54 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guesstosucces`
--
CREATE DATABASE IF NOT EXISTS `guesstosucces` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `guesstosucces`;

-- --------------------------------------------------------

--
-- Table structure for table `achievement`
--

CREATE TABLE `achievement` (
  `ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `rewaredAt` int(11) NOT NULL DEFAULT '1',
  `picture` varchar(100) NOT NULL,
  `points` int(11) NOT NULL,
  `visibility` enum('Visible','Hidden') NOT NULL DEFAULT 'Visible'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `achievement`
--

INSERT INTO `achievement` (`ID`, `name`, `description`, `rewaredAt`, `picture`, `points`, `visibility`) VALUES
(35, 'Lucky guess', 'You guessed right for the 1st time!', 1, 'lucky-guess1.png', 100, 'Visible'),
(36, '25 wins', 'You guessed right for your 25th time!', 25, 'lucky-guess25.png', 250, 'Visible'),
(37, '50 wins', 'You guessed right for your 50th time!', 50, 'lucky-guess50.png', 500, 'Visible'),
(38, '100 wins', 'You guessed right for the 100th time!', 100, 'lucky-guess100.png', 1000, 'Visible'),
(39, '250 wins', 'You guessed right for the 250th time!', 250, 'lucky-guess250.png', 2500, 'Visible'),
(40, '500 wins', 'You guessed right for the 500th time!', 500, 'lucky-guess500.png', 5000, 'Visible'),
(41, '1000 wins', 'You guessed right for the 1000th time!', 1000, 'lucky-guess1000.png', 10000, 'Visible'),
(42, 'First points', 'You have earned more than 2.500 points!', 2500, 'points2500.png', 250, 'Visible'),
(43, 'Big saver', 'You have earned more than 10.000 points!', 10000, 'points10000.png', 1000, 'Visible'),
(44, 'Wolf of Wallstreet', 'You have earned more than 100.000 points!', 100000, 'points100000.png', 10000, 'Visible'),
(45, 'Grand bet winnar', 'You have guessed your 1st Grand Prix winnar right!', 1, 'gp-winnar1.png', 100, 'Visible'),
(46, '5 Grand bets driver winnar', 'You have guessed your 5th Grand Prix winnar right!', 5, 'gp-winnar5.png', 500, 'Visible'),
(47, '10 Grand bets driver winnar', 'You have guessed your 10th Grand Prix winnar right!', 10, 'gp-winnar10.png', 1000, 'Visible'),
(48, '25 Grand bets winnar', 'You have guessed your 25th Grand Prix winnar right!', 25, 'gp-winnar25.png', 2500, 'Visible'),
(49, '50 Grand bets winnar', 'You have guessed your 50th Grand Prix winnar right!', 50, 'gp-winnar50.png', 5000, 'Visible'),
(50, '100 Grand bets winnar', 'You have guessed your 100th Grand Prix winnar right!', 100, 'gp-winnar100.png', 10000, 'Visible'),
(51, 'Grand constructor bets winnar', 'You have guessed your 1st Grand Prix Constructor winnar right!', 1, 'gp-constructor-winnar1.png', 100, 'Visible'),
(52, '5 Grand constructor bets winnar', 'You have guessed your 5th Grand Prix Constructor winnar right!', 5, 'gp-constructor-winnar5.png', 500, 'Visible'),
(53, '10 Grand constructor bets winnar', 'You have guessed your 10th Grand Prix Constructor winnar right!', 10, 'gp-constructor-winnar10.png', 1000, 'Visible'),
(54, '25 Grand constructor bets winnar', 'You have guessed your 25th Grand Prix Constructor winnar right!', 25, 'gp-constructor-winnar25.png', 2500, 'Visible'),
(55, '50 Grand constructor bets winnar', 'You have guessed your 50th Grand Prix Constructor winnar right!', 50, 'gp-constructor-winnar50.png', 5000, 'Visible'),
(56, '100 Grand constructor bets winnar', 'You have guessed your 100th Grand Prix Constructor winnar right!', 100, 'gp-constructor-winnar100.png', 10000, 'Visible'),
(57, '1 fastest driver bets winnar', 'You have guessed your 1st Grand Prix fastest lap driver right!', 1, 'fastest-lap-driver1.png', 100, 'Visible'),
(58, '5 fastest driver bets winnar', 'You have guessed your 5th Grand Prix fastest lap driver right!', 5, 'fastest-lap-driver5.png', 500, 'Visible'),
(59, '10 fastest driver bets winnar', 'You have guessed your 10th Grand Prix fastest lap driver right!', 10, 'fastest-lap-driver10.png', 1000, 'Visible'),
(60, '25 fastest driver bets winnar', 'You have guessed your 25th Grand Prix fastest lap driver right!', 25, 'fastest-lap-driver25.png', 2500, 'Visible'),
(61, '50 fastest driver bets winnar', 'You have guessed your 50th Grand Prix fastest lap driver right!', 50, 'fastest-lap-driver50.png', 5000, 'Visible'),
(62, '100 fastest driver bets winnar', 'You have guessed your 100th Grand Prix fastest lap driver right!', 100, 'fastest-lap-driver100.png', 10000, 'Visible'),
(63, '1 fastest constructor bets winnar', 'You have guessed your 1st Grand Prix fastest lap constructor right!', 1, 'fastest-lap-constructor1.png', 100, 'Visible'),
(64, '5 fastest constructor bets winnar', 'You have guessed your 5th Grand Prix fastest lap constructor right!', 5, 'fastest-lap-constructor5.png', 500, 'Visible'),
(65, '10 fastest constructor bets winnar', 'You have guessed your 10th Grand Prix fastest lap constructor right!', 10, 'fastest-lap-constructor10.png', 1000, 'Visible'),
(66, '25 fastest constructor bets winnar', 'You have guessed your 25th Grand Prix fastest lap constructor right!', 25, 'fastest-lap-constructor25.png', 2500, 'Visible'),
(67, '50 fastest constructor bets winnar', 'You have guessed your 50th Grand Prix fastest lap constructor right!', 50, 'fastest-lap-constructor50.png', 5000, 'Visible'),
(68, '100 fastest constructor bets winnar', 'You have guessed your 100th Grand Prix fastest lap constructor right!', 100, 'fastest-lap-constructor100.png', 100, 'Visible'),
(69, 'Did Not Finish', 'You aren\'t done yet, you just retired for one race! Get back in their with this achievement!', 1, 'bankrupt.png', 1000, 'Hidden');

-- --------------------------------------------------------

--
-- Table structure for table `bet`
--

CREATE TABLE `bet` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `season` int(4) NOT NULL,
  `grandPrix` varchar(255) NOT NULL,
  `categorieID` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `betOn` varchar(255) NOT NULL,
  `odds` double NOT NULL,
  `status` enum('Open','Won','Losed') DEFAULT 'Open',
  `rewardPayed` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bet`
--

INSERT INTO `bet` (`ID`, `userID`, `season`, `grandPrix`, `categorieID`, `points`, `betOn`, `odds`, `status`, `rewardPayed`) VALUES
(5, 1, 2020, 'hungaroring', 1, 500, 'bottas', 6.35, 'Open', NULL),
(7, 1, 2019, 'silverstone', 4, 500, 'mclaren', 8.98, 'Open', NULL),
(8, 1, 2019, 'red_bull_ring', 2, 250, 'williams', 25.89, 'Losed', NULL),
(9, 1, 2019, 'monza', 3, 1500, 'vettel', 4.35, 'Losed', NULL),
(10, 1, 2019, 'monza', 1, 500, 'hamilton', 2.35, 'Losed', NULL),
(11, 1, 2019, 'monza', 2, 1000, 'ferrari', 5.53, 'Won', '1');

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `ID` int(11) NOT NULL,
  `categorie` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`ID`, `categorie`) VALUES
(4, 'Constructor fastest lap'),
(2, 'Constructor winnar'),
(3, 'Driver fastest lap'),
(1, 'Driver winner');

-- --------------------------------------------------------

--
-- Table structure for table `passwordreset`
--

CREATE TABLE `passwordreset` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `selector` varchar(255) NOT NULL,
  `token` longtext NOT NULL,
  `linkExpires` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `points` int(11) NOT NULL DEFAULT '1000'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_achievement`
--

CREATE TABLE `user_achievement` (
  `userID` int(11) NOT NULL,
  `achievementID` int(11) NOT NULL,
  `achievementProgress` int(4) DEFAULT '0',
  `receivedAt` timestamp NULL DEFAULT NULL,
  `seen` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievement`
--
ALTER TABLE `achievement`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `picture` (`picture`);

--
-- Indexes for table `bet`
--
ALTER TABLE `bet`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `betCategorie` (`categorieID`);

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `categorie` (`categorie`);

--
-- Indexes for table `passwordreset`
--
ALTER TABLE `passwordreset`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userPassword` (`userID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_achievement`
--
ALTER TABLE `user_achievement`
  ADD PRIMARY KEY (`userID`,`achievementID`),
  ADD KEY `uaAchievement` (`achievementID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievement`
--
ALTER TABLE `achievement`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `bet`
--
ALTER TABLE `bet`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `passwordreset`
--
ALTER TABLE `passwordreset`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bet`
--
ALTER TABLE `bet`
  ADD CONSTRAINT `betCategorie` FOREIGN KEY (`categorieID`) REFERENCES `categorie` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `passwordreset`
--
ALTER TABLE `passwordreset`
  ADD CONSTRAINT `userPassword` FOREIGN KEY (`userID`) REFERENCES `user` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `user_achievement`
--
ALTER TABLE `user_achievement`
  ADD CONSTRAINT `uaAchievement` FOREIGN KEY (`achievementID`) REFERENCES `achievement` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `uaUser` FOREIGN KEY (`userID`) REFERENCES `user` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
