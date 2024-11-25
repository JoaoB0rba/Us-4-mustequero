<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisar Veículos</title>
    <link rel="stylesheet" href="estilo/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="container mt-5">

    <form action="pesquisar_veiculo.php" method="get" class="mb-3">
        <div class="input-group">
            <input type="text" name="busca" class="form-control" placeholder="Pesquisar Veículos">
            <button type="submit" class="btn btn-primary">Pesquisar</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Placa</th>
                <th>Modelo</th>
                <th>Numero chaci</th>
                <th>Tipo Veiculo</th>
                <th>Cor veiculo</th>
                <th>Capacidade veiculo</th>
                <th>Porta mala</th>
                <th>alugado</th>
                <th>KM atual</th>
                <th colspan='2'>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once 'conexao.php';

            // Verificar se o formulário foi submetido
            if (isset($_GET['busca'])) {
                $busca = $_GET['busca'];
                $sql = "SELECT * FROM tb_veiculo WHERE modelo LIKE '%$busca%' OR marca LIKE '%$busca%'";
            } else {
                // Se não houver busca, seleciona todos os veículos
                $sql = "SELECT * FROM tb_veiculo";
            }

            $resultados = mysqli_query($conexao, $sql);

            if (mysqli_num_rows($resultados) > 0) {
                while ($linha = mysqli_fetch_array($resultados)) {
                    $idtb_veiculo = $linha['idtb_veiculo'];
                    $marca_veiculo = $linha['marca_veiculo'];
                    $placa_veiculo = $linha['placa_veiculo'];
                    $modelo_veiculo = $linha['modelo_veiculo'];
                    $numero_chaci_veiculo = $linha['numero_chaci_veiculo'];
                    $tipo_veiculo = $linha['tipo_veiculo'];
                    $cor_veiculo = $linha['cor_veiculo'];
                    $capacidade_veiculo = $linha['capacidade_veiculo'];
                    $porta_mala_veiculo = $linha['porta_mala_veiculo'];
                    $alugado_veiculo = $linha['alugado_veiculo'];
                    $km_atual = $linha['km_atual'];

                    echo "<tr>";
                    echo "<td>$idtb_veiculo</td>";
                    echo "<td>$marca_veiculo</td>";
                    echo "<td>$placa_veiculo</td>";
                    echo "<td>$modelo_veiculo</td>";
                    echo "<td>$numero_chaci_veiculo</td>";
                    echo "<td>$tipo_veiculo</td>";
                    echo "<td>$cor_veiculo</td>";
                    echo "<td>$capacidade_veiculo</td>";
                    echo "<td>$porta_mala_veiculo</td>";
                    echo "<td>$alugado_veiculo</td>";
                    echo "<td>$km_atual</td>";
                    echo "<td><a href='editar_veiculo.php?idtb_veiculo=$idtb_veiculo' class='btn btn-warning'>Editar</a></td>";
                    echo "<td><a href='excluir_veiculo.php?idtb_veiculo=$idtb_veiculo' class='btn btn-danger'>Excluir</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Nenhum veículo encontrado.</td></tr>";
            }

            mysqli_close($conexao);
            ?>
        </tbody>
    </table>
    <a href="pdf_veiculo.php">PDF</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
