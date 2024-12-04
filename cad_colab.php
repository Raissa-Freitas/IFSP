<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include_once('config.php');
        $cpf = $_POST['cpf'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $empresa = $_POST['empresa'];
        $tipo_usuario = $_POST['tipo_usuario'];

            // Verificar se a razão social selecionada existe na tabela empresa
        $sql_check_empresa = "SELECT 1 FROM empresa WHERE razao_social = ?";
        $stmt = $conexao->prepare($sql_check_empresa);
        $stmt->bind_param("s", $empresa);
        $stmt->execute();
        $stmt->store_result();


        $sql = "insert into usuario (cpf,nome,email,senha,empresa,tipo_usuario) values ('$cpf','$nome','$email','$senha','$empresa','$tipo_usuario')";
            if ($conexao->query($sql)===TRUE){
                echo "Novo registro cadastrado!";
            } else{
                echo "erro" .$sql."<br>" . $conexao->error;
            }
    }
?>

<?php
include_once('config.php');
 
 try {
     $connec = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
     $connec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $connec->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
 } catch (Exception $e) {
     echo "Erro de conexão: " . $e->getMessage();
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
    <style> 
        #selectbox {
        color: black;

        background-color: gray;
    }
    </style>
    <title>Cadastro Colaborador</title>
</head>
   
<body>
    <div class="containerCadastroColaborador">

        <form action="cad_colab.php" method = "POST">
            
            <fieldset>
                
                <legend class = "titulo_form">
                    Cadastrar Colaborador
                </legend>

                    <!--Solicita CPF do Colaborador, Formato especifico, campo obrigatório-->
                <div class="input-container">
                    <label for="cpf" class="label_input">CPF:</label><br>
                    <input type="cpf" id = "cpf" class="inputuser" name="cpf" required><br><br>
                </div>
    
                    <!--Solicita Nome Completo do Colaborador, campo obrigatório-->
                <div class="input-container">
                    <label for = "nome" class="label_input">Nome:</label><br>
                    <input type = "text" id = "nome" class="inputuser"  name="nome" required><br><br>
                </div>
    
                    <!--Solicita Email do Colaborador, campo obrigatório-->
                <div class = "input-container">
                    <label for="email" class="label_input">E-mail:</label><br>
                    <input type="email" id = "email" class="inputuser"  name="email" required> <br><br>
                </div>

                <div class = "input-container">
                    <label for="senha" class="label_input">Senha:</label><br>
                    <input type="password" id = "senha" class="inputuser"  name="senha" required> <br><br>
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
                    <input type="radio" name = "tipo_usuario" value="Colaborador">Colaborador
                    <input type="radio" name = "tipo_usuario" value="Empregador">Empregador <br><br>
                </div>
    
                    
                <!--Solicita foto do Colaborador, campo obrigatório-->
                <!-- <label for = "foto">Foto:</label><br>
                    <input type = "file" id="foto"  required><br><br>-->
            
                <br>

                <!--Botão cadastro do Colaborador-->
                <button class="Cadastrar" type = "submit" value="Cadastrar">
                    Cadastrar
                </button>

            </fieldset>
        </form>
    </div>
</body>
</html>