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
                    window.location.href='/public/index.php';
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

        default:
            # code...
            break;
    }
};



?>