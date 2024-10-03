<?php 
require_once "conexao.php";
require_once "operacoes.php";
session_start();
$idaluguel = $_GET['idaluguel'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lançar Pagamento</title>
</head>
<body>
    <h2>Lançar pagamento</h2>
    <form action="form_pag5.php" method="POST">

        <input type="hidden" name="idaluguel" value="<?php echo $idaluguel; ?>">

        Preço por KM: <br>
        <input type="text" name="precokm" required><br>

        Método pagamento: <br>
        <select name="tipopag">
            <option value="Dinheiro">Dinheiro</option>
            <option value="Cartão">Cartão</option>
            <option value="Pix">Pix</option>
        </select> <br>
        
        <h4>Carros</h4>
        <hr>
        <?php
        $carros = listarVeiculosAluguel($conexao, $idaluguel);
        
        foreach ($carros as $carroAluguel) {
            $veiculo = listarVeiculoPorId($conexao, $carroAluguel[0]);
            $kmInicial = $veiculo[10]; // Supondo que o Km Inicial está no índice 10
            echo "<br>";
            echo "Pagar agora:<input type='checkbox' name='veiculos[]' value='$veiculo[0]'>"; // ID do veículo
            echo "<input type='hidden' name='km_inicial[$veiculo[0]]' value='$kmInicial'>"; // Envia o Km Inicial para a próxima página
            echo "<p>Veículo: $veiculo[1] - $veiculo[3]</p>";
            echo "<p>Km Inicial: $kmInicial</p>";
            echo "Km Final: <input type='text' name='kmfinal[$veiculo[0]]'>"; // Para que o nome do input seja associado ao ID do veículo
            echo "<hr>";
        }
        ?>
        
        <input type="submit" value='Lançar pagamento'>
    </form>
</body>
</html>
