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
</style>
<body>
    <header class="header">
        <div>
        <img src="/public/assets/img/logo_estendida_verde.png" alt="" style="max-width: 350px; max-height: 350px;">
        </div>   
    </header>
    <?php $view = $_REQUEST['view']; ?>
    <div class="t_header">
        <ul>
            <li><a href="/public/index.php">Início</a></li>
            <li><a href="/public/dashboard/admin/cavalo/index.php?view=<?=$view?>">Voltar</a></li>
        </ul>
    </div>
    
    <div class="div_form">
        <form action="/controle/controle_cavalo.php?caso=cadastro&view=<?=$view?>" enctype="multipart/form-data" method="POST">
            <ul>
                <li>
                    <input type="text" name="nome_cavalo" placeholder="Nome">
                </li>
                <li>
                    <input type="text" name="raca_cavalo" placeholder="Raça"> 
                </li>
                <li>
                    <input type="text" name="pelagem_cavalo" placeholder="Pelagem"> 
                </li>
                <li>
                    <input type="text" name="premio_cavalo" placeholder="Premio"> 
                </li>
                    <select name="modalidade_cavalo" id="">
                        <option value="3 Tambores">3 Tambores</option>
                        <option value="Laço">Laço</option>
                        <option value="Vaquejada">Vaquejada</option>
                    </select>
                </li>
                <li>
                    <input type="file" name="imagem_cavalo">
                </li>
            </ul>
            <button type="submit" id="green">Salvar</button>
        </form>
    </div>
</body>
</html>