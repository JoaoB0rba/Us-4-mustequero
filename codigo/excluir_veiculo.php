<?php
require_once 'conexao.php';

if (isset($_GET['idtb_veiculo'])) {
    $idtb_veiculo = $_GET['idtb_veiculo'];

    // Verificar se há registros associados a este veículo na tabela `tb_aluguel_has_tb_veiculo`
    $sql_verificar_alugueis = "
        SELECT COUNT(*) AS total_alugueis 
        FROM tb_aluguel_has_tb_veiculo 
        WHERE tb_veiculo_idtb_veiculo = $idtb_veiculo";
    $result_verificar_alugueis = mysqli_query($conexao, $sql_verificar_alugueis);
    
    if ($result_verificar_alugueis) {
        $linha_verificar_alugueis = mysqli_fetch_assoc($result_verificar_alugueis);
        $total_alugueis = $linha_verificar_alugueis['total_alugueis'];

        if ($total_alugueis > 0) {
            // Excluir os registros relacionados na tabela `tb_aluguel_has_tb_veiculo`
            $sql_excluir_relacao = "
                DELETE FROM tb_aluguel_has_tb_veiculo 
                WHERE tb_veiculo_idtb_veiculo = $idtb_veiculo";

            if (mysqli_query($conexao, $sql_excluir_relacao)) {
                // Após excluir os registros relacionados, excluir o veículo
                $sql_excluir_veiculo = "
                    DELETE FROM tb_veiculo 
                    WHERE idtb_veiculo = $idtb_veiculo";

                if (mysqli_query($conexao, $sql_excluir_veiculo)) {
                    header("Location: pesquisar_veiculo.php?status=sucesso");
                    echo "Veículo e registros associados excluídos com sucesso.";
                } else {
                    echo "Erro ao excluir o veículo. Tente novamente.";
                }
            } else {
                echo "Erro ao excluir registros associados ao veículo. Tente novamente.";
            }
        } else {
            // Se não houver registros associados, excluir apenas o veículo
            $sql_excluir_veiculo = "
                DELETE FROM tb_veiculo 
                WHERE idtb_veiculo = $idtb_veiculo";

            if (mysqli_query($conexao, $sql_excluir_veiculo)) {
                header("Location: pesquisar_veiculo.php?status=sucesso");
                echo "Veículo excluído com sucesso.";
            } else {
                echo "Erro ao excluir o veículo. Tente novamente.";
            }
        }
    } else {
        echo "Erro ao verificar registros associados ao veículo.";
    }
} else {
    echo "ID do veículo não especificado.";
}


mysqli_close($conexao);
?>
