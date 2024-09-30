<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/session_usuarios.php';

    session_start(); verificar_sessao("Admin");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/public/assets/css/form.css">
</head>
<style>
    /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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

        .t_header {
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

        .t_header a {
            display: block;
            padding: 10px 15px;
            background-color: #282e09;
            color: #b6ab9e;
            text-decoration: none;
            border-radius: 5px;
        }

        .t_header a:hover {
            background-color: #53422a;
        }

        /* Estilos para o formulário */
        
        /* Layout para a imagem e formulário */
        .form-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
            margin: 40px auto;
            max-width: 800px;
        }

        /* Estilo para a imagem */
        .img-container {
            text-align: center;
            
        }
        .img-container li {
            text-decoration: none;
            list-style: none;
        }

        .img-container img {
            max-width: 300px;
            border-radius: 10px;
            margin-bottom: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Botão de editar imagem */
        .img-container a.blue {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .img-container a.blue:hover {
            background-color: #0056b3;
        }
        .img-container a.red {
            margin-top: auto;
            margin-left: 0.5%;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #ff3333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .img-container a.red:hover {
            background-color: #e60000;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .form-container {
                flex-direction: column;
                align-items: center;
            }

            .img-container img {
                max-width: 90%;
            }

            .div_form {
                width: 100%;
                max-width: 90%;
            }
        }

</style>
<body>
    <header class="header">
        <div>
        <img src="/public/assets/img/logo_estendida_verde.png" alt="" style="max-width: 350px; max-height: 350px;">
        </div>   
    </header>
    <?php $view = $_REQUEST['view']; ?>
    <div class="t_header">
        <ul>
            <li><a href="/public/index.php">Início</a></li>
            <li><a href="/public/dashboard/admin/cavalo/index.php?view=<?=$view?>">Voltar</a></li>
        </ul>
    </div>
    
    <?php if (!isset($_REQUEST['id_cavalo'])) { ?>
        <div class="div_form">
            <form action="/controle/controle_cavalo.php?caso=cadastro&view=<?=$view?>" enctype="multipart/form-data" method="POST">
                <ul>
                    <li>
                        <input type="text" name="nome_cavalo" placeholder="Nome">
                    </li>
                    <li>
                        <input type="text" name="raca_cavalo" placeholder="Raça"> 
                    </li>
                    <li>
                        <input type="text" name="pelagem_cavalo" placeholder="Pelagem"> 
                    </li>
                    <li>
                        <input type="text" name="premio_cavalo" placeholder="Premio"> 
                    </li>
                        <select name="modalidade_cavalo" id="">
                            <option value="3 Tambores">3 Tambores</option>
                            <option value="Laço">Laço</option>
                            <option value="Vaquejada">Vaquejada</option>
                        </select>
                    </li>
                    <li>
                        <input type="file" name="imagem_cavalo">
                    </li>
                </ul>
                <button type="submit" id="green">Salvar</button>
            </form>
        </div>
    <?php } else { 
        include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';
            $id_cavalo = $_REQUEST['id_cavalo'];
            $sql = "SELECT * FROM tb_cavalo WHERE id_cavalo = ?";
            $retorno = conectarDB("select", $sql, [$id_cavalo], "i");
            $dados = $retorno[1][0];
            $destaque = $dados['destaque'];
            $situacao_cavalo = $dados['situacao_cavalo'];
        //editar sem a imagem ->
            if (!isset($_REQUEST['edit_img'])) { ?>
                
                <!--estilizar essa parte da imagem!!!! {-->
                <div class="form-container">
                    <div class="img-container">
                        <ul>
                            <li>
                                <h3>Imagem do atual do Cavalo</h3> <br>
                            </li>
                            <li>
                                <img src="<?=$dados['img_cavalo']?>" alt="Imagem do Cavalo"><br>
                            </li>
                            <li>
                                <a href="form.php?id_cavalo=<?=$id_cavalo?>&view=<?=$view?>&edit_img=1" class="blue">Editar Imagem</a>
                            </li>
                        </ul>
                    </div>
                <!--estilizar ess parte da imagem!!!! }-->
                <div class="div_form">
                        
                        <form action="/controle/controle_cavalo.php?caso=editar&view=<?=$view?>&id_cavalo=<?=$id_cavalo?>" enctype="multipart/form-data" method="POST">
                        
                            <ul>
                                <li>
                                    <input type="text" name="nome_cavalo" placeholder="Nome" value="<?= $dados['nome_cavalo']?>">
                                </li>
                                <li>
                                    <input type="text" name="raca_cavalo" placeholder="Raça" value="<?= $dados['raca_cavalo']?>"> 
                                </li>
                                <li>
                                    <input type="text" name="pelagem_cavalo" placeholder="Pelagem" value="<?= $dados['pelagem_cavalo']?>"> 
                                </li>
                                <li>
                                    <input type="text" name="premio_cavalo" placeholder="Premio" value="<?= $dados['premio_cavalo']?>"> 
                                </li>
                                    <select name="modalidade_cavalo" id="">
                                        <option value="3 Tambores" <?php if ($dados['modalidade_cavalo'] == "3 Tambores") echo "selected"; ?>>Modalidade - 3 Tambores</option>
                                        <option value="Laço" <?php if ($dados['modalidade_cavalo'] == "Laço") echo "selected"; ?>>Modalidade - Laço</option>
                                        <option value="Vaquejada" <?php if ($dados['modalidade_cavalo'] == "Vaquejada") echo "selected"; ?>>Modalidade - Vaquejada</option>
                                    </select>
                                    <select name="destaque" id="">
                                        <option value="Sim" <?php if ($dados['destaque'] == "Sim") echo "selected"; ?>>Destaque - Sim</option>
                                        <option value="Não" <?php if ($dados['destaque'] == "Não") echo "selected"; ?>>Destaque - Não</option>
                                    </select>
                            </ul>
                            <button type="submit" id="green">Salvar</button>
                        </form>
                    </div>
                </div>
    <?php }else{ ?>
            <!--estilizar essa parte da imagem!!!! {-->
            <div class="form-container">
                    <div class="img-container">
                        <ul>
                            <li>
                                <h3>Imagem do atual do Cavalo</h3> <br>
                            </li>
                            <li>
                                <img src="<?=$dados['img_cavalo']?>" alt="Imagem do Cavalo"><br>
                            </li>
                        </ul>               
                    
                <!--estilizar ess parte da imagem!!!! }-->
                        
                        <form action="/controle/controle_cavalo.php?caso=editar&view=<?=$view?>&id_cavalo=<?=$id_cavalo?>&img=1" enctype="multipart/form-data" method="POST"> 
                            <div style="display: flex;">
                                <input type="file" name="imagem_cavalo">
                                <a href="form.php?id_cavalo=<?=$id_cavalo?>&view=<?=$view?>" class="red">Cancelar</a>
                            </div>
                        </div>
                            <div class="div_form">
                                <ul>
                                    <li>
                                        <input type="text" name="nome_cavalo" placeholder="Nome" value="<?= $dados['nome_cavalo']?>">
                                    </li>
                                    <li>
                                        <input type="text" name="raca_cavalo" placeholder="Raça" value="<?= $dados['raca_cavalo']?>"> 
                                    </li>
                                    <li>
                                        <input type="text" name="pelagem_cavalo" placeholder="Pelagem" value="<?= $dados['pelagem_cavalo']?>"> 
                                    </li>
                                    <li>
                                        <input type="text" name="premio_cavalo" placeholder="Premio" value="<?= $dados['premio_cavalo']?>"> 
                                    </li>
                                    <select name="modalidade_cavalo" id="">
                                        <option value="3 Tambores" <?php if ($dados['modalidade_cavalo'] == "3 Tambores") echo "selected"; ?>>Modalidade - 3 Tambores</option>
                                        <option value="Laço" <?php if ($dados['modalidade_cavalo'] == "Laço") echo "selected"; ?>>Modalidade - Laço</option>
                                        <option value="Vaquejada" <?php if ($dados['modalidade_cavalo'] == "Vaquejada") echo "selected"; ?>>Modalidade - Vaquejada</option>
                                    </select>
                                    <select name="destaque" id="">
                                        <option value="Sim" <?php if ($dados['destaque'] == "Sim") echo "selected"; ?>>Destaque - Sim</option>
                                        <option value="Não" <?php if ($dados['destaque'] == "Não") echo "selected"; ?>>Destaque - Não</option>
                                    </select>
                                </ul>
                                <button type="submit" id="green">Salvar</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
    <?php } ?>
                
    <?php } ?>

</body>
</html>