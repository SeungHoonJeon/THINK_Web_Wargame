<?php
  include "./config/dbms_conn.php";
  include "./sec_api/inputSecApi.php";
  accessPage();
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <script>
        function aa(){
            document.getElementById('filetag').remove();
            document.getElementById('filetag2').remove();
        }
    </script>
    <style>
        .button{
            color : red;
            text-decoration : underline; 
            cursor:Pointer;
        }
        .button:hover{
            color : gray;
        }
    </style>
</head>
  <?php include "./page_section/headtag_section.php"?>
<body>
    
<?php include "./page_section/header_section.php"?>

<main class="container">
<?php include "./page_section/board/introduce.php";?>
<?php
    $idx = intval($_GET['idx']);
    $sql = "SELECT * FROM think_board WHERE idx={$idx};";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if(!($row['author'] == $_SESSION['name'] && $row['class_number'] == $_SESSION['class_number'])){
        echo "<script>alert('권한이 없습니다.');location.href='./board.php';</script>";
        exit();
    }


?>
    <form action="action.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token=csrfTokenCreate();?>">
        <input type="hidden" name="mode" value="modify">
        <input type="hidden" name="write_page" value="board">
        <input type="hidden" name="board_number" value="<?php echo $row['idx'];?>">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" placeholder="제목" name="title" minlength="1" maxlength="50" value="<?php echo $row['title'];?>">
        </div>
        <div class="form-floating">
            <textarea class="form-control" placeholder="본문" id="floatingTextarea2" style="height: 300px" name="content" minlength="1" maxlength="300"><?php echo $row['description'];?></textarea>
        </div>
        <br>
        <div class="mb-3">
            <input class="form-control" type="file" id="formFile" name="userfile">
            <input type="hidden" name="org_userfile" id="filetag" value="<?php echo $row['file_real'];?>">
            <?php
                if(!empty($row['file_real'])){
                    echo "<span id='filetag2'>이미 업로드한 파일명:".$row['file_real']."</span>"."&nbsp;<span onclick='aa();' class='button'>x</span>";
                }
            ?>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <input type="submit" class="btn btn-primary" value="글 수정">
        </div>
    </form>
</main>
<br>
<?php
    include "./page_section/footer_section.php";
?>

</body>
</html>