<?php

error_reporting(0);
if (!file_exists('madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
define('MADELINE_BRANCH', 'deprecated');
include 'madeline.php';
	function closeConnection($message = 'ربات ساخته شد <br />لطفا با اکانت ادمین به ربات پیام /help را ارسال کنید')
{
    if (php_sapi_name() === 'cli' || isset($GLOBALS['exited'])) {
        return;
    }
    @ob_end_clean();
    header('Connection: close');
    ignore_user_abort(true);
    ob_start();
    echo '<html><body><h1>'.$message.'</h1></body</html>';
    $size = ob_get_length();
    header("Content-Length: $size");
    header('Content-Type: text/html');
    ob_end_flush();
    flush();
    $GLOBALS['exited'] = true;
}
function shutdown_function($lock)
{
    $a = fsockopen((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] ? 'tls' : 'tcp').'://'.$_SERVER['SERVER_NAME'], $_SERVER['SERVER_PORT']);
    fwrite($a, $_SERVER['REQUEST_METHOD'].' '.$_SERVER['REQUEST_URI'].' '.$_SERVER['SERVER_PROTOCOL']."\r\n".'Host: '.$_SERVER['SERVER_NAME']."\r\n\r\n");
    flock($lock, LOCK_UN);
    fclose($lock);
}
if (!file_exists('bot.lock')) {
    touch('bot.lock');
}
$lock = fopen('bot.lock', 'r+');

$try = 1;
$locked = false;
while (!$locked) {
    $locked = flock($lock, LOCK_EX | LOCK_NB);
    if (!$locked) {
        closeConnection();

        if ($try++ >= 90) {
            exit;
        }
        sleep(1);
    }
}
$MadelineProto = new \danog\MadelineProto\API('session.madeline');
$MadelineProto->start();
$offset = -3;

register_shutdown_function('shutdown_function', $lock);
closeConnection();
$pool = new Pool(100);
$offset = -3;
$offset_user = -3;
while (true) {

    $updates = $MadelineProto->get_updates(['offset' => $offset, 'limit' => 500, 'timeout' => 0]); 
    \danog\MadelineProto\Logger::log($updates);
    foreach ($updates as $update) {
        $offset = $update['update_id'] + 1;
     $up = $update['update']['_'];
                if ($up == 'updateNewMessage' or $up == 'updateNewChannelMessage') {
                if (isset($update['update']['message']['out']) && $update['update']['message']['out']) {
                    continue;
                }
               $chatID = $MadelineProto->get_info($update['update']);
               $type = $chatID['type'];
               $chatID = $chatID['bot_api_id'];
               $userID = $update['update']['message']['from_id'];
               $msg = $update['update']['message']['message'];
               $msg_id = $update['update']['message']['id'];
                try {
   
  require 'plugin.php';
                
                } catch (\danog\MadelineProto\RPCErrorException $e) {
                    $MadelineProto->messages->sendMessage(['peer' => 458993517, 'message' => $e->getCode().': '.$e->getMessage().PHP_EOL.$e->getTraceAsString()]);
                }
         
        }
    
}

}
