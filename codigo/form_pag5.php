<?php
require_once "conexao.php";
require_once "operacoes.php";
session_start();

    $idaluguel = $_GET['idaluguel'];
    $precokm = $_GET['precokm'];
    $tipopag = $_GET['tipopag'];
    $valorTotal = $_GET['valorTotal'];
    $kmFinal = $_GET['kmfinal'];  // Quilometragem final para cada veículo
    $veiculos = $_GET['veiculos'];  // IDs dos veículos

    // Atualiza a quilometragem atual do veículo (passando cada veículo individualmente)
    foreach ($kmFinal as $idVeiculo => $kmFinalValue) {
        atualiza_km_atual($conexao, $kmFinalValue, $idVeiculo);  // Atualiza o KM final do veículo
    }

    // Efetua o pagamento
    efetuarPagamento($conexao, $tipopag, $valorTotal, $precokm, $idaluguel);

    // Atualiza o status dos veículos para 'não alugados'
    atualiza_nao_alugado($conexao, explode(',', $veiculos));

    // Redireciona para a tela inicial ou uma página de sucesso
    header('Location: telainicial.html');
    exit();

?>
