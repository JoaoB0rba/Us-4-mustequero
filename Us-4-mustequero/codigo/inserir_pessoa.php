<?php

require_once "conexao.php";
require_once "operacoes.php";

$nome = $_GET['nome'];
$telefone = $_GET['telefone'];
$cpf = $_GET['cpf'];
$cnh = $_GET['cnh'];

$tipo = 'pf';

salvarPF($conexao, $cpf, $cnh, $nome, $tipo, $telefone);

header("location: index.html");
