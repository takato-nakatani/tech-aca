<?php
    //----------　投稿文管理に関する外部ファイル　----------

    require_once 'DbManager2.php';
    require_once 'Encode.php';


    function insert_contribution($contents, $user_id){   //投稿文の投稿時に利用
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

    function Update_Contribution($contents_id, $contents){  //編集ボタンの際に利用
        try{
            $db = GetDb();
            $statement = 'UPDATE post_table SET contents = ? WHERE post_table.id = ? ';
            $db -> beginTransaction();
            $upd = $db -> prepare($statement);
            $upd -> bindvalue('1', $contents);
            $upd -> bindvalue('2', $contents_id);
            $upd -> execute();
            $db -> commit();
        }catch(PDOException $e){
            $db -> rollback();
            die("UPDATEエラー：{$e -> getMessage()}");
        }
    }

    function Delete_Contribution($contents_id){  //削除ボタンの際に利用
        try{
            $db = GetDb();
            $statement = 'DELETE FROM post_table WHERE id = ? ';
            $db -> beginTransaction();
            $del = $db -> prepare($statement);
            $del -> bindValue('1', $contents_id);
            $del -> execute();
            $db -> commit();
        }catch(PDOException $e){
            $db -> rollback();
            die("DELETEエラー：{$e -> getMessage()}");
        }
    }

    function Display_Contribution(){  //全員の投稿を表示
        try{
            $db = GetDb();
            $statement = 'SELECT * FROM post_table INNER JOIN member_table ON post_table.user_id = member_table.id';
            $sel = $db -> prepare($statement);
            $sel -> execute();
            $fetchAll = $sel -> fetchAll(PDO::FETCH_ASSOC);
            if(!(empty($fetchAll))){
                foreach($fetchAll as $data){
                    $name = e($data['name']);
                    $contents = $data['contents'];
                    $time = $data['time'];
                    print("{$name}　さんの投稿　");
                    echo("<".$time.">");
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

    function Select_Inner_Join($user_id){  //テーブルを外部キー制約のもと内部結合させて取得
        try{
            $db = GetDb();
            $statement = 'SELECT post_table.id, contents, user_id, time, name FROM post_table INNER JOIN member_table ON post_table.user_id = member_table.id WHERE user_id = ?';
            $sel = $db -> prepare($statement);
            $sel -> bindValue('1', $user_id);
            $sel -> execute();
            $fetchAll = $sel -> fetchAll(PDO::FETCH_ASSOC);
            return $fetchAll;
        }catch(PDOException $e){
            die("エラーメッセージ：{$e -> getMessage()}");
        }

    }


    function editbutton($contents_id){  //マイページで編集ボタンが押された際に実行される
        $_SESSION['contents'] = $contents_id;
        header('Location: http://localhost/selfphp2/Keiziban2/EditContents.php');
    }

    function Select_contents($contents_id){  //投稿文のidから投稿文を取得
        try{
            $db = GetDb();
            $statement = 'SELECT contents FROM post_table WHERE id = ?';
            $sel = $db -> prepare($statement);
            $sel -> bindValue(1 , $contents_id);
            $sel -> execute();

            $ResultSet = $sel -> fetchAll(PDO::FETCH_ASSOC);
            $contents_data = array();
            foreach($ResultSet as $data_array){
                foreach($data_array as $data){
                    $contents_data = $data;
                }

            }
            return $contents_data;


        }catch(PDOException $e){
            die("エラー：{$e -> getMessage()}");
        }
    }
