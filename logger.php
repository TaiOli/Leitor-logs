<?php

//Retornando tamanho e valor da string

function zero($numero){
    if(strlen(strval($numero))<2){
        return "0$numero";
    }
    return $numero;
    
}

//Pegando data, mês, hora, destinatário e status 
function identificar_eventos_do_email($linha){
    
    $pattern="/^([A-Za-z]+)[ ]+([0-9]+)[ ]+([0-9]+):([0-9]+):([0-9]+)[^<]+<([^>]+).*status=([^ ]+).*/";
    $match = @preg_match($pattern, $linha, $matches);
    
    $ano=date('Y');

    $meses=array('jan'=>'01',
    'fev'=>'02',
    'Mar'=>'03',
    'Abr'=>'04',
    'Mai'=>'05',
    'Jun'=>'06',
    'Jul'=>'07',
    'Agos'=>'08',
    'Set'=>'09',
    'Out'=>'10',
    'Nov'=>'11',
    'Dez'=>'12');
    
    //Selecionando, insertando e dando update no banco as informações do log
    if($match){
        $matches[1]=$meses[$matches[1]];
        print_r($matches);
    //    $data=$ano."-".$matches[1]."-".zero($matches[2])." ".$matches[3].":".$matches[4].":".$matches[5];
        $data=$ano."-".$matches[1]."-".zero($matches[2])." ".$matches[3].":00:00";
    
        echo strtotime($data) . "\n";
    }
}



if ($file = fopen("/var/log/mail.log","r")) {
    while(!feof($file)) {
        $linha = fgets($file);
        identificar_eventos_do_email($linha);
    }
    fclose($file);
} 

?>