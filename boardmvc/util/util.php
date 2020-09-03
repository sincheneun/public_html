<?php 
//get, post값 isset과 공백 검색
function dataValidation($data , $valueArray){
    foreach($valueArray as $value){
        if(!isset($data[$value]) || $data["$value"] == '')
            return true;
    }
    return false;
}  

//메시지 출력 후 페이지 이동 
function location($URL , $message){
    echo "<script>alert('$message');location.href='".$URL."';</script>";
}   



//insert, update 값을 html검사
function dataHtmlspecialchars($data, $valueArray){
    $HtmlCheckData = [];
    foreach($valueArray as $value){
        $HtmlCheckData["$value"] = htmlspecialchars($data["$value"] , ENT_QUOTES);
    }
    return $HtmlCheckData;
}

//검색 기능
function search($select, $selectArray, $searchValue){
    foreach($selectArray as $value){
        if($select == $value)
            return " $value LIKE '%$searchValue%'";
        else if($select == 'titleOrContents'){
            return " title LIKE '$searchValue%' or contents LIKE '$searchValue'";
        }
    }
}
//해당 열 반환
function viewRow($id){
    //board_id값을 받아 query문 실행
    $result = DB::select(db_info::bulletin, "board_id = $id", "");
    //data(get or post)에 없는 board_id값을 넣었을 때 list페이지로 이동
    if($result->num_rows == 0){
        location(URL::list ,'없는 페이지입니다');
    }
    //data(get or post)값으로 받은 열을 정보를 가져옴
    return $row = $result->fetch_array();
}


//로그인 확인
function loginCheck(){
    if(!(isset($_SESSION['username']) && isset($_SESSION['password']))) {
        return true;
    } 
    return false;
}

//로그인 회원정보와 작성자 일치 확인
function loginNameCheck($username){
    if(!($_SESSION['username'] == $username)){
        return true;
    }
    return false;
}

function hits($hits){
    //세션이 존재하지 않을 경우 세션생성 후 db없데이트
    if(!isset($_SESSION["hits{$_GET['view']}"])){
        DB::updateHits($_GET['view']);
        $_SESSION["hits{$_GET['view']}"] = 1;
        return $hits+1;
    //세션이 존재할 경우 db의 조회수 출력     
    }else{
        return $hits;
    }
}


//list에서 view이동, view에서 list이동 할 때 get값 유지
function searchGet($i){
    if(isset($_GET['page'])){ echo $i."page={$_GET['page']}";}else {echo $i."page=1"; }
    if(isset($_GET['select'])){ echo "&select={$_GET['select']}";}
    if(isset($_GET['search'])){ echo "&search={$_GET['search']}";}
}

//페이지네이션 + 검색
function searchCheck(){
    if(isset($_GET['search']) && isset($_GET['select'])){
        return "&select={$_GET['select']}&search={$_GET['search']}";
    }
}

?>