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
<body>
    <div style="display: flex; justify-content:center; text-align: center;">
        <div>
            <ul>
                <p>
                    Cavalos
                </p>
                <li>
                    <a href="/public/dashboard/admin/cavalo/index.php?view=table">Visualização em Tabela</a>
                </li>
                <li>
                    <a href="/public/dashboard/admin/cavalo/index.php?view=card">Visualização Otimizada</a>
                </li>
            </ul>
        </div>
        <div>
            <ul>
                <a href="/public/dashboard/admin/lance/index.php">Lances Gerais</a>
            </ul>
        </div>
        <div>
            <ul>
                <a href="/public/dashboard/admin/lote/index.php">Lotes Ativos</a>
            </ul>
        </div>
    </div>
    
    
</body>
</html>