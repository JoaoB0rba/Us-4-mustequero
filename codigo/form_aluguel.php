<?php
require_once "conexao.php";
require_once "operacoes.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<form action="inserir_aluguel.php">

    <input type="text" name="cliente">
    <input type="text" name="funcionario">
    <input type="text" name="carros">
    <input type="submit" value="enviar">

    </form>


<?php







//  $cliente = 1;
//  $funcionario = 1;
//  $carros = [2, 4];


// salvar o emprestimo
$idemprestimo = salvarEmprestimo($conexao, $tb_funcionario_idtb_funcionario, $tb_pessoas_idpessoas);

// salvar os veiculos
foreach ($carros as $id) {  
    salvarVeiculoEmprestimo($conexao, $idemprestimo, $id);
}
?>
</body>
</html>
