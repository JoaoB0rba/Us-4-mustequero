<?php
$documento = $_GET['documento'];

// Verifica a quantidade de dígitos para diferenciar entre CPF (pessoa física) e CNPJ (pessoa jurídica)
if (strlen($documento) == 11) {
    // Redireciona para página de pessoa física
    header("Location: pagfisica.php?cpf=$documento");
    exit();
} elseif (strlen($documento) == 14) {
    // Redireciona para página de pessoa jurídica
    header("Location: pagjuridica.php?cnpj=$documento");
    exit();
} else {
    echo "Documento inválido.";
    exit();
}
?>
