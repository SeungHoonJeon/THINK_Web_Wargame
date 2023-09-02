<?php
  include "./config/session_config.php";
?>
<!DOCTYPE html>
<html lang="ko">
  <?php include "./page_section/headtag_section.php"?>
<body>
    
<?php include "./page_section/header_section.php"?>

<main class="container">
    <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
        <div class="col-md-6 px-0">
            <h1 class="display-10 fst-italic">THINK 학술 동아리</h1>
            <p class="lead my-3">1999년도에 설립되었고 해킹 및 보안뿐만 아니라 다양한 IT 분야를 공부하는 학술 동아리입니다.</p>
            <p class="lead mb-0"><a href="#" class="text-success fw-bold">THINK 동아리 가입문의</a></p>
        </div>
    </div>

    <?php
        include "./lib/simple_html_dom.php";
        include "./crawling/page_crawing.php";
    ?>
    <div class="row mb-2">
        <div class="col-md-6">
          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static" style="overflow-y:scroll; width:500px; height:300px;">
              <strong class="d-inline-block mb-2"><a class="text-success" target="_blank" href="https://www.boannews.com/media/t_list.asp" class="stretched-link">보안뉴스</a></strong>
              <p class="card-text mb-auto"><?php secNew();?></p>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static" style="overflow-y:scroll; width:500px; height:300px;">
              <strong class="d-inline-block mb-2 text-success"><a class="text-success" target="_blank" href="http://tusw.tu.ac.kr/pages/main.htm" class="stretched-link">sw 사업단 공지</a></strong>
              <p class="card-text mb-auto"><?php sw();?></p>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static" style="overflow-y:scroll; width:500px; height:300px;">
              <strong class="d-inline-block mb-2 text-success"><a class="text-success" target="_blank" href="https://media.naver.com/press/022/ranking" class="stretched-link">실시간 인기뉴스</a></strong>
              <p class="card-text mb-auto"><?php rankNew();?></p>
              
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static" style="overflow-y:scroll; width:500px; height:300px;">
              <strong class="d-inline-block mb-2 text-success"><a class="text-success" target="_blank" href="https://trends.google.co.kr/trends/trendingsearches/daily?geo=KR" class="stretched-link">실검</a></strong>
              <p class="card-text mb-auto"><?php rankSearch();?></p>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
              <strong class="d-inline-block mb-2 text-success">오늘의 학식</strong>
              <p class="card-text mb-auto">점검중</p>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
              <strong class="d-inline-block mb-2 text-success">학교 공지</strong>
              <p class="card-text mb-auto">점검중</p>
            </div>
          </div>
        </div>
    </div>    
</main>
<?php
    include "./page_section/footer_section.php";
?>

</body>
</html>

