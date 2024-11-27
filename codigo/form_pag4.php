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
    <script src="./js/jquery-3.7.1.min.js"></script>
</head>
<body>
    <h2>Lançar pagamento</h2>
    <h4>Carros</h4>
    <hr>
    <form id="pag4" method="GET" action="form_pag5.php">

    <?php
    $carros = listarVeiculosAluguel($conexao, $idaluguel);
    $veiculos = [];

    // Exibir cada veículo
    foreach ($carros as $carroAluguel) {
        $veiculo = listarVeiculoPorId($conexao, $carroAluguel[0]);
        $kmInicial = $veiculo[10]; // Supondo que o Km Inicial está no índice 10
        $veiculos[] = $veiculo[0]; // Adiciona o ID do veículo ao array
        echo "<br>";
        echo "<input type='hidden' name='km_inicial[{$veiculo[0]}]' value='{$kmInicial}'>"; // Envia o Km Inicial para a próxima página
        echo "<p>Veículo: {$veiculo[1]} - {$veiculo[3]}</p>";
        echo "<p>Km Inicial: {$kmInicial}</p>";
        echo "Km Final: <input type='text' name='kmfinal[{$veiculo[0]}]' class='kmpercorrido' required><br>";
        echo "<hr>";
    }

    echo "<input type='hidden' name='veiculos' value='" . implode(',', $veiculos) . "'>";
    ?>
    <input type='hidden' name='idaluguel' value="<?php echo $idaluguel; ?>">

    Preço por KM: <br>
    <input type="text" name="precokm" id="precokm" required><br>

    Valor Total:
    <input type="text" name="valorTotal" id="valorTotal" readonly><br>

    Método pagamento: <br>
    <select name="tipopag">
        <option value="Dinheiro">Dinheiro</option>
        <option value="Cartão">Cartão</option>
        <option value="Pix">Pix</option>
    </select><br>
    <input type="submit" value="Lançar pagamento">
    </form>

    <script>
        // Função para calcular o valor total com base no Km percorrido
        function calcularValor() {
            let totalKmPercorrido = 0;

            $(".kmpercorrido").each(function () {
                totalKmPercorrido += parseFloat($(this).val()) || 0;
            });

            const precokm = parseFloat($("#precokm").val()) || 0;
            const valorTotal = totalKmPercorrido * precokm;

            $("#valorTotal").val(valorTotal.toFixed(2));
        }

        // Evento de cálculo sempre que a quilometragem ou preço por KM mudar
        $(".kmpercorrido, #precokm").on("input", calcularValor);
    </script>

</body>
</html>
