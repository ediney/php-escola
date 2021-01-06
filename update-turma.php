<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

// Checa por id se existe a turma, por exemplo "update.php?id=1"
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
		
        // Checagem para ver se a variavel "ano" existe no sistema, senão, por default, o valor fica em branco para todas as variáveis
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $ano = isset($_POST['ano']) ? $_POST['nome'] : '';
        $nivel = isset($_POST['nivel']) ? $_POST['nivel'] : '';
        $serie = isset($_POST['serie']) ? $_POST['serie'] : '';
		$turno = isset($_POST['turno']) ? $_POST['turno'] : '';
        $escola = isset($_POST['escola']) ? $_POST['escola'] : '';
		
        // Atualiza o registro
        $stmt = $pdo->prepare('UPDATE turmas SET id = ?, ano = ?, nivel = ?, serie = ?, turno = ?, escola = ? WHERE id = ?');
        $stmt->execute([$id, $ano, $nivel, $serie, $turno, $escola, $_GET['id']]);
        $msg = 'Informações atualizadas com sucesso!';
    }
    // Seleciona da tabela turmas o registro para atualização de informações
    $stmt = $pdo->prepare('SELECT * FROM turmas WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $turma = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$turma) {
        exit('Turma não encontrado!');
    }
} else {
    exit('ID não informada!');
}
?>

<?=template_header('Read')?>

<div class="content update">
	<h2>Alteração de Registro #<?=$turma['id']?></h2>
    <form action="update-turma.php?id=<?=$turma['id']?>" method="post">
        <label for="id">ID</label>
		<input type="text" name="id" placeholder="26" value="auto" id="id">
        <label for="ano">Ano</label>        
        <input type="text" name="ano" placeholder="2021" id="ano">
        <label for="nivel">Nível de escolaridade</label>
		<input type="text" name="nivel" placeholder="Ensino médio" id="nivel">
        <label for="serie">Série</label>
        <input type="text" name="serie" placeholder="1o. ano" id="serie">        
        <label for="turno">Turno</label>
        <input type="text" name="turno" placeholder="matutino" id="turno">
		<label for="escola">Escola</label>
		<input type="text" name="escola" placeholder="" id="escola">
        <input type="submit" value="Alterar">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>