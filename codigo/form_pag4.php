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
        echo "Km Final: <input type='text' name='kmfinal[{$veiculo[0]}]' required><br>";
        echo "<hr>";
    }

    // Serializa os IDs dos veículos em um campo oculto
    echo "<input type='hidden' name='veiculos' value='" . implode(',', $veiculos) . "'>";
    ?>
     <form id="pag4" method="GET">
    <input type="hidden" name="idaluguel" value="<?php echo $idaluguel; ?>">

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
        $(document).ready(function () {
            $("#pag4").validate({
                rules: {
                    precokm: {
                        required: true,
                        minlength: 1,
                        number: true
                    },
                    
                    kmfinal: {
                        required: true,
                        minlength: 2,
                        number: true
                    },  
                },
                messages: {
                    precokm: {
                        required: "Campo preço do km é obrigatório.",
                        minlength: "O nome deve ter pelo menos 1 caracteres.",
                        number:" digite somente numeros"
                    },
                    kmfinal: {
                        required: "Campo km final é obrigatório.",
                        minlength: "O km final deve ter no minimo 2 numeros.",
                        number:" digite somente numeros"
                    },
                }
            });
        });
    </script>



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
