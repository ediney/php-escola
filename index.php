<?php
include 'functions.php';
// Código PHP.

?>

<?=template_header('Home')?>

<div class="content">
	<br>
	<div>
    	<h2>Controle de Alunos</h1>
        <a href="create-aluno.php"><i class="fas fa-plus-circle"></i>Novo Registro </a>
		<a href="read-aluno.php"><i class="fas fa-address-book"></i>Lista de Registros </a>
		<a href="update-aluno.php"><i class="fas fa-edit"></i>Atualizar Registro </a>
		<a href="delete-aluno.php"><i class="far fa-trash-alt"></i>Excluir Registro </a>
    </div>
	<br>
	<div>
    	<h2>Controle de Turmas</h1>
        <a href="create-turma.php"><i class="fas fa-plus-circle"></i>Novo Registro </a>
		<a href="read-turma.php"><i class="fas fa-address-book"></i>Lista de Registros </a>
		<a href="update-turma.php"><i class="fas fa-edit"></i>Atualizar Registro </a>
		<a href="delete-turma.php"><i class="far fa-trash-alt"></i>Excluir Registro </a>
    </div>
	<br>
	<div>
    	<h2>Controle de Escolas</h1>
        <a href="create-escola.php"><i class="fas fa-plus-circle"></i>Novo Registro </a>
		<a href="read-escola.php"><i class="fas fa-address-book"></i>Lista de Registros </a>
		<a href="update-escola.php"><i class="fas fa-edit"></i>Atualizar Registro </a>
		<a href="delete-escola.php"><i class="far fa-trash-alt"></i>Excluir Registro </a>
    </div>
</div>

<?=template_footer()?>