<?php
    require_once "../db/conexao.php";
    require_once "../helpers/redirecionamento.php";
    $case = $_REQUEST['caso'];

    switch ($case) {
        case 'destaque':
            $cavalo_d = $_REQUEST['cavalo_d'];
            $sql = "SELECT * FROM tb_cavalo WHERE destaque = 'Sim' ORDER BY id_cavalo";
            $retorno = conectarDB($sql);
            $contador = 1;
            $vetor = [];
            while ($dados = mysqli_fetch_array($retorno)) { 
                if ($contador = $cavalo_d) {
                    $vetor = [
                        $nome_cavalo = $dados["nome_cavalo"],
                        $raca_cavalo = $dados["raca_cavalo"],
                        $pelagem_cavalo = $dados["pelagem_cavalo"],
                        $premio_cavalo = $dados["premio_cavalo"],
                        $situacao_cavalo = $dados["situacao_cavalo"],
                        $modalidade_cavalo = $dados["modalidade_cavalo"],
                        $destaque = $dados["destaque"],
                        $img_cavalo = $dados["img_cavalo"]
                    ];
                }
                $contador += 1;

            }
            break;
        case 'destaque':
            # code...
            break;
        case 'destaque':
            # code...
            break;
        case 'destaque':
            # code...
            break;
        
        default:
            # code...
            break;
    }


?>