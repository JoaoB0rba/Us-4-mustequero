<?php
session_start();

require_once 'conexao.php';
require_once "operacoes.php";

if (isset($_POST['nome_funcionario']) && isset($_POST['senhaa'])) {
    $nome_funcionario = $_POST['nome_funcionario'];
    $senhaa = $_POST['senhaa'];
    

    if (Login($conexao, $nome_funcionario, $senhaa)) {
        $_SESSION['funcionario_autenticado'] = true;
        header('Location: telainicial.html'); // Login bem-sucedido
        exit();
    } else {
        $_SESSION['funcionario_autenticado'] = false;
        header('Location: erro_login.html'); // Falha na autenticação
        exit();
    }
} else {
    header('Location: login.html'); // Se campos não foram enviados
    exit();
}
?>
