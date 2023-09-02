<?php
    header("Content-Type: text/html; charset=UTF-8");
    $upload_path = "./upload";
    $file = $_GET["idx"];

    if(empty($file)){
        echo "no";
        exit();
    }

    $file = str_replace("../","",$file);

    $filepath = "{$upload_path}/{$file}";

    if(!file_exists($filepath)){
        echo "no";
        exit();
    }

    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename={$file}");

    include($filepath);
?>
