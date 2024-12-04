<?php
session_start();
//print_r($_REQUEST);

if (isset($_POST['submit']) && !empty($_POST['cpf']) && !empty($_POST['senha'])) {
    // Acessa
    include_once('config.php');
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    // Verifica no banco de dados se existe esse usuário na tabela sispointer (usuário sispointer)
    $sql_sispointer = "SELECT * FROM sispointer WHERE cpf = '$cpf' AND senha = '$senha'";
    $result_sispointer = $conexao->query($sql_sispointer);

    // Verifica se existe o colaborador na tabela usuario (tipo_usuario = 'colaborador')
    $sql_colab = "SELECT * FROM usuario WHERE cpf = '$cpf' AND senha = '$senha' AND tipo_usuario = 'colaborador'";
    $result_colab = $conexao->query($sql_colab);

    // Verifica se existe o empregador na tabela usuario (tipo_usuario = 'empregador')
    $sql_emp = "SELECT * FROM usuario WHERE cpf = '$cpf' AND senha = '$senha' AND tipo_usuario = 'empregador'";
    $result_emp = $conexao->query($sql_emp);

    // Checa se algum dos resultados retornou um usuário válido
    if (mysqli_num_rows($result_sispointer) > 0) {
        // Usuário encontrado na tabela sispointer
        $_SESSION['cpf'] = $cpf;
        $_SESSION['senha'] = $senha;
        header('Location: index.php');
    } elseif (mysqli_num_rows($result_colab) > 0) {
        // Usuário encontrado como colaborador
        $_SESSION['cpf'] = $cpf;
        $_SESSION['senha'] = $senha;
        header('Location: index_colab.php'); // Redireciona para o index do colaborador
    } elseif (mysqli_num_rows($result_emp) > 0) {
        // Usuário encontrado como empregador
        $_SESSION['cpf'] = $cpf;
        $_SESSION['senha'] = $senha;
        header('Location: index_emp.php'); // Redireciona para o index do empregador
    } else {
        // Se nenhum usuário válido foi encontrado
        unset($_SESSION['cpf']);
        unset($_SESSION['senha']);
        header('Location: login.html');
    }
} else {
    // Não acessa
    header('Location: login.html');
}
?>
