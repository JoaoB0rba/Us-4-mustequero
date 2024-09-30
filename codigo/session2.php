<?php
session_start();
$_SESSION['cliente'] = $_GET['cliente'];
header("location: form_aluguel3.php")
?>