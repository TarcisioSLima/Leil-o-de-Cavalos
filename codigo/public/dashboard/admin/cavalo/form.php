<?php
    /**
     * Página de Cadastro e Edição de Cavalos
     * 
     * Este arquivo controla a exibição e envio do formulário para cadastro e edição de dados dos cavalos.
     * 
     * @requires /helpers/session_usuarios.php
     * @requires /db/conexao.php (apenas em modo edição)
     * 
     * @after verificar_sessao("Admin") Inicia sessão e verifica permissões de acesso.
     */

    include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/session_usuarios.php';
    session_start();
    verificar_sessao("Admin");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro e Edição de Cavalos</title>
    <link rel="stylesheet" href="/public/assets/css/form.css">
</head>
<style>
    /* Estilos Gerais e Formatação */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: Arial, sans-serif; background-color: #f8f8f8; }

    .header { background-color: #b6ab9e; color: white; padding: 5px 10px; text-align: center; }
    .t_header { background-color: #282e09; }
    .t_header ul { list-style: none; display: flex; }
    .t_header li { margin-right: 10px; }
    .t_header a { padding: 10px 15px; color: #b6ab9e; text-decoration: none; border-radius: 5px; }
    .t_header a:hover { background-color: #53422a; }

    /* Estilo da Imagem e Formulário */
    .form-container { display: flex; gap: 20px; max-width: 800px; margin: 40px auto; }
    .img-container { text-align: center; }
    .img-container img { max-width: 300px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); }
    .img-container a.blue { background-color: #007bff; color: white; padding: 10px 20px; border-radius: 5px; }
    .img-container a.red { background-color: #ff3333; color: white; padding: 10px 20px; border-radius: 5px; }
    .img-container a:hover { background-color: #0056b3; }
    .div_form { width: 100%; }

    /* Responsividade */
    @media (max-width: 768px) {
        .form-container { flex-direction: column; align-items: center; }
        .img-container img { max-width: 90%; }
        .div_form { max-width: 90%; }
    }
</style>

<body>
    <header class="header">
        <img src="/public/assets/img/logo_estendida_verde.png" alt="Logo" style="max-width: 350px;">
    </header>
    <?php $view = $_REQUEST['view']; ?>
    
    <div class="t_header">
        <ul>
            <li><a href="/public/index.php">Início</a></li>
            <li><a href="/public/dashboard/admin/cavalo/index.php?view=<?=$view?>">Voltar</a></li>
        </ul>
    </div>

    <!-- Cadastro de Cavalo -->
    <?php if (!isset($_REQUEST['id_cavalo'])) { ?>
        <div class="div_form">
            <form action="/controle/controle_cavalo.php?caso=cadastro&view=<?=$view?>" enctype="multipart/form-data" method="POST">
                <ul>
                    <li><input type="text" name="nome_cavalo" placeholder="Nome"></li>
                    <li><input type="text" name="raca_cavalo" placeholder="Raça"></li>
                    <li><input type="text" name="pelagem_cavalo" placeholder="Pelagem"></li>
                    <li><input type="text" name="premio_cavalo" placeholder="Prêmio"></li>
                    <li>
                        <select name="modalidade_cavalo">
                            <option value="3 Tambores">3 Tambores</option>
                            <option value="Laço">Laço</option>
                            <option value="Vaquejada">Vaquejada</option>
                        </select>
                    </li>
                    <li><input type="file" name="imagem_cavalo"></li>
                </ul>
                <button type="submit" id="green">Salvar</button>
            </form>
        </div>

    <!-- Editar Cavalo -->
    <?php } else { 
        include_once $_SERVER['DOCUMENT_ROOT'].'/db/conexao.php';
        $id_cavalo = $_REQUEST['id_cavalo'];
        $sql = "SELECT * FROM tb_cavalo WHERE id_cavalo = ?";
        $retorno = conectarDB("select", $sql, "i", [$id_cavalo]);
        $dados = $retorno[1][0];
    ?>
    
        <?php if (!isset($_REQUEST['edit_img'])) { ?>
            <div class="form-container">
                <div class="img-container">
                    <h3>Imagem Atual do Cavalo</h3>
                    <img src="<?=$dados['img_cavalo']?>" alt="Imagem do Cavalo">
                    <a href="form.php?id_cavalo=<?=$id_cavalo?>&view=<?=$view?>&edit_img=1" class="blue">Editar Imagem</a>
                </div>
                <div class="div_form">
                    <form action="/controle/controle_cavalo.php?caso=editar&view=<?=$view?>&id_cavalo=<?=$id_cavalo?>" enctype="multipart/form-data" method="POST">
                        <ul>
                            <li><input type="text" name="nome_cavalo" placeholder="Nome" value="<?= $dados['nome_cavalo']?>"></li>
                            <li><input type="text" name="raca_cavalo" placeholder="Raça" value="<?= $dados['raca_cavalo']?>"></li>
                            <li><input type="text" name="pelagem_cavalo" placeholder="Pelagem" value="<?= $dados['pelagem_cavalo']?>"></li>
                            <li><input type="text" name="premio_cavalo" placeholder="Prêmio" value="<?= $dados['premio_cavalo']?>"></li>
                            <li>
                                <select name="modalidade_cavalo">
                                    <option value="3 Tambores" <?php if ($dados['modalidade_cavalo'] == "3 Tambores") echo "selected"; ?>>3 Tambores</option>
                                    <option value="Laço" <?php if ($dados['modalidade_cavalo'] == "Laço") echo "selected"; ?>>Laço</option>
                                    <option value="Vaquejada" <?php if ($dados['modalidade_cavalo'] == "Vaquejada") echo "selected"; ?>>Vaquejada</option>
                                </select>
                                <select name="destaque">
                                    <option value="Sim" <?php if ($dados['destaque'] == "Sim") echo "selected"; ?>>Destaque - Sim</option>
                                    <option value="Não" <?php if ($dados['destaque'] == "Não") echo "selected"; ?>>Destaque - Não</option>
                                </select>
                            </li>
                        </ul>
                        <button type="submit" id="green">Salvar</button>
                    </form>
                </div>
            </div>

        <!-- Editar com Imagem -->
        <?php } else { ?>
            <div class="form-container">
                <div class="img-container">
                    <h3>Imagem Atual do Cavalo</h3>
                    <img src="<?=$dados['img_cavalo']?>" alt="Imagem do Cavalo">
                    <form action="/controle/controle_cavalo.php?caso=editar&view=<?=$view?>&id_cavalo=<?=$id_cavalo?>&img=1" enctype="multipart/form-data" method="POST">
                        <div style="display: flex;">
                            <input type="file" name="imagem_cavalo">
                            <a href="form.php?id_cavalo=<?=$id_cavalo?>&view=<?=$view?>" class="red">Cancelar</a>
                        </div>
                        <div class="div_form">
                            <ul>
                                <li><input type="text" name="nome_cavalo" placeholder="Nome" value="<?= $dados['nome_cavalo']?>"></li>
                                <li><input type="text" name="raca_cavalo" placeholder="Raça" value="<?= $dados['raca_cavalo']?>"></li>
                                <li><input type="text" name="pelagem_cavalo" placeholder="Pelagem" value="<?= $dados['pelagem_cavalo']?>"></li>
                                <li><input type="text" name="premio_cavalo" placeholder="Prêmio" value="<?= $dados['premio_cavalo']?>"></li>
                                <li>
                                    <select name="modalidade_cavalo">
                                        <option value="3 Tambores" <?php if ($dados['modalidade_cavalo'] == "3 Tambores") echo "selected"; ?>>3 Tambores</option>
                                        <option value="Laço" <?php if ($dados['modalidade_cavalo'] == "Laço") echo "selected"; ?>>Laço</option>
                                        <option value="Vaquejada" <?php if ($dados['modalidade_cavalo'] == "Vaquejada") echo "selected"; ?>>Vaquejada</option>
                                    </select>
                                    <select name="destaque">
                                        <option value="Sim" <?php if ($dados['destaque'] == "Sim") echo "selected"; ?>>Destaque - Sim</option>
                                        <option value="Não" <?php if ($dados['destaque'] == "Não") echo "selected"; ?>>Destaque - Não</option>
                                    </select>
                                </li>
                            </ul>
                            <button type="submit" id="green">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
</body>
</html>