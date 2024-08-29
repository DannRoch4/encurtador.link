
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE IF NOT EXISTS `enclinks` (
  `linkID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `destination` varchar(255) NOT NULL,
  `string` varchar(6) NOT NULL,
  `added` int(11) NOT NULL,
  `ip` int(11) NOT NULL,
  PRIMARY KEY (`linkID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;


INSERT INTO `enclinks` (`linkID`, `destination`, `string`, `added`, `ip`) VALUES
(3, 'google.com', '3', 1315495438, 0),
(2, 'crivion.com', '2', 1315495413, 0),
(4, 'localhost', '4', 1315512736, 0),
(5, 'scriptoggle.com', '5', 1315516395, 0);
