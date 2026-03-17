-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/01/2026 às 04:34
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ecommerce`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(2) NOT NULL,
  `tipo` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categorias`
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
-- Estrutura para tabela `dados_banc`
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
-- Despejando dados para a tabela `dados_banc`
--

INSERT INTO `dados_banc` (`id`, `cartao`, `codigo_cartao`, `nome_titu`, `id_cliente`, `validade`) VALUES
(1, '444667788', 454, 'Marcelo Couto', 1, '0000-00-00'),
(2, '5502090846066796', 444, 'Luiz H M Couto', 2, '0000-00-00'),
(3, '5961225779330881', 211, 'Antonio Couto', 3, '0000-00-00'),
(4, '3542356234656567', 555, 'Murilo Couto', 4, '0000-00-00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `enderecos`
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
-- Despejando dados para a tabela `enderecos`
--

INSERT INTO `enderecos` (`id`, `rua`, `bairro`, `numero`, `complemento`, `cidade`, `uf`, `cep`, `id_cliente`) VALUES
(1, 'Antonio Maria Coelho', 'Centro', 331, 'Prédio de apartamento', 'Campo Grande', 'MS', 7951222, 1),
(2, 'José Cangussu', 'Vilas Boas', 332, 'Casa de Esquina', 'Campo Grande', 'MS', 7951735, 2),
(3, 'Rua da Divisão', 'Aero Rancho', 229, 'Condomínio Village', 'Campo Grande', 'MS', 7971145, 3),
(4, 'Rua dos Carvalhos', 'Santo Antonio', 98, 'Casa', 'Campinas', 'SP', 82765123, 4),
(5, 'Av. Mato Grosso', 'Chácara Cachoeira', 40, 'Mansão do Ellon Musk', 'Campo Grande', 'MS', 7988821, 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `favoritos`
--

CREATE TABLE `favoritos` (
  `id` int(4) NOT NULL,
  `id_produto` int(4) NOT NULL,
  `id_cliente` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `grupo`
--

CREATE TABLE `grupo` (
  `id` int(1) NOT NULL,
  `tipo` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `descri` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `grupo`
--

INSERT INTO `grupo` (`id`, `tipo`, `descri`) VALUES
(1, 'cliente', 'cliente da loja'),
(2, 'autorizado', 'funcionário da loja'),
(3, 'administrador', 'administrador');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(4) NOT NULL,
  `id_produto` int(4) NOT NULL,
  `valor_produto` decimal(10,0) NOT NULL,
  `valor_total` double NOT NULL,
  `quantidade` int(11) NOT NULL,
  `id_cliente` int(4) NOT NULL,
  `data` date NOT NULL,
  `pagamento` int(2) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
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
-- Despejando dados para a tabela `produtos`
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
-- Estrutura para tabela `tipo_pagamento`
--

CREATE TABLE `tipo_pagamento` (
  `id` int(2) NOT NULL,
  `tipo` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `descri` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipo_pagamento`
--

INSERT INTO `tipo_pagamento` (`id`, `tipo`, `descri`) VALUES
(1, 'Pix', 'Pagamento por Pix'),
(2, 'Boleto', 'Pagamento po Boleto'),
(3, 'Crédito', 'Pagamento por Crédito'),
(4, 'Débito Virtual', 'Cartão de Débito');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo_produto`
--

CREATE TABLE `tipo_produto` (
  `id` int(2) NOT NULL,
  `tipo` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `descri` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipo_produto`
--

INSERT INTO `tipo_produto` (`id`, `tipo`, `descri`) VALUES
(1, 'livro', 'livo padrão com capa mole'),
(2, 'livro capa dura', 'livro padão com capa dura'),
(3, 'mangá', 'mangá japonês'),
(4, 'revista', 'revista'),
(5, 'HQ', 'revistas em quadrinhos');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(4) NOT NULL,
  `nome` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cpf` int(8) NOT NULL,
  `email` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `senha` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `data_nasc` date NOT NULL,
  `telefone` varchar(14) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `compras` int(3) NOT NULL DEFAULT 0,
  `grupo` int(20) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `cpf`, `email`, `senha`, `data_nasc`, `telefone`, `compras`, `grupo`) VALUES
(1, 'Luiz Henrique da Mota Couto', 11246535, 'luizmtca@gmail.com', '123', '2005-03-31', '67984150233', 0, 1),
(2, 'Murilo', 235633523, '', '', '2010-12-31', '67986743332', 0, 1),
(3, 'João Henrique', 123321, '', '', '2007-03-21', '6796745547', 0, 3),
(4, 'Antônio', 24242472, '', '', '2012-02-22', '679884533', 0, 1),
(5, 'Otávio', 1641332678, '', '', '1995-10-11', '6798416233', 0, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `dados_banc`
--
ALTER TABLE `dados_banc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relacão1` (`id_cliente`);

--
-- Índices de tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enderecos-usu` (`id_cliente`);

--
-- Índices de tabela `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favoritos-usu` (`id_cliente`),
  ADD KEY `favoritos-produ` (`id_produto`);

--
-- Índices de tabela `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidos-usu` (`id_cliente`),
  ADD KEY `pedidos-produ` (`id_produto`),
  ADD KEY `pedidos-pagam` (`pagamento`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produtos-categ` (`categoria`),
  ADD KEY `produtos-tipo` (`tipo`);

--
-- Índices de tabela `tipo_pagamento`
--
ALTER TABLE `tipo_pagamento`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tipo_produto`
--
ALTER TABLE `tipo_produto`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarios-grupo` (`grupo`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `dados_banc`
--
ALTER TABLE `dados_banc`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tipo_pagamento`
--
ALTER TABLE `tipo_pagamento`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tipo_produto`
--
ALTER TABLE `tipo_produto`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `dados_banc`
--
ALTER TABLE `dados_banc`
  ADD CONSTRAINT `relacão1` FOREIGN KEY (`id_cliente`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `enderecos`
--
ALTER TABLE `enderecos`
  ADD CONSTRAINT `enderecos-usu` FOREIGN KEY (`id_cliente`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos-produ` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favoritos-usu` FOREIGN KEY (`id_cliente`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos-pagam` FOREIGN KEY (`pagamento`) REFERENCES `tipo_pagamento` (`id`),
  ADD CONSTRAINT `pedidos-produ` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`),
  ADD CONSTRAINT `pedidos-usu` FOREIGN KEY (`id_cliente`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos-categ` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `produtos-tipo` FOREIGN KEY (`tipo`) REFERENCES `tipo_produto` (`id`);

--
-- Restrições para tabelas `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios-grupo` FOREIGN KEY (`grupo`) REFERENCES `grupo` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
