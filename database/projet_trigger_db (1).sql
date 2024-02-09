-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 09 fév. 2024 à 15:59
-- Version du serveur : 5.7.40
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_trigger_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `audit_dep`
--

DROP TABLE IF EXISTS `audit_dep`;
CREATE TABLE IF NOT EXISTS `audit_dep` (
  `id_audit` int(11) NOT NULL AUTO_INCREMENT,
  `type_action` varchar(50) DEFAULT NULL,
  `date_operation` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_dep` int(11) DEFAULT NULL,
  `nom_etab` varchar(50) DEFAULT NULL,
  `ancien_dep` int(11) DEFAULT NULL,
  `nouveau_dep` int(11) DEFAULT NULL,
  `utilisateur` varchar(50) NOT NULL,
  PRIMARY KEY (`id_audit`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `audit_dep`
--

INSERT INTO `audit_dep` (`id_audit`, `type_action`, `date_operation`, `id_dep`, `nom_etab`, `ancien_dep`, `nouveau_dep`, `utilisateur`) VALUES
(1, 'Suppression depense', '2024-02-09 12:54:21', 11, 'ENS', 222, 0, 'Admin'),
(2, 'Nouveau depense', '2024-02-09 12:55:22', 13, 'ENS', 0, 300, 'Admin'),
(3, 'Nouveau depense', '2024-02-09 12:56:18', 14, 'ENS', 300, 200, 'Admin'),
(4, 'Modification depense', '2024-02-09 12:57:47', 14, 'ENS', 200, 100, 'Admin'),
(5, 'Modification depense', '2024-02-09 12:58:28', 14, 'ENS', 100, 300, 'Admin');

-- --------------------------------------------------------

--
-- Structure de la table `depense`
--

DROP TABLE IF EXISTS `depense`;
CREATE TABLE IF NOT EXISTS `depense` (
  `id_dep` int(11) NOT NULL AUTO_INCREMENT,
  `id_etab` int(11) DEFAULT NULL,
  `dep` int(11) DEFAULT NULL,
  `utilisateur` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_dep`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `depense`
--

INSERT INTO `depense` (`id_dep`, `id_etab`, `dep`, `utilisateur`) VALUES
(14, 2, 300, 'Admin'),
(13, 2, 300, 'Admin');

--
-- Déclencheurs `depense`
--
DROP TRIGGER IF EXISTS `MAJ_depense`;
DELIMITER $$
CREATE TRIGGER `MAJ_depense` AFTER INSERT ON `depense` FOR EACH ROW BEGIN
    DECLARE ancien_dep DECIMAL(10,2);

    -- Sélectionner la dernière dépense pour cet établissement
    SELECT dep INTO ancien_dep
    FROM depense
    WHERE id_etab = NEW.id_etab
    AND id_dep < (
    SELECT MAX(id_dep)
    FROM depense
    WHERE id_etab = NEW.id_etab)
    ORDER BY id_dep DESC
    LIMIT 1;

    -- Si aucune dépense précédente, initialiser ancien_dep à 0
    IF ancien_dep IS NULL THEN
        SET ancien_dep = 0;
    END IF;

    -- Mettre à jour le budget de l'établissement
    UPDATE etablissement
    SET budget = budget - NEW.dep
    WHERE id_etab = NEW.id_etab;

    -- Insérer dans la table d'audit
    INSERT INTO audit_dep (type_action, date_operation, id_dep, nom_etab, ancien_dep, nouveau_dep, utilisateur)
    VALUES ('Nouveau depense', NOW(), NEW.id_dep, (SELECT nom_etab FROM etablissement WHERE id_etab = NEW.id_etab), ancien_dep, NEW.dep, NEW.utilisateur);
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `delete`;
DELIMITER $$
CREATE TRIGGER `delete` BEFORE DELETE ON `depense` FOR EACH ROW BEGIN
	DECLARE ancien_dep DECIMAL(10,2);    
	-- Sélectionner la dernière dépense pour cet établissement
    SELECT dep INTO ancien_dep
    FROM depense
    WHERE id_etab = OLD.id_etab
    ORDER BY id_dep DESC
    LIMIT 1;
    
    -- Si aucune dépense précédente, initialiser ancien_dep à 0
    IF ancien_dep IS NULL THEN
        SET ancien_dep = 0;
    END IF;

    -- Mettre à jour le budget de l'établissement
    UPDATE etablissement
    SET budget = budget + OLD.dep
    WHERE id_etab = OLD.id_etab;
    
    -- Insérer dans la table d'audit
    INSERT INTO audit_dep (type_action, date_operation, id_dep, nom_etab, ancien_dep, nouveau_dep, utilisateur)
    VALUES ('Suppression depense', NOW(), OLD.id_dep, (SELECT nom_etab FROM etablissement WHERE id_etab = OLD.id_etab), OLD.dep, 0, OLD.utilisateur);
    
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update`;
DELIMITER $$
CREATE TRIGGER `update` BEFORE UPDATE ON `depense` FOR EACH ROW BEGIN
	DECLARE ancien_dep DECIMAL(10,2);
    DECLARE nouveau_dep DECIMAL(10,2);
    DECLARE diff_dep DECIMAL(10,2);
    SET diff_dep = OLD.dep - NEW.dep;
	-- Sélectionner la dernière dépense pour cet établissement
    SELECT dep INTO ancien_dep
    FROM depense
    WHERE id_etab = NEW.id_etab
    ORDER BY id_dep DESC
    LIMIT 1;
    
    -- Si aucune dépense précédente, initialiser ancien_dep à 0
    IF ancien_dep IS NULL THEN
        SET ancien_dep = 0;
    END IF;

    -- Mettre à jour le budget de l'établissement
    UPDATE etablissement
    SET budget = budget + diff_dep
    WHERE id_etab = NEW.id_etab;
    
    -- Insérer dans la table d'audit
    INSERT INTO audit_dep (type_action, date_operation, id_dep, nom_etab, ancien_dep, nouveau_dep, utilisateur)
    VALUES ('Modification depense', NOW(), NEW.id_dep, (SELECT nom_etab FROM etablissement WHERE id_etab = NEW.id_etab), OLD.dep, NEW.dep, NEW.utilisateur);
    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `etablissement`
--

DROP TABLE IF EXISTS `etablissement`;
CREATE TABLE IF NOT EXISTS `etablissement` (
  `id_etab` int(11) NOT NULL AUTO_INCREMENT,
  `nom_etab` varchar(50) DEFAULT NULL,
  `budget` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_etab`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etablissement`
--

INSERT INTO `etablissement` (`id_etab`, `nom_etab`, `budget`) VALUES
(2, 'ENS', 400);

-- --------------------------------------------------------

--
-- Structure de la table `systemusers`
--

DROP TABLE IF EXISTS `systemusers`;
CREATE TABLE IF NOT EXISTS `systemusers` (
  `su_id` int(11) NOT NULL AUTO_INCREMENT,
  `su_nom` varchar(500) NOT NULL,
  `su_prenom` varchar(250) NOT NULL,
  `su_role` int(1) NOT NULL,
  `su_mail` varchar(256) NOT NULL,
  `su_login` varchar(128) NOT NULL,
  `su_pass` varchar(128) NOT NULL,
  `su_hash` varchar(100) NOT NULL,
  `su_photo` varchar(500) NOT NULL,
  `su_idcard` varchar(300) NOT NULL,
  `su_withidcard` varchar(300) NOT NULL,
  `su_contact1` varchar(20) NOT NULL,
  `su_contact2` varchar(20) NOT NULL,
  `su_isvalid` int(1) NOT NULL DEFAULT '0',
  `su_isactive` int(1) NOT NULL DEFAULT '1' COMMENT '1: is active ; 0: not active',
  `su_secteur` varchar(500) NOT NULL,
  `su_lastconexion` datetime NOT NULL,
  `su_idpromotion` int(11) DEFAULT NULL,
  `su_idclassetc` int(11) NOT NULL,
  `su_idresp` int(11) NOT NULL,
  `su_idclasseopt` int(11) NOT NULL,
  `su_matricule` varchar(50) NOT NULL,
  `su_dob` date NOT NULL,
  `su_pob` varchar(200) NOT NULL,
  `su_pere` varchar(300) NOT NULL,
  `su_contactpere` varchar(25) NOT NULL,
  `su_mere` varchar(300) NOT NULL,
  `su_professionmere` varchar(300) NOT NULL,
  `su_contactmere` varchar(25) NOT NULL,
  `su_baccserie` varchar(25) NOT NULL,
  `su_baccannee` year(4) NOT NULL,
  `su_entreesd` year(4) NOT NULL,
  `su_origine` varchar(300) NOT NULL,
  `su_autresinfos` text NOT NULL,
  `su_inclasse` int(1) NOT NULL,
  `su_idlevel` int(11) NOT NULL,
  `su_inclassetc` int(1) NOT NULL,
  PRIMARY KEY (`su_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `systemusers`
--

INSERT INTO `systemusers` (`su_id`, `su_nom`, `su_prenom`, `su_role`, `su_mail`, `su_login`, `su_pass`, `su_hash`, `su_photo`, `su_idcard`, `su_withidcard`, `su_contact1`, `su_contact2`, `su_isvalid`, `su_isactive`, `su_secteur`, `su_lastconexion`, `su_idpromotion`, `su_idclassetc`, `su_idresp`, `su_idclasseopt`, `su_matricule`, `su_dob`, `su_pob`, `su_pere`, `su_contactpere`, `su_mere`, `su_professionmere`, `su_contactmere`, `su_baccserie`, `su_baccannee`, `su_entreesd`, `su_origine`, `su_autresinfos`, `su_inclasse`, `su_idlevel`, `su_inclassetc`) VALUES
(2, '', 'Admin', 1, '', 'jp', 'jp', '0f41a0b3b760b54df703e860e40fef1c388ed2c5', '', '', '', '', '', 0, 1, '', '2024-02-09 15:53:00', NULL, 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', '', 0000, 0000, '', '', 0, 0, 0),
(6, '', 'Simple Utilisateur', 0, '', 'rakoto', 'rakoto', '454875b48e096aa6a73b678802af3e6379e781dc', '', '', '', '', '', 0, 1, '', '2024-02-09 09:35:00', NULL, 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', '', 0000, 0000, '', '', 0, 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
