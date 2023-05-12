<?php
	include('./index/index_session.php');
	$ip = $_POST["ip"] ?? NULL;
	$page = $_SERVER['REQUEST_URI'] ?? NULL; // 현재페이지 주소 그대로 받음

	
  	if(empty($_SESSION["id"])){
		echo "<script>alert('정상적인 입력값이 아닙니다.');location.href='index.php?page=login;</script>";
		exit();
  	}else{
		if($_SESSION["id"] != "admin"){
			echo "<script>alert('접근 권한이 없습니다.');history.back(-1);</script>";
			exit();
		}
	}
	
  	if(!empty($ip)) {
		/* 정규표현식 ^: 시작  []:입력가능한 문자열 {}:반복횟수  $: 끝
		$ip_s = preg_replace('/[\@\&\&&\||\|\||\;]+/', '', $ip);
		if(preg_match("/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/", $ip_s)){
			echo "<script>alert('정상적인 입력값이 아닙니다.');history.back(-1);</script>";
			exit();
		}
		*/
		$result = shell_exec("ping -c 5 {$ip}");
		$result = iconv("UTF-8", "UTF-8", $result);
		$result = str_replace("\n", "<br>", $result);
  	}
?>

    <div>
      <h1>Ping Test</h1>
      <hr>
    </div>
    <div>
		<form action="<?php echo $page;?>" method="POST">
		  <div>
			<label>Ping</label>
			<input type="text" name="ip" placeholder="ex)192.168.0.100">
		  </div>
			<div>
				<button type="submit">Check</button>
			</div>
		</form>
	</div>

	<?php if(!empty($result)) { ?>
	<hr>
	<?php echo $result;?>
	<?php } ?>