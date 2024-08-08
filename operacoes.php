<?php}

function salvarVeiculo($conexao, $marca_veiculo, $placa_veiculo, $modelo_veiculo, $chaci_veiculo, $tipo_veiculo, $cor_veiculo, $capacidade_veiculo, $porta_mala, $alugado_veiculo, $km_inicial_veiculo, $valor_veiculo)
{
    $sql = "INSERT INTO tb_veiculo (marca_veiculo, placa_veiculo, modelo_veiculo, chaci_veiculo, tipo_veiculo, cor_veiculo, capacidade_veiculo, porta_mala, alugado_veiculo, km_inicial_veiculo, valor_veiculo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, "ssssssssss", $conexao, $marca_veiculo, $placa_veiculo, $modelo_veiculo, $chaci_veiculo, $tipo_veiculo, $cor_veiculo, $capacidade_veiculo, $porta_mala, $alugado_veiculo, $km_inicial_veiculo, $valor_veiculo);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    
}

function salvarFuncionario($conexao, $nome_funcionario, $cpf_funcionario, $telefone_funcionario)
{
    $sql = "INSERT INTO tb_veiculo (nome_funcionario, cpf_funcionario, telefone_funcionario) VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, "ssssssssss", $conexao, $marca_veiculo, $placa_veiculo, $modelo_veiculo, $chaci_veiculo, $tipo_veiculo, $cor_veiculo, $capacidade_veiculo, $porta_mala, $alugado_veiculo, $km_inicial_veiculo, $valor_veiculo);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    
}