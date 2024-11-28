<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisar Pagamentos</title>
    <link rel="stylesheet" href="estilo/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="container mt-5">

    <form action="pesquisar_pagamento.php" method="get" class="mb-3">
        <div class="input-group">
            <input type="text" name="busca" class="form-control" placeholder="Pesquisar Pagamentos (Tipo ou Preço)">
            <button type="submit" class="btn btn-primary">Pesquisar</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo de Pagamento</th>
                <th>Preço</th>
                <th>Valor por KM</th>
                <th>Aluguel (ID)</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once 'conexao.php';

            // Verificar se o formulário foi submetido
            if (isset($_GET['busca']) && !empty($_GET['busca'])) {
                $busca = $_GET['busca'];
                $sql = "SELECT * FROM tb_pagamento WHERE tipo_pagamento LIKE '%$busca%' OR preco_pagamento LIKE '%$busca%'";
            } else {
                // Se não houver busca, seleciona todos os pagamentos
                $sql = "SELECT * FROM tb_pagamento";
            }

            $resultados = mysqli_query($conexao, $sql);

            if (mysqli_num_rows($resultados) > 0) {
                while ($linha = mysqli_fetch_array($resultados)) {
                    $idtb_pagamento = $linha['idtb_pagamento'];
                    $tipo_pagamento = $linha['tipo_pagamento'];
                    $preco_pagamento = $linha['preco_pagamento'];
                    $valor_valorkm = $linha['valor_valorkm'];
                    $tb_aluguel_idtb_aluguel = $linha['tb_aluguel_idtb_aluguel'];

                    echo "<tr>";
                    echo "<td>$idtb_pagamento</td>";
                    echo "<td>$tipo_pagamento</td>";
                    echo "<td>$preco_pagamento</td>";
                    echo "<td>$valor_valorkm</td>";
                    echo "<td>$tb_aluguel_idtb_aluguel</td>";
                    echo "<td><a href='editar_pagamento.php?idtb_pagamento=$idtb_pagamento' class='btn btn-warning'>Editar</a></td>";
                    echo "<td><a href='excluir_pagamento.php?idtb_pagamento=$idtb_pagamento' class='btn btn-danger'>Excluir</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Nenhum pagamento encontrado.</td></tr>";
            }

            mysqli_close($conexao);
            ?>
        </tbody>
    </table>
    <a href="pdf_pagamento.php" class="btn btn-secondary">Gerar PDF</a>
    <a href="telainicial.html" class="btn btn-secondary">pagina inicial</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
