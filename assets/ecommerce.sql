-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 23, 2026 at 11:37 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id` int(2) NOT NULL,
  `tipo` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `tipo`) VALUES
(1, 'Ficção Científica'),
(2, 'História'),
(3, 'Culinária'),
(4, 'Aventura'),
(5, 'Fantasia'),
(6, 'Contos'),
(7, 'Ciências'),
(8, 'Romance'),
(9, 'Tecnologia'),
(10, 'Carros'),
(11, 'Filosofia'),
(12, 'Biografia');

-- --------------------------------------------------------

--
-- Table structure for table `dados_banc`
--

CREATE TABLE `dados_banc` (
  `id` int(4) NOT NULL,
  `cartao` varchar(20) NOT NULL,
  `codigo_cartao` int(4) NOT NULL,
  `nome_titu` varchar(25) NOT NULL,
  `id_cliente` int(4) NOT NULL,
  `validade` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dados_banc`
--

INSERT INTO `dados_banc` (`id`, `cartao`, `codigo_cartao`, `nome_titu`, `id_cliente`, `validade`) VALUES
(1, '444667788', 454, 'Marcelo Couto', 1, '0000-00-00'),
(2, '5502090846066796', 444, 'Luiz H M Couto', 2, '0000-00-00'),
(3, '5961225779330881', 211, 'Antonio Couto', 3, '0000-00-00'),
(4, '3542356234656567', 555, 'Murilo Couto', 4, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `enderecos`
--

CREATE TABLE `enderecos` (
  `id` int(4) NOT NULL,
  `rua` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `bairro` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `numero` int(4) NOT NULL,
  `complemento` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cidade` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `uf` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cep` int(10) NOT NULL,
  `id_cliente` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enderecos`
--

INSERT INTO `enderecos` (`id`, `rua`, `bairro`, `numero`, `complemento`, `cidade`, `uf`, `cep`, `id_cliente`) VALUES
(1, 'Antonio Maria Coelho', 'Centro', 331, 'Prédio de apartamento', 'Campo Grande', 'MS', 7951222, 1),
(2, 'José Cangussu', 'Vilas Boas', 332, 'Casa de Esquina', 'Campo Grande', 'MS', 7951735, 2),
(3, 'Rua da Divisão', 'Aero Rancho', 229, 'Condomínio Village', 'Campo Grande', 'MS', 7971145, 3),
(4, 'Rua dos Carvalhos', 'Santo Antonio', 98, 'Casa', 'Campinas', 'SP', 82765123, 4),
(5, 'Av. Mato Grosso', 'Chácara Cachoeira', 40, 'Mansão do Ellon Musk', 'Campo Grande', 'MS', 7988821, 5);

-- --------------------------------------------------------

--
-- Table structure for table `favoritos`
--

CREATE TABLE `favoritos` (
  `id` int(4) NOT NULL,
  `id_produto` int(4) NOT NULL,
  `id_cliente` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grupo`
--

CREATE TABLE `grupo` (
  `id` int(1) NOT NULL,
  `tipo` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `descri` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grupo`
--

INSERT INTO `grupo` (`id`, `tipo`, `descri`) VALUES
(1, 'cliente', 'cliente da loja'),
(2, 'autorizado', 'funcionário da loja'),
(3, 'administrador', 'administrador');

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(4) NOT NULL,
  `id_produto` int(4) NOT NULL,
  `id_cliente` int(4) NOT NULL,
  `data` date NOT NULL,
  `pagamento` int(2) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produtos`
--

CREATE TABLE `produtos` (
  `id` int(4) NOT NULL,
  `nome` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tipo` int(2) NOT NULL,
  `valor` float NOT NULL DEFAULT 0,
  `autor` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `click` int(4) NOT NULL DEFAULT 0,
  `descri` varchar(130) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `paginas` int(3) NOT NULL,
  `idioma` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `vendas` int(4) NOT NULL DEFAULT 0,
  `estoque` int(4) NOT NULL DEFAULT 1,
  `img_path` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '/images/logo-image.ico',
  `editora` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `categoria` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `tipo`, `valor`, `autor`, `click`, `descri`, `paginas`, `idioma`, `vendas`, `estoque`, `img_path`, `editora`, `categoria`) VALUES
(1, 'Labirinto do Fauno', 1, 79.99, 'Jonathas', 0, 'A New York Times Bestseller!Fans of dark fairy-tales like The Hazel Wood', 320, 'Português', 0, 50, '/images/logo-image.ico', '', 1),
(2, 'Alice no País das Maravilhas', 2, 75.99, 'Lewis Carrol', 0, 'Uma menina, um coelho e uma história capazes de fazer qualquer um de nós voltar a sonhar.', 208, 'Português', 0, 30, '/images/logo-image.ico', 'Darkside Books', 1),
(3, 'Dom Quixote', 2, 37.89, 'Miguel de Cervantes', 0, 'A história do engenhoso fidalgo Dom Quixote e de seu fiel escudeiro Sancho Pança conquista leitores geração após geração.', 185, 'Português', 0, 1, '/images/logo-image.ico', 'Nova Fronteira', 1),
(4, 'O Pequeno Principe - Edição Luxo Capa Dura', 2, 39.7, 'Antoine de Saint Exúpere', 0, '\" O Pequeno Príncipe \", escrito pelo francês Antoine de Saint-Exupéry, é uma obra atemporal.', 320, 'Francês', 0, 1, '/images/logo-image.ico', 'Nova Leitura', 1),
(5, 'Dom Casmurro', 1, 22.99, 'Machado de Asssis', 0, 'A História de Bento, em sua luta para fugir do Seminário e se casar com Capitu.', 250, 'Paotuguês', 0, 13, '/images/logo-image.ico', 'Martin Claret', 1),
(6, 'Berserker Vol. 1', 3, 19.89, 'Kentaro Miura', 0, 'O misterioso Guts, o \"Espadachim Negro\", carrega em sua mão mecânica uma enorme espada, e em seu pescoço uma estranha marca', 80, 'Japonês', 0, 1, '/images/logo-image.ico', 'Panini', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tipo_pagamento`
--

CREATE TABLE `tipo_pagamento` (
  `id` int(2) NOT NULL,
  `tipo` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `descri` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tipo_pagamento`
--

INSERT INTO `tipo_pagamento` (`id`, `tipo`, `descri`) VALUES
(1, 'Pix', 'Pagamento por Pix'),
(2, 'Boleto', 'Pagamento po Boleto'),
(3, 'Crédito', 'Pagamento por Crédito'),
(4, 'Débito Virtual', 'Cartão de Débito');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_produto`
--

CREATE TABLE `tipo_produto` (
  `id` int(2) NOT NULL,
  `tipo` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `descri` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tipo_produto`
--

INSERT INTO `tipo_produto` (`id`, `tipo`, `descri`) VALUES
(1, 'livro', 'livo padrão com capa mole'),
(2, 'livro capa dura', 'livro padão com capa dura'),
(3, 'mangá', 'mangá japonês'),
(4, 'revista', 'revista'),
(5, 'HQ', 'revistas em quadrinhos');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(4) NOT NULL,
  `nome` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cpf` int(8) NOT NULL,
  `email` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `senha` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `data_nasc` date NOT NULL,
  `telefone` varchar(14) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `compras` int(3) NOT NULL DEFAULT 0,
  `grupo` int(20) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `cpf`, `email`, `senha`, `data_nasc`, `telefone`, `compras`, `grupo`) VALUES
(1, 'Luiz Henrique da Mota Couto', 11246535, 'luizmtca@gmail.com', '123', '2005-03-31', '67984150233', 0, 1),
(2, 'Murilo', 235633523, '', '', '2010-12-31', '67986743332', 0, 1),
(3, 'João Henrique', 123321, '', '', '2007-03-21', '6796745547', 0, 3),
(4, 'Antônio', 24242472, '', '', '2012-02-22', '679884533', 0, 1),
(5, 'Otávio', 1641332678, '', '', '1995-10-11', '6798416233', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dados_banc`
--
ALTER TABLE `dados_banc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relacão1` (`id_cliente`);

--
-- Indexes for table `enderecos`
--
ALTER TABLE `enderecos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enderecos-usu` (`id_cliente`);

--
-- Indexes for table `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favoritos-usu` (`id_cliente`),
  ADD KEY `favoritos-produ` (`id_produto`);

--
-- Indexes for table `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidos-usu` (`id_cliente`),
  ADD KEY `pedidos-produ` (`id_produto`),
  ADD KEY `pedidos-pagam` (`pagamento`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produtos-categ` (`categoria`),
  ADD KEY `produtos-tipo` (`tipo`);

--
-- Indexes for table `tipo_pagamento`
--
ALTER TABLE `tipo_pagamento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipo_produto`
--
ALTER TABLE `tipo_produto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarios-grupo` (`grupo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `dados_banc`
--
ALTER TABLE `dados_banc`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tipo_pagamento`
--
ALTER TABLE `tipo_pagamento`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tipo_produto`
--
ALTER TABLE `tipo_produto`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dados_banc`
--
ALTER TABLE `dados_banc`
  ADD CONSTRAINT `relacão1` FOREIGN KEY (`id_cliente`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enderecos`
--
ALTER TABLE `enderecos`
  ADD CONSTRAINT `enderecos-usu` FOREIGN KEY (`id_cliente`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos-produ` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favoritos-usu` FOREIGN KEY (`id_cliente`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos-pagam` FOREIGN KEY (`pagamento`) REFERENCES `tipo_pagamento` (`id`),
  ADD CONSTRAINT `pedidos-produ` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`),
  ADD CONSTRAINT `pedidos-usu` FOREIGN KEY (`id_cliente`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos-categ` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `produtos-tipo` FOREIGN KEY (`tipo`) REFERENCES `tipo_produto` (`id`);

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios-grupo` FOREIGN KEY (`grupo`) REFERENCES `grupo` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
