<?php

function getDb(){
    $dsn = 'mysql:dbname=board1_db;host=127.0.0.1;charset=utf8';
    $usr = 'dbusr1';
    $passwd = 'dbusr_pass1';

    //データベースへの接続を確立
    $db = new PDO($dsn, $usr, $passwd);  //データベースへの接続
    $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    //接続オプション⇒ERRMODE_EXCEPTION：例外を発生⇒try～catchで処理。
    return $db;
}

?>
