<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/helpers/session_usuarios.php';
    session_start(); verificar_sessao("Admin");

    $sql = "SELECT * FROM tb_lote";
    $retorno = conectarDB("select", $sql, [], "");
    foreach ($retorno[1] as $dados) { 
        $id_lote = $dados['id_lote'];
        $titulo_lote = $dados['titulo_lote'];
        $valor_lote = $dados['valor_lote'];
        $estado_lote = $dados['estado_lote'];
        $tb_cavalo_id_cavalo = $dados['tb_cavalo_id_cavalo'];

        // Obter a data atual
        $data_atual = new DateTime();
        $data_fechamento = new DateTime('+7 days');

        // Calcular a diferença
        $diferenca = $data_atual->diff($data_fechamento);

        // Obter dias, horas, minutos e segundos
        $dias = $diferenca->d;
        $horas = $diferenca->h;
        $minutos = $diferenca->i;
        $segundos = $diferenca->s;

?>
         <div class="lotes">
             <div class="ls">
                 <img src="assets/img/horse.jpg" alt="" style="max-width: 100%; border-radius: 10px;  object-fit: cover;"> <br>
                 <hr> <br>
                 <h4>
                 <?= $titulo_lote?>
                 </h4> <br>
                 <hr><br>
                 <p><?= $valor_lote?></p>
                 <br>
                 <hr>
                 <p <?php if ($estado_lote == 'Disponível') {
                     echo "class='disponivel'";} 
                     else {echo "class='finalizado'";}?> ><?= $estado_lote?></p>
                 <br>
                 <hr>
             <div class="uls">
                     <ul class="ul_dias">
                         <li class="nuns"><?= $dias?></li>
                         <li>Dias</li>
                     </ul>
                     <ul class="ul_horas">
                         <li class="nuns"><?= $horas?></li>
                         <li>Horas</li>
                     </ul>
                     <ul class="ul_minutos">       
                         <li class="nuns"><?= $minutos?></li>
                         <li>Minutos</li>
                     </ul>
                     <ul class="ul_segundos">
                         <li class="nuns"><?= $segundos?></li>
                         <li>Segundos</li>
                     </ul>
                 
             </div>
         </div>

       <?php } ?>  
?>