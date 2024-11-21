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
    <form action="form_pag5.php" method="POST" id="pag5">

        <input type="hidden" name="idaluguel" value="<?php echo $idaluguel; ?>">

        Preço por KM: <br>
        <input type="text" name="precokm" id="precokm" required><br>

        Método pagamento: <br>
        <select name="tipopag">
            <option value="Dinheiro">Dinheiro</option>
            <option value="Cartão">Cartão</option>
            <option value="Pix">Pix</option>
        </select> <br>
        
        <h4>Carros</h4>
        <hr>
        <?php
        $carros = listarVeiculosAluguel($conexao, $idaluguel);
        
        foreach ($carros as $carroAluguel) {
            $veiculo = listarVeiculoPorId($conexao, $carroAluguel[0]);
            $kmInicial = $veiculo[10]; // Supondo que o Km Inicial está no índice 10
            echo "<br>";





            echo "Pagar agora:<input type='checkbox' name='veiculos[]' value='$veiculo[0]'>"; // ID do veículo






            
            echo "<input type='hidden' name='km_inicial[$veiculo[0]]' value='$kmInicial'>"; // Envia o Km Inicial para a próxima página
            echo "<p>Veículo: $veiculo[1] - $veiculo[3]</p>";
            echo "<p>Km Inicial: $kmInicial</p>";
            echo "Km Final: <input type='text' name='kmfinal' id='kmfinal' [$veiculo[0]]'>"; // Para que o nome do input seja associado ao ID do veículo
            echo "<hr>";
        }
        ?>
        
        <input type="submit" value='Lançar pagamento'>
    </form>
    <script>
        $(document).ready(function () {
            
            $("#pag5").validate({
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
