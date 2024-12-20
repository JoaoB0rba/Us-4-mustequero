<?php
/**
 * Salva um novo veículo no banco de dados e redireciona para a página inicial.
 *
 * @requires conexao.php
 * @requires operacoes.php
 */

require_once "conexao.php";
require_once "operacoes.php";

$marca_veiculo = $_GET['marca_veiculo'];
$placa_veiculo = $_GET['placa_veiculo'];
$modelo_veiculo = $_GET['modelo_veiculo'];
$numero_chaci_veiculo = $_GET['chaci_veiculo'];
$tipo_veiculo = $_GET['tipo_veiculo'];
$cor_veiculo = $_GET['cor_veiculo'];
$capacidade_veiculo = $_GET['capacidade_veiculo'];
$porta_mala_veiculo = $_GET['porta_mala'];
$alugado_veiculo = $_GET['alugado_veiculo'];
$km_atual = $_GET['km_atual'];

// Salva os dados do veículo no banco de dados
salvarVeiculo($conexao, $marca_veiculo, $placa_veiculo, $modelo_veiculo, $numero_chaci_veiculo, $tipo_veiculo, $cor_veiculo, $capacidade_veiculo, $porta_mala_veiculo, $alugado_veiculo, $km_atual);

// Redireciona para a página inicial
header("location: telainicial.html");

?>





