<?php 
    require('./index/index_session.php');
    include("./inital_setting/user_db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="./css/board_modify.css">
    <title>think</title>
</head>
<body>
    <header>
        <?php require("./index/index_header.php")?>
    </header>

    <article><!--게시글-->
        <h1>Modify Page</h1>
        <div>
           <hr>
        </div>

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

        <div>
            <form action="action.php" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="mode" value="modify">
                <input type="hidden" name="id" value="<?=$_GET['idx']?>">

                <div class="title">
                    <span>제목</span>
                    <input type="text" name="title" value="<?=$row['title']?>" required>
                </div>

                <div class="contents">
                    <div>내용</div>
                    <textarea name="description" required><?=$row['description']?></textarea>
                </div>

                <div class="sub_menu">
                    <?php if(!empty($row["file_real"])){ $file_name=iconv('EUC-KR','UTF-8',$row["file_real"] ?? NULL)?>
                        <hr><span>[이미 업로드한 파일]<?=$file_name;?></span><hr>
                    <?php }?>
                    <div>File</div>
                    <div class="file"><input type="file" name="userfile"></div><hr>
                    
                    <div class="submit">
                        <input type="submit" value="수정하기">
                    </div>
                </div>                
            </form>
            <button onclick="location.href='./board.php'">뒤로가기</button>
        </div>
    </article>
</body>
</html>