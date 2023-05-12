<?php
  include "./config/dbms_conn.php";
  include "./sec_api/inputSecApi.php";
?>
<?php
    if(empty($_GET['idx'])){
        echo "<script>alert('존재하지 않는 게시글 번호입니다.');location.href='./index.php'</script>";
        exit();
    }
    $idx = IsNum($_GET['idx']);
    $sql = "SELECT * FROM think_board WHERE idx={$idx}";

    $result = mysqli_query($conn, $sql);
    if($result == false){
        echo "<script>alert('서버에 예기친 못한 에러가 발생했습니다. 관리자께 문의하세요.');location.href='./index.php'</script>";
        exit();
    }

    $row = mysqli_fetch_assoc($result);
    if(empty($row)){
        echo "<script>alert('내용이 없습니다.');history.back(-1);</script>";
        exit();
    }

    if(!empty($row['access_key'])){
        if(!empty($_GET['password'])){
            if($row['access_key'] != $_GET['password']){
                echo "<script>alert('The password is wrong');location.href='./board_crypto.php?idx={$idx}'</script>";
                exit();
            }
        }else{
            echo "<script>location.href='./board_crypto.php?idx={$idx}'</script>";
            exit();
        }
    }

?>
<!DOCTYPE html>
<html lang="ko">
  <?php include "./page_section/headtag_section.php"?>
<body>
    
<?php include "./page_section/header_section.php"?>

<main class="container">
<?php include "./page_section/board/introduce.php";?>
        <div class="form-floating mb-3">
            <div class="form-control" id="floatingInput"><?php echo $row['title'];?></div>
        </div>
        <div class="form-floating">
            <div class="form-control" id="floatingTextarea2" style="height: 300px"><?php echo $row['description'];?></div>
        </div>
        <br>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary" href="./?page=1" role="button">Back</a>
    </div>
    
</main>
<br>
<?php
    include "./page_section/footer_section.php";
?>

</body>
</html>