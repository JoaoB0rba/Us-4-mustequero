# Us-4-mustequero
1- arrumar funcoes pagamento 

2- fazer os carros terem a coluna alugado como N apos o pagamento





1- arrumar funcoes aluguel -----ARRUMADO

3- Fazer carros alugados deixarem de aparecer como disponivel para alugar, na tb_veiculos trocar o valor da coluna alugado_veiculo para S apos fazer o aluguel -----ARRUMADO

4-terminar o inserir_aluguel

5- terminar a funçao confiraDados, so pra aparecer os dados do cliente bonitin

5-arrumar o banco de dados ----ARRUMADO

7-mudar no banco a tabela aluguel para 	"timestamp" na coluna data inicial e salvar o banco de todas as formas novamente ----ARRUMADO

20- relatorio



PAGAMENTO CERTO
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
echo "</ul>";

// Cálculo do valor total (opcional, se você quiser mostrar também)
foreach ($veiculosSelecionados as $idVeiculo) {
    // Obtém o km inicial correspondente
    $kmInicial = $kmIniciais[$idVeiculo];
    
    // Obtém o km final correspondente
    $kmFinal = $kmfinais[$idVeiculo];
    
    // Calcula a distância percorrida
    $distanciaPercorrida = $kmFinal - $kmInicial;

    // Calcula o valor a pagar para este veículo
    $valorVeiculo = $distanciaPercorrida * $precokm;

    // Adiciona ao valor total
    $valorTotal += $valorVeiculo;
}

// Exibe o valor total
echo "<p><strong>Total a pagar:</strong> R$ " . number_format($valorTotal, 2, ',', '.') . "</p>";
?>

</body>
</html>
