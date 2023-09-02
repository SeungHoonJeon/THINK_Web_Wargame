<?php
  include "./config/session_config.php";
  include "./sec_api/inputSecApi.php";
  accessPage();
?>
<!DOCTYPE html>
<html lang="ko">
  <?php include "./page_section/headtag_section.php"?>
<body>
    
<?php include "./page_section/header_section.php"?>
<main class="container">
<?php include "./page_section/research/introduce.php"?>
    <form action="action.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="mode" value="write">
        <input type="hidden" name="write_page" value="research">
        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token=csrfTokenCreate();?>">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" placeholder="연구주제" name="title" minlength="1" maxlength="50">
        </div>
        <div class="form-floating">
            <textarea class="form-control" placeholder="간략 내용" id="floatingTextarea2" style="height: 300px" name="content" minlength="1" maxlength="300"></textarea>
        </div>
        <br>
        <div class="mb-3">
            <input class="form-control" type="file" id="formFile" name="userfile">
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <input type="submit" class="btn btn-primary" value="글 작성">
        </div>
    </form>
</main>
<br>
<?php
    include "./page_section/footer_section.php";
?>

</body>
</html>