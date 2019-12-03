-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 01 2019 г., 10:42
-- Версия сервера: 10.4.10-MariaDB
-- Версия PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gk-force`
--

-- --------------------------------------------------------

--
-- Структура таблицы `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `date_deb_contrat` date NOT NULL,
  `id_conseiller` int(11) NOT NULL,
  PRIMARY KEY (`id_admin`),
  KEY `FK_id_user` (`id_conseiller`)
) ENGINE=MyISAM AUTO_INCREMENT=114 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `administrateur`
--

INSERT INTO `administrateur` (`id_admin`, `date_deb_contrat`, `id_conseiller`) VALUES
(111, '2017-09-23', 11),
(112, '2018-09-23', 12),
(113, '2019-09-23', 13);

-- --------------------------------------------------------

--
-- Структура таблицы `adresse`
--

DROP TABLE IF EXISTS `adresse`;
CREATE TABLE IF NOT EXISTS `adresse` (
  `id_adresse` int(11) NOT NULL AUTO_INCREMENT,
  `num_rue` int(5) NOT NULL,
  `nom_rue` varchar(100) NOT NULL,
  `code_postal` int(10) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_adresse`),
  KEY `FK_id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `adresse`
--

INSERT INTO `adresse` (`id_adresse`, `num_rue`, `nom_rue`, `code_postal`, `ville`, `id_user`) VALUES
(3, 56, '', 92300, 'Paris', 2),
(1, 46, 'Bellevue', 92100, 'Boulogne', 1),
(4, 23, 'Victor Hugo', 93290, 'Tremblay', 3),
(5, 32, 'avenue des Roses', 92500, 'Rueil Malmaison', 4),
(6, 50, 'General de Gaulle', 92048, 'Meudon', 5),
(7, 30, 'de Paris', 92072, 'Sevres', 6),
(8, 40, 'Christophe Colombe', 92140, 'Clamart', 7);

-- --------------------------------------------------------

--
-- Структура таблицы `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `id_conseiller` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `adresse` varchar(250) NOT NULL,
  `telephone` int(14) NOT NULL,
  `num_enfants` int(1) NOT NULL,
  `sit_matrimon` varchar(11) NOT NULL COMMENT 'c-celibat, m-marie, d-divorce, v-veuf',
  PRIMARY KEY (`id_client`),
  KEY `FK_id_user` (`id_user`),
  KEY `mle_conseiller` (`id_conseiller`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `compte`
--

DROP TABLE IF EXISTS `compte`;
CREATE TABLE IF NOT EXISTS `compte` (
  `id_compte` int(11) NOT NULL AUTO_INCREMENT,
  `rib` int(9) NOT NULL,
  `date_creation` date NOT NULL,
  `solde` int(20) NOT NULL,
  `type_compte` int(1) NOT NULL COMMENT '0- rémunéré, 1-courant',
  `id_client` int(11) NOT NULL,
  PRIMARY KEY (`id_compte`),
  KEY `FK_id_client` (`id_client`)
) ENGINE=MyISAM AUTO_INCREMENT=129 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `compte`
--

INSERT INTO `compte` (`id_compte`, `rib`, `date_creation`, `solde`, `type_compte`, `id_client`) VALUES
(123, 0, '2017-09-25', 500, 0, 1),
(124, 0, '2017-09-25', 500, 0, 1),
(125, 0, '2018-09-24', 1000, 0, 5),
(126, 0, '2019-09-24', 1500, 0, 6),
(127, 0, '2017-09-25', 2000, 0, 5),
(128, 0, '2018-09-26', 2500, 0, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `compte_rem`
--

DROP TABLE IF EXISTS `compte_rem`;
CREATE TABLE IF NOT EXISTS `compte_rem` (
  `id_compte_rem` int(11) NOT NULL AUTO_INCREMENT,
  `taux_interet` float NOT NULL,
  `id_compte` int(11) NOT NULL,
  `facilite_caisse` tinyint(1) NOT NULL COMMENT '0-non,1-oui',
  `montant_debit` decimal(9,0) NOT NULL,
  PRIMARY KEY (`id_compte_rem`),
  KEY `id_compte` (`id_compte`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `conseiller`
--

DROP TABLE IF EXISTS `conseiller`;
CREATE TABLE IF NOT EXISTS `conseiller` (
  `id_conseiller` int(11) NOT NULL AUTO_INCREMENT,
  `mle_conseiller` int(7) NOT NULL,
  `date_deb_contrat` date NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_conseiller`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `conseiller`
--

INSERT INTO `conseiller` (`id_conseiller`, `mle_conseiller`, `date_deb_contrat`, `id_user`) VALUES
(1, 0, '2017-09-23', 0),
(2, 0, '2019-09-23', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `demande_client`
--

DROP TABLE IF EXISTS `demande_client`;
CREATE TABLE IF NOT EXISTS `demande_client` (
  `ref_demande` int(11) NOT NULL AUTO_INCREMENT,
  `date_demande` date NOT NULL,
  `type_demande` int(1) NOT NULL COMMENT '0-ouverture, 1-chequier',
  `id_client` int(11) NOT NULL,
  PRIMARY KEY (`ref_demande`),
  KEY `FK_id_client` (`id_client`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `demande_client`
--

INSERT INTO `demande_client` (`ref_demande`, `date_demande`, `type_demande`, `id_client`) VALUES
(1, '2017-11-20', 0, 6),
(2, '2018-11-20', 1, 7),
(3, '2018-11-22', 0, 7),
(4, '2019-09-22', 1, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `document`
--

DROP TABLE IF EXISTS `document`;
CREATE TABLE IF NOT EXISTS `document` (
  `id_document` int(11) NOT NULL AUTO_INCREMENT,
  `type_document` varchar(50) NOT NULL,
  `contenu_document` blob NOT NULL,
  `id_client` int(11) NOT NULL,
  PRIMARY KEY (`id_document`),
  KEY `id_client` (`id_client`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id_notif` int(11) NOT NULL AUTO_INCREMENT,
  `date_notif` date NOT NULL,
  `message_notif` varchar(200) NOT NULL,
  `id_transaction` int(11) NOT NULL,
  `id_compte` int(11) NOT NULL,
  `ref_demande` int(11) NOT NULL,
  PRIMARY KEY (`id_notif`),
  KEY `FK_num_transaction` (`id_transaction`),
  KEY `FK_num_compte` (`id_compte`),
  KEY `FK_ref_demande` (`ref_demande`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id_transaction` int(11) NOT NULL AUTO_INCREMENT,
  `date_transaction` date NOT NULL,
  `type_transaction` char(1) NOT NULL COMMENT 'd-debit, c-credit',
  `montant_transaction` int(11) NOT NULL,
  `id_compte` int(11) NOT NULL,
  PRIMARY KEY (`id_transaction`),
  KEY `FK_id_client` (`id_compte`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(15) NOT NULL,
  `email` varchar(60) NOT NULL,
  `pseudonyme` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role` int(1) NOT NULL COMMENT '0-client, 1-conseiller, 2-admin',
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `nom`, `prenom`, `email`, `pseudonyme`, `password`, `role`) VALUES
(1, 'Bernic', '', 'bernic.ina@gmail.com', '', 'inulea10', 1),
(2, 'Paterna', '', 'paterna@club-internet.fr', '', 'Manonegra1988', 0),
(3, 'Rahoui', '', 'rahsouad@gmail.com', '', 'rahoui', 0),
(4, 'Bellard', '', 'frederic.bellard0@gmail.com', '', 'bellard', 2),
(5, 'Bernic', '', 'bernic.dum@gmail.com', '', 'bernic', 1),
(6, 'Rahoui', '', 'rahoui.iris@gmail.com', '', 'rahoui', 2),
(7, 'Paterna', '', 'anne.paterna@gmail.com', '', 'anne', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
