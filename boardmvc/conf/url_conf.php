<?php
class URL{
    const Model             = "Model/boardModel.php";//CRUD 
    const util              = "util/util.php";       //모듈  util.php
    const pagination        = "util/pagination.php";

    const write             = "write";             //글쓰기 페이지
    const list              = "list";              //목록 페이지
    const view              = "view";              //글보기 페이지
    const modify            = "modify";            //글수정 페이지

    const write_process     = "write_process";     //DB 글 삽입
    const modify_process    = "modify_process";    //DB 글 수정
    const delete_process    = "delete_process";    //글삭제 DB전송 페이지
    const comment           = "comment_process";    //글삭제 DB전송 페이지

    const login             = "login";             //DB 로그인 
    const logout            = "logout";            //로그아웃 페이지

    const list_template     = "views/list_template.php";   //리스트 view 
    const modify_template   = "views/modify_template.php"; //글수정 view 
    const view_template     = "views/view_template.php";   //글보기 view 
    const write_template    = "views/write_template.php"; //글쓰기 view  
    
    const mainModule        = "Controllers/mainModule.php";
    const processModule     = "Controllers/processModule.php";
    const authModule        = "Controllers/authModule.php";    
}

?>
