<nav class="navbar navbar-expand-lg navbar-light bg-light" >
  <a class="navbar-brand" href="<?=URL::list?>">게시판</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="<?=URL::list?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">공지사항</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">자유게시판</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          공유게시판
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">노래</a>
          <a class="dropdown-item" href="#">이미지</a>
          <a class="dropdown-item" href="#">영상</a>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
    <?php if(!loginCheck()){ ?>
          <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <?=$_SESSION['username']?>님 환영합니다
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">회원정보</a>
          <a class="dropdown-item" href="<?=URL::logout?>">로그아웃</a>
        </div>
      </li>
      <?php }else{ ?>
          <form action="<?=URL::login?>" method="post">
              <fieldset style ="with:300px">
                  ID : <input type="text" name="username">
                  암호 :  <input type="password" name="password">
                  <input type="submit" value="로그인하기">
              </fieldset>
          </form>      
      <?php }?>
  </div>
</nav>