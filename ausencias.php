<?php
include_once('config.php');

// Verificando os parâmetros passados na URL
$dataInicio = isset($_GET['dataInicio']) ? $_GET['dataInicio'] : '';
$dataFim = isset($_GET['dataFim']) ? $_GET['dataFim'] : '';
$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : '';

// Montando a consulta SQL com base nos filtros fornecidos
$sql = "SELECT DISTINCT `id`, `app_name`, `status`, `horario`, `username`, `entry_exit`, `codigo` 
FROM `appstatuslog` 
INNER JOIN usuario ON appstatuslog.username = usuario.nome
WHERE appstatuslog.username IS NOT NULL 
  AND appstatuslog.entry_exit IS NOT NULL";  
        // WHERE 1=1 permite adicionar as condições dinamicamente

// Filtro pelo código do colaborador
if (!empty($codigo)) {
    $sql .= " AND codigo = '$codigo'";
}

// Filtro pela data de início
if (!empty($dataInicio)) {
    $sql .= " AND horario >= '$dataInicio'";
}

// Filtro pela data de fim
if (!empty($dataFim)) {
    $sql .= " AND horario <= '$dataFim'";
}

// Ordenando os resultados pelo código do colaborador
$sql .= " ORDER BY codigo ASC"; // Espaço adicionado antes de ORDER BY

// Executando a consulta
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Relatório de Ponto</title>
</head>
<body>
    <div class="containerEmpresa">
        <form action="ausencias.php" method="GET">
            <div class="itensRelatorios data">
                <div>
                    <label for="dataInicio">Data início:</label><br>
                    <input type="date" name="dataInicio" value="<?= $dataInicio ?>">
                </div>

                <div>
                    <label for="dataFim">Data fim:</label><br>
                    <input type="date" name="dataFim" value="<?= $dataFim ?>">
                </div>
            </div>

            <div class="div colaborador">
                <div class="inputusername">
                    <label for="codigo">ID:</label><br>
                    <input type="text" name="codigo" value="<?= $codigo ?>">
                </div>
            </div>

            <br><br>
            <button class="bntRelatorio" type="submit">Buscar</button>
            <button class="bntRelatorio" type="reset" onclick="limparBusca()">Limpar</button>
        </form>
        <br><br>
        <!-- *** TABELA COLABORADORES ***-->
        <div class="m-5">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Username</th>
                        <th scope="col">Aplicativo</th>
                        <th scope="col">Status</th>
                        <th scope="col">Data e hora</th>
                        <th scope="col">Entrada/saída</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($user_data = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$user_data['codigo']."</td>";
                        echo "<td>".$user_data['username']."</td>";
                        echo "<td>".$user_data['app_name']."</td>";
                        echo "<td>".$user_data['status']."</td>";
                        echo "<td>".$user_data['horario']."</td>";
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
    var search = document.getElementById('codigo');
    
    search.addEventListener("keydown", function(event) {
        if (event.key === "Enter") {
            document.forms[0].submit(); // Envia o formulário
        }
    });

    function limparBusca() {
        // Limpa os campos de data e colaborador
        document.querySelector('input[name="dataInicio"]').value = '';
        document.querySelector('input[name="dataFim"]').value = '';
        document.querySelector('input[name="codigo"]').value = '';
        
        // Recarrega a página sem parâmetros na URL
        window.location.href = window.location.pathname; // Recarrega a página sem parâmetros de consulta
    }
</script>
</html>
