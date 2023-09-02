<?php
    include("./inital_setting/user_db.php");
?>
<?php
    header("Content-Type: text/html; charset=UTF-8;");
    $mode = $_REQUEST['mode'];
    
    if(empty($mode)){
        echo "<script>alert('올바른 접근이 아닙니다.');history.back(-1);</script>";
        exit();
    }else if($mode == "write"){
            $uploadFile = iconv("UTF-8","CP949",$_FILES["userfile"]["name"]) ?? NULL;
        if(!empty($_FILES["userfile"]["name"])){
            $upload_path = "./upload";
            $uploadFile = iconv("UTF-8","CP949",$_FILES["userfile"]["name"]) ?? NULL;
            $uploadPath = "{$upload_path}/{$uploadFile}";
            
            $file_content = pathinfo($uploadPath);
            $file_ex = $file_content['extension'];
            
            $black_list = array('php');
            
            if(in_array($file_ex,$black_list)){
                echo "<script>alert('지원하지 않는 확장자입니다.');history.back(-1);</script>";
                exit();
            }   
            
            if(!move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadPath)){
                echo "파일 업로드를 실패했습니다.";
                exit();
            }
        }

        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);

        $sql = "INSERT INTO think_board
            (title,description,author,created,file_real)
            VALUE
            ('{$title}','{$description}','whoami',NOW(),'{$uploadFile}'); 
        ";

        $result = mysqli_query($conn,$sql);
        if($result == false){
            exit();
        }else{
            echo "<script>alert('정상적으로 작성이 완료되었습니다.');location.href='./index.php';</script>";
            exit();
        }
       
    }
?>
