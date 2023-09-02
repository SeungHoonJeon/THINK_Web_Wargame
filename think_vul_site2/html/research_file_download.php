<?php
    include "./config/dbms_conn.php";
    include "./sec_api/inputSecApi.php";
    accessPage();
    header("Content-Type: text/html; charset=UTF-8");
    
    $upload_path = "./think/upload/research";
    $file = $_GET["file"] ?? NULL;
    $idx = intval($_GET["idx"]);

    if(empty($file)){
        echo "<script>alert('잘못된 접근이거나 파일 다운로드 실패1');history.back(-1);</script>";
        exit();
    }

    $file= str_replace("/","",$file);
    $file = str_replace("\\","",$file);
    $file = str_replace("..","",$file);

    $file = mysqli_real_escape_string($conn, xssSec($file));
    $sql = "select * from think_research where idx='{$idx}' and file_real ='{$file}'";
    $result = mysqli_query($conn, $sql);
    if($result == false){
        echo "<script>alert('잘못된 접근이거나 파일 다운로드 실패2');history.back(-1);</script>";
        exit();
    }
    $row = mysqli_fetch_assoc($result);

    $filepath = "{$upload_path}/{$row['file_tmp']}";

    if(!file_exists($filepath)){
        echo "<script>alert('잘못된 접근이거나 파일 다운로드 실패3');history.back(-1);</script>";
        exit();
    }

    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename={$file}");

    readfile($filepath);
?>
