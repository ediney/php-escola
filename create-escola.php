<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

// Checagem para ver se POST data não está vazio
if (!empty($_POST)) {
    // Inserção de novo registro
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
	
    // Checagem para ver se a variavel "nome" existe no sistema, senão, por default, o valor fica em branco para todas as variáveis
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $telefone = isset($_POST['endereco']) ? $_POST['endereco'] : '';
    $data = isset($_POST['data']) ? $_POST['data'] : date('d-m-Y');
    $situacao = isset($_POST['situacao']) ? $_POST['situacao'] : '';
	
	// Inserção de novo registro na tabela escolas
    $stmt = $pdo->prepare('INSERT INTO escolas VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $nome, $endereco, $data, $situacao]);
    
	// Mensagem de saída
    $msg = 'Escola cadastrada com sucesso!';
}
?>

<?=template_header('Create')?>

<div class="content update">
	<h2>Nova escola</h2>
    <form action="create-escola.php" method="post">
        <label for="id">ID</label>
        <label for="nome">Nome</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id">
        <input type="text" name="nome" placeholder="Escola A" id="nome">
        <label for="text">Endereço</label>
		<input type="text" name="endereco" placeholder="Rua 1" id="endereco">       
        <label for="data">Data</label>
        <input type="datetime" name="data" value="<?=date('d-m-Y')?>" id="data">
		<label for="situacao">Situação</label>
		<input type="text" name="situacao" placeholder="" id="situacao">
        <input type="submit" value="Novo">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>