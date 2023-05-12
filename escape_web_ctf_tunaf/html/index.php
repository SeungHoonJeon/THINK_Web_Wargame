<?php
  include "./config/dbms_conn.php";
  include "./sec_api/inputSecApi.php";
?>
<!DOCTYPE html>
<html lang="ko">
  <?php include "./page_section/headtag_section.php";?>
<body>
    
<?php include "./page_section/header_section.php";?>

<main class="container">
<?php include "./page_section/board/introduce.php";?>
<?php
  if(!empty($_GET['page'])){
    $page = intval($_GET['page']);
  }else{
    $page = 0;
  }
  
  $sql = "SELECT * FROM think_board";

  $result = mysqli_query($conn, $sql);
  if($result == false){
    echo "<script>alert('예기친 못한 에러로 데이터를 불러오지 못했습니다. 관리자에게 문의해주세요.');history.back(-1);</script>";
    exit();
  }
  $total_article = mysqli_num_rows($result);

  $view_article = 5;
  if(!$page)$page = 1;
  $start = $view_article*($page-1);

  $sql = "SELECT * from think_board ORDER BY idx DESC limit {$start}, {$view_article};";
  $result = mysqli_query($conn, $sql);
  if($result == false){
    echo "<script>alert('예기친 못한 에러로 데이터를 불러오지 못했습니다. 관리자에게 문의해주세요.');history.back(-1);</script>";
    exit();
  }
?>
<div class="d-grid gap-2 d-md-flex justify-content-between">
    <form action="./index.php" method="GET" class="d-flex">
        <input type="hidden" name="page" value="<?php echo intval($page);?>">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" value="<?php if(!empty($_GET['search'])) echo xssSec($_GET['search']);?>">
        <button class="btn btn-outline-primary" type="submit">Search</button>
    </form>
</div>

<table class="table align-middle">
    <thead>
      <tr><td>seq</td><td>Title</td><td>Writer</td></tr>
    </thead>
    <tbody>
      <?php
        $num = $page - 1;
        $i = $total_article+1 - ($num*5);
        if(!empty($_GET['search'])){
          $search = mysqli_real_escape_string($conn,$_GET['search']);
          $sql = "SELECT * FROM think_board WHERE (title LIKE '%{$search}%' OR description LIKE '%{$search}%') ORDER BY idx DESC limit {$start}, {$view_article};";
          $result = mysqli_query($conn, $sql);
          $total_article = mysqli_num_rows($result);
        }
        while($row = mysqli_fetch_assoc($result)){
          $i = $i-1;
          echo "<tr>";
          echo "<th>".$i."</th>";
          if(!empty($row['access_key'])){
            echo "<th><img src='./img/60.png' height='15' width='15'><a href='./board_crypto.php?idx={$row['idx']}'>".$row['title']."</a></th>";
          }else{
            echo "<th><a href='./board_read.php?idx={$row['idx']}'>".$row['title']."</a></th>";
          }
          echo "<th>".$row['author']."</th>";
          echo "</tr>";
        }
      ?>
    </tbody>
  </table>
  <div style="text-align:center;">
    <?php
      if(!empty($_GET['search'])){
        $search = $_GET['search'];
      }else{
        $search = '';
      }
      $prev_group = $page-1;
      $next_group = $page+1;
      $total_page = ceil($total_article/$view_article);
      if($page%10){
        $start_page = $page-$page%10+1;
      }else{
        $start_page = $page-9;
      }
      $end_page = $start_page + 10;

      if($page!=1){
        echo "<a class='btn btn-outline-primary' href='./index.php?page=1&search={$search}' role='button'><<</a>";
      
        if($prev_group < 1){
          $prev_group = 1;
        }
        echo "<a class='btn btn-outline-primary' href='./index.php?page={$prev_group}&search={$search}' role='button'><</a>";
      }else{
        echo "<a class='btn btn-outline-primary' href='./index.php?page=1&search={$search}' role='button'><<</a>";
      }

      for($i=$start_page; $i<$end_page; $i++){
        if($i>$total_page) break;
        if($page == $i){
          echo "<a class='btn btn-outline-primary' href='./index.php?page={$i}&search={$search}' role='button'>$i</a>";
        }else{
          echo "<a class='btn btn-outline-primary' href='./index.php?page={$i}&search={$search}' role='button'>$i</a>";
        }
      }

      if($page!=$total_page){
        $next_group = $end_page;
        if($next_group > $total_page){
          $next_group = $total_page;
        }
        echo "<a class='btn btn-outline-primary' href='./index.php?page={$next_group}&search={$search}' role='button'>></a>";
        echo "<a class='btn btn-outline-primary' href='./index.php?page={$total_page}&search={$search}' role='button'>>></a>";
      }else{
        echo "<a class='btn btn-outline-primary' href='./index.php?page={$total_page}&search={$search}' role='button'>>></a>";
      }
    ?>
    <div class="btn-group me-2" role="group" aria-label="First group">

    </div>
  </div>

</main>
<br>
<?php
    include "./page_section/footer_section.php";
?>

</body>
</html>