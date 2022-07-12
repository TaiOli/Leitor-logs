<?php

//TODO: instalar o composer
//https://getcomposer.org/download/

//TODO: phpuni
define("SENDSTUDIO_TABLEPREFIX", "email_");
define("SENDSTUDIO_DATABASE_HOST", "127.0.0.1");
define("SENDSTUDIO_DATABASE_USER", "uis");
define("SENDSTUDIO_DATABASE_PASS", "XA15a#s@Bz5CGEVS");
define("SENDSTUDIO_DATABASE_NAME", "mailmax");


function verificaSeExisteEstatisticasParaOUsuarioNaDataEspecificada($usuarioId, $data) {

        $prefix = SENDSTUDIO_TABLEPREFIX;
        $link = mysqli_connect(
          SENDSTUDIO_DATABASE_HOST,
          SENDSTUDIO_DATABASE_USER,
          SENDSTUDIO_DATABASE_PASS,
          SENDSTUDIO_DATABASE_NAME);

        if (!$link) {
          echo('erro ao conectar ao banco');
          exit;
        }

        $query = "SELECT summaryid FROM ${prefix}user_stats_emailsperhour WHERE userid=? AND sendtime=?";
        $stmt = mysqli_prepare($link, $query);
      
        mysqli_stmt_bind_param($stmt, 'ii', $usuarioId, $data);
        mysqli_stmt_execute($stmt);
    
        mysqli_stmt_bind_result($stmt, $summaryid);
    
        $empty=true;
        $error = mysqli_stmt_errno($stmt);
        
        while(mysqli_stmt_fetch($stmt)){
          
          if($empty){
            
            $empty=false;
          }
        }
          
        if($empty){
            echo("a consulta nao retornou resultados, será feita uma insercao no banco");
        } else {
          
           echo("será feito uma atualizacao no banco");
        }

        // fecha o statement
        mysqli_stmt_close($stmt);


        //fecha a conexao com o banco
        mysqli_close($link);
 
}
// verificaSeExisteEstatisticasParaOUsuarioNaDataEspecificada(1, 1639771200);
verificaSeExisteEstatisticasParaOUsuarioNaDataEspecificada(1, 9639771200);