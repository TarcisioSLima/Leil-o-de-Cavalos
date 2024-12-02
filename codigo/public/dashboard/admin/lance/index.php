<?php

/**
     * Painel de Lances do Administrador
     * 
     * Este arquivo exibe os lances feitos em lotes, permitindo ao administrador visualizar os lances de um lote específico ou de todos os lotes.
     * Inclui opções para gerar relatórios em PDF.
     *
     * @requires /helpers/session_usuarios.php
     * @requires /db/conexao.php
     * @requires /helpers/verificador_lote.php
     * @requires /helpers/navbar.html
     * 
     * @after verificar_sessao("Admin") Inicia sessão e verifica permissões de acesso.
     * 
     * @param string $_REQUEST['e'] Define o modo de exibição ('t' para um lote específico, 'f' para todos os lotes).
     * @param int $_REQUEST['id_cavalo'] (Opcional) ID do cavalo para exibir os lances do lote correspondente (usado quando $_REQUEST['e'] é 't').
     *
     * @autor Tarcísio <tarcisio.pesquisa.estudo@gmail.com>
     */




include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/session_usuarios.php';

// Inicia sessão e verifica se o usuário possui a permissão "Admin"
session_start();
verificar_sessao("Admin");
$forma = $_REQUEST['e'];
include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/verificador_lote.php';
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
    $id_cavalo = $_REQUEST['id_cavalo'];
    $sql = "SELECT id_lote FROM tb_lote WHERE tb_cavalo_id_cavalo = ?";
    $retorno = conectarDB("select", $sql, "i", [$id_cavalo]);
    $dados = $retorno[1][0];
    $id_lote = $dados['id_lote'];

    // Consulta para obter detalhes do lote
    $sql_lote = "SELECT * FROM tb_lote WHERE id_lote = ?";
    $retorno_lote = conectarDB("select", $sql_lote, "i", [$id_lote]);
    $dados_lote = $retorno_lote[1][0];

    $valor_inicial_lote = $dados_lote['valor_lote'];
    $id_cavalo = $dados_lote['tb_cavalo_id_cavalo'];

    // Consulta para obter dados do cavalo
    $sql_cavalo = "SELECT * FROM tb_cavalo WHERE id_cavalo = ?";
    $retorno_cavalo = conectarDB("select", $sql_cavalo, "i", [$id_cavalo]);
    $dados_cavalo = $retorno_cavalo[1][0];

    $nome_cavalo = $dados_cavalo['nome_cavalo'];
    $raca_cavalo = $dados_cavalo['raca_cavalo'];
    $destaque = $dados_cavalo['destaque'];
    $premio_cavalo = $dados_cavalo['premio_cavalo'];
    $imagem = $dados_cavalo['img_cavalo'];

    ?>
    <div class="lote">
        <div class="dados_lote">
            <img src="<?= $imagem ?>" alt="Imagem do Cavalo">
            <ul>
                <li>
                    <p>
                        <h3>Valor inicial do lote R$ <?= $valor_inicial_lote ?></h3>
                    </p>
                </li>
                <li>Nome - <?= $nome_cavalo ?></li>
                <li>Raça - <?= $raca_cavalo ?></li>
                <li><?php if ($destaque == "Sim") echo "Cavalo em destaque <i class='fa-solid fa-check'></i>"; ?> </li>
                <?php if ($premio_cavalo != null) echo "<li>Cavalo premiado em - $premio_cavalo</li>"; ?>
                <?php if ($premio_cavalo == null) echo "<li>Esse Cavalo não possui nenhum prêmio</li>"; ?>
            </ul>
            <ul class="ul_pdf">
                <li>
                    <a href="/helpers/lances_um_pdf.php?id=<?= $id_lote ?>"><i class="fa-solid fa-file-pdf fa-xl" style="color: #c20000;"></i></a>
                </li>
            </ul>
        </div>
        <?php

        // Consulta para obter lances do lote
        $sql_lances = "SELECT * FROM tb_lance WHERE tb_lote_id_lote = ? ORDER BY valor_lance DESC LIMIT 10";
        $retorno_lances = conectarDB("select", $sql_lances, "i", [$id_lote]);

            if (sizeof($retorno_lances[1]) > 0) { ?>
                <div class="dados_lance">
                    <table>
                        <tr>
                            <td><b>Lance do Usuário</b></td>
                            <td><b>Data e hora do Lance</b></td>
                            <td><b>Nome</b></td>
                            <td><b>E-mail</b></td>
                        </tr>
                        <?php
                        foreach ($retorno_lances[1] as $dados_lance) {
                            $valor_lance = $dados_lance['valor_lance'];
                            $id_usuario = $dados_lance['tb_usuario_id_usuario'];
                            $data_lance = $dados_lance['data_lance'];

                            // Consulta para obter dados do usuário
                            $sql_dados_user = "SELECT * FROM tb_usuario WHERE id_usuario = ?";
                            $retorno_usuario = conectarDB("select", $sql_dados_user, "i", [$id_usuario]);
                            $dados_usuario = $retorno_usuario[1][0];

                            $nome_user = $dados_usuario['nome_usuario'];
                            $email_user = $dados_usuario['email_usuario'];

                            $objeto_data = new DateTime($data_lance);
                            $dia_lance = $objeto_data->format('d');
                            $mes_lance = $objeto_data->format('F');
                            $ano_lance = $objeto_data->format('Y');
                            $hora_lance = $objeto_data->format('H:i');

                            ?>
                            <tr>
                                <td>R$ <?= $valor_lance ?></td>
                                <td><?= "$dia_lance de $mes_lance de $ano_lance às $hora_lance" ?></td>
                                <td><?= $nome_user ?></td>
                                <td><?= $email_user ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            <?php } else { ?>
                <div class="f_dados_lance">
                    <h1>Esse lote ainda não possui lances</h1>
                </div>
            <?php } ?>
        </div>
        <?php


        }elseif ($forma == 'f') { ?>
        <div class="u_pdf">
            <ul>
                <a href="/helpers/lances_gerais_pdf.php"><li><b>Gerar PDF com todos </b> <i class="fa-solid fa-file-pdf fa-xl" style="color: #c20000;"></i></li></a>
            </ul>
            
        </div>
        <?php
            
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
                        <ul class="ul_pdf">
                            <li>
                                <a href="/helpers/lances_um_pdf.php?id=<?=$id_lote?>"><i class="fa-solid fa-file-pdf fa-xl" style="color: #c20000;"></i></a>
                            </li>
                        </ul>                <?php
                
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
                                <td>R$ <?= $valor_lance?></td>
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