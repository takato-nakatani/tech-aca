<html>
<head>
    <title>投稿文の編集 {$name}さん</title>
</head>
<form method = "POST" action = "Keiziban2.php">
    ホーム
    <input type = 'submit' name = 'Logoutbutton' value = 'ログアウト'>
</form>
<form method = "POST" action = "MyContribution.php">
    <input type = 'submit' name = 'MyPage' value = 'マイページに戻る'>
</form>
<form method = "POST" action = "EditContents.php">
    <p>編集後、完了ボタンを押してください。</p>
    <textarea name = 'contribution' cols = '75' rows = '10' maxlength = "500" wrap = "hard">{$before_edit}</textarea><br />
    <input type = 'submit' name = 'editcompletebutton' value = '編集を完了する'>
</form>
<body>

</body>
</html>
