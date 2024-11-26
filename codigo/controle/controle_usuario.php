<?php

/**
 * Controle de Usuários
 * 
 * Este arquivo contém todas as funções relacionadas ao gerenciamento de usuários, incluindo login, logout, cadastro e atualização de informações.
 * 
 * @file controle_usuario.php
 * @requires ../db/conexao.php
 * @requires ../helpers/redirecionamento.php
 */

require_once "../db/conexao.php";
require_once "../helpers/redirecionamento.php";
include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/verificador_lote.php';

/**
 * @var string case Ação a ser executada
 */
$case = $_REQUEST['caso'];

/**
 * Controle de fluxo das operações de usuário
 */
switch ($case) {
    
    case 'login':
        /**
         * Autenticação do usuário
         * 
         * @var string email_usuario   Email do usuário
         * @var string senha_usuario   Senha do usuário
         * @var array  dados           Dados do usuário retornados da consulta
         */
        $email_usuario = $_REQUEST["email_usuario"];
        $senha_usuario = $_REQUEST["senha_usuario"];
        $sql = "SELECT * FROM tb_usuario WHERE email_usuario = ? AND senha_usuario = ?";
        $retorno = conectarDB("select", $sql, "ss", [$email_usuario, $senha_usuario]);

        if (sizeof($retorno[1]) > 0) {
            /** Inicia sessão e armazena informações do usuário */
            session_start();
            session_destroy();
            session_start();
            $dados = $retorno[1][0];
            $_SESSION["id_usuario"] = $dados["id_usuario"];
            $_SESSION["email_usuario"] = $dados["email_usuario"];
            $_SESSION["nome_usuario"] = $dados["nome_usuario"];
            $_SESSION["senha_usuario"] = $dados["senha_usuario"];
            $_SESSION["tipo_usuario"] = $dados["tipo_usuario"];
            $_SESSION["p_modalidade"] = $dados["p_modalidade"];

            /** Redireciona para a página inicial */
            redirecionar('pagina_inicial', '');
        } else {
            /** Redireciona para login com mensagem de erro */
            redirecionar("login_erro", "Email ou Senha incorretos. Tente novamente!");
        }
        break;
    
    case 'logout':
        /**
         * Logout do usuário
         * 
         * Encerra a sessão do usuário e redireciona para a página inicial
         */
        session_start();
        session_destroy();
        redirecionar('pagina_inicial', '');
        break;
    
    case 'cadastro_usuario': 
        /**
         * Cadastro de novo usuário
         * 
         * @var string $nome_usuario    Nome do usuário
         * @var string $email_usuario   Email do usuário
         * @var string $senha_usuario   Senha do usuário
         * @var string $p_modalidade    Preferência de modalidade do usuário
         */
        $nome_usuario = $_REQUEST["nome_usuario"];
        $email_usuario = $_REQUEST["email_usuario"];
        $senha_usuario = $_REQUEST["senha_usuario"];
        $p_modalidade = $_REQUEST["p_modalidade"];
        
        $sql = "SELECT * FROM tb_usuario WHERE email_usuario = ?";
        $retorno = conectarDB("select", $sql, "s", [$email_usuario]);

        if (sizeof($retorno[1]) == 0) {
            /** Insere novo usuário no banco de dados */
            $sql = "INSERT INTO tb_usuario VALUES (NULL, ?, ?, ?, ?, ?)";
            conectarDB("insert_update", $sql, "sssss", [$nome_usuario, $email_usuario, $senha_usuario, 'Cliente', $p_modalidade]);

            /** Redireciona para a página inicial */
            redirecionar("pagina_inicial", "");
        } else {
            /** Redireciona para a página de erro com mensagem */
            redirecionar("cadastro_erro", "Já existe um usuário cadastrado com esse Email!");
        }
        break;
    
    case 'direcionar':
        /**
         * Valida as credenciais do usuário para direcionamento de perfil
         * 
         * @var int    $id_usuario       ID do usuário
         * @var string $senha_digitada   Senha digitada pelo usuário
         * @var string $email_digitado   Email digitado pelo usuário
         * @var string $senha_usuario    Senha do usuário no banco
         * @var string $email_usuario    Email do usuário no banco
         */
        $id_usuario = $_REQUEST["id_usuario"];
        $senha_digitada = $_REQUEST["senha_usuario"];
        $email_digitado = $_REQUEST["email_usuario"];
        
        $sql = "SELECT * FROM tb_usuario WHERE id_usuario = ?";
        $retorno = conectarDB("select", $sql, "i", [$id_usuario]);
        $dados = $retorno[1][0];
        $senha_usuario = $dados["senha_usuario"];
        $email_usuario = $dados["email_usuario"];

        if ($senha_digitada == $senha_usuario && $email_digitado == $email_usuario) {
            echo "
                <script>
                    window.location.href='/public/dashboard/cliente/perfil.php?editar=n';
                </script>";
        } else {
            echo "
                <script>
                    window.alert('Email ou Senha digitados incorretos! Tente novamente...');
                    window.location.href='/public/dashboard/cliente/perfil.php';
                </script>";
        }
        break;

    case 'editar':
        /**
         * Edição dos dados do usuário
         * 
         * @var string $nome_usuario    Novo nome do usuário
         * @var string $email_usuario   Novo email do usuário
         * @var string $p_modalidade    Nova preferência de modalidade do usuário
         */
        $nome_usuario = $_REQUEST["n_nome"];
        $email_usuario = $_REQUEST["n_email"];
        $p_modalidade = $_REQUEST["n_p_modalidade"];
        
        session_start();
        $id_usuario = $_SESSION["id_usuario"];
        
        /** Atualiza dados do usuário no banco de dados */
        $sql = "UPDATE tb_usuario SET nome_usuario = ?, email_usuario = ?, p_modalidade = ? WHERE id_usuario = $id_usuario";
        $retorno = conectarDB("insert_update", $sql, "sss", [$nome_usuario, $email_usuario, $p_modalidade]);

        /** Atualiza dados de sessão */
        $_SESSION["nome_usuario"] = $nome_usuario;
        $_SESSION["email_usuario"] = $email_usuario;
        $_SESSION["p_modalidade"] = $p_modalidade;

        /** Redireciona para o perfil */
        redirecionar("perfil", "");
        break;
    
    default:
        /** @ignore Opção inválida */
        break;
        
}
?>