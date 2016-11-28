<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/preset.php';
?>
<?php

$memId = $_SESSION['user_id'];

$q ="INSERT INTO comment(doc_idx,member_id,content,date) VALUES('$docNo','$memId','$comment',now())";
$result = $mysqli->query($q);

if ($result==false) {
    $_SESSION['comment_status'] = 'NO';
}
else {
    $_SESSION['comment_status'] = 'YES';
}

$mysqli->close();

exit();
?> 