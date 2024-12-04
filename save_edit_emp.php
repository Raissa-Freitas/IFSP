<?php
include_once('config.php');

if (isset($_POST['update'])) {
    // Obtenha os dados do formulário
    $codigo_emp = $_POST['codigo_emp']; // Você precisa obter o código
    $cnpj = $_POST['cnpj'];
    $razao_social = $_POST['razao_social'];
    $nome_fantasia = $_POST['nome_fantasia'];
  

    // Prepare a consulta de atualização
    $sqlUpdate = "UPDATE empresa SET cnpj='$cnpj', razao_social='$razao_social', nome_fantasia='$nome_fantasia'  WHERE codigo_emp='$codigo_emp'";

    // Execute a consulta
    if ($conexao->query($sqlUpdate) === TRUE) {
        // Atualização bem-sucedida
        header('Location: tab_emp.php');
        exit(); // Certifique-se de sair após o redirecionamento
    } else {
        // Trate o erro caso a atualização falhe
        echo "Erro ao atualizar o registro: " . $conexao->error;
    }
} else {
    echo "Nenhum dado recebido.";
}
?>
