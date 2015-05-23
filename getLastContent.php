<?php
/**
 * Created by PhpStorm.
 * User: yuchuan
 * Date: 2015/5/21
 * Time: 15:24
 * 获取最新一次编辑的推送内容
 */
if ("yes" == $_GET["getcontent"]) {
    $con = mysql_connect("localhost", "root", "");
    //echo $_POST["content"];
    if (!$con) {
        echo "failed";
        die('Could not connect: ' . mysql_error());
    }
    //选择数据库
    mysql_select_db("test", $con);
    $sql = "select push_html from push_msg order by push_id desc limit 1";
    //配置UTF-8编码
    mysql_query("SET NAMES UTF8");
    $result = mysql_query($sql, $con);
    if (!$result) {
        die('Error: ' . mysql_error());
    }
    $t = mysql_fetch_array($result)[0];
    if ($t) {
        echo $t . "数据库push_msg字段值：" . htmlspecialchars($t);
    }
    //echo mysql_fetch_array($result)[0];
    //echo
    mysql_close($con);
}