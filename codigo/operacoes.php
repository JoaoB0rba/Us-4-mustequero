<?php

function listarCarros($conexao)
{
    $sql = "SELECT * FROM tb_veiculo";

    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idtb_veiculo, $marca_veiculo, $placa_veiculo, $modelo_veiculo,$numero_chaci_veiculo,$tipo_veiculo,$cor_veiculo,$capacidade_veiculo,$porta_mala_veiculo,$alugado_veiculo,$km_inicial_veiculo);

    mysqli_stmt_store_result($stmt);

    $lista = [];
    if (mysqli_stmt_num_rows($stmt) > 0) {
        while (mysqli_stmt_fetch($stmt)) {

            $lista[] = [$idtb_veiculo, $marca_veiculo, $placa_veiculo, $modelo_veiculo,$numero_chaci_veiculo,$tipo_veiculo,$cor_veiculo,$capacidade_veiculo,$porta_mala_veiculo,$alugado_veiculo,$km_inicial_veiculo];
        }
    }

    mysqli_stmt_close($stmt);

    return $lista;
}

// function listarSituacoes($conexao)
// {
//     $sql = "SELECT * FROM tb_situacao";

//     $stmt = mysqli_prepare($conexao, $sql);

//     mysqli_stmt_execute($stmt);

//     mysqli_stmt_bind_result($stmt, $id, $nome);

//     mysqli_stmt_store_result($stmt);

//     $lista = [];
//     if (mysqli_stmt_num_rows($stmt) > 0) {
//         while (mysqli_stmt_fetch($stmt)) {
//             $lista[] = [$id, $nome];
//         }
//     }
//     mysqli_stmt_close($stmt);

//     return $lista;
// }

// function buscarNomeSituacaoPorId($conexao, $id)
// {
//     $sql = "SELECT nome FROM tb_situacao WHERE id = ?";

//     $stmt = mysqli_prepare($conexao, $sql);

//     mysqli_stmt_bind_param($stmt, "i", $id);

//     mysqli_stmt_execute($stmt);

//     mysqli_stmt_bind_result($stmt, $nome);

//     if (mysqli_stmt_fetch($stmt)) {
//         return $nome;
//     }

//     mysqli_stmt_close($stmt);
// }

// corola e daqui pra baixo 

function salvarVeiculo($conexao, $marca_veiculo, $placa_veiculo, $modelo_veiculo, $chaci_veiculo, $tipo_veiculo, $cor_veiculo, $capacidade_veiculo, $porta_mala, $alugado_veiculo, $km_inicial_veiculo, $valor_veiculo)
{
    $sql = "INSERT INTO tb_veiculo (marca_veiculo, placa_veiculo, modelo_veiculo, chaci_veiculo, tipo_veiculo, cor_veiculo, capacidade_veiculo, porta_mala, alugado_veiculo, km_inicial_veiculo, valor_veiculo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, "ssssssssss", $marca_veiculo, $placa_veiculo, $modelo_veiculo, $chaci_veiculo, $tipo_veiculo, $cor_veiculo, $capacidade_veiculo, $porta_mala, $alugado_veiculo, $km_inicial_veiculo, $valor_veiculo);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    
}

function salvarFuncionario($conexao, $nome_funcionario, $cpf_funcionario, $telefone_funcionario)
{
    $sql = "INSERT INTO tb_funcionario (nome_funcionario, cpf_funcionario, telefone_funcionario) VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, "sss", $nome_funcionario, $cpf_funcionario, $telefone_funcionario);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    
}