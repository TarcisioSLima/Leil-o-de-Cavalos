<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
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
</head>
<body>

    <header class="header">
        <div>
           <img src="../../assets/img/logo_estendida_verde.png" alt="" style="max-width: 350px; max-height: 350px;">
        </div>   
    </header>

    <div class="t_header">
        <ul>
            <li><a href="public/index.php">Início</a></li>
            <li><a href="#">Quem Somos</a></li>
        </ul>
    </div>

    
        <?php if (isset($_GET["id_usuario"])) { $id_usuario = $_REQUEST['id_usuario']; ?>
        <div style="text-align: center;">
            <p>Primeiro confirme seu email e senha!</p> <br>
            <form action="/controle/controle_usuario.php?caso=direcionar&id_usuario=<?php echo $id_usuario ;?>" method="POST">
                <p><input type="text" name="email_usuario" placeholder="Email" style="text-align: center;"></p>
                <p><input type="text" name="senha_usuario" placeholder="Senha" style="text-align: center;"></p>
                <button type="submit">Acessar</button>
            </form>
        </div>
        <?php } else {?>
        <div style="text-align: center;">
            <p>Preencha os campos abaixo e entre em sua conta!</p> <br>
            <form action="/controle/controle_usuario.php?caso=login" method="POST">    
                <p><input type="text" name="email_usuario" placeholder="Email" style="text-align: center;"></p>
                <p><input type="text" name="senha_usuario" placeholder="Senha" style="text-align: center;"></p> 
                <button type="submit">Acessar</button>
            </form>
        </div>
        <?php }?>
</body>
</html>