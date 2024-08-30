<?php
    function conectarDB($sql){
        $servidor = "db";
        $usuario ="root";
        $senha = "123";
        $nome_banco ="db_quarter_horse";
        $conexao = mysqli_connect($servidor, $usuario, $senha, $nome_banco );
        
        $retorno = mysqli_query($conexao, $sql);
        
        mysqli_close($conexao);
        return $retorno;
    }
?>