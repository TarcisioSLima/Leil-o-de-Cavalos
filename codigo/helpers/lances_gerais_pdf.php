<?php

/**
 * Geração de Relatório de Lotes
 * 
 * Este script cria um relatório em PDF detalhado sobre os lotes e lances registrados no sistema.
 * 
 * @file relatorio_lotes.php
 * @requires ./pdf/tcpdf.php       Biblioteca TCPDF para geração de PDFs.
 * @requires /db/conexao.php       Conexão com o banco de dados.
 * 
 * @autor Tarcísio <seu_email@example.com>
 */

// Inclusão das dependências
require_once './pdf/tcpdf.php';                  // Biblioteca TCPDF para criação do PDF.
require_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php'; // Conexão com o banco de dados.

// Criação do objeto TCPDF
$pdf = new TCPDF();

// Configurações iniciais do PDF
$pdf->SetCreator(PDF_CREATOR);               // Criador do PDF.
$pdf->SetAuthor('Nome do Autor');            // Autor do relatório.
$pdf->SetTitle('Relatório de Lotes');        // Título do documento.
$pdf->SetSubject('Relatório Detalhado de Lotes'); // Assunto do relatório.
$pdf->SetKeywords('PDF, Relatório, Lotes'); // Palavras-chave associadas ao relatório.

// Configuração das margens e layout
$pdf->SetMargins(15, 20, 15); // Margens do documento (esquerda, superior, direita).
$pdf->SetHeaderMargin(10);    // Margem do cabeçalho.
$pdf->SetFooterMargin(10);    // Margem do rodapé.
$pdf->setPrintHeader(false);  // Desabilita o cabeçalho.
$pdf->setPrintFooter(true);   // Habilita o rodapé.

// Consulta para buscar todos os lotes cadastrados
$sql_lotes = "SELECT * FROM tb_lote ORDER BY data_fechamento";
$retorno_lotes = conectarDB("select", $sql_lotes, "", []);

// Itera sobre os lotes retornados para gerar páginas no PDF
foreach ($retorno_lotes[1] as $dados_lote) {
    // Adiciona uma nova página para o lote atual
    $pdf->AddPage();

    // Captura os dados do lote
    $id_lote = $dados_lote['id_lote'];
    $valor_inicial_lote = $dados_lote['valor_lote'];
    $id_cavalo = $dados_lote['tb_cavalo_id_cavalo'];

    // Consulta para obter detalhes do cavalo associado ao lote
    $sql_cavalo = "SELECT * FROM tb_cavalo WHERE id_cavalo = $id_cavalo";
    $retorno_cavalo = conectarDB("select", $sql_cavalo, "", []);
    $dados_cavalo = $retorno_cavalo[1][0];
    $nome_cavalo = $dados_cavalo['nome_cavalo'];
    $raca_cavalo = $dados_cavalo['raca_cavalo'];
    $destaque = $dados_cavalo['destaque'];
    $premio_cavalo = $dados_cavalo['premio_cavalo'];

    // Adiciona o título do lote
    $pdf->SetFont('helvetica', 'B', 16);
    $pdf->Cell(0, 10, "Lote #$id_lote - $nome_cavalo", 0, 1, 'C');
    $pdf->Ln(5);

    // Adiciona uma tabela com as informações do lote
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

    // Consulta para buscar os lances associados ao lote atual
    $sql_lances = "SELECT * FROM tb_lance WHERE tb_lote_id_lote = $id_lote ORDER BY valor_lance DESC LIMIT 10";
    $retorno_lances = conectarDB("select", $sql_lances, "", []);

    if (!empty($retorno_lances[1])) {
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Ln(5);
        $pdf->Cell(0, 8, "Lances:", 0, 1, 'L');

        // Cria uma tabela para exibir os lances
        $tbl_lances = <<<EOD
<table border="1" cellpadding="5">
    <tr>
        <th><b>Valor</b></th>
        <th><b>Usuário</b></th>
        <th><b>Email</b></th>
        <th><b>Data e Hora</b></th>
    </tr>
EOD;

        // Itera sobre os lances retornados
        foreach ($retorno_lances[1] as $dados_lance) {
            $valor_lance = number_format($dados_lance['valor_lance'], 2, ',', '.');
            $id_usuario = $dados_lance['tb_usuario_id_usuario'];
            $data_lance = $dados_lance['data_lance'];

            // Consulta para buscar informações do usuário que fez o lance
            $sql_dados_user = "SELECT * FROM tb_usuario WHERE id_usuario = $id_usuario";
            $retorno_usuario = conectarDB("select", $sql_dados_user, "", []);
            $dados_usuario = $retorno_usuario[1][0];
            $nome_user = $dados_usuario['nome_usuario'];
            $email_user = $dados_usuario['email_usuario'];

            // Formata a data no estilo "25 de novembro às 15hs e 43min"
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

// Gera o arquivo PDF e o envia ao navegador
$pdf->Output('relatorio_lotes.pdf', 'I');
?>
