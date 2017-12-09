<?php

require_once 'DbManager2.php';

function Insert_User($user_name, $user_pass){
    try{

        $connect = GetDb();
        $statement = 'INSERT INTO member_table(name, password) VALUES(?, ?)';
        $connect -> beginTransaction();
        $ins = $connect -> prepare($statement);
        $ins -> bindValue('1', $user_name);
        $ins -> bindValue('2', $user_pass);
        $ins -> execute();
        $connect -> commit();
    }catch(PDOException $e){
        $connect -> rollback();
        die("INSERTエラー：{$e -> getMessage()}");
    }
}


function Duplication_Check($name, $pass){
    try{
        $db = GetDb();
        $statement = 'SELECT * FROM member_table WHERE name = ? AND password = ?';
        $sel = $db -> prepare($statement);
        $sel -> bindValue(1 , $name);
        $sel -> bindValue(2 , $pass);
//        $statement = "SELECT * FROM member_table WHERE name = '$name' AND password = '$pass'";
//        $sel = $db -> prepare($statement);
        $sel -> execute();

        $ResultSet = $sel -> fetchAll(PDO::FETCH_ASSOC);
        if(!(empty($ResultSet))){
            foreach($ResultSet as $data){

                if($data['name'] === $name && $data['password'] === $pass){
                    echo('このユーザ名は使用できません。');
                    return false;
                }else{
                    return true;
                }
            }

        }else{
            return true;
        }


    }catch(PDOException $e){
        die("認証エラー：{$e -> getMessage()}");
    }
}

function Login_Certification($name, $pass){
    try{


        $db = GetDb();
        $statement = 'SELECT * FROM member_table WHERE name = ? AND password = ?';
        $sel = $db -> prepare($statement);
        $sel -> bindValue(1 , $name);
        $sel -> bindValue(2 , $pass);
//        $statement = "SELECT * FROM member_table WHERE name = '$name' AND password = '$pass'";
//        $sel = $db -> prepare($statement);
        $sel -> execute();

        $ResultSet = $sel -> fetchAll(PDO::FETCH_ASSOC);
        if(!(empty($ResultSet))){
            foreach($ResultSet as $data){

                if($data['name'] === $name && $data['password'] === $pass){
                    $_SESSION['id'] = $data['id'];
                    return true;
                }else{
                    return false;
                }
            }

        }else{
            return false;
        }


        }catch(PDOException $e){
        die("Loginエラー：{$e -> getMessage()}");
    }
    }


function Select_LogedIn_User_Data($id){
    try{


        $db = GetDb();
        $statement = 'SELECT * FROM member_table WHERE id = ?';
        $sel = $db -> prepare($statement);
        $sel -> bindValue(1 , $id);
        $sel -> execute();

        $ResultSet = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $user_data = array();
        foreach($ResultSet as $data){
            $user_data = $data;
            }
        return $user_data;


    }catch(PDOException $e){
        die("Loginエラー：{$e -> getMessage()}");
    }
}


    //結果セットの取得
