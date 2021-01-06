<?php
include 'functions.php';

// Conexão ao banco de dados
$pdo = pdo_connect_mysql();

// Coleta via GET request (URL param: page), caso não exista fica por default a página 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

// Quantidade de registros a exibir por página
$records_per_page = 5;

// Preparação do SQL statement e coleta dos dados da tabela alunos, de acordo com o limite definido
$stmt = $pdo->prepare('SELECT * FROM alunos ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();

// Fetch os registros que podem ser exibidos na tela
$alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Coleta do número total de alunos, de acordo com os botões avançar e anterior
$num_alunos = $pdo->query('SELECT COUNT(*) FROM alunos')->fetchColumn();
?>

<?=template_header('Read')?>

<div class="content read">
	<h2>Lista de Alunos</h2>
	<a href="create-aluno.php" class="create">Adicionar aluno</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Nome</td>
                <td>Telefone</td>
                <td>E-mail</td>
                <td>Data de Nascimento</td>
                <td>Sexo</td>
                <td></td>				
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alunos as $aluno): ?>
            <tr>
                <td><?=$aluno['id']?></td>
                <td><?=$aluno['nome']?></td>
                <td><?=$aluno['telefone']?></td>
                <td><?=$aluno['email']?></td>
                <td><?=$aluno['nascimento']?></td>
                <td><?=$aluno['genero']?></td>
                <td class="actions">
                    <a href="update-aluno.php?id=<?=$aluno['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete-aluno.php?id=<?=$aluno['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read-aluno.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_alunos): ?>
		<a href="read-aluno.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>