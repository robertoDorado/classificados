-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 03-Ago-2020 às 04:00
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `classificados`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `anuncios`
--

CREATE TABLE IF NOT EXISTS `anuncios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `valor` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `anuncios`
--

INSERT INTO `anuncios` (`id`, `id_usuario`, `id_categoria`, `titulo`, `descricao`, `valor`, `estado`) VALUES
(3, 19, 3, 'Ferrari Vermelha!', 'Um bom carro para toda a famÃƒÂ­lia!', 'R$ 350.000,00', 2),
(4, 19, 2, 'Novo RelÃ³gio', 'Novo RelÃƒÂ³gio!', 'R$ 400,00', 2),
(5, 19, 1, 'Roupa Feminina', 'Roupa feminina', 'R$ 650,00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `anuncios_imagens`
--

CREATE TABLE IF NOT EXISTS `anuncios_imagens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_anuncios` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Extraindo dados da tabela `anuncios_imagens`
--

INSERT INTO `anuncios_imagens` (`id`, `id_anuncios`, `url`) VALUES
(6, 3, 'eced6c910d719f00642ef73f5ef745a4.jpg'),
(7, 3, '0c7ab902c93bc201e4929399f8acc57d.jpg'),
(8, 3, 'ad2956431d9b13cf83f3fa62823e48d9.jpg'),
(10, 4, '1305f7a506d46cfa5e1350dc6bae93b2.jpg'),
(11, 5, '7fb2c20653ed9015098387df379c6232.jpg'),
(12, 5, '0563361a1d406d2b921ea28e456e33c3.jpg'),
(13, 5, 'ad83cce684d42e341f52f41c9da49749.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`) VALUES
(1, 'Roupas'),
(2, 'Relógios'),
(3, 'Carros'),
(4, 'Eletrônicos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `telefone`) VALUES
(19, 'Roberto Dorado', 'robertodorado7@gmail.com', '89794b621a313bb59eed0d9f0f4e8205', '(11) 98032-2264');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
