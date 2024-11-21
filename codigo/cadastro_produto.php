<?php
    require_once 'conexao.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produtos</title>
    <!-- Link para o CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Cadastrar Produtos</h1>
        
        <form action="cadastros.php" class="shadow p-4 rounded bg-light">
            <!-- Nome do Produto -->
            <div class="mb-3">
                <label for="nome_produto" class="form-label">Nome do Produto:</label>
                <input type="text" class="form-control" name="nome_produto" id="nome_produto" required>
            </div>
            
            <!-- Categoria do Produto -->
            <div class="mb-3">
                <label for="id_categoria" class="form-label">Categoria do Produto:</label>
                <select name="id_categoria" id="id_categoria" class="form-select" required>
                    <?php
                        $sql = "SELECT * FROM tb_categoria";
                        $resultados = mysqli_query($conexao, $sql);

                        if (mysqli_num_rows($resultados) > 0){
                            while ($linha = mysqli_fetch_array($resultados)){
                                $id_categoria = $linha['id_categoria'];
                                $nome_categoria = $linha['nome_categ'];
                                echo "<option value='$id_categoria'>$nome_categoria</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            
            <!-- Botão de Enviar -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
        
        <!-- Botão de Voltar -->
        <div class="mt-4 text-center">
            <a href="index.php" class="btn btn-secondary">Tela Inicial</a>
        </div>
    </div>
    
    <!-- Script do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
