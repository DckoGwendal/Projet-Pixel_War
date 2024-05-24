-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 24 mai 2024 à 13:39
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pixelwar`
--

-- --------------------------------------------------------

--
-- Structure de la table `grids`
--

CREATE TABLE `grids` (
  `id` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Idusers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `grids`
--

INSERT INTO `grids` (`id`, `Nom`, `Idusers`) VALUES
(21, 'toto', 6),
(22, 'xxx', 6),
(23, 'zzzzzzzzzzz', 6),
(24, 'erd', 6),
(25, 'kk', 6),
(26, 'zzz', 6),
(27, 'mmm', 6);

-- --------------------------------------------------------

--
-- Structure de la table `pixel`
--

CREATE TABLE `pixel` (
  `id` int(11) NOT NULL,
  `Position_X` int(11) NOT NULL,
  `Position_Y` int(11) NOT NULL,
  `Couleur` varchar(255) NOT NULL,
  `idusers` int(11) NOT NULL,
  `idgrille` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `Mail` varchar(100) NOT NULL,
  `Pseudo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `Nom`, `Password`, `Mail`, `Pseudo`) VALUES
(1, 'de cecco', 'GU_dc3!', 'gwendal.dako@gmail.com', 'gu'),
(2, '123', '$2y$10$BdAOl63/46fB..tFpkV5DOjMdFB3Kkbw63AcirL/L.q', '123@gmail.com', '123'),
(3, '123', '$2y$10$fJeuEPf1zjtNr6itmIdTMuBr8jt1KqT3JrqAVOZIsbR', '123@gmail.com', '123'),
(4, 'aa', '$2y$10$Y6cTfAgID9b1yeuXmIL4CeqCkGL.QQiIphXVs6AU8B3', 'aaa@gmaill.com', 'aaa'),
(5, '012', '$2y$10$vyyNg/37z/0EP4lEleUJ5ua5WzHa30qvTl8UgTZptGarOOkWHF2Q2', '012@gmail.com', '0'),
(6, '456', 'b3a8e0e1f9ab1bfe3a36f231f676f78bb30a519d2b21e6c530c0eee8ebb4a5d0', '456@gmail.com', '456>'),
(7, 's', 'a871c47a7f48a12b38a994e48a9659fab5d6376f3dbce37559bcb617efe8662d', 'steven976.com@gmail.com', 'sss'),
(8, 's', 'a871c47a7f48a12b38a994e48a9659fab5d6376f3dbce37559bcb617efe8662d', 'steven976.com@gmail.com', 'sss'),
(9, 'Thomas', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'steven976.com@gmail.coms', 'thomas'),
(10, 'Thomas', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'steven976.com@gmail.coms', 'thomas'),
(11, 'piere', '0e6523810856a138a75dec70a9cf3778a5c70b83ac915f22c33f05db97cb3e68', 'steven976.com@gmail.coms', 'pm'),
(12, 'mouan', '2fca346db656187102ce806ac732e06a62df0dbb2829e511a770556d398e1a6e', 'mpouna@gmail.com', 'JD'),
(13, 'z', '043a718774c572bd8a25adbeb1bfcd5c0256ae11cecf9f9c3f925d0e52beaf89', 'steven976.com@gmail.coms', '12'),
(14, 's', 'a95bc16631ae2b6fadb455ee018da0adc2703e56d89e3eed074ce56d2f7b1b6a', 'steven976.com@gmail.coms', '584'),
(15, 'taha', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'steven976.com@gmail.coms', 'th'),
(16, 'gwendal', '38989031b6cc80f529efca824f7a75abb219c832777e332d81af50be6bc65cf9', 'gwendal.dako@gmail.com', 'gg'),
(17, '', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855', '', ''),
(18, 'aa', '9834876dcfb05cb167a5c24953eba58c4ac89b1adf57f28f2f9d09af107ee8f0', 'aaa@gmaill.com', 'y');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `grids`
--
ALTER TABLE `grids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iduser` (`Idusers`) USING BTREE;

--
-- Index pour la table `pixel`
--
ALTER TABLE `pixel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_u` (`idusers`),
  ADD KEY `p_g` (`idgrille`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `grids`
--
ALTER TABLE `grids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `pixel`
--
ALTER TABLE `pixel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `grids`
--
ALTER TABLE `grids`
  ADD CONSTRAINT `g_u` FOREIGN KEY (`idusers`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `pixel`
--
ALTER TABLE `pixel`
  ADD CONSTRAINT `p_g` FOREIGN KEY (`idgrille`) REFERENCES `grids` (`id`),
  ADD CONSTRAINT `p_u` FOREIGN KEY (`idusers`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
