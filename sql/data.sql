-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Client: localhost:3306
-- Généré le: Jeu 17 Mars 2016 à 20:05
-- Version du serveur: 5.5.44-MariaDB-cll-lve
-- Version de PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `mobilelo_share`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adminName` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `adminPass` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `ratio` int(3) NOT NULL,
  `vcName` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `proxstop` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `proxWall` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `score` int(1) NOT NULL,
  `proxstopAPI` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stop2ip` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `lockOffers` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `lockWalls` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `passOffers` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `board` text COLLATE utf8_unicode_ci NOT NULL,
  `showStats` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `IPQC` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `IPQCKey` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`id`, `adminName`, `adminPass`, `ratio`, `vcName`, `proxstop`, `proxWall`, `score`, `proxstopAPI`, `stop2ip`, `lockOffers`, `lockWalls`, `passOffers`, `board`, `showStats`, `IPQC`, `IPQCKey`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 10, 'Points', 'OFF', 'OFF', 4, '', 'OFF', 'OFF', 'OFF', '', 'Hello GemGPT', 'ON', 'OFF', '');

-- --------------------------------------------------------

--
-- Structure de la table `ads`
--

CREATE TABLE IF NOT EXISTS `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topUrl` text COLLATE utf8_unicode_ci NOT NULL,
  `topImageUrl` text COLLATE utf8_unicode_ci NOT NULL,
  `bottomUrl` text COLLATE utf8_unicode_ci NOT NULL,
  `bottomImageUrl` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `ads`
--

INSERT INTO `ads` (`id`, `topUrl`, `topImageUrl`, `bottomUrl`, `bottomImageUrl`) VALUES
(1, 'Url', 'Image Url ( 468x60 px )', '#', '#');

-- --------------------------------------------------------

--
-- Structure de la table `clicks`
--

CREATE TABLE IF NOT EXISTS `clicks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `offerId` int(11) NOT NULL,
  `offerIdOffer` int(11) NOT NULL,
  `offerName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `offerCC` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `offerNwk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `points` int(5) NOT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `port` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `protocol` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hostName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userAgent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userName` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `trackingID` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cc` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=247 ;

--
-- Contenu de la table `countries`
--

INSERT INTO `countries` (`id`, `name`, `cc`) VALUES
(14, 'Argentina', 'AR'),
(16, 'Austria', 'AT'),
(17, 'Australia', 'AU'),
(24, 'Belgium', 'BE'),
(26, 'Bulgaria', 'BG'),
(33, 'Bolivia', 'BO'),
(35, 'Brazil', 'BR'),
(42, 'Canada', 'CA'),
(47, 'Switzerland', 'CH'),
(50, 'Chile', 'CL'),
(52, 'China', 'CN'),
(60, 'Czech Republic', 'CZ'),
(61, 'Germany', 'DE'),
(63, 'Denmark', 'DK'),
(72, 'Spain', 'ES'),
(80, 'France', 'FR'),
(82, 'United Kingdom', 'GB'),
(100, 'Hong Kong', 'HK'),
(103, 'Croatia', 'HR'),
(105, 'Hungary', 'HU'),
(106, 'Indonesia', 'ID'),
(107, 'Ireland', 'IE'),
(108, 'Israel', 'IL'),
(110, 'India', 'IN'),
(115, 'Italy', 'IT'),
(119, 'Japan', 'JP'),
(162, 'Mexico', 'MX'),
(171, 'Netherlands', 'NL'),
(172, 'Norway', 'NO'),
(176, 'New Zealand', 'NZ'),
(184, 'Poland', 'PL'),
(189, 'Portugal', 'PT'),
(191, 'Paraguay', 'PY'),
(196, 'Russian Federation', 'RU'),
(202, 'Sweden', 'SE'),
(203, 'Singapore', 'SG'),
(205, 'Slovenia', 'SI'),
(207, 'Slovakia', 'SK'),
(223, 'Thailand', 'TH'),
(230, 'Turkey', 'TR'),
(233, 'Taiwan', 'TW'),
(235, 'Ukraine', 'UA'),
(238, 'United States', 'US'),
(246, 'Vietnam', 'VN');

-- --------------------------------------------------------

--
-- Structure de la table `leads`
--

CREATE TABLE IF NOT EXISTS `leads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `offerId` int(11) NOT NULL,
  `offerIdOffer` int(11) NOT NULL,
  `offerName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `offerCC` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `offerNwk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `points` int(5) NOT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `port` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `protocol` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hostName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userAgent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userName` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `userPassword` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `points` int(5) NOT NULL,
  `leadedOffers` int(2) NOT NULL,
  `referralId` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `port` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `requester` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `members`
--

INSERT INTO `members` (`id`, `userName`, `userPassword`, `email`, `points`, `leadedOffers`, `referralId`, `ip`, `port`, `date`, `requester`, `status`) VALUES
(3, 'paypal123', '123456', 'paypal123@mail.com', 0, 0, '', '115.76.106.24', '46699', '2016-03-18 01:42:52', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `networks`
--

CREATE TABLE IF NOT EXISTS `networks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `networks`
--

INSERT INTO `networks` (`id`, `name`, `ip`, `status`) VALUES
(1, 'CPAGrip', '', 'ON');

-- --------------------------------------------------------

--
-- Structure de la table `offers`
--

CREATE TABLE IF NOT EXISTS `offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `offerId` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payout` float NOT NULL,
  `ratio` int(3) NOT NULL,
  `imageUrl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `des` text COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `network` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Structure de la table `requesters`
--

CREATE TABLE IF NOT EXISTS `requesters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `yahoo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `banks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `rewards`
--

CREATE TABLE IF NOT EXISTS `rewards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amounts` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Contenu de la table `rewards`
--

INSERT INTO `rewards` (`id`, `type`, `amounts`) VALUES
(1, 'Paypal', 2),
(2, 'Paypal', 5),
(3, 'Payza', 10),
(4, 'Liberty Reserve', 5),
(5, 'WebMoney', 10),
(6, 'Ukash', 20),
(7, 'Amazon', 50),
(8, 'Amazon', 10),
(9, 'Liberty Reserve', 10),
(10, 'Liberty Reserve', 2);

-- --------------------------------------------------------

--
-- Structure de la table `shoutbox`
--

CREATE TABLE IF NOT EXISTS `shoutbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `offerName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `offerNwk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `points` int(5) NOT NULL,
  `date` datetime NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `shoutbox`
--

INSERT INTO `shoutbox` (`id`, `userName`, `offerName`, `offerNwk`, `points`, `date`, `message`) VALUES
(5, 'paypal123', '', '', 0, '2016-03-18 01:42:52', '');

-- --------------------------------------------------------

--
-- Structure de la table `template`
--

CREATE TABLE IF NOT EXISTS `template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `des` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bgColor` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `logo` text COLLATE utf8_unicode_ci NOT NULL,
  `heading2` text COLLATE utf8_unicode_ci NOT NULL,
  `heading3` text COLLATE utf8_unicode_ci NOT NULL,
  `heading4` text COLLATE utf8_unicode_ci NOT NULL,
  `paragraph` text COLLATE utf8_unicode_ci NOT NULL,
  `f1` text COLLATE utf8_unicode_ci NOT NULL,
  `f2` text COLLATE utf8_unicode_ci NOT NULL,
  `f3` text COLLATE utf8_unicode_ci NOT NULL,
  `f4` text COLLATE utf8_unicode_ci NOT NULL,
  `f5` text COLLATE utf8_unicode_ci NOT NULL,
  `f6` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `template`
--

INSERT INTO `template` (`id`, `template`, `title`, `des`, `bgColor`, `logo`, `heading2`, `heading3`, `heading4`, `paragraph`, `f1`, `f2`, `f3`, `f4`, `f5`, `f6`) VALUES
(1, 'HARD', 'OhMyOffers', '', 'FFFFFF', 'http://ohmyoffers.biz/images/logo.png', '&lt;h2&gt;Get Vouchers For Completing Easy Featured Offers !&lt;/h2&gt;', '&lt;h3&gt;Request and get vouchers every day from your own home ...&lt;/h3&gt;', '&lt;h4&gt;Just 3 steps to success!&lt;/h4&gt;', '&lt;p style=&quot;color: #000&quot;&gt;It&#039;s easy to use your free time to earn gift vouchers. While you certainly won&#039;t get rich quick or instantly win prizes, if you put in a bit of effort you can earn whatever you want! You can redeem points for vouchers such as Amazon, iTunes, ASOS and Xbox Live, the choice is yours. &lt;/p&gt;', 'Fast Sign Up - Fast Approve', '200 Points Minimum Threshold For Any Vouchers', 'Best Featured Offers for Earning More Points', 'Earn A Full 20% Lifetime Points From Referrals', 'Request Vouchers Daily', 'Various Vouchers for Request as Amazon, Ebay...');

-- --------------------------------------------------------

--
-- Structure de la table `walls`
--

CREATE TABLE IF NOT EXISTS `walls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iframe` text COLLATE utf8_unicode_ci NOT NULL,
  `secretKey` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Contenu de la table `walls`
--

INSERT INTO `walls` (`id`, `name`, `iframe`, `secretKey`, `pass`, `status`) VALUES
(1, 'BlvdMedia', '', '', '', 'ON'),
(2, 'CPAlead', '', '', '', 'ON'),
(3, 'SuperRewards', '', '', '', 'OFF'),
(4, 'SuperSonicAds', '', '', '', 'OFF'),
(5, 'RadiumOne', '', '', '', 'OFF'),
(6, 'Matomy', '', '', '', 'OFF'),
(7, 'PaymentWalls', '', '', '', 'OFF'),
(8, 'OfferWalls', '', '', '', 'OFF'),
(9, 'SponsorPay', '', '', '', 'OFF'),
(10, 'Jampp', '', '', '', 'OFF');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
