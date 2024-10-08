<?php
require_once './fpdf/fpdf.php';
require_once '../db/conexao.php';

$pdf = new FPDF();

// adicionar uma nova página
// AddPage(orientação, tamanho, manterMargens)
// orientação: retrato/padrão ("P"), paisagem ("L")
// tamanho: "A4", "A5", "Letter" ou array com os tamanhos array(100,200)
// manter margens: manter as margens anteriores (true), usar margens padrão ou definidas no início do documento (false)
// para alterar margens usa-se setMargins()
$pdf->AddPage();

// definir a fonte
// setFont(família, estilo, tamanho)
// família: 'helvetica', 'times'...
// estilo: normal (''), negrito ('B'), itálico ('I'), sublinhado ('U') ou uma combinação destes valores.
// tamanho: tamanho em pontos (pt); valor padrão é 0 que mantém o tamanho anterior. Poderia ser usado 12, por exemplo.
$pdf->SetFont('Arial', '', 14);

// Cell(Largura, Altura, Texto, Borda, QuebraLinha, Alinhamento)
// largura, altura em mm.
// texto: o que será exibido
// borda: sem borda (0), com borda (1) ou lados específicos ("L", "R", "T", "B")
// quebra de linha: mantém a mesma posição após a célula (0), move início da próxima linha (1)
// alinhamento: esquerda ("L"), centralizado ("C") ou direita ("R").
$pdf->Cell(0, 5, 'Listagem de Tarefas', 0, 1, 'C');

// nova linha
$pdf->Ln();

$sql = "SELECT * FROM tb_tarefa WHERE id_usuario = 1 ORDER BY id_tarefa;";
$retorno = executarSQL($sql, "", []);

if (sizeof($retorno[1]) > 0) {
    $pdf->Cell(30, 10, 'Título', 1, 0, 'C');
    $pdf->Cell(85, 10, 'Descrição', 1);
    $pdf->Cell(32, 10, 'Início', 1, 0, 'C');
    $pdf->Cell(32, 10, 'Conclusao', 1, 0, 'C');
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
$pdf->Output();
