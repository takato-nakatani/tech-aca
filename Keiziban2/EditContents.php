<?php
    //----------　投稿文の編集ページ　----------


    session_start();
    require_once 'UserManager.php';
    require_once 'PostManager.php';
    require(dirname(__FILE__).'/libs/Smarty.class.php');




    $smarty = new Smarty();
    $smarty -> template_dir = dirname(__FILE__).'/KeizibanTmp/';
    $smarty -> compile_dir = dirname(__FILE__).'/KeizibanTmp_c/';

    $contents_id = $_SESSION['contents'];
    $before_edit = Select_contents($contents_id);
    $smarty -> assign('before_edit', $before_edit);


    if(isset($_POST['editcompletebutton'])) {
        if(!(empty($_POST['contribution']))){
            $after_edit = $_POST['contribution'];
            if(mb_strlen($after_edit) > 100){
                print('100字以内で入力してください。');
            }else{
                Update_Contribution($contents_id, $after_edit);
            }

            header('Location: http://localhost/selfphp2/Keiziban2/EditCompletion.php');
        }
    }

    if(isset($_POST['Logoutbutton'])){
        session_destroy();
        header('Location: http://localhost/selfphp2/Keiziban2/Login.php');
    }

    if(isset($_POST['backtomypagebutton'])){
        $_SESSION['contents'] = NULL;
        header('Location: http://localhost/selfphp2/Keiziban2/MyContribution.php');
    }

    $smarty -> display("Edit.tpl");
