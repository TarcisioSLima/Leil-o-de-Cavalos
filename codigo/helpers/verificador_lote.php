<?php
/**
 * Atualização de Lotes e Situação de Cavalos
 * 
 * Este script realiza a atualização do estado dos lotes para "Encerrado" e altera a situação dos cavalos
 * para "Vendido" quando o lote é encerrado.
 * 
 * @file atualizacao_lote.php
 * @requires /db/conexao.php       Conexão com o banco de dados.
 * 
 * @autor Tarcísio <tarcisio.pesquisa.estudo@gmail.com>
 */

// Inclusão da dependência de conexão com o banco de dados
include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';

// Atualiza o estado dos lotes que estão "Ativos" e cujo fechamento aconteceu há mais de 5 dias
$sql_att_lote = "UPDATE tb_lote
SET estado_lote = 'Encerrado' 
WHERE estado_lote = 'Ativo' AND data_fechamento <= NOW() - INTERVAL 5 DAY";

// Executa a atualização no banco de dados
conectarDB("insert_update", $sql_att_lote);

// Atualiza a situação dos cavalos associados aos lotes encerrados para "Vendido"
$sql_cavalo_att = "UPDATE tb_cavalo 
SET situacao_cavalo = 'Vendido' 
WHERE id_cavalo IN (
    SELECT tb_cavalo_id_cavalo 
    FROM tb_lote 
    WHERE estado_lote = 'Encerrado')";

// Executa a atualização no banco de dados para a tabela tb_cavalo
conectarDB("insert_update", $sql_cavalo_att);
?>
