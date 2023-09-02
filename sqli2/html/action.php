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
        
        $id_no = $_POST['id'] ?? NULL;
        $password = $_POST['password'] ?? NULL;
            
        $id_no = str_replace("--", "", $id_no);
        $ids = str_replace("#", "", $id_no);
            
        $sql = "SELECT * FROM think_member WHERE id='{$ids}' and password='{$password}'";
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
    }
?>
