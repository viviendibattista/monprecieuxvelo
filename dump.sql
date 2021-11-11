-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           8.0.19-0ubuntu5 - (Ubuntu)
-- SE du serveur:                Linux
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour monprecieuxvelo
CREATE DATABASE IF NOT EXISTS `monprecieuxvelo` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `monprecieuxvelo`;

-- Listage de la structure de la table monprecieuxvelo. employes
CREATE TABLE IF NOT EXISTS `employes` (
  `id` int NOT NULL,
  `mdp` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `employes_ibfk_1` FOREIGN KEY (`id`) REFERENCES `utilisateurs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table monprecieuxvelo.employes : ~4 rows (environ)
/*!40000 ALTER TABLE `employes` DISABLE KEYS */;
INSERT INTO `employes` (`id`, `mdp`, `email`) VALUES
	(1, '$2y$10$ihiCxTqS5z6dllA5kBzaL.A/nkYnVH5.qsYi/AZDwlMmLrS6Bv6AW', 'johnwayne@mpv.fr'),
	(2, '$2y$10$CXhOdAghKl88wNUhsSW0R.7WrF8BpVEs2pv5Sm2oJGlildp/ndx3G', 'leevancliff@mpv.fr'),
	(3, '$2y$10$JiEgvijNeY3ciWlm3.PgOutRBPWoSFhZ.EOpWIc1VsAqmHuvdGENK', 'charlesbronson@mpv.fr'),
	(4, '$2y$10$oE6ER5pzd3Oc8VlAK4fvpeJrIzKYwjrDMT1fx2Q1avKkDd3p7FNES', 'clinteastwood@mpv.fr');
/*!40000 ALTER TABLE `employes` ENABLE KEYS */;

-- Listage de la structure de la table monprecieuxvelo. membres
CREATE TABLE IF NOT EXISTS `membres` (
  `id` int NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `membres_ibfk_1` FOREIGN KEY (`id`) REFERENCES `utilisateurs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table monprecieuxvelo.membres : ~9 rows (environ)
/*!40000 ALTER TABLE `membres` DISABLE KEYS */;
INSERT INTO `membres` (`id`, `email`) VALUES
	(5, 'lskywalker@jedi.net'),
	(6, 'solo@millenium.net'),
	(7, 'leia.organa@aldebaran.gov'),
	(8, 'a.lee@galactica.net'),
	(9, 'kthrace@starbuck.org'),
	(10, 'jholden@rocinante.net'),
	(11, 'kamal@march.mil'),
	(12, 'nnagata@freelancer.net'),
	(22, 'homer@simpson.com');
/*!40000 ALTER TABLE `membres` ENABLE KEYS */;

-- Listage de la structure de la table monprecieuxvelo. parkings
CREATE TABLE IF NOT EXISTS `parkings` (
  `idParking` int NOT NULL AUTO_INCREMENT,
  `disponible` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idParking`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- Listage des données de la table monprecieuxvelo.parkings : ~24 rows (environ)
/*!40000 ALTER TABLE `parkings` DISABLE KEYS */;
INSERT INTO `parkings` (`idParking`, `disponible`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 0),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(20, 1),
	(21, 1),
	(22, 1),
	(23, 1),
	(24, 1);
/*!40000 ALTER TABLE `parkings` ENABLE KEYS */;

-- Listage de la structure de la table monprecieuxvelo. piecesdetachees
CREATE TABLE IF NOT EXISTS `piecesdetachees` (
  `idPiece` int NOT NULL AUTO_INCREMENT,
  `designation` varchar(50) DEFAULT NULL,
  `qteStock` int DEFAULT NULL,
  `prixUnitaire` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`idPiece`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- Listage des données de la table monprecieuxvelo.piecesdetachees : ~21 rows (environ)
/*!40000 ALTER TABLE `piecesdetachees` DISABLE KEYS */;
INSERT INTO `piecesdetachees` (`idPiece`, `designation`, `qteStock`, `prixUnitaire`) VALUES
	(1, 'Selle trek', 10, 60.00),
	(2, 'Selle', 20, 35.00),
	(3, 'Collier de serrage', 54, 6.50),
	(4, 'Cintre droit', 3, 14.50),
	(5, 'Cintre route', 2, 30.00),
	(6, 'Cintre trek', 4, 23.00),
	(7, 'Potence', 12, 27.50),
	(8, 'Feins à disque', 5, 67.50),
	(9, 'Freins sur jante', 12, 37.50),
	(10, 'Patins', 125, 8.50),
	(11, 'Plaquettes', 82, 20.00),
	(12, 'Cable de frein (au metre)', 28, 0.30),
	(13, 'Pédalier', 7, 32.50),
	(14, 'Pédales', 35, 45.00),
	(15, 'Dérailleur arrière', 16, 27.50),
	(16, 'Dérailleur avant', 7, 15.00),
	(17, 'Plateau 32', 12, 16.50),
	(18, 'Plateau 22', 17, 9.50),
	(19, 'Jante 26', 25, 21.50),
	(20, 'Pneu 26', 14, 28.50),
	(21, 'Fourche', 11, 50.50);
/*!40000 ALTER TABLE `piecesdetachees` ENABLE KEYS */;

-- Listage de la structure de la table monprecieuxvelo. reparations
CREATE TABLE IF NOT EXISTS `reparations` (
  `idService` int NOT NULL,
  `duree` decimal(15,2) DEFAULT NULL,
  `details` text,
  `observations` text,
  PRIMARY KEY (`idService`),
  CONSTRAINT `reparations_ibfk_1` FOREIGN KEY (`idService`) REFERENCES `services` (`idService`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table monprecieuxvelo.reparations : ~4 rows (environ)
/*!40000 ALTER TABLE `reparations` DISABLE KEYS */;
INSERT INTO `reparations` (`idService`, `duree`, `details`, `observations`) VALUES
	(4, NULL, 'Frein avant défectueux', ''),
	(5, 1.00, 'Roue arrière voilée', 'Pneu très abîmé, remplacé avec accord du membre'),
	(6, 2.00, 'Remplacement freins jante par disques', 'RAS'),
	(7, 2.00, 'Détails', 'Obs'),
	(9, NULL, NULL, NULL);
/*!40000 ALTER TABLE `reparations` ENABLE KEYS */;

-- Listage de la structure de la table monprecieuxvelo. services
CREATE TABLE IF NOT EXISTS `services` (
  `idService` int NOT NULL AUTO_INCREMENT,
  `statut` varchar(50) DEFAULT NULL,
  `dateDebut` datetime DEFAULT NULL,
  `dateFin` datetime DEFAULT NULL,
  `datePaiement` date DEFAULT NULL,
  `id` int NOT NULL,
  PRIMARY KEY (`idService`),
  KEY `id` (`id`),
  CONSTRAINT `services_ibfk_1` FOREIGN KEY (`id`) REFERENCES `membres` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Listage des données de la table monprecieuxvelo.services : ~9 rows (environ)
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` (`idService`, `statut`, `dateDebut`, `dateFin`, `datePaiement`, `id`) VALUES
	(1, 'en cours', '2020-03-17 15:03:11', NULL, NULL, 5),
	(2, 'à payer', '2020-02-12 12:01:00', '2020-05-01 10:00:00', NULL, 7),
	(3, 'réglé', '2019-12-12 10:01:00', '2019-12-14 12:08:00', '2019-12-14', 8),
	(4, 'en cours', '2020-03-16 13:24:00', NULL, NULL, 10),
	(5, 'à payer', '2020-01-16 15:00:00', '2020-01-16 17:01:00', NULL, 6),
	(6, 'réglé', '2020-02-27 09:31:00', '2020-02-27 10:41:00', '2020-02-28', 12),
	(7, 'réglé', '2020-04-27 08:00:00', '2020-04-29 10:00:00', '2020-05-01', 8),
	(8, 'à payer', '2020-05-04 06:00:00', '2020-05-04 09:00:00', NULL, 22),
	(9, 'en cours', '2020-05-04 09:30:00', NULL, NULL, 22);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;

-- Listage de la structure de la table monprecieuxvelo. stationnements
CREATE TABLE IF NOT EXISTS `stationnements` (
  `idService` int NOT NULL,
  `idParking` int NOT NULL,
  PRIMARY KEY (`idService`),
  KEY `idParking` (`idParking`),
  CONSTRAINT `stationnements_ibfk_1` FOREIGN KEY (`idService`) REFERENCES `services` (`idService`),
  CONSTRAINT `stationnements_ibfk_2` FOREIGN KEY (`idParking`) REFERENCES `parkings` (`idParking`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table monprecieuxvelo.stationnements : ~4 rows (environ)
/*!40000 ALTER TABLE `stationnements` DISABLE KEYS */;
INSERT INTO `stationnements` (`idService`, `idParking`) VALUES
	(1, 5),
	(2, 5),
	(8, 18),
	(3, 21);
/*!40000 ALTER TABLE `stationnements` ENABLE KEYS */;

-- Listage de la structure de la table monprecieuxvelo. utilisateurs
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- Listage des données de la table monprecieuxvelo.utilisateurs : ~13 rows (environ)
/*!40000 ALTER TABLE `utilisateurs` DISABLE KEYS */;
INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`) VALUES
	(1, 'Wayne', 'John'),
	(2, 'VanCliff', 'Lee'),
	(3, 'Bronson', 'Charles'),
	(4, 'Eastwood', 'Clint'),
	(5, 'Skywalker', 'Luke'),
	(6, 'Solo', 'Han'),
	(7, 'Organa', 'Leia'),
	(8, 'Adama', 'Lee'),
	(9, 'Thrase', 'Kara'),
	(10, 'Holden', 'Jim'),
	(11, 'Kamal', 'Alex'),
	(12, 'Nagata', 'Naomi'),
	(22, 'Simpson', 'Homer');
/*!40000 ALTER TABLE `utilisateurs` ENABLE KEYS */;

-- Listage de la structure de la table monprecieuxvelo. utiliser
CREATE TABLE IF NOT EXISTS `utiliser` (
  `idService` int NOT NULL,
  `idPiece` int NOT NULL,
  `quantite` int DEFAULT NULL,
  PRIMARY KEY (`idService`,`idPiece`),
  KEY `idPiece` (`idPiece`),
  CONSTRAINT `utiliser_ibfk_1` FOREIGN KEY (`idService`) REFERENCES `reparations` (`idService`),
  CONSTRAINT `utiliser_ibfk_2` FOREIGN KEY (`idPiece`) REFERENCES `piecesdetachees` (`idPiece`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table monprecieuxvelo.utiliser : ~12 rows (environ)
/*!40000 ALTER TABLE `utiliser` DISABLE KEYS */;
INSERT INTO `utiliser` (`idService`, `idPiece`, `quantite`) VALUES
	(5, 3, 1),
	(5, 4, 2),
	(5, 11, 1),
	(5, 12, 1),
	(5, 15, 1),
	(6, 4, 0),
	(6, 5, 1),
	(6, 6, 1),
	(6, 12, 2),
	(6, 16, 1),
	(7, 12, 3),
	(7, 21, 1);
/*!40000 ALTER TABLE `utiliser` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
