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
<div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
    <div class="col-md-6 px-0">
      <h1 class="display-10 fst-italic">THINK 동아리 멤버</h1>
      <p class="lead my-3">동아리원분들이 어떤 것에 관심 있고 어떤 것을 공부를 하고 있는지 확인해보세요 :)</p>
      <p class="lead mb-0"><a href="insert.php" class="text-success fw-bold">아래 기입된 내용을 바꾸고 싶다면?</a></p>
    </div>
</div>
<div>
  희망 참여
</div>
<div>
  <b>1.</b>스터디 그룹
  <b>2.</b>프로젝트
  <b>3.</b>연구활동
  <b>4.</b>각종 대회
  <b>5.</b>워게임/CTF
  <b>6.</b>세미나/컨퍼런스
</div>
<div class="table-responsive">
  <table class="table align-middle">
    <thead>
      <tr><td>이름</td><td>학번</td><td>메인 분야</td><td>관심 분야</td><td>올해 목표</td><td>희망 참여</td><td>수정 날짜</td></tr>
    </thead>
    <tbody class="table table-striped">
      <?php
        $sql = "SELECT * FROM think_member";
        $result = mysqli_query($conn, $sql);
        if($result == false){
          echo "<script>alert('예기친 못한 에러로 데이터를 불러오지 못했습니다. 관리자에게 문의해주세요.');history.back(-1);</script>";
          exit();
        }
        $i = 0;
        while($row = mysqli_fetch_assoc($result)){
            $i = $i + 1;
            echo "<tr>";
            echo "<th width=100px;>".$row['name']."</th>";
            echo "<th width=80px;>".substr($row['class_number'],0,2)."</th>";
            echo "<th width=150px;>".$row['main_major']."</th>";
            echo "<th width=150px;>".$row['sub_major']."</th>";
            echo "<th>".$row['goal']."</th>";
            echo "<th width=100px;>".$row['study_group'].' ',$row['project'].' '.$row['subjecting'],' ',$row['competition'],' ',$row['wargame'],' ',$row['seminar']."</th>";
            echo "<th>".$row['created']."</th>";
            echo "</tr>";
        }
      ?>
    </tbody>
  </table>
</div>
</main>

<?php
    include "./page_section/footer_section.php";
?>

</body>
</html>