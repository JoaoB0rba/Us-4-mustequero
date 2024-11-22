<?php
require_once 'conexao.php';

if (isset($_GET['veiculo_id'])) {
    $veiculo_id = $_GET['veiculo_id'];

    // Verificar se há registros associados a este veículo
    $sql_verificar_locacoes = "SELECT COUNT(*) AS total_locacoes FROM locacoes WHERE veiculo_id = $veiculo_id";
    $result_verificar_locacoes = mysqli_query($conexao, $sql_verificar_locacoes);
    
    if ($result_verificar_locacoes) {
        $linha_verificar_locacoes = mysqli_fetch_assoc($result_verificar_locacoes);
        $total_locacoes = $linha_verificar_locacoes['total_locacoes'];

        if ($total_locacoes > 0) {
            // Se houver locações associadas, exclua primeiro os registros de locações
            $sql_excluir_locacoes = "DELETE FROM locacoes WHERE veiculo_id = $veiculo_id";
            
            if (mysqli_query($conexao, $sql_excluir_locacoes)) {
                // Agora que as locações foram excluídas, exclua o veículo
                $sql_excluir_veiculo = "DELETE FROM veiculos WHERE veiculo_id = $veiculo_id";

                if (mysqli_query($conexao, $sql_excluir_veiculo)) {
                    echo "Veículo excluído com sucesso.";
                } else {
                    echo "Erro ao excluir veículo. Tente novamente.";
                }
            } else {
                echo "Erro ao excluir locações associadas ao veículo. Tente novamente.";
            }
        } else {
            // Se não houver locações associadas, exclua apenas o veículo
            $sql_excluir_veiculo = "DELETE FROM veiculos WHERE veiculo_id = $veiculo_id";

            if (mysqli_query($conexao, $sql_excluir_veiculo)) {
                echo "Veículo excluído com sucesso.";
            } else {
                echo "Erro ao excluir veículo. Tente novamente.";
            }
        }
    } else {
        echo "Erro ao verificar locações associadas ao veículo.";
    }
} else {
    echo "ID do veículo não especificado.";
}

mysqli_close($conexao);
?>
