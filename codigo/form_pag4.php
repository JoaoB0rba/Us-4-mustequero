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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- jQuery -->
    <script src="./js/jquery-3.7.1.min.js"></script>
</head>

<body class="container mt-5">
    <h2 class="text-center mb-4">Lançar Pagamento</h2>
    <h4 class="mb-3">Carros</h4>
    <hr>

    <form id="pag4" method="GET" action="form_pag5.php">
        <?php
        $carros = listarVeiculosAluguel($conexao, $idaluguel);
        $veiculos = [];

        foreach ($carros as $carroAluguel) {
            $veiculo = listarVeiculoPorId($conexao, $carroAluguel[0]);
            $kmInicial = $veiculo[10]; // Supondo que o Km Inicial está no índice 10
            $veiculos[] = $veiculo[0]; // Adiciona o ID do veículo ao array

            echo "<div class='mb-4'>";
            echo "<input type='hidden' name='km_inicial[{$veiculo[0]}]' value='{$kmInicial}'>";
            echo "<p><strong>Veículo:</strong> {$veiculo[1]} - {$veiculo[3]}</p>";
            echo "<p><strong>Km Inicial:</strong> {$kmInicial}</p>";
            echo "<label for='kmfinal[{$veiculo[0]}]' class='form-label'>Km Final:</label>";
            echo "<input type='text' name='kmfinal[{$veiculo[0]}]' class='form-control kmpercorrido' required>";
            echo "</div>";
            echo "<hr>";
        }

        echo "<input type='hidden' name='veiculos' value='" . implode(',', $veiculos) . "'>";
        ?>
        <input type='hidden' name='idaluguel' value="<?php echo $idaluguel; ?>">

        <div class="mb-3">
            <label for="precokm" class="form-label">Preço por KM:</label>
            <input type="text" name="precokm" id="precokm" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="valorTotal" class="form-label">Valor Total:</label>
            <input type="text" name="valorTotal" id="valorTotal" class="form-control" readonly>
        </div>

        <div class="mb-3">
            <label for="tipopag" class="form-label">Método de Pagamento:</label>
            <select name="tipopag" id="tipopag" class="form-select">
                <option value="Dinheiro">Dinheiro</option>
                <option value="Cartão">Cartão</option>
                <option value="Pix">Pix</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Lançar Pagamento</button>
    </form>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

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
