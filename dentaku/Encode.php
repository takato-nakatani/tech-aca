<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>電卓</title>
</head>
<body>
<?php

function e(string $str, string $charset = 'UTF-8'): string{
    return htmlspecialchars($str, ENT_QUOTES | ENT_HTML5, $charset);
}

?>

</body>
</html>

<!--/**-->
<!--* Created by PhpStorm.-->
<!--* User: TAKATO-->
<!--* Date: 2017/11/03-->
<!--* Time: 17:08-->
<!--*/-->
<!---->
<!---->
<!---->
<!-- Encode.phpが存在することによって、HTMLで特殊な意味を持つものを文字列に変換し例えば、「<」をタグの始まりではなく、本来の「<」と認識するようになる。-->