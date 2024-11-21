<?php
    session_start();

    require_once 'conexao.php';

    // && é usado para verificar se duas condições são verdadeiras ao mesmo tempo. Se ambas forem verdadeiras, o resultado é true
    if (isset($_POST['nome_funcionario']) && isset($_POST['senhaa'])) {
        $login = $_POST['nome_funcionario'];
        $senhaa = $_POST['senhaa'];

        $sql = "SELECT * FROM tb_funcionario WHERE nome_funcionario = '$login' AND senhaa = '$senhaa'";
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
