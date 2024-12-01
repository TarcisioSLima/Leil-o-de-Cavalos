<?php

/**
 * Controle de Lotes
 * 
 * Este arquivo contém todas as funções relacionadas ao gerenciamento de lotes.
 * 
 * @file controle_lote.php
 * @requires ../db/conexao.php
 * @requires ../helpers/redirecionamento.php
 * 
 * @autor Samuel <samuelbatistadeb@gmail.com>
*/

require_once "../db/conexao.php";
require_once "../helpers/redirecionamento.php";
include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/verificador_lote.php';

/**
 * @var string case Ação a ser executada
 * @var string view Visão para redirecionamento
 */
$case = $_REQUEST['caso'];
$view = $_REQUEST['view'];

/**
 * Controle de fluxo das operações de lote
 */
switch ($case) {

    case 'cadastro':
        /** 
         * Cadastro de um novo lote
         * 
         * @var string  valor_lote       Valor do lote em formato monetário
         * @var string  data_fechamento  Data de fechamento do lote em formato brasileiro (dd/mm/yyyy)
         * @var string  estado_lote      Estado inicial do lote ("Ativo")
         * @var int     id_cavalo        Identificador do cavalo associado ao lote
         * @var string  dataParaInserir  Data formatada para o banco de dados (yyyy-mm-dd)
         * @var float   valor            Valor do lote convertido para formato numérico
         */
        $valor_lote = $_REQUEST['valor_lote'];
        $data_fechamento = $_REQUEST["data_fechamento"];
        $estado_lote = "Ativo";
        $id_cavalo = $_REQUEST["id_cavalo"];
        $dataParaInserir = DateTime::createFromFormat('d/m/Y', $data_fechamento)->format('Y-m-d');

        /** Converte o valor do lote de string monetária para float */
        $valor = str_replace(['R$', '.', ','], ['', '', '.'], $valor_lote);
        $valor = (float)$valor;

        /** Insere o novo lote no banco de dados */
        $sql = "INSERT INTO tb_lote VALUES (NULL, ?, ?, ?, ?)";
        $retorno = conectarDB("insert_update", $sql, "dssi", [$valor, $dataParaInserir, $estado_lote, $id_cavalo]);

         /** Atuliza o campo situacao_cavalo da tabela tb_cavalo no banco de dados */
         $situacao_cavalo = 'Ativo';
         $sql = "UPDATE  tb_cavalo SET situacao_cavalo = ? WHERE id_cavalo = ?";
         $retorno = conectarDB("insert_update", $sql, "si", [$situacao_cavalo, $id_cavalo]); 

        /** Redireciona para a visão especificada */
        redirecionar("index_lote", "$view");
        break;
}
?>