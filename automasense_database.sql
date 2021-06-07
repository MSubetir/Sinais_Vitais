-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Jun-2021 às 15:40
-- Versão do servidor: 10.4.13-MariaDB
-- versão do PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `automasense`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `access`
--

CREATE TABLE `access` (
  `IdAccess` int(3) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `access`
--

INSERT INTO `access` (`IdAccess`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$2/w8BouyHxGACOt31LpE4uIeb.BViMQejcoDvf2IdptUuhxPwCCee');

-- --------------------------------------------------------

--
-- Estrutura da tabela `boards`
--

CREATE TABLE `boards` (
  `IdBoard` int(3) NOT NULL,
  `IdUser` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `boards`
--

INSERT INTO `boards` (`IdBoard`, `IdUser`) VALUES
(6, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `histories`
--

CREATE TABLE `histories` (
  `IdHistory` int(3) NOT NULL,
  `O2` float NOT NULL,
  `BPM` float NOT NULL,
  `TEMPERATURA` float NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `histories`
--

INSERT INTO `histories` (`IdHistory`, `O2`, `BPM`, `TEMPERATURA`, `date`) VALUES
(3, 80, 120, 36, '2021-05-07 22:29:19'),
(5, 84, 170, 35, '2021-05-08 22:29:24'),
(6, 82, 150, 37.5, '2021-04-19 17:20:30'),
(7, 89, 125, 39, '2021-05-11 17:10:27'),
(8, 77, 130, 39, '2021-05-11 17:10:27'),
(9, 90, 80, 36, '2021-03-22 22:09:57'),
(10, 80, 123, 36, '2021-03-16 22:09:57'),
(12, 88, 100, 37, '2021-03-17 22:09:57'),
(14, 83, 110, 39, '2021-03-18 04:40:45'),
(18, 75, 90, 37, '2021-05-09 17:20:27'),
(19, 85, 98, 35, '2021-04-19 09:09:57'),
(20, 75, 85, 40, '2021-03-23 17:20:31'),
(21, 91, 80, 37.5, '2021-05-10 17:20:31'),
(22, 758, 85, 37, '2021-03-25 17:20:31'),
(23, 83, 112, 38, '2021-05-07 22:29:30'),
(24, 90, 100, 36, '2021-05-08 10:10:00'),
(25, 41, 160, 40, '2021-05-10 20:15:37');

-- --------------------------------------------------------

--
-- Estrutura da tabela `normalsigns`
--

CREATE TABLE `normalsigns` (
  `IdNormalSigns` int(3) NOT NULL,
  `idade` int(3) NOT NULL,
  `O2_min` float NOT NULL,
  `O2_max` float NOT NULL,
  `BPM_min` float NOT NULL,
  `BPM_max` float NOT NULL,
  `TEMPERATURA_min` float NOT NULL,
  `TEMPERATURA_max` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `normalsigns`
--

INSERT INTO `normalsigns` (`IdNormalSigns`, `idade`, `O2_min`, `O2_max`, `BPM_min`, `BPM_max`, `TEMPERATURA_min`, `TEMPERATURA_max`) VALUES
(1, 0, 90, 100, 60, 120, 35.5, 38),
(2, 18, 90, 100, 56, 85, 35.4, 38),
(3, 25, 90, 100, 56, 85, 35.4, 38),
(4, 35, 90, 100, 56, 85, 35.4, 38),
(5, 45, 90, 100, 58, 84, 35.4, 38),
(6, 55, 90, 100, 56, 82, 35.4, 38),
(7, 65, 90, 100, 56, 80, 35.4, 38);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `IdUser` int(3) NOT NULL,
  `name` varchar(25) NOT NULL,
  `nascimento` datetime NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone` varchar(25) NOT NULL,
  `idade` int(3) DEFAULT NULL,
  `rua` varchar(100) NOT NULL,
  `numero` varchar(25) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `cep` varchar(25) DEFAULT NULL,
  `lat` decimal(11,8) NOT NULL,
  `lon` decimal(11,8) NOT NULL,
  `descricao` text DEFAULT NULL,
  `diagnosticos_numero` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`IdUser`, `name`, `nascimento`, `email`, `telefone`, `idade`, `rua`, `numero`, `cidade`, `estado`, `cep`, `lat`, `lon`, `descricao`, `diagnosticos_numero`) VALUES
(1, 'Maycon Subetir', '2002-07-20 00:00:00', 'msubetir@gmail.com', '47997626547', 18, '810', '330', 'Itapema', 'Santa catarina', '88220-000', '-27.14500140', '-48.59213720', 'Significant for hypertension, insomnia.', 2),
(5, 'Mike Cuevas', '2000-01-01 00:00:00', 'mike@gmail.com', '47998950312', 20, 'Osmar Sotero Martins', '30', 'Palhoça', 'Santa catarina', '88130-835', '-27.64111410', '-48.66224330', NULL, NULL),
(6, 'Hector', '2000-01-01 00:00:00', 'hector@gmail.com', '47997626544', 36, 'R. Cap. Romualdo de Barros', '1000', 'Florianópolis', 'Santa catarina', '88040-600', '-27.60648610', '-48.53063810', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usersxhistories`
--

CREATE TABLE `usersxhistories` (
  `IdUser` int(3) NOT NULL,
  `IdHistory` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usersxhistories`
--

INSERT INTO `usersxhistories` (`IdUser`, `IdHistory`) VALUES
(1, 3),
(1, 5),
(1, 7),
(1, 10),
(1, 12),
(1, 14),
(1, 18),
(1, 20),
(5, 6),
(5, 9),
(5, 19),
(5, 22),
(5, 23),
(5, 24),
(6, 8),
(6, 21),
(6, 25);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`IdAccess`);

--
-- Índices para tabela `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`IdBoard`),
  ADD KEY `FK_Users_IdUser` (`IdUser`);

--
-- Índices para tabela `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`IdHistory`);

--
-- Índices para tabela `normalsigns`
--
ALTER TABLE `normalsigns`
  ADD PRIMARY KEY (`IdNormalSigns`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`IdUser`);

--
-- Índices para tabela `usersxhistories`
--
ALTER TABLE `usersxhistories`
  ADD PRIMARY KEY (`IdUser`,`IdHistory`),
  ADD KEY `PK_UsersXHistories3` (`IdHistory`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `normalsigns`
--
ALTER TABLE `normalsigns`
  MODIFY `IdNormalSigns` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `IdUser` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `boards`
--
ALTER TABLE `boards`
  ADD CONSTRAINT `FK_Users_IdUser` FOREIGN KEY (`IdUser`) REFERENCES `users` (`IdUser`);

--
-- Limitadores para a tabela `usersxhistories`
--
ALTER TABLE `usersxhistories`
  ADD CONSTRAINT `PK_UsersXHistories2` FOREIGN KEY (`IdUser`) REFERENCES `users` (`IdUser`),
  ADD CONSTRAINT `PK_UsersXHistories3` FOREIGN KEY (`IdHistory`) REFERENCES `histories` (`IdHistory`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
