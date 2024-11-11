<?php
    //Incluiu o arquivo de conexão
    require_once('../db/conexao.php');

    //Verifica se existe o parâmetro ID
    if (isset($_REQUEST['id'])){
        //Criar as variáveis para idenficiar a operação
        $textoAcao = 'Alterar';
        $action = 'update';
        
        //Pega o ID da tarefa
        $idTarefa = $_REQUEST['id'];
        
        //Seleciona a Terefa no banco
        $sql = "SELECT * FROM tb_tarefa WHERE id_tarefa = ?";
        $resultado = executarSQL($sql, 'i', [$idTarefa]);
        
        // usa-se $resultado[1][0] pois essa consulta retorna, sempre, apenas um registro.
        $linha = $resultado[1][0];
        
        //Pega as variáveis com os dados
        $titulo = $linha['titulo'];
        $descricao = $linha['descricao'];
        $data_inicio = $linha['data_inicio'];
        $data_conclusao = $linha['data_conclusao'];
        $id_tarefa = $linha['id_tarefa'];
        $prioridade = $linha['prioridade'];

    } else {
        //Criar as variáveis para idenficiar a operação
        $textoAcao = 'Criar';
        $action = 'insert';
        //Cria as variáveis em branco
        $titulo = '';
        $descricao = '';
        $data_inicio = '';
        $data_conclusao = '';
        $id_tarefa = '';
        $prioridade = '';
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $textoAcao ?> Tarefa</title>
</head>
<body>
    <h1><?php echo $textoAcao ?>  Tarefa</h1>

    <form action="../controle/controle_tarefa.php" method="post" >
        <input type="text" name="titulo" id="titulo" placeholder="Título" value='<? echo $titulo?>' required />
        <br /> <br />
        <textarea name="descricao" id="descricao" rows="5" placeholder="Descrição detalhada" required ><? echo $descricao ?></textarea>
        <br /> <br />
        <input type="date" name="data_inicio" id="data_inicio" value='<? echo $data_inicio ?>' required />
        <br /> <br />
        <input type="date" name="data_conclusao" id="data_conclusao"  value='<? echo $data_conclusao ?>' required />
        <br /> <br />
        <select name="prioridade" id="prioridade">
            <option value="0" <? if( $prioridade == 0) { echo 'selected'; }; ?>>-</option>
            <option value="1" <? if( $prioridade == 1) { echo 'selected'; }; ?>>Baixa</option>
            <option value="2" <? if( $prioridade == 2) { echo 'selected'; }; ?>>Média</option>
            <option value="3" <? if( $prioridade == 3) { echo 'selected'; }; ?>>Alta</option>
        </select>
        <input type="hidden" name='action' id='action' value='<? echo $action ?>'/>
        <input type="hidden" name='id' id='id' value='<? echo $id_tarefa ?>'/>
        <br /> <br />
        <!-- <button type="submit">Enviar</button> -->
        <button type="submit"><?= $textoAcao; ?></button>
    </form>

</body>
</html>