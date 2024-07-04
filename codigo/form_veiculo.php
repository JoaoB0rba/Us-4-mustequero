<?php

require_once "conexao.php";

$marca_veiculo = $_GET['marca_veiculo'];
$placa_veiculo = $_GET['placa_veiculo'];
$modelo_veiculo = $_GET['modelo_veiculo'];
$numero_chaci_veiculo = $_GET['chaci_veiculo'];
$tipo_veiculo = $_GET['tipo_veiculo'];
$cor_veiculo = $_GET['cor_veiculo'];
$capacidade_veiculo = $_GET['capacidade_veiculo'];
$porta_mala_veiculo = $_GET['porta_mala'];
$alugado_veiculo = $_GET['alugado_veiculo'];
$km_inicial_veiculo = $_GET['km_inicial_veiculo'];




$sql = "INSERT INTO tb_veiculo (marca_veiculo, placa_veiculo, modelo_veiculo, numero_chaci_veiculo, tipo_veiculo, cor_veiculo, capacidade_veiculo, porta_mala_veiculo, alugado_veiculo, km_inicial_veiculo) VALUES ('$marca_veiculo', '$placa_veiculo', '$modelo_veiculo', '$numero_chaci_veiculo', '$tipo_veiculo', '$cor_veiculo', '$capacidade_veiculo', '$porta_mala_veiculo', '$alugado_veiculo', '$km_inicial_veiculo')";

mysqli_query($conexao, $sql);

header("location: index.html")


?>





