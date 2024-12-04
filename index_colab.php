<?php
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION['cpf']) || !isset($_SESSION['senha'])) {
    header('Location: login.html');
    exit();
}

// Conexão com o banco de dados
include('config.php'); // Substitua pelo arquivo de conexão ao seu banco de dados

// Obter o CPF do usuário logado
$cpf = $_SESSION['cpf'];

// Consultar o banco de dados para obter as informações do usuário
$query = "SELECT nome, email FROM usuario WHERE cpf = ?";
$stmt = $conexao->prepare($query);
$stmt->bind_param("s", $cpf);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($nome, $email);
$stmt->fetch();
$stmt->close();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link rel="stylesheet" href="style.css">
    
    <title>SisPoint</title>
</head>
<body>
    

     
    <!-- *** DIV CONTEUDO ***-->
    <div id="conteudo">
        

        <!-- *** CABEÇALHO *** ***-->
        <header class="cabecalho">
            <h1 class="tituloDaPagina">SisPoint</h1> 
        </header>


        <!-- *** DIV MENU LATERAL ***-->
        <aside class="menuLateral">
            <div class="conteudoMenuLateral">

                <div class="imgLogo">
                    <img src="logo.png" alt="Logo SisPoint">
                </div>
                      
                
        <!-- *** Informações do Usuário *** -->
            <div class="usuario">
                <div class="imgContainer">
                    <!-- <img src="theo.png" alt="avatarUsuario" class="avatar"> *** -->
                </div>
                <p class="infoUsuario">
                    <span><?php echo $nome; ?></span><br>
                    <span><?php echo $email; ?></span>
                </p>
            </div>
                
            <br><br>

                <ul class="itensMenuLateral">

                    <li class="item">
                        <a href="tab_perfil.php" target="frameMain">
                            <i class="fa-solid fa-user-group"></i>
                            <span class="descricaoItem">Perfil</span>
                        </a>
                    </li>
                    <!--
                    <li class="item">
                        <a href="ausencias.html" target="frameMain">
                            <i class="fa-solid fa-list"></i>
                            <span class="descricaoItem">Ausências</span>
                        </a>
                    </li>
                    -->
                    <li class="item">
                        <a href="relatorio_colab.php" target="frameMain">
                            <i class="fa-solid fa-file-lines"></i>
                            <span class="descricaoItem">Relatórios</span>
                        </a>
                    </li>
                </ul>
                <hr class="hrMenuLateral">

            <br><br><br>     
            <div class="sair">
                <form action="sair.php" method="POST">
                    <button type="submit" class="botaoSair">
                          <i class="fa-solid fa-right-from-bracket"></i>
                           Sair
                     </button>
                </form>
            </div>
            </div>
            
            

                
        </aside>
        

        <!-- *** DIV CONTEÚDO PRINCIPAL ***-->
        <main class="conteudoPrincipal">

            <iframe src="" frameborder="0" name="frameMain" class="frameMain"></iframe> 

        </main>
    </div>
</body>
</html>