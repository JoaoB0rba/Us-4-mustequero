<?php
    require_once 'conexao.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleção de Veículo</title>
</head>
<body>
    <form action="inserir_aluguel.php" method="post">
        Funcionário: <br>
        <select name="funcionario_aluguel">
            <?php
            $sql_funcionario = "SELECT * FROM tb_funcionario";
            $resultados_funcionario = mysqli_query($conexao, $sql_funcionario);

            if ($resultados_funcionario) {
                if (mysqli_num_rows($resultados_funcionario) > 0) {
                    while ($linha_funcionario = mysqli_fetch_array($resultados_funcionario)) {
                        $idtb_funcionario = $linha_funcionario['idtb_funcionario'];
                        $nome_funcionario = $linha_funcionario['nome_funcionario'];
                        echo "<option value='$idtb_funcionario'>$nome_funcionario</option>";
                    }
                } else {
                    echo "<option value=''>Nenhum funcionário encontrado</option>";
                }
            } else {
                echo "<option value=''>Erro ao consultar funcionários</option>";
            }
            ?>
        </select>
        <br><br>
<!--         Pessoa: <br>
        <select name="pessoa_aluguel">
            ?php
            $sql_pessoa = "SELECT * FROM tb_pessoas";
            $resultados_pessoa = mysqli_query($conexao, $sql_pessoa);

            if ($resultados_pessoa) {
                if (mysqli_num_rows($resultados_pessoa) > 0) {
                    while ($linha_pessoa = mysqli_fetch_array($resultados_pessoa)) {
                        $idpessoas = $linha_pessoa['idpessoas'];
                        $nome_pessoa = $linha_pessoa['nome'];
                        echo "<option value='$idpessoas'>$nome_pessoa</option>";
                    }
                } else {
                    echo "<option value=''>Nenhuma pessoa encontrada</option>";
                }
            } else {
                echo "<option value=''>Erro ao consultar pessoas</option>";
            }
            ?> -->
        </select>
        <br><br>
        Veículo: <br>
        <select name="veiculo_aluguel[]" multiple>
    <?php
    $sql_veiculo = "SELECT * FROM tb_veiculo WHERE alugado_veiculo = 'N'";
    $resultados_veiculo = mysqli_query($conexao, $sql_veiculo);

    if ($resultados_veiculo) {
        if (mysqli_num_rows($resultados_veiculo) > 0) {
            while ($linha_veiculo = mysqli_fetch_array($resultados_veiculo)) {
                $idtb_veiculo = $linha_veiculo['idtb_veiculo'];
                $modelo_veiculo = $linha_veiculo['modelo_veiculo'];
                echo "<option value='$idtb_veiculo'>$modelo_veiculo</option>";
            }
        } else {
            echo "<option value=''>Nenhum veículo disponível para aluguel</option>";
        }
    } else {
        echo "<option value=''>Erro ao consultar veículos</option>";
    }
    ?>
</select>

        <br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
