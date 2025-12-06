CREATE DATABASE IF NOT EXISTS sessiondb;
USE sessiondb;

CREATE TABLE IF NOT EXISTS `users` (
  `uname` varchar(20) NOT NULL,
  `pass` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`uname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`uname`, `pass`) VALUES
('a', '1234'),
('b', '1234');