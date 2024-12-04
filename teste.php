<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once('config.php');
    
    // Capturando os dados do formulário
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $empresa = $_POST['empresa'];
    $tipo_usuario = $_POST['tipo_usuario'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Informações do Usuário</title>
</head>
<body>
    <div class="containerCadastroColaborador">
        <fieldset>
            <legend class="titulo_form">Informações do Usuário</legend>
            
            <p><strong>CPF:</strong> <?php echo $cpf; ?></p>
            <p><strong>Nome:</strong> <?php echo $nome; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Empresa:</strong> <?php echo $empresa; ?></p>
            <p><strong>Perfil:</strong> <?php echo $tipo_usuario; ?></p>

            <br><a href="index.html">Voltar ao formulário</a>
        </fieldset>
    </div>
</body>
</html>
