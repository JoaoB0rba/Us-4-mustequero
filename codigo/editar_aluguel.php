<?php
require_once 'conexao.php';

if (isset($_GET['idtb_aluguel'])) {
    $idtb_aluguel = $_GET['idtb_aluguel'];
    $sql = "SELECT * FROM tb_aluguel WHERE idtb_aluguel = $idtb_aluguel";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) == 1) {
        $linha = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluguel</title>
    <link rel="stylesheet" href="estilo/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- jQuery e Validação -->
    <script src="./js/jquery-3.7.1.min.js"></script>
    <script src="./js/jquery.validate.min.js"></script>
    <script src="./js/jquery.mask.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Editar Aluguel</h2>

        <form id="editarAluguel" action="atualizar_aluguel.php" method="post">
            <input type="hidden" name="idtb_aluguel" value="<?= $idtb_aluguel ?>">

            <div class="mb-3">
                <label for="data_inicial" class="form-label">Data Inicial</label>
                <input type="date" id="data_inicial" name="data_inicial" class="form-control" value="<?= $linha['data_inicial'] ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="tb_funcionario_idtb_funcionario" class="form-label">Funcionário</label>
                <input type="number" id="tb_funcionario_idtb_funcionario" name="tb_funcionario_idtb_funcionario" class="form-control" value="<?= $linha['tb_funcionario_idtb_funcionario'] ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="tb_pessoas_idpessoas" class="form-label">Cliente</label>
                <input type="number" id="tb_pessoas_idpessoas" name="tb_pessoas_idpessoas" class="form-control" value="<?= $linha['tb_pessoas_idpessoas'] ?>" required>
            </div>
            
            <button type="submit" class="btn btn-danger">Atualizar</button>
            <a href="pesquisar_aluguel.php" class="btn btn-secondary">Voltar</a>

        </form>
    </div>

    <script>
        $(document).ready(function () {
            $("#editarAluguel").validate({
                rules: {
                    data_inicial: {
                        required: true
                    },
                    tb_funcionario_idtb_funcionario: {
                        required: true,
                        number: true
                    },
                    tb_pessoas_idpessoas: {
                        required: true,
                        number: true
                    }
                },
                messages: {
                    data_inicial: {
                        required: "Campo Data Inicial é obrigatório."
                    },
                    tb_funcionario_idtb_funcionario: {
                        required: "Campo Funcionário é obrigatório.",
                        number: "Digite um número válido."
                    },
                    tb_pessoas_idpessoas: {
                        required: "Campo Cliente é obrigatório.",
                        number: "Digite um número válido."
                    }
                }
            });
        });
    </script>
</body>
</html>

<?php
    }
}
?>
