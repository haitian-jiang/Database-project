<?php

define('HOST','101.94.138.133');
define('USER','root');
// define('PASS','a760c29fc9f6c45306f3998b7ae68ed4');
define('PASS','MyPasswd');
define('DBNM','qbpc');  //定义数据库连接常量
$conn=new mysqli(HOST,USER,PASS,DBNM);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
$conn->set_charset('utf8');
?>