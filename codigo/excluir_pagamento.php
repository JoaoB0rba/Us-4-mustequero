<?php
require_once 'conexao.php';

// Verifica se o ID do pagamento foi passado na URL
if (isset($_GET['idtb_pagamento'])) {
    $idtb_pagamento = $_GET['idtb_pagamento'];

    // Verifica se há aluguéis associados a este pagamento
    $sql_verificar_alugueis = "
        SELECT 1
        FROM tb_pagamento 
        WHERE idtb_pagamento = $idtb_pagamento
        LIMIT 1";  // Adiciona o LIMIT 1 para parar a consulta ao encontrar um registro

    $result_verificar_alugueis = mysqli_query($conexao, $sql_verificar_alugueis);
    
    if ($result_verificar_alugueis && mysqli_num_rows($result_verificar_alugueis) > 0) {
        // Exibir mensagem informando que há aluguéis associados a este pagamento
        echo "Este pagamento está associado a aluguéis e não pode ser removido.";
    } else {
        // Excluir o pagamento, pois não há registros associados
        $sql_excluir_pagamento = "
            DELETE FROM tb_pagamento 
            WHERE idtb_pagamento = $idtb_pagamento";
        $result_excluir_pagamento = mysqli_query($conexao, $sql_excluir_pagamento);

        if ($result_excluir_pagamento) {
            header("Location: pesquisar_pagamento.php?status=sucesso");
            exit();
        } else {
            echo "Erro ao excluir o pagamento: " . mysqli_error($conexao);
        }
    }
} else {
    echo "ID do pagamento não fornecido.";
}

mysqli_close($conexao);
?>
