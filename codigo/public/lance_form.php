<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/session_usuarios.php';
    session_start(); verificar_sessao("Cliente");
    include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/navbar.html';
    // -----------------
    $id_cavalo = $_REQUEST['id_cavalo'];
    $sql = "SELECT * FROM tb_cavalo WHERE id_cavalo = ? ";
    $retorno = conectarDB("select", $sql, "i", [$id_cavalo]);

    $dados = $retorno[1][0];
    $nome_cavalo = $dados['nome_cavalo'];
    $raca_cavalo = $dados['raca_cavalo'];
    $pelagem_cavalo = $dados['pelagem_cavalo'];
    $premio_cavalo = $dados['premio_cavalo'];
    $modalidade_cavalo = $dados['modalidade_cavalo'];
    $img_cavalo = $dados['img_cavalo'];

    //-------------------
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
                $dados = $retorno_3[1][$indice];
                $lance_atual = $dados["valor_lance"];
            }
    }
    $_SESSION['id_cavalo'] = $id_cavalo;
    $valor_min = $lance_atual + 100;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/public/assets/css/form.css">
</head>
<body>
<?php

?>
<div class="lance">

    <div>
        
        <img src="assets/img/horse.jpg" alt="Imagem do cavalo <?= $nome_cavalo ?>" class="img">
        
        <h4>Nome: <?= $nome_cavalo ?></h4>
        
        <p>Raça: <?= $raca_cavalo ?></p>
        
        <p>Prêmios: <?= $premio_cavalo ?></p>
        
        <p>Modalidade: <?= $modalidade_cavalo ?></p>
        
        <p>Valor atual do lote: <?= $lance_atual ?></p> 
        
        <p>Data de fechamento: <?= $data_de_fechamento ?></p> 
        
    </div>
    
    <div>
        <h3>Escolha uma das opções abaixo ou defina sua proposta!</h3> 
        <div class="op_buttons">
            <ul>
    
    <?php 
        $opcao = $lance_atual + 100;
        $o = 1;
        for ($i=0; $i < 5; $i++) { 
    ?>
        <a href="/controle/controle_lance.php?lance_usuario=<?= $o?>&action=n_lance"><li><?= $opcao ?></li></a>
    
    <?php $opcao += 100; $o += 1;} ?>          
            </ul>
        </div>
        <div>
            <form action="/controle/controle_lance.php" class="div_form">
                <input type="hidden" value="n_lance" name="action">
                <input type="text" placeholder="Valor mínimo <?= $valor_min ?>" name="lance_usuario">
                <button type="submit" id="green">Enviar</button>
            </form>
        </div>
    </div>
</div>
    
</body>
</html>