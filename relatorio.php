<?php
include_once('config.php');

// Verificando os parâmetros passados na URL
$dataInicio = isset($_GET['dataInicio']) ? $_GET['dataInicio'] : '';
$dataFim = isset($_GET['dataFim']) ? $_GET['dataFim'] : '';
$username = isset($_GET['username']) ? $_GET['username'] : '';

// Montando a consulta SQL com base nos filtros fornecidos
$sql = "SELECT asl.id, asl.app_name, asl.status, asl.horario, asl.username, asl.entry_exit
        FROM appstatuslog asl
        WHERE 1=1
          AND asl.username IS NOT NULL 
          AND asl.username != '' 
          AND asl.entry_exit IS NOT NULL 
          AND asl.entry_exit != ''";

  // WHERE 1=1 permite adicionar as condições dinamicamente

// Filtro pelo username
if (!empty($username)) {
    $sql .= " AND asl.username = '$username'";
}

// Filtro pela data de início (horário)
if (!empty($dataInicio)) {
    $sql .= " AND asl.horario >= '$dataInicio'";
}

// Filtro pela data de fim (horário)
if (!empty($dataFim)) {
    $sql .= " AND asl.horario <= '$dataFim'";
}

// Ordenando os resultados pela data/hora
$sql .= " ORDER BY asl.horario ASC"; // Ordena pela data/hora de forma crescente

// Executando a consulta
$result = $conexao->query($sql);
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Relatório de Status de Aplicativo</title>
</head>
<body>
    <div class="containerEmpresa">
        <form action="relatorio.php" method="GET">
            <div class="itensRelatorios data">
                <div>
                    <label for="dataInicio">Data início:</label><br>
                    <input type="datetime-local" name="dataInicio" value="<?= $dataInicio ?>">
                </div>

                <div>
                    <label for="dataFim">Data fim:</label><br>
                    <input type="datetime-local" name="dataFim" value="<?= $dataFim ?>">
                </div>
            </div>

            <div class="div colaborador">
                <div class="inputfuncionario_id">
                    <label for="username">Usuário:</label><br>
                    <input type="text" name="username" value="<?= $username ?>">
                </div>
            </div>

            <br><br>
            <button class="bntRelatorio" type="submit">Buscar</button>
            <button class="bntRelatorio" type="reset" onclick="limparBusca()">Limpar</button>
        </form>
        <br><br>
        <!-- *** TABELA DE STATUS DO APLICATIVO ***-->
        <div class="m-5">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">App</th>
                        <th scope="col">Status</th>
                        <th scope="col">Horário</th>
                        <th scope="col">Usuário</th>
                        <th scope="col">Entrada/Saída</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($user_data = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$user_data['id']."</td>";
                        echo "<td>".$user_data['app_name']."</td>";
                        echo "<td>".$user_data['status']."</td>";
                        echo "<td>".$user_data['horario']."</td>";
                        echo "<td>".$user_data['username']."</td>";
                        echo "<td>".$user_data['entry_exit']."</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script>
    var search = document.getElementById('username');
    
    search.addEventListener("keydown", function(event) {
        if (event.key === "Enter") {
            document.forms[0].submit(); // Envia o formulário
        }
    });

    function limparBusca() {
        // Limpa os campos de data e usuário
        document.querySelector('input[name="dataInicio"]').value = '';
        document.querySelector('input[name="dataFim"]').value = '';
        document.querySelector('input[name="username"]').value = '';
        
        // Recarrega a página sem parâmetros na URL
        window.location.href = window.location.pathname; // Recarrega a página sem parâmetros de consulta
    }
</script>
</html>
