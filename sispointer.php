<?php
if (isset($_POST['submit'])) {

    include_once('config.php');

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $conexao->prepare("INSERT INTO sispointer (nome, cpf, email, senha) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nome, $cpf, $email, $senha);

    header('Location: login.html');

    if ($stmt->execute()) {
        echo "Novo registro criado com sucesso!";
    } else {
        echo "Erro ao criar registro: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro | SisPoint</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-box">
        <img src="logo.png" alt="Logo" class="logo">
        <h1>Cadastro SisPointer</h1>
        <form action="sispointer.php" method="POST">
            <div class="input-group">
                <label for="nome">Nome completo</label>
                <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo" required>
            </div>
            <div class="input-group">
                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" placeholder="Digite seu CPF" required>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Digite seu email" required>
            </div>
            <div class="input-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
            </div>
            <button type="submit" class="btn" name="submit" id="submit">Cadastrar</button>
            <a href="login.html" class="back-link">Já possui conta? Faça login</a>
            
            
        </form>
        <br>
        <a href="cad_usuario.php" class="btn" class="back-link">Cadastrar usuario</a>
    </div>
</body>
</html>
