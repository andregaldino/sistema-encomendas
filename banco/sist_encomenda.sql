-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 11-Jun-2015 às 13:13
-- Versão do servidor: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";



/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sist_encomenda`
--
CREATE DATABASE sist_encomenda;
use sist_encomenda;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
`codigo_cli` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `cpf` varchar(250) DEFAULT NULL,
  `tel_residencial` varchar(50) DEFAULT NULL,
  `tel_celular` varchar(50) DEFAULT NULL,
  `status` binary(1) DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`codigo_cli`, `nome`, `email`, `cpf`, `tel_residencial`, `tel_celular`, `status`) VALUES
(1, 'Luzia leme', 'lola@yahoo.com.br', '1234123', '22334455', '223456454', 0x31),
(2, 'Jorge DO meio', 'jorge@jorge.com', '5555777753', '66222221', '99999945', 0x31);

-- --------------------------------------------------------

--
-- Estrutura da tabela `encomenda`
--

CREATE TABLE IF NOT EXISTS `encomenda` (
`codigo_enc` int(11) NOT NULL,
  `fk_func` int(11) NOT NULL,
  `fk_cliente` int(11) NOT NULL,
  `fk_prod` int(11) NOT NULL,
  `data_pedido` varchar(250) DEFAULT NULL,
  `data_prevista` varchar(250) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `status` varchar(250) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `encomenda`
--

INSERT INTO `encomenda` (`codigo_enc`, `fk_func`, `fk_cliente`, `fk_prod`, `data_pedido`, `data_prevista`, `quantidade`, `status`) VALUES
(1, 1, 1, 1, '2014-06-10', '2014-06-16', 3, 'Pronto'),
(3, 1, 2, 1, '2015-06-11', '2015-06-18', 3, 'Entregue');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE IF NOT EXISTS `funcionario` (
`codigo_func` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `cpf` varchar(250) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `senha` varchar(250) NOT NULL,
  `status` binary(1) DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`codigo_func`, `nome`, `cpf`, `telefone`, `email`, `senha`, `status`) VALUES
(1, 'Fulano de Talalterado', '417123', '1934569652', 'fulano@tal.com', 'e10adc3949ba59abbe56e057f20f883e', 0x31),
(2, 'nananana', '4335447766', '33334444', 'man@asda.com.br', 'e10adc3949ba59abbe56e057f20f883e', 0x31);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
`codigo_prod` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `descr` varchar(250) DEFAULT NULL,
  `preco` double DEFAULT NULL,
  `status` binary(1) DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`codigo_prod`, `nome`, `descr`, `preco`, `status`) VALUES
(1, 'Camiseta Masculina', 'Tamanho M\r\n100% Algodao\r\n', 19.9, 0x31),
(2, 'cama', 'box,azul', 19.9, 0x31),
(3, 'calÃ§a ', 'moleton nas cores azul, preto e verde, tamanho P.', 20, 0x31);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
 ADD PRIMARY KEY (`codigo_cli`), ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Indexes for table `encomenda`
--
ALTER TABLE `encomenda`
 ADD PRIMARY KEY (`fk_func`,`fk_cliente`,`fk_prod`), ADD UNIQUE KEY `codigo_enc` (`codigo_enc`), ADD KEY `fk_cliente` (`fk_cliente`), ADD KEY `fk_prod` (`fk_prod`);

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
 ADD PRIMARY KEY (`codigo_func`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
 ADD PRIMARY KEY (`codigo_prod`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
MODIFY `codigo_cli` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `encomenda`
--
ALTER TABLE `encomenda`
MODIFY `codigo_enc` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
MODIFY `codigo_func` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
MODIFY `codigo_prod` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
