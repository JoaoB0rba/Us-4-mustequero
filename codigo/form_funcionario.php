<?php

require_once "conexao.php";

$nome_funcionario = $_GET['nome_funcionario'];
$cpf_funcionario = $_GET['cpf_funcionario'];
$telefone_funcionario = $_GET['telefone_funcionario'];




$sql = "INSERT INTO tb_pagamento (nome_funcionario, cpf_funcionario, telefone_funcionar VALUES ('nome_funcionario', '$cpf_funcionario', '$telefone_funcionario')";

mysqli_query($conexao, $sql);

?>





