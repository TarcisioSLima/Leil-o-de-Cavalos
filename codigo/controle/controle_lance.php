<?php

/**
 * Controle de Lances
 * 
 * Este arquivo contém as operações relacionadas ao gerenciamento de lances.
 * 
 * @file controle_lances.php
 * @requires ../db/conexao.php                Arquivo para conexão com o banco de dados.
 * @requires ../helpers/redirecionamento.php  Função de redirecionamento.
 * @requires ../helpers/verificador_lote.php  Verifica condições relacionadas ao lote.
 * 
 * @autor Tarcísio <seu_email@example.com>
 */

// Inclusão dos arquivos necessários para o funcionamento do sistema
include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php'; // Conexão com o banco de dados.
require_once "../helpers/redirecionamento.php";           // Redirecionamento de páginas.
include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/verificador_lote.php'; // Verificação de condições do lote.

// Captura a ação enviada na requisição
$action = $_REQUEST['action'];

// Controle de fluxo para tratar diferentes ações relacionadas aos lances
switch ($action) {

    // Caso para visualizar lances (implementação futura)
    case 'ver_lances':
        // Aqui seriam adicionadas funcionalidades relacionadas à visualização de lances.
        break;

    // Caso para registrar um novo lance
    case 'n_lance':
        /**
         * Registro de um novo lance
         * 
         * @var int $lance_usuario Valor do lance informado pelo usuário
         */
        $lance_usuario = $_REQUEST['lance_usuario'];

        // Inicia a sessão para acessar informações do usuário e do lote
        session_start();

        /**
         * Busca informações do lote associado ao cavalo selecionado
         * 
         * @var array $retorno_2 Resultado da consulta ao banco de dados
         */
        $sql_2 = "SELECT * FROM tb_lote WHERE tb_cavalo_id_cavalo = ?";
        $retorno_2 = conectarDB("select", $sql_2, "i", [$_SESSION['id_cavalo']]);

        if (sizeof($retorno_2[1]) > 0) {
            // Captura os dados do lote
            $dados_2 = $retorno_2[1][0];
            $id_lote = $dados_2["id_lote"];                   // Identificador do lote
            $valor_inicial_lote = $dados_2["valor_lote"];     // Valor inicial do lote
            $data_de_fechamento = $dados_2["data_fechamento"]; // Data de fechamento do lote

            /**
             * Busca o maior lance atual do lote
             * 
             * @var array $retorno_3 Resultado da consulta ao banco de dados
             */
            $sql = "SELECT * FROM tb_lance WHERE tb_lote_id_lote = ? ORDER BY valor_lance";
            $retorno_3 = conectarDB("select", $sql, "i", [$id_lote]);

            // Determina o valor do lance atual (o maior já registrado ou o valor inicial do lote)
            if (sizeof($retorno_3[1]) == 0) {
                $lance_atual = $valor_inicial_lote;
            } else {
                $indice = sizeof($retorno_3[1]) - 1;
                $dados = $retorno_3[1][$indice];
                $lance_atual = $dados["valor_lance"];
            }
        }

        // Verifica o valor do lance informado e ajusta conforme as regras
        if ($lance_usuario >= 1 && $lance_usuario <= 5) {
            switch ($lance_usuario) {
                case 1:
                    $lance_usuario = $lance_atual + (100 * 1);
                    break;
                case 2:
                    $lance_usuario = $lance_atual + (100 * 2);
                    break;
                case 3:
                    $lance_usuario = $lance_atual + (100 * 3);
                    break;
                case 4:
                    $lance_usuario = $lance_atual + (100 * 4);
                    break;
                case 5:
                    $lance_usuario = $lance_atual + (100 * 5);
                    break;
                default:
                    // Não há ação para valores fora do intervalo de 1 a 5
                    break;
            }
        }

        // Valida se o lance atende ao requisito mínimo de incremento
        if ($lance_usuario >= ($lance_atual + 100)) {
            $data_de_lance = date('Y-m-d H:i:s'); // Captura a data e hora do lance

            // Insere o novo lance no banco de dados
            $sql = "INSERT INTO tb_lance VALUES(NULL, ?, ?, ?, ?)";
            conectarDB("insert_update", $sql, "dsii", [$lance_usuario, $data_de_lance, $_SESSION['id_usuario'], $id_lote]);

            // Redireciona para a página inicial após o sucesso
            redirecionar("pagina_inicial", "");
        } elseif ($lance_usuario < ($lance_atual + 100)) {
            // Redireciona para a página inicial caso o lance não atenda ao requisito
            redirecionar("pagina_inicial", "");
        }
        break;

    // Caso padrão para ações não reconhecidas
    default:
        // Ações não especificadas podem ser tratadas aqui
        break;
}
?>
