<?php

if($msg == 'ping' || $msg == 'Ping' || $msg == 'ربات' || $msg == 'آنلاینی' || $msg == 'انلاینی'){ 
$robot = [ "جونم", "هاع؟😐", "انلاینم", "بلهههه", "کارم داری؟", "جانم بابایی", "صدام نکن :|", "کارتو بنال :/", "بله ادمین جون", "خب😐", "بگو؟😕" ]; 
$r = $robot[rand(0, count($robot)-1)];
 $MadelineProto->messages->sendMessage(['peer' => $chatID, 'reply_to_msg_id' =>
 $msg_id ,'message' =>
 $r,'parse_mode' => 'html']); 
}
if ($msg =="/chatid" ||$msg=="!chatid" ||$msg=="#chatid"){ 
      $MadelineProto->messages->sendMessage(['peer' =>$chatID,'reply_to_msg_id' => $msg_id ,'message' =>  "$chatID",'parse_mode' => 'MarkDown']); 
} 

