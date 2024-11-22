<?php
/**
 * Redireciona para o formulário de aluguel, armazenando informações do funcionário e tipo de cliente na sessão.
 * 
 * @author Pedro <pedrohenriquereisferreira123@gmail.com>
 * @author Yuri <email@email.com>
 * @author Ana Carolini <email@email.com>
 * @author João <email@email.com>
 * 
 * @requires session
 * 
 */

require_once "conexao.php";
require_once "operacoes.php";

$idFuncionario = $_GET['idFuncionario'];
$tipocliente = $_GET['tipocliente'];


session_start();
$_SESSION['idFuncionario'] = $_GET['idFuncionario'];
$_SESSION['tipocliente'] = $_GET['tipocliente'];
header("location: form_aluguel2.php")

?>