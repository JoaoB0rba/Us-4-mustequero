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
    <script src="./js/jquery.validate.min.js"></script>
</head>
<body>
    <h2>Lançar pagamento</h2>
    
    <h4>Carros</h4>
    <hr>
    <?php
    $carros = listarVeiculosAluguel($conexao, $idaluguel);
    $veiculos = [];

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

    // Serializa os IDs dos veículos em um campo oculto
    echo "<input type='hidden' name='veiculos' value='" . implode(',', $veiculos) . "'>";
    ?>
    <form id="pag4" method="GET">
        <input type='hidden' name='idaluguel' value="<?php echo $idaluguel; ?>">

        Preço por KM: <br>
        <input type="text" name="precokm" id="precokm" required><br>

        Valor Total:
        <input type="text" name="valorTotal" id="valorTotal" disabled><br>

        Método pagamento: <br>
        <select name="tipopag">
            <option value="Dinheiro">Dinheiro</option>
            <option value="Cartão">Cartão</option>
            <option value="Pix">Pix</option>
        </select><br>
        <input type="submit" value="Lançar pagamento">
    </form>

    <script>
    
            $(".kmpercorrido").on("input", function () {
                const kmInicial = parseFloat($(this).closest(".mb-3").find(".km_inicial").text());
                const kmPercorrido = parseFloat($(this).val()) || 0;
                const kmFinal = kmInicia + kmPercorrido;
                $(this).closest(".mb-3").find(".kmFinal").text(kmFinal.toFixed(2));
            });

            function calcularValor() {
                let totalKmPercorrido = 0;

                $(".kmpercorrido").each(function () {
                    totalKmPercorrido += parseFloat($(this).val()) || 0;
                });

                const precokm = parseFloat($("input[name='preco_por_km']").val()) || 0;
                const valorTotal = totalKmPercorrido * precokm;

                $("input[name='valor']").val(kmFinal.toFixed(2));
                $("#kmtotaldoaluguel").text(totalKmPercorrido.toFixed(2));
            }

            $(".kmpercorrido, input[name='precokm']").on("input", calcularValor);


        

        
    </script>
    <?php
 // Atualiza a quilometragem atual do veículo
 atualiza_km_atual($conexao, $kmFinal, $idVeiculo);


 // Deleta o registro do veículo no aluguel
 // deletar_veiculo_aluguel($conexao, $idaluguel, $idVeiculo);



// Efetua o pagamento
efetuarPagamento($conexao, $tipopag, $valorTotal, $precokm, $idaluguel);


// Atualiza o status dos veículos para 'não alugados'
atualiza_nao_alugado($conexao, $veiculosSelecionados);

?>
</body>
</html>
