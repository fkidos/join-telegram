<?php
flush();
define('BOT_TOKEN',' '); ///// توکن بذارید
define('API_TELEGRAM','https://api.telegram.org/bot'.BOT_TOKEN.'/');
flush();
/////////////////////////////
$json = file_get_contents('php://input');
$telegram = urldecode($json);
$update = json_decode($telegram);
$chat = $update->message->chat->id;
$tyype = $update->message->chat->type;
flush();
//////////////////////////
$forwardu = $update->message->forward_from;
$forwardc = $update->message->forward_from_chat;
$msg_text = isset($update->message->text)?$update->message->text:'';
///////////////////////
$forwardcname = $forwardc->title;
$forwarduname = $forwardu->first_name;
$forwardcid = $forwardc->id;
$forwarduid = $forwardu->id;
///////////////////////
$msgtxt = $update->message->text;
flush();
$get = 'data/usert/'.$chat;
$command = $get.'/command.txt';
$gcommand = file_get_contents($command);
$name = $get.'/name.txt';
$gname = file_get_contents($name);
$gname = str_replace('H','h',$gname);
$user = $get.'/user.txt';
$guser = file_get_contents($user);
$type = $get.'/type.txt';
$gtype = file_get_contents($type);
////////////////////
function send($chat,$text)
{
file_get_contents(API_TELEGRAM.'sendMessage?chat_id='.$chat.'&text='.urlencode($text));
flush();
}
/////////////////////////////
$forwarduuser = $update->message->forward_from->username;
$forwardulast = $update->message->forward_from->last_name;
////////////////////////////
flush();
if($msgtxt == '/start')
{
mkdir($get);
file_put_contents($command,1);
file_put_contents($name,'');
flush();
file_put_contents($user,'');
file_put_contents($type,'');
send($chat,'سلام کاربر عزیز به ربات یوزر تایم خوش امدید🌷 در اینجا شما باید دو پیام از دو کانال را فوروارد کنید یا دو پیام از دو ربات را فوروارد و یا دو پیام از دو کاربر فوروارد کنید تا من بهتون بگم کدوم زودتر ساخته شده و کدوم زودتر از دیگری به تلگرام اومده⏰');
}
else if($msgtxt == '/creator')
{flush();
send($chat,'این ربات توسط @Directory_Virus ساخته شده است');
}
else if($gcommand == 1)
{
if($forwardcid == true)
{flush();
file_put_contents($command,2);
file_put_contents($type,'channel');
file_put_contents($user,$forwardcid);
file_put_contents($name,$forwardcname);
send($chat,'کانال اول ثبت شد✅ پیام کانال دوم را برای مقایسه فوروارد کنید');
}
else if($tyype == 'robot' && $forwarduuser == true && $forwardulast != true)
{flush();
file_put_contents($command,2);
file_put_contents($type,'robot');
file_put_contents($user,$forwarduid);
file_put_contents($name,$forwarduname);
send($chat,'ربات اول ثبت شد✅ پیام ربات دوم را برای مقایسه فوروارد کنید');
}
else if($forwarduid == true)
{flush();
file_put_contents($command,2);
file_put_contents($type,'user');
file_put_contents($user,$forwarduid);
file_put_contents($name,$forwarduname);
send($chat,'کاربر اول ثبت شد✅ پیام کاربر دوم را برای مقایسه فوروارد کنید');
}
else
{
send($chat,'لطفا یک پیام را فوروارد کنید⛔');
}
}
else if($gcommand == 2)
{flush();
if($forwardcid == true)
{
if($gtype == 'channel')
{
if($guser != $forwardcid)
{
if($guser >= $forwardcid)
{flush();
file_put_contents($command,1);
send($chat,"کانال $gname قبل از کانال $forwardcname ساخته شده است🎉");
}
else
{
//®®®اگر دوی بزرگ تر از اولی
file_put_contents($command,1);
send($chat,"کانال $forwardcname قبل از کانال $gname ساخته شده است🎉");
}
}
else
{flush();
send($chat,'فوروارد قبلی را نیز از همین چت فوروارد کردید این فوروارد را از چت دیگری ارسال کنید⚠');
}
}
else
{
if($gtype == 'robot')
{
send($chat,'دفعه قبل پیام ربات فوروارد کردید الان نمیتوانید پیام کانال فوروارد کنید⚠');
}
else if($gtype == 'user')
{
send($chat,'دفعه قبل پیام کاربر فوروارد کردید الان نمیتوانید پیام کانال فوروارد کنید⚠');
}
}
}
else if($tyype == 'robot' && $forwarduuser == true && $forwardulast != true)
{flush();
if($gtype == 'robot')
{
if($guser != $forwarduid)
{
if($guser >= $forwarduid)
{
file_put_contents($command,1);
send($chat," ربات $forwarduname قبل از ربات $gname ساخته شده است🎉 ");
}
else
{
file_put_contents($command,1);
send($chat,"ربات $gname قبل از ربات $forwarduname ساخته شده است🎉");
}
}
else
{flush();
send($chat,'فوروارد قبلی را نیز از همین چت فوروارد کردید این فوروارد را از چت دیگری ارسال کنید⚠');
}
}
else
{
if($gtype == 'channel')
{
send($chat,'دفعه قبل پیام کانال فوروارد کردید الان نمیتوانید پیام ربات فوروارد کنید⚠');
}
else if($gtype == 'user')
{
send($chat,'دفعه قبل پیام کاربر فوروارد کردید الان نمیتوانید پیام ربات فوروارد کنید⚠');
}
}
}
else if($forwarduid == true)
{flush();
if($gtype == 'user')
{
if($guser != $forwarduid)
{
if($guser >= $forwarduid)
{
file_put_contents($command,1);
send($chat," کاربر $forwarduname قبل از کاربر $gname به تلگرام اومده است🎉 ");
}
else
{
file_put_contents($command,1);
send($chat,"کاربر $gname قبل از کاربر $forwarduname به تلگرام اومده است🎉");
}
}
else
{flush();
send($chat,'فوروارد قبلی را نیز از همین چت فوروارد کردید این فوروارد را از چت دیگری ارسال کنید⚠');
}
}
else
{
if($gtype == 'channel')
{
send($chat,'دفعه قبل پیام کانال فوروارد کردید الان نمیتوانید پیام کاربر فوروارد کنید⚠');
}
else if($gtype == 'robot')
{
send($chat,'دفعه قبل پیام ربات فوروارد کردید الان نمیتوانید پیام کاربر فوروارد کنید⚠');
}
}
}
else if($msg_text != 'امار')
{
send($chat,'لطفا یک پیام را فوروارد کنید⛔');
}
}
flush();
$amar = "data/ammmar.txt";
$gamar = file_get_contents($amar);
$camar = count(explode('/',$gamar))-1;
flush();
if($msg_text == 'امار')
{
send($chat,'امار ربات👥 : '.$camar);
}
if(str_replace($chat,'',$gamar) == $gamar)
{
file_put_contents($amar,$gamar.'/'.$chat);
}
flush();
file_get_contents(API_TELEGRAM.'forwardMessage?chat_id='.$chat.'&from_chat_id=@ایدی ربات&message_id='.rand(593,594)); //// ایدی ربات رو بذارید
flush();
?>