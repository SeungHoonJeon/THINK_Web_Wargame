<div class="container">
  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1">
        <a class="blog-header-logo text-dark" href="/"><img src="./img/동아리로고-removebg-preview.png" width="100" height="50"></a>
      </div>
      <div class="col-6 d-flex justify-content-end align-items-center">
        <?php
          if(!empty($_SESSION['name'])){
            echo "안녕하세요.  "."<b>".$_SESSION['name']."</b>"."님&nbsp;<hr>";
            echo "<a class='btn btn-outline-primary' href='./insert.php' role='button'>개인정보 수정</a>";
            echo "<a class='btn btn-outline-primary' href='./action.php?mode=logout' role='button'>로그아웃</a>";
          }else{
            ?>
            <a class="btn btn-sm btn-outline-secondary" href="login.html">Sign in</a>
            <?php
          }
        ?>
        
      </div>
    </div>
  </header>

  <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
        <a class="p-2 link-secondary" href="#"></a>
        <a class="p-2 link-secondary" href="active.php">활동</a>
        <a class="p-2 link-secondary" href="member.php">멤버</a>
        <a class="p-2 link-secondary" href="#" onclick="alert('과거 think 자료들 모으는 곳. 준비중')">자료실</a>
        <a class="p-2 link-secondary" href="study.php">스터디</a>
        <a class="p-2 link-secondary" href="research.php">연구 활동</a>
        <a class="p-2 link-secondary" href="board.php?page=1">자유게시판</a>
        <a class="p-2 link-secondary" href="#" onclick="alert('준비중')">상점</a>
        <a class="p-2 link-secondary" href="#"></a>
    </nav>
  </div>
</div>
