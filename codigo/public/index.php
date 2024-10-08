<?php
    session_start();
    include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';
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
       /* Container geral */
        .container {
            display: flex;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Menu de Categorias */
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
                    <option value="raca_cavalo">Raça</option>
                    <option value="pelagem_cavalo">Pelagem</option>
                    <option value="premio_cavalo">Prêmio</option>
                </select>    
                <input type="text" placeholder="Digite aqui" class="search-box" name="texto">
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
        </ul>
    </div>
    <?php 
        if (!isset($_REQUEST["texto"])) { ?>
            <div class="container">
                <!-- Menu lateral de cavalos em destaque -->
                
                <div class="card_categorias">
                    <ul class="u_categorias">
                        <li><a href="index.php">
                            <i class="fa-solid fa-horse"></i>Cavalos em Destaque</a>
                </li>    
                <?php 
            $sql = "SELECT * FROM tb_cavalo WHERE destaque = 'Sim'";
            $retorno = conectarDB("select", $sql, [], "");
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
            $sql = "SELECT * FROM tb_cavalo WHERE destaque = 'Sim' ORDER BY id_cavalo";
            $retorno = conectarDB("select", $sql, [], "");
            $contador = 1;
            foreach ($retorno[1] as $dados) { 
                if ($contador == $cavalo_d) {
                    $id_cavalo = $dados['id_cavalo'];
                    $dados_basicos = [
                        $nome_cavalo = ("Nome: " . $dados["nome_cavalo"]),
                        $raca_cavalo = ("Raça: " . $dados["raca_cavalo"]),
                        $pelagem_cavalo = ("Pelagem: " . $dados["pelagem_cavalo"]),
                        $premio_cavalo = ("Prêmio: " . $dados["premio_cavalo"]),
                        $modalidade_cavalo = ("Modalidade: " . $dados["modalidade_cavalo"]),
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
                    
                    <a href="lance.php?id_cavalo=<?=$id_cavalo?>">Ver lances</a>
                </ul>
            </div>
            <?php } else { ?>
                <div class="main-content"> 
                <img src="assets/img/test.png" alt="" class="img_i"> 
            </div>
            <?php } ?>
        </div>
        
        <!-- Lotes de cavalos -->
        <div class="lotes">
            <?php
       $sql = "SELECT * FROM tb_cavalo WHERE destaque = 'Sim'";
       $retorno = conectarDB("select", $sql, [], "");
       foreach ($retorno[1] as $dados) { 
           $id_cavalo = $dados['id_cavalo'];
           $nome_cavalo = $dados['nome_cavalo'];
           $raca_cavalo = $dados['raca_cavalo'];
           $pelagem_cavalo = $dados['pelagem_cavalo'];
           $premio_cavalo = $dados['premio_cavalo'];
           $situacao_cavalo = $dados['situacao_cavalo'];
           $modalidade_cavalo = $dados['modalidade_cavalo'];
           $img_cavalo = $dados['img_cavalo'];
           ?>
    <div class="ls">
        <img src="assets/img/horse.jpg" alt="Imagem do cavalo <?= $nome_cavalo ?>" class="img">
        <hr>
        <h4>Nome: <?= $nome_cavalo ?></h4>
        <hr>
        <p>Raça: <?= $raca_cavalo ?></p>
        <hr>
        <p>Prêmios: <?= $premio_cavalo ?></p>
        <hr>
        <p>Modalidade: <?= $modalidade_cavalo ?></p>  
    </div>
    <?php } ?>
</div>
<?php } else {
        $filtro = $_REQUEST["filtro"];
        $texto = $_REQUEST["texto"];
        switch ($filtro) {
            case 'raca_cavalo':
                $sql = "SELECT * FROM tb_cavalo WHERE raca_cavalo LIKE ? AND situacao_cavalo = 'Ativo'"; 
                $param = "%" . $texto . "%"; // Adiciona os % ao redor do texto
                $retorno = conectarDB("select", $sql, [$param], "s");
                if (sizeof($retorno[1]) > 0) {
                    foreach ($retorno[1] as $dados) { 
                        // Dados do cavalo
                        $id_cavalo = $dados["id_cavalo"];
                        $nome_cavalo = $dados["nome_cavalo"];
                        $raca_cavalo = $dados["raca_cavalo"];
                        $pelagem_cavalo = $dados["pelagem_cavalo"];
                        $premio_cavalo = $dados["premio_cavalo"];
                        $modalidade_cavalo = $dados["modalidade_cavalo"];
                        $img_cavalo = $dados["img_cavalo"];


                        // $data_fechamento_conversao = new DateTime($data_fechamento);
                        // $data_final = $data_fechamento_conversao ->format('d/m/Y');
                ?>
                        <div class="card">
                            <img src="<?= $img_cavalo?>" alt="Imagem do cavalo <?= $nome_cavalo ?>" class="card-img">
                            <div class="card-content">
                                <h3 class="card-title"><?= $nome_cavalo ?></h3>
                                <p class="card-text"><strong>Raça:</strong> <?= $raca_cavalo ?></p>
                                <p class="card-text"><strong>Pelagem:</strong> <?= $pelagem_cavalo ?></p>
                                <p class="card-text"><strong>Prêmios:</strong> <?= $premio_cavalo ?></p>
                                <p class="card-text"><strong>Modalidade:</strong> <?= $modalidade_cavalo ?></p>

                            <div class="card-actions">
                                <a href="#" class="card-link">Dar lance</a>
                            </div>
                            </div>
                        </div>
                <?php  
                    }
                }
                break;
            case 'pelagem_cavalo':
                $sql = "SELECT * FROM tb_cavalo WHERE pelagem_cavalo like %?%";
                conectarDB("select", $sql, [$texto], "s");
                break;
            case 'premio_cavalo':
                $sql = "SELECT * FROM tb_cavalo WHERE premio_cavalo like %?%";
                conectarDB("select", $sql, [$texto], "s");
                break;

            default:
                
                break;
            }
        }
        


    ?>
<<<<<<< HEAD
=======
        
<?php } ?>

>>>>>>> c10a14585b77354903ec819959fc1fbe6eca5b07
<br><br><br><br><br><br>

    <script>
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