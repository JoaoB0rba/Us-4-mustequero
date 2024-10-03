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

function salvarVeiculo($conexao, $marca_veiculo, $placa_veiculo, $modelo_veiculo, $numero_chaci_veiculo, $tipo_veiculo, $cor_veiculo, $capacidade_veiculo, $porta_mala_veiculo, $alugado_veiculo, $km_atual) {
    $sql = "INSERT INTO tb_veiculo (marca_veiculo, placa_veiculo, modelo_veiculo, numero_chaci_veiculo, tipo_veiculo, cor_veiculo, capacidade_veiculo, porta_mala_veiculo, alugado_veiculo , km_atual) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, "ssssssssss", $marca_veiculo, $placa_veiculo, $modelo_veiculo, $numero_chaci_veiculo, $tipo_veiculo, $cor_veiculo, $capacidade_veiculo, $porta_mala_veiculo, $alugado_veiculo, $km_atual);
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
     mysqli_stmt_bind_result($stmt, $idtb_veiculo, $marca_veiculo, $placa_veiculo, $modelo_veiculo,$numero_chaci_veiculo,$tipo_veiculo,$cor_veiculo,$capacidade_veiculo,$porta_mala_veiculo,$alugado_veiculo,$km_atual);
     mysqli_stmt_store_result($stmt);
     $lista = [];
     if (mysqli_stmt_num_rows($stmt) > 0) {
         while (mysqli_stmt_fetch($stmt)) {
             $lista[] = [$idtb_veiculo, $marca_veiculo, $placa_veiculo, $modelo_veiculo,$numero_chaci_veiculo,$tipo_veiculo,$cor_veiculo,$capacidade_veiculo,$porta_mala_veiculo,$alugado_veiculo,$km_atual];
        }
    }
    mysqli_stmt_close($stmt);
    return $lista;
}

// // falta arrumar aluguel e o pagamento ;

// function salvarAluguel($conexao, $idfuncionario, $idcliente) {
//     $sql = "INSERT INTO emprestimo (idfuncionario, idcliente) VALUES (?, ?)";
//     $stmt = mysqli_prepare($conexao, $sql);

//     mysqli_stmt_bind_param($stmt, "ii", $idfuncionario, $idcliente);
//     mysqli_stmt_execute($stmt);

//     $id = mysqli_stmt_insert_id($stmt);
//     mysqli_stmt_close($stmt);

//     return $id;
// }

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

function listarFuncionario($conexao)
{
    $sql= "SELECT idtb_funcionario, nome_funcionario FROM tb_funcionario";
    $stmt= mysqli_prepare($conexao,$sql);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,$id,$nome);
    mysqli_stmt_store_result($stmt);
    $lista = [];
    if (mysqli_stmt_num_rows($stmt) > 0){
        while (mysqli_stmt_fetch($stmt)){
            $lista[]=[$id, $nome];
        }
    }
    mysqli_stmt_close($stmt);
    return $lista;
}

function listarCliente($conexao, $tipocliente)
{
    // $sql = "SELECT * FROM tb_pessoas WHERE tipo = ?" PERGUNTAR PRO PROFESSOR COMO FAZ DESSE JEITO COM "?";

    $sql = "SELECT idpessoas,nome,telefone FROM tb_pessoas WHERE tipo = '$tipocliente'";
    
    $stmt= mysqli_prepare($conexao,$sql);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,$id,$nome,$telefone);
    mysqli_stmt_store_result($stmt);
    $lista = [];
    if (mysqli_stmt_num_rows($stmt) > 0){
        while (mysqli_stmt_fetch($stmt)){
            $lista[]=[$id, $nome,$telefone];
        }
    }
    mysqli_stmt_close($stmt);
    return $lista;
}
function listarCarrosN($conexao) {
    $sql = "SELECT * FROM tb_veiculo WHERE alugado_veiculo = 'N'";
    $resultado = mysqli_query($conexao, $sql);

    // Verifica se a consulta foi bem-sucedida
    if (!$resultado) {
        die("Erro na consulta: " . mysqli_error($conexao));
    }

    $carros = [];
    // Percorre os resultados e os armazena em um array
    while ($carro = mysqli_fetch_assoc($resultado)) {
        // Adiciona uma verificação para ver se a chave existe
        if (isset($carro['idtb_veiculo'])) {
            $carros[] = $carro;
        }
    }

    return $carros; // Retorna o array com os carros disponíveis
}

// function confiraDados($conexao, $tipocliente, $idFuncionario, $cliente, $carros){
// }

function salvarAluguel($conexao, $idFuncionario, $cliente) {
    $dataInicial = date('Y-m-d H:i:s'); // Formato adequado para o timestamp
    $sql = "INSERT INTO tb_aluguel (data_inicial, tb_funcionario_idtb_funcionario, tb_pessoas_idpessoas) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, "sii", $dataInicial, $idFuncionario, $cliente);
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

function salvarVeiculoAluguel($conexao, $idaluguel, $idveiculo) {

    $km_inicial = kmInicialVeiculo($conexao, $idveiculo);
    $km_final = 0;

    $sql = "INSERT INTO tb_aluguel_has_tb_veiculo (tb_aluguel_idtb_aluguel, tb_veiculo_idtb_veiculo, kmfinal, kminicial) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, "iiss", $idaluguel, $idveiculo, $km_final, $km_inicial);
    mysqli_stmt_execute($stmt);

    $id = mysqli_stmt_insert_id($stmt);
    mysqli_stmt_close($stmt);

    return $id;
}

function atualiza_alugado($conexao, $carros) {
    $sql = "UPDATE tb_veiculo SET alugado_veiculo = 'S' WHERE idtb_veiculo = ?";

    $stmt = mysqli_prepare($conexao, $sql);

    foreach ($carros as $carro) {
        mysqli_stmt_bind_param($stmt, "i", $carro);
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
}

function listarAluguelCliente($conexao, $cliente) {
    $sql = "SELECT * FROM tb_aluguel WHERE tb_pessoas_idpessoas = ?";

    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, "i", $cliente);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $aluguel, $data, $funcionario, $cliente);

    $lista = [];
    if (mysqli_stmt_num_rows($stmt) > 0) {
        while (mysqli_stmt_fetch($stmt)) {
          $lista[] = [$aluguel, $data, $funcionario, $cliente];
        }
    }

    mysqli_stmt_close($stmt);

    return $lista;
}


function listarVeiculosAluguel($conexao, $idaluguel) {
    $sql = "SELECT tb_veiculo_idtb_veiculo, kminicial FROM tb_aluguel_has_tb_veiculo WHERE tb_aluguel_idtb_aluguel = ?";

    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, "i", $idaluguel);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $idveiculo, $km_inicial);

    $lista = [];
    if (mysqli_stmt_num_rows($stmt) > 0) {
        while (mysqli_stmt_fetch($stmt)) {
          $lista[] = [$idveiculo, $km_inicial];
        }
    }

    mysqli_stmt_close($stmt);

    return $lista;
}



function listarVeiculoPorId($conexao, $idveiculo)
{
    $sql = "SELECT * FROM tb_veiculo WHERE idtb_veiculo = ?";

    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, 'i', $idveiculo);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $id, $marca, $placa, $modelo, $chaci, $tipo, $cor, $capacidade, $porta_mala, $alugado, $km_atual);

    mysqli_stmt_store_result($stmt);

    $lista = 0;
    if (mysqli_stmt_num_rows($stmt) > 0) {
        while (mysqli_stmt_fetch($stmt)) {
          $lista = [$id, $marca, $placa, $modelo, $chaci, $tipo, $cor, $capacidade, $porta_mala, $alugado, $km_atual];
        }
    }

    mysqli_stmt_close($stmt);

    return $lista;
}

?>