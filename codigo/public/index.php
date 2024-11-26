<?php
    session_start();
    include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/verificador_lote.php';
    
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quarter Horse</title>
    <link rel="stylesheet" href="assets/css/nav.css">
    <script src="https://kit.fontawesome.com/bc42253982.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        /* Container geral  */
        .container {
            display: flex;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

         /* Menu de Categorias  */
         .card_categorias {
            width: 25%;
            margin-right: 20px;
        }  

        .u_categorias {
            display: flex;
            flex-direction: column;
            list-style: none;
            border: 1px solid rgb(210, 209, 209); 
            background-color: #f7f7f7;
            border-radius: 10px;
            overflow: hidden;
        }

        .u_categorias li {
            border-bottom: 1px solid rgb(210, 209, 209);
        }

        .u_categorias a {
            text-decoration: none;
            color: #191c06;
            display: flex;
            align-items: center;
            padding: 15px 20px;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        .u_categorias a:hover {
            background-color: #dedddd;
        }

        .u_categorias i {
            margin-right: 10px;
            font-size: 1.2em; 
        }

        /* Card de destaque */
        .card {
            width: 70%;
            height: auto;
            background-color: #282e09;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 2%;
        }

        .card ul {
            list-style: none;
            color: #b6ab9e;
            padding: 0;
            margin: 0;
            width: 50%;
        }

        .card li:first-child {
            font-size: 1.8em;
            margin-bottom: 10px;
        }

        .card li {
            font-size: 1.2em;
            margin-bottom: 8px;
        }

        /* Imagem do cavalo */
        .card img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            object-fit: cover;
            max-height: 300px;
            border: 2px solid #b6ab9e;
            margin-left: 10px;
        }  

        /* Estilo dos lotes de cavalos */
        .lotes {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: flex-start;
            margin-top: 30px;
            align-items: flex-start;
        }

        .ls {
            width: 30%;
            background-color: #f7f7f7;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            flex-grow: 1; /* Mantém a proporção e permite a expansão */
            flex-shrink: 0; /* Não encolhe além do tamanho especificado */
        }

        .ls:hover {
            transform: translateY(-5px);
        }

        .ls img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .ls h4, .ls p {
            color: #191c06;
            margin-bottom: 10px;
        }

        .ls hr {
            border: 1px solid #d1d1d1;
        }


        /* Responsividade */
        @media (max-width: 768px) {
            .ls {
                width: 48%; /* Ajusta para 2 colunas em telas médias */
            }
        }

        @media (max-width: 480px) {
            .ls {
                width: 100%; /* Ajusta para 1 coluna em telas pequenas */
            }
        }

    </style>

</head>
<body>
    <header class="header">
        <div class="logo" >
           <img src="assets/img/logo_verde.png" alt="" style="max-width: 200px; max-height: 200px;">
        </div>
        <form action="index.php">
            <div class="search-container">
            <!-- <input type="hidden" name="pesquisa" value = "qualquercoisa"> -->
                <select name="filtro" id="" class="search-box">
                    <option value="sem_filtro" selected >Sem filtro</option>
                    <option value="raca_cavalo" <?php if (isset($_REQUEST['filtro']) && $_REQUEST['filtro'] == 'raca_cavalo') {echo 'selected';} ?>>Raça</option>
                    <option value="pelagem_cavalo" <?php if (isset($_REQUEST['filtro']) && $_REQUEST['filtro'] == 'pelagem_cavalo') {echo 'selected';} ?>>Pelagem</option>
                    <option value="premio_cavalo" <?php if (isset($_REQUEST['filtro']) && $_REQUEST['filtro'] == 'premio_cavalo') {echo 'selected';} ?>>Prêmio</option>
                </select>    
                <input type="text" placeholder="Digite aqui" class="search-box" value="<?= isset($_REQUEST['texto']) ? $_REQUEST['texto'] : '' ?>" name="texto">
                <button type="submit" class="search-button">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                </button>
                
            </div>
        </form>
        
        <div class="auth-buttons">
            <ul> 
            <!-- Botões Padrões Usuário deslogado -->

                <?php if (!isset($_SESSION["tipo_usuario"])) {  ?>
                    <li>
                        <a href="dashboard/cliente/index.php" id="button1" class="" onmouseover="animate_y1()" onmouseout="animate_n1()">
                            <i class="fa-solid fa-user-check"></i> Login
                        </a>
                    </li>
                    <li>
                        <a href="dashboard/cliente/form.php" id="button2" class="" onmouseover="animate_y2()" onmouseout="animate_n2()">
                            <i class="fa-solid fa-user-plus"></i> Cadastrar-se
                        </a>
                    </li>
                
            <!-- Botões ADM logado -->
                
                <?php } elseif (isset($_SESSION["tipo_usuario"]) AND $_SESSION["tipo_usuario"] == "Admin") { ?>
                    <li>
                        <a href="dashboard/admin/index.php" id="button1" class="" onmouseover="animate_y1()" onmouseout="animate_n1()">
                            Painel <i class="fa-solid fa-screwdriver-wrench"></i> 
                        </a>
                    </li>
                    <li>
                        <a href="/controle/controle_usuario.php?caso=logout" id="button2" class="" onmouseover="animate_y2()" onmouseout="animate_n2()">
                        Sair <i class="fa-solid fa-person-walking-arrow-right"></i>
                        </a>
                    </li>

            <!-- Botões Cliente logado -->

                <?php } elseif (isset($_SESSION["tipo_usuario"]) AND $_SESSION["tipo_usuario"] == "Cliente") { ?>
                    <li>
                        <a href="dashboard/cliente/perfil.php" id="button1" class="" onmouseover="animate_y1()" onmouseout="animate_n1()">
                            <i class="fa-regular fa-id-card"></i> 
                            <?php $nome_usuario = $_SESSION['nome_usuario']; echo " Olá $nome_usuario"; ?>
                        </a>
                    </li>
                    <li>
                        <a href="/controle/controle_usuario.php?caso=logout" id="button2" class="" onmouseover="animate_y2()" onmouseout="animate_n2()">
                            Sair <i class="fa-solid fa-person-walking-arrow-right"></i>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        
        </div>
       
    </header>

    <div class="t_header">
        <ul>
            <li><a href="/public/index.php">Início</a></li>
            <li><a href="/public/quarter_horse.php">Quem Somos</a></li>
            <li><a href="../public/dashboard/cliente/lote.php?view=cardativo">Ver cavalos</a></li>

        </ul>
    </div>
    <?php 
        if (!isset($_REQUEST["texto"]) && !isset($_REQUEST["filtro"])) { ?>
            <div class="container">
                <!-- Menu lateral de cavalos em destaque -->
                
                <div class="card_categorias">
                    <ul class="u_categorias">
                        <li><a href="index.php">
                            <i class="fa-solid fa-horse"></i>Cavalos em Destaque</a>
                </li>    
                <?php 
            $sql = "SELECT * FROM tb_cavalo WHERE destaque = 'Sim' AND situacao_cavalo = 'Ativo'";
            $retorno = conectarDB("select", $sql, "", []);
            $num = 1;
            foreach ($retorno[1] as $dados) { ?>
            
                 <li><a href="index.php?cavalo_d=<?=$num?>">
                     <i class="fa-solid fa-<?=$num?>"></i>Cavalo em destaque</a>
                    </li>
                    <?php
                if ($num >= 10) break;
                $num += 1; 
            }?>
        
    </ul>
</div>

        <!-- Card com o cavalo em destaque -->
        <?php if (isset($_REQUEST["cavalo_d"])) {
            
            $cavalo_d = $_REQUEST['cavalo_d'];
            $sql = "SELECT * FROM tb_cavalo WHERE destaque = 'Sim' AND situacao_cavalo = 'Ativo' ORDER BY id_cavalo";
            $retorno = conectarDB("select", $sql, "", []);
            $contador = 1;
            foreach ($retorno[1] as $dados) { 
                if ($contador == $cavalo_d) {
                    $id_cavalo = $dados['id_cavalo'];
                    $sql_2 = "SELECT * FROM tb_lote WHERE tb_cavalo_id_cavalo = ?";
                    $retorno_2 = conectarDB("select", $sql_2, "i", [$id_cavalo]);
                    
                    if (sizeof($retorno_2[1]) > 0) {
                        $dados_2 = $retorno_2[1][0];
                        $id_lote = $dados_2["id_lote"];
                        $valor_inicial_lote = $dados_2["valor_lote"];
                        $data_de_fechamento = $dados_2["data_fechamento"];
                    
                        // --------------------------------------------------------------------}
                        // Maior Lance {------------------------------------------------------------------
                        $sql = "SELECT * FROM tb_lance WHERE tb_lote_id_lote = ? ORDER BY valor_lance";
                        $retorno_3 = conectarDB("select", $sql, "i", [$id_lote]);
                        if (sizeof($retorno_3[1]) == 0) {
                            $lance_atual = $valor_inicial_lote;
                        }else {
                            $indice = sizeof($retorno_3[1]) -1;
                            $dados_1 = $retorno_3[1][$indice];
                            $lance_atual = $dados_1["valor_lance"];

                        }
                    }
                    
                    $dados_basicos = [
                        $nome_cavalo = ("Nome: " . $dados["nome_cavalo"]),
                        $raca_cavalo = ("Raça: " . $dados["raca_cavalo"]),
                        $pelagem_cavalo = ("Pelagem: " . $dados["pelagem_cavalo"]),
                        $premio_cavalo = ("Prêmio: " . $dados["premio_cavalo"]),
                        $modalidade_cavalo = ("Modalidade: " . $dados["modalidade_cavalo"]),
                        $valor_lote_atual = ("Valor atual do Lote: " . $lance_atual),
                        $fechamento =  ("Data de fechamento: " . $data_de_fechamento)
                    ];
                    $img_cavalo = $dados["img_cavalo"];
                    $situacao_cavalo = $dados["situacao_cavalo"];
                }
                $contador += 1;
            }
        ?>
        <div class="card">
            <ul>
                <?php foreach ($dados_basicos as $dado) { ?>
                    <li><?= $dado; ?></li>
                    <?php } ?>
                </ul>
                <ul>
                    <img src="<?= $img_cavalo ?>" alt="Imagem do cavalo <?= $nome_cavalo ?>" class="img">
                </ul>
                <ul>
                    
                    <a href="lance_form.php?id_cavalo=<?=$id_cavalo?>&action=dar_lance">Dar lance</a>
                </ul>
            </div>
            <?php } else { ?>
                <div class="main-content"> 
                <img src="assets/img/test.png" alt="" class="img_i"> 
            </div>
            <?php } ?>
        </div>

        <!-- Inclusão do CSS e JavaScript do Swiper -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<style>
    /* Centralizar os carrosséis na página */
    .swiper-container {
        max-width: 80%; /* Ajuste conforme desejado */
        margin: 0 auto;
        position: relative;
    }

    /* Estilos para os cards */
    .card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        padding: 15px;
        text-align: left; /* Alinha o conteúdo do card à esquerda */
        width: 90%; /* Ajusta o tamanho dos cards */
    }

    /* Estilos para a imagem dentro dos cards */
    .card-img {
        width: 100%;
        height: auto;
        max-height: 200px; /* Ajuste conforme desejado */
        object-fit: cover;
        border-radius: 8px;
    }

    /* Estilos para o conteúdo do card */
    .card-content {
        text-align: left; /* Alinha o conteúdo ao lado esquerdo */
    }

    /* Estilos para os botões de navegação do Swiper */
    .swiper-button-next, .swiper-button-prev {
        color: #000; /* Cor das setas */
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 40px;
        height: 40px;
        z-index: 10;
    }

    /* Posição das setas fora da área dos cards */
    .swiper-button-next {
        right: -30px;
    }

    .swiper-button-prev {
        left: -30px;
    }
</style>

<!-- Carrossel para a modalidade Corrida -->
<h2 style="text-align: center;">Modalidade: 3 Tambores</h2>
<div class="swiper-container corrida-carousel">
    <div class="swiper-wrapper">
        <?php
        $sql = "SELECT * FROM tb_cavalo WHERE modalidade_cavalo = '3 Tambores' AND situacao_cavalo = 'Ativo' ";
        $retorno = conectarDB("select", $sql, "", []);
        foreach ($retorno[1] as $dados) {
            $nome_cavalo = $dados['nome_cavalo'];
            $raca_cavalo = $dados['raca_cavalo'];
            $pelagem_cavalo = $dados['pelagem_cavalo'];
            $premio_cavalo = $dados['premio_cavalo'];
            $img_cavalo = $dados['img_cavalo'];
        ?>
        <div class="swiper-slide">
            <div class="card lotes">
                <img src="<?= $img_cavalo ?>" alt="Imagem do cavalo <?= $nome_cavalo ?>" class="card-img">
                <div class="card-content">
                    <h3 class="card-title"><?= $nome_cavalo ?></h3>
                    <p class="card-text"><strong>Tempo restante:</strong> </p>
                    <p class="card-text"><strong>Raça:</strong> <?= $raca_cavalo ?></p>
                    <p class="card-text"><strong>Pelagem:</strong> <?= $pelagem_cavalo ?></p>
                    <p class="card-text"><strong>Prêmios:</strong> <?= $premio_cavalo ?></p>
                    <div class="card-actions">
                        <a href="#" class="card-link">Dar lance</a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>

<!-- Carrossel para a modalidade Salto -->
<p><h2 style="text-align: center;">Modalidade: Laço</h2></p>
<div class="swiper-container salto-carousel">
    <div class="swiper-wrapper">
        <?php
        $sql = "SELECT * FROM tb_cavalo WHERE modalidade_cavalo = 'Laço' AND situacao_cavalo = 'Ativo'";
        $retorno = conectarDB("select", $sql, "", []);
        foreach ($retorno[1] as $dados) {
            $nome_cavalo = $dados['nome_cavalo'];
            $raca_cavalo = $dados['raca_cavalo'];
            $pelagem_cavalo = $dados['pelagem_cavalo'];
            $premio_cavalo = $dados['premio_cavalo'];
            $img_cavalo = $dados['img_cavalo'];
        ?>
        <div class="swiper-slide">
            <div class="card lotes">
                <img src="<?= $img_cavalo ?>" alt="Imagem do cavalo <?= $nome_cavalo ?>" class="card-img">
                <div class="card-content">
                    <h3 class="card-title"><?= $nome_cavalo ?></h3>
                    <p class="card-text"><strong>Tempo restante:</strong> </p>
                    <p class="card-text"><strong>Raça:</strong> <?= $raca_cavalo ?></p>
                    <p class="card-text"><strong>Pelagem:</strong> <?= $pelagem_cavalo ?></p>
                    <p class="card-text"><strong>Prêmios:</strong> <?= $premio_cavalo ?></p>
                    <div class="card-actions">
                        <a href="#" class="card-link">Dar lance</a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>

<!-- Carrossel para a modalidade Exposição -->
<p><h2 style="text-align: center;">Modalidade: Vaquejada</h2></p>
<div class="swiper-container exposicao-carousel">
    <div class="swiper-wrapper">
        <?php
        $sql = "SELECT * FROM tb_cavalo WHERE modalidade_cavalo = 'Vaquejada' AND situacao_cavalo = 'Ativo'";
        $retorno = conectarDB("select", $sql, "", []);
        foreach ($retorno[1] as $dados) {
            $nome_cavalo = $dados['nome_cavalo'];
            $raca_cavalo = $dados['raca_cavalo'];
            $pelagem_cavalo = $dados['pelagem_cavalo'];
            $premio_cavalo = $dados['premio_cavalo'];
            $img_cavalo = $dados['img_cavalo'];
        ?>
        <div class="swiper-slide">
            <div class="card lotes">
                <img src="<?= $img_cavalo ?>" alt="Imagem do cavalo <?= $nome_cavalo ?>" class="card-img">
                <div class="card-content">
                    <h3 class="card-title"><?= $nome_cavalo ?></h3>
                    <p class="card-text"><strong>Tempo restante:</strong> </p>
                    <p class="card-text"><strong>Raça:</strong> <?= $raca_cavalo ?></p>
                    <p class="card-text"><strong>Pelagem:</strong> <?= $pelagem_cavalo ?></p>
                    <p class="card-text"><strong>Prêmios:</strong> <?= $premio_cavalo ?></p>
                    <div class="card-actions">
                        <a href="#" class="card-link">Dar lance</a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>

 
<?php } ?>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
    // JavaScript para Inicializar os Carrosséis

        var corridaCarousel = new Swiper('.corrida-carousel', {
            loop: true,
            navigation: {
                nextEl: '.corrida-carousel .swiper-button-next',
                prevEl: '.corrida-carousel .swiper-button-prev',
            },
            slidesPerView: 3, /* Apenas 3 cards na tela */
            spaceBetween: 30, /* Espaço entre os cards */
        });

        var saltoCarousel = new Swiper('.salto-carousel', {
            loop: true,
            navigation: {
                nextEl: '.salto-carousel .swiper-button-next',
                prevEl: '.salto-carousel .swiper-button-prev',
            },
            slidesPerView: 3,
            spaceBetween: 30,
        });

        var exposicaoCarousel = new Swiper('.exposicao-carousel', {
            loop: true,
            navigation: {
                nextEl: '.exposicao-carousel .swiper-button-next',
                prevEl: '.exposicao-carousel .swiper-button-prev',
            },
            slidesPerView: 3,
            spaceBetween: 30,
        });
        function animate_y1() {
            document.getElementById("button1").classList.add('animate__animated', 'animate__pulse')
        }
        function animate_n1() {
            document.getElementById("button1").classList.remove('animate__animated', 'animate__pulse')
        }
        function animate_y2() {
            document.getElementById("button2").classList.add('animate__animated', 'animate__pulse')
        }
        function animate_n2() {
            document.getElementById("button2").classList.remove('animate__animated', 'animate__pulse')
        }
        function animate_y1() {
            document.getElementById("button1").classList.add('animate__animated', 'animate__pulse')
        }
        function animate_n1() {
            document.getElementById("button1").classList.remove('animate__animated', 'animate__pulse')
        }
        function animate_y2() {
            document.getElementById("button2").classList.add('animate__animated', 'animate__pulse')
        }
        function animate_n2() {
            document.getElementById("button2").classList.remove('animate__animated', 'animate__pulse')
        }
    </script>
</body>
</html>