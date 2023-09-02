<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="./css/join.css">
    <title>Think_회원가입</title>
</head>
<body>
    <div>
        <form action="./action.php" method="POST">
            <input type="hidden" name="mode" value="join">
            <input type="text" name="name" placeholder="이름" required><br>
            <input type="text" name="id" placeholder="ID" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="password" name="password_check" placeholder="Password_check" required><br>
            <!--<input type="password" name="join_code" placeholder="#가입코드" required>-->
            <input type="submit" value="회원가입"><br>
        </form>
    </div>
</body>
</html>