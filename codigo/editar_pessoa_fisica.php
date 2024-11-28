<?php
require_once 'conexao.php';

if (isset($_GET['idpessoa_fisica'])) {
    $idpessoa_fisica = $_GET['idpessoa_fisica'];
    // Alterar a consulta para selecionar os dados de tb_pessoa_fisica e tb_pessoas
    $sql = "SELECT pf.idpessoa_fisica, p.nome, p.telefone, pf.cpf, pf.cnh 
            FROM tb_pessoa_fisica pf
            JOIN tb_pessoas p ON pf.tb_pessoas_idpessoas = p.idpessoas
            WHERE pf.idpessoa_fisica = $idpessoa_fisica";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) == 1) {
        $linha = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pessoa Física</title>
    <link rel="stylesheet" href="estilo/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- jQuery e plugins -->
    <script src="./js/jquery-3.7.1.min.js"></script>
    <script src="./js/jquery.validate.min.js"></script>
    <script src="./js/jquery.mask.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2>Editar Pessoa Física</h2>

        <form id="pf" action="atualizar_pessoa_fisica.php" method="post">
            <input type="hidden" name="idpessoa_fisica" value="<?= $idpessoa_fisica ?>">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" value="<?= $linha['nome'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" name="cpf" id="cpf" class="form-control" value="<?= $linha['cpf'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" name="telefone" id="telefone" class="form-control" value="<?= $linha['telefone'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="cnh" class="form-label">CNH</label>
                <input type="text" name="cnh" id="cnh" class="form-control" value="<?= $linha['cnh'] ?>" required>
            </div>
            
            <button type="submit" class="btn btn-success">Atualizar</button>
            <a href="pesquisar_pessoa_fisica.php" class="btn btn-secondary">Voltar</a>

        </form>
    </div>

    <script>
    $(document).ready(function () {
        // Máscaras
        $('#cpf').mask('000.000.000-00');
        $('#telefone').mask('(00) 0 0000-0000');
        $('#cnh').mask('000000000'); // Máscara para CNH com 9 dígitos

        // Validação do formulário
        $("#pf").validate({
            rules: {
                nome: {
                    required: true,
                    minlength: 2,
                },
                cpf: {
                    required: true,
                    minlength: 14, // CPF com máscara
                },
                telefone: {
                    required: true,
                    minlength: 15, // Telefone com máscara
                },
                cnh: {
                    required: true,
                    minlength: 9, // CNH com 9 dígitos
                    maxlength: 9,
                    number: true // Validar que é somente numérico
                }
            },
            messages: {
                nome: {
                    required: "Campo nome é obrigatório.",
                    minlength: "O nome deve ter pelo menos 2 caracteres."
                },
                cpf: {
                    required: "Campo CPF é obrigatório.",
                    minlength: "O CPF deve ter 14 caracteres.",
                },
                telefone: {
                    required: "Campo telefone é obrigatório.",
                    minlength: "O telefone deve ter pelo menos 15 caracteres.",
                },
                cnh: {
                    required: "Campo CNH é obrigatório.",
                    minlength: "A CNH deve ter 9 caracteres.",
                    maxlength: "A CNH deve ter no máximo 9 caracteres.",
                    number: "CNH aceita apenas números."
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
        echo "Pessoa Física não encontrada.";
    }
} else {
    echo "ID da pessoa física não especificado.";
}
mysqli_close($conexao);
?>
