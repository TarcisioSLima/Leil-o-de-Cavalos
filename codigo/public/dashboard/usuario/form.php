<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
</head>
<body>

    <header class="header">
        <div>
           <img src="../../assets/img/logo_estendida_verde.png" alt="" style="max-width: 350px; max-height: 350px;">
        </div>   
    </header>

    <div class="t_header">
        <ul>
            <li><a href="index.php">Início</a></li>
            <li><a href="#">Quem Somos</a></li>
        </ul>
    </div>

    <div>
        <p>Preencha os campos abaixo e para criar sua conta!</p> <br>
        <form action="/controle/controle_usuario.php?caso=cadastro_usuario" method="POST">
            <ul>
                <li>
                    <input type="text" name="nome_usuario" placeholder="Nome">
                </li>
                <li>
                    <input type="text" name="email_usuario" placeholder="Email"> 
                </li>
                <li>
                    <input type="text" name="senha_usuario" placeholder="Senha"> 
                </li>
                <li>
                    <select name="p_modalidade" id="">
                        <option value="-">Sem Preferência</option>
                        <option value="3 Tambores">3 Tambores</option>
                        <option value="Laço">Laço</option>
                        <option value="Vaquejada">Vaquejada</option>
                    </select>
                </li>
            </ul>

            <button type="submit">Acessar</button>
            

        </form>
    </div>
</body>
</html>