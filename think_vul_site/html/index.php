<?php 
    require('./index/index_session.php');
    include("./inital_setting/user_db.php");
    header("Content-Type: text/html; charset=UTF-8;");
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <script>
        function deleteFunction(){
            if(confirm("회원 탈퇴하시겠습니까?"))
                return true;
            else   
                return false;
        }
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="./css/index1.css">
    <title>Think</title>
</head>

<body >
    <!--데이터 베이스 조회-->
    <?php
        $sql = "SELECT id,title,author,created FROM think_board";
        $result = mysqli_query($conn,$sql);
    ?>

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
        


        <!--게시글 미리보기-->
        <article> 
            <fieldset class="main">
                <legend><a href="#">공지사항</a></legend>
                    <ul>
                        <?php
                            $result = mysqli_query($conn,$sql);
                            $count = 0;
                            while($row = mysqli_fetch_assoc($result)){
                                $count++;
                                if($count > 8) break;
                                echo "<li><a href='./board_read.php?idx={$row['id']}'>{$row['title']}</a></li>";
                            }
                        ?>
                    </ul>
            </fieldset>

        <!--게시글 메인사진-->
            <fieldset class="main_image">
                <legend><a href="#">활동사진</a></legend>
                <div>
                    <ul>
                        
                        <?php
                            $list = scandir("./upload");
                            $i=0;
                            while($i < count($list)){
                                if($list[$i] != '.'){
                                    if($list[$i] != '..'){
                                        if(preg_match("/.jpg\$/i",$list[$i]) || preg_match("/.png\$/i",$list[$i])){
                                            $final_list = iconv("EUC-KR", "UTF-8", $list[$i]);
                                            echo "<li><img src='./upload/{$final_list}'></li>";
                                        }
                                    }
                                }
                                $i = $i+1;
                            }
                        ?>
                    </ul>
                </div>
            </fieldset>
        </article>
        
        <aside><!--회원정보-->
            <fieldset id="my_page">
                <legend>내 정보</legend>
                    <?php
                        if(!empty($_SESSION['id'])){
                            echo "<div>"."이름:".$_SESSION['name']."님"."<br>"."</div>";
                            echo "<div>"."직책".":###"."<hr>"."</div>";
                            echo "<a href=\"./board_write.php\">게시글 작성</a>"."<br>";
                            echo "<a href=\"./mypage.php\">내 정보</a>"."<br>";
                            if($_SESSION['id'] == 'admin'){
                                echo "<a href=\"./pingcheck.php\">ping</a>";
                            }
                            echo "<a onclick=\"return deleteFunction()\" href=\"./membership_withdrawal.php\">회원탈퇴</a>"."<br>";
                        }else{
                            echo "<a href=\"./login.php\">로그인</a>";
                            //echo "<button onclick=\"loginWindow()\">로그인</button>";
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
