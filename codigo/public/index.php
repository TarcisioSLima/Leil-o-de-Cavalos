<?php
    /**
         * Index
         * 
         * Este script cria várias coisas no sistema.
         * 
         * @file index.php
         * @requires /db/conexao.php       Conexão com o banco de dados.
         * 
         * @autor Tarcísio e Samuel <seu_email@example.com>
    */

   // Inicia uma nova sessão ou retoma a sessão existente
    session_start();
    
    // Inclui o arquivo de conexão com o banco de dados
    include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';
    
    // Inclui o arquivo que contém funções relacionadas ao verificador de lotes
    include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/verificador_lote.php';
?>

<!-- Início do código HTML -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- Definição da codificação de caracteres como UTF-8 -->
    <meta charset="UTF-8">
    <!-- Definição da viewport para dispositivos móveis -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Título da página -->
    <title>Quarter Horse</title>

    <!-- Link para o arquivo de estilos CSS da navegação -->
    <link rel="stylesheet" href="assets/css/nav.css">
    
    <!-- Inclusão da biblioteca Font Awesome para ícones -->
    <script src="https://kit.fontawesome.com/bc42253982.js" crossorigin="anonymous"></script>
    
    <!-- Inclusão da biblioteca Animate.css para animações -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <!-- Estilos CSS internos para personalizar a página -->
    <style>
        /* Container geral que envolve os elementos da página */
        .container {
            display: flex;  /* Usando Flexbox para layout */
            max-width: 1200px;  /* Define a largura máxima do container */
            margin: 0 auto;  /* Centraliza o container */
            padding: 20px;  /* Define o padding dentro do container */
        }

         /* Estilos do card de categorias */
         .card_categorias {
            width: 25%;  /* Largura de 25% para o card */
            margin-right: 20px;  /* Espaço à direita do card */
        }  

        /* Estilos da lista de categorias */
        .u_categorias {
            display: flex;  /* Usando Flexbox para layout da lista */
            flex-direction: column;  /* Os itens da lista vão se empilhar verticalmente */
            list-style: none;  /* Remove os marcadores da lista */
            border: 1px solid rgb(210, 209, 209);  /* Borda cinza para a lista */
            background-color: #f7f7f7;  /* Cor de fundo para a lista */
            border-radius: 10px;  /* Arredonda os cantos da lista */
            overflow: hidden;  /* Garante que não haja transbordamento do conteúdo */
        }

        /* Estilos dos itens da lista */
        .u_categorias li {
            border-bottom: 1px solid rgb(210, 209, 209);  /* Borda inferior entre os itens */
        }

        /* Estilos dos links dentro da lista de categorias */
        .u_categorias a {
            text-decoration: none;  /* Remove o sublinhado dos links */
            color: #191c06;  /* Cor do texto dos links */
            display: flex;  /* Usando Flexbox para alinhar ícones e texto */
            align-items: center;  /* Alinha verticalmente o conteúdo */
            padding: 15px 20px;  /* Define o padding do link */
            font-size: 1em;  /* Tamanho da fonte */
            transition: background-color 0.3s ease;  /* Transição suave para mudança de cor de fundo */
        }

        /* Efeito ao passar o mouse sobre os links */
        .u_categorias a:hover {
            background-color: #dedddd;  /* Altera a cor de fundo ao passar o mouse */
        }

        /* Estilos para o ícone dentro dos links */
        .u_categorias i {
            margin-right: 10px;  /* Espaço à direita do ícone */
            font-size: 1.2em;  /* Tamanho do ícone */
        }

        /* Estilos do card de destaque */
        .card {
            width: 70%;  /* Largura de 70% para o card */
            height: auto;  /* Altura automática para o card */
            background-color: #282e09;  /* Cor de fundo do card */
            border-radius: 10px;  /* Arredonda os cantos do card */
            display: flex;  /* Usando Flexbox para layout do card */
            justify-content: space-between;  /* Espaço igual entre os itens dentro do card */
            padding: 20px;  /* Padding interno do card */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  /* Sombra suave ao redor do card */
            margin-top: 2%;  /* Espaço superior para o card */
        }

        /* Estilos da lista dentro do card */
        .card ul {
            list-style: none;  /* Remove os marcadores da lista */
            color: #b6ab9e;  /* Cor do texto */
            padding: 0;  /* Remove o padding da lista */
            margin: 0;  /* Remove a margem da lista */
            width: 50%;  /* Largura de 50% para a lista dentro do card */
        }

        /* Estilos para o primeiro item da lista no card */
        .card li:first-child {
            font-size: 1.8em;  /* Tamanho maior para o primeiro item */
            margin-bottom: 10px;  /* Espaço abaixo do primeiro item */
        }

        /* Estilos para os demais itens da lista no card */
        .card li {
            font-size: 1.2em;  /* Tamanho da fonte para os itens */
            margin-bottom: 8px;  /* Espaço abaixo dos itens */
        }
        /* Imagem do cavalo */
        .card img {
            width: 100%;  /* Define a largura da imagem como 100% do seu container */
            height: auto;  /* Mantém a proporção da imagem */
            border-radius: 10px;  /* Arredonda os cantos da imagem */
            object-fit: cover;  /* A imagem cobrirá o espaço disponível sem distorção */
            max-height: 300px;  /* Define a altura máxima da imagem */
            border: 2px solid #b6ab9e;  /* Borda ao redor da imagem */
            margin-left: 10px;  /* Espaço à esquerda da imagem */
        }  

        /* Estilo para os lotes de cavalos */
        .lotes {
            display: flex;  /* Usando Flexbox para layout dos lotes */
            flex-wrap: wrap;  /* Permite que os itens se quebrem para a próxima linha se necessário */
            gap: 20px;  /* Espaço entre os itens */
            justify-content: flex-start;  /* Alinha os itens no início */
            margin-top: 30px;  /* Espaço superior */
            align-items: flex-start;  /* Alinha os itens no início da linha */
        }

        /* Estilo dos cards de lotes */
        .ls {
            width: 30%;  /* Define a largura do card de lote como 30% do container */
            background-color: #f7f7f7;  /* Cor de fundo do card */
            padding: 15px;  /* Espaçamento interno do card */
            border-radius: 10px;  /* Arredonda os cantos do card */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  /* Sombra suave ao redor do card */
            transition: transform 0.3s ease;  /* Transição suave ao passar o mouse */
            flex-grow: 1;  /* Permite que o card ocupe mais espaço se houver espaço disponível */
            flex-shrink: 0;  /* Impede que o card encolha além do tamanho especificado */
        }

        /* Efeito ao passar o mouse sobre os cards de lote */
        .ls:hover {
            transform: translateY(-5px);  /* Move o card para cima ao passar o mouse */
        }

        /* Estilo da imagem dentro do card de lote */
        .ls img {
            width: 100%;  /* A imagem ocupa toda a largura do card */
            height: auto;  /* Mantém a proporção da imagem */
            border-radius: 10px;  /* Arredonda os cantos da imagem */
            object-fit: cover;  /* Faz com que a imagem cubra o espaço disponível */
            margin-bottom: 15px;  /* Espaço abaixo da imagem */
        }

        /* Estilos para os textos dentro do card de lote */
        .ls h4, .ls p {
            color: #191c06;  /* Cor do texto */
            margin-bottom: 10px;  /* Espaço abaixo dos textos */
        }

        /* Estilo para a linha horizontal dentro do card */
        .ls hr {
            border: 1px solid #d1d1d1;  /* Linha de separação com cor cinza clara */
        }

        /* Responsividade - Ajuste para telas médias */
        @media (max-width: 768px) {
            .ls {
                width: 48%;  /* Ajusta o card para ocupar 48% da largura em telas médias */
            }
        }

        /* Responsividade - Ajuste para telas pequenas */
        @media (max-width: 480px) {
            .ls {
                width: 100%;  /* Ajusta o card para ocupar 100% da largura em telas pequenas */
            }
        }
    </style>

</head>
<body>
    <!-- Cabeçalho da página -->
    <header class="header">
        <!-- Logo do site -->
        <div class="logo" >
           <!-- Imagem do logo com limite de tamanho -->
           <img src="assets/img/logo_verde.png" alt="" style="max-width: 200px; max-height: 200px;">
        </div>

        <!-- Formulário de pesquisa -->
        <form action="index.php">
            <div class="search-container">
                <!-- Seleção de filtro para pesquisa -->
                <select name="filtro" id="" class="search-box">
                    <!-- Opções de filtro para pesquisa -->
                    <option value="sem_filtro" selected >Sem filtro</option>
                    <option value="raca_cavalo" <?php if (isset($_REQUEST['filtro']) && $_REQUEST['filtro'] == 'raca_cavalo') {echo 'selected';} ?>>Raça</option>
                    <option value="pelagem_cavalo" <?php if (isset($_REQUEST['filtro']) && $_REQUEST['filtro'] == 'pelagem_cavalo') {echo 'selected';} ?>>Pelagem</option>
                    <option value="premio_cavalo" <?php if (isset($_REQUEST['filtro']) && $_REQUEST['filtro'] == 'premio_cavalo') {echo 'selected';} ?>>Prêmio</option>
                </select>    
                <!-- Campo de texto para pesquisa -->
                <input type="text" placeholder="Digite aqui" class="search-box" value="<?= isset($_REQUEST['texto']) ? $_REQUEST['texto'] : '' ?>" name="texto">
                <!-- Botão de envio do formulário de pesquisa -->
                <button type="submit" class="search-button">
                    <!-- Ícone da lupa para pesquisa -->
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                </button>
                
            </div>
        </form>
        
        <!-- Botões de autenticação -->
        <div class="auth-buttons">
            <ul> 
                <!-- Se o usuário não estiver logado -->
                <?php if (!isset($_SESSION["tipo_usuario"])) {  ?>
                    <!-- Link para login -->
                    <li>
                        <a href="dashboard/cliente/index.php" id="button1" class="" onmouseover="animate_y1()" onmouseout="animate_n1()">
                            <i class="fa-solid fa-user-check"></i> Login
                        </a>
                    </li>
                    <!-- Link para cadastro -->
                    <li>
                        <a href="dashboard/cliente/form.php" id="button2" class="" onmouseover="animate_y2()" onmouseout="animate_n2()">
                            <i class="fa-solid fa-user-plus"></i> Cadastrar-se
                        </a>
                    </li>
                
                <!-- Se o usuário for um administrador -->
                <?php } elseif (isset($_SESSION["tipo_usuario"]) AND $_SESSION["tipo_usuario"] == "Admin") { ?>
                    <!-- Link para o painel do administrador -->
                    <li>
                        <a href="dashboard/admin/index.php" id="button1" class="" onmouseover="animate_y1()" onmouseout="animate_n1()">
                            Painel <i class="fa-solid fa-screwdriver-wrench"></i> 
                        </a>
                    </li>
                    <!-- Link para sair da conta (logout) -->
                    <li>
                        <a href="/controle/controle_usuario.php?caso=logout" id="button2" class="" onmouseover="animate_y2()" onmouseout="animate_n2()">
                        Sair <i class="fa-solid fa-person-walking-arrow-right"></i>
                        </a>
                    </li>
                    <?php } ?>

                    // Verifica se o usuário está logado e qual tipo de usuário (Cliente)
<!-- Botões Cliente logado -->

<?php 
// Condição para verificar se a variável 'tipo_usuario' está definida na sessão e se o valor é 'Cliente' 
if (isset($_SESSION["tipo_usuario"]) AND $_SESSION["tipo_usuario"] == "Cliente") { ?>
    <!-- Exibe o botão com o nome do cliente logado e o link para o perfil do cliente -->
    <li>
        <a href="dashboard/cliente/perfil.php" id="button1" class="" onmouseover="animate_y1()" onmouseout="animate_n1()">
            <!-- Ícone de identificação -->
            <i class="fa-regular fa-id-card"></i> 
            <?php 
                // Recupera o nome do usuário da sessão e exibe uma saudação personalizada
                $nome_usuario = $_SESSION['nome_usuario']; 
                echo " Olá $nome_usuario"; 
            ?>
        </a>
    </li>

    <!-- Exibe o botão para logout, direcionando para a URL que faz o logout -->
    <li>
        <a href="/controle/controle_usuario.php?caso=logout" id="button2" class="" onmouseover="animate_y2()" onmouseout="animate_n2()">
            Sair <!-- Ícone indicando a ação de sair -->
            <i class="fa-solid fa-person-walking-arrow-right"></i>
        </a>
    </li>
<?php } ?>
</ul>

</div>

</header>

<!-- Barra de navegação superior -->
<div class="t_header">
    <ul>
        <!-- Link para a página inicial -->
        <li><a href="/public/index.php">Início</a></li>
        <!-- Link para a página "Quem Somos" -->
        <li><a href="/public/quarter_horse.php">Quem Somos</a></li>
        <!-- Link para a página onde o cliente pode ver os cavalos -->
        <li><a href="../public/dashboard/cliente/lote.php?view=cardativo">Ver cavalos</a></li>
    </ul>
</div>

<?php 
    // Verifica se não há parâmetros 'texto' ou 'filtro' na requisição
    if (!isset($_REQUEST["texto"]) && !isset($_REQUEST["filtro"])) { ?>
        <!-- Início do container para o conteúdo principal -->
        <div class="container">
            <!-- Menu lateral com as categorias de cavalos em destaque -->
            <div class="card_categorias">
                <ul class="u_categorias">
                    <!-- Link para exibir cavalos em destaque -->
                    <li><a href="index.php">
                        <i class="fa-solid fa-horse"></i>Cavalos em Destaque</a>
                    </li>    
                    <?php 
                    // Consulta ao banco para pegar os cavalos destacados e com situação ativa
                    $sql = "SELECT * FROM tb_cavalo WHERE destaque = 'Sim' AND situacao_cavalo = 'Ativo'";
                    $retorno = conectarDB("select", $sql, "", []);
                    // Variável que controla a numeração dos cavalos destacados
                    $num = 1;
                    // Exibe até 3 cavalos destacados
                    foreach ($retorno[1] as $dados) { ?>
                        <li><a href="index.php?cavalo_d=<?=$num?>">
                            <!-- Exibe o número do cavalo destacado para identificação -->
                            <i class="fa-solid fa-<?=$num?>"></i>Cavalo em destaque</a>
                        </li>
                    <?php
                        // Limita a exibição a 3 cavalos
                        if ($num >= 4) break; 
                        $num += 1; 
                    } ?>
                </ul>
            </div>

            <!-- Verifica se há um cavalo selecionado -->
            <?php if (isset($_REQUEST["cavalo_d"])) {
                // Recupera o identificador do cavalo selecionado
                $cavalo_d = $_REQUEST['cavalo_d'];
                // Consulta os cavalos destacados e ativos
                $sql = "SELECT * FROM tb_cavalo WHERE destaque = 'Sim' AND situacao_cavalo = 'Ativo' ORDER BY id_cavalo";
                $retorno = conectarDB("select", $sql, "", []);
                // Variável para controle de iteração sobre os cavalos destacados
                $contador = 1;
                // Itera sobre os cavalos destacados
                foreach ($retorno[1] as $dados) { 
                    // Se o cavalo atual é o selecionado, exibe suas informações
                    if ($contador == $cavalo_d) {
                        // Variáveis para armazenar dados do cavalo selecionado
                        $id_cavalo = $dados['id_cavalo']; // Identificador do cavalo
                        // Consulta o lote relacionado ao cavalo
                        $sql_2 = "SELECT * FROM tb_lote WHERE tb_cavalo_id_cavalo = ?";
                        $retorno_2 = conectarDB("select", $sql_2, "i", [$id_cavalo]);
                        
                        // Verifica se o cavalo tem um lote associado
                        if (sizeof($retorno_2[1]) > 0) {
                            // Variáveis para armazenar dados do lote
                            $dados_2 = $retorno_2[1][0]; // Dados do lote
                            $id_lote = $dados_2["id_lote"]; // Identificador do lote
                            $valor_inicial_lote = $dados_2["valor_lote"]; // Valor inicial do lote
                            $data_de_fechamento = $dados_2["data_fechamento"]; // Data de fechamento do lote
                        
                            // Consulta os lances registrados para o lote
                            $sql = "SELECT * FROM tb_lance WHERE tb_lote_id_lote = ? ORDER BY valor_lance";
                            $retorno_3 = conectarDB("select", $sql, "i", [$id_lote]);
                            // Se não houver lances, o valor inicial é considerado o lance atual
                            if (sizeof($retorno_3[1]) == 0) {
                                $lance_atual = $valor_inicial_lote; 
                            } else {
                                // Caso haja lances, usa o valor do último lance
                                $indice = sizeof($retorno_3[1]) - 1; 
                                $dados_1 = $retorno_3[1][$indice]; // Dados do último lance
                                $lance_atual = $dados_1["valor_lance"]; // Valor do último lance
                            }
                        }

                        // Variáveis para armazenar informações principais do cavalo
                        $dados_basicos = [
                            $nome_cavalo = ("Nome: " . $dados["nome_cavalo"]), // Nome do cavalo
                            $raca_cavalo = ("Raça: " . $dados["raca_cavalo"]), // Raça do cavalo
                            $pelagem_cavalo = ("Pelagem: " . $dados["pelagem_cavalo"]), // Pelagem do cavalo
                            $premio_cavalo = ("Prêmio: " . $dados["premio_cavalo"]), // Prêmio do cavalo
                            $modalidade_cavalo = ("Modalidade: " . $dados["modalidade_cavalo"]), // Modalidade do cavalo
                            $valor_lote_atual = ("Valor atual do Lote: " . $lance_atual), // Valor atual do lote
                            $fechamento =  ("Data de fechamento: " . $data_de_fechamento) // Data de fechamento do lote
                        ];
                        // Variáveis para armazenar a imagem e situação do cavalo
                        $img_cavalo = $dados["img_cavalo"]; // Imagem do cavalo
                        $situacao_cavalo = $dados["situacao_cavalo"]; // Situação do cavalo
                    }
                    // Incrementa o contador para iterar sobre os cavalos destacados
                    $contador += 1;
                }
            ?>
            <!-- Exibe as informações detalhadas do cavalo selecionado -->
            <div class="card">
                <ul>
                    <?php 
                    // Exibe todas as informações armazenadas no array $dados_basicos
                    foreach ($dados_basicos as $dado) { ?>
                        <li><?= $dado; ?></li>
                    <?php } ?>
                </ul>
                <ul>
                    <!-- Exibe a imagem do cavalo -->
                    <img src="<?= $img_cavalo ?>" alt="Imagem do cavalo <?= $nome_cavalo ?>" class="img">
                </ul>
                <ul>
                    <!-- Link para dar um lance no cavalo -->
                    <a href="lance_form.php?id_cavalo=<?=$id_cavalo?>&action=dar_lance">Dar lance</a>
                </ul>
            </div>
        <?php } else { ?>
            <!-- Caso não haja um cavalo selecionado, exibe uma imagem padrão -->
            <div class="main-content"> 
                <img src="assets/img/test.png" alt="" class="img_i"> 
            </div>
        <?php } ?>
    </div>

<!-- Inclusão do CSS e JavaScript do Swiper -->
<!-- O Swiper é uma biblioteca que permite criar carrosséis (sliders) interativos para a exibição de conteúdo -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<style>
    /* Estilo para o container do carrossel (Swiper) */
    .swiper-container {
        max-width: 80%; /* Define a largura máxima do carrossel */
        margin: 0 auto; /* Centraliza o carrossel horizontalmente */
        position: relative; /* Define a posição do container para permitir a sobreposição de elementos */
    }

    /* Estilo para os cards exibidos no carrossel */
    .card {
        background-color: #fff; /* Cor de fundo do card */
        border-radius: 8px; /* Borda arredondada para os cards */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra suave para os cards */
        padding: 15px; /* Espaçamento interno do card */
        text-align: left; /* Alinha o texto à esquerda dentro do card */
        width: 90%; /* Define a largura do card */
    }

    /* Estilo para a imagem dentro dos cards */
    .card-img {
        width: 100%; /* Faz a imagem ocupar toda a largura do card */
        height: auto; /* Mantém a proporção da imagem */
        max-height: 200px; /* Define uma altura máxima para a imagem */
        object-fit: cover; /* Faz a imagem cobrir todo o espaço disponível, cortando o excesso */
        border-radius: 8px; /* Borda arredondada para a imagem */
    }

    /* Estilo para o conteúdo do card (texto e botões) */
    .card-content {
        text-align: left; /* Alinha o conteúdo do card à esquerda */
    }

    /* Estilo para os botões de navegação do Swiper (setas) */
    .swiper-button-next, .swiper-button-prev {
        color: #000; /* Cor das setas */
        position: absolute; /* Posiciona as setas em relação ao carrossel */
        top: 50%; /* Posiciona verticalmente no meio do carrossel */
        transform: translateY(-50%); /* Centraliza as setas verticalmente */
        width: 40px; /* Largura da seta */
        height: 40px; /* Altura da seta */
        z-index: 10; /* Garante que as setas fiquem acima do conteúdo */
    }

    /* Posição das setas fora da área dos cards */
    .swiper-button-next {
        right: -30px; /* Posiciona a seta à direita */
    }

    .swiper-button-prev {
        left: -30px; /* Posiciona a seta à esquerda */
    }
</style>

<!-- Carrossel para a modalidade Corrida -->
<h2 style="text-align: center;">Modalidade: 3 Tambores</h2>
<div class="swiper-container corrida-carousel">
    <div class="swiper-wrapper">
        <?php
        // Consulta ao banco de dados para obter cavalos da modalidade "3 Tambores" que estão ativos
        $sql = "SELECT * FROM tb_cavalo WHERE modalidade_cavalo = '3 Tambores' AND situacao_cavalo = 'Ativo' ";
        $retorno = conectarDB("select", $sql, "", []);
        // Itera sobre os cavalos retornados
        foreach ($retorno[1] as $dados) {
            // Atribui dados do cavalo a variáveis
            $nome_cavalo = $dados['nome_cavalo'];
            $raca_cavalo = $dados['raca_cavalo'];
            $pelagem_cavalo = $dados['pelagem_cavalo'];
            $premio_cavalo = $dados['premio_cavalo'];
            $img_cavalo = $dados['img_cavalo'];
        ?>
        <div class="swiper-slide">
            <!-- Card para exibir informações sobre o cavalo -->
            <div class="card lotes">
                <!-- Exibe a imagem do cavalo -->
                <img src="<?= $img_cavalo ?>" alt="Imagem do cavalo <?= $nome_cavalo ?>" class="card-img">
                <div class="card-content">
                    <!-- Exibe o nome do cavalo -->
                    <h3 class="card-title"><?= $nome_cavalo ?></h3>
                    <!-- Exibe o tempo restante do leilão (ainda não calculado, mas espaço para inserção futura) -->
                    <p class="card-text"><strong>Tempo restante:</strong> </p>
                    <!-- Exibe informações adicionais sobre o cavalo -->
                    <p class="card-text"><strong>Raça:</strong> <?= $raca_cavalo ?></p>
                    <p class="card-text"><strong>Pelagem:</strong> <?= $pelagem_cavalo ?></p>
                    <p class="card-text"><strong>Prêmios:</strong> <?= $premio_cavalo ?></p>
                    <div class="card-actions">
                        <!-- Link para dar lance no cavalo (ainda sem implementação de funcionalidade) -->
                        <a href="#" class="card-link">Dar lance</a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <!-- Botões de navegação do Swiper -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>

<!-- Carrossel para a modalidade Laço -->
<p><h2 style="text-align: center;">Modalidade: Laço</h2></p>
<div class="swiper-container salto-carousel">
    <div class="swiper-wrapper">
        <?php
        // Consulta ao banco de dados para obter cavalos da modalidade "Laço" que estão ativos
        $sql = "SELECT * FROM tb_cavalo WHERE modalidade_cavalo = 'Laço' AND situacao_cavalo = 'Ativo'";
        $retorno = conectarDB("select", $sql, "", []);
        // Itera sobre os cavalos retornados
        foreach ($retorno[1] as $dados) {
            // Atribui dados do cavalo a variáveis
            $nome_cavalo = $dados['nome_cavalo'];
            $raca_cavalo = $dados['raca_cavalo'];
            $pelagem_cavalo = $dados['pelagem_cavalo'];
            $premio_cavalo = $dados['premio_cavalo'];
            $img_cavalo = $dados['img_cavalo'];
        ?>
        <div class="swiper-slide">
            <!-- Card para exibir informações sobre o cavalo -->
            <div class="card lotes">
                <!-- Exibe a imagem do cavalo -->
                <img src="<?= $img_cavalo ?>" alt="Imagem do cavalo <?= $nome_cavalo ?>" class="card-img">
                <div class="card-content">
                    <!-- Exibe o nome do cavalo -->
                    <h3 class="card-title"><?= $nome_cavalo ?></h3>
                    <!-- Exibe o tempo restante do leilão (ainda não calculado, mas espaço para inserção futura) -->
                    <p class="card-text"><strong>Tempo restante:</strong> </p>
                    <!-- Exibe informações adicionais sobre o cavalo -->
                    <p class="card-text"><strong>Raça:</strong> <?= $raca_cavalo ?></p>
                    <p class="card-text"><strong>Pelagem:</strong> <?= $pelagem_cavalo ?></p>
                    <p class="card-text"><strong>Prêmios:</strong> <?= $premio_cavalo ?></p>
                    <div class="card-actions">
                        <!-- Link para dar lance no cavalo (ainda sem implementação de funcionalidade) -->
                        <a href="#" class="card-link">Dar lance</a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <!-- Botões de navegação do Swiper -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>

<!-- Carrossel para a modalidade Vaquejada -->
<p><h2 style="text-align: center;">Modalidade: Vaquejada</h2></p>
<div class="swiper-container exposicao-carousel">
    <div class="swiper-wrapper">
        <?php
        // Consulta ao banco de dados para obter cavalos da modalidade "Vaquejada" que estão ativos
        $sql = "SELECT * FROM tb_cavalo WHERE modalidade_cavalo = 'Vaquejada' AND situacao_cavalo = 'Ativo'";
        $retorno = conectarDB("select", $sql, "", []);
        // Itera sobre os cavalos retornados
        foreach ($retorno[1] as $dados) {
            // Atribui dados do cavalo a variáveis
            $nome_cavalo = $dados['nome_cavalo'];
            $raca_cavalo = $dados['raca_cavalo'];
            $pelagem_cavalo = $dados['pelagem_cavalo'];
            $premio_cavalo = $dados['premio_cavalo'];
            $img_cavalo = $dados['img_cavalo'];
        ?>
        <div class="swiper-slide">
            <!-- Card para exibir informações sobre o cavalo -->
            <div class="card lotes">
                <!-- Exibe a imagem do cavalo -->
                <img src="<?= $img_cavalo ?>" alt="Imagem do cavalo <?= $nome_cavalo ?>" class="card-img">
                <div class="card-content">
                    <!-- Exibe o nome do cavalo -->
                    <h3 class="card-title"><?= $nome_cavalo ?></h3>
                    <!-- Exibe o tempo restante do leilão (ainda não calculado, mas espaço para inserção futura) -->
                    <p class="card-text"><strong>Tempo restante:</strong> </p>
                    <!-- Exibe informações adicionais sobre o cavalo -->
                    <p class="card-text"><strong>Raça:</strong> <?= $raca_cavalo ?></p>
                    <p class="card-text"><strong>Pelagem:</strong> <?= $pelagem_cavalo ?></p>
                    <p class="card-text"><strong>Prêmios:</strong> <?= $premio_cavalo ?></p>
                    <div class="card-actions">
                        <!-- Link para dar lance no cavalo (ainda sem implementação de funcionalidade) -->
                        <a href="#" class="card-link">Dar lance</a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <!-- Botões de navegação do Swiper -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>

 
 <?php } ?>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<!-- Inclusão da biblioteca Swiper para criação de carrosséis -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Inclusão do Bootstrap JS para funcionalidades interativas, como modais e botões -->

<script>
    /** 
     * Inicialização dos Carrosséis
     * 
     * As variáveis abaixo configuram os carrosséis para diferentes modalidades de cavalos
     * utilizando a biblioteca Swiper. Cada carrossel possui navegação, controle de repetição
     * e exibe três slides por vez.
     */
    
    // Inicializa o carrossel para a modalidade Corrida
    var corridaCarousel = new Swiper('.corrida-carousel', {
        loop: true,  // Faz o carrossel girar infinitamente
        navigation: {
            nextEl: '.corrida-carousel .swiper-button-next', // Botão de navegação para o próximo slide
            prevEl: '.corrida-carousel .swiper-button-prev', // Botão de navegação para o slide anterior
        },
        slidesPerView: 3, // Exibe 3 slides por vez no carrossel
        spaceBetween: 30, // Define o espaçamento entre os slides
    });

    // Inicializa o carrossel para a modalidade Salto
    var saltoCarousel = new Swiper('.salto-carousel', {
        loop: true,  // Faz o carrossel girar infinitamente
        navigation: {
            nextEl: '.salto-carousel .swiper-button-next', // Botão de navegação para o próximo slide
            prevEl: '.salto-carousel .swiper-button-prev', // Botão de navegação para o slide anterior
        },
        slidesPerView: 3, // Exibe 3 slides por vez no carrossel
        spaceBetween: 30, // Define o espaçamento entre os slides
    });

    // Inicializa o carrossel para a modalidade Exposição
    var exposicaoCarousel = new Swiper('.exposicao-carousel', {
        loop: true,  // Faz o carrossel girar infinitamente
        navigation: {
            nextEl: '.exposicao-carousel .swiper-button-next', // Botão de navegação para o próximo slide
            prevEl: '.exposicao-carousel .swiper-button-prev', // Botão de navegação para o slide anterior
        },
        slidesPerView: 3, // Exibe 3 slides por vez no carrossel
        spaceBetween: 30, // Define o espaçamento entre os slides
    });

    /**
     * Funções para animação dos botões.
     * Estas funções são usadas para adicionar e remover classes de animação aos botões.
     */

    // Função para adicionar animação no botão 1
    function animate_y1() {
        document.getElementById("button1").classList.add('animate__animated', 'animate__pulse');  // Adiciona animação de "pulse"
    }

    // Função para remover animação no botão 1
    function animate_n1() {
        document.getElementById("button1").classList.remove('animate__animated', 'animate__pulse');  // Remove a animação de "pulse"
    }

    // Função para adicionar animação no botão 2
    function animate_y2() {
        document.getElementById("button2").classList.add('animate__animated', 'animate__pulse');  // Adiciona animação de "pulse"
    }

    // Função para remover animação no botão 2
    function animate_n2() {
        document.getElementById("button2").classList.remove('animate__animated', 'animate__pulse');  // Remove a animação de "pulse"
    }
</script>
</body>
</html>