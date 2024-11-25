# LeilÃ£o de Cavalos

## Executar o projeto

Rode os seguintes comandos no terminal:
```
docker-compose up -d

docker exec quarter_horse docker-php-ext-install mysqli

docker exec quarter_horse a2enmod rewrite
```

## Acessar o projeto

No navegador digite:
```
localhost:824
```



### Todos os dados do banco

``` 
O Código abaixo pega todos os dados do banco, lance, lote, usuario e cavalo.

<?php

        if ($forma == 't') {
            
        }elseif ($forma == 'f') {

            $sql_lotes = "SELECT * FROM tb_lote ORDER BY data_fechamento";
            $retorno_lotes = conectarDB("select", $sql_lotes, "", []);
            foreach ($retorno_lotes[1] as $dados_lote) {

                $id_lote = $dados_lote['id_lote'];
                $valor_inicial_lote = $dados_lote['valor_lote'];
                $id_cavalo = $dados_lance['id_cavalo'];

                $sql_cavalo = "SELECT * FROM tb_cavalo WHERE id_cavalo = $id_cavalo";
                $retorno_cavalo = conectarDB("select", $sql_cavalo, "", []); 
                $dados_cavalo = $retorno_cavalo[1][0];
                    $nome_cavalo = $dados_cavalo['nome_cavalo'];
                    $raca_cavalo = $dados_cavalo['raca_cavalo'];
                    $destaque = $dados_cavalo['destaque'];
                    $premio_cavalo = $dados_cavalo['premio_cavalo'];
                    $imagem = $dados_cavalo['img_cavalo'];

                
                
                $sql_lances = "SELECT * FROM tb_lance WHERE tb_lote_id_lote = $id_lote ORDER BY valor_lance DESC";
                $retorno_lances = conectarDB("select", $sql_lances, '', []);


                
                foreach($retorno_lances[1] as $dados_lance){

                    $valor_lance = $dados_lance['valor_lance'];
                    $id_usuario = $dados_lance['id_usuario'];
                    $data_lance = $dados_lance['data_lance'];
                        
                        $sql_dados_user = "SELECT * FROM tb_usuario WHERE id_usuario = $id_usuario";
                        $retorno_usuario = conectarDB("select", $sql_dados_user, "", []);
                        $dados_usuario = $retorno_usuario[1][0];
                        $nome_user = $dados_usuario['nome_usuario'];
                        $email_user = $dados_usuario['email_usuario'];


                }

            }

        }
    ?>