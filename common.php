<?php
require_once("common/html_functions.php");
require_once("common/dbmanager.php");
require_once("common/data_check.php");

function get_error(){
    $error = "";
    if(isset($GET["error"])){
        $error = $GET["error"];
    }
    return $error;
}
$dbm = new DBManager();

?>
