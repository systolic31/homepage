<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/preset.php';
include $_SERVER['DOCUMENT_ROOT'].'/header.php';


$is_logged = $_SESSION['is_logged'];
if($is_logged=='YES') {
    $user_id = $_SESSION['user_id'];
    $message = $user_id . ' 님, 로그인 했습니다.';
}
else {
    $message = '로그인이 실패했습니다.';
}
?>
        login_done.php - 로그인 완료 페이지<br />
        <hr />
<?php
    echo $message;
?>
<?php
    include $_SERVER['DOCUMENT_ROOT'].'/footer.php';
?>
