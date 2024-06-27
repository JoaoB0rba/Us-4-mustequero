<?php

require_once "conexao.php";

$marca_veiculo = $_GET['marca'];
$placa_veiculo = $_GET['placa'];
$modelo_veiculo = $_GET['modelo'];
$numero_chaci_veiculo = $_GET['chaci'];
$tipo_veiculo = $_GET['tipo'];
$cor_veiculo = $_GET['cor'];
$capacidade_veiculo = $_GET['capacidade'];
$porta_mala_veiculo = $_GET['mala'];
$km_inicial_veiculo = $GET['km_inicial'];
$valo_veiculo = $_GET['valor'];
$alugado_veiculo = $_GET['situacao'];



$sql = "INSERT INTO tb_veiculo (marca, placa, modelo, chaci, tipo, cor, capacidade, mala, km_inicial, valor, situacao) VALUES ('$marca_veiculo', '$placa_veiculo', '$modelo_veiculo', '$numero_chaci_veiculo', '$tipo_veiculo', '$cor_veiculo', '$capacidade_veiculo', '$porta_mala_veiculo', '$km_inicial_veiculo '$valor_veiculo', '$alugado_veiculo')";

mysqli_query($conexao, $sql);

//header("Location: listar_alunos.php")


?>






