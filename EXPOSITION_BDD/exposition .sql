-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 31 mai 2020 à 14:05
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `exposition`
--

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `delete_arrivee_of_exposition`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_arrivee_of_exposition` (IN `param_nom_exposition` VARCHAR(255))  NO SQL
DELETE FROM arrivee WHERE nom_exposition = param_nom_exposition$$

DROP PROCEDURE IF EXISTS `delete_salle_of_exposition`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_salle_of_exposition` (IN `param_nom_exposition` VARCHAR(255))  NO SQL
DELETE FROM salle_exposition WHERE nom_exposition = param_nom_exposition$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `arrivee`
--

DROP TABLE IF EXISTS `arrivee`;
CREATE TABLE IF NOT EXISTS `arrivee` (
  `id_arrivee` int(11) NOT NULL AUTO_INCREMENT,
  `nb_arrivee` int(11) NOT NULL,
  `date_arrivee` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nom_exposition` varchar(255) NOT NULL,
  PRIMARY KEY (`id_arrivee`),
  KEY `nom_exposition` (`nom_exposition`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `exposition`
--

DROP TABLE IF EXISTS `exposition`;
CREATE TABLE IF NOT EXISTS `exposition` (
  `nom_exposition` varchar(255) NOT NULL,
  `descriptif_exposition` varchar(500) NOT NULL,
  `date_debut_d_exposition` date NOT NULL,
  `date_fin_d_exposition` date NOT NULL,
  `nom_organisateur` varchar(255) NOT NULL,
  PRIMARY KEY (`nom_exposition`),
  KEY `nom_organisateur` (`nom_organisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `exposition`
--

INSERT INTO `exposition` (`nom_exposition`, `descriptif_exposition`, `date_debut_d_exposition`, `date_fin_d_exposition`, `nom_organisateur`) VALUES
('6 milliards d\'autres', '5 000 interviews filmées dans 75 pays par les équipes de Yann Arthus-Bertrand pendant 4 ans. Une réflexion sur la diversité humaine et culturelle.', '2009-04-14', '2009-08-30', 'Direction des Champs Libres'),
('BDZH, 35 ans de BD en Bretagne', 'Les différentes étapes et les nombreux acteurs de l\'histoire  de la bande dessinée en Bretagne après l\'essor que lui a donné Jean-Claude Fournier au début des années 1970.', '2006-04-25', '2006-08-19', 'Direction des Champs Libres'),
('Beat Generation / Allen Ginsberg', 'L\'univers du poète américain Allen Ginsberg, fondateur avec Jack Kerouac et William Burroughs de la Beat Generation. En partenariat avec le Centre Pompidou-Metz, Le Fresnoy  et le ZKM de Karlsruhe.', '2013-01-09', '2013-05-31', 'Direction des Champs Libres'),
('Bernard Collet s’affiche au Musée de Bretagne', 'Le travail de Bernard Collet, affichiste et illustrateur contemporain, dont certaines images font partie des collections du musée de Bretagne.', '2008-01-06', '2008-02-15', 'Musée de Bretagne'),
('Boat People, bateaux de l’exil', 'L’exode vietnamien de la fin des années 70 qui illustre la migration des réfugiés de la mer.', '2009-03-12', '2010-02-05', 'Musée de Bretagne'),
('Condemmed_bulbes', 'Une installation sonore et visuelle, du studio de création numérique Artificiel, constituée d\'ampoules incandescentes de 1 000W.', '2012-09-10', '2012-10-21', 'Direction des Champs Libres'),
('Des habits et nous, vêtir nos identités', 'Une collection de vêtements d\'aujourd\'hui et de costumes régionaux qui interroge sur la signification du choix et du port d\'un vêtement.', '2007-01-19', '2007-05-20', 'Musée de Bretagne'),
('Dessins de presse à la Une', 'L’univers du dessin de presse qui informe, dénonce et interroge la société. En partenariat avec la fondation Cartooning for peace - Dessins pour la paix présidée par Plantu.', '2010-06-29', '2011-09-01', 'Direction des Champs Libres'),
('D’hommes et d’argent, orfèvrerie de Haute-Bretagne XV-XVIIIe', 'Les plus belles pièces d\'orfèvrerie civile et religieuse réalisées par les maîtres orfèvres de Haute Bretagne du XVe au XVIIIe siècle.', '2006-10-24', '2007-04-15', 'Musée de Bretagne'),
('Germaine Tillion, ethnologue et résistante', 'Le parcours de Germaine Tillion, grande figure humaniste du XXe siècle connue pour son engagement précoce dans la résistance et ses positions pendant la guerre d\'Algérie. En partenariat avec le Centre d\'histoire de la résistance et de la déportation de Lyon, le musée de l\'Homme et le musée du quai Branly.', '2008-01-24', '2008-04-05', 'Musée de Bretagne'),
('Hommes racines', 'Le parcours photographique mené par Pierre de Vallombreuse à la rencontre de 11 peuples qui entretiennent un rapport singulier avec leur environnement.', '2012-04-26', '2012-09-23', 'Direction des Champs Libres'),
('Horizon 2020', 'Une mise en scène du pays de Rennes en 2020 qui fait participer le visiteur à la construction d\'un \"avenir commun\".', '2006-10-11', '2006-11-26', 'Rennes Métropole'),
('Images d\'Alice au pays des merveilles', 'Les différents moments de la création d\'\"Alice au pays des merveilles\" depuis Lewis Carroll  jusqu\'à neuf illustrateurs contemporains. Une incroyable richesse graphique et chromatique.', '2011-10-25', '2012-10-03', 'Bibliothèque de Rennes Métropole'),
('Images de chantier', 'L\'histoire du chantier des Champs Libres vue par Alain Amet, photographe du musée de Bretagne.', '2006-03-09', '2006-03-28', 'Musée de Bretagne'),
('La Bretagne fait son cinéma', 'Un panorama artistique et historique sur la façon dont le cinéma a filmé la Bretagne et comment il s\'est développé dans la région.', '2011-03-03', '2011-08-28', 'Direction des Champs Libres'),
('La Mer pour Mémoire, archéologie sous-marine des épaves atlantiques', 'Près de 550 pièces majeures issues d’épaves prospectées lors des recherches archéologiques menées depuis 20 ans en Manche et en Atlantique. En partenariat avec l\'association Buhez (Musées et écomusées de Bretagne) et du Ministère de la Culture.', '2007-11-21', '2008-04-27', 'Musée de Bretagne'),
('Le Chat s\'expose', 'L\'univers et le parcours de Philippe Geluck et l\'histoire de son personnage emblèmatique : le Chat.', '2006-01-10', '2006-03-28', 'Direction des Champs Libres'),
('Le roi Arthur, une légende en devenir', 'L’histoire culturelle du mythe arthurien. La naissance, le devenir et l\'universalité de la légende du roi Arthur. En partenariat avec la bibliothèque nationale de France.', '2008-07-15', '2009-04-01', 'Direction des Champs Libres'),
('Les Bretons et l\'argent', 'Une collection de plus de 300 objets met en valeur les comportements individuels et les pratiques collectives des Bretons à l’égard de l’argent.', '2011-10-05', '2011-10-30', 'Musée de Bretagne'),
('Les Mécaniques Poétiques', 'Douze installations numériques interactives sonores et visuelles conçues à partir d\'objets anciens détournés. Une plongée poétique dans l\'univers de Yann Nguema du groupe EZ3kiel', '2012-11-27', '2013-01-27', 'Direction des Champs Libres'),
('Mali au féminin', 'La culture malienne à travers les femmes, éléments moteur de la mutation de la société malienne.', '2010-03-10', '2010-03-16', 'Musée de Bretagne'),
('Migrations Bretagne / Monde', 'Témoignages, documents et films d\'archives éclairent les circonstances et le vécu des émigrés et des immigrés du début du XIXe siècle à nos jours en Bretagne.', '2013-01-09', '2013-03-15', 'Musée de Bretagne'),
('Odorico, mosaïstes art déco', 'L’épopée économique et artistique de l\'entreprise familiale Odorico, depuis l’émigration du nord de l’Italie jusqu’à la production florissante de mosaïque dans l’ouest de la France.', '2009-02-04', '2010-03-01', 'Musée de Bretagne'),
('Pékin 66', '40 photographies de la française Solange Brand qui a vécu en direct la révolution culturelle en Chine et montre la complexité de ces années pour le peuple chinois.', '2006-11-14', '2007-02-14', 'Musée de Bretagne'),
('Peuples', 'Une centaine de photographies de Pierre de Vallombreuse  qui présente 14 peuples autochtones, leurs modes de vie et leurs croyances.', '2007-05-29', '2007-09-30', 'Direction des Champs Libres'),
('Reflets de Bretagne - 160 ans de photographies inédites', '300 tirages issus du fonds photographique du musée de Bretagne proposent une multitude de regards sur la Bretagne et son histoire.', '2012-06-29', '2013-06-01', 'Musée de Bretagne'),
('Rennes en chansons', 'L\'histoire musicale et chantée de Rennes, du 18e siècle à nos jours.', '2010-11-19', '2011-03-13', 'Musée de Bretagne'),
('Soyons fouilles ! Découvertes archéologiques en Bretagne', 'Un regard inédit sur les dernières recherches archéologiques. Grâce aux nouvelles technologies, elles permettent de mieux comprendre le passé de la Bretagne. En partenariat avec le château de la Roche-Jagu (Conseil général des Côtes-d\'Armor), l\'Institut national des recherches archéologiques préventives et le service régional de l\'archéologie (service de l\'Etat).', '2011-12-16', '2012-04-29', 'Musée de Bretagne'),
('Temps perdu / Temps retrouvé', 'Un double parcours au sein de Rennes Métropole et de l\'oeuvre de Marcel Proust : des habitants lisent des extraits d’\"A la Recherche du temps perdu\" devant la caméra de Véronique Aubouy.', '2009-02-17', '2009-03-15', 'Direction des Champs Libres'),
('Travailler du chapeau, les métiers du chapelier et de la modiste', 'Une rétrospective de l\'évolution de la chapellerie au cours du XXe siècle et une découverte des techniques de la fabrication du chapeau.', '2007-05-18', '2007-10-11', 'Musée de Bretagne'),
('Voyager en couleurs', 'Un chapitre de l’histoire de la photographie : les premières photographies en couleur (sur plaque autochrome) prises en Bretagne de 1907 à 1929. En partenariat avec le musée départemental Albert-Kahn (Conseil général des Hauts-de-Seine).', '2007-10-07', '2007-11-18', 'Direction des Champs Libres'),
('XYZT - Les paysages abstraits', 'Dix installations, créées par la compagnie Adrien M / Claire B, explorent des interactions inédites ou exploitent d\'anciennes techniques d\'illusions et déploient un territoire imaginaire.', '2013-03-13', '2013-04-14', 'Direction des Champs Libres');

--
-- Déclencheurs `exposition`
--
DROP TRIGGER IF EXISTS `delete_exposition_arrivee`;
DELIMITER $$
CREATE TRIGGER `delete_exposition_arrivee` BEFORE DELETE ON `exposition` FOR EACH ROW CALL delete_arrivee_of_exposition(old.nom_exposition)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `delete_exposition_salle`;
DELIMITER $$
CREATE TRIGGER `delete_exposition_salle` BEFORE DELETE ON `exposition` FOR EACH ROW CALL delete_salle_of_exposition(old.nom_exposition)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `organisateur`
--

DROP TABLE IF EXISTS `organisateur`;
CREATE TABLE IF NOT EXISTS `organisateur` (
  `nom_organisateur` varchar(255) NOT NULL,
  PRIMARY KEY (`nom_organisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `organisateur`
--

INSERT INTO `organisateur` (`nom_organisateur`) VALUES
('Bibliothèque de Rennes Métropole'),
('Direction des Champs Libres'),
('Musée de Bretagne'),
('Rennes Métropole');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

DROP TABLE IF EXISTS `salle`;
CREATE TABLE IF NOT EXISTS `salle` (
  `nom_salle` varchar(255) NOT NULL,
  PRIMARY KEY (`nom_salle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`nom_salle`) VALUES
('Conti'),
('Creston'),
('Rivière');

-- --------------------------------------------------------

--
-- Structure de la table `salle_exposition`
--

DROP TABLE IF EXISTS `salle_exposition`;
CREATE TABLE IF NOT EXISTS `salle_exposition` (
  `nom_exposition` varchar(255) NOT NULL,
  `nom_salle` varchar(255) NOT NULL,
  PRIMARY KEY (`nom_exposition`,`nom_salle`),
  KEY `nom_salle` (`nom_salle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `salle_exposition`
--

INSERT INTO `salle_exposition` (`nom_exposition`, `nom_salle`) VALUES
('6 milliards d\'autres', 'Conti'),
('Beat Generation / Allen Ginsberg', 'Conti'),
('Boat People, bateaux de l’exil', 'Conti'),
('Condemmed_bulbes', 'Conti'),
('Des habits et nous, vêtir nos identités', 'Conti'),
('Dessins de presse à la Une', 'Conti'),
('Germaine Tillion, ethnologue et résistante', 'Conti'),
('Hommes racines', 'Conti'),
('Horizon 2020', 'Conti'),
('Images d\'Alice au pays des merveilles', 'Conti'),
('La Bretagne fait son cinéma', 'Conti'),
('Le Chat s\'expose', 'Conti'),
('Le roi Arthur, une légende en devenir', 'Conti'),
('Les Mécaniques Poétiques', 'Conti'),
('Temps perdu / Temps retrouvé', 'Conti'),
('Voyager en couleurs', 'Conti'),
('XYZT - Les paysages abstraits', 'Conti'),
('Bernard Collet s’affiche au Musée de Bretagne', 'Creston'),
('Images de chantier', 'Creston'),
('La Mer pour Mémoire, archéologie sous-marine des épaves atlantiques', 'Creston'),
('Le roi Arthur, une légende en devenir', 'Creston'),
('Les Bretons et l\'argent', 'Creston'),
('Mali au féminin', 'Creston'),
('Migrations Bretagne / Monde', 'Creston'),
('Odorico, mosaïstes art déco', 'Creston'),
('Pékin 66', 'Creston'),
('Reflets de Bretagne - 160 ans de photographies inédites', 'Creston'),
('Rennes en chansons', 'Creston'),
('Soyons fouilles ! Découvertes archéologiques en Bretagne', 'Creston'),
('Travailler du chapeau, les métiers du chapelier et de la modiste', 'Creston'),
('BDZH, 35 ans de BD en Bretagne', 'Rivière'),
('D’hommes et d’argent, orfèvrerie de Haute-Bretagne XV-XVIIIe', 'Rivière'),
('La Mer pour Mémoire, archéologie sous-marine des épaves atlantiques', 'Rivière'),
('Le roi Arthur, une légende en devenir', 'Rivière'),
('Les Bretons et l\'argent', 'Rivière'),
('Mali au féminin', 'Rivière'),
('Migrations Bretagne / Monde', 'Rivière'),
('Odorico, mosaïstes art déco', 'Rivière'),
('Peuples', 'Rivière'),
('Reflets de Bretagne - 160 ans de photographies inédites', 'Rivière'),
('Rennes en chansons', 'Rivière'),
('Soyons fouilles ! Découvertes archéologiques en Bretagne', 'Rivière');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `arrivee`
--
ALTER TABLE `arrivee`
  ADD CONSTRAINT `arrivee_ibfk_1` FOREIGN KEY (`nom_exposition`) REFERENCES `exposition` (`nom_exposition`);

--
-- Contraintes pour la table `exposition`
--
ALTER TABLE `exposition`
  ADD CONSTRAINT `exposition_ibfk_1` FOREIGN KEY (`nom_organisateur`) REFERENCES `organisateur` (`nom_organisateur`);

--
-- Contraintes pour la table `salle_exposition`
--
ALTER TABLE `salle_exposition`
  ADD CONSTRAINT `salle_exposition_ibfk_1` FOREIGN KEY (`nom_salle`) REFERENCES `salle` (`nom_salle`),
  ADD CONSTRAINT `salle_exposition_ibfk_2` FOREIGN KEY (`nom_exposition`) REFERENCES `exposition` (`nom_exposition`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
