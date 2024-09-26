<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/session_usuarios.php';
    session_start(); verificar_sessao("Admin");

    $sql = "SELECT * FROM tb_lote";
    $retorno = conectarDB("select", $sql, [], "");
    foreach ($retorno[1] as $dados) { 
        $id_lote = $dados['id_lote'];
        $titulo_lote = $dados['titulo_lote'];
        $valor_lote = $dados['valor_lote'];
        $estado_lote = $dados['estado_lote'];
        $tb_cavalo_id_cavalo = $dados['tb_cavalo_id_cavalo'];

        // Obter a data atual
        $data_atual = new DateTime();
        $data_fechamento = new DateTime('+7 days');

        // Calcular a diferença
        $diferenca = $data_atual->diff($data_fechamento);

        // Obter dias, horas, minutos e segundos
        $dias = $diferenca->d;
        $horas = $diferenca->h;
        $minutos = $diferenca->i;
        $segundos = $diferenca->s;

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
</header>
<?php $view = $_REQUEST['view']; ?>

<div class="t_header">
    <ul>
        <li><a href="/public/index.php">Início</a></li>
        <li><a href="/public/dashboard/admin/index.php">Voltar</a></li><?php if($view == "card"){?>
        <li><a href="/public/dashboard/admin/cavalo/form.php?view=card">Cadastrar novo lote</a></li><?php } else { ?>
        <li><a href="/public/dashboard/admin/cavalo/form.php?view=table">Cadastrar novo lote</a></li><?php } ?>
    </ul>
</div>

<?php if ($view == 'table') { ?>
    <!-- Tabela com os dados do cavalo! -->
    <div>   
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Valor</th>
                    <th>Data Fechamento</th>
                    <th>Estado</th>
                </tr>
            </thead>        
            <tbody>
                <?php
                include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';
                $sql = "SELECT * FROM tb_lote";
                $retorno = conectarDB("select", $sql, [], "");

                foreach ($retorno[1] as $dados) { 
                    $titulo_lote = $dados["titulo_lote"]; 
                    $valor_lote = $dados['valor_lote'];
                    $data_fechamento = $dados['data_fechamento'];
                    $estado_lote = $dados['estado_lote'];

                ?>
                <tr>
                    <td><?= $dados["titulo_lote"]; ?></td>
                    <td><?= $dados["valor_lote"]; ?></td>
                    <td><?= $dados["data_fechamento"]; ?></td>
                    <td><?= $dados["estado_lote"]; ?></td>
                    <td class="acao">
                        <!-- <?php  
                        // switch ($estado_lote) {
                        //     case 'Ativo':
                        //         echo "<a href='?caso=propostas'>Ver propostas</a>";
                        //         break;
                        //     case 'Inativo':
                        //         echo "<a href='?caso=editar'>Editar</a><div></div><a href='?caso=anunciar'>Anunciar</a>";
                        //         break;
                        //     case 'Vendido':
                        //         echo "<a href='/controle/controle_cavalo.php?caso=remover&id_cavalo=$id_cavalo'>Remover</a>";
                        //         break;
                        //     default:
                        //         echo '-';
                        //         break;
                        // } ?>-->
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
                $sql = "SELECT * FROM tb_lote";
                $retorno = conectarDB("select", $sql, [], "");

                foreach ($retorno[1] as $dados) { 
                    // Dados do cavalo
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
                        <img src="<?= $img_cavalo?>" alt="Imagem do cavalo <?= $nome_cavalo ?>" class="card-img">
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
                                    echo '<a href="#" class="card-link">Ver propostas</a>';
                                    break;
                                case 'Inativo':
                                    echo '<a href="#" class="card-link">Editar</a>';
                                    echo '<a href="#" class="card-link">Anunciar</a>';
                                    break;
                                case 'Vendido':
                                    echo '<a href="#" class="card-link">Remover</a>';
                                    break;
                                default:
                                    // Caso não faça nada
                                    break;
                            }?>
                        </div>
                        </div>
                    </div>
                <?php } ?>
        </div>
        
    <?php } else redirecionar("pagina_inicial", "")?>


        <!-- <div class="lotes">
                    <div class="ls">
                        <img src="assets/img/horse.jpg" alt="" style="max-width: 100%; border-radius: 10px;  object-fit: cover;"> <br>
                        <hr> <br>
                        <h4>
                        <?= $titulo_lote?>
                        </h4> <br>
                        <hr><br>
                        <p><?= $valor_lote?></p>
                        <br>
                        <hr>
                        <p <?php if ($estado_lote == 'Disponível') {
                            echo "class='disponivel'";} 
                            else {echo "class='finalizado'";}?> ><?= $estado_lote?></p>
                        <br>
                        <hr>
                    <div class="uls">
                            <ul class="ul_dias">
                                <li class="nuns"><?= $dias?></li>
                                <li>Dias</li>
                            </ul>
                            <ul class="ul_horas">
                                <li class="nuns"><?= $horas?></li>
                                <li>Horas</li>
                            </ul>
                            <ul class="ul_minutos">       
                                <li class="nuns"><?= $minutos?></li>
                                <li>Minutos</li>
                            </ul>
                            <ul class="ul_segundos">
                                <li class="nuns"><?= $segundos?></li>
                                <li>Segundos</li>
                            </ul>
                        
                    </div>
                </div>

            <?php } ?>  
        ?> -->
    
</body>
</html>
       