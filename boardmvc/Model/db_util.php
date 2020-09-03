<?php
require_once('db_conf.php');
//db연결 
function DB(){
    $conn = new mysqli(db_info::db_url, db_info::user_id, db_info::passwd, db_info::db);
    //db연결 확인
    if($conn ->connect_errno){
        throw new Exception("시스템 오류, 관리자에게 연락 바랍니다.");
    }
    return $conn; 
}
?>