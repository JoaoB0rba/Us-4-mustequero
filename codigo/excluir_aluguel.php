<?php
require_once 'conexao.php';

if (isset($_GET['idtb_aluguel'])) {
    $idtb_aluguel = $_GET['idtb_aluguel'];

    // 1. Excluir os registros relacionados na tabela `tb_aluguel_has_tb_veiculo`
    $sql_excluir_relacao_veiculo = "
        DELETE FROM tb_aluguel_has_tb_veiculo 
        WHERE tb_aluguel_idtb_aluguel = $idtb_aluguel";

    if (mysqli_query($conexao, $sql_excluir_relacao_veiculo)) {
        // 2. Agora, excluir o aluguel da tabela `tb_aluguel`
        $sql_excluir_aluguel = "
            DELETE FROM tb_aluguel 
            WHERE idtb_aluguel = $idtb_aluguel";

        if (mysqli_query($conexao, $sql_excluir_aluguel)) {
            header("Location: pesquisar_aluguel.php?status=sucesso");
            echo "Aluguel e registros associados excluídos com sucesso.";
        } else {
            echo "Erro ao excluir o aluguel. Tente novamente.";
        }
    } else {
        echo "Erro ao excluir os registros associados ao aluguel. Tente novamente.";
    }
} else {
    echo "ID do aluguel não especificado.";
}

mysqli_close($conexao);
?>
