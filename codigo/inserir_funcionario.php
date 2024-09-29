<?php

require_once "conexao.php";
require_once "operacoes.php";

$nome_funcionario = $_GET['nome_funcionario'];
$cpf_funcionario = $_GET['cpf_funcionario'];
$telefone_funcionario = $_GET['telefone_funcionario'];




salvarFuncionario($conexao, $nome_funcionario, $cpf_funcionario, $telefone_funcionario);
header("location: index.html")

?>
