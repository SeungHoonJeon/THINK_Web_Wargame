<?php
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
?>