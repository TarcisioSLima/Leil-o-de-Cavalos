<?php
    /**
     * Página de Visualização de Lotes (Tabela e Cartões)
     * 
     * Este arquivo exibe os lotes de cavalos em formato de tabela ou cartões, 
     * permitindo ao administrador visualizar lotes ativos e inativos, com opções de ações como
     * ver propostas, editar, anunciar e remover.
     *
     * @requires /helpers/verificador_lote.php
     * @requires /db/conexao.php
     * 
     * @param string $_REQUEST['view'] Define o modo de exibição:
     * - 'tableativo': Exibe lotes ativos em tabela.
     * - 'tableinativo': Exibe lotes inativos em tabela.
     * - 'cardativo': Exibe lotes ativos em cartões.
     * - 'cardinativo': Exibe lotes inativos em cartões.
     * 
     * @autor Samuel <samuelbatistadeb@gmail.com>
     */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<header class="header">
    <div>
       <img src="/public/assets/img/logo_estendida_verde.png" alt="" style='max-width: 350px; max-height: 350px;'>
    </div>   
    <link rel="stylesheet" href="/public/assets/css/cards.css">
</header>
<style>
    /* CSS da navbar */
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

    
    /* Estilização da tabela */    
            table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
                font-size: 1em;
                font-family: Arial, sans-serif;
                background-color: #fff;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            th, td {
                padding: 12px 15px;
                text-align: left;
                text-align: center;
            }

            th {
                background-color: #282e09;
                color: #fff;
                text-transform: uppercase;
                letter-spacing: 0.03em;
                
            }

            td {
                border-bottom: 1px solid #dddddd;
            }
            /* Estilos para a célula de ações */
                td.acao {
                    display: flex;
                    justify-content: space-between;
                    gap: 10px; /* Espaçamento entre os botões */
                }

                /* Estilo base para o link dentro das ações - Botões */
                td.acao a {
                    flex: 1;
                    text-align: center;
                    padding: 10px 15px; /* Espaçamento interno dos botões */
                    color: #b6ab9e; /* Cor do texto igual a .t_header a */
                    border-radius: 5px; /* Bordas arredondadas */
                    text-decoration: none; /* Remove o sublinhado */
                    transition: background-color 0.3s ease, transform 0.2s ease; /* Animações de hover */
                    font-size: 14px;
                    font-weight: bold;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Sombra dos botões */
                    width: 100%; /* Largura total */
                    display: inline-block;
                    background-color: #282e09;  /* Cor de fundo igual a .t_header a */
                }

                td.acao a:hover {
                    background-color: #53422a; /* Cor de fundo no hover igual a .t_header a:hover */
                    transform: translateY(-2px); /* Leve efeito de elevação no hover */
                }

                /* Ajusta o tamanho proporcionalmente quando há dois botões */
                td.acao a:nth-child(1), 
                td.acao a:nth-child(2) {
                    width: calc(50% - 5px); /* Dois botões, dividem o espaço */
                }

                /* Quando houver apenas um botão, ele ocupa a largura total */
                td.acao a:only-child {
                    width: 100%; /* Largura total quando houver um único botão */
                }

            tr:hover {
                background-color: #f1f1f1;
            }

            /* Alterna a cor das linhas para melhor visualização */
            tr:nth-child(even) {
                background-color: #f8f8f8;
            }

            /* Responsividade para dispositivos móveis */
            @media (max-width: 768px) {
                table {
                    font-size: 0.9em;
                }

                th, td {
                    padding: 10px;
                }
            }
            
</style>
<?php $view = $_REQUEST['view']; ?>

<div class="t_header">
    <ul>
        <li><a href="/public/index.php">Início</a></li>
        <li><a href="/public/dashboard/admin/index.php">Voltar</a></li>
        <?php if($view == "cardativo"){?>
        <li><a href="/public/dashboard/admin/lote/index.php?view=tableativo">Ver em tabela</a></li>
        <li><a href="/public/dashboard/admin/lote/selecionar_cavalo.php?view=card">Cadastrar novo lote</a></li><?php } else { ?>
        <li><a href="/public/dashboard/admin/lote/index.php?view=cardativo">Ver em card</a></li>
        <li><a href="/public/dashboard/admin/lote/selecionar_cavalo.php?view=card">Cadastrar novo lote</a></li><?php } ?>
    </ul>
</div>
        <!--Tabela com os ativos!   -->

    <?php 

    $view = $_REQUEST['view'];     

    if ($view == 'tableativo') { ?>
   
    <div>   
        <table>
            <thead>
                <tr>
                    <th>Valor</th>
                    <th>Data Fechamento</th>
                    <th>Estado</th>
                    <th>Ações</th>
                </tr>
            </thead>        
            <tbody>
                <?php
                include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/verificador_lote.php';
                include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';
                $sql = "SELECT * FROM tb_lote WHERE estado_lote = 'Ativo'";
                $retorno = conectarDB("select", $sql, "", []);

                foreach ($retorno[1] as $dados) { 
                    $valor_lote = $dados['valor_lote'];
                    $data_fechamento = $dados['data_fechamento'];
                    $data_fechamento_conversao = new DateTime($data_fechamento);
                    $data_final = $data_fechamento_conversao ->format('d/m/Y');
                    $estado_lote = $dados['estado_lote'];

                ?>
                <tr>
                    <td><?= $dados["valor_lote"]; ?></td>
                    <td><?= $data_final; ?></td>
                    <td><?= $dados["estado_lote"]; ?></td>
                    <td class="acao">

                    <a href='?caso=propostas'>Ver propostas</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

        <!-- Tabela com os inativos! -->  
        <?php }
        elseif ($view == 'tableinativo') { ?>
    <div>   
        <table>
            <thead>
                <tr>
                    <th>Valor</th>
                    <th>Data Fechamento</th>
                    <th>Estado</th>
                </tr>
            </thead>        
            <tbody>
                <?php
                include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';
                $sql = "SELECT * FROM tb_lote WHERE estado_lote = 'Inativo'";
                $retorno = conectarDB("select", $sql, "", []);

                foreach ($retorno[1] as $dados) { 
                    $valor_lote = $dados['valor_lote'];
                    $data_fechamento = $dados['data_fechamento'];
                    $estado_lote = $dados['estado_lote'];

                ?>
                <tr>
                    <td><?= $dados["valor_lote"]; ?></td>
                    <td><?= $dados["data_fechamento"]; ?></td>
                    <td><?= $dados["estado_lote"]; ?></td>
                    <td class="acao">
                            
                    <a href='?caso=editar'>Editar</a><div></div>
                    <a href='?caso=anunciar'>Anunciar</a>
                    <a href='/controle/controle_lote.php?caso=remover&id_lote=$id_lote'>Remover</a>
                  
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php } 
    
    elseif ($view == 'cardativo') { ?>
    <!-- Card ativos -->
        <div class="cards-container">
            <?php
                include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';
                $sql = "SELECT * FROM tb_lote WHERE estado_lote = 'Ativo'";
                $retorno = conectarDB("select", $sql, "", []);

                foreach ($retorno[1] as $dados) { 
                    // Dados do cavalo
                    $id_lote = $dados["id_lote"];
                    $valor_lote = $dados["valor_lote"];
                    $estado_lote = $dados["estado_lote"];
                    $data_fechamento = $dados["data_fechamento"];
                    // $data_fechamento_conversao = new DateTime($data_fechamento);
                    $data_final_final = date("d/m/Y", strtotime($data_fechamento));
                    // $data_final = $data_final_final ->format('d/m/Y');

            ?>
            <div class="card">
                <img src="<?= $img_cavalo?>" alt="Imagem do cavalo " class="card-img">
                <div class="card-content">
                <p class="card-text"><strong>Tempo restante: </strong></p>
                <div id="cronometro card-content" style="display: flex; gap: 10px; margin-top: 10px;">
                    <div id="dias-box" class="time-box" style="background-color: #f3f3f3; padding: 10px; border-radius: 5px; font-size: 16px; font-weight: bold; text-align: center; min-width: 50px;">
                        <span id="dias" style="display: block; font-size: 18px;"></span> d
                    </div>
                    <div id="horas-box" class="time-box" style="background-color: #f3f3f3; padding: 10px; border-radius: 5px; font-size: 16px; font-weight: bold; text-align: center; min-width: 50px;">
                        <span id="horas" style="display: block; font-size: 18px;"></span> h
                    </div>
                    <div id="minutos-box" class="time-box" style="background-color: #f3f3f3; padding: 10px; border-radius: 5px; font-size: 16px; font-weight: bold; text-align: center; min-width: 50px;">
                        <span id="minutos" style="display: block; font-size: 18px;"></span> m
                    </div>
                    <div id="segundos-box" class="time-box" style="background-color: #f3f3f3; padding: 10px; border-radius: 5px; font-size: 16px; font-weight: bold; text-align: center; min-width: 50px;">
                        <span id="segundos" style="display: block; font-size: 18px;"></span> s
                    </div>
                </div>
                    <p class="card-text"><strong>Valor:</strong> <?= $valor_lote ?></p>
                    <p class="card-text"><strong>Data de fechamento:</strong> <?= $data_final_final ?></p>
                    <p class="card-text"><strong>Situação:</strong> <?= $estado_lote ?></p>
                <div class="card-actions">
                    <a href="#" class="card-link">Ver propostas</a>
                    <a href="#" class="card-link">Pausar anuncio</a>
                </div>
                </div>
            </div></div>
                    <?php } ?>
        </div>

        
    <?php }
    elseif ($view == 'cardinativo') { ?>
    <!-- Card inativos -->
        <div class="cards-container">
            <?php
                include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';
                $sql = "SELECT * FROM tb_lote WHERE estado_lote = 'Inativo'";
                if (isset($sql)) {
                    echo "<h2>Nada por aqui ainda :(</h2>";
                }
                $retorno = conectarDB("select", $sql, "", []);

                foreach ($retorno[1] as $dados) { 
                    // Dados do cavalo
                    $id_lote = $dados["id_lote"];
                    $valor_lote = $dados["valor_lote"];
                    $data_fechamento = $dados["data_fechamento"];
                    $estado_lote = $dados["estado_lote"];
            ?>
            <div class="card">
                <img src="<?= $img_cavalo?>" alt="Imagem do cavalo" class="card-img">
                <div class="card-content">
                    <p class="card-text"><strong>Valor:</strong> <?= $valor_lote ?></p>
                    <p class="card-text"><strong>Data de fechamento:</strong> <?= $data_fechamento ?></p>
                    <p class="card-text"><strong>Situação:</strong> <?= $estado_lote ?></p>
                <div class="card-actions">                            
                        <a href="#" class="card-link">Editar</a>
                        <a href="#" class="card-link">Anunciar</a>
                        <a href="#" class="card-link">Remover</a>
                </div>
                </div>
            </div>
            <script>
                Cronometro("<?= $data_fechamento ?>", "timer-<?= $dados['id_lote'] ?>");
            </script>
                    <?php } ?>
        </div>
        
    <?php } 
    // else redirecionar("pagina_inicial", "")?>

</body>

    <script>
        // Passe a data de fechamento do PHP para o JavaScript
    const dataFinal = new Date("<?= $data_fechamento ?>").getTime();

// Atualize a contagem regressiva a cada segundo
const intervalo = setInterval(() => {
    const agora = new Date().getTime();
    const diferenca = dataFinal - agora;

    // Calcule os dias, horas, minutos e segundos restantes
    const dias = Math.floor(diferenca / (1000 * 60 * 60 * 24));
    const horas = Math.floor((diferenca % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutos = Math.floor((diferenca % (1000 * 60 * 60)) / (1000 * 60));
    const segundos = Math.floor((diferenca % (1000 * 60)) / 1000);

    // Atualize os elementos com os valores calculados
    document.getElementById('dias').innerText = dias;
    document.getElementById('horas').innerText = horas;
    document.getElementById('minutos').innerText = minutos;
    document.getElementById('segundos').innerText = segundos;

    // Se a contagem regressiva terminar, exiba uma mensagem
    if (diferenca < 0) {
        clearInterval(intervalo);
        document.getElementById('cronometro').innerHTML = "Contagem encerrada!";
    }
}, 1000);
    </script>

</html>
       