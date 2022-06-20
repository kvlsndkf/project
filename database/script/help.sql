-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Jun-2022 às 17:20
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `help`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `photo` text DEFAULT NULL,
  `document` text DEFAULT NULL,
  `document_name` varchar(255) DEFAULT NULL,
  `is_denounced` tinyint(1) NOT NULL,
  `is_blocked` tinyint(1) NOT NULL,
  `blocking_reason` varchar(100) DEFAULT NULL,
  `avg_avaliation` float NOT NULL,
  `like_answer` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_creator_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `answershasavaliations`
--

CREATE TABLE `answershasavaliations` (
  `id` int(11) NOT NULL,
  `avaliation` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `answer_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `person_avaliation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `answershaslikes`
--

CREATE TABLE `answershaslikes` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `answer_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `person_liked_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Erro', '2022-05-31 14:45:20', NULL),
(2, 'Dúvida', '2022-05-31 14:45:20', NULL),
(3, 'Apoio', '2022-05-31 14:45:20', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `about` varchar(474) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `about` text NOT NULL,
  `photo` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `courses`
--

INSERT INTO `courses` (`id`, `name`, `about`, `photo`, `created_at`, `updated_at`) VALUES
(50, 'Ensino médio', 'Essa etec é muito top em Essa etec é muito top em  Essa etec é muito top em  Essa etec é muito top em  Essa etec é muito top em  Essa etec é muito top em  Essa etec é muito top em ', '/project/private/adm/pages/register/upload/courses/62a8e222205e9.png', '2022-06-14 16:31:46', NULL),
(51, 'Administração', 'Essa etec é muito top em Essa etec é muito top em  Essa etec é muito top em  Essa etec é muito top em  Essa etec é muito top em  Essa etec é muito top em  Essa etec é muito top em ', '/project/private/adm/pages/register/upload/courses/62a8e237f31aa.png', '2022-06-14 16:32:07', NULL),
(52, 'Desenvolvimento de Sistemas', 'Essa etec é muito top em Essa etec é muito top em  Essa etec é muito top em  Essa etec é muito top em  Essa etec é muito top em  Essa etec é muito top em  Essa etec é muito top em ', '/project/private/adm/pages/register/upload/courses/62a8e252c41f9.png', '2022-06-14 16:32:34', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `courseshassubjects`
--

CREATE TABLE `courseshassubjects` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `course_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `courseshassubjects`
--

INSERT INTO `courseshassubjects` (`id`, `created_at`, `updated_at`, `course_id`, `subject_id`) VALUES
(80, '2022-06-14 16:31:46', NULL, 50, 65),
(81, '2022-06-14 16:31:46', NULL, 50, 66),
(82, '2022-06-14 16:32:08', NULL, 51, 63),
(83, '2022-06-14 16:32:08', NULL, 51, 64),
(84, '2022-06-14 16:32:34', NULL, 52, 61),
(85, '2022-06-14 16:32:34', NULL, 52, 62);

-- --------------------------------------------------------

--
-- Estrutura da tabela `courseshasteachers`
--

CREATE TABLE `courseshasteachers` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `course_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `courseshasteachers`
--

INSERT INTO `courseshasteachers` (`id`, `created_at`, `updated_at`, `course_id`, `teacher_id`) VALUES
(100, '2022-06-14 16:31:46', NULL, 50, 53),
(101, '2022-06-14 16:32:08', NULL, 51, 54),
(102, '2022-06-14 16:32:34', NULL, 52, 52);

-- --------------------------------------------------------

--
-- Estrutura da tabela `denunciations`
--

CREATE TABLE `denunciations` (
  `id` int(11) NOT NULL,
  `reason` varchar(30) NOT NULL,
  `post_link` varchar(100) NOT NULL,
  `status` varchar(30) NOT NULL,
  `conclusion` varchar(192) DEFAULT NULL,
  `context` varchar(30) DEFAULT NULL,
  `created_by_id` int(11) NOT NULL,
  `denounced_id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `modules`
--

INSERT INTO `modules` (`id`, `name`, `created_at`, `updated_at`) VALUES
(32, '1º Módulo', '2022-05-31 13:42:22', NULL),
(33, '2º Módulo', '2022-05-31 13:42:29', NULL),
(34, '3º Módulo', '2022-06-05 00:03:19', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `xp` int(11) NOT NULL,
  `link_question` text DEFAULT NULL,
  `question` text NOT NULL,
  `photo` text DEFAULT NULL,
  `document` text DEFAULT NULL,
  `document_name` varchar(255) DEFAULT NULL,
  `is_denounced` tinyint(1) NOT NULL,
  `is_blocked` tinyint(1) NOT NULL,
  `blocking_reason` varchar(100) DEFAULT NULL,
  `course_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `schools`
--

CREATE TABLE `schools` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `have_account` varchar(12) NOT NULL,
  `in_sp_city` varchar(14) DEFAULT NULL,
  `not_in_sp_city` varchar(14) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `github` text DEFAULT NULL,
  `linkedin` text DEFAULT NULL,
  `facebook` text DEFAULT NULL,
  `instagram` text DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `schools`
--

INSERT INTO `schools` (`id`, `name`, `address`, `have_account`, `in_sp_city`, `not_in_sp_city`, `about`, `github`, `linkedin`, `facebook`, `instagram`, `photo`, `created_at`, `updated_at`) VALUES
(167, 'Etec de Guaianases', 'Guaianases', 'Com conta', 'Inside city', '', 'Essa etec é muito top em Essa etec é muito top em  Essa etec é muito top em  Essa etec é muito top em  Essa etec é muito top em  Essa etec é muito top em  Essa etec é muito top em ', '', '', '', '', '/project/private/adm/pages/register/upload/schools/62a8dfa787060.png', '2022-06-14 16:21:11', NULL),
(168, 'Etec de Itaquera', 'Itaquera', 'Com conta', 'Inside city', '', 'Essa etec é muito top em Essa etec é muito top em  Essa etec é muito top em  Essa etec é muito top em  Essa etec é muito top em  Essa etec é muito top em  Essa etec é muito top em ', '', '', '', '', '/project/private/adm/pages/register/upload/schools/62a8dfc53ec6c.jpg', '2022-06-14 16:21:41', NULL),
(169, 'Etec de Poá', 'Poá', 'Com conta', '', 'Outside city', 'Essa etec é muito top em Essa etec é muito top em  Essa etec é muito top em  Essa etec é muito top em  Essa etec é muito top em  Essa etec é muito top em  Essa etec é muito top em ', '', '', '', '', '/project/private/adm/pages/register/upload/schools/62a8dfe31019d.jpg', '2022-06-14 16:22:11', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `schoolshascourses`
--

CREATE TABLE `schoolshascourses` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `school_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `schoolshascourses`
--

INSERT INTO `schoolshascourses` (`id`, `created_at`, `updated_at`, `school_id`, `course_id`) VALUES
(80, '2022-06-14 16:31:46', NULL, 169, 50),
(81, '2022-06-14 16:32:08', NULL, 168, 51),
(82, '2022-06-14 16:32:34', NULL, 167, 52);

-- --------------------------------------------------------

--
-- Estrutura da tabela `schoolshasstudents`
--

CREATE TABLE `schoolshasstudents` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `student_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `schoolshasteachers`
--

CREATE TABLE `schoolshasteachers` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `school_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `schoolshasteachers`
--

INSERT INTO `schoolshasteachers` (`id`, `created_at`, `updated_at`, `school_id`, `teacher_id`) VALUES
(218, '2022-06-14 16:21:11', NULL, 167, 52),
(219, '2022-06-14 16:21:11', NULL, 167, 53),
(220, '2022-06-14 16:21:11', NULL, 167, 54),
(221, '2022-06-14 16:21:41', NULL, 168, 52),
(222, '2022-06-14 16:21:41', NULL, 168, 53),
(223, '2022-06-14 16:21:41', NULL, 168, 54),
(224, '2022-06-14 16:22:11', NULL, 169, 52),
(225, '2022-06-14 16:22:11', NULL, 169, 54);

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitations`
--

CREATE TABLE `solicitations` (
  `id` int(11) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `register_link` varchar(100) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(192) NOT NULL,
  `status` varchar(30) NOT NULL,
  `conclusion` varchar(192) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `context_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `solicitations`
--

INSERT INTO `solicitations` (`id`, `contact`, `register_link`, `title`, `description`, `status`, `conclusion`, `category_id`, `context_id`, `created_at`, `updated_at`) VALUES
(1, 'teste1@gmaill.com', '', 'Não tem o nome da etec', 'Não tem o nome da etec que eu estudo no cadastro.', 'Resolvida', 'stjstj', 1, 0, '2022-06-14 16:39:34', '2022-06-14 17:10:30'),
(2, 'teste2@gmail.com', '', 'Não tem o curso', 'Aqui não tem o curso que eu faço que é o floricultura', 'Análise', NULL, 2, 0, '2022-06-14 16:41:07', '2022-06-14 16:41:28'),
(3, 'teste3@gmail.com', '', 'módulo', 'não tem o módulo.', 'Análise', NULL, 3, 0, '2022-06-14 17:08:26', '2022-06-14 17:08:31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitationscategories`
--

CREATE TABLE `solicitationscategories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `solicitationscategories`
--

INSERT INTO `solicitationscategories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Etec', '2022-06-14 16:38:08', NULL),
(2, 'Curso', '2022-06-14 16:38:17', NULL),
(3, 'Módulo', '2022-06-14 16:38:26', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitationscontexts`
--

CREATE TABLE `solicitationscontexts` (
  `id` int(11) NOT NULL,
  `context` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `solicitationscontexts`
--

INSERT INTO `solicitationscontexts` (`id`, `context`, `created_at`, `updated_at`) VALUES
(1, 'Solicitação acatada', '2022-06-19 13:58:52', '0000-00-00 00:00:00'),
(2, 'Solicitação negada', '2022-06-19 13:58:58', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `xp` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `created_at`, `updated_at`) VALUES
(61, 'Programação WEB I', '0000-00-00 00:00:00', NULL),
(62, 'Banco de Dados I', '0000-00-00 00:00:00', NULL),
(63, 'Design Digital', '0000-00-00 00:00:00', NULL),
(64, 'Ética', '0000-00-00 00:00:00', NULL),
(65, 'Física', '2022-06-13 19:39:15', NULL),
(66, 'Artes', '2022-06-13 19:39:21', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `photo`, `created_at`, `updated_at`) VALUES
(52, 'Professora Aline', '/project/private/adm/pages/register/upload/teachers/62a8ded228a56.jpg', '2022-06-14 16:17:38', NULL),
(53, 'Professor Anibal', '/project/private/adm/pages/register/upload/teachers/62a8df0409fdb.jpg', '2022-06-14 16:18:28', NULL),
(54, 'Professor Roberto', '/project/private/adm/pages/register/upload/teachers/62a8df1286ecb.jpg', '2022-06-14 16:18:42', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `photo` text NOT NULL,
  `type_user` varchar(40) NOT NULL,
  `is_confirmed` tinyint(1) NOT NULL,
  `key_confirm` text DEFAULT NULL,
  `is_blocked` tinyint(1) NOT NULL,
  `github` text DEFAULT NULL,
  `linkedin` text DEFAULT NULL,
  `facebook` text DEFAULT NULL,
  `instagram` text DEFAULT NULL,
  `profile_link` text DEFAULT NULL,
  `blocking_reason` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `blocked_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `photo`, `type_user`, `is_confirmed`, `key_confirm`, `is_blocked`, `github`, `linkedin`, `facebook`, `instagram`, `profile_link`, `blocking_reason`, `created_at`, `updated_at`, `blocked_at`) VALUES
(148, 'adm@gmail.com', '$2y$10$AIZ8zFf2W2v2zSO2YX9xP.tEWi7aWgNB7TRkOQGDOwUWnRHyTJjo.', '', 'administrator', 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-14 16:15:00', NULL, NULL),
(149, 'teste@teste', '$2y$10$.dRiV2jCAi/X1SKnvI21muVfIncCRKC311kNkcPrIs4Z/DDc4zAMK', '', 'administrator', 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-19 14:01:15', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usershaspreferences`
--

CREATE TABLE `usershaspreferences` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `preference_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `answer_creator_id` (`answer_creator_id`);

--
-- Índices para tabela `answershasavaliations`
--
ALTER TABLE `answershasavaliations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answer_id` (`answer_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `person_avaliation_id` (`person_avaliation_id`);

--
-- Índices para tabela `answershaslikes`
--
ALTER TABLE `answershaslikes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answer_id` (`answer_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `person_avaliation_id` (`person_liked_id`);

--
-- Índices para tabela `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices para tabela `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `courseshassubjects`
--
ALTER TABLE `courseshassubjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Índices para tabela `courseshasteachers`
--
ALTER TABLE `courseshasteachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Índices para tabela `denunciations`
--
ALTER TABLE `denunciations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by_id` (`created_by_id`),
  ADD KEY `denounced_id` (`denounced_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `answer_id` (`answer_id`);

--
-- Índices para tabela `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Índices para tabela `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `schoolshascourses`
--
ALTER TABLE `schoolshascourses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Índices para tabela `schoolshasstudents`
--
ALTER TABLE `schoolshasstudents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `school_id` (`school_id`);

--
-- Índices para tabela `schoolshasteachers`
--
ALTER TABLE `schoolshasteachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Índices para tabela `solicitations`
--
ALTER TABLE `solicitations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Índices para tabela `solicitationscategories`
--
ALTER TABLE `solicitationscategories`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `solicitationscontexts`
--
ALTER TABLE `solicitationscontexts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `module_id` (`module_id`);

--
-- Índices para tabela `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usershaspreferences`
--
ALTER TABLE `usershaspreferences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `preference_id` (`preference_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de tabela `answershasavaliations`
--
ALTER TABLE `answershasavaliations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `answershaslikes`
--
ALTER TABLE `answershaslikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `courseshassubjects`
--
ALTER TABLE `courseshassubjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de tabela `courseshasteachers`
--
ALTER TABLE `courseshasteachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de tabela `denunciations`
--
ALTER TABLE `denunciations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT de tabela `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT de tabela `schoolshascourses`
--
ALTER TABLE `schoolshascourses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de tabela `schoolshasstudents`
--
ALTER TABLE `schoolshasstudents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de tabela `schoolshasteachers`
--
ALTER TABLE `schoolshasteachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT de tabela `solicitations`
--
ALTER TABLE `solicitations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `solicitationscategories`
--
ALTER TABLE `solicitationscategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `solicitationscontexts`
--
ALTER TABLE `solicitationscontexts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT de tabela `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de tabela `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT de tabela `usershaspreferences`
--
ALTER TABLE `usershaspreferences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`answer_creator_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `answershasavaliations`
--
ALTER TABLE `answershasavaliations`
  ADD CONSTRAINT `answershasavaliations_ibfk_1` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `answershasavaliations_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `answershasavaliations_ibfk_3` FOREIGN KEY (`person_avaliation_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `answershaslikes`
--
ALTER TABLE `answershaslikes`
  ADD CONSTRAINT `answershaslikes_ibfk_1` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `answershaslikes_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `answershaslikes_ibfk_3` FOREIGN KEY (`person_liked_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `courseshassubjects`
--
ALTER TABLE `courseshassubjects`
  ADD CONSTRAINT `courseshassubjects_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `courseshassubjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `courseshasteachers`
--
ALTER TABLE `courseshasteachers`
  ADD CONSTRAINT `courseshasteachers_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `courseshasteachers_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `denunciations`
--
ALTER TABLE `denunciations`
  ADD CONSTRAINT `denunciations_ibfk_1` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `denunciations_ibfk_2` FOREIGN KEY (`denounced_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `denunciations_ibfk_3` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `denunciations_ibfk_4` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `questions_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `questions_ibfk_4` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `schoolshascourses`
--
ALTER TABLE `schoolshascourses`
  ADD CONSTRAINT `schoolshascourses_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `schoolshascourses_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `schoolshasstudents`
--
ALTER TABLE `schoolshasstudents`
  ADD CONSTRAINT `schoolshasstudents_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `schoolshasstudents_ibfk_2` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `schoolshasteachers`
--
ALTER TABLE `schoolshasteachers`
  ADD CONSTRAINT `schoolshasteachers_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `schoolshasteachers_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `solicitations`
--
ALTER TABLE `solicitations`
  ADD CONSTRAINT `solicitations_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `solicitationscategories` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `usershaspreferences`
--
ALTER TABLE `usershaspreferences`
  ADD CONSTRAINT `usershaspreferences_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `usershaspreferences_ibfk_2` FOREIGN KEY (`preference_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
