<?php

require_once "conexao.php";
require_once "operacoes.php";

$tipocliente = $_GET['tipocliente'];

session_start();
$_SESSION['tipocliente'] = $_GET['tipocliente'];
header("location: form_pag2.php")

?>