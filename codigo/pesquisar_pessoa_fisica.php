<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisar Pessoas Físicas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="container mt-5">

    <!-- Formulário de Busca -->
    <form action="pesquisar_pessoa_fisica.php" method="get" class="mb-4">
        <div class="input-group">
            <input type="text" name="busca" class="form-control" placeholder="Pesquisar Pessoas Físicas">
            <button type="submit" class="btn btn-primary">Pesquisar</button>
        </div>
    </form>

    <!-- Tabela Responsiva -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>CNH</th>
                    <th>Telefone</th>
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'conexao.php';

                if (isset($_GET['busca'])) {
                    $busca = $_GET['busca'];
                    $sql = "SELECT idpessoa_fisica, nome, cpf, cnh, telefone FROM tb_pessoa_fisica JOIN tb_pessoas ON tb_pessoas_idpessoas = idpessoas WHERE nome LIKE '%$busca%' OR cpf LIKE '%$busca%'";
                } else {
                    $sql = "SELECT idpessoa_fisica, nome, cpf, cnh, telefone FROM tb_pessoa_fisica JOIN tb_pessoas ON tb_pessoas_idpessoas = idpessoas";
                }

                $resultados = mysqli_query($conexao, $sql);

                if (mysqli_num_rows($resultados) > 0) {
                    while ($linha = mysqli_fetch_array($resultados)) {
                        $idpessoa_fisica = $linha['idpessoa_fisica'];
                        $nome = $linha['nome'];
                        $cpf = $linha['cpf'];
                        $cnh = $linha['cnh'];
                        $telefone = $linha['telefone'];

                        echo "<tr>";
                        echo "<td>$idpessoa_fisica</td>";
                        echo "<td>$nome</td>";
                        echo "<td>$cpf</td>";
                        echo "<td>$cnh</td>";
                        echo "<td>$telefone</td>";
                        echo "<td><a href='editar_pessoa_fisica.php?idpessoa_fisica=$idpessoa_fisica' class='btn btn-warning btn-sm'>Editar</a></td>";
                        echo "<td><a href='excluir_pessoa_fisica.php?idpessoa_fisica=$idpessoa_fisica' class='btn btn-danger btn-sm'>Excluir</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>Nenhuma pessoa física encontrada.</td></tr>";
                }

                mysqli_close($conexao);
                ?>
            </tbody>
        </table>
    </div>

    <!-- Botões de Ações -->
    <div class="d-flex justify-content-between mt-4">
        <a href="pdf_pessoafi.php" class="btn btn-secondary">Gerar PDF</a>
        
        <a href="telainicial.html" class="btn btn-secondary">pagina inicial</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
