<?php
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Verificar se todos os dados necessários foram enviados via GET
    if (isset($_GET['id_pessoas'], $_GET['nome'], $_GET['cpf'], $_GET['telefone'], $_GET['senha'])) {
        // Receber os dados do formulário via GET
        $id_pessoas = $_GET['id_pessoas'];
        $nome = $_GET['nome'];
        $cpf = $_GET['cpf'];
        $telefone = $_GET['telefone'];
        $senha = $_GET['senha']; // Senha (caso queira atualizar)

        // Atualizar no banco de dados
        $sql = "UPDATE pessoa_fisica 
                SET nome='$nome', 
                    cpf='$cpf', 
                    telefone='$telefone',
                    senha='$senha'
                WHERE id_pessoa='$id_pessoa'";

        if (mysqli_query($conexao, $sql)) {
            // header("Location: listar_pessoas.php"); // Redireciona após sucesso (caso tenha uma página de listagem de pessoas físicas)
            header("Location: pesquisar_pessoa.php?status=sucesso");
            echo "Pessoa física atualizada com sucesso.";
        } else {
            echo "Erro ao atualizar pessoa física. Tente novamente.";
        }
    } else {
        echo "Dados do formulário incompletos.";
    }
} else {
    echo "Método inválido de requisição.";
}

mysqli_close($conexao);
?>
