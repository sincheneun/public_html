<?php
class DbConf{
    const USER = "root";
    const PASSWORD = "autoset";
}
try {
    //PDO를 이용 localhost DBMS 접속, 사용자 : root, 패스워드 : autoset
    //'mysql:host=localhost;port=3306;dbname=yjc_test' : DBMS로 myslq사용 의미
    $db_conn = new PDO("mysql:host=localhost;dbname=yjc_test",DbConf::USER,DbConf::PASSWORD);
} catch(PDOException $e) {
    //연결 실패 시 PDOException 예외 발생
    echo "PDOException 예외 발생<br>";
    echo $e->getMessage();
} catch(Exception $e){
    echo $e->getMessage();
}