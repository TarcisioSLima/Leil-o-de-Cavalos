<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/session_usuarios.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

<div class="t_header">
    <ul>
        <li><a href="/public/index.php">Início</a></li>
        <li><a href="/public/dashboard/admin/cavalo/form.php">Cadastrar novo cavalo</a></li>
    </ul>
</div>

<!-- Tabela com os dados do cavalo! -->
    <div>   
        <table>
            <thead>
                <tr>
                    <th>Nome</th><th>Raça</th><th>Pelagem</th><th>Premio</th><th>Modalidade</th><th>Situação</th><th>Destaque</th><th>Ações</th>
                </tr>
            </thead>        
        <?php
            include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';
            $sql = "SELECT * FROM tb_cavalo";
            $retorno = conectarDB("select", $sql, [], "");
            $i = 0;
            foreach ($retorno[1] as $dados) { 
            $situacao_cavalo = $dados["situacao_cavalo"]; ?>
            <tr>
                <td><?= $dados["nome_cavalo"]; ?></td><td><?= $dados["raca_cavalo"]; ?></td><td><?= $dados["pelagem_cavalo"];?></td><td><?= $dados["premio_cavalo"];?></td><td><?= $dados["modalidade_cavalo"];?></td><td><?= $dados["situacao_cavalo"];?></td><td><?= $dados["destaque"];?></td>
                <?php 
            switch ($situacao_cavalo) {
                case 'Ativo':
                    ?>
                    <td><a href="">Ver propostas</a></td>
                    <?php
                    break;
                case 'Inativo':
                    ?>
                    <td><a href="">Editar</a></td>
                    <td><a href="">Anunciar</a></td>
                    <?php
                    break;
                case 'Vendido':
                    ?>
                    <td><a href="">Remover</a></td>
                    <?php
                    break;
                default:
                    # code...
                    break;
               }
               ?>
                       
            </tr>
        <?php }?>
        </table>
    </div>
            
        


    
</body>
</html>