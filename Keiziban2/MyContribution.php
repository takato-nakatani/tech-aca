<?php
    //----------　マイページ　----------


    session_start();
    require_once 'UserManager.php';
    require_once 'PostManager.php';
    require(dirname(__FILE__).'/libs/Smarty.class.php');

    $smarty = new Smarty();
    $smarty -> template_dir = dirname(__FILE__).'/KeizibanTmp/';
    $smarty -> compile_dir = dirname(__FILE__).'/KeizibanTmp_c/';


    $LoginUserId = $_SESSION['id'];         //ユーザのid
    $LoginUserData = array();
    $LoginUserData = Select_LogedIn_User_Data($LoginUserId);        //ユーザidからログインしているユーザの名前を取得
    $user_id = $LoginUserData['id'];
    $user_name = $LoginUserData['name'];

    $smarty -> assign("name" ,$user_name);


    if(isset($_POST['Logoutbutton'])){  //ログアウトボタンが押されたときの処理
        session_destroy();      //保持していたユーザidを破棄
        header('Location: http://localhost/selfphp2/Keiziban2/Login.php');  //ログイン画面に戻る
    }

    if(isset($_POST['homebutton'])){   //ホームボタンが押されたときの処理
        header('Location: http://localhost/selfphp2/Keiziban2/Keiziban2.php');   //ユーザidの情報をセッションで保持したままホーム画面へ移動
    }

    $fetchAll = Select_Inner_Join($LoginUserId);  // 内部結合した結果セットを取得する関数。
    $cnt = 1;  //ボタンの個別番号
    $smarty -> assign('cnt', $cnt);
    $smarty -> assign('fetchAll', $fetchAll);


    for ($i = 1; $i < count($fetchAll[0]); $i++){    //投稿文の数だけfor文でループ
        if(isset($_POST["editbutton{$i}"])){   //どのボタンが押されたか
            $contents_id = $_POST["contents_id{$i}"];  //押されたボタンのhiddenから投稿文のidを取得
            editbutton($contents_id);   //投稿文のidをセッションで保持して編集画面へ移動する関数
        }
    }


    for ($i = 1; $i < count($fetchAll[0]); $i++){
        if(isset($_POST["deletebutton{$i}"])){   //どのボタンが押されたか
            $contents_id = $_POST["contents_id{$i}"];  //押されたボタンと投稿文のidを紐づけたhiddenから投稿文のidを取得
            Delete_Contribution($contents_id);   //投稿文を削除する関数
            header('Location: http://localhost/selfphp2/Keiziban2/MyContribution.php');
        }
    }


    $smarty -> display("MyPage.tpl");