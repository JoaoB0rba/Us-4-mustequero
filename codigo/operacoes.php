<?php
/**
 * operações
 * 
 * funções gerais do site
 * 
 * @author Pedro <pedrohenriquereisferreira123@gmail.com>
 * @author Yuri <email@email.com>
 * @author Ana Carolini <email@email.com>
 * @author João <email@email.com>
 * 
 * @requires session
 * 
 * 
 */


 /**
  * salvarPF
  * @param [MYSQLI]     $conexao    contem dados do DB
  * @param [INT]        $cpf        id da pessoa fisica selecionada 
  * @param [INT]        $cnh        cnh da pessoa fisica selecionada 
  * @param [VARCHAR]    $nome       nome da pessoa selecionada
  * @param [VARCHAR]    $telefone   telefone da pessoa fisica 
  * @return void
  */

function salvarPF($conexao, $cpf, $cnh, $nome, $tipo, $telefone)
{

    $idPessoa = salvarpessoa($conexao, $nome, $tipo, $telefone);

    /**
     * @var string @sql
     */
    $sql = "INSERT INTO tb_pessoa_fisica (cpf, cnh, tb_pessoas_idpessoas) VALUES (?, ?, ?)";


    /**
     * @var mysqli_stmt $stmt
     */
    $stmt = mysqli_prepare($conexao, $sql);

    /** Monta os parâmetros do sql */
    mysqli_stmt_bind_param($stmt, "ssi", $cpf, $cnh, $idPessoa);

    /** Executa o sql */
    mysqli_stmt_execute($stmt);

    /** Fecha a conexão com o banco */
    mysqli_stmt_close($stmt);

}


 /**
  * salvarPJ
  * @param [MYSQLI]     $conexao    contem dados do DB
  * @param [INT]        $cnpj       cnpj da pessoa juridica selecionada 
  * @param [VARCHAR]    $nome       nome da pessoa selecionada 
  * @param [VARCHAR]    $tipo       tipo selecionada
  * @param [VARCHAR]    $telefone   telefone da pessoa juridica 
  * @return void
  */
function salvarPJ($conexao, $cnpj, $nome, $tipo, $telefone)
{

    $idPessoa = salvarpessoa($conexao, $nome, $tipo, $telefone);

    /**
     * @var string @sql
     */
    $sql = "INSERT INTO tb_pessoa_juridica (cnpj, tb_pessoas_idpessoas) VALUES (?, ?)";

    /**
     * @var mysqli_stmt $stmt
     */
    $stmt = mysqli_prepare($conexao, $sql);

    /** Monta os parâmetros do sql */
    mysqli_stmt_bind_param($stmt, "si", $cnpj, $idPessoa);

    /** Executa o sql */
    mysqli_stmt_execute($stmt);

    /** Fecha a conexão com o banco */
    mysqli_stmt_close($stmt);

}


/**
  * salvarPJ
  * @param [MYSQLI]     $conexao    contem dados do DB
  * @param [VARCHAR]    $nome       nome da pessoa selecionada 
  * @param [VARCHAR]    $tipo       se a pessoa e fisica ou juridica 
  * @param [VARCHAR]    $telefone   telefone da pessoa
  * @return void
  */
function salvarpessoa($conexao, $nome, $tipo, $telefone)
{
    /**
     * @var string @sql 
     */
    $sql = "INSERT INTO tb_pessoas (nome, tipo, telefone) VALUES (?, ?, ?)";

    /**
     * @var mysqli_stmt $stmt 
     */
    $stmt = mysqli_prepare($conexao, $sql);

    /** Monta os parâmetros do sql */
    mysqli_stmt_bind_param($stmt, "sss", $nome, $tipo, $telefone);

    /** Executa o sql */
    mysqli_stmt_execute($stmt);

    $id = mysqli_stmt_insert_id($stmt);

    /** Fecha a conexão com o banco */
    mysqli_stmt_close($stmt);

    /** Retorna o id selecionado */
    return $id;

}

function salvarFuncionario($conexao, $nome_funcionario, $cpf_funcionario, $telefone_funcionario, $senhaa) {
    $sql = "INSERT INTO tb_funcionario (nome_funcionario, cpf_funcionario, telefone_funcionario, senhaa) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, "ssss", $nome_funcionario, $cpf_funcionario, $telefone_funcionario, $senhaa);
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

function Login($conexao, $nome_funcionario, $senhaa) {
    // Consulta segura para verificar se o funcionário existe
    $sql_check = "SELECT * FROM tb_funcionario WHERE nome_funcionario = ? AND senhaa = ?";
    $stmt_check = mysqli_prepare($conexao, $sql_check);
    mysqli_stmt_bind_param($stmt_check, "ss", $nome_funcionario, $senhaa);
    mysqli_stmt_execute($stmt_check);
    $resultado = mysqli_stmt_get_result($stmt_check);

    // Verifica se há resultados
    if (mysqli_num_rows($resultado) > 0) {
        mysqli_stmt_close($stmt_check);
        return true; // Funcionário autenticado
    } else {
        mysqli_stmt_close($stmt_check);
        return false; // Funcionário não encontrado
    }
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


function listarpessoa($conexao)
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

function efetuarPagamento($conexao, $tipo, $preco_pagamento, $valor_valorkm, $tb_aluguel_idtb_aluguel) {
    $sql = "INSERT INTO tb_pagamento (tipo_pagamento, preco_pagamento, valor_valorkm, tb_aluguel_idtb_aluguel) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);

    // Corrige os parâmetros de ligação
    mysqli_stmt_bind_param($stmt, "sddi", $tipo, $preco_pagamento, $valor_valorkm, $tb_aluguel_idtb_aluguel);

    // Executa a consulta
    mysqli_stmt_execute($stmt);

    // Obtém o ID do pagamento inserido
    $id = mysqli_insert_id($conexao);

    // Fecha a declaração
    mysqli_stmt_close($stmt);

    return $id;
}


// UPDATE emprestimo_has_veiculo SET km_final = 50000 WHERE idemprestimo = 1 AND idveiculo = 1;

function atualiza_km_final_has($conexao, $km_final, $idemprestimo, $idveiculo) {
    // Ajuste da consulta SQL com os nomes corretos das colunas
    $sql = "UPDATE tb_aluguel_has_tb_veiculo SET kmfinal = ? WHERE tb_veiculo_idtb_veiculo = ? AND tb_aluguel_idtb_aluguel = ?";
    
    $stmt = mysqli_prepare($conexao, $sql);
    
    if ($stmt === false) {
        die("Erro ao preparar a consulta: " . mysqli_error($conexao));
    }

    // Bind dos parâmetros
    mysqli_stmt_bind_param($stmt, "dii", $km_final, $idveiculo, $idemprestimo);

    // Executa a query
    $executou = mysqli_stmt_execute($stmt);

    if (!$executou) {
        die("Erro ao atualizar km final: " . mysqli_stmt_error($stmt));
    }

    // Fecha a declaração
    mysqli_stmt_close($stmt);

    // Chama a função para atualizar o km atual do veículo
    atualiza_km_atual($conexao, $km_final, $idveiculo);
}



// UPDATE veiculo SET km_atual = 999 WHERE idveiculo = 3;
// function atualiza_km_atual($conexao, $km_atual, $idveiculo) {
//     $sql = "UPDATE tb_veiculo SET km_atual = ? WHERE idtb_veiculo = ?";
//     $stmt = mysqli_prepare($conexao, $sql);

//     mysqli_stmt_bind_param($stmt, "ii", $km_atual, $idveiculo);
//     mysqli_stmt_execute($stmt);

//     if (mysqli_stmt_error($stmt)) {
//         // Adicione uma verificação de erro
//         die("Erro ao atualizar km: " . mysqli_stmt_error($stmt));
//     }

//     mysqli_stmt_close($stmt);
// }

function atualiza_km_atual($conexao, $km_atual, $idveiculo) {
    // Prepara a query para atualizar o km_atual do veículo
    $sql = "UPDATE tb_veiculo SET km_atual = ? WHERE idtb_veiculo = ?";
    $stmt = mysqli_prepare($conexao, $sql);

    if ($stmt === false) {
        // Verifica se ocorreu algum erro ao preparar a consulta
        die("Erro ao preparar a consulta: " . mysqli_error($conexao));
    }

    // Bind dos parâmetros para a consulta
    mysqli_stmt_bind_param($stmt, "di", $km_atual, $idveiculo);

    // Executa a query
    $executou = mysqli_stmt_execute($stmt);

    if (!$executou) {
        // Verifica se ocorreu algum erro na execução da consulta
        die("Erro ao atualizar km: " . mysqli_stmt_error($stmt));
    }

    // Fecha a declaração
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



function listarFuncionarios($conexao) {
    $sql = "SELECT idtb_funcionario, nome_funcionario, cpf_funcionario, telefone_funcionario FROM tb_funcionario";
    $resultado = mysqli_query($conexao, $sql);

    // Verifica se a consulta foi bem-sucedida
    if (!$resultado) {
        die("Erro na consulta: " . mysqli_error($conexao));
    }

    $funcionarios = [];
    // Percorre os resultados e os armazena em um array
    while ($funcionario = mysqli_fetch_assoc($resultado)) {
        $funcionarios[] = $funcionario;
    }

    return $funcionarios; // Retorna o array com os funcionários
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

function listarClienteAlugado($conexao, $tipocliente)
{



    // Seleciona apenas os clientes que têm aluguéis pendentes
    $sql = "
        SELECT DISTINCT p.idpessoas, p.nome, p.telefone 
        FROM tb_pessoas p
        JOIN tb_aluguel a ON p.idpessoas = a.tb_pessoas_idpessoas
        LEFT JOIN tb_pagamento pag ON a.idtb_aluguel = pag.tb_aluguel_idtb_aluguel
        WHERE p.tipo = ? AND pag.tb_aluguel_idtb_aluguel IS NULL
        GROUP BY p.idpessoas
    ";
    
    $stmt = mysqli_prepare($conexao, $sql);
    
    // Bind do parâmetro do tipo de cliente
    mysqli_stmt_bind_param($stmt, "s", $tipocliente);
    
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $nome, $telefone);
    mysqli_stmt_store_result($stmt);
    
    $lista = [];
    if (mysqli_stmt_num_rows($stmt) > 0) {
        while (mysqli_stmt_fetch($stmt)) {
            $lista[] = [$id, $nome, $telefone];
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


function atualiza_nao_alugado($conexao, $carros) {
    // Prepara a query fora do loop
    $sql = "UPDATE tb_veiculo SET alugado_veiculo = 'N' WHERE idtb_veiculo = ?";

    $stmt = mysqli_prepare($conexao, $sql);

    if ($stmt) {
        foreach ($carros as $carro) {
            // Faz o bind do parâmetro e executa a query
            mysqli_stmt_bind_param($stmt, "i", $carro);
            mysqli_stmt_execute($stmt);
        }
        // Fecha o statement após o loop
        mysqli_stmt_close($stmt);
    } else {
        echo "Erro ao preparar a consulta: " . mysqli_error($conexao);
    }
}

function deletar_veiculo_aluguel($conexao, $idaluguel, $idveiculo) {
    $sql = "DELETE FROM tb_aluguel_has_tb_veiculo WHERE tb_aluguel_idtb_aluguel = ? AND tb_veiculo_idtb_veiculo = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($stmt, "ii", $idaluguel, $idveiculo);
    mysqli_stmt_execute($stmt);
    
    // Verifica se houve erro na execução
    if (mysqli_stmt_error($stmt)) {
        die("Erro ao deletar veículo do aluguel: " . mysqli_stmt_error($stmt));
    }

    mysqli_stmt_close($stmt);
}

function listarPessoaFisica($conexao) {
    $query = "SELECT 
                 tb_pessoa_fisica.idpessoa_fisica AS idtb_pessoa_fisica,
                 tb_pessoa_fisica.cpf AS cpf_pessoa,
                 tb_pessoa_fisica.cnh,
                 tb_pessoas.nome AS nome_pessoa,
                 tb_pessoas.telefone 
              FROM tb_pessoa_fisica
              INNER JOIN tb_pessoas 
              ON tb_pessoa_fisica.tb_pessoas_idpessoas = tb_pessoas.idpessoas
              WHERE tb_pessoas.tipo = 'pf'"; // Garante que apenas pessoas físicas sejam retornadas

    // Executa a consulta SQL
    $result = mysqli_query($conexao, $query);

    // Inicializa o array para armazenar os resultados
    $pessoasFisicas = [];

    // Verifica se a consulta retornou resultados
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Adiciona os resultados ao array
            $pessoasFisicas[] = $row;
        }
    }
    
    // Retorna o array com as pessoas físicas encontradas
    return $pessoasFisicas;
}


function listarPessoaJuridica($conexao) {
    // Query para buscar os dados das pessoas jurídicas
    $query = "SELECT 
                 tb_pessoa_juridica.idpessoa_juridica AS idtb_pessoa_juridica,
                 tb_pessoa_juridica.cnpj AS cnpj_pessoa,
                 tb_pessoas.nome AS nome_pessoa,
                 tb_pessoas.telefone
              FROM tb_pessoa_juridica
              INNER JOIN tb_pessoas 
              ON tb_pessoa_juridica.tb_pessoas_idpessoas = tb_pessoas.idpessoas
              WHERE tb_pessoas.tipo = 'pj'"; // Garante que apenas pessoas jurídicas sejam retornadas

    // Executa a consulta SQL
    $result = mysqli_query($conexao, $query);

    // Inicializa o array para armazenar os resultados
    $pessoasJuridicas = [];

    // Verifica se a consulta retornou resultados
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Adiciona os resultados ao array
            $pessoasJuridicas[] = $row;
        }
    }
    
    // Retorna o array com as pessoas jurídicas encontradas
    return $pessoasJuridicas;
}




function listarPagamentos($conexao) {
    $query = "SELECT 
                  pg.idtb_pagamento, 
                  pg.tipo_pagamento, 
                  pg.preco_pagamento, 
                  pg.valor_valorkm, 
                  al.idtb_aluguel 
              FROM tb_pagamento pg
              INNER JOIN tb_aluguel al ON pg.tb_aluguel_idtb_aluguel = al.idtb_aluguel";

    $resultado = mysqli_query($conexao, $query);

    if (!$resultado) {
        die("Erro na consulta: " . mysqli_error($conexao));
    }

    $pagamentos = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $pagamentos[] = $row;
    }

    return $pagamentos;
}


?>