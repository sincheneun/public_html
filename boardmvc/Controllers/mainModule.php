<?php

trait mainModule {  
    public function list(){
        require_once(URL::pagination);
        if(!dataValidation($_GET, ['select', 'search']))
            $search = search(
                "{$_GET['select']}",
                ['title','user_name','contents','titleOrContents'],
                "{$_GET['search']}"
            );
        else 
            $search = "1";
            
        $page  = pageQuery($search, 5); //limt sql문 추가
        $result = DB::select(db_info::bulletin, $search , $page);
        require_once(URL::list_template);
    }
    public function write(){
        if(loginCheck()) //login시만 접속 가능
            location(URL::login, '로그인 후 사용해주세요');
        else    
            require_once(URL::write_template);
    }

    public function view(){
        if(!isset($_GET['view']))
            throw new Exception("<h1>Not found</h1>");
        $row = viewRow($_GET['view']);
        require_once(URL::view_template);   
    }

    public function modify(){
        if(!isset($_GET['view']))
            throw new Exception("<h1>Not found</h1>");
        $row = viewRow($_GET['view']);
        if(loginCheck()) //login시만 접속 가능
            location(URL::list, '로그인 후 사용해주세요');
        else if(loginNameCheck($row['user_name']))  //로그인한 유저와 작성자 일치 확인
            location(URL::view . "?view={$_GET['view']}" , '접근권한이 없습니다.');
        else    
            require_once(URL::modify_template);   
    }
}


?>