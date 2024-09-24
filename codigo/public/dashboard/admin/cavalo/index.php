<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/session_usuarios.php';
    session_start(); verificar_sessao("Admin");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
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

    /* CSS dos cards */
        /* Container dos cards */
            .cards-container {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
                justify-content: center;
                padding: 20px;
            }

            /* Card individual */
            .card {
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                width: 300px;
                overflow: hidden;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .card:hover {
                transform: scale(1.05);
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            }

            /* Imagem no card */
            .card-img {
                width: 100%;
                height: 200px;
                object-fit: cover;
                border-bottom: 2px solid #ccc;
            }

            /* Conteúdo do card */
            .card-content {
                padding: 15px;
                text-align: center;
            }

            /* Título do card */
            .card-title {
                font-size: 1.5em;
                margin-bottom: 10px;
                color: #333;
            }

            /* Texto do card */
            .card-text {
                font-size: 1em;
                color: #666;
                margin-bottom: 8px;
            }

            /* Links para ações no card */
            .card-actions {
                margin-top: 10px;
            }

            .card-link {
                display: inline-block;
                margin: 5px 10px;
                padding: 8px 12px;
                border-radius: 5px;
                background-color: #007bff;
                color: #fff;
                text-decoration: none;
                transition: background-color 0.3s ease;
            }

            .card-link:hover {
                background-color: #0056b3;
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
<body>
<header class="header">
    <div>
       <img src="/public/assets/img/logo_estendida_verde.png" alt="" style='max-width: 350px; max-height: 350px;'>
    </div>   
</header>
<?php $view = $_REQUEST['view']; ?>

<div class="t_header">
    <ul>
        <li><a href="/public/index.php">Início</a></li>
        <li><a href="/public/dashboard/admin/index.php">Voltar</a></li><?php if($view == "card"){?>
        <li><a href="/public/dashboard/admin/cavalo/form.php?view=card">Cadastrar novo cavalo</a></li><?php } else { ?>
        <li><a href="/public/dashboard/admin/cavalo/form.php?view=table">Cadastrar novo cavalo</a></li><?php } ?>
    </ul>
</div>

<?php if ($view == 'table') { ?>
    <!-- Tabela com os dados do cavalo! -->
    <div>   
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Raça</th>
                    <th>Pelagem</th>
                    <th>Premio</th>
                    <th>Modalidade</th>
                    <th>Situação</th>
                    <th>Destaque</th>
                    <th>Ações</th>
                </tr>
            </thead>        
            <tbody>
                <?php
                include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';
                $sql = "SELECT * FROM tb_cavalo";
                $retorno = conectarDB("select", $sql, [], "");

                foreach ($retorno[1] as $dados) { 
                    $situacao_cavalo = $dados["situacao_cavalo"]; 
                    $id_cavalo = $dados['id_cavalo'];
                ?>
                <tr>
                    <td><?= $dados["nome_cavalo"]; ?></td>
                    <td><?= $dados["raca_cavalo"]; ?></td>
                    <td><?= $dados["pelagem_cavalo"]; ?></td>
                    <td><?= $dados["premio_cavalo"]; ?></td>
                    <td><?= $dados["modalidade_cavalo"]; ?></td>
                    <td><?= $dados["situacao_cavalo"]; ?></td>
                    <td><?= $dados["destaque"]; ?></td>
                    <td class="acao">
                        <?php 
                        switch ($situacao_cavalo) {
                            case 'Ativo':
                                echo "<a href='?caso=propostas'>Ver propostas</a>";
                                break;
                            case 'Inativo':
                                echo "<a href='?caso=editar'>Editar</a><div></div><a href='?caso=anunciar'>Anunciar</a>";
                                break;
                            case 'Vendido':
                                echo "<a href='/controle/controle_cavalo.php?caso=remover&id_cavalo=$id_cavalo'>Remover</a>";
                                break;
                            default:
                                echo '-';
                                break;
                        } ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php } elseif ($view == 'card') { ?>
    <!-- Cards com os dados do cavalo -->
        <div class="cards-container">
            <?php
                include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';
                $sql = "SELECT * FROM tb_cavalo";
                $retorno = conectarDB("select", $sql, [], "");

                foreach ($retorno[1] as $dados) { 
                    // Dados do cavalo
                    $nome_cavalo = $dados["nome_cavalo"];
                    $raca_cavalo = $dados["raca_cavalo"];
                    $pelagem_cavalo = $dados["pelagem_cavalo"];
                    $premio_cavalo = $dados["premio_cavalo"];
                    $modalidade_cavalo = $dados["modalidade_cavalo"];
                    $situacao_cavalo = $dados["situacao_cavalo"];
                    $destaque = $dados["destaque"];
                    $img_cavalo = $dados["img_cavalo"];
            ?>
                    <div class="card">
                        <img src="<?= $img_cavalo?>" alt="Imagem do cavalo <?= $nome_cavalo ?>" class="card-img">
                        <div class="card-content">
                            <h3 class="card-title"><?= $nome_cavalo ?></h3>
                            <p class="card-text"><strong>Raça:</strong> <?= $raca_cavalo ?></p>
                            <p class="card-text"><strong>Pelagem:</strong> <?= $pelagem_cavalo ?></p>
                            <p class="card-text"><strong>Prêmio:</strong> <?= $premio_cavalo ?></p>
                            <p class="card-text"><strong>Modalidade:</strong> <?= $modalidade_cavalo ?></p>
                            <p class="card-text"><strong>Situação:</strong> <?= $situacao_cavalo ?></p>
                            <p class="card-text"><strong>Destaque:</strong> <?= $destaque ?></p>
                        <div class="card-actions">
                            <?php 
                            switch ($situacao_cavalo) {
                                case 'Ativo':
                                    echo '<a href="#" class="card-link">Ver propostas</a>';
                                    break;
                                case 'Inativo':
                                    echo '<a href="#" class="card-link">Editar</a>';
                                    echo '<a href="#" class="card-link">Anunciar</a>';
                                    break;
                                case 'Vendido':
                                    echo '<a href="#" class="card-link">Remover</a>';
                                    break;
                                default:
                                    // Caso não faça nada
                                    break;
                            }?>
                        </div>
                        </div>
                    </div>
                <?php } ?>
        </div>
        
    <?php } else redirecionar("pagina_inicial", "")?>

    
</body>
</html>