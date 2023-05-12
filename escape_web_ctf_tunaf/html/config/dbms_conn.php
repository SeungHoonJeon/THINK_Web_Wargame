<?php
    include "dbms_user.php";
    $conn = mysqli_connect($ip,$user,$passwd,$db,$port);

    if(!$conn){
        echo "<script>alert('서버상 문제로 연결이 되지않습니다.');history.back(-1);</script>";
        exit();
    }
?>