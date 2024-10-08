<?php
    require_once "../db/conexao.php";
    require_once "../helpers/redirecionamento.php";
    $case = $_REQUEST['caso'];

    switch ($case) {
           
        case 'cadastro':
            $nome_cavalo = $_REQUEST["nome_cavalo"];
            $raca_cavalo = $_REQUEST["raca_cavalo"];
            $pelagem_cavalo = $_REQUEST["pelagem_cavalo"];
            $premio_cavalo = $_REQUEST["premio_cavalo"];
            $modalidade_cavalo = $_REQUEST["modalidade_cavalo"];
            
            $view = $_REQUEST['view'];

            $pasta_server = $_SERVER['DOCUMENT_ROOT'].'/public/assets/img/';
            $pasta_banco = "/public/assets/img/";

            $extensao_imagem_cavalo = "." . pathinfo($_FILES['imagem_cavalo']['name'], PATHINFO_EXTENSION);
            
            $novo_nome_cavalo = time(). md5(uniqid()) . rand(1,100);

            $arquivo_servidor_cavalo = $pasta_server . $novo_nome_cavalo . $extensao_imagem_cavalo;
            $arquivo_banco_cavalo = $pasta_banco . $novo_nome_cavalo . $extensao_imagem_cavalo;
            
            move_uploaded_file($_FILES['imagem_cavalo']['tmp_name'], $arquivo_servidor_cavalo);
            
            $sql = "INSERT INTO tb_cavalo VALUES (NULL, ?, ?, ?, ?, DEFAULT, ?, DEFAULT, ?)";
            $retorno = conectarDB("insert_update", $sql, "ssssss",
            [$nome_cavalo, $raca_cavalo, $pelagem_cavalo, $premio_cavalo, $modalidade_cavalo, $arquivo_banco_cavalo]);
            redirecionar("index_cavalo", "$view");
            break;
        case 'proposta':
            $id_cavalo = $_REQUEST['id_cavalo'];
            
            
            break;
        case 'editar':
            $id_cavalo = $_REQUEST['id_cavalo'];
            $nome_cavalo = $_REQUEST["nome_cavalo"];
            $raca_cavalo = $_REQUEST["raca_cavalo"];
            $pelagem_cavalo = $_REQUEST["pelagem_cavalo"];
            $premio_cavalo = $_REQUEST["premio_cavalo"];
            $modalidade_cavalo = $_REQUEST["modalidade_cavalo"];
            $destaque = $_REQUEST['destaque'];
            $view = $_REQUEST['view'];
            if (isset($_REQUEST['img'])) {
                
                $pasta_server = $_SERVER['DOCUMENT_ROOT'].'/public/assets/img/';
                $pasta_banco = "/public/assets/img/";
    
                $extensao_imagem_cavalo = "." . pathinfo($_FILES['imagem_cavalo']['name'], PATHINFO_EXTENSION);
                
                $novo_nome_cavalo = time(). md5(uniqid()) . rand(1,100);
    
                $arquivo_servidor_cavalo = $pasta_server . $novo_nome_cavalo . $extensao_imagem_cavalo;
                $arquivo_banco_cavalo = $pasta_banco . $novo_nome_cavalo . $extensao_imagem_cavalo;
                
                move_uploaded_file($_FILES['imagem_cavalo']['tmp_name'], $arquivo_servidor_cavalo);

                $sql = "UPDATE tb_cavalo SET
                nome_cavalo = ?, raca_cavalo = ?, pelagem_cavalo = ?, premio_cavalo = ?, destaque = ?, modalidade_cavalo = ?, img_cavalo = ?
                WHERE id_cavalo = ?";
                conectarDB("insert_update", $sql, "sssssssi", 
                [$nome_cavalo, $raca_cavalo, $pelagem_cavalo, $premio_cavalo, $destaque, $modalidade_cavalo, $arquivo_banco_cavalo, $id_cavalo]);
                redirecionar("index_cavalo", $view);
            }else{
                $sql = "UPDATE tb_cavalo SET
                nome_cavalo = ?, raca_cavalo = ?, pelagem_cavalo = ?, premio_cavalo = ?, destaque = ?, modalidade_cavalo = ?
                WHERE id_cavalo = ?";
                conectarDB("insert_update", $sql, "ssssssi", 
                [$nome_cavalo, $raca_cavalo, $pelagem_cavalo, $premio_cavalo, $destaque, $modalidade_cavalo, $id_cavalo]);
                redirecionar("index_cavalo", $view);
            }
            break;
        case 'anunciar':
            $id_cavalo = $_REQUEST['id_cavalo'];

            break;
        case 'remover':
            
            // Parte que faz com que o cavalo só seja excluido se ja estiver sido vendido. {-----
            $id_cavalo = $_REQUEST['id_cavalo'];
            $view =  $_REQUEST['view'];
            
            
            $sql = "SELECT situacao_cavalo FROM tb_cavalo WHERE id_cavalo = ?";
            $retorno = conectarDB("select", $sql, [$id_cavalo], "i");
            $dados =  $retorno[1][0];
            $situacao_cavalo = $dados["situacao_cavalo"];
            if ($situacao_cavalo == "Vendido") {
            // ----------------------------------------------------------------------------------}
                $sql = "DELETE FROM tb_cavalo WHERE id_cavalo = ? ";
                conectarDB("insert_update", $sql, "i", [$id_cavalo]);
                redirecionar("index_cavalo", $view);
            }else redirecionar("index_cavalo", $view);
            break;
        
        default:
            # code...
            break;
    }


?>