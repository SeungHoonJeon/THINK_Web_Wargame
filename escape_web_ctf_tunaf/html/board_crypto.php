<?php
  include "./config/dbms_conn.php";
  include "./sec_api/inputSecApi.php";
?>
<!DOCTYPE html>
<html lang="ko">
  <?php include "./page_section/headtag_section.php"?>
<body>
    
<?php include "./page_section/header_section.php"?>

<main class="container">
<?php include "./page_section/board/introduce.php";?>
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
?>
    <form action="board_read.php" method="GET" enctype="multipart/form-data">
        <input type="hidden" name="write_page" value="board">
        <input type="hidden" name="idx" value="<?php echo intval($_GET['idx']);?>">
        암호:<input type="text" name="password">
        <input type="submit" value="Check">
    </form>
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