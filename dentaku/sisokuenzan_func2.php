<?php

//入力した値を配列に格納する関数　⇒　入力された数値を逐一ためていく。
function button_data($button)
{
    if(is_string($_SESSION['text'])){
        $num_array = array();
        $num_array[] = $_SESSION['text'];
        $num_array[] = $button;
        $_SESSION['text'] = $num_array;
    }else
    {
        $num_array = $_SESSION['text'];
        $num_array[] = $button;
        $_SESSION['text'] = $num_array;
    }

    //50文字以上は読み込めないように制御
    if (count($_SESSION['text']) > 50) {  //count関数：配列の要素数を取得する
        array_shift($_SESSION['text']);
    }

    return $_SESSION['text'];

}









//計算履歴を格納する関数　⇒　計算履歴の作成
function store_record($new_formula){
    if($_SESSION['record'][-2] == null){
        if(is_string($_SESSION['record'])){
            $record_array = array();
            $record_array[] = $_SESSION['record'];
            $record_array[] = $new_formula;
        }else{
            $record_array = $_SESSION['record'];
            $record_array[] = $new_formula;
        }
        //履歴数が5を超えたら古いものから順番に削除する
        if(count($record_array) > 5){
            array_shift($record_array);
        }
    }
    return $record_array;
}






//数値のボタンを押したときに実行される関数
function num_button($num){
    if($_SESSION['text'] == "0"){
        $_SESSION['text'] = [];
    }
    $formula_data = button_data($num);
    $_SESSION['text'] = $formula_data;
}






//演算子や＝を押したときに実行される関数　⇒　計算の処理(実際の計算)
function calc($formula_str, $calc_method){
    $formula_num = explode($calc_method, $formula_str);  //$formula_num：演算子と演算子の間の数値を文字列で格納した配列
    preg_match_all("/\./", $formula_num[0], $count_dot1);
    preg_match_all("/\./", $formula_num[1], $count_dot2);
    if (count($count_dot1[0]) > 1 || count($count_dot2[0]) > 1) {
        $_SESSION['text'] = "ERROR";
    }else{
        switch($calc_method) {
            case " ＋ ":
                $result = $formula_num[0] + $formula_num[1];
                break;
            case " － ":
                $result = $formula_num[0] - $formula_num[1];
                break;
            case " × ":
                $result = $formula_num[0] * $formula_num[1];
                break;
            case " ÷ ":
                if ($formula_num[1] == "0") {
                    $_SESSION['text'] = "ERROR";
                    break;
                }
                $result = $formula_num[0] / $formula_num[1];
                break;
            default :
                break;
        }
        if($_SESSION['text'] != "ERROR"){
            $formula = "{$formula_num[0]} {$calc_method} {$formula_num[1]} ＝ {$result}";
            $history = store_record($formula);
            $_SESSION['record'] = $history;
            $_SESSION['text'] = [];
            $_SESSION['text'] = "$result";
        }
    }
}




//演算子のボタンが押されたときに実行される関数　⇒　計算以外の部分(計算の準備)
function calc_button($formula_data)
{
    if ($_SESSION['text'] == null) {
        $_SESSION['text'] = "0";
    }
    if (is_array($formula_data) == True &&  (end($formula_data) == " ＋ " || end($formula_data) == " － " || end($formula_data) == " × " || end($formula_data) == " ÷ ")) {
        array_splice($formula_data, -1, 1, $_POST['calculation']);
        $_SESSION['text'] = $formula_data;
    }else {
        if (is_array($formula_data)) {
            $formula_str = implode('', $formula_data); //$formula_str：計算式の文字列
        }else {
            $formula_str = $formula_data;
        }
        if (preg_match("/ \＋ /", $formula_str, $cal_method) || preg_match("/ \－ /", $formula_str, $cal_method) || preg_match("/ \× /", $formula_str, $cal_method) || preg_match("/ \÷ /", $formula_str, $cal_method)) {
            calc($formula_str, $cal_method[0]);
        }
        //演算子が入力されていない場合の処理。
        $formula_data = button_data($_POST['calculation']);   //$formula_data：数字一つ一つと演算子をそれぞれ配列に格納(今回入力されたもの、つまり最新の文字は格納していない)
    }
}


?>