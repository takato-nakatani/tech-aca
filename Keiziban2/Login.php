<?php
require_once 'DbManager2.php';
require_once 'Encode.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Login画面</title>
</head>
<body>
<form method = "POST" action = "Keiziban2.php">
    <label>ユーザ名：</label>
    <input id = 'nametextbox' type = 'text' name = 'name' size = '15'><br />

    <label>パスワード：</label>
    <input id = 'passwordtextbox' type = 'text' name = 'password' size = '30'><br />

    <input type = 'submit' name = 'Loginbutton' value = 'ログイン'>

</form>
<?php




try{

    $db = getDb();
    if(isset($_POST['name']) && isset($_POST['password'])){
        if(!(empty($_POST['namebox']) || empty($_POST['contribution']))){


        }
    }

    while($data = $out -> fetch(PDO::FETCH_ASSOC)){   //FETCH_ASSOC：連想配列で処理
        ?>
        <span style = "color:Red"><?php   echo(e($data['name']."　さんの投稿"));    ?></span>
        <?php


        echo nl2br("\n");
        echo(nl2br(e($data['contents'])));
        echo nl2br("\n\n");
    }


    $db = NULL;
}catch(PDOException $e){
    $db -> rollback();
    die("エラーメッセージ：{$e -> getMessage()}");
}






?>

</body>
</html>