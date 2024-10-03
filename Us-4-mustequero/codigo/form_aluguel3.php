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
</head>
<body>
    <h2>Selecione os Carros para Alugar</h2>
    <form action="session3.php" method="post">
        <table border="1">
            <thead>
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


        <button type="submit">Alugar Carros Selecionados</button>
    </form>
    <a href="form_aluguel2.php">
        <button>Voltar</button>
    </a>
</body>
</html>
