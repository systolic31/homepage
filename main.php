<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/preset.php';
?>
<!DOCTYPE HTML>
<HTML>
    <HEAD>
     <title>Home page</title>
    <style>
        body, div {
            padding: 0;
            margin: 0;
        }

        #header {
        	border-bottom: gray solid 1px;
            font-size: 90px;
            text-align: center;
            padding: 50px;
        }

        #navigator {        	
            width: 20%;
            float: left;
        }

        #content {
            width: 79%;
        }

        #footer {
            clear: both;
            padding: 50px;
            font-size: 70px;
            text-align: center;
        }

        .menu_wrap {
            overflow: hidden;
            border-bottom: gray solid 1px;
            padding-bottom: 300px;
        }

        li {
            padding:10px;
            list-style-type:none;
            text-align:center;
            font-size:20px;
        }

        a{
            text-decoration:none;
            color:black;
        }

        #div_loging{            
            float: right;
            padding-top: 25px;
            margin-right: 100px;
        }

    </style>

</head>
<body>
<div id="div_loging">
        <?php if($_SESSION['is_logged'] == 'YES'):
        echo $_SESSION['user_id'].'님 환영합니다.';?>
         <a href="./member/logout.php" class="btn"> 로그아웃</a>

    <?php else:?>
    <a href="./member/signup.php" class="btn">회원가입&nbsp;&nbsp;&nbsp;&nbsp;</a>
     <a href="./member/login.php" class="btn"> 로그인</a>
     <?php endif?>
</div>
    <div id="header">HOME PAGE</div>
    <div class="menu_wrap">
        <div id="navigator">
            <ul>
                <li><a href="/bbs/list.php">게시판</a></li>
                <li><a href="#content">menu2</a></li>
                <li><a href="#content">menu3</a></li>
                <li><a href="#content">menu4</a></li>
            </ul>
        </div>
        <div id="content"></div>
    </div>
    <div id="footer">Footer</div>
</body>
</html>
