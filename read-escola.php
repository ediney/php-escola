<?php
include 'functions.php';

// Conexão ao banco de dados
$pdo = pdo_connect_mysql();

// Coleta via GET request (URL param: page), caso não exista fica por default a página 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

// Quantidade de registros a exibir por página
$records_per_page = 5;

// Preparação do SQL statement e coleta dos dados da tabela escolas, de acordo com o limite definido
$stmt = $pdo->prepare('SELECT * FROM escolas ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();

// Fetch os registros que podem ser exibidos na tela
$escolas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Coleta do número total de escolas, de acordo com os botões avançar e anterior
$num_escolas = $pdo->query('SELECT COUNT(*) FROM escolas')->fetchColumn();
?>

<?=template_header('Read')?>

<div class="content read">
	<h2>Lista de escolas</h2>
	<a href="create-escola.php" class="create">Adicionar escola</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Nome</td>
                <td>Endereço</td>
                <td>Data</td>
                <td>Situação</td>
                <td></td>				
            </tr>
        </thead>
        <tbody>
            <?php foreach ($escolas as $escola): ?>
            <tr>
                <td><?=$escola['id']?></td>
                <td><?=$escola['nome']?></td>
                <td><?=$escola['endereco']?></td>
                <td><?=$escola['data']?></td>
                <td><?=$escola['situacao']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$escola['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$escola['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read-escola.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_alunos): ?>
		<a href="read-escola.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>