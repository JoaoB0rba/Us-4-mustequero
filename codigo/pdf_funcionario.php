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
$pdf->Cell(0, 5, 'Listagem de Funcionários', 0, 1, 'C');
$pdf->Ln();

// Busca os funcionários usando a função listarFuncionarios
$funcionarios = listarFuncionarios($conexao);

if (sizeof($funcionarios) > 0) {
    // Cabeçalhos da tabela
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(20, 10, 'ID', 1, 0, 'C');
    $pdf->Cell(60, 10, 'Nome', 1, 0, 'C');
    $pdf->Cell(40, 10, 'CPF', 1, 0, 'C');
    $pdf->Cell(50, 10, 'Telefone', 1, 1, 'C');

    // Linhas da tabela
    $pdf->SetFont('helvetica', '', 10);
    foreach ($funcionarios as $funcionario) {
        $pdf->Cell(20, 10, $funcionario['idtb_funcionario'], 1, 0, 'C'); // ID
        $pdf->Cell(60, 10, $funcionario['nome_funcionario'], 1, 0, 'C'); // Nome
        $pdf->Cell(40, 10, $funcionario['cpf_funcionario'], 1, 0, 'C'); // CPF
        $pdf->Cell(50, 10, $funcionario['telefone_funcionario'], 1, 1, 'C'); // Telefone
    }
} else {
    // Exibe mensagem caso não haja funcionários
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, 'Nenhum funcionário encontrado.', 0, 1, 'C');
}

// Saída do PDF
$pdf->Output();
?>
