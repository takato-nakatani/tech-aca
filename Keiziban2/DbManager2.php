<?php
    //----------　DB接続の外部ファイル　----------

    function GetDb(){
        try{
            $dsn = 'mysql:dbname=board2_db;host=127.0.0.1;charset=utf8';
            $usr = 'dbusr2';
            $passwd = 'dbusr_pass2';

            //データベースへの接続を確立
            $db = new PDO($dsn, $usr, $passwd);  //データベースへの接続
            $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    //接続オプション⇒ERRMODE_EXCEPTION：例外を発生⇒try～catchで処理。
            return $db;

        }catch(PDOException $e){
            die("接続エラー：{$e -> getMessage()}");
        }
    }










?>