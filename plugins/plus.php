<?php

if (in_array($userID, $admins)){
if(strpos($msg,"/download ") !== false){
         $req = trim(str_replace("/download ","",$msg));
         $req = explode("|",$req."|");
         $link = trim($req[0]);
         $name = trim($req[1]);
         $header = get_headers($link,true);
         if(isset($header['Content-Length'])){
          $file_size = $header['Content-Length'];
         }else{
          $file_size = -1;
         }
         $sizeLimit = ( 40 * 1024 * 1024);
         if($name==""){
          $name=explode("/",$link);
          $name = $name[sizeof($name)-1];
         }
         if($file_size > 0 && $file_size <= $sizeLimit ){
          $txt = "⏳ <b>Downloading Wait...</b> ".$name."";
          $m = $MadelineProto->messages->sendMessage(['peer' => $chatID, 'reply_to_msg_id' => $mid , 'message' => $txt, 'parse_mode' => 'HTML' ]);
          if(isset($m['updates'][0]['id'])){
           $mid = $m['updates'][0]['id'];
          }else{
           $mid = $m['id'];
          }
          
          $file = file_get_contents($link);
          $localFile = 'Eliya/'.$name;
          file_put_contents($localFile,$file);
          $txt = "⏳ <b>Uploading...</b> ".$name."";
          $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $mid, 'message' => $txt, 'parse_mode' => 'html' ]);
          $caption = '☂'.$name.'|@Robotsazi_Eliya';
          
          $inputFile = $MadelineProto->upload($localFile);
          $txt = "⏳ Sending Wait plz...: <b>".$name."</b>";
          $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $mid, 'message' => $txt, 'parse_mode' => 'html' ]);
          $inputMedia = ['_' => 'inputMediaUploadedDocument', 'file' => $inputFile, 'mime_type' => mime_content_type($localFile), 'caption' => $caption, 'attributes' => [['_' => 'documentAttributeFilename', 'file_name' => $name]]];
          
          $p = ['peer' => $chatID, 'media' => $inputMedia];
          $res = $MadelineProto->messages->sendMedia($p);
          unlink($localFile);
          
          $txt = "🔰 <b>Sent!</b> 😉";
          $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $mid, 'message' => $txt, 'parse_mode' => 'html' ]);
          
          
         }else{
          $text = "❌ Max File Size: <b>".($sizeLimit / 1024 /1024 )."MB</b> but your file is <b>".round(($file_size/1024/1024),2)."MB</b>";
         }
}


if(preg_match("/^[\/\#\!]?(خروج|left)$/i", $msg)){
  $type = $MadelineProto->get_info($chatID);
  $type3 = $type['type'];
  if($type3 == "supergroup"){
    $MadelineProto->messages->sendMessage(['peer' => $chatID,'message' => "Bye!! :)"]);
    $MadelineProto->channels->leaveChannel(['channel' => $chatID, ]);
  }else{
    $MadelineProto->messages->sendMessage(['peer' => $chatID,'reply_to_msg_id' => $msg_id ,'message' => "این دستور مخصوص استفاده در سوپرگروه میباشد"]);
  }
}

if(strpos($msg, "بکنش") !== false){
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "چشم سرورم", 'reply_to_msg_id' => $msg_id]);
}
if(strpos($msg, "بکنش") !== false){
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "بکش پایین اومدم😍", 'reply_to_msg_id' => $msg_id]);
}
if(strpos($msg, "بکنش") !== false){
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "جووون چه نرمی سکسیه من😍💦", 'reply_to_msg_id' => $msg_id]);
}
if(strpos($msg, "بکنش") !== false){
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' =>"داره ابم میادکه😍اههه", 'reply_to_msg_id' => $msg_id]);
}
if(strpos($msg, "بکنش") !== false){
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "اخیش اومدکه 😍💦", 'reply_to_msg_id' => $msg_id]);
}
if(strpos($msg, "بکنش") !== false){
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "اییییی جووووون خالی کردم روکمرت اخیش💦💦🤤", 'reply_to_msg_id' => $msg_id]);
}
if(strpos($msg, "بکنش") !== false){
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "حالا یکم میکنم لا ممه هات😍😂", 'reply_to_msg_id' => $msg_id]);
}
if(strpos($msg, "بکنش") !== false){
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "اهه چه نرمی کونی", 'reply_to_msg_id' => $msg_id]);
}
if(strpos($msg, "بکنش") !== false){
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "اصا کونیه کی بودی تو😍", 'reply_to_msg_id' => $msg_id]);
}
if(strpos($msg, "بکنش") !== false){
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "جـــون چه میساکی جاکش💦💦💦", 'reply_to_msg_id' => $msg_id]);
}
if(strpos($msg, "بکنش") !== false){
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "کونت خیلی ناز  داره لذت پرواز داره :)", 'reply_to_msg_id' => $msg_id]);
}
if(strpos($msg, "بکنش") !== false){
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "سرورم ترتیبشو دادم😎😌", 'reply_to_msg_id' => $msg_id]);
}

}
