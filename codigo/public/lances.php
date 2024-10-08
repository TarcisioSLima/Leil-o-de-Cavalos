<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/session_usuarios.php';
    session_start(); verificar_sessao("Cliente");

    $id_cavalo = $_REQUEST["id_cavalo"];
    
    // Lote {--------------------------------------------------------------
    $sql = "SELECT * FROM tb_lote WHERE tb_cavalo_id_cavalo	= ?";

    $retorno = conectarDB("select" , $sql, [$id_cavalo] ,"i");
    $dados = $retorno[1][0];
    $id_lote = $dados["id_lote"];
    $valor_inicial_lote = $dados["valor_lote"];
    $data_de_fechamento = $dados["data_de_fechamento"];
    $titulo_lote = $dados["titulo_lote"];

    // --------------------------------------------------------------------}
    // Maior Lance {-------------------------------------------------------------------
    $sql = "SELECT * FROM tb_lance WHERE tb_lote_id_lote = ? ORDER BY valor_lance";
    $retorno = conectarDB("select", $sql, [$id_lote], "i");
    $dados = $retorno[1][0];
    $maior_lance = $dados["valor_lance"];
    //--------------------------------------------------------------------------------}


?>

