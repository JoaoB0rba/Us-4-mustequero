<?php
require_once "conexao.php";
require_once "operacoes.php";

session_start();

// Captura os dados enviados pelo formulário
$idaluguel = $_GET['idaluguel'];
$precokm = $_GET['precokm'];
$tipopag = $_GET['tipopag'];
$kmfinais = $_GET['kmfinal']; // Quilometragem final (array)
$kmIniciais = $_GET['km_inicial']; // Quilometragem inicial (array)
$veiculosSelecionados = explode(',', $_GET['veiculos']); // IDs dos veículos como array

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

// Passa os dados para o JavaScript
echo "<script>
    const precokm = $precokm;
    const kmIniciais = " . json_encode($kmIniciais) . ";
    const kmFinais = " . json_encode($kmfinais) . ";
    const veiculosSelecionados = " . json_encode($veiculosSelecionados) . ";
</script>";
?>

<!-- JavaScript para calcular o valor total -->
<script>
    // Inicializa o valor total
    let valorTotal = 0;

    // Itera sobre os veículos selecionados
    veiculosSelecionados.forEach((idVeiculo) => {
        // Obtém os valores de quilometragem inicial e final
        const kmInicial = parseFloat(kmIniciais[idVeiculo] || 0); // Evita erros com valores indefinidos
        const kmFinal = parseFloat(kmFinais[idVeiculo] || 0);

        // Calcula a distância percorrida
        const distancia = kmFinal - kmInicial;

        // Verifica se a distância é válida (não negativa)
        if (distancia > 0) {
            // Calcula o valor para o veículo e adiciona ao total
            const valor = distancia * precokm;
            valorTotal += valor;
        }
    });

    // Exibe o resultado na página
    document.body.innerHTML += `<h3>Total a pagar: R$ ${valorTotal.toFixed(2).replace(".", ",")}</h3>`;
</script>
