<?php
require_once 'DbManager2.php';
require_once 'Encode.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>掲示板</title>
</head>
<body>
<form method = "POST" action = "Keiziban2.php">
    <p></p>
    <textarea name = 'contribution' cols = '75' rows = '10' maxlength = "500" wrap = "hard"></textarea><br />
    <input type = 'submit' name = 'submitbutton' value = '投稿!!!!!'>

</form>
<?php

    if(isset($_POST['namebox']) && isset($_POST['contribution'])){
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







?>

</body>
</html>