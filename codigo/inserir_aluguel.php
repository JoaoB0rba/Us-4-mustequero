<?php
require_once 'conexao.php';
require_once 'operacoes.php';
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados do formulário
    $funcionario_aluguel = $_POST['funcionario_aluguel'];
    $pessoa_aluguel = $_POST['pessoa_aluguel']; // ID da pessoa (não é um array)
    $veiculos_aluguel = $_POST['veiculo_aluguel']; // Array de IDs de veículos
    $data_inicial = $_POST['data_inicial']; // Data inicial do aluguel
    $pessoa_aluguel = $_POST['pessoa_aluguel']; 


    // Insere um novo registro na tabela tb_aluguel
    $sql_aluguel = "INSERT INTO tb_aluguel (data_inicial, tb_funcionario_idtb_funcionario, tb_pagamento_idtb_pagamento, tb_pessoas_idpessoas)
                    VALUES ('$data_inicial', $funcionario_aluguel, 1,$pessoa_aluguel)";
   
    if (mysqli_query($conexao, $sql_aluguel)) { 
        // Obtém o ID do último aluguel inserido
        $id_aluguel = mysqli_insert_id($conexao);

        // Insere os registros na tabela de relacionamento tb_aluguel_has_tb_veiculo
       
         $kminicial =  kmInicialVeiculo($conexao, $veiculos_aluguel);
         $kmfinal = 0;
        foreach ($veiculos_aluguel as $veiculos_aluguel) {
            $sql_relacionamento_veiculo = "INSERT INTO tb_aluguel_has_tb_veiculo (tb_aluguel_idtb_aluguel, tb_veiculo_idtb_veiculo, kmfinal, kminicial) VALUES ($tb_aluguel_idtb_aluguel, $tb_veiculo_idtb_veiculo, $kmfinal, $kminicial)";
            mysqli_query($conexao, $sql_relacionamento_veiculo);
        }

        // Insere o registro na tabela de relacionamento tb_aluguel_has_tb_pessoas
        $sql_relacionamento_pessoa = "INSERT INTO tb_aluguel_has_tb_pessoas (tb_aluguel_idtb_aluguel, tb_pessoas_idpessoas)
                                      VALUES ($id_aluguel, $pessoa_aluguel)";
        mysqli_query($conexao, $sql_relacionamento_pessoa);

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
