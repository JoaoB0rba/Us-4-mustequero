<?php
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber os dados do formulário
    $idtb_funcionario = $_POST['idtb_funcionario'];
    $nome_funcionario = $_POST['nome_funcionario'];
    $cpf_funcionario = $_POST['cpf_funcionario'];
    $telefone_funcionario = $_POST['telefone_funcionario'];
    $senhaa = $_POST['senhaa']; // Senha (caso queira atualizar)

    // Atualizar no banco de dados
    $sql = "UPDATE tb_funcionario 
            SET nome_funcionario='$nome_funcionario', 
                cpf_funcionario='$cpf_funcionario', 
                telefone_funcionario='$telefone_funcionario',
                senhaa='$senhaa'
            WHERE idtb_funcionario='$idtb_funcionario'";

    if (mysqli_query($conexao, $sql)) {
        // header("Location: listar_funcionarios.php"); // Redireciona após sucesso (caso tenha uma página de listagem de funcionários)
        echo "Funcionário atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar funcionário. Tente novamente.";
    }
} else {
    echo "Método inválido de requisição.";
}

mysqli_close($conexao);
?>
