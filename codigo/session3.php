<?php
session_start();
$_SESSION['carros'] = $_REQUEST['carros'];
header("location: inserir_aluguel.php")
?>