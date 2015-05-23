<?php
/**
 * Created by PhpStorm.
 * User: yuchuan
 * Date: 2015/5/21
 * Time: 14:14
 * 保存编辑内容到数据库
 */
if (!empty($_POST["content"])) {
    $con = mysql_connect("localhost", "root", "");
    //echo $_POST["content"];
    if (!$con) {
        echo "failed";
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("test", $con);
    $msg = $_POST["content"];
    //echo $msg;
    $sql = "insert into push_msg(push_html) VALUES ('$msg')";
    mysql_query("SET NAMES UTF8");
    $result = mysql_query($sql, $con);
    if (!$result) {
        die('Error: ' . mysql_error());
    }
    echo 'insert result:' . $result;
    mysql_close($con);
} else echo "编辑内容为空";