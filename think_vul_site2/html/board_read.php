<?php
  include "./config/dbms_conn.php";
  include "./sec_api/inputSecApi.php";
  accessPage();
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
        echo "<script>alert('존재하지 않는 게시글 번호입니다.');location.href='./board.php'</script>";
        exit();
    }
    $idx = $_GET['idx'];
    $sql = "SELECT * FROM think_board WHERE idx={$idx}";

    $result = mysqli_query($conn, $sql);
    if($result == false){
        echo "<script>alert('서버에 예기친 못한 에러가 발생했습니다. 관리자께 문의하세요.');location.href='./board.php'</script>";
        exit();
    }

    $row = mysqli_fetch_assoc($result);
    if(empty($row)){
        echo "<script>alert('내용이 없습니다.');history.back(-1);</script>";
    }
?>
    <form action="action.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="mode" value="modify">
        <input type="hidden" name="write_page" value="board">
        <input type="hidden" name="board_number" value="<?php echo intval($_GET['idx']);?>">
        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token=csrfTokenCreate();?>">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" placeholder="연구주제" name="title" value="<?php echo $row['title'];?>" minlength="1" maxlength="50">
        </div>
        <div class="form-floating">
            <textarea class="form-control" placeholder="본문" id="floatingTextarea2" style="height: 300px" name="content" minlength="1" maxlength="300"><?php echo $row['description'];?></textarea>
        </div>
        <br>
        <div class="mb-3">
            <?php 
                echo "<a href='./board_file_download.php?idx={$row['idx']}&file={$row['file_real']}'>{$row['file_real']}</a>";
            ?>
        </div>
        
    </form>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary" href="./board.php?page=1" role="button">뒤로</a>
        <?php
            if($_SESSION['class_number'] == $row['class_number']){
                echo "<a class='btn btn-primary' href='./board_modify.php?idx={$_GET['idx']}' role='button'>수정</a>";
                
                echo "<a class='btn btn-primary' href='./action.php?mode=delete&write_page=board&idx={$_GET['idx']}&csrf_token={$csrf_token}' role='button'>삭제</a>";
            }
        ?>
    </div>
    
</main>
<br>
<?php
    include "./page_section/footer_section.php";
?>

</body>
</html>