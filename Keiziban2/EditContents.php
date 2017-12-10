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
            Update_Contribution($contents_id, $after_edit);
            header('Location: http://localhost/selfphp2/Keiziban2/EditCompletion.php');
        }
    }

    $smarty -> display("Edit.tpl");
