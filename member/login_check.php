<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/preset.php';
?>
<?php


$id = $_REQUEST['id'];
$pass = $_REQUEST['pw'];

$ep = sha1($pass);

$q = "SELECT * FROM member WHERE id='$id'";
$result = $mysqli->query( $q);

if($result->num_rows==1) {
    //해당 ID 의 회원이 존재할 경우
    // 암호가 맞는지를 확인

    $row = $result->fetch_array(MYSQLI_ASSOC);
    if( $row['password'] == $ep ) {
        $_SESSION['is_logged'] = 'YES';
        $_SESSION['user_id'] = $id;
         echo json_encode(array('msg'=>"Y"));
       // header('Location: '.$url['root'].'login_done.php');  //메인 페이지로 보내야함 세션 정보 가지고
        exit();
    }
    else {
        $_SESSION['is_logged'] = 'NO';
        $_SESSION['user_id'] = '';
        
        echo json_encode(array('msg'=>"N"));
        exit();
    }

}
else {
    echo "해당 아이디가 없음";
    
}

$result->free();

$mysqli->close($mysqli);

?>
