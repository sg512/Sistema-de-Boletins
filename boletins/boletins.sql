-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 25/07/2016 às 12:29
-- Versão do servidor: 5.5.43-0+deb8u1
-- Versão do PHP: 5.6.7-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `boletins`
--
CREATE DATABASE IF NOT EXISTS `boletins` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `boletins`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `upload`
--

CREATE TABLE IF NOT EXISTS `upload` (
`uploadid` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `data` date NOT NULL,
  `diretorio` varchar(150) NOT NULL,
  `tipo` varchar(80) NOT NULL,
  `conteudo` longtext NOT NULL,
  `conteudo_mantido` longtext NOT NULL,
  `tamanho` int(11) NOT NULL,
  `url` varchar(150) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2152 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userid` int(11) NOT NULL,
  `login` varchar(25) NOT NULL,
  `password` varchar(64) NOT NULL,
  `role` enum('default','admin','owner') NOT NULL DEFAULT 'default'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `upload`
--
ALTER TABLE `upload`
 ADD PRIMARY KEY (`uploadid`), ADD FULLTEXT KEY `conteudo` (`conteudo`), ADD FULLTEXT KEY `conteudo_2` (`conteudo`);

--
-- Índices de tabela `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `upload`
--
ALTER TABLE `upload`
MODIFY `uploadid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2152;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
