<?php
include_once('config.php');
session_start(); // Inicia a sessão

// Verifique se o CPF do usuário logado está disponível na sessão
if (isset($_SESSION['cpf'])) {
    // Obtém o CPF do usuário logado
    $cpf_logado = $_SESSION['cpf'];

    // Consulta preparada para obter os dados do usuário logado
    $stmt = $conexao->prepare("SELECT * FROM usuario WHERE cpf = ? LIMIT 1");
    $stmt->bind_param("s", $cpf_logado); // "s" indica que o CPF é uma string
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifique se a consulta retornou resultados
    if ($result && mysqli_num_rows($result) > 0) {
        // Exibe os dados do usuário logado
        while($user_data = mysqli_fetch_assoc($result)) {
            // Recupera a empresa do usuário logado
            $empresa_logado = $user_data['empresa'];
        }
    } else {
        echo "<p>Nenhum dado encontrado.</p>";
    }

    // Fechar a declaração
    $stmt->close();
} else {
    echo "Usuário não está logado.";
    exit;
}

// Filtra os colaboradores pela empresa do usuário logado
if(!empty($_GET['search'])) {
    $data = $_GET['search'];
    $sql = "SELECT * FROM usuario WHERE (codigo LIKE '%$data%' OR nome LIKE '%$data%' OR cpf LIKE '%$data%' OR email LIKE '%$data%' OR empresa LIKE '%$data%' OR tipo_usuario LIKE '%$data%') AND empresa = '$empresa_logado' ORDER BY codigo ASC";
} else {
    // A consulta agora só pega usuários da mesma empresa
    $sql = "SELECT * FROM usuario WHERE empresa = '$empresa_logado' ORDER BY codigo ASC";
}

$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link rel="stylesheet" href="style.css">
    
    <title>Colaborador</title>
</head>
<body>
    <!-- *** DIV CONTEUDO ***-->
    <div class="container">

        <!-- *** DIV NAVEGAÇÃO ***-->
        <nav class="navegacaoColaborador">
            <div>
                <input class="buscarColaborador" type="search" placeholder="Buscar" id="pesquisar">
                
                <button onclick="searchData()" class="bntBuscarColaborador">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span>Buscar</span>
                </button>

                
            </div>

            <a href="cad_colab.php" class="bntCastrarColaborador">
                <i class="fa-solid fa-user-plus"></i>
                <span>Cadastrar</span>
            </a>
        </nav>

        <!-- *** TABELA COLABORADORES ***-->
        <div class="m-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Codigo</th>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Nome da empresa</th>
                    <th scope="col">Perfil</th>
                    <th scope="col">Ações</th>
                    </tr>
            </thead>
            <tbody>
               <?php
                    while($user_data = mysqli_fetch_assoc($result))
                    {
                        echo "<tr>";
                        echo "<td>".$user_data['codigo']."</td>";
                        echo "<td>".$user_data['nome']."</td>";
                        echo "<td>".$user_data['cpf']."</td>";
                        echo "<td>".$user_data['email']."</td>";
                        echo "<td>".$user_data['empresa']."</td>";
                        echo "<td>".$user_data['tipo_usuario']."</td>";
                        echo "<td>
                            <a class='btn btn-sm btn-primary' href='edit_colab_perfil.php?codigo=$user_data[codigo]'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325'/>
                            </svg>
                            <a/>

                            <a class='btn btn-sm btn-danger' href='delete_colab_perfil.php?codigo=$user_data[codigo]'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                            </svg>
                            </a>
                        </td>";
                        echo "<tr>";
                    }
               ?> 
            </tbody>
            </table>
        </div>
     
</body>

<script>
    var search = document.getElementById('pesquisar');
    
    search.addEventListener("keydown", function(event) {
        if (event.key == "Enter")
        {
            searchData();
        }
    
    });    
    
    
    function searchData()
    {
        window.location = 'tab_colab.php?search='+search.value;
    }
</script>

</html>
