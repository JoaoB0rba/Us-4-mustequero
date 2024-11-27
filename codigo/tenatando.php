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
    <form id="pag4" action="processar_pagamento.php" method="GET">

    <?php
// Captura os dados enviados pelo formulário
$idaluguel = $_POST['idaluguel'];
$precokm = $_POST['precokm'];
$tipopag = $_POST['tipopag'];
$kmfinais = $_POST['kmfinal'];
$kmIniciais = $_POST['km_inicial']; // Recebe os km iniciais
$veiculosSelecionados = $_POST['veiculos']; // Recebe os IDs dos veículos selecionados
// Inicializa uma variável para o valor total a pagar
$valorTotal = 0;
// Echo para imprimir os dados
echo "<h2>Dados do Pagamento</h2>";
echo "<p><strong>ID do Aluguel:</strong> $idaluguel</p>";
echo "<p><strong>Preço por KM:</strong> R$ $precokm</p>";
echo "<p><strong>Método de Pagamento:</strong> $tipopag</p>";
echo "<h4>Veículos Selecionados:</h4>";
echo "<ul>";
foreach ($veiculosSelecionados as $idVeiculo) {
    echo "<li>ID do Veículo: $idVeiculo</li>";
    echo "<li>Km Inicial: " . $kmIniciais[$idVeiculo] . "</li>";
    echo "<li>Km Final: " . $kmfinais[$idVeiculo] . "</li>";
    echo "<hr>";
}
  ?>  
    
        <input type='hidden' name='idaluguel' value="<?php echo $idaluguel; ?>">

        Preço por KM: <br>
        <input type="text" name="precokm" id="precokm" required><br>

        Valor Total:
        <input type="text" name="valorTotal" id="valorTotal" rea><br>

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

    <?php
    // Verificar se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['precokm']) && isset($_GET['tipopag']) && isset($_GET['valorTotal'])) {
        $precokm = $_GET['precokm'];
        $tipopag = $_GET['tipopag'];
        $valorTotal = $_GET['valorTotal'];
        echo'ttt';
        
        // Atualiza a quilometragem atual do veículo (passando cada veículo individualmente)
        foreach ($carros as $carroAluguel) {
            $idVeiculo = $carroAluguel[0];
            $kmFinal = $_GET['kmfinal'];
            atualiza_km_atual($conexao, $kmFinal, $idVeiculo);  // Atualiza o KM final do veículo
        }

        // Efetua o pagamento
        efetuarPagamento($conexao, $tipopag, $valorTotal, $precokm, $idaluguel);

        // Atualiza o status dos veículos para 'não alugados'
        atualiza_nao_alugado($conexao, $veiculos);
    }
    ?>
</body>
</html>
