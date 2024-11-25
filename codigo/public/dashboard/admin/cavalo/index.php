<?php
    /**
     * Página de Gerenciamento de Cavalos
     * 
     * Este arquivo exibe uma interface administrativa para listar, editar e
     * gerenciar os dados dos cavalos em formato de tabela ou de cartões.
     * 
     * @requires /helpers/session_usuarios.php
     * @requires /db/conexao.php
     * 
     * @after verificar_sessao("Admin")
     */

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
    <link rel="stylesheet" href="/public/assets/css/cards.css">
    <script src="https://kit.fontawesome.com/bc42253982.js" crossorigin="anonymous"></script>
</head>
<style>
    /* CSS da navbar */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    .t_header { background-color: #282e09; }
    .t_header ul { list-style: none; margin: 0; padding: 0; display: flex; }
    .t_header li { margin-right: 10px; }
    .t_header li:last-child { margin-right: 0; }
    .t_header li:first-child { margin-left: 10px; }
    .t_header a {
        display: block; padding: 10px 15px; background-color: #282e09; 
        color: #b6ab9e; text-decoration: none; border-radius: 5px;
    }
    .t_header a:hover { background-color: #53422a; }
    body {
        font-family: Arial, sans-serif; background-color: #f8f8f8; margin: 0; padding: 0;
    }
    .header {
        background-color: #b6ab9e; color: white; padding: 5px 10px; text-align: center;
    }

    /* Estilização da tabela */
    table {
        width: 100%; border-collapse: collapse; margin: 20px 0; font-size: 1em;
        font-family: Arial, sans-serif; background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    th, td { padding: 12px 15px; text-align: center; }
    th {
        background-color: #282e09; color: #fff; text-transform: uppercase;
        letter-spacing: 0.03em;
    }
    td { border-bottom: 1px solid #dddddd; }
    td.acao { display: flex; justify-content: space-between; gap: 10px; }
    td.acao a {
        flex: 1; text-align: center; padding: 10px 15px; color: #b6ab9e;
        border-radius: 5px; text-decoration: none; transition: background-color 0.3s ease, transform 0.2s ease;
        font-size: 14px; font-weight: bold; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        width: 100%; display: inline-block; background-color: #282e09;
    }
    td.acao a:hover { background-color: #53422a; transform: translateY(-2px); }
    td.acao a:nth-child(1), td.acao a:nth-child(2) { width: calc(50% - 5px); }
    td.acao a:only-child { width: 100%; }
    tr:hover { background-color: #f1f1f1; }
    tr:nth-child(even) { background-color: #f8f8f8; }
    @media (max-width: 768px) { table { font-size: 0.9em; } th, td { padding: 10px; } }
</style>
<body>

<!-- nav bar -->
<header class="header">
    <div>
        <img src="/public/assets/img/logo_estendida_verde.png" alt="Logo" style='max-width: 350px; max-height: 350px;'>
    </div>   
</header>
<?php $view = $_REQUEST['view']; ?>

<div class="t_header">
    <ul>
        <li><a href="/public/index.php">Início</a></li>
        <li><a href="/public/dashboard/admin/index.php">Voltar</a></li>
        <?php if($view == "card"){ ?>
            <li><a href="/public/dashboard/admin/cavalo/form.php?view=card">Cadastrar novo cavalo</a></li>
        <?php } else { ?>
            <li><a href="/public/dashboard/admin/cavalo/form.php?view=table">Cadastrar novo cavalo</a></li>
        <?php } ?>
    </ul>
</div>

<?php if ($view == 'table') { ?>
    <!-- Tabela com os dados do cavalo -->
    <div>   
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Raça</th>
                    <th>Pelagem</th>
                    <th>Premio</th>
                    <th>Modalidade</th>
                    <th>Situação</th>
                    <th>Destaque</th>
                    <th>Ações</th>
                </tr>
            </thead>        
            <tbody>
                <?php
                include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';
                $sql = "SELECT * FROM tb_cavalo";
                $retorno = conectarDB("select", $sql, "", []);

                foreach ($retorno[1] as $dados) { 
                    $situacao_cavalo = $dados["situacao_cavalo"]; 
                    $id_cavalo = $dados['id_cavalo'];
                ?>
                <tr>
                    <td><?= $dados["nome_cavalo"]; ?></td>
                    <td><?= $dados["raca_cavalo"]; ?></td>
                    <td><?= $dados["pelagem_cavalo"]; ?></td>
                    <td><?= $dados["premio_cavalo"]; ?></td>
                    <td><?= $dados["modalidade_cavalo"]; ?></td>
                    <td><?= $dados["situacao_cavalo"]; ?></td>
                    <td><?= $dados["destaque"]; ?></td>
                    <td class="acao">
                        <?php 
                        switch ($situacao_cavalo) {
                            case 'Ativo':
                                echo "<a href='/controle/controle_cavalo.php?caso=proposta&id_cavalo=$id_cavalo&view=$view'>Propostas</a>";
                                if ($dados['destaque'] == "Sim") {
                                    echo "<a href='/controle/controle_cavalo.php?caso=r_destaque&id_cavalo=$id_cavalo&view=$view'><i class='fa-solid fa-star'></i></a>";
                                }elseif ($dados['destaque'] == "Não") {
                                    echo "<a href='/controle/controle_cavalo.php?caso=a_destaque&id_cavalo=$id_cavalo&view=$view'><i class='fa-regular fa-star'></i></a>";
                                }
                                break;
                            case 'Inativo':
                                echo "<a href='/public/dashboard/admin/cavalo/form.php?id_cavalo=$id_cavalo&view=$view'>Editar</a>
                                    <div></div>
                                    <a href='/controle/controle_cavalo.php?caso=anunciar&id_cavalo=$id_cavalo&view=$view'>Anunciar</a>";
                                break;
                            case 'Vendido':
                                echo "<a href='/controle/controle_cavalo.php?caso=remover&id_cavalo=$id_cavalo&view=$view'>Remover</a>";
                                break;
                            default:
                                echo '-';
                                break;
                        } ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } elseif ($view == 'card') { ?>
    <!-- Cards com os dados do cavalo -->
    <div class="cards-container">
        <?php
            include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';
            $sql = "SELECT * FROM tb_cavalo";
            $retorno = conectarDB("select", $sql, "", []);

            foreach ($retorno[1] as $dados) { 
                $id_cavalo = $dados['id_cavalo'];
                $nome_cavalo = $dados["nome_cavalo"];
                $raca_cavalo = $dados["raca_cavalo"];
                $pelagem_cavalo = $dados["pelagem_cavalo"];
                $premio_cavalo = $dados["premio_cavalo"];
                $modalidade_cavalo = $dados["modalidade_cavalo"];
                $situacao_cavalo = $dados["situacao_cavalo"];
                $destaque = $dados["destaque"];
                $img_cavalo = $dados["img_cavalo"];
        ?>
                <div class="card">
                    <img src="<?= $img_cavalo ?>" alt="Imagem do cavalo <?= $nome_cavalo ?>" class="card-img">
                    <div class="card-content">
                        <h3 class="card-title"><?= $nome_cavalo ?></h3>
                        <p class="card-text"><strong>Raça:</strong> <?= $raca_cavalo ?></p>
                        <p class="card-text"><strong>Pelagem:</strong> <?= $pelagem_cavalo ?></p>
                        <p class="card-text"><strong>Prêmio:</strong> <?= $premio_cavalo ?></p>
                        <p class="card-text"><strong>Modalidade:</strong> <?= $modalidade_cavalo ?></p>
                        <p class="card-text"><strong>Situação:</strong> <?= $situacao_cavalo ?></p>
                        <p class="card-text"><strong>Destaque:</strong> <?= $destaque ?></p>
                        <div class="card-actions">
                            <?php 
                            switch ($situacao_cavalo) {
                                case 'Ativo':
                                    echo "<a href='/controle/controle_cavalo.php?caso=proposta&id_cavalo=$id_cavalo&view=$view' class='card-link'>Ver propostas</a>";
                                    break;
                                case 'Inativo':
                                    echo "<a href='/public/dashboard/admin/cavalo/form.php?id_cavalo=$id_cavalo&view=$view' class='card-link'>Editar</a>";
                                    echo "<a href='/controle/controle_cavalo.php?caso=anunciar&id_cavalo=$id_cavalo&view=$view' class='card-link'>Anunciar</a>";
                                    break;
                                case 'Vendido':
                                    echo "<a href='/controle/controle_cavalo.php?caso=remover&id_cavalo=$id_cavalo&view=$view' class='card-link'>Remover</a>";
                                    break;
                            } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
    </div>
<?php } else { 
    redirecionar("pagina_inicial", "");
} ?>
</body>
</html>