<?php 
    include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/session_usuarios.php';
    session_start(); verificar_sessao("Cliente");
    $nome_usuario = $_SESSION["nome_usuario"]; $email_usuario = $_SESSION["email_usuario"]; $senha_usuario = $_SESSION["senha_usuario"]; $p_modalidade = $_SESSION["p_modalidade"]; $id_usuario = $_SESSION["id_usuario"]
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php $nome_usuario = $_SESSION['nome_usuario']; echo "Perfil $nome_usuario"; ?>
    </title>
    <link rel="stylesheet" href="/public/assets/css/form.css">
    <style>
        .div_p {
            padding: 12px 0px 0px 0px;
            height: 250px;
            border-radius: 5%;
            max-width: 400px;
            margin: 4% auto;
            text-align: center;
        }
        .div_p p {
            font-size: large;
            margin-bottom: 10px;
            padding: 10px 0px 0px 0px;
            
        }
        .div_p a {
            width: 100px;
            align-items: center;
            padding: 10px;
            border-radius: 10px;
            color: white;
            background-color: rgb(30, 30, 245);
            border: 0px;
            text-align: center;
            font-size: medium;
            text-decoration: none;
        }
        .div_p a:hover {
            background-color: rgb(68, 68, 231);
        }
    </style>
</head>
<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/navbar.html'; ?>
    <?php if (isset($_GET['editar'])) {?>
        <div class="div_form">
            <p>Altere os campos que achar necessário</p>
                <form action="/controle/controle_usuario.php?caso=editar" method="POST" id="form_editar_usuario">
                    <ul>
                        <li>
                            <input type="text" value="<?= $nome_usuario ;?>" name="n_nome" id="n_nome">
                            <br><small class="error-message" id="nomeError"></small>
                        </li>
                        <li>
                            <input type="email" value="<?= $email_usuario ;?>" name="n_email" id="n_email">  
                            <br> <small class="error-message" id="emailError"></small>
                        </li>
                        <li>
                            <select name="n_p_modalidade" id="">
                                <option value="Sem preferência" <?php if ($p_modalidade == "Sem preferência") echo "selected"; ?> >Sem Preferência</option>
                                <option value="3 Tambores" <?php if ($p_modalidade == "3 Tambores") echo "selected";?> >3 Tambores</option>
                                <option value="Laço" <?php if ($p_modalidade == "Laço") echo "selected"; ?> >Laço</option>
                                <option value="Vaquejada" <?php if ($p_modalidade == "Vaquejada") echo "selected"; ?>>Vaquejada</option>
                            </select>
                        </li>
                        <li>
                            <button type="submit" id="green">Salvar</button>
                        </li>
                    </ul>
                </form>
            </div>
            <?php } else {?>
                <div class="div_p">
                    <p><?= "$nome_usuario"; ?></p>
                    <p><?= "$email_usuario"; ?></p>
                    <p><?= "$p_modalidade"; ?></p>
                    <p><a href="index.php?id_usuario=<?= $id_usuario; ?>">Alterar dados</a></p>
                </div>
        <?php }?>    

    
</body>
    <script src="../../assets/js/jquery-3.7.1.min.js"></script>
    <script src="../../assets/js/script.js"></script>
</html>