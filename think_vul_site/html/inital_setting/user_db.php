<?php
    $conn = mysqli_connect("localhost","tunaf","qwe123","think");
    
    if(!$conn){
        echo mysqli_connect_error();
        #echo "<script>alert('서버상 문제로 연결이 되지않습니다.');history.back(-1);</script>";
        exit();
    }
?>