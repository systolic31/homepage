<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/preset.php';
include $_SERVER['DOCUMENT_ROOT'].'/header.php';
?>
  로그아웃 되었습니다.<br />
  <form action="http://localhost:81/main.php">
		<input type="submit" value="메인으로 가기">
	</form>
<?php
    include $_SERVER['DOCUMENT_ROOT'].'/footer.php';
?> 