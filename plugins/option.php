<?php

if(isset($data['answering'][$msg])){
$texx = $data['answering'][$msg];
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => $texx, 'reply_to_msg_id' => $msg_id]);
}
if(strpos($msg, "😐") !== false && $data['poker'] == "on"){
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "😐", 'reply_to_msg_id' => $msg_id]);
}
if (in_array($userID, $admins)){

$data = json_decode(file_get_contents("data.json"), true);

if(preg_match("/^[\/\#\!]?(bot) (on|off)$/i", $msg)){
preg_match("/^[\/\#\!]?(bot) (on|off)$/i", $msg, $text);
$data['Status'] = $text[2];
file_put_contents("data.json", json_encode($data));
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "Bot is $text[2] Now!", ]);
}
if($data['Status'] == "on"){
//---
if(preg_match("/^[\/\#\!]?(save)$/i", $msg) && isset($update['update']['message']['reply_to_msg_id'])){
$me = $MadelineProto->get_self();
$me_id = $me['id'];
$MadelineProto->messages->forwardMessages(['from_peer' => $chatID, 'to_peer' => $me_id, 'id' => [$update['update']['message']['reply_to_msg_id']], ]);
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "Saved To yourself private xD"]);
}
//---
if(preg_match("/^[\/\#\!]?(flood) ([0-9]+) (.*)$/i", $msg)){
preg_match("/^[\/\#\!]?(flood) ([0-9]+) (.*)$/i", $msg, $text);
$count = $text[2];
$txt = $text[3];
$spm = "";
for($i=1; $i <= $count; $i++){
$spm .= "$txt \n";
}
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => $spm]);
}
if(preg_match("/^[\/\#\!]?(spam) ([0-9]+) (.*)$/i", $msg)){
preg_match("/^[\/\#\!]?(spam) ([0-9]+) (.*)$/i", $msg, $text);
$count = $text[2];
$txt = $text[3];
for($i=1; $i <= $count; $i++){
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => $txt]);
}
}
//---
if(strpos($msg,"/setanswer ") !== false){
$ip = trim(str_replace("/setanswer ","",$msg));
$ip = explode("|",$ip."|||||");
$txxt = trim($ip[0]);
$answeer = trim($ip[1]);
if(!isset($data['answering'][$txxt])){
$data['answering'][$txxt] = $answeer;
file_put_contents("data.json", json_encode($data));
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "کلمه جدید به لیست پاسخ شما اضافه شد👌🏻"]);
} else{
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "این کلمه از قبل موجود است :/"]);
}
}
 if(preg_match("/^[\/\#\!]?(delanswer) (.*)$/i", $msg)){
preg_match("/^[\/\#\!]?(delanswer) (.*)$/i", $msg, $text);
$txxt = $text[2];
if(isset($data['answering'][$txxt])){
unset($data['answering'][$txxt]);
file_put_contents("data.json", json_encode($data));
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "کلمه مورد نظر از لیست پاسخ حذف شد👌🏻"]);
} else{
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "این کلمه در لیست پاسخ وجود ندارد :/"]);
}
}
if(preg_match("/^[\/\#\!]?(clean answers)$/i", $msg)){
$data['answering'] = [];
file_put_contents("data.json", json_encode($data));
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "لیست پاسخ خالی است!"]);
}
if(preg_match("/^[\/\#\!]?(answerlist)$/i", $msg)){
if(count($data['answering']) > 0){
$txxxt = "Answer List: 
";
$counter = 1;
foreach($data['answering'] as $k => $ans){
$txxxt .= "$counter: $k => $ans \n";
$counter++;
}
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => $txxxt]);
} else{
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "No Answer!"]);
}
}
//---
if(preg_match("/^[\/\#\!]?(chats)$/i", $msg)){
$dialogs = json_encode($MadelineProto->get_dialogs());
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => ''.$dialogs]);
}
//---
if(preg_match("/^[\/\#\!]?(info) (.*)$/i", $msg)){
preg_match("/^[\/\#\!]?(info) (.*)$/i", $msg, $text);
$mee = $MadelineProto->get_full_info($text[2]);
$me = $mee['User'];
$me_id = $me['id'];
$me_status = $me['status']['_'];
$me_bio = $mee['full']['about'];
$me_common = $mee['full']['common_chats_count'];
$me_name = $me['first_name'];
$me_uname = $me['username']; 
$mes = "ID: $me_id \nName: $me_name \nUsername: @$me_uname \nStatus: $me_status \nBio: $me_bio \nCommon Groups Count: $me_common";
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => $mes]);
}
 if(preg_match("/^[\/\#\!]?(sessions)$/i", $msg)){
$authorizations = $MadelineProto->account->getAuthorizations();
$txxt="";
foreach($authorizations['authorizations'] as $authorization){
$txxt .="
hash: ".$authorization['hash']."
device_model: ".$authorization['device_model']."
platform: ".$authorization['platform']."
system_version: ".$authorization['system_version']."
api_id: ".$authorization['api_id']."
app_name: ".$authorization['app_name']."
app_version: ".$authorization['app_version']."
date_created: ".date("Y-m-d H:i:s",$authorization['date_active'])."
date_active: ".date("Y-m-d H:i:s",$authorization['date_active'])."
ip: ".$authorization['ip']."
country: ".$authorization['country']."
region: ".$authorization['region']."
======================
";
}
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => $txxt]);
}
//---
if(preg_match("/^[\/\#\!]?(blue) (.*)$/i", $msg)){
preg_match("/^[\/\#\!]?(blue) (.*)$/i", $msg, $text);
$txxxt = $text[2];
$messages_BotResults = $MadelineProto->messages->getInlineBotResults(['bot' => "@TextMagicBot", 'peer' => $chatID, 'query' => $txxxt, 'offset' => '0', ]);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][0]['id'];
$MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $chatID, 'reply_to_msg_id' => $msg_id, 'query_id' => $query_id, 'id' => "$query_res_id", ]);
}
//---
if(strpos($msg,"/hidden ") !== false){
$ip = trim(str_replace("/hidden ","",$msg));
$ip = explode("|",$ip."|||||");
$txxt = trim($ip[0]);
$answeer = trim($ip[1]);
$messages_BotResults = $MadelineProto->messages->getInlineBotResults(['bot' => "@nnbbot", 'peer' => $chatID, 'query' => "$txxt $answeer", 'offset' => '0', ]);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][0]['id'];
$MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $chatID, 'reply_to_msg_id' => $msg_id, 'query_id' => $query_id, 'id' => "$query_res_id", ]);
}
//---
if(preg_match("/^[\/\#\!]?(translate) (.*)$/i", $msg)){
preg_match("/^[\/\#\!]?(translate) (.*)$/i", $msg, $text);
$txxxt = $text[2];
$messages_BotResults = $MadelineProto->messages->getInlineBotResults(['bot' => "@TransisBot", 'peer' => $chatID, 'query' => $txxxt, 'offset' => '0', ]);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][0]['id'];
$MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $chatID, 'reply_to_msg_id' => $msg_id, 'query_id' => $query_id, 'id' => "$query_res_id", ]);
}
if(preg_match("/^[\/\#\!]?(short) (.*)$/i", $msg)){
preg_match("/^[\/\#\!]?(short) (.*)$/i", $msg, $text);
$txxxt = $text[2];
$messages_BotResults = $MadelineProto->messages->getInlineBotResults(['bot' => "@ylinkpro_bot", 'peer' => $chatID, 'query' => $txxxt, 'offset' => '0', ]);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][0]['id'];
$MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $chatID, 'reply_to_msg_id' => $msg_id, 'query_id' => $query_id, 'id' => "$query_res_id", ]);
}
//---
if(preg_match("/^[\/\#\!]?(apk) (.*)$/i", $msg)){
preg_match("/^[\/\#\!]?(apk) (.*)$/i", $msg, $text);
$txxxt = $text[2];
$messages_BotResults = $MadelineProto->messages->getInlineBotResults(['bot' => "@apkdl_bot", 'peer' => $chatID, 'query' => $txxxt, 'offset' => '0', ]);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][0]['id'];
$MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $chatID, 'reply_to_msg_id' => $msg_id, 'query_id' => $query_id, 'id' => "$query_res_id", ]);
}
//---
if(preg_match("/^[\/\#\!]?(calc) (.*)$/i", $msg)){
preg_match("/^[\/\#\!]?(calc) (.*)$/i", $msg, $text);
$txxxt = $text[2];
$messages_BotResults = $MadelineProto->messages->getInlineBotResults(['bot' => "@MACLBot", 'peer' => $chatID, 'query' => $txxxt, 'offset' => '0', ]);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][0]['id'];
$MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $chatID, 'reply_to_msg_id' => $msg_id, 'query_id' => $query_id, 'id' => "$query_res_id", ]);
}
//---
if(preg_match("/^[\/\#\!]?(time) (.*)$/i", $msg)){
preg_match("/^[\/\#\!]?(time) (.*)$/i", $msg, $text);
$txxxt = $text[2];
$messages_BotResults = $MadelineProto->messages->getInlineBotResults(['bot' => "@ClockBot", 'peer' => $chatID, 'query' => $txxxt, 'offset' => '0', ]);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][0]['id'];
$MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $chatID, 'reply_to_msg_id' => $msg_id, 'query_id' => $query_id, 'id' => "$query_res_id", ]);
}
//---
if(preg_match("/^[\/\#\!]?(weather) (.*)$/i", $msg)){
preg_match("/^[\/\#\!]?(weather) (.*)$/i", $msg, $text);
$txxxt = $text[2];
$messages_BotResults = $MadelineProto->messages->getInlineBotResults(['bot' => "@raindropsbot", 'peer' => $chatID, 'query' => $txxxt, 'offset' => '0', ]);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][0]['id'];
$MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $chatID, 'reply_to_msg_id' => $msg_id, 'query_id' => $query_id, 'id' => "$query_res_id", ]);
}
//---
if(preg_match("/^[\/\#\!]?(google) (.*)$/i", $msg)){
preg_match("/^[\/\#\!]?(google) (.*)$/i", $msg, $text);
$txxxt = $text[2];
$messages_BotResults = $MadelineProto->messages->getInlineBotResults(['bot' => "@GoogleDEBot", 'peer' => $chatID, 'query' => $txxxt, 'offset' => '0', ]);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][rand(0, count($messages_BotResults['results']))]['id'];
$MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $chatID, 'reply_to_msg_id' => $msg_id, 'query_id' => $query_id, 'id' => "$query_res_id", ]);
}
//---
if(preg_match("/^[\/\#\!]?(gif) (.*)$/i", $msg)){
preg_match("/^[\/\#\!]?(gif) (.*)$/i", $msg, $text);
$txxxt = $text[2];
$messages_BotResults = $MadelineProto->messages->getInlineBotResults(['bot' => "@gif", 'peer' => $chatID, 'query' => $txxxt, 'offset' => '0', ]);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][rand(0, count($messages_BotResults['results']))]['id'];
$MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $chatID, 'reply_to_msg_id' => $msg_id, 'query_id' => $query_id, 'id' => "$query_res_id", ]);
							}
//---
if(preg_match("/^[\/\#\!]?(pic) (.*)$/i", $msg)){
preg_match("/^[\/\#\!]?(pic) (.*)$/i", $msg, $text);
$txxxt = $text[2];
$messages_BotResults = $MadelineProto->messages->getInlineBotResults(['bot' => "@pic", 'peer' => $chatID, 'query' => $txxxt, 'offset' => '0', ]);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][rand(0, count($messages_BotResults['results']))]['id'];
$MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $chatID, 'reply_to_msg_id' => $msg_id, 'query_id' => $query_id, 'id' => "$query_res_id", ]);
}
//---
if(preg_match("/^[\/\#\!]?(voice) (.*)$/i", $msg)){
preg_match("/^[\/\#\!]?(voice) (.*)$/i", $msg, $text);
$txxxt = $text[2];
$messages_BotResults = $MadelineProto->messages->getInlineBotResults(['bot' => "@melobot", 'peer' => $chatID, 'query' => $txxxt, 'offset' => '0', ]);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][rand(0, count($messages_BotResults['results']))]['id'];
$MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $chatID, 'reply_to_msg_id' => $msg_id, 'query_id' => $query_id, 'id' => "$query_res_id", ]);
}

//---
if(preg_match("/^[\/\#\!]?(poker) (on|off)$/i", $msg)){
preg_match("/^[\/\#\!]?(poker) (on|off)$/i", $msg, $text);
$data['poker'] = $text[2];
file_put_contents("data.json", json_encode($data));
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "Poker Now Is $text[2]", ]);
}
//---
if(strpos(" ".$msg, "!setenemy")){
  $prima = str_replace("!setenemy ", "", $msg);
$myfile2 = fopen("enemy.txt", "a") or die("Unable to open file!"); 
fwrite($myfile2, "$prima\n");
fclose($myfile2);
 $MadelineProto->messages->sendMessage(['peer' => $chatID,'reply_to_msg_id' => $msg_id ,'message' => "🔻فرد موردنظر به لیست دشمنان اضافه  شد
💢 ایدی عددی فرد مورد نظر :$prima"]);
}
if(strpos(" ".$msg, "!delenemy")){
  $prima2 = str_replace("!delenemy ", "", $msg);
$newlist = str_replace($prima2, "", $enemy);
file_put_contents("enemy.txt", $newlist);
 $MadelineProto->messages->sendMessage(['peer' => $chatID,'reply_to_msg_id' => $msg_id ,'message' => "🔻فرد موردنظر از لیست دشمنان حذف شد
💢 ایدی عددی فرد مورد نظر :$prima2"]);
}
if($msg == '!enemylist'){
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'reply_to_msg_id' => $msg_id ,'message' => "🔰 لیست دشمنان ربات :
﹍﹍﹍﹍﹍﹍﹍﹍﹍﹍
$enemy",'parse_mode' => 'MarkDown']);
}
//---
if($msg == "!enemyon"){
 file_put_contents('bad.txt','on');
              $MadelineProto->messages->sendMessage(['peer' => $chatID,'message' => "حالت مواجه شدن با دشمن فعال شد ✅

🔻اگر شما شخصی را به عنوان دشمن تنظیم کرده باشید از این لحظه به بعد ربات شروع به فحش دادن به او در گروه و پیوی میکند 😂",'parse_mode' => 'MarkDown']);
}
if($msg == "!enemyoff"){
 file_put_contents('bad.txt','off');
              $MadelineProto->messages->sendMessage(['peer' => $chatID,'message' => "حالت مواجه شدن با دشمن غیرفعال شد ✅   
🔻ربات با دشمنان کاری نداد ",'parse_mode' => 'MarkDown']);
}
//---
if(preg_match("/^[\/\#\!]?(block) (.*)$/i", $msg)){
preg_match("/^[\/\#\!]?(block) (.*)$/i", $msg, $text);
$MadelineProto->contacts->block(['id' => $text[2], ]);
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "Blocked!"]);
}
 if(preg_match("/^[\/\#\!]?(unblock) (.*)$/i", $msg)){
preg_match("/^[\/\#\!]?(unblock) (.*)$/i", $msg, $text);
$MadelineProto->contacts->unblock(['id' => $text[2], ]);
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "UnBlocked!"]);
}
if(preg_match("/^[\/\#\!]?(cleanenemy)$/i", $msg)){ 
   unlink("enemy.txt"); 
   $MadelineProto->messages->sendMessage(['peer' => $chatID, 'reply_to_msg_id' => $msg_id ,'message' => "🔻
لیست دشمنان ربات خالی شد 
:)",'parse_mode' => 'MarkDown']);
}
//---
 if(strpos($msg,"setusername ") !== false){
$ip = trim(str_replace("setusername ","",$msg));
$ip = explode("|",$ip."|||||");
$id = trim($ip[0]);
$User = $MadelineProto->account->updateUsername(['username' => "$id", ]);
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' =>"•نام کاربری جدید برای ربات تنظیم شد : 
@$id",'parse_mode' => "markdown"]);
 }
if(strpos($msg,"profile ") !== false){
$ip = trim(str_replace("profile ","",$msg));
$ip = explode("|",$ip."|||||");
$id1 = trim($ip[0]);
$id2 = trim($ip[1]);
$id3 = trim($ip[2]);
$User = $MadelineProto->account->updateProfile(['first_name' => "$id1", 'last_name' => "$id2", 'about' => "$id3", ]);
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' =>"
🔸نام جدید ربات : $id1
🔹نام خانوادگی جدید ربات : $id2
🔸بیوگرافی جدید ربات : $id3
➖➖➖➖➖➖➖➖
",'parse_mode' => "markdown"]);
}
if($typing== 'yes'){
$sendMessageTypingAction = ['_' => 'sendMessageTypingAction'];
$m= $MadelineProto->messages->setTyping(['peer' => $chatID, 'action' =>$sendMessageTypingAction ]);				
}
if($markread == 'yes'){
$msg_id = $update['update']['message']['id'];
if($chatID < 0){
$msg_id = $update['update']['message']['id'];
$MadelineProto->channels->readHistory(['channel' => $chatID, 'max_id' => $msg_id ]);
$MadelineProto->channels->readMessageContents(['channel' => $chatID, 'id' => [$msg_id] ]);
}else{
$MadelineProto->messages->readHistory(['peer' => $chatID , 'max_id' => $msg_id ]);
}}
 if($msg =="markread on" ||$msg=="MarkRead On" ||$msg=="MarkRead on"){
$data["data"]["markread"] = "yes";
file_put_contents("data.json",json_encode($data));
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' =>'با موفقیت انجام شد✔️','parse_mode' => "markdown"]);

$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id +1, 'message' =>'حالت <b>Mark Read</b> در ربات فعال شد❗️', 'parse_mode' => 'html' ]);
}
 if($msg =="markread off" ||$msg=="MarkRead Off" ||$msg=="MarkRead off"){
$data["data"]["markread"] = "no";
file_put_contents("data.json",json_encode($data));
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' =>'با موفقیت انجام شد✔️','parse_mode' => "markdown"]);

$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id +1, 'message' =>'حالت <b>Mark Read</b> در ربات خاموش شد❗️', 'parse_mode' => 'html' ]);
}
if($msg =="typing on" ||$msg=="Typing On" ||$msg=="Typing on"){
$data["data"]["typing"] = "yes";
file_put_contents("data.json",json_encode($data));
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' =>'با موفقیت انجام شد✔️','parse_mode' => "markdown"]);

$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id +1, 'message' =>'حالت <b>Typing</b> در ربات فعال شد❗️', 'parse_mode' => 'html' ]);
}
 if($msg =="typing off" ||$msg=="Typing Off" ||$msg=="Typing off"){
$data["data"]["typing"] = "no";
file_put_contents("data.json",json_encode($data));
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' =>'با موفقیت انجام شد✔️','parse_mode' => "markdown"]);

$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id +1, 'message' =>'حالت <b>Typing</b> در ربات خاموش شد❗️', 'parse_mode' => 'html' ]);
}
if($msg =="contacts on" ||$msg=="Contacts On" ||$msg=="Contacts on"){
$data["data"]["contacts"] = "yes";
file_put_contents("data.json",json_encode($data));
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' =>'با موفقیت انجام شد✔️','parse_mode' => "markdown"]);

$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id +1, 'message' =>'حالت ذخیره سازی خودکار مخاطب در ربات فعال شد❗️', 'parse_mode' => 'html' ]);
}
 if($msg =="contacts off" ||$msg=="Contacts Off" ||$msg=="Contacts off"){
$data["data"]["contacts"] = "no";
file_put_contents("data.json",json_encode($data));
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' =>'با موفقیت انجام شد✔️','parse_mode' => "markdown"]);

$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id +1, 'message' =>'حالت ذخیره سازی خودکار مخاطب در ربات خاموش شد❗️', 'parse_mode' => 'html' ]);
}
}
}
