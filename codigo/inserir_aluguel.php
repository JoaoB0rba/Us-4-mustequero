<?php
require_once "conexao.php"; // Inclui a conexão ao banco de dados
require_once "operacoes.php"; // Inclui outras funções se necessário

$idFuncionario = $_GET['idFuncionario'];
$tipocliente = $_GET['tipocliente'];
$cliente = $_GET['cliente'];
// Array dos IDs dos carros:
$carros = $_POST['carros'];

// Insere cada carro alugado na tabela de aluguéis
foreach ($carros as $idCarro) {
    // Prepara a consulta SQL para inserir os dados
    $sql = "INSERT INTO tb_aluguel (id_funcionario, tipo_cliente, id_cliente, id_veiculo) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    
    // Verifica se a preparação da consulta foi bem-sucedida
    if ($stmt) {
        // Faz o binding das variáveis
        mysqli_stmt_bind_param($stmt, 'isii', $idFuncionario, $tipocliente, $cliente, $idCarro);
        
        // Executa a consulta
        if (!mysqli_stmt_execute($stmt)) {
            echo "Erro ao inserir o aluguel: " . mysqli_error($conexao);
        }
        
        // Fecha a declaração
        mysqli_stmt_close($stmt);
    } else {
        echo "Erro ao preparar a consulta: " . mysqli_error($conexao);
    }
}

// Redireciona ou exibe uma mensagem de sucesso
echo "Aluguel realizado com sucesso!";
?>
