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
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $nascimento = isset($_POST['nascimento']) ? $_POST['nascimento'] : date('d-m-Y');
    $genero = isset($_POST['genero']) ? $_POST['genero'] : '';
	
	// Inserção de novo registro na tabela alunos
    $stmt = $pdo->prepare('INSERT INTO alunos VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $nome, $telefone, $email, $nascimento, $genero]);
    
	// Mensagem de saída
    $msg = 'Aluno cadastrado com sucesso!';
}
?>

<?=template_header('Create')?>

<div class="content update">
	<h2>Novo Aluno</h2>
    <form action="create-aluno.php" method="post">
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
        <input type="submit" value="Novo">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>