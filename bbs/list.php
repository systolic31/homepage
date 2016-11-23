<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/preset.php';
include $_SERVER['DOCUMENT_ROOT'].'/header.php';

$q = "SELECT * FROM bbs";
$result = $mysqli->query($q);
$total_record = $result->num_rows;  // 게시물 총 개수 (바의 숫자)$result->num_rows;
?> 

<div id="write_button_wrap" style="margin-top: 4%;margin-right:10%;display: inline-block;float:right;">
 <form action="write.php">  
 <input style="margin-left: 10px;" type="submit" value="글쓰기"></button>
  </form>
</div>


<?php if($total_record==0) :?>  <!-- 열 갯수가 0일 때 --> 
    글이 없습니다.

<?php else :                 //열 갯수(게시글 갯수)가 0이 아닐 때

$record_per_page = 5;
$num_page = 6;
$total_page = ceil($total_record/$record_per_page);



if(isset($page))
  $page_now = $page;
else
  $page_now = 1;

 $record_to_get = ($record_per_page*($page_now-1)); 

 $q = "SELECT * FROM bbs ORDER BY doc_idx desc LIMIT $record_to_get,$record_per_page";
 $result = $mysqli->query($q);

?>


<div id="table_wrap" style="margin:0 10%;">

<table class="table">         
    <thead>
        <th style="text-align:center;">글번호</th>
        <th style="text-align:center;">제목</th>
        <th style="text-align:center;">작성자</th>
        <th style="text-align:center;">등록일시</th>
    </thead>

<?php while($data = $result->fetch_array()) :?>
    <tr>
        <td style="text-align:center;"><?php echo $data['doc_idx']?></td>
        <td style="text-align:center;"><a href="http://<?php echo $_SERVER['HTTP_HOST'].'/bbs/view.php?doc_idx='.$data['doc_idx'];?>"><?php echo $data['subject']?></a></td>
        <td style="text-align:center;"><?php echo $data['member_id']?></td>
        <td style="text-align:center;"><?php echo $data['date']?></td>
    </tr>

<?php endwhile ?>
</table>
</div>
<?php

$block = ceil($page_now/$num_page);
$last_block = ceil($total_page/$num_page);


$start_page = $num_page*($block-1)+1;
$end_page = $block*$num_page;

if($block===$last_block)
  $end_page = $total_page;


?>
<div style="text-align:center;margin-top:5%;">
<div id="1" style="display: inline-block;">
<?php if($block>=2):
  $page_to_move = $page_now - $num_page;?>
    <li style="float:left;padding-right: 15px;list-style-type:none;font-size:15px;"><a href="http://localhost:81/bbs/list.php?page=<?php echo $page_to_move ?>"> 이전 </a></li>    
  <?php endif?>

<?php for($i=$start_page; $i<=$end_page; $i++) :?>
<li style="float:left;padding-right: 15px;list-style-type:none;font-size:18px;">
   <li style="float:left;padding-right: 15px;list-style-type:none;font-size:18px;"><a href="http://localhost:81/bbs/list.php?page=<?php echo $i ?>"> <?php echo $i ?></a></li>
<?php endfor ?>
</div>

<?php if($block<$last_block):
  $page_to_move = $page_now + $num_page; ?>
    <li style="float:left;padding-right: 15px;list-style-type:none;font-size:15px;"><a href="http://localhost:81/bbs/list.php?page=<?php echo $page_to_move ?>"> 다음 </a></li> 
  <?php endif?>
<?php endif?>
</div>


<?php 
  include $_SERVER['DOCUMENT_ROOT'.'/footer.php'];
?>

