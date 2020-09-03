<?php
//페이지네이션에 필요한 변수
function pageinfo($query, $pageNum){    //select문 , 보여줄 페이지 수
    $resultNum  = DB::select(db_info::bulletin ,$query, ''); 
    $rowTotal   = $resultNum->num_rows;  //총 열 개수
    return [
        'rowTotal'  => $rowTotal,                       
        'pageTotal' => ceil($rowTotal/$pageNum),            //페이지 총 개수
        'pageLast'  => ($rowTotal % $pageNum),              //마지막 페이지 목록 수
        'page'      => (!dataValidation($_GET, ['page']) ? $_GET['page'] : 1) //페이지 값(get없을 시 1)
    ];
}

//페이지네이션에 사용할 sql문
function pageQuery($query, $pageNum){
    $resultAll  = DB::select(db_info::bulletin ,' 1 ', ''); 
    $pageQuery = '';
    $pageinfo = pageinfo($query, $pageNum);  //pagenation에 필요한 변수 가져오기
    $pageLimit = 0;
    // //페이지 유효성 검사
    if(($pageinfo['page'] > $pageinfo['pageTotal'] || $pageinfo['page']  < 0) && !($resultAll->num_rows == 0)) 
        return location(URL::list, '없는 페이지입니다.');
    //mysql에서 가져온 목록이 한 페이지에서 보여줄 목록 수보다 클 경우에만    
    if($pageinfo['rowTotal'] > $pageNum){
        //page만큼 pageLimit값 추가(+5) 
        for($j = 1; $j < $pageinfo['page']; $j++){
            $pageLimit +=  $pageNum;
        }
        //pageLimit값에서 5 row 씩 보여주기(마지막 페이지 제외)
        if($pageinfo['pageTotal'] >= $pageinfo['page']){
            $pageQuery .= " limit $pageLimit,$pageNum";    // (시작 row ,보여줄 row 수)
            
        }
        //마지막 페이지 일 경우
        else{
            $pageQuery .= " limit $pageLimit,{$pageinfo['pageLast']}";  //보여줄 row의 수 = 총 row % 5
        }
        return $pageQuery;
    }
    return $pageQuery;

}
//페이지 버튼
//인자값 블럭 수, query문, page당 row수
function block($blockNum, $query, $pageNum){  
    
    $pageinfo = pageinfo($query, $pageNum);                     //페이지 정보 가져오기
    $block_list = $blockNum;                                    //페이지 마다 보여줄 페이지 버튼 수
    $block =  ceil($pageinfo['page']/$block_list);              //현재 리스트의 블럭
    $block_total = ceil($pageinfo['pageTotal']/$block_list);    //블럭의 총 개수
    $blockTotal = $pageinfo['pageTotal'];                       //페이지 총 개수
    $blockStart = (($block - 1) * $block_list) + 1;             //현재 블럭에서 시작페이지 번호
    $blockEnd = $blockStart + $block_list - 1;                  //현재 블럭에서 마지막 페이지 번호    
    if ($blockEnd > $blockTotal) $blockEnd = $blockTotal;       //블럭의 마지막 페이지가 총 페이지 수보다 클 때
   ;
    if($pageinfo['page'] != 1){
    ?>
        <li class="page-item">
            <a class="page-link" href="<?=URL::list?>?page=1<?=searchCheck()?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
    <?php
        }
    ?>
    <?php
        if($block > 1){ //block이 1보다 클때 보여주기
    ?>
        <li class="page-item">
            <a class="page-link" href="<?=URL::list?>?page=<?=$blockStart-1?><?=searchCheck()?>" aria-label="Previous">
                <span aria-hidden="true">&#60;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
    <?php
        }
    ?>
    <?php    
        //페이지 버튼 
        for($i = $blockStart; $i <= $blockEnd ; $i++){ 
            //현재 페이지 버튼 비활성화
            if($i == $pageinfo['page']){
        ?>  
            <li class="page-item active">
                <span class="page-link"><?=$i?><span class="sr-only">(current)</span></span>
            </li>
            <?php
                }else{ 
            ?>    
                <li class="page-item"><a class="page-link" href="<?=URL::list?>?page=<?=$i?><?=searchCheck()?>"><?=$i?></a></li>
        <?php
                }
        }
    ?>
    <?php 
        if($block < $block_total){ //bock이 총 block갯수보다 작을때만 보여주기
    ?>
            <li class="page-item">
                <a class="page-link" href="<?=URL::list?>?page=<?=$blockEnd+1?><?=searchCheck()?>" aria-label="Next">
                    <span aria-hidden="true">&#62;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
    <?php       
        }
    ?>
    <?php 
        if($pageinfo['page'] != $pageinfo['pageTotal']){
    ?>
            <li class="page-item">
                <a class="page-link" href="<?=URL::list?>?page=<?=$pageinfo['pageTotal']?><?=searchCheck()?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
    <?php       
        }
}

?>
