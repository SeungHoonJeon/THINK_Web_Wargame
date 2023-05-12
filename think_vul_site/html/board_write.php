<?php 
    require('./index/index_session.php');
    include("./inital_setting/user_db.php");
?>

<?php
    if(empty($_SESSION['id'])){
        echo "<script>alert('로그인이 되어 있지 않습니다.');location.href='./login.php';</script>";
        exit();
    }
    /*
    function csrf_token_create(){
		if(!empty($_SESSION["id"])){
			$time=time();
			$id = $_SESSION["id"];
			$csrf_token=sha1($id.$time);
			$_SESSION["csrf_token"] = $csrf_token;
		}else{
			$csrf_token="";
		}
		return $csrf_token;
	}
    $csrf_token = csrf_token_create()
    */
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
                        <!--<input type="hidden" name="csrf_token" value="<?php echo $csrf_token?>">-->
                        <input type="submit" value="Write">
                    </div>
                </div>
            </form>
        </div>
    </article>
</body>
</html>