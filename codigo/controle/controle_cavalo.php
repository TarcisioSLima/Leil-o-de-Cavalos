<?php

/**
 * Controle de Cavalos
 * 
 * Este arquivo contém todas as funções relacionadas ao gerenciamento de cavalos.
 * 
 * @file controle_cavalo.php
 * @requires ../db/conexao.php
 * @requires ../helpers/redirecionamento.php
 * @autor Tarcísio <tarcisio.pesquisa.estudo@gmail.com>
 * 
 */

require_once "../db/conexao.php";
require_once "../helpers/redirecionamento.php";
include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/verificador_lote.php';

/**
 * @var string $case Ação a ser executada
 */
$case = $_REQUEST['caso'];

/**
 * Controle de fluxo das operações de cavalo
 */
switch ($case) {
    
    case 'cadastro':
        /**
         * Cadastro de um novo cavalo
         * 
         * @var string nome_cavalo             Nome do cavalo
         * @var string raca_cavalo             Raça do cavalo
         * @var string pelagem_cavalo          Cor da pelagem do cavalo
         * @var float  premio_cavalo           Valor do prêmio associado ao cavalo
         * @var string modalidade_cavalo       Modalidade esportiva do cavalo
         * @var string view                    Nome da visão para redirecionamento
         * @var string pasta_server            Caminho da pasta para salvar imagem no servidor
         * @var string pasta_banco             Caminho da imagem para salvar no banco de dados
         * @var string arquivo_servidor_cavalo Caminho completo do arquivo no servidor
         * @var string arquivo_banco_cavalo    Caminho da imagem a ser armazenado no banco de dados
         */
        $nome_cavalo = $_REQUEST["nome_cavalo"];
        $raca_cavalo = $_REQUEST["raca_cavalo"];
        $pelagem_cavalo = $_REQUEST["pelagem_cavalo"];
        $premio_cavalo = $_REQUEST["premio_cavalo"];
        $modalidade_cavalo = $_REQUEST["modalidade_cavalo"];
        $view = $_REQUEST['view'];

        $pasta_server = $_SERVER['DOCUMENT_ROOT'].'/public/assets/img/';
        $pasta_banco = "/public/assets/img/";

        $extensao_imagem_cavalo = "." . pathinfo($_FILES['imagem_cavalo']['name'], PATHINFO_EXTENSION);
        $novo_nome_cavalo = time() . md5(uniqid()) . rand(1,100);
        $arquivo_servidor_cavalo = $pasta_server . $novo_nome_cavalo . $extensao_imagem_cavalo;
        $arquivo_banco_cavalo = $pasta_banco . $novo_nome_cavalo . $extensao_imagem_cavalo;

        move_uploaded_file($_FILES['imagem_cavalo']['tmp_name'], $arquivo_servidor_cavalo);

        $sql = "INSERT INTO tb_cavalo VALUES (NULL, ?, ?, ?, ?, DEFAULT, ?, DEFAULT, ?)";
        $retorno = conectarDB("insert_update", $sql, "ssssss",
            [$nome_cavalo, $raca_cavalo, $pelagem_cavalo, $premio_cavalo, $modalidade_cavalo, $arquivo_banco_cavalo]
        );

        /** Redireciona para a visão especificada */
        redirecionar("index_cavalo", $view);
        break;

    case 'proposta':
        /**
         * Manipulação de propostas
         * 
         * @var int id_cavalo Identificador do cavalo
         */
        $id_cavalo = $_REQUEST['id_cavalo'];
        // Aqui entrariam as operações relacionadas às propostas de compra/venda do cavalo
        break;

    case 'editar':
        /**
         * Edição dos dados do cavalo
         * 
         * @var int    id_cavalo           Identificador do cavalo
         * @var string destaque            Status de destaque do cavalo
         */
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
            $novo_nome_cavalo = time() . md5(uniqid()) . rand(1,100);
            $arquivo_servidor_cavalo = $pasta_server . $novo_nome_cavalo . $extensao_imagem_cavalo;
            $arquivo_banco_cavalo = $pasta_banco . $novo_nome_cavalo . $extensao_imagem_cavalo;

            move_uploaded_file($_FILES['imagem_cavalo']['tmp_name'], $arquivo_servidor_cavalo);

            $sql = "UPDATE tb_cavalo SET nome_cavalo = ?, raca_cavalo = ?, pelagem_cavalo = ?, premio_cavalo = ?, destaque = ?, modalidade_cavalo = ?, img_cavalo = ? WHERE id_cavalo = ?";
            conectarDB("insert_update", $sql, "sssssssi", [$nome_cavalo, $raca_cavalo, $pelagem_cavalo, $premio_cavalo, $destaque, $modalidade_cavalo, $arquivo_banco_cavalo, $id_cavalo]);
        } else {
            $sql = "UPDATE tb_cavalo SET nome_cavalo = ?, raca_cavalo = ?, pelagem_cavalo = ?, premio_cavalo = ?, destaque = ?, modalidade_cavalo = ? WHERE id_cavalo = ?";
            conectarDB("insert_update", $sql, "ssssssi", [$nome_cavalo, $raca_cavalo, $pelagem_cavalo, $premio_cavalo, $destaque, $modalidade_cavalo, $id_cavalo]);
        }

        /** Redireciona para a visão especificada */
        redirecionar("index_cavalo", $view);
        break;

    case 'anunciar':
        /**
         * Anúncio de venda ou destaque do cavalo
         * 
         * @var int id_cavalo Identificador do cavalo
         */
        $id_cavalo = $_REQUEST['id_cavalo'];
        // Código para anunciar o cavalo
        break;

    case 'remover':
        /**
         * Remoção de cavalo do sistema
         * 
         * A remoção só ocorre se o cavalo estiver com status de "Vendido".
         * 
         * @var int    id_cavalo         Identificador do cavalo
         * @var string situacao_cavalo   Situação do cavalo (deve ser "Vendido" para exclusão)
         */
        $id_cavalo = $_REQUEST['id_cavalo'];
        $view = $_REQUEST['view'];

        $sql = "SELECT situacao_cavalo FROM tb_cavalo WHERE id_cavalo = ?";
        $retorno = conectarDB("select", $sql, "i", [$id_cavalo]);
        $dados = $retorno[1][0];
        $situacao_cavalo = $dados["situacao_cavalo"];

        if ($situacao_cavalo == "Vendido") {
            $sql = "DELETE FROM tb_cavalo WHERE id_cavalo = ?";
            conectarDB("insert_update", $sql, "i", [$id_cavalo]);
        }

        /** Redireciona para a visão especificada */
        redirecionar("index_cavalo", $view);
        break;

    case 'a_destaque':
        $id_cavalo = $_REQUEST['id_cavalo'];
        $view = $_REQUEST['view'];

        $sql = "UPDATE tb_cavalo SET destaque = 'Sim' WHERE id_cavalo = ?";
        conectarDB("insert_update", $sql, 'i', [$id_cavalo]);
        redirecionar('index_cavalo', $view);

        break;
    case 'r_destaque':
        $id_cavalo = $_REQUEST['id_cavalo'];
        $view = $_REQUEST['view'];

        $sql = "UPDATE tb_cavalo SET destaque = 'Não' WHERE id_cavalo = ?";
        conectarDB("insert_update", $sql, 'i', [$id_cavalo]);
        redirecionar('index_cavalo', $view);
        break;
    default:
        /**
         * @ignore Caso não entre em nenhuma das opções acima
         */
        break;
}
?>