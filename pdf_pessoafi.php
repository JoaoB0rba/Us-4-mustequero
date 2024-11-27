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
$pdf->Cell(0, 5, 'Listagem de Pessoas Físicas', 0, 1, 'C');
$pdf->Ln();

// Busca as pessoas físicas usando a função listarPessoaFisica
$pessoasFisicas = listarPessoaFisica($conexao);

if (sizeof($pessoasFisicas) > 0) {
    // Cabeçalhos da tabela
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(20, 10, 'ID', 1, 0, 'C');
    $pdf->Cell(60, 10, 'Nome', 1, 0, 'C');
    $pdf->Cell(40, 10, 'CPF', 1, 0, 'C');
    $pdf->Cell(50, 10, 'Data de Nasc.', 1, 1, 'C');

    // Linhas da tabela
    $pdf->SetFont('helvetica', '', 10);
    foreach ($pessoasFisicas as $pessoa) {
        $pdf->Cell(20, 10, $pessoa['idtb_pessoa_fisica'], 1, 0, 'C'); // ID
        $pdf->Cell(60, 10, $pessoa['nome_pessoa'], 1, 0, 'C'); // Nome
        $pdf->Cell(40, 10, $pessoa['cpf_pessoa'], 1, 0, 'C'); // CPF
        $pdf->Cell(50, 10, $pessoa['data_nascimento'], 1, 1, 'C'); // Data de Nascimento
    }
} else {
    // Exibe mensagem caso não haja registros
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, 'Nenhuma pessoa física encontrada.', 0, 1, 'C');
}

// Saída do PDF
$pdf->Output();
?>
