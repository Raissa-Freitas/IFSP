<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include_once('config.php');
        $cpf = $_POST['cpf'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $empresa = $_POST['empresa'];
        $tipo_usuario = $_POST['tipo_usuario'];

        $sql = "insert into usuario (cpf,nome,email,empresa,tipo_usuario) values ('$cpf','$nome','$email','$empresa','$tipo_usuario')";
        if ($conn->query($sql)===TRUE){
            echo "Novo registro cadastrado!";
        } else{
            echo "erro" .$sql."<br>" . $conn->error;
        }
    }
?>


