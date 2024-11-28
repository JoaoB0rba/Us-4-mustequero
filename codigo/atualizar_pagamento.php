<?php
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber os dados do formulário
    $idtb_pagamento = $_POST['idtb_pagamento'];
    $tipo_pagamento = $_POST['tipo_pagamento'];
    $preco_pagamento = $_POST['preco_pagamento'];
    $valor_valorkm = $_POST['valor_valorkm'];
    $tb_aluguel_idtb_aluguel = $_POST['tb_aluguel_idtb_aluguel'];

    // Validar os dados recebidos
    if (empty($idtb_pagamento) || empty($tipo_pagamento) || empty($preco_pagamento) || empty($valor_valorkm)) {
        die("Todos os campos são obrigatórios.");
    }

    // Usar prepared statements para evitar injeção de SQL
    $sql = "UPDATE tb_pagamento 
            SET tipo_pagamento = ?, 
                preco_pagamento = ?, 
                valor_valorkm = ?,
                tb_aluguel_idtb_aluguel = ?
            WHERE idtb_pagamento = ?";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ssddi", $tipo_pagamento, $preco_pagamento, $valor_valorkm, $tb_aluguel_idtb_aluguel, $idtb_pagamento);

    if (mysqli_stmt_execute($stmt)) {
        // Redireciona após sucesso
        header("Location: telainicial.html");
        exit(); // Finaliza o script após o redirecionamento
    } else {
        echo "Erro ao atualizar o pagamento: " . mysqli_error($conexao);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conexao);
?>
