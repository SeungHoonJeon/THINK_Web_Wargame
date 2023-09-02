<?php
    include "./config/dbms_conn.php";
    include "./sec_api/inputSecApi.php";
?>
<?php
    $mode = $_REQUEST['mode'] ?? NULL;
    $mode_write_page = $_REQUEST['write_page'] ?? NULL;
    
    if(empty($mode)){
        echo "<script>alert('올바른 접근이 아닙니다.');history.back(-1);</script>";
        exit();
    }else if($mode == "join"){
        if(empty($_POST['name']) || empty($_POST['class_number']) || empty($_POST['password']) || empty($_POST['password_check']) || empty($_POST["password_verification"])){
            echo "<script>alert('모든 칸을 채워주세요 :)');history.back(-1);</script>";
            exit();
        }
        
        if(intval($_POST['join_code']) != 20891411){
            echo "<script>alert('참여코드가 일치하지 않습니다!');history.back(-1);</script>";
            exit();
        }

        $name = mysqli_real_escape_string($conn,$_POST['name']);
        $class_number = mysqli_real_escape_string($conn,$_POST['class_number']);
        $password = $_POST['password'];
        $password_check = $_POST['password_check'];
        $password_verification = hash('sha256',$_POST["password_verification"]);

        $class_number = classNumberSec($class_number);
        $password = passwordSec($password,$password_check);

        $sql = "SELECT class_number FROM think_member";

       $result = mysqli_query($conn, $sql);
       while($row = mysqli_fetch_array($result)){
           if($class_number == $row['class_number']){
                echo "<script>alert('이미 가입하신 학번입니다.');history.back(-1);</script>";
           }
       }

       $sql = "INSERT INTO think_member(
           name,
           class_number,
           password,
           password_verification
        )VALUES(
           '{$name}',
           '{$class_number}',
           '{$password}',
           '{$password_verification}'
        );";

        $result = mysqli_query($conn, $sql);
        if($result == false){
            echo "<script>alert('예기친 못한 에러로 회원가입을 실패했습니다. 관리자에게 문의해주세요.');history.back(-1);</script>";
            exit();
        }else{
            echo "<script>alert('회원가입이 완료되었습니다.');location.href='./login.html';</script>";
        }
    }else if($mode == "login"){

        if(empty($_POST['class_number']) || empty($_POST['password'])){
            echo "<script>alert('아이디와 패스워드를 입력해주세요.');history.back(-1);</script>";
            exit();
        }

        $class_number = mysqli_real_escape_string($conn,intval($_POST['class_number']));
        $class_number = mysqli_real_escape_string($conn, $_POST['class_number']);
        $password = hash('sha256',$_POST['password']);
        $sql = "SELECT * FROM think_member where class_number = {$class_number} and password = '{$password}';";
	$result = mysqli_query($conn, $sql);
	if($result == false){
            echo "<script>alert('아이디 혹은 패스워드가 틀렸습니다.');history.back(-1);</script>";
            exit();
	}
	$row_num = mysqli_num_rows($result);

        if($row_num != 0){
            $row = mysqli_fetch_assoc($result);

            $_SESSION['name'] = $row['name'];
            $_SESSION['class_number'] = $row['class_number'];
            $_SESSION['password'] = $row['password'];

            echo "<script>location.href='./';</script>";
        }else{
            echo "<script>alert('아이디 혹은 패스워드가 틀렸습니다.');history.back(-1);</script>";
            exit();
        }
    }else if($mode == "logout"){
        $name = $_SESSION['name'];
        $class_number = $_SESSION['class_number'];

        if(empty($name) || empty($class_number)){
            echo "<script>alert('잘못된 접근입니다.');history.back(-1);</script>";
            exit();
        }else{
            
            session_destroy(); // 세션삭제
            echo "<script>alert('정상적으로 로그아웃이 되었습니다.');location.href='./';</script>";
            exit();
        }

    }else if($mode == "insert"){
        if(empty($_POST['password']) || empty($_POST['password_check']) || empty($_POST["password_verification"])){
            echo "<script>alert('필수 빈칸을 모두 채워주세요 :)');history.back(-1);</script>";
            exit();
        }
        csrfSec();
        $name = $_SESSION['name'];
        $class_number = intval($_SESSION['class_number']);
        $password = $_POST['password']; 
        $password_check = $_POST['password_check'];
        $password_verification = $_POST['password_verification'];
        $main_major = $_POST['main_major'] ?? NULL;
        $sub_major = $_POST['sub_major'] ?? NULL;
        $goal = $_POST['goal'] ?? NULL;
        $study_group = IsNum($_POST['inlineRadioOptions1'] ?? NULL);
        $project =  IsNum($_POST['inlineRadioOptions2'] ?? NULL);
        $subjecting = IsNum($_POST['inlineRadioOptions3'] ?? NULL);
        $competition = IsNum($_POST['inlineRadioOptions4'] ?? NULL);
        $wargame = IsNum($_POST['inlineRadioOptions5'] ?? NULL);
        $seminar = IsNum($_POST['inlineRadioOptions6'] ?? NULL);
        
        $password = passwordSec($password,$password_check);
        $password_verification = hash('sha256',$password_verification);
        $main_major = mysqli_real_escape_string($conn,xssSec($main_major));
        $sub_major = mysqli_real_escape_string($conn,xssSec($sub_major));
        $goal =  mysqli_real_escape_string($conn,xssSec($goal));
        

        $sql = "UPDATE think_member SET password='{$password}' ,password_verification='{$password_verification}',main_major='{$main_major}',sub_major='{$sub_major}',goal='{$goal}',study_group={$study_group},project={$project},subjecting={$subjecting},competition={$competition},wargame={$wargame},seminar={$seminar},created=NOW() where name='{$name}' and class_number={$class_number};";
        $result = mysqli_query($conn, $sql);
        
        if($result == false){
            echo "<script>alert('예기친 못한 에러로 개인정보 수정을 실패했습니다. 관리자에게 문의해주세요.');location.href='./';</script>";
            exit();
        }else{
            echo "<script>alert('정상적으로 수정되었습니다.');location.href='./member.php';</script>";
            exit();
        }
        
    }else if($mode == "write"){
        if(empty($mode_write_page)){
            echo "<script>alert('올바른 접근이 아닙니다.');history.back(-1);</script>";
            exit();
        }

        if($mode_write_page == "board"){
            $title = mysqli_real_escape_string($conn,titleSec($_POST['title']));
            $description = mysqli_real_escape_string($conn,contentSec($_POST['content']));
            $name = $_SESSION['name'];
            $class_number = intval($_SESSION['class_number']);
            $uploadFile = NULL;
            $uploadFile_tmp = NULL;
            csrfSec();
            if(!empty($_FILES['userfile']['name'])){
                $upload_path = "./think/upload/board";
                $uploadFile = mysqli_real_escape_string($conn,xssSec($_FILES['userfile']['name']));
                $uploadFile_tmp = hash("sha256",$_FILES['userfile']['name'].time());
                $uploadPath = "{$upload_path}/{$uploadFile_tmp}";

                if(move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadPath)){
                    
                }else{
                    echo "<script>alert('예기친 못한 오류로 파일 업로드를 실패했습니다.');location.href='./board.php';</script>";
                    exit();
                }
            }
            
            $sql = "INSERT INTO think_board(title,description,author,class_number,created,file_real,file_tmp) VALUE('{$title}','{$description}','{$name}',{$class_number},NOW(),'{$uploadFile}','{$uploadFile_tmp}');";
            $result = mysqli_query($conn, $sql);
            if($result == false){
                echo "<script>alert('예기친 못한 에러로 글 작성을 실패했습니다. 관리자에게 문의해주세요.');location.href='./board.php';</script>";
                exit();
            }else{
                echo "<script>alert('정상적으로 작성이 완료되었습니다.');location.href='./board.php';</script>";
                exit();
            }
        }else if($mode_write_page == "research"){
            $title = mysqli_real_escape_string($conn,titleSec($_POST['title']));
            $description = mysqli_real_escape_string($conn,contentSec($_POST['content']));
            $name = $_SESSION['name'];
            $class_number = intval($_SESSION['class_number']);
            $uploadFile = NULL;
            $uploadFile_tmp = NULL;
            csrfSec();
            if(!empty($_FILES['userfile']['name'])){
                $upload_path = "./think/upload/research";
                $uploadFile = mysqli_real_escape_string($conn,xssSec($_FILES['userfile']['name']));
                $uploadFile_tmp = hash("sha256",$_FILES['userfile']['name'].time());
                $uploadPath = "{$upload_path}/{$uploadFile_tmp}";

                if(move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadPath)){
                    
                }else{
                    echo "<script>alert('예기친 못한 오류로 파일 업로드를 실패했습니다.');location.href='./research.php';</script>";
                    exit();
                }
            }
            
            $sql = "INSERT INTO think_research(title,description,author,class_number,created,file_real,file_tmp) VALUE('{$title}','{$description}','{$name}',{$class_number},NOW(),'{$uploadFile}','{$uploadFile_tmp}');";
            $result = mysqli_query($conn, $sql);
            if($result == false){
                echo "<script>alert('예기친 못한 에러로 글 작성을 실패했습니다. 관리자에게 문의해주세요.');location.href='./research.php';</script>";
                exit();
            }else{
                echo "<script>alert('정상적으로 작성이 완료되었습니다.');location.href='./research.php';</script>";
                exit();
            }
        }
    }else if($mode == "modify"){
        if(empty($mode_write_page)){
            echo "<script>alert('올바른 접근이 아닙니다.');history.back(-1);</script>";
            exit();
        }

        if($mode_write_page == "board"){
            $title = mysqli_real_escape_string($conn,titleSec($_POST['title']));
            $description = mysqli_real_escape_string($conn,contentSec($_POST['content']));
            $name = $_SESSION['name'];
            $class_number = intval($_SESSION['class_number']);
            $uploadFile = NULL;
            $uploadFile_tmp = NULL;
            $board_number = intval($_POST['board_number']);
            $org_userfile = $_POST['org_userfile'] ?? NULL;
            csrfSec();
            paraSec($conn,$board_number,$class_number,$mode_write_page);

            if(!empty($_FILES['userfile']['name'])){
                $upload_path = "./think/upload/board";
                $uploadFile = mysqli_real_escape_string($conn,xssSec($_FILES['userfile']['name']));
                $uploadFile_tmp = hash("sha256",$_FILES['userfile']['name'].time());
                $uploadPath = "{$upload_path}/{$uploadFile_tmp}";

                if(move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadPath)){
                    $sql = "SELECT * FROM think_board WHERE idx='{$board_number}';";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $upload_path = "./think/upload/board";
                    $uploadPath = "{$upload_path}/{$row['file_tmp']}";
                    @unlink($uploadPath);
                }else{
                    echo "<script>alert('예기친 못한 오류로 파일 업로드를 실패했습니다.');location.href='./board.php';</script>";
                    exit();
                }

                $sql = "UPDATE think_board SET title='{$title}', description='{$description}', created=NOW(), file_real='{$uploadFile}', file_tmp='{$uploadFile_tmp}' WHERE idx={$board_number};";
            }else if(!empty($org_userfile)){          
                $sql = "UPDATE think_board SET title='{$title}', description='{$description}', created=NOW() WHERE idx={$board_number};";
            }else{
                $sql = "SELECT * FROM think_board WHERE idx='{$board_number}';";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $upload_path = "./think/upload/board";
                $uploadPath = "{$upload_path}/{$row['file_tmp']}";
                @unlink($uploadPath);

                $sql = "UPDATE think_board SET title='{$title}', description='{$description}', created=NOW(), file_real='{$uploadFile}', file_tmp='{$uploadFile_tmp}' WHERE idx={$board_number};";
            }

            $result = mysqli_query($conn, $sql);
            if($result == false){
                echo "<script>alert('예기친 못한 에러로 글 작성을 실패했습니다. 관리자에게 문의해주세요.');location.href='./board.php';</script>";
                exit();
            }else{
                echo "<script>alert('정상적으로 작성이 완료되었습니다.');location.href='./board.php';</script>";
                exit();
            }
        }else if($mode_write_page == "research"){
            $title = mysqli_real_escape_string($conn,titleSec($_POST['title']));
            $description = mysqli_real_escape_string($conn,contentSec($_POST['content']));
            $name = $_SESSION['name'];
            $class_number = intval($_SESSION['class_number']);
            $uploadFile = NULL;
            $uploadFile_tmp = NULL;
            $board_number = intval($_POST['board_number']);
            csrfSec();
            paraSec($conn,$board_number,$class_number,$mode_write_page);

            if(!empty($_FILES['userfile']['name'])){
                $upload_path = "./think/upload/research";
                $uploadFile = mysqli_real_escape_string($conn,xssSec($_FILES['userfile']['name']));
                $uploadFile_tmp = hash("sha256",$_FILES['userfile']['name'].time());
                $uploadPath = "{$upload_path}/{$uploadFile_tmp}";

                if(move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadPath)){
                    $sql = "SELECT * FROM think_research WHERE idx='{$board_number}';";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $upload_path = "./think/upload/research";
                    $uploadPath = "{$upload_path}/{$row['file_tmp']}";
                    @unlink($uploadPath);
                }else{
                    echo "<script>alert('예기친 못한 오류로 파일 업로드를 실패했습니다.');location.href='./research.php';</script>";
                    exit();
                }
                
                $sql = "UPDATE think_research SET title='{$title}', description='{$description}', created=NOW(), file_real='{$uploadFile}', file_tmp='{$uploadFile_tmp}' WHERE idx={$board_number};";
            }else if(!empty($org_userfile)){
                $sql = "UPDATE think_research SET title='{$title}', description='{$description}', created=NOW() WHERE idx={$board_number};";
            }else{
                $sql = "SELECT * FROM think_research WHERE idx='{$board_number}';";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $upload_path = "./think/upload/research";
                $uploadPath = "{$upload_path}/{$row['file_tmp']}";
                @unlink($uploadPath);

                $sql = "UPDATE think_research SET title='{$title}', description='{$description}', created=NOW(), file_real='{$uploadFile}', file_tmp='{$uploadFile_tmp}' WHERE idx={$board_number};";
            }
        
            $result = mysqli_query($conn, $sql);
            if($result == false){
                echo "<script>alert('예기친 못한 에러로 글 작성을 실패했습니다. 관리자에게 문의해주세요.');location.href='./research.php';</script>";
                exit();
            }else{
                echo "<script>alert('정상적으로 작성이 완료되었습니다.');location.href='./research.php';</script>";
                exit();
            }
        }
    }else if($mode == "delete"){
        if(empty($mode_write_page)){
            echo "<script>alert('올바른 접근이 아닙니다.');history.back(-1);</script>";
            exit();
        }

        if($mode_write_page == "board"){
            $idx = intval($_GET['idx']);
            $sql = "SELECT * FROM think_board WHERE idx={$idx};";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            csrfSec();
            if($row['class_number'] != $_SESSION['class_number']){
                echo "<script>alert('잘못된 접근입니다.');history.back(-1);</script>";
                exit();
            }

            if(!empty($row['file_real'])){
                $upload_path = "./think/upload/board";
                $uploadPath = "{$upload_path}/{$row['file_tmp']}";
                @unlink($uploadPath);
            }

            $sql = "DELETE FROM think_board where idx=$idx";
            $result = mysqli_query($conn, $sql);

            if($result == false){
                echo "<script>alert('예기친 못한 에러로 글 삭제을 실패했습니다. 관리자에게 문의해주세요.');location.href='./board.php';</script>";
                exit();
            }else{
                echo "<script>alert('정상적으로 삭제가 완료되었습니다.');location.href='./board.php?page=1';</script>";
                exit();
            }
        }else if($mode_write_page == "research"){
            $idx = intval($_GET['idx']);
            $sql = "SELECT * FROM think_research WHERE idx={$idx};";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            csrfSec();
            if($row['class_number'] != $_SESSION['class_number']){
                echo "<script>alert('잘못된 접근입니다.');history.back(-1);</script>";
                exit();
            }

            if(!empty($row['file_real'])){
                $upload_path = "./think/upload/board";
                $uploadPath = "{$upload_path}/{$row['file_tmp']}";
                @unlink($uploadPath);
            }

            $sql = "DELETE FROM think_research where idx=$idx";
            $result = mysqli_query($conn, $sql);

            if($result == false){
                echo "<script>alert('예기친 못한 에러로 글 삭제을 실패했습니다. 관리자에게 문의해주세요.');location.href='./research.php';</script>";
                exit();
            }else{
                echo "<script>alert('정상적으로 삭제가 완료되었습니다.');location.href='./research.php?page=1';</script>";
                exit();
            }
        }
    }else if($mode == "find_pw"){
        $class_number = intval($_POST['class_number']); //파라미터 입력값 처리 집에서 해야함
        $name = $_POST['name'];
        $password_verification = hash('sha256',$_POST['password_verification']);

        echo $name;
        echo $class_number;
        echo $password_verification;

        $sql = "SELECT * from think_member WHERE class_number=$class_number AND name='{$name}' AND password_verification='{$password_verification}';";
        $result = mysqli_query($conn, $sql);
        
        if($result == false){
            echo "<script>alert('예기친 못한 에러로 글 삭제을 실패했습니다. 관리자에게 문의해주세요.');location.href='./board.php';</script>";
            exit();
        }

        $row_num = mysqli_num_rows($result);

        if($row_num == 0){
            echo "<script>alert('입력하신 정보가 일치하지 않습니다.');history.back(-1);</script>";
            exit();
        }
        $password_tmp = 'think'.rand(4000,4999);
        $password_tmp_hash = hash('sha256',$password_tmp); //해시값 처리
        
        $sql = "UPDATE think_member SET password='{$password_tmp_hash}' where class_number={$class_number}";
        $result = mysqli_query($conn, $sql);
        
        if($result == false){
            echo "<script>alert('예기친 못한 에러로 글 삭제을 실패했습니다. 관리자에게 문의해주세요.');location.href='./find_pw.html';</script>";
            exit();
        }else{
            echo "<script>alert('임시로 발급된 패스워드는 {$password_tmp}입니다.');location.href='./login.html';</script>";
            exit();
        }
    }
?>
