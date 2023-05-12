<?php
    require('./index/index_session.php');
    include("./inital_setting/user_db.php");
    header("Content-Type: text/html; charset=UTF-8;");
?>
<?php
    $sql = "delete from think_member where idx={$_SESSION['idx']}";
    $result = mysqli_query($conn, $sql);
    if($result == false){
        echo mysqli_error($conn);
        exit();
    }else{
        unset($_SESSION['idx']);
        session_destroy();
        echo "<script>alert('정상적으로 회원탈퇴가 완료되었습니다.');location.href='./board.php';</script>";
        exit();
    }
?>