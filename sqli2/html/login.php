<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="./css/login.css">
    <title>Think_login</title>
</head>
<body>
    <div id="Login_title">Login Page</div>
    <div id="Login">
        <form action="./action.php" method="POST">
            <input type="hidden" name="mode" value="login">
            <input type="text" name="id" placeholder="ID" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="로그인">
        </form>
        <div id="Login_help">
            <ul>
                <li><a href=".\join.php" target="_blank">회원가입</a></li>
            </ul>
        </div>
    </div>
</body>
</html>