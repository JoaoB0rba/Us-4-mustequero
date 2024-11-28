<?php
require_once 'conexao.php';

if (isset($_GET['idtb_funcionario'])) {
    $idtb_funcionario = $_GET['idtb_funcionario'];
    $sql = "SELECT * FROM tb_funcionario WHERE idtb_funcionario = $idtb_funcionario";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) == 1) {
        $linha = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Funcionário</title>
    <link rel="stylesheet" href="estilo/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- jQuery e plugins -->
    <script src="./js/jquery-3.7.1.min.js"></script>
    <script src="./js/jquery.validate.min.js"></script>
    <script src="./js/jquery.mask.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2>Editar Funcionário</h2>

        <form id="formulario" action="atualizar_funcionario.php" method="post">
            <input type="hidden" name="idtb_funcionario" value="<?= $idtb_funcionario ?>">
            <div class="mb-3">
                <label for="nome_funcionario" class="form-label">Nome</label>
                <input type="text" name="nome_funcionario" id="nome_funcionario" class="form-control" value="<?= $linha['nome_funcionario'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="cpf_funcionario" class="form-label">CPF</label>
                <input type="text" name="cpf_funcionario" id="cpf_funcionario" class="form-control" value="<?= $linha['cpf_funcionario'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="telefone_funcionario" class="form-label">Telefone</label>
                <input type="text" name="telefone_funcionario" id="telefone_funcionario" class="form-control" value="<?= $linha['telefone_funcionario'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="senhaa" class="form-label">Senha</label>
                <input type="text" name="senhaa" id="senhaa" class="form-control" value="<?= $linha['senhaa'] ?>" required>
            </div>
            
            <button type="submit" class="btn btn-success">Atualizar</button>
            <a href="pesquisar_vendedor.php" class="btn btn-secondary">Voltar</a>

        </form>
    </div>

    <script>
        $(document).ready(function () {
            // Máscaras
            $('#cpf_funcionario').mask('000.000.000-00');
            $('#telefone_funcionario').mask('(00) 0 0000-0000');

            // Validação do formulário
            $("#formulario").validate({
                rules: {
                    nome_funcionario: {
                        required: true,
                        minlength: 2,
                    },
                    cpf_funcionario: {
                        required: true,
                        minlength: 14, // CPF com máscara
                    },
                    telefone_funcionario: {
                        required: true,
                        minlength: 15, // Telefone com máscara
                    },
                    senhaa: {
                        required: true,
                        maxlength: 10,
                    }
                },
                messages: {
                    nome_funcionario: {
                        required: "Campo nome é obrigatório.",
                        minlength: "O nome deve ter pelo menos 2 caracteres."
                    },
                    cpf_funcionario: {
                        required: "Campo CPF é obrigatório.",
                        minlength: "O CPF deve ter 14 caracteres.",
                    },
                    telefone_funcionario: {
                        required: "Campo telefone é obrigatório.",
                        minlength: "O telefone deve ter pelo menos 15 caracteres.",
                    },
                    senhaa: {
                        required: "Campo senha é obrigatório.",
                        maxlength: "A senha deve ter no máximo 10 caracteres.",
                    }
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>

<?php
    } else {
        echo "Funcionário não encontrado.";
    }
} else {
    echo "ID do funcionário não especificado.";
}
mysqli_close($conexao);
?>
