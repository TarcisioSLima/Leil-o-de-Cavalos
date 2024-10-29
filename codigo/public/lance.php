<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/session_usuarios.php';
    session_start(); verificar_sessao("Cliente");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Uma Página Incrivel
</body>
</html>