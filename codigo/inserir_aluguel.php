<?php
/**
 * Realiza a operação de salvar um aluguel e associar veículos a ele, redirecionando para a página inicial.
 *
 * @requires session
 * @requires conexao.php
 * @requires operacoes.php
 */

session_start();

require_once "conexao.php";
require_once "operacoes.php";

$tipocliente = $_SESSION['tipocliente'];
$idFuncionario = $_SESSION['idFuncionario'];
$cliente = $_SESSION['cliente'];
$carros = $_SESSION['carros'];

// Salva o aluguel e obtém o ID do aluguel recém-criado
$idaluguel = salvarAluguel($conexao, $idFuncionario, $cliente);

// Armazena o ID do aluguel na sessão
$_SESSION['idaluguel'] = $idaluguel;

// Associa cada veículo ao aluguel
foreach ($carros as $id) {
    salvarVeiculoAluguel($conexao, $idaluguel, $id);
}

// Redireciona para a página inicial
header("location: telainicial.html");

?>
