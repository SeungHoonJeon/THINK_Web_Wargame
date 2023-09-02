<?php 
    require('./index/index_session.php');
    include("./inital_setting/user_db.php");
    header("Content-Type: text/html; charset=UTF-8;");
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="./css/index1.css">
    <title>Think</title>
</head>

<body >
    <!--상단 메뉴-->
    <header>
        <?php require("./index/index_header.php")?>

    </header>

    <nav><!--서브 상단-->
       <?php require("./index/index_subtitle.php")?>
       
    </nav>

    <!--index 페이지 main-->
    <div id='content'>

        <!--오른쪽 메뉴-->
        <section>
            <?php require("./index/index_list.php")?>    
        </section>
        <aside><!--회원정보-->
            <fieldset id="my_page">
                <legend>내 정보</legend>
                    <?php
                        if(!empty($_SESSION['id'])){
                            echo "<div>"."이름:".$_SESSION['name']."님"."<br>"."</div>";
                            echo "<div><a href='./logout.php'>로그아웃</a></div>";
                        }else{
                            echo "<a href=\"./login.php\">로그인</a>";
                        }
                    ?>
            </fieldset>

            <!--서브 메뉴-->
            <fieldset id="board_list">
                <legend><a href="./board.php"></legend>
                <?php require('./index/index_submenu.php');?>
            </fieldset>
        </aside>
    </div>

    <!--홈페이지 소개-->
    <footer>
        <?php require('./index/index_footer.php');?>                    
    </footer>
</body>
</html>
