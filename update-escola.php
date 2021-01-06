<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

// Checa por id se existe a escola, por exemplo "update.php?id=1"
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
		
        // Checagem para ver se a variavel "nome" existe no sistema, senão, por default, o valor fica em branco para todas as variáveis
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
        $endereco = isset($_POST['endereco']) ? $_POST['endereco'] : '';
		$data = isset($_POST['data']) ? $_POST['data'] : date('d-m-Y');
        $situacao = isset($_POST['situacao']) ? $_POST['situacao'] : '';
		
        // Atualiza o registro
        $stmt = $pdo->prepare('UPDATE escolas SET id = ?, nome = ?, endereco = ?, data = ?, situacao = ? WHERE id = ?');
        $stmt->execute([$id, $nome, $endereco, $data, $situacao, $_GET['id']]);
        $msg = 'Informações atualizadas com sucesso!';
    }
    // Seleciona da tabela escolas o registro para atualização de informações
    $stmt = $pdo->prepare('SELECT * FROM escolas WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $escola = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$escola) {
        exit('escola não encontrado!');
    }
} else {
    exit('ID não informada!');
}
?>

<?=template_header('Read')?>

<div class="content update">
	<h2>Alteração de Registro #<?=$escola['id']?></h2>
    <form action="update-escola.php?id=<?=$escola['id']?>" method="post">
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
        <input type="submit" value="Alterar">
    </form>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>