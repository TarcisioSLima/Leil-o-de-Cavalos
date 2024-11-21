<?php 
    include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/navbar.html';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/public/assets/css/form.css">
</head>
<body>
    <?php if (isset($_GET["id_usuario"])) { $id_usuario = $_REQUEST['id_usuario']; ?>
        <div class="div_form">
            <div>
                <p>Primeiro confirme seu email e senha!</p> <br>
                <form action="/controle/controle_usuario.php?caso=direcionar&id_usuario=<?php echo $id_usuario ;?>" method="POST">
                    <ul>
                        <li>
                            <input type="text" name="email_usuario" placeholder="Email" class="inputs">    
                        </li>
                        <li>
                            <input type="text" name="senha_usuario" placeholder="Senha" class="inputs">
                        </li>
                        <button type="submit" id="green">Acessar</button>
                    </ul>
                </form>
            </div>
        </div>
        <?php } else {?>
        <div class="div_form">
                <p>Preencha os campos abaixo 
                e entre em sua conta!</p> <br>
                <form action="/controle/controle_usuario.php?caso=login" method="POST" id="form_login"> 
                    <ul>
                        <li>
                            <input type="text" name="email_usuario" placeholder="Email" class="inputs" id="email" > <br>
                            <small class="error-message" id="emailError"></small>
                        </li>        
                        <li>
                            <input type="text" name="senha_usuario" placeholder="Senha" class="inputs" id="senha" ><br>
                            <small class="error-message" id="senhaError"></small>
                        </li>
                        <button type="submit" id="green">Acessar</button>
                    </ul>   
                </form>
        </div>
    <?php }?>
</body>
    <script src="../../assets/js/jquery-3.7.1.min.js"></script>
    <script src="../../assets/js/script.js"></script>
</html>