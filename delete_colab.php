<?php
    
    
    if(!empty($_GET['codigo']))
    {

        include_once('config.php');

        $codigo = $_GET['codigo'];

        $sqlSelect = "SELECT * FROM funcionario WHERE codigo=$codigo";

        $result = $conexao->query($sqlSelect);

        if ($result->num_rows > 0) {
            // Se o registro existe, realiza a exclusão
            $sqlDelete = "DELETE FROM funcionario WHERE codigo=$codigo";
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

