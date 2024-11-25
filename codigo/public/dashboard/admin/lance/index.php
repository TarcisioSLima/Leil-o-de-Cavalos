<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/session_usuarios.php';

// Inicia sessão e verifica se o usuário possui a permissão "Admin"
session_start();
verificar_sessao("Admin");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>