<?php
    require_once "../db/conexao.php";
    require_once "../helpers/redirecionamento.php";
    
    $case = $_REQUEST['caso'];

    switch ($case) {
        case 'login':
            $email_usuario = $_REQUEST["email_usuario"];
            $senha_usuario = $_REQUEST["senha_usuario"];
            $sql = "SELECT * FROM tb_usuario WHERE email_usuario = '$email_usuario' AND senha_usuario = '$senha_usuario'";
            $retorno = conectarDB("select_comum", $sql, "", "" );
            if (mysqli_num_rows($retorno) == 1) {
                session_start();
                session_destroy();
                session_start();
                $dados = mysqli_fetch_array($retorno);
                $_SESSION["id_usuario"] = $dados["id_usuario"];
                $_SESSION["email_usuario"] = $dados["email_usuario"];
                $_SESSION["nome_usuario"] = $dados["nome_usuario"];
                $_SESSION["senha_usuario"] = $dados["senha_usuario"];
                $_SESSION["tipo_usuario"] = $dados["tipo_usuario"];
                $_SESSION["p_modalidade"] = $dados["p_modalidade"];
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
            $p_modalidade = $_REQUEST["p_modalidade"];
           
            $sql = "SELECT * FROM tb_usuario WHERE email_usuario = '$email_usuario'";
            $retorno = conectarDB("select_comum", $sql, "nada", []);

            if (mysqli_num_rows($retorno) == 0) {
                $sql = "INSERT INTO tb_usuario VALUES (NULL, ?, ?, ?, ?, ?)";

                conectarDB("insert_update", $sql, "sssss", 
                [$nome_usuario, $email_usuario, $senha_usuario, 'Cliente', $p_modalidade] );
                
                redirecionar("pagina_inicial", "");
            } else redirecionar("cadastro_erro", "Já existe um usuário cadastrado com esse Email!");
            break;
        case 'direcionar':
                $id_usuario = $_REQUEST["id_usuario"];
                $senha_digitada = $_REQUEST["senha_usuario"]; $email_digitado = $_REQUEST["email_usuario"];
                $sql = "SELECT * FROM tb_usuario WHERE id_usuario = $id_usuario";
                $retorno = conectarDB("select_comum", $sql, "nada", []); $dados = mysqli_fetch_array($retorno);
                $senha_usuario = $dados["senha_usuario"]; $email_usuario = $dados["email_usuario"];
            if ($senha_digitada ==  $senha_usuario AND $email_digitado == $email_usuario) {
                echo "
                <script>
                    window.location.href='/public/dashboard/usuario/perfil.php?editar=n';
                </script>";
            }else {
                echo "
                <script>
                    window.alert('Email ou Senha digitados incorretos! tente novamente...');
                    window.location.href='/public/dashboard/usuario/perfil.php';
                </script>";
            }

            break;
        case 'editar':
            $nome_usuario = $_REQUEST["n_nome"]; 
            $email_usuario = $_REQUEST["n_email"]; 
            $p_modalidade = $_REQUEST["n_p_modalidade"];
            session_start();
            
            $id_usuario = $_SESSION["id_usuario"];
            $sql = "UPDATE tb_usuario SET
            nome_usuario = ?, email_usuario = ?, p_modalidade = ?
            WHERE id_usuario = $id_usuario";
            $retorno = conectarDB("insert_update", $sql,"sss", [$nome_usuario, $email_usuario, $p_modalidade]);
            $_SESSION["nome_usuario"] = $nome_usuario;
            $_SESSION["email_usuario"] = $email_usuario;
            $_SESSION["p_modalidade"] = $p_modalidade;
            redirecionar("perfil", "");
            break;
            default:
            
            break;
    }

?>
