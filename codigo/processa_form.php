<?php
// Verifica se o parâmetro tipo_pessoa foi enviado via GET
$tipo_pessoa = $_GET['tipo_pessoa'] ?? '';

// Redireciona para a página correspondente com base no tipo de pessoa selecionado
if ($tipo_pessoa == 'F') {
    header("Location: consulta_pessoa_fisica.php");
    exit(); // Encerra o script após redirecionamento
} elseif ($tipo_pessoa == 'J') {
    header("Location: consulta_pessoa_juridica.php");
    exit(); // Encerra o script após redirecionamento
} else {
    echo "Opção inválida.";
    exit(); // Encerra o script se a opção for inválida
}
?>
