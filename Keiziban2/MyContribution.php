<?php
    session_start();
    require_once 'UserManager.php';
    require_once 'PostManager.php';
    require(dirname(__FILE__).'/libs/Smarty.class.php');


    $smarty = new Smarty();
    $smarty -> template_dir = dirname(__FILE__).'/KeizibanTmp/';
    $smarty -> compile_dir = dirname(__FILE__).'/KeizibanTmp_c/';


    $LoginUserId = $_SESSION['id'];
    $LoginUserData = array();
    $LoginUserData = Select_LogedIn_User_Data($LoginUserId);
    $user_id = $LoginUserData['id'];
    $user_name = $LoginUserData['name'];

    $smarty -> assign("name" ,$user_name);
    $smarty -> display("MyPage.tpl");



    if(isset($_POST['Logoutbutton'])){
        session_destroy();
        header('Location: http://localhost/selfphp2/Keiziban2/Login.php');
    }

    Display_Mycontribution($LoginUserId);