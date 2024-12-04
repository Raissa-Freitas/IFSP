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
            // Recupera a razão social da empresa do usuário logado
            $razao_social_logado = $user_data['empresa'];
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

// Modifica a consulta para pegar somente a empresa do usuário logado, agora filtrando por razão social
if(!empty($_GET['search'])) {
    $data = $_GET['search'];
    $sql = "SELECT * FROM empresa WHERE (codigo_emp LIKE '%$data%' OR cnpj LIKE '%$data%' OR razao_social LIKE '%$data%' OR nome_fantasia LIKE '%$data%') AND razao_social = '$razao_social_logado' ORDER BY codigo_emp ASC";
} else {
    // Consulta para pegar apenas a empresa do usuário logado filtrando pela razão social
    $sql = "SELECT * FROM empresa WHERE razao_social = '$razao_social_logado' ORDER BY codigo_emp ASC";
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

    <title>Empresa</title>
</head>
<body>
    <!-- *** DIV CONTEUDO ***-->
    <div class="container">

        <!-- *** DIV NAVEGAÇÃO ***-->
        <nav class="navegacaoEmpresa">
            <div>
                <input class="buscarEmpresa" type="search" placeholder="Buscar" id="pesquisar">
                
                <button onclick="searchData()" class="bntBuscarColaborador">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span>Buscar</span>
                </button>

            </div>

            <a href="cad_emp1.php" class="bntCastrarEmpresa">
                <i class="fa-solid fa-user-plus"></i>
                <span>Cadastrar</span>
            </a>
        </nav>

        <!-- *** TABELA COLABORADORES ***-->
        <div class="m-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Codigo empresa</th>
                    <th scope="col">CNPJ</th>
                    <th scope="col">Razao social</th>
                    <th scope="col">Nome Fantasia</th>
                    <th scope="col">Ações</th>
                    </tr>
            </thead>
            <tbody>
                <?php
                    while($user_data = mysqli_fetch_assoc($result))
                    {
                        echo "<tr>";
                        echo "<td>".$user_data['codigo_emp']."</td>";
                        echo "<td>".$user_data['cnpj']."</td>";
                        echo "<td>".$user_data['razao_social']."</td>";
                        echo "<td>".$user_data['nome_fantasia']."</td>"; 
                        echo "<td>
                            <a class='btn btn-sm btn-primary' href='edit_emp_perfil.php?codigo_emp=$user_data[codigo_emp]'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325'/>
                            </svg>
                            <a/>

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
        window.location = 'tab_perfil_emp.php?search='+search.value;
    }
</script>

</html>