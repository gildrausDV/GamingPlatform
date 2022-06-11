
DROP TABLE IF EXISTS 'game';
CREATE TABLE `game` (
  `ID` int(11) NOT NULL,
  `name` text NOT NULL
);

DROP TABLE IF EXISTS 'user';
CREATE TABLE `user` (
  `ID` int(11),
  `username` text NOT NULL,
  'password' text NOT NULL,
  'date' text NOT NULL,
  'role' int(11) NOT NULL,
  'blocked' int(11) NOT NULL,
  'NP' int(11) NOT NULL,
  'name' text NOT NULL,
  'surname' text NOT NULL,
  'email' text NOT NULL,
  'picture' text NOT NULL
);

DROP TABLE IF EXISTS 'playedgame';
CREATE TABLE `playedgame` (
  `ID` int(11),
  `timeplayed` int(11) NOT NULL,
  'points' int(11) NOT NULL,
  'ID_user' int(11) NOT NULL,
  'ID_game' int(11) NOT NULL,
  'maxLevel' int(11) NOT NULL,
  'on_tournament' int(11) NOT NULL
);

DROP TABLE IF EXISTS 'participation';
CREATE TABLE `participation` (
  `ID` int(11) NOT NULL,
  `ID_tournament` int(11) NOT NULL,
  'ID_user' int(11) NOT NULL
);

DROP TABLE IF EXISTS 'tournament';
CREATE TABLE `tournament` (
  `ID` int(11),
  `date` int(11) NOT NULL,
  'timeStart' int(11) NOT NULL,
  'timeEnd' int(11) NOT NULL,
  'maxNumOfPlayers' int(11) NOT NULL,
  'numOfPlayers' int(11) default 0,
  'ID_game' int(11) NOT NULL,
  'ended' int(11) NOT NULL
);

DROP TABLE IF EXISTS 'participation';
CREATE TABLE `participation` (
  `ID` int(11),
  `ID_tournament` int(11) NOT NULL,
  'ID_user' int(11) NOT NULL
);

DROP TABLE IF EXISTS 'level';
CREATE TABLE `level` (
  `ID` int(11),
  `level_desc` TEXT NOT NULL,
  'ID_game' int(11) NOT NULL,
  'lvl' int(11) NOT NULL
);