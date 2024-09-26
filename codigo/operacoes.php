<?php

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

function salvarFuncionario($conexao, $nome, $cpf, $telefone) {
    $sql = "INSERT INTO tb_funcionario (nome_funcionario, cpf_funcionario, telefone_funcionario) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, "sss", $nome, $cpf, $telefone);
    mysqli_stmt_execute($stmt);

    $id = mysqli_stmt_insert_id($stmt);
    mysqli_stmt_close($stmt);

    return $id;
}

function salvarVeiculo($conexao, $marca_veiculo, $placa_veiculo, $modelo_veiculo, $numero_chaci_veiculo, $tipo_veiculo, $cor_veiculo, $capacidade_veiculo, $porta_mala_veiculo, $alugado_veiculo) {
    $sql = "INSERT INTO tb_veiculo (marca_veiculo, placa_veiculo, modelo_veiculo, numero_chaci_veiculo, tipo_veiculo, cor_veiculo, capacidade_veiculo, porta_mala_veiculo, alugado_veiculo ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, "sssssssss", $marca_veiculo, $placa_veiculo, $modelo_veiculo, $numero_chaci_veiculo, $tipo_veiculo, $cor_veiculo, $capacidade_veiculo, $porta_mala_veiculo, $alugado_veiculo);
    mysqli_stmt_execute($stmt);

    $id = mysqli_stmt_insert_id($stmt);
    mysqli_stmt_close($stmt);

    return $id;
}


function listarCarros($conexao)
 {
     $sql = "SELECT * FROM tb_veiculo";
     $stmt = mysqli_prepare($conexao, $sql);
     mysqli_stmt_execute($stmt);
     mysqli_stmt_bind_result($stmt, $idtb_veiculo, $marca_veiculo, $placa_veiculo, $modelo_veiculo,$numero_chaci_veiculo,          $tipo_veiculo,$cor_veiculo,$capacidade_veiculo,$porta_mala_veiculo,$alugado_veiculo);
     mysqli_stmt_store_result($stmt);
     $lista = [];
     if (mysqli_stmt_num_rows($stmt) > 0) {
         while (mysqli_stmt_fetch($stmt)) {
             $lista[] = [$idtb_veiculo, $marca_veiculo, $placa_veiculo, $modelo_veiculo,$numero_chaci_veiculo,$tipo_veiculo,$cor_veiculo,$capacidade_veiculo,$porta_mala_veiculo,$alugado_veiculo];
        }
    }
    mysqli_stmt_close($stmt);
    return $lista;
}


// // falta arrumar aluguel e o pagamento ;

function salvarAluguel($conexao, $idfuncionario, $idcliente) {
    $sql = "INSERT INTO emprestimo (idfuncionario, idcliente) VALUES (?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, "ii", $idfuncionario, $idcliente);
    mysqli_stmt_execute($stmt);

    $id = mysqli_stmt_insert_id($stmt);
    mysqli_stmt_close($stmt);

    return $id;
}

function salvarVeiculoEmprestimo($conexao, $idemprestimo, $idveiculo) {

    $km_inicial = kmInicialVeiculo($conexao, $idveiculo);
    $km_final = 0;

    $sql = "INSERT INTO tb_aluguel_has_tb_veiculo (tb_aluguel_idtb_aluguel, tb_veiculo_idtb_veiculo, kmfinal, kminicial) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, "iiss", $tb_aluguel_idtb_aluguel, $tb_veiculo_idtb_veiculo, $kmfinal, $kminicial);
    mysqli_stmt_execute($stmt);

    $id = mysqli_stmt_insert_id($stmt);
    mysqli_stmt_close($stmt);

    return $id;
}

function kmInicialVeiculo($conexao, $idveiculo) {
    $sql = "SELECT km_atual FROM tb_veiculo WHERE idtb_veiculo = ?";
    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, 'i', $idveiculo);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $km);

    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    return $km;
}

function efetuarPagamento($conexao, $tipo, $preco_pagamento, $valor_valorkm, $tb_aluguel_idtb_aluguel) {
    $sql = "INSERT INTO tb_pagamento (tipo, preco_pagamento, valor_valorkm, tb_aluguel_idtb_aluguel) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, "idds", $tipo, $preco, $preco_pagamento, $tb_aluguel_idtb_aluguel);
    mysqli_stmt_execute($stmt);

    $id = mysqli_stmt_insert_id($stmt);
    mysqli_stmt_close($stmt);

    return $id;
}

// UPDATE emprestimo_has_veiculo SET km_final = 50000 WHERE idemprestimo = 1 AND idveiculo = 1;

function atualiza_km_final($conexao, $km_final, $idemprestimo, $idveiculo) {
    $sql = "UPDATE emprestimo_has_veiculo SET km_final = ? WHERE idemprestimo = ? AND idveiculo = ?";
    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, "dii", $km_final, $idemprestimo, $idveiculo);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    atualiza_km_atual($conexao, $km_final, $idveiculo);
}

// UPDATE veiculo SET km_atual = 999 WHERE idveiculo = 3;
function atualiza_km_atual($conexao, $km_atual, $idveiculo) {
    $sql = "UPDATE veiculo SET km_atual = ? WHERE idveiculo = ?";
    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, "ii", $km_atual, $idveiculo);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
}

function salvarEmprestimo($conexao, $idfuncionario, $idcliente) {   
    $sql = "INSERT INTO tb_aluguel (data_inicial,tb_funcionario_idtb_funcionario, tb_pessoas_idpessoas) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, "sii",$data_inicial, $tb_funcionario_idtb_funcionario, $tb_pessoas_idpessoas);
    mysqli_stmt_execute($stmt);

    $id = mysqli_stmt_insert_id($stmt);
    mysqli_stmt_close($stmt);

    return $id;
}

 ?>