<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

// Checa por id se existe o aluno, por exemplo "update.php?id=1"
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
		
        // Checagem para ver se a variavel "nome" existe no sistema, senão, por default, o valor fica em branco para todas as variáveis
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
        $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
		$nascimento = isset($_POST['nascimento']) ? $_POST['nascimento'] : date('d-m-Y');
        $genero = isset($_POST['genero']) ? $_POST['genero'] : '';
		
        // Atualiza o registro
        $stmt = $pdo->prepare('UPDATE alunos SET id = ?, nome = ?, telefone = ?, email = ?, nascimento = ?, genero = ? WHERE id = ?');
        $stmt->execute([$id, $nome, $telefone, $email, $nascimento, $genero, $_GET['id']]);
        $msg = 'Informações atualizadas com sucesso!';
    }
    // Seleciona da tabela alunos o registro para atualização de informações
    $stmt = $pdo->prepare('SELECT * FROM alunos WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $aluno = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$aluno) {
        exit('Aluno não encontrado!');
    }
} else {
    exit('ID não informada!');
}
?>

<?=template_header('Read')?>

<div class="content update">
	<h2>Alteração de Registro #<?=$aluno['id']?></h2>
    <form action="update-aluno.php?id=<?=$aluno['id']?>" method="post">
        <label for="id">ID</label>
        <label for="nome">Nome</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id">
        <input type="text" name="nome" placeholder="Fulano de Tal" id="nome">
        <label for="phone">Telefone</label>
		<input type="text" name="phone" placeholder="659963-1234" id="phone">
        <label for="mail">Email</label>
        <input type="text" name="email" placeholder="fulanodetal@phpescola.com" id="email">        
        <label for="nascimento">Data de Nascimento</label>
        <input type="datetime" name="nascimento" value="<?=date('d-m-Y')?>" id="nascimento">
		<label for="genero">Sexo</label>
		<input type="text" name="genero" placeholder="M ou F" id="genero">
        <input type="submit" value="Alterar">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>