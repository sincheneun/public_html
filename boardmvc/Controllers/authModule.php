<?php
trait authModule {  
    public function login(){
        $auth = DB::select(db_info::user_info, '1' , '');
        //post로 id값과 password값을 받았는지 확인 
        if(!dataValidation($_POST, ['username', 'password'])){  
            //db의 레코드 정보를 배열로 저장하여 열마다 반복
            while($row = $auth->fetch_assoc()){
                //db에 회원정보가 일치하면 session에 값 저장
                if($_POST['username'] == $row['id'] && $_POST['password'] == $row['password']){
                    $_SESSION['username'] = $row['name'];
                    $_SESSION['password'] = $_POST['password']; 
                    location(URL::list , '로그인되었습니다.');
                    break;
                }
            }
            if(loginCheck()){
                location(URL::list , '로그인에 실패하였습니다.');
            }
        }    
    }

    public function logout(){
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        location(URL::list , '로그아웃 되었습니다.');
    }
}
?>