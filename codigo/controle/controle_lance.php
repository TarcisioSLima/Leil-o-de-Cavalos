<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';

$action = $_REQUEST['action'];

switch ($action) {
    case 'ver_lances':
        //Essa parte é responsável por mostrar os dados do lote, quando fecha, valor atual e titulo. {---------------------

    $id_cavalo = $_REQUEST["id_cavalo"];
    
    // Lote {--------------------------------------------------------------
    $sql = "SELECT * FROM tb_lote WHERE tb_cavalo_id_cavalo	= ?";
    $retorno = conectarDB("select", $sql, "i", [$id_cavalo]);
    if (sizeof($retorno[1]) > 0) {
        $dados = $retorno[1][0];
        $id_lote = $dados["id_lote"];
        $valor_inicial_lote = $dados["valor_lote"];
        $data_de_fechamento = $dados["data_fechamento"];
    
        echo "<pre>";
        print_r($dados);
        echo "</pre>";
    
        // --------------------------------------------------------------------}
        // Maior Lance {------------------------------------------------------------------
        $sql = "SELECT * FROM tb_lance WHERE tb_lote_id_lote = ? ORDER BY valor_lance";
        $retorno = conectarDB("select", $sql, "i", [$id_lote]);
        if (sizeof($retorno[1]) == 0) {
            $lance_atual = $valor_inicial_lote;
        }else {
            $dados = $retorno[1][0];
            $lance_atual = $dados["valor_lance"];
        }
        //--------------------------------------------------------------------------------}
        
        echo "<pre>";
        print_r($lance_atual);
        echo "</pre>";
        //-------------------------------------------------------------------------------------------------------------------}
    
     //Essa parte é responsável pela lógica de dar os lances no cavalo.{--------------------------------------------------
        //Leve em consideração que é necessário que o Cliente tenha dado um valor em um formulário
            //Esse valor precisa ser > do que o valor atual do lote. 
                //que pode ser tanto o maior lance do usuário ou incial caso não tenha nenhum lance ainda 
        //O Cliente só pode confirmar o lance obedecendo os parametros acima e após confirmar senha.
        }elseif (sizeof($retorno[1]) == 0) {
            echo "Esse Cavalo não está a lote!";
        }
        break;
    case 'n_lance':
        $lance_usuario = $_REQUEST['lance_usuario'];
    
            if ($lance_usuario > $lance_atual) {
                $sql = "INSERT INTO tb_lance VALUES( )";
            }
        break;
    
    default:
        # code...
        break;
}

    



    
    
        
            
    


    // --------------------------------------------------------------------------------------------------------------}
?>

