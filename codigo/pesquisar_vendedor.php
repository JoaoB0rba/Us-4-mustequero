<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisar Funcionários</title>
    <link rel="stylesheet" href="estilo/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="container mt-5">

    <form action="pesquisar_vendedor.php" method="get" class="mb-3">
        <div class="input-group">
            <input type="text" name="busca" class="form-control" placeholder="Pesquisar Funcionários">
            <button type="submit" class="btn btn-primary">Pesquisar</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once 'conexao.php';

            // Verificar se o formulário foi submetido
            if (isset($_GET['busca'])) {
                $busca = $_GET['busca'];
                $sql = "SELECT * FROM tb_funcionario WHERE nome_funcionario LIKE '%$busca%' OR cpf_funcionario LIKE '%$busca%'";
            } else {
                // Se não houver busca, seleciona todos os funcionários
                $sql = "SELECT * FROM tb_funcionario";
            }

            $resultados = mysqli_query($conexao, $sql);

            if (mysqli_num_rows($resultados) > 0) {
                while ($linha = mysqli_fetch_array($resultados)) {
                    $idtb_funcionario = $linha['idtb_funcionario'];
                    $nome_funcionario = $linha['nome_funcionario'];
                    $cpf_funcionario = $linha['cpf_funcionario'];
                    $telefone_funcionario = $linha['telefone_funcionario'];

                    echo "<tr>";
                    echo "<td>$idtb_funcionario</td>";
                    echo "<td>$nome_funcionario</td>";
                    echo "<td>$cpf_funcionario</td>";
                    echo "<td>$telefone_funcionario</td>";
                    echo "<td><a href='editar_funcionario.php?idtb_funcionario=$idtb_funcionario' class='btn btn-warning'>Editar</a></td>";
                    echo "<td><a href='excluir_funcionario.php?idtb_funcionario=$idtb_funcionario' class='btn btn-danger'>Excluir</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Nenhum funcionário encontrado.</td></tr>";
            }

            mysqli_close($conexao);
            ?>
        </tbody>
    </table>
    <a href="pdf_funcionario.php" class="btn btn-secondary">Gerar PDF</a>
    <a href="telainicial.html" class="btn btn-secondary">Pagina Inicial</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
