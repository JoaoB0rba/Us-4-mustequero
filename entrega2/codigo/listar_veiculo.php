
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veículos</title>
</head>

<body>
    <h1>Lista de Veículos</h1>

    <table style="border-style: solid;">
        <tr>
            <td>Modelo</td>
            <td>Marca</td>
            <td>Cor</td>
            <td>Placa</td>
            <td>Situação</td>


        </tr>
        <?php
        require_once "conexao.php";

        $sql = "SELECT * FROM tb_veiculo";

        $resultados = mysqli_query($conexao, $sql);

        if (mysqli_num_rows($resultados)) {
            while ($linha = mysqli_fetch_array($resultados)) {
                $modelo_veiculo = $linha['modelo_veiculo'];
                $marca_veiculo = $linha['marca_veiculo'];
                $cor_veiculo = $linha['cor_veiculo'];
                $placa_veiculo = $linha['placa_veiculo'];
                $alugado_veiculo = $linha['alugado_veiculo'];

                echo "<tr>";
                echo "<td>$modelo_veiculo</td>";
                echo "<td>$marca_veiculo</td>";
                echo "<td>$cor_veiculo</td>";
                echo "<td>$placa_veiculo</td>";
                echo "<td>$alugado_veiculo</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</body>

</html>
