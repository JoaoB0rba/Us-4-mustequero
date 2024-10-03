<?php
session_start();
require_once "conexao.php";
require_once "operacoes.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
    $tipocliente = $_SESSION['tipocliente'];
    $idFuncionario = $_SESSION['idFuncionario'];
    $cliente = $_SESSION['cliente'];
    $carros = $_SESSION['carros'];

    echo "<h2>Confira os dados:</h2>";

    // Exibe os dados em uma tabela
    echo "<table border='1'>";
    echo "<tr><th>Tipo Cliente</th><td>$tipocliente</td></tr>";
    echo "<tr><th>ID Funcionário</th><td>$idFuncionario</td></tr>";
    echo "<tr><th>Cliente</th><td>$cliente</td></tr>";
    
    // Exibir todos os carros selecionados
    echo "<tr><th>Carros Selecionados</th><td>";
    if (is_array($carros)) {
        foreach ($carros as $carro) {
            echo "$carro<br>"; // Exibe cada carro em uma nova linha
        }
    } else {
        echo "Nenhum carro selecionado.";
    }
    echo "</td></tr>";

    echo "</table>";
    ?>
     <a href="inserir_aluguel.php">
        <button>Salvar</button>
    </a>

</body>
</html>