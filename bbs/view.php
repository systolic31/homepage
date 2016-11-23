<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/preset.php';
include $_SERVER['DOCUMENT_ROOT'].'/header.php';

$q = "SELECT * FROM bbs WHERE doc_idx = $doc_idx";
$result = $mysqli->query($q);
$data = $result->fetch_array();
?> 
<div style="text-align:center;">
<div id="view_table_wrap" style="display:inline-block;width:50%;margin-top: 4%;">
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
</div>
</div>




<?php 
	include $_SERVER['DOCUMENT_ROOT'.'/footer.php'];
?>