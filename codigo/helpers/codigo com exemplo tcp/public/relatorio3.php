<?php
require_once './tcpdf/tcpdf.php';
require_once '../db/conexao.php';

$pdf = new TCPDF();
$pdf->setPrintHeader(false);
$pdf->AddPage();

$pdf->SetFont('helvetica', '', 13);
$pdf->Cell(0, 5, 'Listagem de Tarefas', 0, 1, 'C');
$pdf->Ln();

$sql = "SELECT * FROM tb_tarefa WHERE id_usuario = 1 ORDER BY id_tarefa;";
$retorno = executarSQL($sql, "", []);

if (sizeof($retorno[1]) > 0) {
    $pdf->Cell(30, 10, 'Título', 1, 0, 'C');
    $pdf->Cell(85, 10, 'Descrição', 1);
    $pdf->Cell(32, 10, 'Início', 1, 0, 'C');
    $pdf->Cell(32, 10, 'Conclusão', 1, 0, 'C');
    $pdf->Cell(10, 10, '!', 1, 0, 'C');
    $pdf->Ln();
    foreach ($retorno[1] as $linha) {
        $pdf->Cell(30, 10, $linha['titulo'], 1, 0, 'C');
        $pdf->Cell(85, 10, $linha['descricao'], 1);
        $pdf->Cell(32, 10, $linha['data_inicio'], 1, 0, 'C');
        $pdf->Cell(32, 10, $linha['data_conclusao'], 1, 0, 'C');
        $pdf->Cell(10, 10, $linha['prioridade'], 1, 0, 'C');
        $pdf->Ln();
    }
}
else {

}
$pdf->Output();
