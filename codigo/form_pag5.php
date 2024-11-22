<?php
require_once "conexao.php";
require_once "operacoes.php"; // Certifique-se de que a função está nesse arquivo

session_start();

// Captura os dados enviados pelo formulário
$idaluguel = $_POST['idaluguel'];
$precokm = $_POST['precokm'];
$tipopag = $_POST['tipopag'];
$kmfinais = $_POST['kmfinal']; // Quilometragem final
$kmIniciais = $_POST['km_inicial']; // Quilometragem inicial
$veiculosSelecionados = $_POST['veiculos']; // IDs dos veículos selecionados

// Armazena os dados na sessão
$_SESSION['idaluguel'] = $idaluguel;
$_SESSION['precokm'] = $precokm;
$_SESSION['tipopag'] = $tipopag;
$_SESSION['kmfinal'] = $kmfinais;
$_SESSION['kminicial'] = $kmIniciais;
$_SESSION['veiculos'] = $veiculosSelecionados;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento de Aluguel</title>
</head>
<body>
<form id = "pag5" action met>
        <input type="hidden" value= <?php echo $_GET['veiculos']; ?>>

        Preço por KM: 
        <input type="text" name="precokm" id = "precokm"><br>
        Método pagamento: <br>
        <!-- <input type="text" name="metodo"><br> -->
        <select name="tipopag" id="tipopag">
            <option>Dinheiro</option>
            <option>Cartão</option>
        </select> <br>
        <input type = text name = "kminicial" id = "kminicial"><br><br>
        <input type = text name = "kmfinal" id = "kmfinal"><br><br>
        
        <button>Salvar Pagamento</button>
    </form>

    <script>
        $(document).ready(function () {
            $(".calculo").keyup(function () {
                let unitario = $("#unitario").val();
                let quantidade = $("#quantidade").val();

                let total = unitario * quantidade;

                $("#total").val(total);
            });
        });
    </script>
</body>

</html>
    
<?php
// Inicializa uma variável para o valor total a pagar
$valorTotal = 0;

// Exibe os dados do pagamento
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

    






















// Cálculo do valor total
//=foreach ($veiculosSelecionados as $idVeiculo) {
    // Obtém o km inicial e final correspondentes
    //=$kmInicial = $kmIniciais[$idVeiculo];
    //=$kmFinal = $kmfinais[$idVeiculo];
    
    // Calcula a distância percorrida e o valor do aluguel para o veículo
    //=$distanciaPercorrida = $kmFinal - $kmInicial;
    //=$valorVeiculo = $distanciaPercorrida * $precokm;

    // Adiciona ao valor total
    //=$valorTotal += $valorVeiculo;

<<<<<<< Updated upstream
    // ================Atualiza a quilometragem atual do veículo
    //=atualiza_km_atual($conexao, $kmFinal, $idVeiculo);
=======
    // Atualiza a quilometragem atual do veículo
    // =atualiza_km_atual($conexao, $kmFinal, $idVeiculo);
>>>>>>> Stashed changes

    // Deletar o registro do veículo no aluguel
    // deletar_veiculo_aluguel($conexao, $idaluguel, $idVeiculo);
//=}
    //=efetuarPagamento($conexao, $tipopag, $valorTotal, $precokm, $idaluguel);

// Exibe o valor total
//=echo "<p><strong>Total a pagar:</strong> R$ " . number_format($valorTotal, 2, ',', '.') . "</p>";

// Atualiza o status dos veículos para 'não alugados'
//=$_SESSION['carros'] = $veiculosSelecionados;

// Chama a função para atualizar os veículos como não alugados
//=if (isset($_SESSION['carros'])) {
  //=  $carros = $_SESSION['carros']; // Recebe o array de IDs dos carros
   //= atualiza_nao_alugado($conexao, $carros); // Chama a função para atualizar os veículos como não alugados
//=}
?>

<!-- Botão de conclusão do pagamento 
<p>Pagamento efetuado</p>
<a href="index.html">
    <button>Concluído</button>
</a>

</body>
</html>-->


<