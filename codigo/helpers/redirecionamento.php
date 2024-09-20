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
                    window.location.href='/public/dashboard/cliente/index.php';
                </script>";
                exit();
            break;
        case 'cadastro_erro':
            echo "
            <script>
                window.alert('$mensagem');
                window.location.href='/public/dashboard/cliente/form.php';
            </script>";
            break;
        case 'perfil':
            echo "
            <script>
                window.location.href='/public/dashboard/cliente/perfil.php';
            </script>";
            break;
        case 'index_cavalo':
            echo "
            <script>
                window.location.href='/public/dashboard/admin/cavalo/index.php';
            </script>";
            break;
        default:
            # code...
            break;
    }
};



?>