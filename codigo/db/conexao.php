<?php
    function conectarDB($tipo, $sql, $tipos_dados, $dados){
        $servidor = "db";
        $usuario ="root";
        $senha = "123";
        $nome_banco ="db_quarter_horse";
        $conexao = mysqli_connect($servidor, $usuario, $senha, $nome_banco );
        
        switch ($tipo) {
            case 'select':
                /*{ 
                    Inversão da ordem dos parâmetros:
                    
                    $dados é agora o parâmetro obrigatório, pois é essencial para consultas com parâmetros.
                    $tipos_dados é opcional, pois apenas é necessário quando os parâmetros são fornecidos. 
                    
                    A ordem foi invertida para atender às melhores práticas do PHP, 
                    onde parâmetros obrigatórios devem vir antes de parâmetros opcionais.
                    
                    !is_null($tipos_dados): Verifica se o parâmetro $tipos_dados foi passado como argumento. 
                    Se ele for null, significa que a função foi chamada sem os tipos de dados, 
                    
                    e a verificação de empty() não precisa ser realizada.
                    !empty($tipos_dados): Verifica se $tipos_dados é uma string não vazia. 
                    Essa verificação adicional é necessária para garantir que os tipos de dados não sejam uma string vazia 
                    (``), o que causaria erros na função mysqli_stmt_bind_param() 
                        }
                    */    
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
    
function select($conexao, $sql, $dados = null, $tipos_dados = null) {
    $stmt = mysqli_prepare($conexao, $sql);
    
    if (!is_null($tipos_dados) && !empty($tipos_dados)) {
        mysqli_stmt_bind_param($stmt, $tipos_dados, ...$dados);
    }
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