<?php
    //----------　新規登録画面　----------

    require_once 'DbManager2.php';
    require_once 'Encode.php';
    require_once 'UserManager.php';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>登録画面</title>
</head>
<body>
<form method = "POST" action = "Registration.php">

    <p>以下のフォームに従って＜ユーザ名＞と＜パスワード＞を設定してください</p>
    <label>ユーザ名(半角英数字２字以上２０字以内)：</label>
    <input id = 'username' type = 'text' name = 'username' size = '30' maxlength="20"><br />

    <label>パスワード(半角英数字８字以上３０字以内)：</label>
    <input id = 'userpass' type = 'text' name = 'userpass' size = '30' maxlength="30"><br />
    <input type = 'submit' name = 'Registrationbutton' value = '登録'>

</form>
<form method = "POST" action = "Login.php">
    <input type = "submit" name = "backtoLogin" value = "ログイン画面に戻る">
</form>
<?php
    if(isset($_POST['Registrationbutton'])){
        if(isset($_POST['username']) && isset($_POST['userpass'])){
            if(!(empty($_POST['username']) || empty($_POST['userpass']))){

                $user_name = $_POST['username'];
                $user_pass = $_POST['userpass'];

                if(!preg_match('/^[0-9a-zA-Z]{2,20}$/', $user_name)) {
                    print("ユーザ名は半角英数字２字以上２０字以下で入力してください。");
                }else if(!preg_match('/^[0-9a-zA-Z]{8,30}$/', $user_pass)){
                    print("パスワードは半角英数字８字以上３０字以下で入力してください。");
                }else{

                    $decision = Duplication_Check($user_name, $user_pass);
                    if($decision){
                        $db = GetDB();
                        Insert_User($user_name, $user_pass);
                        header('Location: http://localhost/selfphp2/Keiziban2/RegistrationCompletion.php');
                    }

                }

            }else if(empty($_POST['username']) && empty($_POST['userpass'])){
                echo('ユーザ名とパスワードを入力してください。');
            }else if(empty($_POST['username'])){
                echo('ユーザ名を入力してください。');
            }else{
                echo('パスワードを入力してください。');
            }
        }
    }

?>

</body>
</html>