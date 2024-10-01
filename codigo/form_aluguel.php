<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<form action="session.php">


    funcionario:
    <select name="idFuncionario">
            <?php
            require_once "conexao.php";
            require_once "operacoes.php";

            $resultados = listarFuncionario($conexao);

            foreach ($resultados as $funcionario) {
                echo "<option value='$funcionario[0]'>$funcionario[1]</option>";
            }
            ?>
        </select> <br><br>
    
    
        Tipo de cliente:
        <label><input type="radio" name="tipocliente" value="pf"> Físico</label>
        <label><input type="radio" name="tipocliente" value="pj"> Jurídico</label><br>
    <br><br>


    <!-- carros:
    <input type="text" name="carros">
    <br><br> -->


    <input type="submit" value="enviar">

    </form>
    <a href="index.html">
    <button>Voltar</button>
    </a>

</body>
</html>
