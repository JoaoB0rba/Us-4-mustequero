<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veículos</title>
    <!-- Link para o CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Lista de Veículos</h1>

        <!-- Tabela Responsiva -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Id</th>
                        <th>Marca</th>
                        <th>Placa</th>
                        <th>Modelo</th>
                        <th>Número Chassi</th>
                        <th>Tipo</th>
                        <th>Cor</th>
                        <th>Capacidade</th>
                        <th>Porta Mala</th>
                        <th>Alugado</th>
                        <th>KM Atual</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once "conexao.php";
                    require_once "operacoes.php";

                    $resultados = listarCarros($conexao);

                    foreach ($resultados as $carro) {
                        echo "<tr>";
                        echo "<td>$carro[0]</td>";
                        echo "<td>$carro[1]</td>";
                        echo "<td>$carro[2]</td>";
                        echo "<td>$carro[3]</td>";
                        echo "<td>$carro[4]</td>";
                        echo "<td>$carro[5]</td>";
                        echo "<td>$carro[6]</td>";
                        echo "<td>$carro[7]</td>";
                        echo "<td>$carro[8]</td>";
                        echo "<td>$carro[9]</td>";
                        echo "<td>$carro[10]</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Script do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
