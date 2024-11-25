<?php
require_once "conexao.php";
require_once "operacoes.php";

session_start();

// Captura os dados enviados pelo formulário
$idaluguel = $_POST['idaluguel'];
$precokm = $_POST['precokm'];
$tipopag = $_POST['tipopag'];
$kmfinais = $_POST['kmfinal']; // Quilometragem final (array)
$kmIniciais = $_POST['km_inicial']; // Quilometragem inicial (array)
$veiculosSelecionados = explode(',', $_POST['veiculos']); // IDs dos veículos como array

// Armazena os dados na sessão
$_SESSION['idaluguel'] = $idaluguel;
$_SESSION['precokm'] = $precokm;
$_SESSION['tipopag'] = $tipopag;
$_SESSION['kmfinal'] = $kmfinais;
$_SESSION['kminicial'] = $kmIniciais;
$_SESSION['veiculos'] = $veiculosSelecionados;

// Exibe os dados do pagamento
echo "<h2>Dados do Pagamento</h2>";
echo "<p><strong>ID do Aluguel:</strong> $idaluguel</p>";
echo "<p><strong>Preço por KM:</strong> R$ $precokm</p>";
echo "<p><strong>Método de Pagamento:</strong> $tipopag</p>";

echo "<h4>Veículos Selecionados:</h4>";
echo "<ul>";
foreach ($veiculosSelecionados as $idVeiculo) {
    echo "<li><strong>ID do Veículo:</strong> $idVeiculo</li>";
    echo "<li><strong>Km Inicial:</strong> " . $kmIniciais[$idVeiculo] . "</li>";
    echo "<li><strong>Km Final:</strong> " . $kmfinais[$idVeiculo] . "</li>";
    echo "<hr>";
}
echo "</ul>";

// Cálculo do valor total
$valorTotal = 0;
foreach ($veiculosSelecionados as $idVeiculo) {
    $kmInicial = $kmIniciais[$idVeiculo];
    $kmFinal = $kmfinais[$idVeiculo];
    $distanciaPercorrida = $kmFinal - $kmInicial;
    $valorVeiculo = $distanciaPercorrida * $precokm;
    $valorTotal += $valorVeiculo;

    // Atualiza a quilometragem atual do veículo
    atualiza_km_atual($conexao, $kmFinal, $idVeiculo);

    // Deleta o registro do veículo no aluguel
    // deletar_veiculo_aluguel($conexao, $idaluguel, $idVeiculo);
}

// Efetua o pagamento
efetuarPagamento($conexao, $tipopag, $valorTotal, $precokm, $idaluguel);

// Atualiza o status dos veículos para 'não alugados'
atualiza_nao_alugado($conexao, $veiculosSelecionados);

// Exibe o valor total
echo "<p><strong>Total a pagar:</strong> R$ " . number_format($valorTotal, 2, ',', '.') . "</p>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="telainicial.html" class="botao">Ir para a Página Inicial</a>
</body>
</html>

