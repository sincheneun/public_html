<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>list</title>
    <script src="//code.jquery.com/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/view.css">
    <link rel="stylesheet" href="../css/comment.css">

</head>
<body>             

     <div class="container">     
        <table  style="padding-top:50px" align = center width=930 border=0 cellpadding=2 >
        <br><br>
            <tr>
                <td height=20>
                    <center>
                        <div class="p-3 mb-2 bg-dark text-white"><h1>게시판 글보기</h1><p>글번호 :<?=$row['board_id'];?> </p></div>
                    </center>
                </td>
            </tr>
            <tr>
                <td bgcolor=white>
                <table class = "table2">
            <tr>
                <td>제목</td>
                <td><input type="text" class="form-control classname " id="formGroupExampleInput" placeholder="<?=$row['title'];?>" readonly></td>
            </tr>
            <tr>
                <td>작성자</td>
                <td><input type = text class="classname" size=100 readonly value="<?=$row['user_name'];?>"></td>
            </tr>
            <tr>
            <tr>
                <td>작성시간</td>
                <td><input type="text" class="form-control classname " id="formGroupExampleInput" placeholder="<?=$row['reg_date'];?>" readonly></td>
            </tr>
            <tr>
                <td>조회수</td>
                <td>
                    <input type="text" class="form-control classname " id="formGroupExampleInput" placeholder="<?=hits($row['hits']);?>" readonly>
                </td>
            </tr>
            <td>내용</td>
                <td><textarea class="form-control classname col-sm-20" rows="10" name = content readonly ><?=$row['contents'];?></textarea></td>
            </tr>
            </table>
            <center>
                <!-- 목록버튼 -->
                <button type="button" class='btn btn-outline-info' onClick="location.href='<?php echo URL::list;searchGet('?');?>'">
                    글목록
                </button>
                <?php 
                    if(!loginCheck() && !loginNameCheck($row['user_name'])){
                ?>  
                    <!-- 삭제버튼 -->
                    <button type="button" class='btn btn-outline-danger' onClick="location.href='<?=URL::delete_process?>?view=<?=$_GET['view']?>'">
                        글삭제
                    </button>
                    <!-- 수정버튼 -->
                    <button type="button" class='btn btn-outline-warning' onClick="location.href='<?=URL::modify?>?view=<?=$_GET['view']?>'">
                        글수정
                    </button>
                <?php }?>    
            </center>
            </td>
            </tr>
        </table>
        </div>
<hr>
<div class="container">
    <!-- 댓글 작성 부분 -->
    <?php if(!loginCheck()){ ?>     
        <form method = "post" action = "<?=URL::comment?>">
            <div class="input-group mb-3">
                <input name="comment" type="text" class="form-control" placeholder="Comment" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary">등록</button>
                </div>
                <input type="hidden" name="username" value="<?=$_SESSION['username']?>">
                <!-- 접속 후 로그인이 안되었을 경우 다시 현재페이지 보여주기 위해 get view값을 보내줌 -->
                <input type="hidden" name="view" value="<?=$_GET['view']?>">  
                <input type="hidden" name="create" value="<?=$_GET['view']?>">  
                <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="sr-only">Password</label>
                </div> 
            </div>
        </form>
    <?php }?>    
</div>
<!-- 댓글 DB에 정보에서 현재 view값에 적은 댓글 정보를 가져옴 -->
<?php $result= DB::select(db_info::comment, "board_pid='{$_GET['view']}'", "" ); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <!-- 댓글 정보 가져오기 -->
            <?php while($row = $result->fetch_array()){ ?>
                <div class="card card-white post ">
                    <div class="post-heading">
                        <div class="float-left image">
                            <img src="http://bootdey.com/img/Content/user_1.jpg" class="img-circle avatar" 
                                alt="user profile image">
                        </div>
                        <div class="float-left meta">
                            <div class="title h5">
                                <!-- 댓글 작성자 이름 -->
                                <b><?=$row['user_name'];?></b>
                            </div>
                            <!-- 댓글 작성 시간 -->
                            <h6 class="text-muted time"><?=$row['reg_date'];?></h6>
                        </div>
                    </div> 
                    <!-- 댓글 정보 -->
                    <div class="post-description"> 
                        <p><?=$row['contents'];?></p>
                    </div>
                    <!-- 댓글 삭제버튼 -->
                    <?php if(!loginCheck() && !loginNameCheck($row['user_name'])){ ?>  
                        <form class="text-right" method = "post" action = "<?=URL::comment?>">
                            <input type="hidden" name="view" value="<?=$_GET['view']?>">
                            <input type="hidden" name="id" value="<?=$row['board_id']?>">
                            <input type="hidden" name="delete" value="<?=$_GET['view']?>">  
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="inputPassword2" class="sr-only">Password</label>
                            </div>  
                            <button class='btn btn-outline-danger'>delete</button>
                        </form>
                    <?php }?>         
                </div>
            <?php } ?>              
        </div>
    </div>
</div>

</body>
</html>


