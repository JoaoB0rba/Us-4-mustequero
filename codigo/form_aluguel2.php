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
    <title>Seleção de Cliente</title>
    <!-- Incluindo Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Seleção de Cliente</h2>

    <form action="session2.php" method="get">
        <div class="mb-3">
            <label for="cliente" class="form-label">Cliente</label>
            <select name="cliente" id="cliente" class="form-select" required>
                <?php
                // Consulta para listar os clientes com base no tipo de cliente
                $resultados = listarCliente($conexao, $_SESSION['tipocliente']);

                // Exibindo as opções de cliente
                foreach ($resultados as $cliente) {
                    echo "<option value='$cliente[0]'>$cliente[1]</option>";
                }
                ?>
            </select>
        </div>

        <div class="d-flex justify-content-center mt-3">
            <input type="submit" value="Enviar" class="btn btn-primary">
        </div>
    </form>

    <div class="d-flex justify-content-center mt-3">
        <a href="form_aluguel.php" class="btn btn-secondary">Voltar</a>
    </div>
</div>

<!-- Incluindo Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
