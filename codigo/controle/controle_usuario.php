<?php
    require_once "../db/conexao.php";
    require_once "../helpers/redirecionamento.php";
    
    $case = $_REQUEST['caso'];

    switch ($case) {
        case 'login':
            $email_usuario = $_REQUEST["email_usuario"];
            $senha_usuario = $_REQUEST["senha_usuario"];
            $sql = "SELECT * FROM tb_usuario WHERE email_usuario = '$email_usuario' AND senha_usuario = '$senha_usuario'";
            $retorno = conectarDB($sql);
            if (mysqli_num_rows($retorno) == 1) {
                session_start();
                session_destroy();
                session_start();
                $dados = mysqli_fetch_array($retorno);
                $_SESSION["id_usuario"] = $dados["id_usuario"];
                $_SESSION["email_usuario"] = $dados["email_usuario"];
                $_SESSION["nome_usuario"] = $dados["nome_usuario"];
                $_SESSION["tipo_usuario"] = $dados["tipo_usuario"];
                redirecionar('pagina_inicial', '');
            }else redirecionar("login_erro", "Email ou Senha incorretos. Tente novamente!");
            break;
        case 'logout':
            session_start();
            session_destroy();
            redirecionar('pagina_inicial', '');
            break;
        case 'cadastro_usuario':
            $nome_usuario = $_REQUEST["nome_usuario"];
            $email_usuario = $_REQUEST["email_usuario"];
            $senha_usuario = $_REQUEST["senha_usuario"];
            $sql = "SELECT * FROM tb_usuario WHERE email_usuario = '$email_usuario'";
            $retorno = conectarDB($sql);
            if (mysqli_num_rows($retorno) == 0) {
                $sql = "INSERT INTO tb_usuario VALUES (NULL, '$nome_usuario', '$email_usuario', '$senha_usuario', 'Cliente')";
                conectarDB($sql);
                redirecionar("pagina_inicial", "");
            } else redirecionar("cadastro_erro", "Já existe um usuário cadastrado com esse Email!");
            break;
        default:
            # code...
            break;
    }

?>
