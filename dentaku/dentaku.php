<?php
require_once 'sisokuenzan_func2.php';
require_once 'Encode.php';
session_start();
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>電卓改</title>
    <link rel="stylesheet" type="text/css" href="dentaku.css">
</head>
<body>
<form name = "button"  method = 'POST' action = 'dentaku.php'>

    <button type="submit" name="button" value="1">１</button>
    <button type="submit" name="button" value="2">２</button>
    <button type="submit" name="button" value="3">３</button>
    <button type="submit" name="calculation" value="divide">÷</button>
    <button type="submit" name="square_root" value="root">√</button><br />

    <button type="submit" name="button" value="4">４</button>
    <button type="submit" name="button" value="5">５</button>
    <button type="submit" name="button" value="6">６</button>
    <button type="submit" name="calculation" value="multiply">×</button><br />

    <button type="submit" name="button" value="7">７</button>
    <button type="submit" name="button" value="8">８</button>
    <button type="submit" name="button" value="9">９</button>
    <button type="submit" name="calculation" value="minus">－</button><br />

    <button type="submit" name="button" value="s0">０</button>
    <button type="submit" name="button" value="w0">００</button>
    <button type="submit" name="button" value="dot">.</button>
    <button type="submit" name="calculation" value="plus">＋</button>
    <button type ="submit" name = "result" value = "＝">＝</button>
    <button type ="submit" name = "reset" style = "background : Red" value = "ＡＣ">ＡＣ</button><br />

</form>



<?php


//if($_POST['calculation']){
//    calculation_Method();
//}
if($_SESSION['text'] === 'ERROR'){
    $_SESSION['text'] = [];
}

global $formula_data;
$formula_data = array();
$formula_data = $_SESSION['text'];
$formula_method = array();
global $formula_str;

var_dump($_SESSION['text']);










//数字のボタンが押されたときの処理

switch($_POST['button']){

    case "1" :
        $buttonvalue_1 = "1";
        if($_SESSION['text'] == "0"){
            $_SESSION['text'] = [];
        }
        $formula_data = button_data($buttonvalue_1);
        $_SESSION['text'] = $formula_data;
        var_dump($_SESSION['text']);

        break;

    case "2":
        $buttonvalue_2 = "2";
        if($_SESSION['text'] == "0"){
            $_SESSION['text'] = [];
        }
        $formula_data = button_data($buttonvalue_2);
        $_SESSION['text'] = $formula_data;

        break;

    case "3":
        $buttonvalue_3 = "3";
        if($_SESSION['text'] == "0"){
            $_SESSION['text'] = [];
        }
        $formula_data = button_data($buttonvalue_3);
        $_SESSION['text'] = $formula_data;

        break;

    case "4":
        $buttonvalue_4 = "4";
        if($_SESSION['text'] == "0"){
            $_SESSION['text'] = [];
        }
        $formula_data = button_data($buttonvalue_4);
        $_SESSION['text'] = $formula_data;

        break;

    case "5" :
        $buttonvalue_5 = "5";
        if($_SESSION['text'] == "0"){
            $_SESSION['text'] = [];
        }
        $formula_data = button_data($buttonvalue_5);
        $_SESSION['text'] = $formula_data;

        break;

    case "6":
        $buttonvalue_6 = "6";
        if($_SESSION['text'] == "0"){
            $_SESSION['text'] = [];
        }
        $formula_data = button_data($buttonvalue_6);
        $_SESSION['text'] = $formula_data;

        break;

    case "7":
        $buttonvalue_7 = "7";
        if($_SESSION['text'] == "0"){
            $_SESSION['text'] = [];
        }
        $formula_data = button_data($buttonvalue_7);
        $_SESSION['text'] = $formula_data;

        break;
    case "8":
        $buttonvalue_8 = "8";
        if($_SESSION['text'] == "0"){
            $_SESSION['text'] = [];
        }
        $formula_data = button_data($buttonvalue_8);
        $_SESSION['text'] = $formula_data;

        break;

    case "9" :
        $buttonvalue_9 = "9";
        if($_SESSION['text'] == "0"){
            $_SESSION['text'] = [];
        }
        $formula_data = button_data($buttonvalue_9);
        $_SESSION['text'] = $formula_data;

        break;

    case "s0":
        $buttonvalue_10 = "0";
        if($_SESSION['text'] == "0"){
            $_SESSION['text'] = [];
        }
        if($_SESSION['text'] == NULL){
            break;
        }else{
            $formula_data = button_data($buttonvalue_10);
            $_SESSION['text'] = $formula_data;
        }

        break;

    case "w0":

        $buttonvalue_11 = "00";
        if($_SESSION['text'] == "0"){
            $_SESSION['text'] = [];
        }
        if($_SESSION['text'] == NULL){
            break;
        }else{
            $formula_data = button_data($buttonvalue_11);
            $_SESSION['text'] = $formula_data;

        }
        break;

    case "dot":
        $buttonvalue_dot = ".";
        if($_SESSION['text'] == NULL){
            array_push($_SESSION['text'],"0");
            $formula_data = button_data($buttonvalue_dot);
            $_SESSION['text'] = $formula_data;
            break;
        }else if(end($_SESSION['text']) === "." || end($_SESSION['text']) === " + " || end($_SESSION['text']) === " - " || end($_SESSION['text']) === " * " || end($_SESSION['text']) === " / ")
        {
            break;
        }else
        {

            $formula_data = button_data($buttonvalue_dot);
            $_SESSION['text'] = $formula_data;
            break;
        }


}








//ルートのボタンが押されたときの処理
if(isset($_POST['square_root']))
{

    $formula_str = implode('' , $formula_data);    //$formula_str：計算式の文字列
    if($_SESSION['text'] != null){
        if( ! (preg_match("/ \+ /", $formula_str) || preg_match("/ \- /", $formula_str) || preg_match("/ \* /", $formula_str) || preg_match("/ \/ /", $formula_str) ) )
        {

            $_SESSION['text'] = [];
            $after_root = sqrt((float)$formula_str);
            $formula_data = explode("/\./",$after_root);
            foreach($formula_data as $value){
                array_push($_SESSION['text'], $value);
            }
            $formula = "√{$formula_str} = {$after_root}";
            $history = store_record($formula);
            $_SESSION['record'] = $history;

        }
    }



}








//演算子のボタンが押されたときの処理
global $formula;
switch($_POST['calculation']){


    case "plus" :

        if($_SESSION['text'] == null){
            array_push($_SESSION['text'],"0");
        }

        $buttonvalue_cal = " + ";

        if(is_array($formula_data))
        {
            if(end($formula_data) === " + " ||end($formula_data) === " - " ||end($formula_data) === " * " ||end($formula_data) === " / "  )
            {
                array_splice($formula_data,-1, 1, " + ");
                $_SESSION['text'] = $formula_data;
                break;
            }

            $formula_str = implode('' , $formula_data);  //$formula_str：計算式の文字列
        }


        if(preg_match("/ \+ /", $formula_str, $cal_method) || preg_match("/ \- /", $formula_str, $cal_method) || preg_match("/ \* /", $formula_str, $cal_method) || preg_match("/ \/ /", $formula_str, $cal_method)  )
        {
            switch($cal_method[0]){
                case " + " :
                    $formula_num = explode(" + " , $formula_str);  //$formula_num：演算子と演算子の間の数値を文字列で格納した配列
                    $num1 = $formula_num[0];
                    $num2 = $formula_num[1];
                    preg_match_all("/\./", $formula_num[0], $count_dot1);
                    preg_match_all("/\./", $formula_num[1], $count_dot2);
                    if(count($count_dot1[0]) > 1 || count($count_dot2[0]) > 1){
                        $_SESSION['text'] = "ERROR";
                        break 2;
                    }
                    $result = $formula_num[0] + $formula_num[1];
                    $formula = "{$formula_num[0]} ＋ {$formula_num[1]} ＝ {$result}";
                    $history = store_record($formula);
                    $_SESSION['record'] = $history;
                    $_SESSION['text'] = [];
                    $_SESSION['text'] = "$result";
                    break;

                case " - " :
                    $formula_num = explode(" - " , $formula_str);
                    $num1 = $formula_num[0];
                    $num2 = $formula_num[1];
                    preg_match_all("/\./", $formula_num[0], $count_dot1);
                    preg_match_all("/\./", $formula_num[1], $count_dot2);
                    if(count($count_dot1[0]) > 1 || count($count_dot2[0]) > 1){
                        $_SESSION['text'] = "ERROR";
                        break 2;
                    }
                    $result = $formula_num[0] - $formula_num[1];
                    $formula = "{$formula_num[0]} － {$formula_num[1]} ＝ {$result}";
                    $history = store_record($formula);
                    $_SESSION['record'] = $history;
                    $_SESSION['text'] = [];
                    $_SESSION['text'] = "$result";
                    break;

                case " * " :
                    $formula_num = explode(" * " , $formula_str);
                    $num1 = $formula_num[0];
                    $num2 = $formula_num[1];
                    preg_match_all("/\./", $formula_num[0], $count_dot1);
                    preg_match_all("/\./", $formula_num[1], $count_dot2);
                    if(count($count_dot1[0]) > 1 || count($count_dot2[0]) > 1){
                        $_SESSION['text'] = "ERROR";
                        break 2;
                    }
                    $result = $formula_num[0] * $formula_num[1];
                    $formula = "{$formula_num[0]} × {$formula_num[1]} ＝ {$result}";
                    $history = store_record($formula);
                    $_SESSION['record'] = $history;
                    $_SESSION['text'] = [];
                    $_SESSION['text'] = "$result";
                    break;

                case " / " :
                    $formula_num = explode(" / " , $formula_str);
                    $num1 = $formula_num[0];
                    $num2 = $formula_num[1];
                    if($num2 == "0"){
                        $_SESSION['text'] = "ERROR";
                        break 2;
                    }
                    preg_match_all("/\./", $formula_num[0], $count_dot1);
                    preg_match_all("/\./", $formula_num[1], $count_dot2);
                    if(count($count_dot1[0]) > 1 || count($count_dot2[0]) > 1){
                        $_SESSION['text'] = "ERROR";
                        break 2;
                    }
                    $result = $formula_num[0] / $formula_num[1];
                    $formula = "{$formula_num[0]} ÷ {$formula_num[1]} ＝ {$result}";
                    $history = store_record($formula);
                    $_SESSION['record'] = $history;
                    $_SESSION['text'] = [];
                    $_SESSION['text'] = "$result";
                    break;

            }


        }
        //演算子が入力されていない場合の処理。
        $formula_data = button_data($buttonvalue_cal);   //$formula_data：数字一つ一つと演算子をそれぞれ配列に格納(今回入力されたもの、つまり最新の文字は格納していない)
        $_SESSION['text'] = $formula_data;

        break;

    case "minus":

        if($_SESSION['text'] == null){
            array_push($_SESSION['text'],"0");
        }

        $buttonvalue_cal = " - ";

        if(is_array($formula_data))
        {
            if(end($formula_data) === " + " ||end($formula_data) === " - " ||end($formula_data) === " * " ||end($formula_data) === " / "  )
            {
                array_splice($formula_data,-1, 1, " - ");
                $_SESSION['text'] = $formula_data;
                break;
            }
            $formula_str = implode('' , $formula_data);  //$formula_str：計算式の文字列
        }


        if(preg_match("/ \+ /", $formula_str, $cal_method) || preg_match("/ \- /", $formula_str, $cal_method) || preg_match("/ \* /", $formula_str, $cal_method) || preg_match("/ \/ /", $formula_str, $cal_method)  )
        {
            switch($cal_method[0]){
                case " + " :
                    $formula_num = explode(" + " , $formula_str);  //$formula_num：演算子と演算子の間の数値を文字列で格納した配列
                    $num1 = $formula_num[0];
                    $num2 = $formula_num[1];
                    preg_match_all("/\./", $formula_num[0], $count_dot1);
                    preg_match_all("/\./", $formula_num[1], $count_dot2);
                    if(count($count_dot1[0]) > 1 || count($count_dot2[0]) > 1){
                        $_SESSION['text'] = "ERROR";
                        break 2;
                    }
                    $result = $formula_num[0] + $formula_num[1];
                    $formula = "{$formula_num[0]} ＋ {$formula_num[1]} ＝ {$result}";
                    $history = store_record($formula);
                    $_SESSION['record'] = $history;
                    $_SESSION['text'] = [];
                    $_SESSION['text'] = "$result";
                    break;

                case " - " :
                    $formula_num = explode(" - " , $formula_str);
                    $num1 = $formula_num[0];
                    $num2 = $formula_num[1];
                    preg_match_all("/\./", $formula_num[0], $count_dot1);
                    preg_match_all("/\./", $formula_num[1], $count_dot2);
                    if(count($count_dot1[0]) > 1 || count($count_dot2[0]) > 1){
                        $_SESSION['text'] = "ERROR";
                        break 2;
                    }
                    $result = $formula_num[0] - $formula_num[1];
                    $formula = "{$formula_num[0]} － {$formula_num[1]} ＝ {$result}";
                    $history = store_record($formula);
                    $_SESSION['record'] = $history;
                    $_SESSION['text'] = [];
                    $_SESSION['text'] = "$result";
                    break;

                case " * " :
                    $formula_num = explode(" * " , $formula_str);
                    $num1 = $formula_num[0];
                    $num2 = $formula_num[1];
                    preg_match_all("/\./", $formula_num[0], $count_dot1);
                    preg_match_all("/\./", $formula_num[1], $count_dot2);
                    if(count($count_dot1[0]) > 1 || count($count_dot2[0]) > 1){
                        $_SESSION['text'] = "ERROR";
                        break 2;
                    }
                    $result = $formula_num[0] * $formula_num[1];
                    $formula = "{$formula_num[0]} × {$formula_num[1]} ＝ {$result}";
                    $history = store_record($formula);
                    $_SESSION['record'] = $history;
                    $_SESSION['text'] = [];
                    $_SESSION['text'] = "$result";
                    break;

                case " / " :
                    $formula_num = explode(" / " , $formula_str);
                    $num1 = $formula_num[0];
                    $num2 = $formula_num[1];
                    if($num2 == "0"){
                        $_SESSION['text'] = "ERROR";
                        break 2;
                    }
                    preg_match_all("/\./", $formula_num[0], $count_dot1);
                    preg_match_all("/\./", $formula_num[1], $count_dot2);
                    if(count($count_dot1[0]) > 1 || count($count_dot2[0]) > 1){
                        $_SESSION['text'] = "ERROR";
                        break 2;
                    }
                    $result = $formula_num[0] / $formula_num[1];
                    $formula = "{$formula_num[0]} ÷ {$formula_num[1]} ＝ {$result}";
                    $history = store_record($formula);
                    $_SESSION['record'] = $history;
                    $_SESSION['text'] = [];
                    $_SESSION['text'] = "$result";
                    break;

            }


        }

        $formula_data = button_data($buttonvalue_cal);   //$formula_data：数字一つ一つと演算子をそれぞれ配列に格納(今回入力されたもの、つまり最新の文字は格納していない)
        $_SESSION['text'] = $formula_data;

        break;

    case "multiply":

        if($_SESSION['text'] == null){
            array_push($_SESSION['text'],"0");
        }

        $buttonvalue_cal = " * ";

        if(is_array($formula_data)){
            if(end($formula_data) === " + " ||end($formula_data) === " - " ||end($formula_data) === " * " ||end($formula_data) === " / "  )
            {
                array_splice($formula_data,-1, 1, " * ");
                $_SESSION['text'] = $formula_data;
                break;
            }

            $formula_str = implode('' , $formula_data);  //$formula_str：計算式の文字列
        }

        if(preg_match("/ \+ /", $formula_str, $cal_method) || preg_match("/ \- /", $formula_str, $cal_method) || preg_match("/ \* /", $formula_str, $cal_method) || preg_match("/ \/ /", $formula_str, $cal_method)  )
        {
            switch($cal_method[0]){
                case " + " :
                    $formula_num = explode(" + " , $formula_str);  //$formula_num：演算子と演算子の間の数値を文字列で格納した配列
                    $num1 = $formula_num[0];
                    $num2 = $formula_num[1];
                    preg_match_all("/\./", $formula_num[0], $count_dot1);
                    preg_match_all("/\./", $formula_num[1], $count_dot2);
                    if(count($count_dot1[0]) > 1 || count($count_dot2[0]) > 1){
                        $_SESSION['text'] = "ERROR";
                        break 2;
                    }
                    $result = $formula_num[0] + $formula_num[1];
                    $formula = "{$formula_num[0]} ＋ {$formula_num[1]} ＝ {$result}";
                    $history = store_record($formula);
                    $_SESSION['record'] = $history;
                    $_SESSION['text'] = [];
                    $_SESSION['text'] = "$result";
                    break;

                case " - " :
                    $formula_num = explode(" - " , $formula_str);
                    $num1 = $formula_num[0];
                    $num2 = $formula_num[1];
                    preg_match_all("/\./", $formula_num[0], $count_dot1);
                    preg_match_all("/\./", $formula_num[1], $count_dot2);
                    if(count($count_dot1[0]) > 1 || count($count_dot2[0]) > 1){
                        $_SESSION['text'] = "ERROR";
                        break 2;
                    }
                    $result = $formula_num[0] - $formula_num[1];
                    $formula = "{$formula_num[0]} － {$formula_num[1]} ＝ {$result}";
                    $history = store_record($formula);
                    $_SESSION['record'] = $history;
                    $_SESSION['text'] = [];
                    $_SESSION['text'] = "$result";
                    break;

                case " * " :
                    $formula_num = explode(" * " , $formula_str);
                    $num1 = $formula_num[0];
                    $num2 = $formula_num[1];
                    preg_match_all("/\./", $formula_num[0], $count_dot1);
                    preg_match_all("/\./", $formula_num[1], $count_dot2);
                    if(count($count_dot1[0]) > 1 || count($count_dot2[0]) > 1){
                        $_SESSION['text'] = "ERROR";
                        break 2;
                    }
                    $result = $formula_num[0] * $formula_num[1];
                    $formula = "{$formula_num[0]} × {$formula_num[1]} ＝ {$result}";
                    $history = store_record($formula);
                    $_SESSION['record'] = $history;
                    $_SESSION['text'] = [];
                    $_SESSION['text'] = "$result";
                    break;

                case " / " :
                    $formula_num = explode(" / " , $formula_str);
                    $num1 = $formula_num[0];
                    $num2 = $formula_num[1];
                    if($num2 == "0"){
                        $_SESSION['text'] = "ERROR";
                        break 2;
                    }
                    preg_match_all("/\./", $formula_num[0], $count_dot1);
                    preg_match_all("/\./", $formula_num[1], $count_dot2);
                    if(count($count_dot1[0]) > 1 || count($count_dot2[0]) > 1){
                        $_SESSION['text'] = "ERROR";
                        break 2;
                    }
                    $result = $formula_num[0] / $formula_num[1];
                    $formula = "{$formula_num[0]} ÷ {$formula_num[1]} ＝ {$result}";
                    $history = store_record($formula);
                    $_SESSION['record'] = $history;
                    $_SESSION['text'] = [];
                    $_SESSION['text'] = "$result";
                    break;

            }


        }

        $formula_data = button_data($buttonvalue_cal);   //$formula_data：数字一つ一つと演算子をそれぞれ配列に格納(今回入力されたもの、つまり最新の文字は格納していない)
        $_SESSION['text'] = $formula_data;

        break;

    case "divide":

        if($_SESSION['text'] == null){
            array_push($_SESSION['text'],"0");
        }

        $buttonvalue_cal = " / ";

        if(is_array($formula_data))
        {
            if(end($formula_data) === " + " ||end($formula_data) === " - " ||end($formula_data) === " * " ||end($formula_data) === " / "  )
            {
                array_splice($formula_data,-1, 1, " / ");
                $_SESSION['text'] = $formula_data;
                break;
            }

            $formula_str = implode('' , $formula_data);  //$formula_str：計算式の文字列
        }

        if(preg_match("/ \+ /", $formula_str, $cal_method) || preg_match("/ \- /", $formula_str, $cal_method) || preg_match("/ \* /", $formula_str, $cal_method) || preg_match("/ \/ /", $formula_str, $cal_method)  )
        {
            switch($cal_method[0]){
                case " + " :
                    $formula_num = explode(" + " , $formula_str);  //$formula_num：演算子と演算子の間の数値を文字列で格納した配列
                    $num1 = $formula_num[0];
                    $num2 = $formula_num[1];
                    preg_match_all("/\./", $formula_num[0], $count_dot1);
                    preg_match_all("/\./", $formula_num[1], $count_dot2);
                    if(count($count_dot1[0]) > 1 || count($count_dot2[0]) > 1){
                        $_SESSION['text'] = "ERROR";
                        break 2;
                    }
                    $result = $formula_num[0] + $formula_num[1];
                    $formula = "{$formula_num[0]} ＋ {$formula_num[1]} ＝ {$result}";
                    $history = store_record($formula);
                    $_SESSION['record'] = $history;
                    $_SESSION['text'] = [];
                    $_SESSION['text'] = "$result";
                    break;

                case " - " :
                    $formula_num = explode(" - " , $formula_str);
                    $num1 = $formula_num[0];
                    $num2 = $formula_num[1];
                    preg_match_all("/\./", $formula_num[0], $count_dot1);
                    preg_match_all("/\./", $formula_num[1], $count_dot2);
                    if(count($count_dot1[0]) > 1 || count($count_dot2[0]) > 1){
                        $_SESSION['text'] = "ERROR";
                        break 2;
                    }
                    $result = $formula_num[0] - $formula_num[1];
                    $formula = "{$formula_num[0]} － {$formula_num[1]} ＝ {$result}";
                    $history = store_record($formula);
                    $_SESSION['record'] = $history;
                    $_SESSION['text'] = [];
                    $_SESSION['text'] = "$result";
                    break;

                case " * " :
                    $formula_num = explode(" * " , $formula_str);
                    $num1 = $formula_num[0];
                    $num2 = $formula_num[1];
                    preg_match_all("/\./", $formula_num[0], $count_dot1);
                    preg_match_all("/\./", $formula_num[1], $count_dot2);
                    if(count($count_dot1[0]) > 1 || count($count_dot2[0]) > 1){
                        $_SESSION['text'] = "ERROR";
                        break 2;
                    }
                    $result = $formula_num[0] * $formula_num[1];
                    $formula = "{$formula_num[0]} × {$formula_num[1]} ＝ {$result}";
                    $history = store_record($formula);
                    $_SESSION['record'] = $history;
                    $_SESSION['text'] = [];
                    $_SESSION['text'] = "$result";
                    break;

                case " / " :
                    $formula_num = explode(" / " , $formula_str);
                    $num1 = $formula_num[0];
                    $num2 = $formula_num[1];
                    if($num2 == "0"){
                        $_SESSION['text'] = "ERROR";
                        break 2;
                    }
                    preg_match_all("/\./", $formula_num[0], $count_dot1);
                    preg_match_all("/\./", $formula_num[1], $count_dot2);
                    if(count($count_dot1[0]) > 1 || count($count_dot2[0]) > 1){
                        $_SESSION['text'] = "ERROR";
                        break 2;
                    }
                    $result = $formula_num[0] / $formula_num[1];
                    $formula = "{$formula_num[0]} ÷ {$formula_num[1]} ＝ {$result}";
                    $history = store_record($formula);
                    $_SESSION['record'] = $history;
                    $_SESSION['text'] = [];
                    $_SESSION['text'] = "$result";
                    break;

            }


        }

        $formula_data = button_data($buttonvalue_cal);   //$formula_data：数字一つ一つと演算子をそれぞれ配列に格納(今回入力されたもの、つまり最新の文字は格納していない)
        $_SESSION['text'] = $formula_data;

        break;




}

//　「＝」が押されたときの処理
global $history;
$history = array();
if($_POST['result']){

    if($_SESSION['text'] != null)
    {

        if(is_array($formula_data)){
            $formula_str = implode('' , $formula_data);  //$formula_str：計算式の文字列
        }
        if(preg_match("/[^ ]$/",$formula_str)){     //計算式の最後が演算子の場合に「＝」が押されたらこのif文以下は実行されない。
            if(preg_match("/ \+ /", $formula_str, $cal_method) || preg_match("/ \- /", $formula_str, $cal_method) || preg_match("/ \* /", $formula_str, $cal_method) || preg_match("/ \/ /", $formula_str, $cal_method)  )
            {

                switch($cal_method[0]){
                    case " + " :
                        $formula_num = explode(" + " , $formula_str);  //$formula_num：計算する数値をそれぞれ文字列で格納した配列
                        $num1 = $formula_num[0];
                        $num2 = $formula_num[1];
                        preg_match_all("/\./", $formula_num[0], $count_dot1);
                        preg_match_all("/\./", $formula_num[1], $count_dot2);
                        if(count($count_dot1[0]) > 1 || count($count_dot2[0]) > 1){
                            $_SESSION['text'] = "ERROR";
                            break;
                        }
                        $result = $formula_num[0] + $formula_num[1];
                        $formula = "{$formula_num[0]} ＋ {$formula_num[1]} ＝ {$result}";
                        $_SESSION['text'] = [];
                        $_SESSION['text'] = "$result";

                        break;

                    case " - " :
                        $formula_num = explode(" - " , $formula_str);
                        $num1 = $formula_num[0];
                        $num2 = $formula_num[1];
                        preg_match_all("/\./", $formula_num[0], $count_dot1);
                        preg_match_all("/\./", $formula_num[1], $count_dot2);
                        if(count($count_dot1[0]) > 1 || count($count_dot2[0]) > 1){
                            $_SESSION['text'] = "ERROR";
                            break;
                        }
                        $result = $formula_num[0] - $formula_num[1];
                        $formula = "{$formula_num[0]} － {$formula_num[1]} ＝ {$result}";
                        $_SESSION['text'] = [];
                        $_SESSION['text'] = "$result";
                        break;

                    case " * " :
                        $formula_num = explode(" * " , $formula_str);
                        $num1 = $formula_num[0];
                        $num2 = $formula_num[1];
                        preg_match_all("/\./", $formula_num[0], $count_dot1);
                        preg_match_all("/\./", $formula_num[1], $count_dot2);
                        if(count($count_dot1[0]) > 1 || count($count_dot2[0]) > 1){
                            $_SESSION['text'] = "ERROR";
                            break;
                        }
                        $result = $formula_num[0] * $formula_num[1];
                        $formula = "{$formula_num[0]} × {$formula_num[1]} ＝ {$result}";
                        $_SESSION['text'] = [];
                        $_SESSION['text'] = "$result";
                        break;

                    case " / " :
                        $formula_num = explode(" / " , $formula_str);
                        $num1 = $formula_num[0];
                        $num2 = $formula_num[1];
                        if($num2 == "0"){
                            $_SESSION['text'] = "ERROR";
                            break;
                        }
                        preg_match_all("/\./", $formula_num[0], $count_dot1);
                        preg_match_all("/\./", $formula_num[1], $count_dot2);
                        if(count($count_dot1[0]) > 1 || count($count_dot2[0]) > 1){
                            $_SESSION['text'] = "ERROR";
                            break;
                        }
                        $result = $formula_num[0] / $formula_num[1];
                        $formula = "{$formula_num[0]} ÷ {$formula_num[1]} ＝ {$result}";
                        $_SESSION['text'] = [];
                        $_SESSION['text'] = "$result";
                        break;

                }
                if($_SESSION['text'] != "ERROR"){
                    $history = store_record($formula);

                    $_SESSION['record'] = $history;
                }

            }


            $history = $_SESSION['record'];
        }


    }


}





//ACボタンの処理
if($_POST['reset']){
    $_SESSION['text'] = [];
}

?>




<input type = text name = "text" size = "50" style = "text-align : left; font-size: 30px; "
       value = "<?php

       global $text;
       if(($_POST['button'] || $_POST['calculation'] || $_POST['result'] || $_POST['square_root']) && $_SESSION['text'] != null)
       {
           display_method($_SESSION['text']);
       }else{
           $text = 0;
           echo($text);
       }

       //                    if($_SESSION['text'] === "0"){
       //                        $_SESSION['text'] = [];
       //                    }

       ?>"><br />





<form>
    計算履歴<br />
    <textarea name = "record" style = "font-size: 30px; text-align: center " cols = "40" rows = "5"><?php

        foreach($history as $value){
            echo($value."\n");
        }
        ?></textarea>
    <br />
    <input name = "delete" type = submit value = "履歴を削除する">
    <?php
    if($_POST['delete']){
        $_SESSION['record'] = [];
    }
    ?>


</form>
</body>
</html>



小数点の扱い、面白い機能、西岡さんに言われたエラー処理。
小数点：一つの数字に二つ以上ある場合と、「 + 」などの文字の後の小数点の扱いについて。