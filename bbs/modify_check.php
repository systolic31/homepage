<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/preset.php';
?>
<?php

$q = "UPDATE bbs SET subject='$subject',content='$content' WHERE doc_idx=$doc_idx";
$result = $mysqli->query($q);

if ($result==false) {
    $_SESSION['modify_status'] = 'NO';
}
else {
    $_SESSION['modify_status'] = 'YES';
}

//$result->free();

$mysqli->close();
//var_dump($url);

header('Location: '.$url['root'].'modify_done.php');
exit();

?> 