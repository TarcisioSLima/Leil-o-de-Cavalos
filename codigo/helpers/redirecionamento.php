<?php

/**
 * Função de Redirecionamento com Mensagem
 * 
 * Esta função redireciona o usuário para diferentes páginas dentro do sistema, 
 * exibindo mensagens de alerta quando necessário.
 * 
 * @param string $action Nome da ação que determina a página de destino
 * @param string $mensagem (Opcional) Mensagem para exibição em alert
 * @autor Tarcísio <tarcisio.pesquisa.estudo@gmail.com>
 */
function redirecionar($action, $mensagem) {
    switch ($action) {
        
        case 'pagina_inicial':
            // Redireciona para a página inicial
            echo "
                <script>
                    window.location.href='/public/index.php';
                </script>";
            exit();
            break;

        case 'login_erro':
            // Exibe mensagem de erro e redireciona para a página de login
            echo "
                <script>
                    window.alert('$mensagem');
                    window.location.href='/public/dashboard/cliente/index.php';
                </script>";
            exit();
            break;

        case 'cadastro_erro':
            // Exibe mensagem de erro e redireciona para o formulário de cadastro
            echo "
                <script>
                    window.alert('$mensagem');
                    window.location.href='/public/dashboard/cliente/form.php';
                </script>";
            break;

        case 'perfil':
            // Redireciona para a página de perfil do cliente
            echo "
                <script>
                    window.location.href='/public/dashboard/cliente/perfil.php';
                </script>";
            break;

        case 'index_cavalo':
            // Redireciona para a listagem de cavalos com uma mensagem de status
            echo "
                <script>
                    window.location.href='/public/dashboard/admin/cavalo/index.php?view=$mensagem';
                </script>";
            break;

        case 'index_lote':
            // Redireciona para a listagem de lotes com uma mensagem de status
            echo "
                <script>
                    window.location.href='/public/dashboard/admin/lote/index.php?view=$mensagem';
                </script>";
            break;

        default:
            // Caso não seja uma ação conhecida, nenhuma ação é realizada
            break;
    }
}

?>