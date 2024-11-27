<?php
require_once 'conexao.php';

$idpessoa_fisica = $_GET['idpessoa_fisica']; // Obtém o ID da pessoa física para exclusão

// Verificar se existe algum registro de aluguel associado à pessoa física
$sql_check = "SELECT 1 FROM tb_aluguel WHERE tb_pessoas_idpessoas = ? LIMIT 1"; // Corrigido para usar a coluna correta

$stmt_check = mysqli_prepare($conexao, $sql_check);
mysqli_stmt_bind_param($stmt_check, 'i', $idpessoa_fisica);
mysqli_stmt_execute($stmt_check);
mysqli_stmt_store_result($stmt_check);

// Se o resultado da consulta for encontrado, o valor de num_rows será > 0
if (mysqli_stmt_num_rows($stmt_check) > 0) {
    // Caso haja algum aluguel associado à pessoa física, não permite exclusão
    echo "<script>alert('A pessoa física está associada a um aluguel e não pode ser excluída.');</script>";
    echo "<script>window.location = 'listar_pessoa_fisica.php';</script>";
} else {
    // Caso contrário, pode proceder com a exclusão
    // Excluir da tb_pessoa_fisica
    $sql = "DELETE FROM tb_pessoa_fisica WHERE idpessoa_fisica = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idpessoa_fisica);
    mysqli_stmt_execute($stmt);
    
    // Excluir da tb_pessoas
    $sql_pessoas = "DELETE FROM tb_pessoas WHERE idpessoas = (SELECT tb_pessoas_idpessoas FROM tb_pessoa_fisica WHERE idpessoa_fisica = ?)";
    $stmt_pessoas = mysqli_prepare($conexao, $sql_pessoas);
    mysqli_stmt_bind_param($stmt_pessoas, 'i', $idpessoa_fisica);
    mysqli_stmt_execute($stmt_pessoas);
    
    // Mensagem de sucesso
    header('Location: telainicial.html');

}

mysqli_stmt_close($stmt_check);
mysqli_stmt_close($stmt);
mysqli_stmt_close($stmt_pessoas);
mysqli_close($conexao);
?>
