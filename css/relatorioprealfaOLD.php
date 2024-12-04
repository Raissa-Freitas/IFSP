<?php
    
    include_once('config.php');

    if(!empty($_GET['search']))
    {
        $data = $_GET['search'];
        $sql = "SELECT * FROM registro_ponto WHERE funcionario_id LIKE '%$data%'  ORDER BY funcionario_id ASC";
    }
    else
    {
        $sql = "SELECT * FROM registro_ponto ORDER BY funcionario_id ASC";
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
    <div class="containerEmpresa">

        <!-- *** DIV NAVEGAÇÃO ***-->
        <nav class="navegacaoEmpresa">
                
                
                <div class="itensRelatorios data">
                    <div>
                        <label for="dataInicio">Data inicio:</label><br>
                        <input type="date" name="dataInicio">
                    </div>
            
                    <div>
                        <label for="dataFim">Data fim:</label><br>
                        <input type="date" name="dataFim">
                    </div>
                </div>
                

                <div class="div colaborador">

                    <div class="inputNomeColaborador">
                        <label for="nomeColaborador">Codigo Colaborador:</label><br>
                        <input type="text" name="nomeColaborador">
                    </div>
                </div>

                <br><br>
                <button class="bntRelatorio" type="submit">Relatório</button>
            
        </nav>

        <!-- *** TABELA COLABORADORES ***-->
        <div class="m-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Codigo colaborador</th>
                    <th scope="col">Entrada</th>
                    <th scope="col">Almoço inicio</th>
                    <th scope="col">Almoço fim</th>
                    <th scope="col">Saída</th>
                    </tr>
            </thead>
            <tbody>
                <?php
                    while($user_data = mysqli_fetch_assoc($result))
                    {
                        echo "<tr>";
                        echo "<td>".$user_data['funcionario_id']."</td>";
                 
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
        window.location = 'relatorioprealfa.php?search='+search.value;
    }
</script>

</html>