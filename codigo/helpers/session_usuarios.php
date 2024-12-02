<?php

// Inclui o arquivo de redirecionamento para utilizar a função de redirecionamento
include_once "redirecionamento.php";

/**
 * Função para verificar a sessão do usuário
 *
 * Esta função verifica se o usuário está logado e tem as permissões adequadas
 * para acessar uma determinada página. Caso contrário, redireciona para uma página de erro ou de login.
 *
 * @param string $usuario Tipo de usuário que a página requer, por exemplo, 'Cliente' ou 'Admin'.
 * 
 * @autor Tarcísio <tarcisio.pesquisa.estudo@gmail.com>
 */
function verificar_sessao($usuario) {
    if (isset($_SESSION['id_cavalo'])) { unset($_SESSION['id_cavalo']); }
    switch ($usuario) {
        
        case 'Cliente':
            // Verifica se o usuário é um Cliente e está logado
            if (!isset($_SESSION["id_usuario"])) {
                // Se não estiver logado, redireciona para a página de login com mensagem de erro
                redirecionar("login_erro", "Você precisa de uma conta para acessar essa página!");
            }
            break;

        case 'Admin':
            // Verifica se o usuário é um Admin e está logado
            if (!isset($_SESSION["tipo_usuario"]) || $_SESSION["tipo_usuario"] != "Admin") {
                // Se não for Admin ou não estiver logado, redireciona para a página inicial com mensagem de erro
                redirecionar("pagina_inicial", "Você não tem acesso a essa página!");
            }
            break;

        default:
            // Para outros casos, nenhum redirecionamento é feito
            break;
    }
}

?>