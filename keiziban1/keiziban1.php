<?php
    require_once 'DbManager.php';
    require_once 'Encode.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>掲示板1</title>
</head>
<body>
<form method = "POST" action = "keiziban1.php">
    <label>名前：</label>
    <input id = 'nametextbox' type = 'text' name = 'namebox' size = '15'><br />
    <p>言いたいこと！！</p>
    <textarea name = 'contribution' cols = '75' rows = '10'></textarea>
    <input type = 'submit' name = 'submitbutton' value = '投稿!!!!!'>

</form>
<?php
    if($_POST['namebox'] && $_POST['contribution']){
        try{
            $db = getDb();
            $ins = $db -> prepare('INSERT INTO post_table(name, contents) VALUES(:username, :usercontents)');
            $ins -> bindValue(':username', e($_POST['namebox']));
            $ins -> bindValue(':usercontents', e($_POST['contribution']));
            $ins -> execute();


            $out = $db -> prepare('SELECT * FROM post_table ORDER BY id DESC');
            $out -> execute();
            while($data = $out -> fetch(PDO::FETCH_ASSOC)){
?>
                <span style = "color:Red"><?php   echo(e($data['name']."　さんの投稿"));    ?></span>
                <?php
                echo nl2br("\n");
                echo(nl2br(e($data['contents'])));
                echo nl2br("\n\n");

            }
            $db = NULL;
        }catch(PDOException $e){
            die("エラーメッセージ：{$e -> getMessage()}");
        }
    }





?>

</body>
</html>