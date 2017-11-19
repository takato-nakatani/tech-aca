<?php

    function button_data($button)
    {
        if(is_string($_SESSION['text'])){
            $num_array = array();
            $num_array[] = $_SESSION['text']; //配列に現在の履歴を代入
            $num_array[] = $button;  //今回の数値を最後列に格納
        }else
        {
            //push_array関数が使えるかも
            $num_array = $_SESSION['text']; //配列に現在の履歴を代入
            $num_array[] = $button;  //今回の数値を最後列に格納
        }

        //50文字以上は読み込めないように制御
        if (count($num_array) > 50) {  //count関数：配列の要素数を取得する
            array_shift($num_array);
        }

        return $num_array;

    }

    function store_record($new_formula){
        if($_SESSION['record'][-2] == null){
            if(is_string($_SESSION['record'])){
                $record_array = array();
                $record_array[] = $_SESSION['record']; //配列に現在の履歴を代入
                $record_array[] = $new_formula;  //今回の数値を最後列に格納
            }else{
                $record_array = $_SESSION['record']; //配列に現在の履歴を代入

                $record_array[] = $new_formula;  //今回の数値を最後列に格納

            }

            //履歴数が5を超えたら古いものから順番に削除する
            if(count($record_array) > 5){
                array_shift($record_array);
            }


        }
        return $record_array;
    }



    function display_method($text_info){



        switch($text_info[1]){
            case " + " :
                $text_info[1] = " ＋ ";
                break;

            case " - " :
                $text_info[1] = " － ";
                break;

            case " * " :
                $text_info[1] = " × ";
                break;

            case " / " :
                $text_info[1] = " ÷ ";
                break;

            default :
                break;

        }

        if(is_string($text_info)){
            echo($text_info);
        }else{
            foreach($text_info as $value){
                echo ($value);
            }
        }


        switch($text_info[1]){
            case " ＋ " :
                $text_info[1] = " + ";
                break;

            case " － " :
                $text_info[1] = " - ";
                break;

            case " × " :
                $text_info[1] = " * ";
                break;

            case " ÷ " :
                $text_info[1] = " / ";
                break;

            default :
                break;

        }


    }



?>



