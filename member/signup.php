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
            var id_check = false;
            
            function onlynumber() {
                var inputValue = event.which;
                if (inputValue >= 48 && inputValue <= 57) {
                    return true;
                } else {
                    event.returnValue = false;
                }
            }

            function onlyalpha() {
                var inputValue = event.which;

                if (!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) {
                    event.preventDefault();
                }
            }

            $("#firstname").keypress(function () {
                onlyalpha();
            });

            $("#lastname").keypress(function () {
                onlyalpha();
            });

            $("#phone1").keypress(function () {
                onlynumber();
            });

            $("#phone2").keypress(function () {
                onlynumber();

            });

            $("#phone3").keypress(function () {
                onlynumber();
            });



            $('form').submit(function () {
                var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
                var reg_pw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;
                var reg_id = /^[a-z0-9]{5,16}$/;

                if ($("#firstname").val().length === 0 || $("#lastname").val().length === 0) {
                    alert("name");
                    $('#firstname').focus();
                    return false;
                }
                else if(id_check === false)
                {
                    alert("아이디를 중복 확인을 해주세요");
                    return false;
                }
                else if ($("#id").val().length === 0 || reg_id.test($("#id").val()) == false) {
                    alert("id");
                    $('#id').focus();
                    return false;
                }                
                else if (pattern.test($("#email").val()) == false || $("#email").val().length === 0) {
                    alert("email");
                    $('#email').focus();
                    return false;
                }
                else if ($("#password").val().length === 0 || reg_pw.test($("#password").val()) == false) {
                    alert("password");
                    $('#password').focus();
                    return false;
                }
                else if ($("#password").val() != $("#repassword").val()) {
                    alert("password is not matched");
                    $('#password').focus();
                    return false;
                }
                else if ($("#phone1").val().length < 3 || $("#phone2").val().length < 3 || $("#phone3").val().length < 4) {
                    alert("phone");
                    return false;
                }

            });

            $("#id").focusout(function (){
				var reg_id = /^[a-z0-9]{5,16}$/;
					// 유효성 검사 통과 못하면 빡구
                if($("#id").val().length === 0 || reg_id.test($("#id").val()) == false){
                   $("#label_idcheck").text("ID 양식을 다시 확인해 주세요");
                    $('#id').focus();
                    return false;
                }
                	// 유효성 검사 통과하면 ajax로 아이디 보낸다 
                else 
                {
                	$.ajax({
                    url: '/member/id_check.php',
                    dataType: 'json',
                    type: 'POST',
                    data: { 'id':$('#id').val() },
                    success:function(result) {
                            if(result['msg'] == "Y")
                               { 
                                id_check = false;                               
                                 $('#label_idcheck').text("ID: "+$('#id').val()+" is already used.");
                                  $('#label_idcheck').addClass('red');
                                  $('#id').focus();
                            } 
                            else
                                {                             
              		 				 $('#label_idcheck').text("ID: "+$('#id').val()+" is available to use !");    $('#id').addClass("check");                              
                                    id_check = true;
                            }
                    }
                });
                }

            });


              /*  $('#div_btnidcheck').click(function () {
                  var reg_id = /^[a-z0-9]{5,16}$/;

                  if($("#id").val().length === 0 || reg_id.test($("#id").val()) === false){
                    $('#label_idcheck').text("ID 양식을 다시 확인해 주세요");
                    $('#id').focus();
                    return false;
                }

                $.ajax({
                    url: '/member/id_check.php',
                    dataType: 'json',
                    type: 'POST',
                    data: { 'id':$('#id').val() },
                    success:function(result) {
                            if(result['msg'] == "Y")
                               { 
                                alert(result['msg']);
                                id_check = false;
                            } 
                            else
                                { 
                               //     alert(result['msg']);                                
                                    id_check = true;
                                    $('#id').addClass("check");
              		 				 $('#label_idcheck').text("ID: "+$('#id').val()+" is available to use !");
                            }
                    }
                });
            }) */

        });
</script>
    </HEAD>
    <BODY>
    <div class="header">
    </div>
    <div class="content">

      <form name="signup_form" method="post" action="./signup_check.php">
        <div id="signup_wrap">
            <div class=field_wrap>
                <div id=label_firstname class="margin-top">Name</div>
                <div id="div_firstname"><input id="firstname" type="text" class="short" maxlength="15"  name="user_fname" placeholder="First Name"></div>
                <div id="div_lastname"><input id="lastname" type="text" class="short" maxlength="15" name="user_lname" placeholder="Last Name"></div>
            </div>
             <div class=field_wrap>
                    <div class=label_field>ID</div><input id="id" class="long1" maxlength="15" type="text" name="user_id">
                    <div id=label_idcheck></div>
                </div>
            <div class=field_wrap>
                <div class=label_field>Password</div><input class="long" id="password" type="password" maxlength="16" name="user_pass">
            </div>
            <div class=field_wrap>
                <div class=label_field>Confirm password</div><input class="long" id="repassword" type="password" maxlength="16" name="user_repass">
            </div>
            <div class=field_wrap>
                <div class=label_field>Email</div><input id="email" class="long" type="text" name="user_mail">
            </div>
            <div class=field_wrap>
                <div class=label_field>Celphone</div>
                <input type="text" id="phone1" maxlength="3"  class="phone" name="user_phone1">
                <div class="div_phone">-</div>
                <input type="text" id="phone2" maxlength="3"  class="phone" name="user_phone2">
                <div class="div_phone">-</div>
                <input style="float:right;" id="phone3" maxlength="4" type="text" class="phone" name="user_phone3">
            </div>
            <div class="field_wrap text_left">
                <div class="label_field margin_bottom">Gender</div>
                <div class="radio_wrap"><input checked type="radio" name="user_gender" value="1" /> F </div>
                <div class="radio_wrap"><input type="radio" name="user_gender" value="2" /> M </div>
            </div>
            <div class="field_wrap text_left favarite_wrap">
                <div class=label_field>Favorite <a class="optional">(optional)</a></div>
                <div class="checkbox_wrap">
                    <input type="checkbox" name="favorite[]" id="favorite" value="Travel" /> Travel</div>
                <div class="checkbox_wrap">
                    <input type="checkbox" name="favorite[]" id="favorite" value="Movie" /> Movie
                </div>
                <div class="checkbox_wrap">
                    <input type="checkbox" name="favorite[]" id="favorite" value="Fashion" /> Fashion
                </div>
                <div class="checkbox_wrap">
                    <input type="checkbox" name="favorite[]" id="favorite" value="Interior" /> Interior
                </div>
                <div class="checkbox_wrap">
                    <input type="checkbox" name="favorite[]" id="favorite" value="Game" /> Game
                </div>
                <div class="checkbox_wrap">
                    <input type="checkbox" name="favorite[]" id="favorite" value="Health" /> Health
                </div>
                <div class="checkbox_wrap">
                    <input type="checkbox" name="favorite[]" id="favorite" value="Car" /> Car
                </div>
                <div class="checkbox_wrap">
                    <input type="checkbox" name="favorite[]" id="favorite" value="Sports" /> Sports
                </div>
                <div class="checkbox_wrap">
                    <input type="checkbox" name="favorite[]" id="favorite" value="Art" /> Art
                </div>
            </div>
            <div class="field_wrap">
                <input type="submit" id="btn_join" value="J O I N">
            </div>
        </div>
    </form>
        
<?php
    include $_SERVER['DOCUMENT_ROOT'].'/footer.php';
?>
