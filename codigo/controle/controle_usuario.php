<?php
    require_once "../db/conexao.php";
    
    
    switch ($case) {
        case 'login':
            $email_usuario = $_REQUEST["email_usuario"];
            $senha_usuario = $_REQUEST["senha_usuario"];
            $sql = "SELECT * FROM tb_usuario WHERE email_usuario = '$email_usuario' AND senha_usuario = '$senha_usuario'";
            conectarDB($sql);

            if (mysqli_num_rows($retorno) == 1) {
                
            }
            break;
        
        default:
            # code...
            break;
    }

?>
