<?php
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pegando os valores do formulário
    $idtb_aluguel = $_POST['idtb_aluguel'];
    $data_inicial = $_POST['data_inicial'];
    $tb_funcionario_idtb_funcionario = $_POST['tb_funcionario_idtb_funcionario'];
    $tb_pessoas_idpessoas = $_POST['tb_pessoas_idpessoas'];

    // Atualizar os dados do aluguel na tabela tb_aluguel
    $sql = "UPDATE tb_aluguel SET data_inicial='$data_inicial', 
                                  tb_funcionario_idtb_funcionario='$tb_funcionario_idtb_funcionario', 
                                  tb_pessoas_idpessoas='$tb_pessoas_idpessoas' 
            WHERE idtb_aluguel='$idtb_aluguel'";

    // Executar a atualização
    if (mysqli_query($conexao, $sql)) {
        header("Location: pesquisar_aluguel.php?status=sucesso");
    } else {
        echo "Erro ao atualizar Aluguel. Tente novamente.";
    }
} else {
    echo "Método inválido de requisição.";
}

// Fechar a conexão
mysqli_close($conexao);
?>
