<?php
  $agree1 = $_POST['agree1'] ?? NULL;
  $agree2 = $_POST['agree2'] ?? NULL;

  if(!($agree1 == "agree" && $agree2 == "agree")){
    echo "<script>alert('필수 약관 동의를 하셔야지 회원가입을 할 수 있습니다. ㅜㅜ');location.href='./sign_up_agree.html';</script>";
    exit();
  }
?>
<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>think</title>

    
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    
    <link rel="canonical" href="https://getbootstrap.kr/docs/5.1/examples/sign-in/">

    
    <link href="/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

   
    <link rel="apple-touch-icon" href="/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.1/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
   
    <link href="./page_css/sign_up.css" rel="stylesheet">
  </head>
  <body class="text-center">
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
   
    <script src="./js/bootstrap.min.js"></script>

    <main class="form-signin">
        <form action="action.php" method="POST">
          <img class="mb-4" src="./img/동아리로고-removebg-preview.png" alt="" width="200" height="100">
      
          <div class="form-floating">
            <input type="hidden" class="form-control" name="mode" value="join">
          </div>
          <div class="form-floating">
            <input type="text" class="form-control" name="name" placeholder="이름">
          </div>
          <div class="form-floating">
            <input type="text" class="form-control" name="class_number"placeholder="학번">
          </div>
          <div class="form-floating">
            <input type="password" class="form-control" name="password" placeholder="Password">
          </div>
          <div class="form-floating">
            <input type="password" class="form-control" name="password_check" placeholder="Password_Check">
          </div>
          <div class="form-floating">
            <input type="text" class="form-control" name="password_verification" placeholder="당신의 보물 1호는?">
          </div>
          <div class="form-floating">
            <input type="text" class="form-control" name="join_code" placeholder="#가입코드">
          </div>
          <br>
          <button class="w-100 btn btn-lg btn-primary" type="submit">Sign Up</button>
        </form>
        <p class="mt-5 mb-3 text-muted">&copy; <a href="#">#가입코드</a>는 동아리 톡방에</p>
      </main>
  </body>
</html>