<?php
    require_once "../db/conexao.php";
    require_once "../helpers/redirecionamento.php";
    $case = $_REQUEST['caso'];
    $view = $_REQUEST['view'];

    switch ($case) {
           
        case 'cadastro':
            $titulo_lote = $_REQUEST["titulo_lote"];
            $valor_lote = $_REQUEST["valor_lote"];
            $data_fechamento = $_REQUEST["data_fechamento"];
            $estado_lote = $_REQUEST["estado_lote"];
            $id_cavalo = $_REQUEST["id_cavalo"];
            $sql = "INSERT INTO tb_lote VALUES (NULL, ?, ?, ?, ?, ?)";
            $retorno = conectarDB("insert_update", $sql, "ssssi",
            [$titulo_lote, $valor_lote, $data_fechamento, $estado_lote, $id_cavalo]);
            redirecionar("index_lote", "$view");
            break;    
    }


?>