<?php
require_once 'conexao.php';

if (isset($_GET['idtb_pagamento'])) {
    $idtb_pagamento = $_GET['idtb_pagamento'];
    $sql = "SELECT * FROM tb_pagamento WHERE idtb_pagamento = $idtb_pagamento";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) == 1) {
        $linha = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pagamento</title>
    <link rel="stylesheet" href="estilo/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- jQuery e plugins -->
    <script src="./js/jquery-3.7.1.min.js"></script>
    <script src="./js/jquery.validate.min.js"></script>
    <script src="./js/jquery.mask.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2>Editar Pagamento</h2>

        <form id="formulario" action="atualizar_pagamento.php" method="post">
            <input type="hidden" name="idtb_pagamento" value="<?= $idtb_pagamento ?>">
            <div class="mb-3">
                <label for="tipo_pagamento" class="form-label">Tipo de Pagamento</label>
                <select name="tipo_pagamento" id="tipo_pagamento" class="form-control" required>
                    <option value="Cartao" <?= $linha['tipo_pagamento'] == 'Cartao' ? 'selected' : '' ?>>Cartão</option>
                    <option value="Dinheiro" <?= $linha['tipo_pagamento'] == 'Dinheiro' ? 'selected' : '' ?>>Dinheiro</option>
                    <option value="Pix" <?= $linha['tipo_pagamento'] == 'Pix' ? 'selected' : '' ?>>Pix</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="preco_pagamento" class="form-label">Preço</label>
                <input type="text" name="preco_pagamento" id="preco_pagamento" class="form-control" value="<?= $linha['preco_pagamento'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="valor_valorkm" class="form-label">Valor por KM</label>
                <input type="text" name="valor_valorkm" id="valor_valorkm" class="form-control" value="<?= $linha['valor_valorkm'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="tb_aluguel_idtb_aluguel" class="form-label">Aluguel (ID)</label>
                <input type="text" name="tb_aluguel_idtb_aluguel" id="tb_aluguel_idtb_aluguel" class="form-control" value="<?= $linha['tb_aluguel_idtb_aluguel'] ?>" readonly required>
            </div>

            <button type="submit" class="btn btn-success">Atualizar</button>
        </form>
    </div>

    <script>
$(document).ready(function () {
    // Validação do formulário
    $("#formulario").validate({
        rules: {
            preco_pagamento: {
                required: true,
                number: true,
                minlength: 2
            },
            valor_valorkm: {
                required: true,
                number: true,
                minlength: 2
            },
            tb_aluguel_idtb_aluguel: {
                required: true,
                digits: true
            }
        },
        messages: {
           
            preco_pagamento: {
                required: "Campo preço é obrigatório.",
                number: "Informe um valor válido.",
                minlength: "O preço deve ter no mínimo 2 caracteres."
            },
            valor_valorkm: {
                required: "Campo valor por KM é obrigatório.",
                number: "Informe um valor válido.",
                minlength: "O preço deve ter no mínimo 2 caracteres."
            },
            tb_aluguel_idtb_aluguel: {
                required: "Campo ID do aluguel é obrigatório.",
                digits: "O ID do aluguel deve ser um número."
            }
        }
    });
}); 
</script>

</html>

<?php
    } else {
        echo "Pagamento não encontrado.";
    }
} else {
    echo "ID do pagamento não especificado.";
}
mysqli_close($conexao);
?>