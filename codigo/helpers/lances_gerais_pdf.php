<?php
require_once './pdf/tcpdf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';

// Criação do PDF
$pdf = new TCPDF();

// Configurações iniciais
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nome do Autor');
$pdf->SetTitle('Relatório de Lotes');
$pdf->SetSubject('Relatório Detalhado de Lotes');
$pdf->SetKeywords('PDF, Relatório, Lotes');

// Definindo margens
$pdf->SetMargins(15, 20, 15);
$pdf->SetHeaderMargin(10);
$pdf->SetFooterMargin(10);

// Adicionando cabeçalho e rodapé
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(true);

// Consulta principal de lotes
$sql_lotes = "SELECT * FROM tb_lote ORDER BY data_fechamento";
$retorno_lotes = conectarDB("select", $sql_lotes, "", []);

// Iteração sobre os lotes
foreach ($retorno_lotes[1] as $dados_lote) {
    // Adicionando uma nova página para cada lote
    $pdf->AddPage();

    $id_lote = $dados_lote['id_lote'];
    $valor_inicial_lote = $dados_lote['valor_lote'];
    $id_cavalo = $dados_lote['tb_cavalo_id_cavalo'];

    $sql_cavalo = "SELECT * FROM tb_cavalo WHERE id_cavalo = $id_cavalo";
    $retorno_cavalo = conectarDB("select", $sql_cavalo, "", []);
    $dados_cavalo = $retorno_cavalo[1][0];
    $nome_cavalo = $dados_cavalo['nome_cavalo'];
    $raca_cavalo = $dados_cavalo['raca_cavalo'];
    $destaque = $dados_cavalo['destaque'];
    $premio_cavalo = $dados_cavalo['premio_cavalo'];

    // Título do lote
    $pdf->SetFont('helvetica', 'B', 16);
    $pdf->Cell(0, 10, "Lote #$id_lote - $nome_cavalo", 0, 1, 'C');
    $pdf->Ln(5);

    // Tabela com informações do lote
    $tbl = <<<EOD
<table border="1" cellpadding="5">
    <tr>
        <th><b>Raça</b></th>
        <th><b>Destaque</b></th>
        <th><b>Prêmio</b></th>
        <th><b>Valor Inicial</b></th>
    </tr>
    <tr>
        <td>$raca_cavalo</td>
        <td>$destaque</td>
        <td>$premio_cavalo</td>
        <td>R$ {$valor_inicial_lote}</td>
    </tr>
</table>
EOD;
    $pdf->writeHTML($tbl, true, false, false, false, '');

    // Consulta de lances para o lote
    $sql_lances = "SELECT * FROM tb_lance WHERE tb_lote_id_lote = $id_lote ORDER BY valor_lance DESC LIMIT 10";
    $retorno_lances = conectarDB("select", $sql_lances, "", []);

    if (!empty($retorno_lances[1])) {
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Ln(5);
        $pdf->Cell(0, 8, "Lances:", 0, 1, 'L');

        // Criando tabela de lances
        $tbl_lances = <<<EOD
<table border="1" cellpadding="5">
    <tr>
        <th><b>Valor</b></th>
        <th><b>Usuário</b></th>
        <th><b>Email</b></th>
        <th><b>Data e Hora</b></th>
    </tr>
EOD;

        foreach ($retorno_lances[1] as $dados_lance) {
            $valor_lance = number_format($dados_lance['valor_lance'], 2, ',', '.');
            $id_usuario = $dados_lance['tb_usuario_id_usuario'];
            $data_lance = $dados_lance['data_lance'];

            $sql_dados_user = "SELECT * FROM tb_usuario WHERE id_usuario = $id_usuario";
            $retorno_usuario = conectarDB("select", $sql_dados_user, "", []);
            $dados_usuario = $retorno_usuario[1][0];
            $nome_user = $dados_usuario['nome_usuario'];
            $email_user = $dados_usuario['email_usuario'];

            // Formatar data no estilo "25 de novembro às 15hs e 43min"
            $objeto_data = new DateTime($data_lance);
            $dia = $objeto_data->format('d');
            $mes = $objeto_data->format('m');
            $hora = $objeto_data->format('H');
            $minuto = $objeto_data->format('i');

            $meses = [
                '01' => 'janeiro', '02' => 'fevereiro', '03' => 'março',
                '04' => 'abril', '05' => 'maio', '06' => 'junho',
                '07' => 'julho', '08' => 'agosto', '09' => 'setembro',
                '10' => 'outubro', '11' => 'novembro', '12' => 'dezembro'
            ];
            $mes_extenso = $meses[$mes];
            $data_formatada = "$dia de $mes_extenso às ${hora}hs e ${minuto}min";

            $tbl_lances .= <<<EOD
    <tr>
        <td>R$ $valor_lance</td>
        <td>$nome_user</td>
        <td>$email_user</td>
        <td>$data_formatada</td>
    </tr>
EOD;
        }

        $tbl_lances .= "</table>";
        $pdf->writeHTML($tbl_lances, true, false, false, false, '');
    } else {
        $pdf->Cell(0, 8, "Sem lances registrados.", 0, 1, 'L');
    }
}

// Saída do PDF
$pdf->Output('relatorio_lotes.pdf', 'I');
?>
