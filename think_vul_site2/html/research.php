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
<?php include "./page_section/research/introduce.php"?>

<div class="d-grid gap-2 d-md-flex justify-content-end">
    <button type="button" class="btn btn-outline-primary text-end" onclick="location.href='research_write.php'">글 쓰기</button>
</div>
<table class="table align-middle">
    <thead>
      <tr><td>순번</td><td>이름</td><td>연구주제</td><td>파일</td><td>작성 날짜</td></tr>
    </thead>
    <tbody>
      <?php
        
        $sql = "SELECT * FROM think_research";

        $result = mysqli_query($conn, $sql);
        if($result == false){
          echo "<script>alert('예기친 못한 에러로 데이터를 불러오지 못했습니다. 관리자에게 문의해주세요.');history.back(-1);</script>";
          exit();
        }
        $total_article = mysqli_num_rows($result);
        $sql = "SELECT * from think_research ORDER BY idx DESC;";
        $result = mysqli_query($conn, $sql);
        if($result == false){
          echo "<script>alert('예기친 못한 에러로 데이터를 불러오지 못했습니다. 관리자에게 문의해주세요.');history.back(-1);</script>";
          exit();
        }
        $i = $total_article+1;
        while($row = mysqli_fetch_assoc($result)){
          $i = $i-1;
          echo "<tr>";
          echo "<th>".$i."</th>";
          echo "<th>".$row['author']."</th>";
          echo "<th><a href='./research_read.php?idx={$row['idx']}'>".$row['title']."</a></th>";
          echo "<th><a href='./research_file_download.php?idx={$row['idx']}&file={$row['file_real']}'>".$row['file_real']."</th>";
          echo "<th>".$row['created']."</th>";
          echo "</tr>";
        }
      ?>
    </tbody>
  </table>
</main>

<?php
    include "./page_section/footer_section.php";
?>

</body>
</html>