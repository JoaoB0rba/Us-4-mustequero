<?php
// Inclua as bibliotecas necessárias
require_once 'TCPDF-main/tcpdf.php';
require_once 'conexao.php';
require_once 'operacoes.php';

// Instancia o objeto TCPDF
$pdf = new TCPDF();
$pdf->setPrintHeader(false);

// Adiciona uma nova página
$pdf->AddPage();

// Define a fonte
$pdf->SetFont('helvetica', '', 14);

// Cabeçalho do documento
$pdf->Cell(0, 5, 'Listagem de Pagamentos', 0, 1, 'C');
$pdf->Ln();

// Busca os pagamentos usando a função listarPagamentos
$pagamentos = listarPagamentos($conexao);

if (sizeof($pagamentos) > 0) {
    // Cabeçalhos da tabela
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(20, 10, 'ID', 1, 0, 'C');
    $pdf->Cell(60, 10, 'Tipo', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Preço', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Valor/Km', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Aluguel', 1, 1, 'C');

    // Linhas da tabela
    $pdf->SetFont('helvetica', '', 10);
    foreach ($pagamentos as $pagamento) {
        $pdf->Cell(20, 10, $pagamento['idtb_pagamento'], 1, 0, 'C'); // ID
        $pdf->Cell(60, 10, $pagamento['tipo_pagamento'], 1, 0, 'C'); // Tipo
        $pdf->Cell(40, 10, $pagamento['preco_pagamento'], 1, 0, 'C'); // Preço
        $pdf->Cell(40, 10, $pagamento['valor_valorkm'], 1, 0, 'C'); // Valor/Km
        $pdf->Cell(30, 10, $pagamento['idtb_aluguel'], 1, 1, 'C'); // ID Aluguel
    }
} else {
    // Exibe mensagem caso não haja pagamentos
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, 'Nenhum pagamento encontrado.', 0, 1, 'C');
}

// Saída do PDF
$pdf->Output();
?>
