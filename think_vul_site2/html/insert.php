<?php
	include "./config/dbms_conn.php";
  include "./sec_api/inputSecApi.php";
  accessPage();
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
			<?php
				$class_number = intval($_SESSION['class_number']);
				$sql = "SELECT * FROM think_member where class_number={$class_number}";

				$result = mysqli_query($conn,$sql);
				$row_num = mysqli_num_rows($result);
				if($row_num != 0){
					$row = mysqli_fetch_assoc($result);
				}else{
					echo "<script>alert('잘못된 접근입니다.!');history.back(-1);</script>";
					exit();
				}
			?>
    <main class="form-signin">
        <form action="action.php" method="POST">
          <img class="mb-5" src="./img/동아리로고-removebg-preview.png" alt="" width="200" height="100">
    
          <div class="form-floating">
            <input type="hidden" class="form-control" name="mode" value="insert">
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token=csrfTokenCreate();?>">
          </div>
          <div class="form-floating">
            <input type="text" class="form-control" name="name" placeholder="이름" value="<?php echo "{$row['name']}";?>" disabled>
          </div>
          <div class="form-floating">
            <input type="text" class="form-control" name="class_number"placeholder="학번" value="<?php echo "{$row['class_number']}";?>" disabled>
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
          <div class="input-group">
            <span class="input-group-text">메인 분야</span>
            <textarea class="form-control" name="main_major" aria-label="With textarea" placeholder="ex)웹해킹,리버싱"><?php echo "{$row['main_major']}";?></textarea>
          </div>
          <div class="input-group">
            <span class="input-group-text">관심 분야</span>
            <textarea class="form-control" name="sub_major" aria-label="With textarea" placeholder="ex)개발, 포렌식"><?php echo "{$row['sub_major']}";?></textarea>
          </div>
          <div class="input-group">
            <span class="input-group-text">올해 목표</span>
            <textarea class="form-control" name="goal" aria-label="With textarea" placeholder="ex)자격증 취득, 시스템해킹"><?php echo "{$row['goal']}";?></textarea>
          </div>
					<div class="border border-4">
						<span class="input-group-text">선호하는 참여</span>
						<div class="form-check form-check-inline">
							<?php if($row['study_group'] == 0){
								echo '<input class="form-check-input" type="checkbox" name="inlineRadioOptions1" id="inlineRadioOptions1" value="1">';
							}else{
								echo '<input class="form-check-input" type="checkbox" name="inlineRadioOptions1" id="inlineRadioOptions1" value="1" checked>';
							}?>
  						<label class="form-check-label" for="inlineRadioOptions1">스터디 그룹</label>
						</div>
						<div class="form-check form-check-inline">
							<?php if($row['project'] == 0){
								echo '<input class="form-check-input" type="checkbox" name="inlineRadioOptions2" id="inlineRadioOptions2" value="2">';
							}else{
								echo '<input class="form-check-input" type="checkbox" name="inlineRadioOptions2" id="inlineRadioOptions2" value="2" checked>';
							}?>
						  <label class="form-check-label" for="inlineRadioOptions2">프로젝트</label>
						</div>
						<div class="form-check form-check-inline">
							<?php if($row['subjecting'] == 0){
								echo '<input class="form-check-input" type="checkbox" name="inlineRadioOptions3" id="inlineRadioOptions3" value="3">';
							}else{
								echo '<input class="form-check-input" type="checkbox" name="inlineRadioOptions3" id="inlineRadioOptions3" value="3" checked>';
							}?>
						  <label class="form-check-label" for="inlineRadioOptions3">연구활동</label>
						</div>
						<div class="form-check form-check-inline">
						<?php if($row['competition'] == 0){
								echo '<input class="form-check-input" type="checkbox" name="inlineRadioOptions4" id="inlineRadioOptions4" value="4">';
							}else{
								echo '<input class="form-check-input" type="checkbox" name="inlineRadioOptions4" id="inlineRadioOptions4" value="4" checked>';
							}?>
						  <label class="form-check-label" for="inlineRadioOptions4">각종 대회</label>
						</div>
						<div class="form-check form-check-inline">
						<?php if($row['wargame'] == 0){
								echo '<input class="form-check-input" type="checkbox" name="inlineRadioOptions5" id="inlineRadioOptions5" value="5">';
							}else{
								echo '<input class="form-check-input" type="checkbox" name="inlineRadioOptions5" id="inlineRadioOptions5" value="5" checked>';
							}?>
						  <label class="form-check-label" for="inlineRadioOptions5">워게임/CTF</label>
						</div>
						<div class="form-check form-check-inline">
						<?php if($row['seminar'] == 0){
								echo '<input class="form-check-input" type="checkbox" name="inlineRadioOptions6" id="inlineRadioOptions6" value="6">';
							}else{
								echo '<input class="form-check-input" type="checkbox" name="inlineRadioOptions6" id="inlineRadioOptions6" value="6" checked>';
							}?>
						  <label class="form-check-label" for="inlineRadioOptions6">세미나/컨퍼런스</label>
						</div>
					</div>
          
          <br>
          <button class="w-100 btn btn-lg btn-primary" type="submit">개인정보 수정</button>
        </form>
      </main>
      

  </body>
</html>