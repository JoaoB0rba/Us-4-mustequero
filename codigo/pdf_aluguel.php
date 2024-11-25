<?php
// Inclua as bibliotecas necessárias
require_once 'TCPDF-main/tcpdf.php';
require_once 'conexao.php';

// Função para listar aluguéis

function listarAlugueis($conexao) {
    $sql = "
        SELECT 
            a.idtb_aluguel, 
            a.data_inicial, 
            p.nome AS cliente, 
            f.nome_funcionario AS funcionario
        FROM tb_aluguel a
        INNER JOIN tb_pessoas p ON a.tb_pessoas_idpessoas = p.idpessoas
        INNER JOIN tb_funcionario f ON a.tb_funcionario_idtb_funcionario = f.idtb_funcionario
        ORDER BY a.idtb_aluguel ASC
    ";
    $result = $conexao->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Instancia o objeto TCPDF
$pdf = new TCPDF();
$pdf->setPrintHeader(false);

// Adiciona uma nova página
$pdf->AddPage();

// Define a fonte
$pdf->SetFont('helvetica', '', 14);

// Cabeçalho do documento
$pdf->Cell(0, 5, 'Relatório de Aluguéis', 0, 1, 'C');
$pdf->Ln();

// Busca os aluguéis usando a função listarAlugueis
$aluguéis = listarAlugueis($conexao);

if (sizeof($aluguéis) > 0) {
    // Cabeçalhos da tabela
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(30, 10, 'ID Aluguel', 1, 0, 'C');
    $pdf->Cell(50, 10, 'Data Inicial', 1, 0, 'C');
    $pdf->Cell(60, 10, 'Cliente', 1, 0, 'C');
    $pdf->Cell(50, 10, 'Funcionário', 1, 1, 'C');

    // Linhas da tabela
    $pdf->SetFont('helvetica', '', 10);
    foreach ($aluguéis as $aluguel) {
        $pdf->Cell(30, 10, $aluguel['idtb_aluguel'], 1, 0, 'C'); // ID Aluguel
        $pdf->Cell(50, 10, date('d/m/Y H:i', strtotime($aluguel['data_inicial'])), 1, 0, 'C'); // Data Inicial
        $pdf->Cell(60, 10, $aluguel['cliente'], 1, 0, 'C'); // Nome do Cliente
        $pdf->Cell(50, 10, $aluguel['funcionario'], 1, 1, 'C'); // Nome do Funcionário
    }
} else {
    // Exibe mensagem caso não haja aluguéis
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, 'Nenhum aluguel encontrado.', 0, 1, 'C');
}

// Saída do PDF
$pdf->Output();
