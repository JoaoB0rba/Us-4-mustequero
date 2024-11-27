<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter os dados do formulário
    $idpessoa_fisica = $_POST['idpessoa_fisica'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $cnh = $_POST['cnh'];

    // Atualizar os dados da tabela tb_pessoas
    $sql_pessoas = "UPDATE tb_pessoas 
                    SET nome = '$nome', telefone = '$telefone' 
                    WHERE idpessoas = (SELECT tb_pessoas_idpessoas FROM tb_pessoa_fisica WHERE idpessoa_fisica = $idpessoa_fisica)";

    // Atualizar os dados da tabela tb_pessoa_fisica
    $sql_pessoa_fisica = "UPDATE tb_pessoa_fisica 
                          SET cpf = '$cpf', cnh = '$cnh' 
                          WHERE idpessoa_fisica = $idpessoa_fisica";

    // Executar as consultas de atualização
    if (mysqli_query($conexao, $sql_pessoas) && mysqli_query($conexao, $sql_pessoa_fisica)) {
        header("Location: pesquisar_vendedor.php?status=sucesso");
}
}

mysqli_close($conexao);
?>
