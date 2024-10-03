<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/session_usuarios.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';
    session_start(); verificar_sessao("Admin");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/public/assets/css/form.css">
</head>
<style>
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

</style>
<body>
    <header class="header">
        <div>
        <img src="/public/assets/img/logo_estendida_verde.png" alt="" style="max-width: 350px; max-height: 350px;">
        </div>   
    </header>
    <div class="t_header">
        <ul>
            <li><a href="/public/index.php">Início</a></li>
            <li><a href="/public/dashboard/admin/index.php">Voltar</a></li>
        </ul>
    </div>
    
    <?php 
        $data_hoje = new DateTime();
        $data_hoje ->modify('+7 days');
        $data_fechamento = $data_hoje ->format('d-m-y');
        $id_cavalo = $_REQUEST['id_cavalo'];
        $sql = "SELECT img_cavalo FROM tb_cavalo WHERE id_cavalo = ?";
        $retorno = conectarDB("select", $sql, [$id_cavalo], "i");
        $dados = $retorno[1][0];
    ?>

    <div class="div_form">
        <form action="/controle/controle_lote.php?caso=cadastro&id_cavalo=<?= $id_cavalo?>&view=card" enctype="multipart/form-data" method="POST">
            <ul>
                <img src="<?= $dados['img_cavalo']?>" alt="">
                <li>
                    <input type="text" name="titulo_lote" placeholder="Título">
                </li>
                <li>
                    <input type="text" name="valor_lote" placeholder="Valor"> 
                </li>
                <li>
                    <input type="text" name="data_fechamento" value="<?= $data_fechamento?>"readonly> 
                </li>
                <li>
                    <input type="text" name="estado_lote" value="Ativo" hidden> 
                </li>
                <!-- <li>
                    <select name="cavalo" id="">
                        <option value="3 Tambores">3 Tambores</option>
                        <option value="Laço">Laço</option>
                        <option value="Vaquejada">Vaquejada</option>
                    </select>
                </li> -->
            </ul>
            <button type="submit" id="green">Salvar</button>
        </form>
    </div>
</body>
</html> 