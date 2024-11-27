<?php
require_once 'conexao.php';

if (isset($_GET['idpessoa_juridica'])) {
    $idpessoa_juridica = $_GET['idpessoa_juridica'];

    // Verificar se há registros associados a esta pessoa jurídica
    $sql_verificar_associados = "
        SELECT COUNT(*) AS total_associados 
        FROM tb_pessoa_juridica 
        WHERE idpessoa_juridica = $idpessoa_juridica";
    $result_verificar_associados = mysqli_query($conexao, $sql_verificar_associados);

    if ($result_verificar_associados) {
        $linha_verificar_associados = mysqli_fetch_assoc($result_verificar_associados);
        $total_associados = $linha_verificar_associados['total_associados'];

        if ($total_associados > 0) {
            // Excluir os registros relacionados na tabela `tb_pessoa_juridica`
            $sql_excluir_relacao = "
                DELETE FROM tb_pessoa_juridica 
                WHERE idpessoa_juridica = $idpessoa_juridica";

            if (mysqli_query($conexao, $sql_excluir_relacao)) {
                // Após excluir os registros relacionados, excluir o registro da tabela `tb_pessoas`
                $sql_excluir_pessoa = "
                    DELETE FROM tb_pessoas 
                    WHERE idpessoas = (SELECT tb_pessoas_idpessoas FROM tb_pessoa_juridica WHERE idpessoa_juridica = $idpessoa_juridica)";

                if (mysqli_query($conexao, $sql_excluir_pessoa)) {
                    header("Location: pesquisar_pessoa_juridica.php?status=sucesso");
                    exit();
                } else {
                    echo "<script>alert('Erro ao excluir a pessoa jurídica. Tente novamente.');</script>";
                }
            } else {
                echo "<script>alert('Erro ao excluir registros associados à pessoa jurídica. Tente novamente.');</script>";
            }
        } else {
            // Se não houver registros associados, excluir apenas a pessoa jurídica
            $sql_excluir_pessoa_juridica = "
                DELETE FROM tb_pessoa_juridica 
                WHERE idpessoa_juridica = $idpessoa_juridica";

            if (mysqli_query($conexao, $sql_excluir_pessoa_juridica)) {
                header("Location: pesquisar_pessoa_juridica.php?status=sucesso");
                exit();
            } else {
                echo "<script>alert('Erro ao excluir a pessoa jurídica. Tente novamente.');</script>";
            }
        }
    } else {
        echo "<script>alert('Erro ao verificar registros associados à pessoa jurídica.');</script>";
    }
} else {
    echo "<script>alert('ID da pessoa jurídica não especificado.');</script>";
}

mysqli_close($conexao);
?>
