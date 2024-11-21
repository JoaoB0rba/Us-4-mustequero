<?php

require_once "conexao.php";
require_once "operacoes.php";

$nome = $_GET['nome'];
$telefone = $_GET['telefone'];
$cnpj = $_GET['cnpj'];

$tipo = 'pj';

salvarPJ($conexao, $cnpj, $nome, $tipo, $telefone);

header("location: telainicial.html")
?>
