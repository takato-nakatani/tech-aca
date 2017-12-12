<!--　投稿文の編集完了画面　-->


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>編集完了画面</title>
</head>
<body>
<p>投稿文の編集が完了しました。</p>
<form method = "POST" action = "EditCompletion.php">
    <input type = "submit" name = "backtomypage" value = "マイページに戻る">
</form>
<?php
    session_start();

    if(isset($_POST['backtomypage'])){
        $_SESSION['contents'] = NULL;
        header('Location: http://localhost/selfphp2/Keiziban2/MyContribution.php');
    }
?>
</body>
</html>