<html>
<head>
    <title>掲示版2 {$name}</title>
</head>
<form method = "POST" action = "Keiziban2.php">
    {$name}　さんのマイページ
    <input type = 'submit' name = 'Logoutbutton' value = 'ログアウト'>
</form>
<form method = "POST" action = "MyContribution.php">
    <input type = 'submit' name = 'MyConbutton' value = '自分の投稿した内容を見る'>
</form>
<form method = "POST" action = "Keiziban2.php">
    <p>何してるなう？？</p>
    <textarea name = 'contribution' cols = '75' rows = '10' maxlength = "500" wrap = "hard"></textarea><br />
    <input type = 'submit' name = 'contributionbutton' value = '投稿!!'>
</form>
<body>

</body>
</html>