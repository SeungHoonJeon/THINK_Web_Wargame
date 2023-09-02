<?require('./index/index_session.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Think_내정보</title>
</head>
<body>
<?php
	$name = $_SESSION['name'] ?? NULL;
?>
    <div>
        <form action="./action.php" method="POST">
            <input type="hidden" name="mode" value="update">
            <p><h2>아이디는 변경 안됨.<h2></p>
	    <h2>이름:<input type="text" name="name" placeholder="이름" value="<?php echo $name;?>">
            <h2>패스워드:<input type="password" name="password" placeholder="" required><br></h2>
            <h2>패스워드 확인:<input type="password" name="password_check" placeholder="" required><br></h2>
            <input type="submit" value="수정하기"><br>
        </form>
    </div>
</body>
</html>
