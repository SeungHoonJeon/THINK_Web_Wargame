<?php 
    require('./index/index_session.php');
    include("./inital_setting/user_db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta content="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="./css/board_read.css">
    <title>think</title>
</head>
<body>
    <header>
        <?php 
            require("./index/index_header.php");
        ?>
    </header>
    <article><!--게시글-->
        
       <?php
    
            $sql = "SELECT * from think_board where id={$_GET['idx']}";

            $result = mysqli_query($conn, $sql);
            if(!$result){
                echo("Error description: " . mysqli_error($conn));
            }
            $row = mysqli_fetch_assoc($result);
            if(empty($row)){
                echo "<script>alert('내용이 없습니다.');history.back(-1);</script>";
                exit();
            }
            

          
        ?>

        <h1>Write Page</h1>
        <div>
           <hr>
        </div>

        <div id="board_read">
            <span>author: <?php echo $row['author'];?></span>
            <span>Date: <?php echo $row['created'];?></span>
            <div class="title">
                <span id="title">제목</span>
                <div>
                    <?php echo nl2br($row['title']);?>
                </div>
            </div>
            
            <div class="contents">
                <div>내용</div>
                <div id="textarea">
                    <?php echo nl2br($row['description']);?>
                </div>
            </div>

            <div class="sub_menu">
                <?php
                    if(!empty($row["file_real"])){
                        $file_name=iconv("UTF-8","UTF-8",$row["file_real"]) ?? NULL;
                ?>
                        <div>
                            <div id="File">File</div>
                            <div id="File_contents"><a href="download.php?file=<?php echo $file_name;?>"><?php echo $file_name;?></a></div>
                        </div>
                <?php
                    }
                ?>

                <div class="submit">
                    
                    <?php
                        $id = $_SESSION['name'] ?? NULL;
                        if($row['author'] == $id){
                            echo "<button onclick=\"location.href='./board_modify.php?idx={$_GET['idx']}'\">수정</button>";
                            echo "<button onclick=\"location.href='./action.php?mode=delete&idx={$_GET['idx']}'\">삭제</button>";
                        }
                    ?>
                    <button onclick="location.href='./board.php'">목록</button>
                </div>
            </div>
        </div>
    </article>
</body>
</html>