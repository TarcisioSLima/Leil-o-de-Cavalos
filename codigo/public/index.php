<?php
    session_start();
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
    <link rel="stylesheet" href="assets/css/cards.css">
    <style>
        * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        }
        .main-content {
            padding: 20px;
            display: flex;
            gap: 20px;
        }

        .search-container {
        display: flex;
        width: 300px; 
        border-radius: 10px;
        overflow: hidden;
        background-color: #282e09 ;
        color: #b6ab9e;
        }
        .search-box {
        padding: 10px;
        border: none;
        width: 100%;
        font-size: 16px;
        background-color: transparent;
        
        }

        .search-box::placeholder {
        color: #b6ab9e; 
        }

        .search-button {
        background-color: transparent;
        border: none;
        padding: 10px;
        cursor: pointer;
        }

        .search-icon {
        width: 20px; 
        color: #b6ab9e; 
        }

        .u_categorias {
            display: flex;
            flex-direction: column;
            width: 300px;
            margin: 10%;
            padding-top: 0; 
            list-style: none;
            border: 1px solid rgb(210, 209, 209); 
            background-color: rgb(247, 247, 247);
            border-radius: 10px;
            overflow: hidden;
        }

        .u_categorias a {
            text-decoration: none;
            color: #191c06;
            display: flex;
            align-items: center;
            padding: 15px 20px; 
            border-bottom: 1px solid rgb(210, 209, 209);
            
        }

        .u_categorias i {
            margin-right: 6px; 
            font-size: 1.0em; 
            padding: 0;
        }

        .img_i {
            max-width: 100%;
            border-radius: 10px;
            
            
        }
        .search-container {
            display: flex;
            align-items: center;
        }

        .main-content {
            width: 75%; 
            padding: 0;
            margin-left: 10%;
        }

        .card_categorias{
            width: 25%;
            
        }

        .container {
            display: flex;
            max-width: 1200px; 
            margin: 0 auto; 
            padding: 20px;
            
        }

        .lotes {
            display: flex;
            align-items: center;
        }
        .lotes div{
            margin-left: 2%;    
        }

        .ul_numeros {
            list-style: none;
            display: flex;
        }

        .ul_numeros li {
            margin-right: 50px;
        }

        .lotes {
            text-align: left;
            
        }
        p {
            margin-left: 10px;
        }

        .lotes ul {
            list-style: none;
            display: flex;
            margin-right: 10px;
            text-align: center;
            flex-direction: column;
            
        }
        .uls {
            display: flex; 
        }

        .nuns {
            font-size: 30px;
        }

        .ls {
            border: solid 2px rgb(216, 216, 216);
            border-radius: 5px;
        }
        .u_categorias li:hover{
            background-color: #dedddd;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="logo" >
           <img src="assets/img/logo_verde.png" alt="" style="max-width: 200px; max-height: 200px;">
        </div>

        <div class="search-container">
            <input type="text" placeholder="Pesquisar..." class="search-box">
            <button type="submit" class="search-button">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
            </button>
          </div>    
        
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
                            Painel <i class="fa-solid fa-horse"></i> 
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

    <div class="container" > 
        
            <div class="card_categorias">
                <ul class="u_categorias">
                    <li><a href="">
                        <i class="fa-solid fa-horse"></i>Cavalos em Destaque</a>
                    </li>
                    <li><a href="index.php?cavalo_d=1">
                        <i class="fa-solid fa-1"></i>Cavalo em destaque</a>
                    </li>
                    <li><a href="index.php?cavalo_d=2">
                        <i class="fa-solid fa-2"></i>Cavalo em destaque</a>
                    </li>
                    <li><a href="index.php?cavalo_d=3">
                        <i class="fa-solid fa-3"></i>Cavalo em destaque</a>
                    </li>
                    <li><a href="index.php?cavalo_d=4">
                        <i class="fa-solid fa-4"></i>Cavalo em destaque</a>
                    </li>
                    <li><a href="index.php?cavalo_d=5">
                        <i class="fa-solid fa-5"></i>Cavalo em destaque</a>
                    </li>
                    <li><a href="index.php?cavalo_d=6">
                        <i class="fa-solid fa-6"></i>Cavalo em destaque</a>
                    </li>  
                </ul>
            </div>

        <?php if (isset($_REQUEST["cavalo_d"])) {
                include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';
                $cavalo_d = $_REQUEST['cavalo_d'];
                $sql = "SELECT * FROM tb_cavalo WHERE destaque = 'Sim' ORDER BY id_cavalo";
                $retorno = conectarDB("select", $sql, [], "");
                $contador = 1;
                foreach ($retorno[1] as $dados) { 
                    if ($contador == $cavalo_d) {
                        $dados_basicos = [
                                    $nome_cavalo = ("Nome: " . $dados["nome_cavalo"]),
                                    $raca_cavalo = ("Raça: " . $dados["raca_cavalo"]),
                                    $pelagem_cavalo = ("Pelagem: " . $dados["pelagem_cavalo"]),
                                    $premio_cavalo = ("Prémio: " . $dados["premio_cavalo"]),
                                    $modalidade_cavalo = ("Modalidade: " . $dados["modalidade_cavalo"]),];
                        $img_cavalo = $dados["img_cavalo"];
                        $destaque = $dados["destaque"];
                        $situacao_cavalo = $dados["situacao_cavalo"];                                                                    
                    }
                    $contador += 1;
                }?>
                <div class="card">
                    <ul>
                        <?php for ($i=0; $i < 5; $i++) {?>
                        <li>
                            <?php echo $dados_basicos[$i] ;?>
                        </li>
                       <?php } ?>
                    </ul>
                    <ul>
                        <img src="<?php $img_cavalo ?>" alt="imagem" class="img">
                    </ul>
                </div>

        <?php } else{ ?>
            <div class="main-content"> 
                <img src="assets/img/test.png" alt="" class="img_i"> 
            </div>
        <?php } ?>
    
    
    </div>

    <div class="lotes">
        <div class="ls">
            <img src="assets/img/horse.jpg" alt="" style="max-width: 100%; border-radius: 10px;  object-fit: cover;"> <br>
            <hr> <br>
            <h4>
                Item de Exemplo 1
            </h4> <br>
            <hr><br>
            <p>R$ 12.000,00</p>
            <br>
            <hr>
        <div class="uls">
                <ul class="ul_dias">
                    <li class="nuns">4</li>
                    <li>Dias</li>
                </ul>
                <ul class="ul_horas">
                    <li class="nuns">7</li>
                    <li>Horas</li>
                </ul>
                <ul class="ul_minutos">       
                    <li class="nuns">40</li>
                    <li>Minutos</li>
                </ul>
                <ul class="ul_segundos">
                    <li class="nuns">10</li>
                    <li>Segundos</li>
                </ul>
            
        </div>
        
        </div>
        <div class="ls">
            <img src="assets/img/horse.jpg" alt="" style="overflow: hidden;"> <br>
            <hr> <br>
            <h4>
                Item de Exemplo 2
            </h4>
            <br><hr>
            <br>
            <p>R$ 4.700,00</p>
            <br><hr>
        <div class="uls">

            <ul class="ul_dias">
                <li class="nuns">4</li>
                <li>Dias</li>
            </ul>
            <ul class="ul_horas">
                <li class="nuns">7</li>
                <li>Horas</li>
            </ul>
            <ul class="ul_minutos">       
                <li class="nuns">40</li>
                <li>Minutos</li>
            </ul>
            <ul class="ul_segundos">
                <li class="nuns">10</li>
                <li>Segundos</li>
            </ul>
        </div>
        

        </div>
        <div class="ls">
            <img src="assets/img/horse.jpg" alt=""> <br>
            <hr> <br>
            <h4>
                Item de Exemplo 3
            </h4>
            <br> <hr><br>
            <p>R$ 9.000,00</p>
            <br><hr>
            <div class="uls">
                <ul class="ul_dias">
                    <li class="nuns">4</li>
                    <li>Dias</li>
                </ul>
                <ul class="ul_horas">
                    <li class="nuns">7</li>
                    <li>Horas</li>
                </ul>
                <ul class="ul_minutos">       
                    <li class="nuns">40</li>
                    <li>Minutos</li>
                </ul>
                <ul class="ul_segundos">
                    <li class="nuns">10</li>
                    <li>Segundos</li>
                </ul>
            </div>
               
        </div>
        <div class="ls">
                <img src="assets/img/horse.jpg" alt=""> <br> <hr> <br>
                <h4>
                    Item de Exemplo 4
                </h4>
                <br> <hr><br>
                <p>R$ 4.000,00</p>
                <br><hr>
                <div class="uls">
                    <ul class="ul_dias">
                        <li class="nuns">4</li>
                        <li>Dias</li>
                    </ul>
                    <ul class="ul_horas">
                        <li class="nuns">7</li>
                        <li>Horas</li>
                    </ul>
                    <ul class="ul_minutos">       
                        <li class="nuns">40</li>
                        <li>Minutos</li>
                    </ul>
                    <ul class="ul_segundos">
                        <li class="nuns">10</li>
                        <li>Segundos</li>
                    </ul>
                </div>
                
        </div>
            
    </div>
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