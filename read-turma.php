<?php
include 'functions.php';

// Conexão ao banco de dados
$pdo = pdo_connect_mysql();

// Coleta via GET request (URL param: page), caso não exista fica por default a página 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

// Quantidade de registros a exibir por página
$records_per_page = 5;

// Preparação do SQL statement e coleta dos dados da tabela turmas, de acordo com o limite definido
$stmt = $pdo->prepare('SELECT * FROM turmas ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();

// Fetch os registros que podem ser exibidos na tela
$alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Coleta do número total de turmas, de acordo com os botões avançar e anterior
$num_alunos = $pdo->query('SELECT COUNT(*) FROM turmas')->fetchColumn();
?>

<?=template_header('Read')?>

<div class="content read">
	<h2>Lista de Turmas</h2>
	<a href="create-turma.php" class="create">Adicionar turma</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Ano</td>
                <td>Nível</td>
                <td>Série</td>
                <td>Turno</td>
				<td>Escola</td>
                <td></td>				
            </tr>
        </thead>
        <tbody>
            <?php foreach ($turmas as $turma): ?>
            <tr>
                <td><?=$turma['id']?></td>
                <td><?=$turma['ano']?></td>
                <td><?=$turma['nivel']?></td>
                <td><?=$turma['serie']?></td>
                <td><?=$turma['turno']?></td>
                <td><?=$turma['escola']?></td>
                <td class="actions">
                    <a href="update-turma.php?id=<?=$turma['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete-turma.php?id=<?=$turma['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read-turma.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_turmas): ?>
		<a href="read-turma.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>