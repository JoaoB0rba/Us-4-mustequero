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
    <title>Selecionar Cliente</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="container mt-5">
    <h1 class="mb-4 text-center">Selecionar Cliente</h1>

    <form action="form_pag3.php" method="get" class="mb-4">
        <div class="mb-3">
            <label for="cliente" class="form-label">Cliente:</label>
            <select name="cliente" id="cliente" class="form-select">
                <?php
                $resultados = listarClienteAlugado($conexao, $_SESSION['tipocliente']);
                foreach ($resultados as $cliente) {
                    echo "<option value='$cliente[0]'>$cliente[1]</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <a href="form_aluguel.php" class="btn btn-secondary">Voltar</a>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
