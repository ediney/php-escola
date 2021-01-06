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
