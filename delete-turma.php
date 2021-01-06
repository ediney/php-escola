<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Checagem de existência de registro
if (isset($_GET['id'])) {
    // Seleção do registro para exclusão
    $stmt = $pdo->prepare('SELECT * FROM turmas WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $turma = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$turma) {
        exit('turma não encontrado!');
    }
    // Confirmação de exclusão
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // Usuário clicou no botão "Sim", delete o registro
            $stmt = $pdo->prepare('DELETE FROM turmas WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'Registro excluido com sucesso!';
        } else {
            // Usuário clicou no botão "Não", redirecione para a lista de turmas
            header('Location: read-turma.php');
            exit;
        }
    }
} else {
    exit('ID não informada!');
}
?>

<?=template_header('Delete')?>

<div class="content delete">
	<h2>Exclusão de Registro #<?=$turma['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Você tem certeza que deseja apagar o registro #<?=$turma['id']?>?</p>
    <div class="yes">
        <a href="delete-turma.php?id=<?=$turma['id']?>&confirm=yes">Sim</a>
    </div>
	<div class="no">
        <a href="delete-turma.php?id=<?=$turma['id']?>&confirm=no">Não</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>