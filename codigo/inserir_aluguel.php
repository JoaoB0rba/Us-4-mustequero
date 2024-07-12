<?php
require_once 'conexao.php';

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados do formulário
    $funcionario_aluguel = $_POST['funcionario_aluguel'];
/*     $pessoa_aluguel = $_POST['pessoa_aluguel']; */
    $veiculos_aluguel = $_POST['veiculo_aluguel']; // Este será um array de IDs de veículos

    // Insere um novo registro na tabela tb_aluguel
    $sql_aluguel = "INSERT INTO tb_aluguel (data_inicial, tb_pagamento_idtb_pagamento, tb_funcionario_idtb_funcionario)
                    VALUES (NOW(), 1, $funcionario_aluguel)";
    
    if (mysqli_query($conexao, $sql_aluguel)) {
        // Obtém o ID do último aluguel inserido
        $id_aluguel = mysqli_insert_id($conexao);

        // Insere os registros na tabela de relacionamento tb_aluguel_has_tb_veiculo
        foreach ($veiculos_aluguel as $id_veiculo) {
            $sql_relacionamento = "INSERT INTO tb_aluguel_has_tb_veiculo (tb_aluguel_idtb_aluguel, tb_veiculo_idtb_veiculo)
                                   VALUES ($id_aluguel, $id_veiculo)";
            mysqli_query($conexao, $sql_relacionamento);
        }

        // Redireciona para a página desejada após inserção
        header("Location: index.html");
        exit();
    } else {
        echo "Erro ao inserir aluguel: " . mysqli_error($conexao);
    }
} else {
    echo "Método de requisição inválido.";
}
?>
