<?php
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
    <label>ユーザ名：</label>
    <input id = 'nametextbox' type = 'text' name = 'Loginname' size = '15'><br />

    <label>パスワード：</label>
    <input id = 'passwordtextbox' type = 'text' name = 'Loginpass' size = '30'><br />

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
                $decision = Login_Certification($LoginName, $LoginPass);
                if($decision){
                    header('Location: http://localhost/selfphp2/Keiziban2/Keiziban2.php');
                }else{
                    echo('ユーザ名またはパスワードが間違っています。');
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