<?php 
    include("./inital_setting/user_db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="./css/board_write.css">
    <title>think</title>
</head>
<body>
    <header>
        <?php require("./index/index_header.php")?>
    </header>

    <article><!--게시글-->
        <h1>Write Page</h1>
        <div>
           <hr>
        </div>
        <div>
            <form action="action.php" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="mode" value="write">
                <div class="title">
                    <span>제목</span>
                    <input type="text" name="title" required>
                </div>
                
                <div class="contents">
                    <div>내용</div>
                    <textarea name="description" required></textarea>
                </div>
                <div class="sub_menu">
                    <div>File</div>
                    <input type="file" name="userfile"><br>
                    <div class="submit">
                        <input type="submit" value="Write">
                    </div>
                </div>
            </form>
        </div>
    </article>
</body>
</html>