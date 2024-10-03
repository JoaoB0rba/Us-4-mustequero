
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
            <td>Id</td>
            <td>Marca</td>
            <td>Placa</td>
            <td>Modelo</td>
            <td>Número Chaci</td>
            <td>Tipo</td>
            <td>Cor</td>
            <td>Capacidade</td>
            <td>Porta Mala</td>
            <td>Alugado</td>
            <td>km_atual</td>

           



        </tr>
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

        
    </table>
</body>

</html>
