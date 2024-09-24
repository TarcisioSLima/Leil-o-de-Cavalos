<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarefas TADW</title>
</head>

<body>
    <h1>Tarefas</h1>
    <a href="form_tarefa.php">Criar nova tarefa</a>

    <a href="relatorio1.php">Gerar relatório (Opção1)</a>

    <a href="relatorio2.php">Gerar relatório (Opção2)</a>

    <a href="relatorio3.php">Gerar relatório (Opção3)</a>

    <br /> <br />

    <table>
        <thead>
            <tr>
                <td>Título</td>
                <td>Descição</td>
                <td>Data Início</td>
                <td>Data Final</td>
                <td>Prioridade</td>
                <td>Ações</td>
            </tr>
        </thead>
        <tbody>
            <?php
            include_once('../db/conexao.php');
            // $sql = "SELECT * FROM tb_tarefa WHERE id_usuario = ? ORDER BY id_tarefa;";
            $sql = "SELECT * FROM tb_tarefa WHERE id_usuario = 1 ORDER BY id_tarefa;";
            // $id = 1;
            // $retorno = executarSQL($sql, "i", [$id]);
            $retorno = executarSQL($sql, "", []);

            if (sizeof($retorno[1]) > 0) {
                foreach ($retorno[1] as $linha) {
            ?>
                    <tr>
                        <td> <?php echo $linha['titulo'] ?> </td>
                        <td> <?php echo $linha['descricao'] ?> </td>
                        <td> <?php echo $linha['data_inicio'] ?> </td>
                        <td> <?php echo $linha['data_conclusao'] ?> </td>
                        <td> <?php echo $linha['prioridade'] ?> </td>
                        <td>
                            <a href="../controle/controle_tarefa.php?action=delete&id=<?php echo $linha['id_tarefa'] ?> ">Deletar</a>
                            <a href="form_tarefa.php?id=<?php echo $linha['id_tarefa'] ?>">Atualizar</a>
                        </td>
                    </tr>
            <?php
                };
            } else {
                echo "<h2>Nenhuma tarefa encontrada</h2>";
            };
            ?>
        </tbody>
    </table>
</body>

</html>