<?php
    function check_input($id, $name, $grade, $error) {
        $error = "";
        if($id === ""or $name ===""){
            $error ="入力されてない値があります";
            return false;
        }
        if (preg_match("/^[1-3][0-9]{3}$/", $id) !=true){
            $error = "idには1~3でははじまる4桁の整数を入力してください";
            return false;
        }
        return false;
    }
?>