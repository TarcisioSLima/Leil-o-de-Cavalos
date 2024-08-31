<?php
    include_once "redirecionamento.php";
    function verificar_sessao($usuario){
        switch ($usuario) {
            case 'Cliente':
                if (!isset($_SESSION["id_usuario"])) {
                    redirecionar("login_erro", "Você precisar de uma conta para acessar essa página!");
                }
                break;
            case 'Admin':
                if (!isset($_SESSION["tipo_usuario"]) OR $_SESSION["tipo_usuario"] != "Admin") {
                    redirecionar("pagina_inicial", "Você não tem acesso a essa página!");
                }
                break;
            default:
                
                break;
        }
    }

?>