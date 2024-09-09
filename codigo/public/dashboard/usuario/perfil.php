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
</head>
<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/navbar.html'; ?>
    <?php if (isset($_GET['editar'])) {?>
        <div class="div_form">
            <p>Altere os campos que achar necessário</p>
                <form action="/controle/controle_usuario.php?caso=editar" method="POST">
                    <ul>
                        <li>
                            <input type="text" value="<?php echo $nome_usuario ;?>" name="n_nome">
                        </li>
                        <li>
                            <input type="email" value="<?php echo $email_usuario ;?>" name="n_email">  
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
                <div style="text-align: center;">
                    <p><?php echo"$nome_usuario"; ?></p>
                    <p><?php echo"$email_usuario"; ?></p>
                    <p><?php echo"$p_modalidade"; ?></p>
                    <p><a href="index.php?id_usuario=<?php echo $id_usuario; ?>">Alterar dados</a></p>
                </div>
        <?php }?>    

    
</body>
</html>