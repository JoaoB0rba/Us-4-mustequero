<?php
session_start();
require_once "conexao.php";
require_once "operacoes.php";

// Pegando as variáveis da sessão
$tipocliente = $_SESSION['tipocliente'];
$idFuncionario = $_SESSION['idFuncionario'];
$cliente = $_SESSION['cliente'];
$carros = $_SESSION['carros'];

// Consulta para obter o nome do cliente
$queryCliente = "SELECT nome FROM tb_pessoas WHERE idpessoas = $cliente";
$resultCliente = mysqli_query($conexao, $queryCliente);
$nomeCliente = mysqli_fetch_assoc($resultCliente)['nome'];

// Consulta para obter o nome do funcionário
$queryFuncionario = "SELECT nome_funcionario FROM tb_funcionario WHERE idtb_funcionario = $idFuncionario";
$resultFuncionario = mysqli_query($conexao, $queryFuncionario);
$nomeFuncionario = mysqli_fetch_assoc($resultFuncionario)['nome_funcionario'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Aluguel</title>
    <!-- Link para o Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <h3 class="text-center mb-4">Detalhes do Aluguel</h3>
        <table class="table table-bordered table-hover table-striped">
            <thead class="thead-dark">
                <tr><th>Tipo de Cliente</th><td><?= $tipocliente ?></td></tr>
                <tr><th>Funcionário</th><td><?= $nomeFuncionario ?></td></tr>
                <tr><th>Cliente</th><td><?= $nomeCliente ?></td></tr>
                <tr><th>Carros Selecionados</th><td>
                    <?php
                    if (is_array($carros)) {
                        foreach ($carros as $idCarro) {
                            $queryCarro = "SELECT modelo_veiculo FROM tb_veiculo WHERE idtb_veiculo = $idCarro";
                            $resultCarro = mysqli_query($conexao, $queryCarro);
                            $nomeCarro = mysqli_fetch_assoc($resultCarro)['modelo_veiculo'];
                            echo "$nomeCarro<br>";
                        }
                    } else {
                        echo "Nenhum carro selecionado.";
                    }
                    ?>
                </td></tr>
            </thead>
        </table>

        <div class="d-flex justify-content-center mt-4">
            <a href="inserir_aluguel.php" class="btn btn-success btn-lg">Concluido</a>
        </div>

        <div class="d-flex justify-content-center mt-3">
            <a href="form_aluguel2.php" class="btn btn-secondary btn-lg">Voltar</a>
        </div>
    </div>

    <!-- Scripts do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
