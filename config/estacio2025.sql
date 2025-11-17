-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 17/11/2025 às 19:09
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
-- Banco de dados: `estacio2025`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `qtd` int(11) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `valor` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `nome`, `qtd`, `descricao`, `valor`) VALUES
(1, '1984', 25, 'Um clássico distópico de George Orwell sobre vigilância totalitária e manipulação da verdade. Uma reflexão poderosa sobre liberdade e controle social.', 46),
(2, 'O Senhor dos Anéis: A Sociedade do Anel', 30, 'Primeira parte da épica trilogia de J.R.R. Tolkien. Acompanhe Frodo em sua jornada para destruir o Um Anel e salvar a Terra Média.', 90),
(4, 'O Hobbit', 20, 'A aventura que precede O Senhor dos Anéis. Bilbo Bolseiro parte em uma jornada inesperada com anões para recuperar um tesouro guardado por um dragão.', 55),
(5, 'Cem Anos de Solidão', 15, 'Obra-prima de Gabriel García Márquez que narra a história da família Buendía em Macondo, mesclando realismo mágico e crítica social.', 53),
(6, 'Orgulho e Preconceito', 35, 'Clássico de Jane Austen sobre Elizabeth Bennet e Mr. Darcy. Uma história atemporal sobre amor, classe social e superação de preconceitos.', 43),
(7, 'Romeu e Julieta', 40, 'A mais famosa tragédia romântica de Shakespeare. Dois jovens amantes de famílias rivais desafiam o destino por seu amor.', 29),
(8, 'O Morro dos Ventos Uivantes', 18, 'Romance gótico de Emily Brontë sobre paixão obsessiva, vingança e redenção nas charnecas inglesas.', 49),
(9, 'Dom Casmurro', 30, 'Obra clássica de Machado de Assis que questiona: Capitu traiu Bentinho? Um dos maiores enigmas da literatura brasileira.', 36),
(10, 'A Culpa é das Estrelas', 45, 'Romance contemporâneo de John Green sobre dois adolescentes com câncer que se apaixonam e vivem uma história emocionante.', 35),
(11, 'As Crônicas de Nárnia', 22, 'Coleção completa de C.S. Lewis. Sete livros que narram as aventuras mágicas no mundo de Nárnia, repleto de alegorias cristãs.', 66),
(12, 'Percy Jackson e o Ladrão de Raios', 38, 'Rick Riordan mistura mitologia grega com o mundo moderno. Percy descobre ser um semideus e embarca em aventuras épicas.', 40),
(13, 'A Guerra dos Tronos', 28, 'Primeiro livro de George R.R. Martin na saga As Crônicas de Gelo e Fogo. Intrigas políticas, dragões e batalhas pelo Trono de Ferro.', 60),
(14, 'O Nome do Vento', 20, 'Fantasia épica de Patrick Rothfuss. A história de Kvothe, um jovem prodígio que se torna lenda, contada por ele mesmo.', 65),
(15, 'Eragon', 25, 'Christopher Paolini cria um mundo de dragões, elfos e magia. Eragon, um jovem camponês, encontra um ovo de dragão e seu destino muda.', 50),
(16, 'O Silêncio dos Inocentes', 32, 'Thriller psicológico de Thomas Harris. A agente Clarice Starling busca ajuda do canibal Hannibal Lecter para capturar um serial killer.', 45),
(17, 'Garota Exemplar', 35, 'Gillian Flynn cria um thriller psicológico sobre um casamento que esconde segredos obscuros. O desaparecimento de Amy vira o jogo.', 47),
(18, 'O Código Da Vinci', 40, 'Dan Brown mistura história, arte e conspirações religiosas. Robert Langdon desvenda mistérios que podem abalar o cristianismo.', 43),
(19, 'A Paciente Silenciosa', 30, 'Alex Michaelides conta a história de uma mulher que para de falar após matar o marido. Um thriller psicológico impressionante.', 49),
(20, 'E Não Sobrou Nenhum', 28, 'Clássico de Agatha Christie. Dez pessoas são convidadas para uma ilha e começam a morrer uma a uma, seguindo uma cantiga infantil.', 39),
(21, 'Duna', 24, 'Obra-prima de Frank Herbert. Em um planeta desértico, Paul Atreides enfrenta intrigas políticas e descobre seu destino profético.', 70),
(22, 'Fundação', 20, 'Isaac Asimov cria uma saga galáctica sobre a queda e ascensão de civilizações, baseada em psicohistória.', 55),
(23, 'Neuromancer', 18, 'William Gibson define o cyberpunk. Hackers, inteligência artificial e um futuro distópico dominado por corporações.', 53),
(24, 'O Guia do Mochileiro das Galáxias', 35, 'Comédia sci-fi de Douglas Adams. Arthur Dent escapa da destruição da Terra e viaja pelo espaço com um guia eletrônico.', 45),
(25, 'Fahrenheit 451', 30, 'Ray Bradbury imagina uma sociedade onde livros são proibidos e bombeiros queimam qualquer exemplar encontrado.', 42),
(26, 'It: A Coisa', 26, 'Stephen King cria um dos monstros mais icônicos. Um grupo de amigos enfrenta uma entidade maligna que aterroriza sua cidade.', 63),
(27, 'O Iluminado', 32, 'Família isolada em hotel durante inverno. Jack Torrance enfrenta fantasmas e sua própria sanidade mental neste clássico de King.', 49),
(28, 'Drácula', 28, 'Clássico gótico de Bram Stoker que definiu o mito do vampiro moderno. Conde Drácula aterroriza a Inglaterra vitoriana.', 40),
(29, 'Frankenstein', 30, 'Mary Shelley cria a história do cientista que dá vida a uma criatura e enfrenta as consequências de brincar de Deus.', 37),
(30, 'O Exorcista', 22, 'William Peter Blatty narra a possessão demoníaca de uma menina e a batalha dos padres para salvá-la.', 45),
(31, 'O Poder do Hábito', 50, 'Charles Duhigg explica a ciência por trás dos hábitos e como transformá-los para melhorar sua vida pessoal e profissional.', 43),
(32, 'Mindset: A Nova Psicologia do Sucesso', 45, 'Carol Dweck apresenta a diferença entre mentalidade fixa e de crescimento, e como isso impacta o sucesso.', 47),
(33, 'Rápido e Devagar', 35, 'Daniel Kahneman explora os dois sistemas de pensamento do cérebro e como tomamos decisões.', 59),
(34, 'Pai Rico, Pai Pobre', 60, 'Robert Kiyosaki ensina educação financeira através da história de dois pais com visões opostas sobre dinheiro.', 40),
(35, 'Atomic Habits', 55, 'James Clear apresenta estratégias práticas para construir bons hábitos e eliminar maus hábitos através de pequenas mudanças.', 50),
(36, 'Steve Jobs', 30, 'Walter Isaacson narra a vida do fundador da Apple, suas inovações revolucionárias e personalidade complexa.', 55),
(37, 'Elon Musk', 35, 'Ashlee Vance conta a história do empreendedor por trás da Tesla, SpaceX e outras empresas revolucionárias.', 60),
(38, 'Minha História', 40, 'Michelle Obama compartilha sua jornada da infância em Chicago até se tornar Primeira-Dama dos Estados Unidos.', 53),
(39, 'O Diário de Anne Frank', 45, 'Relato emocionante de uma menina judia escondida durante a ocupação nazista na Holanda durante a Segunda Guerra Mundial.', 35),
(40, 'Einstein: Sua Vida, Seu Universo', 25, 'Walter Isaacson explora a vida do maior físico do século XX, suas descobertas e humanidade.', 65),
(41, 'Sapiens: Uma Breve História da Humanidade', 48, 'Yuval Noah Harari traça a evolução do Homo sapiens desde a Idade da Pedra até a era moderna.', 55),
(42, '21 Lições para o Século 21', 42, 'Harari analisa os desafios atuais: tecnologia, política, religião e o futuro da humanidade.', 50),
(43, 'A República', 20, 'Obra fundamental de Platão sobre justiça, política e a natureza da realidade através de diálogos socráticos.', 45),
(44, 'O Príncipe', 35, 'Maquiavel escreve sobre poder político e a arte de governar neste clássico controverso do pensamento político.', 33),
(45, 'Meditações', 30, 'Reflexões pessoais do imperador romano Marco Aurélio sobre estoicismo, ética e vida virtuosa.', 39),
(46, 'De Zero a Um', 38, 'Peter Thiel e Blake Masters discutem como construir empresas inovadoras que criam novos mercados.', 47),
(47, 'A Startup Enxuta', 40, 'Eric Ries apresenta metodologia para criar empresas de sucesso através de experimentação e aprendizado validado.', 53),
(48, 'Princípios', 32, 'Ray Dalio compartilha os princípios que o levaram ao sucesso nos negócios e na vida pessoal.', 65),
(49, 'O Investidor Inteligente', 28, 'Benjamin Graham, mentor de Warren Buffett, ensina os fundamentos do investimento em valor.', 70),
(50, 'Feitas para Durar', 30, 'Jim Collins analisa o que diferencia empresas visionárias de longa duração das demais empresas.', 59),
(51, 'star wars', 50, NULL, 50),
(52, 'a arte da guerra', 100, NULL, 100),
(53, 'bliblioteca da meia noite', 30, NULL, 55),
(54, 'codigo limpo', 40, 'um guia para programar de forma limpa e manutenivel', 80);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(60) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `estado` char(2) DEFAULT NULL,
  `telefone` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--




--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
