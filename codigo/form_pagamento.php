<?php

require_once "conexao.php";

$tipo_pagamento = $_GET['tipo_pagamento'];
$preco_pagamento = $_GET['preco_pagamento'];
$km_final = $_GET['km_final'];
$valor_valorkm = $_GET['valor_valorkm'];

$sql = "INSERT INTO tb_pagamento (tipo_pagamento, preco_pagamento, km_final, valor_valorkm) VALUES ('$tipo_pagamento', '$preco_pagamento', '$km_final', '$valor_valorkm')";

mysqli_query($conexao, $sql);

header("location: index.html")
?>





