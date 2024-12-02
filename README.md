# LeilÃ£o de Cavalos

## Executar o projeto

Rode os seguintes comandos no terminal:
```
docker-compose up -d

docker exec quarter_horse docker-php-ext-install mysqli

docker exec quarter_horse a2enmod rewrite
```

## Acessar o projeto

No navegador digite:
```
localhost:824
```



### Todos os dados do banco

``` 
O Código abaixo pega todos os dados do banco, lance, lote, usuario e cavalo.

<?php

        if ($forma == 't') {
            
        }elseif ($forma == 'f') {

            $sql_lotes = "SELECT * FROM tb_lote ORDER BY data_fechamento";
            $retorno_lotes = conectarDB("select", $sql_lotes, "", []);
            foreach ($retorno_lotes[1] as $dados_lote) {

                $id_lote = $dados_lote['id_lote'];
                $valor_inicial_lote = $dados_lote['valor_lote'];
                $id_cavalo = $dados_lance['id_cavalo'];

                $sql_cavalo = "SELECT * FROM tb_cavalo WHERE id_cavalo = $id_cavalo";
                $retorno_cavalo = conectarDB("select", $sql_cavalo, "", []); 
                $dados_cavalo = $retorno_cavalo[1][0];
                    $nome_cavalo = $dados_cavalo['nome_cavalo'];
                    $raca_cavalo = $dados_cavalo['raca_cavalo'];
                    $destaque = $dados_cavalo['destaque'];
                    $premio_cavalo = $dados_cavalo['premio_cavalo'];
                    $imagem = $dados_cavalo['img_cavalo'];

                
                
                $sql_lances = "SELECT * FROM tb_lance WHERE tb_lote_id_lote = $id_lote ORDER BY valor_lance DESC";
                $retorno_lances = conectarDB("select", $sql_lances, '', []);


                
                foreach($retorno_lances[1] as $dados_lance){

                    $valor_lance = $dados_lance['valor_lance'];
                    $id_usuario = $dados_lance['id_usuario'];
                    $data_lance = $dados_lance['data_lance'];
                        
                        $sql_dados_user = "SELECT * FROM tb_usuario WHERE id_usuario = $id_usuario";
                        $retorno_usuario = conectarDB("select", $sql_dados_user, "", []);
                        $dados_usuario = $retorno_usuario[1][0];
                        $nome_user = $dados_usuario['nome_usuario'];
                        $email_user = $dados_usuario['email_usuario'];


                }

            }

        }
    ?>

Com base nesses códigos de exemplo ->

Código de exemplo (

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
     * 
     * @autor Tarcísio <tarcisio.pesquisa.estudo@gmail.com>
     * 
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
                                echo "<a href='/public/dashboard/admin/lance/index.php?e=t&id_cavalo=$id_cavalo'>Propostas</a>";
                                if ($dados['destaque'] == "Sim") {
                                    echo "<a href='/controle/controle_cavalo.php?caso=r_destaque&id_cavalo=$id_cavalo&view=$view'><i class='fa-solid fa-star'></i></a>";
                                }elseif ($dados['destaque'] == "Não") {
                                    echo "<a href='/controle/controle_cavalo.php?caso=a_destaque&id_cavalo=$id_cavalo&view=$view'><i class='fa-regular fa-star'></i></a>";
                                }
                                break;
                            case 'Inativo':
                                echo "<a href='/public/dashboard/admin/cavalo/form.php?id_cavalo=$id_cavalo&view=$view'>Editar</a>
                                    <div></div>
                                    <a href='/public/dashboard/admin/lote/form_lote.php?id_cavalo=$id_cavalo&view=$view'>Anunciar</a>";
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
                                    echo "<a href='/public/dashboard/admin/lance/index.php?e=t&id_cavalo=$id_cavalo' class='card-link'>Ver propostas</a>";
                                    break;
                                case 'Inativo':
                                    echo "<a href='/public/dashboard/admin/cavalo/form.php?id_cavalo=$id_cavalo&view=$view' class='card-link'>Editar</a>";
                                    echo "<a href='/public/dashboard/admin/lote/form_lote.php?id_cavalo=$id_cavalo&view=$view' class='card-link'>Anunciar</a>";
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

)

Código de Exemplo 2 (

<?php
    /**
     * Página de Cadastro e Edição de Cavalos
     * 
     * Este arquivo controla a exibição e envio do formulário para cadastro e edição de dados dos cavalos.
     * 
     * @requires /helpers/session_usuarios.php
     * @requires /db/conexao.php (apenas em modo edição)
     * 
     * @after verificar_sessao("Admin") Inicia sessão e verifica permissões de acesso.
     * 
     * @autor Tarcísio <tarcisio.pesquisa.estudo@gmail.com>
     * 
     */

    include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/verificador_lote.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/session_usuarios.php';
    session_start();
    verificar_sessao("Admin");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro e Edição de Cavalos</title>
    <link rel="stylesheet" href="/public/assets/css/form.css">
</head>
<style>
    /* Estilos Gerais e Formatação */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: Arial, sans-serif; background-color: #f8f8f8; }

    .header { background-color: #b6ab9e; color: white; padding: 5px 10px; text-align: center; }
    .t_header { background-color: #282e09; }
    .t_header ul { list-style: none; display: flex; }
    .t_header li { margin-right: 10px; }
    .t_header a { padding: 10px 15px; color: #b6ab9e; text-decoration: none; border-radius: 5px; }
    .t_header a:hover { background-color: #53422a; }

    /* Estilo da Imagem e Formulário */
    .form-container { display: flex; gap: 20px; max-width: 800px; margin: 40px auto; }
    .img-container { text-align: center; }
    .img-container img { max-width: 300px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); }
    .img-container a.blue { background-color: #007bff; color: white; padding: 10px 20px; border-radius: 5px; }
    .img-container a.red { background-color: #ff3333; color: white; padding: 10px 20px; border-radius: 5px; }
    .img-container a:hover { background-color: #0056b3; }
    .div_form { width: 100%; }

    /* Responsividade */
    @media (max-width: 768px) {
        .form-container { flex-direction: column; align-items: center; }
        .img-container img { max-width: 90%; }
        .div_form { max-width: 90%; }
    }
</style>

<body>
    <header class="header">
        <img src="/public/assets/img/logo_estendida_verde.png" alt="Logo" style="max-width: 350px;">
    </header>
    <?php $view = $_REQUEST['view']; ?>
    
    <div class="t_header">
        <ul>
            <li><a href="/public/index.php">Início</a></li>
            <li><a href="/public/dashboard/admin/cavalo/index.php?view=<?=$view?>">Voltar</a></li>
        </ul>
    </div>

    <!-- Cadastro de Cavalo -->
    <?php if (!isset($_REQUEST['id_cavalo'])) { ?>
        <div class="div_form">
            <form action="/controle/controle_cavalo.php?caso=cadastro&view=<?=$view?>" enctype="multipart/form-data" method="POST" id="cadastro_cavalo">
                <ul>
                    <li>
                        <input type="text" name="nome_cavalo" placeholder="Nome">
                        <br><small class="error-message" id="nomeError"></small>
                    </li>
                    <li>
                        <input type="text" name="raca_cavalo" placeholder="Raça">
                        <br><small class="error-message" id="racaError"></small>
                    </li>
                    <li>
                        <input type="text" name="pelagem_cavalo" placeholder="Pelagem">
                        <br><small class="error-message" id="pelagemError"></small>
                    </li>
                    <li>
                        <input type="text" name="premio_cavalo" placeholder="Prêmio">
                        <br><small class="error-message" id="premioError"></small>
                    </li>
                    <li>
                        <select name="modalidade_cavalo">
                            <option value="3 Tambores">3 Tambores</option>
                            <option value="Laço">Laço</option>
                            <option value="Vaquejada">Vaquejada</option>
                        </select>
                        <br><small class="error-message" id="modalidadeError"></small>
                    </li>
                    <li>
                        <input type="file" name="imagem_cavalo" id="imagem_cavalo">
                        <br><small class="error-message" id="imagemError"></small>
                    </li>
                </ul>
                <button type="submit" id="green">Salvar</button>
            </form>
        </div>

    <!-- Editar Cavalo -->
    <?php } 
    else { 
        include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';
        $id_cavalo = $_REQUEST['id_cavalo'];
        $sql = "SELECT * FROM tb_cavalo WHERE id_cavalo = ?";
        $retorno = conectarDB("select", $sql, "i", [$id_cavalo]);
        $dados = $retorno[1][0];
    ?>
    
        <?php 
        if (!isset($_REQUEST['edit_img'])) { ?>
            <div class="form-container" >
                <div class="img-container">
                    <h3>Imagem Atual do Cavalo</h3><br>
                    <small class="error-message"></small>

                    <img src="<?=$dados['img_cavalo']?>" alt="Imagem do Cavalo" id="img_editar"><br>
                    <br>
                    <p><a href="form.php?id_cavalo=<?=$id_cavalo?>&view=<?=$view?>&edit_img=1" class="blue">Editar Imagem</a></p>
                </div>
                <div class="div_form">
                    <form id="cadastro_cavalo" action="/controle/controle_cavalo.php?caso=editar&view=<?=$view?>&id_cavalo=<?=$id_cavalo?>" enctype="multipart/form-data" method="POST">
                        <ul>
                            <li>
                                <input type="text"  name="nome_cavalo" placeholder="Nome" value="<?= $dados['nome_cavalo']?>">
                                <br><small class="error-message" id="nomeError"></small>
                            </li>
                            <li>
                                <input type="text" name="raca_cavalo" placeholder="Raça" value="<?= $dados['raca_cavalo']?>">
                                <br><small class="error-message" id="racaError"></small>
                            </li>
                            <li>
                                <input type="text" name="pelagem_cavalo" placeholder="Pelagem" value="<?= $dados['pelagem_cavalo']?>">
                                <br><small class="error-message" id="pelagemError"></small>
                            </li>
                            <li>
                                <input type="text" name="premio_cavalo" placeholder="Prêmio" value="<?= $dados['premio_cavalo']?>">
                                <br><small class="error-message" id="premioError"></small>
                            </li>
                            <li>
                                <select name="modalidade_cavalo">
                                    <option value="3 Tambores" <?php if ($dados['modalidade_cavalo'] == "3 Tambores") echo "selected"; ?>>3 Tambores</option>
                                    <option value="Laço" <?php if ($dados['modalidade_cavalo'] == "Laço") echo "selected"; ?>>Laço</option>
                                    <option value="Vaquejada" <?php if ($dados['modalidade_cavalo'] == "Vaquejada") echo "selected"; ?>>Vaquejada</option>
                                </select>
                                <br><small class="error-message" id="modalidadeError"></small>
                            </li>
                            <select name="destaque">
                                <option value="Sim" <?php if ($dados['destaque'] == "Sim") echo "selected"; ?>>Destaque - Sim</option>
                                <option value="Não" <?php if ($dados['destaque'] == "Não") echo "selected"; ?>>Destaque - Não</option>
                            </select>
                            <br><small class="error-message" id="destaqueError"></small>

                        </ul>
                        <button type="submit" id="green">Salvar</button>
                    </form>
                </div>
            </div>

        <!-- Editar com Imagem -->
        <?php } 
        else { ?>
            <div class="form-container">
                <div class="img-container">
                    <h3>Imagem Atual do Cavalo</h3>
                    <img src="<?=$dados['img_cavalo']?>" alt="Imagem do Cavalo" ><br>
                    <small class="error-message" id="imagem_obrigatoriaError"></small>
                    <form id="cadastro_cavalo" action="/controle/controle_cavalo.php?caso=editar&view=<?=$view?>&id_cavalo=<?=$id_cavalo?>&img=1" enctype="multipart/form-data" method="POST">
                        <div style="display: flex;">
                            <input type="file" name="imagem_editar_cavalo" id="imagem_editar_cavalo">
                            <a href="form.php?id_cavalo=<?=$id_cavalo?>&view=<?=$view?>" class="red">Cancelar</a>
                        </div>
                        <div class="div_form">
                        <ul>
                            <li>
                                <input type="text" name="nome_cavalo" placeholder="Nome" value="<?= $dados['nome_cavalo']?>">
                                <br><small class="error-message" id="nomeError"></small>
                            </li>
                            <li>
                                <input type="text" name="raca_cavalo" placeholder="Raça" value="<?= $dados['raca_cavalo']?>">
                                <br><small class="error-message" id="racaError"></small>
                            </li>
                            <li>
                                <input type="text" name="pelagem_cavalo" placeholder="Pelagem" value="<?= $dados['pelagem_cavalo']?>">
                                <br><small class="error-message" id="pelagemError"></small>
                            </li>
                            <li>
                                <input type="text" name="premio_cavalo" placeholder="Prêmio" value="<?= $dados['premio_cavalo']?>">
                                <br><small class="error-message" id="premioError"></small>
                            </li>
                            <li>
                                <select name="modalidade_cavalo">
                                    <option value="3 Tambores" <?php if ($dados['modalidade_cavalo'] == "3 Tambores") echo "selected"; ?>>3 Tambores</option>
                                    <option value="Laço" <?php if ($dados['modalidade_cavalo'] == "Laço") echo "selected"; ?>>Laço</option>
                                    <option value="Vaquejada" <?php if ($dados['modalidade_cavalo'] == "Vaquejada") echo "selected"; ?>>Vaquejada</option>
                                </select>
                                <br><small class="error-message" id="modalidadeError"></small>
                            </li>
                            <select name="destaque">
                                <option value="Sim" <?php if ($dados['destaque'] == "Sim") echo "selected"; ?>>Destaque - Sim</option>
                                <option value="Não" <?php if ($dados['destaque'] == "Não") echo "selected"; ?>>Destaque - Não</option>
                            </select>
                            <br><small class="error-message" id="destaqueError"></small>

                        </ul>
                        <button type="submit" id="green">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
</body>
    <script src="../../../assets/js/jquery-3.7.1.min.js"></script>
    <script src="../../../assets/js/cadastro_cavalo.js"></script>
</html>

)

Com base nesses códigos de exemplo comente esse próximo seguindo a mesma estrutura e padrão dos comentários dos exemplos anteriores, considere devolver a respostas com o código completo e comentado apenas.

