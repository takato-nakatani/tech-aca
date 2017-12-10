<html>
<head>
    <title>掲示版2 {$name}</title>
</head>
<form method = "POST" action = "MyContribution.php">
    <p>{$name}　さんのマイページ</p>
    <input type = 'submit' name = 'Logoutbutton' value = "ログアウト">
</form>
<form method = "POST" action = "Keiziban2.php">
    <input type = 'submit' name = 'homebutton' value = 'ホームに戻る'><br /><br /><br />
</form>
<body>
            {if $fetchAll != NULL}
                {foreach from = $fetchAll item = $data}
                    {$cnt++}.　<{$data['time']}>

                    <form method = "POST" action = "MyContribution.php">
                        <input type = "submit" name = "editbutton{$cnt}" value = "編集">
                        <input type = "submit" name = "deletebutton{$cnt}" value = "削除">

                        <input type = "hidden" name = "contents_id{$cnt}" value = {$data['id']}>
                    </form>
                    {$data['contents']|e}<br /><br />



                {/foreach}
            {/if}


</body>
</html>