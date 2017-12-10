<?php
    //----------　エスケープ処理　----------

    function e(string $str, string $charset = 'UTF-8'): string{
            return htmlspecialchars($str, ENT_QUOTES | ENT_HTML5, $charset);
    }


//Encode.phpが存在することによって、HTMLで特殊な意味を持つものを文字列に変換し例えば、「<」をタグの始まりではなく、本来の「<」と認識するようになる。