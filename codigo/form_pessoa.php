<?php

require_once "conexao.php";

$nome = $_GET['nome'];
$tipo = $_GET['tipo'];
$telefone = $_GET['telefone'];
$cpf = $_GET['cpf'];
$cnh = $_GET['cnh'];

$sql = "INSERT INTO tb_pessoas (nome, tipo, telefone) VALUES ('$nome', '$tipo', '$telefone')";
mysqli_query($conexao, $sql);

$idpessoas = mysqli_insert_id($conexao);

$sql = "INSERT INTO tb_pessoa_fisica (cpf, cnh, tb_pessoas_idpessoas) VALUES ('$cpf', '$cnh', $idpessoas)";
mysqli_query($conexao, $sql);

header("location: index.html")
?>





