<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/preset.php';

$q = "SELECT * FROM bbs WHERE doc_idx = $doc_idx";
$result = $mysqli->query($q);
$data = $result->fetch_array();

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

    </HEAD>
    <BODY>
<div style="text-align:center;">
<div id="view_table_wrap" style="display:inline-block;width:50%;margin-top: 4%;">
<div style="overflow:hidden;width:100%;">
<div id="wiew_list_button" style="display:inline-block;float:right;">
<?php
    echo '<a href="http://'.$_SERVER['HTTP_HOST'].'/bbs/list.php" class="btn" >목록</a>';
    ?>
</div>
<div id="wiew_modify_button" style="display:inline-block;float:right;padding:7px 12px;">
<?php
if($data['member_id'] === $_SESSION['user_id'])
    echo '<a href="http://'.$_SERVER['HTTP_HOST'].'/bbs/modify.php?doc_idx='.$doc_idx.'">수정</a>';
?>
</div>
<div id="wiew_delete_button" style="display:inline-block;float:right;padding:7px 12px;">
<?php
if($data['member_id'] === $_SESSION['user_id'])
        echo '<a href="http://'.$_SERVER['HTTP_HOST'].'/bbs/delete.php?doc_idx='.$doc_idx.'">삭제</a>';
?>
</div>
</div>
<table style="border-bottom:#D0CECE solid 1px;width:100%;">
    <tr>
    <td style="padding:10px;border-bottom:#D0CECE solid 1px;text-align:center;background-color:#D7D6D6;">
            <?php echo $data['subject']; ?>
    </td>
    </tr>
    <tr>
       <td style="border-bottom:#D0CECE solid 1px;text-align:right;padding:5px 10px;">
            <?php echo "작성자: ".$data['member_id']; ?>
    </td>
    </tr>
    <tr>
    <td style="border-bottom:#D0CECE solid 1px;padding:15px 10px;">
            <?php echo $data['content']; ?>
    </td>
    </tr>
</table> 

</div>
<div id="comment_wrap" style="background-color:#E6E6E6;width:50%;margin-top:20px;display: inline-block;overflow: hidden;padding:7px;padding-left: 10px;margin-bottom:100px;">
<?php 

$q2 = "SELECT * FROM comment WHERE doc_idx=$doc_idx ORDER BY date";
$result = $mysqli->query($q2);

 ?>
<?php while($data = $result->fetch_array()) :?>
 <div style="font-weight:bold;float:left;margin-right: 15px;"><?php echo $data['member_id']?></div>
 <div style="float:left;"><?php echo $data['date']?></div><br>
 <div style="border-bottom:#BDBDBD solid 1px;clear:both;text-align:left;padding-bottom:10px;margin-bottom: 10px;font-size:12px;margin-top:5px;"><?php echo $data['content']?></div>
<?php endwhile ?>
 <form name="cregister_commeent_form" id="comment_form" action="http://localhost:81/bbs/comment_check.php" method="post" accept-charset="utf-8">
    <div id="commmit_div" style="text-align:left;width:100%"> 
        <div id="text_wrap" style="float: left;overflow:hidden;width:86%;"> <textarea  name="comment" rows="3.5" style="width:100%;resize:none;"></textarea></div> 
        <div style="display: inline-block;width:13%;margin-left:0.5%;">
        <div style="font-size:17px;"><input type="checkbox"> secret</div>
        <div style="padding:3px;"><input style="width:100%;" type="submit"></div>
        <input type="text" value="<?php echo $doc_idx?>" name="docNo" style="display:none;">
        </div>
    </div>
    </form>
</div>
</div>

<script>
        $(document).ready(function () {
                $('form').submit(function () {
               
                    $.ajax({
                    url: '/member/comment_check.php',
                    dataType: 'json',
                    type: 'POST',
                    data: { 'id':$('#id').val(),
                    'id':$('#id').val(),
                    'id':$('#id').val(),
                    'id':$('#id').val(),
                     },
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
                

            });


        });
</script>



<?php 
	include $_SERVER['DOCUMENT_ROOT'.'/footer.php'];
?>