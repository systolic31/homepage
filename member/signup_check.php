<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/preset.php';
?>
<?php

$user_number = $user_phone1."-".$user_phone2."-".$user_phone3;

$user_favorite = $_POST['favorite'];
$fianl_favorite = "";
$encrypted_pass = sha1($user_pass);

foreach ($user_favorite as $favorite){
$fianl_favorite = $fianl_favorite.' '.$favorite;
}

echo $user_fname.' '.$user_lname.' '.$user_id.' '.$encrypted_pass.' '.$user_mail.' '.$user_number.' '.$user_gender.' '.
$fianl_favorite;


$q = "INSERT INTO member ( firstname, lastname, id, password, email, number, gender, favorite ) VALUES ( 
'$user_fname', '$user_lname', '$user_id', '$encrypted_pass', '$user_mail', '$user_number', '$user_gender' ,'$fianl_favorite' )";

$mysqli->query( $q);

$mysqli->close();

header("Location: http://localhost:81\member\signup_done.php");
exit();


?> 