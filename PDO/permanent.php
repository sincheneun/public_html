<?php
class DbConf{
    const USER = "root";
    const PASSWORD = "autoset";
}
try {
    //DBNS와의 연결을 caching 화. 현 PHP 문서 종료 시 연결을 종료하지 않고 유지
    //동일한 DBMS & DB 사용 시 이전에 연결한 DB 연결을 재활용 -> 시스템 성능 향상 
    $db_conn = new PDO("mysql:host=localhost;dbname=yjc_test",DbConf::USER,DbConf::PASSWORD,
                        array(PDO::ATTR_PERSISTENT => true)); // array(PDO::ATTR_PERSISTENT => true)
} catch(PDOException $e) {
    echo $e->getMessage();
} catch(Exception $e){
    echo $e->getMessage();
}