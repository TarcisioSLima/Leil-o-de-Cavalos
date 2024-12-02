<?php
/**
 * Geração de Relatório do Lote
 * 
 * Este script gera um relatório detalhado em PDF sobre o lote especificado, incluindo informações do lote, cavalo e os lances registrados.
 * 
 * @file relatorio_lote.php
 * @requires ./pdf/tcpdf.php      Biblioteca TCPDF para criação de PDF.
 * @requires /db/conexao.php      Conexão com o banco de dados.
 * 
 * @autor Tarcísio <seu_email@example.com>
 */

// Inclusão das dependências
require_once './pdf/tcpdf.php'; // Biblioteca TCPDF para criação do PDF.
require_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php'; // Conexão com o banco de dados.

// Captura do ID do lote via requisição GET ou POST
$id_lote = $_REQUEST['id']; // ID do lote que será gerado o relatório

// Criação do objeto TCPDF para geração do PDF
$pdf = new TCPDF();

// Configurações do documento PDF
$pdf->SetCreator(PDF_CREATOR);  // Definindo o criador do PDF.
$pdf->SetAuthor('Relatório');   // Autor do relatório.
$pdf->SetTitle("Relatório do Lote #$id_lote"); // Título do PDF.
$pdf->SetMargins(15, 20, 15);   // Definindo margens esquerda, superior e direita.
$pdf->SetHeaderMargin(10);      // Margem do cabeçalho.
$pdf->SetFooterMargin(10);      // Margem do rodapé.
$pdf->setPrintHeader(false);    // Desabilita o cabeçalho.
$pdf->setPrintFooter(true);     // Habilita o rodapé.

$pdf->AddPage(); // Adiciona uma nova página ao PDF

// Consulta para buscar o lote com base no ID
$sql_lote = "SELECT * FROM tb_lote WHERE id_lote = ?"; // Consulta para pegar dados do lote
$retorno_lote = conectarDB("select", $sql_lote, "i", [$id_lote]); // Executa a consulta com o ID do lote

// Verifica se o lote foi encontrado
if (!empty($retorno_lote[1])) {
    $dados_lote = $retorno_lote[1][0]; // Captura os dados do lote
    $valor_inicial_lote = $dados_lote['valor_lote']; // Valor inicial do lote
    $id_cavalo = $dados_lote['tb_cavalo_id_cavalo']; // ID do cavalo associado ao lote

    // Consulta para obter informações do cavalo associado ao lote
    $sql_cavalo = "SELECT * FROM tb_cavalo WHERE id_cavalo = ?"; // Consulta para pegar dados do cavalo
    $retorno_cavalo = conectarDB("select", $sql_cavalo, "i", [$id_cavalo]); // Executa a consulta para pegar os dados do cavalo
    $dados_cavalo = $retorno_cavalo[1][0]; // Dados do cavalo
    $nome_cavalo = $dados_cavalo['nome_cavalo']; // Nome do cavalo
    $raca_cavalo = $dados_cavalo['raca_cavalo']; // Raça do cavalo
    $destaque = $dados_cavalo['destaque']; // Destaque do cavalo
    $premio_cavalo = $dados_cavalo['premio_cavalo']; // Prêmio associado ao cavalo

    // Título do lote no PDF
    $pdf->SetFont('helvetica', 'B', 16); // Define a fonte do título
    $pdf->Cell(0, 10, "Lote #$id_lote - $nome_cavalo", 0, 1, 'C'); // Exibe o título no centro
    $pdf->Ln(5); // Adiciona uma linha em branco

    // Criação de uma tabela com informações do lote
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
    $pdf->writeHTML($tbl, true, false, false, false, ''); // Escreve a tabela no PDF

    // Consulta para obter os lances do lote
    $sql_lances = "SELECT * FROM tb_lance WHERE tb_lote_id_lote = ? ORDER BY valor_lance DESC LIMIT 10"; // Consulta para pegar os lances
    $retorno_lances = conectarDB("select", $sql_lances, "i", [$id_lote]); // Executa a consulta para pegar os lances

    // Verifica se há lances registrados
    if (!empty($retorno_lances[1])) {
        $pdf->SetFont('helvetica', 'B', 12); // Define a fonte para a seção de lances
        $pdf->Ln(5); // Adiciona uma linha em branco
        $pdf->Cell(0, 8, "Lances:", 0, 1, 'L'); // Exibe o título "Lances"

        // Criação da tabela para exibir os lances
        $tbl_lances = <<<EOD
<table border="1" cellpadding="5">
    <tr>
        <th><b>Valor</b></th>
        <th><b>Usuário</b></th>
        <th><b>Email</b></th>
        <th><b>Data e Hora</b></th>
    </tr>
EOD;

        // Itera sobre os lances para preencher a tabela
        foreach ($retorno_lances[1] as $dados_lance) {
            $valor_lance = number_format($dados_lance['valor_lance'], 2, ',', '.'); // Formata o valor do lance
            $id_usuario = $dados_lance['tb_usuario_id_usuario']; // ID do usuário que fez o lance
            $data_lance = $dados_lance['data_lance']; // Data do lance

            // Consulta para pegar os dados do usuário que fez o lance
            $sql_usuario = "SELECT * FROM tb_usuario WHERE id_usuario = ?"; // Consulta para pegar os dados do usuário
            $retorno_usuario = conectarDB("select", $sql_usuario, "i", [$id_usuario]); // Executa a consulta
            $dados_usuario = $retorno_usuario[1][0]; // Dados do usuário
            $nome_user = $dados_usuario['nome_usuario']; // Nome do usuário
            $email_user = $dados_usuario['email_usuario']; // Email do usuário

            // Formatação da data e hora do lance
            $objeto_data = new DateTime($data_lance); // Cria um objeto DateTime para formatar a data
            $dia = $objeto_data->format('d'); // Dia
            $mes = $objeto_data->format('m'); // Mês
            $hora = $objeto_data->format('H'); // Hora
            $minuto = $objeto_data->format('i'); // Minuto

            // Mapeamento dos meses para formato por extenso
            $meses = [
                '01' => 'janeiro', '02' => 'fevereiro', '03' => 'março',
                '04' => 'abril', '05' => 'maio', '06' => 'junho',
                '07' => 'julho', '08' => 'agosto', '09' => 'setembro',
                '10' => 'outubro', '11' => 'novembro', '12' => 'dezembro'
            ];
            $mes_extenso = $meses[$mes]; // Mês por extenso
            $data_formatada = "$dia de $mes_extenso às ${hora}hs e ${minuto}min"; // Data formatada

            // Preenche a tabela de lances
            $tbl_lances .= <<<EOD
    <tr>
        <td>R$ $valor_lance</td>
        <td>$nome_user</td>
        <td>$email_user</td>
        <td>$data_formatada</td>
    </tr>
EOD;
        }

        $tbl_lances .= "</table>"; // Fecha a tabela de lances
        $pdf->writeHTML($tbl_lances, true, false, false, false, ''); // Escreve a tabela de lances no PDF
    } else {
        $pdf->Cell(0, 8, "Sem lances registrados.", 0, 1, 'L'); // Caso não haja lances, informa que não há lances registrados
    }
} else {
    $pdf->Cell(0, 10, "Lote não encontrado.", 0, 1, 'C'); // Caso o lote não seja encontrado, exibe mensagem de erro
}

// Gera e envia
