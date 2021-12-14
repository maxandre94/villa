-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 13 déc. 2021 à 05:54
-- Version du serveur :  5.7.34
-- Version de PHP : 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `test`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_cl` int(11) NOT NULL,
  `civilite_cl` varchar(100) NOT NULL,
  `nom_cl` varchar(100) NOT NULL,
  `prenom_cl` varchar(100) NOT NULL,
  `email` text NOT NULL,
  `mot_pas` text NOT NULL,
  `tel_cl` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_cl`, `civilite_cl`, `nom_cl`, `prenom_cl`, `email`, `mot_pas`, `tel_cl`) VALUES
(30, 'Mlle', 'ahou', 'ahou', 'ahou@gmail.com', '$2y$12$HGo3xew5zZMa.T3vqU4.kOCIhwq3bJKSN3h5qNiTe13ZnNecPyd/W', '0102030405'),
(31, 'Mme', 'awa', 'awa', 'awa@gmail.com', '$2y$12$WBkQowntH9vCeovBuKCqKe/aNDsC/l0uwSPWVEAuNN0fvqBY6Mb92', '0700060700'),
(32, 'Mr', 'kevin', 'kevin', 'kevin@gmail.com', '$2y$12$MFLyIU3QGOjhmHPGgwkpQekGQrvDzsBdfYDeFG0NWyhVIB61OUWMO', '0102030405'),
(33, 'Mr', 'adjoua', 'max andre', 'adjoua94@gmail.com', '$2y$12$b/G6RGzfGb/xbIHTDaq6B.JzR3kPupmxvozJPqcV3TFSex/EhlmoO', '0102030405'),
(34, 'Mr', 'assare', 'guy', 'guyassare@gmail.com', '$2y$12$Z0s8ZcPJVZJlvxq3CZ9jGuWPMuyUIYLMnVCn/5Pf3ABI1pwtUQ0Nu', '0702030405'),
(35, 'Mme', 'koffi', 'koffi', 'koffi@gmail.com', '$2y$12$0rmQUfKIrOaSAcUwqagp8e619N3W5UT0rxlaViiuzxrDvQHArVuAu', '0104060209'),
(36, 'Mlle', 'kalli', 'kalli', 'kalli@gmail.com', '$2y$12$DFrwMUi3Z2NnsRK70e/V8uPzcd4PX5/hXgqtaUtbksJwHKDG5nMl.', '0506070809'),
(37, 'Mr', 'kablan', 'kablan', 'kablan@gmail.com', '$2y$12$kPGUYXQ8NGZdAnmnBSkWLOGvigQncHQGKoyM2w9.p5kc.5A3ygwJq', '0102078193'),
(38, 'Mme', 'kodan', 'kodan', 'kodan@gmail.com', '$2y$12$3XGA.Yz8q0STwJZ7Kjah5uTAxgmt30tr2zILBSUdywnCktvcH0gz2', '0123000485'),
(39, 'Mr', 'sahid', 'sahid', 'sahid@gmail.com', '$2y$12$Dx4rSGOqXNGLFRe0vpqFyOCk7PUzo50Bcx1pc404HbYKa5TlVJHiS', '0767985235');

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `id_fact` int(11) NOT NULL,
  `id_cl` int(11) NOT NULL,
  `date_fact` datetime NOT NULL,
  `montant` int(11) NOT NULL,
  `statut` int(11) NOT NULL DEFAULT '0',
  `paye` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`id_fact`, `id_cl`, `date_fact`, `montant`, `statut`, `paye`) VALUES
(6, 25, '2021-11-19 17:20:09', 130000, 1, 0),
(8, 25, '2021-11-29 12:30:25', 120000, 0, 0),
(11, 27, '2021-11-29 17:53:39', 780000, 1, 0),
(26, 30, '2021-11-30 14:40:53', 185000, 0, 0),
(27, 30, '2021-12-01 18:51:52', 100000, 2, 0),
(29, 30, '2021-12-01 22:59:06', 115000, 1, 0),
(30, 30, '2021-12-01 23:06:29', 110000, 1, 0),
(31, 33, '2021-12-02 16:23:30', 80000, 1, 0),
(32, 34, '2021-12-02 17:55:01', 150000, 1, 0),
(33, 35, '2021-12-02 18:06:40', 30000, 0, 0),
(34, 36, '2021-12-02 18:10:18', 30000, 0, 0),
(35, 37, '2021-12-02 18:15:55', 240000, 0, 0),
(36, 38, '2021-12-02 18:19:25', 560000, 2, 0),
(37, 39, '2021-12-02 21:44:47', 120000, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `reglement`
--

CREATE TABLE `reglement` (
  `id_regl` int(11) NOT NULL,
  `id_fact` int(11) NOT NULL,
  `date_regl` date NOT NULL,
  `typ_regl` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id_res` int(11) NOT NULL,
  `id_fact` int(11) NOT NULL,
  `id_cl` int(11) NOT NULL,
  `id_typ` int(11) NOT NULL,
  `arrive` date NOT NULL,
  `depart` date NOT NULL,
  `chb_nb` int(11) NOT NULL,
  `pers_nb` int(11) NOT NULL,
  `prix_resa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id_res`, `id_fact`, `id_cl`, `id_typ`, `arrive`, `depart`, `chb_nb`, `pers_nb`, `prix_resa`) VALUES
(19, 6, 25, 1, '2021-11-19', '2021-11-20', 2, 1, 60000),
(20, 6, 25, 3, '2021-11-19', '2021-11-21', 1, 1, 70000),
(23, 8, 25, 1, '2021-11-29', '2021-11-30', 1, 1, 20000),
(24, 8, 25, 3, '2021-12-03', '2021-12-04', 2, 3, 100000),
(25, 9, 26, 3, '2021-11-29', '2021-12-02', 2, 2, 160000),
(26, 9, 26, 4, '2021-11-29', '2021-12-05', 1, 2, 185000),
(27, 9, 26, 2, '2021-11-30', '2021-12-04', 1, 1, 85000),
(28, 9, 26, 1, '2021-12-04', '2021-12-06', 1, 2, 35000),
(29, 9, 26, 1, '2021-12-03', '2021-12-05', 1, 2, 40000),
(30, 9, 26, 2, '2021-11-29', '2021-12-15', 1, 2, 275000),
(32, 10, 26, 4, '2021-11-29', '2021-12-05', 1, 2, 185000),
(33, 10, 26, 2, '2021-11-30', '2021-12-04', 1, 1, 85000),
(34, 10, 26, 1, '2021-12-04', '2021-12-06', 1, 2, 35000),
(35, 10, 26, 1, '2021-12-03', '2021-12-05', 1, 2, 40000),
(36, 10, 26, 2, '2021-11-29', '2021-12-15', 1, 2, 275000),
(37, 11, 27, 3, '2021-11-29', '2021-12-02', 2, 2, 160000),
(38, 11, 27, 4, '2021-11-29', '2021-12-05', 1, 2, 185000),
(39, 11, 27, 2, '2021-11-30', '2021-12-04', 1, 1, 85000),
(40, 11, 27, 1, '2021-12-04', '2021-12-06', 1, 2, 35000),
(41, 11, 27, 1, '2021-12-03', '2021-12-05', 1, 2, 40000),
(42, 11, 27, 2, '2021-11-29', '2021-12-15', 1, 2, 275000),
(52, 26, 30, 1, '2021-11-30', '2021-12-01', 1, 1, 10000),
(53, 26, 30, 3, '2021-12-03', '2021-12-04', 3, 1, 75000),
(54, 26, 30, 4, '2021-12-05', '2021-12-07', 2, 2, 100000),
(55, 27, 30, 1, '2021-12-01', '2021-12-05', 1, 1, 50000),
(56, 27, 30, 3, '2021-12-03', '2021-12-04', 2, 2, 50000),
(59, 29, 30, 2, '2021-12-02', '2021-12-04', 1, 1, 35000),
(60, 29, 30, 1, '2021-12-02', '2021-12-05', 2, 1, 80000),
(61, 30, 30, 1, '2021-12-01', '2021-12-02', 1, 1, 10000),
(62, 30, 30, 2, '2021-12-01', '2021-12-04', 2, 1, 100000),
(63, 31, 33, 1, '2021-12-02', '2021-12-03', 1, 1, 10000),
(64, 31, 33, 3, '2021-12-02', '2021-12-05', 1, 1, 70000),
(65, 32, 34, 1, '2021-12-02', '2021-12-05', 2, 1, 80000),
(66, 32, 34, 2, '2021-12-03', '2021-12-07', 1, 2, 70000),
(67, 33, 35, 1, '2021-12-02', '2021-12-03', 1, 1, 10000),
(68, 33, 35, 3, '2021-12-02', '2021-12-03', 1, 1, 20000),
(69, 34, 36, 1, '2021-12-02', '2021-12-03', 1, 1, 10000),
(70, 34, 36, 1, '2021-12-02', '2021-12-03', 1, 1, 10000),
(71, 34, 36, 1, '2021-12-02', '2021-12-03', 1, 1, 10000),
(72, 35, 37, 1, '2021-12-02', '2021-12-03', 2, 1, 20000),
(73, 35, 37, 3, '2021-12-02', '2021-12-12', 1, 2, 220000),
(74, 36, 38, 3, '2021-12-02', '2021-12-03', 1, 1, 20000),
(75, 36, 38, 4, '2021-12-02', '2021-12-12', 2, 1, 540000),
(76, 37, 39, 2, '2021-12-03', '2021-12-05', 2, 2, 80000),
(77, 37, 39, 1, '2021-12-03', '2021-12-06', 1, 2, 40000);

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE `type` (
  `id_typ` int(11) NOT NULL,
  `img_typ` text NOT NULL,
  `nom_typ` varchar(1000) NOT NULL,
  `prix_sem` int(11) NOT NULL,
  `prix_week` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id_typ`, `img_typ`, `nom_typ`, `prix_sem`, `prix_week`) VALUES
(1, 'images/room/room2.jpg', 'Chambre classique', 10000, 15000),
(2, 'images/room/room3.jpeg', 'Suite junior', 15000, 20000),
(3, 'images/room/room5.jpg', 'Suite sénior', 20000, 25000),
(4, 'images/room/room1.jpg', 'Villa', 25000, 30000);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_user` int(11) NOT NULL,
  `civilite` varchar(100) NOT NULL,
  `tel_admin` varchar(10) NOT NULL,
  `pseudo` text NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `valide` int(11) NOT NULL,
  `ip` text NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_user`, `civilite`, `tel_admin`, `pseudo`, `prenom`, `email`, `password`, `valide`, `ip`, `token`) VALUES
(2, '', '0', 'kevin', '', 'kevin@gmail.com', '$2y$12$luoOvoRWI62Mp09Zxelnr.UpNTWfWbQ5FIA9Tswq7bxltJPEBEgMu', 0, '::1', '75ee85c534708f477b5e766df8635834ef20e7697e4f518ee719bad5049e70719666187a06af7ca7f48cd18d2d4c33136932b7398c4e7d8f210658b19d42b523'),
(4, '', '0', 'adjoua', 'Max', 'adjoua@gmail.com', '$2y$12$z0CzJ2pLXDvCXkrsCCrK0ueI65a/vYs4K3pRkEs2ppD7yhgSNMkSq', 1, '::1', '13a823723940c5082cbc3a7779822fbbe8e58ed8259a141c2d3840f68e5c78cf094d4075f3590d7635a336fcaf1c07a086ec6afe3525821f6a9871fa6f52da61'),
(5, '', '0', 'charle', 'charle', 'charle@gmail.com', '$2y$12$rusZO/G39BafqLKireo.DeFCdjVl7zCdRxq1AClI/nXl70K.kqx1i', 1, '::1', 'ba44e1daada9c3280f5356b3d91485973863bac4436db6d9510ea848579ee8f63dfe9d0d29ccc136beda65f94d1d4e069b17697f77daadfe7fbcfeeae3669526'),
(6, 'Mr', '0102030405', 'kan', 'kamille', 'kamille@gmail.com', '$2y$12$/NcLUo2p6R1YhKEi4uL9p.KFCMj50qw8PRe0jxnNX1ARg8CcE4cVS', 0, '::1', 'a23723f241192ae184f7345170b2bcad9fd5e417d6157e4dc03c460b0fe670d0a64107ef4905221651de89967607e3e89e457f94c927277e8c28446b91aa07ce');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_cl`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`id_fact`);

--
-- Index pour la table `reglement`
--
ALTER TABLE `reglement`
  ADD PRIMARY KEY (`id_regl`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_res`);

--
-- Index pour la table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id_typ`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_cl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `id_fact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `reglement`
--
ALTER TABLE `reglement`
  MODIFY `id_regl` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_res` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT pour la table `type`
--
ALTER TABLE `type`
  MODIFY `id_typ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
