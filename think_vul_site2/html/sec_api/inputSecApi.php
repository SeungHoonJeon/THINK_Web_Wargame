<?php
    //변수가 숫자인지 아닌지 판별하고 숫자가 아니라면 NULL로 초기화.
    function IsNum($IsNum){
        $IsNum = intval($IsNum);
        if($IsNum == 0){
            $IsNum = "NULL";
            return $IsNum;
        }else{
            return $IsNum;
        }
    }

    //학번 입력값 처리 숫자가 맞는지, 자릿수는 정확한지 ex)18110138
    function classNumberSec($class_number){
        $class_number_len = strlen($class_number);

        if($class_number_len < 5 || intval($class_number) == 0){
            echo "<script>alert('학번이 일치하지 않습니다.');history.back(-1);</script>";
            exit();
        }
        
        return intval($class_number);
    }
    
    
    //패스워드 유효처리 8자 이상.
    function passwordSec($password, $password_check){
        $password_len = strlen($password);
        
        if($password_len < 8){
            echo "<script>alert('패스워드는 8자 이상 입력해야합니다.');history.back(-1);</script>";
            exit();
        }
        
        if($password != $password_check){
            echo "<script>alert('입력하신 두 패스워드가 일치하지 않습니다.');history.back(-1);</script>";
            exit();
        }else{
            return hash('sha256',$password);
        }
    }

    //XSS방지
    function xssSec($data){
        // Fix &entity\n;
        $data = str_replace('\'','',$data);
        $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

        // Remove any attribute starting with "on" or xmlns
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

        // Remove javascript: and vbscript: protocols
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

        // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

        // Remove namespaced elements (we do not need them)
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

        do
        {
            // Remove really unwanted tags
            $old_data = $data;
            $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
        }
        while ($old_data !== $data);

        // we are done...
        return $data;
    }

    //게시글 제목 입력값 유효처리 최소 1글자 ~ 최대 50 및 XSS 방지
    function titleSec($title){
        $title_len = strlen(trim($title));
        if($title_len < 1 || $title_len > 100){
            echo "<script>alert('게시글 제목은 최소 1 글자 ~ 최대 50 글자만 허용합니다.');history.back(-1);</script>";
            exit();
        }
        
        return xssSec($title);
    }

    //게시글 본문 입력값 유효처리 최소 1글자 ~ 최대 300 및 XSS 방지
    function contentSec($content){
        $content_len = strlen(trim($content));

        if($content_len < 1 || $content_len > 700){
            echo "<script>alert('게시글 본문은 최소 1글자 ~ 최대 300만 허용합니다.');history.back(-1);</script>";
            exit();
        }

        return xssSec($content);
    }

    //파라미터 취약점 보안조치 - 내가 쓴 글은 나만 수정,삭제
    function paraSec($conn,$board_number,$class_number,$mode_write_page){
        if($mode_write_page == "research"){
            $sql = "SELECT * FROM think_research where idx = {$board_number}";
        }else if($mode_write_page == "board"){
            $sql = "SELECT * FROM think_board where idx = {$board_number}";
        }

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        if($row['class_number'] != $class_number){
            echo "<script>alert('잘못된 접근입니다.');history.back(-1);</script>";
            exit();
        }
        
    }

    //CSRF 토큰 발행
    function csrfTokenCreate(){
        if(!empty($_SESSION['class_number'])){
            $time = time();
            $class_number = $_SESSION['class_number'];
            $csrf_token = hash('sha256',$class_number.$time);
            $_SESSION['csrf_token'] = $csrf_token;
        }else{
            $csrf_token="";
        }

        return $csrf_token;
    }

    //CSRF Sec
    function csrfSec(){
        $csrf_token_session = $_SESSION["csrf_token"];
	    $csrf_token_param = $_REQUEST["csrf_token"];
	    unset($_SESSION["csrf_token"]);

	    if(empty($csrf_token_session)&&empty($csrf_token_param)){
		    echo "<script>alert('정상적인 접근이 아닙니다.1');history.back(-1);</script>";
		    exit();
	    }else{
		    if($csrf_token_param != $csrf_token_session){
			    echo "<script>alert('정상적인 접근이 아닙니다.1');history.back(-1);</script>";
			    exit();
		    }
	    }
    }

    //로그인 한 유저만 접근 가능
    function accessPage(){
        if(empty($_SESSION['class_number'])){
            echo "<script>alert('로그인한 사용자만이 접근 가능한 페이지입니다.');location.href='./login.html';</script>";
			exit();
        }
    }
?>
