<?php
require_once 'conexao.php';

if (isset($_GET['idpessoa_juridica'])) {
    $idpessoa_juridica = $_GET['idpessoa_juridica'];
    
    // Alterar a consulta para selecionar os dados de tb_pessoa_juridica e tb_pessoas
    $sql = "SELECT pj.idpessoa_juridica, p.nome, p.telefone, pj.cnpj 
            FROM tb_pessoa_juridica pj
            JOIN tb_pessoas p ON pj.tb_pessoas_idpessoas = p.idpessoas
            WHERE pj.idpessoa_juridica = $idpessoa_juridica";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) == 1) {
        $linha = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pessoa Jurídica</title>
    <link rel="stylesheet" href="estilo/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- jQuery e plugins -->
    <script src="./js/jquery-3.7.1.min.js"></script>
    <script src="./js/jquery.validate.min.js"></script>
    <script src="./js/jquery.mask.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2>Editar Pessoa Jurídica</h2>

        <form id="pj" action="atualizar_pessoa_juridica.php" method="post">
            <input type="hidden" name="idpessoa_juridica" value="<?= $idpessoa_juridica ?>">

            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" value="<?= $linha['nome'] ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="cnpj" class="form-label">CNPJ</label>
                <input type="text" name="cnpj" id="cnpj" class="form-control" value="<?= $linha['cnpj'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" name="telefone" id="telefone" class="form-control" value="<?= $linha['telefone'] ?>" required>
            </div>
            
            <button type="submit" class="btn btn-success">Atualizar</button>
        </form>
    </div>

    <script>
    $(document).ready(function () {
        // Máscaras
        $('#cnpj').mask('00.000.000/0000-00');
        $('#telefone').mask('(00) 0 0000-0000');

        // Validação do formulário
        $("#pj").validate({
            rules: {
                nome: {
                    required: true,
                    minlength: 2,
                },
                cnpj: {
                    required: true,
                    minlength: 18, // CNPJ com máscara
                },
                telefone: {
                    required: true,
                    minlength: 15, // Telefone com máscara
                }
            },
            messages: {
                nome: {
                    required: "Campo nome é obrigatório.",
                    minlength: "O nome deve ter pelo menos 2 caracteres."
                },
                cnpj: {
                    required: "Campo CNPJ é obrigatório.",
                    minlength: "O CNPJ deve ter 18 caracteres.",
                },
                telefone: {
                    required: "Campo telefone é obrigatório.",
                    minlength: "O telefone deve ter pelo menos 15 caracteres.",
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
        echo "Pessoa Jurídica não encontrada.";
    }
} else {
    echo "ID da pessoa jurídica não especificado.";
}
mysqli_close($conexao);
?>
