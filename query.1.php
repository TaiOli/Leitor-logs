<?php

//TODO: instalar o composer
//https://getcomposer.org/download/

// senha = 2{f^N4W5"<3hQx"<


//TODO: phpuni
require_once('conexao.php');

function verificaSeExisteEstatisticasParaOUsuarioNaDataEspecificada($usuarioId, $data) {
      
      $pdo=fabricaConexao();
      

      $query = $pdo->prepare("SELECT summaryid FROM email_user_stats_emailsperhour WHERE userid=:user AND sendtime=:sendtime");
      
      $result = $query->execute(array(
        ':user' => $usuarioId,
        ':sendtime' => $data
        ));
        
      var_dump($result);
      //$result=$query->fetchAll();
      
      
 
      for($i=0; $row = $query->fetch(); $i++){
        
        echo("achou");
        echo $i." - ".$row['summaryid']."<br/>"
        $summaryid=$row['summaryid'];
      }
      
       if($count($result)>0){
        // quando o summaryid não existe, o valor da quantidade = 1
       $ins=$pdo->prepare("INSERT INTO email_user_stats_emailsperhour(statid, sendtime, emailssent, userid) VALUES(0, :sendtime, 1, :userid)");
        $result = $ins->execute(array(
        ':user' => $usuarioId,
        ':sendtime' => $data
        ));
       var_dump($result);
       
      }else{
        // quando o summaryid já existe, o valor da quantidade = quantidade + 1
        $upd=$pdo->prepare("UPDATE email_user_stats_emailsperhour SET emailssent = emailssent + 1 WHERE summaryid = :summaryid");
        $result= $upd->execute(array
        ':summaryid' =>$row['summaryid']
        ));
       
     }
     
      unset($pdo); 
      unset($query);
      
      //echo("fim");
}

verificaSeExisteEstatisticasParaOUsuarioNaDataEspecificada(1, 1657544881);


