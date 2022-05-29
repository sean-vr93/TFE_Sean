-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.23 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour itcm_bdd_sean
CREATE DATABASE IF NOT EXISTS `itcm_bdd_sean` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `itcm_bdd_sean`;

-- Listage de la structure de la table itcm_bdd_sean. actualitees
CREATE TABLE IF NOT EXISTS `actualitees` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `REDACTEUR_ID` int DEFAULT NULL,
  `REDACTEUR_NAME` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `TITRE` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `TEXTE` text,
  `MOMENT` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `REDACTEUR_ID_USER` (`REDACTEUR_ID`),
  CONSTRAINT `REDACTEUR_ID_USER` FOREIGN KEY (`REDACTEUR_ID`) REFERENCES `users` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Listage des données de la table itcm_bdd_sean.actualitees : ~3 rows (environ)
/*!40000 ALTER TABLE `actualitees` DISABLE KEYS */;
REPLACE INTO `actualitees` (`ID`, `REDACTEUR_ID`, `REDACTEUR_NAME`, `TITRE`, `TEXTE`, `MOMENT`) VALUES
	(8, 1, 'Admin admin', 'Test', 'Allo ?', '2022-04-30 14:31:43');
/*!40000 ALTER TABLE `actualitees` ENABLE KEYS */;

-- Listage de la structure de la table itcm_bdd_sean. classes
CREATE TABLE IF NOT EXISTS `classes` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `CLASSE` varchar(50) DEFAULT NULL,
  `TITULAIRE` int DEFAULT '1',
  PRIMARY KEY (`ID`),
  KEY `CLASSE_ID_TITULAIRE` (`TITULAIRE`),
  CONSTRAINT `CLASSE_ID_TITULAIRE` FOREIGN KEY (`TITULAIRE`) REFERENCES `profs` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Listage des données de la table itcm_bdd_sean.classes : ~9 rows (environ)
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
REPLACE INTO `classes` (`ID`, `CLASSE`, `TITULAIRE`) VALUES
	(1, 'SANS CLASSE', 1),
	(2, '6TT', 14),
	(3, '5TT', 1),
	(4, '4TT', 1),
	(5, '3TT', 1),
	(10, '6PA2', 1),
	(11, '6GT', 1),
	(12, '5GT', 1),
	(13, '4GT', 1);
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;

-- Listage de la structure de la table itcm_bdd_sean. config_ecole
CREATE TABLE IF NOT EXISTS `config_ecole` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `ANNEE_ACTUELLE` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Listage des données de la table itcm_bdd_sean.config_ecole : ~0 rows (environ)
/*!40000 ALTER TABLE `config_ecole` DISABLE KEYS */;
REPLACE INTO `config_ecole` (`ID`, `ANNEE_ACTUELLE`) VALUES
	(1, '2021');
/*!40000 ALTER TABLE `config_ecole` ENABLE KEYS */;

-- Listage de la structure de la table itcm_bdd_sean. directions
CREATE TABLE IF NOT EXISTS `directions` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `NOM` varchar(50) DEFAULT NULL,
  `PRENOM` varchar(50) DEFAULT NULL,
  `SEXE` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `TELEPHONE` varchar(50) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `PHOTO` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'avatar.png',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Listage des données de la table itcm_bdd_sean.directions : ~2 rows (environ)
/*!40000 ALTER TABLE `directions` DISABLE KEYS */;
REPLACE INTO `directions` (`ID`, `NOM`, `PRENOM`, `SEXE`, `TELEPHONE`, `EMAIL`, `PHOTO`) VALUES
	(1, '/ AUCUN ', '/', '/', '/', '/', NULL),
	(2, 'NomDirecteur', 'ffzefzfz', NULL, NULL, 'fezzz', 'avatar.png');
/*!40000 ALTER TABLE `directions` ENABLE KEYS */;

-- Listage de la structure de la table itcm_bdd_sean. educateurs
CREATE TABLE IF NOT EXISTS `educateurs` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `NOM` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `PRENOM` varchar(50) DEFAULT NULL,
  `SEXE` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `TELEPHONE` varchar(50) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `PHOTO` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'avatar.png',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Listage des données de la table itcm_bdd_sean.educateurs : ~2 rows (environ)
/*!40000 ALTER TABLE `educateurs` DISABLE KEYS */;
REPLACE INTO `educateurs` (`ID`, `NOM`, `PRENOM`, `SEXE`, `TELEPHONE`, `EMAIL`, `PHOTO`) VALUES
	(1, '/ AUCUN ', '/', '/', '/', '/', NULL),
	(7, 'Educ', 'educ', NULL, NULL, 'zefoizoief@gmail.com', 'avatar.png');
/*!40000 ALTER TABLE `educateurs` ENABLE KEYS */;

-- Listage de la structure de la table itcm_bdd_sean. educateurs_classes
CREATE TABLE IF NOT EXISTS `educateurs_classes` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `EDUCATEUR` int DEFAULT NULL,
  `CLASSE` int DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `EDUCATEUR_ID_EDUCATEUR` (`EDUCATEUR`),
  KEY `CLASSE_ID_EDUCATEUR` (`CLASSE`),
  CONSTRAINT `CLASSE_ID_EDUCATEUR` FOREIGN KEY (`CLASSE`) REFERENCES `classes` (`ID`),
  CONSTRAINT `EDUCATEUR_ID_EDUCATEUR` FOREIGN KEY (`EDUCATEUR`) REFERENCES `educateurs` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Listage des données de la table itcm_bdd_sean.educateurs_classes : ~0 rows (environ)
/*!40000 ALTER TABLE `educateurs_classes` DISABLE KEYS */;
REPLACE INTO `educateurs_classes` (`ID`, `EDUCATEUR`, `CLASSE`) VALUES
	(2, 7, 3),
	(3, 7, 2);
/*!40000 ALTER TABLE `educateurs_classes` ENABLE KEYS */;

-- Listage de la structure de la table itcm_bdd_sean. eleves
CREATE TABLE IF NOT EXISTS `eleves` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `NOM` varchar(50) DEFAULT NULL,
  `PRENOM` varchar(50) DEFAULT NULL,
  `SEXE` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `EMAIL` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `TELEPHONE` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `EMAIL_RESPONSABLE` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `TELEPHONE_RESPONSABLE` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `PHOTO` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'avatar.png',
  `DATE_NAISSANCE` date DEFAULT NULL,
  `CLASSE` int DEFAULT '5',
  PRIMARY KEY (`ID`),
  KEY `CLASSE_ID_ELEVES` (`CLASSE`),
  CONSTRAINT `CLASSE_ID_ELEVES` FOREIGN KEY (`CLASSE`) REFERENCES `classes` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Listage des données de la table itcm_bdd_sean.eleves : ~3 rows (environ)
/*!40000 ALTER TABLE `eleves` DISABLE KEYS */;
REPLACE INTO `eleves` (`ID`, `NOM`, `PRENOM`, `SEXE`, `EMAIL`, `TELEPHONE`, `EMAIL_RESPONSABLE`, `TELEPHONE_RESPONSABLE`, `PHOTO`, `DATE_NAISSANCE`, `CLASSE`) VALUES
	(1, '/ AUCUN ', '/', '/', '/', '/', '/', '/', NULL, NULL, NULL),
	(7, 'Vergauwen', 'Sean', NULL, 'zefzefz', NULL, NULL, NULL, '7VergauwenSeanAvatarEleveScreenshot_14.png', NULL, 2),
	(9, 'dqzqdz', 'dzqqzdq', NULL, 'qdzdqz', NULL, NULL, NULL, 'avatar.png', NULL, 1);
/*!40000 ALTER TABLE `eleves` ENABLE KEYS */;

-- Listage de la structure de la table itcm_bdd_sean. grille_horaire_classe
CREATE TABLE IF NOT EXISTS `grille_horaire_classe` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `ANNEE` varchar(50) DEFAULT NULL,
  `CLASSE` int DEFAULT NULL,
  `PROF` int DEFAULT NULL,
  `LOCAL` int DEFAULT NULL,
  `HEURE` int DEFAULT NULL,
  `JOUR` int DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `HORAIRE_CLASSE_ID_CLASSE` (`CLASSE`),
  KEY `HORAIRE_CLASSE_ID_PROF` (`PROF`),
  KEY `HORAIRE_CLASSE_ID_LOCAL` (`LOCAL`),
  KEY `HORAIRE_CLASSE_ID_HEURE` (`HEURE`),
  KEY `HORAIRE_CLASSE_ID_JOUR` (`JOUR`),
  CONSTRAINT `HORAIRE_CLASSE_ID_CLASSE` FOREIGN KEY (`CLASSE`) REFERENCES `classes` (`ID`),
  CONSTRAINT `HORAIRE_CLASSE_ID_HEURE` FOREIGN KEY (`HEURE`) REFERENCES `heures` (`ID`),
  CONSTRAINT `HORAIRE_CLASSE_ID_JOUR` FOREIGN KEY (`JOUR`) REFERENCES `jours` (`ID`),
  CONSTRAINT `HORAIRE_CLASSE_ID_LOCAL` FOREIGN KEY (`LOCAL`) REFERENCES `locaux` (`ID`),
  CONSTRAINT `HORAIRE_CLASSE_ID_PROF` FOREIGN KEY (`PROF`) REFERENCES `profs` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Listage des données de la table itcm_bdd_sean.grille_horaire_classe : ~0 rows (environ)
/*!40000 ALTER TABLE `grille_horaire_classe` DISABLE KEYS */;
/*!40000 ALTER TABLE `grille_horaire_classe` ENABLE KEYS */;

-- Listage de la structure de la table itcm_bdd_sean. heures
CREATE TABLE IF NOT EXISTS `heures` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `HEURE` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Listage des données de la table itcm_bdd_sean.heures : ~9 rows (environ)
/*!40000 ALTER TABLE `heures` DISABLE KEYS */;
REPLACE INTO `heures` (`ID`, `HEURE`) VALUES
	(1, '8H20-9H10'),
	(2, '9H10-10H00'),
	(3, '10H15-11H05'),
	(4, '11H05-11H55'),
	(5, '11H55-12H45'),
	(6, '13H45-14H35'),
	(7, '14H35-15H25'),
	(8, '15H35-16H25'),
	(9, '16H25-17H15');
/*!40000 ALTER TABLE `heures` ENABLE KEYS */;

-- Listage de la structure de la table itcm_bdd_sean. jours
CREATE TABLE IF NOT EXISTS `jours` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `JOUR` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Listage des données de la table itcm_bdd_sean.jours : ~5 rows (environ)
/*!40000 ALTER TABLE `jours` DISABLE KEYS */;
REPLACE INTO `jours` (`ID`, `JOUR`) VALUES
	(1, 'LUNDI'),
	(2, 'MARDI'),
	(3, 'MERCREDI'),
	(4, 'JEUDI'),
	(5, 'VENDREDI');
/*!40000 ALTER TABLE `jours` ENABLE KEYS */;

-- Listage de la structure de la table itcm_bdd_sean. locaux
CREATE TABLE IF NOT EXISTS `locaux` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `LOCAL` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Listage des données de la table itcm_bdd_sean.locaux : ~13 rows (environ)
/*!40000 ALTER TABLE `locaux` DISABLE KEYS */;
REPLACE INTO `locaux` (`ID`, `LOCAL`) VALUES
	(1, 'P 3.11'),
	(2, 'P 3.07'),
	(3, 'P 3.10'),
	(4, 'P 2.10'),
	(5, 'P 3.01'),
	(6, 'EPS'),
	(7, 'P 3.12'),
	(8, 'P 3.06'),
	(9, 'P 1.03'),
	(10, 'P 3.03'),
	(11, 'P 3.04'),
	(12, 'P 2.03'),
	(13, 'P 2.13');
/*!40000 ALTER TABLE `locaux` ENABLE KEYS */;

-- Listage de la structure de la table itcm_bdd_sean. matieres
CREATE TABLE IF NOT EXISTS `matieres` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `MATIERE` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- Listage des données de la table itcm_bdd_sean.matieres : ~16 rows (environ)
/*!40000 ALTER TABLE `matieres` DISABLE KEYS */;
REPLACE INTO `matieres` (`ID`, `MATIERE`) VALUES
	(1, '/ AUCUN /'),
	(2, 'Mathématiques'),
	(3, 'Anglais'),
	(4, 'Sciences'),
	(5, 'Religion'),
	(6, 'Histoire'),
	(7, 'Geographie'),
	(8, 'EPS'),
	(9, 'Néerlandais'),
	(10, 'Programmation'),
	(11, 'OS'),
	(12, 'Multimédia'),
	(13, 'Biologie'),
	(14, 'Rem_MATH'),
	(19, 'Sciences Economiques'),
	(22, 'Français');
/*!40000 ALTER TABLE `matieres` ENABLE KEYS */;

-- Listage de la structure de la table itcm_bdd_sean. messages
CREATE TABLE IF NOT EXISTS `messages` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `REDACTEUR_ID` int DEFAULT NULL,
  `REDACTEUR_NOM` varchar(50) DEFAULT NULL,
  `DESTINATAIRE_CLASSE` int DEFAULT NULL,
  `DESTINATAIRE_ID` int DEFAULT NULL,
  `TITRE` varchar(50) DEFAULT NULL,
  `TEXTE` text,
  `MOMENT` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `MESSAGE_REDACTEUR_ID` (`REDACTEUR_ID`),
  KEY `MESSAGE_DESTINATAIRE_CLASSE_ID` (`DESTINATAIRE_CLASSE`),
  KEY `MESSAGE_DESTINATAIRE_USER_ID` (`DESTINATAIRE_ID`),
  CONSTRAINT `MESSAGE_DESTINATAIRE_CLASSE_ID` FOREIGN KEY (`DESTINATAIRE_CLASSE`) REFERENCES `classes` (`ID`),
  CONSTRAINT `MESSAGE_DESTINATAIRE_USER_ID` FOREIGN KEY (`DESTINATAIRE_ID`) REFERENCES `users` (`ID`),
  CONSTRAINT `MESSAGE_REDACTEUR_ID` FOREIGN KEY (`REDACTEUR_ID`) REFERENCES `users` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- Listage des données de la table itcm_bdd_sean.messages : ~0 rows (environ)
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
REPLACE INTO `messages` (`ID`, `REDACTEUR_ID`, `REDACTEUR_NOM`, `DESTINATAIRE_CLASSE`, `DESTINATAIRE_ID`, `TITRE`, `TEXTE`, `MOMENT`) VALUES
	(43, 1, 'Vergauwen Sean', NULL, 5, 'Yo le boss', 'ça va ou quoi le sang ?', '2022-04-30 17:54:52'),
	(44, 1, 'Vergauwen Sean', NULL, 1, 'test', 'test', '2022-04-30 18:58:28'),
	(45, 8, 'Prof prof', 2, NULL, 'yo les djeuns', 'ça va ou quoi ?', '2022-05-07 11:46:42');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;

-- Listage de la structure de la table itcm_bdd_sean. profs
CREATE TABLE IF NOT EXISTS `profs` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `NOM` varchar(50) DEFAULT NULL,
  `PRENOM` varchar(50) DEFAULT NULL,
  `SEXE` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `TELEPHONE` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `PHOTO` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'avatar.png',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Listage des données de la table itcm_bdd_sean.profs : ~2 rows (environ)
/*!40000 ALTER TABLE `profs` DISABLE KEYS */;
REPLACE INTO `profs` (`ID`, `NOM`, `PRENOM`, `SEXE`, `TELEPHONE`, `EMAIL`, `PHOTO`) VALUES
	(1, '/ AUCUN ', '/', '/', '/', '/', '/'),
	(14, 'Prof', 'prof', NULL, NULL, 'fzefzfzefzefLOOOL', 'avatar.png');
/*!40000 ALTER TABLE `profs` ENABLE KEYS */;

-- Listage de la structure de la table itcm_bdd_sean. profs_classes_matieres
CREATE TABLE IF NOT EXISTS `profs_classes_matieres` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `ANNEE` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `PROF` int DEFAULT NULL,
  `CLASSE` int DEFAULT NULL,
  `MATIERE` int DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `PROF_ID` (`PROF`),
  KEY `CLASSE_ID` (`CLASSE`),
  KEY `MATIERE_ID` (`MATIERE`),
  CONSTRAINT `CLASSE_ID` FOREIGN KEY (`CLASSE`) REFERENCES `classes` (`ID`),
  CONSTRAINT `MATIERE_ID` FOREIGN KEY (`MATIERE`) REFERENCES `matieres` (`ID`),
  CONSTRAINT `PROF_ID` FOREIGN KEY (`PROF`) REFERENCES `profs` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- Listage des données de la table itcm_bdd_sean.profs_classes_matieres : ~2 rows (environ)
/*!40000 ALTER TABLE `profs_classes_matieres` DISABLE KEYS */;
REPLACE INTO `profs_classes_matieres` (`ID`, `ANNEE`, `PROF`, `CLASSE`, `MATIERE`) VALUES
	(15, '2021', 14, 2, 8),
	(16, '2021', 14, 2, 12);
/*!40000 ALTER TABLE `profs_classes_matieres` ENABLE KEYS */;

-- Listage de la structure de la table itcm_bdd_sean. roles
CREATE TABLE IF NOT EXISTS `roles` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `ROLE` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Listage des données de la table itcm_bdd_sean.roles : ~6 rows (environ)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
REPLACE INTO `roles` (`ID`, `ROLE`) VALUES
	(1, 'admin'),
	(2, 'prof'),
	(3, 'educateur'),
	(4, 'eleve'),
	(5, 'direction'),
	(7, 'AUCUN');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Listage de la structure de la table itcm_bdd_sean. users
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `EMAIL` varchar(50) DEFAULT NULL,
  `LOGIN` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `PASSWORD` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `NOM` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `PRENOM` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ROLE` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'AUCUN',
  `APPROVED` int DEFAULT '0',
  `LIEN_ELEVE` int DEFAULT NULL,
  `LIEN_PROF` int DEFAULT NULL,
  `LIEN_EDUCATEUR` int DEFAULT NULL,
  `LIEN_DIRECTION` int DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `ELEVE_ID_USER` (`LIEN_ELEVE`),
  KEY `PROF_ID_USER` (`LIEN_PROF`),
  KEY `EDUCATEUR_ID_USER` (`LIEN_EDUCATEUR`),
  KEY `DIRECTION_ID_USER` (`LIEN_DIRECTION`),
  CONSTRAINT `DIRECTION_ID_USER` FOREIGN KEY (`LIEN_DIRECTION`) REFERENCES `directions` (`ID`),
  CONSTRAINT `EDUCATEUR_ID_USER` FOREIGN KEY (`LIEN_EDUCATEUR`) REFERENCES `educateurs` (`ID`),
  CONSTRAINT `ELEVE_ID_USER` FOREIGN KEY (`LIEN_ELEVE`) REFERENCES `eleves` (`ID`),
  CONSTRAINT `PROF_ID_USER` FOREIGN KEY (`LIEN_PROF`) REFERENCES `profs` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Listage des données de la table itcm_bdd_sean.users : ~4 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`ID`, `EMAIL`, `LOGIN`, `PASSWORD`, `NOM`, `PRENOM`, `ROLE`, `APPROVED`, `LIEN_ELEVE`, `LIEN_PROF`, `LIEN_EDUCATEUR`, `LIEN_DIRECTION`) VALUES
	(1, 'admin', 'admin', 'admin', 'admin', 'admin', 'admin', 1, 1, 1, 1, 1),
	(5, 'eleve@gmail.com', 'eleve', 'eleve', 'NomEleve', 'eleve', 'eleve', 1, 7, 1, 1, 1),
	(7, 'direction@gmail.com', 'direction', 'direction', 'NomDirec', 'direc', 'direction', 1, 1, 1, 1, 2),
	(8, 'prof@gmail.com', 'prof', 'prof', 'NomProf', 'prof', 'prof', 1, 1, 14, 1, 1),
	(9, 'educ@gmail.com', 'educ', 'educ', 'NomEduc', 'educ', 'educateur', 1, 1, 1, 7, 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
