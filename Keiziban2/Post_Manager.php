<?php

require_once 'DbManager2.php';

function insert_contribution($sql, $contents){
    try{

        $connect = GetDb();
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