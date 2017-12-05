<?php
class use_db{
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

    function insert_contribution($sql, $contents){
        try{
            $connect = $this -> getDb();
            $connect -> beginTransaction();
            $ins = $connect -> prepare($sql);
            $ins -> bindValue(':usercontents', $contents);
            $ins -> execute();
            $connect -> commit();
        }catch(PDOException $e){
            $connect -> rollback();
            die("INSERTエラー：{$e -> getMessage()}");
        }
    }


    function insert_user($sql, $user_name, $user_pass){
        try{
            $connect = $this -> getDb();
            $connect -> beginTransaction();
            $ins = $connect -> prepare($sql);
            $ins -> bindValue(':username', $user_name);
            $ins -> bindValue(':userpass', $user_pass);
            $ins -> execute();
            $connect -> commit();
        }catch(PDOException $e){
            $connect -> rollback();
            die("INSERTエラー：{$e -> getMessage()}");
        }

    }

    function Select($sql){
        try{
            $connect = $this -> getDb();
            $out = $connect -> prepare($sql);
            $out -> execute();
        }catch(PDOException $e){
            $connect -> rollback();
            die("SELECTエラー：{$e -> getMessage()}");
        }

    }

}

?>