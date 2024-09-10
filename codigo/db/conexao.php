<?php
    function conectarDB($tipo, $sql, $tipos_dados, $dados){
        $servidor = "db";
        $usuario ="root";
        $senha = "123";
        $nome_banco ="db_quarter_horse";
        $conexao = mysqli_connect($servidor, $usuario, $senha, $nome_banco );
        
        switch ($tipo) {
            case 'select':
                $r_fun = select($conexao, $sql, $tipos_dados, $dados);
                return $r_fun;
                break;
            /*---------------------------------------------------------*/
            /*---------------------------------------------------------*/
            case 'insert_update':
                insert_update($conexao, $sql, $tipos_dados, $dados);
                break;
            /*---------------------------------------------------------*/
            case 'delete':
                # code...
                break;
            default:
                
                break;
        } 
    }
    
function select($conexao, $sql, $tipos_dados, $dados){
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, $tipos_dados, ...$dados);
        $retorno = mysqli_stmt_execute($stmt);
        $resultados = mysqli_stmt_get_result($stmt);
        if ($resultados) {
            $resultados = mysqli_fetch_all($resultados, MYSQLI_ASSOC);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conexao);
        return [$retorno, $resultados];
}

function insert_update($conexao, $sql, $tipos_dados, $dados){
        $stmt = mysqli_prepare($conexao, $sql);
                
        mysqli_stmt_bind_param($stmt, $tipos_dados, ...$dados);

        mysqli_stmt_execute($stmt);

        $id = mysqli_stmt_insert_id($stmt);

        mysqli_stmt_close($stmt);
        
        return $id;
}
    
?>