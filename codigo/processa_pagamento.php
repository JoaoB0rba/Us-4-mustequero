<?php
require_once 'conexao.php';

// Verifica se todos os dados foram recebidos do formulário
if (
    !isset($_POST['cpf']) ||
    !isset($_POST['num_alugueis']) ||
    !isset($_POST['tipo_pagamento']) ||
    !isset($_POST['valor_valorkm']) ||
    !isset($_POST['data_pagamento'])
) {
    echo "Dados incompletos. Verifique o formulário.";
    exit();
}

$cpf = $_POST['cpf'];
$num_alugueis = $_POST['num_alugueis'];
$tipo_pagamento = $_POST['tipo_pagamento'];
$valor_valorkm = $_POST['valor_valorkm'];
$data_pagamento = $_POST['data_pagamento'];

// Prepara a consulta para inserir o pagamento na tabela tb_pagamento
$sql_insere_pagamento = "INSERT INTO tb_pagamento (tipo_pagamento, preco_pagamento, km_final, valor_valorkm, data_pagamento)
                        VALUES ('$tipo_pagamento', '0', '0', '$valor_valorkm', '$data_pagamento')";

if (mysqli_query($conexao, $sql_insere_pagamento)) {
    $id_pagamento = mysqli_insert_id($conexao); // Obtém o ID do pagamento inserido

    // Processar cada aluguel
    for ($i = 1; $i <= $num_alugueis; $i++) {
        // Verifica se os dados específicos deste aluguel foram recebidos
        if (
            !isset($_POST["id_aluguel_$i"]) ||
            !isset($_POST["id_veiculo_$i"]) ||
            !isset($_POST["km_final_$i"])
        ) {
            echo "Dados incompletos para o aluguel $i. Verifique o formulário.";
            exit();
        }

        // Obtém os dados do formulário
        $id_aluguel = $_POST["id_aluguel_$i"];
        $id_veiculo = $_POST["id_veiculo_$i"];
        $km_final = $_POST["km_final_$i"];

        // Atualiza a tabela tb_veiculo com o novo km_inicial
        $sql_atualiza_km = "UPDATE tb_veiculo SET km_inicial_veiculo = '$km_final' WHERE idtb_veiculo = $id_veiculo";

        if (mysqli_query($conexao, $sql_atualiza_km)) {
            // Calcula o preço do aluguel com base no km percorrido
            $sql_veiculo = "SELECT km_inicial_veiculo FROM tb_veiculo WHERE idtb_veiculo = $id_veiculo";
            $result_veiculo = mysqli_query($conexao, $sql_veiculo);

            if ($result_veiculo) {
                $row_veiculo = mysqli_fetch_assoc($result_veiculo);
                $km_inicial = $row_veiculo['km_inicial_veiculo'];
                $km_percorrido = $km_final - $km_inicial;
                $preco_aluguel = $km_percorrido * $valor_valorkm;

                // Atualiza o preço do pagamento na tabela tb_pagamento
                $sql_atualiza_pagamento = "UPDATE tb_pagamento SET preco_pagamento = '$preco_aluguel', km_final = '$km_final' WHERE idtb_pagamento = $id_pagamento";

                if (!mysqli_query($conexao, $sql_atualiza_pagamento)) {
                    echo "Erro ao atualizar o preço do pagamento: " . mysqli_error($conexao);
                }
            } else {
                echo "Erro ao buscar o km inicial do veículo: " . mysqli_error($conexao);
            }
        } else {
            echo "Erro ao atualizar o km inicial do veículo: " . mysqli_error($conexao);
        }
    }

    // Inserir o registro de aluguel na tabela tb_aluguel
    $sql_insere_aluguel = "INSERT INTO tb_aluguel (data_inicial, tb_funcionario_idtb_funcionario, tb_pagamento_idtb_pagamento)
                           VALUES ('$data_pagamento', 1, $id_pagamento)";

    if (!mysqli_query($conexao, $sql_insere_aluguel)) {
        echo "Erro ao inserir o registro de aluguel: " . mysqli_error($conexao);
    }

    // Redireciona para a página de sucesso
    header("Location: sucesso_pagamento.php");
    exit();
} else {
    echo "Erro ao inserir o pagamento: " . mysqli_error($conexao);
}

mysqli_close($conexao);
?>
