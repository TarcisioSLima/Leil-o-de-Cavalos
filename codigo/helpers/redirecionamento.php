<?php
function redirecionar($action, $mensagem){
    switch ($action) {
        case 'pagina_inicial':
            echo "
                <script>
                    window.location.href='/public/index.php';
                </script>";
                exit();
            break;
        case 'login_erro':
            echo "
                <script>
                    window.alert('$mensagem');
                    window.location.href='/public/dashboard/usuario/index.php';
                </script>";
                exit();
            break;
        case 'cadastro_erro':
            echo "
            <script>
                window.alert('$mensagem');
                window.location.href='/public/dashboard/usuario/form.php';
            </script>";
            break;
        case 'perfil':
            echo "
            <script>
                window.location.href='/public/dashboard/usuario/perfil.php';
            </script>";
            break;
        case 'value':
            # code...
            break;
        default:
            # code...
            break;
    }
};



?>