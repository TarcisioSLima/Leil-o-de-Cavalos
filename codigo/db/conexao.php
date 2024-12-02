<?php

/**
 * Conexão e Operações com Banco de Dados
 * 
 * Este arquivo contém funções para conectar ao banco de dados MySQL e executar operações de consulta (select),
 * inserção e atualização (insert/update) com segurança usando prepared statements.
 * 
 * @file conexao.php
 * @autor Tarcísio <tarcisio.pesquisa.estudo@gmail.com>
 */

/**
 * Conecta ao banco de dados e executa uma operação SQL
 * 
 * @param string $tipo Tipo de operação SQL: 'select', 'insert_update' ou 'delete'
 * @param string $sql  Consulta SQL a ser executada
 * @param string|null $tipos_dados Tipos de dados dos parâmetros para binding (ex: 'ssi' para string, string, inteiro)
 * @param array|null $dados Parâmetros para binding na consulta SQL
 * 
 * @return mixed Retorna os resultados de uma consulta select ou o ID de inserção para insert/update
 */
function conectarDB($tipo, $sql, $tipos_dados = null, $dados = null) {
    // Parâmetros de conexão
    $servidor = "db";
    $usuario = "root";
    $senha = "123";
    $nome_banco = "db_quarter_horse";

    // Conexão com o banco de dados
    $conexao = mysqli_connect($servidor, $usuario, $senha, $nome_banco);

    switch ($tipo) {
        case 'select':
            return select($conexao, $sql, $tipos_dados, $dados);
        case 'insert_update':
            return insert_update($conexao, $sql, $tipos_dados, $dados);
        case 'delete':
            // Implementação futura
            break;
        default:
            return null;
    }
}

/**
 * Função de Seleção (SELECT) com prepared statement
 * 
 * @param object $conexao Conexão MySQL
 * @param string $sql Consulta SQL a ser executada
 * @param string|null $tipos_dados Tipos de dados dos parâmetros para binding
 * @param array|null $dados Parâmetros para binding na consulta SQL
 * 
 * @return array Retorna um array com status de execução e resultados da consulta
 */
function select($conexao, $sql, $tipos_dados = null, $dados = null) {
    $stmt = mysqli_prepare($conexao, $sql);

    // Associa parâmetros somente se forem fornecidos
    if (!empty($tipos_dados) && !empty($dados)) {
        mysqli_stmt_bind_param($stmt, $tipos_dados, ...$dados);
    }

    $retorno = mysqli_stmt_execute($stmt);
    $resultados = mysqli_stmt_get_result($stmt);

    if ($resultados) {
        $resultados = mysqli_fetch_all($resultados, MYSQLI_ASSOC);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);

    return [$retorno, $resultados];
}

/**
 * Função de Inserção/Atualização (INSERT/UPDATE) com prepared statement
 * 
 * @param object $conexao Conexão MySQL
 * @param string $sql Consulta SQL a ser executada
 * @param string|null $tipos_dados Tipos de dados dos parâmetros para binding
 * @param array|null $dados Parâmetros para binding na consulta SQL
 * 
 * @return int Retorna o ID do registro inserido (ou atualizado)
 */
function insert_update($conexao, $sql, $tipos_dados = null, $dados = null) {
    $stmt = mysqli_prepare($conexao, $sql);

    // Associa parâmetros somente se forem fornecidos
    if (!empty($tipos_dados) && !empty($dados)) {
        mysqli_stmt_bind_param($stmt, $tipos_dados, ...$dados);
    }

    mysqli_stmt_execute($stmt);

    $id = mysqli_stmt_insert_id($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);

    return $id;
}