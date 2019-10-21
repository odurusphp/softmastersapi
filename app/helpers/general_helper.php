<?php


function months(){
    $mtharr  = array('Jan'=>'01', 'Feb'=>'02',
    'Mar'=>'03','Apr'=>'04', 'May'=>'05', 'Jun'=>'06', 'Jul'=>'07','Aug'=>'08',
    'Sep'=>'09', 'Oct'=>'10', 'Nov'=>'11', 'Dec'=>'12');
    return $mtharr;
}




function getYear(){
    for($y=2015; $y<=date('Y'); $y++){
        $years[] = $y;
    }
    return $years;
}


function sendTextMessage($telephone, $title){

  $key="c4b012085cf6c914e538";
  $altelephone = substr($telephone, 1);
  $mestelephone = '233'.$altelephone;
  $message = 'You have been assigned a task labelled '.$title. '.'.
             'Please verify and work on it. Thank you';
  $message=urlencode($message);
  $sender_id = 'LABOR POWER';
  $url="https://apps.mnotify.net/smsapi?key=$key&to=$mestelephone&msg=$message&sender_id=$sender_id";
  $result=file_get_contents($url);


}


function kmaTextMessage($telephone){

    $key="c4b012085cf6c914e538";
    $altelephone = substr($telephone, 1);
    $mestelephone = '233'.$altelephone;
    $message = 'Your store allocation has been approved. Report at the office of Kumasi City Markets Limited at Kejetia  with your original documents to process your allocation';
    $message=urlencode($message);
    $sender_id = 'KCM KMA';
    $url="https://apps.mnotify.net/smsapi?key=$key&to=$telephone&msg=$message&sender_id=$sender_id";
    $result=file_get_contents($url);


}


function receiveTextMessage($telephone, $title){

  $key="c4b012085cf6c914e538";
  $altelephone = substr($telephone, 1);
  $mestelephone = '233'.$altelephone;
  $message = 'Feedback on task '.$title. '. Please log in to your account and verify'.
             'Thank you';
  $message=urlencode($message);
  $sender_id = 'LABOR POWER';
  $url="https://apps.mnotify.net/smsapi?key=$key&to=$mestelephone&msg=$message&sender_id=$sender_id";
  $result=file_get_contents($url);

}

function premiumCalculation($premium){
   $cost = $premium * 12 * 5;
   return  $cost;
}


function premiumBOP($premium){
    $cost = 0.03 * ($premium * 12);
    return  $cost;
}

function paymentcycle($cycle){
   if($cycle == 'Monthly'){
     return 1;
   }elseif($cycle == 'Quarterly'){
      return 3;
   }elseif($cycle == 'Biannually'){
     return 6;
   }elseif($cycle == 'Annually'){
     return 12;
   }else{
     return 0;
   }
}

function randomString($length = 8) {
    $str = "";
    $characters = array_merge(range('A','Z'), range('a','z'));
    $max = count($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $max);
        $str .= $characters[$rand];
    }
    return $str;
}


function randomFix($length)
{
    $random= "";

    srand((double)microtime()*1000000);

    $data = "AbcDE123IJKLMN67QRSTUVWXYZ";
    $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
    $data .= "0FGH45OP89";

    for($i = 0; $i < $length; $i++)
    {
        $random .= substr($data, (rand()%(strlen($data))), 1);
    }
    return $random;
}


function invoiceNumbers($newreportnumber){
     $newreportnumber = $newreportnumber + 1;
    if(strlen($newreportnumber) == 1) $reportindex = '00000'.$newreportnumber;
    if(strlen($newreportnumber) == 2) $reportindex = '0000'.$newreportnumber;
    if(strlen($newreportnumber) == 3) $reportindex = '000'.$newreportnumber;
    if(strlen($newreportnumber) == 4) $reportindex = '00'.$newreportnumber;
    if(strlen($newreportnumber) == 5) $reportindex = '0'.$newreportnumber;
    if(strlen($newreportnumber) >= 6) $reportindex = $newreportnumber;

    return 'RP-'.$reportindex;
}


function setupinvoiceNumbers($newreportnumber){
    $newreportnumber = $newreportnumber + 1;
    if(strlen($newreportnumber) == 1) $reportindex = '00000'.$newreportnumber;
    if(strlen($newreportnumber) == 2) $reportindex = '0000'.$newreportnumber;
    if(strlen($newreportnumber) == 3) $reportindex = '000'.$newreportnumber;
    if(strlen($newreportnumber) == 4) $reportindex = '00'.$newreportnumber;
    if(strlen($newreportnumber) == 5) $reportindex = '0'.$newreportnumber;
    if(strlen($newreportnumber) >= 6) $reportindex = $newreportnumber;

    return 'SF-'.$reportindex;
}




?>
