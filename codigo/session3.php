<?php
session_start();
require_once "conexao.php";
require_once "operacoes.php";
$_SESSION['carros'] = $_REQUEST['carros'];
$carros=[];
$carros = $_SESSION['carros'];

atualiza_alugado($conexao, $carros);

header("location: form_aluguel4.php");
?>