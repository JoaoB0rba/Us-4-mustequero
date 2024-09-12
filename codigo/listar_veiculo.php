
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
            

            echo "</tr>";
        }
        ?>

<!-- 
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
         } -->
        
    </table>
</body>

</html>
