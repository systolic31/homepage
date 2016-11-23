<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/preset.php';

$userid = $_REQUEST['id'];

$query= "SELECT * FROM member WHERE id='$userid'";

$result_col = $mysqli->query($query);

	if($result_col->num_rows==1){   	 //있다.
		echo json_encode(array('msg'=>"Y"));
	}
     else
     {	echo json_encode(array('msg'=>"N"));
 }

$mysqli->close();

?>
