<?php
/**
 * Salva uma nova pessoa jurídica no banco de dados e redireciona para a página inicial.
 *
 * @requires conexao.php
 * @requires operacoes.php
 */

require_once "conexao.php";
require_once "operacoes.php";

$nome = $_GET['nome'];
$telefone = $_GET['telefone'];
$cnpj = $_GET['cnpj'];

$tipo = 'pj';

// Salva os dados da pessoa jurídica no banco de dados
salvarPJ($conexao, $cnpj, $nome, $tipo, $telefone);

// Redireciona para a página inicial
header("location: telainicial.html");
?>
