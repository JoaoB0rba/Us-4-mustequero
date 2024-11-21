<?php
session_start();
require_once "conexao.php";
require_once "operacoes.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumo do Aluguel</title>
    <!-- Incluindo o CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Confira os dados do Aluguel</h2>

    <?php
    $tipocliente = $_SESSION['tipocliente'];
    $idFuncionario = $_SESSION['idFuncionario'];
    $cliente = $_SESSION['cliente'];
    $carros = $_SESSION['carros'];

    // Exibe os dados em uma tabela estilizada com Bootstrap
    echo "<table class='table table-bordered table-striped'>";
    echo "<tr><th>Tipo de Cliente</th><td>$tipocliente</td></tr>";
    echo "<tr><th>ID Funcionário</th><td>$idFuncionario</td></tr>";
    echo "<tr><th>Cliente</th><td>$cliente</td></tr>";
    
    // Exibe os carros selecionados
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

    <!-- Botão para salvar os dados -->
    <div class="d-flex justify-content-center mt-4">
        <a href="inserir_aluguel.php" class="btn btn-success">Salvar</a>
    </div>

    <!-- Botão para voltar -->
    <div class="d-flex justify-content-center mt-3">
        <a href="form_aluguel2.php" class="btn btn-secondary">Voltar</a>
    </div>
</div>

<!-- Incluindo o JS do Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
