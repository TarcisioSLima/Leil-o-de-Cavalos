<?php
    function conectarDB(){
        $servidor = "db";
        $usuario ="root";
        $senha = "123";
        $nome_banco ="db_tarefas";
        $conexao = mysqli_connect($servidor, $usuario, $senha, $nome_banco );
        return $conexao;
    }

    function desconectarDB($conexao){
        mysqli_close($conexao);
    }

    function executarSQL($sql, $tipos, $dados){
        $conexao = conectarDB();

        $stmt = mysqli_prepare($conexao, $sql);

        if ($tipos != "") {
            mysqli_stmt_bind_param($stmt, $tipos, ...$dados);
        }
        
        $retorno = mysqli_stmt_execute($stmt);

        // se o comando SQL começa com S é SELECT
        if ($sql[0] == 'S') {
            $resultados = mysqli_stmt_get_result($stmt);
            if ($resultados) {
                $resultados = mysqli_fetch_all($resultados, MYSQLI_ASSOC);
            }
            return [$retorno, $resultados];
        }

        desconectarDB($conexao);
        return $retorno;
    }
?>