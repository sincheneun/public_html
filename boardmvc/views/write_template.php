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
        <form method = "post" action="<?=URL::write_process?>">
        <table  style="padding-top:50px" align = center width=930 border=0 cellpadding=2 >
        <br><br>
            <tr>
                <td height=20>
                    <center>
                        <div class="p-3 mb-2 bg-dark text-white">게시판 글작성</div>
                    </center>
                </td>
            </tr>
            <tr>
                <td bgcolor=white>
                <table class = "table2">
            <tr>
                <td>제목</td>
                <td><input type="text" name = title class="form-control" id="formGroupExampleInput" placeholder="title"></td>
            </tr>
            <tr>
                <td>작성자</td>
                <td><input type = text name = name size=100 readonly value="<?=$_SESSION['username']?>"></td>
            </tr>
            <tr>
            <td>내용</td>
                <td><textarea class="form-control col-sm-20" rows="10" name = content></textarea></td>
            </tr>
            </table>
            <center>
                <input class='btn btn-outline-success' type = "submit" value="작성">
                <button type="button" class='btn btn-outline-info' onClick="location.href='<?=URL::list?>'">목록</button>
            </center>
            </td>
            </tr>
        </table>
        </form>
        </div>
</body>
</html>


