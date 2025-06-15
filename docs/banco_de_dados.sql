-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16/06/2025 às 00:58
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_eventos`
--
CREATE DATABASE IF NOT EXISTS `db_eventos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_eventos`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos`
--

CREATE TABLE `alunos` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `senha` varchar(250) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `cpf` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `lugar` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `curso` varchar(100) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `cont_participantes` int(11) NOT NULL DEFAULT 0,
  `palestrante_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `eventos`
--

INSERT INTO `eventos` (`id`, `titulo`, `descricao`, `lugar`, `data`, `hora`, `curso`, `foto`, `cont_participantes`, `palestrante_id`) VALUES
(2, 'Conectando o Mundo: Soluções Web na Prática', 'Este evento é voltado para estudantes e profissionais da área de Sistemas para Internet que desejam explorar o desenvolvimento de aplicações web modernas. Serão abordados temas como front-end responsivo, back-end escalável, APIs, segurança e tendências atuais no universo web. Uma oportunidade para aprender com quem está no mercado e trocar experiências práticas com outros desenvolvedores.', 'UniALFA - Auditório', '2025-06-20', '19:30:00', 'Sistemas para Internet', 'evento_si.jpg', 0, 7),
(3, 'PHP na Veia: Desenvolvendo com Eficiência no Back-end', 'Evento focado em programadores iniciantes e intermediários que desejam dominar o PHP, uma das linguagens mais utilizadas no desenvolvimento web. A programação abordará desde os fundamentos da linguagem até conceitos de orientação a objetos, integração com banco de dados e boas práticas. Ideal para quem quer construir aplicações dinâmicas e robustas com PHP.', 'UniALFA - Lab. Info 03', '2025-06-23', '20:00:00', 'Sistemas para Internet', 'php1.png', 0, 7),
(4, 'Direito em Foco: Desafios e Tendências no Século XXI', 'Uma palestra voltada para estudantes, profissionais e interessados na área jurídica, com discussões sobre temas atuais como Direito Digital, LGPD, mediação de conflitos e a evolução da legislação frente às transformações sociais e tecnológicas. Palestrantes experientes trarão insights práticos e reflexões sobre o futuro da advocacia e da justiça no Brasil.', 'UniALFA - Auditório', '2025-07-12', '20:00:00', 'Direito', 'evento_direito.jpg', 0, 4),
(5, 'Mentes em Movimento: Psicologia e Bem-Estar na Atualidade', 'Este evento tem como foco o papel da psicologia na promoção da saúde mental em diferentes contextos, especialmente entre jovens e adultos. Serão abordados temas como ansiedade, inteligência emocional, relações interpessoais e estratégias de enfrentamento no cotidiano. Um espaço de diálogo, aprendizado e troca de experiências com profissionais da área.', 'UniALFA - Auditório', '2025-06-30', '17:00:00', 'Psicologia', 'evento_psico.jpg', 0, 2),
(6, 'Pedagogia Inovadora: Transformando a Educação do Século XXI', 'Um encontro dedicado a educadores, gestores e interessados em novas metodologias de ensino. O evento abordará práticas pedagógicas centradas no aluno, o uso da tecnologia em sala de aula, inclusão e a importância do desenvolvimento socioemocional no processo de aprendizagem. Uma oportunidade para repensar e aprimorar a educação com foco no futuro.', 'UniALFA - Sala 11', '2025-06-24', '19:00:00', 'Pedagogia', 'evento_pedag.jpg', 0, 1),
(7, 'Gestão Eficiente: Estratégias para o Sucesso Empresarial', 'Evento voltado para estudantes e profissionais de Administração que desejam aprimorar suas habilidades em gestão, liderança e tomada de decisão. Serão discutidos temas como planejamento estratégico, inovação, gestão de equipes e sustentabilidade nos negócios. Uma chance de se atualizar com cases reais e insights de especialistas do mercado.', 'UniALFA - Sala 12', '2025-06-25', '20:30:00', 'Administração', 'evento_admin.jpg', 0, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `inscricoes`
--

CREATE TABLE `inscricoes` (
  `id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `data_inscricao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `palestrantes`
--

CREATE TABLE `palestrantes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `foto` varchar(250) DEFAULT NULL,
  `tema` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `palestrantes`
--

INSERT INTO `palestrantes` (`id`, `nome`, `descricao`, `foto`, `tema`) VALUES
(1, 'Juliana Ribeiro', 'Juliana Ribeiro é pedagoga com mais de 12 anos de experiência na área de educação infantil e metodologias ativas de aprendizagem. Atualmente, atua como coordenadora pedagógica em uma rede de escolas inovadoras e ministra palestras sobre inclusão, ludicidade e o uso da tecnologia em sala de aula. É conhecida por sua abordagem acolhedora e pela forma prática como transmite seus conhecimentos aos educadores.', 'palestrante_educ.jpg', 'Educação'),
(2, 'Camila Duarte', 'Camila Duarte é psicóloga clínica com foco em saúde mental de adolescentes e jovens adultos. Formada pela UFRJ, possui especialização em Terapia Cognitivo-Comportamental e já atuou em projetos sociais de apoio emocional em escolas públicas. É palestrante sobre temas como ansiedade, autoestima e inteligência emocional, sempre com uma linguagem acessível e empática que conecta com diferentes públicos.', 'palestrante_psico.jpg', 'Psicologia'),
(3, 'Rafael Monteiro', 'Rafael Monteiro é empreendedor serial e fundador de três startups de tecnologia voltadas para o setor de educação e finanças. Com uma trajetória marcada por inovação e superação, já participou de programas de aceleração no Brasil e no exterior. Suas palestras abordam temas como validação de ideias, criação de modelos de negócio e liderança jovem, sempre com uma pegada motivacional e prática.', 'palestrante_empr.jpg', 'Empreendedorismo'),
(4, 'Dr. Henrique Vasconcelos', 'Dr. Henrique Vasconcelos é advogado especialista em Direito Digital e Proteção de Dados, com mais de 15 anos de atuação. É mestre em Direito Empresarial e tem se destacado como consultor jurídico para empresas de tecnologia. Suas palestras abordam temas atuais como LGPD, ética no uso de dados e os desafios legais na era da informação, sempre com uma abordagem clara e acessível tanto para juristas quanto para o público leigo.', 'palestrante_dire.jpg', 'Direito'),
(5, 'Lucas Santana', 'Lucas Santana é mentor de carreira e especialista em desenvolvimento profissional, com mais de 10 anos de experiência em recrutamento e seleção em grandes empresas. Formado em Administração com MBA em Gestão de Pessoas, já ajudou centenas de profissionais a se reposicionarem no mercado de trabalho. Em suas palestras, aborda temas como planejamento de carreira, transição profissional e construção de marca pessoal, com uma linguagem prática e motivadora.', 'palestrante_carr.jpg', 'Carreira'),
(6, 'Dra. Bianca Melo', 'Dra. Bianca Melo é médica clínica geral com atuação focada em prevenção e promoção da saúde. Com experiência em programas comunitários e campanhas de saúde pública, também é conhecida por seu trabalho em educação em saúde e estilo de vida saudável. Em suas palestras, fala sobre autocuidado, alimentação equilibrada, saúde mental e a importância da medicina preventiva, sempre com empatia e uma linguagem acessível ao público.', 'palestrante_saude.jpg', 'Saúde'),
(7, 'Diego Almeida', 'Diego Almeida é desenvolvedor full stack com mais de 8 anos de experiência na área de tecnologia. É formado em Ciência da Computação e atua como instrutor em cursos de programação para iniciantes. Já participou de hackathons nacionais e projetos open source. Em suas palestras, aborda temas como lógica de programação, boas práticas de desenvolvimento e tendências no mercado de tecnologia, sempre com foco em inclusão e aprendizado prático.', 'palestrante_info.jpg', 'Tecnologia');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk1` (`palestrante_id`);

--
-- Índices de tabela `inscricoes`
--
ALTER TABLE `inscricoes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unica_inscricao` (`aluno_id`,`evento_id`) USING BTREE,
  ADD KEY `fk3` (`evento_id`);

--
-- Índices de tabela `palestrantes`
--
ALTER TABLE `palestrantes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `inscricoes`
--
ALTER TABLE `inscricoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `palestrantes`
--
ALTER TABLE `palestrantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`palestrante_id`) REFERENCES `palestrantes` (`id`);

--
-- Restrições para tabelas `inscricoes`
--
ALTER TABLE `inscricoes`
  ADD CONSTRAINT `fk2` FOREIGN KEY (`aluno_id`) REFERENCES `alunos` (`id`),
  ADD CONSTRAINT `fk3` FOREIGN KEY (`evento_id`) REFERENCES `eventos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
