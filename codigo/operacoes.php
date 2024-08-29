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



function salvarVeiculo($conexao, $marca_veiculo, $placa_veiculo, $modelo_veiculo, $numero_chaci_veiculo, $tipo_veiculo, $cor_veiculo, $capacidade_veiculo, $porta_mala_veiculo, $alugado_veiculo, $km_inicial_veiculo)
{
    $sql = "INSERT INTO tb_veiculo (marca_veiculo, placa_veiculo, modelo_veiculo, numero_chaci_veiculo, tipo_veiculo, cor_veiculo, capacidade_veiculo, porta_mala_veiculo, alugado_veiculo, km_inicial_veiculo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, "ssssssssss", $marca_veiculo, $placa_veiculo, $modelo_veiculo, $numero_chaci_veiculo, $tipo_veiculo, $cor_veiculo, $capacidade_veiculo, $porta_mala_veiculo, $alugado_veiculo, $km_inicial_veiculo);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    
}

function salvarfuncionario($conexao, $nome_funcionario, $cpf_funcionario, $telefone_funcionario)
{
    $sql = "INSERT INTO tb_funcionario (nome_funcionario, cpf_funcionario, telefone_funcionario) VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, "sss", $nome_funcionario, $cpf_funcionario, $telefone_funcionario);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    
}

function salvarPF($conexao, $cpf, $cnh, $nome, $tipo, $telefone)
{

    $idPessoa = salvarpessoa($conexao, $nome, $tipo, $telefone);

    $sql = "INSERT INTO tb_pessoa_fisica (cpf, cnh, tb_pessoas_idpessoas) VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, "ssi", $cpf, $cnh, $idPessoa);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    
}

function salvarPJ($conexao, $cnpj, $nome, $tipo, $telefone)
{

    $idPessoa = salvarpessoa($conexao, $nome, $tipo, $telefone);

    $sql = "INSERT INTO tb_pessoa_juridica (cnpj, tb_pessoas_idpessoas) VALUES (?, ?)";

    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, "si", $cnpj, $idPessoa);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    
}


function salvarpessoa($conexao, $nome, $tipo, $telefone)
{
    $sql = "INSERT INTO tb_pessoas (nome, tipo, telefone) VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, "sss", $nome, $tipo, $telefone);

    mysqli_stmt_execute($stmt);

    $id = mysqli_stmt_insert_id($stmt);

    mysqli_stmt_close($stmt);

    return $id;
    
}