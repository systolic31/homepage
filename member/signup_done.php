<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/preset.php';
include $_SERVER['DOCUMENT_ROOT'].'/header.php';
?>
	signup_done.php - 회원가입 완료 페이지 <br>
	<hr>

	회원가입이 완료되었습니다.

	<form action="http://localhost:81/member/login.php">
		<input type="submit" value="로그인하기">
	</form>
<?php
    include $_SERVER['DOCUMENT_ROOT'].'/footer.php';
?>
