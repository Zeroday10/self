<?php
$admins = [
  '458993517','1441756685','1480027891','1237238055','1383530049','1257314180'    
];
$listplugins = [
  "ping",
  "enemy",
  "option",
  "help",
   "plus",
   "numb",
  "enemy",
  "option2"
];
$cplug = count($listplugins) - 1;
for($n=0; $n<=$cplug; $n++) {
  $pluginlist = "plugins/".$listplugins[$n].".php";
  include($pluginlist);
}
$data = json_decode(file_get_contents("data.json"),true);
$markread = $data["data"]["markread"];
$typing = $data["data"]["typing"];
$contacts = $data["data"]["contacts"];
$link = $data["data"]["link"];
unlink("MadelineProto.log");






