<?php
/**
 * Salva um novo funcionário no banco de dados e redireciona para a página inicial.
 *
 * @requires conexao.php
 * @requires operacoes.php
 */

require_once "conexao.php";
require_once "operacoes.php";

$nome_funcionario = $_GET['nome_funcionario'];
$cpf_funcionario = $_GET['cpf_funcionario'];
$telefone_funcionario = $_GET['telefone_funcionario'];
$senhaa = $_GET['senhaa'];

salvarFuncionario($conexao, $nome_funcionario, $cpf_funcionario, $telefone_funcionario, $senhaa);

// Redireciona para a página inicial
header("location: telainicial.html");

?>