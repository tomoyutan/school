<?php
    try{
        $db = new PDO('mysql:host=localhost;dbname=school','root','root');
        $stmt = $db->prepare("SELECT * FROM student;");

        $res = $stmt->execute();
        if($res){
            $all = $stmt->fetchAll();
            foreach($all as $loop){
                echo "id&nbsp;=&nbsp;". $loop["id"];
                echo "&nbsp;name&nbsp;=&nbsp;". $loop["name"];
                echo "id&nbsp;grade&nbsp=&nbsp;". $loop["grade"].
"<br>";
            }
        }
        $db = null;
    } catch(PDOException $e) {
        echo "データベース接続失敗<br>";
        echo $e->getMessage();
    }
?>