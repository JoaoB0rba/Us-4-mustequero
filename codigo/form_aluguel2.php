<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

require_once "conexao.php";
require_once "operacoes.php";

$idFuncionario = $_GET['idFuncionario'];
$tipocliente = $_GET['tipocliente'];

?>
<form action="form_aluguel3.php" method="get">

    <input type="hidden" name="idFuncionario" value="<?php echo $idFuncionario; ?>">

    <input type="hidden" name="tipocliente" value="<?php echo $tipocliente; ?>">

    Cliente:
    <select name="cliente">
            <?php

            $resultados = listarCliente($conexao, $tipocliente);

            // ------------Arrumar daqui pra baixo
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