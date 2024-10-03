<?php
require_once "conexao.php";
require_once "operacoes.php";

session_start();

    $idaluguel = $_POST['idaluguel'];
    $precokm = $_POST['precokm'];
    $tipopag = $_POST['tipopag'];
    $kmfinais = $_POST['kmfinal'];


