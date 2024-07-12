<?php
    require_once 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtém os valores do formulário
        $funcionario_aluguel = $_POST['funcionario_aluguel'];
        $pessoa_aluguel = $_POST['pessoa_aluguel'];
        $veiculo_aluguel = $_POST['veiculo_aluguel'];

        // Constrói a consulta SQL para inserir o aluguel
        $sql = "INSERT INTO tb_aluguel (data_inicial, tb_funcionario_idtb_funcionario, tb_pessoas_idpessoas, tb_veiculo_idtb_veiculo)
                VALUES (NOW(), '$funcionario_aluguel', '$pessoa_aluguel', '$veiculo_aluguel')";

        // Executa a consulta
        mysqli_query($conexao, $sql);

        // Redireciona para a página inicial
        header("location: index.html");
        exit(); // Termina o script após o redirecionamento
    }
?>
