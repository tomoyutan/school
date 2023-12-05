<?php

function show_top($heading="学生一覧"){
    echo<<<STUDENT_LIST
    <heml>
        <head>
            <title>学生リスト</title>
        </head>
        <body>
            <h1>{$heading}</h1>
    STUDENT_LIST;
}

function show_bottom($return_top=false){

    if($return_top == true) {
        echo <<<BACK_TOP
            <a href="index.php">学生一覧に戻る</a>
        BACK_TOP;
    }
    echo <<<BOTTOM
    </body>
    </heml>
    BOTTOM;
}

function show_input(){
    $error = get_error();
    show_edit_input_common("","" , -1,"","create","登録");
}

function show_delete($member) {
    if($member !=null){
        show_student($member);
    }
    $error = "";
    $error = get_error();
    echo <<< DERETE
        <form action="post_data.php" method="post">
            <p>この情報を削除しますか？</p>
            <p>{$error}</p>
            <input type="hidden" name="id" value="{$member["id"]}"/>
            <input type="hidden" name="data" value="delete" />
            <input type="submit" value="削除"/>
        </form>
    DERETE;
}

function show_update($id, $name, $grade, $old_id) {
    show_edit_input_common($id, $name, $grade, $old_id, "update", "更新");
}

function show_edit_input_common($id, $name, $grade, $old_id, $data, $botton) {
    $error = "";
    $error = get_error();

    echo <<<INPUT_TOP
    <from action="post_date.php" method="post">
    <p>学生番号</p>
    <input type="text" name="id" placeholder="例"）1001" value="{$id}">
    <p>名前</p>
    <input type="text" name="name" placehplder="例"）山田太郎" value="{$name}">
    <p>学年</p>
    <select name="garde">
    INPUT_TOP;
    
    for ($i = 1; $i <= 3; $i++){
        echo "<option value=\"{$i}\"";
        if ($i == $grade) {
            echo "selected ";
    }
    echo ">";
    echo $i;
    echo "</option>";
}

echo <<< INPUT_BOTTOM
</select>
    <p>{$error}</p>
    <input type="hidden" name="old_id" value="{$old_id}">
    <input type="hidden" name="data" value="{$data}">
    <input type="submit" value="{$botton}">
</form>
INPUT_BOTTOM;
}

function show_student_list($member) {

    echo <<<TABLE_TOP
    <table border= "1" style="border-collapse:collapse">
    <tr>
    <th>学生番号</th><th width="100px">名前</th><th>学生</th>
    </tr>
    TABLE_TOP;
    foreach($member as $loop) {

        echo <<<END
            <tr aling="center">
                <td>{$loop["id"]}</td>
                <td><a href="student_edit.php?id={$loop["id"]}">{$loop["name"]}</a></td>
                <td>{$loop["grade"]}</td>
                </tr>

        END;
    }

    echo <<<TABLE_BOTTOM
    </table>
    <br>
    TABLE_BOTTOM;            
}

function show_student($member) {

    echo <<<STUDENT
    <table border="1" style="border-collapse:collase">
    <tr>
        <th>学生番号</th><th width="100px">名前</th><th>学年</th>
        </tr>
        <tr align="center">
            <td>{$member["id"]}</td>
            <td>{$member["name"]}</td>
            <td>{$member["grade"]}</td>
        </tr>
    </table>
    <br>
    STUDENT;
}

function show_operations($id) {
    echo <<<OPERATIONS
    <a href="student_update.php?id={$id}">情報の更新</a>
    <br>
    <a href="student_delete.php?id={$id}">情報の削除</a>
    <br>
    <br>
    OPERATIONS;
}
?>