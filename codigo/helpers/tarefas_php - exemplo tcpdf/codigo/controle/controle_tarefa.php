<?php

    include_once('../db/conexao.php');

    $action = $_REQUEST['action'];

    switch ($action) {
        case 'insert':
            $titulo = $_REQUEST['titulo'];
            $descricao = $_REQUEST['descricao'];
            $data_inicio = $_REQUEST['data_inicio'];
            $data_conclusao = $_REQUEST['data_conclusao'];
            $prioridade = $_REQUEST['prioridade'];

            $sql = "INSERT INTO tb_tarefa VALUES (NULL, ?, ?, ?, ?, ?, 1) ";

            $retorno = executarSQL($sql, "sssss",[$titulo, $descricao, $data_inicio, $data_conclusao, $prioridade]);

            if ($retorno) {
                echo "Deu certo!";
            } else {
                echo "Deu ruim!";
            };
            break;
        
        case 'delete':
            $id = $_REQUEST['id'];
            $sql = "DELETE FROM tb_tarefa WHERE id_tarefa = ? ";
            $retorno = executarSQL($sql, "i", [$id]);
            if ($retorno) {
                echo "Deu certo!";
            } else {
                echo "Deu ruim!";
            };
            break;

        case 'update':
            $titulo = $_REQUEST['titulo'];
            $descricao = $_REQUEST['descricao'];
            $data_inicio = $_REQUEST['data_inicio'];
            $data_conclusao = $_REQUEST['data_conclusao'];
            $prioridade = $_REQUEST['prioridade'];
            $id = $_REQUEST['id'];

            $sql = "UPDATE tb_tarefa SET id_tarefa	= ?, titulo = ?, descricao = ?, data_inicio = ?, data_conclusao = ?, prioridade = ? WHERE id_tarefa = ?";

            $retorno = executarSQL($sql, "isssssi", [$id, $titulo, $descricao, $data_inicio, $data_conclusao, $prioridade, $id]);

            if ($retorno) {
                echo "Deu certo!";
            } else {
                echo "Deu ruim!";
            };
            break;

        default:
            #erro e retorna
            break;
    }



    
    
?>