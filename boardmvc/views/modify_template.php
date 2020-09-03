
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
    <link rel="stylesheet" href="../css/write.css">
</head>
<body>               
     <div class="container">
     <form method = "post" action = "<?=URL::modify_process?>">
        <table  style="padding-top:50px" align = center width=930 border=0 cellpadding=2 >
        <br><br>
            <tr>
                <td height=20>
                    <center>
                        <div class="p-3 mb-2 bg-dark text-white"><h1>게시판 글수정</h1><p>글번호 :<?=$row['board_id'];?>
                         </p></div>
                    </center>
                </td>
            </tr>
            <tr>
                <td bgcolor=white>
                <table class = "table2">
            <tr>
                <td>제목</td>
                <td>
                    <input type="text" class="form-control" name="title" id="formGroupExampleInput" value="<?=$row['title'];?>">
                </td>
            </tr>
            <tr>
                <td>작성자</td>
                <td><input type = text size=100 name="name" readonly value="<?=$row['user_name'];?>"></td>
            </tr>
            <tr>
            <td>내용</td>
                <td><textarea class="form-control col-sm-20" rows="10" name = content  ><?=$row['contents'];?></textarea></td>
            </tr>
            <input type="hidden" name="view" value="<?=$_GET['view']?>">
            </table>
            
            <center>

            <button class="btn btn-lg btn-primary">수정하기</button>

            <br><br>
                <!-- 목록버튼 -->
                <button type="button" class='btn btn-outline-info' onClick="location.href='<?=URL::list?>'">글목록</button>
                <!-- 글보기버튼 -->
                <button type="button" class='btn btn-outline-success' onClick="location.href='<?=URL::view?>?view=<?=$_GET['view']?>'">
                    글보기
                </button>
            </center>
            </td>
            </tr>
        </table>
        </form>

        </div>

</body>
</html>


