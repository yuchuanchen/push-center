<?php
/**
 * Created by PhpStorm.
 * User: yuchuan
 * Date: 2015/5/23
 * Time: 15:23
 */
try{
    $pdo = new PDO('mysql:dbname=test;host=localhost;charset=utf8','root','');
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}catch (PDOException $e){
    echo '数据库连接失败：'.$e->getMessage();
    exit;
}