<?php

require_once 'DbManager2.php';
require_once 'Encode.php';


function insert_contribution($contents, $user_id){
    try{

        $db = GetDb();
        $statement = 'INSERT INTO post_table(contents, user_id, time) VALUES(?, ?, ?)';
        $datetime = new DateTime();
        $db -> beginTransaction();
        $time = $datetime -> format('Y年m月d日 H:i:s');
        $ins = $db -> prepare($statement);
        $ins -> bindValue('1', $contents);
        $ins -> bindvalue('2', $user_id);
        $ins -> bindvalue('3', $time);
        $ins -> execute();
        $db -> commit();
    }catch(PDOException $e){
        $db -> rollback();
        die("INSERTエラー：{$e -> getMessage()}");
    }
}

function Update_Contribution($contents, $user_id){
    try{
        $db = GetDb();
        $statement = 'UPDATE post_table SET contents = ?, user_id = ?';
        $db -> beginTransaction();
        $ins = $db -> prepare($statement);
        $ins -> bindValue('1', $contents);
        $ins -> bindvalue('2', $user_id);
        $ins -> execute();
        $db -> commit();
    }catch(PDOException $e){
        $db -> rollback();
        die("UPDATEエラー：{$e -> getMessage()}");
    }
}

function Delete_Contribution($contents, $user_id){
    try{
        $db = GetDb();
        $statement = 'DELETE FROM post_table WHERE contents = ? AND user_id = ?';
        $db -> beginTransaction();
        $ins = $db -> prepare($statement);
        $ins -> bindValue('1', $contents);
        $ins -> bindvalue('2', $user_id);
        $ins -> execute();
        $db -> commit();
    }catch(PDOException $e){
        $db -> rollback();
        die("DELETEエラー：{$e -> getMessage()}");
    }
}

function Display_Contribution(){
    try{
        $db = GetDb();
        $statement = 'SELECT * FROM post_table INNER JOIN member_table ON post_table.user_id = member_table.id';
        $sel = $db -> prepare($statement);
        $sel -> execute();
        $fetchAll = $sel -> fetchAll(PDO::FETCH_ASSOC);
        if(!(empty($fetchAll))){
            foreach($fetchAll as $data){
                $name = e($data['name']);
                $contents = e($data['contents']);
                $time = $data['time'];
                print("{$name}　さんの投稿　");
                echo($time);
                echo nl2br("\n");
                echo(nl2br(e($contents)));
                echo nl2br("\n\n");
            }
        }
    }catch(PDOException $e){
        $db -> rollback();
        die("エラーメッセージ：{$e -> getMessage()}");
    }
}

function Display_Mycontribution($user_id){
    try{
        $db = GetDb();
        $statement = 'SELECT post_table.id, contents, user_id, time, name FROM post_table INNER JOIN member_table ON post_table.user_id = member_table.id WHERE user_id = ?';
        $sel = $db -> prepare($statement);
        $sel -> bindValue('1', $user_id);
        $sel -> execute();
        $fetchAll = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $cnt =1;
        if(!(empty($fetchAll))){
            foreach($fetchAll as $data){
                $contents = e($data['contents']);
                $time = $data['time'];
                echo($cnt.".　");
                echo('-'.$time.'-');
                echo nl2br("\n");
                echo(nl2br(e($contents)));
                echo nl2br("\n\n");
                $cnt++;
            }
        }
    }catch(PDOException $e){
        die("エラーメッセージ：{$e -> getMessage()}");
    }

}
