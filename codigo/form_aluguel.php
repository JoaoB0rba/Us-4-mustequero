<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
    <!-- Link para o CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Cadastro de Sessão</h1>
        
        <form action="session.php" method="GET" class="shadow p-4 bg-light rounded">
            <!-- Seleção de Funcionário -->
            <div class="mb-3">
                <label for="idFuncionario" class="form-label">Funcionário:</label>
                <select name="idFuncionario" id="idFuncionario" class="form-select" required>
                    <?php
                    require_once "conexao.php";
                    require_once "operacoes.php";

                    $resultados = listarFuncionario($conexao);

                    foreach ($resultados as $funcionario) {
                        echo "<option value='$funcionario[0]'>$funcionario[1]</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Tipo de Cliente -->
            <div class="mb-3">
                <label class="form-label">Tipo de Cliente:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipocliente" id="pf" value="pf" required>
                    <label class="form-check-label" for="pf">Físico</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipocliente" id="pj" value="pj" required>
                    <label class="form-check-label" for="pj">Jurídico</label>
                </div>
            </div>

            <!-- Botão de Enviar -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>

        <!-- Botão de Voltar -->
        <div class="mt-3 text-center">
            <a href="index.html" class="btn btn-secondary">Voltar</a>
        </div>
    </div>

    <!-- Script do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
