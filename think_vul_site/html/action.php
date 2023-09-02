<?php
    require('./index/index_session.php');
    include("./inital_setting/user_db.php");
?>
<?php
    header("Content-Type: text/html; charset=UTF-8;");
    $mode = $_REQUEST['mode'];
    
    if(empty($mode)){
        echo "<script>alert('올바른 접근이 아닙니다.');history.back(-1);</script>";
        exit();
    }else if($mode == "join"){
        $name = $_POST['name'];
        $id = $_POST['id'];
        $password = $_POST['password'];
        $password_check = $_POST['password_check'];
        $email = NULL;
        $position = NULL;

        $sql = "
            SELECT id FROM think_member;
        ";
        
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)){
            if($id == $row['id']){
                echo "<script>alert('중복되는 아이디가 존재합니다.');history.back(-1)</script>";
            }
        }

        if($password !== $password_check){
            echo "<script>alert('입력하신 패스워드가 일치하지 않습니다.');history.back(-1);</script>";
            exit();
        }

        $sql = "
            INSERT INTO think_member(
                name,
                id,
                password,
                email,
                position
            )VALUES(
                '{$name}',
                '{$id}',
                '{$password}',
                '{$email}',
                '{$position}'
            );
        ";
        
        $result = mysqli_query($conn, $sql);
        if($result == false){
            echo mysqli_error($conn);
            exit();
        }else{
            echo "<script>alert('회원가입이 완료되었습니다.');location.href='./login.php';</script>";
        }
    }else if($mode == "login"){
        /*입력값 검증에 대한 시큐어코딩 적용*/
        #$id = mysqli_real_escape_string($conn,$_POST['id']);
        #$password = $_POST['password'];
        //$password = md5($_POST['password']); //지금은 계정내용들이 해시값으로 저장되어 있지 않기 때문에 
        
        
        
        $id = $_POST['id'];
        $password = $_POST['password'];
        

        $sql = "SELECT * FROM think_member WHERE id='{$id}' and password='{$password}';";
        $result = mysqli_query($conn, $sql);
        $row_num = mysqli_num_rows($result);
        if($row_num != 0){
            $row = mysqli_fetch_assoc($result);
            
            $_SESSION['idx'] = $row['idx'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['password'] = $row['password'];

            echo "<script>location.href='./';</script>";
        }else{
            echo "<script>alert('아이디 혹은 패스워드가 틀렸습니다.');location.href='./login.php'</script>";
            exit();
        }
    }else if($mode == 'update'){
        $name = $_POST['name'];
        $password = $_POST['password'];
        $password_check = $_POST['password_check'];
        if($password != $password_check){
            echo "<script>alert('패스워드가 일치하지 않습니다.');history.back(-1)</script>";
            exit();
        }
    
        $sql = "
            update think_member set name='{$name}', password='{$password}' where id='{$_SESSION['id']}';
        ";
        
        $result = mysqli_query($conn, $sql);
        if($result == false){
            echo mysqli_error($conn);
            exit();
        }else{
            echo "<script>alert('수정이 정상적으로 완료되었습니다.');location.href='./index.php';</script>";
        }
    }else if($mode == "write"){
            $uploadFile = iconv("UTF-8","CP949",$_FILES["userfile"]["name"]) ?? NULL;
        if(!empty($_FILES["userfile"]["name"])){
            $upload_path = "./upload";
            $uploadFile = iconv("UTF-8","CP949",$_FILES["userfile"]["name"]) ?? NULL;
            $uploadPath = "{$upload_path}/{$uploadFile}";
            
            /*
            $file_content = pathinfo($uploadPath);
            $file_ex = $file_content['extension'];
            
            $white_list = array('png','txt');
            
            if(!in_array($file_ex,$white_list)){
                echo "<script>alert('지원하지 않는 확장자입니다.');history.back(-1);</script>";
                exit();
            }
            */
                
            
            if(move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadPath)){
                echo "파일이 성공적으로 업로드 되었습니다. \n";
            }else{
                echo "파일 업로드를 실패했습니다.";
                exit();
            }
        }
        
        /*
        $_POST = str_replace("<","&lt;",$_POST);
        $_POST = str_replace("<","&gt;",$_POST);
        $_POST = str_replace("\"","&quot;",$_POST);
        
        #csrf_token 시큐어코딩 적용
        $csrf_token_session = $_SESSION["csrf_token"];
	    $csrf_token_param = $_REQUEST["csrf_token"]; //GET 방식 뿐만 아니라 POST 방식으로도 올 수 있기 떄문에 REQUEST로 함.
	    unset($_SESSION["csrf_token"]);
	    if(empty($csrf_token_session)&&empty($csrf_token_param)){
		    echo "<script>alert('정상적인 접근이 아닙니다.');history.back(-1);</script>";
		    exit();
	    }else{
		    if($csrf_token_param != $csrf_token_session){
			    echo "<script>alert('정상적인 접근이 아닙니다.');history.back(-1);</script>";
			    exit();
		    }
	    }
        */
        
        $sql = "INSERT INTO think_board
            (title,description,author,created,file_real)
            VALUE
            ('{$_POST['title']}','{$_POST['description']}','{$_SESSION['name']}',NOW(),'{$uploadFile}'); 
        ";

        $result = mysqli_query($conn,$sql);
        if($result == false){
            echo mysqli_error($conn);
            exit();
        }else{
            echo "<script>alert('정상적으로 작성이 완료되었습니다.');location.href='./board.php';</script>";
            exit();
        }
       
    }else if($mode == "modify"){
        if(!empty($_FILES["userfile"]["name"])){
            $upload_path = "./upload";
            $uploadFile = iconv("UTF-8","EUC-KR",$_FILES["userfile"]["name"]);
            $uploadPath = "{$upload_path}/{$uploadFile}";
            
            if(move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadPath)){
                echo "파일이 성공적으로 업로드 되었습니다. \n";
            }else{
                echo "파일 업로드를 실패했습니다.";
                exit();
            }
        }
        $sql = "UPDATE think_board SET title='{$_POST['title']}', description='{$_POST['description']}', created=NOW(),file_real='{$uploadFile}' WHERE id={$_POST['id']}";
        $result = mysqli_query($conn, $sql);

        if($result == false){
            echo mysqli_error($conn);
            exit();
        }else{
            echo "<script>alert('정상적으로 수정이 완료되었습니다.');location.href='./board.php';</script>";
            exit();
        }
        
    }else if($mode == "delete"){
        $idx = $_GET['idx'];
        $sql = "SELECT * FROM think_board WHERE id={$_GET['idx']}";

            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            if(!empty($row["file_real"])){ 
                $uploaded_path = "./upload";
                $uploadedPath = "{$uploaded_path}/{$row['file_real']}";
                @unlink($uploadedPath);
            }
        $sql = "DELETE FROM think_board WHERE id='{$idx}'";
        $result = mysqli_query($conn,$sql);

        if($result == false){
            echo mysqli_error($conn);
            exit();
        }else{
            echo "<script>alert('정상적으로 삭제가 완료되었습니다.');location.href='./board.php';</script>";
            exit();
        }
    }
?>
