<?php
    //----------　ログイン画面　----------

    session_start();
    require_once 'DbManager2.php';
    require_once 'Encode.php';
    require_once 'UserManager.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Login画面</title>
</head>
<body>
<form method = "POST" action = "Login.php">
    <p>掲示板</p>
    <label>ユーザ名(半角英数字２字以上２０字以内)：</label>
    <input id = 'nametextbox' type = 'text' name = 'Loginname' size = '20' maxlength="20"><br />

    <label>パスワード(半角英数字８字以上３０字以内)：</label>
    <input id = 'passwordtextbox' type = 'text' name = 'Loginpass' size = '30' maxlength="30"><br />

    <input type = 'submit' name = 'Loginbutton' value = 'ログイン'>
</form>
<form method = "POST" action = "Registration.php">
    <p>まだ新規登録されていない方は以下の＜新規登録＞ボタンより新規登録を行ってください。</p>
    <input type = 'submit' name = 'NewRegistration' value = '新規登録'>
</form>
<?php



    if(isset($_POST['Loginbutton'])){

        if(isset($_POST['Loginname']) && isset($_POST['Loginpass'])){

            if(!(empty($_POST['Loginname']) || empty($_POST['Loginpass']))){

                $LoginName = $_POST['Loginname'];
                $LoginPass = $_POST['Loginpass'];
                if(!preg_match('/^[0-9a-zA-Z]{2,20}$/', $LoginName)) {
                    print("ユーザ名は半角英数字２字以上２０字以下で入力してください。");
                }else if(!preg_match('/^[0-9a-zA-Z]{8,30}$/', $LoginPass)){
                    print("パスワードは半角英数字８字以上３０字以下で入力してください。");
                }else {
                    $decision = Login_Certification($LoginName, $LoginPass);  //ログインの認証

                    if ($decision) {
                        header('Location: http://localhost/selfphp2/Keiziban2/Keiziban2.php');  //ログイン後のページ
                    } else {
                        echo('ユーザ名またはパスワードが間違っています。');
                    }
                }


            }else if(empty($_POST['Loginname']) && empty($_POST['Loginpass'])){
                echo('ユーザ名とパスワードを入力してください。');
            }else if(empty($_POST['Loginname'])){
                echo('ユーザ名を入力してください。');
            }else{
                echo('パスワードを入力してください。');
            }
        }
    }

?>

</body>
</html>