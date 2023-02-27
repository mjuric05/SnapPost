
CREATE TABLE IF NOT EXISTS `Comments` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(250) NOT NULL,
  `Description` text NOT NULL,
  `PostID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7;

INSERT INTO `Comments` (`ID`, `Username`, `Description`, `PostID`) VALUES
(2, '@Mate', ':)', 2),
(3, '@Filip', 'Asti', 4),
(4, '@Josip', 'Hello', 4) ;
