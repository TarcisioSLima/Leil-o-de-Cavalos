<?php
    /**
     * Painel Admin - Cavalos
     * 
     * Este arquivo renderiza o painel administrativo com opções de navegação para gerenciar cavalos, lances e lotes.
     * 
     * @requires session_usuarios.php Responsável pela verificação de sessão do usuário
     * 
     * @autor Admin <admin@email.com>
     */

    // Importa o arquivo de sessão e inicia/verifica se o usuário possui nível de acesso "Admin"
    include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/session_usuarios.php';
    session_start();
    verificar_sessao("Admin");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin - Cavalos</title>
    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Garante que o conteúdo ocupe a tela toda */
        }

        /* Container do painel */
        .container {
            display: flex;
            justify-content: space-around; /* Alinha os cards horizontalmente */
            max-width: 1200px;
            padding: 20px;
            gap: 20px;
            width: 100%; /* Ocupar toda a largura disponível */
        }

        /* Estilo dos cards */
        .box {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            flex: 1; /* Garantir que todos os cards tenham a mesma largura */
            max-width: 300px;
        }

        /* Animação ao passar o mouse */
        .box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* Título dos cards */
        .box p {
            font-size: 1.5em;
            font-weight: bold;
            color: #444;
            margin-bottom: 15px;
        }

        /* Lista de opções */
        .box ul {
            list-style: none;
            padding: 0;
        }

        /* Estilo dos links */
        .box li a {
            display: block;
            font-size: 1.1em;
            color: black;
            text-decoration: none;
            padding: 10px 0;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        /* Cor ao passar o mouse */
        .box li a:hover {
            background-color: #f0f0f0;
            color: #0056b3;
        }

        /* Responsividade para telas menores */
        @media (max-width: 768px) {
            .container {
                flex-direction: column; /* Em telas pequenas, os cards ficam verticais */
                align-items: center;
            }

            .box {
                max-width: 90%; /* Os cards ocupam 90% da largura da tela em dispositivos móveis */
            }
        }

        @media (max-width: 480px) {
            .box p {
                font-size: 1.2em;
            }

            .box li a {
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="box">
            <p>Cavalos</p>
            <ul>
                <li><a href="/public/dashboard/admin/cavalo/index.php?view=table">Visualização em Tabela</a></li>
                <li><a href="/public/dashboard/admin/cavalo/index.php?view=card">Visualização Otimizada</a></li>
            </ul>
        </div>
        <div class="box">
            <p>Lances</p>
            <ul>
                <li><a href="/public/dashboard/admin/lance/index.php?e=f">Gerais</a></li>
            </ul>
        </div>
        <div class="box">            
            <p>Lotes</p>
            <ul>
                <li><a href="/public/dashboard/admin/lote/index.php?view=cardativo">Ativos</a></li>
                <li><a href="/public/dashboard/admin/lote/index.php?view=cardinativo">Encerrados</a></li>
                <li><a href="/public/dashboard/admin/lote/selecionar_cavalo.php?view=card">Novo</a></li>
            </ul>
        </div>
    </div>
</body>
</html>