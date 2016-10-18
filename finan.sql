-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 18-Out-2016 às 11:39
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `finan`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cartao_credito`
--

CREATE TABLE IF NOT EXISTS `cartao_credito` (
  `idCartao` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  `diaVencimento` int(11) NOT NULL,
  PRIMARY KEY (`idCartao`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `cartao_credito`
--

INSERT INTO `cartao_credito` (`idCartao`, `descricao`, `diaVencimento`) VALUES
(1, 'Santander Flex Mastercard', 20);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `descricao`) VALUES
(1, 'Academia'),
(2, 'Alimentação'),
(3, 'Aluguel / Condomínio'),
(4, 'Bares/Restaurantes'),
(5, 'Cabeleireiro'),
(6, 'Cartão de Crédito'),
(7, 'Cinema/Teatro'),
(8, 'Combustível'),
(9, 'Educação'),
(10, 'Empréstimo'),
(11, 'Estacionamento'),
(12, 'Esteticista'),
(13, 'Feira'),
(14, 'Gás'),
(15, 'IPTU'),
(16, 'IPVA'),
(17, 'Luz'),
(18, 'Manicure'),
(19, 'Manutenção Carro'),
(20, 'Manutenção Casa'),
(21, 'Medicamentos'),
(22, 'Móveis/Etc'),
(23, 'Ônibus'),
(24, 'Padaria'),
(25, 'Presentes'),
(26, 'Prestação do Carro'),
(27, 'Seguro Carro'),
(28, 'Supermercado'),
(29, 'Taxa/Juros'),
(30, 'Telefone'),
(31, 'TV / Internet'),
(32, 'Vestuário'),
(33, 'Viagens'),
(34, 'N/A'),
(35, 'Outros'),
(36, 'Salário Honeywell');

-- --------------------------------------------------------

--
-- Estrutura da tabela `compras_cartao`
--

CREATE TABLE IF NOT EXISTS `compras_cartao` (
  `idCompraCartao` int(11) NOT NULL AUTO_INCREMENT,
  `idCartao` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `valorTotal` decimal(10,2) NOT NULL,
  `parceladoEm` int(11) NOT NULL,
  `dataCompra` date NOT NULL,
  `nrodaParcela` int(11) NOT NULL,
  `valorParcela` decimal(10,2) NOT NULL,
  `vencParcela` date NOT NULL,
  PRIMARY KEY (`idCompraCartao`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=76 ;

--
-- Extraindo dados da tabela `compras_cartao`
--

INSERT INTO `compras_cartao` (`idCompraCartao`, `idCartao`, `idCategoria`, `descricao`, `valorTotal`, `parceladoEm`, `dataCompra`, `nrodaParcela`, `valorParcela`, `vencParcela`) VALUES
(1, 1, 22, 'Cybelar', '3768.00', 10, '2015-07-27', 1, '376.80', '2015-08-20'),
(2, 1, 22, 'Cybelar', '3768.00', 10, '2015-07-27', 2, '376.80', '2015-09-20'),
(3, 1, 22, 'Cybelar', '3768.00', 10, '2015-07-27', 3, '376.80', '2015-10-20'),
(4, 1, 22, 'Cybelar', '3768.00', 10, '2015-07-27', 4, '376.80', '2015-11-20'),
(5, 1, 22, 'Cybelar', '3768.00', 10, '2015-07-27', 5, '376.80', '2015-12-20'),
(6, 1, 22, 'Cybelar', '3768.00', 10, '2015-07-27', 6, '376.80', '2016-01-20'),
(7, 1, 22, 'Cybelar', '3768.00', 10, '2015-07-27', 7, '376.80', '2016-02-20'),
(8, 1, 22, 'Cybelar', '3768.00', 10, '2015-07-27', 8, '376.80', '2016-03-20'),
(9, 1, 22, 'Cybelar', '3768.00', 10, '2015-07-27', 9, '376.80', '2016-04-20'),
(10, 1, 22, 'Cybelar', '3768.00', 10, '2015-07-27', 10, '376.80', '2016-05-20'),
(11, 1, 22, 'Xbox Ponto Frio', '850.00', 10, '2015-09-17', 1, '85.00', '2015-10-20'),
(12, 1, 22, 'Xbox Ponto Frio', '850.00', 10, '2015-09-17', 2, '85.00', '2015-11-20'),
(13, 1, 22, 'Xbox Ponto Frio', '850.00', 10, '2015-09-17', 3, '85.00', '2015-12-20'),
(14, 1, 22, 'Xbox Ponto Frio', '850.00', 10, '2015-09-17', 4, '85.00', '2016-01-20'),
(15, 1, 22, 'Xbox Ponto Frio', '850.00', 10, '2015-09-17', 5, '85.00', '2016-02-20'),
(16, 1, 22, 'Xbox Ponto Frio', '850.00', 10, '2015-09-17', 6, '85.00', '2016-03-20'),
(17, 1, 22, 'Xbox Ponto Frio', '850.00', 10, '2015-09-17', 7, '85.00', '2016-04-20'),
(18, 1, 22, 'Xbox Ponto Frio', '850.00', 10, '2015-09-17', 8, '85.00', '2016-05-20'),
(19, 1, 22, 'Xbox Ponto Frio', '850.00', 10, '2015-09-17', 9, '85.00', '2016-06-20'),
(20, 1, 22, 'Xbox Ponto Frio', '850.00', 10, '2015-09-17', 10, '85.00', '2016-07-20'),
(21, 1, 4, 'Bar do Valdomiro', '21.50', 1, '2015-12-13', 1, '21.50', '2016-01-20'),
(22, 1, 31, 'Netflix', '274.80', 12, '2016-01-01', 1, '22.90', '2016-01-20'),
(23, 1, 31, 'Netflix', '274.80', 12, '2016-01-01', 2, '22.90', '2016-02-20'),
(24, 1, 31, 'Netflix', '274.80', 12, '2016-01-01', 3, '22.90', '2016-03-20'),
(25, 1, 31, 'Netflix', '274.80', 12, '2016-01-01', 4, '22.90', '2016-04-20'),
(26, 1, 31, 'Netflix', '274.80', 12, '2016-01-01', 5, '22.90', '2016-05-20'),
(27, 1, 31, 'Netflix', '274.80', 12, '2016-01-01', 6, '22.90', '2016-06-20'),
(28, 1, 31, 'Netflix', '274.80', 12, '2016-01-01', 7, '22.90', '2016-07-20'),
(29, 1, 31, 'Netflix', '274.80', 12, '2016-01-01', 8, '22.90', '2016-08-20'),
(30, 1, 31, 'Netflix', '274.80', 12, '2016-01-01', 9, '22.90', '2016-09-20'),
(31, 1, 31, 'Netflix', '274.80', 12, '2016-01-01', 10, '22.90', '2016-10-20'),
(32, 1, 31, 'Netflix', '274.80', 12, '2016-01-01', 11, '22.90', '2016-11-20'),
(33, 1, 31, 'Netflix', '274.80', 12, '2016-01-01', 12, '22.90', '2016-12-20'),
(34, 1, 8, 'Socied dos Motoristas', '35.00', 1, '2015-12-19', 1, '35.00', '2016-01-20'),
(35, 1, 32, 'Tênis Matos', '72.00', 3, '2015-12-19', 1, '24.00', '2016-01-20'),
(36, 1, 32, 'Tênis Matos', '72.00', 3, '2015-12-19', 2, '24.00', '2016-02-20'),
(37, 1, 32, 'Tênis Matos', '72.00', 3, '2015-12-19', 3, '24.00', '2016-03-20'),
(38, 1, 8, 'Avalon', '20.00', 1, '2015-12-21', 1, '20.00', '2016-01-20'),
(39, 1, 8, 'Itavel', '40.00', 1, '2015-12-24', 1, '40.00', '2016-01-20'),
(40, 1, 32, 'Camisa Hering', '69.99', 1, '2015-12-24', 1, '69.99', '2016-01-20'),
(44, 1, 8, 'Avalon', '50.00', 1, '2015-12-26', 1, '50.00', '2016-01-20'),
(45, 1, 4, 'Shopping PA Emporio', '72.93', 1, '2015-12-26', 1, '72.93', '2016-01-20'),
(52, 1, 29, 'Seguro Cartão', '71.40', 12, '2016-01-01', 1, '5.95', '2016-01-20'),
(53, 1, 29, 'Seguro Cartão', '71.40', 12, '2016-01-01', 2, '5.95', '2016-02-20'),
(54, 1, 29, 'Seguro Cartão', '71.40', 12, '2016-01-01', 3, '5.95', '2016-03-20'),
(55, 1, 29, 'Seguro Cartão', '71.40', 12, '2016-01-01', 4, '5.95', '2016-04-20'),
(56, 1, 29, 'Seguro Cartão', '71.40', 12, '2016-01-01', 5, '5.95', '2016-05-20'),
(57, 1, 29, 'Seguro Cartão', '71.40', 12, '2016-01-01', 6, '5.95', '2016-06-20'),
(58, 1, 29, 'Seguro Cartão', '71.40', 12, '2016-01-01', 7, '5.95', '2016-07-20'),
(59, 1, 29, 'Seguro Cartão', '71.40', 12, '2016-01-01', 8, '5.95', '2016-08-20'),
(60, 1, 29, 'Seguro Cartão', '71.40', 12, '2016-01-01', 9, '5.95', '2016-09-20'),
(61, 1, 29, 'Seguro Cartão', '71.40', 12, '2016-01-01', 10, '5.95', '2016-10-20'),
(62, 1, 29, 'Seguro Cartão', '71.40', 12, '2016-01-01', 11, '5.95', '2016-11-20'),
(63, 1, 29, 'Seguro Cartão', '71.40', 12, '2016-01-01', 12, '5.95', '2016-12-20'),
(64, 1, 19, 'Luiz Mecânico', '150.00', 2, '2016-01-06', 1, '75.00', '2016-02-20'),
(65, 1, 19, 'Luiz Mecânico', '150.00', 2, '2016-01-06', 2, '75.00', '2016-03-20'),
(70, 1, 20, 'Adesivo Espelho Aplique', '96.54', 3, '2016-01-24', 1, '32.18', '2016-02-20'),
(71, 1, 20, 'Adesivo Espelho Aplique', '96.54', 3, '2016-01-24', 2, '32.18', '2016-03-20'),
(72, 1, 20, 'Adesivo Espelho Aplique', '96.54', 3, '2016-01-24', 3, '32.18', '2016-04-20'),
(73, 1, 35, 'Bike Alpha Ciclo', '350.00', 3, '2016-01-29', 1, '116.67', '2016-02-20'),
(74, 1, 35, 'Bike Alpha Ciclo', '350.00', 3, '2016-01-29', 2, '116.67', '2016-03-20'),
(75, 1, 35, 'Bike Alpha Ciclo', '350.00', 3, '2016-01-29', 3, '116.67', '2016-04-20');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contas`
--

CREATE TABLE IF NOT EXISTS `contas` (
  `idConta` int(11) NOT NULL AUTO_INCREMENT,
  `foto` varchar(100) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `saldo` decimal(10,2) NOT NULL,
  PRIMARY KEY (`idConta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `contas`
--

INSERT INTO `contas` (`idConta`, `foto`, `descricao`, `saldo`) VALUES
(1, '../img/3eca403f0475470eef5ed9934aecbfba.jpg', 'Santander CC', '119.31'),
(2, '../img/951f9041321786a62eb094c8e2241bbb.jpg', 'Itaú CC', '1255.12'),
(3, '../img/c4a0f3ac54586b47dca101c4b0438daa.png', 'Santander CP', '150.36'),
(4, '../img/e0ab6d696704bc88a815cc27d36ca809.png', 'Carteira', '5.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contas_a_pagar`
--

CREATE TABLE IF NOT EXISTS `contas_a_pagar` (
  `idContaPagar` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `dataVencimento` date NOT NULL,
  `tipo` char(1) NOT NULL,
  `statusPgto` char(1) NOT NULL,
  PRIMARY KEY (`idContaPagar`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Extraindo dados da tabela `contas_a_pagar`
--

INSERT INTO `contas_a_pagar` (`idContaPagar`, `descricao`, `valor`, `dataVencimento`, `tipo`, `statusPgto`) VALUES
(1, 'Alguel e Condomínio', '1200.00', '2016-10-10', 'M', 'A'),
(2, 'Alguel e Condomínio', '1200.00', '2016-11-10', 'M', 'A'),
(3, 'Alguel e Condomínio', '1200.00', '2016-12-10', 'M', 'A'),
(4, 'Alguel e Condomínio', '1200.00', '2017-01-10', 'M', 'A'),
(5, 'Alguel e Condomínio', '1200.00', '2017-02-10', 'M', 'A'),
(6, 'Alguel e Condomínio', '1200.00', '2017-03-10', 'M', 'A'),
(7, 'Alguel e Condomínio', '1200.00', '2017-04-10', 'M', 'A'),
(8, 'Alguel e Condomínio', '1200.00', '2017-05-10', 'M', 'A'),
(9, 'Alguel e Condomínio', '1200.00', '2017-06-10', 'M', 'A'),
(10, 'Alguel e Condomínio', '1200.00', '2017-07-10', 'M', 'A'),
(11, 'Alguel e Condomínio', '1200.00', '2017-08-10', 'M', 'A'),
(12, 'Alguel e Condomínio', '1200.00', '2017-09-10', 'M', 'A'),
(13, 'Internet', '89.90', '2016-10-20', 'M', 'A'),
(14, 'Internet', '89.90', '2016-11-20', 'M', 'A'),
(15, 'Internet', '89.90', '2016-12-20', 'M', 'A'),
(16, 'Internet', '89.90', '2017-01-20', 'M', 'A'),
(17, 'Internet', '89.90', '2017-02-20', 'M', 'A'),
(18, 'Internet', '89.90', '2017-03-20', 'M', 'A'),
(19, 'Internet', '89.90', '2017-04-20', 'M', 'A'),
(20, 'Internet', '89.90', '2017-05-20', 'M', 'A'),
(21, 'Internet', '89.90', '2017-06-20', 'M', 'A'),
(22, 'Internet', '89.90', '2017-07-20', 'M', 'A'),
(23, 'Internet', '89.90', '2017-08-20', 'M', 'A'),
(24, 'Internet', '89.90', '2017-09-20', 'M', 'A'),
(25, 'Luz', '150.00', '2016-10-06', 'M', 'P'),
(26, 'Luz', '150.00', '2016-11-06', 'M', 'A'),
(27, 'Luz', '150.00', '2016-12-06', 'M', 'A'),
(28, 'Luz', '150.00', '2017-01-06', 'M', 'A'),
(29, 'Luz', '150.00', '2017-02-06', 'M', 'A'),
(30, 'Luz', '150.00', '2017-03-06', 'M', 'A'),
(31, 'Luz', '150.00', '2017-04-06', 'M', 'A'),
(32, 'Luz', '150.00', '2017-05-06', 'M', 'A'),
(33, 'Luz', '150.00', '2017-06-06', 'M', 'A'),
(34, 'Luz', '150.00', '2017-07-06', 'M', 'A'),
(35, 'Luz', '150.00', '2017-08-06', 'M', 'A'),
(36, 'Luz', '150.00', '2017-09-06', 'M', 'A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fechamento`
--

CREATE TABLE IF NOT EXISTS `fechamento` (
  `idFechamento` int(11) NOT NULL AUTO_INCREMENT,
  `dataFechamento` date NOT NULL,
  `saldoContaPrinc` decimal(10,2) NOT NULL,
  PRIMARY KEY (`idFechamento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Fechamento e o saldo na Conta Corrente principal logo apos segundo salario cair' AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `fechamento`
--

INSERT INTO `fechamento` (`idFechamento`, `dataFechamento`, `saldoContaPrinc`) VALUES
(1, '2016-01-29', '2345.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `operacoes`
--

CREATE TABLE IF NOT EXISTS `operacoes` (
  `idOperacao` int(11) NOT NULL AUTO_INCREMENT,
  `idConta` int(11) DEFAULT NULL,
  `idCategoria` int(11) DEFAULT NULL,
  `tipo` char(1) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `dataOperacao` date NOT NULL,
  `transf_idContaOrig` int(11) DEFAULT NULL,
  `transf_idContaDest` int(11) DEFAULT NULL,
  PRIMARY KEY (`idOperacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID do Usuário',
  `user` varchar(255) NOT NULL COMMENT 'Usuário',
  `user_name` varchar(255) NOT NULL COMMENT 'Nome do usuário',
  `user_password` varchar(255) NOT NULL COMMENT 'Senha',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`user_id`, `user`, `user_name`, `user_password`) VALUES
(3, 'teste@teste.com.br', 'teste', '$1$iv1.Dy5.$XdJamyw5b9q3ooJb.Y1A20');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
