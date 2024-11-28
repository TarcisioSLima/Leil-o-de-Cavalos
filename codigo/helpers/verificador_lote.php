<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';

$sql_att_lote = "UPDATE tb_lote
SET estado_lote = 'Encerrado' 
WHERE estado_lote = 'Ativo' AND data_fechamento <= NOW() - INTERVAL 5 DAY";

conectarDB("insert_update", $sql_att_lote);

$sql_cavalo_att = "UPDATE tb_cavalo 
SET situacao_cavalo = 'Vendido' 
WHERE id_cavalo IN (
    SELECT tb_cavalo_id_cavalo 
    FROM tb_lote 
    WHERE estado_lote = 'Encerrado')";
    
conectarDB("insert_update", $sql_cavalo_att);


?>