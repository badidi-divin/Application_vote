-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 17 juin 2020 à 08:09
-- Version du serveur :  10.1.36-MariaDB
-- Version de PHP :  7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gest_pharma`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_categorie`
--

CREATE TABLE `t_categorie` (
  `id_cat` int(11) NOT NULL,
  `lib_cat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_commandes`
--

CREATE TABLE `t_commandes` (
  `id_cmd` int(11) NOT NULL,
  `ref_cmd` varchar(50) NOT NULL,
  `ref_prod` int(11) NOT NULL,
  `total_mont` int(11) NOT NULL,
  `reduct` int(11) NOT NULL,
  `date_cmd` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_ligne_cmd`
--

CREATE TABLE `t_ligne_cmd` (
  `id_lgne` int(11) NOT NULL,
  `ref_cmd` varchar(100) NOT NULL,
  `ref_prod` varchar(100) NOT NULL,
  `desi_prod` varchar(100) NOT NULL,
  `prix_unit` int(11) NOT NULL,
  `qte_achet` int(11) NOT NULL,
  `prix_total` int(11) NOT NULL,
  `reduct` int(11) NOT NULL,
  `mont_verse` double NOT NULL,
  `mont_rendu` int(11) NOT NULL,
  `montant_rendu` int(11) NOT NULL,
  `total_fact` int(11) NOT NULL,
  `creer_le` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_panier`
--

CREATE TABLE `t_panier` (
  `id_pn` int(11) NOT NULL,
  `ref_cmd` varchar(100) NOT NULL,
  `ref_prod` varchar(100) NOT NULL,
  `desi_prod` varchar(100) NOT NULL,
  `prix_unit` int(11) NOT NULL,
  `qte_achet` int(11) NOT NULL,
  `stock_prod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_pharma`
--

CREATE TABLE `t_pharma` (
  `id` int(11) NOT NULL,
  `nom_pharma` int(11) NOT NULL,
  `adrs` varchar(100) NOT NULL,
  `tel` varchar(100) NOT NULL,
  `e_mail` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_produits`
--

CREATE TABLE `t_produits` (
  `id` int(11) NOT NULL,
  `ref_prod` varchar(30) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `dci` varchar(100) NOT NULL,
  `frm_dos` varchar(100) NOT NULL,
  `prix_gros` double NOT NULL,
  `prix_unit` double NOT NULL,
  `stock` int(10) NOT NULL,
  `date_prod` varchar(15) NOT NULL,
  `date_expirat` varchar(15) NOT NULL,
  `fabricant` varchar(100) NOT NULL,
  `date_creat` varchar(25) NOT NULL,
  `categ` int(10) NOT NULL,
  `Lib_cat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_user`
--

CREATE TABLE `t_user` (
  `id_cmd` int(11) NOT NULL,
  `nom_ut` varchar(100) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `fonction` varchar(100) NOT NULL,
  `Pharma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_user`
--

INSERT INTO `t_user` (`id_cmd`, `nom_ut`, `pass`, `nom`, `fonction`, `Pharma`) VALUES
(1, 'admin2020', '1234567', '', '', 0);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_facture`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `vue_facture` (
`id_pn` int(11)
,`ref_cmd` varchar(100)
,`ref_prod` varchar(100)
,`desi_prod` varchar(100)
,`prix_unit` int(11)
,`qte_achet` int(11)
,`stock_prod` int(11)
,`total_qte` bigint(21)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_rapport_ventes`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `vue_rapport_ventes` (
`ref_prod` varchar(30)
,`desi_prod` varchar(100)
,`prix_unit` double
,`stock` int(10)
,`total_qte` decimal(32,0)
,`Prix_total` double
,`creer_le` datetime
);

-- --------------------------------------------------------

--
-- Structure de la vue `vue_facture`
--
DROP TABLE IF EXISTS `vue_facture`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_facture`  AS  select `t_panier`.`id_pn` AS `id_pn`,`t_panier`.`ref_cmd` AS `ref_cmd`,`t_panier`.`ref_prod` AS `ref_prod`,`t_panier`.`desi_prod` AS `desi_prod`,`t_panier`.`prix_unit` AS `prix_unit`,`t_panier`.`qte_achet` AS `qte_achet`,`t_panier`.`stock_prod` AS `stock_prod`,(`t_panier`.`qte_achet` * `t_panier`.`prix_unit`) AS `total_qte` from `t_panier` ;

-- --------------------------------------------------------

--
-- Structure de la vue `vue_rapport_ventes`
--
DROP TABLE IF EXISTS `vue_rapport_ventes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_rapport_ventes`  AS  select `t_produits`.`ref_prod` AS `ref_prod`,`t_ligne_cmd`.`desi_prod` AS `desi_prod`,`t_produits`.`prix_unit` AS `prix_unit`,`t_produits`.`stock` AS `stock`,sum(`t_ligne_cmd`.`qte_achet`) AS `total_qte`,(`t_produits`.`prix_unit` * sum(`t_ligne_cmd`.`qte_achet`)) AS `Prix_total`,`t_ligne_cmd`.`creer_le` AS `creer_le` from (`t_ligne_cmd` join `t_produits`) where (`t_produits`.`ref_prod` = `t_ligne_cmd`.`ref_prod`) group by `t_ligne_cmd`.`ref_prod` order by `t_ligne_cmd`.`desi_prod` ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_categorie`
--
ALTER TABLE `t_categorie`
  ADD PRIMARY KEY (`id_cat`);

--
-- Index pour la table `t_commandes`
--
ALTER TABLE `t_commandes`
  ADD PRIMARY KEY (`id_cmd`);

--
-- Index pour la table `t_ligne_cmd`
--
ALTER TABLE `t_ligne_cmd`
  ADD PRIMARY KEY (`id_lgne`),
  ADD KEY `id_lgne` (`id_lgne`);

--
-- Index pour la table `t_panier`
--
ALTER TABLE `t_panier`
  ADD PRIMARY KEY (`id_pn`);

--
-- Index pour la table `t_produits`
--
ALTER TABLE `t_produits`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ref_prod` (`ref_prod`);

--
-- Index pour la table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id_cmd`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_categorie`
--
ALTER TABLE `t_categorie`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `t_commandes`
--
ALTER TABLE `t_commandes`
  MODIFY `id_cmd` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_ligne_cmd`
--
ALTER TABLE `t_ligne_cmd`
  MODIFY `id_lgne` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT pour la table `t_panier`
--
ALTER TABLE `t_panier`
  MODIFY `id_pn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `t_produits`
--
ALTER TABLE `t_produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT pour la table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id_cmd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
