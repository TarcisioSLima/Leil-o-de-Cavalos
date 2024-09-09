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
    <div class="div_form">
        <p>Preencha os campos abaixo para criar sua conta!</p> <br>
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
                
                    <select name="p_modalidade" id="">
                        <option value="-">Sem Preferência</option>
                        <option value="3 Tambores">3 Tambores</option>
                        <option value="Laço">Laço</option>
                        <option value="Vaquejada">Vaquejada</option>
                    </select>
                </li>
            </ul>
            <button type="submit" id="green">Enviar</button>
        </form>
    </div>
</body>
</html>