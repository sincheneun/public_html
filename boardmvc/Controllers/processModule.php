<?php

trait processModule {  
    public function write_process(){
        if(loginCheck()) //login시만 접속 가능
            location(URL::login, '로그인 후 사용해주세요');
        //post값 중 하나라도 공백일 경우 메시지 출력 후 글쓰기 페이지로 돌아감 
        else if((dataValidation($_POST, ['title', 'name', 'content'])))
            location(URL::write, '입력 값 누락');    
        else{
            $insertData = dataHtmlspecialchars($_POST, ['title', 'name', 'content']); //html태그 체크
            DB::create(db_info::bulletin , [
                'title'     => $insertData['title'], 
                'user_name' => $insertData['name'], 
                'contents'  => $insertData['content']
            ]);
            //입력이 완료 후 목록 페이지 이동
            location(URL::list, '입력되었습니다'); 
        }   
    }

    public function modify_process(){
        if(!isset($_POST['view']))
            throw new Exception("<h1>Not found</h1>");
        $row = viewRow($_POST['view']);
        if(loginCheck()) //login시만 접속 가능
            location(URL::list, '로그인 후 사용해주세요');
        else if(loginNameCheck($row['user_name']))  //로그인한 유저와 작성자 일치 확인
            location(URL::view . "?view={$_POST['view']}" , '접근권한이 없습니다.');
        //post값 isset과 공백 검사
        else if((dataValidation($_POST, ['title', 'name', 'content'])))
            location(URL::view . "?view={$_POST['view']}", '입력 값 누락');
        else{
            $updateData = dataHtmlspecialchars($_POST, ['title', 'name', 'content']); //html태그 체크
            //db에 전송할 update문 전송, 실패시 에러
            DB::update($_POST['view'], [
                'title'     => $updateData['title'], 
                'contents'  => $updateData['content']
            ]);
            //수정이 완료 후 글보기 페이지 이동
            location(URL::view."?view={$_POST['view']}", '입력되었습니다'); 
        }
    }
    
    public function delete_process(){
        if(!isset($_GET['view']))
            throw new Exception("<h1>Not found</h1>");
        $row = viewRow($_GET['view']);
        if(loginCheck()) //login시만 접속 가능
            location(URL::list, '로그인 후 사용해주세요');
        else if(loginNameCheck($row['user_name']))  //로그인한 유저와 작성자 일치 확인
            location(URL::view . "?view={$_GET['view']}" , '접근권한이 없습니다.');
        //db에 저장된 비빌번호를 복호화하여 입력한 비밀번호와 일치하는지 확인, 불일치시 글보기 페이지 이동
        else{
            DB::delete(db_info::bulletin, $_GET['view']);
            DB::delete(db_info::comment, $_GET['view']);
            //삭제 완료 후 list 페이지 이동
            location(URL::list, '삭제되었습니다'); 
        }
    }

    public function commnet_process(){
        if(!isset($_POST['view']))
            throw new Exception("<h1>Not found</h1>");
        //db에 post로 받은 view값과 board_id값이 같은 열 찾기 
        $row = viewRow($_POST['view']);
        if(loginCheck()) //login시만 접속 가능
            location(URL::list, '로그인 후 사용해주세요');
        else if(isset($_POST['create'])){
            if(dataValidation($_POST, ['comment'])){ 
                location(URL::view . "?view={$_POST['view']}", '댓글을 입력해주세요.');
            }
            else {
                $insertData = dataHtmlspecialchars($_POST, ['comment']); //html태그 체크
                DB::create(db_info::comment , [
                    'board_pid' => $_POST['view'], 
                    'user_name' => $_POST['username'], 
                    'contents'  => $insertData['comment']
                ]);
                location(URL::view . "?view={$_POST['view']}", '입력되었습니다.');    
            }
        }
        else if(isset($_POST['delete'])){
            if(loginNameCheck($row['user_name']))  //로그인한 유저와 작성자 일치 확인
                location(URL::view . "?view={$_POST['view']}" , '접근권한이 없습니다.');
            else{
                //삭제버튼을 눌렀을 때 넘어오는 id값으로 삭제
                DB::delete(db_info::comment, $_POST['id']);
                location(URL::view . "?view={$_POST['view']}", '삭제 되었습니다.');
            }
        }else 
            location(URL::view . "?view={$_POST['view']}" , '접근권한이 없습니다.');    

    }
}

?>