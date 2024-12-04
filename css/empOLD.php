<?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    
    $dbHost = 'Localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'registro_hora';

    $conn = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
    /*
    if($conn-> connect_error)
    {
        echo "Erro";
    }
    else
    {
        echo"Conectado";
    }
    */

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cnpj = $_POST['cnpj'];
        $razao_social = isset($_POST['razao_social']) ? $_POST['razao_social'] : 'Não registrado';
        $nome_fantasia = isset($_POST['nome_fantasia']) ? $_POST['nome_fantasia'] : 'Não registrado';
    
        // Debugging: exibir os valores
        echo "CNPJ: $cnpj<br>";
        echo "Razão Social: $razao_social<br>";
        echo "Nome Fantasia: $nome_fantasia<br>";
    
        $stmt = $conn->prepare("INSERT INTO empresa (cnpj, razao_social, nome_fantasia) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $cnpj, $razao_social, $nome_fantasia);
    
        if (empty($razao_social) || empty($nome_fantasia)) {
            echo "Razão social e nome fantasia não podem estar vazios.";
            exit;
        }
        
        if ($stmt->execute() === TRUE) {
            echo "Novo registro cadastrado!";
        } else {
            echo "Erro: " . $stmt->error;
        }
    
        $stmt->close();
    }
?>


