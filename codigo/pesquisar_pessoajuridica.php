<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisar Pessoa Jurídica</title>
    <link rel="stylesheet" href="estilo/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="container mt-5">

    <form action="pesquisar_pessoa_juridica.php" method="get" class="mb-3">
        <div class="input-group">
            <input type="text" name="busca" class="form-control" placeholder="Pesquisar Pessoa Jurídica">
            <button type="submit" class="btn btn-primary">Pesquisar</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CNPJ</th>
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
                $sql = "SELECT idpessoa juridica, nome, cnpj, telefone FROM tb_pessoa_juridica JOIN tb_pessoas ON tb_pessoas_idpessoas = idpessoas WHERE nome LIKE '%$busca%' OR cnpj LIKE '%$busca%'";
            } else {
                // Se não houver busca, seleciona todas as pessoas jurídicas
                $sql = "SELECT idpessoa juridica, nome, cnpj, telefone FROM tb_pessoa_juridica
                    JOIN tb_pessoas ON tb_pessoas_idpessoas = idpessoas";
            }

            $resultados = mysqli_query($conexao, $sql);

            if (mysqli_num_rows($resultados) > 0) {
                while ($linha = mysqli_fetch_array($resultados)) {
                    $idpessoa_juridica = $linha['idpessoa_juridica'];
                    $nome = $linha['nome'];
                    $cnpj = $linha['cnpj'];
                    $telefone = $linha['telefone'];

                    echo "<tr>";
                    echo "<td>$idpessoa_juridica</td>";
                    echo "<td>$nome</td>";
                    echo "<td>$cnpj</td>";
                    echo "<td>$telefone</td>";
                    echo "<td><a href='editar_pessoa_juridica.php?idpessoa_juridica=$idpessoa_juridica' class='btn btn-warning'>Editar</a></td>";
                    echo "<td><a href='excluir_pessoa_juridica.php?idpessoa_juridica=$idpessoa_juridica' class='btn btn-danger'>Excluir</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Nenhuma pessoa jurídica encontrada.</td></tr>";
            }

            mysqli_close($conexao);
            ?>
        </tbody>
    </table>
    <a href="pdf_pessoa_juridica.php" class="btn btn-secondary">Gerar PDF</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
