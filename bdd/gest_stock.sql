-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  sam. 16 jan. 2021 à 08:38
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
-- Base de données :  `gest_stock`
--

-- --------------------------------------------------------

--
-- Structure de la table `archives`
--

CREATE TABLE `archives` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `fichier_url` varchar(255) NOT NULL,
  `Categorie` int(40) NOT NULL,
  `creer_le` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `archives`
--

INSERT INTO `archives` (`id`, `name`, `fichier_url`, `Categorie`, `creer_le`) VALUES
(27, 'EXAM_LANGAGE C#(MARIE).pdf', 'upload/EXAM_LANGAGE C#(MARIE).pdf', 0, '2020-12-18 15:27:39'),
(28, 'Cv + PORTOFOLIO.pdf', 'upload/Cv + PORTOFOLIO.pdf', 0, '2021-01-04 13:47:03'),
(29, 'OZ_Carto_Fonctionnel_SGMC_2020.pdf', 'upload/OZ_Carto_Fonctionnel_SGMC_2020.pdf', 0, '2021-01-08 15:38:07'),
(30, '20200812-LI_Cn.pdf', 'upload/20200812-LI_Cn.pdf', 0, '2021-01-08 15:38:45');

-- --------------------------------------------------------

--
-- Structure de la table `t_categorie`
--

CREATE TABLE `t_categorie` (
  `id_cat` int(11) NOT NULL,
  `lib_cat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_categorie`
--

INSERT INTO `t_categorie` (`id_cat`, `lib_cat`) VALUES
(4, 'Ordinateurs');

-- --------------------------------------------------------

--
-- Structure de la table `t_cat_cours`
--

CREATE TABLE `t_cat_cours` (
  `id_cat` int(11) NOT NULL,
  `designation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_cat_cours`
--

INSERT INTO `t_cat_cours` (`id_cat`, `designation`) VALUES
(1, 'WEB'),
(3, 'BUREAUTIQUE'),
(4, 'COMPTABILITE'),
(5, 'HISTOIRE');

-- --------------------------------------------------------

--
-- Structure de la table `t_client`
--

CREATE TABLE `t_client` (
  `id_cli` int(11) NOT NULL,
  `client` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_client` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adrs` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `t_client`
--

INSERT INTO `t_client` (`id_cli`, `client`, `nom_client`, `adrs`, `user_id`, `etat`) VALUES
(1, 'PNUD', 'PNUD', 'Kinshasa/Gombe', 'G-STOCK001', 0),
(2, 'PNUD', 'PNUD', 'Kinshasa/Gombe', 'G-STOCK001', 1),
(3, 'ONU', 'ONU', 'KIN', 'G-STOCK001', 0),
(4, 'SEP-CONGO', 'SEP-CONGO', 'Kinshasa/Gombe', 'G-STOCK001', 1);

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
  `id_cli` int(11) NOT NULL,
  `client` varchar(50) NOT NULL,
  `adrs_cli` varchar(50) NOT NULL,
  `ref_prod` varchar(100) NOT NULL,
  `desi_prod` varchar(100) NOT NULL,
  `prix_unit` double DEFAULT NULL,
  `qte_achet` int(11) NOT NULL,
  `unite` varchar(30) NOT NULL,
  `prix_total` double NOT NULL,
  `devise` varchar(12) NOT NULL,
  `reduct` int(11) NOT NULL,
  `mont_verse` double NOT NULL,
  `mont_rendu` double NOT NULL,
  `montant_rendu` double NOT NULL,
  `total_fact` double NOT NULL,
  `creer_le` datetime NOT NULL,
  `type_vente` varchar(45) NOT NULL,
  `user_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_ligne_cmd`
--

INSERT INTO `t_ligne_cmd` (`id_lgne`, `ref_cmd`, `id_cli`, `client`, `adrs_cli`, `ref_prod`, `desi_prod`, `prix_unit`, `qte_achet`, `unite`, `prix_total`, `devise`, `reduct`, `mont_verse`, `mont_rendu`, `montant_rendu`, `total_fact`, `creer_le`, `type_vente`, `user_name`) VALUES
(50, 'CMDE-6601', 0, 'Non defini', 'Non defini', 'ART-939', 'Papier', 20.5, 1, 'PCS', 20.5, 'dollar', 1, 249.1, 1.2455, 0, 247.8545, '2021-01-08 10:43:56', 'FACT', 'ETS-BAHEYKE'),
(51, 'CMDE-6601', 0, 'Non defini', 'Non defini', 'ART-832', 'Beniere', 25.4, 9, 'PCS', 225, 'dollar', 1, 249.1, 1.2455, 0, 247.8545, '2021-01-08 10:43:56', 'FACT', 'ETS-BAHEYKE'),
(52, 'CMDE-9398', 0, 'Non defini', 'Non defini', 'ART-797', 'pppppp', 15.5, 1, 'PCS', 15, 'dollar', 1, 40.9, 0.2045, 0, 40.695499999999996, '2021-01-08 10:55:15', 'PROFORMA', 'ETS-BAHEYKE'),
(53, 'CMDE-9398', 0, 'Non defini', 'Non defini', 'ART-832', 'Beniere', 25.4, 1, 'PCS', 25, 'dollar', 1, 40.9, 0.2045, 0, 40.695499999999996, '2021-01-08 10:55:15', 'PROFORMA', 'ETS-BAHEYKE'),
(54, 'CMDE-4817', 0, 'Non defini', 'Non defini', 'ART-939', 'Papier', 20.5, 1, 'PCS', 20, 'dollar', 1, 45.9, 0.2295, 0, 45.6705, '2021-01-08 11:03:22', 'FACT', 'ETS-BAHEYKE'),
(55, 'CMDE-4817', 0, 'Non defini', 'Non defini', 'ART-832', 'Beniere', 25.4, 1, 'PCS', 25, 'dollar', 1, 45.9, 0.2295, 0, 45.6705, '2021-01-08 11:03:22', 'FACT', 'ETS-BAHEYKE'),
(56, 'CMDE-9758', 0, 'Non defini', 'Non defini', 'ART-263', 'Sac', 25, 1, 'PCS', 25, 'dollar', 1, 40.5, 0.2025, 0, 40.2975, '2021-01-08 11:05:11', 'PROFORMA', 'ETS-BAHEYKE'),
(57, 'CMDE-9758', 0, 'Non defini', 'Non defini', 'ART-797', 'pppppp', 15.5, 1, 'PCS', 15, 'dollar', 1, 40.5, 0.2025, 0, 40.2975, '2021-01-08 11:05:11', 'PROFORMA', 'ETS-BAHEYKE'),
(58, 'CMDE-4157', 0, 'Non defini', 'Non defini', 'ART-797', 'pppppp', 15.5, 1, 'PCS', 15, 'dollar', 1, 15.5, 0.077500000000001, 0, 15.4225, '2021-01-08 13:01:10', 'BON', 'ETS-BAHEYKE'),
(59, 'CMDE-5665', 0, 'Non defini', 'Non defini', 'ART-797', 'pppppp', 15.5, 11, 'PCS', 1700.5, 'dollar', 1, 232, 1.16, 0, 230.84, '2021-01-08 13:08:25', 'BON', 'ETS-BAHEYKE'),
(60, 'CMDE-5665', 0, 'Non defini', 'Non defini', 'ART-939', 'Papier', 20.5, 3, 'PCS', 61.5, 'dollar', 1, 232, 1.16, 0, 230.84, '2021-01-08 13:08:25', 'BON', 'ETS-BAHEYKE'),
(61, 'CMDE-7832', 0, 'Non defini', 'Non defini', 'ART-797', 'pppppp', 15.5, 8, 'PCS', 124, 'dollar', 1, 225.6, 1.128, 0, 224.472, '2021-01-13 10:01:11', 'FACT', 'ETS-BAHEYKE'),
(62, 'CMDE-7832', 0, 'Non defini', 'Non defini', 'ART-832', 'Beniere', 25.4, 4, 'PCS', 101.6, 'dollar', 1, 225.6, 1.128, 0, 224.472, '2021-01-13 10:01:11', 'FACT', 'ETS-BAHEYKE'),
(63, 'CMDE-5622', 0, 'Non defini', 'Non defini', 'ART-263', 'Sac', 25, 1, 'PCS', 25, 'dollar', 0, 25, 0, 0, 25, '2021-01-14 12:03:39', 'PROFORMA', 'ETS-BAHEYKE');

-- --------------------------------------------------------

--
-- Structure de la table `t_panier`
--

CREATE TABLE `t_panier` (
  `id_pn` int(11) NOT NULL,
  `ref_cmd` varchar(100) NOT NULL,
  `ref_prod` varchar(100) NOT NULL,
  `client` varchar(50) NOT NULL,
  `adrs_cli` varchar(60) NOT NULL,
  `desi_prod` varchar(100) NOT NULL,
  `prix_unit` double NOT NULL,
  `devise` varchar(12) NOT NULL,
  `qte_achet` int(11) NOT NULL,
  `unite` varchar(30) NOT NULL,
  `stock_prod` int(11) NOT NULL,
  `type_vente` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_param`
--

CREATE TABLE `t_param` (
  `id_param` int(11) NOT NULL,
  `taux_change` int(11) NOT NULL,
  `Devise_vente` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `devise` varchar(12) NOT NULL,
  `stock` int(10) NOT NULL,
  `unite` varchar(30) NOT NULL,
  `Descript` text NOT NULL,
  `date_prod` varchar(15) NOT NULL,
  `date_expirat` varchar(15) NOT NULL,
  `fabricant` varchar(100) NOT NULL,
  `date_creat` varchar(25) NOT NULL,
  `categ` int(10) NOT NULL,
  `Lib_cat` varchar(100) NOT NULL,
  `user_id` varchar(35) NOT NULL,
  `etat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_produits`
--

INSERT INTO `t_produits` (`id`, `ref_prod`, `designation`, `dci`, `frm_dos`, `prix_gros`, `prix_unit`, `devise`, `stock`, `unite`, `Descript`, `date_prod`, `date_expirat`, `fabricant`, `date_creat`, `categ`, `Lib_cat`, `user_id`, `etat`) VALUES
(22, 'ART-939', 'Papier', '', '', 16.5, 20.5, '', 10, 'PCS', '', '08/01/2021', '', '', '2021-01-08 11:03:22', 0, 'Aucune', '', 1),
(23, 'ART-263', 'Sac', '', '', 19.5, 25, '', 12, 'PCS', '', '08/01/2021', '', '', '08-01-2021 08:22:01', 0, 'Aucune', '', 1),
(24, 'ART-797', 'pppppp', '', '', 11.5, 15.5, '', 8, 'PCS', '', '08/01/2021', '', '', '2021-01-13 10:01:11', 0, 'Aucune', '', 1),
(25, 'ART-832', 'Beniere', '', '', 22.4, 25.4, '', 6, 'PCS', '', '08/01/2021', '', '', '2021-01-13 10:01:11', 0, 'Aucune', '', 1),
(26, 'ART-968', 'ddd', '', '', 0.5, 0.5, '', 1, 'PCS', '', '08/01/2021', '', '', '08-01-2021 14:58:10', 0, 'Aucune', '', 1);

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
(2, 'ETS-BAHEYKE', '30juin1960', '', '', 0);

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
,`prix_unit` double
,`devise` varchar(12)
,`qte_achet` int(11)
,`unite` varchar(30)
,`stock_prod` int(11)
,`total_qte` double
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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_facture`  AS  select `t_panier`.`id_pn` AS `id_pn`,`t_panier`.`ref_cmd` AS `ref_cmd`,`t_panier`.`ref_prod` AS `ref_prod`,`t_panier`.`desi_prod` AS `desi_prod`,`t_panier`.`prix_unit` AS `prix_unit`,`t_panier`.`devise` AS `devise`,`t_panier`.`qte_achet` AS `qte_achet`,`t_panier`.`unite` AS `unite`,`t_panier`.`stock_prod` AS `stock_prod`,(`t_panier`.`qte_achet` * `t_panier`.`prix_unit`) AS `total_qte` from `t_panier` ;

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
-- Index pour la table `archives`
--
ALTER TABLE `archives`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_categorie`
--
ALTER TABLE `t_categorie`
  ADD PRIMARY KEY (`id_cat`);

--
-- Index pour la table `t_cat_cours`
--
ALTER TABLE `t_cat_cours`
  ADD PRIMARY KEY (`id_cat`);

--
-- Index pour la table `t_client`
--
ALTER TABLE `t_client`
  ADD PRIMARY KEY (`id_cli`);

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
-- Index pour la table `t_param`
--
ALTER TABLE `t_param`
  ADD PRIMARY KEY (`id_param`);

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
-- AUTO_INCREMENT pour la table `archives`
--
ALTER TABLE `archives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `t_categorie`
--
ALTER TABLE `t_categorie`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `t_cat_cours`
--
ALTER TABLE `t_cat_cours`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `t_client`
--
ALTER TABLE `t_client`
  MODIFY `id_cli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `t_commandes`
--
ALTER TABLE `t_commandes`
  MODIFY `id_cmd` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_ligne_cmd`
--
ALTER TABLE `t_ligne_cmd`
  MODIFY `id_lgne` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT pour la table `t_panier`
--
ALTER TABLE `t_panier`
  MODIFY `id_pn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_param`
--
ALTER TABLE `t_param`
  MODIFY `id_param` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_produits`
--
ALTER TABLE `t_produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id_cmd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
