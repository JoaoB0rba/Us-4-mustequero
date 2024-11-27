<?php
    session_start();

    require_once 'conexao.php';
    require_once "operacoes.php";


    // && é usado para verificar se duas condições são verdadeiras ao mesmo tempo. Se ambas forem verdadeiras, o resultado é true
    if (isset($_POST['nome_funcionario']) && isset($_POST['senhaa'])) {
        $nome_funcionario = $_POST['nome_funcionario'];
        $senhaa = $_POST['senhaa'];

        Login($conexao, $nome_funcionario, $senhaa);
        $resultados = mysqli_query($conexao, $sql);

        if (mysqli_num_rows($resultados) > 0) {
            $_SESSION['funcionario_autenticado'] = true;

            header('Location: telainicial.html');
            exit();
        } else {
            header('Location: telainicial.html');
            exit();
        }
    } 
?>