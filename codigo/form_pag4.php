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
    <script src="./js/jquery.mask.min.js"></script>
</head>
<body>
    <h2>Lançar pagamento</h2>
    <form id="pag4" action="form_pag5.php" method="POST">
    <input type="hidden" name="idaluguel" value="<?php echo $idaluguel; ?>">

    Preço por KM: <br>
    <input type="text" name="precokm" id="precokm" required><br>

    Método pagamento: <br>
    <select name="tipopag">
        <option value="Dinheiro">Dinheiro</option>
        <option value="Cartão">Cartão</option>
        <option value="Pix">Pix</option>
    </select><br>
    
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
</body>
</html>
