<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="">
</head>
<body>
    <form action="inserir_veiculo.php" method="get">
        Marca: <br>
        <input type="text" name="marca_veiculo"> <br><br>
        Placa:
        <input type="text" name="placa_veiculo"> <br><br>
        Modelo:
        <input type="text" name="modelo_veiculo"> <br><br>
        Numero do Chaci:
        <input type="text" name="chaci_veiculo"> <br><br>
        Tipo de Veiculo:
        <input type="text" name="tipo_veiculo"> <br><br>
        Cor:
        <input type="text" name="cor_veiculo"><br><br>
        Capacidade:
        <input type="text" name="capacidade_veiculo"> <br><br>
        Porta-Mala:
        <input type="text" name="porta_mala"> <br><br>
        
        <!-- Situação:
        <input type="text" name="alugado_veiculo"> <br><br> -->

        <input type="hidden" name="alugado_veiculo" value="N">


        Km atual:
        <input type="text" name="km_atual"> <br><br>

        
        <input type="submit" value="Salvar">
    </form>
</body>
</html>