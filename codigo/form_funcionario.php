<?php

require_once "conexao.php";

$nome_funcionario = $_GET['nome_funcionario'];
$cpf_funcionario = $_GET['cpf_funcionario'];
$telefone_funcionario = $_GET['telefone_funcionario'];




$sql = "INSERT INTO tb_funcionario (nome_funcionario, cpf_funcionario, telefone_funcionario) VALUES ('$nome_funcionario', '$cpf_funcionario', '$telefone_funcionario')";

mysqli_query($conexao, $sql);

?>





