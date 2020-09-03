<?php
require_once('db_conf.php');
//db연결 
function DB(){
    $dsn = "mysql:host=".db_info::db_url.";port=3306;dbname=".db_info::db.";charset=utf8";

    try {
        $db = new PDO($dsn, db_info::user_id, db_info::passwd);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "데이터베이스 연결 성공!!<br/>";
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
    return $db;
}
?>