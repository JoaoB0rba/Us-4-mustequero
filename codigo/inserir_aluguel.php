<?php

session_start();

require_once "conexao.php";
require_once "operacoes.php";

$tipocliente = $_SESSION['tipocliente'];
$idFuncionario = $_SESSION['idFuncionario'];
$cliente = $_SESSION['cliente'];
$carros = $_SESSION['carros'];


$idaluguel = salvarAluguel($conexao, $idFuncionario, $cliente);

$_SESSION['idaluguel'] = $idaluguel;

foreach ($carros as $id) {
    salvarVeiculoAluguel($conexao, $idaluguel, $id);
}

header("location: deucerto.html")

?>
