<?php

$linha1="Jul  6 14:22:00 snw postfix/smtp[28453]: 94B4D101C19: to=<maxmobinho@outlok.com>, relay=none, delay=5, delays=3.9/0.88/0.25/0, dsn=5.4.4, status=bounced (Host or domain name not found. Name service error for name=outlok.com type=AAAA: Host found but no data record of requested type)";
$linha2="Jul  6 14:22:00 snw postfix/smtp[28453]: 94B4D101C19: to=<maxmobinho@outlok.com>, relay=none, delay=5, delays=3.9/0.88/0.25/0, dsn=5.4.4, status=sent (Host or domain name not found. Name service error for name=outlok.com type=AAAA: Host found but no data record of requested type)";

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

    $meses=array('Jan'=>'01',
    'Fev'=>'02',
    'Mar'=>'03',
    'Abr'=>'04',
    'Mai'=>'05',
    'Jun'=>'06',
    'Jul'=>'07',
    'Ago'=>'08',
    'Set'=>'09',
    'Out'=>'10',
    'Nov'=>'11',
    'Dez'=>'12');
    

    if($match){
        $matches[1]=$meses[$matches[1]];
        if(strcmp($matches[7],'sent')==0){
            print_r($matches);

            //    $data=$ano."-".$matches[1]."-".zero($matches[2])." ".$matches[3].":".$matches[4].":".$matches[5];
            $data=$ano."-".$matches[1]."-".zero($matches[2])." ".$matches[3].":00:00";
            $sendtime=strtotime($data);


                $query="SELECT summaryid FROM mailmax.email_user_stats_emailsperhour WHERE userid=? AND sendtime=?";

                // $insertQuery="INSERT INTO mailmax.email_user_stats_emailsperhour (statid, sendtime, emailssent, userid) VALUES(0, ?, 1, ?);";
                // $updateQuery="UPDATE mailmax.email_user_stats_emailsperhour SET emailssent=emailssent+1 WHERE summaryid=?;";
            
        }
    }
}

//Resposta Linha 1
echo 'linha1';
identificar_eventos_do_email($linha1);

//Resposta Linha 2
echo 'linha2';
identificar_eventos_do_email($linha2);

?>