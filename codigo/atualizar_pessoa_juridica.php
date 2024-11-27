<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter os dados do formulário
    $idpessoa_juridica = $_POST['idpessoa_juridica'];
    $nome = $_POST['nome'];
    $cnpj = $_POST['cnpj'];
    $telefone = $_POST['telefone'];

    // Atualizar os dados da tabela tb_pessoas
    $sql_pessoas = "UPDATE tb_pessoas 
                    SET nome = '$nome', telefone = '$telefone' 
                    WHERE idpessoas = (SELECT tb_pessoas_idpessoas FROM tb_pessoa_juridica WHERE idpessoa_juridica = $idpessoa_juridica)";

    // Atualizar os dados da tabela tb_pessoa_juridica
    $sql_pessoa_juridica = "UPDATE tb_pessoa_juridica 
                            SET cnpj = '$cnpj' 
                            WHERE idpessoa_juridica = $idpessoa_juridica";

    // Executar as consultas de atualização
    if (mysqli_query($conexao, $sql_pessoas) && mysqli_query($conexao, $sql_pessoa_juridica)) {
        header("Location: pesquisar_pessoa_juridica.php?status=sucesso");
    } else {
        echo "Erro ao atualizar os dados. Tente novamente.";
    }
}

mysqli_close($conexao);
?>
