<?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    
    include_once('config.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cnpj = $_POST['cnpj'];
        $razao_social = isset($_POST['razao_social']) ? $_POST['razao_social'] : 'Não registrado';
        $nome_fantasia = isset($_POST['nome_fantasia']) ? $_POST['nome_fantasia'] : 'Não registrado';
    
        // Debugging: exibir os valores
        echo "CNPJ: $cnpj<br>";
        echo "Razão Social: $razao_social<br>";
        echo "Nome Fantasia: $nome_fantasia<br>";
    
        $stmt = $conn->prepare("INSERT INTO empresa (cnpj, razao_social, nome_fantasia) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $cnpj, $razao_social, $nome_fantasia);
    
        if (empty($razao_social) || empty($nome_fantasia)) {
            echo "Razão social e nome fantasia não podem estar vazios.";
            exit;
        }
        
        if ($stmt->execute() === TRUE) {
            echo "Novo registro cadastrado!";
        } else {
            echo "Erro: " . $stmt->error;
        }
    
        $stmt->close();
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
        <form action="cad_emp.php" method = "POST">
            <fieldset> <!--Agrupar dentro de uma caixa-->
                <legend class = "titulo_form">Cadastrar Empresa</legend><!--Titulo do agrupamento-->
                    
                    <!--10/10/2024 Foi retirado esse campo da tela do cadastro por ser-->
                    <!--Solicita código do colaborador, permitindo apenas numeros, campo obrigatório-->
                    <!--<div class="input-container">
                        <label for="codigo">Código:</label><br>
                        <input type="number" id = "codigo" class="inputuser"  name = "codigo"><br><br>
                    </div>-->
                    
                    <!--Solicita CNPJ da Empresa, Formato especifico, campo obrigatório-->
                    <div class="input-container">
                        <label for="cnpj" class="label_input">CNPJ:</label><br>
                        <input type="cnpj" id = "cnpj" class="inputuser" name="cnpj" required><br><br>
                    </div>

                    <!--Solicita a Razão Social da Empresa, campo obrigatório-->
                    <div class="input-container">
                        <label for = "razao_social" class="label_input">Razão Social:</label><br>
                        <input type = "text" id = "razao_social" class="inputuser" name="razao_social" required><br><br>
                    </div>

                    <!--Solicita Nome Fantasia da Empresa, campo obrigatório-->
                    <div class="input-container">
                        <label for = "nome_fantasia" class="label_input">Nome Fantasia:</label><br>
                        <input type = "text" id = "nome_fantasia" class="inputuser" name="nome_fantasia" required><br><br>
                    </div>

                    <!--Solicita fota da Empresa(logo), campo opcional-->
                    <!--<div class="input-container">
                        <label for = "foto">Foto:</label><br>
                        <input type = "file" id="foto"><br><br>
                    </div>-->

                    <br><!--Pula Linha-->

                    <!--Botão cadastro da Empresa-->
                    <button class="Cadastrar" type = "submit" value="Cadastrar">Cadastrar</button> 
            </fieldset>
        </form>
    </div>
</body>
</html>