<?php
    
    
    if(!empty($_GET['codigo']))
    {

        include_once('config.php');

        $codigo = $_GET['codigo'];

        $sqlSelect = "SELECT * FROM usuario WHERE codigo=$codigo";

        $result = $conexao->query($sqlSelect);

        if($result -> num_rows > 0)
        {
            while($user_data = mysqli_fetch_assoc($result))
            {
                $cpf = $user_data['cpf'];
                $nome = $user_data['nome'];
                $email = $user_data['email'];
                $empresa = $user_data['empresa'];
                $tipo_usuario = $user_data['tipo_usuario'];
            }
            // print_r($nome);
            
        }
        else
        {
            header('Location: index.php');
        }

  
    }
?>

<?php
$host = 'Localhost';
$user = 'root';
$pass = '';
$db = 'registro_hora';

try{
    $connec = new PDO ("mysql:host=$host;dbname=$db", $user, $pass);
    $connec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connec->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch(Exception $e) { 
    echo $e->getMessage();
    exit;
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
    <style> 
        #selectbox {
        color: white;

        background-color: gray;
    }
    </style>
</head>
<body>
    <div class="containerCadastroColaborador">

        <form action="save_edit_colab.php" method = "POST">
            
            <fieldset>
                
                <legend class = "titulo_form">
                    Modificar Colaborador
                </legend>

                    <!--Solicita CPF do Colaborador, Formato especifico, campo obrigatório-->
                <div class="input-container">
                    <label for="cpf" class="label_input">CPF:</label><br>
                    <input type="cpf" id = "cpf" class="inputuser" name="cpf" value="<?php echo $cpf ?>" required><br><br>
                </div>
    
                    <!--Solicita Nome Completo do Colaborador, campo obrigatório-->
                <div class="input-container">
                    <label for = "nome" class="label_input">Nome:</label><br>
                    <input type = "text" id = "nome" class="inputuser"  name="nome" value="<?php echo $nome ?>" required><br><br>
                </div>
    
                    <!--Solicita Email do Colaborador, campo obrigatório-->
                <div class = "input-container">
                    <label for="email" class="label_input">E-mail:</label><br>
                    <input type="email" id = "email" class="inputuser"  name="email" value="<?php echo $email ?>" required> <br><br>
                </div>
    
                    <!--Solicita o código da empresa que o funcionário irá atuar, campo obrigatório-->
                    <div class = "input-container">
                    <label for="empresa" class="label_input">Empresa:</label><br><br>      
                    <select name="empresa" id = "selectbox" class="inputuser" required>
                        <option class="selectbox" value="">Selecione a empresa</option>
                        <?php 
                        $query = $connec->query("SELECT razao_social FROM empresa ORDER BY razao_social ASC");
                        $registros = $query->fetchall(PDO::FETCH_ASSOC);
                        foreach($registros as $option) { 
                            ?>
                                <option value="<?php echo $option['razao_social']; ?>"><?php echo $option['razao_social']; ?></option>
                            <?php    
                        }    
                        ?>
                    </select>
                </div>    
    
                    <!--Solicita o tipo_usuario do funcionário, campo obrigatório-->
                <div class = "input-container"><br>
                    <label for="tipo_usuario">Perfil:</label><br>
                    <input type="radio" name = "tipo_usuario" value="Colaborador" <?php echo $tipo_usuario == '1' ? 'checked' : '' ?> required
                    >Colaborador
                    <input type="radio" name = "tipo_usuario" value="Empregador" <?php echo $tipo_usuario == '2' ? 'checked' : '' ?> required
                    >Empregador <br><br>
                </div>
    
                    
                <!--Solicita foto do Colaborador, campo obrigatório-->
                <!-- <label for = "foto">Foto:</label><br>
                    <input type = "file" id="foto"  required><br><br>-->
            
                <br>
                <input type="hidden" name="codigo" value="<?php echo $codigo ?>">
                <!--Botão cadastro do Colaborador-->
                <input type = "submit" name="update" id="update" value="Salvar alteração">
                    

            </fieldset>
        </form>
    </div>
</body>
</html>


