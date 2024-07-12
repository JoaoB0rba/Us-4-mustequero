<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento de Veículos Alugados</title>
</head>

<body>
    <h1>Pagamento de Veículos Alugados</h1>

    <h2>Veículos Alugados</h2>
    <table style="border-style: solid;">
        <tr>
            <td>Modelo</td>
            <td>Marca</td>
            <td>Cor</td>
            <td>Placa</td>
            <td>Km Inicial</td>
        </tr>
        <?php
        require_once 'conexao.php';

        $cpf = $_GET['cpf'];

        // Verifica se o CPF foi fornecido
        if (!$cpf) {
            echo "CPF não fornecido.";
            exit();
        }

        // Etapa 1: Encontrar o ID da pessoa física
        $sql_pessoa_fisica = "SELECT tb_pessoas_idpessoas FROM tb_pessoa_fisica WHERE cpf = '$cpf'";
        $result_pessoa_fisica = mysqli_query($conexao, $sql_pessoa_fisica);

        if ($result_pessoa_fisica) {
            if (mysqli_num_rows($result_pessoa_fisica) > 0) {
                $row_pessoa_fisica = mysqli_fetch_assoc($result_pessoa_fisica);
                $id_pessoa = $row_pessoa_fisica['tb_pessoas_idpessoas'];

                // Etapa 2: Encontrar os IDs dos aluguéis dessa pessoa
                $sql_alugueis = "SELECT tb_aluguel_idtb_aluguel FROM tb_aluguel_has_tb_pessoas WHERE tb_pessoas_idpessoas = $id_pessoa";
                $result_alugueis = mysqli_query($conexao, $sql_alugueis);

                if ($result_alugueis) {
                    if (mysqli_num_rows($result_alugueis) > 0) {
                        // Etapa 3: Para cada aluguel, encontrar os veículos alugados
                        while ($row_alugueis = mysqli_fetch_assoc($result_alugueis)) {
                            $id_aluguel = $row_alugueis['tb_aluguel_idtb_aluguel'];

                            $sql_veiculos = "SELECT tb_veiculo.* FROM tb_veiculo 
                                             INNER JOIN tb_aluguel_has_tb_veiculo 
                                             ON tb_veiculo.idtb_veiculo = tb_aluguel_has_tb_veiculo.tb_veiculo_idtb_veiculo 
                                             WHERE tb_aluguel_has_tb_veiculo.tb_aluguel_idtb_aluguel = $id_aluguel";

                            $result_veiculos = mysqli_query($conexao, $sql_veiculos);

                            if ($result_veiculos) {
                                while ($row_veiculos = mysqli_fetch_assoc($result_veiculos)) {
                                    echo "<tr>";
                                    echo "<td>" . $row_veiculos['modelo_veiculo'] . "</td>";
                                    echo "<td>" . $row_veiculos['marca_veiculo'] . "</td>";
                                    echo "<td>" . $row_veiculos['cor_veiculo'] . "</td>";
                                    echo "<td>" . $row_veiculos['placa_veiculo'] . "</td>";
                                    echo "<td>" . $row_veiculos['km_inicial_veiculo'] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "Erro ao consultar veículos: " . mysqli_error($conexao);
                            }
                        }
                    } else {
                        echo "<tr><td colspan='5'>Nenhum aluguel encontrado para esta pessoa.</td></tr>";
                    }
                } else {
                    echo "Erro ao consultar aluguéis: " . mysqli_error($conexao);
                }
            } else {
                echo "<tr><td colspan='5'>Nenhuma pessoa física encontrada com este CPF.</td></tr>";
            }
        } else {
            echo "Erro ao consultar pessoa física: " . mysqli_error($conexao);
        }
        ?>
    </table>

    <h2>Registrar Pagamento</h2>
    <form action="processa_pagamento.php" method="post">
        <label for="tipo_pagamento">Tipo de Pagamento:</label>
        <input type="text" id="tipo_pagamento" name="tipo_pagamento" required><br><br>

        <label for="valor_valorkm">Valor por KM:</label>
        <input type="text" id="valor_valorkm" name="valor_valorkm" pattern="\d+(\.\d{1,2})?" required><br><br>

        <label for="data_pagamento">Data de Pagamento:</label>
        <input type="date" id="data_pagamento" name="data_pagamento" required><br><br>

        <?php
        // Reiniciar consulta para os aluguéis
        $result_alugueis = mysqli_query($conexao, $sql_alugueis);

        if ($result_alugueis && mysqli_num_rows($result_alugueis) > 0) {
            while ($row_alugueis = mysqli_fetch_assoc($result_alugueis)) {
                $id_aluguel = $row_alugueis['tb_aluguel_idtb_aluguel'];

                $sql_veiculos = "SELECT tb_veiculo.* FROM tb_veiculo 
                                 INNER JOIN tb_aluguel_has_tb_veiculo 
                                 ON tb_veiculo.idtb_veiculo = tb_aluguel_has_tb_veiculo.tb_veiculo_idtb_veiculo 
                                 WHERE tb_aluguel_has_tb_veiculo.tb_aluguel_idtb_aluguel = $id_aluguel";

                $result_veiculos = mysqli_query($conexao, $sql_veiculos);

                if ($result_veiculos) {
                    while ($row_veiculos = mysqli_fetch_assoc($result_veiculos)) {
                        echo "<label for='km_final_$id_aluguel'>KM Final para {$row_veiculos['modelo_veiculo']}:</label>";
                        echo "<input type='number' id='km_final_$id_aluguel' name='km_final_$id_aluguel' required><br><br>";
                        echo "<input type='hidden' name='id_aluguel_$id_aluguel' value='$id_aluguel'>";
                        echo "<input type='hidden' name='id_veiculo_$id_aluguel' value='" . $row_veiculos['idtb_veiculo'] . "'>";
                    }
                } else {
                    echo "Erro ao consultar veículos: " . mysqli_error($conexao);
                }
            }
            echo "<input type='hidden' name='cpf' value='$cpf'>";
            echo "<input type='submit' value='Registrar Pagamento'>";
        } else {
            echo "<p>Nenhum aluguel encontrado para esta pessoa.</p>";
        }
        ?>
    </form>
</body>

</html>
