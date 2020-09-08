-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  mer. 24 juin 2020 à 15:50
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `calculator_batitom_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `devis`
--

DROP TABLE IF EXISTS `devis`;
CREATE TABLE IF NOT EXISTS `devis` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `devisDate` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ibfc_Devis_1` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=781 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `devis`
--

INSERT INTO `devis` (`id`, `user_id`, `devisDate`) VALUES
(500, NULL, '2020-02-27'),
(501, NULL, '2020-02-28'),
(780, NULL, '2020-06-23');

-- --------------------------------------------------------

--
-- Structure de la table `devisdetails`
--

DROP TABLE IF EXISTS `devisdetails`;
CREATE TABLE IF NOT EXISTS `devisdetails` (
  `devis_id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `priceEach` float DEFAULT NULL,
  `piece` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  KEY `ibfc_DevisDetails_1` (`devis_id`),
  KEY `ibfc_DevisDetails_2` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `devisdetails`
--

INSERT INTO `devisdetails` (`devis_id`, `question_id`, `quantity`, `priceEach`, `piece`) VALUES
(500, 16, 25, NULL, ''),
(500, 26, 25, NULL, ''),
(500, 29, 14, NULL, ''),
(500, 9, 1, NULL, ''),
(500, 10, 1, NULL, ''),
(500, 11, 1, NULL, ''),
(500, 34, 14, NULL, ''),
(500, 36, 20, NULL, ''),
(500, 41, 1, NULL, ''),
(500, 51, 1, NULL, ''),
(500, 18, 1, NULL, ''),
(501, 15, 26, NULL, ''),
(501, 28, 26, NULL, ''),
(501, 30, 8, NULL, ''),
(501, 9, 1, NULL, ''),
(501, 12, 1, NULL, ''),
(501, 21, 1, NULL, ''),
(501, 33, 8, NULL, ''),
(501, 58, 8, NULL, ''),
(501, 36, 27, NULL, ''),
(501, 39, 1, NULL, ''),
(501, 40, 1, NULL, ''),
(501, 51, 1, NULL, ''),
(780, 9, 1, NULL, 'sdb');

-- --------------------------------------------------------

--
-- Structure de la table `formquestion`
--

DROP TABLE IF EXISTS `formquestion`;
CREATE TABLE IF NOT EXISTS `formquestion` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `formquestion`
--

INSERT INTO `formquestion` (`id`, `title`, `category`) VALUES
(9, 'Suppression d\'une douche encastrée', 'suppression'),
(10, 'Suppression cabine de docuhe', 'suppression'),
(11, 'Suppression lavabo', 'suppression'),
(12, 'Suppression meubles de salle de bain', 'suppression'),
(13, 'Suppression bidet', 'suppression'),
(14, 'Carrelage', 'modifier-sol'),
(15, 'Parquet', 'modifier-sol'),
(16, 'Lino/PCV', 'modifier-sol'),
(17, 'Moquette', 'modifier-sol'),
(18, 'Prise electrique', 'installation-electrique'),
(19, 'Eclairage', 'installation-electrique'),
(21, 'Suppression WC', 'suppression'),
(22, 'Suppression WC suspendus', 'suppression'),
(23, 'Suppression radiateur éléctrique', 'suppression'),
(24, 'Suppression radiateur eau chaude', 'suppression'),
(25, 'Carrelage', 'sol-nouveau'),
(26, 'Parquet', 'sol-nouveau'),
(27, 'Lino/PCV', 'sol-nouveau'),
(28, 'Moquette', 'sol-nouveau'),
(29, 'Carrelage', 'mural-actuel'),
(30, 'Peinture', 'mural-actuel'),
(31, 'Mix peinture + carrelage', 'mural-actuel'),
(32, 'Lambris', 'mural-actuel'),
(33, 'Bon état', 'mur-etat'),
(34, 'Etat moyen  (Traces d\'humidité)', 'mur-etat'),
(35, 'Mauvais état (Surface abimée, fissurée)', 'mur-etat'),
(36, 'Bon état', 'plafond-etat'),
(37, 'Etat moyen  (Traces d\'humidité)', 'plafond-etat'),
(38, 'Mauvais état (Surface abimée, fissurée)', 'plafond-etat'),
(39, 'Cabine de douche (Economique)', 'salle de baine equipement'),
(40, 'Douche large vitrée', 'salle de baine equipement'),
(41, 'Douche à l\'italienne (plus chére)', 'salle de baine equipement'),
(42, 'Baignoire', 'salle de baine equipement'),
(43, 'Baignoire d\'angle (Plus chére qu\'une baignoire standard)', 'salle de baine equipement'),
(44, 'Baignoire balnéo (Solution la plus chére)', 'salle de baine equipement'),
(45, 'Lavabo posé', 'salle de baine equipement'),
(46, 'Lavabo suspendu (plus cher qu\'un lavabo posé)', 'salle de baine equipement'),
(47, 'Lavabo double vasques', 'salle de baine equipement'),
(48, 'WC', 'salle de baine equipement'),
(49, 'WC suspendu (Plus chers)', 'salle de baine equipement'),
(50, 'Séche-serviette', 'salle de baine equipement'),
(51, 'Je souhaite nettoyer et remettre à neuf la ventilation actuelle', 'ventilation'),
(52, 'Je souhaite poser une nouvelle ventllation', 'ventilation'),
(53, 'Pas de modification de la ventilation', 'ventilation'),
(56, 'Raccordement machine à laver', 'installation-electrique'),
(57, 'Carrelage', 'mur-nouveau'),
(58, 'Peinture', 'mur-nouveau'),
(59, 'Mix peinture + carrelage', 'sol-nouveau'),
(60, 'cloison', 'cloison'),
(62, 'oui', 'point-en-eau'),
(63, 'non', 'point-en-eau'),
(64, 'entre 1000 - 3000', 'pose-cuisine'),
(65, 'entre 3000 - 6000', 'pose-cuisine'),
(66, 'entre 6000 - 10 000', 'pose-cuisine'),
(67, 'plus de 10 000', 'pose-cuisine');

-- --------------------------------------------------------

--
-- Structure de la table `formquestion_pricelist`
--

DROP TABLE IF EXISTS `formquestion_pricelist`;
CREATE TABLE IF NOT EXISTS `formquestion_pricelist` (
  `pricelist_id` int(10) UNSIGNED DEFAULT NULL,
  `formquestion_id` int(10) UNSIGNED NOT NULL,
  KEY `ibfc_FormQuestion_ListeDePrix_1` (`formquestion_id`),
  KEY `ibfc_FormQuestion_ListeDePrix_2` (`pricelist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `formquestion_pricelist`
--

INSERT INTO `formquestion_pricelist` (`pricelist_id`, `formquestion_id`) VALUES
(13, 9),
(14, 10),
(17, 11),
(18, 12),
(19, 13),
(20, 21),
(21, 22),
(22, 23),
(23, 24),
(24, 14),
(25, 15),
(26, 16),
(27, 17),
(30, 25),
(31, 26),
(35, 18),
(39, 29),
(39, 31),
(41, 32),
(42, 34),
(43, 35),
(45, 58),
(46, 57),
(46, 59),
(48, 37),
(49, 38),
(51, 39),
(52, 40),
(53, 40),
(53, 41),
(54, 40),
(54, 41),
(54, 43),
(55, 41),
(58, 42),
(59, 42),
(59, 43),
(60, 42),
(60, 43),
(61, 44),
(62, 45),
(63, 46),
(64, 47),
(65, 48),
(67, 49),
(68, 50),
(69, 51),
(69, 52),
(71, 56),
(73, 60),
(75, 62),
(75, 63),
(77, 64),
(78, 65),
(79, 66),
(79, 67);

-- --------------------------------------------------------

--
-- Structure de la table `pricelist`
--

DROP TABLE IF EXISTS `pricelist`;
CREATE TABLE IF NOT EXISTS `pricelist` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` float NOT NULL,
  `dontFurniture` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `bym2` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `pricelist`
--

INSERT INTO `pricelist` (`id`, `description`, `category`, `price`, `dontFurniture`, `bym2`, `title`) VALUES
(13, 'Compris : mise en décharge, bouchonnage des réseaux.', NULL, 130, '', 1, 'Dépose de douche encastrée et de parois'),
(14, 'Compris : mise en décharge, bouchonnage des réseaux.', NULL, 122, '', 0, 'Dépose de cabine de douche'),
(15, 'Compris : mise en décharge, bouchonnage des réseaux.', NULL, 90, '', 0, 'Dépose de baignoire en acrylique'),
(16, 'Compris : mise en décharge, bouchonnage des réseaux.', NULL, 90, '', 0, 'Dépose de lavabo sur colonne (simple ou double)'),
(17, 'Compris : évacuation et mise en décharge, bouchonnage des réseaux.', NULL, 86, '', 0, 'Dépose de lavabo sur colonne (simple ou double)'),
(18, 'évacuation et mise en décharge, bouchonnage des réseaux', NULL, 70, '', 0, 'Dépose de meuble vasque de salle de bains (simple ou double)'),
(19, 'Compris : évacuation et mise en décharge, bouchonnage des réseaux.', NULL, 79, '', 0, 'Dépose de bidet'),
(20, 'Compris: évacuation et mise en décharge, bouchonnage des réseaux.', NULL, 120, '', 0, 'Dépose de bloc WC'),
(21, 'Compris : démolition du coffrage en plaque de plâtre, évacuation et mise en décharge, bouchonnage des réseaux.', NULL, 155, '', 0, 'Dépose de WC suspendus, bâti-support et réservoir encastré'),
(22, 'Compris : évacuation et mise en décharge.', NULL, 30, '', 0, 'Dépose de radiateur électrique'),
(23, 'Compris : mise en décharge, bouchonnage des réseaux.', NULL, 85, '', 0, 'Dépose de radiateur à eau chaude'),
(24, 'Compris : évacuation et mise en décharge.', NULL, 16, '', 1, 'Dépose de carrelage au sol'),
(25, 'Compris : évacuation et mise en décharge.', NULL, 13, '', 1, 'Dépose de parquet flottant'),
(26, 'Compris : évacuation et mise en décharge.', NULL, 5, '', 0, 'Dépose de sol vinyle - PVC'),
(27, 'Compris : évacuation et mise en décharge.', NULL, 10, '', 1, 'Dépose de moquette collée'),
(30, 'Compris : colle, joints.', NULL, 93, '40', 1, 'Fourniture et pose de carrelage au sol'),
(31, 'Parement chêne, chataigner ou hêtre. Non compris : sous-couche isolante. La pose collée est plus chère mais plus insonorisante et durable que la pose flottante - clipsable. Le parquet doit être entreposé à température ambiante pendant 48 h avant la pose.\r', NULL, 93, '40 ', 1, 'Fourniture et pose de parquet contrecollé en pose collée'),
(35, 'La référence chiffrée est Dooxie de Legrand ou équivalent.\r\nNon compris : câblage et création de l\'arrivée électrique.', NULL, 28, '13', 1, 'Fourniture et pose de prise de courant simple'),
(39, 'Compris : évacuation et mise en décharge, rebouchage et mastiquage des irrégularités, passage d\'un enduit de lissage.', NULL, 16, '', 1, 'Dépose de carrelage mural - faïence'),
(41, 'Compris : évacuation et mise en décharge.', NULL, 8, '', 1, 'Dépose de lambris collé - pointés'),
(42, 'Grattage des parties écaillées, ouverture des trous et fissures, impression, 2 à 3 passes d\'enduit croisées (afin de bien lisser le support) avec ponçage intermédiaire. Bandes (calicot) sur les fissures importantes. ', NULL, 20, '', 1, 'Préparation complète des murs'),
(43, 'Grattage des parties écaillées, ouverture des trous et fissures, impression, Fiss Net (toile à enduire afin d\'éviter la réapparition de fissures), 3 passes d\'enduit croisées (afin de bien lisser le support) avec ponçage intermédiaire.', NULL, 28, '', 1, 'Préparation complète des murs avec entoilage'),
(44, 'Compris : colle, joints.', NULL, 85, '', 1, 'Fourniture et pose de carrelage mural - faïence'),
(45, 'Sous-couche puis 2 couches de peinture satinée, hydrofuge pour les pièces humides. Peinture Seigneurie, Guittet, Tollens ou similaire. La peinture satinée renvoie la lumière et est facilement lessivable mais nécessite une bonne préparation du support au r', NULL, 19, '', 1, 'Peinture murale satinée sur fond préparé'),
(46, 'Compris : colle, joints.', NULL, 50, '', 1, 'Fourniture et pose de carrelage mural - faïence'),
(47, 'Sous-couche puis 2 couches de peinture mate, hydrofuge pour les pièces humides. Peinture Seigneurie, Guittet, Tollens ou similaire. La peinture mate ne renvoie pas la lumière et masque donc les défauts du support, par contre elle est difficilement lessiva', NULL, 21, '', 1, 'Peinture plafonds mate sur fonds préparé'),
(48, 'Grattage des parties écaillées, ouverture des trous et fissures, impression, 2 à 3 passes d\'enduit croisées (afin de bien lisser le support) avec ponçage intermédiaire. Bandes (calicot) sur les fissures importantes. Il est recommandé de mettre une toile à', NULL, 22, '', 1, 'Préparation complète des plafonds'),
(49, 'Grattage des parties écaillées, ouverture des trous et fissures, impression, Fiss Net (toile à enduire afin d\'éviter la réapparition de fissures), 3 passes d\'enduit croisées (afin de bien lisser le support) avec ponçage intermédiaire.', NULL, 32, '', 1, 'Préparation complète des plafonds avec entoilage'),
(50, 'Compris : évacuation et mise en décharge.', NULL, 38, '', 1, 'Démolition de cloison en placoplatre + isolant'),
(51, 'Installation comprenant receveur, ossature en aluminium, portes et parois en verre, mitigeur thermostatique, douchette, flexible et barre de douche.', NULL, 900, '', 0, 'Fourniture et pose de cabine de douche'),
(52, '', NULL, 430, '150', 0, 'Fourniture et pose de receveur de douche extra-plat en acrylique'),
(53, '', NULL, 350, '', 0, 'Fourniture et pose de paroi de douche en verre securit'),
(54, 'Installation comprenant mitigeur, rampe, pomme et douchette.', NULL, 450, '300', 0, 'Fourniture et pose de colonne de douche avec mitigeur'),
(55, 'Compris : surélévation, fixation, étanchéité.', NULL, 700, '350', 0, 'Fourniture et pose de receveur de douche à carreler de marque WEDI'),
(56, '', NULL, 540, '350', 0, 'Fourniture et pose de paroi de douche en verre securit'),
(57, 'Installation comprenant mitigeur, rampe, pomme et douchette.', NULL, 450, '300', 0, 'Fourniture et pose de colonne de douche avec mitigeur'),
(58, 'Baignoire en matériaux de synthèse, compris calage, mise à niveau, fixations.', NULL, 648, '330', 0, 'Fourniture et pose de baignoire droite'),
(59, '', NULL, 450, '300', 0, 'Fourniture et pose de colonne de douche avec mitigeur pour baignoire'),
(60, 'Compris : trappe d\'accès pour effectuer les raccordements de plomberie et l\'entretien.', NULL, 370, '170', 0, 'Fourniture et pose de tablier de baignoire à carreler'),
(61, 'Compris : calage, mise à niveau, fixations, avec raccordements d\'alimentation.', NULL, 1800, '900', 0, 'Fourniture et pose de baignoire balnéo'),
(62, 'Non compris : mitigeur.', NULL, 590, '440', 0, 'Fourniture et pose de meuble de salle de bain simple vasque'),
(63, 'Non compris : mitigeur.', NULL, 350, '250', 0, 'Fourniture et pose de lavabo suspendu'),
(64, 'Non compris : mitigeurs.', NULL, 700, '550', 0, 'Fourniture et pose de meuble de salle de bain double vasque'),
(65, 'Compris : raccordements d\'alimentation et d\'évacuation.', NULL, 550, '250', 0, 'Fourniture et pose de bloc WC'),
(66, 'Cuvette sur bâti support de marque Geberit et réservoir encastré à commande mécanique par plaque murale.\r\nNon compris : coffrage en placo.', NULL, 825, '350', 0, 'Fourniture et pose de WC suspendus + réservoir encastré'),
(67, 'Cuvette sur bâti support de marque Geberit et réservoir encastré à commande mécanique par plaque murale.\r\nNon compris : coffrage en placo.', NULL, 825, '350', 0, 'Fourniture et pose de WC suspendus + réservoir encastré'),
(68, '', NULL, 300, '200', 0, 'Fourniture et pose de sèche-serviette électrique'),
(69, 'Compris : raccordement sur gaine de ventilation existante.', NULL, 900, '', 0, 'Fourniture et pose de VMC simple flux'),
(70, 'Compris : raccordement sur gaine de ventilation existante.', NULL, 900, '', 0, 'Fourniture et pose de VMC simple flux'),
(71, 'Robinet d\'arrivée d\'eau et siphon de vidange.', NULL, 220, '', 0, 'Création d\'attente eau froide + évacuation pour lave-vaisselle ou lave-linge'),
(73, 'Compris : évacuation et mise en décharge.', NULL, 38, '', 1, 'Démolition de cloison en placoplatre + isolant'),
(75, '', NULL, 50, '', 0, 'création ou déplacement un point en eau'),
(76, '', NULL, 30, '', 0, 'création ou déplacement un point en electricité'),
(77, '', NULL, 500, '', 0, 'pose d\'elements de cuisine fornis d\'un valor total entre 1000 - 3000'),
(78, '', NULL, 1000, '', 0, 'pose d\'elements de cuisine fornis d\'un valor total entre 3000 - 6000'),
(79, '', NULL, 1500, '', 0, 'pose d\'elements de cuisine fornis d\'un valor total entre 6000 - 10 000'),
(80, '', NULL, 2000, '', 0, 'pose d\'elements de cuisine fornis d\'un valor total plus de 10');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `forname` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `lastLoginDate` datetime DEFAULT NULL,
  `numTel` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pwd` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `signInDate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`, `forname`, `email`, `isAdmin`, `lastLoginDate`, `numTel`, `pwd`, `signInDate`) VALUES
(1, 'Niewiadomska', 'Marta', 'martaen@gmail.com', 1, NULL, '2222222222222222', '$2y$10$FzGv6z5gE4Bc/sZK/S/ZEOhip7u4kA7rDE3vcTplhL6aA/VZDXxoS', '2020-01-15 14:41:13');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `devis`
--
ALTER TABLE `devis`
  ADD CONSTRAINT `ibfc_Devis_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `devisdetails`
--
ALTER TABLE `devisdetails`
  ADD CONSTRAINT `ibfc_DevisDetails_1` FOREIGN KEY (`devis_id`) REFERENCES `devis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ibfc_DevisDetails_2` FOREIGN KEY (`question_id`) REFERENCES `formquestion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `formquestion_pricelist`
--
ALTER TABLE `formquestion_pricelist`
  ADD CONSTRAINT `ibfc_FormQuestion_ListeDePrix_1` FOREIGN KEY (`formquestion_id`) REFERENCES `formquestion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ibfc_FormQuestion_ListeDePrix_2` FOREIGN KEY (`pricelist_id`) REFERENCES `pricelist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
