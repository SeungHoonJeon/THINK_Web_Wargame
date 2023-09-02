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
      <h1 class="display-10 fst-italic">THINK 이용</h1>
      <p class="lead my-3">THINK 동아리가 해온 것을 하나하나 서비스화 시켜서 모두가 이용할 수 있도록 하고 있습니다.</p>
      <p class="lead mb-0"><a href="#" class="text-success fw-bold">THINK 동아리 가입문의</a></p>
    </div>
</div>
  <div class="row mb-2">
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-success">hacking zone</strong>
          <h3 class="mb-0">취약점 진단 연습</h3><br>
          <div class="mb-1 text-muted">[소개]</div>
          <p class="card-text mb-auto">Think 자체 취약한 웹사이트로 취약점을 찾아보세요 :)</p>
          <a href="" onclick="alert('서버 쓰기 적합한 PC 찾는중. 지금은 회장님께 연락하면 열어드립니다.')" class="stretched-link">Let's go</a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-success">Monitor</strong>
          <h3 class="mb-0">관제 모니터실</h3><br>
          <div class="mb-1 text-muted">[소개]</div>
          <p class="mb-auto">Think 자체 취약한 웹사이트를 공격하고 공격 로그를 실시간으로 확인해보세요 :)</p>
          <a href="" onclick="alert('서버 쓰기 적합한 PC 찾는중. 지금은 회장님께 연락하면 열어드립니다.')" class="stretched-link">Let's go</a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>

        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-success">service</strong>
          <h3 class="mb-0">동명대 학식이</h3><br>
          <div class="mb-1 text-muted">[소개]</div>
          <p class="card-text mb-auto">학교 정보 및 언론 정보를 카카오톡 봇으로 쉽게 파악해보세요 :)</p>
          <a href="" onclick="alert('카카오톡 ID:sg10840을 추가해보세요 :)')" class="stretched-link">Let's go</a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-success">event</strong>
          <h3 class="mb-0">월별 이벤트</h3><br>
          <div class="mb-1 text-muted">[소개]</div>
          <p class="mb-auto">매년 교내,대외에 어떤 행사가 일어나는지 확인해보세요 :)</p>
          <a href="" onclick="alert('동명대 학식이한테 물어보시면 됩니다.!')" class="stretched-link">Let's go</a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
        </div>
      </div>
    </div>
</main>

<?php
    include "./page_section/footer_section.php";
?>

</body>
</html>