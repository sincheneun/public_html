<?php 
require_once('db_util.php');
// aa
class DB{
    //DB 게시글 삽입
    public static function create($table , $insterts){
        $conn = DB();
        $query = "INSERT INTO ". $table . "(";
        $queryValue = "VALUES (";
        foreach($insterts as $key => $value){
            $query .= "`$key`,";
            $queryValue .= "'$value', ";
        }
        $query .= "`reg_date`)"; 
        $queryValue .= "now())";
        if(!($conn->query($query . $queryValue))){
            throw new Exception("시스템 오류, 관리자에게 연락 바랍니다.");
        }    
    }

    //DB 테이블 검색 
    public static function select($table, $where, $page){
        $conn = DB();
        $query = "select * from `$table` where $where order by board_id desc $page";
        if(!($result = $conn->query($query))){
            throw new Exception("시스템 오류, 관리자에게 연락 바랍니다.");
        }
        return $result;
    }

    //DB 게시글 업데이트
    public static function update($id , $updates){
        $conn = DB();
        $query = "UPDATE ". db_info::bulletin . " set ";

        foreach($updates as $key => $value){
            $query .= "`$key`= '$value',";
        }
        $query .= "`reg_date`=now() where board_id = ". $id;
        if(!($conn->query($query))){
            throw new Exception("시스템 오류, 관리자에게 연락 바랍니다.");
        }   
    }
    //DB 조회수 업데이트
    public static function updateHits($id){
        $conn = DB();
        $query = "update ".db_info::bulletin . " set hits=hits+1 where board_id=" . $id;
        if(!($conn->query($query))){
            throw new Exception("시스템 오류, 관리자에게 연락 바랍니다.");
        }
    }

    //DB 삭제
    public static function delete($table, $id){
        $conn = DB();
        $query = "DELETE FROM `$table` WHERE board_id =". $id;
        if(!($conn->query($query))){
            throw new Exception("시스템 오류, 관리자에게 연락 바랍니다.");
        }
    }
}



?>