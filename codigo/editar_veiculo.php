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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Veículo</title>
    <link rel="stylesheet" href="estilo/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- jQuery e Validação -->
    <script src="./js/jquery-3.7.1.min.js"></script>
    <script src="./js/jquery.validate.min.js"></script>
    <script src="./js/jquery.mask.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Editar Veículo</h2>

        <form id="editarVeiculo" action="atualizar_veiculo.php" method="post">
            <input type="hidden" name="idtb_veiculo" value="<?= $idtb_veiculo ?>">
            
            <div class="mb-3">
                <label for="marca_veiculo" class="form-label">Marca</label>
                <input type="text" id="marca_veiculo" name="marca_veiculo" class="form-control" value="<?= $linha['marca_veiculo'] ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="placa_veiculo" class="form-label">Placa</label>
                <input type="text" id="placa_veiculo" name="placa_veiculo" class="form-control" value="<?= $linha['placa_veiculo'] ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="modelo_veiculo" class="form-label">Modelo</label>
                <input type="text" id="modelo_veiculo" name="modelo_veiculo" class="form-control" value="<?= $linha['modelo_veiculo'] ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="numero_chaci_veiculo" class="form-label">Número do Chassi</label>
                <input type="text" id="numero_chaci_veiculo" name="numero_chaci_veiculo" class="form-control" value="<?= $linha['numero_chaci_veiculo'] ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="tipo_veiculo" class="form-label">Tipo</label>
                <input type="text" id="tipo_veiculo" name="tipo_veiculo" class="form-control" value="<?= $linha['tipo_veiculo'] ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="cor_veiculo" class="form-label">Cor</label>
                <input type="text" id="cor_veiculo" name="cor_veiculo" class="form-control" value="<?= $linha['cor_veiculo'] ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="capacidade_veiculo" class="form-label">Capacidade</label>
                <input type="number" id="capacidade_veiculo" name="capacidade_veiculo" class="form-control" value="<?= $linha['capacidade_veiculo'] ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="porta_mala_veiculo" class="form-label">Porta-Mala</label>
                <input type="text" id="porta_mala_veiculo" name="porta_mala_veiculo" class="form-control" value="<?= $linha['porta_mala_veiculo'] ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="alugado_veiculo" class="form-label">Alugado</label>
                <select id="alugado_veiculo" name="alugado_veiculo" class="form-control" required>
                    <option value="S" <?= $linha['alugado_veiculo'] == 'S' ? 'selected' : '' ?>>Sim</option>
                    <option value="N" <?= $linha['alugado_veiculo'] == 'N' ? 'selected' : '' ?>>Não</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="km_atual" class="form-label">Km Atual</label>
                <input type="text" id="km_atual" name="km_atual" class="form-control" value="<?= $linha['km_atual'] ?>" required>
            </div>
            
            <button type="submit" class="btn btn-danger">Atualizar</button>
            <a href="pesquisar_veiculo.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $("#editarVeiculo").validate({
                rules: {
                    marca_veiculo: {
                        required: true,
                        minlength: 2
                    },
                    placa_veiculo: {
                        required: true,
                        minlength: 7,
                        maxlength: 7
                    },
                    modelo_veiculo: {
                        required: true,
                        minlength: 2
                    },
                    numero_chaci_veiculo: {
                        required: true,
                        minlength: 17,
                        maxlength: 17
                    },
                    tipo_veiculo: {
                        required: true,
                        minlength: 2
                    },
                    cor_veiculo: {
                        required: true,
                        minlength: 2
                    },
                    capacidade_veiculo: {
                        required: true,
                        number: true,
                        min: 1
                    },
                    porta_mala_veiculo: {
                        required: true
                    },
                    km_atual: {
                        required: true,
                        number: true
                    },
                    alugado_veiculo: {
                        required: true,
                        pattern: /^[SN]$/ // Apenas 'S' ou 'N'
                    }
                },
                messages: {
                    marca_veiculo: {
                        required: "Campo Marca é obrigatório.",
                        minlength: "A Marca deve ter pelo menos 2 caracteres."
                    },
                    placa_veiculo: {
                        required: "Campo Placa é obrigatório.",
                        minlength: "A Placa deve ter 7 caracteres.",
                        maxlength: "A Placa deve ter 7 caracteres."
                    },
                    modelo_veiculo: {
                        required: "Campo Modelo é obrigatório.",
                        minlength: "O Modelo deve ter pelo menos 2 caracteres."
                    },
                    numero_chaci_veiculo: {
                        required: "Campo Número do Chassi é obrigatório.",
                        minlength: "O Número do Chassi deve ter 17 caracteres.",
                        maxlength: "O Número do Chassi deve ter 17 caracteres."
                    },
                    tipo_veiculo: {
                        required: "Campo Tipo é obrigatório.",
                        minlength: "O Tipo deve ter pelo menos 2 caracteres."
                    },
                    cor_veiculo: {
                        required: "Campo Cor é obrigatório.",
                        minlength: "A Cor deve ter pelo menos 2 caracteres."
                    },
                    capacidade_veiculo: {
                        required: "Campo Capacidade é obrigatório.",
                        number: "Digite um número válido.",
                        min: "A capacidade deve ser maior que 0."
                    },
                    porta_mala_veiculo: {
                        required: "Campo Porta-Mala é obrigatório."
                    },
                    km_atual: {
                        required: "Campo Km Atual é obrigatório.",
                        number: "Digite um valor numérico válido."
                    },
                    alugado_veiculo: {
                        required: "Campo Alugado é obrigatório.",
                        pattern: "Escolha uma opção válida ('S' ou 'N')."
                    }
                }
            });

            // Máscara para o campo KM Atual
            $('#km_atual').mask('0000000');
        });
    </script>
</body>
</html>

<?php
    }
}
?>
