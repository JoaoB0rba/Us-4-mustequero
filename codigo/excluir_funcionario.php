<?php
require_once 'conexao.php';

if (isset($_GET['idtb_funcionario'])) {
    $idtb_funcionario = $_GET['idtb_funcionario'];

    // Verificar se há registros associados a este funcionário na tabela `tb_aluguel`
    $sql_verificar_alugueis = "
        SELECT COUNT(*) AS total_alugueis 
        FROM tb_aluguel 
        WHERE tb_funcionario_idtb_funcionario = $idtb_funcionario";
    $result_verificar_alugueis = mysqli_query($conexao, $sql_verificar_alugueis);
    
    if ($result_verificar_alugueis) {
        $linha_verificar_alugueis = mysqli_fetch_assoc($result_verificar_alugueis);
        $total_alugueis = $linha_verificar_alugueis['total_alugueis'];

        if ($total_alugueis > 0) {
            // Exibir mensagem informando que há aluguéis associados a este funcionário
            echo "Este funcionário está associado a $total_alugueis aluguel(is) e não pode ser removido.";
        } else {
            // Excluir o funcionário, pois não há registros associados
            $sql_excluir_funcionario = "
                DELETE FROM tb_funcionario 
                WHERE idtb_funcionario = $idtb_funcionario";
            $result_excluir_funcionario = mysqli_query($conexao, $sql_excluir_funcionario);

            if ($result_excluir_funcionario) {
                header("Location: pesquisar_vendedor.php?status=sucesso");
                echo "Funcionário excluído com sucesso.";
            } else {
                echo "Erro ao excluir o funcionário: " . mysqli_error($conexao);
            }
        }
    } else {
        echo "Erro ao verificar registros associados: " . mysqli_error($conexao);
    }
} else {
    echo "ID do funcionário não fornecido.";
}
