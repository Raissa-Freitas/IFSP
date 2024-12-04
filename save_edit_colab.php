<?php
include_once('config.php');

if (isset($_POST['update'])) {
    // Obtenha os dados do formulário
    $codigo = $_POST['codigo']; // Você precisa obter o código
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $empresa = $_POST['empresa'];
    $tipo_usuario = $_POST['tipo_usuario'];

    // Prepare a consulta de atualização
    $sqlUpdate = "UPDATE usuario SET cpf='$cpf', nome='$nome', email='$email', empresa='$empresa', tipo_usuario='$tipo_usuario' WHERE codigo='$codigo'";

    // Execute a consulta
    if ($conexao->query($sqlUpdate) === TRUE) {
        // Atualização bem-sucedida
        header('Location: tab_colab.php');
        exit(); // Certifique-se de sair após o redirecionamento
    } else {
        // Trate o erro caso a atualização falhe
        echo "Erro ao atualizar o registro: " . $conexao->error;
    }
} else {
    echo "Nenhum dado recebido.";
}
?>
