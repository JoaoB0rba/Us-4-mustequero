<?php
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
    <form action="form_pag4.php">
        <?php
        $_SESSION['cliente'] = $_GET['cliente'];
        
        
        $algueis = listarAluguelCliente($conexao, $_SESSION['cliente']);
        
        $quantidade = sizeof($algueis);
        if ($quantidade > 0) {
            echo "algueis: <br>";
            echo "<select name='idaluguel'>";
            foreach ($algueis as $aluguel) {
                $idaluguel = $aluguel[0];
                $data = $aluguel[1];
                $idfuncionario = $aluguel[2];
                $idcliente = $aluguel[3];

                echo "<option value='$idaluguel'>$data</option>";
            }
            echo "</select><br><br>";
            echo "<input type='submit' value='Preencher dados do pagamento'>";
        }
        else {
            echo "Não há empréstimos para esse cliente.";
        }
        ?>
    </form>
</body>

</html>
