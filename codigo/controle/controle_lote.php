<?php
    require_once "../db/conexao.php";
    require_once "../helpers/redirecionamento.php";
    $case = $_REQUEST['caso'];
    $view = $_REQUEST['view'];

    switch ($case) {
           
        case 'cadastro':
            $valor_lote = $_REQUEST['valor_lote'];
            $data_fechamento = $_REQUEST["data_fechamento"];
            $estado_lote = "Ativo";
            $id_cavalo = $_REQUEST["id_cavalo"];
            $dataParaInserir = DateTime::createFromFormat('d/m/Y', $data_fechamento) ->format('Y-m-d');

            // if (isset($_REQUEST['valor'])) {
            //     $valor = $_REQUEST['valor'];
                
            //     // Remover o "R$", pontos e substituir a vírgula por ponto
            $valor = str_replace(['R$', '.', ','], ['', '', '.'], $valor_lote);
            
            // Converter o valor para float
            $valor = (float)$valor;
                
            // }

            $sql = "INSERT INTO tb_lote VALUES (NULL, ?, ?, ?, ?)";
            $retorno = conectarDB("insert_update", $sql, "dssi",
            [$valor, $dataParaInserir, $estado_lote, $id_cavalo]);
            redirecionar("index_lote", "$view");
            break;    
    }


?>  