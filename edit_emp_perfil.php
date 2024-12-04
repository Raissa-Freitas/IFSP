<?php
    
    
    if(!empty($_GET['codigo_emp']))
    {

        include_once('config.php');

        $codigo_emp = $_GET['codigo_emp'];

        $sqlSelect = "SELECT * FROM empresa WHERE codigo_emp=$codigo_emp";

        $result = $conexao->query($sqlSelect);

        if($result -> num_rows > 0)
        {
            while($user_data = mysqli_fetch_assoc($result))
            {
                $cnpj = $user_data['cnpj'];
                $razao_social = $user_data['razao_social'];
                $nome_fantasia = $user_data['nome_fantasia'];
                
            }
            // print_r($razao_social);
            
        }
        else
        {
            header('Location: index.php');
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
    <title>Sispoint</title>
</head>
<body>
    <div class="containerCadastroEmpresa">

        <form action="save_edit_perfil_emp.php" method = "POST">
            
            <fieldset>
                
                <legend class = "titulo_form">
                    Modificar Empresa
                </legend>

                    <!--Solicita cnpj do Empresa, Formato especifico, campo obrigatório-->
                <div class="input-container">
                    <label for="cnpj" class="label_input">CNPJ:</label><br>
                    <input type="cnpj" id = "cnpj" class="inputuser" name="cnpj" value="<?php echo $cnpj ?>" required><br><br>
                </div>
    
                    <!--Solicita razao_social Completo do Empresa, campo obrigatório-->
                <div class="input-container">
                    <label for = "razao_social" class="label_input">Razao social:</label><br>
                    <input type = "text" id = "razao_social" class="inputuser"  name="razao_social" value="<?php echo $razao_social ?>" required><br><br>
                </div>

                    <!--Solicita razao_social Completo do Empresa, campo obrigatório-->
                <div class="input-container">
                    <label for = "nome_fantasia" class="label_input">Nome fantasia:</label><br>
                    <input type = "text" id = "nome_fantasia" class="inputuser"  name="nome_fantasia" value="<?php echo $nome_fantasia ?>" required><br><br>
                </div>
    

                <!--Solicita foto do Empresa, campo obrigatório-->
                <!-- <label for = "foto">Foto:</label><br>
                    <input type = "file" id="foto"  required><br><br>-->
            
                <br>
                <input type="hidden" name="codigo_emp" value="<?php echo $codigo_emp ?>">
                <!--Botão cadastro do Empresa-->
                <input type = "submit" name="update" id="update" value="Salvar alteração">
                    

            </fieldset>
        </form>
    </div>
</body>
</html>


