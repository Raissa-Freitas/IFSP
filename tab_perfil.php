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

    <title>Informações do colaborador</title>
</head>
<body>
    <form id="Formulario" method="POST">

        <fieldset> <!--Agrupar dentro de uma caixa-->

            <legend class="titulo_form">
                Informações do colaborador
            </legend>

            <!-- Código do colaborador -->
            <div class="input-container">
                <label for="codigo" class="label_input">
                    Código:
                </label><br>
                <input type="number" id="codigo" class="inputuser" value="<?php echo htmlspecialchars($user_data['codigo']); ?>"><br><br>
            </div>

            <!-- CPF do colaborador -->
            <div class="input-container">
                <label for="cpf" class="label_input">
                    CPF:
                </label><br>
                <input type="text" id="cpf" class="inputuser" name="cpf" value="<?php echo htmlspecialchars($user_data['cpf']); ?>" readonly><br><br>
            </div>

            <!-- Nome Completo do colaborador -->
            <div class="input-container">
                <label for="nome" class="label_input">
                    Nome Completo:
                </label><br>
                <input type="text" id="nome" class="inputuser" value="<?php echo htmlspecialchars($user_data['nome']); ?>"><br><br>
            </div>

            <!-- E-mail do colaborador -->
            <div class="input-container">
                <label for="email" class="label_input">
                    E-mail:
                </label><br>
                <input type="email" id="email" class="inputuser" name="email" value="<?php echo htmlspecialchars($user_data['email']); ?>"><br><br>
            </div>

            <!-- Empresa do colaborador -->
            <div class="input-container">
                <label for="email" class="label_input">
                    Empresa:
                </label><br>
                <input type="text" id="empresa" class="inputuser" name="empresa" value="<?php echo htmlspecialchars($user_data['empresa']); ?>"><br><br>
            </div>

        </fieldset>
    </form>
</body>
</html>
<?php
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
?>
