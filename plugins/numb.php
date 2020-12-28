<?php

  $kos = [
"➊",
"➋",
"➌",
"➍",
"➎",
"➏",
"➐",
"➑",
"➒",
"➓",
"شمردم قربان ، امر دیگری نیست؟"

];
foreach ( $kos as $shmre => $shomare ) {


if (in_array($userID, $admins)){
if($msg == "بشمار"){
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'reply_to_msg_id' =>
 $msg_id ,'message' =>
 $shomare,'parse_mode' => 'html']); 

}
}
}
