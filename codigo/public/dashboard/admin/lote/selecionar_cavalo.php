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

    <?php if ($view == 'card') { ?>
    <!-- Cards com os dados do cavalo -->
        <div class="cards-container">
            <?php
                include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';
                $sql = "SELECT * FROM tb_cavalo WHERE situacao_cavalo = 'Inativo'";
                $retorno = conectarDB("select", $sql, [], "");

                foreach ($retorno[1] as $dados) { 
                    // Dados do cavalo
                    $id_cavalo = $dados["id_cavalo"];
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
                            <a href="/public/dashboard/admin/lote/form_lote.php?id_cavalo=<?= $id_cavalo?>" class="card-link">Selecionar</a>
                         </div>
                        </div>
                    </div>

                   <?php  } ?>
        </div>
        
    <?php  } else redirecionar("pagina_inicial", "")?>

    
</body>
</html>