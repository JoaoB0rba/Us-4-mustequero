<?php
    require_once 'conexao.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produtos</title>
</head>

<body>
    <form action="cadastros.php">

        Nome do Produto: <br>

        <input type="text" name="nome_produto" id=""> <br><br>
        
        Categoria do Produto: <br>
        <select name='id_categoria'>
            <?php

                $sql = "SELECT * FROM tb_categoria";

                $resultados = mysqli_query($conexao, $sql);

                if (mysqli_num_rows($resultados) > 0){
                    while ($linha = mysqli_fetch_array($resultados)){
                    
                        $id_categoria = $linha['id_categoria'];
                        $nome_categoria = $linha['nome_categ'];

                        echo "<option value='$id_categoria'>$nome_categoria</option>";
                    }
                }
            ?>
        </select> <br> <br>
        <input type="submit" value="Cadastrar">
    </form>
    <br><br>
    <button><a href="index.php">Tela Inicial</a></button> 
</body>

</html>