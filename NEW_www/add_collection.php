<?php
    header("content-type:text/html;charset=utf-8");  //设置页面内容是html  编码是utf-8
    error_reporting(E_ALL &~ E_NOTICE);     //屏蔽错误信息
    include 'connect.php';     //调用数据库连接文件

    $pid = $_POST['paper_id'];     //接收前台post值
    session_start();
    $username = $_SESSION['username'];
    $name_encoded = base64_encode($username);
    //echo $name_encoded;   
    $uidsql = "SELECT * FROM user WHERE username = '$name_encoded'";
    $uidres = $conn->query($uidsql);
    $uidrow = $uidres->fetch_object();
    $uid = $uidrow->id;

    $timesql = "SELECT DATE_FORMAT(NOW(), '%Y-%m-%d %h:%i:%s')";
    $timeres = $conn->query($timesql);
    $time = $timeres->fetch_row();
    $time = $time[0];   //获取添加的时间
    
    $insertsql = "INSERT favourite (`uid`, `pid`, `collect_time`) VALUES ('$uid', '$pid', '$time')";
    $send = $conn->query($insertsql);   //向favourite表中添加这条记录
    if ($send)
        echo true;
    else
        echo false;
?>