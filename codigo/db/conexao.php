<?php
    function conectarDB($tipo, $sql, $tipos_dados, $dados){
        $servidor = "db";
        $usuario ="root";
        $senha = "123";
        $nome_banco ="db_quarter_horse";
        $conexao = mysqli_connect($servidor, $usuario, $senha, $nome_banco );
        
        switch ($tipo) {
            case 'select_comum':
                $retorno = mysqli_query($conexao, $sql);
                mysqli_close($conexao);
                return $retorno;
                
                break;
            /*---------------------------------------------------------*/
            case 'select_c_variavel':
                /* Esperar ele fazer */
                
                break;
            /*---------------------------------------------------------*/
            case 'insert_update':
                $stmt = mysqli_prepare($conexao, $sql);
                
                mysqli_stmt_bind_param($stmt, $tipos_dados, ...$dados);

                mysqli_stmt_execute($stmt);

                $id = mysqli_stmt_insert_id($stmt);

                mysqli_stmt_close($stmt);
                
                return $id;

                break;
            /*---------------------------------------------------------*/
            case 'delete':
                # code...
                break;
            default:
                
                break;
        }


        
        
        
       
    }
?>