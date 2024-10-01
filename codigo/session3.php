<?php
session_start();
$_SESSION['carros'] = $_REQUEST['carros'];
header("location: form_aluguel4.php")
?>