<?php
    header("Content-Type: text/html; charset=UTF-8");
    $upload_path = "./upload";
    $file = $_GET["file"];

    if(empty($file)){
        echo "<script>alert('잘못된 접근이거나 파일 다운로드 실패');history.back(-1);</script>";
        exit();
    }

    #$file = str_replace("./","",$file);
    #$file = str_replace(".\\","",$file);
    #$file = str_replace("../","",$file);
    #$file = str_replace("..\\","",$file);
    #$file = str_replace("/","",$file);
    #$file = str_replace("\\","",$file);
    #$file = str_replace("..","",$file);

    $filepath = "{$upload_path}/{$file}";

    if(!file_exists($filepath)){
        echo "<script>alert('잘못된 접근이거나 파일 다운로드 실패');history.back(-1);</script>";
        exit();
    }

    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename={$file}");

    readfile($filepath);
?>