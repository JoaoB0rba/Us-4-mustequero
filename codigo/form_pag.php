<?php
require_once 'conexao.php';

// Verifica se o parâmetro tipo_pessoa foi enviado via GET
$tipo_pessoa = isset($_GET['tipo_pessoa']) ? $_GET['tipo_pessoa'] : '';

// Determina a tabela a ser consultada com base no tipo de pessoa
if ($tipo_pessoa == 'F') {
    // Consulta SQL para pessoa física
    $sql = "SELECT * FROM tb_pessoa_fisica";
} elseif ($tipo_pessoa == 'J') {
    // Consulta SQL para pessoa jurídica
    $sql = "SELECT * FROM tb_pessoa_juridica";
} else {
    echo "Opção inválida.";
    exit(); // Encerra o script se a opção for inválida
}

// Executa a consulta
$result = mysqli_query($conexao, $sql);

if ($result) {
    // Exibe os resultados
    echo "<h2>Resultados:</h2>";
    while ($row = mysqli_fetch_assoc($result)) {
        // Exibe os resultados conforme recuperado da consulta
        echo "<p>ID: " . $row['idpessoa fisica'] . "</p>"; // Ajuste conforme o nome real da coluna de ID
        echo "<p>Nome: " . $row['nome'] . "</p>"; // Verifica se 'nome' é o nome correto da coluna
        if ($tipo_pessoa == 'F') {
            echo "<p>CPF: " . $row['cpf'] . "</p>"; // Exibe CPF para pessoa física
        } elseif ($tipo_pessoa == 'J') {
            echo "<p>CNPJ: " . $row['cnpj'] . "</p>"; // Exibe CNPJ para pessoa jurídica
        }
        echo "<hr>";
    }
} else {
    echo "Erro ao consultar banco de dados: " . mysqli_error($conexao);
}
?>
