<?php

  $kos = [
"کس ننت",
"ننت گاییده شد یا چی؟😂😂😂",
"ببین میتونی کیرمو بخوری خارکصه؟",
"ریز میبینمت ",
"کیرمم نتونستی بخوری ",
"ننه کس کلنگی",
"دم سوراخ ننت داد بزنم 5 بار صدام اکو میشه از بس گشاده",
"ننت جنده نیست فقط ملت با کس و کونش شوخی دارن",
"کیر اقام تو کون ننت ",
"بینهایت کس ننت",
"مادرت به گوه کشیده شد بای"

];
foreach ( $kos as $shmre => $shomare ) {
if(stripos($enemy, "$userID") !== false){
if($doshman == "on"){
if($mod == "fu"){
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'reply_to_msg_id' =>
 $msg_id ,'message' =>
 $shomare,'parse_mode' => 'html']); 
}
}
}
}
