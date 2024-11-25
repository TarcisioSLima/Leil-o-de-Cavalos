<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campo de Valor em Reais</title>
    <script>
        function formatCurrency() {
            var input = document.getElementById('valor');
            var value = input.value.replace(/\D/g, '');
            value = (value/100).toFixed(2) + '';
            value = value.replace(".", ",");
            value = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            input.value = 'R$ ' + value;
        }
    </script>
</head>
<body>
    <form action="processar.php" method="post">
        <label for="valor">Valor (R$):</label>
        <input type="text" id="valor" name="valor" onkeyup="formatCurrency()" placeholder="R$ 0,00">
        <button type="submit">Enviar</button>
    </form>
</body>

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
        $sql = "SELECT * FROM tb_cavalo WHERE modalidade_cavalo = '3 Tambores'";
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
<h2 style="text-align: center;">Modalidade: Laço</h2>
<div class="swiper-container salto-carousel">
    <div class="swiper-wrapper">
        <?php
        $sql = "SELECT * FROM tb_cavalo WHERE modalidade_cavalo = 'Laço'";
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
<h2 style="text-align: center;">Modalidade: Vaquejada</h2>
<div class="swiper-container exposicao-carousel">
    <div class="swiper-wrapper">
        <?php
        $sql = "SELECT * FROM tb_cavalo WHERE modalidade_cavalo = 'Vaquejada'";
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

<!-- JavaScript para Inicializar os Carrosséis -->
<script>
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
</script>


<br><br><br><br><br><br>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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