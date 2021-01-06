<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

// Checagem para ver se POST data não está vazio
if (!empty($_POST)) {
    // Inserção de novo registro
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
	
    // Checagem para ver se a variavel "ano" existe no sistema, senão, por default, o valor fica em branco para todas as variáveis
    $ano = isset($_POST['ano']) ? $_POST['ano'] : '';
    $nivel = isset($_POST['nivel']) ? $_POST['nivel'] : '';
    $serie = isset($_POST['serie']) ? $_POST['serie'] : '';
    $turno = isset($_POST['turno']) ? $_POST['turno'] : '');
    $escola = isset($_POST['escola']) ? $_POST['escola'] : '';
	
	// Inserção de novo registro na tabela turmas
    $stmt = $pdo->prepare('INSERT INTO turmas VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $ano, $nivel, $serie, $turno, $escola]);
    
	// Mensagem de saída
    $msg = 'Turma cadastrada com sucesso!';
}
?>

<?=template_header('Create')?>

<div class="content update">
	<h2>Nova turma</h2>
    <form action="create-turma.php" method="post">
        <label for="id">ID</label>
		<input type="text" name="id" placeholder="26" value="auto" id="id">
        <label for="ano">Ano</label>
        <input type="text" name="ano" placeholder="2021" id="ano">
        <label for="text">Nível de Escolaridade</label>
		<input type="text" name="nivel" placeholder="Ensino Médio" id="nivel">
        <label for="turno">Turno</label>
        <input type="text" name="turno" placeholder="matutino" id="turno">        
        <label for="serie">Série</label>
        <input type="text" name="serie" placeholder="1o. ano" id="serie">
		<label for="escola">Escola</label>
		<input type="text" name="escola" placeholder="" id="escola">
        <input type="submit" value="Novo">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>