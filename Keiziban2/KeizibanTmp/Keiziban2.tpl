<html>
<head>
    <title>ホーム {$name}さん</title>
</head>
<form method = "POST" action = "Keiziban2.php">
    <p>{$name}　さん</p>
    <input type = 'submit' name = 'Logoutbutton' value = 'ログアウト'>
</form>
<form method = "POST" action = "MyContribution.php">
    <input type = 'submit' name = 'MyConbutton' value = 'マイページ'>
</form>
<form method = "POST" action = "Keiziban2.php">
    <p>何してるなう？？(１００文字以内)</p>
    <textarea name = 'contribution' cols = '75' rows = '10' maxlength = "500" wrap = "hard"></textarea><br />
    <input type = 'submit' name = 'contributionbutton' value = '投稿!!'>
</form>
<body>

</body>
</html>
