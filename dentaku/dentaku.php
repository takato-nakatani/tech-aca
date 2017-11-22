<?php
require_once 'sisokuenzan_func2.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>村長のおいしい電卓</title>
    <link rel="stylesheet" type="text/css" href="dentaku.css">
</head>
<body>
<form name = "button"  method = 'POST' action = 'dentaku.php'>

    <button type="submit" name="numbutton" value="1">１</button>
    <button type="submit" name="numbutton" value="2">２</button>
    <button type="submit" name="numbutton" value="3">３</button>
    <button type="submit" name="calculation" value=" ÷ ">÷</button>
    <button type="submit" name="square_root" value="root">√</button><br />

    <button type="submit" name="numbutton" value="4">４</button>
    <button type="submit" name="numbutton" value="5">５</button>
    <button type="submit" name="numbutton" value="6">６</button>
    <button type="submit" name="calculation" value=" × ">×</button><br />

    <button type="submit" name="numbutton" value="7">７</button>
    <button type="submit" name="numbutton" value="8">８</button>
    <button type="submit" name="numbutton" value="9">９</button>
    <button type="submit" name="calculation" value=" － ">－</button><br />

    <button type="submit" name="zerobutton" value="0">０</button>
    <button type="submit" name="zerobutton" value="00">００</button>
    <button type="submit" name="dotbutton" value=".">.</button>
    <button type="submit" name="calculation" value=" ＋ ">＋</button>
    <button type ="submit" name = "result" value = "＝">＝</button>
    <button type ="submit" name = "reset" style = "background : Red" value = "ＡＣ">ＡＣ</button><br />

</form>
<?php
if($_SESSION['text'] === 'ERROR'){
    $_SESSION['text'] = [];
}
global $formula_data;
$formula_data = array();
$formula_data = $_SESSION['text'];
global $formula_str;


//数字のボタンが押されたときの処理
if(isset($_POST['numbutton'])){
    num_button($_POST['numbutton']);
}
if(isset($_POST['zerobutton'])) {
    if ($_SESSION['text'] !== NULL) {
        num_button($_POST['zerobutton']);
    }
}


//小数点のボタンが押されたときの処理
if(isset($_POST['dotbutton'])){
    if($_SESSION['text'] == NULL){
        array_push($_SESSION['text'],"0");
        $formula_data = button_data($_POST['dotbutton']);
        $_SESSION['text'] = $formula_data;

    }else if(end($_SESSION['text']) !== "." && end($_SESSION['text']) !== " ＋ " && end($_SESSION['text']) !== " － " && end($_SESSION['text']) !== " × " && end($_SESSION['text']) !== " ÷ ") {
        $formula_data = button_data($_POST['dotbutton']);
        $_SESSION['text'] = $formula_data;
    }

}


//ルートのボタンが押されたときの処理
if(isset($_POST['square_root']))
{
    if(is_array($formula_data)){
        $formula_str = implode('' , $formula_data);    //$formula_str：計算式の文字列
    }else{
        $formula_str = $formula_data;
    }
    if($_SESSION['text'] != null){
        if( ! (preg_match("/ \＋ /", $formula_str) || preg_match("/ \－ /", $formula_str) || preg_match("/ \× /", $formula_str) || preg_match("/ \÷ /", $formula_str) ) ) {
            $_SESSION['text'] = [];
            $after_root = sqrt((float)$formula_str);
            $formula_data = explode("/\./", $after_root);
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
if(isset($_POST['calculation'])){
    calc_button($formula_data);
}


//　「＝」が押されたときの処理
global $history;
$history = array();
if(isset($_POST['result'])) {
    if($_SESSION['text'] != null) {
        if(is_array($formula_data)) {
            $formula_str = implode('' , $formula_data);
        }else{
            $formula_str = $formula_data;
        }
        if(preg_match("/[^ ]$/",$formula_str)){    //計算式の最後が演算子の場合に「＝」が押されたらこのif文以下は実行されない{
            if(preg_match("/ \＋ /", $formula_str, $cal_method) || preg_match("/ \－ /", $formula_str, $cal_method) || preg_match("/ \× /", $formula_str, $cal_method) || preg_match("/ \÷ /", $formula_str, $cal_method)  ) {
                calc($formula_str, $cal_method[0]);
                if($_SESSION['text'] != "ERROR") {
                    $history = store_record($formula);
                    $_SESSION['record'] = $history;
                }
            }
            $history = $_SESSION['record'];
        }
    }
}

//ACボタンの処理
if($_POST['reset'])
{
    $_SESSION['text'] = [];
}
?>

<input type = text name = "text" size = "50" style = "text-align : left; font-size: 30px; "
       value = "<?php
       if(($_POST['numbutton'] || $_POST['zerobutton'] === "0" || $_POST['zerobutton'] === "00" || $_POST['dotbutton'] || $_POST['calculation'] || $_POST['result'] || $_POST['square_root']) && $_SESSION['text'] != null){
           if(is_string($_SESSION['text'])){
               echo($_SESSION['text']);
           }
           else{
               foreach($_SESSION['text'] as $value){
                   echo ($value);
               }
           }
       }else{
           $_SESSION['text'] = 0;
           echo($_SESSION['text']);
       }
       ?>"><br />

<form name = "button"  method = 'POST' action = 'dentaku.php'>
    <input name = "delete" type = submit value = "履歴を削除する">
    <?php
    if(isset($_POST['delete'])){
        $_SESSION['record'] = [];
    }
    ?><br />
    計算履歴<br />
    <textarea name = "record" style = "font-size: 30px; text-align: center " cols = "40" rows = "5"><?php
        if(is_array($_SESSION['record'])){
            foreach($_SESSION['record'] as $value){
                echo($value."\n");
            }
        }else{
            echo($_SESSION['record']);
        }

        ?></textarea>
    <br />
</form>
</body>
</html>