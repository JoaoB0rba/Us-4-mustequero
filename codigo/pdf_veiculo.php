<?php
// Inclua as bibliotecas necessárias
require_once './tcpdf/tcpdf.php';
require_once '../conexao.php';
require_once '../operacoes.php';

// Instancia o objeto TCPDF
$pdf = new TCPDF();
$pdf->setPrintHeader(false);

// Adiciona uma nova página
$pdf->AddPage();

// Define a fonte
$pdf->SetFont('helvetica', '', 14);

// Cabeçalho do documento
$pdf->Cell(0, 5, 'Listagem de Veículos', 0, 1, 'C');
$pdf->Ln();

// Busca os veículos usando a função listarCarros
$carros = listarCarros($conexao);

if (sizeof($carros) > 0) {
    // Cabeçalhos da tabela
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(20, 10, 'ID', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Marca', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Modelo', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Tipo', 1, 0, 'C');
    $pdf->Cell(25, 10, 'Cor', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Placa', 1, 0, 'C');
    $pdf->Cell(20, 10, 'Km Atual', 1, 1, 'C');

    // Linhas da tabela
    $pdf->SetFont('helvetica', '', 10);
    foreach ($carros as $carro) {
        $pdf->Cell(20, 10, $carro[0], 1, 0, 'C'); // ID
        $pdf->Cell(30, 10, $carro[1], 1, 0, 'C'); // Marca
        $pdf->Cell(30, 10, $carro[3], 1, 0, 'C'); // Modelo
        $pdf->Cell(30, 10, $carro[5], 1, 0, 'C'); // Tipo
        $pdf->Cell(25, 10, $carro[6], 1, 0, 'C'); // Cor
        $pdf->Cell(30, 10, $carro[2], 1, 0, 'C'); // Placa
        $pdf->Cell(20, 10, $carro[10], 1, 1, 'C'); // Km Atual
    }
} else {
    // Exibe mensagem caso não haja veículos
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, 'Nenhum veículo encontrado.', 0, 1, 'C');
}

// Saída do PDF
$pdf->Output();
