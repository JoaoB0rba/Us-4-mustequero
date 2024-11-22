<?php
/**
 * Salva uma nova pessoa física no banco de dados e redireciona para a página inicial.
 *
 * @requires conexao.php
 * @requires operacoes.php
 */

require_once "conexao.php";
require_once "operacoes.php";

$nome = $_GET['nome'];
$telefone = $_GET['telefone'];
$cpf = $_GET['cpf'];
$cnh = $_GET['cnh'];

$tipo = 'pf';

// Salva os dados da pessoa física no banco de dados
salvarPF($conexao, $cpf, $cnh, $nome, $tipo, $telefone);

// Redireciona para a página inicial
header("location: telainicial.html");

?>