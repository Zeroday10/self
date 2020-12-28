<?php

$enemy = file_get_contents('enemy.txt'); 
$doshman = file_get_contents('bad.txt');
$mod = file_get_contents("mod.txt");
$fosh = file("fosh.txt");
$fohsh = $fosh[array_rand($fosh)];
//------//
if(preg_match("/^(بگو) (.*)/iu",$msg)){
preg_match("/^(بگو) (.*)/iu",$msg,$match);
$MadelineProto->messages->sendMessage(['peer'=>$chatID,'message'=>$match[2],'reply_to_msg_id'=>$msg_id]);
}
//-----//
if($msg == '/Timedit'){
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => 'Z PHP ;)']);
for ($i=0; $i <= 50; $i++){
$ed =  $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => date('H:i:s'),]);
sleep(1);
}
}
//----
if($msg == "/fal"){
$fal = file_get_contents("https://api-eliyatm.cf/fal-txt.php");
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'reply_to_msg_id' => $msg_id, 'message' => " 🔗 فال امروز برای شما:

📌
$fal

⭐️ کانل من :
🆔 @Conditions_zero ", ]);
}
//----
if($msg == "/My"){
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'reply_to_msg_id' => $msg_id, 'message' => "بسم الله الرحمن الرحیم

ایدی من جهت ارتباط:
🆔 @MrTerminal", ]);
}
//----
if($doshman == "on"){
if($mod == "tak"){
if(stripos($enemy, "$userID") !== false){
 $MadelineProto->messages->sendMessage(['peer' => $chatID, 'reply_to_msg_id' =>
 $msg_id ,'message' =>
 $fohsh,'parse_mode' => 'html']); 
}
}
}
//---
if($msg =="آیدی" || $msg=="ایدی" || $msg=="/id" || $msg=="id" || $msg=="!id" || $msg=="me" || $msg=="/me" || $msg=="!me"){
if(isset($update['update']['message']['reply_to_msg_id'])){
$gmsg = $MadelineProto->channels->getMessages(['channel' => $chatID, 'id' => [$update["update"]["message"]["reply_to_msg_id"]]]);
$reply_from_id = $gmsg['messages'][0]['from_id'];
$photos_Photos = $MadelineProto->photos->getUserPhotos(['user_id' => $reply_from_id, 'offset' => 0, 'max_id' => 0, 'limit' => 1, ]);
$photo_id=$photos_Photos['photos']['0']['id'];
$photo_hash=$photos_Photos['photos']['0']['access_hash'];
$mee = $MadelineProto->get_full_info($reply_from_id);
if($photo_id == null){
$me = $mee['User'];
$me_id = $me['id'];
$me_status = $me['status']['_'];
$me_bio = $mee['full']['about'];
$me_name = $me['first_name'];
$me_uname = $me['username']; 
@$database_warn = json_decode(file_get_contents("warn/$chatID.json"),true);
$warn_count = $database_warn["$reply_from_id"];
if($warn_count == null){
$warn_count = 0;
}
$mes_fa = "🔺شناسه : $me_id
🔻نام : $me_name
🔸یوزرنیم : @$me_uname
📍تعداد اخطار های شما : $warn_count
▫️تعداد پیام های گروه : $msg_id";
$mes_en = "🔺ID : $me_id
🔻Name : $me_name
🔸Username : @$me_uname
📍Warns : $warn_count
▫Group Msgs Count : $msg_id";
if($lang == "en"){
$MadelineProto->messages->sendMessage(['peer' => $chatID,'message' => $mes_en,'reply_to_msg_id' => $msg_id,]);
}else{
$MadelineProto->messages->sendMessage(['peer' => $chatID,'message' => $mes_fa,'reply_to_msg_id' => $msg_id,]);	
}
}
if($photo_id !== null){
$me = $mee['User'];
$me_id = $me['id'];
$me_status = $me['status']['_'];
$me_bio = $mee['full']['about'];
$me_name = $me['first_name'];
$me_uname = $me['username']; 
@$database_warn = json_decode(file_get_contents("warn/$chatID.json"),true);
$warn_count = $database_warn["$reply_from_id"];
if($warn_count == null){
$warn_count = 0;
}
$mes_fa = "🔺شناسه : $me_id
🔻نام : $me_name
🔸یوزرنیم : @$me_uname
📍تعداد اخطار های شما : $warn_count
▫️تعداد پیام های گروه : $msg_id";
$mes_en = "🔺ID : $me_id
🔻Name : $me_name
🔸Username : @$me_uname
📍Warns : $warn_count
▫Group Msgs Count : $msg_id";
if($lang == "en"){
$inputPhoto = ['_' => 'inputPhoto', 'id' => $photo_id, 'access_hash' => $photo_hash];
 $inputMediaPhoto = ['_' => 'inputMediaPhoto', 'id' => $inputPhoto, ];
$MadelineProto->messages->sendMedia([ 'peer' => $chatID, 'media' => $inputMediaPhoto,'message' => "$mes_en"]);
}else{
$inputPhoto = ['_' => 'inputPhoto', 'id' => $photo_id, 'access_hash' => $photo_hash];
 $inputMediaPhoto = ['_' => 'inputMediaPhoto', 'id' => $inputPhoto, ];
$MadelineProto->messages->sendMedia([ 'peer' => $chatID, 'media' => $inputMediaPhoto,'message' => "$mes_fa"]);
}
}
}
if(isset($update['update']['message']['reply_to_msg_id']) == null){
$photos_Photos = $MadelineProto->photos->getUserPhotos(['user_id' => $userID, 'offset' => 0, 'max_id' => 0, 'limit' => 1, ]);
$photo_id=$photos_Photos['photos']['0']['id'];
$photo_hash=$photos_Photos['photos']['0']['access_hash'];
$mee = $MadelineProto->get_full_info($userID);
if($photo_id == null){
$me = $mee['User'];
$me_id = $me['id'];
$me_status = $me['status']['_'];
$me_bio = $mee['full']['about'];
$me_name = $me['first_name'];
$me_uname = $me['username']; 
if($warn_count == null){
$warn_count = 0;
}
$mes_fa = "🔺شناسه : $me_id
🔻نام : $me_name
🔸یوزرنیم : @$me_uname
📍تعداد اخطار های شما : $warn_count
▫️تعداد پیام های گروه : $msg_id";
$mes_en = "🔺ID : $me_id
🔻Name : $me_name
🔸Username : @$me_uname
📍Warns : $warn_count
▫Group Msgs Count : $msg_id";
if($lang == "en"){
$MadelineProto->messages->sendMessage(['peer' => $chatID,'message' => $mes_en,'reply_to_msg_id' => $msg_id,]);
}else{
$MadelineProto->messages->sendMessage(['peer' => $chatID,'message' => $mes_fa,'reply_to_msg_id' => $msg_id,]);	
}
}else{
$me = $mee['User'];
$me_id = $me['id'];
$me_status = $me['status']['_'];
$me_bio = $mee['full']['about'];
$me_name = $me['first_name'];
$me_uname = $me['username']; 
if($warn_count == null){
$warn_count = 0;
}
$mes_fa = "🔺شناسه : $me_id
🔻نام : $me_name
🔸یوزرنیم : @$me_uname
📍تعداد اخطار های شما : $warn_count
▫️تعداد پیام های گروه : $msg_id";
$mes_en = "🔺ID : $me_id
🔻Name : $me_name
🔸Username : @$me_uname
📍Warns : $warn_count
▫Group Msgs Count : $msg_id";
if($lang == "en"){
$inputPhoto = ['_' => 'inputPhoto', 'id' => $photo_id, 'access_hash' => $photo_hash];
 $inputMediaPhoto = ['_' => 'inputMediaPhoto', 'id' => $inputPhoto, ];
$MadelineProto->messages->sendMedia([ 'peer' => $chatID, 'media' => $inputMediaPhoto,'message' => "$mes_en"]);
}else{
$inputPhoto = ['_' => 'inputPhoto', 'id' => $photo_id, 'access_hash' => $photo_hash];
 $inputMediaPhoto = ['_' => 'inputMediaPhoto', 'id' => $inputPhoto, ];
$MadelineProto->messages->sendMedia([ 'peer' => $chatID, 'media' => $inputMediaPhoto,'message' => "$mes_fa"]);
}
}
}
}
//----like
if(preg_match("/^[\/\#\!]?(like) (.*)$/i", $msg)){
preg_match("/^[\/\#\!]?(like) (.*)$/i", $msg, $text);
$txxxt = $text[2];
$messages_BotResults = $MadelineProto->messages->getInlineBotResults(['bot' => "@like", 'peer' => $chatID, 'query' => $txxxt, 'offset' => '0', ]);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][0]['id'];
$MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $chatID, 'reply_to_msg_id' => $msg_id, 'query_id' => $query_id, 'id' => "$query_res_id", ]);
}
//----
if($msg == "/time"){
$time = file_get_contents("https://api.liteteam.ir/td.php");
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'reply_to_msg_id' => $msg_id, 'message' => " $time ", ]);
}
//----
if($msg == "info" || $msg == "gpinfo" || $msg == "/info" || $msg == "!info" || $msg == "اطلاعات"){
@$photos_Photos = $MadelineProto->get_full_info($chatID);
$pic_gp = $photos_Photos['Chat']['photo']['_'];
if($pic_gp !== "chatPhotoEmpty"){
$photos_Photos = $MadelineProto->get_full_info($chatID);
$photo_id=$photos_Photos['full']['chat_photo']['id'];
$photo_hash=$photos_Photos['full']['chat_photo']['access_hash'];
$bot_api_id = $photos_Photos['bot_api_id'];
$about = $photos_Photos['full']['about'];
$kicked_count = $photos_Photos['full']['kicked_count'];
$participants_count = $photos_Photos['full']['participants_count'];
$admins_count = $photos_Photos['full']['admins_count'];
$banned_count = $photos_Photos['full']['banned_count'];
$title = $photos_Photos['Chat']['title'];
$mes_en = "🔺ID : $bot_api_id
🔻Name : $title
🔸About : 
$about
▫️Group Members Count : $participants_count";
$inputPhoto = ['_' => 'inputPhoto', 'id' => $photo_id, 'access_hash' => $photo_hash];
 $inputMediaPhoto = ['_' => 'inputMediaPhoto', 'id' => $inputPhoto, ];
$MadelineProto->messages->sendMedia([ 'peer' => $chatID, 'media' => $inputMediaPhoto,'message' => "$mes_en"]);
}
if($pic_gp == "chatPhotoEmpty"){
$photos_Photos = $MadelineProto->get_full_info($chatID);
$photo_id=$photos_Photos['full']['chat_photo']['id'];
$photo_hash=$photos_Photos['full']['chat_photo']['access_hash'];
$bot_api_id = $photos_Photos['bot_api_id'];
$about = $photos_Photos['full']['about'];
$kicked_count = $photos_Photos['full']['kicked_count'];
$participants_count = $photos_Photos['full']['participants_count'];
$admins_count = $photos_Photos['full']['admins_count'];
$banned_count = $photos_Photos['full']['banned_count'];
$title = $photos_Photos['Chat']['title'];
$mes_en = "🔺ID : $bot_api_id
🔻Name : $title
🔸About : 
$about
▫️Group Members Count : $participants_count
▫️Admin Count : $admins_count
▫️Kicked Count : $kicked_count
▫️Banned Count : $banned_count";
$MadelineProto->messages->sendMessage(['peer' => $chatID,'message' => $mes_en,'reply_to_msg_id' => $msg_id,]);	
}
}
//--stiker--
if(preg_match("/^[\/\#\!]?(sticker) (.*)$/i", $msg)){
preg_match("/^[\/\#\!]?(sticker) (.*)$/i", $msg, $text);
$txxxt = $text[2];
$messages_BotResults = $MadelineProto->messages->getInlineBotResults(['bot' => "@big_text_bot", 'peer' => $chatID, 'query' => $txxxt, 'offset' => '0', ]);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][0]['id'];
$MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $chatID, 'reply_to_msg_id' => $msg_id, 'query_id' => $query_id, 'id' => "$query_res_id", ]);
}
//---
if($msg == "/joke"){
$jok = file_get_contents("http://api-eliyatm.cf/jok.php");
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'reply_to_msg_id' => $msg_id, 'message' => "
$jok

⭐️ کانال ما:
🆔 @Conditions_zero", ]);
}
if (in_array($userID, $admins)){

$data = json_decode(file_get_contents("data.json"), true);
if(preg_match("/^[\/\#\!]?(tak)$/i", $msg)){
 file_put_contents('mod.txt','tak');
              $MadelineProto->messages->sendMessage(['peer' => $chatID,'message' => "حله داش/:",'parse_mode' => 'MarkDown']);
}
if(preg_match("/^[\/\#\!]?(all)$/i", $msg)){
 file_put_contents('mod.txt','fu');
              $MadelineProto->messages->sendMessage(['peer' => $chatID,'message' => "هرچی تو بگی دادا/:",'parse_mode' => 'MarkDown']);
}
}
