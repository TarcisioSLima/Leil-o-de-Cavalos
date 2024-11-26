<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';
    require_once "../helpers/redirecionamento.php";
    include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/verificador_lote.php';

$action = $_REQUEST['action'];

switch ($action) {
    case 'ver_lances':
        
    case 'n_lance':
        $lance_usuario = $_REQUEST['lance_usuario'];
        session_start();
        $sql_2 = "SELECT * FROM tb_lote WHERE tb_cavalo_id_cavalo = ?";
        $retorno_2 = conectarDB("select", $sql_2, "i", [$_SESSION['id_cavalo']]);
        if (sizeof($retorno_2[1]) > 0) {
            $dados_2 = $retorno_2[1][0];
            $id_lote = $dados_2["id_lote"];
            $valor_inicial_lote = $dados_2["valor_lote"];
            $data_de_fechamento = $dados_2["data_fechamento"];
        
            // --------------------------------------------------------------------}
            // Maior Lance {------------------------------------------------------------------
            $sql = "SELECT * FROM tb_lance WHERE tb_lote_id_lote = ? ORDER BY valor_lance";
            $retorno_3 = conectarDB("select", $sql, "i", [$id_lote]);
            if (sizeof($retorno_3[1]) == 0) {
                $lance_atual = $valor_inicial_lote;
                }else {
                $indice = sizeof($retorno_3[1]) -1;
                $dados = $retorno_3[1][$indice];
                $lance_atual = $dados["valor_lance"];
            }
        }   
            if ($lance_usuario >= 1 AND $lance_usuario <= 5) {
                switch ($lance_usuario) {
                    case 1:
                        $lance_usuario = $lance_atual + (100*1);
                        break;
                    case 2:
                        $lance_usuario = $lance_atual + (100*2);
                        break;
                    case 3:
                        $lance_usuario = $lance_atual + (100*3);
                        break;
                    case 4:
                        $lance_usuario = $lance_atual + (100*4);
                        break;
                    case 5:
                        $lance_usuario = $lance_atual + (100*5);
                        break;
                    
                    default:
                        
                        break;
                }
            }
            if ($lance_usuario >= ($lance_atual+100)) {
                $data_de_lance = date('Y-m-d H:i:s');
                $sql = "INSERT INTO tb_lance VALUES(NULL, ?, ?, ?, ?)";
                conectarDB("insert_update", $sql, "dsii", [$lance_usuario, $data_de_lance, $_SESSION['id_usuario'], $id_lote]);
                redirecionar("pagina_inicial","");
            }elseif ($lance_usuario < ($lance_atual+100)) {
                redirecionar("pagina_inicial", "");
            }
        break;
    
    default:
        # code...
        break;
}

    



    
    
        
            
    


    // --------------------------------------------------------------------------------------------------------------}
?>

