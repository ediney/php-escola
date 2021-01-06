<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Checagem de existência de registro
if (isset($_GET['id'])) {
    // Seleção do registro para exclusão
    $stmt = $pdo->prepare('SELECT * FROM alunos WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $aluno = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$aluno) {
        exit('Aluno não encontrado!');
    }
    // Confirmação de exclusão
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // Usuário clicou no botão "Sim", delete o registro
            $stmt = $pdo->prepare('DELETE FROM alunos WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'Registro excluido com sucesso!';
        } else {
            // Usuário clicou no botão "Não", redirecione para a lista de alunos
            header('Location: read-aluno.php');
            exit;
        }
    }
} else {
    exit('ID não informada!');
}
?>

<?=template_header('Delete')?>

<div class="content delete">
	<h2>Exclusão de Registro #<?=$aluno['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Você tem certeza que deseja apagar o registro #<?=$aluno['id']?>?</p>
    <div class="yes">
        <a href="delete-aluno.php?id=<?=$aluno['id']?>&confirm=yes">Sim</a>
    </div>
	<div class="no">
        <a href="delete-aluno.php?id=<?=$aluno['id']?>&confirm=no">Não</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>