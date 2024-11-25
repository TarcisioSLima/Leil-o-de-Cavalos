<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/session_usuarios.php';

// Inicia sessão e verifica se o usuário possui a permissão "Admin"
session_start();
verificar_sessao("Admin");
$forma = $_REQUEST['e'];
include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/navbar.html';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/public/assets/css/lance_painel.css">
    <script src="https://kit.fontawesome.com/bc42253982.js" crossorigin="anonymous"></script>

</head>
<body>
    <div class="main">

    
    <?php

        if ($forma == 't') {
            $id_lote = $_REQUEST['id_lote'];
        }elseif ($forma == 'f') {

            $sql_lotes = "SELECT * FROM tb_lote ORDER BY data_fechamento";
            $retorno_lotes = conectarDB("select", $sql_lotes, "", []);
            foreach ($retorno_lotes[1] as $dados_lote) {

                $id_lote = $dados_lote['id_lote'];
                $valor_inicial_lote = $dados_lote['valor_lote'];
                $id_cavalo = $dados_lote['tb_cavalo_id_cavalo'];

                $sql_cavalo = "SELECT * FROM tb_cavalo WHERE id_cavalo = $id_cavalo";
                $retorno_cavalo = conectarDB("select", $sql_cavalo, "", []); 
                $dados_cavalo = $retorno_cavalo[1][0];
                    $nome_cavalo = $dados_cavalo['nome_cavalo'];
                    $raca_cavalo = $dados_cavalo['raca_cavalo'];
                    $destaque = $dados_cavalo['destaque'];
                    $premio_cavalo = $dados_cavalo['premio_cavalo'];
                    $imagem = $dados_cavalo['img_cavalo'];

                ?>
                <div class="lote">
                    <div class="dados_lote">
                        <img src="<?= $imagem?>" alt="oi">
                        <ul>
                            <li>
                                <p>
                                    <h3>Valor inicial do lote R$ <?= $valor_inicial_lote?></h3>
                                </p>
                            </li>
                            <li>Nome - <?= $nome_cavalo?></li>
                            <li>Raça - <?= $raca_cavalo?></li>
                            <li><?php if ($destaque == "Sim") echo "Cavalo em destaque <i class='fa-solid fa-check'></i>";?> </li>
                            <?php if ($premio_cavalo != null) echo "<li> Cavalo premiado em - $premio_cavalo </li>"; ?>
                            <?php if ($premio_cavalo == null) echo "<li> Esse Cavalo não possui nenhum prêmio </li>"; ?>

                        </ul>
                <?php
                
                ?></div><?php
             
                $sql_lances = "SELECT * FROM tb_lance WHERE tb_lote_id_lote = $id_lote ORDER BY valor_lance DESC LIMIT 10";
                $retorno_lances = conectarDB("select", $sql_lances, '', []);            
                if (sizeof($retorno_lances[1]) > 0) {?>
                    <div class="dados_lance">
                        <table>
                            <tr>
                                <td><b>Lance do Usuário</b></td>
                                <td><b>Data e hora do Lance</b></td>
                                <td><b>Nome</b></td>
                                <td><b>E-mail</b></td>
                            </tr>    
                <?php
                    foreach($retorno_lances[1] as $dados_lance){

                        $valor_lance = $dados_lance['valor_lance'];
                        $id_usuario = $dados_lance['tb_usuario_id_usuario'];
                        $data_lance = $dados_lance['data_lance'];
                            
                            $sql_dados_user = "SELECT * FROM tb_usuario WHERE id_usuario = $id_usuario";
                            $retorno_usuario = conectarDB("select", $sql_dados_user, "", []);
                            $dados_usuario = $retorno_usuario[1][0];
                            $nome_user = $dados_usuario['nome_usuario'];
                            $email_user = $dados_usuario['email_usuario'];

                            $objeto_data = new DateTime($data_lance);
                            $data_lance = $objeto_data ->format('d/m/Y');

                            $ano_lance = $objeto_data -> format('Y'); 
                            $mes_lance = $objeto_data ->format('m');
                            $dia_lance = $objeto_data ->format('d');

                            switch ($mes_lance) {
                                case '1':
                                    $mes_lance = "Janeiro";
                                    break;
                                case '2':
                                    $mes_lance = "Fevereiro";
                                    break;
                                case '3':
                                    $mes_lance = "Março";
                                    break;
                                case '4':
                                    $mes_lance = "Abril";
                                    break;
                                case '5':
                                    $mes_lance = "Maio";
                                    break;
                                case '6':
                                    $mes_lance = "Junho";
                                    break;
                                case '7':
                                    $mes_lance = "Julho";
                                    break;
                                case '8':
                                    $mes_lance = "Agosto";
                                    break;
                                case '9':
                                    $mes_lance = "Setembro";
                                    break;
                                case '10':
                                    $mes_lance = "Outubro";
                                    break;
                                case '11':
                                    $mes_lance = "Novembro";
                                    break;
                                case '12':
                                    $mes_lance = "Dezembro";
                                    break;
                                
                                default:
                                    
                                    break;
                                    }
                            $hora_lance = $objeto_data ->format('H');
                            $minutos_lance = $objeto_data ->format('i');
                            $data_lance = 
                            $dia_lance . " de " . 
                            $mes_lance . " as " . 
                            $hora_lance ."hs e " . 
                            $minutos_lance . "min ";
                        ?>
                            <tr>
                                <td><?= $valor_lance?></td>
                                <td><?= $data_lance?></td>
                                <td><?= $nome_user?></td>
                                <td><?= $email_user?></td>
                                
                            </tr>         
                            <?php } ?>
                            </table>
                        </div>
                        <?php
                   
                   
                }elseif (sizeof($retorno_lances[1]) == 0) {
                    ?>
                    <div class="f_dados_lance">
                        <h1>
                            Esse lote ainda não possui lances    
                        </h1>
                    </div>
                        <?php
                }
                ?></div><?php
                
                
            }

        }
    ?>
    </div>
</body>
</html>