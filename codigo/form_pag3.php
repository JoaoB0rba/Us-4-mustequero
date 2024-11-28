<?php
session_start(); // Inicie a sessão no início
require_once "conexao.php";
require_once "operacoes.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selecionar Aluguel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="container mt-5">
    <h1 class="text-center mb-4">Selecionar Aluguel</h1>

    <form action="form_pag4.php" method="get" class="mb-4">
        <?php
        if (isset($_GET['cliente'])) {
            $_SESSION['cliente'] = $_GET['cliente'];

            $algueis = listarAluguelCliente($conexao, $_SESSION['cliente']);
            $quantidade = sizeof($algueis);

            if ($quantidade > 0) {
                echo '<div class="mb-3">';
                echo '<label for="idaluguel" class="form-label">Aluguéis Disponíveis:</label>';
                echo '<select name="idaluguel" id="idaluguel" class="form-select">';
                foreach ($algueis as $aluguel) {
                    $idaluguel = $aluguel[0];
                    $data = $aluguel[1];
                    echo "<option value='$idaluguel'>Data: $data</option>";
                }
                echo '</select>';
                echo '</div>';
                echo '<button type="submit" class="btn btn-primary">Preencher Dados do Pagamento</button>';
            } else {
                echo '<div class="alert alert-warning" role="alert">Não há empréstimos para esse cliente.</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Nenhum cliente selecionado. Por favor, volte e escolha um cliente.</div>';
        }
        ?>
    </form>

    <a href="form_pag3.php" class="btn btn-secondary">Voltar</a>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
