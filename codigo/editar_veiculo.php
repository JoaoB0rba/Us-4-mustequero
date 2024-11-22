<?php
require_once 'conexao.php';

if (isset($_GET['veiculo_id'])) {
    $veiculo_id = $_GET['veiculo_id'];
    $sql = "SELECT * FROM veiculos WHERE veiculo_id = $veiculo_id";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) == 1) {
        $linha = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Veículo</title>
    <link rel="stylesheet" href="estilo/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h2>Editar Veículo</h2>

        <form action="atualizar_veiculo.php" method="post">
            <input type="hidden" name="veiculo_id" value="<?= $veiculo_id ?>">
            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" name="modelo" class="form-control" value="<?= $linha['modelo'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" name="marca" class="form-control" value="<?= $linha['marca'] ?>" required>
            </div>
            <div class="row g-2">
                <div class="col-md">
                    <label for="ano" class="form-label">Ano</label>
                    <input type="number" name="ano" class="form-control" value="<?= $linha['ano'] ?>" required>
                </div>
                <div class="col-md">
                    <label for="preco" class="form-label">Preço</label>
                    <input type="text" name="preco" class="form-control" value="<?= $linha['preco'] ?>" required>
                </div>
                <div class="col-md">
                    <label for="quantidade_disponivel" class="form-label">Quantidade disponível</label>
                    <input type="text" name="quantidade_disponivel" class="form-control" value="<?= $linha['quantidade_disponivel'] ?>" required>
                </div>
            </div>
            <button type="submit" class="btn btn-danger">Atualizar</button>
        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>

<?php
    } else {
        echo "Veículo não encontrado.";
    }
} else {
    echo "ID do veículo não especificado.";
}
mysqli_close($conexao);
?>
