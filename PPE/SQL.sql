CREATE TABLE IF NOT EXISTS `user` (
  `ID_User` varchar(32) NOT NULL,
  `E_Mail` varchar(128) NOT NULL,
  `Password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `Date_Inscription` date DEFAULT NULL,
  `Type` int(1) NOT NULL DEFAULT '1' COMMENT '1 = Default User, 2 = VIP, 3 = Admin',
  PRIMARY KEY (`ID_User`),
  UNIQUE KEY `E_Mail` (`E_Mail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`ID_User`, `E_Mail`, `Password`, `Date_Inscription`, `Type`) VALUES
('El Barto', 'Freedou@live.fr', 'e71429b169fb38fe425af8a7f5ef9ad3a03866b6', '2015-11-03', 1),
('Freedou', 'freeboy-@hotmail.fr', 'e71429b169fb38fe425af8a7f5ef9ad3a03866b6', '2015-06-18', 3),
('Joffray', 'joffray.billon@gmail.com', 'e71429b169fb38fe425af8a7f5ef9ad3a03866b6', '2015-06-18', 2);