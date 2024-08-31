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
</head>
<body>
    <div>
        <?php if (isset($_GET['editar'])) {?>
            <div style="text-align: center;">
                <form action="">
                    <p><input type="text" value="<?php echo $nome_usuario ; ?>" style="text-align: center;"></p>
                    <p><input type="email" value="<?php echo $email_usuario ; ?>" style="text-align: center;"></p>
                    <p><input type="password" value="<?php echo $senha_usuario ; ?>" style="text-align: center;"></p>
                    <p><input type="text" value="<?php echo $p_modalidade ; ?>" style="text-align: center;"></p>
                    <button type="submit">Salvar</button>
                </form>
            </div>
            <?php } else {?>
                <div style="text-align: center;">
                    <p><?php echo"$nome_usuario"; ?></p>
                    <p><?php echo"$email_usuario"; ?></p>
                    <p><?php echo"$senha_usuario"; ?></p>
                    <p><?php echo"$p_modalidade"; ?></p>
                    <p><a href="index.php?id_usuario=<?php echo $id_usuario; ?>">Alterar dados</a></p>
                </div>
        <?php }?>    

    </div>
</body>
</html>