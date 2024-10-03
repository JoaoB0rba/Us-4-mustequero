<?php 
session_start();
require_once "conexao.php";
require_once "operacoes.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="form_pag3.php" method="get">
    Cliente:
    <select name="cliente">
            <?php
            
            $resultados = listarClienteAlugado($conexao, $_SESSION['tipocliente']);

            foreach ($resultados as $cliente) {
                echo "<option value='$cliente[0]'>$cliente[1]</option>";
            }
            ?>
        </select> <br><br>
    
    <br><br>
    <input type="submit" value="enviar"><br>
</form>
<a href="form_aluguel.php">
    <button>Voltar</button>
</a>

</body>
</html>
