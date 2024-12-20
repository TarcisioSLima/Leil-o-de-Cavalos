<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<header class="header">
    <div>
       <img src="/public/assets/img/logo_estendida_verde.png" alt="" style='max-width: 350px; max-height: 350px;'>
    </div>   
    <link rel="stylesheet" href="/public/assets/css/cards.css">
</header>
<style>
    /* CSS da navbar */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .t_header{
            background-color: #282e09;
        }

        .t_header ul {
            list-style: none; 
            margin: 0; 
            padding: 0; 
            display: flex; 
        }

        .t_header li {
            margin-right: 10px;
        }

        .t_header li:last-child { 
            margin-right: 0; 
        }
        .t_header li:first-child { 
            margin-left: 10px; 
        }

        .t_header a {
            display: block; 
            padding: 10px 15px; 
            background-color:#282e09; 
            color: #b6ab9e; 
            text-decoration: none; 
            border-radius: 5px; 
        }

        .t_header a:hover {
            background-color: #53422a;
        }    

        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #b6ab9e;
            color: white;
            padding: 5px 10px;
            text-align: center;
        }

    
    /* Estilização da tabela */    
            table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
                font-size: 1em;
                font-family: Arial, sans-serif;
                background-color: #fff;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            th, td {
                padding: 12px 15px;
                text-align: left;
                text-align: center;
            }

            th {
                background-color: #282e09;
                color: #fff;
                text-transform: uppercase;
                letter-spacing: 0.03em;
                
            }

            td {
                border-bottom: 1px solid #dddddd;
            }
            /* Estilos para a célula de ações */
                td.acao {
                    display: flex;
                    justify-content: space-between;
                    gap: 10px; /* Espaçamento entre os botões */
                }

                /* Estilo base para o link dentro das ações - Botões */
                td.acao a {
                    flex: 1;
                    text-align: center;
                    padding: 10px 15px; /* Espaçamento interno dos botões */
                    color: #b6ab9e; /* Cor do texto igual a .t_header a */
                    border-radius: 5px; /* Bordas arredondadas */
                    text-decoration: none; /* Remove o sublinhado */
                    transition: background-color 0.3s ease, transform 0.2s ease; /* Animações de hover */
                    font-size: 14px;
                    font-weight: bold;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Sombra dos botões */
                    width: 100%; /* Largura total */
                    display: inline-block;
                    background-color: #282e09;  /* Cor de fundo igual a .t_header a */
                }

                td.acao a:hover {
                    background-color: #53422a; /* Cor de fundo no hover igual a .t_header a:hover */
                    transform: translateY(-2px); /* Leve efeito de elevação no hover */
                }

                /* Ajusta o tamanho proporcionalmente quando há dois botões */
                td.acao a:nth-child(1), 
                td.acao a:nth-child(2) {
                    width: calc(50% - 5px); /* Dois botões, dividem o espaço */
                }

                /* Quando houver apenas um botão, ele ocupa a largura total */
                td.acao a:only-child {
                    width: 100%; /* Largura total quando houver um único botão */
                }

            tr:hover {
                background-color: #f1f1f1;
            }

            /* Alterna a cor das linhas para melhor visualização */
            tr:nth-child(even) {
                background-color: #f8f8f8;
            }

            /* Responsividade para dispositivos móveis */
            @media (max-width: 768px) {
                table {
                    font-size: 0.9em;
                }

                th, td {
                    padding: 10px;
                }
            }
            
</style>
<?php $view = $_REQUEST['view']; ?>

<div class="t_header">
    <ul>
        <li><a href="/public/index.php">Início</a></li>
        <li><a href="/public/dashboard/admin/index.php">Voltar</a></li>
        <?php if($view == "cardativo") ?>
    </ul>
</div>

    <?php 

    $view = $_REQUEST['view'];     

    if ($view == 'cardativo') { ?>
    <!-- Card ativos -->
        <div class="cards-container">
            <?php
                include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';
                $sql = "SELECT * FROM tb_lote WHERE estado_lote = 'Ativo'";
                $retorno = conectarDB("select", $sql, [], "");

                foreach ($retorno[1] as $dados) { 
                    // Dados do cavalo
                    $valor_lote = $dados["valor_lote"];
                    $estado_lote = $dados["estado_lote"];
                    $data_fechamento = $dados["data_fechamento"];
                    $data_fechamento_conversao = new DateTime($data_fechamento);
                    $data_final = $data_fechamento_conversao ->format('d/m/Y');

            ?>
            <div class="card">
                <img src="<?= $img_cavalo?>" alt="Imagem do cavalo" class="card-img">
                <div class="card-content">
                    <p class="card-text"><strong>Valor:</strong> <?= $valor_lote ?></p>
                    <p class="card-text"><strong>Data de fechamento:</strong> <?= $data_final ?></p>
                    <p class="card-text"><strong>Situação:</strong> <?= $estado_lote ?></p>
                <div class="card-actions">
                    <a href="#" class="card-link">Dar lance</a>
                </div>
                </div>
            </div>
                    <?php } ?>
        </div>
        
        <?php } ?>
        <!-- else redirecionar("pagina_inicial", "")?> -->

</body>
</html>