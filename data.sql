DROP DATABASE IF EXISTS `api_dashboard_biblioteca`;
CREATE DATABASE `api_dashboard_biblioteca`; USE `api_dashboard_biblioteca`;

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
 `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
 `nome` VARCHAR(255) NOT NULL DEFAULT '',
 `email` VARCHAR(255) NOT NULL DEFAULT '',
 `password` VARCHAR(255) NOT NULL DEFAULT '',
 `forget` VARCHAR(255) DEFAULT NULL,
 `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `updated_at` TIMESTAMP NULL DEFAULT NULL ON
UPDATE CURRENT_TIMESTAMP, PRIMARY KEY (`id`), UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `users` (`id`, `nome`, `email`, `password`, `created_at`, `updated_at`) VALUES
	(1,'Adonay Douglas', 'adonay.douglas@nubbi.com.br','$2a$12$dwk2mLN6OyKN2oM04h6iF.SSXDvvs6dFZ2niugTDKFap9XrZKIEb6','2018-09-03 16:39:07','2018-11-13 15:11:45');
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
 `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
 `titulo` VARCHAR(255) NOT NULL DEFAULT '',
 `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON
UPDATE CURRENT_TIMESTAMP, PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

INSERT INTO `categorias` (`titulo`) VALUES
('Biografias'),
('Coleções'),
('Comportamento'),
('Contos'),
('Crítica Literária'),
('Ficção Científica'),
('Folclore'),
('Genealogia'),
('Humor'),
('Infanto juvenis'),
('Jogos'),
('Jornais'),
('Literatura Brasileira'),
('Literatura Estrangeira'),
('Livros Raros'),
('Manuscritos'),
('Poesia'),
('Outros Assuntos'),
('Administração'),
('Agricultura'),
('Antropologia'),
('Arqueologia'),
('Arquitetura'),
('Artes'),
('Astronomia'),
('Biologia'),
('Botânica'),
('Brasil'),
('Ciência Política'),
('Ciências Exatas'),
('Cinema'),
('Comunicação'),
('Contabilidade'),
('Decoração'),
('Dicionários'),
('Didáticos'),
('Direito'),
('Documentos'),
('Ecologia'),
('Economia'),
('Engenharia'),
('Enciclopédias'),
('Ensino de Idiomas'),
('Filosofia'),
('Fotografia'),
('Geografia'),
('Guerra'),
('História do Brasil'),
('História Geral'),
('Informática'),
('Linguística'),
('Medicina'),
('Moda'),
('Música'),
('Pecuária'),
('Pedagogia'),
('Pintura'),
('Psicologia'),
('Saúde'),
('Sociologia'),
('Teatro'),
('Turismo'),
('Artesanato'),
('Auto ajuda'),
('Culinária'),
('Esoterismo'),
('Esportes'),
('Hobbies'),
('Religião'),
('Sexualidade');

DROP TABLE IF EXISTS `alunos`;

CREATE TABLE `alunos` (
 `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
 `nome` VARCHAR(255) NOT NULL DEFAULT '',
 `email` VARCHAR(255) NOT NULL DEFAULT '',
 `documento` VARCHAR(255) NOT NULL DEFAULT '',
 `endereco` VARCHAR(255) NOT NULL DEFAULT '',
 `telefone` VARCHAR(255) NOT NULL DEFAULT '',
 `sexo` VARCHAR(1) NOT NULL DEFAULT 'M' COMMENT 'M, F',
 `data_nascimento` date DEFAULT NULL,
 `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON
UPDATE CURRENT_TIMESTAMP, PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

INSERT INTO `alunos` (`nome`, `email`, `documento`, `endereco`, `telefone`) VALUES
 ('Adonay Douglas', 'Adonay@email.com', '51665656069', 'Rua dos Bobos', '(11) 51805-7537'),
 ('Murilo Santos', 'Murilo@email.com', '63448217018', 'Rua dos Bobos', '(91) 81211-8960'),
 ('Julios', 'Julios@email.com', '63328946012', 'Rua dos Bobos', '(95) 66651-1536'),
 ('Spiga & Spiga', 'Spiga@email.com', '81089169094', 'Rua dos Bobos', '(11) 20570-6541');
 
DROP TABLE IF EXISTS `livros`;

CREATE TABLE `livros` (
 `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
 `categoria` INT(11) UNSIGNED NOT NULL DEFAULT '0',
 `isbn` VARCHAR(255) NOT NULL DEFAULT '',
 `titulo` VARCHAR(255) NOT NULL DEFAULT '',
 `autor` VARCHAR(255) NOT NULL DEFAULT '',
 `editora` VARCHAR(255) NOT NULL DEFAULT '',
 `ano` VARCHAR(4) NOT NULL DEFAULT '',
 `disponivel` VARCHAR(3) NOT NULL DEFAULT 'Sim' COMMENT 'Sim, Não',
 `situacao_livro` VARCHAR(20) NOT NULL DEFAULT 'Ok' COMMENT 'Ok, Danificado, Destruído',
 `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON
UPDATE CURRENT_TIMESTAMP, PRIMARY KEY (`id`), KEY `categoria_id` (`categoria`), CONSTRAINT `categoria_id` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id`) ON
DELETE CASCADE ON
UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

INSERT INTO `livros` (`isbn`, `categoria`, `titulo`, `autor`, `editora`, `ano`) VALUES
 ('9780007136568', 1,'O Senhor dos Anéis', 'J. R. R. Tolkien', 'Allen & Unwin', '1954'),
 ('9788869183157', 2,'Harry Potter', 'J. K. Rowling', 'Bloomsbury Publishing Rocco Presença', '1998-2007'),
 ('9780375432309', 3,'O Código Da Vinci', 'Dan Brown', 'Editora Arqueiro', '2004');

DROP TABLE IF EXISTS `locacoes`;

CREATE TABLE `locacoes` (
 `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
 `aluno` INT(11) UNSIGNED NOT NULL DEFAULT '0',
 `livro` INT(11) UNSIGNED NOT NULL DEFAULT '0',
 `situacao_livro` VARCHAR(20) NOT NULL DEFAULT 'Ok' COMMENT 'Ok, Danificado',
 `status` INT(11) NOT NULL DEFAULT '1',
 `data_locacao` date NOT NULL,
 `data_devolucao` date NOT NULL,
 `devolucao_atradasa` date DEFAULT NULL,
 `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON
UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`), 
KEY `locacao_aluno_id` (`aluno`), 
KEY `locacao_livro_id` (`livro`), 
CONSTRAINT `locacao_aluno_id` FOREIGN KEY (`aluno`) REFERENCES `alunos` (`id`) ON
DELETE CASCADE ON
UPDATE NO ACTION, 
CONSTRAINT `locacao_livro_id` FOREIGN KEY (`livro`) REFERENCES `livros` (`id`) ON
DELETE CASCADE ON
UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

DROP TABLE IF EXISTS `notificacoes`;

CREATE TABLE `notificacoes` (
 `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
 `aluno` INT(11) UNSIGNED NOT NULL DEFAULT '0',
 `livro` INT(11) UNSIGNED NOT NULL DEFAULT '0',
 `text` VARCHAR(255) NOT NULL DEFAULT '',
 `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON
UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`), 
KEY `notificacao_aluno_id` (`aluno`), 
KEY `notificacao_livro_id` (`livro`), 
CONSTRAINT `notificacao_aluno_id` FOREIGN KEY (`aluno`) REFERENCES `alunos` (`id`) ON
DELETE CASCADE ON
UPDATE NO ACTION, 
CONSTRAINT `notificacao_livro_id` FOREIGN KEY (`livro`) REFERENCES `livros` (`id`) ON
DELETE CASCADE ON
UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;


