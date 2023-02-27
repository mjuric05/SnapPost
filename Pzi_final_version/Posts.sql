SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `Posts` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(250) NOT NULL,
  `ImageUrl` varchar(250) NOT NULL,
  `Description` text NOT NULL,
  `Liked` tinyint(1) NOT NULL DEFAULT '0',
  `Likes` int(11) NOT NULL DEFAULT '0',
  `Bookmarked` tinyint(1) NOT NULL DEFAULT '0',
  `Bookmarks` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7;

INSERT INTO `Posts` (`ID`, `Username`, `ImageUrl`, `Description`, `Liked`, `Likes`, `Bookmarked`, `Bookmarks`) VALUES
(2, '@Mate','http://pzi.fesb.hr/JuricM/Vjezba4/images/thumbnails/kozjak.jpg', 'Kozjak je planina koja sa sjeverne strane okružuje grad Kaštela. Njegova je južna padina vrlo strma i klisurasta, a sjeverni kameniti obronci postupno prelaze u valovitu visoravan Dalmatinske Zagore.', 1, 1, 0, 0),
(3, '@Ivan', 'http://pzi.fesb.hr/JuricM/Vjezba4/images/cetina.jpg', 'Cetina izvire na nadmorskoj visini od 385 m u sjeverozapadnim obroncima Dinare blizu sela Cetina, 7 km sjeverno od Vrlike, a po kojem je rijeka i dobila ime. Izvor Cetine je jezero duboko preko stotinu metara.', 0, 99, 0, 0),
(4, '@Boki',"Tijekom turske invazije 1542., otočić na kojemu se nalazi Primošten je bio zaštićen zidovima i kulama i sa pomičnim mostom koji ga je spajao s kopnom. Kad su se Turci povukli, most je zamijenjen nasipom, a naselje je nazvano Primošten, od riječi primostiti (premostiti).",  1, 4, 10, 0);

