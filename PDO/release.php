<?php
class DbConf{
    const USER = "root";
    const PASSWORD = "autoset";
}
try {
    $db_conn = new PDO("mysql:host=localhost;dbname=yjc_test",DbConf::USER,DbConf::PASSWORD);
} catch(PDOException $e) {
    echo $e->getMessage();
} catch(Exception $e){
    echo $e->getMessage();
}

//PDO 연결 종료: 생성된 PDO 객체가 소멸되면 DBMS와의 연결도 종료된다.
//고찰 : PHP 파일 실행이 종료 되면 GC에 의해 자동으로 PDO 객체가 소멸된다.
//      따라서 명시적으로 DBMS와 연결해제 이외에는 사용할 이유가 없다
$db_conn = null; //PDO 객체 소멸 -> DBMS와의 연결 해제