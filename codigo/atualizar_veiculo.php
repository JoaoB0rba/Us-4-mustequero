<?php
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idtb_veiculo = $_POST['idtb_veiculo'];
    $marca_veiculo = $_POST['marca_veiculo'];
    $placa_veiculo = $_POST['placa_veiculo'];
    $modelo_veiculo = $_POST['modelo_veiculo'];
    $numero_chaci_veiculo = $_POST['numero_chaci_veiculo'];
    $tipo_veiculo = $_POST['tipo_veiculo'];
    $cor_veiculo = $_POST['cor_veiculo'];
    $capacidade_veiculo = $_POST['capacidade_veiculo'];
    $porta_mala_veiculo = $_POST['porta_mala_veiculo'];
    $alugado_veiculo = $_POST['alugado_veiculo'];
    $km_atual = $_POST['km_atual'];

    

    // Adicione outros campos conforme necessário

     $sql = "UPDATE tb_veiculo SET marca_veiculo='$marca_veiculo', placa_veiculo='$placa_veiculo', modelo_veiculo='$modelo_veiculo', numero_chaci_veiculo='$numero_chaci_veiculo', tipo_veiculo='$tipo_veiculo', cor_veiculo='$cor_veiculo', capacidade_veiculo='$capacidade_veiculo', porta_mala_veiculo='$porta_mala_veiculo', alugado_veiculo='$alugado_veiculo', km_atual='$km_atual' WHERE idtb_veiculo='$idtb_veiculo'";

     if (mysqli_query($conexao, $sql)) {
        header("Location: pesquisar_veiculo.php?status=sucesso");
         echo "Carro atualizado com sucesso.";
     } else {
         echo "Erro ao atualizar Carro. Tente novamente.";
     }
 } else {
     echo "Método inválido de requisição.";
 }

  //Fechar a conexão
 mysqli_close($conexao);

?>