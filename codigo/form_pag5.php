<?php
require_once "conexao.php";
require_once "operacoes.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['precokm']) && isset($_POST['tipopag']) && isset($_POST['valorTotal'])) {
    $idaluguel = $_POST['idaluguel'];
    $precokm = $_POST['precokm'];
    $tipopag = $_POST['tipopag'];
    $valorTotal = $_POST['valorTotal'];
    $kmFinal = $_POST['kmfinal'];  // Quilometragem final para cada veículo
    $veiculos = $_POST['veiculos'];  // IDs dos veículos

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
} else {
    // Se os dados não foram enviados corretamente, redireciona para a página de lançamento do pagamento
    header('Location: form_pag4.php?idaluguel=' . $_POST['idaluguel']);
    exit();
}
?>
