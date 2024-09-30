<?php

require_once "conexao.php";
require_once "operacoes.php";

$idFuncionario = $_GET['idFuncionario'];
$tipocliente = $_GET['tipocliente'];


session_start();
$_SESSION['idFuncionario'] = $_GET['idFuncionario'];
$_SESSION['tipocliente'] = $_GET['tipocliente'];
header("location: form_aluguel2.php")

?>