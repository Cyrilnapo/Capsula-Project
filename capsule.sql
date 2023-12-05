-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 20 mai 2022 à 16:29
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `capsule`
--

-- --------------------------------------------------------

--
-- Structure de la table `capsula`
--

CREATE TABLE `capsula` (
  `userid` int(11) NOT NULL,
  `userpseudo` varchar(200) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `usertext` longtext NOT NULL,
  `date_time` datetime NOT NULL,
  `date_open` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `capsula`
--

INSERT INTO `capsula` (`userid`, `userpseudo`, `titre`, `usertext`, `date_time`, `date_open`) VALUES
(1, 'Admin', 'Exemple', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec condimentum diam in sapien congue vulputate. Suspendisse at feugiat risus. Maecenas vel odio sapien. Donec congue magna vel neque tincidunt lacinia. Vestibulum eget est erat. In sit amet sapien mauris. Aliquam eget nunc quam. Nullam a mattis diam.', '2022-05-19 10:39:43', '2022-05-20'),
(1, 'Admin', 'exemple 2 ', '', '2022-05-20 13:19:04', '2061-11-24');

-- --------------------------------------------------------

--
-- Structure de la table `files`
--

CREATE TABLE `files` (
  `userid` int(11) NOT NULL,
  `userpseudo` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `titre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `files`
--

INSERT INTO `files` (`userid`, `userpseudo`, `images`, `id`, `titre`) VALUES
(1, 'Admin', 'exemple_1.jpg', 1, 'Exemple'),
(1, 'Admin', 'exemple_2.jpg', 2, 'Exemple'),
(1, 'Admin', 'gif_exemple.gif', 3, 'Exemple'),
(1, 'Admin', 'video_exemple.mp4', 4, 'Exemple');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `mdp` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pseudo` varchar(200) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `ip`, `mdp`, `email`, `pseudo`, `date`) VALUES
(1, '::1', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@admin.com', 'Admin', '2022-03-31'),
(3, '', 'cf730e31f2761466522b87a2f66d5439daf0222e', 'obaba@eduvaud.ch', 'albert ', '2022-03-31'),
(6, '10.228.160.31', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@amnet.com', 'AmNet', '2022-03-31'),
(7, '10.228.160.36', '4452d71687b6bc2c9389c3349fdc17fbd73b833b', 'sd@gmail.couille', 'sd', '2022-04-01'),
(8, '10.228.160.33', 'c1f3cfc8b6d047c693c3f4114b1abcc75e6f43fc', 'evinsasi@hotmail.com', 'evin', '2022-04-01'),
(10, '10.228.160.58', '0547eacc0467cb20b44200d52b9e6c076d4b8335', 'quifaitlemalinchanteleravin@hotmail.com', 'fait gaffe à toi', '2022-04-07'),
(11, '::1', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'chibre@zgeg.com', 'bite', '2022-04-11'),
(12, '10.228.160.31', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'zgeg@zgeg.zgeg', 'Zgeg', '2022-04-11'),
(13, '10.228.160.58', '0547eacc0467cb20b44200d52b9e6c076d4b8335', 'jeremebsn@eduvaud.ch', 'jeremy ', '2022-04-11'),
(15, '10.228.160.54', 'da95e1f07c8ab712c2a9bbaf43979710c7ae1fa2', 'esteboss@gmail.com', 'Esteboss', '2022-04-11'),
(16, '10.228.160.36', 'a16358be6e2306b153b1f071477e68837266075e', 'couille@gmail.com', 'Magg Rosebeat', '2022-04-11'),
(17, '10.228.160.64', '7288edd0fc3ffcbe93a0cf06e3568e28521687bc', 'test1234@gmail.com', 'test', '2022-04-11'),
(18, '10.228.160.54', '356a192b7913b04c54574d18c28d46e6395428ab', 'piaopia@gmail.com', 'PiaoPiao', '2022-04-11'),
(20, '10.228.160.58', '19b58543c85b97c5498edfd89c11c3aa8cb5fe51', 'eric.zmmr@lesnoirs.com', 'Mia Pakalihfa', '2022-04-12'),
(21, '::1', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'test@gmail.com', 'Test', '2022-04-12'),
(22, '10.228.160.36', '356a192b7913b04c54574d18c28d46e6395428ab', 'cyril.le.giga.bg@gmail.com', 'octo-pute', '2022-04-12'),
(23, '10.228.160.58', 'fa8754f5bb796d6c5129b02b646bbd8bd4cb779c', 'eklnfjkdnevievv@gmail.com', 'lenasi', '2022-04-12'),
(25, '10.228.160.33', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'pablo@pablo.com', 'evin', '2022-05-02'),
(26, '10.228.160.36', '27d5482eebd075de44389774fce28c69f45c8a75', 'h@couille.com', 'h', '2022-05-06'),
(27, '10.228.160.58', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'jbl.ded@gmail.com', 'Mendez Rondon Abraham ', '2022-05-06'),
(28, '10.228.160.58', '0547eacc0467cb20b44200d52b9e6c076d4b8335', 'pt47ppe@eduvaud.ch', 'koi feur', '2022-05-13'),
(29, '10.228.160.36', '39f6f95327b31d796f8d305a29df43b1d585e3cf', 'cyrilconstantnapoleone@gmail.com', 'cyril constant napoleoné', '2022-05-13'),
(30, '::1', '2997a8f8f64097f2644b85ff9135b1e8782a1ec8', 'exemple@gmail.com', 'Exemple', '2022-05-20');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
