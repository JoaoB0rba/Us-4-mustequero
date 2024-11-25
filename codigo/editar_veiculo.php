<?php
require_once 'conexao.php';

if (isset($_GET['idtb_veiculo'])) {
    $idtb_veiculo = $_GET['idtb_veiculo'];
    $sql = "SELECT * FROM tb_veiculo WHERE idtb_veiculo = $idtb_veiculo";
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

        <form action="atualizar_veiculo.php" method="Post">
            <input type="hidden" name="idtb_veiculo" value="<?= $idtb_veiculo ?>">
            <div class="mb-3">
                <label for="marca_veiculo" class="form-label">marca</label>
                <input type="text" name="marca_veiculo" class="form-control" value="<?= $linha['marca_veiculo'] ?>" required>
            </div>
            <div class="row g-2">
                <div class="col-md">
                    <label for="placa_veiculo" class="form-label">placa</label>
                    <input type="text" name="placa_veiculo" class="form-control" value="<?= $linha['placa_veiculo'] ?>" required>
                </div>
            <div class="mb-3">
                <label for="modelo_veiculo" class="form-label">modelo </label>
                <input type="text" name="modelo_veiculo" class="form-control" value="<?= $linha['modelo_veiculo'] ?>" required>
            </div>
                <div class="col-md">
                    <label for="numero_chaci_veiculo " class="form-label">chaci</label>
                    <input type="text" name="numero_chaci_veiculo " class="form-control" value="<?= $linha['numero_chaci_veiculo'] ?>" required>
                </div>
                <div class="col-md">
                    <label for="tipo_veiculo" class="form-label">tipo veiculo</label>
                    <input type="text" name="tipo_veiculo" class="form-control" value="<?= $linha['tipo_veiculo'] ?>" required>
                </div>
                <div class="col-md">
                    <label for="cor_veiculo" class="form-label">Cor</label>
                    <input type="text" name="cor_veiculo" class="form-control" value="<?= $linha['cor_veiculo'] ?>" required>
                </div>
                <div class="col-md">
                    <label for="capacidade_veiculo" class="form-label">Capacidade</label>
                    <input type="text" name="capacidade_veiculo" class="form-control" value="<?= $linha['capacidade_veiculo'] ?>" required>
                </div>
                <div class="col-md">
                    <label for="porta_mala_veiculo " class="form-label">Porta mala</label>
                    <input type="text" name="porta_mala_veiculo " class="form-control" value="<?= $linha['porta_mala_veiculo'] ?>" required>
                </div>
                <div class="col-md">
                    <label for="alugado_veiculo" class="form-label">alugado</label>
                    <input type="text" name="alugado_veiculo" class="form-control" value="<?= $linha['alugado_veiculo'] ?>" required>
                </div>
                <div class="col-md">
                    <label for="km_atual" class="form-label">Km atual</label>
                    <input type="text" name="km_atual" class="form-control" value="<?= $linha['km_atual'] ?>" required>
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
