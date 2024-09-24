<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/session_usuarios.php';
    session_start(); verificar_sessao("Admin");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin - Cavalos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            height: 100vh; /* Altura mínima para a centralização vertical funcionar */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center; /* Centralização vertical */
            flex-wrap: wrap; /* Responsivo para quebrar linha em telas menores */
            text-align: center;
            padding: 20px;
            gap: 20px; /* Espaçamento entre os cards */
        }

        .box {
            background-color: #fff;
            padding: 20px;
            margin: 0 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 250px; /* Largura fixa para os cards */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 200px; /* Altura fixa */
        }

        .box ul {
            list-style: none;
            padding: 0;
            flex-grow: 1; /* Expande o conteúdo para preencher o card */
        }

        .box p {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .box li, .box a {
            margin: 10px 0;
            font-size: 1em;
            text-decoration: none;
            color: #007bff;
            transition: color 0.3s ease;
        }

        .box a:hover {
            color: #0056b3;
        }

        .box ul li {
            margin: 15px 0;
        }

        /* Responsividade para telas menores */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="box">
            <ul>
                <p>Cavalos</p>
                <li>
                    <a href="/public/dashboard/admin/cavalo/index.php?view=table">Visualização em Tabela</a>
                </li>
                <li>
                    <a href="/public/dashboard/admin/cavalo/index.php?view=card">Visualização Otimizada</a>
                </li>
            </ul>
        </div>
        <div class="box">
            <ul>
                <p>Lances</p>
                <li>
                    <a href="/public/dashboard/admin/lance/index.php">Específicos</a>
                </li>
                <li>
                    <a href="/public/dashboard/admin/lance/index.php">Gerais</a>
                </li>
            </ul>
        </div>
        <div class="box">
            <ul>
                <p>Lotes</p>
                <li>
                    <a href="/public/dashboard/admin/lote/index.php">Ativos</a>
                </li>
                <li>
                    <a href="/public/dashboard/admin/lote/index.php">Encerrados</a>
                </li>
                <li>
                    <a href="/public/dashboard/admin/lote/index.php">Novo</a>
                </li>
            </ul>
        </div>
    </div>
</body>
</html>
