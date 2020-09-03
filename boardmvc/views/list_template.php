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
    <style>
        form{display:inline}     
    </style>
</head>
<body>
<div class="container">
<?php require_once('views/nav.php'); ?>
<table id="names" class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col"><center>번호</center></th>
            <th scope="col"><center>타이틀</center></th>
            <th scope="col">작성자</th>
            <th scope="col">조회수</th>
            <th scope="col">날짜</th>
        </tr>
    </thead>
    <?php while($row = $result->fetch_array()){ ?>
        <tr class='input' id='<?=$row['board_id']?>' style='cursor: pointer'>
        <td width='100'><center><?=$row['board_id']?></center></td> 
        <td width='400'><center><?=$row['title']?></center></td> 
        <td><?=$row['user_name']?></td> 
        <td><?=$row['hits']?></td>                          
        <td><?=date( 'Y-m-d', strtotime($row['reg_date']))?></td>        
        </tr>
        <?php }?>
</table>
    <center>
        <?php if(!loginCheck()){ ?>    
            <button class='btn btn btn-primary btn-lg' onClick="location.href='<?=URL::write?>'">글쓰기</button>
        <?php }?>
        
        <br><br>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <!-- page 버튼 -->
                <?php block(3, $search, 5); ?>
            </ul>
        </nav>
    </center>
    <!-- 검색버튼 -->
    <form class="form-inline my-2 my-lg-0 justify-content-center" method="get">
        <select id="inputState" class="form-control" name="select">
            <option value="title">제목</option>
            <option value="contents">내용</option>
            <option value="user_name">작성자</option>
            <option value="titleOrContents">제목 + 내용</option>
        </select>
        <input class="form-control mr-sm-2" type="search" placeholder="search" aria-label="Search" name="search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        <button class="btn btn-outline-primary" type="button" onClick="location.href='<?=URL::list?>'">Reset</button>
    </form>
    
    </div>
    <script>
        //tr태그 각각 hover 효과
        $('.input').hover(
            function(){
                $(this).css('box-shadow', '0 0 10px rgb(0, 0, 0, 0.5)');
            },
            function(){
                $(this).css('box-shadow', 'none');
            }  
        );
        <?php $result = DB::select(db_info::bulletin, '1', "") ?>;
        <?php while($row = $result->fetch_array()){ ?>
            $('#<?=$row['board_id']?>').click(function(){
                location.href = '<?=URL::view?>?view=<?php echo $row['board_id']; searchGet('&');?>';
            });
        <?php }?>    
    </script>
    
</body>
</html>