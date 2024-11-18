
<?php
    require_once 'conexao.php';
    $login = $_POST['nome_funcionario'];
    $senhaa = $_POST['cpf_funcionario'];

    $sql = "SELECT * FROM usuario WHERE tb_funcionario = '$login' AND $senhaa";
    $resultados = mysqli_query($conexao, $sql);
    
    session_start();

    // Verifica se o usuário está autenticado
    if (!isset($_SESSION['funcionario_autenticado'])) {
        // Redireciona para a página de login caso o usuário não esteja autenticado
        header('Location: index.html');
        exit();
    }
            header('Location: telainicial.html');
            exit();

?>