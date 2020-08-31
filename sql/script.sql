-- --------------------------------------------------------
-- Hôte :                        192.168.0.25
-- Version du serveur:           10.1.45-MariaDB-0+deb9u1 - Raspbian 9.11
-- SE du serveur:                debian-linux-gnueabihf
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour LSPD_Osmoze_RP
DROP DATABASE IF EXISTS `LSPD_Osmoze_RP`;
CREATE DATABASE IF NOT EXISTS `LSPD_Osmoze_RP` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `LSPD_Osmoze_RP`;

-- Listage de la structure de la table LSPD_Osmoze_RP. avis_de_recherche
DROP TABLE IF EXISTS `avis_de_recherche`;
CREATE TABLE IF NOT EXISTS `avis_de_recherche` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quand` varchar(100) DEFAULT NULL,
  `utilisateur` int(11) DEFAULT NULL,
  `nom_crim` varchar(50) DEFAULT NULL,
  `sexe` varchar(2) DEFAULT NULL,
  `pourquoi` text,
  PRIMARY KEY (`id`),
  KEY `FK_avis_de_recherche_compte_lspd` (`utilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table LSPD_Osmoze_RP. bracelet
DROP TABLE IF EXISTS `bracelet`;
CREATE TABLE IF NOT EXISTS `bracelet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur` int(11) NOT NULL DEFAULT '0',
  `date_pose` varchar(100) DEFAULT NULL,
  `date_fin_pose` varchar(100) DEFAULT NULL,
  `raison` varchar(200) NOT NULL DEFAULT '0',
  `criminel` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `criminel` (`criminel`),
  KEY `utilisateur` (`utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table LSPD_Osmoze_RP. casier
DROP TABLE IF EXISTS `casier`;
CREATE TABLE IF NOT EXISTS `casier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quand` varchar(100) DEFAULT NULL,
  `utilisateur` int(11) DEFAULT NULL,
  `lieu` varchar(100) DEFAULT NULL,
  `nom_crim` varchar(50) DEFAULT NULL,
  `date_de_naissance` varchar(50) DEFAULT NULL,
  `num_tel` varchar(10) DEFAULT NULL,
  `sexe` varchar(2) DEFAULT NULL,
  `taille` int(11) DEFAULT NULL,
  `piece_id` text,
  PRIMARY KEY (`id`),
  KEY `FK_casier_casier` (`utilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table LSPD_Osmoze_RP. compte_lspd
DROP TABLE IF EXISTS `compte_lspd`;
CREATE TABLE IF NOT EXISTS `compte_lspd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur` varchar(50) DEFAULT NULL,
  `motdepasse` text,
  `grade` int(11) DEFAULT NULL,
  `matricule` int(11) DEFAULT NULL,
  `rh` int(11) DEFAULT NULL,
  `isadmin` int(11) DEFAULT NULL,
  `issuperadmin` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO compte_lspd VALUES (1, 'Bollin0', '7e2feac95dcd7d1df803345e197369af4b156e4e7a95fcb2955bdbbb3a11afd8bb9d35931bf15511370b18143e38b01b903f55c5ecbded4af99934602fcdf38c', 15, 24, 0, 0, 1);

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table LSPD_Osmoze_RP. infraction
DROP TABLE IF EXISTS `infraction`;
CREATE TABLE IF NOT EXISTS `infraction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `casier` int(11) DEFAULT NULL,
  `utilisateur` int(11) DEFAULT NULL,
  `quand` varchar(100) DEFAULT NULL,
  `infra` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_infraction_casier` (`casier`),
  KEY `FK_infraction_compte_lspd` (`utilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table LSPD_Osmoze_RP. log_panel
DROP TABLE IF EXISTS `log_panel`;
CREATE TABLE IF NOT EXISTS `log_panel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur` text,
  `historique` text,
  `quand` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table LSPD_Osmoze_RP. plainte
DROP TABLE IF EXISTS `plainte`;
CREATE TABLE IF NOT EXISTS `plainte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quand` varchar(100) DEFAULT NULL,
  `utilisateur` int(11) DEFAULT NULL,
  `lieu` varchar(100) DEFAULT NULL,
  `victime` text,
  `tel_victime` text,
  `suspect` text,
  `tel_suspect` text,
  `des_info_suspect` text,
  `vers_victime` text,
  `vers_suspect` text,
  `preuve` text,
  `etat` int(11) DEFAULT NULL,
  `signa` text,
  PRIMARY KEY (`id`),
  KEY `FK_plainte_compte_lspd` (`utilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table LSPD_Osmoze_RP. question_reponse
DROP TABLE IF EXISTS `question_reponse`;
CREATE TABLE IF NOT EXISTS `question_reponse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(200) NOT NULL DEFAULT '0',
  `q/r` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table LSPD_Osmoze_RP. rapport
DROP TABLE IF EXISTS `rapport`;
CREATE TABLE IF NOT EXISTS `rapport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quand` varchar(100) DEFAULT NULL,
  `lieu` varchar(100) DEFAULT NULL,
  `utilisateur` int(11) DEFAULT NULL,
  `nom_crim` text,
  `maison_crim` text,
  `qst_1` text,
  `rep_1` text,
  `qst_2` text,
  `rep_2` text,
  `qst_3` text,
  `rep_3` text,
  `qst_4` text,
  `rep_4` text,
  `qst_5` text,
  `rep_5` text,
  `rap_situ` text,
  `preuve` text,
  `etat` int(11) DEFAULT NULL,
  `signa` text,
  PRIMARY KEY (`id`),
  KEY `utilisateur` (`utilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
