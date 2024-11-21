<?php 
session_start();
require_once "conexao.php";
require_once "operacoes.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selecionar Carros para Aluguel</title>
    <!-- Incluindo o CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Selecione os Carros para Alugar</h2>
    
    <form action="session3.php" method="post">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Selecionar</th>
                    <th>ID</th>
                    <th>Marca</th>
                    <th>Placa</th>
                    <th>Modelo</th>
                    <th>Número Chaci</th>
                    <th>Tipo</th>
                    <th>Cor</th>
                    <th>Capacidade</th>
                    <th>Porta Malas</th>
                    <th>Alugado</th>
                    <th>Km Atual</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $carrosDisponiveis = listarCarrosN($conexao);

                foreach ($carrosDisponiveis as $carro): ?>
                <tr>
                    <td><input type="checkbox" name="carros[]" value="<?php echo $carro['idtb_veiculo']; ?>"></td>
                    <td><?php echo $carro['idtb_veiculo']; ?></td>
                    <td><?php echo $carro['marca_veiculo']; ?></td>
                    <td><?php echo $carro['placa_veiculo']; ?></td>
                    <td><?php echo $carro['modelo_veiculo']; ?></td>
                    <td><?php echo $carro['numero_chaci_veiculo']; ?></td>
                    <td><?php echo $carro['tipo_veiculo']; ?></td>
                    <td><?php echo $carro['cor_veiculo']; ?></td>
                    <td><?php echo $carro['capacidade_veiculo']; ?></td>
                    <td><?php echo $carro['porta_mala_veiculo']; ?></td>
                    <td><?php echo $carro['alugado_veiculo']; ?></td>
                    <td><?php echo $carro['km_atual']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-3">
            <button type="submit" class="btn btn-primary">Alugar Carros Selecionados</button>
        </div>
    </form>

    <div class="d-flex justify-content-center mt-3">
        <a href="form_aluguel2.php" class="btn btn-secondary">Voltar</a>
    </div>
</div>

<!-- Incluindo o JS do Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
