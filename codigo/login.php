<?php
/**
 * Autentica o funcionário baseado no nome e senha fornecidos via POST e redireciona para a página inicial.
 * 
 * @requires session
 * @requires conexao.php
 * 
 */

session_start();

require_once 'conexao.php';

// Verifica se os campos nome_funcionario e senhaa foram enviados via POST
if (isset($_POST['nome_funcionario']) && isset($_POST['senhaa'])) {
    $login = $_POST['nome_funcionario'];
    $senhaa = $_POST['senhaa'];

    // Prepara a consulta para verificar as credenciais do funcionário
    $sql = "SELECT * FROM tb_funcionario WHERE nome_funcionario = '$login' AND senhaa = '$senhaa'";
    $resultados = mysqli_query($conexao, $sql);

    // Verifica se há algum resultado da consulta
    if (mysqli_num_rows($resultados) > 0) {
        $_SESSION['funcionario_autenticado'] = true;

        // Redireciona para a página inicial se a autenticação for bem-sucedida
        header('Location: telainicial.html');
        exit();
    } else {
        // Redireciona para a página inicial se a autenticação falhar
        header('Location: telainicial.html');
        exit();
    }
} 
?>