<?php

require_once "conexao.php";

$nome = $_GET['nome'];
$tipo = $_GET['tipo'];
$telefone = $_GET['telefone'];
$cnpj = $_GET['cnpj'];


$sql = "INSERT INTO tb_pessoas (nome, tipo, telefone) VALUES ('$nome', '$tipo', '$telefone')";
mysqli_query($conexao, $sql);

$idpessoas = mysqli_insert_id($conexao);

$sql = "INSERT INTO tb_pessoa_juridica (cnpj, tb_pessoas_idpessoas) VALUES ('$cnpj', $idpessoas)";
mysqli_query($conexao, $sql);

header("location: index.html")
?>
