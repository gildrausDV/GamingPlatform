-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2022 at 11:33 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamingplatform`
--

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `ID` int(11) NOT NULL,
  `Name` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`ID`, `Name`) VALUES
(1, 'Rayman'),
(2, 'FlappyBird');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `ID` int(11) NOT NULL,
  `level_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `ID_game` int(11) NOT NULL,
  `lvl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`ID`, `level_desc`, `ID_game`, `lvl`) VALUES
(1, '{\"rows\":\"5\",\"cols\":\"5\",\"wood\":[{\"y\":\"1\",\"x\":\"1\",\"len\":\"2\"},{\"y\":\"2\",\"x\":\"2\",\"len\":\"2\"},{\"y\":\"3\",\"x\":\"3\",\"len\":\"1\"},{\"y\":\"1\",\"x\":\"0\",\"len\":\"1\"}],\"coins\":[{\"y\":\"1\",\"x\":\"1\"},{\"y\":\"2\",\"x\":\"2\"},{\"y\":\"1\",\"x\":\"0\"}]}', 1, 1),
(2, '{\"rows\":\"7\",\"cols\":\"7\",\"wood\":[{\"y\":\"1\",\"x\":\"1\",\"len\":\"2\"},{\"y\":\"2\",\"x\":\"2\",\"len\":\"2\"},{\"y\":\"3\",\"x\":\"3\",\"len\":\"1\"},{\"y\":\"5\",\"x\":\"1\",\"len\":\"2\"},{\"y\":\"4\",\"x\":\"2\",\"len\":\"2\"},{\"y\":\"1\",\"x\":\"4\",\"len\":\"2\"}],\"coins\":[{\"y\":\"1\",\"x\":\"1\"},{\"y\":\"2\",\"x\":\"2\"},{\"y\":\"1\",\"x\":\"6\"},{\"y\":\"5\",\"x\":\"6\"}]}', 1, 2),
(3, '{\"rows\":\"10\",\"cols\":\"10\",\"wood\":[{\"y\":\"4\",\"x\":\"1\",\"len\":\"2\"},{\"y\":\"5\",\"x\":\"2\",\"len\":\"2\"},{\"y\":\"6\",\"x\":\"4\",\"len\":\"1\"},{\"y\":\"7\",\"x\":\"4\",\"len\":\"2\"},{\"y\":\"8\",\"x\":\"2\",\"len\":\"2\"},{\"y\":\"3\",\"x\":\"3\",\"len\":\"2\"},{\"y\":\"2\",\"x\":\"5\",\"len\":\"2\"}],\"coins\":[{\"y\":\"3\",\"x\":\"1\"},{\"y\":\"5\",\"x\":\"3\"},{\"y\":\"7\",\"x\":\"5\"},{\"y\":\"1\",\"x\":\"7\"},{\"y\":\"4\",\"x\":\"8\"}]}', 1, 3),
(5, '{\"rows\":\"5\",\"cols\":\"10\",\"wood\":[{\"y\":\"1\",\"direction\":\"down\"},{\"y\":\"3\",\"direction\":\"up\"},{\"y\":\"4\",\"direction\":\"down\"},{\"y\":\"7\",\"direction\":\"down\"},{\"y\":\"9\",\"direction\":\"up\"}],\"coins\":[{\"y\":\"1\",\"x\":\"1\"},{\"y\":\"2\",\"x\":\"4\"},{\"y\":\"4\",\"x\":\"7\"},{\"y\":\"4\",\"x\":\"9\"}]}', 2, 1),
(6, '{\"rows\":\"5\",\"cols\":\"10\",\"wood\":[{\"y\":\"1\",\"direction\":\"down\"},{\"y\":\"3\",\"direction\":\"up\"},{\"y\":\"4\",\"direction\":\"down\"}],\"coins\":[{\"y\":\"1\",\"x\":\"1\"},{\"y\":\"3\",\"x\":\"9\"}]}', 2, 2),
(7, '{\"rows\":\"5\",\"cols\":\"10\",\"wood\":[{\"y\":\"3\",\"x\":\"1\",\"len\":\"2\"},{\"y\":\"2\",\"x\":\"3\",\"len\":\"2\"},{\"y\":\"2\",\"x\":\"6\",\"len\":\"2\"}],\"coins\":[{\"y\":\"1\",\"x\":\"5\"},{\"y\":\"1\",\"x\":\"8\"},{\"y\":\"3\",\"x\":\"3\"}]}', 1, 4),
(8, '{\"rows\":\"5\",\"cols\":\"15\",\"wood\":[{\"y\":\"1\",\"direction\":\"down\"},{\"y\":\"3\",\"direction\":\"up\"},{\"y\":\"4\",\"direction\":\"down\"},{\"y\":\"9\",\"direction\":\"down\"},{\"y\":\"12\",\"direction\":\"up\"},{\"y\":\"14\",\"direction\":\"down\"}],\"coins\":[{\"y\":\"1\",\"x\":\"1\"},{\"y\":\"1\",\"x\":\"4\"},{\"y\":\"3\",\"x\":\"8\"},{\"y\":\"1\",\"x\":\"9\"},{\"y\":\"4\",\"x\":\"14\"}]}', 2, 3),
(9, '{\"rows\":\"5\",\"cols\":\"10\",\"wood\":[{\"y\":\"1\",\"x\":\"1\",\"len\":\"3\"},{\"y\":\"2\",\"x\":\"4\",\"len\":\"3\"},{\"y\":\"1\",\"x\":\"7\",\"len\":\"2\"},{\"y\":\"3\",\"x\":\"7\",\"len\":\"3\"}],\"coins\":[{\"y\":\"0\",\"x\":\"0\"},{\"y\":\"3\",\"x\":\"2\"},{\"y\":\"2\",\"x\":\"4\"},{\"y\":\"1\",\"x\":\"8\"},{\"y\":\"3\",\"x\":\"9\"}]}', 1, 5),
(10, '{\"rows\":\"5\",\"cols\":\"12\",\"wood\":[{\"y\":\"1\",\"direction\":\"down\"},{\"y\":\"3\",\"direction\":\"up\"},{\"y\":\"4\",\"direction\":\"down\"},{\"y\":\"7\",\"direction\":\"down\"},{\"y\":\"10\",\"direction\":\"up\"},{\"y\":\"11\",\"direction\":\"down\"}],\"coins\":[{\"y\":\"1\",\"x\":\"1\"},{\"y\":\"3\",\"x\":\"4\"},{\"y\":\"4\",\"x\":\"6\"},{\"y\":\"3\",\"x\":\"8\"},{\"y\":\"1\",\"x\":\"11\"}]}', 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `participation`
--

CREATE TABLE `participation` (
  `ID` int(11) NOT NULL,
  `ID_tournament` int(11) NOT NULL,
  `ID_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `participation`
--

INSERT INTO `participation` (`ID`, `ID_tournament`, `ID_user`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 2, 2),
(5, 3, 1),
(6, 3, 2),
(7, 4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `playedgame`
--

CREATE TABLE `playedgame` (
  `ID` int(11) NOT NULL,
  `timePlayed` int(11) DEFAULT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  `ID_user` int(11) NOT NULL,
  `ID_game` int(11) NOT NULL,
  `maxLevel` int(11) NOT NULL,
  `on_tournament` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `playedgame`
--

INSERT INTO `playedgame` (`ID`, `timePlayed`, `points`, `ID_user`, `ID_game`, `maxLevel`, `on_tournament`) VALUES
(1, 5, 15, 1, 1, 1, 0),
(2, 4, 15, 1, 1, 1, 0),
(3, 3, 15, 1, 1, 1, 0),
(4, 3, 15, 1, 1, 1, 0),
(5, 3, 15, 1, 1, 1, 0),
(6, 0, 0, 1, 2, 1, 0),
(7, 4, 15, 1, 1, 1, 1),
(8, 4, 15, 2, 1, 1, 1),
(9, 18, 30, 1, 1, 1, 0),
(10, 23, 60, 1, 1, 3, 0),
(11, 0, 0, 1, 2, 1, 0),
(12, 6, 20, 1, 2, 2, 0),
(13, 7, 30, 1, 2, 3, 0),
(14, 4, 20, 1, 2, 2, 0),
(15, 19, 75, 1, 1, 4, 0),
(16, 6, 25, 1, 2, 2, 0),
(17, 24, 55, 1, 1, 2, 0),
(18, 18, 75, 1, 1, 4, 0),
(19, 7, 30, 1, 2, 3, 0),
(20, 13, 55, 1, 2, 4, 0),
(21, 11, 50, 1, 2, 3, 0),
(22, 15, 5, 1, 1, 0, 0),
(23, 22, 75, 1, 1, 4, 2),
(24, 28, 75, 2, 1, 4, 2),
(25, 23, 75, 2, 1, 4, 2),
(26, 0, 0, 2, 2, 1, 0),
(27, 12, 55, 2, 2, 4, 0),
(28, 27, 100, 1, 1, 5, 2),
(29, 20, 80, 1, 2, 5, 0),
(30, 27, 100, 2, 1, 5, 2),
(31, 9, 35, 2, 2, 3, 0),
(32, 18, 70, 1, 2, 4, 3),
(33, 20, 80, 2, 2, 5, 3),
(34, 3, 15, 2, 2, 1, 3),
(35, 18, 75, 1, 2, 4, 3),
(36, 16, 65, 3, 2, 4, 0),
(37, 27, 100, 3, 1, 5, 0),
(38, 22, 80, 3, 2, 5, 0),
(39, 17, 15, 6, 1, 1, 0),
(40, 2, 5, 6, 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tournament`
--

CREATE TABLE `tournament` (
  `ID` int(11) NOT NULL,
  `date` date NOT NULL,
  `timeStart` time NOT NULL,
  `timeEnd` time NOT NULL,
  `maxNumOfPlayers` int(11) NOT NULL,
  `numOfPlayers` int(11) NOT NULL,
  `ID_game` int(11) NOT NULL,
  `ended` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tournament`
--

INSERT INTO `tournament` (`ID`, `date`, `timeStart`, `timeEnd`, `maxNumOfPlayers`, `numOfPlayers`, `ID_game`, `ended`) VALUES
(1, '2022-06-01', '19:00:00', '20:00:00', 10, 2, 1, 1),
(2, '2022-06-02', '17:00:00', '18:00:00', 2, 2, 1, 1),
(3, '2022-06-02', '18:00:00', '18:10:00', 10, 2, 2, 0),
(4, '2023-06-02', '17:00:00', '18:00:00', 10, 0, 1, 1),
(5, '2023-06-02', '17:00:00', '18:00:00', 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `role` int(11) NOT NULL,
  `blocked` tinyint(1) NOT NULL,
  `NP` int(11) NOT NULL DEFAULT 0,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `email` varchar(45) NOT NULL,
  `picture` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `username`, `password`, `date`, `role`, `blocked`, `NP`, `name`, `surname`, `email`, `picture`) VALUES
(1, 'admin', '123123', '2022-06-01', 2, 0, 8, 'admin', 'admin', 'admin@gmail.com', '/images/kirby.jpg'),
(2, 'lily', '12345', '2001-01-12', 1, 0, 47, 'Nikola', 'Vujcic', 'nikola.vujcic.001@gmail.com', '/images/kirby.jpg'),
(3, 'gildraus', '123123', '2022-06-02', 1, 1, 0, 'Dimitrije', 'Vujcic', 'vujcic.dimitrije@gmail.com', '/usersImages/guest.png'),
(4, 'niki', '123123', '2022-06-07', 0, 0, 0, 'ime', 'prezime', 'mejl@gmail.com', '/usersImages/guest.png'),
(5, 'pera', '123123', '2003-02-12', 1, 0, 0, 'Petar', 'Petrovic', 'petar@gmail.com', '/usersImages/guest.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `playedgame`
--
ALTER TABLE `playedgame`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tournament`
--
ALTER TABLE `tournament`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `participation`
--
ALTER TABLE `participation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `playedgame`
--
ALTER TABLE `playedgame`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tournament`
--
ALTER TABLE `tournament`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
