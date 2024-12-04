<?php
    
    
    if(!empty($_GET['codigo_emp']))
    {

        include_once('config.php');

        $codigo_emp = $_GET['codigo_emp'];

        $sqlSelect = "SELECT * FROM empresa WHERE codigo_emp=$codigo_emp";

        $result = $conexao->query($sqlSelect);

        if ($result->num_rows > 0) {
            // Se o registro existe, realiza a exclusão
            $sqlDelete = "DELETE FROM empresa WHERE codigo_emp=$codigo_emp";
            $resultDelete = $conexao->query($sqlDelete);
    
            // Verifica se a exclusão foi bem-sucedida
            if ($resultDelete) {
                $mensagem = "Registro excluído com sucesso!";
            } else {
                $mensagem = "Erro ao excluir o registro: " . $conexao->error;
            }
        } else {
            header('Location: index.php');
        }
    }
    ?>

    <!-- Exibição da mensagem na página -->
<?php if (!empty($mensagem)) : ?>
    <div class="alert alert-success">
        <?php echo $mensagem; ?>
    </div>
<?php endif; ?>

