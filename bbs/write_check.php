<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/preset.php';
?>
<?php

$reg_date = time();
$member_id = $_SESSION['user_id'];

$q = "INSERT INTO bbs(member_id, subject,content,date) VALUES('$member_id', '$subject', '$content', now())";

$result = $mysqli->query($q);

if ($result==false) {
    $_SESSION['writing_status'] = 'NO';
}
else {
    $_SESSION['writing_status'] = 'YES';
}

$mysqli->close();

header('Location: '.$url['root'].'write_done.php');
exit();



?> 