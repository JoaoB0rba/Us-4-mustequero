<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisar Aluguel</title>
    <link rel="stylesheet" href="estilo/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="container mt-5">

    <form action="pesquisar_aluguel.php" method="get" class="mb-3">
        <div class="input-group">
            <input type="text" name="busca" class="form-control" placeholder="Pesquisar Aluguel" value="<?php echo isset($_GET['busca']) ? $_GET['busca'] : ''; ?>">
            <button type="submit" class="btn btn-primary">Pesquisar</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Data Inicial</th>
                <th>ID Funcionário</th>
                <th>ID Cliente</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once 'conexao.php';

            // Verificar se o formulário foi submetido
            if (isset($_GET['busca']) && !empty($_GET['busca'])) {
                $busca = "%" . $_GET['busca'] . "%";
                // Ajuste a consulta para buscar os aluguéis com base na data ou IDs
                $sql = "SELECT * FROM tb_aluguel WHERE data_inicial LIKE ? OR tb_funcionario_idtb_funcionario LIKE ? OR tb_pessoas_idpessoas LIKE ?";

                // Preparar a consulta
                if ($stmt = mysqli_prepare($conexao, $sql)) {
                    // Vincular os parâmetros
                    mysqli_stmt_bind_param($stmt, "sss", $busca, $busca, $busca);

                    // Executar a consulta
                    mysqli_stmt_execute($stmt);

                    // Obter o resultado
                    $resultados = mysqli_stmt_get_result($stmt);
                }
            } else {
                // Se não houver busca, seleciona todos os alugueis
                $sql = "SELECT * FROM tb_aluguel";
                $resultados = mysqli_query($conexao, $sql);
            }

            if (mysqli_num_rows($resultados) > 0) {
                while ($linha = mysqli_fetch_array($resultados)) {
                    $idtb_aluguel = $linha['idtb_aluguel'];
                    $data_inicial = $linha['data_inicial'];
                    $tb_funcionario_idtb_funcionario = $linha['tb_funcionario_idtb_funcionario'];
                    $tb_pessoas_idpessoas = $linha['tb_pessoas_idpessoas'];

                    echo "<tr>";
                    echo "<td>$idtb_aluguel</td>";
                    echo "<td>$data_inicial</td>";
                    echo "<td>$tb_funcionario_idtb_funcionario</td>";
                    echo "<td>$tb_pessoas_idpessoas</td>";
                    echo "<td><a href='editar_aluguel.php?idtb_aluguel=$idtb_aluguel' class='btn btn-warning'>Editar</a></td>";
                    echo "<td><a href='excluir_aluguel.php?idtb_aluguel=$idtb_aluguel' class='btn btn-danger'>Excluir</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Nenhum aluguel encontrado.</td></tr>";
            }

            // Fechar a conexão
            mysqli_close($conexao);
            ?>
        </tbody>
    </table>

    <a href="telainicial.html" class="btn btn-secondary">Página Inicial</a>
    <a href="pdf_aluguel.php" class="btn btn-secondary">PDF</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
