<?php
    header("content-type:text/html;charset=utf-8");  //设置页面内容是html  编码是utf-8
    error_reporting(E_ALL &~ E_NOTICE);     //屏蔽错误信息
    include 'connect.php';     //调用数据库连接文
    session_start();
    //$name_encoded = base64_encode($username);   //查找此姓名对应的id
    if( isset($_SESSION['username']) ){
        echo $_SESSION['username'];
    }
    else{
        echo "NULL";
    }
?>
