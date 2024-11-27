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
$pdf->Cell(0, 5, 'Listagem de Pessoas Jurídicas', 0, 1, 'C');
$pdf->Ln();

// Busca as pessoas jurídicas usando a função listarPessoaJuridica
$pessoasJuridicas = listarPessoaJuridica($conexao);

if (sizeof($pessoasJuridicas) > 0) {
    // Cabeçalhos da tabela
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(20, 10, 'ID', 1, 0, 'C');
    $pdf->Cell(60, 10, 'Nome', 1, 0, 'C');
    $pdf->Cell(40, 10, 'CNPJ', 1, 0, 'C');
    $pdf->Cell(50, 10, 'Telefone', 1, 1, 'C'); // Alterando para Telefone

    // Linhas da tabela
    $pdf->SetFont('helvetica', '', 10);
    foreach ($pessoasJuridicas as $pessoa) {
        $pdf->Cell(20, 10, $pessoa['idtb_pessoa_juridica'], 1, 0, 'C'); // ID
        $pdf->Cell(60, 10, $pessoa['nome_pessoa'], 1, 0, 'C'); // Nome
        $pdf->Cell(40, 10, $pessoa['cnpj_pessoa'], 1, 0, 'C'); // CNPJ
        $pdf->Cell(50, 10, $pessoa['telefone'], 1, 1, 'C'); // Telefone
    }
} else {
    // Exibe mensagem caso não haja registros
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, 'Nenhuma pessoa jurídica encontrada.', 0, 1, 'C');
}

// Saída do PDF
$pdf->Output();
?>
