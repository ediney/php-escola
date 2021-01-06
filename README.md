# Controle de alunos

## Descrição
<p align="justify"> Sistema de controle de alunos de uma escola. Basicamente é um sistema com as opções de cadastrar, editar, listar e excluir alunos, turmas e/ou escolas, ou seja, um CRUD em PHP.</p>

### Estrutura do projeto
- arquivos de configuração
    - index.php: página inicial
    - functions.php: arquivo de funções
    - style.css: arquivo de estilos
    
- CRUD da tabela alunos
    - create-aluno.php
    - read-aluno.php
    - update-aluno.php
    - delete-aluno.php
    
- CRUD da tabela turmas
    - create-turma.php
    - read-turma.php
    - update-turma.php
    - delete-turma.php
    
- CRUD da tabela escolas
    - create-escola.php
    - read-escola.php
    - update-escola.php
    - delete-escola.php

### Checklist  

- [X] Criação do banco de dados e configuração das tabelas
- [X] Criação e configuração dos estilos (CSS)
- [X] Criação e configuração das funções
- [X] Criação e configuração da página inicial
- [X] Criação e configuração dos arquivos de CRUD
- [ ] Tabela Alunos de Turmas

### Lista de tarefas a serem concluídas ou melhoradas
1. Página inicial está com a configuração visual muito básica;
2. Métodos update só estão funcionando via url na barra de endereços - opção: um formulário para essas funcionalidades;
3. Função para exibir a data que vem do banco no formato d-m-Y;

### Scripts SQL utilizados
`CREATE TABLE IF NOT EXISTS 'alunos' (
	'id' int(11) NOT NULL AUTO_INCREMENT,
  	'nome' varchar(255) NOT NULL,
	'telefone' varchar(50) NOT NULL,
  	'email' varchar(50) NOT NULL,
	'nascimento' datetime NOT NULL,
  	'genero' char(1) NOT NULL,
	PRIMARY KEY ('id')
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;`

`CREATE TABLE IF NOT EXISTS 'escolas' (
	'id' int(11) NOT NULL AUTO_INCREMENT,
  	'nome' varchar(255) NOT NULL,
	'endereco' varchar(50) NOT NULL,
	'data' datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  	'situacao' varchar(50) NOT NULL,
	PRIMARY KEY ('id')
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;`

`CREATE TABLE IF NOT EXISTS 'turmas' (
	'id' int(11) NOT NULL AUTO_INCREMENT,
  	'ano' int(4) NOT NULL,
	'nivel' varchar(50) NOT NULL,
	'serie' varchar(10) NOT NULL,
	'turno' varchar(50) NOT NULL,
	'escola' int(11) NOT NULL,
	PRIMARY KEY ('id')
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;`

`ALTER TABLE 'turmas' ADD CONSTRAINT 'fk_escola' FOREIGN KEY ( 'escola' ) REFERENCES 'escolas' ( 'id' ) ;`

`INSERT INTO 'alunos' ('id', 'nome', 'telefone', 'email', 'nascimento', 'genero') VALUES
(1, 'Pedro Soares', '(65)99500-1234','pedrosoares@phpescola.com',  '1996-08-05', 'M'),
(2, 'Luara Dias', '(65)99400-5678', 'luaradias@phpescola.com',  '1998-05-28','F'),
(3, 'Amanda Souza', '(65)99309-9012', 'amandasouza@phpescola.com',  '1999-01-17','F'),
(4, 'Adriano Alves', '(65)9961-3456','adrianoalvescba@phpescola.com', '1997-05-18','M'),
(5, 'Simone Ferreira', '(65)99701-7890','ferreirasimone@phpescola.com', '1996-09-02','F'),
(6, 'Carlos Vieira', '(65)99260-1234','carlopvieira@phpescola.com', '1998-06-25','M'),
(7, 'Jorge Marques', '(65)9950-5678','jorgemarques@phpescola.com', '1997-11-13','M'),
(8, 'Felipe Palhares', '(65)99786-9012','fpalhares@phpescola.com', '1997-03-15','M'),
(9, 'Bruno Costa', '(65)99202-3456','brunocosta0@phpescola.com', '1998-08-04','M'),
(10, 'Rafael Mendes', '(65)99200-7890','rafamendes55@phpescola.com', '1996-05-21','M'),
(11, 'Juliana Lopes', '(65)99202-1234','julianalopes586@phpescola.com', '1996-12-19','F'),
(12, 'Daniel Silva', '(65)99202-5678','danielsilva@phpescola.com', '1997-09-01','M');`

Obs.: foi utilizado nomes e dados fictícios para preencher o sql. 
