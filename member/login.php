<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/preset.php';
?>
<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <TITLE>기본 틀</TITLE>
        <meta charset="utf-8">
<link href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/main.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Alegreya+Sans" rel="stylesheet">
<link href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/member/join.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>

<script>
  $(document).ready(function () {

  	$('#login_button').click(function (){
  		$.ajax({
                    url: '/member/login_check.php',
                    dataType: 'json',
                    type: 'POST',
                    data: { 'id':$('#id').val(),
                    		'pw':$('#pass').val() },
                    success:function(result) {
                            if(result['msg'] == "N")
                               {                             
                                 $('#comment').text("죄송합니다. 로그인에 실패했습니다. 아이디(ID)와 비밀번호를 확인하고 다시 로그인해주세요.");
                                  $('#id').focus();
                            }
                            else
                            	$(location).attr('href','http://localhost:81/main.php');
                    }
                });
  	});
  });
</script>
<br>
	login.php-로그인 페이지 
	<br>
	<hr>

	아이디 : <input type="text" name="user_id" id="id"> <br>
	비밀번호 : <input type="password" name="user_pass" id="pass"> <br>
	<button id="login_button">로그인</button>
	<div id="comment"></div>
<?php
    include $_SERVER['DOCUMENT_ROOT'].'/footer.php';
?>
