<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include_once('config.php');
        $cnpj = $_POST['cnpj'];
        $razao_social = $_POST['razao_social'];
        $nome_fantasia = $_POST['nome_fantasia'];
       
        // Verificar se o CNPJ já existe no banco de dados
        $sqlCheck = "SELECT * FROM empresa WHERE cnpj = '$cnpj'";
        $result = $conexao->query($sqlCheck);

        if ($result->num_rows > 0) {
            // Se o CNPJ já existir, exibe uma mensagem de erro
            echo "Erro: Empresa já cadastrada com o CNPJ informado.";
        } else {
            // Caso contrário, insere o novo registro
            $sqlInsert = "INSERT INTO empresa (cnpj, razao_social, nome_fantasia) VALUES ('$cnpj', '$razao_social', '$nome_fantasia')";
            
            if ($conexao->query($sqlInsert) === TRUE) {
                echo "Novo registro cadastrado!";
            } else {
                echo "Erro: " . $conexao->error;
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="containerCadastroEmpresa">

        <form action="cad_emp1.php" method = "POST">
            
            <fieldset>
                
                <legend class = "titulo_form">
                    Cadastrar Empresa
                </legend>

                    <!--Solicita cnpj da Empresa, Formato especifico, campo obrigatório-->
                <div class="input-container">
                    <label for="cnpj" class="label_input">CNPJ:</label><br>
                    <input type="cnpj" id = "cnpj" class="inputuser" name="cnpj" required><br><br>
                </div>
    
                    <!--Solicita razao_social Completo da Empresa, campo obrigatório-->
                <div class="input-container">
                    <label for = "razao_social" class="label_input">Razao social:</label><br>
                    <input type = "text" id = "razao_social" class="inputuser"  name="razao_social" required><br><br>
                </div>
    
                    <!--Solicita nome_fantasia da Empresa, campo obrigatório-->
                <div class = "input-container">
                    <label for="nome_fantasia" class="label_input">Nome Fantasia:</label><br>
                    <input type="nome_fantasia" id = "nome_fantasia" class="inputuser"  name="nome_fantasia" required> <br><br>
                </div>
   

                <!--Botão cadastro da Empresa-->
                <button class="Cadastrar" type = "submit" value="Cadastrar">
                    Cadastrar
                </button>

            </fieldset>
        </form>
    </div>
</body>
</html>